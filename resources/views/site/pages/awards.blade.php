@extends('site.layouts.app')
@section('title', 'Awards & Recognitions')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/awards.css') }}">
@endpush

@section('content')
<div class="wrap hero-dark">
    <img class="bg" src="{{ asset('images/site/Awards/AwardBanner.JPG') }}" alt="">
    <div class="wrap">
        <h1>Awards &amp; Recognitions</h1>
        <p class="lead">Milestones that inspire us to innovate, excel and create impact every day.</p>
    </div>
</div>

<div class="wrap section">
    <div class="section-head"><h2>Celebrating Excellence</h2><p>Our journey of innovation and commitment has been recognized by leading organizations across industry and government.</p></div>

    <div class="card-grid awards-grid">
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/EconomicsTimes.png') }}" alt=""><h4>ET MSME Awards 2025 Finalist</h4><p>Recognized for innovation, excellence, and impact in India's MSME sector.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Nascom.png') }}" alt=""><h4>NASSCOM Deep Tech Emerge 50 Award 2025</h4><p>Selected among India's leading deep-tech startups in manufacturing innovation.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Seoul.png') }}" alt=""><h4>Seoul Design Award 2025 Finalist</h4><p>Recognized for pioneering sustainable innovation in garment manufacturing.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Xindus.png') }}" alt=""><h4>Top 10 Export Volume Award 2024–25</h4><p>Honoring exceptional export growth and international business excellence.</p><div class="year">2024–2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Tally.png') }}" alt=""><h4>Tally MSME Honours 2026 – Tech Transformer</h4><p>Recognized for driving innovation and digital transformation in manufacturing.</p><div class="year">2026</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/TIE.png') }}" alt=""><h4>Young Entrepreneur of the Year</h4><p>Recognized for entrepreneurial leadership and outstanding business growth.</p><div class="year">2022</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Payoneer.png') }}" alt=""><h4>Payoneer Global Indian Award</h4><p>Recognized for contribution to India's exports and global business excellence.</p><div class="year">2021</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/ImageGroup.png') }}" alt=""><h4>IMAGES eCommerce Awards</h4><p>Recognized for excellence in eCommerce innovation and digital transformation.</p><div class="year">2023</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/SustainableNXT.png') }}" alt=""><h4>Sustainable D2C Brand of the Year</h4><p>Recognized for excellence in sustainable innovation and responsible D2C brand growth.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/ImageGroup.png') }}" alt=""><h4>Most Admired Digital Brand Experience of the Year</h4><p>Recognized for excellence in digital customer experience and eCommerce innovation.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/ImageGroup.png') }}" alt=""><h4>Moomaya Wins the 25th Annual IMAGES Fashion Award</h4><p>Honoured for Pioneering Use of Fashion Technology.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/AtalInovation.png') }}" alt=""><h4>Grand Idea Challenge – Smart Manufacturing</h4><p>Recognized for innovation and excellence in smart manufacturing solutions.</p><div class="year">2021</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/HDFC.png') }}" alt=""><h4>HDFC Tech Innovators 2025</h4><p>Recognized among the Top 56 innovators for developing impactful technology solutions.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Greenr.png') }}" alt=""><h4>GREENR Sustainability Assessment</h4><p>Evaluated for environmental impact and sustainable business practices.</p><div class="year">2024–2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Enterpenuer.png') }}" alt=""><h4>Entrepreneur India Fashion Startup of the Year</h4><p>Recognized for excellence in fashion innovation and entrepreneurial leadership.</p><div class="year">2024</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/ChitkaraUniversity.png') }}" alt=""><h4>Chitkara University Excellence Award</h4><p>Recognized for leadership, innovation, and entrepreneurial excellence.</p></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/SustainableNXT.png') }}" alt=""><h4>Green SME of the Year</h4><p>Honored by SustainableNXT for outstanding commitment to sustainable and responsible business practices.</p><div class="year">2023</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Arrcus.png') }}" alt=""><h4>SME Empowering India Awards – Textiles</h4><p>Honored for excellence in manufacturing innovation and contribution to the Indian textile industry.</p><div class="year">2024</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/sme.png') }}" alt=""><h4>India SME 100</h4><p>Honored as one of India's leading small and medium enterprises for outstanding business performance.</p><div class="year">2023</div></div>
    </div>
</div>

<div class="wrap ">
<div class="awards-stats-panel">
    <div class=" stats-row-icons">
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/AwardsWonIcon.png') }}" alt=""> 
        <div><strong>10+</strong><span>Awards Won</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/RecognitionsIcon.png') }}" alt=""> 
            <div><strong>20+</strong><span>Recognitions</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/GlobalClientsIcon.png') }}" alt=""> 
            <div><strong>Trusted by</strong><span>Global Clients</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/MadeInIndiaIcon.png') }}" alt=""> 
            <div><strong>Proudly</strong><span>Made in India</span></div></div>
    </div>
</div>
</div>
<div class="wrap">

<div class="cta-band-final awards-cta" style="background: linear-gradient(120deg, #0d3327, #145c42); margin-top:0px;margin-bottom:0px;">
    <div class="wrap awards-cta-inner">
        <img class="awards-cta-icon" src="{{ asset('images/site/Awards/RecognitionTrophyIcon.png') }}" alt="">
        <div class="awards-cta-text">
            <h3>Recognition fuels responsibility.</h3>
            <p>We remain committed to building a sustainable, technology-first manufacturing ecosystem for the global fashion industry.</p>
            <a href="{{ url('/contact') }}" class="partner-btn btn-teal">Partner With Us</a>
        </div>
    </div>
</div>
</div>
@endsection
