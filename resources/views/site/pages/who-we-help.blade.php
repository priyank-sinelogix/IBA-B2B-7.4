@extends('site.layouts.app')
@section('title', 'Who We Help')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/who-we-help.css') }}">
@endpush

@section('content')
<div class="wrap">
    <div class="hero-split">
        <div>
            <div class="eyebrow">Solutions by Business Type</div>
            <h1>Built for Different Fashion Businesses.</h1>
            <p class="lead">From startups to large retailers, Sewgo adapts Just In Time manufacturing to your business model.</p>
            <div class="mini-stats">
                <div class="mini-stat"><i class="far fa-clock"></i><div><strong>Manufactured</strong>in 24–48 Hours</div></div>
                <div class="mini-stat"><i class="fas fa-tshirt"></i><div><strong>MOQ 1</strong>As low as 1 piece</div></div>
                <div class="mini-stat"><i class="fas fa-globe"></i><div><strong>40+ Countries</strong>We ship worldwide</div></div>
                <div class="mini-stat"><i class="fas fa-leaf"></i><div><strong>Sustainable</strong>By Design</div></div>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=800&q=70" alt="">
    </div>
</div>

<div class="wrap section" style="padding-top:10px;">
    <div class="card-grid who-we-help-grid">
        <div class="info-card">
            <div class="icon-circle"><i class="fas fa-rocket"></i></div>
            <h3>1. D2C Fashion Startups</h3><p>Launch faster with zero inventory risk.</p>
            <ul>
                <li><i class="fas fa-check"></i> Start with MOQ 1</li>
                <li><i class="fas fa-check"></i> Test ideas, not inventory</li>
                <li><i class="fas fa-check"></i> Quick market validation</li>
                <li><i class="fas fa-check"></i> Scale only what sells</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><i class="fas fa-shopping-bag"></i></div>
            <h3>2. Established Fashion Brands</h3><p>Agile manufacturing for smarter growth.</p>
            <ul>
                <li><i class="fas fa-check"></i> Quick replenishment</li>
                <li><i class="fas fa-check"></i> Seasonless, on-demand</li>
                <li><i class="fas fa-check"></i> Multi-style production</li>
                <li><i class="fas fa-check"></i> Reduce overstock risk</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><i class="fas fa-cart-shopping"></i></div>
            <h3>3. Online Retailers &amp; Marketplaces</h3><p>Reliable fulfillment for high-velocity commerce.</p>
            <ul>
                <li><i class="fas fa-check"></i> Fast turnaround</li>
                <li><i class="fas fa-check"></i> Wide SKU flexibility</li>
                <li><i class="fas fa-check"></i> Consistent quality</li>
                <li><i class="fas fa-check"></i> On-time delivery</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><i class="fas fa-award"></i></div>
            <h3>4. Influencers &amp; Creator-Led Labels</h3><p>Bring your vision to life — faster and leaner.</p>
            <ul>
                <li><i class="fas fa-check"></i> Low MOQ, high flexibility</li>
                <li><i class="fas fa-check"></i> Custom prints &amp; styles</li>
                <li><i class="fas fa-check"></i> Build your unique brand</li>
                <li><i class="fas fa-check"></i> Scale with confidence</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><i class="fas fa-box"></i></div>
            <h3>5. Private Label / White Label Buyers</h3><p>Your brand. Our manufacturing excellence.</p>
            <ul>
                <li><i class="fas fa-check"></i> End-to-end production</li>
                <li><i class="fas fa-check"></i> Your labels, your brand</li>
                <li><i class="fas fa-check"></i> Scalable capacity</li>
                <li><i class="fas fa-check"></i> Quality you can trust</li>
            </ul>
        </div>
    </div>
</div>

<div class="stat-band">
    <div class="wrap" style="grid-template-columns: repeat(5,1fr);">
        <div class="stat"><i class="far fa-clock"></i><div><div class="num">48H</div><div class="lbl">Dispatch — Speed you can trust</div></div></div>
        <div class="stat"><i class="fas fa-user"></i><div><div class="num">1 MOQ</div><div class="lbl">Minimum Order</div></div></div>
        <div class="stat"><i class="fas fa-box"></i><div><div class="num">1000+</div><div class="lbl">Brands Served Globally</div></div></div>
        <div class="stat"><i class="fas fa-globe"></i><div><div class="num">40+</div><div class="lbl">Countries We ship</div></div></div>
        <div class="stat"><i class="fas fa-tshirt"></i><div><div class="num">10M+</div><div class="lbl">Garments Produced</div></div></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>How Sewgo Supports Each Business Type</h2></div>
    <div class="icon-grid">
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-images"></i></div><h4>Design Library Access</h4><p>Access 1000+ ready-to-produce styles or share your own designs — we make it real.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-tshirt"></i></div><h4>Small Batch to Scale</h4><p>Begin with MOQ 1, test the market, then scale production seamlessly.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-th-large"></i></div><h4>Multi-SKU Flexibility</h4><p>Produce multiple styles, sizes, colors &amp; prints in one order, without complexity.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-globe"></i></div><h4>Global Fulfillment Support</h4><p>We handle production, quality, packaging &amp; worldwide shipping — end to end.</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>Why This Model Works Across Business Types</h2></div>
    <div class="icon-grid cols-3">
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-shield-alt"></i></div><h4>Low Inventory Risk</h4><p>No bulk orders. No unsold stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-bolt"></i></div><h4>Faster Launches</h4><p>Go from design to delivered in 24–48 hrs.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-box"></i></div><h4>No Dead Stock</h4><p>We produce only what you sell.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-chart-line"></i></div><h4>Demand-Led Production</h4><p>Real-time, on-demand manufacturing.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-wallet"></i></div><h4>Better Cash Flow</h4><p>Pay for what sells, not what sits.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-palette"></i></div><h4>Flexibility in Sizes, Colors, Prints</h4><p>Unlimited combinations. One efficient system.</p></div>
    </div>
</div>

<div class="wrap" style="padding-bottom:20px;">
    <div class="quote-block">
        <p style="font-style:italic; margin:0; flex:1; min-width:260px; color:var(--ink);">"Sewgo's JIT model lets us test, launch, and scale without the risk. It's the smartest way we've grown our fashion business."</p>
        <div class="who">
            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=70" alt="">
            <div><strong>Ananya Mehta</strong><span>Founder, Urban Loom</span></div>
        </div>
        <div class="metrics">
            <div class="metric"><div class="num">3X</div><div class="lbl">Faster Launches</div></div>
            <div class="metric"><div class="num">60%</div><div class="lbl">Less Inventory Risk</div></div>
            <div class="metric"><div class="num">2M+</div><div class="lbl">Units Produced</div></div>
        </div>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final" style="margin:0;">
        <div><h3>Let's Find the Right JIT Setup for Your Business</h3><p>Tell us about your needs and we'll design the perfect manufacturing plan for you.</p></div>
        <div class="actions">
            <a href="{{ url('/site/contact') }}" class="btn-white">Book a Discovery Call</a>
            <a href="{{ url('/site/contact') }}" class="btn-ghost">Request a Quote</a>
        </div>
    </div>
</div>
@endsection
