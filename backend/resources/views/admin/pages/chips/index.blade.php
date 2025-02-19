@extends('admin.layout')

@section('content')
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Danh sách thuộc tính</h4>
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
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <div class="d-flex justify-content-between">
                                <h2>Chip</h2>
                                <a class="btn btn-success mb-2" href="{{route('admins.chips.create')}}">Thêm Chip</a>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chip as $items)
                                <tr>
                                    <td>{{$items->id}}</td>
                                    <td>{{$items->name}}</td>
                                    <td>
                                        <a href="{{route('admins.chips.edit',['id'=>$items->id])}}" class="btn btn-warning d-inline-block me-1"><i class="ri-pencil-fill fs-16"></i></a>
                                        <form action="{{route('admins.chips.destroy',['id'=>$items->id])}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa không?')"><i class="ri-delete-bin-5-fill fs-16"></i></button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="container">
                            <!-- Dòng flex để căn chỉnh nội dung -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <!-- Phân trang nằm bên phải -->
                                <div class="ms-auto">
                                    {{ $chip->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <div class="d-flex justify-content-between">
                                <h2>Ram</h2>
                                <a class="btn btn-success mb-2" href="{{route('admins.rams.create')}}">Thêm Ram</a>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ram as $item1)
                                <tr>
                                    <td>{{$item1->id}}</td>
                                    <td>{{$item1->name}}</td>
                                    <td>
                                        <a href="{{route('admins.rams.edit',['id'=>$item1->id])}}" class="btn btn-warning d-inline-block me-1"><i class="ri-pencil-fill fs-16"></i></a>
                                        <form action="{{route('admins.rams.destroy',['id'=>$item1->id])}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa không?')"><i class="ri-delete-bin-5-fill fs-16"></i></button>
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

                                <!-- Phân trang nằm bên phải -->
                                <div>
                                    {{ $ram->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <div class="d-flex justify-content-between">
                                <h2>Storage</h2>
                                <a class="btn btn-success mb-2" href="{{route('admins.storages.create')}}">Thêm Storage</a>
                            </div>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($storage as $item2)
                                <tr>
                                    <td>{{$item2->id}}</td>
                                    <td>{{$item2->name}}</td>
                                    <td>
                                        <a href="{{route('admins.storages.edit',['id'=>$item2->id])}}" class="btn btn-warning d-inline-block me-1"><i class="ri-pencil-fill fs-16"></i></a>
                                        <form action="{{route('admins.storages.destroy',['id'=>$item2->id])}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn có chắc muốn xóa không?')"><i class="ri-delete-bin-5-fill fs-16"></i></button>
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

                                <!-- Phân trang nằm bên phải -->
                                <div>
                                    {{ $storage->links() }}
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