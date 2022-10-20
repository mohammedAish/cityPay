@extends('wallet.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-arrow-down" style="padding-right: 5px;padding-left: 5px;"></i>طلب ايداع</h2>

        </div>
        <div class="wizard-v3-content">
            <div class="wizard-form">
                <div class="wizard-header">
                    <h3 class="heading">4 خطوات بس عشان تشحن محفظتك </h3>
                    <p>ادفع - استلم - حول عن طرق محفظة كاش تداول </p>
                </div>
                <form class="form-register" id="post-form" action="{{route('wallet.confirm_deposit')}}" method="post">
                    {{ csrf_field() }}
                    <div id="form-total">

                        <!-- الدولة -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-city"></i></span>
                            <span class="step-text text-left">وكالات الأيداع  </span>
                        </h2>
                        <section>
                            <div class="inner ">
                                <div class="form-row form-row-date">
                                    <div class="form-holder form-holder-2 col-md-6">
                                        <h3>{{trans('lang.country')}} :</h3>

                                        <select name="country" class="country" id="country">
                                            <option value="0" selected="true">{{trans('lang.country')}}</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}"
                                                        name="country">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-holder form-holder-2 col-md-6">
                                        <h3>وكالات الايداع :</h3>
                                        <select name="Agency" class="Agency" id="Agency">

                                        </select>
                                    </div>
                                </div>


                            </div>

                        </section>


                        <!-- نوع الايداع  -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                            <span class="step-text text-left">نوع الايداع</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="form-row form-row-date">
                                    <div class="form-holder form-holder-2 col-md-6">
                                        <h3>نوع الايداع </h3>

                                        <select name="deposit_type" class="deposit_type" id="deposit_type">
                                        </select>
                                    </div>

                                    {{--                                    <div class="text-center col-md-6 img">--}}
                                    {{--                                        <img src="{{asset('org_assets/dist/img/wizardimages/cacbank.png')}}"--}}
                                    {{--                                             alt="Loader" class="wizardimg mx-auto d-block">--}}
                                    {{--                                        <hr>--}}

                                    {{--                                        <h5>قم بتحويل المبلغ لحساب يمن تداول </h5>--}}

                                    {{--                                    </div>--}}


                                </div>

                            </div>

                        </section>

                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-money-box"></i></span>
                            <span class="step-text text-left">المبلغ</span>
                        </h2>
                        <section>
                            <div class="inner ">
                                <div class="form-row form-row-date">
                                    <div class="form-holder ml-5 form-holder-2 col-md-4">
                                        <h3>العملة</h3>
                                        <select name="country" id="country">
                                            <option value="Month" disabled selected>العملة</option>
                                            <option value="Feb">دولار</option>
                                            <option value="Mar">يمني</option>
                                            <option value="Apr">سعودي</option>
                                        </select>
                                    </div>


                                    <div class="bank_box text-center col-md-7">
                                        <img src="{{asset('org_assets/dist/img/wizardimages/cacbank.png')}}"
                                             alt="Loader" class="wizardimg mx-auto d-block">
                                        <br>

                                        <div class="theme-input-box">
                                            <label><h3>
                                                    قم بادخال المبلغ الذي تريد ايداعه
                                                </h3>
                                            </label>
                                            <input type="" name="" value="50.00 $" class="theme-input"
                                                   style="width: 50%">
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </section>

                        <!-- الايصال -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                            <span class="step-text text-left">ارفق ايصال الدفع</span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="form-row form-row-date">
                                    <div class="form-holder form-holder-2 col-md-12">
                                        <div class="container" style="text-align: center;">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h1 style="color: gray;">قم برفع صورة ايصال الدفع</h1>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-md-offset-3 " style="text-align: center;">
                                                    <div class="btn-container">
                                                        <!--the three icons: default, ok file (img), error file (not an img)-->

                                                        <h1 class="imgupload"><i class="zmdi zmdi-cloud-upload"
                                                                                 style="color: #0B4879;"></i>
                                                        </h1>
                                                        <h1 class="imgupload ok"><i class="zmdi zmdi-check"></i></h1>
                                                        <h1 class="imgupload stop"><i
                                                                    class="zmdi zmdi-close-circle"></i>
                                                        </h1>
                                                        <!--this field changes dinamically displaying the filename we are trying to upload-->
                                                        <p id="namefile">امتدادات الصور المسموح بها !
                                                            (jpg,jpeg,bmp,png)</p>
                                                        <!--our custom btn which which stays under the actual one-->
                                                        <button type="button" id="btnup" class="btn  btn-lg"
                                                                style="background-color: #0B4879; color: white">تصفح
                                                            الصور !
                                                        </button>
                                                        <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                                        <input type="file" value="" name="fileup" id="fileup">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--additional fields-->


                                        </div>


                                    </div>

                                </div>

                            </div>

                        </section>
                        <!-- التأكيد -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
                            <span class="step-text text-left">التأكيد</span>
                        </h2>
                        <section>
                            <div class="row col-md-12">
                                <div class="col-md-12">
                                    <h3>تفاصيل عملية الايداع :</h3>
                                    <table class="table table-borderless ">

                                        <tr>
                                            <td>
                                                <h5>
                                                    الدولة :

                                                </h5>

                                            </td>
                                            <td id="countryConfirm">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>
                                                    نوع الايداع :

                                                </h5>

                                            </td>
                                            <td id="AgencyConfirm">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>
                                                    طريقة الايداع :

                                                </h5>

                                            </td>
                                            <td id="TypeConfirm">
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5>
                                                    مبلغ الايداع :

                                                </h5>

                                            </td>
                                            <td>
                                                35000 ريال يمني
                                            </td>
                                        <tr>
                                            <td>
                                                <h5>
                                                    الايميل :

                                                </h5>

                                            </td>
                                            <td>
                                                {{auth()->user()->email}}
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <h5>
                                                    رقم التلفون :
                                                </h5>
                                            </td>
                                            <td>
                                                {{auth()->user()->phone}}
                                            </td>
                                        </tr>

                                    </table>
                                </div>

                                {{--                                <div class="bank_box text-center col-md-6">--}}
                                {{--                                    <img src="{{asset('org_assets/dist/img/wizardimages/paypal.png')}}" alt="Loader"--}}
                                {{--                                         class="wizardimg mx-auto d-block">--}}
                                {{--                                    <br>--}}

                                {{--                                    <div class="theme-input-box">--}}
                                {{--                                        <table class="table table-borderless">--}}
                                {{--                                            <tr>--}}
                                {{--                                                <td>--}}
                                {{--                                                    <h5>--}}
                                {{--                                                        ايصال الدفع :--}}
                                {{--                                                    </h5>--}}

                                {{--                                                </td>--}}
                                {{--                                                <td>--}}
                                {{--                                                    <img id="img" alt="Loader" class=" mx-auto d-block">--}}

                                {{--                                                </td>--}}
                                {{--                                            </tr>--}}

                                {{--                                        </table>--}}

                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            jQuery(document).on('change', '.country', function () {
                getMoreAgency();
            });
            $.ajax({
                type: 'GET',
                url: '/wallet/list_deposit_type_by_agency/2', //why this //todo OSAMA
                dataType: 'json',      //return data will be json
                success: function (deposit_type) {
                    console.log(deposit_type);
                },
                error: function () {
                    console.log('false');


                }
            });
            console.log('jkhkhkuhfuksheukdfhsuhfushufhdhjshjk')


            function getMoreAgency() {

                //selected_country_id

                var country = $(".country option:selected").val();
                //selected_country_name in confirm
                var e = document.getElementById("country");
                document.getElementById("countryConfirm").innerHTML = e.options[e.selectedIndex].text;


                $.ajax({
                    type: 'GET',
                    url: '/wallet/list_agencies_by_country/' + country,
                    dataType: 'json',      //return data will be json
                    success: function (agenciesCountry) {
                        console.log(agenciesCountry);

                        $('select[name="Agency"]').empty();
                        $.each(agenciesCountry, function (key, value) {

                            $('select[name="Agency"]').append('<option value="' + value.id + '"  data-tadawul="' + value.ytadawul_acc_number + '">' + value.name + '</option>');
                        });

                    },
                    error: function () {
                        console.log('false');


                    }
                });
            }

            //getDepositType by country and agency
            jQuery(document).on('change', '.Agency', function () {
                console.log('changed agency')
                var Agency = $(".Agency option:selected").val();
                //selected_name_type_in_confirm
                var b = document.getElementById("Agency");
                document.getElementById("AgencyConfirm").innerHTML = b.options[b.selectedIndex].text;
                document.getElementById("ytadwul-acc").innerHTML = $(".Agency option:selected").attr('data-tadawul');

                // var country = $(".country option:selected").val();   + '/' + country

                $.ajax({
                    type: 'GET',
                    url: '/wallet/list_deposit_type_by_agency/' + Agency,
                    dataType: 'json',      //return data will be json
                    success: function (deposit_type) {
                        console.log(deposit_type);

                        $('select[name="deposit_type"]').empty();
                        $.each(deposit_type, function (key, value) {

                            $('select[name="deposit_type"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });

                        //selected_id_type
                        var type = $(".deposit_type option:selected").val();

                        //selected_name_type_in_confirm
                        var c = document.getElementById("deposit_type");
                        document.getElementById("TypeConfirm").innerHTML = c.options[c.selectedIndex].text;
                    },
                    error: function () {
                        console.log('false');


                    }
                });
            });

            function confirm_deposit(lang_id) {
                jQuery(function ($) {
                    var country_id = $('#country').val();
                    var agency_id = $('#Agency').val();
                    var deposit_type = $('#deposit_type').val();
                    jQuery.ajax({
                        beforeSend: function (xhr) { // Add this line
                            xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                        },
                        url: '{{ route('wallet.confirm_deposit')}}',
                        type: "POST",
                        data: {
                            "agency_id": agency_id, "country_id": country_id, "deposit_type": deposit_type,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function (res) {
                            console.log(res);
                            // window.location.reload();
                        },
                    });
                });
            }

        });

    </script>
@endsection
