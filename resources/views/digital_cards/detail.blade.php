@extends('layouts.org_web.layout')
@section('content')

    <section class="breadcrumb-section" style="margin-top: 6%;">
        <div class="breadcrumb-shape">
            <img src="{{asset('/org_assets/dist/img/courseimg/logo0.png')}}" style="width: 70px; !important;" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{$Cards_info->name}}  </h2>
                    <div class="breadcrumb-link margin-top-10">
                        {{--                        <span><a href="index.html">home</a> / cart page</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Course Details Section Starts -->
    <section class="course-details-section padding-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="course-details-sidebar">
                        <img src="{{asset('/org_assets/dist/img/DC/amazon-gift.jpg')}}"  alt="image" width="100%" style="border-radius: 20px;">

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="course-details-title text-center">
                        <h3 style="font-family: 'Almarai',sans-serif;">{{$Cards_info->name}} </h3>
                    </div>
                    <hr>
                    <div class="col-md-12 text-center">
                        <div class="payment-part">
                            <h3> السعر   :  $   {{$Cards_info->price}} </h3>

                             <span style="color: green"><i class="fa fa-check"></i> متوفر. </span>
                            <div class="payment-tab margin-top-20">
                                <ul class="require-item">
                                    <li class="row justify-content-center"><i class="fa fa-check"></i> <h5>العلامة التجارية : </h5><span>امازون.</span></li>
                                    <li class="row justify-content-center"><i class="fa fa-check"></i> <h5>الموديل : </h5><span>Amazom gifts.</span></li>

                                </ul>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="tab-content margin-top-30">
                                            <div class="tab-one-content lost active">

                                                <div class="proceed-button text-center margin-top-30">
                                                    <button type="submit" class="template-button" style="width: 100%">  <i class="fas fa-shopping-cart"></i> اضافة للسلة </button>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="course-details-tab">
{{--                        <div class="tab">--}}
{{--                            <ul>--}}
{{--                                <li class="tab-one active">--}}
{{--                                    <span>نبذة </span>--}}
{{--                                </li>--}}


{{--                                --}}{{--                                <li class="tab-four">--}}
{{--                                --}}{{--                                    <span>review</span>--}}
{{--                                --}}{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
                        <div class="tab-content margin-top-30">
                            <div class="tab-one-content tab-content-bg overview-content lost active">
                                <h4>وصف المنتج :</h4>
                                <p class="margin-top-20">بطاقات هدايا أمازون هي الحل المناسب والهدية المثالية فهي تتيح لجميع الأشخاص الاختيار من بين مجموعة متنوعة وكم هائل من المنتجات ,جميعنا يتذكر موقع أمازون عندما كان يبيع الكتب الالكترونية فقط, الآن أمازون يحتوى تقريباً على كل ما يمكنك تخيله, من الرائع أن صلاحية قسائم شراء أمازون لا تنتهي أبداً, أحصل على بطاقات شراء أمازون واستخدمها في شراء كافة المنتجات داخل الموقع.</p>
                                <div class="overview-title margin-top-30">
                                    <h4>مزايا الخدمة :</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="learn-item">
                                            <li><i class="fa fa-check"></i> قسائم شراء أمازون تعنى الأمان، سهولة الاستخدام ، خدمة تثق بها.<span></span></li>
                                            <li><i class="fa fa-check"></i> قسائم شراء أمازون تعنى الأمان، سهولة الاستخدام ، خدمة تثق بها.<span></span></li>
                                            <li><i class="fa fa-check"></i> قسائم شراء أمازون تعنى الأمان، سهولة الاستخدام ، خدمة تثق بها.<span></span></li>
                                            <li><i class="fa fa-check"></i> قسائم شراء أمازون تعنى الأمان، سهولة الاستخدام ، خدمة تثق بها.<span></span></li>
                                            <li><i class="fa fa-check"></i> قسائم شراء أمازون تعنى الأمان، سهولة الاستخدام ، خدمة تثق بها.<span></span></li>
                                        </ul>
                                    </div>

                                </div>
                                {{--                                <p class="margin-top-20">This course is aimed at teaching photographers what it takes to improve your techniques to earn more money.You'll start with the basics and tackle how a camera operates. While there are plenty of digital photography courses that focus on specific styles or how to use gear, it's hard to find a comprehensive course like this one, which is for beginner to advanced photographers.</p>--}}
                                <div class="overview-title margin-top-20">
                                    <h4>كيفية الأستخدام  :</h4>
                                </div>
                                <ul class="require-item">
                                    <li><i class="fa fa-square"></i> <span>أختر الفئة التي تريد شرائها ثم أضغط "اشترى الأن.</span></li>
                                    <li><i class="fa fa-square"></i> <span>أختر الفئة التي تريد شرائها ثم أضغط "اشترى الأن.</span></li>
                                    <li><i class="fa fa-square"></i> <span>أختر الفئة التي تريد شرائها ثم أضغط "اشترى الأن.</span></li>
                                    <li><i class="fa fa-square"></i> <span>أختر الفئة التي تريد شرائها ثم أضغط "اشترى الأن.</span></li>
                                </ul>
                            </div>
                            {{--                            <div class="tab-four-content tab-content-bg review-content lost">--}}
                            {{--                                <div class="row">--}}
                            {{--                                    <div class="col-lg-4">--}}
                            {{--                                        <div class="rating-left">--}}
                            {{--                                            <h2>4.5</h2>--}}
                            {{--                                            <ul class="green-starts">--}}
                            {{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>--}}
                            {{--                                            </ul>--}}
                            {{--                                            <span>متوسط التقييم</span>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-lg-8">--}}
                            {{--                                        <div class="rating-right">--}}
                            {{--                                            <div class="review-title">--}}
                            {{--                                                <h4>تقييمات</h4>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="single-review">--}}
                            {{--                                                <div class="progress-part">--}}
                            {{--                                                    <div class="progress">--}}
                            {{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="start-part">--}}
                            {{--                                                    <ul class="yellow-starts">--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                    </ul>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="percentage-part">--}}
                            {{--                                                    <span>80%</span>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="single-review">--}}
                            {{--                                                <div class="progress-part">--}}
                            {{--                                                    <div class="progress">--}}
                            {{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="start-part">--}}
                            {{--                                                    <ul class="yellow-starts">--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                    </ul>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="percentage-part">--}}
                            {{--                                                    <span>50%</span>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="single-review">--}}
                            {{--                                                <div class="progress-part">--}}
                            {{--                                                    <div class="progress">--}}
                            {{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="start-part">--}}
                            {{--                                                    <ul class="yellow-starts">--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                    </ul>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="percentage-part">--}}
                            {{--                                                    <span>20%</span>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="single-review">--}}
                            {{--                                                <div class="progress-part">--}}
                            {{--                                                    <div class="progress">--}}
                            {{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="start-part">--}}
                            {{--                                                    <ul class="yellow-starts">--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                    </ul>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="percentage-part">--}}
                            {{--                                                    <span>10%</span>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                            <div class="single-review">--}}
                            {{--                                                <div class="progress-part">--}}
                            {{--                                                    <div class="progress">--}}
                            {{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>--}}
                            {{--                                                    </div>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="start-part">--}}
                            {{--                                                    <ul class="yellow-starts">--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
                            {{--                                                    </ul>--}}
                            {{--                                                </div>--}}
                            {{--                                                <div class="percentage-part">--}}
                            {{--                                                    <span>10%</span>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
