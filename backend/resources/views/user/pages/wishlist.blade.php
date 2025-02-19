@extends('user.layout')

@section('content')
<body class="page-template-default page woocommerce-wishlist can-uppercase">
    <div id="page" class="hfeed site">
        @include('user.partials.header')
        @include('user.partials.menu')

        <div id="content" class="site-content">
            <div class="col-full">
                <div class="row">
                    <nav class="woocommerce-breadcrumb">
                        <a href="">Trang chủ</a>
                        <span class="delimiter">
                            <i class="tm tm-breadcrumbs-arrow-right"></i>
                        </span>
                        Sản phẩm yêu thích 
                    </nav>
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <div class="type-page hentry">
                                <header class="entry-header">
                                    <h1 class="entry-title">Sản phẩm yêu thích </h1>
                                </header>

                                <div class="entry-content">
                                    <form class="woocommerce" method="post" action="#">
                                        <table class="shop_table cart wishlist_table">
                                            <thead>
                                                <tr>
                                                    <th class="product-remove"></th>
                                                    <th class="product-thumbnail"></th>
                                                    <th class="product-name"><span class="nobr">Tên sản phẩm</span></th>
                                                    <th class="product-price"><span class="nobr">Giá sản phẩm</span></th>
                                                    <th class="product-stock-status"><span class="nobr">Số lượng </span></th>
                                                    <th class="product-add-to-cart"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    @if ($item->product) <!-- Check if the product exists -->
                                                        <tr>
                                                            <td class="product-remove">
                                                                <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách yêu thích không?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button style="color: aliceblue" type="submit" class="delete">×</button>
                                                                </form>
                                                            </td>
                                                            
                                                            
                                            
                                                            <td class="product-thumbnail">
                                                                <a href="{{ route('product.show', $item->product->id) }}">
                                                                    <img width="150" height="150"
                                                                        alt="{{ $item->product->name }}"
                                                                        class="wp-post-image"
                                                                        src="{{ Storage::url($item->product->image) }}">
                                                                </a>    
                                                            </td>
                                            
                                                            <td class="product-name">
                                                                <a href="{{ route('product.show', $item->product->id) }}">{{ $item->product->name }}</a>
                                                            </td>
                                            
                                                            <td class="product-price">
                                                                {{ number_format($item->product->variants->first()->sale_price, 0, ',', '.') }}đ
                                                            </td>                      
                                            
                                                            <td class="product-stock-status text-center">
                                                                @php
                                                                    $total_quantity = $item->product->variants->sum('quantity');
                                                                @endphp
                                                            
                                                                @if ($total_quantity <= 0)
                                                                    <span style="color: red;">Hết hàng</span>
                                                                @else
                                                                    {{ $total_quantity }}
                                                                @endif
                                                            </td>
                                                            <td class="product-add-to-cart">
                                                                <a href="" class="button">Chi tiết sản phẩm</a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                    </form>
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