/**
 * Offline engine for the admin POS screen.
 *
 * Scope (see README for the full explanation given to the store owner):
 *  - Ringing up NEW sales (browse cached catalog, barcode lookup, cart
 *    math, pick an already-known customer, discount, checkout) keeps
 *    working with zero network connectivity, using an IndexedDB cache of
 *    the product catalog and a locally-queued "pending sale" per
 *    checkout.
 *  - Creating a brand-new customer while offline is NOT supported (needs
 *    a server-side uniqueness check on email) — the "+" button is
 *    disabled with an explanatory message while offline.
 *  - Refunds are NOT supported offline — that screen requires the
 *    server's authoritative "how much of this line is still returnable"
 *    state to avoid double-refunding.
 *  - The POS page itself must have been loaded once while online each
 *    session (this file doesn't install a Service Worker to cache the
 *    page shell) — after that, the tab keeps working fully offline.
 *
 * Exposes `window.PosOffline` with everything admin-pos.js needs; talks
 * to IndexedDB directly, never to jQuery/Bootstrap (kept UI-agnostic).
 */
(function () {
    'use strict';

    var DB_NAME = 'shopperzz_pos_offline';
    var DB_VERSION = 1;
    var STORE_NAMES = ['products', 'categories', 'brands', 'customers', 'pending_sales', 'meta'];

    var dbPromise = null;
    var catalog = { products: [], categories: [], brands: [], customers: [] };
    var listeners = { connectivity: [], syncQueue: [] };

    function openDb() {
        if (dbPromise) return dbPromise;

        dbPromise = new Promise(function (resolve, reject) {
            if (!window.indexedDB) {
                reject(new Error('IndexedDB not supported in this browser.'));
                return;
            }
            var req = indexedDB.open(DB_NAME, DB_VERSION);
            req.onupgradeneeded = function (e) {
                var db = e.target.result;
                STORE_NAMES.forEach(function (name) {
                    if (!db.objectStoreNames.contains(name)) {
                        var keyPath = name === 'pending_sales' ? 'offline_id' : (name === 'meta' ? 'key' : 'id');
                        db.createObjectStore(name, { keyPath: keyPath });
                    }
                });
            };
            req.onsuccess = function (e) { resolve(e.target.result); };
            req.onerror = function () { reject(req.error); };
        });

        return dbPromise;
    }

    function tx(storeName, mode) {
        return openDb().then(function (db) {
            return db.transaction(storeName, mode).objectStore(storeName);
        });
    }

    function idbGetAll(storeName) {
        return tx(storeName, 'readonly').then(function (store) {
            return new Promise(function (resolve, reject) {
                var req = store.getAll();
                req.onsuccess = function () { resolve(req.result || []); };
                req.onerror = function () { reject(req.error); };
            });
        });
    }

    function idbClearAndFill(storeName, items) {
        return openDb().then(function (db) {
            return new Promise(function (resolve, reject) {
                var t = db.transaction(storeName, 'readwrite');
                var store = t.objectStore(storeName);
                store.clear();
                items.forEach(function (item) { store.put(item); });
                t.oncomplete = function () { resolve(); };
                t.onerror = function () { reject(t.error); };
            });
        });
    }

    function idbPut(storeName, item) {
        return tx(storeName, 'readwrite').then(function (store) {
            return new Promise(function (resolve, reject) {
                var req = store.put(item);
                req.onsuccess = function () { resolve(); };
                req.onerror = function () { reject(req.error); };
            });
        });
    }

    function idbDelete(storeName, key) {
        return tx(storeName, 'readwrite').then(function (store) {
            return new Promise(function (resolve, reject) {
                var req = store.delete(key);
                req.onsuccess = function () { resolve(); };
                req.onerror = function () { reject(req.error); };
            });
        });
    }

    // ---------------------------------------------------------------
    // Connectivity — navigator.onLine only reflects link-layer state
    // (a laptop connected to wifi with no real internet still reads
    // "online"), so this is backed up with a periodic real HTTP probe.
    // ---------------------------------------------------------------

    var online = navigator.onLine;
    var probeUrl = null; // set via PosOffline.init()
    var probeTimer = null;

    function setOnline(next) {
        if (next === online) return;
        online = next;
        listeners.connectivity.forEach(function (fn) { fn(online); });
        if (online) trySync();
    }

    function probeOnce() {
        if (!probeUrl) return;
        var controller = window.AbortController ? new AbortController() : null;
        var timeout = controller ? setTimeout(function () { controller.abort(); }, 4000) : null;

        fetch(probeUrl, { method: 'HEAD', cache: 'no-store', signal: controller ? controller.signal : undefined })
            .then(function (res) {
                if (timeout) clearTimeout(timeout);
                setOnline(res.ok || (res.status >= 200 && res.status < 500));
            })
            .catch(function () {
                if (timeout) clearTimeout(timeout);
                setOnline(false);
            });
    }

    window.addEventListener('online', probeOnce);
    window.addEventListener('offline', function () { setOnline(false); });

    // ---------------------------------------------------------------
    // Catalog cache
    // ---------------------------------------------------------------

    var lastSyncedAt = null;
    var catalogUrl = null;

    function loadCatalogFromIdb() {
        return Promise.all([
            idbGetAll('products'), idbGetAll('categories'), idbGetAll('brands'), idbGetAll('customers'), idbGetAll('meta')
        ]).then(function (results) {
            catalog.products = results[0];
            catalog.categories = results[1];
            catalog.brands = results[2];
            catalog.customers = results[3];
            var meta = results[4].reduce(function (acc, m) { acc[m.key] = m.value; return acc; }, {});
            lastSyncedAt = meta.synced_at || null;
        });
    }

    function refreshCatalog() {
        if (!online || !catalogUrl) return Promise.resolve(false);

        return fetch(catalogUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (res) { if (!res.ok) throw new Error('catalog fetch failed'); return res.json(); })
            .then(function (data) {
                return Promise.all([
                    idbClearAndFill('products', data.products),
                    idbClearAndFill('categories', data.categories),
                    idbClearAndFill('brands', data.brands),
                    idbClearAndFill('customers', data.customers),
                    idbPut('meta', { key: 'synced_at', value: data.synced_at }),
                    idbPut('meta', { key: 'currency', value: data.currency })
                ]);
            })
            .then(function () { return loadCatalogFromIdb(); })
            .then(function () { return true; })
            .catch(function () { return false; });
    }

    // ---------------------------------------------------------------
    // Pending sales queue (sales rung up while offline)
    // ---------------------------------------------------------------

    function queueSale(sale) {
        // sale: { offline_id, items, customer_id, payment_method,
        //         amount_tendered, discount_type, discount_value,
        //         totals, customer_name, created_at }
        return idbPut('pending_sales', sale).then(function () {
            listeners.syncQueue.forEach(function (fn) { fn(); });
        });
    }

    var syncing = false;

    function trySync() {
        if (syncing || !online) return;
        syncing = true;

        idbGetAll('pending_sales').then(function (sales) {
            sales.sort(function (a, b) {
                if (a.created_at < b.created_at) return -1;
                if (a.created_at > b.created_at) return 1;
                return 0;
            });
            return syncNext(sales, 0);
        }).finally(function () { syncing = false; });
    }

    function syncNext(sales, index) {
        if (index >= sales.length) {
            return idbPut('meta', { key: 'last_sync_run', value: new Date().toISOString() }).then(function () {
                listeners.syncQueue.forEach(function (fn) { fn(); });
            });
        }

        var sale = sales[index];
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        return fetch(window.posRoutes.sync, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: JSON.stringify(sale)
        }).then(function (res) {
            if (!res.ok) throw new Error('sync failed for ' + sale.offline_id);
            return res.json();
        }).then(function () {
            return idbDelete('pending_sales', sale.offline_id);
        }).then(function () {
            listeners.syncQueue.forEach(function (fn) { fn(); });
            return syncNext(sales, index + 1);
        }).catch(function () {
            // Stop here — still offline or a transient server error.
            // The rest of the queue stays put and will retry on the
            // next connectivity event / periodic probe.
        });
    }

    // ---------------------------------------------------------------
    // Local (offline) cart math — mirrors PosCartService's rules
    // exactly (see app/Services/PosCartService.php) so totals match
    // what the server would have computed.
    // ---------------------------------------------------------------

    function findProduct(id) {
        id = parseInt(id, 10);
        for (var i = 0; i < catalog.products.length; i++) {
            if (catalog.products[i].id === id) return catalog.products[i];
        }
        return null;
    }

    function findProductByCode(code) {
        var bySku = catalog.products.find(function (p) { return p.sku && p.sku === code; });
        if (bySku) return bySku;
        if (/^\d+$/.test(code)) return findProduct(parseInt(code, 10));
        return null;
    }

    function lineKey(productId, optionIds) {
        var sorted = (optionIds || []).slice().sort(function (a, b) { return a - b; });
        return String(productId) + (sorted.length ? '-' + sorted.join('-') : '');
    }

    function LocalCart() {
        this.lines = {}; // key -> {product_id, option_ids, quantity}
        this.customerId = null;
        this.discountType = 'percentage';
        this.discountValue = 0;
    }

    LocalCart.prototype.add = function (productId, optionIds, quantity) {
        var key = lineKey(productId, optionIds);
        if (this.lines[key]) {
            this.lines[key].quantity += quantity;
        } else {
            this.lines[key] = { product_id: productId, option_ids: optionIds || [], quantity: quantity };
        }
    };

    LocalCart.prototype.updateQuantity = function (key, quantity) {
        if (!this.lines[key]) return;
        if (quantity < 1) delete this.lines[key];
        else this.lines[key].quantity = quantity;
    };

    LocalCart.prototype.remove = function (key) { delete this.lines[key]; };
    LocalCart.prototype.clear = function () { this.lines = {}; this.customerId = null; this.discountType = 'percentage'; this.discountValue = 0; };
    LocalCart.prototype.setCustomer = function (id) { this.customerId = id || null; };
    LocalCart.prototype.setDiscount = function (type, value) { this.discountType = type === 'fixed' ? 'fixed' : 'percentage'; this.discountValue = Math.max(0, parseFloat(value) || 0); };

    LocalCart.prototype.hydratedItems = function () {
        var self = this;
        return Object.keys(this.lines).map(function (key) {
            var line = self.lines[key];
            var product = findProduct(line.product_id);
            if (!product) return null;

            var selectedOptions = [];
            (product.variant_groups || []).forEach(function (group) {
                (group.options || []).forEach(function (option) {
                    if (line.option_ids.indexOf(option.id) !== -1) selectedOptions.push(option);
                });
            });
            var priceModifierSum = selectedOptions.reduce(function (s, o) { return s + (parseFloat(o.price_modifier) || 0); }, 0);
            var variantSummary = selectedOptions.map(function (o) { return o.value; }).join(' | ');

            var unitPrice = round2(product.effective_price + priceModifierSum);
            var lineTotal = round2(unitPrice * line.quantity);
            var taxRate = product.tax_rate || 0;
            var lineTax = round2(lineTotal * (taxRate / 100));

            return {
                key: key,
                product_id: product.id,
                option_ids: line.option_ids,
                title: product.title,
                image: product.image,
                variant: variantSummary,
                unit_price: unitPrice,
                unit_price_formatted: unitPrice.toFixed(2),
                quantity: line.quantity,
                line_total: lineTotal,
                line_total_formatted: lineTotal.toFixed(2),
                tax_rate: taxRate,
                line_tax: lineTax
            };
        }).filter(Boolean);
    };

    function round2(n) { return Math.round((n + Number.EPSILON) * 100) / 100; }

    LocalCart.prototype.totals = function () {
        var items = this.hydratedItems();
        var subtotal = round2(items.reduce(function (s, i) { return s + i.line_total; }, 0));
        var tax = round2(items.reduce(function (s, i) { return s + i.line_tax; }, 0));

        var discount = 0;
        if (this.discountValue > 0) {
            discount = this.discountType === 'fixed' ? this.discountValue : subtotal * (this.discountValue / 100);
            discount = round2(Math.min(discount, subtotal));
        }

        var total = Math.max(0, round2(subtotal + tax - discount));
        return { subtotal: subtotal, tax: tax, discount: discount, total: total };
    };

    LocalCart.prototype.payload = function () {
        var items = this.hydratedItems();
        // Customer display name for offline mode is looked up from the
        // existing <select> element in the DOM instead (admin-pos.js) —
        // that select is already rendered server-side and always
        // available, so this only needs the id round-tripped.
        return {
            items: items,
            count: items.reduce(function (s, i) { return s + i.quantity; }, 0),
            customer: this.customerId ? { id: this.customerId, name: null } : null,
            discount_type: this.discountType,
            discount_value: this.discountValue,
            totals: this.totals(),
            currency: window.posCurrency || ''
        };
    };

    LocalCart.prototype.isEmpty = function () { return Object.keys(this.lines).length === 0; };

    var localCart = new LocalCart();

    // ---------------------------------------------------------------
    // Public API
    // ---------------------------------------------------------------

    window.PosOffline = {
        init: function (opts) {
            probeUrl = opts.probeUrl;
            catalogUrl = opts.catalogUrl;

            return loadCatalogFromIdb().then(function () {
                if (online) return refreshCatalog();
            }).then(function () {
                probeOnce();
                probeTimer = setInterval(probeOnce, 20000);
                setInterval(function () { if (online) refreshCatalog(); }, 5 * 60 * 1000);
                trySync();
            });
        },
        isOnline: function () { return online; },
        onConnectivityChange: function (fn) { listeners.connectivity.push(fn); },
        onSyncQueueChange: function (fn) { listeners.syncQueue.push(fn); },
        refreshCatalog: refreshCatalog,
        getLastSyncedAt: function () { return lastSyncedAt; },
        pendingCount: function () { return idbGetAll('pending_sales').then(function (s) { return s.length; }); },
        findProductByCode: findProductByCode,
        findProduct: findProduct,
        catalogProducts: function () { return catalog.products; },
        catalogCategories: function () { return catalog.categories; },
        catalogBrands: function () { return catalog.brands; },
        cart: localCart,
        queueSale: queueSale,
        trySync: trySync,
        generateOfflineId: function () {
            return 'off_' + Date.now() + '_' + Math.random().toString(36).slice(2, 10);
        }
    };
})();
