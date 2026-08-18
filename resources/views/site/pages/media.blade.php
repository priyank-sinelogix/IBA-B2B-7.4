@extends('site.layouts.app')
@section('title', 'Media')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/media.css') }}">
@endpush

@section('content')
<div class="wrap hero-dark">
    <img class="bg" src="{{ asset('images/site/Media/MediaBanner.JPG') }}" alt="">
    <div class="wrap">
        <h1>In the Media</h1>
        <p class="lead">From leading publications to industry voices, see how Sewgo is redefining the future of fashion manufacturing.</p>
    </div>
</div>

<div class="wrap section">
    <div class="media-stats-grid">
        <div class="media-stat-card">
            <img src="{{ asset('images/site/Media/MediaFeatures.png') }}" alt="">
            <div><strong>30+</strong><span>Media Features</span></div>
        </div>
        <div class="media-stat-card">
            <img src="{{ asset('images/site/Media/IndustryInterviews.png') }}" alt="">
            <div><strong>10+</strong><span>Industry Interviews</span></div>
        </div>
        <div class="media-stat-card">
            <img src="{{ asset('images/site/Media/GlobalMediaPresence.png') }}" alt="">
            <div><strong>Global</strong><span>Media Presence</span></div>
        </div>
    </div>
</div>

<div class="wrap section media-featured-section" style="padding-top:0;">
    <div class="section-head media-section-head"><h2>Featured In</h2></div>
    <div class="logo-row media-logo-row">
        <img src="{{ asset('images/site/Media/logo/Forbes.png') }}" alt="Forbes">
        <img src="{{ asset('images/site/Media/logo/TheEconomicTimes.png') }}" alt="The Economic Times">
        <!-- <img src="{{ asset('images/site/Media/logo/YourStory.png') }}" alt="YourStory"> -->
        <img src="{{ asset('images/site/Media/logo/BWBusinessworld.png') }}" alt="BW Businessworld">
        <img src="{{ asset('images/site/Media/logo/SMEFutures.png') }}" alt="SME Futures">
        <!-- <img src="{{ asset('images/site/Media/logo/EntrepreneurIndia.png') }}" alt="Entrepreneur India"> -->
        <!-- <img src="{{ asset('images/site/Media/logo/FashionNetwork.png') }}" alt="Fashion Network"> -->
        <!-- <img src="{{ asset('images/site/Media/logo/Inc42.png') }}" alt="Inc42"> -->
    </div>
</div>

<hr class="wrap media-divider">

<div class="wrap section" style="padding-top:0;">
    <div class="section-head media-section-head"><h2>Latest Highlights</h2></div>
    <div>
        <div class="media-card">
            <img src="{{ asset('images/site/Media/Highlight/OnDemandManufacturing.jpg') }}" alt="">
            <div><h4>Sewgo on the Future of On-Demand Manufacturing</h4><p>Our Co-founder shares insights on how JIT is solving inventory challenges for global fashion brands.</p><a href="#">Watch Interview →</a></div>
        </div>
        <div class="media-card">
            <img src="{{ asset('images/site/Media/Highlight/SustainableSupplyChain.jpg') }}" alt="">
            <div><h4>Building a Sustainable Fashion Supply Chain</h4><p>Feature story on our technology-led manufacturing model and sustainability mission.</p><a href="#">Read Article →</a></div>
        </div>
        <div class="media-card">
            <img src="{{ asset('images/site/Media/Highlight/JitTransformingFashion.jpg') }}" alt="">
            <div><h4>How JIT Manufacturing is Transforming Fashion</h4><p>Sewgo featured in leading business magazine for innovation in agile manufacturing.</p><a href="#">Read More →</a></div>
        </div>
    </div>
</div>

<div class="wrap" style="">
    <div class="subscribe-box">
        <img class="subscribe-icon" src="{{ asset('images/site/Media/StayUpdated.png') }}" alt="">
        <div style="">
            <h3 style="font-size:1.1rem; margin-bottom:4px;">Stay Updated</h3>
            <p style="color:var(--muted); font-size:.86rem; margin:0;">Get the latest updates, media features and industry insights straight to your inbox.</p>
            <form style="padding: 10px 0px;">
            <input type="email" placeholder="Enter your email address" >
            <button type="submit" class="btn btn-teal">Subscribe</button>
        </form>
        </div>
        
    </div>
</div>
@endsection
