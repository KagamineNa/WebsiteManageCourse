@extends('layouts.auth_clients')
@section('content')
    <div class="container">
        <div class="sign-up">
            <h3>Đặt lại mật khẩu</h3>
            @if (session('msg'))
                <div class="alert alert-danger">{{ session('msg') }}</div>
            @endif
            <form action="{{ route('clients.password.update') }}" method="post">

                <input type="password" name="password" placeholder="Mật khẩu" />
                @error('password')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <input type="password" name="confirm_password" placeholder="Lặp lại mật khẩu" />
                @error('confirm_password')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror
                <input type="hidden" name="token" value="{{ $token }}" />
                <input type="hidden" name="email" value="{{ request()->email }}" />
                <button type="submit"
                    style="background: linear-gradient(to right bottom, #031b88, #6096fd);
                background-size: 100%;
                background-repeat: no-repeat;">
                    <i class="fa-solid fa-user"></i>
                    Xác nhận
                </button>
                @csrf
            </form>
            <p class="sign-up">
                <a href="{{ route('clients.login') }}">Quay lại đăng nhập</a>
            </p>
        </div>
    </div>
@endsection
