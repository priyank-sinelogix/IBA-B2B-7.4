@extends('site.layouts.app')
@section('title', 'Sustainability')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/sustainability.css') }}">
@endpush

@section('content')
<section class="sustain-hero">
    <img class="sustain-hero-bg" src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1600&q=70" alt="">
    <div class="sustain-hero-content">
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
</section>

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
        <p style="font-size:.75rem; color:var(--muted); margin-top:16px;"><i class="fas fa-circle-info"></i> All figures are estimated based on data reported by IBA Crafts Private Ltd. Methodology aligned with GHG Protocol standards.</p>

            </div>
            <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=500&q=70" style="border-radius:14px;" alt="">
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="eyebrow" style="text-align:center;">How We Create Impact</div>
    <div class="section-head" style="margin-top:0;"><h2>The Sewgo Difference</h2></div>
    <div class="icon-grid cols-5 diff-grid">
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/DiffJustInTime.png') }}" alt=""></div><h4>Just In Time<br>Manufacturing</h4><p>We produce only after you order — no overproduction, no dead stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/DiffDigitalPrinting.png') }}" alt=""></div><h4>Digital Printing<br>Technology</h4><p>Uses less water and energy compared to conventional dyeing &amp; screen printing.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/DiffWaterEnergy.png') }}" alt=""></div><h4>Water &amp; Energy<br>Conservation</h4><p>Significantly lower water usage and energy consumption.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/DiffSustainableMaterials.png') }}" alt=""></div><h4>Sustainable<br>Materials</h4><p>Responsible material sourcing and eco-friendly packaging.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/DiffEthicalPartnerships.png') }}" alt=""></div><h4>Ethical &amp; Fair<br>Partnerships</h4><p>Empowering our network partners and promoting fair working conditions.</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="methodology-panels">
        <div class="method-left-card">
            <h3>Our Methodology</h3>
            <p>We follow a science-based approach to estimate emissions avoided through our JIT model.</p>
            <ul class="method-checklist">
                <li><img src="{{ asset('images/site/CheckGreen.png') }}" alt="">Activity data from actual operations</li>
                <li><img src="{{ asset('images/site/CheckGreen.png') }}" alt="">Assumptions benchmarked with Indian garment manufacturing</li>
                <li><img src="{{ asset('images/site/CheckGreen.png') }}" alt="">Comparative analysis with conventional manufacturing practices</li>
                <li><img src="{{ asset('images/site/CheckGreen.png') }}" alt="">Aligned with GHG Protocol (Scopes 1, 2, 3 &amp; 4)</li>
            </ul>
        </div>
        <div class="method-right-card">
            <div class="method-flow">
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/StepFactory.png') }}" alt=""></div><h4>Traditional Mass<br>Production</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/StepOverproduction.png') }}" alt=""></div><h4>Overproduction &amp;<br>Inventory Waste</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/StepEmissions.png') }}" alt=""></div><h4>Higher Resource<br>Use &amp; Emissions</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step method-step-highlight"><div class="method-step-icon"><img src="{{ asset('images/site/StepSewgoJIT.png') }}" alt=""></div><h4>Sewgo JIT Model<br>(Order-Based)</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/StepZeroWaste.png') }}" alt=""></div><h4>Zero Inventory<br>Waste</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/StepLowerEmissions.png') }}" alt=""></div><h4>Lower Emissions &amp;<br>Conservation</h4></div>
            </div>
            <div class="method-quote">
                <img src="{{ asset('images/site/QuoteLeaf.png') }}" alt="">
                <p>Every order made with Sewgo is a step towards a <strong>cleaner, smarter and more sustainable future.</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="commit-head"><span>Our Commitments</span></div>
    <div class="commit-row">
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/CommitCarbonNegative.png') }}" alt=""></div><div class="commit-txt">Carbon Negative<br>Growth</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/CommitZeroWaste.png') }}" alt=""></div><div class="commit-txt">Zero Inventory<br>Waste</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/CommitInnovate.png') }}" alt=""></div><div class="commit-txt">Innovate for<br>Sustainability</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/CommitTransparency.png') }}" alt=""></div><div class="commit-txt">Transparency in<br>Impact</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/CommitEmpowerPeople.png') }}" alt=""></div><div class="commit-txt">Empower People<br>&amp; Communities</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/CommitPartner.png') }}" alt=""></div><div class="commit-txt">Partner for a<br>Better Tomorrow</div></div>
    </div>
</div>

<div class="" style="padding-bottom:60px;">
    <div class="cta-band-final sustain-cta-final">
        <img class="sustain-cta-leaf" src="{{ asset('images/site/SustainCtaLeaf.png') }}" alt="">
        <div class="cta-band-final-text">
            <h3>Let's build a sustainable future together.</h3>
            <p>Choose JIT. Choose Responsibility. Choose Sewgo.</p>
        </div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white"><img src="{{ asset('images/site/IconQuotePlant.png') }}" alt="">Request a Quote</a>
            <a href="{{ url('/contact') }}" class="btn-ghost"><img src="{{ asset('images/site/IconCalendar.png') }}" alt="">Book a Discovery Call</a>
        </div>
    </div>
</div>
@endsection
