@extends('trading.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            @include('layouts.trading.tabs')

            <h2>خدمة الأنتفاع بالتداول  </h2>

            <div class="tranfer-coin-box">

                <div class="transfer-coin-content-box col-xl-12 row ">
                    <div class="col-xl-6">
                        <section class="ftco-section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h2 class="heading-section mb-3 pb-md-4">قم بأختيار الخدمات التي تريد الاشتراك فيها </h2>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <ul class="ks-cboxtags">
                                            <li>
                                                <input type="checkbox" id="checkboxOne" value="Order one">
                                                <label for="checkboxOne"> خدمة الكاش باك</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="checkboxTwo" value="Order Two">
                                                <label for="checkboxTwo"> خدمة التداول الحي</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="checkboxThree" value="Order Three">
                                                <label for="checkboxThree"> خدمة نسخ التداول</label>
                                            </li>
                                            <li>
                                                <input type="checkbox" id="checkboxFour" value="Order Four">
                                                <label for="checkboxFour"> خدمة التحليلات والتوصيات </label>
                                            </li>
                                        </ul>
                                    </div>

                                </div>


                                <div class="profile-btn  row justify-content-center" >
                                    <button class="theme-btn" >اشتراك</button>
                                </div>
                            </div>
                        </section>

                    </div>


                    <div class="col-xl-6 mt-responsive">


                                <div class="invoice-warning direction-box" style="background-color: white">
                                    <h3 style="margin-bottom: 30px">
                                        ماهي خدمة الأنتفاع بالتداول ؟

                                    </h3>
                                    <p> هي خدمة يمكن من خلالها الأستفادة من خدماتها الفرعية وهم: </p>
                                    <ol>
                                        <li>- الكاش باك حيث انك عزيزي المتداول يمكنك الحصول ع عائد اثنا تداولك في الفوركس</li>
                                        <li> - خدمة التداول الحي حيث يمكنك ان تحضر تداولات حية يمكنك الأستفادة منها</li>
                                        <li> - التوصيات والتحليلات</li>
                                        <li> - نسخ التداول الألكتروني </li>
                                    </ol>
                                    <h3 style=" color: green">ماهي شروط الأنضمام للخدمة  ؟</h3>
                                    <p> كي تستفيد من هذه الخدمة يجب توفر الشروط التالية  :  </p>
                                    <ol>
                                        <li>- ان تكون متداول في احد وساطات التداول</li>
                                        <li> - ان يتم قبول طلبك من شركة الوساطة</li>
                                    </ol>
                                    <h3 >كيف يمكنني الأشتراك في خدمة الأنتفاع بالتداول ؟</h3>
                                    <p> من خلال اتباعك للخطوات التالية :  </p>
                                    <ol>
                                        <li>- تحديد الخدمات التي تريد تفعيلها</li>
                                        <li> - اضافة حساب تداول واحد على الأقل </li>
                                        <li> - بعد قبول وسيط التداول سيتم تفعيل خدمات التداول التي اخترتها</li>
                                    </ol>


                                </div>


                        {{--                    <div class="invoice-warning direction-box  ">--}}
                        {{--                        <h3 style="margin-bottom: 30px"><span class="invoice-text"><i--}}
                        {{--                                        class="fas fa-question-circle" style="color: green"></i></span>--}}
                        {{--                            تعليمات الايداع للمحفظة :--}}

                        {{--                        </h3>--}}
                        {{--                        <table class="table ">--}}
                        {{--                            <thead>--}}

                        {{--                            </thead>--}}
                        {{--                            <tbody>--}}
                        {{--                            @foreach($instructions as $steps)--}}
                        {{--                                <tr>--}}
                        {{--                                    <th scope="row"></th>--}}

                        {{--                                    <td class="text-right"> {!! $steps->instructions !!}</td>--}}

                        {{--                                </tr>--}}
                        {{--                            @endforeach--}}
                        {{--                            <tr>--}}
                        {{--                                <th scope="row">2</th>--}}
                        {{--                                <td class="text-right">6556455455</td>--}}

                        {{--                            </tr>--}}
                        {{--                            <tr>--}}
                        {{--                                <th scope="row">3</th>--}}
                        {{--                                <td class="text-right">ترقب قبول طلبك من قائمة الطلبات</td>--}}

                        {{--                            </tr>--}}
                        {{--                            </tbody>--}}
                        {{--                        </table>--}}
                        {{--                    </div>--}}
                    </div>



                </div>


            </div>

        </div>
    </div>
    </div>


@endsection
