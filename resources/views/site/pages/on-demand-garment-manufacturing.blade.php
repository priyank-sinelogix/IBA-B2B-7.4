@extends('site.layouts.app')
@section('title', 'On-Demand Garment Manufacturing')
@section('full_title', 'On-Demand Garment Manufacturing | Sewgo')
@section('meta_description', 'Manufacture garments closer to actual customer demand with Sewgo\'s technology-led on-demand production model for fashion brands.')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/landing-pages.css') }}">
@endpush

@section('content')
<section class="wrap section landing-hero">
    <div class="landing-hero-inner">
        <div class="eyebrow">On-Demand Manufacturing</div>
        <h1>On-Demand Garment Manufacturing for Fashion Brands</h1>
        <p>Sewgo enables fashion businesses to move from inventory-led production towards demand-led manufacturing. Once a product is developed and approved, production can be triggered as demand is received, giving brands greater flexibility across styles, prints, colours and sizes while reducing the need to commit to large quantities of finished stock.</p>
    </div>
</section>

<div class="wrap section">
    <div class="card-grid">
        <div class="info-card"><h3>How On-Demand Manufacturing Works</h3><p>Approved styles are held production-ready and manufactured as orders come in, rather than produced in bulk ahead of demand.</p></div>
        <div class="info-card"><h3>Benefits for Fashion Brands</h3><p>Lower inventory risk, better cash flow and the flexibility to offer a wider assortment without bulk commitments.</p></div>
        <div class="info-card"><h3>From Product Approval to Production</h3><p>Once a style, fabric, print and grading are approved, it moves straight into our on-demand production pipeline.</p></div>
        <div class="info-card"><h3>MOQ 1 Capability</h3><p>Production can start from a single unit, so brands are never forced to over-order to justify a run.</p></div>
        <div class="info-card"><h3>Private Labelling &amp; Global Fulfilment</h3><p>Labels, packaging and worldwide shipping are handled end to end, under your own brand.</p></div>
    </div>
</div>

<div class="wrap landing-cta-wrap">
    <div class="cta-band-final landing-cta-band">
        <div class="cta-band-final-text"><h3>Start a Manufacturing Project</h3><p>Tell us about your product and we'll help you move to on-demand production.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
