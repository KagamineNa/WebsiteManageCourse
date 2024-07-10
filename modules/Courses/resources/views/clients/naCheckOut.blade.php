@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="dashboard_container">
                                <div class="dashboard_container_header">
                                    <div class="dashboard_fl_1">
                                        <h3>Thông tin đơn hàng</h3>
                                    </div>
                                </div>
                                <div class="dashboard_container_body p-4">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <p><b>Thông tin khóa học</b></p>
                                            <p>– Khóa học: <b>{{ $course->name }}</b>
                                            </p>
                                            <p>– Giá: {{ $course->sale_price ? $course->sale_price : $course->price }}đ</p>
                                            {{ $check ? 'Bạn được giảm giá 10% là: ' . ($realPrice * 10) / 100 : '' }}
                                            <p></p>
                                            {{ $check ? 'Bạn còn phải trả là: ' . ($realPrice * 90) / 100 : '' }}

                                            <p>– Giảng viên: {{ $teacher->name }}</p>
                                            <p>– Thời lượng: {{ getTime($course->durations) }} giờ</p>
                                            <p>– Mã khóa học: {{ $course->code }}</p>
                                            <p style="color: red; font-weight: bold">Lưu ý:</p>
                                            <p style="font-style: italic; font-weight: bold">Sau khi bạn chuyển khoản xong,
                                                hệ thống sẽ kích
                                                hoạt khóa học cho bạn</p>
                                            <div id="paypal-button-container" style="width:300px; margin-top: 20px;"></div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <p class="text-center"><img style="max-width: 100%; height: auto; width: 450px;"
                                                    src= "{{ $course->thumbnail }}" alt=""></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $check ? ($realPrice * 90) / 100 : $realPrice }}'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(orderData) {
                    console.log("helo", orderData)
                    var transaction = orderData.purchase_units[0].payments.captures[0];

                    var transaction_id = transaction.id
                    var status = orderData.status
                    var payment_method = 'PayPal'
                    sendTransaction(transaction_id, payment_method, status);


                    // Replace the above to show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML =
                        '<h4 class="text-center"><i class="fa fa-spinner fa-spin"></i> Please wait...</h4>';
                    // alert('Transaction completed by ' + details.payer.name.given_name);
                });
            }

        }).render('#paypal-button-container');

        function getCookie(name) {
            var cookieValue = null;
            if (document.cookie && document.cookie != '') {
                var cookies = document.cookie.split(';');
                for (var i = 0; i < cookies.length; i++) {
                    var cookie = jQuery.trim(cookies[i]);
                    // Does this cookie string begin with the name we want?
                    if (cookie.substring(0, name.length + 1) == (name + '=')) {
                        cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                        break;
                    }
                }
            }
            return cookieValue;
        }

        function sendTransaction(transaction_id, payment_method, status) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            $.ajax({
                type: 'POST',
                url: '{{ route('courses.checkout-complete', ['id' => $course->id]) }}',
                data: {
                    'order_number': 5,
                    'transaction_id': transaction_id,
                    'payment_method': payment_method,
                    'status': status,
                    '_token': csrfToken
                },
                success: function(response) {
                    console.log('response==>', response)
                    window.location.href = '{{ route('courses.checkout-success', ['id' => $course->id]) }}'
                }
            })
        }
    </script>
@endsection
