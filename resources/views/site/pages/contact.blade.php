@extends('site.layouts.app')
@section('title', 'Contact')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/site/contact.css') }}">
@endpush

@section('content')
<section class="wrap contact-hero">
    <div class="contact-hero-inner">
        <div class="eyebrow" style="text-align:center;">Get In Touch</div>
        <h1>Let's Build Something Together</h1>
        <p>Have a question about JIT manufacturing, pricing, or partnering with Sewgo? Fill out the form below and our team will get back to you within 24 hours.</p>
        <div class="contact-hero-stats">
            <div class="chs-item"><i class="far fa-clock"></i><span>24H Response Time</span></div>
            <div class="chs-item"><i class="fas fa-users"></i><span>1000+ Brands Trust Us</span></div>
            <div class="chs-item"><i class="fas fa-globe"></i><span>Support in 40+ Countries</span></div>
        </div>
    </div>
</section>

<div class="wrap section">
    <div class="contact-row">
        <div class="contact-info">
            <div class="eyebrow" style="color:#6fe0c0;">Contact Information</div>
            <h2>We'd Love to Hear From You</h2>
            <p>Reach out directly or fill the form — whichever works best for you.</p>
            <ul class="contact-info-list">
                <li><i class="far fa-envelope"></i><div><strong>Email</strong><span>hello@sewgo.com</span></div></li>
                <li><i class="fas fa-phone"></i><div><strong>Phone</strong><span>+91 95138 88875</span></div></li>
                <li><i class="fas fa-location-dot"></i><div><strong>Office</strong><span>IBA Crafts Pvt. Ltd., Tiruppur, Tamil Nadu, India</span></div></li>
                <li><i class="far fa-clock"></i><div><strong>Working Hours</strong><span>Mon – Sat, 9:00 AM – 6:00 PM IST</span></div></li>
            </ul>
            <div class="contact-info-divider"></div>
            <div class="contact-info-social">
                <span>Follow Us</span>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

        <div class="contact-form-card">
            <h3>Send Us a Message</h3>
            <p class="contact-form-sub">Fill in your details and our team will reach out shortly.</p>
            @if (session('success'))
                <div class="alert-success"><i class="fas fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ url('/contact') }}">
                @csrf
                <div class="form-row">
                    <div class="field"><label>First Name</label><input type="text" name="first_name" value="{{ old('first_name') }}" required></div>
                    <div class="field"><label>Last Name</label><input type="text" name="last_name" value="{{ old('last_name') }}" required></div>
                </div>
                <div class="field"><label>Work Email</label><input type="email" name="work_email" value="{{ old('work_email') }}" required></div>
                <div class="form-row">
                    <div class="field" style="flex:2;"><label>Phone</label><input type="tel" name="phone" value="{{ old('phone') }}"></div>
                    <div class="field" style="flex:1;"><label>Ext</label><input type="text" name="ext" value="{{ old('ext') }}"></div>
                </div>
                <div class="form-row">
                    <div class="field"><label>Company</label><input type="text" name="company" value="{{ old('company') }}" required></div>
                    <div class="field"><label>Website URL</label><input type="url" name="website" value="{{ old('website') }}" placeholder="https://"></div>
                </div>
                <div class="field">
                    <label>Company Size</label>
                    <select name="company_size">
                        <option value="">Select</option>
                        <option value="2-5">2 – 5</option>
                        <option value="6-10">6 – 10</option>
                        <option value="11-50">11 – 50</option>
                        <option value="51+">51+</option>
                    </select>
                </div>
                <div class="field"><label>Tell us about your needs</label><textarea name="message" rows="4" placeholder="Share a bit about your brand and what you're looking for...">{{ old('message') }}</textarea></div>
                <div class="field">
                    <label>How did you hear about us?</label>
                    <select name="learned_from">
                        <option value="">Select</option>
                        <option>Google Search</option>
                        <option>Social Media</option>
                        <option>Referral</option>
                        <option>Event / Trade Show</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="contact-form-actions">
                    <button type="submit" class="btn btn-teal"><i class="fas fa-paper-plane"></i> Submit</button>
                    <a href="https://calendar.app.google/qgyUmtXeovdwHFUB6" class="btn btn-outline-navy"><i class="far fa-calendar"></i> Book a Meeting</a>
                
                    
                    
                </div>
                <div class="contact-form-actions">
                    <p>We keep any info you share with us private and confidential.For more on how we process and protect data,please review IBA Crafts's Privacy Policy</p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
