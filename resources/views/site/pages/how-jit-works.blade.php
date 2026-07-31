@extends('site.layouts.app')
@section('title', 'How JIT Works')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/how-jit-works.css') }}">
@endpush

@section('content')
<div class="wrap">
    <div class="hero-split">
        <div>
            <div class="eyebrow">Smarter Manufacturing. Made After You Sell.</div>
            <h1>How Just In Time Manufacturing Works</h1>
            <p class="lead">At Sewgo, garments are produced only after an order is received. Our JIT model eliminates inventory risk, reduces waste, and ensures faster fulfillment with unmatched flexibility for modern brands.</p>
            <div style="display:flex; gap:12px; margin-top:22px;">
                <a href="{{ url('/site/contact') }}" class="btn btn-teal"><i class="far fa-calendar"></i> Book a Discovery Call</a>
                <a href="{{ url('/site/contact') }}" class="btn" style="border:1.5px solid var(--border); color:var(--navy);">Request Sample Kit</a>
            </div>
        </div>
        <div class="jit-panel">
            <div class="row-title"><span>JIT PRODUCTION CONTROL</span><span>● Real-time Sync</span></div>
            <div style="font-size:.75rem; color:#9fb0c1;">ORDER TRIGGER — New Order Received #SGO-78456</div>
            <div class="jit-stages">
                <div class="st"><div class="dot"></div>Cutting</div>
                <div class="st"><div class="dot"></div>Stitching</div>
                <div class="st"><div class="dot"></div>Finishing</div>
                <div class="st"><div class="dot"></div>QA Check</div>
                <div class="st"><div class="dot"></div>Packing</div>
            </div>
            <div class="jit-metrics">
                <div class="m"><div class="v">32</div><div class="l">Orders Today</div></div>
                <div class="m"><div class="v">18</div><div class="l">In Production</div></div>
                <div class="m"><div class="v">27</div><div class="l">Dispatched</div></div>
                <div class="m"><div class="v">98%</div><div class="l">On Time Rate</div></div>
            </div>
        </div>
    </div>
</div>

<div class="stat-band">
    <div class="wrap" style="grid-template-columns: repeat(5,1fr);">
        <div class="stat"><i class="far fa-clock"></i><div><div class="num">24–48H</div><div class="lbl">Production &amp; Dispatch</div></div></div>
        <div class="stat"><i class="fas fa-tshirt"></i><div><div class="num">MOQ 1</div><div class="lbl">Start From 1 Piece</div></div></div>
        <div class="stat"><i class="fas fa-layer-group"></i><div><div class="num">Multiple</div><div class="lbl">Sizes &amp; Prints</div></div></div>
        <div class="stat"><i class="fas fa-globe"></i><div><div class="num">Global</div><div class="lbl">Shipping</div></div></div>
        <div class="stat"><i class="fas fa-users"></i><div><div class="num">1000+</div><div class="lbl">Brands Served</div></div></div>
    </div>
</div>

<div class="wrap section">
    <div class="section-head"><h2>The JIT Flow</h2><p>Production starts only after order confirmation. Simple, transparent, and built for speed.</p></div>
    <div class="step-flow">
        <div class="step"><div class="num-badge">01</div><h4>Customer Order Received</h4><p>Order placed via website, brand portal or marketplace.</p></div>
        <div class="step"><div class="num-badge">02</div><h4>Style &amp; Specifications Matched</h4><p>Style, size, color, print &amp; quantity confirmed.</p></div>
        <div class="step"><div class="num-badge">03</div><h4>Fabric / Print / Trim Allocation</h4><p>Materials allocated from approved suppliers.</p></div>
        <div class="step"><div class="num-badge">04</div><h4>Cutting &amp; Production Begins</h4><p>Cutting scheduled as per confirmed order.</p></div>
        <div class="step"><div class="num-badge">05</div><h4>Stitching / Finishing / Branding</h4><p>Sewing, finishing, labeling &amp; branding completed.</p></div>
        <div class="step"><div class="num-badge">06</div><h4>Quality Check</h4><p>Multi-level QC for size, print accuracy, stitching &amp; construction.</p></div>
        <div class="step"><div class="num-badge">07</div><h4>Packed &amp; Shipped</h4><p>Secure packing and dispatch within 24–48 hours.*</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>How Orders Trigger Production</h2><p>Orders from your brand website, app, marketplace, or ERP system automatically trigger production planning at Sewgo.</p></div>
    <div class="flow-diagram">
        <div class="flow-box"><i class="fas fa-globe" style="color:var(--teal-dark);"></i><br>Brand Website</div>
        <div class="flow-box"><i class="fas fa-mobile-alt" style="color:var(--teal-dark);"></i><br>Mobile App</div>
        <div class="flow-box"><i class="fas fa-store" style="color:var(--teal-dark);"></i><br>Marketplace</div>
        <div class="flow-box"><i class="fas fa-code" style="color:var(--teal-dark);"></i><br>API / ERP</div>
        <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
        <div class="flow-box" style="background:var(--navy); color:#fff;">Sewgo Order Engine<br><span style="color:#6fe0c0; font-size:.75rem;">● Status: Confirmed</span></div>
        <div class="flow-arrow"><i class="fas fa-arrow-right"></i></div>
        <div class="flow-box">Production Plan Auto-Generated<br><span style="font-size:.75rem; color:var(--muted);">Material · Cutting · Line · Delivery</span></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>What Makes Sewgo Different</h2><p>Our JIT model is designed to help brands grow smarter.</p></div>
    <div class="icon-grid cols-3">
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-ban"></i></div><h4>No Dead Stock</h4><p>Produce only after you sell. Zero unsold inventory.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-box"></i></div><h4>No Bulk Inventory</h4><p>No large upfront investment in stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-bolt"></i></div><h4>Faster Replenishment</h4><p>Replenish bestsellers quickly with 24–48H dispatch.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-tshirt"></i></div><h4>Flexible Styles / Sizes / Prints</h4><p>Launch more SKU variations with ease.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-dollar-sign"></i></div><h4>Better Cash Flow</h4><p>Pay for what you sell. Improve working capital.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-tags"></i></div><h4>Private Label &amp; Packaging</h4><p>Custom tags, labels &amp; packaging to build your brand.</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head" style="text-align:left; max-width:none;"><h2>Frequently Asked Questions</h2></div>
    <div>
        <details class="faq-item" open><summary>When does production begin? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.88rem; margin-top:10px;">Production begins immediately after an order is confirmed — there's no pre-production inventory.</p></details>
        <details class="faq-item"><summary>What is the minimum order quantity? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.88rem; margin-top:10px;">Our MOQ starts at just 1 piece, so you can test styles before scaling.</p></details>
        <details class="faq-item"><summary>Can I offer multiple sizes and prints? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.88rem; margin-top:10px;">Yes — Sewgo supports multi-SKU flexibility across sizes, colours and prints in one order.</p></details>
        <details class="faq-item"><summary>How fast can orders be dispatched? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.88rem; margin-top:10px;">Most orders are produced and dispatched within 24–48 hours.</p></details>
        <details class="faq-item"><summary>Do you offer white label / custom branding? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.88rem; margin-top:10px;">Yes, including custom labels, hangtags and packaging for private label brands.</p></details>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final" style="background:var(--navy); margin:0;">
        <div><h3>Ready to Launch with JIT?</h3><p>Grow your brand without inventory risk. Let Sewgo handle production, so you can focus on sales.</p></div>
        <div class="actions">
            <a href="{{ url('/site/contact') }}" class="btn-white">Request a Quote</a>
            <a href="{{ url('/site/contact') }}" class="btn-ghost">Book a Discovery Call</a>
        </div>
    </div>
</div>
@endsection
