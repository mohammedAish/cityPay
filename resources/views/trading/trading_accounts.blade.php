@extends('trading.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            @include('layouts.trading.tabs')

            <h2 class="mb-5">{{trans('lang.trading_accounts')}}  </h2><div class="row">

            </div>
            <div class="container mt-0">
                <!-- Table -->

                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">{{trans('lang.trading_accounts')}}  </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>

                                    <th scope="col"></th>
                                    <th scope="col">اسم شركة الوساطة</th>
                                    <th scope="col">رقم الحساب</th>
                                    <th scope="col">حالة الحساب </th>



                                    <th scope="col">
                                        <a href={{url('trading/brokers')}}  >
                                            <i class="fas fa-plus"></i> اضافة حساب
                                        </a>
                                    </th>
                                </tr>
                                </thead>


                                <tbody>
                                <tr>



                                    <td style="width: 20%">
                                        <div class="media align-items-center" >
                                            <img src="{{asset('org_assets/dist/img/trading/forex.jpg')}}" alt="Loader" class="wizardimg" style="width: 100%">


                                        </div>

                                    </td>
                                    <td>
                                        FBS
                                    </td>

                                    <td>
                                        156465455
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">

                                            <span>  <i class="fas fa-circle p-5-wizard " style="color: #87d682"></i>قيد الانتظار </span>
                                        </div>

                                    </td>


                                </tr>


                                </tbody>
                                <!-- add trading account Modal -->
{{--                                <div class="modal fade" id="addaccount" tabindex="-1" role="dialog" aria-labelledby="modal"--}}
{{--                                     aria-hidden="true">--}}
{{--                                    <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--                                        <div class="modal-content">--}}
{{--                                            <div class="modal-header   col-md-12">--}}
{{--                                                <div class=" col-md-10 row ">--}}
{{--                                                    <div class="col-md-2 text-right">--}}
{{--                                                        <div class="circle_icon"><i class="fas fa-user"></i></div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-8 " style="margin-top: 5px">--}}
{{--                                                        <h3>اضافة حساب تداول</h3>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}


{{--                                                <div class=" text-left">--}}
{{--                                                    <button type="button" class="close" data-dismiss="modal"--}}
{{--                                                            aria-label="Close">--}}
{{--                                                        <span aria-hidden="true">&times;</span>--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
{{--                                            <form  id="form_data">--}}
{{--                                                @csrf--}}
{{--                                                <div class="modal-body">--}}


{{--                                                    <div class="transfer-coin-input ">--}}
{{--                                                        <input type="hidden" name="broker" value="">--}}
{{--                                                        <label> شركة الوساطة </label>--}}
{{--                                                        <div class="input-two clearfix">--}}
{{--                                                            <div class="dropdown" style="width: 95%">--}}
{{--                                                                <div class="select form-group" style="width: 100%" >--}}
{{--                                                                    <input type="hidden" required value="broker" id="broker"--}}
{{--                                                                           name="broker">--}}
{{--                                                                    <span  id="selected_deposit_type">  </span>--}}
{{--                                                                    <i class="fas fa-caret-down"></i>--}}
{{--                                                                </div>--}}
{{--                                                                <ul class="dropdown-menu" id="brokerul">--}}
{{--                                                                        <li class='' >FBS</li>--}}

{{--                                                                </ul>--}}
{{--                                                            </div>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}

{{--                                                    <div class="theme-input-box" style="margin-bottom: 20px;">--}}
{{--                                                        <label>{{trans('lang.account-number')}}</label>--}}
{{--                                                        <input type="text" id="account_num"--}}
{{--                                                               name="account_num" value=" "--}}
{{--                                                               class="theme-input">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="theme-input-box" style="margin-bottom: 20px;">--}}
{{--                                                        <label>ايميلك في شركة الوساطة </label>--}}
{{--                                                        <input type="email" id="email"--}}
{{--                                                               name="email" value=" "--}}
{{--                                                               class="theme-input">--}}
{{--                                                    </div>--}}

{{--                                                    <div class="theme-input-box">--}}
{{--                                                        <label>سيتم ارسال هذه الرسالة لشركة الوساطة </label>--}}
{{--                                                        <textarea class="form-control" rows="5" placeholder="يرجى قبول طلبي بأن اكون تحت الوكيل يمن تداول .." disabled></textarea>--}}

{{--                                                    </div>--}}


{{--                                                </div>--}}
{{--                                                <div class="remove-popuo-btn clearfix" style="width: 100%; margin: 0">--}}
{{--                                                    <button class="remove-btn cancel-btn"--}}
{{--                                                            data-dismiss="modal">{{trans('lang.close')}}--}}
{{--                                                    </button>--}}
{{--                                                    <button class="remove-btn" id="edit_customer_agency" type="button"--}}

{{--                                                            style="background-color: #87d682">ارسال الطلب--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </form>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section("custom_js")

@endsection
