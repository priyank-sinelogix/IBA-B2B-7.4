<header class="site-nav wrap">
    <a href="{{ url('/') }}" class="brand">
        <img src="{{ asset('images/site/logo.png') }}" alt="Sewgo" class="logo">
    </a>

    <button class="nav-toggle" id="navToggle"><i class="fas fa-bars"></i></button>

    <ul class="nav-links" id="navLinks">
        <li><a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ url('/how-jit-works') }}" class="{{ request()->is('how-jit-works') ? 'active' : '' }}">How JIT Works</a></li>
        <li><a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About</a></li>
        <li><a href="{{ url('/services') }}" class="{{ request()->is('services') ? 'active' : '' }}">Services</a></li>
        <li><a href="{{ url('/sustainability') }}" class="{{ request()->is('sustainability') ? 'active' : '' }}">Sustainability</a></li>
        <li><a href="{{ url('/awards') }}" class="{{ request()->is('awards') ? 'active' : '' }}">Awards</a></li>
        <li><a href="{{ url('/media') }}" class="{{ request()->is('media') ? 'active' : '' }}">Media</a></li>
        <li><a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a></li>
        <li><a href="{{ url('/login') }}" class="{{ request()->is('partner-login') ? 'active' : '' }}">Partner Login</a></li>

        <li class="nav-cta">
            <a href="{{ url('/contact') }}" class="btn btn-teal">
                <i class="fas fa-user-tie"></i> Request a Quote
            </a>
        </li>
    </ul>
</header>
