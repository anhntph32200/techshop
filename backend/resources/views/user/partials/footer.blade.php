<footer class="site-footer footer-v1">
    <div class="col-full">
        <div class="before-footer-wrap">
            <div class="col-full">
                <!-- .footer-newsletter -->
                <div class="footer-social-icons">
                    <ul class="social-icons nav">
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="#">
                                <i class="fa fa-facebook"></i> Facebook</a>
                        </li>
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="#">
                                <i class="fa fa-twitter"></i> Twitter</a>
                        </li>
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="#">
                                <i class="fa fa-google-plus"></i> Google+</a>
                        </li>
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="#">
                                <i class="fa fa-vimeo-square"></i> Vimeo</a>
                        </li>
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="#">
                                <i class="fa fa-rss"></i> RSS</a>
                        </li>
                    </ul>
                </div>
                <!-- .footer-social-icons -->
            </div>
            <!-- .col-full -->
        </div>
        <!-- .before-footer-wrap -->
        <div class="footer-widgets-block">
            <div class="row">
                <div class="footer-contact">
                    <div class="footer-logo">
                        <img src="{{ asset('template2/assets/images/logo.png') }}" alt="">
                    </div>
                    <!-- .footer-logo -->
                    <div class="contact-payment-wrap">
                        <div class="footer-contact-info">
                            <div class="media">
                                <span class="media-left icon media-middle">
                                    <i class="tm tm-call-us-footer"></i>
                                </span>
                                <div class="media-body">
                                    <span class="call-us-title">Bạn có thắc mắc ? Hãy gọi cho chúng tôi 24/7!</span>
                                    <span class="call-us-text">(800) 8001-8588, (0600) 874 548</span>
                                    <address class="footer-contact-address">29 Hà Nội, Việt Nam</address>
                                    <a href="#" class="footer-address-map-link">
                                        <i class="tm tm-map-marker"></i>Tìm chúng tôi trên bản đồ</a>
                                </div>
                                <!-- .media-body -->
                            </div>
                            <!-- .media -->
                        </div>
                        <!-- .footer-contact-info -->
                        <div class="footer-payment-info">
                            <div class="media">
                                <span class="media-left icon media-middle">
                                    <i class="tm tm-safe-payments"></i>
                                </span>
                                <div class="media-body">
                                    <h5 class="footer-payment-info-title">Chúng tôi đang sử dụng phương thức thanh toán an toàn</h5>
                                    <div class="footer-payment-icons">
                                        <ul class="list-payment-icons nav">
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{ asset('template2/assets/images/credit-cards/mastercard.svg') }}" alt="mastercard" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{ asset('template2/assets/images/credit-cards/visa.svg') }}" alt="visa" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{ asset('template2/assets/images/credit-cards/paypal.svg') }}" alt="paypal" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{ asset('template2/assets/images/credit-cards/maestro.svg') }}" alt="maestro" />
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- .footer-payment-icons -->
                                    <div class="footer-secure-by-info">
                                        <h6 class="footer-secured-by-title">Được đảm bảo bởi:</h6>
                                        <ul class="footer-secured-by-icons">
                                            <li class="nav-item">
                                                <img class="secure-icons-image" src="{{ asset('template2/assets/images/secured-by/norton.svg') }}" alt="norton" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="secure-icons-image" src="{{ asset('template2/assets/images/secured-by/mcafee.svg') }}" alt="mcafee" />
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- .footer-secure-by-info -->
                                </div>
                                <!-- .media-body -->
                            </div>
                            <!-- .media -->
                        </div>
                        <!-- .footer-payment-info -->
                    </div>
                    <!-- .contact-payment-wrap -->
                </div>
                <!-- .footer-contact -->
                <div class="footer-widgets">
                    <div class="columns"></div>
                    <div class="columns">
                        <aside class="widget clearfix">
                            <div class="body">
                                <h4 class="widget-title">Tìm kiếm nhanh</h4>
                                <div class="menu-footer-menu-1-container">
                                    <ul id="menu-footer-menu-1" class="menu">
                                        @foreach ($categories as $category)
                                            @foreach ($category->subCategories as $subCategory)
                                                <li class="menu-item"><a href="{{ route('users.subcategories', $subCategory->id) }}">{{ $subCategory->name }}</a></li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- .menu-footer-menu-1-container -->
                            </div>
                            <!-- .body -->
                        </aside>
                        <!-- .widget -->
                    </div>
                    <!-- .columns -->
                    <div class="columns">
                        <aside class="widget clearfix">
                            <div class="body">
                                <h4 class="widget-title">Chăm sóc khách hàng</h4>
                                <div class="menu-footer-menu-3-container">
                                    <ul id="menu-footer-menu-3" class="menu">
                                        @if (Auth::check())
                                        <li class="menu-item">
                                            <a href="{{ route('user.profile') }}">Tài khoản của tôi</a>
                                        </li>
                                        @endif
                                        <li class="menu-item">
                                            <a href="{{ route('cart.myorder', ['status' => 'all'])}}">Lịch sử đơn hàng</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('users.filter') }}">Cửa hàng</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{ route('wishlist.index') }}">Danh sách yêu thích</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="about">Giới thiệu</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- .menu-footer-menu-3-container -->
                            </div>
                            <!-- .body -->
                        </aside>
                        <!-- .widget -->
                    </div>
                    <!-- .columns -->
                </div>
                <!-- .footer-widgets -->
            </div>
            <!-- .row -->
        </div>
        <!-- .footer-widgets-block -->
        <div class="site-info">
            <div class="col-full">
                <div class="copyright">DATN &copy; 2024 <a href="home-v1.html">TechShop</a> </div>
                <!-- .copyright -->
                <div class="credit">DATN Foly
                    <i class="fa fa-heart"></i></div>
                <!-- .credit -->
            </div>
            <!-- .col-full -->
        </div>
        <!-- .site-info -->
    </div>
    <!-- .col-full -->
</footer>