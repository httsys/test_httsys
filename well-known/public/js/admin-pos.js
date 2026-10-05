/**
 * Admin POS screen behaviour. Talks to the PosController/PosOrderController
 * JSON endpoints (see routes/web.php, the "Point of Sale" block) and keeps
 * the cart panel in sync without ever reloading the page.
 *
 * Route URLs are handed in from the Blade view via `window.posRoutes`
 * (see resources/views/admin/pos/index.blade.php) instead of being
 * hard-coded here, so this file has no Laravel-specific syntax in it.
 */
(function () {
    'use strict';

    var routes = window.posRoutes || {};
    var currencySymbol = window.posCurrency || '';
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    var state = {
        selectedGroups: {}, // { groupId: optionId } while the variation modal is open
        currentVariationProduct: null,
        currentVariationIsOffline: false,
        paymentMethod: 'cash',
        lastOrderTotal: 0,
        saleMode: null // 'online' | 'offline' — decided fresh each time the cart is empty
    };

    // A whole sale is rung up in ONE mode, decided the moment the first
    // item goes into an empty cart, based on connectivity at that exact
    // moment — not re-evaluated mid-sale, so a connection blip halfway
    // through ringing something up can't leave the cart in a confused
    // half-online, half-offline state. Whichever mode is chosen, every
    // dispatch* function below routes to the matching implementation but
    // always resolves to the exact same payload shape for renderCart().
    function ensureSaleMode() {
        if (state.saleMode === null) {
            state.saleMode = (window.PosOffline && !window.PosOffline.isOnline()) ? 'offline' : 'online';
        }
        return state.saleMode;
    }

    function isOfflineSale() {
        return ensureSaleMode() === 'offline';
    }

    function localPayload() {
        return Promise.resolve(window.PosOffline.cart.payload());
    }

    function money(n) {
        n = Number(n) || 0;
        return currencySymbol + n.toFixed(2);
    }

    function jsonFetch(url, options) {
        options = options || {};
        options.headers = Object.assign({
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }, options.headers || {});

        if (options.body && !(options.body instanceof FormData)) {
            options.headers['Content-Type'] = 'application/json';
        }

        return fetch(url, options).then(function (res) {
            return res.json().then(function (data) {
                if (!res.ok) {
                    var err = new Error(data.message || 'Request failed');
                    err.data = data;
                    err.status = res.status;
                    throw err;
                }
                return data;
            });
        });
    }

    function postJson(url, payload) {
        return jsonFetch(url, { method: 'POST', body: JSON.stringify(payload || {}) });
    }

    // Safety net for any cart action that started an online request and
    // then genuinely lost the connection mid-flight (fetch() rejects
    // outright rather than resolving with a non-2xx response in that
    // case) — rather than failing silently. Most individual actions
    // below don't each carry their own .catch for this rare case, so one
    // shared listener covers all of them; debounced so a burst of
    // several failed requests only shows the message once.
    var lastNetworkWarning = 0;
    window.addEventListener('unhandledrejection', function (e) {
        var now = Date.now();
        if (now - lastNetworkWarning < 4000) return;
        lastNetworkWarning = now;
        alert('Connection to the server was lost while making a change. If you\'re now offline, finish this sale offline (it will sync automatically once you\'re back online) — or press Cancel and start again.');
    });

    // ---------------------------------------------------------------
    // Product grid + filters
    // ---------------------------------------------------------------

    var grid = document.getElementById('pos-product-grid');
    var searchInput = document.getElementById('pos-search');
    var categorySelect = document.getElementById('pos-category');
    var brandSelect = document.getElementById('pos-brand');
    var searchTimer = null;

    function currentFilterUrl(base) {
        var params = new URLSearchParams();
        if (searchInput.value.trim()) params.set('search', searchInput.value.trim());
        if (categorySelect.value) params.set('category_id', categorySelect.value);
        if (brandSelect.value) params.set('brand_id', brandSelect.value);
        return base + (params.toString() ? '?' + params.toString() : '');
    }

    function loadProducts(url) {
        if (!window.PosOffline || !window.PosOffline.isOnline()) {
            renderOfflineGrid();
            return;
        }

        grid.style.opacity = '0.5';
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                grid.innerHTML = data.html;
                grid.style.opacity = '1';
                bindProductCards();
                bindPagination();
            });
    }

    // Offline fallback: filters/paginates the IndexedDB-cached catalog
    // client-side and builds the exact same card markup (same classes,
    // same data-id/data-has-variants attributes) the server partial
    // produces, so bindProductCards()/click handling need no changes.
    var OFFLINE_PAGE_SIZE = 18;
    var offlinePage = 1;

    function renderOfflineGrid() {
        if (!window.PosOffline) return;

        var term = searchInput.value.trim().toLowerCase();
        var categoryId = categorySelect.value;
        var brandId = brandSelect.value;

        var products = window.PosOffline.catalogProducts().filter(function (p) {
            if (!p.is_active) return false;
            if (term && p.title.toLowerCase().indexOf(term) === -1 && (!p.sku || p.sku.toLowerCase().indexOf(term) === -1)) return false;
            if (categoryId && String(p.product_category_id) !== String(categoryId)) return false;
            if (brandId && String(p.brand_id) !== String(brandId)) return false;
            return true;
        });

        var totalPages = Math.max(1, Math.ceil(products.length / OFFLINE_PAGE_SIZE));
        offlinePage = Math.min(offlinePage, totalPages);
        var pageItems = products.slice((offlinePage - 1) * OFFLINE_PAGE_SIZE, offlinePage * OFFLINE_PAGE_SIZE);

        var html = '<div class="alert alert-warning py-1 px-2 small mb-2"><i class="fas fa-wifi mr-1"></i>Offline — showing the last synced catalog.</div><div class="row">';

        if (!pageItems.length) {
            html += '<div class="col-12 text-center text-muted py-5">No products found.</div>';
        }

        pageItems.forEach(function (p) {
            var hasSale = p.sale_price && p.sale_price > 0 && p.sale_price < p.price;
            var priceHtml = hasSale
                ? '<span class="font-weight-bold">' + money(p.sale_price) + '</span> <small class="text-muted"><del>' + money(p.price) + '</del></small>'
                : '<span class="font-weight-bold">' + money(p.price) + '</span>';
            var variantCount = (p.variant_groups || []).length;

            html += '<div class="col-6 col-md-4 col-xl-3 mb-3">' +
                '<div class="card h-100 pos-product-card shadow-sm" data-id="' + p.id + '" data-has-variants="' + variantCount + '" role="button">' +
                (p.is_flash_sale ? '<span class="badge badge-dark position-absolute" style="top:8px;left:8px;">Flash Sale</span>' : '') +
                '<img src="' + p.image + '" class="card-img-top" style="height:140px;object-fit:cover;" alt="">' +
                '<div class="card-body p-2">' +
                '<div class="small font-weight-bold text-truncate" title="' + p.title + '">' + p.title + '</div>' +
                '<div>' + priceHtml + '</div>' +
                (p.stock !== null && p.stock !== undefined ? '<div class="small text-muted">Stock: ' + p.stock + '</div>' : '') +
                '</div></div></div>';
        });

        html += '</div><div class="pos-pagination d-flex justify-content-center">' +
            '<button type="button" class="btn btn-sm btn-outline-secondary mr-2" id="pos-offline-prev" ' + (offlinePage <= 1 ? 'disabled' : '') + '>&laquo; Prev</button>' +
            '<span class="align-self-center small text-muted">Page ' + offlinePage + ' / ' + totalPages + '</span>' +
            '<button type="button" class="btn btn-sm btn-outline-secondary ml-2" id="pos-offline-next" ' + (offlinePage >= totalPages ? 'disabled' : '') + '>Next &raquo;</button>' +
            '</div>';

        grid.innerHTML = html;
        bindProductCards();

        var prevBtn = document.getElementById('pos-offline-prev');
        var nextBtn = document.getElementById('pos-offline-next');
        if (prevBtn) prevBtn.addEventListener('click', function () { offlinePage--; renderOfflineGrid(); });
        if (nextBtn) nextBtn.addEventListener('click', function () { offlinePage++; renderOfflineGrid(); });
    }

    function reloadWithFilters() {
        offlinePage = 1;
        if (window.PosOffline && !window.PosOffline.isOnline()) {
            renderOfflineGrid();
        } else {
            loadProducts(currentFilterUrl(routes.products));
        }
    }

    searchInput.addEventListener('input', function () {
        clearTimeout(searchTimer);
        searchTimer = setTimeout(reloadWithFilters, 350);
    });
    categorySelect.addEventListener('change', reloadWithFilters);
    brandSelect.addEventListener('change', reloadWithFilters);

    function bindPagination() {
        grid.querySelectorAll('.pagination a[href]').forEach(function (a) {
            a.addEventListener('click', function (e) {
                e.preventDefault();
                loadProducts(a.getAttribute('href'));
            });
        });
    }

    function bindProductCards() {
        grid.querySelectorAll('.pos-product-card').forEach(function (card) {
            card.addEventListener('click', function () {
                var id = card.getAttribute('data-id');
                var hasVariants = parseInt(card.getAttribute('data-has-variants'), 10) > 0;
                var offline = isOfflineSale();

                if (hasVariants) {
                    if (offline) {
                        var product = window.PosOffline.findProduct(id);
                        if (product) openVariationModal(product, true);
                    } else {
                        openVariationModalForProduct(id);
                    }
                } else if (offline) {
                    window.PosOffline.cart.add(parseInt(id, 10), [], 1);
                    localPayload().then(renderCart);
                } else {
                    postJson(routes.cartAdd, { product_id: id, quantity: 1 }).then(renderCart);
                }
            });
        });
    }

    bindProductCards();
    bindPagination();

    // ---------------------------------------------------------------
    // Barcode box
    // ---------------------------------------------------------------

    var barcodeForm = document.getElementById('pos-barcode-form');
    var barcodeInput = document.getElementById('pos-barcode-input');

    barcodeForm.addEventListener('submit', function (e) {
        e.preventDefault();
        var code = barcodeInput.value.trim();
        if (!code) return;

        if (isOfflineSale()) {
            var product = window.PosOffline.findProductByCode(code);
            barcodeInput.value = '';
            barcodeInput.focus();

            if (!product) {
                alert('No product matches that barcode in the offline catalog.');
                return;
            }

            if ((product.variant_groups || []).length) {
                openVariationModal(product, true);
            } else {
                window.PosOffline.cart.add(product.id, [], 1);
                localPayload().then(renderCart);
            }
            return;
        }

        postJson(routes.barcode, { code: code }).then(function (data) {
            barcodeInput.value = '';
            barcodeInput.focus();

            if (data.needs_variation) {
                openVariationModal(data.product, false);
            } else {
                renderCart(data);
            }
        }).catch(function (err) {
            barcodeInput.value = '';
            barcodeInput.focus();
            alert(err.data && err.data.message ? err.data.message : 'Product not found.');
        });
    });

    // Most USB/Bluetooth barcode scanners just "type" the code into
    // whatever field has focus and then send Enter — so the field needs
    // focus at the moment of scanning. Bring it back after anything that
    // could have stolen focus (a modal closing, a click elsewhere on the
    // page) so the cashier can keep scanning item after item without
    // touching the mouse or keyboard in between.
    function refocusBarcode() {
        setTimeout(function () { barcodeInput.focus(); }, 150);
    }

    // ---------------------------------------------------------------
    // Product Variation modal
    // ---------------------------------------------------------------

    // Tiny wrapper around jQuery's $.fn.modal (this admin theme loads
    // bootstrap.bundle.min.js + jQuery, same as every other modal already
    // in the admin, e.g. the logout confirmation modal in the layout).
    function bsModal(el) {
        return {
            show: function () { window.jQuery(el).modal('show'); },
            hide: function () { window.jQuery(el).modal('hide'); }
        };
    }

    var variationModalEl = document.getElementById('posVariationModal');
    var variationModal = bsModal(variationModalEl);

    function openVariationModalForProduct(productId) {
        fetch(routes.variationBase.replace('__ID__', productId), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (res) { return res.json(); })
          .then(function (data) { openVariationModal(data.product); });
    }

    function openVariationModal(product, isOffline) {
        state.currentVariationProduct = product;
        state.currentVariationIsOffline = !!isOffline;
        state.selectedGroups = {};

        document.getElementById('pos-variation-title').textContent = product.title;
        document.getElementById('pos-variation-price').innerHTML = renderPriceHtml(product);
        document.getElementById('pos-variation-qty').value = 1;

        var mainImg = document.getElementById('pos-variation-main-image');
        mainImg.src = product.image;

        var thumbs = document.getElementById('pos-variation-thumbs');
        var images = [product.image].concat(product.gallery || []);
        thumbs.innerHTML = '';
        images.forEach(function (src, idx) {
            var t = document.createElement('img');
            t.src = src;
            t.className = 'pos-thumb' + (idx === 0 ? ' active' : '');
            t.addEventListener('click', function () {
                mainImg.src = src;
                thumbs.querySelectorAll('.pos-thumb').forEach(function (x) { x.classList.remove('active'); });
                t.classList.add('active');
            });
            thumbs.appendChild(t);
        });

        var groupsWrap = document.getElementById('pos-variation-groups');
        groupsWrap.innerHTML = '';

        (product.variant_groups || []).forEach(function (group) {
            if (!group.options.length) return;

            state.selectedGroups[group.id] = group.options[0].id;

            var row = document.createElement('div');
            row.className = 'mb-2';
            var label = document.createElement('div');
            label.className = 'small font-weight-bold mb-1';
            label.textContent = group.name + ':';
            row.appendChild(label);

            var pillWrap = document.createElement('div');
            group.options.forEach(function (option) {
                var pill = document.createElement('button');
                pill.type = 'button';
                pill.className = 'btn btn-sm btn-outline-secondary mr-1 mb-1 pos-variant-pill' + (option.id === group.options[0].id ? ' active' : '');
                pill.textContent = option.value;
                pill.setAttribute('data-group-id', group.id);
                pill.setAttribute('data-option-id', option.id);
                if (option.color_code) {
                    pill.style.borderLeft = '4px solid ' + option.color_code;
                }
                pill.addEventListener('click', function () {
                    state.selectedGroups[group.id] = option.id;
                    pillWrap.querySelectorAll('.pos-variant-pill').forEach(function (p) { p.classList.remove('active'); });
                    pill.classList.add('active');
                });
                pillWrap.appendChild(pill);
            });
            row.appendChild(pillWrap);
            groupsWrap.appendChild(row);
        });

        variationModal.show();
    }

    function renderPriceHtml(product) {
        var hasSale = product.sale_price && product.sale_price > 0 && product.sale_price < product.price;
        if (hasSale) {
            return '<span class="font-weight-bold">' + money(product.sale_price) + '</span> ' +
                   '<small class="text-muted"><del>' + money(product.price) + '</del></small>';
        }
        return '<span class="font-weight-bold">' + money(product.price) + '</span>';
    }

    document.getElementById('pos-variation-qty-minus').addEventListener('click', function () {
        var input = document.getElementById('pos-variation-qty');
        input.value = Math.max(1, (parseInt(input.value, 10) || 1) - 1);
    });
    document.getElementById('pos-variation-qty-plus').addEventListener('click', function () {
        var input = document.getElementById('pos-variation-qty');
        input.value = (parseInt(input.value, 10) || 1) + 1;
    });

    document.getElementById('pos-variation-add').addEventListener('click', function () {
        var product = state.currentVariationProduct;
        if (!product) return;

        var optionIds = Object.keys(state.selectedGroups).map(function (k) { return state.selectedGroups[k]; });
        var qty = parseInt(document.getElementById('pos-variation-qty').value, 10) || 1;

        if (state.currentVariationIsOffline || isOfflineSale()) {
            window.PosOffline.cart.add(product.id, optionIds.map(Number), qty);
            localPayload().then(function (data) {
                renderCart(data);
                variationModal.hide();
            });
            return;
        }

        postJson(routes.cartAdd, { product_id: product.id, option_ids: optionIds, quantity: qty }).then(function (data) {
            renderCart(data);
            variationModal.hide();
        });
    });

    // ---------------------------------------------------------------
    // Cart rendering
    // ---------------------------------------------------------------

    function dispatchUpdateQuantity(key, quantity) {
        if (isOfflineSale()) {
            window.PosOffline.cart.updateQuantity(key, quantity);
            localPayload().then(renderCart);
        } else {
            postJson(routes.cartUpdate, { key: key, quantity: quantity }).then(renderCart);
        }
    }

    function dispatchRemoveItem(key) {
        if (isOfflineSale()) {
            window.PosOffline.cart.remove(key);
            localPayload().then(renderCart);
        } else {
            postJson(routes.cartRemove, { key: key }).then(renderCart);
        }
    }

    var cartItemsEl = document.getElementById('pos-cart-items');
    var customerSelect = document.getElementById('pos-customer-select');
    var discountTypeSelect = document.getElementById('pos-discount-type');
    var discountValueInput = document.getElementById('pos-discount-value');

    function renderCart(data) {
        cartItemsEl.innerHTML = '';

        if (!data.items.length) {
            cartItemsEl.innerHTML = '<div class="text-center text-muted py-4">Cart is empty — scan a barcode or click a product.</div>';
        }

        data.items.forEach(function (item) {
            var row = document.createElement('div');
            row.className = 'd-flex align-items-center pos-cart-row mb-2 pb-2 border-bottom';
            row.innerHTML =
                '<img src="' + item.image + '" style="width:48px;height:48px;object-fit:cover;" class="rounded mr-2">' +
                '<div class="flex-grow-1">' +
                    '<div class="small font-weight-bold">' + item.title + '</div>' +
                    (item.variant ? '<div class="small text-muted">' + item.variant + '</div>' : '') +
                    '<div class="small">' + money(item.unit_price) + '</div>' +
                    '<div class="d-flex align-items-center mt-1">' +
                        '<button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 pos-qty-minus">-</button>' +
                        '<span class="mx-2">' + item.quantity + '</span>' +
                        '<button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 pos-qty-plus">+</button>' +
                        '<button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 ml-3 pos-remove"><i class="fas fa-trash"></i></button>' +
                    '</div>' +
                '</div>' +
                '<div class="font-weight-bold ml-2">' + money(item.line_total) + '</div>';

            row.querySelector('.pos-qty-minus').addEventListener('click', function () {
                dispatchUpdateQuantity(item.key, item.quantity - 1);
            });
            row.querySelector('.pos-qty-plus').addEventListener('click', function () {
                dispatchUpdateQuantity(item.key, item.quantity + 1);
            });
            row.querySelector('.pos-remove').addEventListener('click', function () {
                dispatchRemoveItem(item.key);
            });

            cartItemsEl.appendChild(row);
        });

        customerSelect.value = data.customer ? data.customer.id : '';
        discountTypeSelect.value = data.discount_type;
        discountValueInput.value = data.discount_value > 0 ? data.discount_value : '';

        document.getElementById('pos-subtotal').textContent = money(data.totals.subtotal);
        document.getElementById('pos-tax').textContent = money(data.totals.tax);
        document.getElementById('pos-discount').textContent = money(data.totals.discount);
        document.getElementById('pos-total').textContent = money(data.totals.total);

        state.lastOrderTotal = data.totals.total;
        document.getElementById('pos-order-btn').disabled = data.items.length === 0;
    }

    // Initial render from server-provided state (in case a sale was
    // already in progress before the page was refreshed).
    renderCart(JSON.parse(document.getElementById('pos-initial-cart').textContent));

    // ---------------------------------------------------------------
    // Customer select + "Customers" quick-add modal
    // ---------------------------------------------------------------

    customerSelect.addEventListener('change', function () {
        if (isOfflineSale()) {
            window.PosOffline.cart.setCustomer(customerSelect.value ? parseInt(customerSelect.value, 10) : null);
            localPayload().then(renderCart);
        } else {
            postJson(routes.customerSet, { customer_id: customerSelect.value || null }).then(renderCart);
        }
    });

    var customerModalEl = document.getElementById('posCustomerModal');
    var customerModal = bsModal(customerModalEl);

    document.getElementById('pos-add-customer-btn').addEventListener('click', function () {
        if (!window.PosOffline || !window.PosOffline.isOnline()) {
            alert('Adding a new customer needs an internet connection (to check the email isn\'t already in use). You can still pick any existing customer from the dropdown, or use Walking Customer, while offline.');
            return;
        }
        document.getElementById('pos-customer-form').reset();
        document.getElementById('pos-customer-errors').innerHTML = '';
        customerModal.show();
    });

    document.getElementById('pos-customer-save').addEventListener('click', function () {
        var form = document.getElementById('pos-customer-form');
        var payload = {
            name: form.name.value,
            email: form.email.value,
            country_code: form.country_code.value,
            phone: form.phone.value,
            is_active: form.querySelector('input[name="is_active"]:checked').value,
            password: form.password.value,
            password_confirmation: form.password_confirmation.value
        };

        postJson(routes.customerStore, payload).then(function (data) {
            var opt = document.createElement('option');
            opt.value = data.customer_created.id;
            opt.textContent = data.customer_created.name;
            opt.selected = true;
            customerSelect.appendChild(opt);
            renderCart(data);
            customerModal.hide();
        }).catch(function (err) {
            var box = document.getElementById('pos-customer-errors');
            box.innerHTML = '';
            if (err.data && err.data.errors) {
                Object.keys(err.data.errors).forEach(function (field) {
                    err.data.errors[field].forEach(function (msg) {
                        var p = document.createElement('div');
                        p.className = 'text-danger small';
                        p.textContent = msg;
                        box.appendChild(p);
                    });
                });
            } else {
                box.innerHTML = '<div class="text-danger small">' + (err.data && err.data.message ? err.data.message : 'Could not save customer.') + '</div>';
            }
        });
    });

    // ---------------------------------------------------------------
    // Discount
    // ---------------------------------------------------------------

    document.getElementById('pos-discount-apply').addEventListener('click', function () {
        var value = parseFloat(discountValueInput.value) || 0;

        if (isOfflineSale()) {
            window.PosOffline.cart.setDiscount(discountTypeSelect.value, value);
            localPayload().then(renderCart);
            return;
        }

        postJson(routes.discountApply, { type: discountTypeSelect.value, value: value }).then(renderCart);
    });

    // ---------------------------------------------------------------
    // Cancel
    // ---------------------------------------------------------------

    document.getElementById('pos-cancel-btn').addEventListener('click', function () {
        if (!confirm('Cancel this sale and clear the cart?')) return;

        var wasOffline = state.saleMode === 'offline';
        state.saleMode = null; // next item added re-decides mode fresh, based on connectivity right then

        if (wasOffline) {
            window.PosOffline.cart.clear();
            localPayload().then(renderCart);
        } else {
            postJson(routes.cartCancel, {}).then(renderCart);
        }
    });

    // ---------------------------------------------------------------
    // Order Payment modal
    // ---------------------------------------------------------------

    var paymentModalEl = document.getElementById('posPaymentModal');
    var paymentModal = bsModal(paymentModalEl);
    var amountInput = document.getElementById('pos-amount-input');

    document.getElementById('pos-order-btn').addEventListener('click', function () {
        document.getElementById('pos-payment-total').textContent = money(state.lastOrderTotal);
        amountInput.value = '';
        state.paymentMethod = 'cash';
        document.querySelectorAll('.pos-payment-method-btn').forEach(function (btn) {
            btn.classList.toggle('active', btn.getAttribute('data-method') === 'cash');
        });
        paymentModal.show();
    });

    document.querySelectorAll('.pos-payment-method-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            state.paymentMethod = btn.getAttribute('data-method');
            document.querySelectorAll('.pos-payment-method-btn').forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
        });
    });

    document.querySelectorAll('.pos-numpad-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var key = btn.getAttribute('data-key');
            if (key === 'clear') {
                amountInput.value = '';
            } else if (key === 'back') {
                amountInput.value = amountInput.value.slice(0, -1);
            } else if (key === '.') {
                if (amountInput.value.indexOf('.') === -1) amountInput.value += '.';
            } else {
                amountInput.value += key;
            }
        });
    });

    document.getElementById('pos-confirm-payment').addEventListener('click', function () {
        var paymentMethod = state.paymentMethod;
        var amountTendered = amountInput.value !== '' ? parseFloat(amountInput.value) : null;

        if (isOfflineSale()) {
            checkoutOffline(paymentMethod, amountTendered);
            return;
        }

        var payload = { payment_method: paymentMethod };
        if (amountTendered !== null) payload.amount_tendered = amountTendered;

        postJson(routes.checkout, payload).then(function (data) {
            paymentModal.hide();
            state.saleMode = null;

            // Server already cleared the cart on success — reset locally
            // instead of making another round trip for it.
            renderCart({
                items: [],
                customer: null,
                discount_type: 'percentage',
                discount_value: 0,
                totals: { subtotal: 0, tax: 0, discount: 0, total: 0 }
            });

            showReceipt(data.order_id);
        }).catch(function (err) {
            alert(err.data && err.data.message ? err.data.message : 'Could not complete the sale.');
        });
    });

    function checkoutOffline(paymentMethod, amountTendered) {
        var cart = window.PosOffline.cart;
        var totals = cart.totals();
        var tendered = amountTendered !== null ? amountTendered : totals.total;
        var changeDue = Math.max(0, Math.round((tendered - totals.total) * 100) / 100);
        var customerName = customerSelect.options[customerSelect.selectedIndex]
            ? customerSelect.options[customerSelect.selectedIndex].text
            : 'Walking Customer';

        var sale = {
            offline_id: window.PosOffline.generateOfflineId(),
            items: Object.keys(cart.lines).map(function (key) {
                var line = cart.lines[key];
                return { product_id: line.product_id, option_ids: line.option_ids, quantity: line.quantity };
            }),
            customer_id: cart.customerId,
            customer_name: customerName,
            payment_method: paymentMethod,
            amount_tendered: tendered,
            change_due: changeDue,
            discount_type: cart.discountType,
            discount_value: cart.discountValue,
            totals: totals,
            line_items_display: cart.hydratedItems(),
            created_at: new Date().toISOString()
        };

        window.PosOffline.queueSale(sale).then(function () {
            paymentModal.hide();
            state.saleMode = null;
            cart.clear();
            renderCart({
                items: [],
                customer: null,
                discount_type: 'percentage',
                discount_value: 0,
                totals: { subtotal: 0, tax: 0, discount: 0, total: 0 }
            });
            showOfflineReceipt(sale);
            updateSyncStatusUi();
        });
    }

    // ---------------------------------------------------------------
    // Receipt modal
    // ---------------------------------------------------------------

    var receiptModalEl = document.getElementById('posReceiptModal');
    var receiptModal = { show: function () { window.jQuery(receiptModalEl).modal('show'); }, hide: function () { window.jQuery(receiptModalEl).modal('hide'); } };

    function showReceipt(orderId) {
        state.currentReceiptMode = 'online';
        fetch(routes.orderShowBase.replace('__ID__', orderId), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (res) { return res.json(); })
          .then(function (data) {
              document.getElementById('pos-receipt-content').innerHTML = data.html;
              document.getElementById('pos-print-invoice').setAttribute('data-order-id', orderId);
              receiptModal.show();
          });
    }

    // Offline sales have no server-rendered receipt to fetch (the real
    // order doesn't exist yet — it's only in the local sync queue), so
    // this builds the same-looking receipt entirely client-side from the
    // sale record that was just queued.
    function showOfflineReceipt(sale) {
        state.currentReceiptMode = 'offline';
        state.currentOfflineSale = sale;

        var rows = sale.line_items_display.map(function (item) {
            var taxLine = item.tax_rate
                ? '<div class="text-muted">VAT-' + trimZeros(item.tax_rate) + ' (' + trimZeros(item.tax_rate) + '%)</div>'
                : '';
            return '<tr><td>' + item.quantity + '</td><td>' + item.title +
                (item.variant ? '<div class="text-muted">' + item.variant + '</div>' : '') + taxLine +
                '</td><td class="text-right">' + money(item.unit_price) + '</td></tr>';
        }).join('');

        var html =
            '<div class="pos-receipt">' +
            '<div class="alert alert-warning py-1 px-2 small text-center">Recorded offline — will sync automatically once back online.</div>' +
            '<div class="text-center mb-2"><div class="font-weight-bold" style="font-size:15px;">' + (window.posShopName || '') + '</div>' +
            (window.posShopAddress ? '<div class="small">' + window.posShopAddress + '</div>' : '') +
            (window.posShopPhone ? '<div class="small">Tel: ' + window.posShopPhone + '</div>' : '') + '</div><hr class="my-2">' +
            '<div class="d-flex justify-content-between small"><span>Offline sale — ' + sale.offline_id + '</span><span>' + new Date(sale.created_at).toLocaleDateString() + '</span></div>' +
            '<div class="d-flex justify-content-between small mb-2"><span>Customer: ' + sale.customer_name + '</span><span>' + new Date(sale.created_at).toLocaleTimeString() + '</span></div>' +
            '<hr class="my-2"><table class="table table-sm table-borderless mb-1" style="font-size:12px;"><thead><tr><th style="width:10%;">Qty</th><th>Product Description</th><th class="text-right" style="width:25%;">Price</th></tr></thead><tbody>' + rows + '</tbody></table>' +
            '<hr class="my-2">' +
            '<div class="d-flex justify-content-between small"><span>SUBTOTAL:</span><span>' + money(sale.totals.subtotal) + '</span></div>' +
            '<div class="d-flex justify-content-between small"><span>TAX FEE:</span><span>' + money(sale.totals.tax) + '</span></div>' +
            '<div class="d-flex justify-content-between small"><span>DISCOUNT:</span><span>' + money(sale.totals.discount) + '</span></div>' +
            '<div class="d-flex justify-content-between font-weight-bold"><span>TOTAL:</span><span>' + money(sale.totals.total) + '</span></div>' +
            '<hr class="my-2">' +
            '<div class="d-flex justify-content-between small"><span>Payment Type:</span><span>' + capitalize(sale.payment_method) + '</span></div>' +
            '<div class="d-flex justify-content-between small"><span>Tendered:</span><span>' + money(sale.amount_tendered) + '</span></div>' +
            '<div class="d-flex justify-content-between small"><span>Change:</span><span>' + money(sale.change_due) + '</span></div>' +
            '<hr class="my-2"><div class="text-center small"><div>Thank You</div><div>Please Come Again</div></div>' +
            '</div>';

        document.getElementById('pos-receipt-content').innerHTML = html;
        receiptModal.show();
    }

    function trimZeros(n) {
        return String(parseFloat(n));
    }

    function capitalize(s) {
        return s ? s.charAt(0).toUpperCase() + s.slice(1) : s;
    }

    document.getElementById('pos-print-invoice').addEventListener('click', function () {
        if (state.currentReceiptMode === 'offline') {
            printHtmlInNewWindow(document.getElementById('pos-receipt-content').innerHTML);
            return;
        }
        var orderId = this.getAttribute('data-order-id');
        window.open(routes.orderPrintBase.replace('__ID__', orderId), '_blank');
    });

    function printHtmlInNewWindow(innerHtml) {
        var win = window.open('', '_blank');
        win.document.write(
            '<!DOCTYPE html><html><head><title>Receipt</title><style>' +
            "body{font-family:'Courier New',Courier,monospace;width:300px;margin:0 auto;padding:12px;color:#000;}" +
            'table{width:100%;border-collapse:collapse;}hr{border:none;border-top:1px dashed #000;}' +
            '.text-right{text-align:right;}.text-center{text-align:center;}.text-muted{color:#555;}' +
            '.font-weight-bold{font-weight:bold;}.small{font-size:11px;}.d-flex{display:flex;}' +
            '.justify-content-between{justify-content:space-between;}.mb-1{margin-bottom:4px;}.mb-2{margin-bottom:8px;}' +
            '.my-2{margin:8px 0;}.alert{border:1px solid #999;padding:4px;}' +
            '</style></head><body>' + innerHtml + '<script>window.onload=function(){window.print();};</' + 'script></body></html>'
        );
        win.document.close();
    }

    document.getElementById('pos-receipt-close').addEventListener('click', function () {
        receiptModal.hide();
    });

    // Whichever modal just closed — by button, backdrop click, or Esc —
    // send keyboard focus back to the barcode box so a scanner (or the
    // cashier just pressing Enter) keeps working right away.
    ['posVariationModal', 'posCustomerModal', 'posPaymentModal', 'posReceiptModal'].forEach(function (id) {
        window.jQuery(document.getElementById(id)).on('hidden.bs.modal', refocusBarcode);
    });

    barcodeInput.focus();

    // ---------------------------------------------------------------
    // Connectivity status pill + offline engine bootstrap
    // ---------------------------------------------------------------

    var statusPill = document.getElementById('pos-status-pill');
    var statusPopover = document.getElementById('pos-status-popover');
    var statusDotText = document.getElementById('pos-status-text');

    function updateSyncStatusUi() {
        if (!window.PosOffline) return;

        var isOnline = window.PosOffline.isOnline();
        statusPill.classList.toggle('pos-status-online', isOnline);
        statusPill.classList.toggle('pos-status-offline', !isOnline);
        statusDotText.textContent = isOnline ? 'ONLINE' : 'OFFLINE';

        document.getElementById('pos-status-value').textContent = isOnline ? 'online' : 'offline';
        var lastSynced = window.PosOffline.getLastSyncedAt();
        document.getElementById('pos-status-synced').textContent = lastSynced ? timeAgo(lastSynced) : 'never';

        window.PosOffline.pendingCount().then(function (count) {
            document.getElementById('pos-status-queue').textContent = count === 0 ? 'empty' : (count + ' sale' + (count === 1 ? '' : 's'));
        });
    }

    function timeAgo(iso) {
        var seconds = Math.floor((Date.now() - new Date(iso).getTime()) / 1000);
        if (seconds < 5) return 'just now';
        if (seconds < 60) return seconds + 's ago';
        if (seconds < 3600) return Math.floor(seconds / 60) + 'm ago';
        return Math.floor(seconds / 3600) + 'h ago';
    }

    statusPill.addEventListener('click', function () {
        statusPopover.classList.toggle('d-none');
        updateSyncStatusUi();
    });
    document.addEventListener('click', function (e) {
        if (!statusPopover.contains(e.target) && e.target !== statusPill && !statusPill.contains(e.target)) {
            statusPopover.classList.add('d-none');
        }
    });

    document.getElementById('pos-refresh-data').addEventListener('click', function () {
        if (!window.PosOffline) return;
        this.disabled = true;
        var label = this.textContent;
        this.textContent = 'Refreshing…';
        window.PosOffline.refreshCatalog().then(function () {
            updateSyncStatusUi();
        }).finally(function () {
            document.getElementById('pos-refresh-data').disabled = false;
            document.getElementById('pos-refresh-data').textContent = label;
        }.bind(this));
    });

    if (window.PosOffline) {
        window.PosOffline.onConnectivityChange(function () {
            updateSyncStatusUi();
            // Connectivity coming back mid-browse should refresh a
            // server-rendered grid if the cashier hasn't started a sale
            // yet (an in-progress offline sale is left completely alone).
            if (window.PosOffline.isOnline() && !state.saleMode) {
                reloadWithFilters();
            }
        });
        window.PosOffline.onSyncQueueChange(updateSyncStatusUi);

        window.PosOffline.init({
            probeUrl: routes.products,
            catalogUrl: routes.catalog
        }).then(updateSyncStatusUi);
    }

    // ---------------------------------------------------------------
    // Refund a sale
    // ---------------------------------------------------------------

    var refundSearchModalEl = document.getElementById('posRefundSearchModal');
    var refundSearchModal = bsModal(refundSearchModalEl);
    var refundProcessModalEl = document.getElementById('posRefundProcessModal');
    var refundProcessModal = bsModal(refundProcessModalEl);
    var refundSuccessModalEl = document.getElementById('posRefundSuccessModal');
    var refundSuccessModal = bsModal(refundSuccessModalEl);

    var refundSearchInput = document.getElementById('pos-refund-search-input');
    var refundResultsEl = document.getElementById('pos-refund-results');
    var refundSearchTimer = null;
    var refundState = { orderId: null, items: [] };

    document.getElementById('pos-refund-btn').addEventListener('click', function () {
        if (!window.PosOffline || !window.PosOffline.isOnline()) {
            alert('Refunds need an internet connection (to check how much of the sale is still returnable).');
            return;
        }
        refundSearchInput.value = '';
        loadRefundSearchResults('');
        refundSearchModal.show();
    });

    refundSearchInput.addEventListener('input', function () {
        clearTimeout(refundSearchTimer);
        var q = refundSearchInput.value;
        refundSearchTimer = setTimeout(function () { loadRefundSearchResults(q); }, 300);
    });

    function loadRefundSearchResults(q) {
        var url = routes.refundsSearch + (q ? '?q=' + encodeURIComponent(q) : '');
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                refundResultsEl.innerHTML = '';
                if (!data.orders.length) {
                    refundResultsEl.innerHTML = '<div class="text-center text-muted py-3">No matching sales.</div>';
                    return;
                }
                data.orders.forEach(function (order) {
                    var row = document.createElement('div');
                    row.className = 'pos-refund-result d-flex justify-content-between align-items-center p-2 border-bottom';
                    row.style.cursor = 'pointer';
                    row.innerHTML =
                        '<div><div class="font-weight-bold">' + order.order_number + '</div>' +
                        '<div class="small text-muted">' + order.customer_name + ' &middot; ' + order.created_at + '</div></div>' +
                        '<div class="font-weight-bold">' + money(order.total) + '</div>';
                    row.addEventListener('click', function () { openRefundProcess(order.id, order.order_number); });
                    refundResultsEl.appendChild(row);
                });
            });
    }

    function openRefundProcess(orderId, orderNumber) {
        fetch(routes.refundsDetailBase.replace('__ID__', orderId), { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (!data.items.length) {
                    alert('Nothing left to refund on this sale — every line has already been fully refunded.');
                    return;
                }

                refundState.orderId = orderId;
                refundState.items = data.items.map(function (item) {
                    return Object.assign({ refund_qty: item.returnable_quantity }, item);
                });

                document.getElementById('pos-refund-process-title').textContent = 'Process refund — ' + orderNumber;
                renderRefundItemsTable();
                document.getElementById('pos-refund-reason').value = '';
                document.getElementById('pos-refund-method').value = 'cash';
                document.getElementById('pos-refund-restock').checked = true;
                document.getElementById('pos-refund-notes').value = '';

                refundSearchModal.hide();
                refundProcessModal.show();
            });
    }

    function renderRefundItemsTable() {
        var body = document.getElementById('pos-refund-items-body');
        body.innerHTML = '';

        refundState.items.forEach(function (item, idx) {
            var row = document.createElement('tr');
            row.innerHTML =
                '<td><div class="font-weight-bold">' + item.title + '</div>' +
                (item.variant ? '<div class="small text-muted">' + item.variant + '</div>' : '') +
                (item.sku ? '<div class="small text-muted">' + item.sku + '</div>' : '') + '</td>' +
                '<td>' +
                    '<div class="d-flex align-items-center">' +
                    '<button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 pos-refund-qty-minus">-</button>' +
                    '<span class="mx-2 pos-refund-qty-value">' + item.refund_qty + '</span>' +
                    '<button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 pos-refund-qty-plus">+</button>' +
                    '</div><div class="small text-muted">Up to ' + item.returnable_quantity + ' returnable</div>' +
                '</td>' +
                '<td>' + money(item.unit_price) + '</td>' +
                '<td class="pos-refund-line-total">' + money(item.unit_price * item.refund_qty) + '</td>';

            row.querySelector('.pos-refund-qty-minus').addEventListener('click', function () {
                refundState.items[idx].refund_qty = Math.max(0, refundState.items[idx].refund_qty - 1);
                renderRefundItemsTable();
            });
            row.querySelector('.pos-refund-qty-plus').addEventListener('click', function () {
                refundState.items[idx].refund_qty = Math.min(item.returnable_quantity, refundState.items[idx].refund_qty + 1);
                renderRefundItemsTable();
            });

            body.appendChild(row);
        });

        updateRefundTotals();
    }

    function updateRefundTotals() {
        var subtotal = 0, tax = 0;
        refundState.items.forEach(function (item) {
            var lineTotal = item.unit_price * item.refund_qty;
            subtotal += lineTotal;
            if (item.tax_rate) tax += lineTotal * (item.tax_rate / 100);
        });
        subtotal = Math.round(subtotal * 100) / 100;
        tax = Math.round(tax * 100) / 100;
        var total = Math.round((subtotal + tax) * 100) / 100;

        document.getElementById('pos-refund-subtotal').textContent = money(subtotal);
        document.getElementById('pos-refund-tax').textContent = money(tax);
        document.getElementById('pos-refund-total').textContent = money(total);
    }

    document.getElementById('pos-refund-cancel').addEventListener('click', function () {
        refundProcessModal.hide();
    });

    document.getElementById('pos-refund-submit').addEventListener('click', function () {
        var items = refundState.items
            .filter(function (item) { return item.refund_qty > 0; })
            .map(function (item) { return { order_item_id: item.id, quantity: item.refund_qty }; });

        if (!items.length) {
            alert('Select at least one item/quantity to refund.');
            return;
        }

        var reason = document.getElementById('pos-refund-reason').value;
        if (!reason) {
            alert('Please choose a reason.');
            return;
        }

        postJson(routes.refundsProcessBase.replace('__ID__', refundState.orderId), {
            items: items,
            reason: reason,
            refund_method: document.getElementById('pos-refund-method').value,
            restock: document.getElementById('pos-refund-restock').checked,
            notes: document.getElementById('pos-refund-notes').value
        }).then(function (data) {
            refundProcessModal.hide();
            document.getElementById('pos-refund-success-number').textContent = data.refund_number;
            document.getElementById('pos-refund-success-amount').textContent = data.total_formatted ? (window.posCurrency + data.total_formatted) : money(data.total);
            document.getElementById('pos-refund-success-order').textContent = data.order_number;
            refundSuccessModal.show();
        }).catch(function (err) {
            alert(err.data && err.data.message ? err.data.message : 'Could not process the refund.');
        });
    });

    document.getElementById('pos-refund-success-done').addEventListener('click', function () {
        refundSuccessModal.hide();
    });

    ['posRefundSearchModal', 'posRefundProcessModal', 'posRefundSuccessModal'].forEach(function (id) {
        window.jQuery(document.getElementById(id)).on('hidden.bs.modal', refocusBarcode);
    });
})();
