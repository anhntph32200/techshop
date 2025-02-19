@extends('admin.layout')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Danh sách người dùng</h4>
                    </div>
                </div>
            </div>

            <!-- Hiển thị thông báo thành công nếu có -->
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


            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Vai trò</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <!-- Form gửi yêu cầu cập nhật -->
                                            <form action="{{ route('users.update') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>

                                                <td>
                                                    <select name="role" class="form-select">
                                                        <option value="admin"
                                                            {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="employee"
                                                            {{ $user->role === 'employee' ? 'selected' : '' }}>Nhân viên
                                                        </option>
                                                        <option value="user"
                                                            {{ $user->role === 'user' ? 'selected' : '' }}>Người dùng
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <select name="status" class="form-select">
                                                        <option value="1" {{ $user->status ? 'selected' : '' }}>Hoạt
                                                            động</option>
                                                        <option value="0" {{ !$user->status ? 'selected' : '' }}>Dừng
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                                </td>
                                            </form>
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
