@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Danh sách sản phẩm</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Sản phẩm</a></li>
                                <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <form method="GET" action="" class="mb-4">
                    <div class="row">
                        <!-- Lọc theo danh mục con -->
                        <div class="col-md-3">
                            <label for="sub_category_id">Danh mục con</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                <option value="">-- Tất cả --</option>
                                @foreach ($subCategories as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ request('sub_category_id') == $id ? 'selected' : '' }}>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Lọc theo Chip -->
                        <div class="col-md-3">
                            <label for="chip_id">Chip</label>
                            <select name="chip_id" id="chip_id" class="form-control">
                                <option value="">-- Tất cả --</option>
                                @foreach ($chips as $id => $name)
                                    <option value="{{ $id }}" {{ request('chip_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Lọc theo RAM -->
                        <div class="col-md-3">
                            <label for="ram_id">RAM</label>
                            <select name="ram_id" id="ram_id" class="form-control">
                                <option value="">-- Tất cả --</option>
                                @foreach ($rams as $id => $name)
                                    <option value="{{ $id }}" {{ request('ram_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Lọc theo bộ nhớ (Storage) -->
                        <div class="col-md-3">
                            <label for="storage_id">Bộ nhớ</label>
                            <select name="storage_id" id="storage_id" class="form-control">
                                <option value="">-- Tất cả --</option>
                                @foreach ($storages as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ request('storage_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Lọc theo trạng thái (is_hot, is_sale, is_show_home) -->
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="is_hot">Nổi bật</label>
                            <select name="is_hot" id="is_hot" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1" {{ request('is_hot') == '1' ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ request('is_hot') == '0' ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="is_sale">Giảm giá</label>
                            <select name="is_sale" id="is_sale" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1" {{ request('is_sale') == '1' ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ request('is_sale') == '0' ? 'selected' : '' }}>Không</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="is_show_home">Hiển thị trang chủ</label>
                            <select name="is_show_home" id="is_show_home" class="form-control">
                                <option value="">-- Tất cả --</option>
                                <option value="1" {{ request('is_show_home') == '1' ? 'selected' : '' }}>Có</option>
                                <option value="0" {{ request('is_show_home') == '0' ? 'selected' : '' }}>Không
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="price_range">Lọc theo giá:</label>
                            <select name="price_range" id="price_range" class="form-control">
                                <option value="">Chọn khoảng giá</option>
                                <option value="under_1m" {{ request('price_range') == 'under_1m' ? 'selected' : '' }}>Dưới
                                    1 triệu</option>
                                <option value="1m_5m" {{ request('price_range') == '1m_5m' ? 'selected' : '' }}>1 - 5
                                    triệu</option>
                                <option value="5m_15m" {{ request('price_range') == '5m_15m' ? 'selected' : '' }}>5 - 15
                                    triệu</option>
                                <option value="15m_25m" {{ request('price_range') == '15m_25m' ? 'selected' : '' }}>15 - 25
                                    triệu</option>
                                <option value="above_25m" {{ request('price_range') == 'above_25m' ? 'selected' : '' }}>
                                    Trên 25 triệu</option>
                            </select>
                        </div>

                        <div class="col-md-3 mt-4">
                            <button type="submit" class="btn btn-primary w-100">Lọc</button>
                        </div>
                    </div>
                </form>
                <!-- end col -->

                <div class="col-xl-12 col-lg-12">
                    <div>
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="row g-4">
                                    <div class="col-sm-auto">
                                        <div>
                                            <a href="{{ route('admins.products.create') }}" class="btn btn-success"
                                                id="addproduct-btn"><i class="ri-add-line align-bottom me-1"></i> Thêm sản
                                                phẩm</a>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="d-flex justify-content-sm-end">
                                            <div class="search-box ms-2">
                                                <input type="text" class="form-control" id="searchProductList"
                                                    placeholder="Search Products...">
                                                <i class="ri-search-line search-icon"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card header -->
                            <div class="card-body">
                                <table id="example"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th data-ordering="false">ID</th>
                                            <th data-ordering="false">IMG</th>
                                            <th data-ordering="false">Tên SP</th>
                                            <th data-ordering="false">Danh mục</th>
                                            <th data-ordering="false">Giá</th>
                                            <th data-ordering="false">Giá KM</th>
                                            <th>Số lượng</th>
                                            <th>Ngày tạo</th>
                                            <th>Trạng thái</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>
                                                    @if ($item->image)
                                                        <img src="{{ Storage::url($item->image) }}"
                                                            alt="{{ $item->name }}"
                                                            style="width: 100px; height: auto;">
                                                    @else
                                                        <span>Không có ảnh</span>
                                                    @endif
                                                </td>
                                                <td><a href="#!">{{ $item->name }}</a></td>
                                                <td>{{ $item->subCategory->name }}</td>
                                                <td>
                                                    @php
                                                        // Lấy tất cả các giá của biến thể sản phẩm
                                                        $prices = $item->variants->pluck('listed_price')->toArray();

                                                        // Nếu có biến thể thì tính khoảng giá
                                                        if (!empty($prices)) {
                                                            $minPrice = min($prices); // Lấy giá thấp nhất
                                                            $maxPrice = max($prices); // Lấy giá cao nhất
                                                            echo number_format($minPrice, 0, ',', '.') .
                                                                ' - ' .
                                                                number_format($maxPrice, 0, ',', '.') .
                                                                '';
                                                        } else {
                                                            echo 'Chưa có giá';
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        // Lấy tất cả các giá của biến thể sản phẩm
                                                        $prices = $item->variants->pluck('sale_price')->toArray();

                                                        // Nếu có biến thể thì tính khoảng giá
                                                        if (!empty($prices)) {
                                                            $minPrice = min($prices); // Lấy giá thấp nhất
                                                            $maxPrice = max($prices); // Lấy giá cao nhất
                                                            echo number_format($minPrice, 0, ',', '.') .
                                                                ' - ' .
                                                                number_format($maxPrice, 0, ',', '.') .
                                                                '';
                                                        } else {
                                                            echo 'Chưa có giá';
                                                        }
                                                    @endphp
                                                </td>
                                                <td>
                                                    @php
                                                        // Lấy tất cả số lượng của biến thể sản phẩm
                                                        $totalQuantity = $item->variants->sum('quantity'); // Tính tổng số lượng
                                                    @endphp

                                                    @if ($totalQuantity == 0)
                                                        <span class="text-danger">Hết hàng</span>
                                                        <!-- Hiển thị chữ màu đỏ nếu số lượng = 0 -->
                                                    @else
                                                        <span>{{ $totalQuantity }}</span>
                                                        <!-- Hiển thị số lượng nếu có sản phẩm -->
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td> <!-- Hiển thị trạng thái -->
                                                    @if ($item->is_show_home == 1)
                                                        <span class="badge bg-success-subtle text-success">Hoạt Động</span>
                                                    @else
                                                        <span class="badge bg-danger-subtle text-danger">Ẩn</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="dropdown d-inline-block">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown"
                                                            type="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <!-- Nút Xem Chi Tiết -->
                                                            <li>
                                                                <a href="{{ route('admins.products.show', $item->id) }}"
                                                                    class="dropdown-item">
                                                                    <i
                                                                        class="ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                    Xem chi tiết
                                                                </a>
                                                            </li>
                                                            <!-- Nút Sửa -->
                                                            <li>
                                                                <a href="{{ route('admins.products.edit', $item->id) }}"
                                                                    class="dropdown-item edit-item-btn">
                                                                    <i
                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                    Sửa
                                                                </a>
                                                            </li>
                                                            <!-- Nút Xóa -->
                                                            <li>
                                                                <form
                                                                    action="{{ route('admins.products.destroy', $item->id) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a class="dropdown-item remove-item-btn">
                                                                        <i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        <button type="submit"
                                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');"
                                                                            style="background: none; border: none; cursor: pointer; text-decoration: none;">
                                                                            Xóa
                                                                        </button>
                                                                    </a>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- end tab content -->
                                <div>
                                    {{ $data->links() }}
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->

        </div>
        <!-- container-fluid -->
    </div>
@endsection
