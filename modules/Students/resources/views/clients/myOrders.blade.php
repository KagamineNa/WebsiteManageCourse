@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="all-course py-2">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>

                <div class="col-9 py-2">
                    <h2 class="mb-3">Danh sách đơn hàng</h2>
                    <form action="">
                        <div class="row my-3">
                            <div class="col-3">
                                <select name="status_id" id="status_id" class="form-select js-select2">
                                    <option value="">Tất cả trạng thái</option>
                                    @foreach ($allStatus as $status)
                                        <option value="{{ $status->id }}"
                                            {{ request()->status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control datepicker-1" name="start_date"
                                    placeholder="Từ ngày..." value="{{ request()->start_date }}">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control datepicker-2" name="end_date"
                                    placeholder="Đến ngày..." value="{{ request()->end_date }}">
                            </div>
                            <div class="col-3">
                                <input type="number" class="form-control" name="total" placeholder="Tổng tiền..."
                                    value="{{ request()->total }}">
                            </div>
                            <div class="col-2 ">
                                <div class="d-grid">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-search" style="margin-right: 15px;"></i>Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th width="15%">Trạng thái</th>
                                <th width="25%">Ngày đặt mua</th>
                                <th width="10%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ number_format($order->total, 0, ',', '.') }}đ</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $order->orderStatus->type }}">{{ $order->orderStatus->name }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Chi tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
