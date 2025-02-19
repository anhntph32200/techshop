@extends('user.layout')

@section('content')
    <style>
        .single-product-header form {
            display: inline;
        }

        .single-product-header form {
            display: inline;
        }

        .single-product-header button.add-to-wishlist {
            background-color: white;
            /* Nền trắng */
            color: #333;
            /* Màu chữ */
            border: none;
            /* Bỏ đường viền */
            padding: 10px 20px;
            /* Điều chỉnh khoảng cách bên trong nút */
            font-size: 14px;
            /* Kích thước chữ */
            cursor: pointer;
            /* Con trỏ khi hover */
            border-radius: 5px;
            /* Bo góc */
        }

        .card-container {
            display: flex;
            /* Sử dụng Flexbox để hiển thị các card theo hàng ngang */
            flex-wrap: wrap;
            /* Cho phép các card xuống hàng nếu không đủ chỗ */
            gap: 15px;
            /* Khoảng cách giữa các card */
            justify-content: center;
            /* Căn giữa các card trong container */
            padding: 20px;
            /* Padding cho container */
        }

        .card {
            box-sizing: border-box;
            /* Bao gồm padding và border trong kích thước */
            border: 2px solid transparent;
            /* Đặt border mặc định là trong suốt */
            border-radius: 8px;
            /* Góc bo tròn */
            /* padding: 15px; */
            /* Padding trong card */
            background-color: #f9f9f9;
            /* Màu nền nhẹ cho card */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Bóng đổ nhẹ cho card */
            text-align: center;
            /* Căn giữa nội dung */
            width: 180px;
            /* Kích thước chiều rộng của card */
            height: 190px;
            /* Kích thước chiều cao của card */
            transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s;
            /* Thêm hiệu ứng cho bóng đổ và màu viền */
            cursor: pointer;
            /* Đổi con trỏ khi hover */
        }

        .card:hover {
            transform: translateY(-5px);
            /* Đẩy card lên một chút khi hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Bóng đổ mạnh hơn khi hover */
        }

        .card.active {
            border-color: #007bff;
            /* Màu viền khi active */
        }

        .card-content {
            display: flex;
            flex-direction: column;
            /* Sắp xếp theo chiều dọc */
            align-items: center;
            /* Căn giữa các thành phần */
        }

        .chip-name,
        .ram-name,
        .storage-name {
            margin: 5px 0;
            /* Khoảng cách giữa các tên */
            font-size: 14px;
            /* Kích thước chữ */
            color: #333;
            /* Màu chữ tối */
        }

        .price {
            color: #0063D1;
            /* Màu chữ cho giá */
            font-size: 16px;
            /* Kích thước chữ giá */
            margin-top: 10px;
            /* Khoảng cách trên của giá */
            font-weight: bold;
            /* Chữ đậm cho giá */
        }

        .sale_price {
            color: #999;
            /* Màu mờ cho giá bán */
            font-size: 14px;
            /* Kích thước chữ cho giá bán */
            text-decoration: line-through;
            /* Gạch ngang giá bán */
            margin-left: 5px;
            /* Khoảng cách bên trái giữa giá bán và giá gốc */
        }

        .quantity-input {
            width: 55px;
            /* Độ rộng của ô input */
            height: 58px;
            margin-right: 60px;
            padding: 5px;
            /* Khoảng đệm bên trong */
            border: 1px solid #ddd;
            /* Viền mỏng và màu xám nhẹ */
            border-radius: 8px;
            /* Bo tròn 8px */
            font-size: 16px;
            /* Cỡ chữ */
            text-align: center;
            /* Căn giữa giá trị */
            -moz-appearance: textfield;
            /* Loại bỏ mũi tên trong Firefox */
        }
    </style>

    <body class="woocommerce-active single-product full-width normal">
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
                            </span><a href="#">{{ $product->subCategory->name }}</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>{{ $product->name }}
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="product product-type-simple">
                                    <div class="single-product-wrapper">
                                        <div class="product-images-wrapper thumb-count-4">
                                            {{-- <span class="onsale">-
                                            <span class="woocommerce-Price-amount amount">
                                                <span class="woocommerce-Price-currencySymbol"></span>242.99</span>
                                        </span> --}}
                                            <!-- .onsale -->
                                            <div id="techmarket-single-product-gallery"
                                                class="techmarket-single-product-gallery techmarket-single-product-gallery--with-images techmarket-single-product-gallery--columns-4 images"
                                                data-columns="4">
                                                <div class="techmarket-single-product-gallery-images"
                                                    data-ride="tm-slick-carousel"
                                                    data-wrap=".woocommerce-product-gallery__wrapper"
                                                    data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:false,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery .techmarket-single-product-gallery-thumbnails__wrapper&quot;}">
                                                    <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images"
                                                        data-columns="4">
                                                        <a href="#"
                                                            class="woocommerce-product-gallery__trigger">🔍</a>
                                                        <figure class="woocommerce-product-gallery__wrapper ">
                                                            <div data-thumb="{{ asset('storage/' . $product->image) }}"
                                                                class="woocommerce-product-gallery__image">
                                                                <a href="{{ asset('template2/assets/images/products/big-card.jpg') }}"
                                                                    tabindex="0">
                                                                    <img width="600" height="600"
                                                                        src="{{ asset('storage/' . $product->image) }}"
                                                                        class="attachment-shop_single size-shop_single wp-post-image"
                                                                        alt="">
                                                                </a>
                                                            </div>
                                                            @foreach ($product->productImages as $image)
                                                                <div data-thumb="{{ asset('template2/assets/images/products/sm-card-3.jpg') }}"
                                                                    class="woocommerce-product-gallery__image">
                                                                    <a href="{{ asset('template2/assets/images/products/big-card-2.jpg') }}"
                                                                        tabindex="-1">
                                                                        <img width="600" height="600"
                                                                            src="{{ asset('storage/' . $image->image_url) }}"
                                                                            class="attachment-shop_single size-shop_single"
                                                                            alt="{{ $product->name }}">
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </figure>
                                                    </div>
                                                    <!-- .woocommerce-product-gallery -->
                                                </div>
                                                <!-- .techmarket-single-product-gallery-images -->
                                                <div class="techmarket-single-product-gallery-thumbnails"
                                                    data-ride="tm-slick-carousel"
                                                    data-wrap=".techmarket-single-product-gallery-thumbnails__wrapper"
                                                    data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;vertical&quot;:true,&quot;verticalSwiping&quot;:true,&quot;focusOnSelect&quot;:true,&quot;touchMove&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-up\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-down\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery .woocommerce-product-gallery__wrapper&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:765,&quot;settings&quot;:{&quot;vertical&quot;:false,&quot;horizontal&quot;:true,&quot;verticalSwiping&quot;:false,&quot;slidesToShow&quot;:4}}]}">
                                                    <figure class="techmarket-single-product-gallery-thumbnails__wrapper">
                                                        <figure
                                                            data-thumb="{{ asset('template2/assets/images/products/sm-card-1.jpg') }}"
                                                            class="techmarket-wc-product-gallery__image">
                                                            <img width="180" height="180"
                                                                src="{{ asset('storage/' . $product->image) }}"
                                                                class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image"
                                                                alt="">
                                                        </figure>
                                                        @foreach ($product->productImages as $image)
                                                            <figure
                                                                data-thumb="{{ asset('template2/assets/images/products/sm-card-3.jpg') }}"
                                                                class="techmarket-wc-product-gallery__image">
                                                                <img width="180" height="180"
                                                                    src="{{ asset('storage/' . $image->image_url) }}"
                                                                    class="attachment-shop_thumbnail size-shop_thumbnail"
                                                                    alt="{{ $product->name }}">
                                                            </figure>
                                                        @endforeach
                                                    </figure>
                                                    <!-- .techmarket-single-product-gallery-thumbnails__wrapper -->
                                                </div>
                                                <!-- .techmarket-single-product-gallery-thumbnails -->
                                            </div>
                                            <!-- .techmarket-single-product-gallery -->
                                        </div>
                                        <!-- .product-images-wrapper -->
                                        <div class="summary entry-summary">
                                            <div class="single-product-header">
                                                <h1 class="product_title entry-title">{{ $product->name }}</h1>
                                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="add-to-wishlist">Yêu thích</button>
                                                </form>
                                            </div>
                                            <!-- .single-product-header -->
                                            <div class="single-product-meta">
                                                <div class="brand">
                                                    <a href="#">
                                                        @if ($product->subCategory->image)
                                                            <img alt=""
                                                                src="{{ asset('storage/' . $product->subCategory->image) }}"
                                                                alt="{{ $product->subCategory->name }} " width="80px">
                                                        @else
                                                            <span>Không có ảnh</span>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="cat-and-sku">
                                                    <span class="posted_in categories">
                                                        <a rel="tag"
                                                            href="product-category.html">{{ $product->subCategory->name }}</a>
                                                    </span>
                                                    {{-- <span class="sku_wrapper">SKU:
                                                    <span class="sku">5487FB8/11</span>
                                                </span> --}}
                                                </div>
                                                <div class="product-label">
                                                    <div class="ribbon label green-label">
                                                        <span>A+</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- .single-product-meta -->
                                            <div class="rating-and-sharing-wrapper">
                                                <div class="woocommerce-product-rating">
                                                    <div class="star-rating">
                                                        <span style="width:100%">Rated
                                                            <strong class="rating">5.00</strong> out of 5 based on
                                                            <span class="rating">1</span> customer rating</span>
                                                    </div>
                                                    <a rel="nofollow" class="woocommerce-review-link"
                                                        href="#reviews">(<span class="count">1</span> customer
                                                        review)</a>
                                                </div>
                                            </div>
                                            <!-- .rating-and-sharing-wrapper -->
                                            <div class="woocommerce-product-details__short-description">
                                                <ul>
                                                    @php
                                                        $specifications = explode(';', $product->description);
                                                    @endphp

                                                    @foreach ($specifications as $index => $spec)
                                                        @if (trim($spec) !== '' && $index < 8)
                                                            <li>{{ trim($spec) }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!-- .woocommerce-product-details__short-description -->
                                            <div class="product-actions-wrapper">
                                                <form action="{{ route('cart.store') }}" enctype="multipart/form-data"
                                                    method="post" class="cart">
                                                    @csrf

                                                    @if (count($product->variants) === 1)
                                                        @php
                                                            $singleVariant = $product->variants->first();
                                                        @endphp
                                                        <input type="hidden" name="variant_id"
                                                            value="{{ $singleVariant->id }}">
                                                        <div class="product-actions">
                                                            <p class="price">
                                                                <del>{{ number_format($singleVariant->listed_price, 0, ',', '.') }}
                                                                    đ</del>
                                                                <ins>{{ number_format($singleVariant->sale_price, 0, ',', '.') }}
                                                                    đ</ins>
                                                            <p>
                                                                Số lượng:
                                                                @if ($singleVariant->quantity <= 0)
                                                                    <span style="color: red;">Hết hàng</span>
                                                                @else
                                                                    {{ $singleVariant->quantity }}
                                                                @endif
                                                            </p>
                                                            </p>
                                                        </div>
                                                    @else
                                                        <input type="hidden" name="variant_id" id="variant_id"
                                                            value="">
                                                        <div class="card-container" style="justify-content: flex-start">
                                                            @foreach ($product->variants as $variant)
                                                                <div class="card @if ($variant->isActive) active @endif"
                                                                    data-variant-id="{{ $variant->id }}"
                                                                    onclick="selectCard(this)">
                                                                    <div class="card-content">
                                                                        @if ($variant->chip->id != 1)
                                                                            <strong
                                                                                class="chip-name">{{ $variant->chip->name }}</strong>
                                                                        @endif
                                                                        @if ($variant->ram->id != 1)
                                                                            <strong
                                                                                class="ram-name">{{ $variant->ram->name }}</strong>
                                                                        @endif
                                                                        @if ($variant->storage->id != 1)
                                                                            <strong
                                                                                class="storage-name">{{ $variant->storage->name }}</strong>
                                                                        @endif
                                                                        <span
                                                                            class="price">{{ number_format($variant->sale_price, 0, ',', '.') }}
                                                                            đ</span>
                                                                        <span
                                                                            class="sale_price">{{ number_format($variant->listed_price, 0, ',', '.') }}
                                                                            đ</span>
                                                                        <p>
                                                                            Số lượng:
                                                                            @if ($variant->quantity <= 0)
                                                                                <span style="color: red;">Hết hàng</span>
                                                                            @else
                                                                                {{ $variant->quantity }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif

                                                    <div class="product-actions">
                                                        <div class="quantity">
                                                            <label for="quantity-input">Số lượng</label>
                                                            <input class="quantity-input" type="number" name="quantity"
                                                                value="1" min="1">
                                                        </div>
                                                        <button class="single_add_to_cart_button button alt"
                                                            name="add-to-cart" type="submit"
                                                            style="border-radius: 8px; margin-top: 30px;">Thêm vào giỏ
                                                            hàng</button>
                                                    </div>
                                                    @error('quantity')
                                                        <span class="error-message"
                                                            style="color: red;">{{ $message }}</span>
                                                    @enderror
                                                    <script>
                                                        // Hàm để chọn và đánh dấu card là active
                                                        function selectCard(card) {
                                                            const cards = document.querySelectorAll('.card');
                                                            cards.forEach(c => c.classList.remove('active'));

                                                            card.classList.add('active');

                                                            const variantId = card.getAttribute('data-variant-id');
                                                            document.getElementById('variant_id').value = variantId;
                                                        }

                                                        // Đảm bảo card đầu tiên được đánh dấu nếu đã có một biến thể active
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const activeCard = document.querySelector('.card.active');
                                                            if (!activeCard) {
                                                                // Nếu không có card nào active, chọn card đầu tiên
                                                                const firstCard = document.querySelector('.card');
                                                                if (firstCard) {
                                                                    selectCard(firstCard); // Gọi hàm để đánh dấu card đầu tiên là active
                                                                }
                                                            }
                                                        });
                                                    </script>
                                                </form>
                                            </div>
                                            <!-- .product-actions-wrapper -->
                                        </div>
                                        <!-- .entry-summary -->
                                    </div>
                                    <!-- .tm-related-products-carousel -->
                                    <div class="woocommerce-tabs wc-tabs-wrapper">
                                        <ul role="tablist" class="nav tabs wc-tabs">
                                            <li class="nav-item accessories_tab">
                                                <a class="nav-link active" data-toggle="tab" role="tab"
                                                    aria-controls="tab-accessories" href="#tab-accessories">Sản phẩm liên
                                                    quan</a>
                                            </li>
                                            <li class="nav-item description_tab">
                                                <a class="nav-link" data-toggle="tab" role="tab"
                                                    aria-controls="tab-description" href="#tab-description">Mô tả</a>
                                            </li>
                                            <li class="nav-item specification_tab">
                                                <a class="nav-link" data-toggle="tab" role="tab"
                                                    aria-controls="tab-specification" href="#tab-specification">Thông số
                                                    kỹ thuật</a>
                                            </li>
                                            <li class="nav-item reviews_tab">
                                                <a class="nav-link" data-toggle="tab" role="tab"
                                                    aria-controls="tab-reviews" href="#tab-reviews">Bình luận</a>
                                            </li>
                                        </ul>
                                        <!-- /.ec-tabs -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-accessories" role="tabpanel">
                                                <div class="tm-related-products-carousel section-products-carousel"
                                                    id="tm-related-products-carousel" data-ride="tm-slick-carousel"
                                                    data-wrap=".products"
                                                    data-slick="{&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:7,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#tm-related-products-carousel .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:767,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:780,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
                                                    <section class="related">
                                                        <header class="section-header">
                                                            <h2 class="section-title">Sản phẩm liên quan</h2>
                                                            <nav class="custom-slick-nav"></nav>
                                                        </header>
                                                        <!-- .section-header -->
                                                        <div class="products">
                                                            @foreach ($relatedProducts as $product1)
                                                                <div class="product">
                                                                    <div class="yith-wcwl-add-to-wishlist">
                                                                        <a href="wishlist.html" rel="nofollow"
                                                                            class="add_to_wishlist">
                                                                            Add to
                                                                            Wishlist</a>
                                                                    </div>
                                                                    <a href="{{ route('users.products.show', $product1->id) }}"
                                                                        class="woocommerce-LoopProduct-link">
                                                                        @if ($product1->image)
                                                                            <img src="{{ Storage::url($product1->image) }}"
                                                                                width="224" height="197"
                                                                                class="wp-post-image"
                                                                                alt="$product1->name">
                                                                        @else
                                                                            <span>Không có ảnh</span>
                                                                        @endif
                                                                        <span class="price">
                                                                            <ins>
                                                                                <span
                                                                                    class="amount">{{ number_format($product1->variants->first()->sale_price, 0, ',', '.') }}đ</span>
                                                                            </ins>
                                                                            <del>
                                                                                <span
                                                                                    class="amount">{{ number_format($product1->variants->first()->listed_price, 0, ',', '.') }}đ</span>
                                                                            </del>
                                                                            <span class="amount"> </span>
                                                                        </span>
                                                                        <!-- /.price -->
                                                                        <h2 class="woocommerce-loop-product__title">
                                                                            {{ $product1->name }}</h2>
                                                                    </a>
                                                                    <div class="hover-area">
                                                                        <form action="{{ route('cart.store') }}"
                                                                            enctype="multipart/form-data" method="post"
                                                                            class="cart">
                                                                            @csrf
                                                                            <input type="hidden" name="variant_id"
                                                                                value="{{ $product1->variants->first()->id }}">
                                                                            <input type="hidden" name="quantity"
                                                                                id="" value="1">
                                                                            <button type="submit"
                                                                                class="button add_to_cart_button">Thêm vào
                                                                                giỏ hàng</button>
                                                                        </form>
                                                                        {{-- <a class="add-to-compare-link" href="compare.html">Add to
                                                                    compare</a> --}}
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </section>
                                                    <!-- .single-product-wrapper -->
                                                </div>
                                            </div>
                                            <div class="tab-pane panel wc-tab" id="tab-description" role="tabpanel">
                                                <h2>Mô tả</h2>
                                                <h1 style="text-align: center;"></h1>
                                                <p style="text-align: center;max-width: 1160px;margin: auto auto 60px;">
                                                    {!! $product->content !!} </p>
                                            </div>
                                            <div class="tab-pane" id="tab-specification" role="tabpanel">
                                                <div class="tm-shop-attributes-detail like-column columns-3">
                                                    <h3 class="tm-attributes-title">Thông số</h3>
                                                    <table class="shop_attributes">
                                                        <tbody>
                                                            @foreach (explode(';', $product->description) as $spec)
                                                                @if (trim($spec) !== '')
                                                                    @php
                                                                        $parts = explode(':', $spec);
                                                                    @endphp
                                                                    <tr>
                                                                        <th>{{ trim($parts[0]) }}</th>
                                                                        <td>
                                                                            <p><a href="#"
                                                                                    rel="tag">{{ trim($parts[1] ?? '') }}</a>
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>

                                                    </table>
                                                    <!-- /.shop_attributes -->
                                                </div>
                                                <!-- /.tm-shop-attributes-detail -->
                                            </div>
                                            {{-- Review --}}
                                            <div class="tab-pane" id="tab-reviews" role="tabpanel">
                                                <div class="techmarket-advanced-reviews" id="reviews">
                                                    <!-- Review Overview Section -->
                                                    <div class="advanced-review row">
                                                        <div class="advanced-review-rating">
                                                            <h2 class="based-title">Đánh giá
                                                                ({{ $product->reviews->count() }})</h2>

                                                            <!-- Error Message Display -->
                                                            @if ($errors->any())
                                                                <div class="alert alert-danger">
                                                                    <ul>
                                                                        @foreach ($errors->all() as $error)
                                                                            <li>{{ $error }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endif

                                                            <!-- Average Rating -->
                                                            <div class="avg-rating">
                                                                <span class="avg-rating-number">
                                                                    {!! $product->reviews->count() > 0
                                                                        ? number_format($product->reviews->avg('rating'), 1)
                                                                        : '<h5>Chưa có đánh giá</h5>' !!}
                                                                </span>
                                                                <div title="Rated {{ number_format($product->reviews->avg('rating'), 1) }} out of 5"
                                                                    class="star-rating">
                                                                    <span
                                                                        style="width:{{ $product->reviews->count() > 0 ? $product->reviews->avg('rating') * 20 : 0 }}%"></span>
                                                                </div>
                                                            </div>

                                                            <!-- Rating Histogram -->
                                                            <div class="rating-histogram">
                                                                @foreach (range(5, 1, -1) as $i)
                                                                    <div class="rating-bar">
                                                                        <div title="Rated {{ $i }} out of 5"
                                                                            class="star-rating">
                                                                            <span
                                                                                style="width:{{ $i * 20 }}%"></span>
                                                                        </div>
                                                                        <div class="rating-count">
                                                                            {{ $product->reviews->where('rating', $i)->count() }}
                                                                        </div>
                                                                        <div class="rating-percentage-bar">
                                                                            <span class="rating-percentage"
                                                                                style="width:{{ $product->reviews->count() > 0 ? ($product->reviews->where('rating', $i)->count() / $product->reviews->count()) * 100 : 0 }}%"></span>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <!-- Review Form Section (Only for logged-in users) -->
                                                        @if (Auth::check())
                                                            <div class="advanced-review-comment">
                                                                <div id="review_form_wrapper">
                                                                    <div id="review_form">
                                                                        <div class="comment-respond" id="respond">
                                                                            <h3 class="comment-reply-title"
                                                                                id="reply-title">Thêm đánh giá</h3>
                                                                            <form novalidate class="comment-form"
                                                                                id="commentform" method="POST"
                                                                                action="{{ route('reviews.store', $product->id) }}">
                                                                                @csrf
                                                                                <div class="comment-form-rating">
                                                                                    <label>Đánh giá của bạn</label>
                                                                                    <p class="stars">
                                                                                        <span>
                                                                                            @foreach (range(1, 5) as $star)
                                                                                                <a href="#"
                                                                                                    class="star-{{ $star }}"
                                                                                                    data-rating="{{ $star }}">{{ $star }}</a>
                                                                                            @endforeach
                                                                                        </span>
                                                                                    </p>
                                                                                    <input type="hidden" name="rating"
                                                                                        id="rating" value="">
                                                                                </div>
                                                                                <p class="comment-form-comment">
                                                                                    <label for="comment">Đánh giá</label>
                                                                                    <textarea aria-required="true" rows="8" cols="45" name="comment" id="comment"></textarea>
                                                                                </p>
                                                                                <p class="comment-form-author">
                                                                                    <label for="author">Tên <span
                                                                                            class="required">*</span></label>
                                                                                    <input type="text"
                                                                                        aria-required="true"
                                                                                        size="30"
                                                                                        value="{{ Auth::user()->name }}"
                                                                                        name="author" id="author">
                                                                                </p>
                                                                                <p class="comment-form-email">
                                                                                    <label for="email">Email <span
                                                                                            class="required">*</span></label>
                                                                                    <input type="email"
                                                                                        aria-required="true"
                                                                                        size="30"
                                                                                        value="{{ Auth::user()->email }}"
                                                                                        name="email" id="email">
                                                                                </p>
                                                                                <p class="form-submit">
                                                                                    <input type="submit"
                                                                                        value="Thêm đánh giá"
                                                                                        class="submit" id="submit"
                                                                                        name="submit">
                                                                                    <input type="hidden"
                                                                                        id="comment_post_ID"
                                                                                        value="{{ $product->id }}"
                                                                                        name="comment_post_ID">
                                                                                    <input type="hidden" value="0"
                                                                                        id="comment_parent"
                                                                                        name="comment_parent">
                                                                                </p>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để
                                                                đánh giá sản phẩm này.</p>
                                                        @endif

                                                    </div>

                                                    <!-- Display Existing Reviews -->
                                                    <div id="comments">
                                                        <ol class="commentlist">
                                                            @foreach ($product->reviews->where('status', 'visible') as $review)
                                                                <li class="comment">
                                                                    <div class="comment_container">
                                                                        <div class="comment-text">
                                                                            <div class="star-rating">
                                                                                <span
                                                                                    style="width:{{ $review->rating * 20 }}%">Rated
                                                                                    <strong
                                                                                        class="rating">{{ $review->rating }}</strong>
                                                                                    out of 5</span>
                                                                            </div>
                                                                            <p class="meta">
                                                                                <strong
                                                                                    class="woocommerce-review__author">{{ $review->author }}</strong>
                                                                                <span
                                                                                    class="woocommerce-review__dash">&ndash;</span>
                                                                                <time
                                                                                    datetime="{{ $review->created_at->toAtomString() }}"
                                                                                    class="woocommerce-review__published-date">
                                                                                    {{ $review->created_at->format('F d, Y') }}
                                                                                </time>
                                                                            </p>
                                                                            <div class="description">
                                                                                <p>{{ $review->comment }}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ol>
                                                    </div>

                                                </div>
                                                <!-- JavaScript for Star Rating -->
                                                <script>
                                                    document.addEventListener('DOMContentLoaded', function() {
                                                        const stars = document.querySelectorAll('.stars a');
                                                        const ratingInput = document.getElementById('rating');

                                                        stars.forEach((star, index) => {
                                                            star.addEventListener('click', function(e) {
                                                                e.preventDefault();

                                                                // Gán giá trị rating
                                                                ratingInput.value = this.dataset.rating;

                                                                // Xóa class `selected` của tất cả sao
                                                                stars.forEach(s => s.classList.remove('selected'));

                                                                // Gán class `selected` cho các sao được chọn
                                                                for (let i = 0; i <= index; i++) {
                                                                    stars[i].classList.add('selected');
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>

                                                <!-- CSS for Styling -->
                                                <style>
                                                    .stars a {
                                                        color: #ccc;
                                                        font-size: 20px;
                                                        text-decoration: none;
                                                        margin-right: 5px;
                                                    }

                                                    .stars a.selected,
                                                    .stars a:hover {
                                                        color: gold;
                                                    }

                                                    .rating-bar {
                                                        display: flex;
                                                        align-items: center;
                                                        margin-bottom: 10px;
                                                    }

                                                    .rating-percentage-bar {
                                                        height: 5px;
                                                        background-color: #f0f0f0;
                                                    }

                                                    .rating-percentage {
                                                        height: 100%;
                                                        background-color: gold;
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                    <section class="brands-carousel">
                                        <h2 class="sr-only">Brands Carousel</h2>
                                        <div class="col-full" data-ride="tm-slick-carousel" data-wrap=".brands"
                                            data-slick="{&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;responsive&quot;:[{&quot;breakpoint&quot;:400,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:800,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
                                            <div class="brands">
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>apple</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="45" height=""
                                                                class="img-responsive desaturate" alt="apple"
                                                                src="{{ asset('template2/assets/images/18.png') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>bosch</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="55" height=""
                                                                class="img-responsive desaturate" alt="bosch"
                                                                src="{{ asset('template2/assets/images/11.png') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>cannon</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="55" height=""
                                                                class="img-responsive desaturate" alt="cannon"
                                                                src="{{ asset('template2/assets/images/12.png') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>connect</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="70" height=""
                                                                class="img-responsive desaturate" alt="connect"
                                                                src="{{ asset('template2/assets/images/20.jpg') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>galaxy</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="80" height=""
                                                                class="img-responsive desaturate" alt="galaxy"
                                                                src="{{ asset('template2/assets/images/14.png') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>gopro</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="80" height=""
                                                                class="img-responsive desaturate" alt="gopro"
                                                                src="{{ asset('template2/assets/images/15.png') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>handspot</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="100" height=""
                                                                class="img-responsive desaturate" alt="handspot"
                                                                src="{{ asset('template2/assets/images/13.jpg') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>kinova</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="100" height=""
                                                                class="img-responsive desaturate" alt="kinova"
                                                                src="{{ asset('template2/assets/images/19.jpg') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>nespresso</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="100" height=""
                                                                class="img-responsive desaturate" alt="nespresso"
                                                                src="{{ asset('template2/assets/images/21.jpg') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>samsung</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="70" height=""
                                                                class="img-responsive desaturate" alt="samsung"
                                                                src="{{ asset('template2/assets/images/23.jpg') }}">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>speedway</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="145" height=""
                                                                class="img-responsive desaturate" alt="speedway"
                                                                src="assets/images/brands/11.png">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                                <div class="item">
                                                    <a href="shop.html">
                                                        <figure>
                                                            <figcaption class="text-overlay">
                                                                <div class="info">
                                                                    <h4>yoko</h4>
                                                                </div>
                                                                <!-- /.info -->
                                                            </figcaption>
                                                            <img width="145" height=""
                                                                class="img-responsive desaturate" alt="yoko"
                                                                src="assets/images/brands/12.png">
                                                        </figure>
                                                    </a>
                                                </div>
                                                <!-- .item -->
                                            </div>
                                        </div>
                                        <!-- .col-full -->
                                    </section>
                                    <!-- .brands-carousel -->
                                </div>
                                <!-- .product -->
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