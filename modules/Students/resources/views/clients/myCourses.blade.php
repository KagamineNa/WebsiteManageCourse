@extends('layouts.client')
@section('content')
    @include('parts.clients.page_title')
    <section class="all-course py-2">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('students::clients.menu')
                </div>
                <div class="col-9 mt-3">
                    <h2>Khóa học của tôi</h2>

                    <form action="">
                        <div class="row my-3">
                            <div class="col-3">
                                <select name="teacher_id" id="teacher_id" class="form-select js-select2">
                                    <option value="">Tất cả giảng viên</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}"
                                            {{ request()->teacher_id == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-7">
                                <input type="search" name="keyword" class="form-control" placeholder="Tên khóa học..."
                                    value="{{ request()->keyword }}">
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
                                <th>Tên khóa học</th>
                                <th width="20%">Giảng viên</th>
                                <th>Trạng thái</th>
                                <th width="10%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="/khoa-hoc/{{ $course->slug }}">{{ $course->name }}</a></td>
                                    <td><a href="#">{{ $course->teacher->name }}</a></td>
                                    <td>{!! $course->pivot->status == 1
                                        ? '<span class="badge bg-success">Hoạt động</span>'
                                        : '<span class="badge bg-danger">Bị khóa</span>' !!}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm">Vào học</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
