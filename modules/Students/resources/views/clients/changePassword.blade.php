@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="all-course py-2">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>

                <div class="col-9 px-5">
                    <h2 class="py-3">Đổi mật khẩu</h2>
                    {{-- @session('message')
                        <div class="alert alert-{{ session('type') }}">{{ session('message') }}</div>
                    @endsession --}}
                    <form action="" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Mật khẩu cũ:</label>
                            <div class="col-sm-8">
                                <input type="password" name="old_password" class="form-control"
                                    placeholder="Mật khẩu cũ...">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Mật khẩu mới:</label>
                            <div class="col-sm-8">
                                <input type="password" name="new_password" class="form-control"
                                    placeholder="Mật khẩu mới...">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Nhập lại mật khẩu mới:</label>
                            <div class="col-sm-8">
                                <input type="password" name="confirm_password" class="form-control"
                                    placeholder="Nhập lại mật khẩu mới...">
                                @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        function showMessage(message, type = "success") {
            const bgMsg = type === "success" ? "#00b09b" : "#f85032";
            Toastify({
                text: message,
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "bottom", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: bgMsg,
                },
                onClick: function() {}, // Callback after click
            }).showToast();
        }
        @if (session('success'))
            showMessage('{{ session('success') }}', 'success');
        @endif
        @if (session('error'))
            showMessage('{{ session('error') }}', 'error');
        @endif
    </script>
@endsection
