@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2>{{trans('lang.history')}}</h2>
        </div>
        <div class="tranfer-coin-box " style="">
            <div class="transfer-coin-content-box col-xl-12 row ">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link {{(isset($type) and $type=="transactions")?"active":"" }}"
                           href="{{route("list_deposit_withdraws")}}"
                        >{{trans('lang.transactions')}}</a>

                        <a class="nav-item nav-link {{(isset($type) and $type=="deposit")?"active":"" }}"
                           href="{{route('list_deposit_orders')}}">{{trans('lang.deposit-order')}}</a>

                        <a class="nav-item nav-link {{(isset($type) and $type=="withdraw")?"active":"" }}"
                           href="{{route('list_internal_withdraw_orders')}}">{{trans('lang.withdraw-order')}}</a>

                        <a class="nav-item nav-link {{(isset($type) and $type=="transfer")?"active":"" }}"
                           href="{{url('/wallet/transfer_orders')}}">{{trans('lang.transfer-order')}}</a>

                        <a class="nav-item nav-link {{(isset($type) and $type=="invoices")?"active":"" }}"
                           href="{{route('paying_orders_list')}}">{{trans('lang.pay-bills-order')}}</a>

                        <a class="nav-item nav-link {{(isset($type) and $type=="freelancing")?"active":"" }}"
                           href="{{route('list_pull_earnings_orders')}}">{{trans('lang.withdraw-from-freelancing-platform-order')}}</a>
<!--                <a class="nav-item nav-link {{(isset($type) and $type=="digital_cards")?"active":"" }}"
                           href="{{route('cards.my_cards')}}">{{trans('lang.my-digital-cards')}}</a>-->


                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent" style="width: 100%">
                    <div class="tab-pane fade show active" id="transaction" role="tabpanel"
                         aria-labelledby="nav-home-tab">

                        @if($type=="invoices")
                            @include("wallet.history_tabs.invoices")
                        @elseif($type=="deposit")
                            @include("wallet.history_tabs.deposit")
                        @elseif($type=="withdraw")
                            @include("wallet.history_tabs.withdraw")
                        @elseif($type=="transfer")
                            @include("wallet.history_tabs.transfer")
                        @elseif($type=="freelancing")
                            @include("wallet.history_tabs.freelancing")
                        @elseif($type=="transfer")
                            @include("wallet.history_tabs.transfer")
                        @elseif($type=="digital_cards")
                            @include("digital_cards.my_digital_cards")
                        @else
                            @include("wallet.history_tabs.transactions")
                        @endif
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

                    </div>
                    {{--                                        <div class="modal-footer">--}}
                    {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--                                        </div>--}}
                </div>
            </div>
        </div>

        <!-- deposit-order -->
        <div class="modal fade" id="deposit-order" tabindex="-1" role="dialog" aria-labelledby="modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header   col-md-12">
                        <div class=" col-md-10 row ">
                            <div class="col-md-2 text-right">
                                <div class="circle_icon " style="background-color: red"><i
                                        class="fas fa-info"></i></div>
                            </div>
                            <div class="col-md-8 " style="margin-top: 5px">
                                <h3>{{trans('lang.upload-payment-invoice')}}</h3>
                            </div>
                        </div>


                        <div class=" text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <div class="modal-body">
                        <div class="inner">
                            <div class="form-row form-row-date">
                                <div class="form-holder form-holder-2 col-md-12">
                                    <div class="container" style="text-align: center;">
                                        <form id="data" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-12 col-md-offset-3 "
                                                     style="text-align: center;">
                                                    <div class="btn-container">
                                                        <!--the three icons: default, ok file (img), error file (not an img)-->

                                                        <h1 class="imgupload"><i
                                                                class="zmdi zmdi-cloud-upload"
                                                                style="color: #0B4879;"></i>
                                                        </h1>
                                                        <h1 class="imgupload ok"><i
                                                                class="zmdi zmdi-check"></i></h1>
                                                        <h1 class="imgupload stop"><i
                                                                class="zmdi zmdi-close-circle"></i>
                                                        </h1>
                                                        <!--this field changes dinamically displaying the filename we are trying to upload-->
                                                        <p id="namefile">{{trans('lang.img-extension')}}
                                                            (jpg,jpeg,bmp,png)</p>
                                                        <!--our custom btn which which stays under the actual one-->
                                                        <button type="button" id="btnup" class="btn  btn-lg"
                                                                style="background-color: #0B4879; color: white">
                                                            {{trans('lang.brows-imgs')}}
                                                        </button>
                                                        <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                                        <input type="file" value="" name="fileup"
                                                               id="fileup">
                                                        <input type="hidden" name="order_id" id="model_order_id" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--additional fields-->


                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>
                    {{--                                        <div class="modal-footer">--}}
                    {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--                                        </div>--}}
                </div>
            </div>
        </div>

        <!-- deposit-order -->
        <div class="modal fade" id="conform_model" tabindex="-1" role="dialog" aria-labelledby="modal"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header   col-md-12">
                        <div class=" col-md-10 row ">
                            <div class="col-md-2 text-right">
                                <div class="circle_icon " style="background-color: red"><i
                                        class="fas fa-info"></i></div>
                            </div>
                            <div class="col-md-8 " style="margin-top: 5px">
                                <h3>{{trans('lang.upload-payment-invoice')}}</h3>
                            </div>
                        </div>


                        <div class=" text-left">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                    <div class="modal-body">
                        <div class="inner">
                            <div class="form-row form-row-date">
                                <div class="form-holder form-holder-2 col-md-12">
                                    <div class="container" style="text-align: center;">
                                        <form id="data" method="post" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-12 col-md-offset-3 "
                                                     style="text-align: center;">
                                                    <div class="btn-container">
                                                        <!--the three icons: default, ok file (img), error file (not an img)-->

                                                        <h1 class="imgupload"><i
                                                                class="zmdi zmdi-cloud-upload"
                                                                style="color: #0B4879;"></i>
                                                        </h1>
                                                        <h1 class="imgupload ok"><i
                                                                class="zmdi zmdi-check"></i></h1>
                                                        <h1 class="imgupload stop"><i
                                                                class="zmdi zmdi-close-circle"></i>
                                                        </h1>
                                                        <!--this field changes dinamically displaying the filename we are trying to upload-->
                                                        <p id="namefile">{{trans('lang.img-extension')}}
                                                            (jpg,jpeg,bmp,png)</p>
                                                        <!--our custom btn which which stays under the actual one-->
                                                        <button type="button" id="btnup" class="btn  btn-lg"
                                                                style="background-color: #0B4879; color: white">
                                                            {{trans('lang.brows-imgs')}}
                                                        </button>
                                                        <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                                        <input type="file" value="" name="fileup"
                                                               id="fileup">
                                                        <input type="hidden" name="order_id" id="model_order_id" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!--additional fields-->


                                    </div>


                                </div>

                            </div>

                        </div>

                    </div>
                    {{--                                        <div class="modal-footer">--}}
                    {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--                                        </div>--}}
                </div>
            </div>
        </div>

        <div class="modal fade" id="model_balance" tabindex="-1" role="dialog" aria-labelledby="modal"
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
                    <div class="modal-body" id="model_balance_body">
                        <div class="">
                            <div class="invoice-warning">
                                <p style="margin-bottom: 10px"><span class="invoice-text"><i
                                            class="fas fa-exclamation-circle"
                                            style="color: red;padding: 5px"></i></span> {{trans('lang.attention-for-balance')}}
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">


                        <div class="transfer-coin-button" style="width: 100%">
                            <button id="cancel-withdraw" class="theme-btn" type="button"
                            >{{trans('lang.ok')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section("custom_js")
    <script type="text/javascript">
        $(document).on("click", '.show_add_file_model', function (e) {
            e.preventDefault();
            var order_id = $(this).data('order_id');
            $('#model_order_id').val(order_id);
            $('#deposit-order').modal('show');

        });

        $(document).on("click", '.show_conform_model', function (e) {
            e.preventDefault();
            // var order_id = $(this).data('order_id');
            // $('#model_order_id').val(order_id);
            $('#conform_model').modal('show');

        });

        $(document).on("click", '.operation_detail', function (e) {
            e.preventDefault();
            var order_id = $(this).data('id');
            var order_type = $(this).data('type');
            $.ajax({
                url: '{{route('wallet.get_operation_info')}}',
                type: "get",
                redirect: true,
                data: {"id": order_id, "data_type": order_type, "type": "{{$type}}"},
                success: function (response) {

                    {{--location.replace("{{route("list_deposit_orders")}}")--}}
                    $('#model_operation_body').html(response);
                    $('#model_operation').modal('show');
                }
            })
            // $("#info_agency_name").text(get_first_objectVal(data.name));


        });

        $('#cancel-withdraw').click(function (e) {
            $("#model_balance").modal('hide');
        });

        $(document).on("click", '#confirm_opration', function (e) {

            var order_id = $(this).data('id');
            var final_price = $(this).data('final_price');

            $.easyAjax({
                url: '{{route('get_customer_balance')}}',
                container: '#form_data',
                type: "GET",
                success: function (response) {
                    console.log(response);
                    if (response.balance > final_price) {
                        $.easyAjax({
                            url: '{{route('confirm_paying_withdraw')}}',
                            type: "get",
                            data: {"paying_order_id": order_id},
                            success: function (response) {
                                if (response.status==false)
                                {
                                    $.toast({
                                        heading: "error",
                                        position: {
                                            right: 10,
                                            top: 10
                                        },
                                        text: response.message,
                                        icon: 'error'
                                    });
                                }

                                location.reload();
                                $('#model_operation_body').html(response);
                                $('#model_operation').modal('show');
                            }
                        })

                    } else {

                        $('#model_balance').modal('show');
                    }
                }
            })




        });

        $('#fileup').change(function () {

            // Check file selected or not
            // if (files.length > 0)

//here we take the file extension and set an array of valid extensions
            var res = $('#fileup').val();
            var arr = res.split("\\");
            var filename = arr.slice(-1)[0];
            filextension = filename.split(".");
            filext = "." + filextension.slice(-1)[0];
            valid = [".jpg", ".png", ".jpeg", ".bmp"];
//if file is not valid we show the error icon, the red alert, and hide the submit button
            if (valid.indexOf(filext.toLowerCase()) == -1) {
                $(".imgupload").hide("slow");
                $(".imgupload.ok").hide("slow");
                $(".imgupload.stop").show("slow");

                $('#namefile').css({"color": "red", "font-weight": 700});
                $('#namefile').html("File " + filename + " is not  pic!");

                $("#submitbtn").hide();
                $("#fakebtn").show();
            } else {
                var formData = new FormData($("form#data")[0]);
                var order_id = $("#model_order_id").val();

                $.ajax({
                    url: "{{route('saveOrderImage')}}",
                    type: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        $("#img_path_" + order_id).attr("src", response.data);
                        console.log(response);
                        $.toast({
                            heading: "success",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: response.message,
                            icon: 'success'
                        });

                        $('#deposit-order').modal('hide');
                    }
                });


                $(".imgupload").hide("slow");
                $(".imgupload.stop").hide("slow");
                $(".imgupload.ok").show("slow");

                $('#namefile').css({"color": "green", "font-weight": 700});
                $('#namefile').html(filename);

                $("#submitbtn").show();
                $("#fakebtn").hide();
            }
        });

    </script>
@endsection
