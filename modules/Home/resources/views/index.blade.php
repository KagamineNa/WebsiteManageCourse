@extends('layouts.client')
@section('content')
    <section class="banner">
        <div class="container padding">
            <div class="row">
                <div class="d-none d-md-block col-md-4 col-lg-3">
                    <div class="banner-left">
                        <div class="course-group">
                            <p>Khoá học nền tảng</p>
                            <ul>
                                <li><a href="#">HTML & CSS cho người mới</a></li>
                                <li><a href="#">Lập Trình JavaScript</a></li>
                                <li><a href="#">Lập Trình C++</a></li>
                                <li><a href="#">Xem thêm</a></li>
                            </ul>
                        </div>
                        <div class="course-group pt-3">
                            <p>khoá học chuyên sâu</p>
                            <ul>
                                <li><a href="#">Xây dựng Web với Django</a></li>
                                <li><a href="#">Lập trình React Native</a></li>
                                <li><a href="#">Cơ sở dữ liệu SQL</a></li>
                                <li><a href="#">Xem thêm</a></li>
                            </ul>
                        </div>
                        <div class="course-group pt-3">
                            <p>khoá học nổi bật</p>
                            <ul>
                                <li><a href="#">Lập trình Android với Kotline</a></li>
                                <li><a href="#">Lập trình Swift</a></li>
                                <li><a href="#">Lập trình Ruby on Rail</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="banner-slider">
                        <div class="banner-slider-inner">
                            <img src="https://images.pexels.com/photos/4145153/pexels-photo-4145153.jpeg?auto=compress&cs=tinysrgb&w=600"
                                alt="" />
                        </div>
                        <div class="banner-slider-inner">
                            <img src="https://images.pexels.com/photos/5212655/pexels-photo-5212655.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                alt="" />
                        </div>
                        <div class="banner-slider-inner">
                            <img src="https://images.pexels.com/photos/68761/pexels-photo-68761.jpeg?auto=compress&cs=tinysrgb&w=600"
                                alt="" />
                        </div>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-3">
                    <div class="banner-right">
                        <div class="banner-right__img">
                            <img src="http://127.0.0.1:8000/storage/photos/1/Kotlin-768x427.png" alt="" />
                        </div>
                        <div class="banner-right__img">
                            <img src="http://127.0.0.1:8000/storage/photos/1/th.jpg" alt="" />
                        </div>
                        <div class="banner-right__img">
                            <img src="http://127.0.0.1:8000/storage/photos/1/SQLpt1-3.jpg" alt="" />
                        </div>
                    </div>
                </div>
                <div class="banner-full">
                    <img src="/clients/assets/fullBanner.jpg" alt="" />
                </div>
            </div>
        </div>
    </section>
    <section class="foundation-course">
        <div class="container padding">
            <h3>khóa học nền tảng</h3>
            <div class="row">
                @foreach ($coursesCoBan as $course)
                    <div class="col-12 col-lg-6">
                        <div class="d-flex course">
                            <div class="banner-course">
                                <img src="{{ $course->thumbnail }}" alt="{{ $course->name }}" />
                            </div>
                            <div class="descreption-course">
                                <div class="descreption-top">
                                    <p><i class="fa-solid fa-clock"></i> {{ getHour($course->durations) }} học</p>
                                    <p><i class="fa-solid fa-video"></i> {{ getLessonCount($course)->module }}
                                        phần/{{ getLessonCount($course)->lessons }} bài</p>
                                    <p><i class="fa-solid fa-eye"></i>
                                        {{ $course->view ? number_format($course->view) : 0 }}
                                    </p>
                                </div>
                                <h5 class="descreption-title">
                                    <a href="/khoa-hoc/{{ $course->slug }}">
                                        {{ $course->name }}
                                    </a>
                                </h5>
                                <div class="descreption-teacher">
                                    <img src="{{ $course->teacher?->image }}" alt="{{ $course->teacher?->name }}" />
                                    <span>{{ $course->teacher?->name }}</span>
                                </div>
                                <p class="descreption-price">
                                    @if ($course->sale_price)
                                        <span class="sale">{{ money($course->price) }}</span>
                                        <span>{{ money($course->sale_price) }}</span>
                                    @else
                                        <span>{{ money($course->price) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="intensive-course">
        <div class="container padding">
            <h3>khóa học chuyên sâu</h3>
            <div class="row">
                @foreach ($coursesChuyenSau as $course)
                    <div class="col-12 col-lg-6">
                        <div class="d-flex course">
                            <div class="banner-course">
                                <img src="{{ $course->thumbnail }}" alt="{{ $course->name }}" />
                            </div>
                            <div class="descreption-course">
                                <div class="descreption-top">
                                    <p><i class="fa-solid fa-clock"></i> {{ getHour($course->durations) }} học</p>
                                    <p><i class="fa-solid fa-video"></i> {{ getLessonCount($course)->module }}
                                        phần/{{ getLessonCount($course)->lessons }} bài</p>
                                    <p><i class="fa-solid fa-eye"></i>
                                        {{ $course->view ? number_format($course->view) : 0 }}
                                    </p>
                                </div>
                                <h5 class="descreption-title">
                                    <a href="/khoa-hoc/{{ $course->slug }}">
                                        {{ $course->name }}
                                    </a>
                                </h5>
                                <div class="descreption-teacher">
                                    <img src="{{ $course->teacher?->image }}" alt="{{ $course->teacher?->name }}" />
                                    <span>{{ $course->teacher?->name }}</span>
                                </div>
                                <p class="descreption-price">
                                    @if ($course->sale_price)
                                        <span class="sale">{{ money($course->price) }}</span>
                                        <span>{{ money($course->sale_price) }}</span>
                                    @else
                                        <span>{{ money($course->price) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="featured-course">
        <div class="container padding">
            <h3>khóa học nổi bật</h3>
            <div class="row">
                @foreach ($coursesNoiBat as $course)
                    <div class="col-12 col-lg-6">
                        <div class="d-flex course">
                            <div class="banner-course">
                                <img src="{{ $course->thumbnail }}" alt="{{ $course->name }}" />
                            </div>
                            <div class="descreption-course">
                                <div class="descreption-top">
                                    <p><i class="fa-solid fa-clock"></i> {{ getHour($course->durations) }} học</p>
                                    <p><i class="fa-solid fa-video"></i> {{ getLessonCount($course)->module }}
                                        phần/{{ getLessonCount($course)->lessons }} bài</p>
                                    <p><i class="fa-solid fa-eye"></i>
                                        {{ $course->view ? number_format($course->view) : 0 }}
                                    </p>
                                </div>
                                <h5 class="descreption-title">
                                    <a href="/khoa-hoc/{{ $course->slug }}">
                                        {{ $course->name }}
                                    </a>
                                </h5>
                                <div class="descreption-teacher">
                                    <img src="{{ $course->teacher?->image }}" alt="{{ $course->teacher?->name }}" />
                                    <span>{{ $course->teacher?->name }}</span>
                                </div>
                                <p class="descreption-price">
                                    @if ($course->sale_price)
                                        <span class="sale">{{ money($course->price) }}</span>
                                        <span>{{ money($course->sale_price) }}</span>
                                    @else
                                        <span>{{ money($course->price) }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="question">
        <div class="container padding">
            <h3>vì sao nên học tại Ngân Academy</h3>
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="group">
                        <div class="group-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="group-title">
                            <p>đã đào tạo từ 2017</p>
                            <ul>
                                <li>Kinh nghiệm 4 năm đào tạo Offline + Zoom</li>
                                <li>Hơn 50 lớp với 1086 học viên, 14 doanh nghiệp</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="group">
                        <div class="group-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="group-title">
                            <p>đã đào tạo từ 2017</p>
                            <ul>
                                <li>Kinh nghiệm 4 năm đào tạo Offline + Zoom</li>
                                <li>Hơn 50 lớp với 1086 học viên, 14 doanh nghiệp</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="group">
                        <div class="group-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="group-title">
                            <p>đã đào tạo từ 2017</p>
                            <ul>
                                <li>Kinh nghiệm 4 năm đào tạo Offline + Zoom</li>
                                <li>Hơn 50 lớp với 1086 học viên, 14 doanh nghiệp</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="group">
                        <div class="group-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <div class="group-title">
                            <p>đã đào tạo từ 2017</p>
                            <ul>
                                <li>Kinh nghiệm 4 năm đào tạo Offline + Zoom</li>
                                <li>Hơn 50 lớp với 1086 học viên, 14 doanh nghiệp</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="partner">
        <div class="container">
            <h3>Đối tác doanh nghiệp chúng tôi đào tạo</h3>
            <div class="row" style="justify-content: center;
            align-items: center;">
                <div class="col-6 col-lg-3">
                    <div class="partner-img">
                        <img src="/clients/assets/partner.jpeg" alt="" />
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="partner-img">
                        <img src="https://img.freepik.com/free-vector/purple-abstract-geometrical-logo-3d_1043-55.jpg"
                            alt="" />
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="partner-img">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfbezy5tscwQq-IYit9Ufq5mBhqHRnLPdimwbTQpX4Kw&s"
                            alt="" />
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="partner-img">
                        <img src="https://www.thelogocreative.co.uk/wp-content/uploads/October-Logo-Design-min.jpg"
                            alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="about-us">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="text">
                        <a href="#">đi tới web site học online</a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mt-3 mt-md-0">
                    <div class="text">
                        <a href="#">đi tới fanpage facebook</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4 col-md-12 mt-3 mt-lg-0">
                    <div class="text">
                        <a href="#">đi tới kênh youtube dscons</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection
