@extends('site.layouts.app')
@section('title', 'Services')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/services.css') }}">
@endpush

@section('content')
<div class="hero-dark">
    <img class="bg" src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=1400&q=60" alt="">
    <div class="wrap" style="text-align:center;">
        <div class="eyebrow" style="color:#6fe0c0;">Our Services</div>
        <h1 style="margin:0 auto 14px;">Flexible Solutions. Uncompromised Quality.</h1>
        <p class="lead" style="margin:0 auto;">From concept to customer — we provide end-to-end JIT manufacturing services that help your brand move faster, smarter and with zero inventory risk.</p>
    </div>
</div>

<div class="wrap section">
    <div class="card-grid services-grid">
        <div class="info-card"><div class="icon-circle"><i class="fas fa-people-arrows"></i></div><h3>Collaborative Design</h3><p>Work with our design experts to bring your ideas to life — your vision, our expertise.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-tag"></i></div><h3>Product Development &amp; Sampling</h3><p>From first sketch to final sample — we get it right the first time so you perform even better.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-bolt"></i></div><h3>Just In Time Manufacturing</h3><p>On-demand production with no inventory, no risk. Only what you sell, we make.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-cut"></i></div><h3>Cut &amp; Sew Manufacturing</h3><p>Advanced cutting, stitching and finishing with strict quality standards at every step.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-check-circle"></i></div><h3>Quality Assurance</h3><p>Multi-step quality checks to ensure every garment meets international standards.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-tags"></i></div><h3>Custom Branding &amp; Packaging</h3><p>Labels, hangtags, polybags and packaging — branded to perfection.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-globe"></i></div><h3>Logistics Assistance</h3><p>End-to-end logistics support to get your products delivered anywhere in the world.</p></div>
        <div class="info-card"><div class="icon-circle"><i class="fas fa-leaf"></i></div><h3>Sustainable Practices</h3><p>Eco-friendly materials, responsible production and less waste for a better tomorrow.</p></div>
    </div>
</div>

<div class="stat-band">
    <div class="wrap" style="grid-template-columns: repeat(5,1fr);">
        <div class="stat"><i class="far fa-clock"></i><div><div class="num">48H</div><div class="lbl">Dispatch — Speed you can trust</div></div></div>
        <div class="stat"><i class="fas fa-user"></i><div><div class="num">1 MOQ</div><div class="lbl">Minimum Order</div></div></div>
        <div class="stat"><i class="fas fa-box"></i><div><div class="num">1000+</div><div class="lbl">Brands Served Globally</div></div></div>
        <div class="stat"><i class="fas fa-globe"></i><div><div class="num">40+</div><div class="lbl">Countries We ship</div></div></div>
        <div class="stat"><i class="fas fa-tshirt"></i><div><div class="num">10M+</div><div class="lbl">Garments Produced</div></div></div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>Why Brands Choose Sewgo</h2></div>
    <div class="icon-grid cols-5">
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-box-open"></i></div><h4>No Inventory Risk</h4><p>Produce only what sells. Zero unsold stock.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-globe"></i></div><h4>Faster Time to Market</h4><p>From order to doorstep in just 24–48 hours.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-tshirt"></i></div><h4>Lower Costs</h4><p>Lower upfront cost &amp; higher cash flow.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-building"></i></div><h4>Scalable Growth</h4><p>Flexible production to scale your business.</p></div>
        <div class="icon-card"><div class="icon-circle"><i class="fas fa-box"></i></div><h4>End-to-End Support</h4><p>We're with you at every step of the journey.</p></div>
    </div>
</div>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final" style="margin:0;">
        <div><h3>Let's Build the Future of Fashion, Together.</h3><p>Partner with Sewgo and experience the power of Just In Time manufacturing.</p></div>
        <a href="{{ url('/site/contact') }}" class="btn-white">Request a Quote →</a>
    </div>
</div>
@endsection
