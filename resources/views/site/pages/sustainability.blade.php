@extends('site.layouts.app')
@section('title', 'Sustainability')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/sustainability.css') }}">
@endpush

@section('content')
<section class="wrap sustain-hero">
    <img class="sustain-hero-bg" src="{{ asset('images/site/Sustanibility/SustanibilityHeroBanner.jpg') }}" alt="">
    <div class="sustain-hero-content">
        <div class="eyebrow">Sustainable Fashion. Responsible Future.</div>
        <h1>Our Commitment to People, Planet &amp; Progress</h1>
        <p class="lead">At Sewgo, sustainability is at the heart of everything we do. Our Just In Time manufacturing model reduces waste, saves resources and helps build a greener fashion industry.</p>
        <div class="sustain-mini-card">
            <div class="mini-stat"><img src="{{ asset('images/site/Sustanibility/HeadFeatures/LessWaste.png') }}" alt=""><div><strong>Less Waste</strong>Zero Overproduction</div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/Sustanibility/HeadFeatures/WaterSaved.png') }}" alt=""><div><strong>Water Saved</strong>10M+ Liters</div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/Sustanibility/HeadFeatures/LowerCarbon.png') }}" alt=""><div><strong>Lower Carbon</strong>Smarter Supply Chain</div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/Sustanibility/HeadFeatures/PeopleFirst.png') }}" alt=""><div><strong>People First</strong>Ethical &amp; Responsible</div></div>
        </div>
    </div>
</section>

<div class="wrap section" style="padding-top:10px;">
    <div class="impact-panel">
        <div class="impact-panel-head">
            <h2>Our Environmental Impact Scorecard</h2>
            <span>Financial Year 2024–25</span>
        </div>
        <div class="impact-scorecard-grid">
            <div class="impact-stats-col">
                <div class="impact-stat"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/CarbonNegative.png') }}" alt=""></div><div><div class="num">-398,154</div><div class="lbl">kg CO₂-eq<br>Net Emissions (Carbon Negative)</div></div></div>
                <div class="impact-stat"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/WaterSaved.png') }}" alt=""></div><div><div class="num">10.2M+</div><div class="lbl">Liters<br>Water Saved</div></div></div>
                <div class="impact-stat"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/ZeroInventoryWaste.png') }}" alt=""></div><div><div class="num">Zero</div><div class="lbl">Inventory Waste<br>With JIT Model</div></div></div>
                <div class="impact-stat"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/GloballyImpacted.png') }}" alt=""></div><div><div class="num">40+</div><div class="lbl">Countries<br>Globally Impacted</div></div></div>
            </div>
            <div class="impact-table-col">
                <p class="impact-table-intro">Our Just In Time (JIT) model helps avoid more emissions than we produce.</p>
                <div class="emission-row good"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/EmissionsAvoided.png') }}" alt=""></div><div class="label">Emissions Avoided</div><div class="val">-572,957<small>kg CO₂-eq</small></div><div class="desc">Avoided through reduced overproduction, digital printing, zero inventory waste, lower water use and efficient resource utilization.</div></div>
                <div class="emission-row bad"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/EmissionsScope12.png') }}" alt=""></div><div class="label">Emissions Added<br>(Scope 1 &amp; 2)</div><div class="val">43,314<small>kg CO₂-eq</small></div><div class="desc">Emissions from our operations including fuel combustion and purchased electricity used in manufacturing and printing.</div></div>
                <div class="emission-row bad"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/EmissionsScope3.png') }}" alt=""></div><div class="label">Emissions Added<br>(Scope 3)</div><div class="val">131,489<small>kg CO₂-eq</small></div><div class="desc">Emissions from purchased goods, materials, packaging, logistics, upstream and downstream partners across our value chain.</div></div>
                <div class="emission-row good"><div class="icon"><img src="{{ asset('images/site/Sustanibility/OurEnvirenmentImpactScored/NetEmissionsCheck.png') }}" alt=""></div><div class="label">Net Emissions</div><div class="val">-398,154<small>kg CO₂-eq</small></div><div class="desc">Emissions avoided exceed total emissions added, resulting in a net carbon-negative outcome for FY 2024–25.</div></div>
                <p class="impact-footnote"><i class="fas fa-circle-info"></i> All figures are estimated based on data reported by IBA Crafts Private Ltd. Methodology aligned with GHG Protocol standards.</p>
            </div>
            <img class="impact-side-img" src="{{ asset('images/site/Sustanibility/ImpactScorecardSide.jpg') }}" alt="">
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="eyebrow" style="text-align:center;">How We Create Impact</div>
    <div class="section-head" style="margin-top:0;"><h2>The Sewgo Difference</h2></div>
    <div class="icon-grid cols-5 diff-grid">
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/Sustanibility/TheSwegoDifference/DiffJustInTime.png') }}" alt=""></div><h4>Just In Time<br>Manufacturing</h4><p>We produce only after you order — no overproduction, no dead stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/Sustanibility/TheSwegoDifference/DiffDigitalPrinting.png') }}" alt=""></div><h4>Digital Printing<br>Technology</h4><p>Uses less water and energy compared to conventional dyeing &amp; screen printing.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/Sustanibility/TheSwegoDifference/DiffWaterEnergy.png') }}" alt=""></div><h4>Water &amp; Energy<br>Conservation</h4><p>Significantly lower water usage and energy consumption.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/Sustanibility/TheSwegoDifference/DiffSustainableMaterials.png') }}" alt=""></div><h4>Sustainable<br>Materials</h4><p>Responsible material sourcing and eco-friendly packaging.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/Sustanibility/TheSwegoDifference/DiffEthicalPartnerships.png') }}" alt=""></div><h4>Ethical &amp; Fair<br>Partnerships</h4><p>Empowering our network partners and promoting fair working conditions.</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="methodology-panels">
        <div class="method-left-card">
            <h3>Our Methodology</h3>
            <p>We follow a science-based approach to estimate emissions avoided through our JIT model.</p>
            <ul class="method-checklist">
                <li><i class="fas fa-check-circle"></i>Activity data from actual operations</li>
                <li><i class="fas fa-check-circle"></i>Assumptions benchmarked with Indian garment manufacturing</li>
                <li><i class="fas fa-check-circle"></i>Comparative analysis with conventional manufacturing practices</li>
                <li><i class="fas fa-check-circle"></i>Aligned with GHG Protocol (Scopes 1, 2, 3 &amp; 4)</li>
            </ul>
        </div>
        <div class="method-right-card">
            <div class="method-flow">
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/Sustanibility/OurMethodology/TraditionalMassProduction.png') }}" alt=""></div><h4>Traditional Mass<br>Production</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/Sustanibility/OurMethodology/OverproductionAndInventoryWaste.png') }}" alt=""></div><h4>Overproduction &amp;<br>Inventory Waste</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/Sustanibility/OurMethodology/HigherResourcesAndEmissions.png') }}" alt=""></div><h4>Higher Resource<br>Use &amp; Emissions</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/Sustanibility/OurMethodology/SewgoJITModel.png') }}" alt=""></div><h4>Sewgo JIT Model<br>(Order-Based)</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/Sustanibility/OurMethodology/ZeroInventoryWaste.png') }}" alt=""></div><h4>Zero Inventory<br>Waste</h4></div>
                <div class="method-arrow"><i class="fas fa-chevron-right"></i></div>
                <div class="method-step"><div class="method-step-icon"><img src="{{ asset('images/site/Sustanibility/OurMethodology/LowerEmissionAndConservation.png') }}" alt=""></div><h4>Lower Emissions &amp;<br>Conservation</h4></div>
            </div>
            <div class="method-quote">
                <img src="{{ asset('images/site/Sustanibility/OurMethodology/QuoteLeaf.png') }}" alt="">
                <p>Every order made with Sewgo is a step towards a <strong>cleaner, smarter and more sustainable future.</strong></p>
            </div>
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="commit-head"><span>Our Commitments</span></div>
    <div class="commit-row">
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/Sustanibility/OurComittment/CarbonNegativeGrowth.png') }}" alt=""></div><div class="commit-txt">Carbon Negative<br>Growth</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/Sustanibility/OurComittment/ZeroInventoryWaste.png') }}" alt=""></div><div class="commit-txt">Zero Inventory<br>Waste</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/Sustanibility/OurComittment/InnovateForSustainability.png') }}" alt=""></div><div class="commit-txt">Innovate for<br>Sustainability</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/Sustanibility/OurComittment/TransparencyInImpact.png') }}" alt=""></div><div class="commit-txt">Transparency in<br>Impact</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/Sustanibility/OurComittment/EmpowerPeopleCommunities.png') }}" alt=""></div><div class="commit-txt">Empower People<br>&amp; Communities</div></div>
        <div class="commit-item"><div class="commit-icon"><img src="{{ asset('images/site/Sustanibility/OurComittment/PartnerForABetterTomorrow.png') }}" alt=""></div><div class="commit-txt">Partner for a<br>Better Tomorrow</div></div>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final sustain-cta-final">
        <img class="sustain-cta-leaf" src="{{ asset('images/site/Sustanibility/SustainCtaLeaf.png') }}" alt="">
        <div class="cta-band-final-text">
            <h3>Let's build a sustainable future together.</h3>
            <p>Choose JIT. Choose Responsibility. Choose Sewgo.</p>
        </div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white"><i class="far fa-calendar-check"></i>Request a Quote</a>
            <a href="{{ url('/contact') }}" class="btn-ghost"><i class="far fa-user"></i>Book a Discovery Call</a>
        </div>
    </div>
</div>
@endsection
