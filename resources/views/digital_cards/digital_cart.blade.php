@extends('wallet.index')
@section('content')

    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2> {{trans('lang.digital_cards')}}  </h2>
        </div>

        <div class="tranfer-coin-box">

            <div class="transfer-coin-content-box col-xl-12 row  ">
                <div class="col-xl-6">
                    <form method="" id="form_data" action="#" autocomplete="off">
                        @csrf
                        <div class="transfer-coin-input col-12  row   clearfix">
                            <label> {{trans('lang.account')}} </label>

                            <div class="dropdown col-12  input-responsive">
                                <div class="select">
                                    <span><img src="{{asset('/org_assets/dist/img/walletimages/usd.png')}}" alt="USD">
                                      {{auth()->user()->wallet_code_symbol}}  </span>
                                    <i class="fas fa-caret-down"></i>
                                </div>

                            </div>

                        </div>


                        <div class="transfer-coin-input col-12  row">
                            <input type="hidden" name="cart_type" value="cash">
                            <label> {{trans('lang.digitalcardproviderpackage')}} </label>
                            <div class="dropdown  col-12 clearfix input-responsive">
                                <div class="select form-group">
                                    <input type="hidden" required value="bank_deposit" id="cart_type"
                                           name="cart_type_id">
                                    <span style="right: 30px" id="selected_cart_type">  {{trans('lang.digitalcardproviderpackage')}} ...</span>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                                <ul class="dropdown-menu" id="ul_cart_type">
                                    @foreach($card_categories as $type)
                                        <li class='cart_type' id="{{$type->id}}">{{$type->name}}</li>
                                    @endforeach

                                </ul>

                            </div>
                        </div>


                        <div class="transfer-coin-input  col-12  row ">
                            <label> {{trans("lang.products")}} </label>
                            <div class="dropdown col-12 input-responsive" id="provider_section">
                                <div class="select form-group" style="width: 100%">
                                    <span style="right: 30px"> {{trans('lang.products')}} ... </span>
                                    <i class="fas fa-caret-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="transfer-coin-input col-12  row  clearfix">
                            <label> {{trans('lang.card_store')}} </label>
                            <div class="dropdown col-12 input-responsive">
                                <div class="select form-group">
                                    <span id="form_store_span">{{trans('lang.card_store')}} ...</span>
                                    <i class="fas fa-caret-down"></i>
                                    <input type="hidden" required value="" id="form_store_id"
                                           name="store_id">
                                </div>
                                <ul class="dropdown-menu" id="ul_stores">
                                </ul>
                            </div>
                        </div>

                        <div class="transfer-coin-input  col-12  row clearfix">
                            <label> {{trans('lang.package_name')}} </label>
                            <div class="dropdown col-12 input-responsive">
                                <div class="select form-group">
                                    <span id="form_package_name_span">{{trans('lang.package_name')}} ...</span>
                                    <i class="fas fa-caret-down"></i>
                                    <input type="hidden" required value="" id="form_package_id"
                                           name="store_id">
                                </div>
                                <ul class="dropdown-menu" id="ul_packages">
                                </ul>
                            </div>
                        </div>

                        <div class="transfer-coin-input col-12  row  clearfix">
                            <label> {{trans('lang.quantity')}} </label>
                            <div class=" col-12 clearfix">
                                <div class="input-two-box form-group">
                                    <input type="number" min="1" name="qty" id="form_qty" value="1"
                                           placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="transfer-coin-button">
                            <button id="show_model" class="theme-btn" type="button">{{trans('lang.buy')}} </button>
                        </div>
                    </form>

                </div>


                <div class="col-xl-6 mt-responsive">

                    <div class=" d-flex flex-row col-md-12 ">
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
                                            <th colspan="2" class="text-center">بيانات العملية</th>
                                        </tr>

                                        <tr>
                                            <th> {{trans('lang.digitalcardproviderpackage')}}</th>

                                            <td id="info_cart_type"></td>
                                        </tr>

                                        <tr>
                                            <th> {{trans('lang.digital_cards_providers')}}</th>

                                            <td id="info_provider_id"></td>
                                        </tr>

                                        <tr>
                                            <th> {{trans('lang.digital_card_stores')}}</th>

                                            <td id="info_store_span"></td>
                                        </tr>

                                        <tr>
                                            <th> {{trans('lang.package_name')}}</th>

                                            <td id="info_package_name_span"></td>
                                        </tr>

                                        <tr>
                                            <th> الكمية</th>
                                            <td id="info_qty"></td>
                                        </tr>
                                        <tr>
                                            <th> السعر</th>

                                            <td id="info_price"> 0</td>
                                        </tr>
                                        <tr>

                                            <th>{{trans('lang.amount')}}</th>

                                            <td>
                                                <span id="info_amount"></span>
                                                <span id="info_selected_currency"></span>
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="transfer-coin-input  custom-control custom-checkbox"
                                     style="width: 100%">
                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="example1"
                                           checked="false"
                                           required>
                                    <label class="custom-control-label" for="customCheck">
                                        {{trans('lang.all_previous_info_correct')}}
                                    </label>
                                </div>

                                <div class="transfer-coin-button" style="width: 100%">
                                    <button id="save-form" class="theme-btn" type="button"
                                            disabled> {{trans('lang.buy')}}
                                    </button>
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
        $(document).ready(function () {
            $('#customCheck').attr('checked', false);
        });


        $('.dropdown .dropdown-menu li.cart_type').click(function () {
            $("#_proformvider_id").html("");
            $("#provider_section").html("");

            $("#form_store_span").html("");
            $("#ul_stores").html("");

            $("#form_package_name_span").html("");
            $("#ul_packages").html("");

            var type_id = ($(this).attr('id'));
            var url = '{!! route('cards.list_providers_category', [':type_id']) !!}';
            url = url.replace(':type_id', type_id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    $("#provider_section").html(response);

                }
            })

        });

        $(document).on("click", '.dropdown .dropdown-menu li.provider_li', function () {
            $("#form_store_span").html("");
            $("#ul_stores").html("");
            $("#form_package_name_span").html("");
            $("#ul_packages").html("");

            var type_id = ($(this).attr('id'));
            var url = '{!! route('cards.list_stores_provider', [':type_id']) !!}';
            url = url.replace(':type_id', type_id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    console.log(response);
                    var options = "";
                    if (response.has_stores == true) {
                        response.stores.forEach(function (element) {
                            options += "<li class='text-center li_store' style='background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;'   id='" + element.id + "'> " + element.name + "</li>";
                        });
                        $("#ul_packages").html("");
                        $("#ul_stores").html(options);
                    } else {
                        response.packages.forEach(function (element) {
                            options += "<li class='text-center li_package' style='background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;'   id='" + element.id + "'> " + element.name + "</li>";
                        });
                        $("#ul_stores").html("");
                        $("#ul_packages").html(options);
                    }
                }
            });
            // $("#cart_type").val("");
            // var data = JSON.parse($(this).attr('all_data'));
            // $("#info_agency_ytadawul_account_number").text(data.ytadawul_account_number);
            // $("#info_agency_name").text(get_first_objectVal(data.name));
            // $("#info_amount").text($("#form_amount").val());

        });

        $(document).on("click", '.dropdown .dropdown-menu li.li_store', function () {
            var store_id = ($(this).attr('id'));
            var provider_id = ($("#form_provider_id").val());
            $("#form_package_name_span").html("");
            $("#ul_packages").html("");
            var url = '{!! route('cards.list_packages', [':provider_id',':store_id']) !!}';
            url = url.replace(':store_id', store_id);
            url = url.replace(':provider_id', provider_id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    console.log(response);
                    var options = "";
                    response.forEach(function (element) {
                        options += "<li data-price='" + element.price + "' class='text-center li_package' style='background-color: #f2f2f2; border-radius: 30px; height: 60px; width:98%;'   id='" + element.id + "'> " + get_first_objectVal(element.name) + "</li>";
                    });
                    $("#ul_packages").html(options);

                }
            });


        });
        var carts_fond = 0;
        $(document).on("click", '.dropdown .dropdown-menu li.li_package', function () {
            var id = ($(this).attr('id'));
            $("#info_price").text($(this).data('price'));
            var url = '{!! route('cards.check_c_stock', [':id']) !!}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    console.log(response);
                    if (response.status == false) {
                        carts_fond = 0;
                        $.toast({
                            heading: "error",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: "غير متوفر",
                            icon: 'error'
                        });

                    } else {
                        carts_fond = 1;
                        $.toast({
                            heading: "success",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: "هذة الفئة موجودة وبعدد " + response.found + " كروت",
                            icon: 'success'
                        });


                    }
                }
            });


        });

        $('#customCheck').change(function () {
            var is_checked = $("#customCheck").is(":checked");
            if (is_checked)
                $("#save-form").attr("disabled", false);
            else
                $("#save-form").attr("disabled", true);
        });

        $('#show_model').click(function (e) {
            var qty = ($("#form_qty").val());
            var package_id = ($("#form_package_id").val());
            if (carts_fond == 0) {
                $.toast({
                    heading: "error",
                    position: {
                        right: 10,
                        top: 10
                    },
                    text: "غير متوفر هذا الفئة",
                    icon: 'error'
                });
            } else if (qty > 0 && package_id > 0) {
                $('#customCheck').attr('checked', false);
                $("#info_qty").html($("#form_qty").val());
                $("#info_amount").html($("#form_qty").val() * $("#info_price").text());
                $("#info_cart_type").html($("#selected_cart_type").html());
                $("#info_store_span").html($("#form_store_span").html());
                $("#info_provider_id").html($("#form_provider_text").html());
                $("#info_package_name_span").html($("#form_package_name_span").html());
                $('#model_operation').modal('show');
            } else {
                $.toast({
                    heading: "error",
                    position: {
                        right: 10,
                        top: 10
                    },
                    text: "يرجى اختيار الفئة اولا",
                    icon: 'error'
                });
            }

        });
        $('#save-form').click(function (e) {
            e.preventDefault();
            var qty = ($("#form_qty").val());
            var package_id = ($("#form_package_id").val());
            var url = '{!! route('cards.confirm_order') !!}';
            var old_text = $("#save-form").text();
            $("#save-form").attr("disabled", true);
            $("#save-form").text("انتظار اتمام العملية");
            $.ajax({
                url: url,
                type: "post",
                data: {
                    'qty': qty,
                    'digital_card_id': package_id,
                    'package_id': package_id,
                    '_token': "{{csrf_token()}}"
                },
                success: function (response) {
                    $("#save-form").text(old_text);
                    $("#save-form").removeAttr("disabled");
                    console.log(response);
                    if (response.status == false) {
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
                        //  response.data.digital_cards_bought.forEach(function (element) {
                        $.toast({
                            heading: "success",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: response.message,
                            icon: 'success'
                        });
                        //  });

                        //todo Osama must return it to a list of puing list and show the cart codes in info modal
                        location.replace("{{route("cards.my_cards")}}")
                    }
                }
            });
        });

    </script>
@endsection
