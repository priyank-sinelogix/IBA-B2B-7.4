@extends('site.layouts.app')
@section('title', 'Media')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/media.css') }}">
@endpush

@section('content')
<div class="hero-dark">
    <img class="bg" src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?w=1400&q=60" alt="">
    <div class="wrap">
        <h1>In the Media</h1>
        <p class="lead">From leading publications to industry voices, see how Sewgo is redefining the future of fashion manufacturing.</p>
    </div>
</div>

<div class="wrap section">
    <div class="icon-grid cols-3">
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-newspaper"></i></div><h4>30+ Media Features</h4></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-microphone"></i></div><h4>10+ Industry Interviews</h4></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-globe"></i></div><h4>Global Media Presence</h4></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>Featured In</h2></div>
    <div class="logo-row media-logo-row">
        <span>Forbes</span><span>The Economic Times</span><span>YourStory</span><span>BW Businessworld</span>
        <span>SME Futures</span><span>Entrepreneur India</span><span>Fashion Network</span><span>Inc42</span>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head" style="text-align:left; max-width:none;"><h2>Latest Highlights</h2></div>
    <div>
        <div class="media-card">
            <img src="https://images.unsplash.com/photo-1560439514-4e9645039924?w=300&q=70" alt="">
            <div><h4>Sewgo on the Future of On-Demand Manufacturing</h4><p>Our Co-founder shares insights on how JIT is solving inventory challenges for global fashion brands.</p><a href="#">Watch Interview →</a></div>
        </div>
        <div class="media-card">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300&q=70" alt="">
            <div><h4>Building a Sustainable Fashion Supply Chain</h4><p>Feature story on our technology-led manufacturing model and sustainability mission.</p><a href="#">Read Article →</a></div>
        </div>
        <div class="media-card">
            <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=300&q=70" alt="">
            <div><h4>How JIT Manufacturing is Transforming Fashion</h4><p>Sewgo featured in leading business magazine for innovation in agile manufacturing.</p><a href="#">Read More →</a></div>
        </div>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="subscribe-box">
        <div class="icon-circle"><i class="fas fa-envelope-open-text"></i></div>
        <div style="flex:1; min-width:220px;">
            <h3 style="font-size:1.1rem; margin-bottom:4px;">Stay Updated</h3>
            <p style="color:var(--muted); font-size:.86rem; margin:0;">Get the latest updates, media features and industry insights straight to your inbox.</p>
        </div>
        <form>
            <input type="email" placeholder="Enter your email address" >
            <button type="submit" class="btn btn-teal">Subscribe</button>
        </form>
    </div>
</div>
@endsection
