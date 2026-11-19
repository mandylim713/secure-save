(function () {
  'use strict';
  var $ = function (s, r) { return (r || document).querySelector(s); }, $$ = function (s, r) { return Array.prototype.slice.call((r || document).querySelectorAll(s)); };
  var toast = function (m) { var t = document.createElement('div'); t.className = 's-toast'; t.textContent = m; document.body.appendChild(t); setTimeout(function () { t.remove(); }, 2600); };

  /* header shadow, back-to-top */
  var hd = $('#sHeader'), tp = $('#sToTop');
  var onScroll = function () { var y = window.scrollY; hd && hd.classList.toggle('sc', y > 8); tp && tp.classList.toggle('show', y > 600); };
  addEventListener('scroll', onScroll, { passive: true }); onScroll();
  tp && tp.addEventListener('click', function () { scrollTo({ top: 0, behavior: 'smooth' }); });

  /* announcement */
  var an = $('.s-announce'); try { if (sessionStorage.getItem('rc_an')) an && an.remove(); } catch (e) {}
  $('[data-dismiss-announce]') && $('[data-dismiss-announce]').addEventListener('click', function () { an.remove(); try { sessionStorage.setItem('rc_an', 1); } catch (e) {} });

  /* mega menu (click for touch / keyboard) + mobile drawer */
  $$('.s-top').forEach(function (b) {
    b.addEventListener('click', function (e) {
      e.stopPropagation(); var it = b.parentNode, on = it.classList.contains('open');
      $$('.s-item.open').forEach(function (x) { x.classList.remove('open'); x.firstElementChild.setAttribute('aria-expanded', 'false'); });
      if (!on) { it.classList.add('open'); b.setAttribute('aria-expanded', 'true'); }
    });
  });
  document.addEventListener('click', function () { $$('.s-item.open').forEach(function (x) { x.classList.remove('open'); }); });
  document.addEventListener('keydown', function (e) { if (e.key === 'Escape') { $$('.s-item.open').forEach(function (x) { x.classList.remove('open'); }); dr(false); } });
  var drawer = $('#sDrawer');
  function dr(o) { if (!drawer) return; drawer.classList.toggle('open', o); drawer.setAttribute('aria-hidden', o ? 'false' : 'true'); document.body.style.overflow = o ? 'hidden' : ''; }
  $('#sBurger') && $('#sBurger').addEventListener('click', function () { dr(true); });
  $$('[data-close-drawer]').forEach(function (b) { b.addEventListener('click', function () { dr(false); }); });

  /* theme */
  var th = $('#sTheme');
  function paintTheme() { var d = document.documentElement.getAttribute('data-theme') === 'dark'; if (th) th.innerHTML = '<i class="bi ' + (d ? 'bi-sun' : 'bi-moon-stars') + '"></i>'; }
  paintTheme();
  th && th.addEventListener('click', function () {
    var d = document.documentElement.getAttribute('data-theme') !== 'dark';
    document.documentElement.setAttribute('data-theme', d ? 'dark' : 'light'); document.documentElement.setAttribute('data-bs-theme', d ? 'dark' : 'light');
    try { localStorage.setItem('rc_theme', d ? 'dark' : 'light'); } catch (e) {} paintTheme();
  });

  /* reveal on scroll + counters */
  var io = 'IntersectionObserver' in window ? new IntersectionObserver(function (es) {
    es.forEach(function (en) {
      if (!en.isIntersecting) return; en.target.classList.add('in'); io.unobserve(en.target);
      if (en.target.hasAttribute('data-count')) count(en.target);
    });
  }, { threshold: 0, rootMargin: '0px 0px -8% 0px' }) : null;
  $$('.reveal,[data-count]').forEach(function (el) { io ? io.observe(el) : (el.classList.add('in'), el.hasAttribute('data-count') && count(el)); });
  function count(el) {
    var to = parseFloat(el.getAttribute('data-count')), pre = el.getAttribute('data-pre') || '', suf = el.getAttribute('data-suf') || '', dec = (String(to).split('.')[1] || '').length, t0 = performance.now(), D = 1400;
    (function f(t) { var p = Math.min(1, (t - t0) / D), v = to * (1 - Math.pow(1 - p, 3)); el.textContent = pre + v.toLocaleString('en-US', { minimumFractionDigits: dec, maximumFractionDigits: dec }) + suf; if (p < 1) requestAnimationFrame(f); })(t0);
  }

  /* tabs */
  $$('[data-tabs]').forEach(function (box) {
    var tabs = $$('.s-tab', box), panes = $$('.s-pane', box);
    tabs.forEach(function (t, i) { t.addEventListener('click', function () { tabs.forEach(function (x, k) { x.classList.toggle('on', k === i); }); panes.forEach(function (x, k) { x.classList.toggle('on', k === i); }); }); });
  });

  /* testimonials */
  $$('[data-quotes]').forEach(function (box) {
    var q = $$('.s-quote', box), dots = $$('.s-dots button', box), i = 0, timer;
    function show(n) { i = n; q.forEach(function (x, k) { x.classList.toggle('on', k === n); }); dots.forEach(function (x, k) { x.classList.toggle('on', k === n); }); }
    dots.forEach(function (d, k) { d.addEventListener('click', function () { show(k); restart(); }); });
    function restart() { clearInterval(timer); timer = setInterval(function () { show((i + 1) % q.length); }, 6000); } restart();
  });

  /* calculators */
  function money(n) { return '$' + Math.round(n).toLocaleString('en-US'); }
  $$('[data-calc]').forEach(function (box) {
    var kind = box.getAttribute('data-calc'), ins = $$('input[type=range]', box);
    function val(n) { return parseFloat($('[name=' + n + ']', box).value); }
    function run() {
      ins.forEach(function (r) { var o = r.parentNode.querySelector('output[for=' + r.name + ']'); if (o) o.textContent = (r.dataset.pre || '') + parseFloat(r.value).toLocaleString('en-US') + (r.dataset.suf || ''); });
      var out = $('[data-out]', box);
      if (kind === 'savings') {
        var p = val('init'), m = val('monthly'), r = val('rate') / 100 / 12, n = val('years') * 12, bal = p;
        for (var k = 0; k < n; k++) bal = (bal + m) * (1 + r);
        var put = p + m * n; out.innerHTML = '<div><small>Future value</small><strong>' + money(bal) + '</strong></div><div><small>Interest earned</small><strong>' + money(bal - put) + '</strong></div>';
      } else {
        var a = val('amount'), rt = val('rate') / 100 / 12, nn = val('months'), pay = rt ? a * rt / (1 - Math.pow(1 + rt, -nn)) : a / nn;
        out.innerHTML = '<div><small>Monthly payment</small><strong>' + money(pay) + '</strong></div><div><small>Total interest</small><strong>' + money(pay * nn - a) + '</strong></div>';
      }
    }
    ins.forEach(function (r) { r.addEventListener('input', run); }); run();
  });

  /* demo forms */
  $$('[data-demo-form]').forEach(function (f) { f.addEventListener('submit', function (e) { e.preventDefault(); toast('Thanks. We received your message.'); f.reset(); }); });

  /* PWA: install + service worker */
  var deferred = null, ios = /iphone|ipad|ipod/i.test(navigator.userAgent) && !navigator.standalone, standalone = matchMedia('(display-mode: standalone)').matches || navigator.standalone;
  var btns = $$('[data-install]'), bar = $('#sInstall');
  function showInstall(on) { btns.forEach(function (b) { if (b.closest('#sInstall')) return; b.hidden = !on; }); }
  addEventListener('beforeinstallprompt', function (e) {
    e.preventDefault(); deferred = e; showInstall(true);
    var dismissed = false; try { dismissed = localStorage.getItem('rc_inst_x'); } catch (er) {}
    if (bar && !dismissed && !standalone) setTimeout(function () { bar.hidden = false; }, 4000);
  });
  if (ios && !standalone) showInstall(true);
  if (standalone) { showInstall(false); }
  btns.forEach(function (b) {
    b.addEventListener('click', function () {
      if (deferred) { deferred.prompt(); deferred.userChoice.then(function (c) { if (c.outcome === 'accepted') toast('Installing…'); deferred = null; if (bar) bar.hidden = true; }); }
      else if (ios) { var m = $('#iosHelp'); if (m && window.bootstrap) bootstrap.Modal.getOrCreateInstance(m).show(); else toast('Tap Share, then “Add to Home Screen”.'); }
      else toast('Open this page in Chrome, Edge or Safari to install.');
    });
  });
  $('#sInstallX') && $('#sInstallX').addEventListener('click', function () { bar.hidden = true; try { localStorage.setItem('rc_inst_x', 1); } catch (e) {} });
  addEventListener('appinstalled', function () { showInstall(false); if (bar) bar.hidden = true; toast('App installed 🎉'); });
  /* app loader */
  function hideLoader() {
    var l = document.getElementById('appLoader');
    if (l) {
      l.classList.add('fade-out');
      setTimeout(function () { if (l.parentNode) l.parentNode.removeChild(l); }, 400);
    }
  }
  if (document.readyState === 'complete') {
    setTimeout(hideLoader, 100);
  } else {
    addEventListener('load', function() { setTimeout(hideLoader, 150); });
    setTimeout(hideLoader, 2500);
  }

  if ('serviceWorker' in navigator && (location.protocol === 'https:' || location.hostname === 'localhost' || location.hostname === '127.0.0.1')) {
    addEventListener('load', function () { navigator.serviceWorker.register('/sw.js').catch(function () {}); });
  }
})();
