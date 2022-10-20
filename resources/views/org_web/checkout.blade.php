@extends('layouts.org_web.layout')
@section('content')

    <!-- Breadcrumb Section Starts -->
    <section class="breadcrumb-section" style="margin-top: 6%;">
        <div class="breadcrumb-shape">
            <img src="{{asset('/org_assets/dist/img/courseimg/round-shape-2.png')}}" alt="shape" class="hero-round-shape-2 item-moveTwo">
            <img src="{{asset('/org_assets/dist/img/courseimg/plus-sign.png')}}" alt="shape" class="hero-plus-sign item-rotate">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>تأكيد الدفع </h2>
                    <div class="breadcrumb-link margin-top-10">
{{--                        <span><a href="index.html">home</a> / cart page</span>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Payment Section Starts -->
    <section class="Payment-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center">
                    <div class="coupon-part">
                        <img src="{{asset('/org_assets/dist/img/ewallets.png')}}" alt="wallet" style="width: 250px;" >

                        <h3>محفظة تداول كاش </h3>
                        <p class="margin-top-20">ايدع اسحب حول أموالك حول العالم . </p>
                        <div class="coupon-code margin-top-30">
                            <div class="header-search">
                                <div class="proceed-button text-center margin-top-30">
                                    <button type="submit" class="template-button">
                                        <i class="fas fa-wallet"></i>
                                         محفظتك</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="payment-part">
                        <h3>رصيد محفظتك  : $3,699</h3>
                        <h5>السعر  : $100</h5>
                        <p class="margin-top-20"> سيتم خصم مبلغ 100 $ من محفضتك مقابل استشارة كيفية البدء في التداول </p>
                        <div class="payment-tab margin-top-20">
                            <div class="row">
                                <div class="col-md-5">
                                    <h3 style="padding-top: 20px;">طريقة الدفع </h3>
                                </div>
                                <div class="col-md-7">
                                    <div class="tab">
                                        <ul>
                                            <li class="tab-one active">
                                                <img src="{{asset('/org_assets/dist/img/ewallets.png')}}" alt="wallet" style="width: 100px;">
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="tab-content margin-top-30">
                                        <div class="tab-one-content lost active">



                                                <div class="proceed-button text-center margin-top-30">
                                                    <button type="submit" class="template-button">  تأكيد الشراء</button>
                                                </div>

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


@endsection
