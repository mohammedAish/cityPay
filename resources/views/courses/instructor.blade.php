@extends('layouts.org_web.layout')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section" style="margin-top: 6%;">
        <div class="breadcrumb-shape">
            <img src="{{asset('/org_assets/dist/img/courseimg/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}"  alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{trans('lang.teacher_detail')}}</h2>

                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Details Section Starts -->
    <section class="instructor-details-section padding-top-120">
        <div class="container">
            <div class="instructor-content-top">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="instructor-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/instructor-details-image.jpg')}}"   alt="instructor">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="instructor-info">
                            <h3>يوسف الخميسي </h3>
                            <span class="instructor-tag">مدرس فلاتر </span>
                            <div class="instructor-social-link">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <p class="margin-top-20">Blanche has always been a passionate educator and instructor for students who have a talent for languages and technical science. founded SoftTech-IT in 1988 and trained over 5000 students online, many of whom are now successful businessmen, educators & technicians.</p>
                            <div class="instructor-education margin-top-20">
                                <h5>{{trans('lang.quali')}}</h5>
                                <ul>
                                    <li><i class="fa fa-arrow-circle-right"></i>ماستر تنولوجيا معلومات - كامبردج - بريطانيا </li>
                                    <li><i class="fa fa-arrow-circle-right"></i>بالكلوريوس - جامعة صناء - اليمن </li>
                                </ul>
                            </div>
                            <div class="instructor-asset margin-top-30">
                                <div class="single-asset">
                                    <div class="asset-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/category-icon-3.png')}}"    alt="image">
                                    </div>
                                    <div class="assets-content">
                                        <h4>500</h4>
                                        <h6>{{trans('lang.total_students')}}</h6>
                                    </div>
                                </div>
                                <div class="single-asset">
                                    <div class="asset-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/counter-image-2.png')}}" alt="image">
                                    </div>
                                    <div class="assets-content">
                                        <h4>20</h4>
                                        <h6>{{trans('lang.total_courses')}}</h6>
                                    </div>
                                </div>
                                <div class="single-asset">
                                    <div class="asset-image">
                                        <img src="{{asset('/org_assets/dist/img/courseimg/counter-image-1.png')}}"  alt="image">
                                    </div>
{{--                                    <div class="assets-content">--}}
{{--                                        <h4>4.4</h4>--}}
{{--                                        <h6>reviews</h6>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="instructor-content-bottom margin-top-60">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="bottom-left-part">
                            <div class="bottom-content-title">
                                <h4>{{trans('lang.about_me')}}</h4>
                            </div>
                            <p>I am the founder of the SoftTech_IT LTD. and an Amazon Web Services community hero. I hold every associate certification and I am a certified AWS Solutions Architect Professional. I am ex-Rackspace, ex-Sungard. I have been working in the Cloud space since it's very inception. I am not just another I.T. trainer. I teach Cloud because I know it.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="instructor-skill-part">
                            <div class="bottom-content-title">
                                <h4>{{trans('lang.my_skills')}}</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>UI & UX design</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>80%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>wordPress</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>90%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>technology</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>70%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-skill-item">
                                        <div class="progress-info d-flex justify-content-between">
                                            <div class="progress-info-left">
                                                <span>marketing</span>
                                            </div>
                                            <div class="progress-info-right">
                                                <span>60%</span>
                                            </div>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Instructor Courses Section Starts -->
    <section class="instructor-courses padding-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>{{trans('lang.course_by')}} <span>يوسف الخميسي</span></h2>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-1.png')}}"  alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>user experience design with adobe XD</h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">
                                <div class="course-instructor">
                                    <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-1.png')}}" alt="instructor">
                                    <h6>يوسف الخميسي</h6>
                                </div>
{{--                                <div class="course-rating">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                        <li><i class="fa fa-star"></i></li>--}}
{{--                                    </ul>--}}
{{--                                    <span>4.2(30)</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="course-info margin-top-20">

                                <div class="course-video">
                                    <i class="fa fa-play-circle-o"></i>
                                    <span>36 {{trans('lang.lecture')}}</span>
                                </div>
                                <div class="course-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>2h 40mins</span>
                                </div>
                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state" >

                            <div class="course-instructor-rating">
                                <a href="#">
                                    <div class="course-instructor">

                                        <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-4.png')}}"  alt="instructor" style="margin: 10px">
                                        <h6>محمد علي</h6>

                                    </div>

                                </a>
                            </div>

                            {{--                            <span class="heart-icon" ><i class="fa fa-heart-o"></i></span>--}}
                            <div class="course-title">
                                <h4><a href="#">فلاتر </a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">
                                {{--                                <span class="best-seller">best seller</span>--}}
                                <span class="course-category"><a href="#">برمجة</a></span>
                                <span class="course-price">$ 500</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>{{trans('lang.enrolled')}} 450 {{trans('lang.student')}} </span>
                                </div>
                                <div class="course-video">
                                    <i class="fa fa-play-circle-o"></i>
                                    <span>20 {{trans('lang.lecture')}}</span>
                                </div>
                                <div class="course-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>50 {{trans('lang.hour')}} </span>
                                </div>
                            </div>
                            <p class="margin-top-20">هنا وصف عن هذا الكورس نمتانانتؤياشتنؤيتغشللسغتنؤل ناؤتنسِـ،} يؤاستؤنس ناؤسيت</p>
                            {{--                            <ul class="margin-top-20">--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Lorem ipsum dolor sit amet.</span></li>--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Consectetur adipisicing elit.</span></li>--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Placeat dolore quaerat itaque.</span></li>--}}
                            {{--                            </ul>--}}
                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">{{trans('lang.details')}}</a>
                                <a href="{{url('checkout')}}" class="template-button margin-left-10">{{trans('lang.buy')}} </a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-1.png')}}"  alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>user experience design with adobe XD</h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">
                                <div class="course-instructor">
                                    <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-1.png')}}" alt="instructor">
                                    <h6>يوسف الخميسي</h6>
                                </div>
                                {{--                                <div class="course-rating">--}}
                                {{--                                    <ul>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                    </ul>--}}
                                {{--                                    <span>4.2(30)</span>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="course-info margin-top-20">

                                <div class="course-video">
                                    <i class="fa fa-play-circle-o"></i>
                                    <span>36 {{trans('lang.lecture')}}</span>
                                </div>
                                <div class="course-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>2h 40mins</span>
                                </div>
                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state" >

                            <div class="course-instructor-rating">
                                <a href="#">
                                    <div class="course-instructor">

                                        <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-4.png')}}"  alt="instructor" style="margin: 10px">
                                        <h6>محمد علي</h6>

                                    </div>

                                </a>
                            </div>

                            {{--                            <span class="heart-icon" ><i class="fa fa-heart-o"></i></span>--}}
                            <div class="course-title">
                                <h4><a href="#">فلاتر </a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">
                                {{--                                <span class="best-seller">best seller</span>--}}
                                <span class="course-category"><a href="#">برمجة</a></span>
                                <span class="course-price">$ 500</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>{{trans('lang.enrolled')}} 450 {{trans('lang.student')}} </span>
                                </div>
                                <div class="course-video">
                                    <i class="fa fa-play-circle-o"></i>
                                    <span>20 {{trans('lang.lecture')}}</span>
                                </div>
                                <div class="course-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>50 {{trans('lang.hour')}} </span>
                                </div>
                            </div>
                            <p class="margin-top-20">هنا وصف عن هذا الكورس نمتانانتؤياشتنؤيتغشللسغتنؤل ناؤتنسِـ،} يؤاستؤنس ناؤسيت</p>
                            {{--                            <ul class="margin-top-20">--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Lorem ipsum dolor sit amet.</span></li>--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Consectetur adipisicing elit.</span></li>--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Placeat dolore quaerat itaque.</span></li>--}}
                            {{--                            </ul>--}}
                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">{{trans('lang.details')}}</a>
                                <a href="{{url('checkout')}}" class="template-button margin-left-10">{{trans('lang.buy')}} </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="single-course-item">
                        <div class="course-image">
                            <img src="{{asset('/org_assets/dist/img/courseimg/course-image-1.png')}}"  alt="image">
                        </div>
                        <div class="course-content margin-top-30">
                            <div class="course-title">
                                <h4>user experience design with adobe XD</h4>
                            </div>
                            <div class="course-instructor-rating margin-top-20">
                                <div class="course-instructor">
                                    <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-1.png')}}" alt="instructor">
                                    <h6>يوسف الخميسي</h6>
                                </div>
                                {{--                                <div class="course-rating">--}}
                                {{--                                    <ul>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                        <li><i class="fa fa-star"></i></li>--}}
                                {{--                                    </ul>--}}
                                {{--                                    <span>4.2(30)</span>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="course-info margin-top-20">

                                <div class="course-video">
                                    <i class="fa fa-play-circle-o"></i>
                                    <span>36 {{trans('lang.lecture')}}</span>
                                </div>
                                <div class="course-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>2h 40mins</span>
                                </div>
                            </div>
                            <div class="course-price-cart margin-top-20">
                                <div class="course-price">
                                    <span class="span-big">$ 400.00</span>
                                    <span class="span-cross">$ 500.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="hover-state" >

                            <div class="course-instructor-rating">
                                <a href="#">
                                    <div class="course-instructor">

                                        <img src="{{asset('/org_assets/dist/img/courseimg/course-instructor-4.png')}}"  alt="instructor" style="margin: 10px">
                                        <h6>محمد علي</h6>

                                    </div>

                                </a>
                            </div>

                            {{--                            <span class="heart-icon" ><i class="fa fa-heart-o"></i></span>--}}
                            <div class="course-title">
                                <h4><a href="#">فلاتر </a></h4>
                            </div>
                            <div class="course-price-info margin-top-20">
                                {{--                                <span class="best-seller">best seller</span>--}}
                                <span class="course-category"><a href="#">برمجة</a></span>
                                <span class="course-price">$ 500</span>
                            </div>
                            <div class="course-info margin-top-30">
                                <div class="course-enroll">
                                    <span>{{trans('lang.enrolled')}} 450 {{trans('lang.student')}} </span>
                                </div>
                                <div class="course-video">
                                    <i class="fa fa-play-circle-o"></i>
                                    <span>20 {{trans('lang.lecture')}}</span>
                                </div>
                                <div class="course-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>50 {{trans('lang.hour')}} </span>
                                </div>
                            </div>
                            <p class="margin-top-20">هنا وصف عن هذا الكورس نمتانانتؤياشتنؤيتغشللسغتنؤل ناؤتنسِـ،} يؤاستؤنس ناؤسيت</p>
                            {{--                            <ul class="margin-top-20">--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Lorem ipsum dolor sit amet.</span></li>--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Consectetur adipisicing elit.</span></li>--}}
                            {{--                                <li><i class="fa fa-circle-o"></i><span>Placeat dolore quaerat itaque.</span></li>--}}
                            {{--                            </ul>--}}
                            <div class="preview-button margin-top-20">
                                <a href="#" class="template-button">{{trans('lang.details')}}</a>
                                <a href="{{url('checkout')}}" class="template-button margin-left-10">{{trans('lang.buy')}} </a>
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
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}"   alt="image" class="plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="section-title margin-bottom-40">
                        <h2>enhance your skills with <span>best online course</span></h2>
                    </div>
                    <div class="cta-button">
                        <a href="#" class="template-button margin-right-20">start teaching</a>
                        <a href="#" class="template-button-2">start learning</a>
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
