@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Danh sách khuyến mãi</h4>
                    </div>
                </div>
            </div>

            <!-- Hiển thị thông báo thành công -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Hiển thị thông báo lỗi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('promotions.create') }}" class="btn btn-primary">Thêm mới khuyến mãi</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Mã khuyến mãi</th>
                                        <th>Giảm giá</th>
                                        <th>Loại giảm giá</th>
                                        <th>Giá trị tối thiểu</th>
                                        <th>Thời gian bắt đầu</th>
                                        <th>Thời gian kết thúc</th>
                                        <th>Giới hạn sử dụng</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($promotions as $promotion)
                                        <tr>
                                            <td>{{ $promotion->id }}</td>
                                            <td>{{ $promotion->code }}</td>
                                            <td>{{ $promotion->discount }}</td>
                                            <td>{{ $promotion->discount_type }}</td>
                                            <td>{{ $promotion->minimum_spend ?? 'Không yêu cầu' }}</td>
                                            <td>{{ $promotion->start_date }}</td>
                                            <td>{{ $promotion->end_date }}</td>
                                            <td>{{ $promotion->usage_limit ?? 'Không giới hạn' }}</td>
                                            <td>{{ $promotion->status ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                                            <td>
                                                <a href="{{ route('promotions.edit', $promotion->id) }}"
                                                    class="btn btn-primary"><i class="ri-pencil-fill fs-16"></i></a>
                                                <form action="{{ route('promotions.destroy', $promotion->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')"><i
                                                            class="ri-delete-bin-5-fill fs-16"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
