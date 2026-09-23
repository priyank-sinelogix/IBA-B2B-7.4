@extends('site.layouts.app')
@section('title', 'Custom Garment Manufacturer in India')
@section('full_title', 'Custom Garment Manufacturer in India | Sewgo')
@section('meta_description', 'Technology-led custom garment manufacturing in India for global fashion brands, including sampling, printing, production and private labelling.')
@section('service_name', 'Custom Garment Manufacturing in India')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/landing-pages.css') }}">
@endpush

@section('content')
<section class="wrap section landing-hero">
    <div class="landing-hero-inner">
        <div class="eyebrow">Manufacturing in India</div>
        <h1>Custom Garment Manufacturing in India for Global Brands</h1>
        <p>Sewgo combines garment manufacturing infrastructure in India with a technology-led <a href="{{ url('/how-jit-works') }}">Just-in-Time production system</a>. We work with fashion businesses on product development, sampling, custom prints, fabrics, sizing, production, <a href="{{ url('/private-label-garment-manufacturing') }}">private labelling</a> and international fulfilment.</p>
    </div>
</section>

<div class="wrap section">
    <div class="section-head"><h2>Our Custom Manufacturing Process</h2></div>
    <div class="card-grid">
        <div class="info-card"><h3>Custom Product Development</h3><p>Your designs are developed into production-ready styles by our in-house team.</p></div>
        <div class="info-card"><h3>Sampling &amp; Approval</h3><p>Samples are produced and refined until every detail is approved.</p></div>
        <div class="info-card"><h3>Printing &amp; Fabric Options</h3><p>A wide range of fabrics and printing techniques are available to match your brand.</p></div>
        <div class="info-card"><h3>Garment Production</h3><p>Cutting, stitching and finishing are carried out to strict quality standards.</p></div>
        <div class="info-card"><h3>Quality Control</h3><p>Multi-step quality checks ensure every garment meets international standards.</p></div>
        <div class="info-card"><h3>International Shipping</h3><p>Finished orders are shipped worldwide with full logistics support.</p></div>
    </div>
</div>

<div class="wrap landing-cta-wrap">
    <div class="cta-band-final landing-cta-band">
        <div class="cta-band-final-text"><h3>Manufacture with Sewgo in India</h3><p>Tell us about your product and we'll help you get started.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
