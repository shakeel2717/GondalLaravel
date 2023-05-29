<section class="footer-area padding-top-100px padding-bottom-30px">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 responsive-column">
                <div class="footer-item">
                    <div class="footer-logo padding-bottom-10px">
                        <a href="/" class="foot__logo"><img style="max-width: 200px;background:transparent" src="{{ asset('assets/img/logo.png') }}" alt="logo"></a>
                    </div>
                    <ul class="list-items pt-3">
                        <li><strong> {{ option('phone') }} </strong></li>
                        <li><strong><a href="mailto:{{ option('email') }}">{{ option('email') }}</a></strong></li>
                        <li><a href="#"><strong>Contact Us</strong></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-9 responsive-column">
                <ul class="foot_menu w-100">
                    <li class="footm">
                        <a href="company">Company <i class="la la-angle-down"></i></a>
                        <ul class="dropdown-menu-item">
                            <li><a href="/about-us">About Us</a>
                            </li>
                            <li><a href="/terms-of-use">Terms of Use</a>
                            </li>
                            <li><a href="/cookies-policy">Cookies policy</a>
                            </li>
                            <li><a href="/privacy-policy">Privacy Policy</a>
                            </li>
                        </ul>
                    </li>
                    <li class="footm">
                        <a href="supprt">Support <i class="la la-angle-down"></i></a>
                        <ul class="dropdown-menu-item">
                            <li><a href="/become-supplier">Become Supplier</a>
                            </li>
                            <li><a href="/faq">FAQ</a>
                            </li>
                            <li><a href="/booking-tips">Booking Tips</a>
                            </li>
                            <li><a href="/how-to-book">How to Book</a>
                            </li>
                        </ul>
                    </li>
                    <li class="footm">
                        <a href="services">Services <i class="la la-angle-down"></i></a>
                        <ul class="dropdown-menu-item">
                            <li><a href="/file-a-claim">File a claim</a>
                            </li>
                            <li><a href="/offers">Last minute deals</a>
                            </li>
                            <li><a href="/signup-supplier">Add your business</a>
                            </li>
                            <li><a href="/careers">Careers and Jobs</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="term-box footer-item">
                    <ul class="list-items list--items d-flex align-items-center">
                        All Rights Reserved by All Rights Reserved by {{ env('APP_NAME') }} </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-social-box text-right">
                    <ul class="social-profile">
                        <li><a href="https://www.facebook.com/phptravels" target="_blank"><i class="lab la-facebook"></i></a></li>
                        <li><a href="https://twitter.com/phptravels" target="_blank"><i class="lab la-twitter"></i></a></li>
                        <li><a href="https://www.youtube.com/c/PhptravelsOfficial" target="_blank"><i class="lab la-youtube"></i></a></li>
                        <li><a href="https://wa.me/123456789" target="_blank"><i class="lab la-whatsapp"></i></a></li>
                        <li><a href="https://www.instagram.com/phptravels_/" target="_blank"><i class="lab la-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section-block mt-4"></div>
</section>