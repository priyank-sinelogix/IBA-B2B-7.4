@extends('site.layouts.app')
@section('title', 'Services')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/services.css') }}">
@endpush

@section('content')
<div class="wrap hero-dark">
    <img class="bg" src="{{ asset('images/site/Services/Background.jpg') }}" alt="">
    <div class="wrap" style="text-align:center;">
        <div class="eyebrow" style="color:#6fe0c0;">Our Services</div>
        <h1 style="margin:0 auto 14px;">Flexible Solutions.<br> Uncompromised Quality.</h1>
        <p class="lead" style="margin:0 auto;">From concept to customer — we provide end-to-end JIT manufacturing services that help your brand move faster, smarter and with zero inventory risk.</p>
    </div>
</div>

<div class="wrap section">
    <div class="card-grid services-grid">
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/CollaborativeDesign.png') }}" alt=""><h3>Collaborative Design</h3><p>Work with our design experts to bring your ideas to life — your vision, our expertise.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/ProductDevelopmentSampling.png') }}" alt=""><h3>Product Development &amp; Sampling</h3><p>From first sketch to final sample — we get it right the first time so you perform even better.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/JustInTimeManufacturing.png') }}" alt=""><h3>Just In Time Manufacturing</h3><p>On-demand production with no inventory, no risk. Only what you sell, we make.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/CutSewManufacturing.png') }}" alt=""><h3>Cut &amp; Sew Manufacturing</h3><p>Advanced cutting, stitching and finishing with strict quality standards at every step.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/QualityAssurance.png') }}" alt=""><h3>Quality Assurance</h3><p>Multi-step quality checks to ensure every garment meets international standards.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/CustomBrandingPackaging.png') }}" alt=""><h3>Custom Branding &amp; Packaging</h3><p>Labels, hangtags, polybags and packaging — branded to perfection.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/LogisticsAssistance.png') }}" alt=""><h3>Logistics Assistance</h3><p>End-to-end logistics support to get your products delivered anywhere in the world.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/SustainablePractices.png') }}" alt=""><h3>Sustainable Practices</h3><p>Eco-friendly materials, responsible production and less waste for a better tomorrow.</p></div>
    </div>
</div>
@include('site.partials.stat-band-standard')


<div class="wrap section" style="">
    <div class="section-head"><h2>Why Brands Choose Sewgo</h2></div>
    <div class="icon-grid cols-5">
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/NoInventoryRisk.png') }}" alt=""><h4>No Inventory Risk</h4><p>Produce only what sells. Zero unsold stock.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/FasterTimeToMarket.png') }}" alt=""><h4>Faster Time to Market</h4><p>From order to doorstep in just 24–48 hours.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/LowerCosts.png') }}" alt=""><h4>Lower Costs</h4><p>Lower upfront cost &amp; higher cash flow.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/ScalableGrowth.png') }}" alt=""><h4>Scalable Growth</h4><p>Flexible production to scale your business.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/EndToEndSupport.png') }}" alt=""><h4>End-to-End Support</h4><p>We're with you at every step of the journey.</p></div>
    </div>
</div>

<div class="wrap" style="padding-bottom:40px;">
    <div class="cta-band-final services-cta-final" style="margin:0;">
        <img class="services-cta-icon" src="{{ asset('images/site/Services/IconQuoteBox.png') }}" alt="">
        <div class="cta-band-final-text"><h3>Let's Build the Future of Fashion, Together.</h3><p>Partner with Sewgo and experience the power of Just In Time manufacturing.</p></div>
        <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
@endsection
