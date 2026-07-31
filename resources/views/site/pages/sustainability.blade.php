@extends('site.layouts.app')
@section('title', 'Sustainability')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/sustainability.css') }}">
@endpush

@section('content')
<div class="wrap">
    <div class="hero-split">
        <div>
            <div class="eyebrow">Sustainable Fashion. Responsible Future.</div>
            <h1>Our Commitment to People, Planet &amp; Progress</h1>
            <p class="lead">At Sewgo, sustainability is at the heart of everything we do. Our Just In Time manufacturing model reduces waste, saves resources and helps build a greener fashion industry.</p>
            <div class="mini-stats">
                <div class="mini-stat"><i class="fas fa-recycle"></i><div><strong>Less Waste</strong>Zero Overproduction</div></div>
                <div class="mini-stat"><i class="fas fa-tint"></i><div><strong>Water Saved</strong>10M+ Liters</div></div>
                <div class="mini-stat"><i class="fas fa-cloud"></i><div><strong>Lower Carbon</strong>Smarter Supply Chain</div></div>
                <div class="mini-stat"><i class="fas fa-users"></i><div><strong>People First</strong>Ethical &amp; Responsible</div></div>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&q=70" alt="">
    </div>
</div>

<div class="wrap section" style="padding-top:10px;">
    <div style="border:1px solid var(--border); border-radius:18px; padding:32px;">
        <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:10px; margin-bottom:24px;">
            <h2 style="font-size:1.4rem;">Our Environmental Impact Scorecard</h2>
            <span style="color:var(--muted); font-size:.85rem;">Financial Year 2024–25</span>
        </div>
        <div class="impact-scorecard-grid" style="display:grid;">
            <div class="impact-grid" style="grid-template-columns:1fr;">
                <div class="impact-card"><div class="icon"><i class="fas fa-smog"></i></div><div><div class="num">-398,154</div><div class="lbl">kg CO₂-eq · Net Emissions (Carbon Negative)</div></div></div>
                <div class="impact-card"><div class="icon"><i class="fas fa-tint"></i></div><div><div class="num">10.2M+</div><div class="lbl">Liters Water Saved</div></div></div>
                <div class="impact-card"><div class="icon"><i class="fas fa-leaf"></i></div><div><div class="num">Zero</div><div class="lbl">Inventory Waste With JIT Model</div></div></div>
                <div class="impact-card"><div class="icon"><i class="fas fa-globe"></i></div><div><div class="num">40+</div><div class="lbl">Countries Globally Impacted</div></div></div>
            </div>
            <div>
                <p style="color:var(--muted); font-size:.85rem; margin-bottom:14px;">Our Just In Time (JIT) model helps avoid more emissions than we produce.</p>
                <div class="emission-row good"><div class="icon"><i class="fas fa-arrow-trend-down" style="color:var(--teal-dark);"></i></div><div class="label">Emissions Avoided</div><div class="val">-572,957</div><div class="desc">Avoided through reduced overproduction, digital printing, zero inventory waste.</div></div>
                <div class="emission-row bad"><div class="icon"><i class="fas fa-industry" style="color:#c0483a;"></i></div><div class="label">Emissions Added (Scope 1&amp;2)</div><div class="val">43,314</div><div class="desc">From fuel combustion and purchased electricity in manufacturing.</div></div>
                <div class="emission-row bad"><div class="icon"><i class="fas fa-truck" style="color:#c0483a;"></i></div><div class="label">Emissions Added (Scope 3)</div><div class="val">131,489</div><div class="desc">From purchased goods, packaging, logistics and value chain partners.</div></div>
                <div class="emission-row good"><div class="icon"><i class="fas fa-check-double" style="color:var(--teal-dark);"></i></div><div class="label">Net Emissions</div><div class="val">-398,154</div><div class="desc">Emissions avoided exceed total emissions added — net carbon-negative for FY 2024–25.</div></div>
            </div>
            <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=500&q=70" style="border-radius:14px;" alt="">
        </div>
        <p style="font-size:.75rem; color:var(--muted); margin-top:16px;"><i class="fas fa-circle-info"></i> All figures are estimated based on data reported by IBA Crafts Private Ltd. Methodology aligned with GHG Protocol standards.</p>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="eyebrow" style="text-align:center;">How We Create Impact</div>
    <div class="section-head" style="margin-top:0;"><h2>The Sewgo Difference</h2></div>
    <div class="icon-grid">
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-tshirt"></i></div><h4>Just In Time Manufacturing</h4><p>We produce only after you order — no overproduction, no dead stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-print"></i></div><h4>Digital Printing Technology</h4><p>Uses less water and energy compared to conventional dyeing &amp; screen printing.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-tint"></i></div><h4>Water &amp; Energy Conservation</h4><p>Significantly lower water usage and energy consumption.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-recycle"></i></div><h4>Sustainable Materials</h4><p>Responsible material sourcing and eco-friendly packaging.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-hand-holding-heart"></i></div><h4>Ethical &amp; Fair Partnerships</h4><p>Empowering our network partners and promoting fair working conditions.</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="methodology-grid" style="background:var(--bg-soft); border-radius:18px; padding:32px; display:grid;">
        <div>
            <h3 style="font-size:1.15rem; margin-bottom:14px;">Our Methodology</h3>
            <p style="color:var(--muted); font-size:.85rem; margin-bottom:14px;">We follow a science-based approach to estimate emissions avoided through our JIT model.</p>
            <ul style="list-style:none; padding:0; margin:0; font-size:.85rem;">
                <li style="margin-bottom:8px;"><i class="fas fa-check" style="color:var(--teal-dark);"></i> Activity data from actual operations</li>
                <li style="margin-bottom:8px;"><i class="fas fa-check" style="color:var(--teal-dark);"></i> Assumptions benchmarked with Indian garment manufacturing</li>
                <li style="margin-bottom:8px;"><i class="fas fa-check" style="color:var(--teal-dark);"></i> Comparative analysis with conventional manufacturing practices</li>
                <li><i class="fas fa-check" style="color:var(--teal-dark);"></i> Aligned with GHG Protocol (Scopes 1, 2, 3 &amp; 4)</li>
            </ul>
        </div>
        <div class="step-flow methodology-steps">
            <div class="step"><div class="icon-circle" style="margin-bottom:8px;"><i class="fas fa-industry"></i></div><h4>Traditional Mass Production</h4></div>
            <div class="step"><div class="icon-circle" style="margin-bottom:8px;"><i class="fas fa-box"></i></div><h4>Overproduction &amp; Inventory Waste</h4></div>
            <div class="step"><div class="icon-circle" style="margin-bottom:8px;"><i class="fas fa-smog"></i></div><h4>Higher Resource Use &amp; Emissions</h4></div>
            <div class="step step-highlight"><h4>Sewgo JIT Model (Order-Based)</h4></div>
            <div class="step"><div class="icon-circle" style="margin-bottom:8px;"><i class="fas fa-leaf"></i></div><h4>Zero Inventory Waste</h4></div>
            <div class="step"><div class="icon-circle" style="margin-bottom:8px;"><i class="fas fa-globe"></i></div><h4>Lower Emissions &amp; Conservation</h4></div>
        </div>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final" style="background:var(--navy); margin:0;">
        <div><h3>Let's Build a Sustainable Future Together.</h3><p>Choose JIT. Choose Responsibility. Choose Sewgo.</p></div>
        <div class="actions">
            <a href="{{ url('/site/contact') }}" class="btn-white">Request a Quote</a>
            <a href="{{ url('/site/contact') }}" class="btn-ghost">Book a Discovery Call</a>
        </div>
    </div>
</div>
@endsection
