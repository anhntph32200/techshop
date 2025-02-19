@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách danh mục con</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('subcategories.create') }}" class="btn btn-success mb-3">Thêm danh mục con</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Hình ảnh</th>
                                    <th>Trạng thái</th>
                                    <th>Danh mục</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                                @endif
                                @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif

                                @if ($subcategories->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center">Không có danh mục con nào.</td>
                                </tr>
                                @else
                                @foreach ($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $subcategory->id }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>
                                        <img src="{{ $subcategory->image ? asset('storage/' . $subcategory->image) : asset('images/default.jpg') }}"
                                            alt="{{ $subcategory->name }}" width="100">
                                    </td>
                                    <td>
                                        <span class="badge {{ $subcategory->status ? 'bg-success' : 'bg-danger' }}">
                                            {{ $subcategory->status ? 'Hoạt động' : 'Không hoạt động' }}
                                        </span>
                                    </td>
                                    <td>{{ $subcategory->category->name }}</td>
                                    <td>
                                        <a href="{{ route('subcategories.edit', $subcategory->id) }}" class="btn btn-primary">
                                            <i class="ri-pencil-fill fs-16"></i>
                                        </a>
                                        <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa danh mục này?')">
                                                <i class="ri-delete-bin-5-fill fs-16"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection