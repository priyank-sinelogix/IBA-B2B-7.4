@extends('site.layouts.app')
@section('title', 'Small Batch Garment Manufacturing')
@section('full_title', 'Small Batch Garment Manufacturing | Sewgo')
@section('meta_description', 'Flexible small-batch garment manufacturing for brands testing new products, launching collections or replenishing based on demand.')
@section('service_name', 'Small Batch Garment Manufacturing')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/landing-pages.css') }}">
@endpush

@section('content')
<section class="wrap section landing-hero">
    <div class="landing-hero-inner">
        <div class="eyebrow">Small Batch Manufacturing</div>
        <h1>Flexible Small-Batch Garment Manufacturing</h1>
        <p>Fashion brands do not always need to commit to large production runs. Sewgo's flexible manufacturing model supports smaller production quantities and demand-led replenishment, helping brands test products, introduce wider assortments and scale production as demand develops.</p>
    </div>
</section>

<div class="wrap section">
    <div class="section-head"><h2>Why Choose Small-Batch Manufacturing</h2></div>
    <div class="card-grid">
        <div class="info-card"><h3>When Small-Batch Production Makes Sense</h3><p>Ideal for new launches, limited drops and styles where demand is still uncertain.</p></div>
        <div class="info-card"><h3>Test New Styles</h3><p>Introduce new styles in small quantities before committing to a full production run.</p></div>
        <div class="info-card"><h3>Expand Assortment</h3><p>Offer more styles, colours and prints without increasing inventory risk.</p></div>
        <div class="info-card"><h3>Replenish Based on Demand</h3><p>Reorder only the styles and sizes that are actually selling.</p></div>
        <div class="info-card"><h3>Move from Sampling to Production</h3><p>Approved samples can move directly into small-batch production without delay.</p></div>
    </div>
</div>

<div class="wrap landing-cta-wrap">
    <div class="cta-band-final landing-cta-band">
        <div class="cta-band-final-text"><h3>Start Small. Scale With Confidence.</h3><p>Talk to us about your next small-batch production run.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
