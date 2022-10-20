@extends('layouts.org_web.layout')
@section('content')

    <!-- Cart Section Starts -->
    <section class="cart-section padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2><span> البطاقات الرقمية </span></h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="single-cart-item">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="row align-items-center">
                                    <div class="col-lg-4">
                                        <a href="#"><img src="{{asset('/org_assets/dist/img/DC/amazon.png')}}"  alt="image" style="width: 150px;"></a>
                                    </div>
                                    <div class="col-lg-8">
                                        <h5><a href="#">بطاقات امازون</a></h5>
{{--                                        <span>المدرب <a href="#">علي التويتي</a></span>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <ul>
                                    <li><h5>Amazon gifts</h5><span>النوع</span></li>
                                    <li><h5>10 $ </h5><span>سعر الوحدة </span></li>
                                    <li>
                                        <div class="form-group">
                                            <input type="number" id="qnt" placeholder="1" style="width: 50%;">
                                        </div>
                                        <span>الكمية </span>
                                    </li>
                                    <li><h5>30 $ </h5><span>الأجمالي </span></li>
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
                                        <a href="#"><img src="{{asset('/org_assets/dist/img/DC/googleplay.png')}}"  alt="image" style="width: 150px;"></a>
                                    </div>
                                    <div class="col-lg-8">
                                        <h5><a href="#">بطاقات قوقل بلاي</a></h5>
                                        {{--                                        <span>المدرب <a href="#">علي التويتي</a></span>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <ul>
                                    <li><h5>google gifts</h5><span>النوع</span></li>
                                    <li><h5>10 $ </h5><span>سعر الوحدة </span></li>
                                    <li>
                                        <div class="form-group">
                                            <input type="number" id="qnt" placeholder="1" style="width: 50%;">
                                        </div>
                                        <span>الكمية </span>
                                    </li>
                                    <li><h5>30 $ </h5><span>الأجمالي </span></li>
                                    <li><a href="#" class="template-button">ازالة</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

{{--            <h5>البطاقات الرقمية</h5>--}}
{{--            <hr>--}}
{{--            <span style="color: grey">لا يوجد بطاقات</span>--}}
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
