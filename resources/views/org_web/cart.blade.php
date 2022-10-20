@extends('layouts.org_web.layout')
@section('content')

    <!-- Cart Section Starts -->
    <section class="cart-section padding-top-120">
        <div class="container">
            <h5>الدورات التدريبية</h5>
            <hr>
            <div class="row">
                <div class="col-12">
                    <div class="single-cart-item">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <a href="#"><img src="{{asset('/site/dist/img/header3.jpg')}}"  alt="image" style="width: 150px;"></a>
                                    </div>
                                    <div class="col-lg-8">
                                        <h5><a href="#">دورة تدريبية في التداول</a></h5>
                                        <span>المدرب <a href="#">علي التويتي</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <ul>
                                    <li><h5>18 june 2020</h5><span>التاريخ</span></li>
                                    <li><h5>مجانا</h5><span>سعر الدورة</span></li>
                                    <li><a href="#" class="template-button">ازالة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="single-cart-item">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <a href="#"><img src="{{asset('/site/dist/img/header3.jpg')}}"  alt="image" style="width: 150px;"></a>
                                    </div>
                                    <div class="col-lg-8">
                                        <h5><a href="#">دورة تدريبية في التداول</a></h5>
                                        <span>المدرب <a href="#">علي التويتي</a></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <ul>
                                    <li><h5>18 june 2020</h5><span>التاريخ</span></li>
                                    <li><h5>مجانا</h5><span>سعر الدورة</span></li>
                                    <li><a href="#" class="template-button">ازالة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>الاستشارات</h5>
            <hr>
            <div class="row">
                <div class="col-12">

                    <div class="single-cart-item">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <a href="#"><img src="{{asset('/site/dist/img/header3.jpg')}}"  alt="image" style="width: 150px;" ></a>
                                    </div>
                                    <div class="col-lg-8">
                                        <h5><a href="#">استشارة في التداول</a></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <ul>
                                    <li><h5>18 june 2020</h5><span>التاريخ</span></li>
                                    <li><h5>$ 16,99</h5><span>سعر الاستشارة</span></li>
                                    <li><a href="#" class="template-button">ازالة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>البطاقات الرقمية</h5>
            <hr>
            <span style="color: grey">لا يوجد بطاقات</span>
            <div class="row">
                <div class="col-12">
                    <div class="cart-bottom-button margin-top-20 d-flex justify-content-between">
                        <a href="#" class="template-button">دفع</a>
                        <a href="#" class="template-button-2">الرئيسية</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
