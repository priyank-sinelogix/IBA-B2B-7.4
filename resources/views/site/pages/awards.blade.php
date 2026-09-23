@extends('site.layouts.app')
@section('title', 'Awards & Recognitions')
@section('full_title', 'Awards & Recognitions | Sewgo')
@section('meta_description', "Explore the industry awards and recognitions Sewgo has received for its technology-led Just-in-Time garment manufacturing platform.")
@section('og_image', 'images/site/Awards/AwardBanner.jpg')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/awards.css') }}">
@endpush

@section('content')
<div class="wrap hero-dark">
    <img class="bg" src="{{ asset('images/site/Awards/AwardBanner.jpg') }}" alt="Sewgo awards and industry recognitions">
    <div class="wrap">
        <h1>Awards &amp; Recognitions</h1>
        <p class="lead">Milestones that inspire us to innovate, excel and create impact every day.</p>
    </div>
</div>

<div class="wrap section">
    <div class="section-head"><h2>Celebrating Excellence</h2><p>Our journey of innovation and commitment has been recognized by leading organizations across industry and government.</p></div>

    <div class="card-grid awards-grid">
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/EconomicsTimes.png') }}" alt="" loading="lazy"><h3>ET MSME Awards 2025 Finalist</h3><p>Recognized for innovation, excellence, and impact in India's MSME sector.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Nascom.png') }}" alt="" loading="lazy"><h3>NASSCOM Deep Tech Emerge 50 Award 2025</h3><p>Selected among India's leading deep-tech startups in manufacturing innovation.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Seoul.png') }}" alt="" loading="lazy"><h3>Seoul Design Award 2025 Finalist</h3><p>Recognized for pioneering sustainable innovation in garment manufacturing.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Xindus.png') }}" alt="" loading="lazy"><h3>Top 10 Export Volume Award 2024–25</h3><p>Honoring exceptional export growth and international business excellence.</p><div class="year">2024–2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Tally.png') }}" alt="" loading="lazy"><h3>Tally MSME Honours 2026 – Tech Transformer</h3><p>Recognized for driving innovation and digital transformation in manufacturing.</p><div class="year">2026</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/TIE.png') }}" alt="" loading="lazy"><h3>Young Entrepreneur of the Year</h3><p>Recognized for entrepreneurial leadership and outstanding business growth.</p><div class="year">2022</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Payoneer.png') }}" alt="" loading="lazy"><h3>Payoneer Global Indian Award</h3><p>Recognized for contribution to India's exports and global business excellence.</p><div class="year">2021</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/IMAGES_Ecommerce_Awards_2025_Excellence_In_Ecommerce_Innovation_Logo.png') }}" alt="" loading="lazy"><h3>IMAGES eCommerce Awards</h3><p>Recognized for excellence in eCommerce innovation and digital transformation.</p><div class="year">2023</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/SustainableNXT.png') }}" alt="" loading="lazy"><h3>Sustainable D2C Brand of the Year</h3><p>Recognized for excellence in sustainable innovation and responsible D2C brand growth.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/ImageGroup.png') }}" alt="" loading="lazy"><h3>Most Admired Digital Brand Experience of the Year</h3><p>Recognized for excellence in digital customer experience and eCommerce innovation.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/IMAGES_Fashion_Awards_25th_Logo_PNG.png') }}" alt="" loading="lazy"><h3>Images Most Admired Fashion Innovation of the Year</h3><p>Honoured for Pioneering Use of Fashion Technology.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/combined_award_logos.png') }}" alt="" loading="lazy"><h3>Recognized at the Grand Idea Challenge 2021</h3><p>IBA Crafts Pvt. Ltd. received Second-Place Recognition at the Grand Idea Challenge under the Smart Manufacturing theme on 26 June 2021.</p><div class="year">2021</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/HDFC.png') }}" alt="" loading="lazy"><h3>HDFC Tech Innovators 2025</h3><p>Recognized among the Top 56 innovators for developing impactful technology solutions.</p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Greenr.png') }}" alt="" loading="lazy"><h3>GREENR Sustainability Assessment</h3><p>Evaluated for environmental impact and sustainable business practices.</p><div class="year">2024–2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Enterpenuer.png') }}" alt="" loading="lazy"><h3>Entrepreneur India Fashion Startup of the Year</h3><p>Recognized for excellence in fashion innovation and entrepreneurial leadership.</p><div class="year">2024</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/ChitkaraUniversity.png') }}" alt="" loading="lazy"><h3>Chitkara University Excellence Award</h3><p>Recognized for leadership, innovation, and entrepreneurial excellence.</p></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/SustainableNXT.png') }}" alt="" loading="lazy"><h3>Green SME of the Year</h3><p>Honored by SustainableNXT for outstanding commitment to sustainable and responsible business practices.</p><div class="year">2023</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/SME_Empowering_India_Awards_Excellence_in_Manufacturing_Logo.png') }}" alt="" loading="lazy"><h3>SME – Empowering India Awards | Excellence in Manufacturing</h3><p>Proudly honored with the SME – Empowering India Award for Excellence in Manufacturing, presented by the Hon’ble Textile Minister of India. </p><div class="year">2024</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/sme.png') }}" alt="" loading="lazy"><h3>India SME 100</h3><p>Honored as one of India's leading small and medium enterprises for outstanding business performance.</p><div class="year">2023</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/Top100.png') }}" alt="" loading="lazy"><h3>Top 100 Startups to Watch Out for 2025</h3><p>Moomaya (By IBA Crafts), led by Nitin Kapoor, was featured among Forbes India’s Top 100 Startups to Watch Out for 2025. </p><div class="year">2025</div></div>
        <div class="badge-card"><img class="badge-icon" src="{{ asset('images/site/Awards/Award/BuisnessWorld.png') }}" alt="" loading="lazy"><h3>BW Retail World 40 Under 40 Award</h3><p>Proudly recognized among BW Retail World’s 40 Under 40, an esteemed recognition celebrating young leaders who are shaping the future of India’s retail industry through innovation, entrepreneurial vision, leadership, and business excellence.</p><div class="year">2023</div></div>
    </div>
</div>

<div class="wrap ">
<div class="awards-stats-panel">
    <div class=" stats-row-icons">
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/AwardsWonIcon.png') }}" alt="" loading="lazy"> 
        <div><strong>10+</strong><span>Awards Won</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/RecognitionsIcon.png') }}" alt="" loading="lazy"> 
            <div><strong>20+</strong><span>Recognitions</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/GlobalClientsIcon.png') }}" alt="" loading="lazy"> 
            <div><strong>Trusted by</strong><span>Global Clients</span></div></div>
        <div class="stat-icon-item">
            <img src="{{ asset('images/site/Awards/MadeInIndiaIcon.png') }}" alt="" loading="lazy"> 
            <div><strong>Proudly</strong><span>Made in India</span></div></div>
    </div>
</div>
</div>
<div class="wrap">

<div class="cta-band-final awards-cta" style="background: linear-gradient(120deg, #0d3327, #145c42); margin-top:0px;margin-bottom:0px;">
    <div class="wrap awards-cta-inner">
        <img class="awards-cta-icon" src="{{ asset('images/site/Awards/RecognitionTrophyIcon.png') }}" alt="" loading="lazy">
        <div class="awards-cta-text">
            <h3>Recognition fuels responsibility.</h3>
            <p>We remain committed to building a sustainable, technology-first manufacturing ecosystem for the global fashion industry.</p>
            <a href="{{ url('/contact') }}" class="partner-btn btn-teal">Partner With Us</a>
        </div>
    </div>
</div>
</div>
@endsection
