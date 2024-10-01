// This is the service worker. Uncomment to run this. Modify based on your needs.
const CACHE_NAME = 'hwpweb-admin-template-cache-v1';
const CACHE_URLS = [
  '/',
  '/index.php',
  '/favicon-1.png', // 16x16 icons
  '/favicon-2.png', // 32x32 icons
  '/favicon-3.png', // 144x144 icons
  '/wide-screenshot.png', // Wide Screenshot
  '/normal-screenshot.jpeg' // Normal Screenshot
];

// Configure service worker based on your needs
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(CACHE_URLS);
    })
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});

self.addEventListener('activate', (event) => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});
