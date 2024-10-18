// This is the service worker. Uncomment to run this. Modify based on your needs.
const CACHE_NAME = 'hwpweb-admin-template-cache-v1';
const ASSETS_TO_CACHE  = [
  '/',
  '/index.php',
  '/favicon-1.png', // 16x16 icons
  '/favicon-2.png', // 32x32 icons
  '/favicon-3.png', // 144x144 icons
  '/Screenshot.png', // Screenshot
];

// Install Service Worker and caching assets
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      console.log('Caching assets');
      return cache.addAll(ASSETS_TO_CACHE);
    })
  );
});

// Get assets from cache
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request).then(response => {
      return response || fetch(event.request);
    })
  );
});