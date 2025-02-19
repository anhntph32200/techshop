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
                            Lịch sử đơn hàng
                        </nav>
                        <!-- .woocommerce-breadcrumb -->
                        <div id="primary" class="content-area">
                            <main id="main" class="site-main">
                                <div class="type-page hentry">
                                    <header class="entry-header">
                                        <div class="page-header-caption">
                                            <h1 class="entry-title">Lịch sử đơn hàng</h1>
                                        </div>
                                    </header>
                                    <!-- .entry-header -->
                                    <div class="entry-content">
                                        <div>
                                            <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'all']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'all' ? 'active' : '' }}"
                                                        id="All" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'all' ? 'true' : 'false' }}">
                                                        Tất cả đơn hàng
                                                    </a>
                                                </li>
                                        
                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'cho_xac_nha']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'cho_xac_nha' ? 'active' : '' }}"
                                                        id="Pending" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'cho_xac_nha' ? 'true' : 'false' }}">
                                                        Chờ xác nhận
                                                    </a>
                                                </li>
                                        
                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'da_xac_nha']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'da_xac_nha' ? 'active' : '' }}"
                                                        id="Confirmed" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'da_xac_nha' ? 'true' : 'false' }}">
                                                        Đã xác nhận
                                                    </a>
                                                </li>
                                        
                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'dang_chuan_bi']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'dang_chuan_bi' ? 'active' : '' }}"
                                                        id="Shipped" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'dang_chuan_bi' ? 'true' : 'false' }}">
                                                        Đang chuẩn bị
                                                    </a>
                                                </li>
                                        
                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'dang_van_chuyen']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'dang_van_chuyen' ? 'active' : '' }}"
                                                        id="Delivered" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'dang_van_chuyen' ? 'true' : 'false' }}">
                                                        Đang vận chuyển
                                                    </a>
                                                </li>
                                        
                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'da_nhan_hang']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'da_nhan_hang' ? 'active' : '' }}"
                                                        id="Cancelled" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'da_nhan_hang' ? 'true' : 'false' }}">
                                                        Đã nhận hàng
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="{{ route('cart.myorder', ['filter_status' => 'huy_hang']) }}"
                                                        class="nav-link py-3 {{ request('filter_status') == 'huy_hang' ? 'active' : '' }}"
                                                        id="Cancelled" role="tab"
                                                        aria-selected="{{ request('filter_status') == 'huy_hang' ? 'true' : 'false' }}">
                                                        Đã hủy
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>                                        

                                        <table class="shop_table cart wishlist_table">
                                            <thead>
                                                <tr>
                                                    <th class="product-name" style="color: black; font-size: 18px">
                                                        <span class="nobr">Mã đơn</span>
                                                    </th>
                                                    <th class="product-name" style="color: black; font-size: 18px">
                                                        <span class="nobr">Ngày đặt</span>
                                                    </th>
                                                    <th class="product-name" style="color: black; font-size: 18px">
                                                        <span class="nobr">Khách hàng</span>
                                                    </th>
                                                    <th class="product-name" style="color: black; font-size: 18px">
                                                        <span class="nobr">
                                                            Trạng thái đơn hàng
                                                        </span>
                                                    </th>
                                                    <th class="product-stock-status" style="color: black; font-size: 18px">
                                                        <span class="nobr">
                                                            Trạng thái thanh toán
                                                        </span>
                                                    </th>
                                                    <th class="product-price" style="color: black; font-size: 18px">
                                                        <span class="nobr">
                                                            Tổng tiền
                                                        </span>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($donhang as $items)
                                                    <tr>
                                                        <td class="product-name">
                                                            <a
                                                                href="single-product-fullwidth.html">{{ $items->code }}</a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a
                                                                href="single-product-fullwidth.html">{{ $items->created_at }}</a>
                                                        </td>
                                                        <td class="product-name">
                                                            <a
                                                                href="single-product-fullwidth.html">{{ $items->name }}</a>
                                                        </td>
                                                        <td class="product-name">
                                                            @if ($TrangThaiDonHang[$items->status] == 'Hủy hàng')
                                                                <span
                                                                    style="color: #d32f2f">{{ $TrangThaiDonHang[$items->status] }}</span>
                                                            @else
                                                                <span
                                                                    class="wishlist-in-stock">{{ $TrangThaiDonHang[$items->status] }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="product-name">
                                                            @if ($TrangThaiThanhToan[$items->payment_status] == 'Đã thanh toán')
                                                                <span
                                                                    class="wishlist-in-stock">{{ $TrangThaiThanhToan[$items->payment_status] }}</span>
                                                            @else
                                                                <span
                                                                    style="color: #d32f2f">{{ $TrangThaiThanhToan[$items->payment_status] }}</span>
                                                            @endif
                                                        </td>
                                                        <td class="product-price">
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span
                                                                        class="woocommerce-Price-currencySymbol"></span>{{ number_format($items->money_total, 0, ',', '.') }}
                                                                    VNĐ</span>
                                                            </ins>
                                                        </td>
                                                        <td style="display: flex; align-items: center; gap: 10px;">
                                                            <a style="color: aliceblue; text-align: center; padding: 5px 10px;text-decoration: none;"
                                                                class="button"
                                                                href="{{ route('order.detail', $items->id) }}">
                                                                Xem
                                                            </a>
                                                            <form action="{{ route('cart.editOrder', $items->id) }}"
                                                                method="POST" style="margin: 0;">
                                                                @csrf
                                                                @method('PUT')
                                                                @if ($items->status === $typeChoXacNha)
                                                                    <input type="hidden" name="status"
                                                                        value="huy_hang">
                                                                    <button
                                                                        style="color: aliceblue; padding: 5px 10px; background-color: #d32f2f; border: none; cursor: pointer;"
                                                                        type="submit">
                                                                        Hủy hàng
                                                                    </button>
                                                                @elseif($items->status === $typeDangVanChuyen)
                                                                    <input type="hidden" name="status"
                                                                        value="da_nhan_hang">
                                                                    <button
                                                                        style="color: aliceblue; padding: 5px 10px; border: none; cursor: pointer;"
                                                                        type="submit">
                                                                        Đã nhận hàng
                                                                    </button>
                                                                @endif
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if(session('success'))
                                                <script>
                                                    alert("{{ session('success') }}");
                                                </script>
                                            @endif
                                            
                                            @if(session('error'))
                                                <script>
                                                    alert("{{ session('error') }}");
                                                </script>
                                            @endif
                                            
                                                <div>
                                                    {{ $donhang->links() }}
                                                </div>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6">
                                                        <div class="yith-wcwl-share">
                                                            <h4 class="yith-wcwl-share-title">Share on:</h4>
                                                            <ul>
                                                                <li style="list-style-type: none; display: inline-block;">
                                                                    <a title="Facebook"
                                                                        href="https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D=My+wishlist+on+Tech+Market&amp;p%5Burl%5D=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F"
                                                                        class="facebook" target="_blank"></a>
                                                                </li>
                                                                <li style="list-style-type: none; display: inline-block;">
                                                                    <a title="Twitter"
                                                                        href="https://twitter.com/share?url=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;text="
                                                                        class="twitter" target="_blank"></a>
                                                                </li>
                                                                <li style="list-style-type: none; display: inline-block;">
                                                                    <a onclick="window.open(this.href); return false;"
                                                                        title="Pinterest"
                                                                        href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;description=&amp;media="
                                                                        class="pinterest" target="_blank"></a>
                                                                </li>
                                                                <li style="list-style-type: none; display: inline-block;">
                                                                    <a onclick="javascript:window.open(this.href, &quot;&quot;, &quot;menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600&quot;);return false;"
                                                                        title="Google+"
                                                                        href="https://plus.google.com/share?url=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;title=My+wishlist+on+Tech+Market"
                                                                        class="googleplus" target="_blank"></a>
                                                                </li>
                                                                <li style="list-style-type: none; display: inline-block;">
                                                                    <a title="Email"
                                                                        href="mailto:?subject=I+wanted+you+to+see+this+site&amp;body=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;title=My+wishlist+on+Tech+Market"
                                                                        class="email"></a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <!-- .wishlist_table -->

                                        <!-- .woocommerce -->
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
            <!-- .col-full -->
            @include('user.partials.footer')
        </div>
        <!-- #content -->

        @include('user.partials.js')

    </body>
@endsection
