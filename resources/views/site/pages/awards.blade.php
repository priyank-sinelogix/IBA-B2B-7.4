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
        <div class="badge-card">
            <img class="badge-logo" src="{{ asset('images/site/AwardNASSCOM.png') }}" alt="NASSCOM">
        <div class="win">Winner</div><h4>NASSCOM Emerge 50 Awards 2025</h4><p>Recognized among India's top emerging tech companies for innovation and impact.</p><div class="year">2025</div></div>
        <div class="badge-card">
            <img class="badge-logo" src="{{ asset('images/site/AwardSME.png') }}" alt="SME Empowering India Awards">
            <div class="win">Winner</div><h4>SME Empowering India Awards — Textiles</h4><p>Honored by Ministry of Textiles, Government of India.</p><div class="year">2024</div></div>
        <div class="badge-card">
            <img class="badge-logo" src="{{ asset('images/site/AwardEntrepreneur.png') }}" alt="Entrepreneur India">y
            <div class="win">Winner</div><h4>Entrepreneur India Fashion Startup of the Year</h4><p>Recognized for excellence in fashion innovation.</p><div class="year">2023</div></div>
        <div class="badge-card">
            <!-- <img class="badge-logo" src="{{ asset('images/site/AwardISBNITI.png') }}" alt="ISB · NITI Aayog"> -->
            <div class="win">Winner</div><h4>Smart Manufacturing Award</h4><p>For our contribution towards advancing smart &amp; sustainable manufacturing in India.</p><div class="year">2022</div></div>
        <div class="badge-card">
            <!-- <img class="badge-logo" src="{{ asset('images/site/AwardYoungEntrepreneur.png') }}" alt="Young Entrepreneur of the Year"> -->
            <div class="win">Winner</div><h4>Young Entrepreneur of the Year</h4><p>Honoring vision, leadership and impact in manufacturing.</p><div class="year">2022</div></div>
        <div class="badge-card">
            <!-- <img class="badge-logo" src="{{ asset('images/site/AwardStartupIndia.png') }}" alt="Startup India"> -->
            <div class="win">Recognized</div><h4>Recognized Startup by Startup India</h4><p>Registered with DPIIT, Ministry of Commerce &amp; Industry, Govt. of India.</p><div class="year">2020</div></div>
    </div>
</div>

<!-- <div class="awards-stats-panel">
    <div class="wrap stats-row-icons">
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/AwardsWonIcon.png') }}" alt=""> 
        <div><strong>10+</strong><span>Awards Won</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/RecognitionsIcon.png') }}" alt=""> 
            <div><strong>20+</strong><span>Recognitions</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/GlobalClientsIcon.png') }}" alt=""> 
            <div><strong>Trusted by</strong><span>Global Clients</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/MadeInIndiaIcon.png') }}" alt=""> 
            <div><strong>Proudly</strong><span>Made in India</span></div></div>
    </div>
</div> -->

<!-- <div class="cta-band-final awards-cta" style="background: linear-gradient(120deg, #0d3327, #145c42); margin-top:50px;">
    <div class="wrap awards-cta-inner">
        <img class="awards-cta-icon" src="{{ asset('images/site/RecognitionTrophyIcon.png') }}" alt="">
        <div class="awards-cta-text">
            <h3>Recognition fuels responsibility.</h3>
            <p>We remain committed to building a sustainable, technology-first manufacturing ecosystem for the global fashion industry.</p>
            <a href="{{ url('/contact') }}" class="partner-btn btn-teal">Partner With Us</a>
        </div>
    </div>
</div> -->
@endsection
