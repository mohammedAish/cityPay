@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h3>{{trans('lang.Withdraw-money-from-freelancing-platforms')}} </h3>
        </div>

        <div class="tranfer-coin-box">

            <div class="transfer-coin-content-box col-xl-12 row ">
                <div class="col-xl-6">
                    <form method="" id="form_data" action="#" autocomplete="off">
                        @csrf
                        <input type="hidden" name="currency_id" value="1">
                        <div class="transfer-coin-input col-md-12 row">
                            <label> {{trans('lang.freelancing-Platforms')}}</label>
                            <div class="dropdown col-12 input-responsive">
                                <div class="select form-group">
                                    <input type="hidden" required id="deposit_type"
                                           name="reference_id">

                                    <span id="form_plateform"> {{trans('lang.choose-platform')}}</span>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <ul class="dropdown-menu">

                                    @foreach($free_lancing_platforms as $free)

                                        <li id="{{$free->id}}" class="platforms text-center dark-color"
                                            style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;">
                                            <h3> {{$free->name}} </h3>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div class="transfer-coin-input col-md-12 row">
                            <label> {{trans('lang.agency')}} </label>

                            <div class="dropdown col-12 input-responsive">
                                <div class="select form-group">
                                    <span id="form_deposit_agency"> {{trans('lang.choose-receiving-agency')}}</span>
                                    <input type="hidden" name="deposit_agency_id" id="formtransfer_agency_id">
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <ul class="dropdown-menu" id="ul_transfer_agency_id" _>


                                </ul>
                            </div>
                        </div>


                        <div class="transfer-coin-input col-md-12 row">

                            <label> {{trans('lang.amount')}}</label>
                            <div class="input-two col-12 input-responsive ">
                                <div class="input-two-box "
                                     style="width: 100%; margin-bottom: 20px">
                                    <div class="form-group">
                                        <input type="number" min="1" name="amount" id="form_amount" value="0"
                                               placeholder="">
                                    </div>
                                    <span>USD</span>
                                </div>
                            </div>
                        </div>
                        <div class="transfer-coin-input col-md-12 row clearfix">


                            <div class="transfer-coin-input col-md-12 row clearfix">

                                <div class="col-6">
                                    <label class="col-12">{{trans('lang.min_amount_pull')}}</label>
                                    <div class=" col-12 clearfix">
                                        <div class=" form-group">
                                            <span type="text" readonly name="min_deposit_amount"
                                                  id="min_deposit_amount" value=""
                                                  placeholder=""></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="col-12">{{trans('lang.max_amount_pull')}}</label>
                                    <div class=" col-12 clearfix">
                                        <div class=" form-group">
                                            <span type="text" readonly name="max_deposit_amount"
                                                  id="max_deposit_amount" value=""
                                                  placeholder=""></span>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>


                        <div class="transfer-coin-button">
                            <button id="show_model" class="theme-btn"
                                    type="button">{{trans('lang.send-withdraw-order')}}</button>
                        </div>

                    </form>
                </div>

                <div class="col-xl-6  mt-responsive ">


                    <div class=" d-flex flex-row col-md-12">
                        <div class="col-8 col-lg-10 col-xl-9">
                            <div class="invoice-warning direction-box" style="background-color: white">
                                <h3 style="margin-bottom: 30px"><span class="invoice-text"><i
                                                class="fas fa-question-circle" style="color: green"></i></span>
                                    {{trans('lang.Instructions-freelancing')}}
                                </h3>
                                @if (is_string($instructions))

                                    {!! $instructions !!}
                                @endif


                            </div>
                        </div>
                        <div class="col-4 col-lg-2 col-xl-3">
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
                                                        style="color: red;padding: 5px"></i></span>
                                            {{trans('lang.attention-for-information')}}</p>
                                    </div>


                                    <table class="table table-borderless">
                                        <tr>
                                            <th colspan="2"
                                                class="text-center">{{trans('lang.transaction-information')}}</th>
                                        </tr>

                                        <tr>
                                            <th>  {{trans('lang.freelancing-Platforms')}}</th>

                                            <td id="info_plateform">


                                            </td>
                                        </tr>

                                        <tr>
                                            <th>{{trans('lang.agency')}} </th>

                                            <td id="info_deposit_agency"></td>
                                        </tr>

                                        <tr>
                                            <th> {{trans('lang.amount_wanted_to_pull')}}</th>

                                            <td id="info_amount" class="text-right"></td>
                                        </tr>
                                        <tr>
                                            <th>{{trans('lang.our_pull_fee')}}</th>
                                            <td class="text-right">
                                                <span id="our_deposit_fee"></span>
                                            </td>
                                        </tr>

                                    </table>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th colspan="2"
                                                class="text-center">{{trans('lang.ytaduwel-information')}}</th>
                                        </tr>

                                        <tr>
                                            <th>{{trans('lang.ytaduwel-account-number')}}</th>
                                            <td id="info_agency_ytadawul_account_number"></td>
                                        </tr>
                                        <tr>
                                            <th>{{trans('lang.ytaduwel-account-name')}}</th>
                                            <td id="info_agency_ytadawul_account_name"></td>
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
                                            type="button">{{trans('lang.confirm')}}</button>

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
        $('#show_model').click(function (e) {
            var deposit_type = $("#deposit_type").val();
            var formtransfer_agency_id = $("#formtransfer_agency_id").val();
            var amount = $("#form_amount").val();

            if (deposit_type > 0 && formtransfer_agency_id > 0 && amount > 0) {
                $('#model_operation').modal('show');
                $("#info_plateform").html($("#form_plateform").html());
                $("#info_deposit_agency").html($("#form_deposit_agency").html());
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
                    text: "يجب المنصة و الوكالة و المبلغ",
                    icon: 'error'
                });
            }


        });

        var elements = [];
        $(document).on("click", '.dropdown .dropdown-menu li.platforms', function () {
            var id = $(this).attr("id");
            var url = '{!! route('list_payment_bt_platform', [':id']) !!}';
            url = url.replace(':id', id);

            $.easyAjax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    var options = "";
                    response.forEach(function (element) {
                        elements.push(element);
                        options += ' <li all_data="' + element.data + '"  id="' + element.id + '" class="agency_li" style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:97%;">\n' +
                            '                                        <div class="row col-md-12">\n' +
                            '                                            <div class="col-md-4">\n' +
                            '                                                <img src="{{asset("")}}/' + element.img_path + '" alt=""\n' +
                            '                                                     style="max-width: 40px;">\n' +
                            '                                            </div>\n' +
                            '                                            <div class="col-md-7">\n' +
                            '                                                <div class="method">\n' +
                            '                                                    <h3>' + element.name + ' </h3>\n' +
                            '                                                </div>\n' +
                            '                                            </div>\n' +
                            '                                        </div>\n' +
                            '\n' +
                            '                                    </li>';
                    });

                    $("#ul_transfer_agency_id").html(options);
                }
            })

        });
        var sum_fee = 0;
        $(document).on("click", '.dropdown .dropdown-menu li.agency_li', function () {

            var id = $(this).attr('id');
            console.log(id);
            var __FOUND = elements.find(function (item, index) {
                if (item.id == id)
                    return item;
            });

            $("#min_deposit_amount").text((__FOUND.min_deposit_amount));
            $("#max_deposit_amount").text((__FOUND.max_deposit_amount));
            $("#info_agency_ytadawul_account_number").text(__FOUND.ytadawul_account_number);
            $("#info_agency_ytadawul_account_name").text(__FOUND.ytadawul_account_name);
            $("#info_agency_name").text(get_first_objectVal(__FOUND.name));
            sum_fee = parseFloat((__FOUND.deposit_fee_percent * $("#form_amount").val() / 100)) + parseFloat(__FOUND.fixed_charge_deposit);
            $("#info_amount").html($("#form_amount").val());
            $("#our_deposit_fee").html(sum_fee + '$');
            $("#form_amount").attr('min', __FOUND.min_deposit_amount);
            $("#form_amount").attr('max', __FOUND.max_deposit_amount);
        });

        $('#save-form').click(function (e) {
            e.preventDefault();
            var old_text = $("#save-form").text();
            $("#save-form").prop("disabled", true);
            $("#save-form").text("انتظار اتمام العملية");
            $.easyAjax({
                url: '{{route('save_freelancing')}}',
                container: '#form_data',
                type: "POST",
                redirect: true,

                data: $('#form_data').serialize(),
                success: function (response) {

                    console.log(response)
                    location.replace("{{route("list_pull_earnings_orders")}}")
                }, custom_error: function () {
                    $("#save-form").prop("disabled", false);
                }

            })
        });
    </script>
@endsection
