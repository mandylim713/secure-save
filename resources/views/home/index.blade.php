@extends('layouts.base')
@section('title', 'Modern Online Banking')

@section('content')
<!-- 1 · HERO -->
<section class="s-hero"><div class="s-wrap s-hero-grid">
  <div>
    <h1 style="margin-top:0">Banking that <em>moves as fast</em> as you do.</h1>
    <p class="s-lead">Spend, save, trade and pay bills from one beautiful dashboard — on the web, or installed as an app on your phone. Every money move is protected by your PIN.</p>
    <div class="s-cta-row"><a href="/register" class="s-btn s-btn-solid s-btn-lg">Open free account <i class="bi bi-arrow-right"></i></a><a href="/apps" class="s-btn s-btn-line s-btn-lg"><i class="bi bi-phone"></i> Get the app</a></div>
    <div class="s-rate"><div class="s-avs"><span style="background:#00609E">A</span><span style="background:#7c3aed">J</span><span style="background:#ec4899">T</span><span style="background:#047857">M</span></div><div><span class="stars">?????</span> 4.9 from 12,000+ customers</div></div>
  </div>
  <div class="s-stage">
    <div class="mk-desk" role="img" aria-label="Preview of the web dashboard">
  <div class="mk-bar"><i></i><i></i><i></i><span>secure-savehub.com/dashboard</span></div>
  <div class="mk-body">
    <aside class="mk-side"><b><i class="bi bi-bank2"></i> {{ $settings->site_name }}</b>
      <span class="on"><i class="bi bi-house"></i> Home</span><span><i class="bi bi-arrow-left-right"></i> Activity</span><span><i class="bi bi-send"></i> Send</span><span><i class="bi bi-credit-card"></i> Cards</span><span><i class="bi bi-graph-up"></i> Trade</span><span><i class="bi bi-receipt"></i> Bills</span><span><i class="bi bi-chat-dots"></i> Messages</span></aside>
    <div class="mk-main">
      <div class="mk-hero"><small>Total balance</small><strong>$24,860.50</strong><em>+ $1,240.00 this month</em>
        <div class="mk-quick"><span><i class="bi bi-box-arrow-in-down"></i>Deposit</span><span><i class="bi bi-box-arrow-up"></i>Withdraw</span><span><i class="bi bi-arrow-left-right"></i>Transfer</span><span><i class="bi bi-receipt"></i>Bills</span></div></div>
      <div class="mk-grid">
        <div class="mk-card"><small>Spending · October</small><strong>$3,180</strong><svg viewBox="0 0 160 44" width="100%" height="44" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="gdaffa1" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#e5484d" stop-opacity=".35"/><stop offset="1" stop-color="#e5484d" stop-opacity="0"/></linearGradient></defs><path d="M0 41 L12.3 38.1 L24.6 39.5 L36.9 33.7 L49.2 35.2 L61.5 27.8 L73.8 30.8 L86.2 23.5 L98.5 24.9 L110.8 17.6 L123.1 19.1 L135.4 10.3 L147.7 13.2 L160 3 L160 44 L0 44 Z" fill="url(#gdaffa1)"/><path d="M0 41 L12.3 38.1 L24.6 39.5 L36.9 33.7 L49.2 35.2 L61.5 27.8 L73.8 30.8 L86.2 23.5 L98.5 24.9 L110.8 17.6 L123.1 19.1 L135.4 10.3 L147.7 13.2 L160 3" fill="none" stroke="#e5484d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <div class="mk-card"><small>Income · October</small><strong>$5,400</strong><svg viewBox="0 0 160 44" width="100%" height="44" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="ga5772e" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#2ec27e" stop-opacity=".35"/><stop offset="1" stop-color="#2ec27e" stop-opacity="0"/></linearGradient></defs><path d="M0 41 L14.5 37.7 L29.1 39.3 L43.6 31.1 L58.2 32.7 L72.7 24.5 L87.3 26.1 L101.8 17.9 L116.4 14.6 L130.9 16.2 L145.5 6.3 L160 3 L160 44 L0 44 Z" fill="url(#ga5772e)"/><path d="M0 41 L14.5 37.7 L29.1 39.3 L43.6 31.1 L58.2 32.7 L72.7 24.5 L87.3 26.1 L101.8 17.9 L116.4 14.6 L130.9 16.2 L145.5 6.3 L160 3" fill="none" stroke="#2ec27e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <div class="mk-card wide"><small>Recent activity</small>
          <ul><li><span class="a g"><i class="bi bi-arrow-down-left"></i></span>Salary — Northwind Ltd<b class="pos">+$4,200.00</b></li><li><span class="a r"><i class="bi bi-cart"></i></span>Grocery market<b>-$86.40</b></li><li><span class="a r"><i class="bi bi-lightning"></i></span>Electricity bill<b>-$120.00</b></li><li><span class="a g"><i class="bi bi-graph-up"></i></span>Gold trade · XAU<b class="pos">+$310.25</b></li></ul></div>
      </div>
    </div>
  </div>
</div>
    <div class="mk-phone" role="img" aria-label="Preview of the mobile app">
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
    <div class="s-float f1"><i class="bi bi-check2-circle"></i><div><b>Transfer sent</b><small>$250.00 · just now</small></div></div>
    <div class="s-float f2"><i class="bi bi-graph-up-arrow"></i><div><b>Gold +1.84%</b><small>XAU · today</small></div></div>
  </div>
</div></section>

<!-- 2 · LIVE TICKER --><div id="ticker"></div>
<div class="s-ticker" aria-label="Live market prices"><div class="s-tick-in">
      <span><b>BTC</b> $62,017.00 <em class="dn" style="font-style:normal">? 0.70%</em></span>
      <span><b>ETH</b> $1,754.78 <em class="dn" style="font-style:normal">? 0.41%</em></span>
      <span><b>USDT</b> $0.9991 <em class="up" style="font-style:normal">? 0.02%</em></span>
      <span><b>BNB</b> $579.89 <em class="up" style="font-style:normal">? 0.30%</em></span>
      <span><b>SOL</b> $72.81 <em class="dn" style="font-style:normal">? 0.06%</em></span>
      <span><b>XRP</b> $0.9604 <em class="dn" style="font-style:normal">? 0.36%</em></span>
      <span><b>LTC</b> $42.27 <em class="dn" style="font-style:normal">? 3.04%</em></span>
      <span><b>USDC</b> $0.9996 <em class="up" style="font-style:normal">? 0.01%</em></span>
      <span><b>ADA</b> $0.1517 <em class="up" style="font-style:normal">? 0.93%</em></span>
      <span><b>DOGE</b> $0.0580 <em class="dn" style="font-style:normal">? 0.51%</em></span>
      <span><b>TRX</b> $0.3102 <em class="up" style="font-style:normal">? 0.44%</em></span>
      <span><b>TON</b> $1.0160 <em class="up" style="font-style:normal">? 0.40%</em></span>
      <span><b>AVAX</b> $6.9600 <em class="up" style="font-style:normal">? 0.17%</em></span>
      <span><b>LINK</b> $8.9600 <em class="dn" style="font-style:normal">? 0.49%</em></span>
      <span><b>BTC</b> $62,017.00 <em class="dn" style="font-style:normal">? 0.70%</em></span>
      <span><b>ETH</b> $1,754.78 <em class="dn" style="font-style:normal">? 0.41%</em></span>
      <span><b>USDT</b> $0.9991 <em class="up" style="font-style:normal">? 0.02%</em></span>
      <span><b>BNB</b> $579.89 <em class="up" style="font-style:normal">? 0.30%</em></span>
      <span><b>SOL</b> $72.81 <em class="dn" style="font-style:normal">? 0.06%</em></span>
      <span><b>XRP</b> $0.9604 <em class="dn" style="font-style:normal">? 0.36%</em></span>
      <span><b>LTC</b> $42.27 <em class="dn" style="font-style:normal">? 3.04%</em></span>
      <span><b>USDC</b> $0.9996 <em class="up" style="font-style:normal">? 0.01%</em></span>
      <span><b>ADA</b> $0.1517 <em class="up" style="font-style:normal">? 0.93%</em></span>
      <span><b>DOGE</b> $0.0580 <em class="dn" style="font-style:normal">? 0.51%</em></span>
      <span><b>TRX</b> $0.3102 <em class="up" style="font-style:normal">? 0.44%</em></span>
      <span><b>TON</b> $1.0160 <em class="up" style="font-style:normal">? 0.40%</em></span>
      <span><b>AVAX</b> $6.9600 <em class="up" style="font-style:normal">? 0.17%</em></span>
      <span><b>LINK</b> $8.9600 <em class="dn" style="font-style:normal">? 0.49%</em></span>
  </div></div>

<!-- 3 · TRUST -->
<section class="s-trust"><div class="s-wrap"><div class="s-trust-row">
  <span><i class="bi bi-shield-lock"></i> PIN on every payment</span><span><i class="bi bi-fingerprint"></i> Device security</span><span><i class="bi bi-lock"></i> 256-bit encryption</span><span><i class="bi bi-patch-check"></i> KYC verified</span><span><i class="bi bi-headset"></i> 24/7 AI + human help</span>
</div></div></section>

<!-- 4 · STATS -->
<section class="s-sec tight"><div class="s-wrap"><div class="s-stats reveal">
  <div class="s-stat"><strong data-count="2.4" data-suf="M+">0</strong><span>Demo customers</span></div>
  <div class="s-stat"><strong data-count="38" data-suf="%">0</strong><span>Top plan return</span></div>
  <div class="s-stat"><strong data-count="23">0</strong><span>Bill categories</span></div>
  <div class="s-stat"><strong data-count="99.99" data-suf="%">0</strong><span>Uptime, last 12 months</span></div>
</div></div></section>

<!-- 5 · FEATURES -->
<section class="s-sec alt"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Why {{ $settings->site_name }}</span><h2 class="s-h2">Everything money does, in one place</h2><p class="s-lead">Replace a drawer full of apps with one fast, secure, beautifully simple bank.</p></div>
  <div class="s-grid g3">
          <div class="s-card reveal"><div class="s-ico"><i class="bi bi-send"></i></div><h3>Instant transfers</h3><p>Send money to anyone in seconds with PIN-protected, rolling confirmations.</p><a class="s-link" href="/personal#transfers">Learn more <i class="bi bi-arrow-right"></i></a></div>
          <div class="s-card reveal"><div class="s-ico"><i class="bi bi-credit-card-2-front"></i></div><h3>Smart cards</h3><p>Order physical cards, create virtual ones and freeze with a single tap.</p><a class="s-link" href="/cards">Learn more <i class="bi bi-arrow-right"></i></a></div>
          <div class="s-card reveal"><div class="s-ico"><i class="bi bi-graph-up-arrow"></i></div><h3>Trade & invest</h3><p>Crypto, stocks, gold and forex with advanced live charts.</p><a class="s-link" href="/business">Learn more <i class="bi bi-arrow-right"></i></a></div>
          <div class="s-card reveal"><div class="s-ico"><i class="bi bi-receipt"></i></div><h3>Pay any bill</h3><p>Airtime, power, water, TV, internet, tax and 17 more categories.</p><a class="s-link" href="/business#bills">Learn more <i class="bi bi-arrow-right"></i></a></div>
          <div class="s-card reveal"><div class="s-ico"><i class="bi bi-piggy-bank"></i></div><h3>Savings pots</h3><p>Set goals, automate round-ups and watch interest build.</p><a class="s-link" href="/personal#savings">Learn more <i class="bi bi-arrow-right"></i></a></div>
          <div class="s-card reveal"><div class="s-ico"><i class="bi bi-robot"></i></div><h3>AI assistant</h3><p>Chat or voice-call an assistant trained on bank data and your account.</p><a class="s-link" href="#ai">Learn more <i class="bi bi-arrow-right"></i></a></div>
      </div>
</div></section>

<!-- 6 · ACCOUNT TABS -->
<section class="s-sec"><div class="s-wrap" data-tabs>
  <div class="s-head reveal"><span class="s-kicker">Accounts</span><h2 class="s-h2">An account for every goal</h2></div>
  <div class="s-tabs"><button class="s-tab on">Checking</button><button class="s-tab">Savings</button><button class="s-tab">Credit</button><button class="s-tab">Business</button></div>
      <div class="s-pane s-split on">
      <div><h3 class="s-h2" style="font-size:2rem">Checking built for daily life</h3><p class="s-lead">Zero monthly fees, instant notifications and a debit card the moment you sign up.</p><ul class="s-checks"><li><i class="bi bi-check-circle-fill"></i><span>No minimum balance</span></li><li><i class="bi bi-check-circle-fill"></i><span>Free domestic transfers</span></li><li><i class="bi bi-check-circle-fill"></i><span>Spending insights each month</span></li><li><i class="bi bi-check-circle-fill"></i><span>Freeze or unfreeze any time</span></li></ul><div class="s-cta-row"><a href="/personal" class="s-btn s-btn-solid">Explore checking</a><a href="/register" class="s-btn s-btn-line">Open account</a></div></div>
      <div class="s-cards3d"><div class="bk c1"><div class="row"><b>{{ $settings->site_name }}</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 4000</strong><div class="row"><span>ALEX MORGAN</span><span>09/29</span></div></div></div>
    </div>
      <div class="s-pane s-split">
      <div><h3 class="s-h2" style="font-size:2rem">Savings that actually grow</h3><p class="s-lead">Create pots for holidays, emergencies or a new home and earn a bonus rate on every one.</p><ul class="s-checks"><li><i class="bi bi-check-circle-fill"></i><span>Round-up every purchase</span></li><li><i class="bi bi-check-circle-fill"></i><span>Automatic monthly top-ups</span></li><li><i class="bi bi-check-circle-fill"></i><span>Withdraw whenever you like</span></li><li><i class="bi bi-check-circle-fill"></i><span>Interest shown daily</span></li></ul><div class="s-cta-row"><a href="/personal#savings" class="s-btn s-btn-solid">Explore savings</a><a href="/register" class="s-btn s-btn-line">Open account</a></div></div>
      <div class="s-cards3d"><div class="bk c4"><div class="row"><b>{{ $settings->site_name }}</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 4777</strong><div class="row"><span>ALEX MORGAN</span><span>09/29</span></div></div></div>
    </div>
      <div class="s-pane s-split">
      <div><h3 class="s-h2" style="font-size:2rem">Credit with clear terms</h3><p class="s-lead">A transparent credit line with real-time limits, no hidden charges and easy repayments.</p><ul class="s-checks"><li><i class="bi bi-check-circle-fill"></i><span>Instant limit view</span></li><li><i class="bi bi-check-circle-fill"></i><span>Pay from any account</span></li><li><i class="bi bi-check-circle-fill"></i><span>Free virtual credit card</span></li><li><i class="bi bi-check-circle-fill"></i><span>Spend alerts</span></li></ul><div class="s-cta-row"><a href="/cards" class="s-btn s-btn-solid">Explore credit</a><a href="/register" class="s-btn s-btn-line">Open account</a></div></div>
      <div class="s-cards3d"><div class="bk c3"><div class="row"><b>{{ $settings->site_name }}</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 5554</strong><div class="row"><span>ALEX MORGAN</span><span>09/29</span></div></div></div>
    </div>
      <div class="s-pane s-split">
      <div><h3 class="s-h2" style="font-size:2rem">Business accounts that scale</h3><p class="s-lead">Multi-user access, invoices, bulk payments and wire transfers for growing teams.</p><ul class="s-checks"><li><i class="bi bi-check-circle-fill"></i><span>Team members & roles</span></li><li><i class="bi bi-check-circle-fill"></i><span>Domestic and SWIFT wires</span></li><li><i class="bi bi-check-circle-fill"></i><span>Tax payment receipts</span></li><li><i class="bi bi-check-circle-fill"></i><span>Dedicated support</span></li></ul><div class="s-cta-row"><a href="business" class="s-btn s-btn-solid">Explore business</a><a href="/register" class="s-btn s-btn-line">Open account</a></div></div>
      <div class="s-cards3d"><div class="bk c2"><div class="row"><b>{{ $settings->site_name }}</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 6331</strong><div class="row"><span>ALEX MORGAN</span><span>09/29</span></div></div></div>
    </div>
  </div></section>

<!-- 7 · WEB DASHBOARD SHOWCASE -->
<section class="s-sec alt"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Web dashboard</span><h2 class="s-h2">A command centre for your money</h2><p class="s-lead">A roomy desktop dashboard with a side navigation, live balances, charts and a side drawer that rolls in for every payment flow.</p></div>
  <div class="s-show reveal"><div class="mk-desk" role="img" aria-label="Preview of the web dashboard">
  <div class="mk-bar"><i></i><i></i><i></i><span>secure-savehub.com/dashboard</span></div>
  <div class="mk-body">
    <aside class="mk-side"><b><i class="bi bi-bank2"></i> {{ $settings->site_name }}</b>
      <span class="on"><i class="bi bi-house"></i> Home</span><span><i class="bi bi-arrow-left-right"></i> Activity</span><span><i class="bi bi-send"></i> Send</span><span><i class="bi bi-credit-card"></i> Cards</span><span><i class="bi bi-graph-up"></i> Trade</span><span><i class="bi bi-receipt"></i> Bills</span><span><i class="bi bi-chat-dots"></i> Messages</span></aside>
    <div class="mk-main">
      <div class="mk-hero"><small>Total balance</small><strong>$24,860.50</strong><em>+ $1,240.00 this month</em>
        <div class="mk-quick"><span><i class="bi bi-box-arrow-in-down"></i>Deposit</span><span><i class="bi bi-box-arrow-up"></i>Withdraw</span><span><i class="bi bi-arrow-left-right"></i>Transfer</span><span><i class="bi bi-receipt"></i>Bills</span></div></div>
      <div class="mk-grid">
        <div class="mk-card"><small>Spending · October</small><strong>$3,180</strong><svg viewBox="0 0 160 44" width="100%" height="44" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="gdaffa1" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#e5484d" stop-opacity=".35"/><stop offset="1" stop-color="#e5484d" stop-opacity="0"/></linearGradient></defs><path d="M0 41 L12.3 38.1 L24.6 39.5 L36.9 33.7 L49.2 35.2 L61.5 27.8 L73.8 30.8 L86.2 23.5 L98.5 24.9 L110.8 17.6 L123.1 19.1 L135.4 10.3 L147.7 13.2 L160 3 L160 44 L0 44 Z" fill="url(#gdaffa1)"/><path d="M0 41 L12.3 38.1 L24.6 39.5 L36.9 33.7 L49.2 35.2 L61.5 27.8 L73.8 30.8 L86.2 23.5 L98.5 24.9 L110.8 17.6 L123.1 19.1 L135.4 10.3 L147.7 13.2 L160 3" fill="none" stroke="#e5484d" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <div class="mk-card"><small>Income · October</small><strong>$5,400</strong><svg viewBox="0 0 160 44" width="100%" height="44" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="ga5772e" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#2ec27e" stop-opacity=".35"/><stop offset="1" stop-color="#2ec27e" stop-opacity="0"/></linearGradient></defs><path d="M0 41 L14.5 37.7 L29.1 39.3 L43.6 31.1 L58.2 32.7 L72.7 24.5 L87.3 26.1 L101.8 17.9 L116.4 14.6 L130.9 16.2 L145.5 6.3 L160 3 L160 44 L0 44 Z" fill="url(#ga5772e)"/><path d="M0 41 L14.5 37.7 L29.1 39.3 L43.6 31.1 L58.2 32.7 L72.7 24.5 L87.3 26.1 L101.8 17.9 L116.4 14.6 L130.9 16.2 L145.5 6.3 L160 3" fill="none" stroke="#2ec27e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
        <div class="mk-card wide"><small>Recent activity</small>
          <ul><li><span class="a g"><i class="bi bi-arrow-down-left"></i></span>Salary — Northwind Ltd<b class="pos">+$4,200.00</b></li><li><span class="a r"><i class="bi bi-cart"></i></span>Grocery market<b>-$86.40</b></li><li><span class="a r"><i class="bi bi-lightning"></i></span>Electricity bill<b>-$120.00</b></li><li><span class="a g"><i class="bi bi-graph-up"></i></span>Gold trade · XAU<b class="pos">+$310.25</b></li></ul></div>
      </div>
    </div>
  </div>
</div>
</div>
  <div class="s-grid g4" style="margin-top:34px">
          <div class="s-card reveal" style="text-align:center;padding:20px"><div class="s-ico" style="margin:0 auto 10px"><i class="bi bi-speedometer2"></i></div><b>Live balances</b></div>
          <div class="s-card reveal" style="text-align:center;padding:20px"><div class="s-ico" style="margin:0 auto 10px"><i class="bi bi-pie-chart"></i></div><b>Monthly insight</b></div>
          <div class="s-card reveal" style="text-align:center;padding:20px"><div class="s-ico" style="margin:0 auto 10px"><i class="bi bi-layout-sidebar-inset-reverse"></i></div><b>Side-drawer flows</b></div>
          <div class="s-card reveal" style="text-align:center;padding:20px"><div class="s-ico" style="margin:0 auto 10px"><i class="bi bi-moon-stars"></i></div><b>Light & dark themes</b></div>
      </div>
</div></section>

<!-- 8 · MOBILE APP SHOWCASE -->
<section class="s-sec"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Mobile app</span><h2 class="s-h2">Your whole bank in your pocket</h2><p class="s-lead">Install it straight from your browser — no app store needed. Full-screen, fast and always up to date.</p></div>
  <div class="s-phones reveal"><div class="mk-phone" role="img" aria-label="Preview of the mobile app">
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
<div class="mk-phone" role="img" aria-label="Preview of the mobile app">
  <div class="mk-notch"></div>
    <div class="mp-top"><b>Pay bills</b><small>What would you like to pay?</small></div>
  <div class="mp-grid"><span><i class="bi bi-phone"></i>Airtime</span><span><i class="bi bi-lightning"></i>Power</span><span><i class="bi bi-droplet"></i>Water</span><span><i class="bi bi-wifi"></i>Internet</span><span><i class="bi bi-tv"></i>TV</span><span><i class="bi bi-fire"></i>Gas</span></div>
    <div class="mp-nav"><i class="bi bi-house-fill on"></i><i class="bi bi-arrow-left-right"></i><i class="bi bi-send"></i><i class="bi bi-credit-card"></i><i class="bi bi-grid"></i></div>
</div>
</div>
  <div class="s-cta-row" style="justify-content:center"><a href="/apps" class="s-btn s-btn-solid s-btn-lg"><i class="bi bi-download"></i> Install the app</a></div>
</div></section>

<!-- 9 · HOW IT WORKS -->
<section class="s-sec alt"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Get started</span><h2 class="s-h2">Open an account in four steps</h2></div>
  <div class="s-steps">
          <div class="s-step reveal"><div class="s-ico"><i class="bi bi-person-plus"></i></div><h3>Create your profile</h3><p>Name, email and a few details — it takes about two minutes.</p></div>
          <div class="s-step reveal"><div class="s-ico"><i class="bi bi-shield-lock"></i></div><h3>Set your PIN</h3><p>Choose a 6-digit PIN that protects every money move.</p></div>
          <div class="s-step reveal"><div class="s-ico"><i class="bi bi-patch-check"></i></div><h3>Verify identity</h3><p>Upload an ID once. We review it before wires and crypto sends are unlocked.</p></div>
          <div class="s-step reveal"><div class="s-ico"><i class="bi bi-rocket-takeoff"></i></div><h3>Start banking</h3><p>Deposit, send, trade, invest and pay bills straight away.</p></div>
      </div>
</div></section>

<!-- 10 · CARDS -->
<section class="s-sec"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Cards</span><h2 class="s-h2">Pick a card that fits your style</h2><p class="s-lead">Physical or virtual, with colours to match. Freeze, unfreeze and set limits instantly.</p></div>
  <div class="s-cards3d reveal">
          <div class="bk c1"><div class="row"><b>Classic</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 4821</strong><div class="row"><span>ALEX MORGAN</span><span>VISA</span></div></div>
          <div class="bk c2"><div class="row"><b>Black</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 7710</strong><div class="row"><span>ALEX MORGAN</span><span>VISA</span></div></div>
          <div class="bk c3"><div class="row"><b>Aurora</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 3095</strong><div class="row"><span>ALEX MORGAN</span><span>VISA</span></div></div>
          <div class="bk c4"><div class="row"><b>Emerald</b><i class="bi bi-wifi"></i></div><div class="chip"></div><strong>•••• •••• •••• 5562</strong><div class="row"><span>ALEX MORGAN</span><span>VISA</span></div></div>
      </div>
  <div class="s-cta-row" style="justify-content:center"><a href="/cards" class="s-btn s-btn-solid">Compare cards</a></div>
</div></section>

<!-- 11 · CALCULATORS --><div id="calculators"></div>
<section class="s-sec alt" id="calc"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Plan ahead</span><h2 class="s-h2">See what your money can do</h2></div>
  <div class="s-grid g2">
    <div class="s-calc reveal" data-calc="savings"><h3>Savings calculator</h3>
      <label>Starting amount <output for="init"></output></label><input type="range" name="init" min="0" max="50000" step="500" value="5000" data-pre="$">
      <label>Monthly deposit <output for="monthly"></output></label><input type="range" name="monthly" min="0" max="5000" step="50" value="400" data-pre="$">
      <label>Interest rate <output for="rate"></output></label><input type="range" name="rate" min="1" max="12" step="0.25" value="4.5" data-suf="%">
      <label>Years <output for="years"></output></label><input type="range" name="years" min="1" max="30" step="1" value="10">
      <div class="s-res" data-out></div></div>
    <div class="s-calc reveal" data-calc="loan"><h3>Loan calculator</h3>
      <label>Loan amount <output for="amount"></output></label><input type="range" name="amount" min="1000" max="100000" step="500" value="15000" data-pre="$">
      <label>Interest rate <output for="rate"></output></label><input type="range" name="rate" min="3" max="25" step="0.25" value="9.5" data-suf="%">
      <label>Term (months) <output for="months"></output></label><input type="range" name="months" min="6" max="84" step="6" value="36">
      <div class="s-res" data-out></div></div>
  </div>
</div></section>

<!-- 12 · MARKETS -->
<section class="s-sec"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Markets</span><h2 class="s-h2">Trade crypto, stocks, gold and forex</h2><p class="s-lead">Charts, candles and an order book for crypto, stocks, gold and forex.</p></div>
  <div class="reveal"><div class="s-scroll"><table class="s-table"><thead><tr><th>Asset</th><th class="r">Price</th><th class="r">24h</th><th class="r d-none d-sm-table-cell">Trend</th><th></th></tr></thead><tbody><tr><td><div class="sym"><i style="background:#f7931a">BTC</i><div>Bitcoin<br><small class="text-muted">BTC · Crypto</small></div></div></td><td class="r"><b>$62,017.00</b></td><td class="r dn" style="color:var(--bad)">? 0.70%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="g50cca4" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#dc2626" stop-opacity=".35"/><stop offset="1" stop-color="#dc2626" stop-opacity="0"/></linearGradient></defs><path d="M0 11.6 L7.3 7 L14.7 6.8 L22 6.7 L29.3 5.1 L36.7 5.9 L44 4 L51.3 4.9 L58.7 3 L66 9 L73.3 14.9 L80.7 18.4 L88 19.1 L95.3 17.5 L102.7 24.6 L110 27 L110 30 L0 30 Z" fill="url(#g50cca4)"/><path d="M0 11.6 L7.3 7 L14.7 6.8 L22 6.7 L29.3 5.1 L36.7 5.9 L44 4 L51.3 4.9 L58.7 3 L66 9 L73.3 14.9 L80.7 18.4 L88 19.1 L95.3 17.5 L102.7 24.6 L110 27" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#627eea">ETH</i><div>Ethereum<br><small class="text-muted">ETH · Crypto</small></div></div></td><td class="r"><b>$1,754.78</b></td><td class="r dn" style="color:var(--bad)">? 0.41%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="ga1228a" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#dc2626" stop-opacity=".35"/><stop offset="1" stop-color="#dc2626" stop-opacity="0"/></linearGradient></defs><path d="M0 9.1 L7.3 5.7 L14.7 7 L22 7.5 L29.3 6 L36.7 7.3 L44 5.6 L51.3 6.2 L58.7 3 L66 9.7 L73.3 17.7 L80.7 22.7 L88 22.2 L95.3 19.3 L102.7 23.3 L110 27 L110 30 L0 30 Z" fill="url(#ga1228a)"/><path d="M0 9.1 L7.3 5.7 L14.7 7 L22 7.5 L29.3 6 L36.7 7.3 L44 5.6 L51.3 6.2 L58.7 3 L66 9.7 L73.3 17.7 L80.7 22.7 L88 22.2 L95.3 19.3 L102.7 23.3 L110 27" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#26a17b">USD</i><div>Tether<br><small class="text-muted">USDT · Crypto</small></div></div></td><td class="r"><b>$0.9991</b></td><td class="r pos" style="">? 0.02%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="gc244f7" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#16a34a" stop-opacity=".35"/><stop offset="1" stop-color="#16a34a" stop-opacity="0"/></linearGradient></defs><path d="M0 8.1 L7.3 7.5 L14.7 8.5 L22 3 L29.3 8 L36.7 13.2 L44 10.3 L51.3 4 L58.7 13.9 L66 14.3 L73.3 9.9 L80.7 9 L88 17.4 L95.3 16.9 L102.7 22.6 L110 27 L110 30 L0 30 Z" fill="url(#gc244f7)"/><path d="M0 8.1 L7.3 7.5 L14.7 8.5 L22 3 L29.3 8 L36.7 13.2 L44 10.3 L51.3 4 L58.7 13.9 L66 14.3 L73.3 9.9 L80.7 9 L88 17.4 L95.3 16.9 L102.7 22.6 L110 27" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#f3ba2f">BNB</i><div>BNB<br><small class="text-muted">BNB · Crypto</small></div></div></td><td class="r"><b>$579.89</b></td><td class="r pos" style="">? 0.30%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="g5c441f" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#16a34a" stop-opacity=".35"/><stop offset="1" stop-color="#16a34a" stop-opacity="0"/></linearGradient></defs><path d="M0 15.9 L7.3 10 L14.7 10.3 L22 9 L29.3 9.6 L36.7 5.4 L44 4.6 L51.3 4.4 L58.7 3 L66 7.8 L73.3 16.7 L80.7 20.6 L88 19.4 L95.3 16.3 L102.7 24.7 L110 27 L110 30 L0 30 Z" fill="url(#g5c441f)"/><path d="M0 15.9 L7.3 10 L14.7 10.3 L22 9 L29.3 9.6 L36.7 5.4 L44 4.6 L51.3 4.4 L58.7 3 L66 7.8 L73.3 16.7 L80.7 20.6 L88 19.4 L95.3 16.3 L102.7 24.7 L110 27" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#9945ff">SOL</i><div>Solana<br><small class="text-muted">SOL · Crypto</small></div></div></td><td class="r"><b>$72.81</b></td><td class="r dn" style="color:var(--bad)">? 0.06%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="ga9074e" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#dc2626" stop-opacity=".35"/><stop offset="1" stop-color="#dc2626" stop-opacity="0"/></linearGradient></defs><path d="M0 9 L7.3 3.6 L14.7 5.7 L22 9.8 L29.3 9.7 L36.7 11 L44 6.6 L51.3 6.4 L58.7 3 L66 5.8 L73.3 20.9 L80.7 24.7 L88 18.2 L95.3 15.5 L102.7 21.8 L110 27 L110 30 L0 30 Z" fill="url(#ga9074e)"/><path d="M0 9 L7.3 3.6 L14.7 5.7 L22 9.8 L29.3 9.7 L36.7 11 L44 6.6 L51.3 6.4 L58.7 3 L66 5.8 L73.3 20.9 L80.7 24.7 L88 18.2 L95.3 15.5 L102.7 21.8 L110 27" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#23292f">XRP</i><div>XRP<br><small class="text-muted">XRP · Crypto</small></div></div></td><td class="r"><b>$0.9604</b></td><td class="r dn" style="color:var(--bad)">? 0.36%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="ge201e3" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#dc2626" stop-opacity=".35"/><stop offset="1" stop-color="#dc2626" stop-opacity="0"/></linearGradient></defs><path d="M0 18.1 L7.3 10.3 L14.7 10.8 L22 10.1 L29.3 8.3 L36.7 11.6 L44 6 L51.3 5.6 L58.7 3 L66 7.8 L73.3 21.4 L80.7 21.7 L88 21.4 L95.3 17.9 L102.7 23.7 L110 27 L110 30 L0 30 Z" fill="url(#ge201e3)"/><path d="M0 18.1 L7.3 10.3 L14.7 10.8 L22 10.1 L29.3 8.3 L36.7 11.6 L44 6 L51.3 5.6 L58.7 3 L66 7.8 L73.3 21.4 L80.7 21.7 L88 21.4 L95.3 17.9 L102.7 23.7 L110 27" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#345d9d">LTC</i><div>Litecoin<br><small class="text-muted">LTC · Crypto</small></div></div></td><td class="r"><b>$42.27</b></td><td class="r dn" style="color:var(--bad)">? 3.04%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="g01e690" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#dc2626" stop-opacity=".35"/><stop offset="1" stop-color="#dc2626" stop-opacity="0"/></linearGradient></defs><path d="M0 5.2 L7.3 3.2 L14.7 3.4 L22 3 L29.3 3.5 L36.7 4.8 L44 4.4 L51.3 4.2 L58.7 4.7 L66 8.3 L73.3 15.9 L80.7 18.7 L88 23.2 L95.3 19.5 L102.7 20.5 L110 27 L110 30 L0 30 Z" fill="url(#g01e690)"/><path d="M0 5.2 L7.3 3.2 L14.7 3.4 L22 3 L29.3 3.5 L36.7 4.8 L44 4.4 L51.3 4.2 L58.7 4.7 L66 8.3 L73.3 15.9 L80.7 18.7 L88 23.2 L95.3 19.5 L102.7 20.5 L110 27" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr><tr><td><div class="sym"><i style="background:#2775ca">USD</i><div>USD Coin<br><small class="text-muted">USDC · Crypto</small></div></div></td><td class="r"><b>$0.9996</b></td><td class="r pos" style="">? 0.01%</td><td class="r d-none d-sm-table-cell" style="width:120px"><svg viewBox="0 0 110 30" width="100%" height="30" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="g7e69a5" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#16a34a" stop-opacity=".35"/><stop offset="1" stop-color="#16a34a" stop-opacity="0"/></linearGradient></defs><path d="M0 12.1 L7.3 8.3 L14.7 8.1 L22 9.3 L29.3 7.6 L36.7 15 L44 14.9 L51.3 3 L58.7 13.7 L66 13.3 L73.3 10 L80.7 7.4 L88 16.2 L95.3 14.4 L102.7 24.3 L110 27 L110 30 L0 30 Z" fill="url(#g7e69a5)"/><path d="M0 12.1 L7.3 8.3 L14.7 8.1 L22 9.3 L29.3 7.6 L36.7 15 L44 14.9 L51.3 3 L58.7 13.7 L66 13.3 L73.3 10 L80.7 7.4 L88 16.2 L95.3 14.4 L102.7 24.3 L110 27" fill="none" stroke="#16a34a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td class="r"><a class="s-link" style="margin:0" href="/register">Trade <i class="bi bi-arrow-right"></i></a></td></tr></tbody></table></div></div>
  <div class="s-cta-row" style="justify-content:center"><a href="/#ticker" class="s-btn s-btn-line">See all live rates</a><a href="/business" class="s-btn s-btn-solid">Start trading</a></div>
</div></section>

<!-- 13 · GOLD & CRYPTO -->
<section class="s-sec alt"><div class="s-wrap s-split s-grid">
  <div class="reveal"><span class="s-kicker">Gold &amp; digital assets</span><h2 class="s-h2">Hold gold and crypto beside your cash</h2><p class="s-lead">Buy and sell from your checking balance. Every trade needs your PIN and rolls for a couple of seconds before it is confirmed.</p>
    <ul class="s-checks"><li><i class="bi bi-check-circle-fill"></i><span><b>Gold (XAU)</b> and silver with live pricing</span></li><li><i class="bi bi-check-circle-fill"></i><span><b>Crypto transfers</b> to external wallets with network selection</span></li><li><i class="bi bi-check-circle-fill"></i><span><b>Advanced charts</b> — candles, depth and time ranges</span></li></ul>
    <div class="s-cta-row"><a href="/business" class="s-btn s-btn-solid">Explore markets</a></div></div>
  <div class="s-phones reveal" style="margin:0"><div class="mk-phone" role="img" aria-label="Preview of the mobile app">
  <div class="mk-notch"></div>
    <div class="mp-top"><b>Gold · XAU</b><small>Commodity</small></div>
  <div class="mp-price"><strong>$2,418.60</strong><em class="pos">? 1.84%</em></div>
  <div class="mp-chart"><svg viewBox="0 0 220 120" width="100%" height="120" preserveAspectRatio="none" aria-hidden="true"><defs><linearGradient id="g67bb80" x1="0" x2="0" y1="0" y2="1"><stop offset="0" stop-color="#f2b01e" stop-opacity=".35"/><stop offset="1" stop-color="#f2b01e" stop-opacity="0"/></linearGradient></defs><path d="M0 117 L16.9 108.9 L33.8 112.9 L50.8 92.6 L67.7 96.6 L84.6 76.3 L101.5 84.4 L118.5 60 L135.4 64.1 L152.3 43.7 L169.2 51.9 L186.2 19.3 L203.1 27.4 L220 3 L220 120 L0 120 Z" fill="url(#g67bb80)"/><path d="M0 117 L16.9 108.9 L33.8 112.9 L50.8 92.6 L67.7 96.6 L84.6 76.3 L101.5 84.4 L118.5 60 L135.4 64.1 L152.3 43.7 L169.2 51.9 L186.2 19.3 L203.1 27.4 L220 3" fill="none" stroke="#f2b01e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
  <div class="mp-seg"><span>1H</span><span class="on">1D</span><span>1W</span><span>1M</span></div>
  <div class="mp-btns"><span class="buy">Buy</span><span class="sell">Sell</span></div>
    <div class="mp-nav"><i class="bi bi-house-fill on"></i><i class="bi bi-arrow-left-right"></i><i class="bi bi-send"></i><i class="bi bi-credit-card"></i><i class="bi bi-grid"></i></div>
</div>
</div>
</div></section>



<!-- 15 · BILLS -->
<section class="s-sec alt"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Bills &amp; tax</span><h2 class="s-h2">23 bill categories, one tap away</h2></div>
  <div class="s-grid g6">
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-phone"></i>Airtime</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-wifi"></i>Mobile data</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-lightning-charge"></i>Electricity</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-droplet"></i>Water</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-fire"></i>Gas</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-recycle"></i>Waste</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-router"></i>Internet</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-tv"></i>TV</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-play-btn"></i>Streaming</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-house"></i>Rent</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-bank2"></i>Tax</a>
          <a href="/business#bills" class="s-bill reveal"><i class="bi bi-mortarboard"></i>Education</a>
      </div>
  <div class="s-cta-row" style="justify-content:center"><a href="/business#bills" class="s-btn s-btn-solid">See all categories</a></div>
</div></section>

<!-- 16 · SECURITY -->
<section class="s-sec s-sec-dark"><div class="s-wrap s-split s-grid">
  <div><span class="s-kicker" style="background:rgba(255,255,255,.14);color:#fff">Security</span><h2 class="s-h2">Protected at every step</h2><p class="s-lead">Your PIN guards every payment. Admins can suspend or freeze accounts instantly, and suspicious activity is stopped before money moves.</p>
    <div class="s-grid g2" style="margin-top:22px">      <div class="s-card" style="padding:18px"><div class="s-ico" style="width:42px;height:42px;font-size:1.2rem;margin-bottom:10px"><i class="bi bi-123"></i></div><b>6-digit PIN</b><p style="font-size:.84rem">Required on every money action</p></div>      <div class="s-card" style="padding:18px"><div class="s-ico" style="width:42px;height:42px;font-size:1.2rem;margin-bottom:10px"><i class="bi bi-lock-fill"></i></div><b>Lockouts</b><p style="font-size:.84rem">5 wrong PINs locks for 5 minutes</p></div>      <div class="s-card" style="padding:18px"><div class="s-ico" style="width:42px;height:42px;font-size:1.2rem;margin-bottom:10px"><i class="bi bi-snow2"></i></div><b>Freeze</b><p style="font-size:.84rem">Stop activity with one tap</p></div>      <div class="s-card" style="padding:18px"><div class="s-ico" style="width:42px;height:42px;font-size:1.2rem;margin-bottom:10px"><i class="bi bi-eye-slash"></i></div><b>Privacy</b><p style="font-size:.84rem">Hide balances anywhere</p></div></div>
    <div class="s-cta-row"><a href="/about#security" class="s-btn s-btn-white">How we protect you</a></div></div>
  <div class="s-shield" aria-hidden="true"><i class="bi bi-shield-check"></i></div>
</div></section>

<!-- 17 · AI ASSISTANT -->
<section class="s-sec" id="ai"><div class="s-wrap s-split s-grid">
  <div class="reveal"><span class="s-kicker">AI assistant</span><h2 class="s-h2">Ask, or just call</h2><p class="s-lead">Chat with the assistant or tap the call button and talk. It is trained on {{ $settings->site_name }} bank data and can read your balances, recent activity and fees. It can never move money.</p>
    <ul class="s-checks"><li><i class="bi bi-mic-fill"></i><span><b>Voice calls</b> with spoken answers</span></li><li><i class="bi bi-book"></i><span><b>Trained by admins</b> on your own Q&amp;A</span></li><li><i class="bi bi-shield-check"></i><span><b>Read-only</b> — payments always need your PIN</span></li></ul></div>
  <div class="s-ai reveal"><div class="s-msg u">What's my balance and last transaction?</div><div class="s-msg a">Your Personal account holds <b>$24,860.50</b>. The last activity was a salary credit of $4,200.00 today.</div><div class="s-msg u">What does an international wire cost?</div><div class="s-msg a">International (SWIFT) wires cost <b>$30.00</b>. Domestic wires cost $15.00.</div><div class="s-wave" aria-hidden="true"><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div></div>
</div></section>

<!-- 18 · TESTIMONIALS -->
<section class="s-sec alt"><div class="s-wrap"><div class="s-tbox" data-quotes>
  <span class="s-kicker">Loved by customers</span><div style="margin-top:22px">
      <div class="s-quote on"><blockquote>“The dashboard is gorgeous and the PIN pad makes every payment feel safe. I moved everything over in a day.”</blockquote><div class="s-who"><span style="background:#00609E">J</span><div><b>Jamie Lee</b><small>Designer, Denver</small></div></div></div>
      <div class="s-quote"><blockquote>“Gold trading beside my checking account is a game changer. The charts are better than my broker’s.”</blockquote><div class="s-who"><span style="background:#7c3aed">T</span><div><b>Taylor Brooks</b><small>Analyst, Boston</small></div></div></div>
      <div class="s-quote"><blockquote>“I installed it on my phone in two taps. It feels exactly like a native app.”</blockquote><div class="s-who"><span style="background:#ec4899">M</span><div><b>Morgan Reyes</b><small>Founder, Austin</small></div></div></div>
      <div class="s-quote"><blockquote>“Paying the electricity, water and tax bills from one screen saves me hours every month.”</blockquote><div class="s-who"><span style="background:#047857">S</span><div><b>Sam Patel</b><small>Teacher, Seattle</small></div></div></div>
  </div>
  <div class="s-dots"><button type="button" class="on" aria-label="Quote 1"></button><button type="button" class="" aria-label="Quote 2"></button><button type="button" class="" aria-label="Quote 3"></button><button type="button" class="" aria-label="Quote 4"></button></div>
</div></div></section>

<!-- 19 · PRICING -->
<section class="s-sec"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">Simple pricing</span><h2 class="s-h2">No surprises, ever</h2><p class="s-lead">Every fee is published. Here are the ones people ask about most.</p></div>
  <div class="s-grid g3">
          <div class="s-plan reveal"><h3>Everyday</h3><div class="pr">$0 <small>per month</small></div>
        <ul><li><i class="bi bi-check-circle-fill"></i>Free domestic transfers</li><li><i class="bi bi-check-circle-fill"></i>Free virtual card</li><li><i class="bi bi-check-circle-fill"></i>Bills with no fee</li><li><i class="bi bi-check-circle-fill"></i>Savings pots</li></ul><a href="pricing" class="s-btn s-btn-line">See full pricing</a></div>
          <div class="s-plan pop reveal"><span class="tag">Best value</span><h3>Plus</h3><div class="pr">$4.99 <small>per month</small></div>
        <ul><li><i class="bi bi-check-circle-fill"></i>Everything in Everyday</li><li><i class="bi bi-check-circle-fill"></i>Lower wire fees</li><li><i class="bi bi-check-circle-fill"></i>Priority chat</li><li><i class="bi bi-check-circle-fill"></i>Higher limits</li></ul><a href="pricing" class="s-btn s-btn-solid">See full pricing</a></div>
          <div class="s-plan reveal"><h3>Business</h3><div class="pr">$19 <small>per month</small></div>
        <ul><li><i class="bi bi-check-circle-fill"></i>Team members</li><li><i class="bi bi-check-circle-fill"></i>Bulk payments</li><li><i class="bi bi-check-circle-fill"></i>Dedicated manager</li><li><i class="bi bi-check-circle-fill"></i>Tax receipts</li></ul><a href="pricing" class="s-btn s-btn-line">See full pricing</a></div>
      </div>
</div></section>

<!-- 20 · INSTALL APP -->
<section class="s-sec alt" id="install"><div class="s-wrap"><div class="s-instbox">
  <div><span class="s-kicker" style="background:rgba(255,255,255,.16);color:#fff">Install app</span><h2 class="s-h2">Add {{ $settings->site_name }} to your home screen</h2><p class="s-lead" style="color:rgba(255,255,255,.8)">Works on Android, iPhone, Windows and Mac. Opens full-screen, loads fast and keeps working on slow connections.</p>
    <div class="s-cta-row"><button type="button" class="s-btn s-btn-white s-btn-lg" data-install><i class="bi bi-download"></i> Install now</button><a href="/apps" class="s-btn s-btn-outline-w s-btn-lg">How it works</a></div>
    <div class="s-howinst"><div><i class="bi bi-android2"></i> Android / Chrome: tap <b>Install</b> or menu ? Install app</div><div><i class="bi bi-apple"></i> iPhone / Safari: Share ? <b>Add to Home Screen</b></div></div></div>
  <div style="display:grid;gap:18px;justify-items:center"><div class="s-qr" aria-label="Decorative QR code"><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i><i class=""></i><i class=""></i><i class="o"></i><i class="o"></i><i class=""></i></div><small style="opacity:.8">Scan on your phone</small><div class="s-cta-row" style="margin:0"><span class="s-store"><i class="bi bi-apple"></i><span>Coming soon<b>App Store</b></span></span><span class="s-store"><i class="bi bi-google-play"></i><span>Coming soon<b>Google Play</b></span></span></div></div>
</div></div></section>

<!-- 21 · BLOG -->
<section class="s-sec"><div class="s-wrap">
  <div class="s-head reveal"><span class="s-kicker">From the blog</span><h2 class="s-h2">Money tips and product news</h2></div>
  <div class="s-grid g3">
          <a class="s-card s-post reveal" href="post?p=save-more-with-pots"><div class="th t3"><i class="bi bi-piggy-bank"></i></div><div class="bd"><small>Oct 22, 2026 · Saving</small><h3>5 ways to save more with savings pots</h3><p>Split your money by goal and let round-ups do the heavy lifting.</p></div></a>
          <a class="s-card s-post reveal" href="post?p=gold-trading-basics"><div class="th t4"><i class="bi bi-gem"></i></div><div class="bd"><small>Oct 15, 2026 · Investing</small><h3>Gold trading basics for beginners</h3><p>Why people hold gold and how the gold market works in the app.</p></div></a>
          <a class="s-card s-post reveal" href="post?p=pin-security-tips"><div class="th t6"><i class="bi bi-shield-lock"></i></div><div class="bd"><small>Oct 08, 2026 · Security</small><h3>Keep your PIN safe: a short guide</h3><p>Simple habits that keep your payments protected.</p></div></a>
      </div>
  <div class="s-cta-row" style="justify-content:center"><a href="blog" class="s-btn s-btn-line">Read the blog</a></div>
</div></section>

<!-- 22 · FAQ -->
<section class="s-sec alt"><div class="s-wrap s-split s-grid" style="align-items:start">
  <div><span class="s-kicker">FAQ</span><h2 class="s-h2">Questions, answered</h2><p class="s-lead">Can't find what you need? Our assistant and support team are a tap away.</p><div class="s-cta-row"><a href="/contact" class="s-btn s-btn-solid">Visit help centre</a><a href="/contact" class="s-btn s-btn-line">Contact us</a></div></div>
  <div><div class="accordion s-faq" id="homefaq"><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#homefaq0">How do deposits work?</button></h3><div id="homefaq0" class="accordion-collapse collapse show" data-bs-parent="#homefaq"><div class="accordion-body">Add money by crypto, check or gift card. Your account is credited after the deposit is reviewed.</div></div></div><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#homefaq1">How do I open an account?</button></h3><div id="homefaq1" class="accordion-collapse collapse" data-bs-parent="#homefaq"><div class="accordion-body">Choose “Open account”, complete the short wizard (details, PIN, review) and you land on your dashboard immediately.</div></div></div><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#homefaq2">Do I need a PIN to send money?</button></h3><div id="homefaq2" class="accordion-collapse collapse" data-bs-parent="#homefaq"><div class="accordion-body">Yes. Every money action — transfers, wires, bills, trades and investments — asks for your 6-digit PIN and rolls for a couple of seconds before it is confirmed.</div></div></div><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#homefaq3">What are the fees?</button></h3><div id="homefaq3" class="accordion-collapse collapse" data-bs-parent="#homefaq"><div class="accordion-body">Domestic transfers are free, domestic wires cost $15 and international wires $30. See the pricing page for every fee.</div></div></div><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#homefaq4">Can I trade gold and crypto?</button></h3><div id="homefaq4" class="accordion-collapse collapse" data-bs-parent="#homefaq"><div class="accordion-body">Yes. The Markets area has crypto, stocks, gold and forex pairs with charts.</div></div></div><div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#homefaq5">Can I install it as an app?</button></h3><div id="homefaq5" class="accordion-collapse collapse" data-bs-parent="#homefaq"><div class="accordion-body">Yes. Use the Install button in the menu (or “Add to Home Screen” on iPhone) and it opens full-screen like a native app.</div></div></div></div></div>
</div></section>
</main>
<section class="s-sec s-cta-band"><div class="s-wrap s-cta-in">
  <div><h2>Ready to bank the modern way?</h2><p>Open an account in minutes.</p></div>
  <div class="s-cta-row"><a href="/register" class="s-btn s-btn-white">Open account</a><a href="/apps" class="s-btn s-btn-outline-w"><i class="bi bi-phone"></i> Get the app</a></div>
</div></section>
@endsection
