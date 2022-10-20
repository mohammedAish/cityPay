@extends('layouts.org_web.layout')

@section('keywords')
    @if(LaravelLocalization::getCurrentLocale()=="en")
        <meta name="keywords" content=" {{ isset($header->home_keywords_en)?$header->home_keywords_en:'تداول' }}" />
    @else
        <meta name="keywords" content=" {{ isset($header->home_keywords)?$header->home_keywords:'تداول' }}" />
    @endif

@endsection
@section('content')
<header  class="course-header" style="margin-top: 2%;">
    <div class="container">

            <div style="position: relative; ">
                <img src="{{asset('org_assets/dist/img/courseheader.jpg')}}" class="img-fluid " style="max-width: 100%;  height: auto;">



                <div class="search-course p-4 bd-highlight  d-flex  " style="background-color: white;left: 4.8rem;
                        top: 6.4rem; max-width: 44rem; width: 400px; position: absolute; flex-direction: column" >
                    <h1>Dream up</h1>
                    <p>some thing to descrip</p>
                    <div class="search-input mt-2 d-flex  flex-row align-items-center">

                        <input type="text" class="form-control" placeholder="ماذا تريد ان تتعلم؟" style="flex-direction: row">
                        <button class="btn" type="submit">
                            <i class="fas fa-search" aria-hidden="true"></i>
                        </button>

                    </div>
                </div>
            </div>


    </div>
</header>

<!-- Main content -->
<main class="courses">
    <div class="container">
        <section>
            <h3>The world's largest selection of courses</h3>
            <p>Choose from 155,000 online video courses with new additions published every month
            </p>
        </section>

        <section class="mt-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach($courses_categories as $courses_category)
                <li class="nav-item " >
                    <a class="nav-link {{ $loop->first ? 'active' : '' }} " style="color: dimgrey" id="" data-toggle="tab" href="#{{$courses_category->id}}" role="tab" aria-controls="home" aria-selected="true">{{$courses_category->name}}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content" id="myTabContent">
                @foreach($courses_categories as $courses_category)
                <div class="tab-pane fade {{ $loop->first ? 'active' : '' }} {{ $loop->first ? 'show' : '' }} " id="{{$courses_category->id}}" role="tabpanel" aria-labelledby="home-tab" style="border: darkgray 1px solid;border-radius: 5px ">
                    @foreach($courses_category->courses as $course)
                    <div class="row col-md-12" >
                        <div class="col-md-10 mt-4">
                            <h4>{{ $loop->first ? $course->name : '' }}
                            </h4>
                            <p>
                                {!! $loop->first ? $course->description : '' !!}
                            </p>



                            <a href="#" class="btn mt-3" >تصفح هذا التصنيف</a>
                        </div>
                        <div class="col-md-2 mt-4">
                            <img src="{{asset('org_assets/dist/img/udemy.jpg')}}" width="150px" class="rounded">
                        </div>





                    </div>
                    <div class="course-slider mt-4 mb-4 slickSlider">
                        <div class="course-card single-course-item">
                            <figure>
                                <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                            </figure>
                            <div class="course-card-content">
                                <h5>{{$course->name}}</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>{{$course->price}} {{$course->currency->symbol}}</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">{{trans('lang.Bestseller')}}</p>
                            </div>
                            <div class="hover-state">
{{--                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                <span class="title-tag">{{$course->teacher->customer->first_name}} {{$course->teacher->customer->last_name}}</span>
                                <div class="course-title margin-top-10">
                                    <a href="#">  <h5 style="color: green">{{$course->name}}</h5></a>
                                </div>
                                <div class="course-price-info margin-top-20">
                                    <span class="course-category"><a href="#">{{$course->category->name}}</a></span>
                                    <span class="course-price">{{$course->price}} {{$course->currency->symbol}}</span>
                                </div>
                                <div class="course-info margin-top-30">
                                    <div class="course-enroll">
                                        <span>enrolled {{$course->total_students}}</span>
                                    </div>
                                    <div class="course-video">
                                        <i class="fa fa-play-circle-o"></i>
                                        <span>{{$course->subjects_count}} lectures</span>
                                    </div>
                                    <div class="course-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>{{$course->duration}}h </span>
                                    </div>
                                </div>
                                <p class="margin-top-20">{!! $course->description !!}</p>

                                <div class="preview-button margin-top-20">
                                    <a href="{{route('courses.detail', $course->id)}}" class="template-button">course preview</a>
                                    <a href="cart.html" class="template-button margin-left-10">buy</a>
                                </div>
                            </div>
                        </div>



                    </div>
                    @endforeach

                </div>
                @endforeach
            </div>
        </section>


    </div>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{trans('lang.students_see')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="course-slider mt-4 mb-4 slickSlider">
                        @foreach($students_poplar as $poplar)
                        <div class="course-card single-course-item">
                            <figure>
                                <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                            </figure>
                            <div class="course-card-content">
                                <h5>{{$poplar->name}}</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>{{$poplar->price}}</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">{{trans('lang.Bestseller')}}</p>
                            </div>
                            <div class="hover-state">

                                <span class="title-tag">{{$poplar->teacher->customer->first_name}} {{$poplar->teacher->customer->last_name}}</span>
                                <div class="course-title margin-top-10">
                                    <a href="#">  <h5 style="color: green">{{$poplar->name}}</h5></a>
                                </div>
                                <div class="course-price-info margin-top-20">
                                    <span class="best-seller">best seller</span>
                                    <span class="course-category"><a href="#">web design</a></span>
                                    <span class="course-price">{{$poplar->price}}</span>
                                </div>

                                <div class="course-info margin-top-30">
                                    <div class="course-enroll">
                                        <span>enrolled 0</span>
                                    </div>
                                    <div class="course-video">
                                        <i class="fa fa-play-circle-o"></i>
                                        <span>36 lectures</span>
                                    </div>
                                    <div class="course-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>{{$poplar->duration}} {{trans('lang.hour')}}</span>
                                    </div>
                                </div>
                                <p class="margin-top-20">{{$poplar->description}}</p>

                                <div class="preview-button margin-top-20">
                                    <a href="course-details.html" class="template-button">course preview</a>
                                    <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>

                            <div class="course-card single-course-item">
                            <figure>
                                <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                            </figure>
                            <div class="course-card-content">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">{{trans('lang.Bestseller')}}</p>
                            </div>
                            <div class="hover-state">
{{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                <span class="title-tag">by instructor</span>
                                <div class="course-title margin-top-10">
                                    <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                </div>
                                <div class="course-price-info margin-top-20">
                                    <span class="best-seller">best seller</span>
                                    <span class="course-category"><a href="#">web design</a></span>
                                    <span class="course-price">$ 400.00</span>
                                </div>
                                <div class="course-info margin-top-30">
                                    <div class="course-enroll">
                                        <span>enrolled 0</span>
                                    </div>
                                    <div class="course-video">
                                        <i class="fa fa-play-circle-o"></i>
                                        <span>36 lectures</span>
                                    </div>
                                    <div class="course-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>2h 40mins</span>
                                    </div>
                                </div>
                                <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                <div class="preview-button margin-top-20">
                                    <a href="course-details.html" class="template-button">course preview</a>
                                    <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="course-card single-course-item">
                            <figure>
                                <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                            </figure>
                            <div class="course-card-content">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">{{trans('lang.Bestseller')}}</p>
                            </div>
                            <div class="hover-state">
{{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                <span class="title-tag">by instructor</span>
                                <div class="course-title margin-top-10">
                                    <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                </div>
                                <div class="course-price-info margin-top-20">
                                    <span class="best-seller">best seller</span>
                                    <span class="course-category"><a href="#">web design</a></span>
                                    <span class="course-price">$ 400.00</span>
                                </div>
                                <div class="course-info margin-top-30">
                                    <div class="course-enroll">
                                        <span>enrolled 0</span>
                                    </div>
                                    <div class="course-video">
                                        <i class="fa fa-play-circle-o"></i>
                                        <span>36 lectures</span>
                                    </div>
                                    <div class="course-time">
                                        <i class="fa fa-clock-o"></i>
                                        <span>2h 40mins</span>
                                    </div>
                                </div>
                                <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                <div class="preview-button margin-top-20">
                                    <a href="course-details.html" class="template-button">course preview</a>
                                    <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                </div>
                            </div>
                        </div>
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <div class="course-card single-course-item">
                                <figure>
                                    <img src="{{asset('/org_assets/dist/img/header1.jpg')}}" alt="">
                                </figure>
                                <div class="course-card-content">
                                    <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                    <p>4.5 (25,428 تقييمات)</p>
                                    <p>
                                        <span>$9.99</span>
                                        <span>$149</span>
                                    </p>
                                    <p class="badge">{{trans('lang.Bestseller')}}</p>
                                </div>
                                <div class="hover-state">
                                    {{--                                                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
                                    <span class="title-tag">by instructor</span>
                                    <div class="course-title margin-top-10">
                                        <a href="#">  <h5 style="color: green">user experience design with adobe XD</h5></a>
                                    </div>
                                    <div class="course-price-info margin-top-20">
                                        <span class="best-seller">best seller</span>
                                        <span class="course-category"><a href="#">web design</a></span>
                                        <span class="course-price">$ 400.00</span>
                                    </div>
                                    <div class="course-info margin-top-30">
                                        <div class="course-enroll">
                                            <span>enrolled 0</span>
                                        </div>
                                        <div class="course-video">
                                            <i class="fa fa-play-circle-o"></i>
                                            <span>36 lectures</span>
                                        </div>
                                        <div class="course-time">
                                            <i class="fa fa-clock-o"></i>
                                            <span>2h 40mins</span>
                                        </div>
                                    </div>
                                    <p class="margin-top-20">Learn WordPress like a Professional! Start from the basics and go all the way to creating your own applications and website!</p>

                                    <div class="preview-button margin-top-20">
                                        <a href="course-details.html" class="template-button">course preview</a>
                                        <a href="cart.html" class="template-button margin-left-10">add to cart</a>
                                    </div>
                                </div>
                            </div>



                    </div>
                </div>
            </div>
        </div>
    </section>





    <section class="category-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{trans('lang.Categories')}}  <span>{{trans('lang.we offer')}}</span></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($courses_categories as $courses_category)

                <div class="col-12 col-md-4 col-lg-3">
                    <a href="{{route('courses.category', $courses_category->id)}}">
                    <div class="category-card border">
                        <figure class="m-0">
                            <img src="{{asset('/org_assets/dist/img/sample.jpg')}}" alt="">
                        </figure>
                        <h5 class="text-center font-weight-bold my-3">{{$courses_category->name}}</h5>
                    </div>
                    </a>
                </div>

                @endforeach

            </div>
{{--            <div class="row">--}}
{{--                @foreach($courses_categories as $courses_category)--}}
{{--                    <div class="col-lg-3 col-md-6">--}}
{{--                        <a href="{{route('courses.category', $courses_category->id)}}"><div class="single-category-item">--}}
{{--                                <div class="category-image">--}}
{{--                                    <img src="{{asset('org_assets/dist/img/courseimg/category-icon-1.png')}}"  alt="image">--}}
{{--                                    <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape" class="feature-round-shape-3">--}}
{{--                                </div>--}}
{{--                                <div class="category-title margin-bottom-10">--}}
{{--                                    <h4>{{$courses_category->name}}</h4>--}}
{{--                                </div>--}}
{{--                                <span>{{$courses_category->courses->count()}} {{trans('lang.courses')}}</span>--}}
{{--                            </div></a>--}}
{{--                    </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
        </div>
    </section>











{{--    old one--}}


{{--    <section>--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="section-title text-center margin-bottom-40">--}}
{{--                        <h2>{{trans('lang.our_courses')}} <span>{{trans('lang.training')}}</span></h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="popular-course-tab">--}}
{{--                        <ul>--}}
{{--                            <li class="active" data-filter="*">{{trans('lang.all')}} </li>--}}
{{--                            @foreach($courses_categories as $courses_category)--}}
{{--                            <li data-filter="#{{str_replace(' ', '',$courses_category->name)}}">{{$courses_category->name}}</li>--}}
{{--                            @endforeach--}}

{{--                        </ul>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row grid">--}}
{{--                @foreach($courses_categories as $courses_category)--}}
{{--                @foreach($courses_category->courses as $course)--}}


{{--                <div class="col-lg-4 col-md-6 grid-item" id="{{str_replace(' ', '',$courses_category->name)}}" >--}}
{{--                    <div class="single-course-item">--}}
{{--                        <div class="course-image">--}}
{{--                            <img  src="{{asset('/org_assets/dist/img/courseimg/course-image-1.png')}}"  alt="image">--}}
{{--                        </div>--}}
{{--                        <div class="course-content margin-top-30">--}}
{{--                            <div class="course-title">--}}
{{--                                <h4>{{$course->name}}</h4>--}}
{{--                            </div>--}}

{{--                            <div class="course-instructor-rating margin-top-20">--}}
{{--                                <div class="course-instructor">--}}
{{--                                    <img src="{{config('app.url').$course->teacher->customer->img_path}}"  alt="instructor">--}}
{{--                                    <h6>{{$course->teacher->customer->first_name}} {{$course->teacher->customer->last_name}}</h6>--}}
{{--                                </div>--}}
{{--                                <div class="course-rating">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                    </ul>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="course-info margin-top-20">--}}
{{--                                <div class="course-video">--}}
{{--                                    <i class="fa fa-play-circle-o"></i>--}}
{{--                                    <span>50 {{trans('lang.lecture')}} </span>--}}
{{--                                </div>--}}
{{--                                <div class="course-time">--}}
{{--                                    <i class="fa fa-clock-o"></i>--}}
{{--                                    <span>{{$course->duration}} {{trans('lang.hour')}} </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="course-price-cart margin-top-20">--}}
{{--                                <div class="course-price">--}}
{{--                                    <span class="span-big">$ {{$course->price}}</span>--}}
{{--                                    <span class="span-cross">$ 500.00</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="hover-state" >--}}

{{--                            <div class="course-instructor-rating">--}}
{{--                                <a href="#">--}}
{{--                                <div class="course-instructor">--}}

{{--                                    <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-4.png')}}"  alt="instructor" style="margin: 10px">--}}
{{--                                    <h6>محمد علي</h6>--}}

{{--                                </div>--}}

{{--                                </a>--}}
{{--                            </div>--}}

{{--                            <span class="heart-icon" ><i class="fa fa-heart-o"></i></span>--}}
{{--                            <div class="course-title">--}}
{{--                                <h4><a href="#">{{$course->name}} </a></h4>--}}
{{--                            </div>--}}
{{--                            <div class="course-price-info margin-top-20">--}}
{{--                                <span class="best-seller">best seller</span>--}}
{{--                                <span class="course-category"><a href="#">{{$course->category->name}}</a></span>--}}
{{--                                <span class="course-price">$ {{$course->price}}</span>--}}
{{--                            </div>--}}
{{--                            <div class="course-info margin-top-30">--}}
{{--                                <div class="course-enroll">--}}
{{--                                    <span>{{trans('lang.enrolled')}} {{$course->total_students}} {{trans('lang.student')}} </span>--}}
{{--                                </div>--}}
{{--                                <div class="course-video">--}}
{{--                                    <i class="fa fa-play-circle-o"></i>--}}
{{--                                    <span>40 {{trans('lang.lecture')}}</span>--}}
{{--                                </div>--}}
{{--                                <div class="course-time">--}}
{{--                                    <i class="fa fa-clock-o"></i>--}}
{{--                                    <span>{{$course->duration}} {{trans('lang.hour')}} </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <p class="margin-top-20">{{$course->description}}</p>--}}
{{--                            <ul class="margin-top-20">--}}
{{--                                <li><i class="fa fa-circle-o"></i><span>Lorem ipsum dolor sit amet.</span></li>--}}
{{--                                <li><i class="fa fa-circle-o"></i><span>Consectetur adipisicing elit.</span></li>--}}
{{--                                <li><i class="fa fa-circle-o"></i><span>Placeat dolore quaerat itaque.</span></li>--}}
{{--                            </ul>--}}
{{--                            <div class="preview-button margin-top-20">--}}
{{--                                <a href="{{route('courses.detail',$course->id)}}" class="template-button">{{trans('lang.details')}}</a>--}}
{{--                                <a href="{{url('checkout')}}" class="template-button margin-left-10">{{trans('lang.buy')}} </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @endforeach--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}

{{--    </section>--}}

{{--    <section class="colored-bg" style="margin-top: 2%">--}}
{{--        <div class="container">--}}
{{--            <div class="section-heading">--}}
{{--                <h1>{{trans('lang.students_see')}}</h1>--}}
{{--                <p>هذا وصف فرعي للعنوان الرئيسي</p>--}}
{{--            </div>--}}
{{--            <div class="course-slider slickSlider">--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/courseimg/sample.png')}}"  alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">Bestseller</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="course-card">--}}
{{--                    <figure>--}}
{{--                        <img src="{{asset('/org_assets/dist/img/sample.png')}}" alt="">--}}
{{--                    </figure>--}}
{{--                    <div class="course-card-content">--}}
{{--                        <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>--}}
{{--                        <p>4.5 (25,428 تقييمات)</p>--}}
{{--                        <p>--}}
{{--                            <span>$9.99</span>--}}
{{--                            <span>$149</span>--}}
{{--                        </p>--}}
{{--                        <p class="badge">{{trans('lang.Bestseller')}}</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section class="course-recommendation">--}}
{{--        <div class="container">--}}
{{--            <div class="section-heading mb-0">--}}
{{--                <h1>احصل على ترشيحات شخصية</h1>--}}
{{--                <p>هذا وصف فرعي للعنوان الرئيسي</p>--}}
{{--                <a class="btn mt-3">اشترك الآن</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--    <!-- Categorry Section Starts -->--}}
{{--    <section class="category-section">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-12">--}}
{{--                    <div class="section-title text-center">--}}
{{--                        <h2>{{trans('lang.Categories')}}  <span>{{trans('lang.we offer')}}</span></h2>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row">--}}
{{--                @foreach($courses_categories as $courses_category)--}}
{{--                <div class="col-lg-3 col-md-6">--}}
{{--                    <a href="{{route('courses.category', $courses_category->id)}}"><div class="single-category-item">--}}
{{--                            <div class="category-image">--}}
{{--                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-1.png')}}"  alt="image">--}}
{{--                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape" class="feature-round-shape-3">--}}
{{--                            </div>--}}
{{--                            <div class="category-title margin-bottom-10">--}}
{{--                                <h4>{{$courses_category->name}}</h4>--}}
{{--                            </div>--}}
{{--                            <span>{{$courses_category->courses->count()}} {{trans('lang.courses')}}</span>--}}
{{--                        </div></a>--}}
{{--                </div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}



</main>
@endsection
