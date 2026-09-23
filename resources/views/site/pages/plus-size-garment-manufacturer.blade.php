@extends('site.layouts.app')
@section('title', 'Plus Size Garment Manufacturer')
@section('full_title', 'Plus Size Garment Manufacturing | Sewgo')
@section('meta_description', 'Flexible plus size garment manufacturing for fashion brands with product development, grading, private labels and on-demand production.')
@section('service_name', 'Plus Size Garment Manufacturing')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/landing-pages.css') }}">
@endpush

@section('content')
<section class="wrap section landing-hero">
    <div class="landing-hero-inner">
        <div class="eyebrow">Plus Size Manufacturing</div>
        <h1>Plus Size Garment Manufacturing for Fashion Brands</h1>
        <p>Sewgo helps fashion businesses develop and manufacture extended-size apparel with structured sampling, grading and production workflows. The Just-in-Time model can support wider size offerings without requiring brands to manufacture every size in large quantities before demand is known.</p>
    </div>
</section>

<div class="wrap section">
    <div class="section-head"><h2>What We Offer</h2></div>
    <div class="card-grid">
        <div class="info-card"><h3>Sampling &amp; Fit Development</h3><p>Fit is developed and approved across extended sizes before production.</p></div>
        <div class="info-card"><h3>Grading &amp; Size Range</h3><p>Accurate grading ensures consistent fit across your full plus-size range.</p></div>
        <div class="info-card"><h3>Prints &amp; Fabrics</h3><p>A wide range of fabrics and prints are available for extended-size styles.</p></div>
        <div class="info-card"><h3>Production Flexibility</h3><p>Manufacture selected sizes on demand instead of bulk-producing every size.</p></div>
        <div class="info-card"><h3>Private Labelling</h3><p>Labels, hangtags and packaging are branded to your specification.</p></div>
        <div class="info-card"><h3>Replenishment</h3><p>Reorder only the sizes and styles that are actually selling.</p></div>
    </div>
</div>

<div class="wrap landing-cta-wrap">
    <div class="cta-band-final landing-cta-band">
        <div class="cta-band-final-text"><h3>Expand Your Size Range with Sewgo</h3><p>Tell us about your product and we'll help you get started.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
