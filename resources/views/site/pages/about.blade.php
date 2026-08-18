@extends('site.layouts.app')
@section('title', 'About')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/about.css') }}">
@endpush

@section('content')
<section class="wrap about-hero">
    <img class="about-hero-bg" src="{{ asset('images/site/AboutUs/AboutUsBanner.jpg') }}" alt="Sewgo facility">
    <div class="about-hero-content">
        <div class="eyebrow">About Sewgo</div>
        <h1>From Fashion Inventory Problems to a Smarter JIT Future.</h1>
        <p class="lead">Sewgo is the technology-powered JIT manufacturing platform of IBA Crafts, created to solve the waste and rigidity of traditional inventory-led fashion manufacturing.</p>
        <div class="about-mini-stats">
            <div class="about-mini-stat"><img src="{{ asset('images/site/AboutUs/BannerIcon/ProductionDispatch.png') }}" alt=""><div class="num">48H</div><span>Production &amp; Dispatch</span></div>
            <div class="about-mini-stat"><img src="{{ asset('images/site/AboutUs/BannerIcon/MinimumOrder.png') }}" alt=""><div class="num">MOQ 1</div><span>Minimum Order</span></div>
            <div class="about-mini-stat"><img src="{{ asset('images/site/AboutUs/BannerIcon/GarmentsShipped.png') }}" alt=""><div class="num">1M+</div><span>Garments Shipped</span></div>
            <div class="about-mini-stat"><img src="{{ asset('images/site/AboutUs/BannerIcon/CountriesServed.png') }}" alt=""><div class="num">40+</div><span>Countries Served</span></div>
        </div>
    </div>
</section>

<div class="wrap section" style="padding-top:10px;">
    <div class="about-head-left"><h2>Why Sewgo Exists</h2></div>
    <div class="why-exists-row">
        <div class="why-exists-item">
            <div class="icon-circle"><img src="{{ asset('images/site/AboutUs/WhySwegoExists/TraditionalManufacturing.png') }}" alt=""></div>
            <p>Traditional fashion manufacturing locks capital in unsold inventory, causes waste, weakens cash flow and forces brands to overproduce in a world that changes every day. It slows decisions, limits innovation, and hurts both businesses and the planet.</p>
        </div>
        <div class="why-exists-item">
            <div class="icon-circle"><img src="{{ asset('images/site/AboutUs/WhySwegoExists/SewgoSolution.png') }}" alt=""></div>
            <p>Sewgo was created to change that. We built a JIT manufacturing platform that connects real demand to real production — so brands can move faster, reduce risk, stay manufacturing only what sells and build more sustainable businesses.</p>
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="about-head-left"><h2>The Story Behind Sewgo</h2></div>
    <div class="story-grid">
        <div class="story-card">
            <div class="story-icon"><img src="{{ asset('images/site/AboutUs/TheStoryBehingSwego/ProblemWeSaw.png') }}" alt=""></div>
            <h4>1. The Problem We Saw Every Day</h4>
            <p>Traditional manufacturing keeps too much inventory in the system—tying up capital and creating waste. By the time trends shift, it's often too late. We knew there had to be a better way.</p>
        </div>
        <div class="story-card">
            <div class="story-icon"><img src="{{ asset('images/site/AboutUs/TheStoryBehingSwego/ExperienceThatChanged.png') }}" alt=""></div>
            <h4>2. The Experience That Changed Our Thinking</h4>
            <p>As a manufacturing partner to leading global brands, IBA Crafts felt the pain firsthand—tight timelines, urgent reorders and missed opportunities. It pushed us to rethink everything we knew about scale, speed and responsiveness.</p>
        </div>
        <div class="story-card">
            <div class="story-icon"><img src="{{ asset('images/site/AboutUs/TheStoryBehingSwego/SolutionWeBuilt.png') }}" alt=""></div>
            <h4>3. The Solution We Built Together</h4>
            <p>Sewgo was born to connect real demand with real-time production. A platform that gives brands the agility to launch, test, adapt and win—manufacturing only what sells.</p>
        </div>
    </div>
</div>

<div class="wrap" style="padding-bottom:20px;">
    <div class="built-by-panel">
        <div class="built-by-text">
            <h3>Built by IBA Crafts</h3>
            <p>Sewgo is powered by IBA Crafts — a vertically integrated manufacturing leader delivering responsible, technology-enabled fashion at scale for over two decades.</p>
            <p>This is not a concept. It's live, commercial manufacturing capacity built on decades of real-world execution.</p>
        </div>
        <div class="built-by-stats">
            <div class="built-by-stat"><img src="{{ asset('images/site/AboutUs/BuiltByIBACrafts/GarmentsShipped.png') }}" alt=""><div class="num">1M+</div><span>Garments Shipped</span></div>
            <div class="built-by-stat"><img src="{{ asset('images/site/AboutUs/BuiltByIBACrafts/CountriesServed.png') }}" alt=""><div class="num">40+</div><span>Countries Served</span></div>
            <div class="built-by-stat"><img src="{{ asset('images/site/AboutUs/BuiltByIBACrafts/Employees.png') }}" alt=""><div class="num">170+</div><span>Employees</span></div>
            <div class="built-by-stat"><img src="{{ asset('images/site/AboutUs/BuiltByIBACrafts/GarmentsPerDay.png') }}" alt=""><div class="num">2,500</div><span>Garments/Day Capacity</span></div>
        </div>
        <img class="built-by-img" src="{{ asset('images/site/AboutUs/BuiltByIBACrafts/BuiltByIbaCrafts.jpg') }}" alt="">
    </div>
</div>

<div class="wrap section" style="padding-top:20px;">
    <div class="about-head-left"><h2>What We Believe</h2></div>
    <div class="card-grid believe-grid">
        <div class="info-card believe-card">
            <img src="{{ asset('images/site/AboutUs/WhatWeBelieve/Mission.png') }}" alt="">
            <div><h3>Mission</h3><p>Make on-demand manufacturing accessible to fashion brands of every size.</p></div>
        </div>
        <div class="info-card believe-card">
            <img src="{{ asset('images/site/AboutUs/WhatWeBelieve/Vision.png') }}" alt="">
            <div><h3>Vision</h3><p>A future in which fashion demand, not forecasts, drives production.</p></div>
        </div>
        <div class="info-card believe-card">
            <img src="{{ asset('images/site/AboutUs/WhatWeBelieve/Values.png') }}" alt="">
            <div><h3>Values</h3><p>Innovation, transparency, quality, agility, sustainability.</p></div>
        </div>
        <div class="info-card believe-card">
            <img src="{{ asset('images/site/AboutUs/WhatWeBelieve/Promise.png') }}" alt="">
            <div><h3>Promise</h3><p>Right product, right time, right cost, responsible and reliable.</p></div>
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="about-head-left"><h2>Leadership</h2></div>
    <div class="card-grid leadership-grid">
        <div class="leader-card">
            <img src="{{ asset('images/site/AboutUs/leadership/NitinKapoor.png') }}" alt="">
            <div class="leader-info">
                <h4>Nitin Kapoor</h4><span>CEO &amp; Co-Founder</span>
                <a href="#" class="leader-linkedin"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="leader-card">
            <img src="{{ asset('images/site/AboutUs/leadership/HemaKapoor.png') }}" alt="">
            <div class="leader-info">
                <h4>Hema Kapoor</h4><span>Co-Founder &amp; Creative Director</span>
                <a href="#" class="leader-linkedin"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="leader-card">
            <img src="{{ asset('images/site/AboutUs/leadership/AmitGupta.png') }}" alt="">
            <div class="leader-info">
                <h4>Amit Gupta</h4><span>Co-Founder &amp; COO</span>
                <a href="#" class="leader-linkedin"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="about-head-left"><h2>Recognition &amp; Trust</h2></div>
    <div class="recognition-logo-row">
        <img src="{{ asset('images/site/AboutUs/RecognitionTrust/Nasscom.png') }}" alt="NASSCOM Emerge 50">
        <img src="{{ asset('images/site/AboutUs/RecognitionTrust/Tally.png') }}" alt="Tally MSME Honours">
        <img src="{{ asset('images/site/AboutUs/RecognitionTrust/EntrepreneurIndia.png') }}" alt="Entrepreneur India">
        <img src="{{ asset('images/site/AboutUs/RecognitionTrust/StartupIndia.png') }}" alt="#startupindia">
        <img src="{{ asset('images/site/AboutUs/RecognitionTrust/SustainabilityHandbook.png') }}" alt="Sustainability Handbook Member">
    </div>
</div>

<div class="wrap" style="">
    <div class="about-quote-box">
        <div class="about-quote-icon"><i class="fas fa-quote-left"></i></div>
        <p>We didn't build Sewgo because manufacturing needed another supplier.<br>We built it because fashion needed a different manufacturing model.</p>
    </div>
</div>
@endsection
