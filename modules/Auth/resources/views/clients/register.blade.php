@extends('layouts.auth_clients')
@section('content')
    <div class="container" style="padding: 30px 0;">

        <div class="sign-up">
            <h3>Đăng ký</h3>
            @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @endif
            <form action="" method="post">
                <input type="text" name="name" placeholder="Tên" />
                @error('name')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <input type="text" name="email" placeholder="Email" />
                @error('email')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <input type="text" name="phone" placeholder="Số điện thoại" />
                @error('phone')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <input type="password" name="password" placeholder="Mật khẩu" />
                @error('password')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <input type="password" name="confirm_password" placeholder="Lặp lại mật khẩu" />
                @error('confirm_password')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <button type="submit"
                    style="background: linear-gradient(to right bottom, #031b88, #6096fd);
                background-size: 100%;
                background-repeat: no-repeat;">
                    <i class="fa-solid fa-user"></i>
                    Đăng ký
                </button>
                @csrf
            </form>
            <p class="sign-in">
                Bạn đã có tài khoản?
                <a href="{{ route('clients.login') }}">Đăng nhập ngay</a>
            </p>
        </div>
    </div>
@endsection
