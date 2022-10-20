@extends('wallet.index')
@section('content')

    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2>قم بتحويل الأموال لأحبائك لأي مكان في العالم </h2>
        </div>

        <div class="tranfer-coin-box">

            <div class="transfer-coin-content-box col-xl-12 row ">

                <div class="col-xl-6">
                    <form method="" id="form_data" action="#">
                        @csrf
                        <div class="transfer-coin-input col-md-12 row clearfix">
                            <label> {{trans('lang.Iam-transferring-money-to')}}  </label>

                            <div class="dropdown col-12">
                                <div class="select form-group">
                                    <span>{{trans('lang.country')}}</span>
                                    <i class="fas fa-caret-down"></i>
                                    <input type="hidden" required value="" id="form_country_id" name="country_id">
                                </div>
                                <ul class="dropdown-menu">
                                    @foreach($countries as $country)
                                        <li id="{{$country->id}}" class="country text-center"
                                            country_name="{{$country->name}}"
                                            style="background-color: #f2f2f2; border-radius: 30px; height: 50px; width:98%;">
                                            <div class="row col-md-12">
                                                <div class="col-md-2">
                                                    <img src="{{asset($country->img_path)}}" alt="{{$country->code}}"
                                                         style="max-width: 40px;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="method text-right">
                                                        <h3>{{$country->name}} </h3>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>

                        <div class="transfer-coin-input col-md-12 row clearfix">
                            <label> {{trans('lang.receiving-method')}} </label>

                            <div class="dropdown col-12">
                                <div class="select form-group">
                                    <span id="form_receiving_mode_span">{{trans('lang.receiving-method')}}</span>
                                    <i class="fas fa-caret-down"></i>
                                    <input type="hidden" required value="" id="form_receiving_mode"
                                           name="receiving_mode">

                                </div>
                                <input type="hidden" name="gender">
                                <ul class="dropdown-menu" id="ul_receiving_mode">


                                    <li class="text-center dark-color"
                                        style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">
                                        <h3>نقد</h3>

                                    </li>
                                    <li class="text-center dark-color"
                                        style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">
                                        <h3>محفظة الكترونية</h3>
                                    </li>
                                </ul>

                            </div>

                        </div>

                        <div class="transfer-coin-input col-md-12 row">
                            <label> {{trans('lang.agency')}} </label>

                            <div class="dropdown col-12">
                                <div class="select form-group">
                                    <span> {{trans('lang.choose-receiving-agency')}}</span>
                                    <input type="hidden" name="transfer_agency_id" id="formtransfer_agency_id">
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <ul class="dropdown-menu" id="ul_transfer_agency_id" _>


                                </ul>
                            </div>
                        </div>
                        <div class="transfer-coin-input row col-md-12  ">
                            <div class="col-5">
                                <label> {{trans('lang.amount')}} </label>
                                <div class="input-two clearfix">
                                    <div class="input-two-box form-group" style="width: 100%">
                                        <input type="number" min="1" id="form_amount" onchange="updateAmount()"
                                               name="amount" value="0" placeholder="write the amount">
                                        <span>USD</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">

                            </div>
                            <div class="col-5">
                                <label>{{trans('lang.our-fees')}}</label>

                                <div class="input-two clearfix">

                                    <div class="input-two-box" style="width: 100%">
                                        <input type="number" id="form_fee" min="1" value="0" placeholder="" disabled>
                                        <span>USD</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- detail Modal -->
                        <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modal"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header   col-md-12">
                                        <div class=" col-md-10 row ">
                                            <div class="col-md-2 text-right">
                                                <div class="circle_icon"><i class="fas fa-user"></i></div>
                                            </div>
                                            <div class="col-md-8 " style="margin-top: 5px">
                                                <h3>{{trans('lang.receiver-information')}}</h3>
                                            </div>
                                        </div>


                                        <div class=" text-left">
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    </div>
                                    <div class="modal-body">


                                        <div class="theme-input-box form-group">

                                            <label>{{trans('lang.receiver-name')}} </label>
                                            <input type="text" id="form_receiver_name" name="receiver_name" value=""
                                                   class="theme-input">
                                        </div>
                                        <div class="theme-input-box form-group">
                                            <label>{{trans('lang.phone-number')}}</label>
                                            <input type="text" id="form_receiver_phone" name="receiver_phone" value=" "
                                                   class="theme-input">
                                        </div>
                                        <div class="theme-input-box">
                                            <label>{{trans('lang.receiver-address')}}</label>
                                            <input type="text" id="form_receiver_address" name="receiver_address"
                                                   value=""
                                                   class="theme-input">
                                        </div>
                                        <div class="theme-input-box form-group">
                                            <label>{{trans('lang.email')}} </label>
                                            <input type="email" id="form_receiver_email" name="receiver_email" value=" "
                                                   class="theme-input">
                                        </div>

                                        <div class="theme-input-box form-group">
                                            <label>{{trans('lang.account-number')}}</label>
                                            <input type="text" id="form_receiver_acc_number" name="receiver_acc_number"
                                                   value="" class="theme-input">
                                        </div>


                                    </div>
                                    <div class="transfer-coin-input  custom-control custom-checkbox"
                                         style="margin-bottom: 50px; margin-right: 10px;margin-left: 10px;">

                                        {{--                                        <input type="checkbox" class="custom-control-input" id="customCheck"--}}
                                        {{--                                               name="example1"--}}
                                        {{--                                               checked="false"--}}
                                        {{--                                               required>--}}
                                        {{--                                        <label class="custom-control-label" for="customCheck">جميع بياناتي السابقة--}}
                                        {{--                                            صحيحة </label>--}}
                                    </div>
                                    <div class="remove-popuo-btn clearfix" style="width: 100%; margin: 0">
                                        <button class="remove-btn cancel-btn"
                                                data-dismiss="modal">{{trans('lang.close')}}</button>
                                        <button id="show_model" class="remove-btn" type="button"
                                        >{{trans('lang.send-transfer-order')}}</button>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="transfer-coin-button">
                            <button type="button" class="theme-btn" id="show_first_model"
                            >{{trans('lang.transfer-ur-money-safely')}}</button>
                        </div>
                    </form>


                </div>
                <div class="col-xl-6  mt-responsive transfer">

                    <div class=" d-flex flex-row col-md-12">
                        <div class="col-8 col-lg-10 col-xl-9">
                            <div class="invoice-warning direction-box" style="background-color: white;opacity: .7">

                                @if (is_string($instructions))

                                    {!! $instructions !!}
                                @endif


                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-xl-3">

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
                                        <th colspan="2"
                                            class="text-center">{{trans('lang.transaction-information')}}</th>
                                    </tr>


                                    <tr>
                                        <th>{{trans('lang.amount')}}</th>
                                        <td><span id="info_amount"></span>
                                            <span id="info_selected_currency">$</span></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('lang.our-fees')}}</th>
                                        <td>
                                            <span id="info_fees"></span>
                                            <span>$</span>

                                        </td>

                                    </tr>
                                    <tr>
                                        <th>{{trans('lang.receiver-country')}}</th>
                                        <td id="info_country">اليمن</td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('lang.transfer-agency')}}</th>
                                        <td id="info_agency_name"></td>
                                    </tr>
                                </table>


                                <table class="table table-borderless">
                                    <tr>
                                        <th colspan="2" class="text-center">بيانات المستلم</th>
                                    </tr>

                                    <tr>
                                        <th> {{trans('lang.receiver-name')}}</th>

                                        <td id="info_receiver_name">


                                        </td>
                                    </tr>


                                    <tr>
                                        <th>{{trans('lang.phone-number')}}</th>

                                        <td id="info_receiver_phone"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('lang.receiver-address')}}</th>

                                        <td id="info_receiver_address"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('lang.email')}}</th>

                                        <td id="info_receiver_email"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('lang.account-number')}}</th>

                                        <td id="info_receiver_acc_number"></td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="transfer-coin-input  custom-control custom-checkbox"
                                 style="width: 100%">

                            </div>

                            <div class="transfer-coin-button" style="width: 100%">

                                <div class="transfer-coin-button" style="width: 100%">
                                    <button id="save-form" class="theme-btn"
                                            type="button">{{trans('lang.send-transfer-order')}}</button>

                                </div>

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
        function updateAmount() {
            var agency_id = $("#form_agency_id").val();
            var amount = $("#form_amount").val();
            $("#info_amount").text(amount);
        }

        $('#show_first_model').click(function (e) {

            var form_country_id = $("#form_country_id").val();
            var formtransfer_agency_id = $("#formtransfer_agency_id").val();
            var amount = $("#form_amount").val();


            if (form_country_id > 0 && formtransfer_agency_id > 0) {
                if (amount > 0)
                    $('#detail').modal('show');
                else {
                    $.toast({
                        heading: "error",
                        position: {
                            right: 10,
                            top: 10
                        },
                        text: "يجب تحديد المبلغ المراد تحويله",
                        icon: 'error'
                    });
                }
            } else {
                $.toast({
                    heading: "error",
                    position: {
                        right: 10,
                        top: 10
                    },
                    text: "يجب تحديد الدولة و الوكالة",
                    icon: 'error'
                });
            }
        });

        $('#show_model').click(function (e) {


            var form_receiver_acc_number = $("#form_receiver_acc_number").val();
            var form_receiver_address = $("#form_receiver_address").val();
            var form_receiver_phone = $("#form_receiver_phone").val();
            var form_receiver_name = $("#form_receiver_name").val();

            if (form_receiver_acc_number != "" && form_receiver_address != "" && form_receiver_name != "") {
                $('#model_operation').modal('show');
                $("#info_receiver_name").html($("#form_receiver_name").val());
                $("#info_receiver_phone").html($("#form_receiver_phone").val());
                $("#info_receiver_address").html($("#form_receiver_address").val());
                $("#info_receiver_email").html($("#form_receiver_email").val());
                $("#info_receiver_acc_number").html($("#form_receiver_acc_number").val());
                $("#info_amount").html($("#form_amount").val());
            } else {
                $.toast({
                    heading: "error",
                    position: {
                        right: 10,
                        top: 10
                    },
                    text: "يجب تحديد اسم وعنوان ورقمالهاتف و الحساب للمستلم ",
                    icon: 'error'
                });
            }


        });


        $(document).ready(function () {
            $('#customCheck').attr('checked', false);


            $('#customCheck').change(function () {

                var is_checked = $("#customCheck").is(":checked");

                if (is_checked)
                    $("#save-form").prop("disabled", false);
                else
                    $("#save-form").prop("disabled", true);

            });
            $('#save-form').click(function (e) {
                e.preventDefault();
                var old_text = $("#save-form").text();
                $("#save-form").prop("disabled", true);
                $("#save-form").text("انتظار اتمام العملية");
                $.easyAjax({
                    url: '{{route('confirm_transfer_order')}}',
                    container: '#form_data',
                    type: "POST",
                    redirect: true,
                    data: $('#form_data').serialize(),
                    success: function (response) {
                        console.log(response)
                        if (response.success == false) {
                            $.toast({
                                heading: "error",
                                position: {
                                    right: 10,
                                    top: 10
                                },
                                text: response.message,
                                icon: 'error'
                            });

                        } else {
                            $.toast({
                                heading: "success",
                                position: {
                                    right: 10,
                                    top: 10
                                },
                                text: response.message,
                                icon: 'success'
                            });
                            location.replace("{{url('/wallet/transfer_orders')}}")
                        }


                    }, error: function (error) {
                        $("#save-form").prop("disabled", false);
                    }, custom_error: function () {
                        $("#save-form").prop("disabled", false);
                    }


                })
            });

        });

        $(document).on("click", '.dropdown .dropdown-menu li.country', function () {
            // $('#customCheck').attr('checked', false);
            $("#form_receiving_mode_span").html();
            $("#form_receiving_mode").val("");
            $("#info_country").html($(this).html());
            var amount = $("#form_amount").val();
            $("#info_amount").text(amount);
            var country_id = $(this).attr("id");
            $.easyAjax({
                url: "{{route('chooseReceivingTypes')}}",
                type: "get",
                data: {"country_id": country_id},
                success: function (response) {
                    {{--location.replace("{{route("wallet.my_accounts")}}")--}}
                    var options = "";

                    response.forEach(function (element) {
                        options += "<li class='text-center li_receiving_mode' style='background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;'   id='" + element + "'> " + element + "</li>";
                    });
                    $("#ul_receiving_mode").html(options);
                    console.log(response);
                }
            })

        });
        $(document).on("click", '.dropdown .dropdown-menu li.agency_li', function () {
            $("#info_agency_name").html($(this).html());
            $("#info_fees").text($(this).attr("transfer_fee"));
            $("#form_fee").val($(this).attr("transfer_fee"));

        });

        $(document).on("click", '.dropdown .dropdown-menu li.li_receiving_mode', function () {
            var country_id = $("#form_country_id").val();
            var trans_type = $(this).attr("id");
            var url = '{!! route('list_receiving_agencies_by_c_type', [':country_id',':trans_type']) !!}';
            url = url.replace(':trans_type', trans_type);
            url = url.replace(':country_id', country_id);
            $.easyAjax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    var options = "";
                    response.forEach(function (element) {
                        options += ' <li transfer_fee="' + element.transfer_fee + '"  id="' + element.id + '" class="agency_li" style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:97%;">\n' +
                            '                                        <div class="row col-md-12">\n' +
                            '                                            <div class="col-md-4">\n' +
                            '                                                <img src="{{asset("")}}/' + element.img_path + '" alt=""\n' +
                            '                                                     style="max-width: 40px;">\n' +
                            '                                            </div>\n' +
                            '                                            <div class="col-md-7">\n' +
                            '                                                <div class="method">\n' +
                            '                                                    <h3>' + element.agency_name + ' </h3>\n' +
                            '                                                </div>\n' +
                            '                                            </div>\n' +
                            '                                        </div>\n' +
                            '\n' +
                            '                                    </li>';
                    });

                    $("#ul_transfer_agency_id").html(options);
                    console.log(response);
                }
            })

        });


    </script>
@endsection
