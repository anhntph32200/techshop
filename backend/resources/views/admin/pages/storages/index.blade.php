@extends('admin.layout')

@section('content')
<div class="page-content">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($storage as $items)
            <tr>
                <td>{{$items->id}}</td>
                <td>{{$items->name}}</td>
                <td>
                    <a href="{{route('admins.storages.edit',['id'=>$items->id])}}" class="btn btn-warning d-inline-block me-1">Sửa</a>
                    <form action="{{route('admins.storages.destroy',['id'=>$items->id])}}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container">
        <!-- Dòng flex để căn chỉnh nội dung -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Thẻ a nằm bên trái -->
            <a class="btn btn-success" href="{{route('admins.storages.create')}}">Thêm sản phẩm</a>

            <!-- Phân trang nằm bên phải -->
            <div>
                {{ $storage->links() }}
            </div>
        </div>
    </div>
    @endsection