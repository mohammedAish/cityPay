@extends('layouts.org_web.layout')
@section('content')


    <header class="inner-header no-overlay" style="margin-top: 6%;">
        <div class="container">
            <div class="section-heading">
                <h1>{{__('lang.consultants')}}</h1>
                <p>شركة يمن تداول هي شركة ريادية متطورة تعمل في مجال المال، تساند العاملين في منصة الاعمال المالية
                    بمساندة متقدمة ومرنة عبر باقات متنوعه من الخدمات المالية ذات الجودة العالية والدقة وبمعايير عالمية
                    تفوق توقعات العملاء؛ لتستمر حركة مواردهم المالية  إلى الأمام.</p>

                <div class="search-input mt-5 d-flex flex-column flex-md-row align-items-center">
                    <input type="text" class="form-control" placeholder="{{__('lang.what_you_want_to_consultant')}}">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                        <span>{{__('lang.search')}}</span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <!-- Categorry Section Starts -->
    <section class="category-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>{{__('lang.ConsultantsCategories') }}<span>{{ __('lang.we_offer')}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($consultants_cats as $consultants_cat)
                    <div class="col-lg-3 col-md-6">
                        <a href={{route('consultants.category',$consultants_cat->id)}}>
                            <div class="single-category-item">
                                <div class="category-image">
                                    <img src="{{config('app.url').$consultants_cat->img_path}}" alt="image">
                                    <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape"
                                         class="feature-round-shape-3">
                                </div>
                                <div class="category-title margin-bottom-10">
                                    <h4>{{$consultants_cat->name}}</h4>
                                </div>
                                <span>{{$consultants_cat->consultants->count()}} استشارات </span>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- consulting Section Starts -->

    <section class="course-section gradient-bg padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center margin-bottom-40">
                        <h2>{{__('lang.consultants_yt')}} <span>{{__('lang.ytadawul')}}</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="popular-course-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="active">
                                <a id="" class="nav-link "
                                   data-toggle="tab" href="#cagtegory_all" role="tab"
                                   aria-controls="home_all"
                                   aria-selected="true">{{__('lang.all_consultants')}}</a>
                            </li>
                            @foreach($consultants_cats as $consultants_cat)

                                {{--                            <li data-filter="#{{str_replace(' ', '', $consultants_cat->name)}}">{{$consultants_cat->name}}</li>--}}
                                <li class=" ">
                                    <a id="" class="nav-link "
                                       data-toggle="tab" href="#cagtegory_{{$consultants_cat->id}}" role="tab"
                                       aria-controls="home{{$consultants_cat->id}}"
                                       aria-selected="true">{{$consultants_cat->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade active show "
                                 id="cagtegory_all" role="tabpanel"
                                 aria-labelledby="home_all-tab">
                                <div class="row grid" style="margin-bottom: 20%;">
                                    @foreach($consultants_cats as $consultants_cat)
                                        @foreach($consultants_cat->consultants as $consultant)
                                            @include('consulting.consultant_item',['consultant'=>$consultant,'consultants_cat'=>$consultants_cat])
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>

                            @foreach($consultants_cats as $consultants_cat)
                                <div class="tab-pane fade  "
                                     id="cagtegory_{{$consultants_cat->id}}" role="tabpanel"
                                     aria-labelledby="home{{$consultants_cat->id}}-tab">
                                    <div class="row grid" style="margin-bottom: 20%; ">
                                        @foreach($consultants_cat->consultants as $consultant)

                                            @include('consulting.consultant_item',['consultant'=>$consultant])
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{--            <div class="row grid">--}}
            {{--                <div class="col-lg-3 col-md-6 grid-item marketing">--}}
            {{--                    <div class="single-course-item">--}}
            {{--                        <div class="course-image">--}}
            {{--                            <img src={{asset('org_assets/dist/img/courseimg/course-image-1.png')}} alt="image" style="width: 100%;">--}}
            {{--                        </div>--}}
            {{--                        <div class="course-content margin-top-30">--}}
            {{--                            <div class="course-title">--}}
            {{--                                <h4>استشارة في التسويق الرقمي</h4>--}}
            {{--                            </div>--}}

            {{--                            <div class="course-info margin-top-20">--}}
            {{--                                <div class="course-view">--}}
            {{--                                    <i class="fa fa-eye"></i>--}}
            {{--                                    <span>25,000 views</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-video">--}}
            {{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                                    <span>36 lectures</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-time">--}}
            {{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                                    <span>2h 40mins</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="course-price-cart margin-top-20">--}}
            {{--                                <div class="course-price">--}}
            {{--                                    <span class="span-big">مجانا</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="hover-state">--}}

            {{--                            <div class="course-title margin-top-10">--}}
            {{--                                <h4><a href="#">استشارة في التسويق الرقمي</a></h4>--}}
            {{--                            </div>--}}
            {{--                            <div class="course-price-info margin-top-20">--}}
            {{--                                <span class="course-category"><a href="#">تسويق</a></span>--}}
            {{--                                <span class="course-price">مجانا</span>--}}
            {{--                            </div>--}}
            {{--                            <div class="course-info margin-top-30">--}}
            {{--                                <div class="course-enroll">--}}
            {{--                                    <span>enrolled 0</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-video">--}}
            {{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                                    <span>36 lectures</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-time">--}}
            {{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                                    <span>2h 40mins</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <p class="margin-top-20">هذه الاستشارة ستمكنك من عمل خطة تسويقية في مجال عملك مهما كان</p>--}}

            {{--                            <div class="preview-button margin-top-20">--}}
            {{--                                <a href="course-details.html" class="template-button">التفاصيل</a>--}}
            {{--                                <a href="cart.html" class="template-button margin-left-10">شراء</a>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-3 col-md-6 grid-item marketing">--}}
            {{--                    <div class="single-course-item">--}}
            {{--                        <div class="course-image">--}}
            {{--                            <img src={{asset('org_assets/dist/img/courseimg/course-image-1.png')}} alt="image" style="width: 100%;">--}}
            {{--                        </div>--}}
            {{--                        <div class="course-content margin-top-30">--}}
            {{--                            <div class="course-title">--}}
            {{--                                <h4>استشارة في التسويق الرقمي</h4>--}}
            {{--                            </div>--}}

            {{--                            --}}{{--                            <div class="course-info margin-top-20">--}}
            {{--                            --}}{{--                                <div class="course-view">--}}
            {{--                            --}}{{--                                    <i class="fa fa-eye"></i>--}}
            {{--                            --}}{{--                                    <span>25,000 views</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-video">--}}
            {{--                            --}}{{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                            --}}{{--                                    <span>36 lectures</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-time">--}}
            {{--                            --}}{{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                            --}}{{--                                    <span>2h 40mins</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                            <div class="course-price-cart margin-top-20">--}}
            {{--                                <div class="course-price">--}}
            {{--                                    <span class="span-big">مجانا</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="hover-state">--}}

            {{--                            <div class="course-title margin-top-10">--}}
            {{--                                <h4><a href="#">استشارة في التسويق الرقمي</a></h4>--}}
            {{--                            </div>--}}
            {{--                            <div class="course-price-info margin-top-20">--}}
            {{--                                <span class="course-category"><a href="#">تسويق</a></span>--}}
            {{--                                <span class="course-price">مجانا</span>--}}
            {{--                            </div>--}}
            {{--                            --}}{{--                            <div class="course-info margin-top-30">--}}
            {{--                            --}}{{--                                <div class="course-enroll">--}}
            {{--                            --}}{{--                                    <span>enrolled 0</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-video">--}}
            {{--                            --}}{{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                            --}}{{--                                    <span>36 lectures</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-time">--}}
            {{--                            --}}{{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                            --}}{{--                                    <span>2h 40mins</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                            <p class="margin-top-20">هذه الاستشارة ستمكنك من عمل خطة تسويقية في مجال عملك مهما كان</p>--}}

            {{--                            <div class="preview-button margin-top-20">--}}
            {{--                                <a href="course-details.html" class="template-button">التفاصيل</a>--}}
            {{--                                <a href="cart.html" class="template-button margin-left-10">شراء</a>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-3 col-md-6 grid-item marketing">--}}
            {{--                    <div class="single-course-item">--}}
            {{--                        <div class="course-image">--}}
            {{--                            <img src={{asset('org_assets/dist/img/courseimg/course-image-1.png')}} alt="image" style="width: 100%;">--}}
            {{--                        </div>--}}
            {{--                        <div class="course-content margin-top-30">--}}
            {{--                            <div class="course-title">--}}
            {{--                                <h4>استشارة في التسويق الرقمي</h4>--}}
            {{--                            </div>--}}

            {{--                            --}}{{--                            <div class="course-info margin-top-20">--}}
            {{--                            --}}{{--                                <div class="course-view">--}}
            {{--                            --}}{{--                                    <i class="fa fa-eye"></i>--}}
            {{--                            --}}{{--                                    <span>25,000 views</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-video">--}}
            {{--                            --}}{{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                            --}}{{--                                    <span>36 lectures</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-time">--}}
            {{--                            --}}{{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                            --}}{{--                                    <span>2h 40mins</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                            <div class="course-price-cart margin-top-20">--}}
            {{--                                <div class="course-price">--}}
            {{--                                    <span class="span-big">مجانا</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="hover-state">--}}

            {{--                            <div class="course-title margin-top-10">--}}
            {{--                                <h4><a href="#">استشارة في التسويق الرقمي</a></h4>--}}
            {{--                            </div>--}}
            {{--                            <div class="course-price-info margin-top-20">--}}
            {{--                                <span class="course-category"><a href="#">تسويق</a></span>--}}
            {{--                                <span class="course-price">مجانا</span>--}}
            {{--                            </div>--}}
            {{--                            --}}{{--                            <div class="course-info margin-top-30">--}}
            {{--                            --}}{{--                                <div class="course-enroll">--}}
            {{--                            --}}{{--                                    <span>enrolled 0</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-video">--}}
            {{--                            --}}{{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                            --}}{{--                                    <span>36 lectures</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-time">--}}
            {{--                            --}}{{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                            --}}{{--                                    <span>2h 40mins</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                            <p class="margin-top-20">هذه الاستشارة ستمكنك من عمل خطة تسويقية في مجال عملك مهما كان</p>--}}

            {{--                            <div class="preview-button margin-top-20">--}}
            {{--                                <a href="course-details.html" class="template-button">التفاصيل</a>--}}
            {{--                                <a href="cart.html" class="template-button margin-left-10">شراء</a>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-lg-3 col-md-6 grid-item marketing">--}}
            {{--                    <div class="single-course-item">--}}
            {{--                        <div class="course-image">--}}
            {{--                            <img src={{asset('org_assets/dist/img/courseimg/course-image-1.png')}} alt="image" style="width: 100%;">--}}
            {{--                        </div>--}}
            {{--                        <div class="course-content margin-top-30">--}}
            {{--                            <div class="course-title">--}}
            {{--                                <h4>استشارة في التسويق الرقمي</h4>--}}
            {{--                            </div>--}}

            {{--                            --}}{{--                            <div class="course-info margin-top-20">--}}
            {{--                            --}}{{--                                <div class="course-view">--}}
            {{--                            --}}{{--                                    <i class="fa fa-eye"></i>--}}
            {{--                            --}}{{--                                    <span>25,000 views</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-video">--}}
            {{--                            --}}{{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                            --}}{{--                                    <span>36 lectures</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-time">--}}
            {{--                            --}}{{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                            --}}{{--                                    <span>2h 40mins</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                            <div class="course-price-cart margin-top-20">--}}
            {{--                                <div class="course-price">--}}
            {{--                                    <span class="span-big">مجانا</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                        <div class="hover-state">--}}

            {{--                            <div class="course-title margin-top-10">--}}
            {{--                                <h4><a href="#">استشارة في التسويق الرقمي</a></h4>--}}
            {{--                            </div>--}}
            {{--                            <div class="course-price-info margin-top-20">--}}
            {{--                                <span class="course-category"><a href="#">تسويق</a></span>--}}
            {{--                                <span class="course-price">مجانا</span>--}}
            {{--                            </div>--}}
            {{--                            --}}{{--                            <div class="course-info margin-top-30">--}}
            {{--                            --}}{{--                                <div class="course-enroll">--}}
            {{--                            --}}{{--                                    <span>enrolled 0</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-video">--}}
            {{--                            --}}{{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                            --}}{{--                                    <span>36 lectures</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                                <div class="course-time">--}}
            {{--                            --}}{{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                            --}}{{--                                    <span>2h 40mins</span>--}}
            {{--                            --}}{{--                                </div>--}}
            {{--                            --}}{{--                            </div>--}}
            {{--                            <p class="margin-top-20">هذه الاستشارة ستمكنك من عمل خطة تسويقية في مجال عملك مهما كان</p>--}}

            {{--                            <div class="preview-button margin-top-20">--}}
            {{--                                <a href="course-details.html" class="template-button">التفاصيل</a>--}}
            {{--                                <a href="cart.html" class="template-button margin-left-10">شراء</a>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}

            {{--            </div>--}}


        </div>

    </section>

    <!-- CounterUp Section Starts -->
    <section class="counterup-section">
        <div class="container">
            <div class="counterup-content common-section padding-top-60 padding-bottom-30">
                <div class="counter-shape">
                    <img src="{{asset('/org_assets/dist/img/courseimg/round-shape-2.png')}}" alt="shape"
                         class="round-shape-2">
                    <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="shape"
                         class="plus-sign item-rotate">
                    <img src="{{asset('/org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape"
                         class="round-shape-3">
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-4 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/counter-image-1.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">{{$all_consultants->count()}}</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>عدد الاستشارات</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/category-icon-3.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">{{$countCustomers}}</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>عدد اشخاص اخذو استشارات</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/counter-image-2.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">10</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>سنين الخبرة</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>




    <!-- CTA Section Starts -->
    <section class="cta-section gradient-bg padding-top-60 padding-bottom-30">
        <div class="cta-shape">
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="image"
                 class="plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title margin-bottom-40">
                        <h2>طور شركتك من خلال <span>استشارات يمن تداول </span></h2>
                    </div>
                    <div class="cta-button">
                        <a href="#" class="template-button margin-right-20">تصفح الاستشارات </a>
                        <a href="#" class="template-button-2">اطلب استشارتك</a>
                    </div>
                </div>
                <div class="col-xl-4 offset-xl-2 col-lg-6">
                    <div class="cta-image">
                        <img src="{{asset('/org_assets/dist/img/courseimg/cta-image.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
