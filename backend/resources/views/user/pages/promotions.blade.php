@extends('user.layout')
<style>
    .promo-container {
    padding: 20px;
    font-family: Arial, sans-serif;
    }

    .promo-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .promo-title {
        font-size: 32px;
        font-weight: bold;
    }

    .promo-description {
        font-size: 16px;
        color: #666;
    }

    .promo-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .promo-item {
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .promo-code-title {
        font-size: 20px;
        font-weight: bold;
        color: #e74c3c;
    }

    .promo-code {
        font-size: 22px;
        font-weight: bold;
    }

    .promo-details {
        margin: 10px 0;
        font-size: 14px;
    }

    .promo-condition {
        font-size: 14px;
        color: #333;
    }

    .btn-copy-promo {
        padding: 10px 20px;
        background-color: #e74c3c;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .promo-terms, .promo-instructions {
        margin-top: 30px;
    }

    .promo-terms-title, .promo-instructions-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
    }

    .promo-terms-list, .promo-instructions-list {
        list-style-type: disc;
        margin-left: 20px;
    }

    .promo-terms-list li, .promo-instructions-list li {
        font-size: 14px;
        color: #666;
    }

</style>
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
                        Khuyến Mãi
                    </nav>
                    <!-- .woocommerce-breadcrumb -->
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <div class="type-page hentry">
                                <div class="promo-container">
                                    <!-- Title Section -->
                                    <div class="promo-header">
                                        <h1 class="promo-title">Khuyến Mãi Đặc Biệt</h1>
                                        <p class="promo-description">
                                            Chào mừng bạn đến với các chương trình khuyến mãi của chúng tôi! Hãy tận dụng các cơ hội giảm giá hấp dẫn để mua sắm những sản phẩm yêu thích.
                                        </p>
                                    </div>
                                
                                    <!-- Active Promotions -->
                                    <div class="promo-list">
                                        @foreach ($promotions as $item)
                                            <div class="promo-item">
                                                <h2 class="promo-code-title">Mã Giảm Giá: <span class="promo-code">{{ $item->code }}</span></h2>
                                                <p class="promo-details">Giảm giá 
                                                    @if ( $item->discount_type == "percentage")
                                                        {{ number_format($item->discount, 0, ',', '.')}}%
                                                    @else
                                                        {{ number_format($item->discount, 0, ',', '.')}}VNĐ
                                                    @endif
                                                    cho tất cả các sản phẩm! Áp dụng ngay hôm nay.</p>
                                                <p class="promo-condition">
                                                    <strong>Điều kiện:</strong> Áp dụng cho đơn hàng từ   {{ number_format($item->minimum_spend, 0, ',', '.')}}VNĐ trở lên. Không áp dụng đồng thời với các chương trình khuyến mãi khác.
                                                </p>
                                                <p class="promo-condition">
                                                    <strong>Thời gian:</strong> Từ {{$item->start_date}} đến {{$item->end_date}}
                                                </p>
                                                <p class="promo-condition">
                                                    <strong>Số lượng:</strong> {{$item->usage_limit}}
                                                </p>
                                                <button class="btn-copy-promo" data-promo-code="{{ $item->code }}">Copy Mã</button>
                                            </div>
                                        @endforeach
                                    </div>
                                
                                    <!-- Terms and Conditions -->
                                    <div class="promo-terms">
                                        <h3 class="promo-terms-title">Điều Khoản và Điều Kiện</h3>
                                        <ul class="promo-terms-list">
                                            <li>Mã giảm giá chỉ có giá trị trong thời gian khuyến mãi.</li>
                                            <li>Chúng tôi có quyền thay đổi điều kiện khuyến mãi mà không cần thông báo trước.</li>
                                        </ul>
                                    </div>
                                
                                    <!-- Instructions for Applying Promo Code -->
                                    <div class="promo-instructions">
                                        <h3 class="promo-instructions-title">Hướng Dẫn Sử Dụng Mã Khuyến Mại</h3>
                                        <ol class="promo-instructions-list">
                                            <li>Chọn sản phẩm bạn muốn mua và thêm vào giỏ hàng tiến hành thanh toán.</li>
                                            <li>Nhập mã khuyến mại vào ô "Mã Giảm Giá".</li>
                                            <li>Nhấn nút "Áp Dụng Mã" để nhận ưu đãi.</li>
                                            <li>Hoàn tất thanh toán và tận hưởng mức giá ưu đãi!</li>
                                        </ol>
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
<script>
    document.querySelectorAll('.btn-copy-promo').forEach(function(button) {
    button.addEventListener('click', function() {
        const promoCode = button.getAttribute('data-promo-code');
        
        const tempInput = document.createElement('input');
        document.body.appendChild(tempInput);
        tempInput.value = promoCode;
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        alert(`Mã khuyến mãi ${promoCode} đã được sao chép!`);
    });
});

</script>
@endsection
