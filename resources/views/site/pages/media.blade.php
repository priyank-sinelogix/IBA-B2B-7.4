@extends('site.layouts.app')
@section('title', 'Media')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/media.css') }}">
@endpush

@section('content')
<div class="wrap hero-dark">
    <img class="bg" src="{{ asset('images/site/Media/MediaBanner.jpg') }}" alt="">
    <div class="wrap">
        <h1>In the Media</h1>
        <p class="lead">From leading publications to industry voices, see how Sewgo is redefining the future of fashion manufacturing.</p>
    </div>
</div>

<div class="wrap section">
    <div class="media-stats-grid">
        <div class="media-stat-card">
            <img src="{{ asset('images/site/Media/MediaFeatures.png') }}" alt="">
            <div><strong>30+</strong><span>Media Features</span></div>
        </div>
        <div class="media-stat-card">
            <img src="{{ asset('images/site/Media/IndustryInterviews.png') }}" alt="">
            <div><strong>10+</strong><span>Industry Interviews</span></div>
        </div>
        <div class="media-stat-card">
            <img src="{{ asset('images/site/Media/GlobalMediaPresence.png') }}" alt="">
            <div><strong>Global</strong><span>Media Presence</span></div>
        </div>
    </div>
</div>

<div class="wrap section media-featured-section" style="padding-top:0;">
    <div class="section-head media-section-head"><h2>Featured In</h2></div>
    <div class="logo-row media-logo-row">
        <img src="{{ asset('images/site/Media/logo/Forbes.png') }}" alt="Forbes">
        <img src="{{ asset('images/site/Media/logo/TheEconomicTimes.png') }}" alt="The Economic Times">
        <!-- <img src="{{ asset('images/site/Media/logo/YourStory.png') }}" alt="YourStory"> -->
        <img src="{{ asset('images/site/Media/logo/BWBusinessworld.png') }}" alt="BW Businessworld">
        <img src="{{ asset('images/site/Media/logo/SMEFutures.png') }}" alt="SME Futures">
        <!-- <img src="{{ asset('images/site/Media/logo/EntrepreneurIndia.png') }}" alt="Entrepreneur India"> -->
        <!-- <img src="{{ asset('images/site/Media/logo/FashionNetwork.png') }}" alt="Fashion Network"> -->
        <!-- <img src="{{ asset('images/site/Media/logo/Inc42.png') }}" alt="Inc42"> -->
    </div>
</div>

<hr class="wrap media-divider">

<div class="wrap section" style="padding-top:0;">
    <div class="section-head media-section-head"><h2>Latest Highlights</h2></div>
    @php
        $pressItems = [
            ['the_hindu.png', 'The Hindu', '1.jpg'],
            ['yahoo.png', 'Yahoo News', 'Yahoo-small.jpg'],
            ['the_asian_age.png', 'The Asian Age', '2.png'],
            ['financial_express.png', 'Financial Express', '3.jpg'],
            ['the_hindu.png', 'The Hindu', '4.jpg'],
            ['Business_standard.png', 'Business Standard', '5.png'],
            ['thenew_indianexpress_red.png', 'The New Indian Express', '6.jpg'],
            ['thenew_indianexpress_red.png', 'The New Indian Express', '7.jpg'],
            ['thenew_indianexpress_red.png', 'The New Indian Express', '8.jpg'],
            ['sme_world.png', 'SME World', '9.png'],
            ['deccan_herald.png', 'Deccan Herald', '11.png'],
            ['morning_standard.png', 'Morning Standard', '12.jpg'],
            ['the-times-of-india.png', 'The Times of India', '13.jpg'],
            ['the_sunday_guardian.png', 'The Sunday Guardian', '14.jpg'],
            ['the-news-of-india.png', 'The News of India', '1.svg'],
            ['financial_express.png', 'Financial Express', '2.svg'],
            ['smart_water_and_waste.png', 'Smart Water &amp; Waste', '3.svg'],
            ['financial_express.png', 'Financial Express', '4.svg'],
            ['press_trust_india.png', 'Press Trust of India', '5.svg'],
            ['fibre2fashion.png', 'Fibre2Fashion', 'Fashion.jpg'],
            ['CNBC-Logo-Square.png', 'CNBC', 'CNBC.png'],
            ['bloomberg-news.png', 'Bloomberg', 'Bloomberg.png'],
            ['outlook_media.png', 'Outlook Media', '2.jpg'],
            ['yourStory.png', 'YourStory', 'yourStory.png'],
            ['the_week.png', 'The Week', '3.jpg'],
            ['REPUBLIC.png', 'Republic', '33.jpg'],
            ['thenew_indianexpress_red.png', 'The New Indian Express', '5.jpg'],
            ['project_hatch.png', 'Project Hatch', 'Capture.jpg'],
            ['smart_water_and_waste.png', 'Smart Water &amp; Waste', '12-Capture.jpg'],
            ['thehindu_business_line.png', 'The Hindu Business Line', '88.jpg'],
            ['deccan_herald.png', 'Deccan Herald', '9-Capture.jpg'],
            ['thenew_indianexpress_red.png', 'The New Indian Express', '10-Capture.jpg'],
            ['txtile_value_chain.png', 'Textile Value Chain', '11-111.jpg'],
            ['the_sunday_guardian.png', 'The Sunday Guardian', 'Capture.jpg'],
            ['financial_express.png', 'Financial Express', '13-Capture.jpg'],
            ['the-news-of-india.png', 'The News of India', '14-Capture.jpg'],
            ['Rretailer.png', 'Retailer', '15-Capture.jpg'],
            ['smb_story.png', 'SMB Story', '16-Capture.jpg'],
            ['silicon_india.png', 'Silicon India', '17-17.jpg'],
            ['deccan_herald.png', 'Deccan Herald', '7-Capture.jpg'],
            ['thehindu_business_line.png', 'The Hindu Business Line', '8-Capture.jpg'],
            ['thenew_indianexpress_red.png', 'The New Indian Express', '21-21.jpg'],
            ['outlook_media.png', 'Outlook Media', '21-21.jpg'],
            ['Business_standard.png', 'Business Standard', '11-Capture.jpg'],
            ['rediffdotcom.png', 'Rediff', '11-Capture.jpg'],
            ['ciol.png', 'CIOL', '12-Capture.jpg'],
            ['franchiseindia.png', 'Franchise India', '13-Capture.jpg'],
            ['ENTREPENEUR.png', 'Entrepreneur', '14-Capture.jpg'],
            ['the-news-of-india.png', 'The News of India', '15-Capture.jpg'],
            ['financial_express.png', 'Financial Express', '16-Capture.jpg'],
            // New
            ['businessnewsthisweek_logo.png', 'Business News This Week', 'businessnewsthisweek.png','https://businessnewsthisweek.com/business/tally-msme-honours-2026-celebrates-the-entrepreneurs-shaping-indias-growth-story/'],
            ['Leap_To_Unicorn_logo.png', 'Leap To Unicorn', 'Leap_To_Unicorn.jpg'],
            ['et-logo.webp', 'The Economic Times', 'et.png','https://m.economictimes.com/small-biz/sme-sector/et-make-in-india-sme-summit-in-noida-highlights-the-citys-potential-as-a-key-manufacturing-hub/amp_articleshow/124869575.cms'],
            ['ap_logo.jpg', 'Apparel Resources', 'ap.png','https://apparelresources.com/business-news/retail/soq-playbook-start-ups-test-win-scale-fast/'],
            ['TecoyaTrend.png', 'Tecoya Trend', 'TecoyaTrend.png'],
            ['Moneymint.png', 'Money Mint', 'Moneymint.png','https://moneymint.com/how-moomaya-turned-spreadsheet-to-stitch-building-4m-fashion-empire/'],
            ['yourStory.png', 'Your Story', 'yourStory2.png','https://yourstory.com/2025/06/noida-startup-uses-tech-eliminate-fashion-waste'],
            ['ap_logo.jpg', 'Apparel Resources', 'ap2.png','https://apparelresources.com/technology-news/retail-tech/powered-ai-future-fashion/'],
            ['htsmartcast_logo.webp', 'HTSmartCast', 'htsmartcast.png','https://www.htsmartcast.com/business-podcasts/startup-beat-2/sustainability-meets-style-redefining-fashion-ft-moomaya-nitin-kapoor'],
            ['et-logo.webp', 'The Economic Times', 'et2.png','https://economictimes.indiatimes.com/small-biz/entrepreneurship/just-in-time-for-ultra-fast-fashion-how-a-noida-based-manufacturer-is-churning-out-clothes-on-demand/articleshow/112335968.cms'],
            ['ap_logo.jpg', 'Apparel Resources', 'ap3.png','https://apparelresources.com/technology-news/retail-tech/15-tech-gurus-reshaping-fashion-cutting-edge-solutions/'],
            ['f2f.png', 'Fibre 2 Fashion', 'f2f.png','https://www.fibre2fashion.com/interviews/industry-speak/moomaya/nitin-kapoor/13809/'],
            ['ap_logo.jpg', 'Apparel Resources', 'ap4.png','https://apparelresources.com/technology-news/manufacturing-tech/demand-manufacturing-zero-inventory-models-make-waves/'],
        ];
    @endphp
    <div class="press-grid">
        @foreach ($pressItems as $item)
        @php [$logo, $name, $clip] = $item; $link = $item[3] ?? null; @endphp
        <div class="press-card" data-clip="{{ asset('images/site/Media/Press/'.$clip) }}" data-name="{{ $name }}" @if($link) data-link="{{ $link }}" @endif>
            <img class="press-logo" src="{{ asset('images/site/Media/LogoMedia/'.$logo) }}" alt="{{ $name }}">
            <img class="press-clip" src="{{ asset('images/site/Media/Press/'.$clip) }}" alt="">
        </div>
        @endforeach
    </div>
</div>

<div class="press-modal" id="pressModal">
    <span class="press-modal-close" id="pressModalClose">&times;</span>
    <img id="pressModalImg" src="" alt="">
</div>

<div class="wrap" style="">
    <div class="subscribe-box">
        <img class="subscribe-icon" src="{{ asset('images/site/Media/StayUpdated.png') }}" alt="">
        <div style="">
            <h3 style="font-size:1.1rem; margin-bottom:4px;">Stay Updated</h3>
            <p style="color:var(--muted); font-size:.86rem; margin:0;">Get the latest updates, media features and industry insights straight to your inbox.</p>
            <form style="padding: 10px 0px;">
            <input type="email" placeholder="Enter your email address" >
            <button type="submit" class="btn btn-teal">Subscribe</button>
        </form>
        </div>
        
    </div>
</div>
@endsection

@push('page-scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('pressModal');
    var modalImg = document.getElementById('pressModalImg');
    var closeBtn = document.getElementById('pressModalClose');

    document.querySelectorAll('.press-card').forEach(function (card) {
        card.addEventListener('click', function () {
            if (card.dataset.link) {
                window.open(card.dataset.link, '_blank', 'noopener');
                return;
            }
            modalImg.src = card.dataset.clip;
            modalImg.alt = card.dataset.name || '';
            modal.classList.add('open');
        });
    });

    function closeModal() {
        modal.classList.remove('open');
        modalImg.src = '';
    }
    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });
});
</script>
@endpush
