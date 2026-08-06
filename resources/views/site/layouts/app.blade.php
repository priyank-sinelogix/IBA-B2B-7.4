<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sewgo') | Powered by IBA Crafts</title>
    <meta name="description" content="@yield('meta_description', 'Sewgo is a technology-powered Just In Time garment manufacturing platform.')">

    <link rel="icon" href="{{ asset('images/site/favicon_icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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

    <script src="{{ asset('js/site/main.js') }}"></script>
    @stack('page-scripts')
</body>
</html>
