@extends('layouts.org_web.layout')
@section('content')
    <header class="inner-header no-overlay" style="margin-top: 6%">
        <div class="container">
            <div class="section-heading">
                <h1 style=" padding: 3rem 0; color: #fff; margin-bottom: 0; font-family: 'Almarai', sans-serif">{{$courses_categories->name}}</h1>
                <p>هنا اضيفو وصف لتصنيف الكورس لانه مابش في قاعدة البيانات وشكرا </p>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="courses">


        <section class="container mb-3">
            <div class="row">
                <div class="col-12">
                    <div class="section-title margin-bottom-40">
                        <h2>{{$courses_categories->name}}</h2>
                    </div>
                </div>
            </div>
            <section class="mt-5">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item ">
                        <a class="nav-link active" style="color: dimgrey" id="home-tab" data-toggle="tab" href="#home"
                           role="tab" aria-controls="home" aria-selected="true">{{$courses_categories->name}}</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                        <div class="course-slider mt-4 mb-4 slickSlider">
                            @foreach($courses as $course)
                                @include('courses.course_itme',['course'=>$course])
                            @endforeach


                        </div>

                    </div>
                </div>
            </section>


        </section>
        <!-- Featured Courses -->
        <section class="">
            <div class="container">
                <div class="section-title margin-bottom-40">
                    <h2>{{trans('lang.special_courses')}}</h2>
                </div>

                <div class="featured-course-slider slickSlider">
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src="dist/img/sample.jpg" alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>4.5 (25,428 تقييمات)</p>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                            <p class="badge">Bestseller</p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src="dist/img/sample.jpg" alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>4.5 (25,428 تقييمات)</p>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                            <p class="badge">Bestseller</p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src="dist/img/sample.jpg" alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>4.5 (25,428 تقييمات)</p>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                            <p class="badge">Bestseller</p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src="dist/img/sample.jpg" alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>4.5 (25,428 تقييمات)</p>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                            <p class="badge">Bestseller</p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src="dist/img/sample.jpg" alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>4.5 (25,428 تقييمات)</p>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                            <p class="badge">Bestseller</p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src="dist/img/sample.jpg" alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>4.5 (25,428 تقييمات)</p>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                            <p class="badge">Bestseller</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        {{--search area--}}
        <section class="">
            <div class="container">
                <div class="section-title margin-bottom-40">
                    <h2>{{$courses_categories->name}}</h2>
                </div>

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-start">
                                <button class="btn mx-2" data-toggle="collapse" href="#filter-collapse" role="button"
                                        aria-expanded="false" aria-controls="filter-collapse">
                                    <i class="fas fa-filter"></i>
                                    <span>تصفية</span>
                                </button>
                                <div class="form-group m-0">
                                    <select class="form-control">
                                        <option disabled value="0" selected>ترتيب</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>
                            <p>253 نتيجة</p>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 collapse show" id="filter-collapse">
                        <div class="filters mb-4">
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter1"
                                        aria-expanded="false" aria-controls="filter1">
                                    <span>الموضوع</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter1">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter2"
                                        aria-expanded="false" aria-controls="filter2">
                                    <span>المستوى</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter2">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter3"
                                        aria-expanded="false" aria-controls="filter3">
                                    <span>اللغة</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter3">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter4"
                                        aria-expanded="false" aria-controls="filter4">
                                    <span>السعر</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter4">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter5"
                                        aria-expanded="false" aria-controls="filter5">
                                    <span>المميزات</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter5">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter6"
                                        aria-expanded="false" aria-controls="filter6">
                                    <span>التقييمات</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter6">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter">
                                <button class="btn btn-primary d-flex align-items-center justify-content-between"
                                        type="button" data-toggle="collapse" data-target="#filter7"
                                        aria-expanded="false" aria-controls="filter7">
                                    <span>مدة الفيديو</span>
                                    <i class="fas fa-angle-down"></i>
                                </button>
                                <div class="collapse" id="filter7">
                                    <div class="card card-body">
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="results">

                            @foreach($courses as $course)
                                <a href="{{route('courses.detail',$course->id)}}">

                                    <div class="course-card flex-row d-flex">
                                        <figure style="width: 40%; padding: 10px ">
                                            <img src="dist/img/sample.jpg" alt="">
                                        </figure>
                                        <div class="course-card-content" style="padding: 10px">
                                            <h5>{{$course->name}}</h5>
                                            <p>4.5 (25,428 تقييمات)</p>
                                            <p>
                                                <span>${{$course->price}}</span>
                                                <span>$149</span>
                                            </p>
                                            <p class="badge">Bestseller</p>
                                        </div>

                                    </div>
                                </a>


                            @endforeach


                        </div>
                    </div>
                </div>


            </div>
        </section>


        {{--        <!-- Courses tabs -->--}}
        {{--        <section class="container mb-3">--}}
        {{--            <div class="container">--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-12">--}}
        {{--                        <div class="section-title text-center margin-bottom-40">--}}
        {{--                            <h2>{{trans('lang.our_courses')}} <span>{{$courses_categories->name}}</span></h2>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-12">--}}
        {{--                        <div class="popular-course-tab">--}}
        {{--                            <ul>--}}
        {{--                                <li class="active" data-filter="#{{str_replace(' ', '', $courses_categories->name)}}">{{trans('lang.all')}} </li>--}}
        {{--                                <li data-filter="#popular">{{trans('lang.popular')}}</li>--}}

        {{--                            </ul>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--                <div class="row grid">--}}
        {{--                    @foreach($courses as $course)--}}
        {{--                    <div class="col-lg-4 col-md-6 grid-item" id="{{str_replace(' ', '', $courses_categories->name)}}">--}}
        {{--                        <div class="single-course-item">--}}
        {{--                            <div class="course-image">--}}

        {{--                                <img src="{{config('app.url').$course->img_path}}"  alt="image">--}}
        {{--                            </div>--}}
        {{--                            <div class="course-content margin-top-30">--}}
        {{--                                <div class="course-title">--}}
        {{--                                    <h4>{{$course->name}} </h4>--}}
        {{--                                </div>--}}
        {{--                                <div class="course-instructor-rating margin-top-20">--}}
        {{--                                    <div class="course-instructor">--}}
        {{--                                        <img src="{{config('app.url').$course->teacher->img_profile}}"   alt="instructor">--}}
        {{--                                        <h6>{{$course->teacher->first_name}} {{$course->teacher->last_name}}</h6>--}}
        {{--                                    </div>--}}
        {{--                                    --}}{{--                                <div class="course-rating">--}}
        {{--                                    --}}{{--                                    <ul>--}}
        {{--                                    --}}{{--                                        <li><i class="fa fa-star"></i></li>--}}
        {{--                                    --}}{{--                                        <li><i class="fa fa-star"></i></li>--}}
        {{--                                    --}}{{--                                        <li><i class="fa fa-star"></i></li>--}}
        {{--                                    --}}{{--                                        <li><i class="fa fa-star"></i></li>--}}
        {{--                                    --}}{{--                                        <li><i class="fa fa-star"></i></li>--}}
        {{--                                    --}}{{--                                    </ul>--}}

        {{--                                    --}}{{--                                </div>--}}
        {{--                                </div>--}}
        {{--                                <div class="course-info margin-top-20">--}}
        {{--                                    <div class="course-video">--}}
        {{--                                        <i class="fa fa-play-circle-o"></i>--}}
        {{--                                        <span>{{$course->subjects_count}} {{trans('lang.lecture')}} </span>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="course-time">--}}
        {{--                                        <i class="fa fa-clock-o"></i>--}}
        {{--                                        <span>{{$course->duration}} {{trans('lang.hours')}} </span>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                                <div class="course-price-cart margin-top-20">--}}
        {{--                                    <div class="course-price">--}}
        {{--                                        <span class="span-big">$ {{$course->price}}</span>--}}
        {{--                                        <span class="span-cross">$ 500.00</span>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            <div class="hover-state" >--}}
        {{--                                <span class="heart-icon" ><i class="fa fa-heart-o"></i></span>--}}
        {{--                                <div class="course-title margin-top-50">--}}
        {{--                                    <h4><a href="#">{{$course->name}} </a></h4>--}}
        {{--                                </div>--}}
        {{--                                <div class="course-price-info margin-top-20">--}}
        {{--                                    --}}{{--                                <span class="best-seller">best seller</span>--}}
        {{--                                    <span class="course-category"><a href="#">{{$course->category->name}}</a></span>--}}
        {{--                                    <span class="course-price"> {{$course->name}}</span>--}}
        {{--                                </div>--}}
        {{--                                <div class="course-info margin-top-30">--}}
        {{--                                    <div class="course-enroll">--}}
        {{--                                        <span>{{trans('lang.enrolled')}} {{$course->total_students}} {{trans('lang.students')}}</span>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="course-video">--}}
        {{--                                        <i class="fa fa-play-circle-o"></i>--}}
        {{--                                        <span>{{$course->subjects_count}} {{trans('lang.lectures')}}</span>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="course-time">--}}
        {{--                                        <i class="fa fa-clock-o"></i>--}}
        {{--                                        <span>{{$course->duration}} {{trans('lang.hours')}} </span>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                                <p class="margin-top-20">{!! $course->description!!}</p>--}}
        {{--                                --}}{{--                            <ul class="margin-top-20">--}}
        {{--                                --}}{{--                                <li><i class="fa fa-circle-o"></i><span>Lorem ipsum dolor sit amet.</span></li>--}}
        {{--                                --}}{{--                                <li><i class="fa fa-circle-o"></i><span>Consectetur adipisicing elit.</span></li>--}}
        {{--                                --}}{{--                                <li><i class="fa fa-circle-o"></i><span>Placeat dolore quaerat itaque.</span></li>--}}
        {{--                                --}}{{--                            </ul>--}}
        {{--                                <div class="preview-button margin-top-20">--}}
        {{--                                    <a href="{{route('courses.detail',$course->id)}}" class="template-button">{{trans('lang.details')}}</a>--}}
        {{--                                    <a href="{{url('checkout')}}" class="template-button margin-left-10">{{trans('lang.buy')}} </a>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                   @endforeach--}}

        {{--                </div>--}}
        {{--            </div>--}}

        {{--        </section>--}}

        {{--        <!-- Featured Courses -->--}}
        {{--        <section class="colored-bg">--}}
        {{--            <div class="container">--}}

        {{--                <div class="section-title margin-bottom-40">--}}
        {{--                    <h2>{{trans('lang.special_courses')}}</h2>--}}
        {{--                </div>--}}

        {{--                <div class="featured-course-slider slickSlider">--}}
        {{--                    <div class="course-card d-flex flex-column flex-md-row">--}}
        {{--                        <figure>--}}
        {{--                            <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
        {{--                        </figure>--}}
        {{--                        <div class="course-card-content">--}}
        {{--                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
        {{--                            <p>4.5 (25,428 تقييمات)</p>--}}
        {{--                            <p>--}}
        {{--                                <span>$9.99</span>--}}
        {{--                                <span>$149</span>--}}
        {{--                            </p>--}}
        {{--                            <p class="badge">Bestseller</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="course-card d-flex flex-column flex-md-row">--}}
        {{--                        <figure>--}}
        {{--                            <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
        {{--                        </figure>--}}
        {{--                        <div class="course-card-content">--}}
        {{--                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
        {{--                            <p>4.5 (25,428 تقييمات)</p>--}}
        {{--                            <p>--}}
        {{--                                <span>$9.99</span>--}}
        {{--                                <span>$149</span>--}}
        {{--                            </p>--}}
        {{--                            <p class="badge">Bestseller</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="course-card d-flex flex-column flex-md-row">--}}
        {{--                        <figure>--}}
        {{--                            <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
        {{--                        </figure>--}}
        {{--                        <div class="course-card-content">--}}
        {{--                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
        {{--                            <p>4.5 (25,428 تقييمات)</p>--}}
        {{--                            <p>--}}
        {{--                                <span>$9.99</span>--}}
        {{--                                <span>$149</span>--}}
        {{--                            </p>--}}
        {{--                            <p class="badge">Bestseller</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="course-card d-flex flex-column flex-md-row">--}}
        {{--                        <figure>--}}
        {{--                            <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
        {{--                        </figure>--}}
        {{--                        <div class="course-card-content">--}}
        {{--                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
        {{--                            <p>4.5 (25,428 تقييمات)</p>--}}
        {{--                            <p>--}}
        {{--                                <span>$9.99</span>--}}
        {{--                                <span>$149</span>--}}
        {{--                            </p>--}}
        {{--                            <p class="badge">Bestseller</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="course-card d-flex flex-column flex-md-row">--}}
        {{--                        <figure>--}}
        {{--                            <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
        {{--                        </figure>--}}
        {{--                        <div class="course-card-content">--}}
        {{--                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
        {{--                            <p>4.5 (25,428 تقييمات)</p>--}}
        {{--                            <p>--}}
        {{--                                <span>$9.99</span>--}}
        {{--                                <span>$149</span>--}}
        {{--                            </p>--}}
        {{--                            <p class="badge">Bestseller</p>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}

        {{--        <!-- موضوعات مشهورة -->--}}
        {{--        <section class="course-recommendation">--}}
        {{--            <div class="container">--}}
        {{--                <div class="section-heading mb-0">--}}
        {{--                    <h1>{{trans('lang.popular_topics')}}</h1>--}}
        {{--                    <p>هذا وصف فرعي للعنوان الرئيسي</p>--}}
        {{--                </div>--}}
        {{--                <!-- <div class="d-flex flex-wrap align-items-center justify-content-center"> -->--}}
        {{--                <div class="popular-course-slider slickSlider mt-4">--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                    <a class="category-card m-2">--}}
        {{--                        <h5 class="text-center font-weight-bold py-3 px-5">نص يستبدل</h5>--}}
        {{--                    </a>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </section>--}}

    </main>
@endsection
