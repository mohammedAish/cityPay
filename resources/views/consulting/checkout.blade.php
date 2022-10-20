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
    <section class="Payment-section padding-20">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 text-center">

                    <div class="coupon-part">
                        <img src="{{asset('/org_assets/dist/img/cashicon.png')}}" alt="wallet" style="width: 250px;" >

                        <p class="margin-top-20">ايدع اسحب حول أموالك حول العالم بأمان مع محفظة كاش تداول. </p>
                        <div class="coupon-code margin-top-30">
                            <div class="header-search">
                                <div class="proceed-button text-center margin-top-30">
                                    <button type="submit" class="template-button">
                                        <i class="fas fa-wallet"></i>
                                         محفظتي</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="payment-part">
                      <form method="POST" action="{{route('courses.buy')}}">
                          @csrf
                          <div class="table-responsive">
                          <table class="table ">
                              <thead>
                              <th colspan="2" class="text-center" style="border-top: 0">فاتورة الدفع</th>
                              </thead>
                              <tbody>

                              <tr>
                                  <th class="text-center" style="color: #0b4879">رصيد المحفظة</th>

                                  <td class="text-center">
                                      100$
                                  </td>
                              </tr>
                              <tr>
                                  <th class="text-center"> ستقوم بدفع مبلغ</th>

                                  <td class="text-center">
                                      {{$consultant_info->id}} $

                                  </td>
                              </tr>
                              <tr>
                                  <th class="text-center">مقابل</th>

                                  <td class="text-center">
                                      استشارة التسويق الألكتروني لشراء البطاقات الرقمية
                                  </td>
                              </tr>

                              <tr>
                                  <th class="text-center">سيتم التواصل معك بواسطة</th>

                                  <td class="text-center">
                                      وتساب
                                  </td>
                              </tr>
                              </tbody>
                          </table>
                          </div>
                          <div class="row col-12 justify-content-center">
                          <button type="submit" class="template-button" style="width: 100%;background-color: #53934F">
                              <i class="fas fa-wallet"></i>
                              تأكيد
                          </button>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
