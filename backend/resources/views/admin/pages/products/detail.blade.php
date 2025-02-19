@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Chi tiết sản phẩm</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                                <li class="breadcrumb-item active">Chi tiết sản phẩm</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row gx-lg-5">
                                <div class="col-xl-4 col-md-8 mx-auto">
                                    <div class="product-img-slider sticky-side-div">
                                        <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                            <div class="swiper-wrapper">
                                                @if ($product->image)
                                                    <div class="swiper-slide text-center">
                                                        <img src="{{ Storage::url($product->image) }}"
                                                            class="img-fluid rounded" alt="Product Image"
                                                            style="height: 300px; width: 300px; object-fit: cover;">
                                                    </div>
                                                @else
                                                    <p>Chưa có ảnh sản phẩm</p>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- end swiper thumbnail slide -->
                                        <div class="swiper product-nav-slider mt-2">
                                            <div class="swiper-wrapper">
                                                <div class="swiper-slide">
                                                    @if ($product->productImages && $product->productImages->isNotEmpty())
                                                        @foreach ($product->productImages as $image)
                                                            @if ($image->image_url)
                                                                <div class="nav-slide-item text-center ">
                                                                    <img src="{{ Storage::url($image->image_url) }}"
                                                                    style="width: 20%;">
                                                                </div>
                                                            @else
                                                                <div class="nav-slide-item">
                                                                    <p>Ảnh không hợp lệ.</p>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <div class="col-12 text-center">
                                                            <p>Chưa có ảnh thư viện.</p>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end swiper nav slide -->
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-xl-8">
                                    <div class="mt-xl-0 mt-5">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <h4>{{ $product->name }}</h4>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <div><a href="#" class="text-primary d-block">ngTanh</a></div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Danh mục : <span
                                                            class="text-body fw-medium">{{ $product->subCategory->name }}</span>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Ngày tạo : <span
                                                            class="text-body fw-medium">{{ $product->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>
                                                    <a href="{{ route('admins.products.edit', $product->id) }}" class="btn btn-light"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Edit"><i class="ri-pencil-fill align-bottom"></i></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                            <div class="text-muted fs-16">
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                                <span class="mdi mdi-star text-warning"></span>
                                            </div>
                                            {{-- <div class="text-muted">( 5.50k Customer Review )</div> --}}
                                        </div>

                                        <div class="row mt-4">
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-money-dollar-circle-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Giá :</p>
                                                            <h5 class="mb-0"> @php
                                                                // Lấy tất cả các giá của biến thể sản phẩm
                                                                $prices = $product->variants
                                                                    ->pluck('listed_price')
                                                                    ->toArray();

                                                                // Nếu có biến thể thì tính khoảng giá
                                                                if (!empty($prices)) {
                                                                    $minPrice = min($prices); // Lấy giá thấp nhất
                                                                    $maxPrice = max($prices); // Lấy giá cao nhất
                                                                    echo number_format($minPrice, 0, ',', '.') .
                                                                        'đ  ' .
                                                                        number_format($maxPrice, 0, ',', '.') .
                                                                        'đ';
                                                                } else {
                                                                    echo 'Chưa có giá';
                                                                }
                                                            @endphp</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-money-dollar-circle-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Giá sale:</p>
                                                            <h5 class="mb-0"> @php
                                                                // Lấy tất cả các giá của biến thể sản phẩm
                                                                $prices = $product->variants
                                                                    ->pluck('sale_price')
                                                                    ->toArray();

                                                                // Nếu có biến thể thì tính khoảng giá
                                                                if (!empty($prices)) {
                                                                    $minPrice = min($prices); // Lấy giá thấp nhất
                                                                    $maxPrice = max($prices); // Lấy giá cao nhất
                                                                    echo number_format($minPrice, 0, ',', '.') .
                                                                        'đ  ' .
                                                                        number_format($maxPrice, 0, ',', '.') .
                                                                        'đ';
                                                                } else {
                                                                    echo 'Chưa có giá';
                                                                }
                                                            @endphp</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class="ri-stack-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Số lượng :</p>
                                                            <h5 class="mb-0">@php
                                                                // Lấy tất cả số lượng của biến thể sản phẩm
                                                                $totalQuantity = $product->variants->sum('quantity'); // Tính tổng số lượng

                                                                // In ra số lượng
                                                                echo $totalQuantity;
                                                            @endphp

                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-lg-3 col-sm-6">
                                                <div class="p-2 border border-dashed rounded">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm me-2">
                                                            <div
                                                                class="avatar-title rounded bg-transparent text-success fs-24">
                                                                <i class=" ri-eye-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="text-muted mb-1">Lượt xem :</p>
                                                            <h5 class="mb-0">
                                                                {{$product->view}}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>

                                        <div class="mt-4 text-muted">
                                            <h5 class="fs-14">Trang thái :</h5>
                                            <div class="row mt-4">
                                                <div class="col-sm-3">
                                                    <p>
                                                        @if ($product->is_show_home == 1)
                                                            <span class="badge bg-success">Hoạt
                                                                Động</span>
                                                        @else
                                                            <span class="badge bg-danger">Ẩn</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p>
                                                        @if ($product->is_hot == 1)
                                                            <span class="badge bg-success">Đang
                                                                hot</span>
                                                        @else
                                                            <span class="badge bg-danger">Ẩn</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p>
                                                        @if ($product->is_sale == 1)
                                                            <span class="badge bg-success">Đang
                                                                sale</span>
                                                        @else
                                                            <span class="badge bg-danger">Ẩn</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" mt-4">
                                            <h5 class="fs-14">Biến thể sản phẩm :</h5>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Chip</th>
                                                            <th>RAM</th>
                                                            <th>SSD</th>
                                                            <th>Giá</th>
                                                            <th>Giá khuyến mãi</th>
                                                            <th>Số lượng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($product->variants as $variant)
                                                            <tr>
                                                                <td>{{ $variant->chip->name ?? 'N/A' }}</td>
                                                                <td>{{ $variant->ram->name ?? 'N/A' }}</td>
                                                                <td>{{ $variant->storage->name ?? 'N/A' }}</td>
                                                                <td>{{ number_format($variant->listed_price) }} VND
                                                                </td>
                                                                <td>{{ number_format($variant->sale_price) }} VND
                                                                </td>
                                                                <td>{{ $variant->quantity }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- end col -->

                                        <div class="product-content mt-5">
                                            <h5 class="fs-14 mb-3">Thông tin sản phẩm :</h5>
                                            <nav>
                                                <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab"
                                                    role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="nav-speci-tab"
                                                            data-bs-toggle="tab" href="#nav-speci" role="tab"
                                                            aria-controls="nav-speci" aria-selected="true">Thông số kỹ
                                                            thuật</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab"
                                                            href="#nav-detail" role="tab" aria-controls="nav-detail"
                                                            aria-selected="false">Mô tả</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="nav-speci" role="tabpanel"
                                                    aria-labelledby="nav-speci-tab">
                                                    <div class="table-responsive">
                                                        <table class="table mb-0">
                                                            <tbody>
                                                                @foreach (explode(';', $product->description) as $spec)
                                                                    @if (trim($spec) !== '')
                                                                        @php
                                                                            // Phân tách thông số kỹ thuật thành hai phần: tiêu đề và giá trị
                                                                            $parts = explode(':', $spec);
                                                                        @endphp
                                                                        <tr>
                                                                            <th>{{ trim($parts[0]) }}</th>
                                                                            <!-- Tiêu đề (ví dụ: RAM, Chip) -->
                                                                            <td>{{ trim($parts[1] ?? '') }}</td>
                                                                            <!-- Giá trị (ví dụ: 8GB, Intel i5) -->
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="nav-detail" role="tabpanel"
                                                    aria-labelledby="nav-detail-tab">
                                                    <div>
                                                        <p>{!! $product->content !!}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product-content -->

                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
@endsection
