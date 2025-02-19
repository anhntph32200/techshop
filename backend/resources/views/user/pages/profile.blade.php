@extends('user.layout')

@section('content')
    @include('user.partials.header')
    @include('user.partials.menu')

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        
        .user-account-card {
            border-radius: 15px;
            background-color: #fdfdfd;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
            overflow: hidden;
        }

        .card-header {
            font-size: 1.8rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #004080, #0066cc);
            color: #fff;
            text-align: center;
            border-bottom: 4px solid #003366;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 4px;
            background: #003366;
            bottom: -4px;
            left: 0;
        }

        .card-body {
            padding: 2rem;
            color: #333;
            background-color: #ffffff;
        }

        .info-item {
            padding: 1.25rem;
            border-bottom: 1px solid #d1d1d1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
            border-radius: 8px;
        }

        .info-item:hover {
            background-color: #f0f7ff;
            transform: translateX(5px);
        }

        .info-item label {
            font-size: 1.1rem;
            color: #666;
            font-weight: 600;
            margin-bottom: 0;
            flex-basis: 35%;
            text-align: right;
        }

        .info-item .info-text {
            font-weight: 500;
            color: #004080;
            flex-basis: 60%;
            text-align: left;
        }

        .alert-dismissible .close {
            padding: 0.5rem;
            cursor: pointer;
            color: #333;
        }

        .btn-primary {
            background: linear-gradient(135deg, #004080, #0066cc);
            color: #fff;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 102, 204, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #003366, #004080);
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.3);
        }

        .text-primary.ml-2 {
            color: #0056cc;
            font-size: 0.9rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .text-primary.ml-2:hover {
            color: #003a9d;
            text-decoration: underline;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card user-account-card">
                    <div class="card-header">
                        Thông tin tài khoản
                    </div>
                    <div class="card-body">
                        <!-- Thông báo nếu có -->
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <!-- Thông tin người dùng -->
                        <div class="info-item">
                            <label>Tên người dùng:</label>
                            <div class="info-text">{{ $user->name }}</div>
                        </div>
                        <div class="info-item">
                            <label>Email:</label>
                            <div class="info-text">{{ $user->email }}</div>
                        </div>
                        <div class="info-item">
                            <label>Mật khẩu:</label>
                            <div class="info-text">
                                <em>*********</em>
                                <a href="{{ route('password.email') }}" class="text-primary ml-2">Thay đổi mật khẩu</a>
                            </div>
                        </div>
                        <div class="info-item">
                            <label>Địa chỉ:</label>
                            <div class="info-text">{{ $user->address ?? 'chưa cập nhật' }}</div>
                        </div>
                        <div class="info-item">
                            <label>Số điện thoại:</label>
                            <div class="info-text">{{ $user->phone ?? 'chưa cập nhật' }}</div>
                        </div>
                        <div class="info-item">
                            <label>Vai trò:</label>
                            <div class="info-text">
                                @if($user->role == 'user')
                                    Người dùng
                                @elseif($user->role == 'employee')
                                    Nhân viên
                                @elseif($user->role == 'admin')
                                    Admin
                                @else
                                    Chưa cập nhật
                                @endif
                            </div>
                            
                        </div>
                        <!-- Nút chỉnh sửa -->
                        <div class="text-right mt-4">
                            @if($user->role === 'admin' || $user->role === 'employee')
                                <a href="{{ route('admins.') }}" class="btn btn-primary">Truy cập trang admin</a>
                            @endif
                            <a href="{{ route('user.edit_profile', $user->id) }}" class="btn btn-primary">
                                Chỉnh sửa thông tin
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('user.partials.footer')
    @include('user.partials.js')
@endsection
