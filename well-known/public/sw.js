const CACHE_NAME = 'httsys-pwa-v1';

// Only cache safe, static, publicly-visible assets. Admin panel pages,
// login/auth pages, and anything under /admin are deliberately never
// touched by this service worker.
const PRECACHE_URLS = [
    '/',
];

self.addEventListener('install', function (event) {
    self.skipWaiting();
    event.waitUntil(
        caches.open(CACHE_NAME).then(function (cache) {
            return cache.addAll(PRECACHE_URLS).catch(function () {
                // Don't fail install if one of the precache URLs is
                // temporarily unavailable.
            });
        })
    );
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (keys) {
            return Promise.all(
                keys
                    .filter(function (key) { return key !== CACHE_NAME; })
                    .map(function (key) { return caches.delete(key); })
            );
        })
    );
    self.clients.claim();
});

self.addEventListener('fetch', function (event) {
    const request = event.request;
    const url = new URL(request.url);

    // Only handle same-origin GET requests. Never intercept the admin
    // panel, login/auth flows, or any non-GET (POST/PUT/DELETE) request —
    // those must always go straight to the server so forms, CSRF tokens,
    // and session state behave normally.
    if (request.method !== 'GET' || url.origin !== self.location.origin) {
        return;
    }

    if (
        url.pathname.startsWith('/admin') ||
        url.pathname.startsWith('/login') ||
        url.pathname.startsWith('/register') ||
        url.pathname.startsWith('/logout') ||
        url.pathname.startsWith('/profile') ||
        url.pathname.startsWith('/mini-games') ||
        url.pathname.startsWith('/email') ||
        url.pathname.startsWith('/password')
    ) {
        return;
    }

    const isStaticAsset = /\.(css|js|png|jpg|jpeg|webp|svg|gif|woff2?|ttf)$/i.test(url.pathname);

    if (isStaticAsset) {
        // Static assets (css/js/images/fonts) rarely change once deployed —
        // serve from cache first for speed, fall back to network and cache
        // the result for next time.
        event.respondWith(
            caches.match(request).then(function (cached) {
                if (cached) return cached;
                return fetch(request).then(function (response) {
                    if (response && response.status === 200) {
                        const clone = response.clone();
                        caches.open(CACHE_NAME).then(function (cache) { cache.put(request, clone); });
                    }
                    return response;
                });
            })
        );
        return;
    }

    // HTML/page requests: try the network first so content stays fresh;
    // fall back to the cache (then to the cached homepage) if offline.
    event.respondWith(
        fetch(request)
            .then(function (response) {
                if (response && response.status === 200) {
                    const clone = response.clone();
                    caches.open(CACHE_NAME).then(function (cache) { cache.put(request, clone); });
                }
                return response;
            })
            .catch(function () {
                return caches.match(request).then(function (cached) {
                    return cached || caches.match('/');
                });
            })
    );
});
