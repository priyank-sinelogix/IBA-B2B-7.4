@extends('site.layouts.app')
@section('title', 'Private Label Garment Manufacturing')
@section('full_title', 'Private Label Garment Manufacturing | Sewgo')
@section('meta_description', 'Private label garment manufacturing for fashion brands with product development, printing, labelling, packaging and flexible production.')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/landing-pages.css') }}">
@endpush

@section('content')
<section class="wrap section landing-hero">
    <div class="landing-hero-inner">
        <div class="eyebrow">Private Label Manufacturing</div>
        <h1>Private Label Garment Manufacturing for Fashion Brands</h1>
        <p>Sewgo supports brands that want to manufacture apparel under their own label. From product development and sampling through printing, production, labels, packaging and dispatch, the manufacturing process can be built around your brand requirements while keeping your brand identity at the forefront.</p>
    </div>
</section>

<div class="wrap section">
    <div class="card-grid">
        <div class="info-card"><h3>Product Development &amp; Sampling</h3><p>Styles are developed and sampled against your specifications before moving into production.</p></div>
        <div class="info-card"><h3>Fabrics, Prints &amp; Colours</h3><p>Choose from a wide range of fabrics, prints and colourways to match your brand.</p></div>
        <div class="info-card"><h3>Labels &amp; Branding</h3><p>Woven labels, hangtags and branded trims are applied to every unit produced.</p></div>
        <div class="info-card"><h3>Packaging</h3><p>Polybags, boxes and branded packaging are prepared to your specification.</p></div>
        <div class="info-card"><h3>Flexible Production</h3><p>Order quantities that match your demand, without committing to large bulk runs.</p></div>
        <div class="info-card"><h3>International Fulfilment</h3><p>Finished goods are shipped directly to your customers or warehouses worldwide.</p></div>
    </div>
</div>

<div class="wrap landing-cta-wrap">
    <div class="cta-band-final landing-cta-band">
        <div class="cta-band-final-text"><h3>Let's Build Your Private Label Line</h3><p>Share your requirements and our team will help you get started.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
