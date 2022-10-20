@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-user"></i>{{trans('lang.Profile')}}</h2>
        </div>
        <div class="wizard-v3-content">
            <div class="wizard-form" >
                <div class="wizard-header">
                    <h3 class="heading">خطوتين عشان تسحب فلوسك من اي بنك </h3>
                    <p>ادفع - استلم - حول عن طرق محفظة كاش تداول </p>
                </div>
                <form class="form-register" action="#" method="post">
                    <div id="form-total">

                        <!-- الدولة -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-city"></i></span>
                            <span class="step-text text-left">دولة الاستلام </span>
                        </h2>
                        <section>
                            <div class="inner ">
                                <div class="form-row form-row-date">
                                    <div class="form-holder form-holder-2 col-md-6">
                                        <h3>دولة الاستلام :</h3>
                                        <select name="country" id="country" class="country">
                                            <option value="0" disabled selected>الدولة</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->id}}" name="country">{{$country->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>

                        </section>

                        <!-- نوع السحب -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                            <span class="step-text text-left">نوع السحب  </span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="form-row form-row-date">
                                    <div class="form-holder form-holder-2 col-md-5 ml-5">
                                        <h3>نوع السحب  :</h3>

                                        <select name="withdrawType" id="withdrawType" class="withdrawType">
                                        </select>
                                    </div>


                                </div>

                            </div>

                        </section>


                        <!-- وكالات السحب -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-card"></i></span>
                            <span class="step-text text-left">اختر الوكالة </span>
                        </h2>
                        <section>
                            <div class="inner">
                                <div class="form-row form-row-date">
                                    <div class="form-holder form-holder-2 col-md-5 ml-5">
                                        <h3> اختر الوكالة التي تريد سحب اموالك اليها  :</h3>

                                        <select name="Agency" id="Agency" class="Agency">

                                        </select>
                                    </div>




                                    <div class="bank_box text-center col-md-6">
                                        <img src="{{asset('org_assets/dist/img/wizardimages/paypal.png')}}" alt="Loader" class="wizardimg mx-auto d-block">
                                        <hr>

                                        <h5>تفاصيل حسابي في باي بال</h5>
                                        <span>الاسم : ايمان محمد مطهر اللوندي</span>
                                        <div class="theme-input-box">
                                            <label><h3>
                                                    ادخل رقم الحساب :
                                                </h3>
                                            </label>
                                            <input type="" name="" value="12345684" class="theme-input" style="width: 50%">

                                        </div>
                                        <div class="profile-btn" style="text-align: left !important;">
                                            <button class="theme-btn">تعديل البروفايل</button>
                                        </div>
                                    </div>






                                </div>

                            </div>

                        </section>

                        <!-- SECTION 1 -->
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
                                        <img src="{{asset('org_assets/dist/img/wizardimages/paypal.png')}}" alt="Loader" class="wizardimg mx-auto d-block">
                                        <br>

                                        <div class="theme-input-box">
                                            <label><h3>
                                                    قم بادخال المبلغ الذي تريد سحبه
                                                </h3>
                                            </label>
                                            <input type="" name="" value="50.00 $" class="theme-input" style="width: 50%">
                                        </div>
                                    </div>


                                </div>

                            </div>

                        </section>

                        <!-- SECTION 5 -->
                        <h2>
                            <span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
                            <span class="step-text text-left">التأكيد</span>
                        </h2>
                        <section>
                            <div class="row col-md-12">
                                <div class="col-md-6">
                                    <h3>تفاصيل الحساب :</h3>





                                    <table class="table table-borderless ">

                                        <tr>
                                            <td>
                                                <h5>
                                                    الدولة :

                                                </h5>

                                            </td>
                                            <td>
                                                مصر
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5>
                                                    الايميل :

                                                </h5>

                                            </td>
                                            <td>
                                                eman@gmail.com
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <h5>
                                                    رقم التلفون :
                                                </h5>
                                            </td>
                                            <td>
                                                777789403
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>
                                                    نوع السحب :

                                                </h5>

                                            </td>
                                            <td>
                                                حوالة بنكية
                                            </td>
                                        </tr>
                                        <tr>

                                            <td>
                                                <h5>
                                                    رقم الحساب :
                                                </h5>
                                            </td>
                                            <td>
                                                545454545
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="bank_box text-center col-md-6">
                                    <img src="{{asset('org_assets/dist/img/wizardimages/paypal.png')}}" alt="Loader" class="wizardimg mx-auto d-block">
                                    <br>

                                    <div class="theme-input-box">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <h5>
                                                        اجمالي المبلغ المدخل :
                                                    </h5>

                                                </td>
                                                <td>
                                                    <input type="" name="" value="50.00 $" class="theme-input" style="width: 50%" disabled>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>
                                                        المبلغ الذي سيتم سحبه :
                                                    </h5>

                                                </td>
                                                <td>
                                                    <input type="" name="" value="45.00 $" class="theme-input" style="width: 50%" disabled>

                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5>
                                                        العمولة :
                                                    </h5>

                                                </td>
                                                <td>
                                                    <input type="" name="" value="5.00 $" class="theme-input" style="width: 50%" disabled>

                                                </td>

                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            jQuery(document).on('change','.country',function () {
                getWithdrawType();
            });
            console.log('jkhkhkuhfuksheukdfhsuhfushufhdhjshjk')



            function getWithdrawType() {




                $.ajax({
                    type: 'GET',
                    url:'/wallet/choose_receive_type/',
                    dataType: 'json',      //return data will be json
                    success: function (type) {
                        console.log('successsuccesssuccesssuccess');

                        $('select[name="withdrawType"]').empty();
                        $.each(type, function(key, value) {

                            $('select[name="withdrawType"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });

                    },
                    error: function () {
                        console.log('false');


                    }
                });
            }


            jQuery(document).on('change','.withdrawType',function () {
                getWithdrawAgency();
            });
            console.log('jkhkhkuhfuksheukdfhsuhfushufhdhjshjk')



            function getWithdrawAgency() {

                var country_id = $(".country option:selected").val();
                var e = document.getElementById("withdrawType");
                var trans_type_id  =  e.options[e.selectedIndex].text;



                $.ajax({
                    type: 'GET',
                    url:'/wallet/list_receiving_agencies_by_c_type/'+ country_id + '/' + trans_type_id ,

                    dataType: 'json',      //return data will be json
                    success: function (receivingAgencies) {
                        console.log('successsuccesssuccesssuccess');

                        $('select[name="Agency"]').empty();
                        $.each(receivingAgencies, function(key, value) {

                            $('select[name="Agency"]').append('<option value="'+ value.id +'">'+ value.id +'</option>');
                        });

                    },
                    error: function () {
                        console.log('false');


                    }
                });
            }




        });
    </script>
@endsection
