<footer class="site-footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-brand">
                <img src="{{ asset('images/site/logo.jpg') }}" alt="Sewgo" class="logo">
                <p>Sewgo is a technology-powered Just In Time garment manufacturing platform that helps fashion brands produce only what sells — faster, smarter and better for the planet.</p>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div>
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/how-jit-works') }}">How JIT Works</a></li>
                    <li><a href="{{ url('/who-we-help') }}">Who We Help</a></li>
                    <li><a href="{{ url('/sustainability') }}">Sustainability</a></li>
                    <li><a href="{{ url('/awards') }}">Awards &amp; Recognitions</a></li>
                </ul>
            </div>
            <div>
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ url('/services') }}">JIT Manufacturing</a></li>
                    <li><a href="{{ url('/services') }}">Product Development</a></li>
                    <li><a href="{{ url('/services') }}">Cut &amp; Sew Manufacturing</a></li>
                    <li><a href="{{ url('/services') }}">Logistics Support</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact</h4>
                <ul>
                    <li><a href="mailto:hello@sewgo.com">hello@sewgo.com</a></li>
                    <li><a href="tel:+919513888875">+91 95138 88875</a></li>
                    <li>IBA Crafts Pvt. Ltd.<br>Tiruppur, Tamil Nadu, India</li>
                </ul>
            </div>
        </div>
        
    </div>
    <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} Sewgo. All rights reserved.</span>
            <span>Secure &amp; Confidential · No Obligation · Quick Response · Expert Support</span>
        </div>
</footer>
