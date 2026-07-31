@extends('site.layouts.app')
@section('title', 'Home')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/home.css') }}">
@endpush

@section('content')

<section class="wrap home-hero">
    <div class="home-hero-grid">
        <div>
            <div class="eyebrow">Just In Time (JIT) Manufacturing</div>
            <h1>
                <span class="line-navy">Sell First.</span>
                <span class="line-teal">Make Next.</span>
            </h1>
            <h3>Only After You Sell.</h3>
            <p class="lead">We manufacture only when an order is placed. No inventory. No risk. Just speed, flexibility and complete visibility.</p>

            <div class="mini-stats">
                <div class="mini-stat"><i class="far fa-clock"></i><div><strong>Manufactured</strong>in 24–48 Hours</div></div>
                <div class="mini-stat"><i class="fas fa-user"></i><div><strong>MOQ 1</strong>No bar on styles</div></div>
                <div class="mini-stat"><i class="fas fa-shapes"></i><div><strong>Multiple</strong>sizes, colors &amp; prints</div></div>
                <div class="mini-stat"><i class="fas fa-tags"></i><div><strong>Ship with</strong>branding</div></div>
            </div>

            <div class="home-hero-actions">
                <a href="{{ url('/site/how-jit-works') }}" class="btn btn-teal">Explore How JIT Works</a>
                <a href="{{ url('/site/contact') }}" class="btn btn-outline-navy"><i class="fas fa-play"></i> Watch Sewgo in Action</a>
            </div>
        </div>

        <div class="home-hero-media">
            <img class="main" src="https://images.unsplash.com/photo-1489987707025-afc232f7ea0f?w=900&q=70" alt="Sewgo production floor">
            <div class="home-hero-powered">
                <div class="lbl">Powered By</div>
                <img src="{{ asset('images/site/logo.jpg') }}" alt="IBA Crafts" style="height:22px; margin:6px auto;">
                <span>Premium JIT-in-Time Garment Manufacturing</span>
            </div>
        </div>
    </div>
</section>

<div class="stat-band">
    <div class="wrap" style="grid-template-columns: repeat(5,1fr);">
        <div class="stat"><i class="far fa-clock"></i><div><div class="num">48H</div><div class="lbl">Dispatch (Speed you can trust)</div></div></div>
        <div class="stat"><i class="fas fa-user"></i><div><div class="num">1 MOQ</div><div class="lbl">No inventory, Order as low as 1 piece</div></div></div>
        <div class="stat"><i class="fas fa-tshirt"></i><div><div class="num">1000+</div><div class="lbl">Styles Delivered Monthly</div></div></div>
        <div class="stat"><i class="fas fa-globe"></i><div><div class="num">40+</div><div class="lbl">JIT-Enabled Manufacturing Units</div></div></div>
        <div class="stat"><i class="fas fa-industry"></i><div><div class="num">10M+</div><div class="lbl">Garments Produced Annually</div></div></div>
    </div>
</div>

<section class="wrap section">
    <div class="why-sewgo">
        <div class="why-video">
            <img src="https://images.unsplash.com/photo-1558769132-cb1aea458c5e?w=700&q=70" alt="See how Sewgo works">
            <div class="play-btn"><i class="fas fa-play"></i></div>
        </div>
        <div>
            <div class="eyebrow">See How Sewgo Works</div>
            <h2>Why Sewgo?</h2>
            <p>We render the first order cyclic. Garments are made-on-demand within 24–48 hours.</p>
            <a href="{{ url('/site/how-jit-works') }}" class="know-more">Know More Details →</a>
            <p>On all JIT working models garment manufacturing unit only at the time of sales order or at stock-out of previous JIT-based sale is placed to the unit. Ensuring 0% liquidation &amp; 100% flexibility.</p>
            <div class="why-icons">
                <div class="icon-card"><div class="icon-circle"><i class="fas fa-hand-sparkles"></i></div><h4>No Wastage</h4></div>
                <div class="icon-card"><div class="icon-circle"><i class="fas fa-cog"></i></div><h4>JIT Technology</h4></div>
                <div class="icon-card"><div class="icon-circle"><i class="fas fa-brain"></i></div><h4>AI-Driven Manufacturing</h4></div>
                <div class="icon-card"><div class="icon-circle"><i class="fas fa-truck-fast"></i></div><h4>Logistics &amp; Add-on</h4></div>
            </div>
        </div>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="section-head">
        <div class="eyebrow">Our JIT Process</div>
        <h2>From Order to Doorstep in 5 Simple Steps</h2>
    </div>
    <div class="step-flow">
        <div class="step"><div class="icon-card"><i class="fas fa-hand-pointer" style="font-size:1.4rem; color:var(--navy);"></i></div><div class="num-badge">1</div><h4>You Choose</h4><p>Select from our design library or share yours</p></div>
        <div class="step"><i class="fas fa-clipboard-check" style="font-size:1.4rem; color:var(--navy);"></i><div class="num-badge">2</div><h4>Order Received</h4><p>We confirm and plan for your order</p></div>
        <div class="step"><i class="fas fa-shirt" style="font-size:1.4rem; color:var(--navy);"></i><div class="num-badge">3</div><h4>We Manufacture</h4><p>Garments are produced within 24–48 hours</p></div>
        <div class="step"><i class="fas fa-circle-check" style="font-size:1.4rem; color:var(--navy);"></i><div class="num-badge">4</div><h4>Quality Check</h4><p>Checked for quality and branding</p></div>
        <div class="step"><i class="fas fa-truck" style="font-size:1.4rem; color:var(--navy);"></i><div class="num-badge">5</div><h4>Packed &amp; Shipped</h4><p>Delivered to your doorstep anywhere in the world</p></div>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="two-card-grid">
        <div class="brand-card">
            <div>
                <h3>Built for Your Brand</h3>
                <ul>
                    <li><i class="fas fa-check"></i> Launch new styles without inventory risk</li>
                    <li><i class="fas fa-check"></i> Multiple sizes, colors &amp; prints</li>
                    <li><i class="fas fa-check"></i> Lower upfront costs, higher cash flow</li>
                    <li><i class="fas fa-check"></i> No minimums, no restrictions</li>
                    <li><i class="fas fa-check"></i> Scale your business with agility</li>
                    <li><i class="fas fa-check"></i> Flexible bulk or on-demand options</li>
                    <li><i class="fas fa-check"></i> Global shipping &amp; fulfillment support</li>
                </ul>
            </div>
            <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=300&q=70" alt="">
        </div>
        <div class="brand-card">
            <div>
                <h3>Better for Your Customer</h3>
                <ul>
                    <li><i class="fas fa-check"></i> New choices in styles, sizes &amp; colors</li>
                    <li><i class="fas fa-check"></i> Freshly made, high-quality products</li>
                    <li><i class="fas fa-check"></i> Faster delivery with real-time updates</li>
                    <li><i class="fas fa-check"></i> Personalized products &amp; experiences</li>
                    <li><i class="fas fa-check"></i> Sustainable fashion with less waste</li>
                </ul>
            </div>
            <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?w=300&q=70" alt="">
        </div>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="section-head">
        <div class="eyebrow">What We Can Manufacture</div>
        <h2>Apparel &amp; Home Solutions for Every Need</h2>
    </div>
    <div class="manufacture-row">
        <div class="item"><i class="fas fa-person-dress"></i><span>Women's Wear</span></div>
        <div class="item"><i class="fas fa-shirt"></i><span>Men's Wear</span></div>
        <div class="item"><i class="fas fa-child"></i><span>Kidswear</span></div>
        <div class="item"><i class="fas fa-dumbbell"></i><span>Activewear</span></div>
        <div class="item"><i class="fas fa-vest"></i><span>Loungewear &amp; Innerwear</span></div>
        <div class="item"><i class="fas fa-bag-shopping"></i><span>Accessories</span></div>
        <div class="item"><i class="fas fa-house"></i><span>Home Textiles</span></div>
        <div class="item"><i class="fas fa-suitcase"></i><span>Bags &amp; More</span></div>
    </div>
    <div style="text-align:center; margin-top:30px;">
        <a href="{{ url('/site/services') }}" class="btn" style="border:1.5px solid var(--teal); color:var(--teal-dark);">Explore Design Library →</a>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="vs-panel">
        <div class="section-head" style="margin-bottom:30px;">
            <div class="eyebrow" style="text-align:center;">Why JIT?</div>
            <h2>The Smarter Way to Manufacture</h2>
        </div>
        <div class="vs-grid">
            <div class="vs-col bad">
                <h4>Traditional Manufacturing</h4>
                <ul>
                    <li><i class="fas fa-xmark"></i> High inventory &amp; storage cost</li>
                    <li><i class="fas fa-xmark"></i> Long production &amp; delivery cycles</li>
                    <li><i class="fas fa-xmark"></i> Risk of overstock &amp; dead inventory</li>
                    <li><i class="fas fa-xmark"></i> Early bulk order &amp; high upfront cost</li>
                    <li><i class="fas fa-xmark"></i> Cash blockage &amp; inflexibility</li>
                </ul>
            </div>
            <div class="vs-badge">VS</div>
            <div class="vs-col good">
                <h4>Sewgo's Just In Time (JIT)</h4>
                <ul>
                    <li><i class="fas fa-check"></i> No inventory, no storage cost</li>
                    <li><i class="fas fa-check"></i> Manufacture + ship within 24–48H</li>
                    <li><i class="fas fa-check"></i> No overstock, no waste</li>
                    <li><i class="fas fa-check"></i> Flexibility at its 100% Best</li>
                    <li><i class="fas fa-check"></i> Cash flow friendly, pay as you sell</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="wrap" style="padding-bottom:30px;">
    <div class="sustain-band">
        <div class="wrap-inner">
            <div class="item"><i class="fas fa-book-open"></i><div><strong>Sustainable by Design</strong><span>We produce only what's sold. Together, we build a more sustainable tomorrow.</span></div></div>
            <div class="item"><i class="fas fa-tint"></i><div><strong>10M+</strong><span>Liters of Water Saved</span></div></div>
            <div class="item"><i class="fas fa-leaf"></i><div><strong>Less Waste</strong><span>Zero Overproduction</span></div></div>
            <div class="item"><i class="fas fa-cloud"></i><div><strong>Lower Carbon</strong><span>Lower Supply Chain</span></div></div>
        </div>
    </div>
</section>

<section class="wrap section trust-strip" style="padding-top:0;">
    <div class="eyebrow">Awarded. Trusted. Recognized.</div>
    <div class="trust-logos">
        <div class="t-logo"><strong>NASSCOM</strong><span>Emerge 50 · Winner 2025</span></div>
        <div class="t-logo"><strong>SME Champions</strong><span>Winner 2024</span></div>
        <div class="t-logo"><strong>Entrepreneur</strong><span>India's Tech 25 – D2C · July 2024</span></div>
        <div class="t-logo"><strong>IISI · IIMT Angels</strong><span>Most Promising Startup Award 2022</span></div>
        <div class="t-logo"><strong>Mahindra &amp; Mahindra</strong><span>Spirit of Manufacturing Award 2021</span></div>
        <div class="t-logo"><strong>Startup India</strong><span>Recognized Startup</span></div>
    </div>
</section>

<div class="wrap" style="padding-bottom:60px;">
    <div class="cta-band-final" style="background:var(--navy); margin:0;">
        <div><h3>Ready to Scale Your Brand with JIT?</h3><p>Let's build a future-ready, inventory-free fashion business together.</p></div>
        <div class="actions">
            <a href="{{ url('/site/contact') }}" class="btn-white">Book a Discovery Call</a>
            <a href="{{ url('/site/contact') }}" class="btn-ghost">Request a Sample Kit</a>
        </div>
    </div>
</div>

@endsection
