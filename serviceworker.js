/* Secure Save Hub service worker: caches static assets, never caches banking pages. */
const V = 'ssh-v1', STATIC = [
  '/offline.html',
  '/images/icons/icon-192x192.png',
  '/images/icons/icon-512x512.png',
  '/assets/royalcity/site.css',
  '/assets/royalcity/site.js'
];

self.addEventListener('install', (e) => {
  e.waitUntil(caches.open(V).then((c) => c.addAll(STATIC)).then(() => self.skipWaiting()));
});

self.addEventListener('activate', (e) => {
  e.waitUntil(caches.keys().then((k) => Promise.all(k.filter((x) => x !== V).map((x) => caches.delete(x)))).then(() => self.clients.claim()));
});

self.addEventListener('fetch', (e) => {
  const r = e.request, u = new URL(r.url);
  if (r.method !== 'GET' || u.origin !== location.origin) return;

  // Pages: always network (account & session data must be live); offline page as fallback.
  if (r.mode === 'navigate') {
    e.respondWith(fetch(r).catch(() => caches.match('/offline.html')));
    return;
  }

  // Static assets (css/js/png/jpg/jpeg/svg/webp/woff2?): stale-while-revalidate.
  if (/\.(css|js|png|jpg|jpeg|svg|webp|woff2?)$/.test(u.pathname)) {
    e.respondWith(caches.open(V).then((c) => c.match(r).then((hit) => {
      const net = fetch(r).then((res) => { if (res.ok) c.put(r, res.clone()); return res; }).catch(() => hit);
      return hit || net;
    })));
  }
});