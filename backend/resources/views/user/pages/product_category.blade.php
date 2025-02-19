@extends('user.layout')

@section('content')
    <style>
        .wc-layered-nav-term {
            display: flex;
            align-items: center;
            margin: 10px 0;
            /* Khoảng cách giữa các item */
            cursor: pointer;
            /* Con trỏ khi hover */
        }

        .wc-layered-nav-term input {
            position: absolute;
            /* Đặt checkbox ra khỏi dòng chảy của tài liệu */
            opacity: 0;
            /* Ẩn checkbox */
            cursor: pointer;
            /* Đảm bảo con trỏ thay đổi khi hover */
        }

        .wc-layered-nav-term label {
            position: relative;
            padding-left: 30px;
            /* Khoảng cách để tạo không gian cho dấu kiểm */
            cursor: pointer;
            /* Con trỏ khi hover */
        }

        .wc-layered-nav-term label::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            /* Kích thước dấu kiểm */
            height: 20px;
            /* Kích thước dấu kiểm */
            border: 2px solid;
            /* Màu viền */
            border-radius: 4px;
            /* Bo góc */
            background-color: white;
            /* Màu nền của dấu kiểm */
            transition: background-color 0.2s, border 0.2s;
            /* Hiệu ứng chuyển động */
        }

        .wc-layered-nav-term input:checked+label::before {
            background-color: #0063D1;
            /* Màu xanh dương khi được chọn */

        }

        .count {
            margin-left: 10px;
            /* Khoảng cách giữa label và count */
            font-size: 0.9em;
            /* Kích thước chữ cho count */
            color: #666;
            /* Màu sắc cho count */
        }

        .select {
            text-align: center;
            margin-top: 15px;
            padding: 8px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
    </style>

    <body class="woocommerce-active left-sidebar">
        <div id="page" class="hfeed site">

            @include('user.partials.header')

            @include('user.partials.menu')

            <!-- .header-v2 -->
            <!-- ============================================================= Header End ============================================================= -->
            <div id="content" class="site-content" tabindex="-1">
                <div class="col-full">
                    <div class="row">
                        <nav class="woocommerce-breadcrumb">
                            <a href="{{ route('users.index') }}">Trang chủ</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>
                            @if (isset($subCategory))
                                Danh mục: {{ $subCategory->name }}  
                            @else
                                Danh sách sản phẩm 
                            @endif

                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="shop-control-bar">
                                    <div class="handheld-sidebar-toggle">
                                        <button type="button" class="btn sidebar-toggler">
                                            <i class="fa fa-sliders"></i>
                                            <span>Filters</span>
                                        </button>
                                    </div>
                                    <!-- .handheld-sidebar-toggle -->
                                    <h1 class="woocommerce-products-header__title page-title">
                                        @if (isset($subCategory))
                                            Danh mục: {{ $subCategory->name }}
                                        @endif
                                    </h1>
                                    {{-- <ul role="tablist" class="shop-view-switcher nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#grid" title="Grid View" data-toggle="tab" class="nav-link active">
                                                <i class="tm tm-grid-small"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#grid-extended" title="Grid Extended View" data-toggle="tab"
                                                class="nav-link ">
                                                <i class="tm tm-grid"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#list-view-large" title="List View Large" data-toggle="tab"
                                                class="nav-link ">
                                                <i class="tm tm-listing-large"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#list-view" title="List View" data-toggle="tab" class="nav-link ">
                                                <i class="tm tm-listing"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#list-view-small" title="List View Small" data-toggle="tab"
                                                class="nav-link ">
                                                <i class="tm tm-listing-small"></i>
                                            </a>
                                        </li>
                                    </ul> --}}
                                    <!-- .shop-view-switcher -->
                                    {{-- <form class="form-techmarket-wc-ppp" method="POST">
                                        <select class="techmarket-wc-wppp-select c-select" onchange="this.form.submit()"
                                            name="ppp">
                                            <option value="20">Show 20</option>
                                            <option value="40">Show 40</option>
                                            <option value="-1">Show All</option>
                                        </select>
                                        <input type="hidden" value="5" name="shop_columns">
                                        <input type="hidden" value="15" name="shop_per_page">
                                        <input type="hidden" value="right-sidebar" name="shop_layout">
                                    </form> --}}
                                    <!-- .form-techmarket-wc-ppp -->
                                    {{-- <form method="get" class="woocommerce-ordering">
                                        <select class="orderby" name="orderby">
                                            <option value="popularity">Sort by popularity</option>
                                            <option value="rating">Sort by average rating</option>
                                            <option selected="selected" value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                        <input type="hidden" value="5" name="shop_columns">
                                        <input type="hidden" value="15" name="shop_per_page">
                                        <input type="hidden" value="right-sidebar" name="shop_layout">
                                    </form> --}}
                                    <!-- .woocommerce-ordering -->
                                    {{-- <nav class="techmarket-advanced-pagination">
                                        <form class="form-adv-pagination" method="post">
                                            <input type="number" value="1" class="form-control" step="1"
                                                max="5" min="1" size="2" id="goto-page">
                                        </form> of 5<a href="#" class="next page-numbers">→</a>
                                    </nav> --}}
                                    <!-- .techmarket-advanced-pagination -->
                                </div>
                                <!-- .shop-control-bar -->
                                <div class="tab-content">
                                    <div id="grid" class="tab-pane active" role="tabpanel">
                                        <div class="woocommerce columns-5">
                                            <div class="products">
                                                @if ($products->count() > 0)
                                                    @foreach ($products as $product)
                                                        <div class="product first">
                                                            <div class="yith-wcwl-add-to-wishlist">
                                                                <a href="wishlist.html" rel="nofollow"
                                                                    class="add_to_wishlist">
                                                                    Add to Wishlist</a>
                                                            </div>
                                                            <!-- .yith-wcwl-add-to-wishlist -->
                                                            <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link"
                                                                href="{{ route('users.products.show', $product->id) }}">
                                                                @if ($product->image)
                                                                    <img style="height: 212px; object-fit: contain;"
                                                                        src="{{ Storage::url($product->image) }}"
                                                                        class="wp-post-image" alt="$product->name">
                                                                @else
                                                                    <span>Không có ảnh</span>
                                                                @endif
                                                                <span class="price">
                                                                    <ins>
                                                                        <span
                                                                            class="amount">{{ number_format($product->variants->first()->sale_price, 0, ',', '.') }}đ</span>
                                                                    </ins>
                                                                    <del>
                                                                        <span
                                                                            class="amount">{{ number_format($product->variants->first()->listed_price, 0, ',', '.') }}đ</span>
                                                                    </del>
                                                                    <span class="amount"> </span>
                                                                </span>
                                                                <h2 class="woocommerce-loop-product__title">
                                                                    {{ $product->name }}</h2>
                                                            </a>
                                                            <!-- .woocommerce-LoopProduct-link -->
                                                            <div class="hover-area">
                                                                <form action="{{ route('cart.store') }}"
                                                                    enctype="multipart/form-data" method="post"
                                                                    class="cart">
                                                                    @csrf
                                                                    <input type="hidden" name="variant_id"
                                                                        value="{{ $product->variants->first()->id }}">
                                                                    <input type="hidden" name="quantity" id=""
                                                                        value="1">
                                                                    <button type="submit"
                                                                        class="button add_to_cart_button">Thêm vào giỏ
                                                                        hàng</button>
                                                                </form>
                                                                {{-- <a class="add-to-compare-link" href="compare.html">Add to
                                                                    compare</a> --}}
                                                            </div>
                                                            <!-- .hover-area -->
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <p>Không có sản phẩm nào phù hợp.</p>
                                                @endif
                                                <!-- .product -->
                                            </div>
                                            <!-- .products -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    {{-- <!-- .tab-pane -->
                                    <div id="grid-extended" class="tab-pane" role="tabpanel">
                                        <div class="woocommerce columns-7">
                                            <div class="products">
                                                <div class="product first">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">XONE Wireless Controller</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof portable speaker</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with Bluetooth Glasses</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass Headphones</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product last">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/7.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof portable speaker</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product first">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/8.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass Headphones</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/9.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/10.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit Monitorss Buds</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/11.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit Monitorss Buds</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/12.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB 512SSD W10</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/13.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi & GPS</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product last">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/14.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with Bluetooth Glasses</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product first">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/15.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi & GPS</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/16.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof portable speaker</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/17.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">XONE Wireless Controller</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB 512SSD W10</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/12.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey Suture Leather Strap</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product ">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                                <div class="product last">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/8.jpg">
                                                        <span class="price">
                                                            <span class="woocommerce-Price-amount amount">
                                                                <span class="woocommerce-Price-currencySymbol">$</span>800.00</span>
                                                        </span>
                                                        <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof portable speaker</h2>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="techmarket-product-rating">
                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                            <span style="width:100%">
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                        <span class="review-count">(1)</span>
                                                    </div>
                                                    <!-- .techmarket-product-rating -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>Multimedia Speakers</li>
                                                            <li>120 watts peak</li>
                                                            <li>Front-facing subwoofer</li>
                                                            <li>Refresh Rate: 120Hz (Effective)</li>
                                                            <li>Backlight: LED</li>
                                                            <li>Smart Functionality: Yes, webOS 3.0</li>
                                                            <li>Dimensions (W x H x D): TV without stand: 43.5″ x 25.4″ x 3.0″, TV with stand: 43.5″ x 27.6″ x 8.5″</li>
                                                            <li>Inputs: 3 HMDI, 2 USB, 1 RF, 1 Component, 1 Composite, 1 Optical, 1 RS232C, 1 Ethernet</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <a class="button product_type_simple add_to_cart_button" href="cart.html">Add to cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product -->
                                            </div>
                                            <!-- .products -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .tab-pane -->
                                    <div id="list-view-large" class="tab-pane active" role="tabpanel">
                                        <div class="woocommerce columns-1">
                                            <div class="products">
                                                <div class="product list-view-large first ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                                <span class="sku_wrapper">SKU:
                                                                    <span class="sku">5487FB8/13</span>
                                                                </span>
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-large ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                                <span class="sku_wrapper">SKU:
                                                                    <span class="sku">5487FB8/13</span>
                                                                </span>
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-large ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                                <span class="sku_wrapper">SKU:
                                                                    <span class="sku">5487FB8/13</span>
                                                                </span>
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-large ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                                <span class="sku_wrapper">SKU:
                                                                    <span class="sku">5487FB8/13</span>
                                                                </span>
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-large ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                                <span class="sku_wrapper">SKU:
                                                                    <span class="sku">5487FB8/13</span>
                                                                </span>
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-large ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                                <span class="sku_wrapper">SKU:
                                                                    <span class="sku">5487FB8/13</span>
                                                                </span>
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                            </div>
                                            <!-- .products -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .tab-pane -->
                                    <div id="list-view" class="tab-pane" role="tabpanel">
                                        <div class="woocommerce columns-1">
                                            <div class="products">
                                                <div class="product list-view last">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view first ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="brand">
                                                                    <a href="#">
                                                                        <img alt="galaxy" src="assets/images/brands/5.png">
                                                                    </a>
                                                                </div>
                                                                <!-- .brand -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <div class="availability">
                                                                    Availability:
                                                                    <p class="stock in-stock">1000 in stock</p>
                                                                </div>
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                            </div>
                                            <!-- .products -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .tab-pane -->
                                    <div id="list-view-small" class="tab-pane" role="tabpanel">
                                        <div class="woocommerce columns-1">
                                            <div class="products">
                                                <div class="product list-view-small ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small last">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small first ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/7.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small ">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/8.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                                <div class="product list-view-small last">
                                                    <div class="media">
                                                        <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/9.jpg">
                                                        <div class="media-body">
                                                            <div class="product-info">
                                                                <div class="yith-wcwl-add-to-wishlist">
                                                                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                                </div>
                                                                <!-- .yith-wcwl-add-to-wishlist -->
                                                                <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                                    <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                                    <div class="techmarket-product-rating">
                                                                        <div title="Rated 5.00 out of 5" class="star-rating">
                                                                            <span style="width:100%">
                                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                                        </div>
                                                                        <span class="review-count">(1)</span>
                                                                    </div>
                                                                </a>
                                                                <!-- .woocommerce-LoopProduct-link -->
                                                                <div class="woocommerce-product-details__short-description">
                                                                    <ul>
                                                                        <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                                        <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                                        <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                                        <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                                    </ul>
                                                                </div>
                                                                <!-- .woocommerce-product-details__short-description -->
                                                            </div>
                                                            <!-- .product-info -->
                                                            <div class="product-actions">
                                                                <span class="price">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                                </span>
                                                                <!-- .price -->
                                                                <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                            </div>
                                                            <!-- .product-actions -->
                                                        </div>
                                                        <!-- .media-body -->
                                                    </div>
                                                    <!-- .media -->
                                                </div>
                                                <!-- .product -->
                                            </div>
                                            <!-- .products -->
                                        </div>
                                        <!-- .woocommerce -->
                                    </div>
                                    <!-- .tab-pane --> --}}
                                </div>
                                <!-- .tab-content -->
                                <div class="shop-control-bar-bottom">
                                    {{-- <form class="form-techmarket-wc-ppp" method="POST">
                                        <select class="techmarket-wc-wppp-select c-select" onchange="this.form.submit()"
                                            name="ppp">
                                            <option value="20">Show 20</option>
                                            <option value="40">Show 40</option>
                                            <option value="-1">Show All</option>
                                        </select>
                                        <input type="hidden" value="5" name="shop_columns">
                                        <input type="hidden" value="15" name="shop_per_page">
                                        <input type="hidden" value="right-sidebar" name="shop_layout">
                                    </form> --}}
                                    <!-- .form-techmarket-wc-ppp -->
                                    {{-- <p class="woocommerce-result-count">
                                        Showing 1&ndash;15 of 73 results
                                    </p> --}}
                                    <!-- .woocommerce-result-count -->
                                    {{-- <nav class="woocommerce-pagination">
                                        <ul class="page-numbers">
                                            <li>
                                                <span class="page-numbers current">1</span>
                                            </li>
                                            <li><a href="#" class="page-numbers">2</a></li>
                                            <li><a href="#" class="page-numbers">3</a></li>
                                            <li><a href="#" class="page-numbers">4</a></li>
                                            <li><a href="#" class="page-numbers">5</a></li>
                                            <li><a href="#" class="next page-numbers">→</a></li>
                                        </ul>
                                        <!-- .page-numbers -->
                                    </nav> --}}
                                    <div>
                                        {{ $products->links() }}
                                    </div>
                                    <!-- .woocommerce-pagination -->
                                </div>
                                <!-- .shop-control-bar-bottom -->
                            </main>
                            <!-- #main -->
                        </div>
                        <!-- #primary -->
                        <div id="secondary" class="widget-area shop-sidebar" role="complementary">
                            <div id="techmarket_products_filter-3" class="widget widget_techmarket_products_filter">
                                <span class="gamma widget-title">Bộ lọc</span>

                                <form action="{{ route('users.filter') }}" method="GET">
                                    <div class="widget woocommerce widget_price_filter" id="woocommerce_price_filter-2">
                                        <span class="gamma widget-title">Lọc theo giá</span>
                                        <div class="price_filter">
                                            <ul>
                                                <li class="wc-layered-nav-term">
                                                    <input type="radio" name="price_range" id="price_below_10" value="below_10"
                                                        {{ request('price_range') == 'below_10' ? 'checked' : '' }}>
                                                    <label for="price_below_10">Dưới 10 triệu</label>
                                                </li>
                                                <li class="wc-layered-nav-term">
                                                    <input type="radio" name="price_range" id="price_10_15" value="10_15"
                                                        {{ request('price_range') == '10_15' ? 'checked' : '' }}>
                                                    <label for="price_10_15">10 - 15 triệu</label>
                                                </li>
                                                <li class="wc-layered-nav-term">
                                                    <input type="radio" name="price_range" id="price_15_20" value="15_20"
                                                        {{ request('price_range') == '15_20' ? 'checked' : '' }}>
                                                    <label for="price_15_20">15 - 20 triệu</label>
                                                </li>
                                                <li class="wc-layered-nav-term">
                                                    <input type="radio" name="price_range" id="price_20_30" value="20_30"
                                                        {{ request('price_range') == '20_30' ? 'checked' : '' }}>
                                                    <label for="price_20_30">20 - 30 triệu</label>
                                                </li>
                                                <li class="wc-layered-nav-term">
                                                    <input type="radio" name="price_range" id="price_above_30" value="above_30"
                                                        {{ request('price_range') == 'above_30' ? 'checked' : '' }}>
                                                    <label for="price_above_30">Trên 30 triệu</label>
                                                </li>
                                            </ul>
                                        </div>  
                                    </div>

                                    <div class="widget woocommerce widget_layered_nav maxlist-more">
                                        <span class="gamma widget-title">Danh mục</span>
                                        <select class="select" name="sub_category_id" id="sub_category_id">
                                            <option value="">-- Laptop --</option>
                                            @foreach ($sub_category as $key => $item)
                                                <option value="{{ $key }}"
                                                    {{ request('sub_category_id') == $key ? 'selected' : '' }}>
                                                    {{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="widget woocommerce widget_layered_nav maxlist-more checkbox">
                                        <span class="gamma widget-title">Chip</span>
                                        <ul>
                                            @foreach ($chips as $key => $item)
                                                @if ($key != 1)
                                                    <li class="wc-layered-nav-term">
                                                        <input type="checkbox" name="chip_id[]"
                                                            id="chip_{{ $key }}" value="{{ $key }}"
                                                            {{ in_array($key, request('chip_id', [])) ? 'checked' : '' }}>
                                                        <label for="chip_{{ $key }}">{{ $item }}</label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="widget woocommerce widget_layered_nav maxlist-more checkbox">
                                        <span class="gamma widget-title">Ram</span>
                                        <ul>
                                            @foreach ($rams as $key => $item)
                                                @if ($key != 1)
                                                    <li class="wc-layered-nav-term">
                                                        <input type="checkbox" name="ram_id[]"
                                                            id="ram_{{ $key }}" value="{{ $key }}"
                                                            {{ in_array($key, request('ram_id', [])) ? 'checked' : '' }}>
                                                        <label for="ram_{{ $key }}">{{ $item }}</label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="widget woocommerce widget_layered_nav maxlist-more checkbox">
                                        <span class="gamma widget-title">Storage</span>
                                        <ul>
                                            @foreach ($storages as $key => $item)
                                                @if ($key != 1)
                                                    <li class="wc-layered-nav-term">
                                                        <input type="checkbox" name="storage_id[]"
                                                            id="storage_{{ $key }}" value="{{ $key }}"
                                                            {{ in_array($key, request('storage_id', [])) ? 'checked' : '' }}>
                                                        <label
                                                            for="storage_{{ $key }}">{{ $item }}</label>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>

                                    <button style="color: aliceblue"  type="submit">Lọc</button>
                                    <button style="color: aliceblue"  type="reset">Reset</button>
                                    <a href="{{ route('users.filter') }}"><button style="color: aliceblue"  type="button">Xóa</button></a>

                                </form>

                            </div>

                            <div class="widget widget_techmarket_products_carousel_widget">
                                <section id="single-sidebar-carousel" class="section-products-carousel">
                                    <header class="section-header">
                                        <h2 class="section-title">Sản phẩm mới nhất</h2>
                                        <nav class="custom-slick-nav"></nav>
                                    </header>
                                    <!-- .section-header -->
                                    <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products"
                                        data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;rows&quot;:2,&quot;slidesPerRow&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#single-sidebar-carousel .custom-slick-nav&quot;}">
                                        <div class="container-fluid">
                                            <div class="woocommerce columns-1">
                                                <div class="products">
                                                    @foreach ($latestProducts as $product)
                                                        <div class="landscape-product-widget product">
                                                            <a class="woocommerce-LoopProduct-link"
                                                                href="{{ route('users.products.show', $product->id) }}">
                                                                <div class="media">
                                                                    @if ($product->image)
                                                                        <img src="{{ Storage::url($product->image) }}"
                                                                            class="wp-post-image" alt="$product->name">
                                                                    @else
                                                                        <span>Không có ảnh</span>
                                                                    @endif
                                                                    <div class="media-body">
                                                                        <span class="price">
                                                                            <ins>
                                                                                <span
                                                                                    class="amount">{{ number_format($product->variants->first()->sale_price, 0, ',', '.') }}đ</span>
                                                                            </ins>
                                                                            <del>
                                                                                <span
                                                                                    class="amount">{{ number_format($product->variants->first()->listed_price, 0, ',', '.') }}đ</span>
                                                                            </del>
                                                                            <span class="amount"> </span>
                                                                        </span>
                                                                        <!-- .price -->
                                                                        <h2 class="woocommerce-loop-product__title">
                                                                            {{ $product->name }}</h2>
                                                                        <div class="techmarket-product-rating">
                                                                            <div title="Rated 0 out of 5"
                                                                                class="star-rating">
                                                                                <span style="width:0%">
                                                                                    <strong class="rating">0</strong> out
                                                                                    of 5</span>
                                                                            </div>
                                                                            <span class="review-count">(0)</span>
                                                                        </div>
                                                                        <!-- .techmarket-product-rating -->
                                                                    </div>
                                                                    <!-- .media-body -->
                                                                </div>
                                                                <!-- .media -->
                                                            </a>
                                                            <!-- .woocommerce-LoopProduct-link -->
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- .products -->
                                            </div>
                                            <!-- .woocommerce -->
                                        </div>
                                        <!-- .container-fluid -->
                                    </div>
                                    <!-- .products-carousel -->
                                </section>
                                <!-- .section-products-carousel -->
                            </div>
                            <!-- .widget_techmarket_products_carousel_widget -->
                        </div>
                        <!-- #secondary -->
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
