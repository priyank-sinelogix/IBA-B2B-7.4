@extends('site.layouts.app')
@section('title', 'Services')
@section('full_title', 'Private Label & Custom Garment Manufacturing Services | Sewgo')
@section('meta_description', 'End-to-end private label garment manufacturing including sampling, printing, cutting, stitching, packaging and global fulfilment.')
@section('service_name', 'Garment Manufacturing Services')
@section('og_image', 'images/site/Services/Background.jpg')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/services.css') }}">
@endpush

@section('content')
<div class="wrap hero-dark">
    <img class="bg" src="{{ asset('images/site/Services/Background.jpg') }}" alt="Garment manufacturing facility">
    <div class="wrap" style="text-align:center;">
        <div class="eyebrow" style="color:#6fe0c0;">Our Services</div>
        <h1 style="margin:0 auto 14px;">End-to-End Garment Manufacturing for Fashion Brands</h1>
        <p class="lead" style="margin:0 auto;">From product development and sampling to printing, automated cutting, stitching, finishing, private labelling, packaging and dispatch, Sewgo provides an integrated <a href="{{ url('/custom-garment-manufacturer-india') }}" style="color:#6fe0c0;">custom garment manufacturing</a> solution for fashion brands.</p>
    </div>
</div>

<div class="wrap section">
    <div class="section-head"><h2>Our Core Services</h2></div>
    <div class="card-grid services-grid">
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/CollaborativeDesign.png') }}" alt="" loading="lazy"><h3>Collaborative Design</h3><p>Work with our design experts to bring your ideas to life — your vision, our expertise.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/ProductDevelopmentSampling.png') }}" alt="" loading="lazy"><h3>Product Development &amp; Sampling</h3><p>From first sketch to final sample — we get it right the first time so you perform even better.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/JustInTimeManufacturing.png') }}" alt="" loading="lazy"><h3><a href="{{ url('/how-jit-works') }}">Just In Time Manufacturing</a></h3><p><a href="{{ url('/on-demand-garment-manufacturing') }}">On-demand production</a> with no inventory, no risk. Only what you sell, we make.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/CutSewManufacturing.png') }}" alt="" loading="lazy"><h3>Automated Cutting &amp; Garment Manufacturing</h3><p>Advanced cutting, stitching and finishing with strict quality standards at every step.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/QualityAssurance.png') }}" alt="" loading="lazy"><h3>Quality Control</h3><p>Multi-step quality checks to ensure every garment meets international standards.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/CustomBrandingPackaging.png') }}" alt="" loading="lazy"><h3><a href="{{ url('/private-label-garment-manufacturing') }}">Private Labelling</a> &amp; Packaging</h3><p>Labels, hangtags, polybags and packaging — branded to perfection.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/LogisticsAssistance.png') }}" alt="" loading="lazy"><h3>Global Fulfilment</h3><p>End-to-end logistics support to get your products delivered anywhere in the world.</p></div>
        <div class="info-card"><img class="services-icon" src="{{ asset('images/site/Services/SustainablePractices.png') }}" alt="" loading="lazy"><h3>Sustainable Practices</h3><p>Eco-friendly materials, responsible production and less waste for a better tomorrow.</p></div>
    </div>
</div>
@include('site.partials.stat-band-standard')


<div class="wrap section" style="">
    <div class="section-head"><h2>Why Brands Choose Sewgo</h2></div>
    <div class="icon-grid cols-5">
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/NoInventoryRisk.png') }}" alt="" loading="lazy"><h3>No Inventory Risk</h3><p>Produce only what sells. Zero unsold stock.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/FasterTimeToMarket.png') }}" alt="" loading="lazy"><h3>Faster Time to Market</h3><p>From order to doorstep in just 24–48 hours.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/LowerCosts.png') }}" alt="" loading="lazy"><h3>Lower Costs</h3><p>Lower upfront cost &amp; higher cash flow.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/ScalableGrowth.png') }}" alt="" loading="lazy"><h3>Scalable Growth</h3><p>Flexible production to scale your business.</p></div>
        <div class="icon-card"><img class="services-icon" src="{{ asset('images/site/Services/WhySewgo/EndToEndSupport.png') }}" alt="" loading="lazy"><h3>End-to-End Support</h3><p>We're with you at every step of the journey.</p></div>
    </div>
</div>

<div class="wrap" style="padding-bottom:40px;">
    <div class="cta-band-final services-cta-final" style="margin:0;">
        <img class="services-cta-icon" src="{{ asset('images/site/Services/IconQuoteBox.png') }}" alt="" loading="lazy">
        <div class="cta-band-final-text"><h3>Let's Build the Future of Fashion, Together.</h3><p>Partner with Sewgo and experience the power of Just In Time manufacturing.</p></div>
        <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
    </div>
</div>
@endsection
