<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (config('services.ga4.measurement_id'))
        {{-- Google Analytics 4 — measurement ID is set via GA4_MEASUREMENT_ID in .env so it
             never fires against real GA4 property data from local/staging environments. --}}
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga4.measurement_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('services.ga4.measurement_id') }}');
        </script>
    @endif

    <meta name="google-site-verification" content="nFKh_2oBjemz-Ry49w4ckm-KT_JznNss0afdJ5zqmIo" />
    <title>
        @hasSection('full_title')
            @yield('full_title')
        @else
            @yield('title', 'Sewgo') | Powered by IBA Crafts
        @endif
    </title>
    <meta name="description" content="@yield('meta_description', 'Sewgo is a technology-powered Just In Time garment manufacturing platform.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="https://sewgo.io{{ request()->getPathInfo() }}">

    @php
        $__decodeYield = function ($section, $default = '') use ($__env) {
            return trim(html_entity_decode(strip_tags($__env->yieldContent($section, $default)), ENT_QUOTES, 'UTF-8'));
        };
        $__pageTitle = $__decodeYield('title', 'Sewgo');
        $__fullTitle = $__decodeYield('full_title', $__pageTitle.' | Powered by IBA Crafts');
        $__metaDescription = $__decodeYield('meta_description', 'Sewgo is a technology-powered Just In Time garment manufacturing platform.');
        $__canonicalUrl = 'https://sewgo.io'.request()->getPathInfo();
        $__serviceName = $__decodeYield('service_name', '');

        // Open Graph / Twitter Card image: pages with a hero banner set their own
        // via @section('og_image', 'images/site/...'); everything else falls back
        // to the home hero so every shared link still gets a real image preview.
        $__ogImagePath = ltrim($__decodeYield('og_image', 'images/site/home-hero.jpg'), '/');
        $__ogImageUrl = 'https://sewgo.io/'.$__ogImagePath;
        $__ogImageDims = @getimagesize(public_path($__ogImagePath));

        $__schemas = [];

        // Organization — Sewgo's manufacturing business identity. Schema.org has
        // no distinct "Manufacturer" type; Organization is the correct type for a
        // manufacturing business (the "manufacturer" role is normally expressed as
        // a property on a Product, which doesn't apply to this service-led site).
        $__schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'Sewgo',
            'legalName' => 'IBA Crafts Pvt. Ltd.',
            'url' => 'https://sewgo.io',
            'logo' => 'https://sewgo.io/images/site/logo.png',
            'description' => 'Sewgo is a technology-powered Just-in-Time garment manufacturing platform powered by IBA Crafts, enabling fashion brands to manufacture on demand from MOQ 1.',
            'email' => 'hello@sewgo.io',
            'telephone' => '+91-95825-57282',
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Noida',
                'addressRegion' => 'Uttar Pradesh',
                'addressCountry' => 'IN',
            ],
        ];

        $__schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'Sewgo',
            'url' => 'https://sewgo.io',
            'publisher' => ['@type' => 'Organization', 'name' => 'Sewgo'],
        ];

        $__schemas[] = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $__fullTitle,
            'description' => $__metaDescription,
            'url' => $__canonicalUrl,
            'isPartOf' => ['@type' => 'WebSite', 'url' => 'https://sewgo.io'],
        ];

        if (request()->getPathInfo() !== '/') {
            $__schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'BreadcrumbList',
                'itemListElement' => [
                    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => 'https://sewgo.io/'],
                    ['@type' => 'ListItem', 'position' => 2, 'name' => $__pageTitle, 'item' => $__canonicalUrl],
                ],
            ];
        }

        if ($__serviceName !== '') {
            $__schemas[] = [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'serviceType' => $__serviceName,
                'name' => $__serviceName,
                'description' => $__metaDescription,
                'url' => $__canonicalUrl,
                'provider' => [
                    '@type' => 'Organization',
                    'name' => 'Sewgo',
                    'url' => 'https://sewgo.io',
                ],
                'areaServed' => 'Worldwide',
            ];
        }
    @endphp
    @foreach ($__schemas as $__schema)
        <script type="application/ld+json">{!! json_encode($__schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    @endforeach
    @stack('schema')

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Sewgo">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="{{ $__fullTitle }}">
    <meta property="og:description" content="{{ $__metaDescription }}">
    <meta property="og:url" content="{{ $__canonicalUrl }}">
    <meta property="og:image" content="{{ $__ogImageUrl }}">
    @if ($__ogImageDims)
    <meta property="og:image:width" content="{{ $__ogImageDims[0] }}">
    <meta property="og:image:height" content="{{ $__ogImageDims[1] }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $__fullTitle }}">
    <meta name="twitter:description" content="{{ $__metaDescription }}">
    <meta name="twitter:image" content="{{ $__ogImageUrl }}">

    <link rel="icon" href="{{ asset('images/site/favicon_icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/site/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site/footer.css') }}">
    @stack('page-styles')
</head>
<body>

    @include('site.partials.header')

    @yield('content')

    @section('footer')
        @include('site.partials.footer-simple')
    @show

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/site/main.js') }}"></script>
    @stack('page-scripts')
</body>
</html>
