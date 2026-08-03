<footer class="site-footer site-footer-simple">
    <div class="wrap">
        <div class="footer-grid-simple">
            <div>
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="{{ url('/site') }}">Home</a></li>
                    <li><a href="{{ url('/site/services') }}">Services</a></li>
                    <li><a href="{{ url('/site/who-we-help') }}">Catalog</a></li>
                    <li><a href="{{ url('/site/about') }}">About</a></li>
                    <li><a href="{{ url('/site/contact') }}">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4>Services</h4>
                <ul>
                    <li><a href="{{ url('/site/services') }}">Collaborative Designs</a></li>
                    <li><a href="{{ url('/site/services') }}">Logistics Assistance</a></li>
                    <li><a href="{{ url('/site/services') }}">Just In Time Manufacturing</a></li>
                    <li><a href="{{ url('/site/services') }}">Cataloging</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact Us</h4>
                <ul>
                    <li>India – IBA Crafts Pvt. Ltd.</li>
                    <li>E-17, Sector - 11, Noida,<br>Uttar Pradesh - 201301, India</li>
                    <li><a href="mailto:info@sewgo.com"><i class="far fa-envelope"></i> info@sewgo.com</a></li>
                    <li><a href="https://sewgo.com"><i class="fas fa-globe"></i> www.sewgo.com</a></li>
                </ul>
            </div>
        </div>

        
    </div>
    <!-- <div class="footer-bottom-simple">
        <img src="{{ asset('images/site/logo.jpg') }}" alt="Sewgo" class="logo">
        <span>&copy; {{ date('Y') }} Sewgo. All Rights Reserved.</span>
        <div class="footer-social">
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div> -->

    <div class="footer-bottom-simple">
        <div class="footer-bottom-item footer-left">
            <img src="{{ asset('images/site/logo.jpg') }}" alt="Sewgo" class="logo">
        </div>

        <div class="footer-bottom-item footer-center">
            <span>&copy; {{ date('Y') }} Sewgo. All Rights Reserved.</span>
        </div>

        <div class="footer-bottom-item footer-right">
            <div class="footer-social">
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>
