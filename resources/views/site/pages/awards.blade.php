@extends('site.layouts.app')
@section('title', 'Awards & Recognitions')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/awards.css') }}">
@endpush

@section('content')
<div class="hero-dark">
    <img class="bg" src="https://images.unsplash.com/photo-1567427017947-545c5f8d16ad?w=1400&q=60" alt="">
    <div class="wrap">
        <h1>Awards &amp; Recognitions</h1>
        <p class="lead">Milestones that inspire us to innovate, excel and create impact every day.</p>
    </div>
</div>

<div class="wrap section">
    <div class="section-head"><h2>Celebrating Excellence</h2><p>Our journey of innovation and commitment has been recognized by leading organizations across industry and government.</p></div>

    <div class="card-grid awards-grid">
        <div class="badge-card"><i class="fas fa-award badge-icon red"></i><div class="win">Winner</div><h4>NASSCOM Emerge 50 Awards 2025</h4><p>Recognized among India's top emerging tech companies for innovation and impact.</p><div class="year">2025</div></div>
        <div class="badge-card"><i class="fas fa-award badge-icon orange"></i><div class="win">Winner</div><h4>SME Empowering India Awards — Textiles</h4><p>Honored by Ministry of Textiles, Government of India.</p><div class="year">2024</div></div>
        <div class="badge-card"><i class="fas fa-award badge-icon teal"></i><div class="win">Winner</div><h4>Entrepreneur India Fashion Startup of the Year</h4><p>Recognized for excellence in fashion innovation.</p><div class="year">2023</div></div>
        <div class="badge-card"><i class="fas fa-award badge-icon blue"></i><div class="win">Winner</div><h4>Smart Manufacturing Award — ISB / NITI Aayog</h4><p>For our contribution towards advancing smart &amp; sustainable manufacturing in India.</p><div class="year">2022</div></div>
        <div class="badge-card"><i class="fas fa-award badge-icon purple"></i><div class="win">Winner</div><h4>Young Entrepreneur of the Year — Spirit of Manufacturing</h4><p>Honoring vision, leadership and impact in manufacturing.</p><div class="year">2022</div></div>
        <div class="badge-card"><i class="fas fa-award badge-icon navy"></i><div class="win">Recognized</div><h4>Recognized Startup by Startup India</h4><p>Registered with DPIIT, Ministry of Commerce &amp; Industry, Govt. of India.</p><div class="year">2020</div></div>
    </div>
</div>

<div class="wrap">
    <div class="awards-stats-panel">
        <div class="icon-grid cols-3">
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-trophy"></i></div><h4>10+ Awards Won</h4></div>
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-certificate"></i></div><h4>20+ Recognitions</h4></div>
            <div class="icon-card"><div class="icon-circle"><i class="fas fa-globe"></i></div><h4>Trusted by Global Clients</h4></div>
        </div>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final" style="background:var(--navy); margin-top:50px;">
        <div><h3>Recognition fuels responsibility.</h3><p>We remain committed to building a sustainable, technology-first manufacturing ecosystem for the global fashion industry.</p></div>
        <a href="{{ url('/site/contact') }}" class="btn-white">Partner With Us</a>
    </div>
</div>
@endsection
