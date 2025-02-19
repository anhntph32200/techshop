@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Danh sách đánh giá</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Đánh giá</a></li>
                                <li class="breadcrumb-item active">Danh sách đánh giá</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản phẩm</th>
                                        <th>Người</th>
                                        <th>Rating</th>
                                        <th>Đánh giá</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->product->name }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->rating }}</td>
                                            <td>{{ $review->comment }}</td>
                                            <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if ($review->status === 'visible')
                                                    <span class="badge bg-success">Hiện</span>
                                                @else
                                                    <span class="badge bg-danger">Ẩn</span>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.reviews.toggleVisibility', $review->id) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $review->status === 'visible' ? 'btn-danger' : 'btn-success' }}">
                                                        {{ $review->status === 'visible' ? 'Ẩn' : 'Hiện' }}
                                                    </button>
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
