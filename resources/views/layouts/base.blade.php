<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover">
<meta name="theme-color" content="#00609E">
<title>@yield('title', 'Modern Online Banking') · {{ $settings->site_name }}</title>
<meta name="description" content="{{ $settings->site_name }} - Accounts, cards, high-yield savings, instant transfers and full mobile banking in one app.">
<link rel="manifest" href="/manifest.webmanifest">
@if(!empty($settings->favicon))
<link rel="icon" type="image/png" href="{{ asset('storage/app/public/'.$settings->favicon) }}">
@else
<link rel="icon" type="image/png" href="/images/icons/icon-192x192.png">
@endif
<link rel="apple-touch-icon" href="/images/icons/icon-192x192.png">
<script>try{if(localStorage.getItem('rc_theme')==='dark'){document.documentElement.setAttribute('data-theme','dark');document.documentElement.setAttribute('data-bs-theme','dark');}}catch(e){}</script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="/assets/royalcity/site.css?v=5" rel="stylesheet">
</head>
<body class="s-body">

<!-- App Loader (Native Mobile Splash) -->
<div id="appLoader">
  <div class="loader-mark">
    @if(!empty($settings->logo))
      <img src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name }}">
    @else
      <i class="bi bi-shield-lock-fill"></i>
    @endif
  </div>
  <div class="loader-title">{{ $settings->site_name }}</div>
  <div class="loader-bar-wrap"><div class="loader-bar-line"></div></div>
</div>

<!-- Announcement Bar -->
<div class="s-announce">
  <span class="s-pill">New</span> Mobile app install, instant wire &amp; crypto transfers are live — <a href="{{ route('app') }}">get the app</a>
  <button type="button" class="s-x" aria-label="Dismiss" data-dismiss-announce><i class="bi bi-x-lg"></i></button>
</div>

<!-- Header -->
<header class="s-header" id="sHeader">
  <div class="s-wrap s-nav">
    <a href="/" class="s-brand">
      @if(!empty($settings->logo))
        <img class="logo-img" src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name }}">
      @else
        <span class="fs-4 fw-bold text-primary">{{ $settings->site_name }}</span>
      @endif
    </a>
    <nav class="s-menu" aria-label="Main">
      <div class="s-item">
        <button type="button" class="s-top" aria-expanded="false">Personal <i class="bi bi-chevron-down"></i></button>
        <div class="s-mega"><div class="s-mega-in">
          <a href="/personal" class="s-mi"><span class="s-mi-ico"><i class="bi bi-bank"></i></span><span><b>Current accounts</b><small>Everyday banking, zero monthly fee</small></span></a>
          <a href="/cards" class="s-mi"><span class="s-mi-ico"><i class="bi bi-credit-card-2-front"></i></span><span><b>Debit &amp; credit cards</b><small>Virtual and physical, freeze in one tap</small></span></a>
          <a href="/personal#savings" class="s-mi"><span class="s-mi-ico"><i class="bi bi-piggy-bank"></i></span><span><b>Savings pots</b><small>Goals, round-ups and bonus rates</small></span></a>
          <a href="/loans" class="s-mi"><span class="s-mi-ico"><i class="bi bi-cash-coin"></i></span><span><b>Loans</b><small>Fast decisions, fair rates</small></span></a>
        </div></div>
      </div>
      <div class="s-item">
        <button type="button" class="s-top" aria-expanded="false">Invest <i class="bi bi-chevron-down"></i></button>
        <div class="s-mega"><div class="s-mega-in">
          <a href="/business" class="s-mi"><span class="s-mi-ico"><i class="bi bi-bar-chart-line"></i></span><span><b>Markets &amp; trading</b><small>Crypto, stocks, gold and forex</small></span></a>
          <a href="/#ticker" class="s-mi"><span class="s-mi-ico"><i class="bi bi-activity"></i></span><span><b>Live rates</b><small>Prices updated every few seconds</small></span></a>
          <a href="/business#plans" class="s-mi"><span class="s-mi-ico"><i class="bi bi-hourglass-split"></i></span><span><b>Fixed-term plans</b><small>Lock in high-yield returns</small></span></a>
          <a href="/#calculators" class="s-mi"><span class="s-mi-ico"><i class="bi bi-calculator"></i></span><span><b>Calculators</b><small>Plan savings, loans and growth</small></span></a>
        </div></div>
      </div>
      <div class="s-item">
        <button type="button" class="s-top" aria-expanded="false">Payments <i class="bi bi-chevron-down"></i></button>
        <div class="s-mega"><div class="s-mega-in">
          <a href="/personal#transfers" class="s-mi"><span class="s-mi-ico"><i class="bi bi-arrow-left-right"></i></span><span><b>Transfers</b><small>Instant, between any banks</small></span></a>
          <a href="/personal#wire" class="s-mi"><span class="s-mi-ico"><i class="bi bi-globe2"></i></span><span><b>Wire &amp; international</b><small>Domestic wires and SWIFT</small></span></a>
          <a href="/business#bills" class="s-mi"><span class="s-mi-ico"><i class="bi bi-receipt"></i></span><span><b>Pay bills</b><small>Utility, electricity and subscriptions</small></span></a>
        </div></div>
      </div>
      <div class="s-item">
        <button type="button" class="s-top" aria-expanded="false">Company <i class="bi bi-chevron-down"></i></button>
        <div class="s-mega"><div class="s-mega-in">
          <a href="/about" class="s-mi"><span class="s-mi-ico"><i class="bi bi-info-circle"></i></span><span><b>About us</b><small>Our mission, team and story</small></span></a>
          <a href="/about#security" class="s-mi"><span class="s-mi-ico"><i class="bi bi-shield-check"></i></span><span><b>Security</b><small>Bank-grade 256-bit encryption</small></span></a>
          <a href="/contact" class="s-mi"><span class="s-mi-ico"><i class="bi bi-chat-dots"></i></span><span><b>Support</b><small>24/7 dedicated assistance</small></span></a>
          <a href="{{ route('app') }}" class="s-mi"><span class="s-mi-ico"><i class="bi bi-phone"></i></span><span><b>Get the app</b><small>Install in seconds</small></span></a>
        </div></div>
      </div>
    </nav>
    <div class="s-actions">
      <button type="button" class="s-icon" id="sTheme" aria-label="Toggle theme"><i class="bi bi-moon-stars"></i></button>
      <button type="button" class="s-btn s-btn-ghost d-none d-xl-inline-flex" data-install hidden><i class="bi bi-download"></i> Install app</button>
      <a href="/login" class="s-btn s-btn-line d-none d-sm-inline-flex">Sign in</a>
      <a href="/register" class="s-btn s-btn-solid d-none d-md-inline-flex">Open account</a>
      <button type="button" class="s-icon s-burger" id="sBurger" aria-label="Open menu"><i class="bi bi-list fs-4"></i></button>
    </div>
  </div>
</header>

<!-- Mobile Slide-out Drawer -->
<aside class="s-drawer" id="sDrawer" aria-hidden="true">
  <div class="s-drawer-bg" data-close-drawer></div>
  <div class="s-drawer-panel">
    <div class="s-drawer-top">
      <span class="s-brand">
        @if(!empty($settings->logo))
          <img class="logo-img" src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name }}">
        @else
          <span class="fs-4 fw-bold">{{ $settings->site_name }}</span>
        @endif
      </span>
      <button type="button" class="s-icon" data-close-drawer aria-label="Close"><i class="bi bi-x-lg"></i></button>
    </div>
    <details class="s-acc"><summary><i class="bi bi-person"></i> Personal</summary>
      <a href="/personal"><i class="bi bi-bank"></i> Current accounts</a>
      <a href="/cards"><i class="bi bi-credit-card-2-front"></i> Debit &amp; credit cards</a>
      <a href="/personal#savings"><i class="bi bi-piggy-bank"></i> Savings pots</a>
      <a href="/loans"><i class="bi bi-cash-coin"></i> Loans</a>
    </details>
    <details class="s-acc"><summary><i class="bi bi-graph-up-arrow"></i> Invest &amp; Trade</summary>
      <a href="/business"><i class="bi bi-bar-chart-line"></i> Markets &amp; trading</a>
      <a href="/#ticker"><i class="bi bi-activity"></i> Live rates</a>
      <a href="/business#plans"><i class="bi bi-hourglass-split"></i> Fixed-term plans</a>
      <a href="/#calculators"><i class="bi bi-calculator"></i> Calculators</a>
    </details>
    <details class="s-acc"><summary><i class="bi bi-send"></i> Payments &amp; Transfers</summary>
      <a href="/personal#transfers"><i class="bi bi-arrow-left-right"></i> Transfers</a>
      <a href="/personal#wire"><i class="bi bi-globe2"></i> Wire &amp; international</a>
      <a href="/business#bills"><i class="bi bi-receipt"></i> Pay bills</a>
    </details>
    <details class="s-acc"><summary><i class="bi bi-info-circle"></i> Company &amp; Support</summary>
      <a href="/about"><i class="bi bi-people"></i> About us</a>
      <a href="/about#security"><i class="bi bi-shield-check"></i> Security</a>
      <a href="/contact"><i class="bi bi-chat-dots"></i> Contact us</a>
      <a href="{{ route('app') }}"><i class="bi bi-phone"></i> Get the app</a>
    </details>
    <div class="s-drawer-cta">
      <a href="/register" class="s-btn s-btn-solid w-100">Open account</a>
      <a href="/login" class="s-btn s-btn-line w-100">Sign in</a>
      <button type="button" class="s-btn s-btn-ghost w-100" data-install><i class="bi bi-download"></i> Install app</button>
      <a href="{{ route('download.app') }}" class="s-btn s-btn-line w-100"><i class="bi bi-android2"></i> Download APK</a>
    </div>
  </div>
</aside>

<!-- Main Body -->
<main id="sMain">
  @yield('content')
</main>

<!-- Modern Footer -->
<footer class="s-footer">
  <div class="s-wrap">
    <div class="s-fgrid">
      <div class="s-fcol s-fabout">
        <a href="/" class="s-brand s-brand-w mb-3">
          @if(!empty($settings->logo))
            <img class="logo-img" src="{{ asset('storage/app/public/'.$settings->logo) }}" alt="{{ $settings->site_name }}">
          @else
            <span class="fs-4 fw-bold text-white">{{ $settings->site_name }}</span>
          @endif
        </a>
        <p>Banking that moves as fast as you do. Licensed and regulated digital financial services.</p>
        <ul class="s-contact">
          <li><i class="bi bi-envelope"></i> <a href="mailto:{{ $settings->contact_email ?? 'support@securesavehub.com' }}">{{ $settings->contact_email ?? 'support@securesavehub.com' }}</a></li>
          <li><i class="bi bi-geo-alt"></i> 301 East Water Street, Charlottesville, VA 22904</li>
        </ul>
        <div class="s-social">
          <a href="#" aria-label="X"><i class="bi bi-twitter-x"></i></a>
          <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
      <div class="s-fcol">
        <h6>Personal</h6>
        <a href="/personal">Current accounts</a>
        <a href="/cards">Debit &amp; credit cards</a>
        <a href="/personal#savings">Savings pots</a>
        <a href="/loans">Loans</a>
      </div>
      <div class="s-fcol">
        <h6>Invest</h6>
        <a href="/business">Markets &amp; trading</a>
        <a href="/#ticker">Live rates</a>
        <a href="/business#plans">Fixed plans</a>
        <a href="/#calculators">Calculators</a>
      </div>
      <div class="s-fcol">
        <h6>Payments</h6>
        <a href="/personal#transfers">Transfers</a>
        <a href="/personal#wire">Wire &amp; SWIFT</a>
        <a href="/business#bills">Pay bills</a>
      </div>
      <div class="s-fcol">
        <h6>Company</h6>
        <a href="/about">About us</a>
        <a href="/about#security">Security</a>
        <a href="/contact">Support</a>
        <a href="{{ route('app') }}">Get the app</a>
      </div>
    </div>
    <div class="s-news">
      <div><b>Stay informed</b><small>Get periodic financial insights and updates.</small></div>
      <form class="s-nform" data-demo-form>
        <input type="email" placeholder="Enter your email" aria-label="Email" required>
        <button class="s-btn s-btn-solid" type="submit">Subscribe</button>
      </form>
    </div>
    <div class="s-legal">
      <span>&copy; {{ date('Y') }} {{ $settings->site_name }}. All Rights Reserved.</span>
      <span><a href="/terms">Terms</a> · <a href="/privacy">Privacy</a> · <a href="/about#security">Security</a> · <a href="{{ route('app') }}">App Download</a></span>
    </div>
  </div>
</footer>

<button type="button" class="s-top-btn" id="sToTop" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

<!-- PWA Mobile Install Floating Bar -->
<div class="s-install" id="sInstall" hidden>
  <div class="s-install-in">
    <span class="s-badge"><img src="/images/icons/icon-192x192.png" alt="" width="38" height="38"></span>
    <div class="s-inst-copy"><b>Install {{ $settings->site_name }}</b><small>Add to home screen for a fast full-screen app.</small></div>
    <button type="button" class="s-btn s-btn-solid s-inst-btn" data-install>Install</button>
    <button type="button" class="s-x2" id="sInstallX" aria-label="Dismiss"><i class="bi bi-x-lg"></i></button>
  </div>
</div>

<!-- iOS Help Modal -->
<div class="modal fade" id="iosHelp" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius:22px;background:var(--sf);color:var(--ink);">
      <div class="modal-body p-4 text-center">
        <div style="font-size:3rem;margin-bottom:12px;">📱</div>
        <h4 class="fw-bold">Install on iPhone / iPad</h4>
        <p class="text-muted small">Install {{ $settings->site_name }} to your home screen in 3 quick steps:</p>
        <ol class="text-start mt-3 mb-4 ps-3" style="line-height:2">
          <li>Open this site in <b>Safari</b></li>
          <li>Tap the <b>Share</b> icon <i class="bi bi-box-arrow-up text-primary"></i> at the bottom</li>
          <li>Scroll down and tap <b>Add to Home Screen</b> <i class="bi bi-plus-square text-primary"></i></li>
        </ol>
        <button class="s-btn s-btn-solid w-100" data-bs-dismiss="modal">Got it</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/royalcity/site.js?v=5"></script>

<!-- Smartsupp Live Chat -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = 'd75c20e2df776b8ffbf647bd7b7fa7cdd7fd2719';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>

</body>
</html>
