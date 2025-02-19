@extends('auth.layout')

@section('content')
<div class="auth-page-wrapper pt-5">
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Tạo tài khoản mới</h5>
                                <p class="text-muted">Nhận ngay tài khoản TechShop miễn phí của bạn</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form class="needs-validation" method="POST" action="{{ route('register.post') }}" novalidate>
                                    @csrf

                                    <div class="mb-3">
                                        <label for="username" class="form-label">Tên người dùng <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="username" name="name" placeholder="Tên người dùng" required value="{{ old('name') }}">
                                        <div class="invalid-feedback">
                                            Vui lòng nhập tên người dùng
                                        </div>
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="useremail" name="email" placeholder="Địa chỉ Email" required value="{{ old('email') }}">
                                        <div class="invalid-feedback">
                                            Vui lòng nhập email
                                        </div>
                                        @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Mật khẩu <span class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-inputgroup">
                                            <input type="password" class="form-control pe-5 password-input" onpaste="return false" placeholder="Mật khẩu" id="password-input" name="password" required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" onclick="togglePasswordVisibility()">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            <div class="invalid-feedback">
                                                Vui lòng nhập mật khẩu
                                            </div>
                                        </div>
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-confirm">Xác nhận mật khẩu <span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                                        <div class="invalid-feedback">
                                            Vui lòng xác nhận mật khẩu
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="address" class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{ old('address') }}">
                                        @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
                                        @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <input type="hidden" name="role" value="user">
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Đăng ký</button>
                                    </div>
                                </form>
                                <div class="mt-4 text-center">
                                    <p class="mb-0">Bạn đã có tài khoản? <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Đăng nhập </a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function togglePasswordVisibility() {
                const passwordInput = document.getElementById('password-input');
                const passwordConfirmInput = document.getElementById('password-confirm');
                const passwordAddon = document.querySelector('.password-addon i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    passwordConfirmInput.type = 'text';
                    passwordAddon.classList.replace('ri-eye-fill', 'ri-eye-off-fill');
                } else {
                    passwordInput.type = 'password';
                    passwordConfirmInput.type = 'password';
                    passwordAddon.classList.replace('ri-eye-off-fill', 'ri-eye-fill');
                }
            }
        </script>
    </div>
    @endsection