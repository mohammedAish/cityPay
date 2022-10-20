@extends('wallet.index')
@section('content')

    {{dd($free_lancing_platforms)}}
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h3>سحب الأموال من منصات العمل الحر </h3>
        </div>

        <div class="tranfer-coin-box">

            <div class="transfer-coin-content-box col-xl-12 row ">
                <div class="col-xl-7">
                    <form method="" action="#">


                        <div class="transfer-coin-input col-md-12 row">
                            <label class="col-md-3"> منصات العمل الحر</label>

                            <div class="dropdown col-md-8">
                                <div class="select">
                                    <span> اختر المنصة ...</span>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <input type="hidden" name="gender">
                                <ul class="dropdown-menu">

                                    <li class="text-center"
                                        style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                        <h3>خمسات </h3>

                                    </li>
                                    <li class="text-center"
                                        style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                        <h3>فري لانسر </h3>

                                    </li>
                                    <li class="text-center"
                                        style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                        <h3>اب وورك </h3>

                                    </li>
                                    <li class="text-center"
                                        style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">

                                        <h3>مستقل </h3>

                                    </li>

                                </ul>
                            </div>
                        </div>


                        <div class="transfer-coin-input col-md-12 row">

                            <label class="col-md-3"> المبلغ</label>
                            <div class="input-two col-md-8 ">
                                <div class="input-two-box " style="float: right;width: 100%;margin-right: 35px;margin-left: 35px;">
                                    <input type="" name="" value="50" placeholder="">
                                    <span>USD</span>
                                </div>
                            </div>
                        </div>

                        <div class="transfer-coin-button">
                            <button class="theme-btn">ارسال الطلب</button>
                        </div>

                    </form>
                </div>
                <div class="col-xl-5">
                    <div class="invoice-warning">
                        <h3 style="margin-bottom: 30px"><span class="invoice-text"><i
                                    class="fas fa-exclamation-circle" style="color: green"></i></span>
                            تعليمات سحب ارباح منصات العمل الحر :

                          </h3>
                        <table class="table table-responsive ">
                            <thead>

                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td class="text-right">سجل الدخول الى حساب خمسات</td>

                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td class="text-right">قم بتحويل الميلغ لحساب يمن تداول الذي هو 6556455455</td>

                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td class="text-right">ترقب قبول طلبك من قائمة الطلبات</td>

                            </tr>
                            </tbody>
                        </table>
                    </div>


                </div>


            </div>


        </div>

    </div>

@endsection
