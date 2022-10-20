@extends('trading.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            @include('layouts.trading.tabs')

            <h2>الكاش باك</h2>
        </div>
        <div class="tranfer-coin-box " style="">
            <div class="transfer-coin-content-box col-xl-12 row ">

                    <div class="row table-responsive">

                        <table id="example2" class="table table-borderless" style="width:100%">
                            <thead>
                            <tr>

                                <th>رقم العملية</th>
                                <th>شركة الوساطة</th>
                                <th>كمية التداول</th>
                                <th>النقاط</th>
                                <th>الارباح</th>
                                <th>الحالة</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>

                                        <div class="wallet-transaction-name">
                                            <span>
                                                5656
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <a href="#" class="operation_detail" data-id="">
                                                <h3>FBS</h3>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <h3>
                                                10 لوت
                                            </h3>
                                        </div>
                                    </td>

                                    <td>
                                        <h3>5 نقاط</h3>

                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <span>100$</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <span>تم سحبها للمحفظة</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <a href="#">سحب</a>
                                        </div>
                                    </td>


                                </tr>
                                <tr>
                                    <td>

                                        <div class="wallet-transaction-name">
                                            <span>
                                                5656
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <a href="#" class="operation_detail" data-id="">
                                                <h3>FBS</h3>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <h3>
                                                10 لوت
                                            </h3>
                                        </div>
                                    </td>

                                    <td>
                                        <h3>5 نقاط</h3>

                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <span>100$</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <span>تم سحبها للمحفظة</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <a href="#">سحب</a>
                                        </div>
                                    </td>


                                </tr>
                                <tr>
                                    <td>

                                        <div class="wallet-transaction-name">
                                            <span>
                                                5656
                                            </span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <a href="#" class="operation_detail" data-id="">
                                                <h3>FBS</h3>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <h3>
                                                10 لوت
                                            </h3>
                                        </div>
                                    </td>

                                    <td>
                                        <h3>5 نقاط</h3>

                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <span>100$</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <span>تم سحبها للمحفظة</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="wallet-transaction-balance">
                                            <a href="#">سحب</a>
                                        </div>
                                    </td>


                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
{{--                            {!! $data->links() !!}--}}
                        </div>
                    </div>



            </div>
        </div>

    </div>

@endsection


@section("custom_js")

@endsection
