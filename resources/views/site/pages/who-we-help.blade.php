@extends('site.layouts.app')
@section('title', 'Who We Help')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/who-we-help.css') }}">
@endpush

@section('content')
<section class="wrap whh-hero">
    <img class="whh-hero-bg" src="{{ asset('images/site/WhoWeHelp/WhoWeHelpBanner.jpg') }}" alt="">
    <div class="whh-hero-content">
        <div class="eyebrow">Solutions by Business Type</div>
        <h1>Built for Different Fashion Businesses.</h1>
        <p class="lead">From startups to large retailers, Sewgo adapts Just In Time manufacturing to your business model.</p>
        <div class="mini-stats">
            <div class="mini-stat"><img src="{{ asset('images/site/WhoWeHelp/BannerIcon/ManufacturedIn24hrs.png') }}" alt=""><div><strong>Manufactured in 24–48 Hours</strong></div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/WhoWeHelp/BannerIcon/MOQ1.png') }}" alt=""><div><strong>MOQ 1 As low as 1 piece</strong></div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/WhoWeHelp/BannerIcon/40Countries.png') }}" alt=""><div><strong>40+ Countries We ship worldwide</strong></div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/WhoWeHelp/BannerIcon/SustainableByDesign.png') }}" alt=""><div><strong>Sustainable By Design</strong></div></div>
        </div>
    </div>
</section>

<div class="wrap section" style="padding-top:10px;">
    <div class="card-grid who-we-help-grid">
        <div class="info-card">
            <div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/icon/D2cFashionStartups.png') }}" alt=""></div>
            <h3>1. D2C Fashion Startups</h3><p>Launch faster with zero inventory risk.</p>
            <ul>
                <li><i class="fas fa-check"></i> Start with MOQ 1</li>
                <li><i class="fas fa-check"></i> Test ideas, not inventory</li>
                <li><i class="fas fa-check"></i> Quick market validation</li>
                <li><i class="fas fa-check"></i> Scale only what sells</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/icon/EstablishedFashionBrands.png') }}" alt=""></div>
            <h3>2. Established Fashion Brands</h3><p>Agile manufacturing for smarter growth.</p>
            <ul>
                <li><i class="fas fa-check"></i> Quick replenishment</li>
                <li><i class="fas fa-check"></i> Seasonless, on-demand</li>
                <li><i class="fas fa-check"></i> Multi-style production</li>
                <li><i class="fas fa-check"></i> Reduce overstock risk</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/icon/OnlineRetailersMarketplaces.png') }}" alt=""></div>
            <h3>3. Online Retailers &amp; Marketplaces</h3><p>Reliable fulfillment for high-velocity commerce.</p>
            <ul>
                <li><i class="fas fa-check"></i> Fast turnaround</li>
                <li><i class="fas fa-check"></i> Wide SKU flexibility</li>
                <li><i class="fas fa-check"></i> Consistent quality</li>
                <li><i class="fas fa-check"></i> On-time delivery</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/icon/InfluencersCreatorLedLabels.png') }}" alt=""></div>
            <h3>4. Influencers &amp; Creator-Led Labels</h3><p>Bring your vision to life — faster and leaner.</p>
            <ul>
                <li><i class="fas fa-check"></i> Low MOQ, high flexibility</li>
                <li><i class="fas fa-check"></i> Custom prints &amp; styles</li>
                <li><i class="fas fa-check"></i> Build your unique brand</li>
                <li><i class="fas fa-check"></i> Scale with confidence</li>
            </ul>
        </div>
        <div class="info-card">
            <div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/icon/PrivateLabelWhiteLabelBuyers.png') }}" alt=""></div>
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

@include('site.partials.stat-band-standard')

<div class="wrap section" style="">
    <div class="section-head"><h2>How Sewgo Supports Each Business Type</h2></div>
    <div class="icon-grid supports-grid">
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/SupportBusinessType/DesignLibraryAccess.png') }}" alt=""></div><h4>Design Library Access</h4><p>Access 1000+ ready-to-produce styles or share your own designs — we make it real.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/SupportBusinessType/SmallBatchToScale.png') }}" alt=""></div><h4>Small Batch to Scale</h4><p>Begin with MOQ 1, test the market, then scale production seamlessly.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/SupportBusinessType/MultiSkuFlexibility.png') }}" alt=""></div><h4>Multi-SKU Flexibility</h4><p>Produce multiple styles, sizes, colors &amp; prints in one order, without complexity.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/SupportBusinessType/GlobalFulfillmentSupport.png') }}" alt=""></div><h4>Global Fulfillment Support</h4><p>We handle production, quality, packaging &amp; worldwide shipping — end to end.</p></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>Why This Model Works Across Business Types</h2></div>
    <div class="icon-grid cols-6 why-model-grid">
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/ModelBusinessTypes/LowInventoryRisk.png') }}" alt=""></div><h4>Low Inventory Risk</h4><p>No bulk orders. No unsold stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/ModelBusinessTypes/FasterLaunches.png') }}" alt=""></div><h4>Faster Launches</h4><p>Go from design to delivered in 24–48 hrs.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/ModelBusinessTypes/NoDeadStock.png') }}" alt=""></div><h4>No Dead Stock</h4><p>We produce only what you sell.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/ModelBusinessTypes/DemandLedProduction.png') }}" alt=""></div><h4>Demand-Led Production</h4><p>Real-time, on-demand manufacturing.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/ModelBusinessTypes/BetterCashFlow.png') }}" alt=""></div><h4>Better Cash Flow</h4><p>Pay for what sells, not what sits.</p></div>
        <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/WhoWeHelp/ModelBusinessTypes/FlexibilityInSizesColorsPrints.png') }}" alt=""></div><h4>Flexibility in Sizes, Colors, Prints</h4><p>Unlimited combinations. One efficient system.</p></div>
    </div>
</div>

<div class="wrap" style="padding-bottom:20px;">
    <div class="quote-block">
        <p style="font-style:italic; margin:0; flex:1; min-width:260px; color:var(--ink);">"Sewgo's JIT model lets us test, launch, and scale without the risk. It's the smartest way we've grown our fashion business."</p>
        <div class="who">
            <img src="{{ asset('images/site/WhoWeHelp/justphoto.jpg') }}" alt="">
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
    <div class="cta-band-final whh-cta-final" style="margin:0; background: linear-gradient(120deg, #0a3830 0%, #0e5947 55%, #12735a 100%);">
        <img class="whh-cta-icon" src="{{ asset('images/site/WhoWeHelp/CtaBox.png') }}" alt="">
        <div class="cta-band-final-text"><h3>Let's Find the Right JIT Setup for Your Business</h3><p>Tell us about your needs and we'll design the perfect manufacturing plan for you.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white"><i class="far fa-calendar-check"></i> Book a Discovery Call</a>
            <a href="{{ url('/contact') }}" class="btn-ghost"><i class="far fa-user"></i> Request a Quote</a>
        </div>
    </div>
</div>
@endsection
