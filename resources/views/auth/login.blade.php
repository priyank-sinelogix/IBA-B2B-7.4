@extends('site.layouts.app')
@section('title', 'Partner Login')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/partner-login.css') }}">
@endpush

@section('content')

<div class="login-hero">
    <img class="hero-banner-img" src="{{ asset('images/site/banner3.png') }}" alt="Sewgo Partner Login">
    <div class="login-hero-content">
        <h1>Partner Login</h1>
        <p>Access your dashboard to manage orders, track production, view updates and more.</p>
    </div>
</div>

<div class="login-card-wrap">
    <div class="login-card">
        <h2>Welcome Back!</h2>
        <p class="sub">Log in to your partner account</p>

        @if ($errors->any())
            <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div class="field">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="field">
                <label>Password</label>
                <div class="input-wrap">
                    <input type="password" name="password" id="pwInput" placeholder="Enter your password" required>
                    <button type="button" class="toggle-pw" onclick="const i=document.getElementById('pwInput'); i.type = i.type==='password' ? 'text' : 'password';">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="field-row">
                <label class="remember"><input type="checkbox" name="remember"> Remember me</label>
                <a href="{{ url('/password/reset') }}">Forgot Password?</a>
            </div>
            <button type="submit" class="btn-login">Log In</button>
        </form>

        <p class="signup-note">New Partner? <a href="{{ url('/site/contact') }}">Request Access</a></p>
        <p class="staff-note"><a href="{{ url('/admin/login') }}">IBA Team Member? Staff Login →</a></p>
    </div>
</div>

<section class="why-section wrap">
    <h2>Why Partner with Sewgo?</h2>
    <div class="why-grid">
        <div class="why-item">
            <div class="icon-circle">
                <img src="{{ asset('images/site/real_time_order_tracking.png') }}" alt="Real-time Order Tracking">
            </div>
            <h4>Real-time Order Tracking</h4>
            <p>Track every step of your production in real time.</p>
        </div>
        <div class="why-item">
            <div class="icon-circle">
                <img src="{{ asset('images/site/transparent_communication.png') }}" alt="Transparent Communication">
            </div>
            <h4>Transparent Communication</h4>
            <p>Stay connected with dedicated support.</p>
        </div>
        <div class="why-item">
            <div class="icon-circle">
                <img src="{{ asset('images/site/secure_reliable_platform.png') }}" alt="Secure & Reliable Platform">
            </div>
            <h4>Secure &amp; Reliable Platform</h4>
            <p>Your data and business are always safe with us.</p>
        </div>
        <div class="why-item">
            <div class="icon-circle">
                <img src="{{ asset('images/site/reports_analytics.png') }}" alt="Reports & Analytics">
            </div>
            <h4>Reports &amp; Analytics</h4>
            <p>Get actionable insights to grow your brand.</p>
        </div>
    </div>
</section>

<div class="cta-band">
    <div class="wrap">
        <div class="cta-content">
            <img src="{{ asset('images/site/hand.png') }}" class="handshake-img" alt="Handshake">

            <div>
                <h3>Not a Partner Yet?</h3>
                <p>Join leading fashion brands who trust Sewgo for their manufacturing needs.</p>

                <a href="{{ url('/site/contact') }}" class="cta-band-btn">
                    Partner With Us
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
    @include('site.partials.footer-simple')
@endsection
