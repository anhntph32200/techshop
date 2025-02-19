@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Sửa ram</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form class="mt-3" action="{{route('admins.rams.update',['id'=>$ram->id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Tên:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Tên chip" value="{{$ram->name}}">
                            @error('name')
                            <div class="invalid-feedback fs-6">
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            </div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Gửi</button>
                            <a class="btn btn-light" href="{{route('admins.chips.index')}}">Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection