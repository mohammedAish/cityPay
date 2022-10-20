@extends('wallet.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-user"></i>اضافة حساب مالي :</h2>
            <br>
            <h5 style="color: grey">تعديل بيانات الحساب   </h5>
        </div>
        <div class="profile-page-area clearfix">
            <div class="profile-page-area-main row col-md-12">

                <div class="profile-information-right col-md-6">
                    <div class="profile-information-box ">

                        <section>
                            <div class="inner ">
                                <div class="form-row form-row-date">

                                    <h2 style="margin-top: 20px; margin-right: 10px;">

                                        <span class="step-icon "><i class="zmdi zmdi-city"></i></span>
                                        <span class="step-text ">الدولة : </span>


                                    </h2>

                                    <div class="form-holder form-holder-2 col-md-9">


                                        <select name="country" id="country" style="display: inline-block">
                                            <option value="Month" disabled selected>اليمن</option>
                                            <option value="Feb">اليمن</option>
                                            <option value="Mar">مصر</option>
                                            <option value="Apr">الجزائر</option>
                                            <option value="May">السعودية</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </section>
                        <section>
                            <div class="inner ">
                                <div class="form-row form-row-date">

                                    <h2 style="margin-top: 20px; margin-right: 10px;">

                                        <span class="step-icon "><i class="zmdi zmdi-money-box"></i></span>
                                        <span class="step-text ">نوع الحساب  : </span>


                                    </h2>

                                    <div class="form-holder form-holder-2 col-md-9">


                                        <select name="country" id="country"  style="display: inline-block">
                                            <option value="Month" disabled selected> بنك الكتروني </option>
                                            <option value="Feb">حوالات اكسبرس</option>
                                            <option value="Mar"> بنك مصرفي</option>
                                            <option value="Apr">بنك الكنروني</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </section>
                        <section>
                            <div class="inner ">
                                <div class="form-row form-row-date">

                                    <h2 style="margin-top: 20px; margin-right: 10px;">

                                        <span class="step-icon "><i class="zmdi zmdi-card"></i></span>
                                        <span class="step-text ">اسم البنك  : </span>


                                    </h2>

                                    <div class="form-holder form-holder-2 col-md-9">


                                        <select name="country" id="country"  style="display: inline-block">
                                            <option value="" disabled selected> كاك بنك </option>
                                            <option value="">


                                                CAC bank

                                            </option>
                                            <option value="">البنك الأسلامي</option>
                                            <option value="">البنك التجاري</option>
                                            <option value="">بنك اليمن والكويت</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </section>


                    </div>


                </div>
                <div class="bank_box profile-information-right col-md-6">

                    <div class="text-center">
                        <img src="{{asset('org_assets/dist/img/wizardimages/cacbank.png')}}" alt="Loader" class="wizardimg mx-auto d-block">
                        <br>

                        <div class="theme-input-box">
                            <label><h3>
                                    تعديل رقم الحساب
                                </h3>
                            </label>
                            <input type="" name="" value="0116465534685" class="theme-input">
                        </div>
                    </div>
                </div>
                <div class="profile-btn">
                    <button class="theme-btn">تعديل</button>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

@endsection
