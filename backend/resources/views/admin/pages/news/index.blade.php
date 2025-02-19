@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách tin tức</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tin tức</a></li>
                            <li class="breadcrumb-item active">Danh sách tin tức</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('news.create') }}" class="btn btn-success">Thêm tin tức</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Tác giả</th>
                                    <th>Hình ảnh</th>
                                    <th>Ngày tạo</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ Str::limit($item->content, 100) }}</td>
                                        <td>{{ $item->author }}</td>
                                        <td>
                                            @if ($item->image)
                                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" width="100">
                                            @else
                                                <span>Không có hình</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('news.edit', $item->id) }}" class="btn btn-primary"><i class="ri-pencil-fill fs-16"></i></a>

                                            <!-- Form xóa tin tức -->
                                            <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa tin tức này?')"><i class="ri-delete-bin-5-fill fs-16"></i></button>
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
