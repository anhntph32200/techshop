@extends('user.layout')

@section('content')

    <body class="woocommerce-active page-template-template-homepage-v4 can-uppercase">
        <div id="page" class="hfeed site">

            @include('user.partials.header')

            @include('user.partials.menu')

            <!-- .header-v2 -->
            <!-- ============================================================= Header End ============================================================= -->
            <div id="content" class="site-content">
                <div class="col-full">
                    <div class="row">
                        <nav class="woocommerce-breadcrumb">
                            <a href="home-v1.html">Trang chủ</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>
                            Chính sách bảo mật và điều khoản
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <header class="entry-header">
                                        <div class="page-header-caption">
                                            <h1 class="entry-title">Chính sách bảo mật và điều khoản</h1>
                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <section class="section terms-conditions">
                                            <h2>1. Giới thiệu</h2>
                                            <p>Chào mừng bạn đến với website của chúng tôi. Khi bạn sử dụng dịch vụ của
                                                chúng tôi, bạn đồng ý tuân thủ các điều khoản và điều kiện dưới đây.</p>

                                            <h2>2. Quyền và Nghĩa Vụ của Người Dùng</h2>
                                            <p>Người dùng có trách nhiệm sử dụng dịch vụ một cách hợp pháp, tuân thủ các quy
                                                định về bản quyền và không xâm phạm quyền lợi của các bên khác.</p>

                                            <h2>3. Quyền Sở Hữu Trí Tuệ</h2>
                                            <p>Tất cả các tài liệu, hình ảnh, logo, và nội dung trên website này thuộc quyền
                                                sở hữu của chúng tôi hoặc các đối tác liên kết và được bảo vệ bởi luật bản
                                                quyền.</p>

                                            <h2>4. Giới Hạn Trách Nhiệm</h2>
                                            <p>Chúng tôi không chịu trách nhiệm đối với bất kỳ thiệt hại nào phát sinh từ
                                                việc sử dụng hoặc không thể sử dụng dịch vụ của chúng tôi.</p>

                                            <h2>5. Thay Đổi Dịch Vụ</h2>
                                            <p>Chúng tôi có quyền thay đổi hoặc ngừng cung cấp dịch vụ mà không cần thông
                                                báo trước.</p>

                                            <h2>6. Giải Quyết Tranh Chấp</h2>
                                            <p>Mọi tranh chấp phát sinh sẽ được giải quyết theo pháp luật của Việt Nam và
                                                tại Tòa án có thẩm quyền tại Hà Nội.</p>

                                            <h2>7. Chính Sách Bảo Mật</h2>
                                            <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn và chỉ sử dụng chúng theo
                                                chính sách bảo mật của chúng tôi.</p>
                                        </section>
                                        <!-- .terms-conditions -->
                                    </div>
                                    <!-- .entry-content -->
                                </div>
                                <!-- .hentry -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                    </div>
                    <!-- .row -->
                </div>
                <!-- .col-full -->
            </div>
            <!-- #content -->

            @include('user.partials.footer')

            <!-- .site-footer -->
        </div>

        @include('user.partials.js')

    </body>
@endsection