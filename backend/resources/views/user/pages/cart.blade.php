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
                            <a href="{{ route('users.index') }}">Trang chủ</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>
                            Giỏ hàng
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <div class="entry-content">
                                        <div class="woocommerce">
                                            <div class="cart-wrapper">
                                                <table class="shop_table shop_table_responsive cart">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-remove">&nbsp;</th>
                                                            <th class="product-thumbnail">&nbsp;</th>
                                                            <th class="product-image">Hình ảnh</th>
                                                            <th class="product-name">Sản phẩm</th>
                                                            <th class="product-price">Giá</th>
                                                            <th class="product-quantity">Số lượng</th>
                                                            <th class="product-subtotal">Tổng cộng</th>
                                                            <th class="product-delete">Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @error('quantity')
                                                            <span class="error-message" style="color: red;">{{ $message }}</span>
                                                        @enderror
                                                        @foreach ($cartDetail as $detail)
                                                            <tr>
                                                                <td class="product-image">
                                                                    <a
                                                                        href="{{ route('users.products.show', $detail->productVariant->product->id) }}">
                                                                        <img width="150" height="150"
                                                                            alt="{{ $detail->productVariant->product->name }}"
                                                                            class="wp-post-image"
                                                                            src="{{ Storage::url($detail->productVariant->product->image) }}">
                                                                    </a>
                                                                </td>
                                                                <td data-title="Product" class="product-name">
                                                                    <a
                                                                        href="{{ route('users.products.show', $detail->productVariant->product->id) }}">
                                                                        {{ $detail->productVariant->product->name }}
                                                                    </a>
                                                                    <div>
                                                                        @if ($detail->productVariant->chip->name !== 'Không áp dụng')
                                                                            <strong>Chip:</strong>
                                                                            {{ $detail->productVariant->chip->name }} <br>
                                                                        @endif

                                                                        @if ($detail->productVariant->ram->name !== 'Không áp dụng')
                                                                            <strong>RAM:</strong>
                                                                            {{ $detail->productVariant->ram->name }} <br>
                                                                        @endif

                                                                        @if ($detail->productVariant->storage->name !== 'Không áp dụng')
                                                                            <strong>Storage:</strong>
                                                                            {{ $detail->productVariant->storage->name }}
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td data-title="Price" class="product-price">
                                                                    {{ number_format($detail->productVariant->sale_price ?? $detail->productVariant->listed_price, 0, ',', '.') }}
                                                                    đ
                                                                </td>
                                                                <td class="product-quantity text-center"
                                                                    data-title="Quantity">
                                                                    <form action="{{ route('cart.update', $detail->id) }}"
                                                                        method="post" class="quantity-form">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="quantity">
                                                                            <button style="color: aliceblue" type="button"
                                                                                class="btn-minus">−</button>
                                                                            <input id="quantity-input-{{ $detail->id }}"
                                                                                type="number" name="quantity"
                                                                                value="{{ $detail->quantity }}"
                                                                                title="Qty" class="input-text qty text"
                                                                                size="4" min="1">
                                                                            <button style="color: aliceblue" type="button"
                                                                                class="btn-plus">+</button>
                                                                        </div>
                                                                    </form>
                                                                </td>
                                                                <td data-title="Total" class="product-subtotal">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {{ number_format(($detail->productVariant->sale_price ?? $detail->productVariant->listed_price) * $detail->quantity, 0, ',', '.') }}
                                                                        đ
                                                                    </span>
                                                                </td>
                                                                <td class="product-delete text-center">
                                                                    <form action="{{ route('cart.destroy', $detail->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button style="color: aliceblue" type="submit" class="remove">Xóa</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                <div class="cart-collaterals">
                                                    <div class="cart_totals">
                                                        <h2>Tổng tiền giỏ hàng</h2>
                                                        <table class=" woocommerce-checkout-review-order-table">
                                                            <tbody>
                                                                <tr class="order-total">
                                                                    <th>Tổng cộng</th>
                                                                    <td data-title="Total">
                                                                        <strong>
                                                                            <span class="woocommerce-Price-amount amount">
                                                                                <span
                                                                                    class="woocommerce-Price-currencySymbol"></span>{{ number_format($total, 0, ',', '.') }}
                                                                                VND</span>
                                                                        </strong>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                        <div class="wc-proceed-to-checkout">
                                                            <form action="{{ route('checkout') }}" method="POST">
                                                                @csrf
                                                                
                                                                    <button style="width: 100%"  class="checkout-button button alt wc-forward" type="submit">Tiến
                                                                        hành
                                                                        thanh toán</button> 
                                                            </form>

                                                            <a class="back-to-shopping" href="{{ route('users.filter') }}">Quay lại mua
                                                                sắm</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>

            @include('user.partials.footer')

        </div>

        @include('user.partials.js')

    </body>
@endsection

@section('js')
    <script>
        document.querySelectorAll('.btn-plus').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                let value = parseInt(input.value);
                input.value = value + 1; // Tăng giá trị lên 1
                this.closest('form').submit(); // Submit form cha
            });
        });

        document.querySelectorAll('.btn-minus').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling;
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1; // Giảm giá trị xuống 1 nếu lớn hơn 1
                }
                this.closest('form').submit(); // Submit form cha
            });
        });
    </script>
@endsection
