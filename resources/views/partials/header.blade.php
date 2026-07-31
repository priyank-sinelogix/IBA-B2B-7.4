<header class="site-header" id="siteHeader">

    <div class="container">

        <div class="header-wrapper">

            <!-- Logo -->

            <div class="logo">

                <a href="{{ url('/') }}">

                    <img src="{{ asset('assets/images/logo.png') }}"
                         alt="Sewgo">

                </a>

            </div>

            <!-- Desktop Menu -->

            <nav class="desktop-menu">

                <ul>

                    <li>

                        <a href="{{ url('/') }}"
                           class="{{ Request::is('/') ? 'active' : '' }}">

                            Home

                        </a>

                    </li>

                    <li>

                        <a href="{{ url('/how-jit-works') }}"
                           class="{{ Request::is('how-jit-works') ? 'active' : '' }}">

                            How JIT Works

                        </a>

                    </li>

                    <li>

                        <a href="{{ url('/services') }}"
                           class="{{ Request::is('services') ? 'active' : '' }}">

                            Services

                        </a>

                    </li>

                    <li>

                        <a href="{{ url('/design-library') }}"
                           class="{{ Request::is('design-library') ? 'active' : '' }}">

                            Design Library

                        </a>

                    </li>

                    <li>

                        <a href="{{ url('/about') }}"
                           class="{{ Request::is('about') ? 'active' : '' }}">

                            About

                        </a>

                    </li>

                    <li>

                        <a href="{{ url('/media') }}"
                           class="{{ Request::is('media') ? 'active' : '' }}">

                            Media

                        </a>

                    </li>

                    <li>

                        <a href="{{ url('/contact') }}"
                           class="{{ Request::is('contact') ? 'active' : '' }}">

                            Contact

                        </a>

                    </li>

                </ul>

            </nav>

            <!-- Right Side -->

            <div class="header-right">

                <a href="{{ url('/contact') }}"
                   class="quote-btn">

                    Request a Quote

                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>

            <!-- Mobile Toggle -->

            <button id="menuToggle"
                    class="menu-toggle">

                <i class="fas fa-bars"></i>

            </button>

        </div>

    </div>

</header>

<div id="mobileMenu"
     class="mobile-menu">

    <ul>

        <li>

            <a href="{{ url('/') }}">

                Home

            </a>

        </li>

        <li>

            <a href="{{ url('/how-jit-works') }}">

                How JIT Works

            </a>

        </li>

        <li>

            <a href="{{ url('/services') }}">

                Services

            </a>

        </li>

        <li>

            <a href="{{ url('/design-library') }}">

                Design Library

            </a>

        </li>

        <li>

            <a href="{{ url('/about') }}">

                About

            </a>

        </li>

        <li>

            <a href="{{ url('/media') }}">

                Media

            </a>

        </li>

        <li>

            <a href="{{ url('/contact') }}">

                Contact

            </a>

        </li>

        <li>

            <a class="mobile-btn"
               href="{{ url('/contact') }}">

                Request a Quote

            </a>

        </li>

    </ul>

</div>