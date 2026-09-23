@extends('site.layouts.app')
@section('title', 'How JIT Works')
@section('full_title', 'Just-in-Time Garment Manufacturing | How JIT Works | Sewgo')
@section('meta_description', 'See how Sewgo enables fashion brands to manufacture garments against actual demand using technology-led Just-in-Time production.')
@section('og_image', 'images/site/HowJitWorks/HowjJtWorksBanner.jpg')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/how-jit-works.css') }}">
@endpush

@push('schema')
    @php
        $__faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'When does production begin?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Production begins immediately after an order is confirmed — there's no pre-production inventory."],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'What is the minimum order quantity?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Our MOQ starts at just 1 piece, so you can test styles before scaling.'],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Can I offer multiple sizes and prints?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes — Sewgo supports multi-SKU flexibility across sizes, colours and prints in one order.'],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'How fast can orders be dispatched?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Most orders are produced and dispatched within 24–48 hours.'],
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Do you offer white label / custom branding?',
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => 'Yes, including custom labels, hangtags and packaging for private label brands.'],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($__faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endpush

@section('content')


<section class="wrap jit-hero">
    <img class="jit-hero-bg" src="{{ asset('images/site/HowJitWorks/HowjJtWorksBanner.jpg') }}" alt="Just-in-Time garment manufacturing production line">
    <div class="jit-hero-content">
        <div class="eyebrow">Smarter Manufacturing. Made After You Sell.</div>
        <h1>How Just-in-Time Garment Manufacturing Works</h1>
        <p class="lead">At Sewgo, garments are produced only after an order is received. Our JIT model eliminates inventory risk, reduces waste, and ensures faster fulfillment with unmatched flexibility for modern brands.</p>
        <div style="display:flex; gap:12px; margin-top:22px;">
            <a href="{{ url('/contact') }}" class="btn btn-teal"><i class="far fa-calendar"></i> Book a Discovery Call</a>
            <a href="{{ url('/contact') }}" class="btn" style="border:1.5px solid var(--border); color:var(--navy);">Request Sample Kit</a>
        </div>
    </div>
</section>


<div class="wrap stat-band">
    <div class="row stat-band-grid">
        <div class="col-6 col-lg stat"><img src="{{ asset('images/site/HowJitWorks/icon/JitDispatch.png') }}" alt="" loading="lazy"><div><div class="num">24–48H</div><div class="lbl">Production &amp; Dispatch</div></div></div>
        <div class="col-6 col-lg stat"><img src="{{ asset('images/site/HowJitWorks/icon/JitMoq.png') }}" alt="" loading="lazy"><div><div class="num">MOQ 1</div><div class="lbl">Start From 1 Piece</div></div></div>
        <div class="col-6 col-lg stat"><img src="{{ asset('images/site/HowJitWorks/icon/JitSizes.png') }}" alt="" loading="lazy"><div><div class="num">Multiple</div><div class="lbl">Sizes &amp; Prints</div></div></div>
        <div class="col-6 col-lg stat"><img src="{{ asset('images/site/HowJitWorks/icon/JitShipping.png') }}" alt="" loading="lazy"><div><div class="num">Global</div><div class="lbl">Shipping</div></div></div>
        <div class="col-6 col-lg stat"><img src="{{ asset('images/site/HowJitWorks/icon/JitBrands.png') }}" alt="" loading="lazy"><div><div class="num">1000+</div><div class="lbl">Brands Served</div></div></div>
    </div>
</div>

<div class="wrap section">
  <div class="jit-flow-row">
    <div class="section-head jit-flow-head"><h2>The JIT Flow</h2><p>Production starts only after order confirmation. Simple, transparent, and built for speed.</p></div>
    <div class="step-flow jit-flow">
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepOrder.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">01</span>
            <h3>Customer Order Received</h3>
            <p>Order placed via website, brand portal or marketplace.</p>
        </div>
        <i class="fas fa-arrow-right step-arrow"></i>
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepStyle.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">02</span>
            <h3>Style &amp; Specifications Matched</h3>
            <p>Style, size, color, print &amp; quantity confirmed.</p>
        </div>
        <i class="fas fa-arrow-right step-arrow"></i>
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepFabric.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">03</span>
            <h3>Fabric / Print / Trim Allocation</h3>
            <p>Materials allocated from approved suppliers.</p>
        </div>
        <i class="fas fa-arrow-right step-arrow"></i>
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepCutting.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">04</span>
            <h3>Cutting &amp; Production Begins</h3>
            <p>Cutting scheduled as per confirmed order.</p>
        </div>
        <i class="fas fa-arrow-right step-arrow"></i>
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepStitching.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">05</span>
            <h3>Stitching / Finishing / Branding</h3>
            <p>Sewing, finishing, labeling &amp; branding completed.</p>
        </div>
        <i class="fas fa-arrow-right step-arrow"></i>
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepQuality.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">06</span>
            <h3>Quality Check</h3>
            <p>Multi-level QC for size, print accuracy, stitching &amp; construction.</p>
        </div>
        <i class="fas fa-arrow-right step-arrow"></i>
        <div class="step">
            <div class="step-icon-box"><img src="{{ asset('images/site/HowJitWorks/JitFlow/JitStepPacked.png') }}" alt="" loading="lazy"></div>
            <span class="num-badge">07</span>
            <h3>Packed &amp; Shipped</h3>
            <p>Secure packing and dispatch within 24–48 hours.*</p>
        </div>
    </div>
  </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="trigger-row">
        <div class="trigger-text">
            <h2>How Orders Trigger Production</h2>
            <p>Orders from your brand website, app, marketplace, or ERP system automatically trigger production planning at Sewgo.</p>
            <ul class="trigger-checklist">
                <li><i class="fas fa-circle-check"></i><div><strong>Catalog-driven fulfillment</strong> — choose from our design library or upload your own styles.</div></li>
                <li><i class="fas fa-circle-check"></i><div><strong>Made-after-sale model</strong> — we produce only what's ordered, the core of <a href="{{ url('/on-demand-garment-manufacturing') }}">on-demand manufacturing</a>.</div></li>
                <li><i class="fas fa-circle-check"></i><div><strong>Flexible SKU handling</strong> — multiple sizes, prints &amp; colors supported.</div></li>
                <li><i class="fas fa-circle-check"></i><div><strong>Real-time visibility</strong> — track every stage from order to dispatch.</div></li>
            </ul>
        </div>
        <div class="trigger-media">
            <img src="{{ asset('images/site/HowJitWorks/TriggerProduction/OrderTriggerDiagram.jpg') }}" alt="How orders trigger production" loading="lazy">
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="codesign-panel">
        <div class="codesign-grid">
            <div class="codesign-text">
                <h2><span class="line-navy">Don't Have Designs?</span><span class="line-teal">We Co-Create With You.</span></h2>
                <p>Whether you're starting fresh or scaling up, our platform empowers you to launch your fashion brand effortlessly — with or without your own designs.</p>
                <ul class="codesign-checklist">
                    <li><span class="check-badge"><i class="fas fa-check"></i></span>Access 20,000+ proven fashion designs</li>
                    <li><span class="check-badge"><i class="fas fa-check"></i></span>Customize prints, tweak trends, or request exclusives</li>
                    <li><span class="check-badge"><i class="fas fa-check"></i></span>Get mockups, AR/VR try-ons &amp; styling help</li>
                    <li><span class="check-badge"><i class="fas fa-check"></i></span>Instant product imagery for your store</li>
                </ul>
                <a href="{{ url('/contact') }}" class="btn btn-teal codesign-cta">Let's Co-Create <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="codesign-visual">
                <div class="codesign-flow">
                    <div class="codesign-step">
                        <div class="codesign-step-icon"><img src="{{ asset('images/site/HowJitWorks/CoCreate/ShareIdeas.png') }}" alt="" loading="lazy"></div>
                        <span>Share Your Ideas<br>or Mood Board</span>
                    </div>
                    <i class="fas fa-arrow-right codesign-arrow"></i>
                    <div class="codesign-step">
                        <div class="codesign-step-icon"><img src="{{ asset('images/site/HowJitWorks/CoCreate/DesignRefine.png') }}" alt="" loading="lazy"></div>
                        <span>We Design &amp;<br>Refine Together</span>
                    </div>
                    <i class="fas fa-arrow-right codesign-arrow"></i>
                    <div class="codesign-step">
                        <div class="codesign-step-icon"><img src="{{ asset('images/site/HowJitWorks/CoCreate/SampleIn48Hrs.png') }}" alt="" loading="lazy"></div>
                        <span>Sample in 48 Hrs<br>(virtual / physical)</span>
                    </div>
                    <i class="fas fa-arrow-right codesign-arrow"></i>
                    <div class="codesign-step">
                        <div class="codesign-step-icon"><img src="{{ asset('images/site/HowJitWorks/CoCreate/ProduceShip.png') }}" alt="" loading="lazy"></div>
                        <span>Produce &amp; Ship<br>On Time</span>
                    </div>
                    <i class="fas fa-arrow-right codesign-arrow"></i>
                    <div class="codesign-step">
                        <div class="codesign-step-icon"><img src="{{ asset('images/site/HowJitWorks/CoCreate/BrandReady.png') }}" alt="" loading="lazy"></div>
                        <span>Your Brand,<br>Ready to Sell</span>
                    </div>
                </div>
                <div class="codesign-media"><img src="{{ asset('images/site/HowJitWorks/CoCreate/CoCreateWorkspace2.jpg') }}" alt="Design team co-creating a garment collection with a brand" loading="lazy"></div>
            </div>
        </div>
        <div class="codesign-stats">
            <div class="item"><img src="{{ asset('images/site/HowJitWorks/CoCreate/StatCountries.png') }}" alt="" loading="lazy"><div><strong>40+</strong><span>Countries</span></div></div>
            <div class="item"><img src="{{ asset('images/site/HowJitWorks/CoCreate/StatPrints.png') }}" alt="" loading="lazy"><div><strong>2,000+</strong><span>Prints Available</span></div></div>
            <div class="item"><img src="{{ asset('images/site/HowJitWorks/CoCreate/StatDispatch.png') }}" alt="" loading="lazy"><div><strong>48H</strong><span>Dispatch</span></div></div>
            <div class="item"><img src="{{ asset('images/site/HowJitWorks/CoCreate/StatTeam.png') }}" alt="" loading="lazy"><div><strong>170+</strong><span>Team Members</span></div></div>
            <div class="item"><img src="{{ asset('images/site/HowJitWorks/CoCreate/StatSustainable.png') }}" alt="" loading="lazy"><div><strong>Sustainable</strong><span>Fashion Made Easy</span></div></div>
        </div>
    </div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="section-head"><h2>What Makes Sewgo Different</h2><p>Our JIT model is designed to help brands grow smarter.</p></div>
    <div class="diff-cards">
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffNoDeadStock.png') }}" alt="" loading="lazy"></div><h3>No Dead Stock</h3><p>Produce only after you sell. Zero unsold inventory.</p></div>
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffNoBulkInventory.png') }}" alt="" loading="lazy"></div><h3>No Bulk Inventory</h3><p>No large upfront investment in stock.</p></div>
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffFasterReplenishment.png') }}" alt="" loading="lazy"></div><h3>Faster Replenishment</h3><p>Replenish bestsellers quickly with 24–48H dispatch.</p></div>
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffFlexibleStyles.png') }}" alt="" loading="lazy"></div><h3>Flexible Styles / Sizes / Prints</h3><p>Launch more SKU variations with ease.</p></div>
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffBetterCashFlow.png') }}" alt="" loading="lazy"></div><h3>Better Cash Flow</h3><p>Pay for what you sell. Improve working capital.</p></div>
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffPrivateLabel.png') }}" alt="" loading="lazy"></div><h3><a href="{{ url('/private-label-garment-manufacturing') }}">Private Label</a> &amp; Packaging</h3><p>Custom tags, labels &amp; packaging to build your brand.</p></div>
        <div class="diff-card"><div class="diff-icon"><img src="{{ asset('images/site/HowJitWorks/WhatMakesSewgoDifferent/DiffGlobalFulfillment.png') }}" alt="" loading="lazy"></div><h3>Global Fulfillment</h3><p>Ship worldwide with reliable logistics partners.</p></div>
    </div>
</div>

<div class="wrap section ">
<div class="dispatch-panel">
    <div class="section-head"><h2>From Digital Selection to Final Dispatch</h2><p>A seamless workflow powered by technology and precision.</p></div>
        <div class="dispatch-flow">
            <div class="dispatch-item">
                <div class="dispatch-text">
                    <span class="dispatch-num">01</span>
                    <h3>Design Library</h3>
                    <p>Browse thousands of styles or upload your own designs. Choose sizes, colors &amp; prints from our configurator.</p>
                </div>
                <div class="dispatch-media"><img src="{{ asset('images/site/HowJitWorks/DigitalDispatch/DispatchDesignLibrary.jpg') }}" alt="Digital design library of ready-to-produce garment styles" loading="lazy"></div>
            </div>
            <i class="fas fa-arrow-right dispatch-arrow"></i>
            <div class="dispatch-item">
                <div class="dispatch-text">
                    <span class="dispatch-num">02</span>
                    <h3>Production</h3>
                    <p>Order triggers material allocation, cutting, stitching &amp; finishing in our smart manufacturing units.</p>
                </div>
                <div class="dispatch-media"><img src="{{ asset('images/site/HowJitWorks/DigitalDispatch/DispatchProduction.jpg') }}" alt="Garment cutting and stitching in production" loading="lazy"></div>
            </div>
            <i class="fas fa-arrow-right dispatch-arrow"></i>
            <div class="dispatch-item">
                <div class="dispatch-text">
                    <span class="dispatch-num">03</span>
                    <h3>Quality Assurance</h3>
                    <p>Multi-level QC checks ensure perfect fit, print accuracy, stitching &amp; finishing.</p>
                </div>
                <div class="dispatch-media"><img src="{{ asset('images/site/HowJitWorks/DigitalDispatch/DispatchQualityAssurance.jpg') }}" alt="Quality assurance check on finished garments" loading="lazy"></div>
            </div>
            <i class="fas fa-arrow-right dispatch-arrow"></i>
            <div class="dispatch-item">
                <div class="dispatch-text">
                    <span class="dispatch-num">04</span>
                    <h3>Logistics</h3>
                    <p>Packed securely and dispatched within 24–48 hours* with real-time tracking.</p>
                </div>
                <div class="dispatch-media"><img src="{{ asset('images/site/HowJitWorks/DigitalDispatch/DispatchLogistics.jpg') }}" alt="Packed garments ready for global logistics dispatch" loading="lazy"></div>
            </div>
        </div>
</div>
</div>

<div class="wrap section" style="padding-top:0;">
    <div class="tech-faq-row">
        <div class="tech-panel">
            <h2>Technology + Manufacturing</h2>
            <p>Sewgo combines digital intelligence with world-class manufacturing.</p>
            <div class="tech-icons">
                <div class="tech-item"><div class="tech-icon"><img src="{{ asset('images/site/HowJitWorks/TechnologyManufacturing/TechSmartOrderEngine.png') }}" alt="" loading="lazy"></div><h3>Smart Order Engine</h3><p>Automated order capture &amp; planning.</p></div>
                <div class="tech-item"><div class="tech-icon"><img src="{{ asset('images/site/HowJitWorks/TechnologyManufacturing/TechDesignLibrary.png') }}" alt="" loading="lazy"></div><h3>Design Library</h3><p>10,500+ ready styles &amp; customization.</p></div>
                <div class="tech-item"><div class="tech-icon"><img src="{{ asset('images/site/HowJitWorks/TechnologyManufacturing/TechDemandLedProduction.png') }}" alt="" loading="lazy"></div><h3>Demand-Led Production</h3><p>We produce only what's sold.</p></div>
                <div class="tech-item"><div class="tech-icon"><img src="{{ asset('images/site/HowJitWorks/TechnologyManufacturing/TechQualityAssurance.png') }}" alt="" loading="lazy"></div><h3>Quality Assurance</h3><p>Multi-stage QC for consistent quality.</p></div>
                <div class="tech-item"><div class="tech-icon"><img src="{{ asset('images/site/HowJitWorks/TechnologyManufacturing/TechLogisticsSupport.png') }}" alt="" loading="lazy"></div><h3>Logistics Support</h3><p>Global shipping &amp; tracking.</p></div>
            </div>
        </div>
        <div class="faq-panel">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-list">
                <details class="faq-item"><summary>When does production begin? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.85rem; margin-top:10px;">Production begins immediately after an order is confirmed — there's no pre-production inventory.</p></details>
                <details class="faq-item"><summary>What is the minimum order quantity? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.85rem; margin-top:10px;">Our MOQ starts at just 1 piece, so you can test styles before scaling.</p></details>
                <details class="faq-item"><summary>Can I offer multiple sizes and prints? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.85rem; margin-top:10px;">Yes — Sewgo supports multi-SKU flexibility across sizes, colours and prints in one order.</p></details>
                <details class="faq-item"><summary>How fast can orders be dispatched? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.85rem; margin-top:10px;">Most orders are produced and dispatched within 24–48 hours.</p></details>
                <details class="faq-item"><summary>Do you offer white label / custom branding? <i class="fas fa-plus"></i></summary><p style="color:var(--muted); font-size:.85rem; margin-top:10px;">Yes, including custom labels, hangtags and packaging for private label brands.</p></details>
            </div>
        </div>
    </div>
</div>

<div class="wrap section">
    <p style="max-width:760px; margin:0 auto; text-align:center; color:var(--muted); font-size:1.05rem;">Sewgo's Just-in-Time manufacturing model is designed around actual demand rather than bulk production forecasts, helping <a href="{{ url('/sustainability') }}">reduce overproduction</a> and unnecessary finished inventory. Once a style, fabric, print and grading are approved, the product becomes production-ready and can be manufactured as orders are received.</p>
    <div style="display:flex; align-items:center; justify-content:center; gap:12px; flex-wrap:wrap; margin:24px 0; font-family:'Manrope','Inter',sans-serif; font-weight:800; font-size:1.15rem; color:var(--navy);">
        <span>Develop</span><i class="fas fa-arrow-right" style="color:var(--teal); font-size:.9rem;"></i>
        <span>Approve</span><i class="fas fa-arrow-right" style="color:var(--teal); font-size:.9rem;"></i>
        <span>Sell</span><i class="fas fa-arrow-right" style="color:var(--teal); font-size:.9rem;"></i>
        <span>Manufacture</span><i class="fas fa-arrow-right" style="color:var(--teal); font-size:.9rem;"></i>
        <span>Dispatch</span>
    </div>
    <p style="max-width:760px; margin:0 auto; text-align:center; color:var(--muted); font-size:1.05rem;">This gives brands the flexibility to offer a wider assortment without manufacturing every style, size, colour and print in bulk before knowing what customers will buy.</p>
</div>

<div class="wrap">
    <div class="cta-band-final jit-cta-final" style="background: linear-gradient(90deg, #0f2a4a 0%, #12395b 35%, #0b6c72 75%, #0e5843 100%);margin:0;">
        <div class="cta-band-final-text"><h3>Ready to Launch with JIT?</h3><p>Grow your brand without inventory risk. Let Sewgo handle production, so you can focus on sales.</p></div>
        <div class="actions">
            <div class="action-item">
                <a href="{{ url('/contact') }}" class="btn-white"><i class="far fa-calendar-check"></i> Book a Discovery Call</a>
                <span class="action-caption"><i class="far fa-clock"></i> Quick Response</span>
            </div>
            <div class="action-item">
                <a href="{{ url('/contact') }}" class="btn-ghost"><i class="fas fa-box-open"></i> Request a Sample Kit</a>
                <span class="action-caption"><i class="fas fa-gear"></i> Custom Solutions</span>
            </div>
        </div>
    </div>
</div>
@endsection
