@extends('layouts.auth_clients')
@section('content')
    <div class="container">
        <div class="sign-in">
            <h3>Quên mật khẩu</h3>
            <p class="mb-3">Vui lòng nhập email để đặt lại mật khẩu</p>
            @if (session('msg'))
                <div class="alert alert-primary">{{ session('msg') }}</div>
            @endif
            <form action="" method="post">
                <input type="text" name="email" placeholder="Email..." />
                @error('email')
                    <span class="text-start text-danger mb-3">{{ $message }}</span>
                @enderror

                <button type="submit"
                    style="background: linear-gradient(to right bottom, #031b88, #6096fd);
                background-size: 100%;
                background-repeat: no-repeat;">Xác
                    nhận</button>
                @csrf
            </form>
            <p class="sign-up" style="margin-bottom:30px">
                <a href="{{ route('clients.login') }}">Quay lại đăng nhập</a>
            </p>
        </div>
    </div>
@endsection
