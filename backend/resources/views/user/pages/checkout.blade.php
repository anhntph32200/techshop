@extends('user.layout')

@section('content')

    <body class="woocommerce-active page-template-default woocommerce-checkout woocommerce-page can-uppercase">
        <div id="page" class="hfeed site">

            @include('user.partials.header')

            @include('user.partials.menu')

            <div id="content" class="site-content">
                <div class="col-full">
                    <div class="row">
                        <nav class="woocommerce-breadcrumb">
                            <a href="{{ route('users.index') }}">Trang chủ</a>
                            <span class="delimiter">
                                <i class="tm tm-breadcrumbs-arrow-right"></i>
                            </span>
                            Thanh toán
                        </nav>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="content-area" id="primary">
                            <main class="site-main" id="main">
                                <div class="type-page hentry">
                                    <div class="entry-content">
                                        <div class="woocommerce">
                                            <div class="woocommerce-info">
                                                <form action="{{ route('checkout') }}" method="POST">
                                                    @csrf
                                                    <td class="actions" colspan="6">
                                                        <div class="coupon">
                                                            <label for="shipping_id">Chọn phương thức giao hàng:</label>
                                                            <select name="shipping_id" id="shipping_id">
                                                                @foreach ($shippings as $shipping)
                                                                    <option value="{{ $shipping->id }}"
                                                                        {{ request('shipping_id') == $shipping->id ? 'selected' : '' }}>
                                                                        {{ $shipping->name }} -
                                                                        {{ number_format($shipping->cost, 0, ',', '.') }}đ
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input  type="text" placeholder="Mã giảm giá"
                                                                name="promo_code" id="promo_code"
                                                                value="{{ request('promo_code') }}">
                                                            <button style="color: aliceblue"  type="submit">Áp dụng</button>
                                                        </div>
                                                    </td>
                                                </form>
                                            </div>
                                            <form action="{{ route('checkout.place') }}"
                                                class="checkout woocommerce-checkout" method="POST">
                                                @csrf
                                                <div id="customer_details" class="col2-set">
                                                    <div class="col-1">
                                                        <div class="woocommerce-billing-fields">
                                                            <h3>Thông tin thanh toán</h3>
                                                            <div class="woocommerce-billing-fields__field-wrapper-outer">
                                                                <div class="woocommerce-billing-fields__field-wrapper">
                                                                    <p id="billing_first_name_field"
                                                                    class="form-row form-row-wide address-field validate-required">
                                                                        <label class="" for="billing_first_name">Họ và tên
                                                                            <abbr title="required" class="required">*</abbr>
                                                                        </label>
                                                                        <input value="{{ old('name', $user->name) }}" type="text" value="" placeholder=""
                                                                            id="name"
                                                                            name="name" class="input-text "
                                                                            required>
                                                                    </p>
                                                                    <div class="clear"></div>
                                                                    {{-- <p id="billing_country_field"
                                                                        class="form-row form-row-wide validate-required validate-email">
                                                                        <label class="" for="billing_country">Quốc gia
                                                                            <abbr title="required" class="required">*</abbr>
                                                                        </label>
                                                                        <select autocomplete="country"
                                                                            class="country_to_state country_select select2-hidden-accessible"
                                                                            id="billing_country" name="billing_country"
                                                                            tabindex="-1" aria-hidden="true">
                                                                            <option value="">Chọn quốc gia…</option>
                                                                            <option value="ZM">Việt Nam </option>
                                                                        </select>
                                                                    </p> --}}
                                                                    <div class="clear"></div>
                                                                    <p id="billing_address_1_field"
                                                                        class="form-row form-row-wide address-field validate-required">
                                                                        <label class="" for="billing_address_1">Địa
                                                                            chỉ
                                                                            <abbr title="required" class="required">*</abbr>
                                                                        </label>
                                                                        <input  value="{{ old('address', $user->address) }}" type="text" value=""
                                                                            placeholder="Địa chỉ" id="address"
                                                                            name="address" class="input-text "
                                                                            required>
                                                                    </p>
                                                                    {{-- <p id="billing_address_2_field"
                                                                        class="form-row form-row-wide address-field">
                                                                        <input type="text" value=""
                                                                            placeholder="Căn hộ, phòng, đơn vị... (tùy chọn)"
                                                                            id="billing_address_2"
                                                                            name="billing_address_2" class="input-text ">
                                                                    </p> --}}
                                                                    {{-- <p id="billing_city_field"
                                                                        class="form-row form-row-wide address-field validate-required">
                                                                        <label class="" for="billing_city">Thành phố
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input type="text" value=""
                                                                            placeholder="" id="billing_city"
                                                                            name="billing_city" class="input-text "
                                                                            required>
                                                                    </p> --}}
                                                                    {{-- <p id="billing_state_field"
                                                                        class="form-row form-row-wide validate-required validate-email">
                                                                        <label class="" for="billing_state">Tỉnh /
                                                                            Hạt
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <select data-placeholder=""
                                                                            autocomplete="address-level1"
                                                                            class="state_select select2-hidden-accessible"
                                                                            id="billing_state" name="billing_state"
                                                                            tabindex="-1" aria-hidden="true">
                                                                            <option value="">Chọn tùy chọn…</option>
                                                                            <option value="LD">Lakshadeep</option>
                                                                            <option value="PY">Pondicherry (Puducherry)
                                                                            </option>
                                                                        </select>
                                                                    </p> --}}
                                                                    {{-- <p id="billing_postcode_field"
                                                                        class="form-row form-row-wide address-field validate-postcode validate-required">
                                                                        <label class="" for="billing_postcode">Mã
                                                                            bưu điện / ZIP
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input type="text" value=""
                                                                            placeholder="" id="billing_postcode"
                                                                            name="billing_postcode" class="input-text ">
                                                                    </p> --}}
                                                                    <p id="billing_phone_field"
                                                                        class="form-row form-row-last validate-required validate-phone">
                                                                        <label class="" for="billing_phone">Điện
                                                                            thoại
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input value="{{ old('phone', $user->phone) }}" type="tel" value=""
                                                                            placeholder="" id="phone"
                                                                            name="phone" class="input-text "
                                                                            required>
                                                                    </p>
                                                                    {{-- <p id="billing_email_field"
                                                                        class="form-row form-row-first validate-required validate-email">
                                                                        <label class="" for="billing_email">Địa chỉ
                                                                            Email
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input type="email" value=""
                                                                            placeholder="" id="billing_email"
                                                                            name="billing_email" class="input-text ">
                                                                    </p> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <div class="woocommerce-account-fields">
                                                            <div class="create-account collapse" id="createLogin">
                                                                <p data-priority="" id="account_password_field"
                                                                    class="form-row validate-required woocommerce-invalid woocommerce-invalid-required-field">
                                                                    <label class="" for="account_password">Mật khẩu
                                                                        tài khoản
                                                                        <abbr title="required" class="required">*</abbr>
                                                                    </label>
                                                                    <input type="password" value=""
                                                                        placeholder="Mật khẩu" id="account_password"
                                                                        name="account_password" class="input-text ">
                                                                </p>
                                                                <div class="clear"></div>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                    <div class="col-2">
                                                        {{-- <div class="woocommerce-shipping-fields">
                                                            <h3 id="ship-to-different-address">
                                                                <label
                                                                    class="collapsed woocommerce-form__label woocommerce-form__label-for-checkbox checkbox"
                                                                    data-toggle="collapse" data-target="#shipping-address"
                                                                    aria-controls="shipping-address">
                                                                    <input id="ship-to-different-address-checkbox"
                                                                        class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox"
                                                                        type="checkbox" value="1"
                                                                        name="ship_to_different_address">
                                                                    <span>Gửi đến địa chỉ khác?</span>
                                                                </label>
                                                            </h3>
                                                            <div class="shipping_address collapse" id="shipping-address">
                                                                <div class="woocommerce-shipping-fields__field-wrapper">
                                                                    <p id="shipping_first_name_field"
                                                                        class="form-row form-row-first validate-required">
                                                                        <label class="" for="shipping_first_name">Họ
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input type="text" autofocus="autofocus"
                                                                            autocomplete="given-name" value=""
                                                                            placeholder="" id="shipping_first_name"
                                                                            name="shipping_first_name"
                                                                            class="input-text ">
                                                                    </p>
                                                                    <p id="shipping_last_name_field"
                                                                        class="form-row form-row-last validate-required">
                                                                        <label class="" for="shipping_last_name">Tên
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input type="text" autocomplete="family-name"
                                                                            value="" placeholder=""
                                                                            id="shipping_last_name"
                                                                            name="shipping_last_name" class="input-text ">
                                                                    </p>
                                                                    <p id="shipping_company_field"
                                                                        class="form-row form-row-wide">
                                                                        <label class="" for="shipping_company">Tên
                                                                            công ty</label>
                                                                        <input type="text" autocomplete="organization"
                                                                            value="" placeholder=""
                                                                            id="shipping_company" name="shipping_company"
                                                                            class="input-text ">
                                                                    </p>
                                                                    <p id="shipping_country_field"
                                                                        class="form-row form-row-wide address-field update_totals_on_change validate-required woocommerce-validated">
                                                                        <label class="" for="shipping_country">Quốc
                                                                            gia
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <select autocomplete="country"
                                                                            class="country_to_state country_select select2-hidden-accessible"
                                                                            id="shipping_country" name="shipping_country"
                                                                            tabindex="-1" aria-hidden="true">
                                                                            <option value="">Chọn quốc gia…</option>
                                                                            <option value="LD">Lakshadeep</option>
                                                                            <option value="PY">Pondicherry (Puducherry)
                                                                            </option>
                                                                        </select>
                                                                    </p>
                                                                    <p data-priority="90" id="shipping_postcode_field"
                                                                        class="form-row form-row-wide address-field validate-postcode validate-required">
                                                                        <label class="" for="shipping_postcode">Mã
                                                                            bưu điện / ZIP
                                                                            <abbr title="required"
                                                                                class="required">*</abbr>
                                                                        </label>
                                                                        <input type="text" autocomplete="postal-code"
                                                                            value="" placeholder=""
                                                                            id="shipping_postcode"
                                                                            name="shipping_postcode" class="input-text ">
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div> --}}
                                                        <div class="woocommerce-additional-fields">
                                                            <div class="woocommerce-additional-fields__field-wrapper">
                                                                <p id="order_comments_field" class="form-row notes">
                                                                    <label class="" for="order_comments">Ghi chú đơn
                                                                        hàng</label>
                                                                    <textarea cols="5" rows="2"
                                                                        placeholder="Ghi chú về đơn hàng của bạn, ví dụ như ghi chú đặc biệt cho việc giao hàng." id="order_comments"
                                                                        class="input-text " name="note"></textarea>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h3 id="order_review_heading">Đơn hàng của bạn</h3>
                                                <div class="woocommerce-checkout-review-order" id="order_review">
                                                    <div class="order-review-wrapper">
                                                        <table class="shop_table woocommerce-checkout-review-order-table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="product-name">Sản phẩm</th>
                                                                    <th class="product-name">Số lượng</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cartDetails as $detail)
                                                                    <tr class="cart_item">
                                                                        <td class="product-name">
                                                                            {{ $detail->productVariant->product->name }}
                                                                        </td>
                                                                        {{-- <td class="product-total">{{ number_format($detail->productVariant->listed_price, 0, ',', '.') }}
                                                                                VND</td> --}}
                                                                        <td class="product-total">{{ $detail->quantity }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="cart-subtotal">
                                                                    <th>Tổng giá trị sản phẩm</th>
                                                                    <td class="product-total">
                                                                        {{ number_format($totalPrice, 0, ',', '.') }}
                                                                        VND</td>
                                                                </tr>
                                                                <tr class="cart-subtotal">
                                                                    <th>Shipping</th>
                                                                    <td class="product-total">
                                                                        {{ number_format($shippingCost, 0, ',', '.') }}
                                                                        VND</td>
                                                                </tr>
                                                                <tr class="cart-subtotal">
                                                                    <th>Mã giảm giá</th>
                                                                    <td class="product-total">
                                                                        {{ number_format($discount, 0, ',', '.') }}
                                                                        VND</td>
                                                                </tr>
                                                                <tr class="order-total">
                                                                    <th>Tổng</th>
                                                                    <td class="product-total">
                                                                        {{ number_format($finalTotal, 0, ',', '.') }}
                                                                        VND</td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>

                                                        <div class="woocommerce-checkout-payment" id="payment">
                                                            <ul class="wc_payment_methods payment_methods methods">
                                                                <li class="wc_payment_method payment_method_cod">
                                                                    <input type="radio" value="cod"
                                                                        name="payment_method" class="input-radio"
                                                                        id="payment_method_cod">
                                                                    <label for="payment_method_cod">Thanh toán khi nhận
                                                                        hàng</label>
                                                                </li>
                                                                {{-- <li class="wc_payment_method payment_method_momo">
                                                                    <input type="radio" value="momo"
                                                                        name="payment_method" class="input-radio"
                                                                        id="payment_method_momo">
                                                                    <label for="payment_method_momo">Thanh toán qua
                                                                        Momo</label>
                                                                </li> --}}
                                                                <li class="wc_payment_method payment_method_vnpay">
                                                                    <input type="radio" value="vnpay" name="payment_method" class="input-radio" id="payment_method_vnpay">
                                                                    <label for="payment_method_vnpay">Thanh toán qua VNPAY</label>
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        <div class="form-row place-order">
                                                            <button type="submit"
                                                                class="button wc-forward text-center">Đặt hàng</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <script>
                                                // Validate and handle form submission
                                                document.querySelector('.place-order button[type="submit"]').addEventListener('click', function(event) {
                                                    // Lấy form cha
                                                    const form = event.target.closest('form');
                                            
                                                    // Validate payment method
                                                    const selectedPaymentMethod = form.querySelector('input[name="payment_method"]:checked');
                                                    if (!selectedPaymentMethod) {
                                                        event.preventDefault(); // Ngăn chặn gửi form
                                                        alert('Vui lòng chọn phương thức thanh toán.'); // Hiển thị thông báo lỗi
                                                    }
                                                });
                                            </script>
                                            
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
