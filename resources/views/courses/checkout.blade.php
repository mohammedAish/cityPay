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
                      <form method="POST" action="{{route('courses.buy')}}">
                          @csrf
                          <table class="table table-borderless">
                              <thead>
                              </thead>
                              <tbody>
                              <tr>
                                  <th>رصيد المحفظة</th>

                                  <td>
                                      100$
                                  </td>
                              </tr>
                              <tr>
                                  <th>المبلغ</th>

                                  <td>
                                      <input value="{{$course_info->id}}" name="course_id" id="" class="">

                                  </td>
                              </tr>
                              </tbody>
                          </table>
                          <button type="submit" class="template-button">
                              <i class="fas fa-wallet"></i>
                              تأكيد</button>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
