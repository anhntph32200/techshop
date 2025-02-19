@extends('user.layout')

@section('content')
    @include('user.partials.header')
    @include('user.partials.menu')

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .account-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #f4f6f9;
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        }

        .account-header {
            font-size: 1.8rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #004080, #0066cc);
            color: #fff;
            text-align: center;
            border-bottom: 4px solid #003366;
            position: relative;
        }

        .form-group label {
            font-weight: 500;
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ccd1d9;
            padding: 10px 15px;
            font-size: 1rem;
            color: #333;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #004080;
            box-shadow: 0px 0px 8px rgba(0, 64, 128, 0.15);
        }

        .btn-save, .btn-cancel {
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
        }

        .btn-save {
            background-color: #004080;
            border: 1px solid #004080;
            color: #fff;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .btn-save:hover {
            background-color: #003366;
            box-shadow: 0px 4px 12px rgba(0, 51, 102, 0.3);
        }

        .btn-cancel {
            background-color: #b3b3b3;
            border: 1px solid #b3b3b3;
            color: #333;
            margin-left: 10px;
            transition: background-color 0.3s;
        }

        .btn-cancel:hover {
            background-color: #9e9e9e;
        }
    </style>

    <div class="account-container">
        <h1 class="account-header">Chỉnh Sửa Thông Tin Cá Nhân</h1>

        <form action="{{ route('user.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Tên người dùng:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
            </div>

            <div class="text-right mt-4">
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="{{ route('user.profile') }}" class="btn btn-primary">Hủy</a>
            </div>
        </form>
    </div>

    @include('user.partials.footer')
    @include('user.partials.js')
@endsection
