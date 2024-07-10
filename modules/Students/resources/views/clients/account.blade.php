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
                    <h2>Tổng quan</h2>
                </div>
            </div>
        </div>
    </section>
@endsection
