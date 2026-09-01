@extends('site.layouts.app')
@section('title', 'Home')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/home.css') }}">
@endpush

@section('content')

<section class="wrap home-hero">
    <img class="home-hero-bg" src="{{ asset('images/site/home-hero.jpg') }}" alt="Sewgo production floor">

    <div class="home-hero-content">
        <div class="eyebrow">Just In Time (JIT) Manufacturing</div>
        <h1>
            <span class="line-navy">Sell First.</span>
            <span class="line-teal">Make Next.</span>
        </h1>
        <!-- <h3>Only After You Sell.</h3> -->
        <p class="lead">We manufacture only when an order is placed. No inventory. No risk. Just speed, flexibility and complete visibility.</p>

        <div class="mini-stats">
            <div class="mini-stat"><img src="{{ asset('images/site/Manufacturing.png') }}" alt=""><div><strong>Manufactured</strong>in 24–48 Hours</div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/MOQ.png') }}" alt=""><div><strong>MOQ 1</strong>No bar on styles</div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/Multiple.png') }}" alt=""><div><strong>Multiple</strong>sizes, colors &amp; prints</div></div>
            <div class="mini-stat"><img src="{{ asset('images/site/Shipping.png') }}" alt=""><div><strong>Ship with</strong>branding</div></div>
        </div>

        <div class="home-hero-actions">
            <a href="{{ url('/how-jit-works') }}" class="btn btn-teal">Explore How JIT Works</a>
            <a href="{{ url('/contact') }}" class="btn btn-outline-navy"><i class="fas fa-play"></i> Watch Sewgo in Action</a>
        </div>
    </div>

    <div class="home-hero-powered">
        <div class="lbl">Powered By</div>
        <img src="{{ asset('images/site/ibacraftlogo.png') }}" alt="IBA Crafts" style="height:22px; margin:6px auto;">
        <span>Premium JIT-in-Time Garment Manufacturing</span>
    </div>
</section>

@include('site.partials.stat-band-standard')

<section class="wrap section">
    <div class="why-sewgo">
        <div class="why-video">
            <video width="100%" controls><source src="{{ asset('images/site/iba_video_final_video.mp4') }}" type="video/mp4">Your browser does not support the video tag.</video>
        </div>
        
        <div>
            <div class="eyebrow">See How Sewgo Works</div>
            <h2>Why Sewgo?</h2>
            <p>We render the first order cyclic. Garments are made-on-demand within 24–48 hours.</p>
            <a href="{{ url('/how-jit-works') }}" class="know-more">Know More Details →</a>
            <p>On all JIT working models garment manufacturing unit only at the time of sales order or at stock-out of previous JIT-based sale is placed to the unit. Ensuring 0% liquidation &amp; 100% flexibility.</p>
            <div class="why-icons">
                <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/NoWastage.png') }}" alt=""></div><h4>No Wastage</h4></div>
                <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/JITTechnology.png') }}" alt=""></div><h4>JIT Technology</h4></div>
                <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/AIDrivenManufacturing.png') }}" alt=""></div><h4>AI-Driven Manufacturing</h4></div>
                <div class="icon-card"><div class="icon-circle"><img src="{{ asset('images/site/LogisticsAddon.png') }}" alt=""></div><h4>Logistics &amp; Add-on</h4></div>
            </div>
        </div>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="jit-process-panel">
        <div class="jit-process-head">
            <h2>How JIT Works</h2>
            <p class="jit-process-sub">A Customer's Order in Action</p>
            <div class="jit-process-rule"></div>
            <div class="jit-process-label"><i class="fas fa-shield-check"></i> Step-by-step explanation:</div>
        </div>
        <div class="jit-process-flow">
            <div class="jit-process-step">
                <span class="jit-process-badge">1</span>
                <h4>Customer orders from their online store.</h4>
                <div class="jit-process-img"><img src="{{ asset('images/site/Home/JitProcess/CustomerOrders.jpg') }}" alt=""></div>
                <p>Customers place orders on your store (Shopify, Magento, etc.), which are instantly integrated into Sewgo's JIT system for immediate processing.</p>
            </div>
            <div class="jit-process-arrow"><span class="jit-process-arrow-line"></span><i class="fas fa-play"></i></div>
            <div class="jit-process-step">
                <span class="jit-process-badge">2</span>
                <h4>We customize and manufacture your order with care.</h4>
                <div class="jit-process-img"><img src="{{ asset('images/site/Home/JitProcess/CustomizeManufacture.jpg') }}" alt=""></div>
                <p>We start with a white or grey fabric, customize it through printing, embroidery, or coloring, and then stitch it into a completed garment based on pre-approved designs.</p>
            </div>
            <div class="jit-process-arrow"><span class="jit-process-arrow-line"></span><i class="fas fa-play"></i></div>
            <div class="jit-process-step">
                <span class="jit-process-badge">3</span>
                <h4>Quality checked and delivered on time.</h4>
                <div class="jit-process-img"><img src="{{ asset('images/site/Home/JitProcess/QualityDelivered.jpg') }}" alt=""></div>
                <p>Our team conducts quality checks on the garments produced within a 48-hour timeframe and then ships them directly to the designated destination.</p>
            </div>
            <div class="jit-process-arrow"><span class="jit-process-arrow-line"></span><i class="fas fa-play"></i></div>
            <div class="jit-process-step">
                <span class="jit-process-badge">4</span>
                <h4>Higher profits. Zero waste. Better for the planet.</h4>
                <div class="jit-process-img"><img src="{{ asset('images/site/Home/JitProcess/HigherProfits.jpg') }}" alt=""></div>
                <p>You retain the profits, as our model ensures there is no unsold inventory or wastage, maximizing your return on investment while minimizing environmental impact.</p>
            </div>
        </div>
        <div class="jit-process-footer"><span><i class="fas fa-heart"></i> Powered by <strong>IBA Crafts</strong></span></div>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="two-card-grid">
        <div class="brand-card tint-teal">
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
            <div class="brand-card-media"><img src="{{ asset('images/site/BuiltforYourBrand.jpg') }}" alt=""></div>
            
            <!-- <div class="brand-card-media"><img src="{{ asset('images/site/BuiltforYourBrand.jpg') }} alt=""></div> -->
        </div>
        <div class="brand-card tint-teal">
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
            <div class="brand-card-media"><img src="{{ asset('images/site/BetterforYourCustomer.jpg') }}" alt=""></div>

        </div>
    </div>
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="section-head">
        <div class="eyebrow">What We Can Manufacture</div>
        <h2>Apparel &amp; Home Solutions for Every Need</h2>
    </div>
    <div class="manufacture-row">
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/WomensWear.png') }}" alt=""><span>Women's Wear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/MensWear.png') }}" alt=""><span>Men's Wear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/Kidswear.png') }}" alt=""><span>Kidswear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/Activewear.png') }}" alt=""><span>Activewear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/LoungewearInnerwear.png') }}" alt=""><span>Loungewear &amp; Innerwear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/HomeTextiles.png') }}" alt=""><span>Home Textiles</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/PlusSizeWear.png') }}" alt=""><span>Plus Size Wear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/Sleepwear.png') }}" alt=""><span>Sleepwear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/ResortWear.png') }}" alt=""><span>Resort Wear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/OccasionWear.png') }}" alt=""><span>Occasion Wear</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/FashionBasics.png') }}" alt=""><span>Fashion Basics</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/CustomizedUniforms.png') }}" alt=""><span>Customized Uniforms</span></div>
        <div class="item hide_class"></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/CushionCovers.png') }}" alt=""><span>Cushion Covers</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/Curtains.png') }}" alt=""><span>Curtains</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/TableLinen.png') }}" alt=""><span>Table Linen</span></div>
        <div class="item"><img src="{{ asset('images/site/Home/Manufacture/KitchenLinen.png') }}" alt=""><span>Kitchen Linen</span></div>
    </div>
    <!-- <div style="text-align:center; margin-top:30px;">
        <a href="{{ url('/services') }}" class="btn" style="border:1.5px solid var(--teal); color:var(--teal-dark);">Explore Design Library →</a>
    </div> -->
</section>

<section class="wrap section" style="padding-top:0;">
    <div class="vs-panel">
        <div class="section-head" style="margin-bottom:30px;">
            <div class="eyebrow" style="text-align:center;">Why JIT?</div>
            <h2>The Smarter Way to Manufacture</h2>
        </div>
        <div class="vs-grid">
            <div class="vs-icon-circle"><img src="{{ asset('images/site/SewgoJIT.png') }}" alt=""></div>
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
            <div class="vs-icon-circle"><img src="{{ asset('images/site/TraditionalManufacturing.png') }}" alt=""></div>
        </div>
    </div>
</section>

<section class="wrap" style="padding-bottom:30px;">
    <div class="sustain-band">
        <div class="wrap-inner">
            <div class="item"><img src="{{ asset('images/site/SustainableDesign2.png') }}" alt=""><div><strong>Sustainable by Design</strong><span>We produce only what's sold. Together, we build a more sustainable tomorrow.</span></div></div>
            <div class="item"><img src="{{ asset('images/site/WaterSaved2.png') }}" alt=""><div><strong>10M+</strong><span>Liters of Water Saved</span></div></div>
            <div class="item"><img src="{{ asset('images/site/LessWaste2.png') }}" alt=""><div><strong>Less Waste</strong><span>Zero Overproduction</span></div></div>
            <div class="item"><img src="{{ asset('images/site/LowerCarbon2.png') }}" alt=""><div><strong>Lower Carbon</strong><span>Lower Supply Chain</span></div></div>
        </div>
    </div>
</section>

<section class="wrap section trust-strip" style="padding-top:0;">
    <div class="eyebrow">Awarded. Trusted. Recognized.</div>
    <div class="trust-logos">
        <div class="t-logo"><img src="{{ asset('images/site/NASSCOM.png') }}" alt="NASSCOM"><span>Emerge 50 · Winner 2025</span></div>
        <div class="t-logo"><img src="{{ asset('images/site/SMEChampions.png') }}" alt="SME Champions"><span>Winner 2024</span></div>
        <div class="t-logo"><img src="{{ asset('images/site/Entrepreneur.png') }}" alt="Entrepreneur"><span>India's Tech 25 – D2C · July 2024</span></div>
        <!-- <div class="t-logo"><img src="{{ asset('images/site/IISIIIMTAngels.png') }}" alt="IISI · IIMT Angels"><span>Most Promising Startup Award 2022</span></div>
        <div class="t-logo"><img src="{{ asset('images/site/MahindraMahindra.png') }}" alt="Mahindra &amp; Mahindra"><span>Spirit of Manufacturing Award 2021</span></div>
        <div class="t-logo"><img src="{{ asset('images/site/StartupIndia.png') }}" alt="Startup India"><span>Recognized Startup</span></div> -->
        <div class="t-logo"><img src="{{ asset('images/site/Seoul.png') }}" alt="Startup India"><span>Seoul Design Award 2025</span></div>
        <div class="t-logo"><img src="{{ asset('images/site/TheEconomicTimes.png') }}" alt="The Economic Times"><span>ET MSME Awards 2025</span></div>
        <div class="t-logo"><img src="{{ asset('images/site/BuisnessWorld.png') }}" alt="Business World"><span>BW Retail 40 Under 40 Award 2024</span></div>
    </div>
</section>

<div class="wrap">
    <div class="cta-band-final" style="background: linear-gradient(90deg, #0f2a4a 0%, #12395b 35%, #0b6c72 75%, #0e5843 100%);margin:0;">
        <div><h3>Ready to Scale Your Brand with JIT?</h3><p>Let's build a future-ready, inventory-free fashion business together.</p></div>
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
@section('footer')
    @include('site.partials.footer-simple')
@endsection
