@extends('site.layouts.app')
@section('title', "Women's Garment Manufacturer")
@section('full_title', "Women's Garment Manufacturer in India | Sewgo")
@section('meta_description', "Women's apparel manufacturing for fashion brands with sampling, custom prints, flexible production, private labels and global fulfilment.")
@section('service_name', "Women's Garment Manufacturing")

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/landing-pages.css') }}">
@endpush

@section('content')
<section class="wrap section landing-hero">
    <div class="landing-hero-inner">
        <div class="eyebrow">Women's Apparel Manufacturing</div>
        <h1>Women's Garment Manufacturing for Fashion Brands</h1>
        <p>Sewgo supports the development and production of women's apparel for fashion and e-commerce brands. Our manufacturing process can accommodate approved styles across different prints, colours and sizes, with sampling, production, private labelling, quality control and international fulfilment managed through one manufacturing platform.</p>
    </div>
</section>

<div class="wrap section">
    <div class="section-head"><h2>What We Offer</h2></div>
    <div class="card-grid">
        <div class="info-card"><h3>Product Development</h3><p>Your women's wear designs are developed into production-ready styles.</p></div>
        <div class="info-card"><h3>Dresses &amp; Separates</h3><p>Manufacturing support across dresses, tops, bottoms and separates.</p></div>
        <div class="info-card"><h3>Prints, Colours &amp; Fabrics</h3><p>A wide range of fabrics, prints and colourways to match your collection.</p></div>
        <div class="info-card"><h3>Size &amp; Grading Support</h3><p>Styles are graded accurately across your required size range.</p></div>
        <div class="info-card"><h3>Private Labelling</h3><p>Labels, hangtags and packaging are branded to your specification.</p></div>
        <div class="info-card"><h3>Flexible Production</h3><p>Order quantities that match demand, from small batches to larger runs.</p></div>
    </div>
</div>

<div class="wrap landing-cta-wrap">
    <div class="cta-band-final landing-cta-band">
        <div class="cta-band-final-text"><h3>Manufacture Your Women's Collection</h3><p>Tell us about your product and we'll help you get started.</p></div>
        <div class="actions">
            <a href="{{ url('/contact') }}" class="btn-white">Request a Quote <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</div>
@endsection
