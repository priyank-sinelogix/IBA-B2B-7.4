<header class="site-nav wrap">
    <a href="{{ url('/site') }}" class="brand">
        <img src="{{ asset('images/site/logo.jpg') }}" alt="Sewgo" class="logo">
    </a>

    <button class="nav-toggle" id="navToggle"><i class="fas fa-bars"></i></button>

    <ul class="nav-links" id="navLinks">
        <li><a href="{{ url('/site') }}" class="{{ request()->is('site') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ url('/site/how-jit-works') }}" class="{{ request()->is('site/how-jit-works') ? 'active' : '' }}">How JIT Works</a></li>
        <li><a href="{{ url('/site/services') }}" class="{{ request()->is('site/services') ? 'active' : '' }}">Services</a></li>
        <li><a href="{{ url('/site/who-we-help') }}" class="{{ request()->is('site/who-we-help') ? 'active' : '' }}">Who We Help</a></li>
        <li><a href="{{ url('/site/about') }}" class="{{ request()->is('site/about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ url('/site/media') }}" class="{{ request()->is('site/media') ? 'active' : '' }}">Media</a></li>
        <li><a href="{{ url('/site/contact') }}" class="{{ request()->is('site/contact') ? 'active' : '' }}">Contact</a></li>
        <li class="nav-cta"><a href="{{ url('/site/contact') }}" class="btn btn-teal"><i class="fas fa-file-alt"></i> Request a Quote</a></li>
    </ul>
</header>
