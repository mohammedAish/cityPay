@extends('layouts.org_web.layout')
@section('content')


    <header class="inner-header no-overlay" style="margin-top: 6%;">
        <div class="container">
            <div class="section-heading">
                <h1>الاستشارات</h1>
                <p>شركة يمن تداول هي شركة ريادية متطورة تعمل في مجال المال، تساند العاملين في منصة الاعمال المالية بمساندة متقدمة ومرنة عبر باقات متنوعه من الخدمات المالية ذات الجودة العالية والدقة وبمعايير عالمية تفوق توقعات العملاء؛ لتستمر حركة مواردهم المالية  إلى الأمام.</p>

                <div class="search-input mt-5 d-flex flex-column flex-md-row align-items-center">
                    <input type="text" class="form-control" placeholder="عن ماذا تريد ان تستشير">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                        <span>بحث</span>
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
                        <h2>انواع الاستشارات  <span>التي نقدمها</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <a href="#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-1.png')}}"  alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>استشارات في التسويق</h4>
                            </div>
                            <span>03 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-2.png')}}" alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>استشارات في التداول</h4>
                            </div>
                            <span>02 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href=#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-3.png')}}"  alt="image">
                                <img  src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}"  alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>استسشارات تعليمية</h4>
                            </div>
                            <span>10 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="%"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-4.png')}}"  alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>شركات ناشئة</h4>
                            </div>
                            <span>04 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-5.png')}}"  alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>استشارات تكنولوجية</h4>
                            </div>
                            <span>03 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-6.png')}}"  alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}"  alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>اي نوع</h4>
                            </div>
                            <span>05 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-7.png')}}"  alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}"  alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>استشارات كثيرة</h4>
                            </div>
                            <span>09 استشارات</span>
                        </div></a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="#"><div class="single-category-item">
                            <div class="category-image">
                                <img src="{{asset('org_assets/dist/img/courseimg/category-icon-8.png')}}" alt="image">
                                <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}"  alt="shape" class="feature-round-shape-3">
                            </div>
                            <div class="category-title margin-bottom-10">
                                <h4>استشارات تصميم</h4>
                            </div>
                            <span>08 استشارات</span>
                        </div></a>
                </div>
            </div>
        </div>
    </section>



    <!-- Course Section Starts -->
    <section class="course-section gradient-bg padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center margin-bottom-40">
                        <h2>استشارات <span>يمن تداول</span></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="popular-course-tab">
                        <ul>
                            <li class="active" data-filter="*">جميع الاستشارات</li>
                            <li data-filter=".web">المشاريع الناشئة</li>
                            <li data-filter=".ux">التسويق</li>
                            <li data-filter=".photography">استشارات التداول</li>
                            <li data-filter=".marketing">استشارات مجانية</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row grid">
                <div class="col-lg-4 col-md-6 grid-item web" >
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-1.png')}}"  alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد </h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">

                                <div class="course-rating">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>4.2(30)</span>
                                </div>
                            </div>
                            <div class="course-info margin-top-20">
                                <div class="course-view">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>5 اشخاص اخذو هذه الاستشارة</span>
                                </div>


                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state">
                            <span class="heart-icon"><i class="fa fa-heart-o"></i></span>
                            <div class="course-title margin-top-80">
                                <h4><a href="#">استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد</a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">

                                <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                <span class="course-price">$ 400.00</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                </div>


                            </div>

                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">تفاصيل الاستشارة</a>
                                <a href="#" class="template-button margin-left-10">اخذ الاستشارة </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item ux">
                    <div class="single-course-item diffrent-bg-color">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-2.png')}}" alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد </h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">

                                <div class="course-rating">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>4.2(30)</span>
                                </div>
                            </div>
                            <div class="course-info margin-top-20">
                                <div class="course-view">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>5 اشخاص اخذو هذه الاستشارة</span>
                                </div>


                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state">
                            <span class="heart-icon"><i class="fa fa-heart-o"></i></span>
                            <div class="course-title margin-top-80">
                                <h4><a href="#">استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد</a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">

                                <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                <span class="course-price">$ 400.00</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                </div>


                            </div>

                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">تفاصيل الاستشارة</a>
                                <a href="#" class="template-button margin-left-10">اخذ الاستشارة </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item web">
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-4.png')}}"  alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد </h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">

                                <div class="course-rating">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>4.2(30)</span>
                                </div>
                            </div>
                            <div class="course-info margin-top-20">
                                <div class="course-view">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>5 اشخاص اخذو هذه الاستشارة</span>
                                </div>


                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state">
                            <span class="heart-icon"><i class="fa fa-heart-o"></i></span>
                            <div class="course-title margin-top-80">
                                <h4><a href="#">استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد</a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">

                                <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                <span class="course-price">$ 400.00</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                </div>


                            </div>

                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">تفاصيل الاستشارة</a>
                                <a href="#" class="template-button margin-left-10">اخذ الاستشارة </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item music">
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-3.png')}}" alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد </h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">

                                <div class="course-rating">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>4.2(30)</span>
                                </div>
                            </div>
                            <div class="course-info margin-top-20">
                                <div class="course-view">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>5 اشخاص اخذو هذه الاستشارة</span>
                                </div>


                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state">
                            <span class="heart-icon"><i class="fa fa-heart-o"></i></span>
                            <div class="course-title margin-top-80">
                                <h4><a href="#">استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد</a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">

                                <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                <span class="course-price">$ 400.00</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                </div>


                            </div>

                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">تفاصيل الاستشارة</a>
                                <a href="#" class="template-button margin-left-10">اخذ الاستشارة </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item photography">
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-4.png')}}"  alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد </h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">

                                <div class="course-rating">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>4.2(30)</span>
                                </div>
                            </div>
                            <div class="course-info margin-top-20">
                                <div class="course-view">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>5 اشخاص اخذو هذه الاستشارة</span>
                                </div>


                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state">
                            <span class="heart-icon"><i class="fa fa-heart-o"></i></span>
                            <div class="course-title margin-top-80">
                                <h4><a href="#">استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد</a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">

                                <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                <span class="course-price">$ 400.00</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                </div>


                            </div>

                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">تفاصيل الاستشارة</a>
                                <a href="#" class="template-button margin-left-10">اخذ الاستشارة </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item web">
                    <div class="single-course-item diffrent-bg-color">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-5.png')}}" alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد </h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">

                                <div class="course-rating">
                                    <ul>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <span>4.2(30)</span>
                                </div>
                            </div>
                            <div class="course-info margin-top-20">
                                <div class="course-view">

                                    <i class="fa fa-shopping-cart"></i>
                                    <span>5 اشخاص اخذو هذه الاستشارة</span>
                                </div>


                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state">
                            <span class="heart-icon"><i class="fa fa-heart-o"></i></span>
                            <div class="course-title margin-top-80">
                                <h4><a href="#">استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد</a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">

                                <span class="course-category"><a href="#">استشارات عن التسويق </a></span>
                                <span class="course-price">$ 400.00</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>عدد الاشخاص الذي اخذو هذه الاستشارة  17 </span>
                                </div>


                            </div>

                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">تفاصيل الاستشارة</a>
                                <a href="#" class="template-button margin-left-10">اخذ الاستشارة </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CounterUp Section Starts -->
    <section class="counterup-section">
        <div class="container">
            <div class="counterup-content common-section padding-top-60 padding-bottom-30">
                <div class="counter-shape">
                    <img src="{{asset('/org_assets/dist/img/courseimg/round-shape-2.png')}}"  alt="shape" class="round-shape-2">
                    <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="shape" class="plus-sign item-rotate">
                    <img src="{{asset('/org_assets/dist/img/courseimg/round-shape-3.png')}}"  alt="shape" class="round-shape-3">
                </div>
                <div class="row align-items-center">
                    <div class="col-xl-3 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/counter-image-1.png')}}"  alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">2000</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>عدد الاستشارات</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/category-icon-3.png')}}" alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">7000</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>عدد اشخاص اخذو استشارات</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/counter-image-2.png')}}"  alt="image">
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
                    <div class="col-xl-3 col-sm-6">
                        <div class="single-counterup">
                            <div class="single-counterup-image">
                                <img src="{{asset('/org_assets/dist/img/courseimg/category-icon-6.png')}}"  alt="image">
                            </div>
                            <div class="single-counterup-content">
                                <div class="counter-number">
                                    <h3 class="title counter">50</h3>
                                    <h3 class="title">+</h3>
                                </div>
                                <span>اي عدد</span>
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
            <img   src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="image" class="plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title margin-bottom-40">
                        <h2>طور شركتك  من خلال <span>استشارات يمن تداول </span></h2>
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
