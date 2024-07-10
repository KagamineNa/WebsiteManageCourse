@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')

    <div class="container mt-5 mb-5">
        <div class="justify-content-center row">
            <div class="col-md-8">
                <div class="bg-white p-3">
                    <img src="/clients/assets/paid.png" alt="foodOnline Logo" style="width:300px" />
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mt-2 mb-3">Cám ơn bạn vì đã đặt hàng.</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <p class="mb-0">Tên khóa học: {{ $course->name }}</p>
                            <p class="mb-0">Thời lượng: {{ getTime($course->durations) }}</p>
                            <p class="mb-0">Giá: {{ $course->sale_price ? $course->sale_price : $course->price }}</p>
                            <p class="mb-0">Giảng viên: {{ $teacher->name }}</p>
                        </div>
                    </div>

                    <h6>Xin chào {{ auth('students')->user()->name }},</h6>
                    <span>Vui lòng kiểm tra thông tin hóa đơn bên dưới.</span>
                    <hr />

                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="d-block">Ngày đặt mua: </span>
                            <span class="font-weight-bold">{{ now()->format('d-m-Y H:i:s') }}</span>
                        </div>
                        <div>
                            <span class="d-block">Hóa đơn số: </span>
                            <span class="font-weight-bold">1</span>
                        </div>
                        <div>
                            <span class="d-block">Phương pháp thanh toán: </span>
                            <span class="font-weight-bold">PayPal</span>
                        </div>
                        <div>
                            <span class="d-block">Mã giao dịch: </span>
                            <span class="font-weight-bold">0138102938141241</span>
                        </div>
                    </div>
                    <hr />
                    <div class="row mt-5">
                        <div class="d-flex justify-content-start col-md-6">
                            <img src="{{ $course->thumbnail }}" style="width:180px" />
                        </div>
                        <div class="col-md-6 pt-4 d-flex justify-content-end">
                            <ul>
                                <li style="list-style-type: none; font-weight: 600">
                                    <span class="price float-right">
                                        <span id="total">Tổng cộng</span>
                                        {{ $course->sale_price ? $course->sale_price : $course->price }}
                                        <span class="currency">đ</span>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="d-block font-weight-bold">Trân trọng.</span>
                            <span>Course Management Team</span>
                        </div>
                        <div class="d-flex justify-content-end align-items-end">
                            <span class="d-block font-weight-bold mr-2">Cần hỗ trợ? </span>

                            <span>Liên hệ: +888716903</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
