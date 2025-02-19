@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Thêm danh mục mới</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback fs-6">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                            <div class="invalid-feedback fs-6">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mt-2">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection