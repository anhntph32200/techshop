@extends('user.layout')

@section('content')

    <body class="page home page-template-default">
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
                            Giới thiệu
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <header class="entry-header">
                                        <h1>Chào Mừng Đến Với Techshop</h1>
                                        <h4>Khám phá công nghệ - Tận hưởng giá trị</h4>
                                        <div class="page-featured-image">
                                            <img width="1920" height="1391" alt=""
                                                class="attachment-full size-full wp-post-image"
                                                src="https://png.pngtree.com/thumb_back/fw800/background/20210902/pngtree-smart-technology-light-hd-background-image_784060.jpg">
                                        </div>
                                    </header>
                                    <!-- .entry-header -->
                                    <div class="entry-content">
                                        <div class="page-header-caption">
                                            <h2 class="entry-title">Về Chúng Tôi</h2>
                                            <p>Techshop là một trong những nền tảng thương mại điện tử hàng đầu chuyên
                                                cung cấp các sản phẩm thiết bị điện tử chính hãng. Với sứ mệnh mang công
                                                nghệ gần gũi hơn với mọi người, chúng tôi không ngừng nỗ lực để mang đến cho
                                                bạn những sản phẩm chất lượng nhất với giá cả cạnh tranh.</p>

                                            <p>Ra đời từ năm 2024, Techshop đã trở thành địa chỉ đáng tin
                                                cậy của hàng nghìn khách hàng trên toàn quốc. Chúng tôi tự hào là đối tác
                                                của các thương hiệu công nghệ uy tín như Apple, Samsung, Sony, Dell, HP, và
                                                nhiều hãng khác.</p>
                                        </div>
                                        {{-- <div class="about-features row">
                                        <div class="col-md-4">
                                            <div class="single-image">
                                                <img alt="" class="" src="assets/images/products/3column1.jpg">
                                            </div>
                                            <!-- .single_image -->
                                            <div class="text-block">
                                                <h2 class="align-top">What we really do?</h2>
                                                <p>Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque,dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                                            </div>
                                            <!-- .text_block -->
                                        </div>
                                        <!-- .col -->
                                        <div class="col-md-4">
                                            <div class="single-image">
                                                <img alt="" class="" src="assets/images/products/3column2.jpg">
                                            </div>
                                            <!-- .single_image -->
                                            <div class="text-block">
                                                <h2 class="align-top">Our Vision</h2>
                                                <p>Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque,dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                                            </div>
                                            <!-- .text_block -->
                                        </div>
                                        <!-- .col -->
                                        <div class="col-md-4">
                                            <div class="single-image">
                                                <img alt="" class="" src="assets/images/products/3column2.jpg">
                                            </div>
                                            <!-- .single_image -->
                                            <div class="text-block">
                                                <h2 class="align-top">History of Beginning</h2>
                                                <p>Donec libero dolor, tincidunt id laoreet vitae,ullamcorper eu tortor. Maecenas pellentesque,dui vitae iaculis mattis, tortor nisi faucibus magna,vitae ultrices lacus purus vitae metus.</p>
                                            </div>
                                            <!-- .text_block -->
                                        </div>
                                        <!-- .col -->
                                    </div> --}}
                                        <!-- .about-features -->
                                        <div class="light-bg team-member-wrapper">
                                            <div class="col-full">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="team-member">
                                                            <div class="profile">
                                                                <h1>HP</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-2">
                                                        <div class="team-member">
                                                            <div class="profile">
                                                                <h1>DELL</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-2">
                                                        <div class="team-member">
                                                            <div class="profile">
                                                                <h1>APPLE</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-2">
                                                        <div class="team-member">
                                                            <div class="profile">
                                                                <h1>ASUS</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-2">
                                                        <div class="team-member">
                                                            <div class="profile">
                                                                <h1>LENOVO</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-2">
                                                        <div class="team-member">
                                                            <div class="profile">
                                                                <h1>ACER</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .col -->
                                                </div>
                                                <!-- .row -->
                                            </div>
                                            <!-- .container -->
                                        </div>
                                        <!-- .team-member-wrapper -->
                                        <div class="row accordion-block">
                                            <div class="text-boxes col-sm-7">
                                                <div class="row first-row">
                                                    <div class="col-sm-6">
                                                        <div class="text-block">
                                                            <h3 class="highlight">Sứ Mệnh Của Chúng Tôi</h3>
                                                            <p>Chúng tôi không chỉ bán sản phẩm mà còn mang đến giải pháp
                                                                công nghệ toàn diện cho khách hàng. Sứ mệnh của chúng tôi
                                                                là:</p>
                                                            <ul>
                                                                <li>Giúp khách hàng tiếp cận công nghệ hiện đại một cách dễ
                                                                    dàng.</li>
                                                                <li>Đảm bảo sự hài lòng tuyệt đối trong từng trải nghiệm mua
                                                                    sắm.</li>
                                                                <li>Đóng góp vào việc nâng cao chất lượng cuộc sống qua công
                                                                    nghệ.</li>
                                                            </ul>
                                                        </div>
                                                        <!-- .text-block -->
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-6">
                                                        <div class="text-block">
                                                            <h3 class="highlight">Điều Gì Khiến Chúng Tôi Khác Biệt?</h3>
                                                            <p>Chúng tôi không chỉ là một trang web thương mại điện tử, mà
                                                                còn là nơi bạn có thể:</p>
                                                            <ul>
                                                                <li><strong>Khám phá sản phẩm đa dạng:</strong> Từ
                                                                    smartphone, laptop, phụ kiện điện tử đến thiết bị thông
                                                                    minh.</li>
                                                                <li><strong>Nhận giá trị vượt trội:</strong> Cam kết chính
                                                                    hãng, bảo hành nhanh chóng, và nhiều ưu đãi hấp dẫn.
                                                                </li>
                                                                <li><strong>Hỗ trợ tận tình:</strong> Đội ngũ tư vấn chuyên
                                                                    nghiệp luôn sẵn sàng giải đáp thắc mắc của bạn.</li>
                                                                <li><strong>Giao hàng toàn quốc:</strong> Nhanh chóng, an
                                                                    toàn và tiện lợi.</li>
                                                            </ul>
                                                        </div>
                                                        <!-- .text-block -->
                                                    </div>
                                                    <!-- .col -->
                                                </div>
                                                <!-- .row -->
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="text-block">
                                                            <h3 class="highlight">Cam Kết Của Chúng Tôi</h3>
                                                            <p>Với phương châm <strong>"Uy tín làm nên thương
                                                                    hiệu"</strong>, chúng tôi cam kết:</p>
                                                            <ul>
                                                                <li>Chỉ cung cấp các sản phẩm chính hãng, đạt tiêu chuẩn
                                                                    cao.</li>
                                                                <li>Chính sách đổi trả minh bạch, bảo vệ quyền lợi khách
                                                                    hàng.</li>
                                                                <li>Luôn cập nhật các xu hướng công nghệ mới nhất.</li>
                                                            </ul>
                                                        </div>
                                                        <!-- .text-block -->
                                                    </div>
                                                    <!-- .col -->
                                                    <div class="col-sm-6">
                                                        <div class="text-block">
                                                            <h3 class="highlight">Đội Ngũ Của Chúng Tôi</h3>
                                                            <p>Techshop sở hữu một đội ngũ trẻ trung, năng động và đầy nhiệt
                                                                huyết. Với nền tảng kiến thức vững chắc và niềm đam mê công
                                                                nghệ, chúng tôi luôn sẵn sàng mang đến những giá trị tốt
                                                                nhất cho khách hàng.</p>
                                                        </div>
                                                        <!-- .text-block -->
                                                    </div>
                                                    <!-- .col -->
                                                </div>
                                                <!-- .row -->
                                            </div>
                                            <!-- .text-boxes -->
                                            <div class="about-accordion col-sm-5">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <h3 class="about-accordion-title">Liên Hệ Với Chúng Tôi</h3>
                                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                                            <div class="card">
                                                                <p>Hãy để chúng tôi đồng hành cùng bạn trong hành trình khám
                                                                    phá công nghệ. Đừng ngần ngại liên hệ nếu bạn cần hỗ
                                                                    trợ:</p>
                                                                <p><strong>Email:</strong> techshop014@gmail.com</p>
                                                                <p><strong>Hotline:</strong> 1900-xxxx</p>
                                                                <p><strong>Địa chỉ:</strong> Trường Cao đẳng FPT
                                                                    Polytechnic, phố Trịnh Văn Bô, phường Phương Canh, quận
                                                                    Nam Từ Liêm, TP Hà Nội.</p>
                                                                <!-- .collapse -->
                                                            </div>
                                                            <!-- .card -->
                                                            <div class="card">
                                                                <p>Bạn cũng có thể theo dõi chúng tôi trên mạng xã hội:</p>
                                                                <p>
                                                                    <a href="#">Facebook</a> |
                                                                    <a href="#">Instagram</a> |
                                                                    <a href="#">YouTube</a>
                                                                </p>
                                                                <!-- .collapse -->
                                                            </div>
                                                            <!-- .card -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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