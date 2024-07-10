@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="all-course py-2">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>

                <div class="col-9">
                    <h2 class="py-3">Thông tin cá nhân</h2>
                    <table class="table table-bordered profile-table">
                        <tr>
                            <td width="25%">Họ và tên</td>
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Email</td>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Số điện thoại</td>
                            <td>{{ $student->phone ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Địa chỉ</td>
                            <td>{{ $student->address ?? 'Chưa cập nhật' }}</td>
                        </tr>
                        <tr>
                            <td>Trạng thái</td>
                            <td>Đang hoạt động</td>
                        </tr>
                        <tr>
                            <td>Thời gian đăng ký</td>
                            <td>{{ Carbon\Carbon::parse($student->created_at)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <td>Thời gian kích hoạt tài khoản</td>
                            <td>{{ Carbon\Carbon::parse($student->email_verified_at)->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    </table>
                    <form action="" method="POST" class="profile-form d-none">
                        <table class="table table-bordered">
                            <tr>
                                <td width="25%">Họ và tên</td>
                                <td> <input type="text" class="form-control" name="name" placeholder="Họ và tên"
                                        value="{{ $student->name }}"><span class="error error-name text-danger"></span></td>
                            </tr>
                            <tr>
                                <td width="25%">Email</td>
                                <td> <input type="text" class="form-control" name="email" placeholder="Email"
                                        value="{{ $student->email }}"><span class="error error-email text-danger"></span>
                                </td>
                            </tr>
                            <tr>
                                <td width="25%">Số điện thoại</td>
                                <td> <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                                        value="{{ $student->phone ?? 'Chưa cập nhật' }}"><span
                                        class="error error-phone text-danger"></span></td>
                            </tr>
                            <tr>
                                <td width="25%">Địa chỉ</td>
                                <td> <input type="text" class="form-control" name="address" placeholder="Địa chỉ"
                                        value="{{ $student->address ?? 'Chưa cập nhật' }}"> <span
                                        class="error error-address text-danger"></span></td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary confirm-update-btn d-none" type="submit">Cập nhật</button>
                            <button class="btn btn-danger delete-profile-btn d-none" type="button">Quay lại</button>
                        </div>
                    </form>
                    <button class="btn btn-primary update-profile-btn my-3">Cập nhật thông tin</button>
                </div>
            </div>
        </div>
    </section>
@endsection
