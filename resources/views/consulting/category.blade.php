@extends('layouts.org_web.layout')
@section('content')
    <header class="inner-header no-overlay" style="margin-top: 6%">
        <div class="container">
            <div class="section-heading">
                <h1>{{$consultants_cats->name}}</h1>

                <p>{{$consultants_cats->description}} </p>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="courses">


        <!-- Course Section Starts -->
        <div class="course-page-content 0">
            <div class="container">
                <div class="page-content-top margin-bottom-40">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="course-tab">
                                <ul>
                                    <li class="active" data-filter="*">استشارات الشركات الناشئة</li>

                                </ul>
                            </div>
                        </div>
{{--                        <div class="col-md-6">--}}
{{--                            <div class="header-search">--}}
{{--                                <form action="#">--}}
{{--                                    <input type="text" placeholder="Course Search">--}}
{{--                                    <button type="submit"><i class="fa fa-search"></i></button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="row grid ">
                    @foreach($all_consultants as $consultant)
                    <div class="col-lg-3 col-md-6 grid-item wishlist" >
                        <div class="single-course-item">
                            <div class="course-image">
                                <img src="{{asset($consultant->img_path)}}"  alt="image" style="width: 100%;">
                            </div>
                            <div class="course-content margin-top-30">
                                <div class="course-title">
                                    <h4>{{$consultant->name}} </h4>
                                </div>
{{--                                <div class="course-instructor-rating margin-top-20">--}}

{{--                                    <div class="course-rating">--}}
{{--                                        <ul>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                            <li><i class="fa fa-star"></i></li>--}}
{{--                                        </ul>--}}
{{--                                        <span>4.2(30)</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="course-info margin-top-20">
                                    <div class="course-view">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span>5 اشخاص اخذو هذه الاستشارة</span>
                                    </div>


                                </div>
                                <div class="course-price-cart margin-top-20">
                                    <div class="course-price">
                                        <span class="span-big">$ {{$consultant->price}}</span>
{{--                                        <span class="span-cross">$ 500.00</span>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="hover-state">

                                <div class="course-price-info margin-top-20">

                                    <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                    <span class="course-price">$ {{$consultant->price}}</span>
                                </div>
                                <div class="course-info margin-top-30">
                                    <div class="course-enroll">
                                        <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                    </div>


                                </div>

                                <div class="preview-button margin-top-20">
                                    <a href={{route('consultant.detail',$consultant->id)}} class="template-button">تفاصيل </a>
                                    <a href="#" class="template-button margin-left-10">شراء </a>
                                </div>
                            </div>
                        </div>
                    </div>




                        @endforeach
                    </div>
                </div>


            </div>



        <!-- Featured Courses -->
        <section class="">
            <div class="container">
                <div class="section-title margin-bottom-40">
                    <h2>استشارات مقترحة</h2>
                </div>

                <div class="featured-course-slider slickSlider">
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src={{asset('org_assets/dist/img/header3.jpg')}} alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src={{asset('org_assets/dist/img/header3.jpg')}} alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src={{asset('org_assets/dist/img/header3.jpg')}} alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src={{asset('org_assets/dist/img/header3.jpg')}} alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                        </div>
                    </div>
                    <div class="course-card d-flex flex-column flex-md-row">
                        <figure style="padding: 20px">
                            <img src={{asset('org_assets/dist/img/header3.jpg')}} alt="">
                        </figure>
                        <div class="course-card-content" style="padding: 20px">
                            <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                            <p>
                                <span>$9.99</span>
                                <span>$149</span>
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </section>
        {{--search area--}}
        <section class="">
            <div class="container">
                <div class="section-title margin-bottom-40">
                    <h2>البحث عن الاستشارة</h2>
                </div>

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center justify-content-start">
                                <button class="btn mx-2" data-toggle="collapse" href="#filter-collapse" role="button" aria-expanded="false" aria-controls="filter-collapse">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter1" aria-expanded="false" aria-controls="filter1">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter2" aria-expanded="false" aria-controls="filter2">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter3" aria-expanded="false" aria-controls="filter3">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter4" aria-expanded="false" aria-controls="filter4">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter5" aria-expanded="false" aria-controls="filter5">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter6" aria-expanded="false" aria-controls="filter6">
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
                                <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter7" aria-expanded="false" aria-controls="filter7">
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

                            @foreach($all_consultants as $consultant)
                                <a href="{{route('courses.detail',$consultant->id)}}">

                                    <div class="course-card flex-row d-flex">
                                        <figure style="width: 40%; padding: 10px ">
                                            <img src="dist/img/sample.jpg" alt="">
                                        </figure>
                                        <div class="course-card-content" style="padding: 10px">
                                            <h5>{{$consultant->name}}</h5>
                                            <p>4.5 (25,428 تقييمات)</p>
                                            <p>
                                                <span>${{$consultant->price}}</span>
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



    </main>
@endsection
