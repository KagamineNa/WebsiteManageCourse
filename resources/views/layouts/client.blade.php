<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle }} - Website học trực tuyến</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/sass/app.scss'])
    @yield('stylesheets')
</head>

<body>
    @include ('parts.clients.header')
    <main>
        @yield('content')
    </main>
    @include ('parts.clients.footer')
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="exampleModalLabel"></h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var trialUrl = `{{ route('courses.data.trial') }}`;
</script>
<script
    src="https://www.paypal.com/sdk/js?client-id=AUjDRmyI0Q0w0-3_NhszMcF2n__zMLNHgtNS9qMtJGxhA9YMPeO-tsk4RjHVPfZSCnG9Oo2EK52WPt_H&currency=USD">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@vite(['resources/js/app.js'])
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
<link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
<script>
    $('.datepicker-1').datepicker({
        uiLibrary: 'bootstrap5'
    });
    $('.datepicker-2').datepicker({
        uiLibrary: 'bootstrap5'
    });
</script>
@yield('script')


</html>
