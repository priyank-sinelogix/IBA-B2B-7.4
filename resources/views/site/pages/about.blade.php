@extends('site.layouts.app')
@section('title', 'About')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/about.css') }}">
@endpush

@section('content')
<div class="wrap">
    <div class="hero-split">
        <div>
            <div class="eyebrow">About Sewgo</div>
            <h1>Reinventing Apparel Manufacturing for a Smarter Tomorrow.</h1>
            <p class="lead">Sewgo is a technology-powered Just In Time (JIT) garment manufacturing platform that helps fashion brands and online retailers produce only what sells — faster, smarter and better for the planet.</p>
            <div class="mini-stats">
                <div class="mini-stat"><i class="far fa-clock"></i><div><strong>Manufactured</strong>in 24–48 Hours</div></div>
                <div class="mini-stat"><i class="fas fa-tshirt"></i><div><strong>MOQ 1</strong>As low as 1 piece</div></div>
                <div class="mini-stat"><i class="fas fa-globe"></i><div><strong>40+ Countries</strong>We ship worldwide</div></div>
                <div class="mini-stat"><i class="fas fa-leaf"></i><div><strong>Sustainable</strong>By Design</div></div>
            </div>
        </div>
        <img src="https://images.unsplash.com/photo-1487958449943-2429e8be8625?w=800&q=70" alt="Sewgo facility">
    </div>
</div>

<div class="wrap section" style="padding-top:10px;">
    <div class="hero-split about-story-grid">
        <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=700&q=70" alt="Production floor" style="border-radius:16px;">
        <div>
            <h2 style="font-size:1.7rem; margin-bottom:16px;">Our Story</h2>
            <p style="color:var(--muted); margin-bottom:14px;">Born out of a simple belief that fashion doesn't have to create waste, Sewgo was built to solve the biggest challenges brands face — inventory risk, long lead times, and inflexible production.</p>
            <p style="color:var(--muted); margin-bottom:14px;">With JIT technology at the core, we connect demand with production in real time, ensuring garments are made only after an order is placed.</p>
            <p style="color:var(--muted);">The result? Lower risk, higher speed, and a more sustainable way to grow your fashion business.</p>
        </div>
    </div>
</div>

<div class="wrap">
    <div style="background:var(--bg-soft); border-radius:18px; padding:40px;">
        <h2 style="text-align:center; font-size:1.5rem; margin-bottom:30px;">Our Mission &amp; Values</h2>
        <div class="icon-grid">
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-bullseye"></i></div><h4>Our Mission</h4><p>To empower brands with on-demand manufacturing and smart technology for a better tomorrow.</p></div>
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-gem"></i></div><h4>Our Vision</h4><p>To be the world's most trusted JIT manufacturing partner for fashion and lifestyle.</p></div>
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-users"></i></div><h4>Our Values</h4><p>Quality, Speed, Transparency, Sustainability. Every single product we make.</p></div>
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-hand-holding-heart"></i></div><h4>Our Promise</h4><p>We treat your brand like our own.</p></div>
        </div>
    </div>
</div>

<div class="stat-band">
    <div class="wrap" style="grid-template-columns: repeat(4,1fr);">
        <div class="stat"><i class="fas fa-tshirt"></i><div><div class="num">10M+</div><div class="lbl">Garments Produced</div></div></div>
        <div class="stat"><i class="fas fa-building"></i><div><div class="num">1000+</div><div class="lbl">Brands That Trust Us</div></div></div>
        <div class="stat"><i class="fas fa-globe"></i><div><div class="num">40+</div><div class="lbl">Countries Served</div></div></div>
        <div class="stat"><i class="fas fa-user-tie"></i><div><div class="num">10+</div><div class="lbl">Years of Excellence</div></div></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2 style="font-size:1.4rem;">Trusted by Brands Worldwide</h2></div>
    <div class="logo-row">
        <span>amazon</span><span>Myntra</span><span>NYKAA</span><span>Shopsy</span><span>Etsy</span><span>Walmart</span>
    </div>
</div>
@endsection
