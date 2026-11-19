@extends('layouts.base')
@section('title', 'Download & Install Mobile App')

@section('content')
<section class="s-phero"><div class="s-wrap s-phero-in">
  <div>
    <span class="s-kicker">Get the app</span>
    <h1>Install in <span style="color:var(--b)">seconds</span></h1>
    <p class="s-lead">No app store needed. Add it to your home screen and it opens full-screen, like a native app.</p>
    <div class="s-cta-row"><a href="#install" class="s-btn s-btn-solid s-btn-lg">Install now</a></div>
  </div>
  <div class="s-phero-art" aria-hidden="true"><div class="s-orb"><i class="bi bi-phone"></i></div><span class="s-dot d1"></span><span class="s-dot d2"></span><span class="s-dot d3"></span></div>
</div></section>
<section class="s-sec" id="install"><div class="s-wrap"><div class="s-instbox">
  <div><h2 class="s-h2">Add {{ $settings->site_name }} to your device</h2><p class="s-lead" style="color:rgba(255,255,255,.8)">Works on Android, iPhone, Windows and Mac.</p>
    <div class="s-cta-row"><button type="button" class="s-btn s-btn-white s-btn-lg" data-install><i class="bi bi-download"></i> Install now</button><a href="/download-app" class="s-btn s-btn-outline-w s-btn-lg"><i class="bi bi-android2"></i> Download APK</a></div>
    <div class="s-howinst"><div><i class="bi bi-android2"></i> Android / Chrome: tap <b>Install</b> or ? ? Install app</div><div><i class="bi bi-apple"></i> iPhone / Safari: Share ? <b>Add to Home Screen</b></div><div><i class="bi bi-windows"></i> Desktop Chrome / Edge: click the install icon in the address bar</div></div></div>
  <div style="display:grid;gap:18px;justify-items:center"><div class="s-qr" aria-label="Decorative QR code"><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i></div><small style="opacity:.8">Scan on your phone</small></div>
</div></div></section>
<section class="s-sec alt"><div class="s-wrap"><div class="s-head"><h2 class="s-h2">Why install?</h2></div><div class="s-grid g4"><div class="s-card"><div class="s-ico"><i class="bi bi-fullscreen"></i></div><h3>Full-screen</h3><p>No browser bars.</p></div><div class="s-card"><div class="s-ico"><i class="bi bi-lightning-charge"></i></div><h3>Faster</h3><p>Assets cached on your device.</p></div><div class="s-card"><div class="s-ico"><i class="bi bi-wifi-off"></i></div><h3>Offline page</h3><p>A friendly screen when you lose connection.</p></div><div class="s-card"><div class="s-ico"><i class="bi bi-arrow-repeat"></i></div><h3>Always current</h3><p>Updates arrive automatically.</p></div></div></div></section>
<section class="s-sec"><div class="s-wrap"><div class="s-head"><h2 class="s-h2">Preview</h2></div><div class="s-phones"><div class="mk-phone" role="img" aria-label="Preview of the mobile app">
  <div class="mk-notch"></div>
    <div class="mp-hero"><small>Evening, Alex ??</small><strong>$24,860.50</strong><em>Checking · ••3777</em>
    <div class="mp-q"><span><i class="bi bi-box-arrow-in-down"></i></span><span><i class="bi bi-box-arrow-up"></i></span><span><i class="bi bi-arrow-left-right"></i></span><span><i class="bi bi-receipt"></i></span></div></div>
  <div class="mp-body"><b>Grow your money</b>
    <div class="mp-tiles"><span><i class="bi bi-graph-up-arrow"></i>Invest</span><span><i class="bi bi-bar-chart"></i>Trade</span><span><i class="bi bi-file-text"></i>Statement</span></div>
    <b>My accounts</b>
    <div class="mp-row"><i class="bi bi-bank"></i><span>Personal<small>Checking</small></span><em>$24,860.50</em></div>
    <div class="mp-row"><i class="bi bi-piggy-bank"></i><span>Savings<small>Goal: Holiday</small></span><em>$3,200.00</em></div></div>
    <div class="mp-nav"><i class="bi bi-house-fill on"></i><i class="bi bi-arrow-left-right"></i><i class="bi bi-send"></i><i class="bi bi-credit-card"></i><i class="bi bi-grid"></i></div>
</div>
<div class="mk-phone" role="img" aria-label="Preview of the mobile app">
  <div class="mk-notch"></div>
    <div class="mp-top"><b>Gold · XAU</b><small>Commodity</small></div>
  <div class="mp-price"><strong>$2,418.60</strong><em class="pos">? 1.84%</em></div>
  <div class="mp-chart"><svg viewBox="0 0 220 120" width="100%" height="120" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="g67bb80" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#f2b01e" stop-opacity=".35"/><stop offset="1" stop-color="#f2b01e" stop-opacity="0"/></linearGradient></defs><path d="M0 117 L16.9 108.9 L33.8 112.9 L50.8 92.6 L67.7 96.6 L84.6 76.3 L101.5 84.4 L118.5 60 L135.4 64.1 L152.3 43.7 L169.2 51.9 L186.2 19.3 L203.1 27.4 L220 3 L220 120 L0 120 Z" fill="url(#g67bb80)"/><path d="M0 117 L16.9 108.9 L33.8 112.9 L50.8 92.6 L67.7 96.6 L84.6 76.3 L101.5 84.4 L118.5 60 L135.4 64.1 L152.3 43.7 L169.2 51.9 L186.2 19.3 L203.1 27.4 L220 3" fill="none" stroke="#f2b01e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
  <div class="mp-seg"><span>1H</span><span class="on">1D</span><span>1W</span><span>1M</span></div>
  <div class="mp-btns"><span class="buy">Buy</span><span class="sell">Sell</span></div>
    <div class="mp-nav"><i class="bi bi-house-fill on"></i><i class="bi bi-arrow-left-right"></i><i class="bi bi-send"></i><i class="bi bi-credit-card"></i><i class="bi bi-grid"></i></div>
</div>
<div class="mk-phone" role="img" aria-label="Preview of the mobile app">
  <div class="mk-notch"></div>
    <div class="mp-top"><b>My cards</b><small>2 active</small></div>
  <div class="mp-card"><small>{{ $settings->site_name }}</small><strong>•••• 4821</strong><em>VALID 09/29</em></div>
  <div class="mp-card alt"><small>Virtual</small><strong>•••• 7710</strong><em>ONLINE ONLY</em></div>
  <div class="mp-q dark"><span><i class="bi bi-snow"></i></span><span><i class="bi bi-eye"></i></span><span><i class="bi bi-sliders"></i></span></div>
    <div class="mp-nav"><i class="bi bi-house-fill on"></i><i class="bi bi-arrow-left-right"></i><i class="bi bi-send"></i><i class="bi bi-credit-card"></i><i class="bi bi-grid"></i></div>
</div>
</div></div></section>


<section class="s-sec s-cta-band"><div class="s-wrap s-cta-in">
  <div><h2>Ready to bank the modern way?</h2><p>Open an account in minutes.</p></div>
  <div class="s-cta-row"><a href="/register" class="s-btn s-btn-white">Open account</a><a href="/apps" class="s-btn s-btn-outline-w"><i class="bi bi-phone"></i> Get the app</a></div>
</div></section>
@endsection
