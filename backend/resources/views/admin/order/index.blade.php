@extends('admin.layout')
@section('title')
    danh sách đơn hàng
@endsection
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">DS đơn hàng</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Đơn hàng</a></li>
                                <li class="breadcrumb-item active">Ds đơn hàng</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admins.orders.index') }}" method="GET" class="mb-3">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label for="from_date" class="form-label">Từ ngày</label>
                                        <input type="date" name="from_date" id="from_date" class="form-control"
                                            value="{{ request('from_date') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="to_date" class="form-label">Đến ngày</label>
                                        <input type="date" name="to_date" id="to_date" class="form-control"
                                            value="{{ request('to_date') }}">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="search" class="form-label">Tìm kiếm</label>
                                        <input type="text" name="search" id="search" class="form-control"
                                            placeholder="Tìm kiếm mã đơn hàng, tên khách hàng..."
                                            value="{{ request('search') }}">
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <button type="submit" class="btn btn-primary w-100">Lọc</button>
                                    </div>
                                </div>
                            </form>

                            @php
                                if (!function_exists('getIconForStatus')) {
                                    function getIconForStatus($status)
                                    {
                                        $icons = [
                                            'pending' => 'fas fa-hourglass-half', // Chờ xử lý
                                            'completed' => 'fas fa-check-circle', // Hoàn thành
                                            'canceled' => 'fas fa-times-circle', // Hủy
                                            'delivered' => 'fas fa-truck', // Đã giao hàng
                                            'processing' => 'fas fa-cogs', // Đang xử lý
                                            'on_hold' => 'fas fa-pause-circle', // Tạm giữ
                                            'refunded' => 'fas fa-undo-alt', // Hoàn tiền
                                            'failed' => 'fas fa-exclamation-triangle', // Thất bại
                                            'draft' => 'fas fa-file-alt', // Bản nháp
                                        ];

                                        return $icons[$status] ?? 'fas fa-question-circle'; // Default icon
                                    }
                                }
                            @endphp

                            <div class="card-body pt-0">
                                <div>
                                    <ul class="nav nav-tabs nav-tabs-custom nav-success mb-3" role="tablist">

                                        <li class="nav-item">
                                            <a href="{{ route('admins.orders.index', ['filter_status' => 'all']) }}"
                                                class="nav-link py-3 All {{ request('filter_status') == 'all' ? 'active' : '' }}"
                                                id="All" role="tab"
                                                aria-selected="{{ request('filter_status') == 'all' ? 'true' : 'false' }}">
                                                <i class="fas fa-list me-1 align-bottom"></i> Tất cả đơn hàng
                                            </a>
                                        </li>

                                        @foreach ($trangThaiDonHang as $key => $value)
                                            <li class="nav-item">
                                                <a href="{{ route('admins.orders.index', ['filter_status' => $key]) }}"
                                                    class="nav-link py-3 {{ request('filter_status') == $key ? 'active' : '' }}"
                                                    id="{{ ucfirst($key) }}" role="tab"
                                                    aria-selected="{{ request('filter_status') == $key ? 'true' : 'false' }}">
                                                    <i class="{{ getIconForStatus($key) }} me-1 align-bottom"></i>
                                                    {{ $value }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th scope="col">Mã sản phẩm</th>
                                                <th scope="col">Ngày đặt</th>
                                                <th scope="col">Trạng thái</th>
                                                <th scope="col">Tổng tiền</th>
                                                <th>Thay đổi trạng thái đơn hàng </th>
                                                <th scope="col">Hành động</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($listDonHang as $item)
                                                <tr>
                                                    <th scope="row">{{ $item->code }}</th>
                                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                                    <td>{{ $trangThaiDonHang[$item->status] ?? 'Không xác định' }}</td>
                                                    <td>{{ number_format($item->money_total) }}</td>
                                                    <td>
                                                        <form action="{{ route('admins.orders.update', $item->id) }}" method="post" id="orderForm">
                                                            @csrf
                                                            @method('PUT')
                                                            
                                                            <div class="mb-3">
                                                                <select name="order_status" class="form-select w-50" onchange="confirmSubmit(this)"
                                                                data-default-value="{{ $item->order_status }}">">
                                                                    @foreach ($trangThaiDonHang as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                            {{ $item->status == $key ? 'selected' : '' }}
                                                                            {{ $key == 'huy_hang' ? 'disabled' : '' }}>
                                                                            @if ($key == 'da_nhan_hang')
                                                                                Đã giao hàng
                                                                            @elseif ($key == 'da_xac_nha')
                                                                                Xác nhận
                                                                            @else
                                                                                {{ $value }}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>                                                         
                                                            <!-- Không cần nút submit nữa vì đã dùng onchange trong select -->
                                                        </form>
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admins.orders.show', $item->id) }}">
                                                            <i class="mdi mdi-eye"></i>
                                                        </a>

                                                        @if ($item->trang_thai_don_hang == 'huy_hang')
                                                            <form action="{{ route('admins.orders.destroy', $item->id) }}"
                                                                method="post" class="d-inline "
                                                                onsubmit="return confirm('bạn có muốn xóa không ?')">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="border-0 bg-white"><i
                                                                        class="mdi mdi-delete text-muted fs-18 rounded-2 border p-1"></i></button>
                                                            </form>
                                                        @endif
                                                    </td>


                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div>
                                        {{ $listDonHang->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function confirmSubmit(selectElement) {
            if (confirm("bạn có chắc muốn thay đổi trạng thái đơn hàng ")) {
                selectElement.closest('form').submit();
            } else {
                // Revert to original value if the user cancels
                selectElement.value = selectElement.getAttribute('data-default-value');
            }
        }
    </script>
@endsection
