@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2>{{trans('lang.pay_purchase_bills')}}</h2>
        </div>

        <div class="tranfer-coin-box">

            <div class="transfer-coin-content-box col-md-12 row ">
                <div class="col-xl-6">
                    <form method="POST" id="form_data" action="{{route('confirm_paying_order')}}">
                        @csrf
                        <div class="transfer-coin-input form-group">
                            <label>{{trans('lang.product-name')}} </label>
                            <input type="" id="form_product_name" name="product_name" value="" placeholder=""
                                   style="width: 80%">
                        </div>
                        <div class="transfer-coin-input form-group">
                            <label>{{trans('lang.product-link')}}</label>
                            <input type="url" name="link_url" id="form_link_url" value="" placeholder=""
                                   style="width: 80%">

                        </div>


                        <div class="transfer-coin-input form-group">
                            <label>{{trans('lang.product-desc')}}</label>
                            <input type="textarea" id="form_description" name="description" value="" placeholder=""
                                   style="width: 80%">
                        </div>

                        <div class="transfer-coin-input form-group" style="width: 80% ;">
                            <label>{{trans('lang.buy-time')}}</label>
                            <input class="form-control" name="paying_date"
                                   type="datetime-local" value=""
                                   id="form_paying_date" style="width: 100%">

                        </div>


                        <div class="transfer-coin-input col-md-12 ">
                            <label class=""> {{trans('lang.amount')}} </label>
                            <div class="input-two  clearfix">
                                <div class="input-two-box form-group" style="width: 75%">
                                    <input type="number" name="product_price" min="1" id="form_amount" value="50"
                                           placeholder="">
                                    <span>USD</span>
                                </div>
                            </div>


                        </div>


                        <div class="transfer-coin-button">

                            <button id="show_model" class="theme-btn"
                                    type="button">{{trans('lang.send_pay_bills_order')}}</button>

                        </div>
                    </form>
                </div>
                <div class="col-xl-6  mt-responsive ">


                    <div class=" d-flex flex-row col-md-12">
                        <div class="col-8 col-lg-10 col-xl-9">
                            <div class="invoice-warning direction-box" style="background-color: white">
                                <h3 style="margin-bottom: 30px"><span class="invoice-text"><i class="fas fa-question-circle" style="color: green"></i></span>
                                    {{trans('lang.Instructions-paying')}}
                                </h3>

{{--                                مسةنمنٍ’--}}

                                @if (is_string($instructions))

                                    {!! $instructions !!}
                                @endif
                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-xl-3" >

                        </div>

                    </div>

                </div>


            </div>

            <div class="modal fade" id="model_operation" tabindex="-1" role="dialog" aria-labelledby="modal"
                 aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header   col-md-12">
                            <div class=" col-md-10 row ">
                                <div class="col-md-2 text-right">
                                    <div class="circle_icon "><i class="fas fa-check"></i></div>
                                </div>
                                <div class="col-md-8 " style="margin-top: 5px">
                                    <h3> {{trans('lang.transaction-detail')}}</h3>
                                </div>
                            </div>


                            <div class=" text-left">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        </div>
                        <div class="modal-body" id="model_operation_body">
                            <div class="">
                                <div class="invoice-warning">
                                    <p style="margin-bottom: 10px"><span class="invoice-text"><i
                                                class="fas fa-exclamation-circle"
                                                style="color: red;padding: 5px"></i></span>تنبية
                                        : الرجاء الاطلاع على هذه المعلومات الاضافية للتأكد .</p>
                                </div>


                                <table class="table table-borderless">
                                    <tr>
                                        <th colspan="2" class="text-center">بيانات العملية</th>
                                    </tr>

                                    <tr>
                                        <th> اسم المنتج</th>

                                        <td id="info_product_name">


                                        </td>
                                    </tr>
                                    <tr>
                                        <th> {{trans('lang.product-link')}}</th>

                                        <td>

                                            <a href="" target="_blank" id="info_link_url"></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('lang.product-desc')}} </th>

                                        <td id="info_description"></td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('lang.buy-time')}} </th>

                                        <td id="info_paying_date"></td>
                                    </tr>
                                    <tr>
                                        <th>{{trans('lang.bill-amount')}} </th>

                                        <td>
                                            <span id="info_amount"></span>
                                            <span>$</span>
                                        </td>

                                    </tr>
                                </table>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="transfer-coin-input  custom-control custom-checkbox"
                                 style="width: 100%">

                            </div>

                            <div class="transfer-coin-button" style="width: 100%">
                                <button id="save-form" class="theme-btn"
                                        type="button">{{trans('lang.send_pay_bills_order')}}</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection

@section("custom_js")
    <script type="text/javascript">
        //todo OSAMA must show to the customer the $paying_order_comms it is available now and the final price will be
        // price+ (price* $paying_order_comms)

        $('#show_model').click(function (e) {

            var form_product_name = $("#form_product_name").val();
            var form_link_url = $("#form_link_url").val();
            var form_description = $("#form_description").val();
            var form_amount = $("#form_amount").val();
            var form_paying_date = $("#form_paying_date").val();


            if (form_paying_date != "" && form_link_url != "" && form_amount != "" && form_description != "" && form_product_name != "") {
                $('#model_operation').modal('show');
                $("#info_product_name").html($("#form_product_name").val());
                $("#info_link_url").attr('href', $("#form_link_url").val());
                $("#info_link_url").html($("#form_link_url").val());
                $("#info_description").html($("#form_description").val());
                $("#info_paying_date").html($("#form_paying_date").val());
                $("#info_amount").html($("#form_amount").val());

            } else {
                $.toast({
                    heading: "error",
                    position: {
                        right: 10,
                        top: 10
                    },
                    text: "يجب اكمال جميع البيانات",
                    icon: 'error'
                });
            }


        });


        $('#save-form').click(function (e) {
            e.preventDefault();
            $("#save-form").prop("disabled", true);
            $.easyAjax({
                url: '{{route('confirm_paying_order')}}',
                container: '#form_data',
                type: "POST",
                async:false,
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    console.log(response)
                    location.replace("{{route("paying_orders_list")}}")
                },custom_error: function() {
                    $("#save-form").prop("disabled", false);
                }

            });

        });
    </script>
@endsection
