@extends('wallet.index')
@section('content')

    <form id="form_data" class="ajax-form" method="POST">
        @csrf
        <div class="wallet-box-scroll">
            <div class="wallet-bradcrumb">
                <h2><i class="fas fa-user" style="padding: 5px"></i>{{trans('lang.add-finical-account')}} :</h2>
                <h3 style="color: grey">الرجاء ادخال بيانات حسابك بشكل صحيح لأنه سيتم استخدام الحساب في عمليات
                    السحب من المحفظة </h3>
            </div>
            <div class="profile-page-area clearfix">
                <div class="transfer-coin-content-box col-xl-12 row ">
                    <div class="col-xl-7">


                        <div class="transfer-coin-input col-md-12 row clearfix">
                            <input type="hidden" name="deposit_type" value="cash">
                            <label class="col-3">النوع </label>
                            <div class="input-two col-12 clearfix">
                                <div class="dropdown" style="width: 100%">
                                    <div class="select form-group" style="width: 100%">
                                        <input type="hidden" required value="bank_deposit" id="deposit_type"
                                               name="deposit_type_id">
                                        <span style="right: 30px" id="selected_deposit_type">  </span>
                                        <i class="fas fa-caret-down"></i>
                                    </div>
                                    <ul class="dropdown-menu" id="ul_deposit_type">
                                        @foreach($deposit_types as $type)
                                            <li class='deposit_type' id="{{$type->id}}">{{$type->name}}</li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                        </div>


                        <div class="transfer-coin-input col-md-12 row clearfix">
                            <label class="col-3">الطريقة </label>
                            <div class="input-two col-12 clearfix">

                                <div class="dropdown" id="agency_section" style="width: 100%">

                                </div>
                            </div>
                        </div>
                        <div class="transfer-coin-input col-md-12 row">

                            <label class="col-md-3"> {{trans('lang.account-number')}} :</label>
                            <div class="input-two col-md-12 clearfix input-responsive">
                                <div class="input-two-box form-group " style="width: 100%">
                                    <input type="text" required name="customer_agency_acc_number" value=""
                                           placeholder="">
                                </div>
                            </div>


                        </div>
                        <div class="transfer-coin-input col-md-12 row">

                            <label class="col-md-3"> {{trans('lang.account-name')}} :</label>
                            <div class="input-two col-md-12 clearfix input-responsive">
                                <div class="input-two-box form-group " style="width: 100%">
                                    <input type="text" required name="customer_agency_acc_name" value=""
                                           placeholder="">
                                </div>
                            </div>


                        </div>


                        <div class="transfer-coin-button">
                            <button class="theme-btn" id="save-form" type="button">{{trans('lang.add-account')}}</button>
                        </div>
                    </div>
                    <div class="col-xl-5 mt-responsive">
                        <div class="invoice-warning">
                            <p><span class="invoice-text"><i class="fas fa-exclamation-circle"></i></span>
                                {{trans('lang.please-see-to-confirm')}}
                            </p>
                        </div>
                        <div class="table-responsive">
                            <table class="table   table-borderless">
                                <tr>
                                    <th colspan="2">
                                        <img id="info_agency_img_path"
                                             src="{{asset('org_assets/dist/img/logo4.png')}}" alt="Loader"
                                             class="wizardimg mx-auto d-block">

                                    </th>
                                </tr>
                                <tr>
                                    <th>{{trans('lang.account-type')}}</th>
                                    <td id="info_agency_national"></td>
                                </tr>
                                <tr>
                                    <th>{{trans('lang.agency-name')}}</th>
                                    <td id="info_agency_name"></td>
                                </tr>
                                <tr>
                                    <th>{{trans('lang.account-number')}}</th>
                                    <td id="info_agency_ytadawul_account_number"></td>
                                </tr>
                                <tr>
                                    <th>{{trans('lang.account-name')}}</th>
                                    <td id="info_agency_ytadawul_account_name"></td>
                                </tr>
                            </table>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </form>


@endsection
@section("custom_js")
    <script type="text/javascript">

        $('.dropdown .dropdown-menu li.deposit_type').click(function () {
            var type_id = ($(this).attr('id'));
            var url = '{!! route('getWithdrawAgencyByMethod', [':type_id']) !!}';
            url = url.replace(':type_id', type_id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    $("#agency_section").html(response);

                },
            })
        });

        $('#save-form').click(function () {
            $.easyAjax({
                url: '{{route('wallet.save_new_account')}}',
                container: '#form_data',
                type: "POST",
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    location.replace("{{route("wallet.my_accounts")}}")
                }
            })
        });

    </script>
@endsection
