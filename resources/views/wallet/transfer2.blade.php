@extends('wallet.index')
@section('content')
    <section>
        <div class="card m-5 ">


            <div class="card-body table-responsive style-card-body-tabs">

                <ul class="nav nav-custom nav-tabs style-card-body-tabs-links  nav-line-tabs nav-line-tabs-2x border-0 ">

                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-bs-toggle="tab"
                           href="#kt_Tab_Transfer_money_around_world">
                            تحويل الأموال حول العالم
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active style-table-nav-link" data-bs-toggle="tab"
                           href="#kt_Tab_Transfer_between_wallets">
                            التحويل بين المحافظ
                        </a>
                    </li>
                </ul>


            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show" id="kt_Tab_Transfer_money_around_world" role="tabpanel">
                <div class="card m-5 ">
                    <div class="row ">
                        <div class="col-md-12 ">
                            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    قم بتحويل الاموال لأحبائك لأي مكان في العالم
                                                </span>
                                </h1>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="" id="form_data" action="#">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-4 my-3">
                                        <label class="style-label-form ">{{trans('lang.Iam-transferring-money-to')}} </label>
                                        <select class="form-select form-select style-select-profile style-label-form  "
                                                data-control="select2" data-placeholder="اختر الدولة"
                                                name="country_id" id="form_country_id"
                                        >
                                            <option></option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 my-3">
                                        <label class="style-label-form">المبلغ المرسل</label>
                                        <input class="form-control" type="number" min="1" id="form_amount"
                                               onchange="updateAmount()"
                                               name="amount" value="0" placeholder="write the amount">
                                        <input type="hidden" name="is_amount_fixed" id="is_amount_fixed" value="1">
                                    </div>
                                    <div class="col-md-2 my-3">
                                        <label class="style-label-form">العملة</label>
                                        <select data-control="select2" data-placeholder="USD"
                                                name="currency_select"
                                                id="currency_select"
                                                class="form-select style-select-profile style-label-form ">
                                            <option></option>
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}">{{$currency->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 my-3">
                                        <label class="style-label-form ">{{trans('lang.receiving-method')}}</label>
                                        <select class="form-select form-select style-select-profile style-label-form  "
                                                data-control="select2" data-placeholder="طريقة الاستلام"
                                                id="form_receiving_mode" name="receiving_mode"
                                        >
                                            <option></option>
                                            <option value="1">نقد</option>
                                            <option value="2">محفظة الكترونية</option>

                                        </select>
                                    </div>
                                    <div class="d-flex flex-row col-md-6" id="MyBtnSales">
                                        <div class="col-md-4  my-3">
                                            <label class="style-label-form "></label>
                                            <button type="button" onclick="ClickFixedPrice(this)" id="fixedPrice"
                                                    class="form-control btn-style-Transger-sale2  btn-style-Transger-sale">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z"
                                                          stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                    <path d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11"
                                                          stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                <span class="px-1"
                                                      style="font-family:almarai!important;">  السعر الثابت</span>
                                            </button>
                                        </div>
                                        <div class="col-md-4 my-3">
                                            <label class="style-label-form "></label>
                                            <button type="button" onclick="ClickFixedPriceChange(this)"
                                                    id="fixedPriceChange"
                                                    class="form-control btn-style-Transger-sale2">
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z"
                                                          stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                    <path d="M7 11.0002V7.00015C6.99876 5.7602 7.45828 4.56402 8.28938 3.64382C9.12047 2.72362 10.2638 2.14506 11.4975 2.02044C12.7312 1.89583 13.9671 2.23406 14.9655 2.96947C15.9638 3.70488 16.6533 4.785 16.9 6.00015"
                                                          stroke-width="2" stroke-linecap="round"
                                                          stroke-linejoin="round"/>
                                                </svg>
                                                <span class="px-1">السعر المتغير </span>
                                            </button>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4 my-3">
                                        <label class="style-label-form ">{{trans('lang.agency')}}</label>
                                        <select class="form-select form-select style-select-profile style-label-form  "
                                                data-control="select2" data-placeholder="اختر الوكالة"
                                                name="transfer_agency_id" id="formtransfer_agency_id">
                                            <option></option>
                                        </select>
                                    </div>
                                    <div class="col-md-3 my-3">

                                        <label class="style-label-form "></label>
                                        <div class="pt-4" id="btnFixedPrice" style="display: block;">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z"
                                                      stroke="#454545" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M7 11V7C7 5.67392 7.52678 4.40215 8.46447 3.46447C9.40215 2.52678 10.6739 2 12 2C13.3261 2 14.5979 2.52678 15.5355 3.46447C16.4732 4.40215 17 5.67392 17 7V11"
                                                      stroke="#454545" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                            <span class="px-1 fixedPriceValue"
                                                  style="font-family:almarai!important;""></span>
                                        </div>
                                        <div class="pt-4" id="btnFixedPriceChange" style="display: none;">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19 11H5C3.89543 11 3 11.8954 3 13V20C3 21.1046 3.89543 22 5 22H19C20.1046 22 21 21.1046 21 20V13C21 11.8954 20.1046 11 19 11Z"
                                                      stroke="#454545" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                <path d="M7 11.0002V7.00015C6.99876 5.7602 7.45828 4.56402 8.28938 3.64382C9.12047 2.72362 10.2638 2.14506 11.4975 2.02044C12.7312 1.89583 13.9671 2.23406 14.9655 2.96947C15.9638 3.70488 16.6533 4.785 16.9 6.00015"
                                                      stroke="#454545" stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                            <span class="px-1 fixedPriceValue"
                                                  style="font-family:almarai!important;"></span>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-4 my-3">
                                        <label class="style-label-form">{{trans('lang.our-fees')}}</label>
                                        <input class="form-control" type="number" id="form_fee" min="1"
                                               value="@if(!empty(auth()->user()->document()) && auth()->user()->document()->status == 1){{(double)$transfer_setting['verified_account_fee']}}@else{{(double)$transfer_setting['unverified_account_fee']}}@endif"
                                               placeholder="" disabled>
                                    </div>
                                    <div class="col-md-2 my-3">
                                        <label class="style-label-form">تحصل على ما يقرب</label>
                                        <input type="text" class="form-control" id="amountPlusTransferFee" value="0"
                                               disabled/>
                                    </div>
                                    <div class="col-md-2 my-3 d-none">
                                        <label class="style-label-form">العملة</label>
                                        <select data-control="select2" data-placeholder="ETH"
                                                data-hide-search="true"
                                                class="form-select style-select-profile style-label-form  ">
                                            <option></option>
                                            <option value="1">LIS</option>
                                            <option value="2">ETH</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 my-3">
                                        <button type="button" id="show_first_model"
                                                class="form-control BntAdd-Modal">حول أموالك بكل أمان
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <div class="modal fade" id="detail" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-450px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!--begin::Modal title-->
                                            <h2 class="fw-bolder style-Address-Modal">
                                                <svg width="24" height="24" viewBox="0 0 34 34" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="17" cy="17" r="17" fill="#3ABE32"/>
                                                    <path d="M17 9C18.0609 9 19.0783 9.42143 19.8284 10.1716C20.5786 10.9217 21 11.9391 21 13C21 14.0609 20.5786 15.0783 19.8284 15.8284C19.0783 16.5786 18.0609 17 17 17C15.9391 17 14.9217 16.5786 14.1716 15.8284C13.4214 15.0783 13 14.0609 13 13C13 11.9391 13.4214 10.9217 14.1716 10.1716C14.9217 9.42143 15.9391 9 17 9ZM17 19C21.42 19 25 20.79 25 23V25H9V23C9 20.79 12.58 19 17 19Z"
                                                          fill="white"/>
                                                </svg>
                                                <span class="px-1">  بيانات المستلم</span>
                                            </h2>
                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div data-bs-dismiss="modal" aria-label="Close"
                                                 data-kt-users-modal-action="close">
                                                <i class="fas fa-times  style-icon-Close-Modal"></i>

                                            </div>
                                            <!--end::Close-->
                                        </div>


                                        <div class="modal-body scroll-y ">
                                            <form class="form" action="#">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-12 my-3">
                                                            <label class="style-label-form">اسم المستلم</label>
                                                            <input type="text" class="form-control"
                                                                   id="form_receiver_name" name="receiver_name"/>
                                                        </div>
                                                        <div class="col-md-12 my-3">
                                                            <label class="style-label-form">رقم الهاتف</label>
                                                            <input type="text" class="form-control"
                                                                   id="form_receiver_phone" name="receiver_phone"/>
                                                        </div>
                                                        <div class="col-md-12 my-3">
                                                            <label class="style-label-form">عنوان المستلم</label>
                                                            <input type="text" class="form-control"
                                                                   id="form_receiver_address" name="receiver_address"/>
                                                        </div>
                                                        <div class="col-md-12 my-3">
                                                            <label class="style-label-form">البريد الالكتروني</label>
                                                            <input type="email" class="form-control"
                                                                   id="form_receiver_email" name="receiver_email"/>
                                                        </div>
                                                        <div class="col-md-12 my-3">
                                                            <label class="style-label-form">رقم الحساب </label>
                                                            <input type="text" class="form-control"
                                                                   id="form_receiver_acc_number"
                                                                   name="receiver_acc_number"/>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal-footer flex-center">
                                                    <button type="button" class="btn BntAdd-Modal" id="show_model">
                                                        ارسال طلب التحويل
                                                    </button>
                                                    <button type="reset" class="btn BntAdd-Modal-close"
                                                            data-bs-dismiss="modal"
                                                            aria-label="Close"
                                                            style="font-weight:600!important;;font-family:almarai!important;color:#fff;background-color:#262626;">
                                                        إغلاق
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>


                    </div>
                </div>
            </div>

            <div class="tab-pane fade show active" id="kt_Tab_Transfer_between_wallets" role="tabpanel">
                <div class="card m-5 ">
                    <div class="row ">
                        <div class="col-md-12 ">
                            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    التحويل من محفظة الى محفظة اخرى
                                                </span>
                                </h1>

                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <form method="POST" id="transfer_to_wallet_form" action="{{route('transfer_to_wallet')}}">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-5 my-3">
                                        <label class="style-label-form">رقم المحفظة</label>
                                        <input type="text" class="form-control " id="wallet_number"
                                               name="wallet_number"/>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-3 my-3">
                                        <label class="style-label-form">المبلغ</label>
                                        <div class="input-group">
                                            <input type="text" class="style-input-radiuse form-control "
                                                   id="wallet_trans_amount" name="wallet_trans_amount" onchange="updateTranTotalAmount()"/>
                                            <span class="input-group-text text-white style-select-profile-curreny"
                                                  id="basic-addon2">
                                                            USD
                                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 my-3">
                                        <label class="style-label-form">مبلغ العمولة </label>
                                        <input type="text" class="form-control" id="cus_fee" name="cus_fee" 
                                               value="@if(!empty(auth()->user()->document()) && auth()->user()->document()->status == 1){{(double)$transfer_setting['verified_account_fee']}}@else{{(double)$transfer_setting['unverified_account_fee']}}@endif"
                                               placeholder="" disabled/>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-5 my-3">
                                        <label class="style-label-form">المبلغ
                                            الاجمالي</label>
                                        <div class="input-group">
                                            <input type="text"
                                                   class="style-input-radiuse form-control" id="total_amount" name="total_amount" readonly/>
                                            <span class="input-group-text text-white style-select-profile-curreny"
                                                  id="basic-addon2">
                                                                                                USD
                                                                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div id="IDShowWithTransferProduct">
                                    <div class="row">
                                        <div class="col-md-5 my-3">
                                            <label class="style-label-form">كود المنتج</label>
                                            <div class="input-group">
                                                <input type="text" class="style-input-radiuse form-control "/>
                                                <span class="input-group-text text-white  style-select-profile-Days"
                                                      style="font-family:Almarai!important;" id="basic-addon2">
                                                                <select name="role" data-control="select2"
                                                                        data-placeholder="1 يوم" data-hide-search="true"
                                                                        class="form-select style-select-profile-Days-select style-select-profile style-label-form  ">
                                                                    <option></option>
                                                                    <option value="1">1 يوم</option>
                                                                    <option value="2">2 يوم</option>
                                                                </select>
                                                            </span>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5 my-3">
                                            <label class="style-label-form">تعليق</label>
                                            <input type="text" placeholder="لا يوجد" class="form-control"/>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-5 my-3">
                                        <button type="button" class="btn style-btn-line-show text-center"
                                                id="BtnClickShow" onclick="clickShow()">
                                            <svg width="340" class="style-svg-line-btn" height="2" viewBox="0 0 95 2"
                                                 fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <line y1="1" x2="95" y2="1" stroke="#898989" stroke-width="2"
                                                      stroke-dasharray="8 8"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-5 my-3">
                                        <button type="button" id="show_trans_wallet_modal"
                                                class="form-control Style-btn-next-form">حول الان
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <!--begin::Modal title-->


                            <!--begin::Modal title-->
                            <div class="modal fade" id="wallet_trans_model_operation" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-450px">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <!--begin::Modal title-->
                                            <div>
                                                <h2 class="fw-bolder style-Address-Modal">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                                                        <path d="M16.3068 8.76953L10.3837 14.6926L7.69141 12.0003"
                                                              stroke="white"
                                                              stroke-width="2" stroke-linecap="round"
                                                              stroke-linejoin="round"/>
                                                    </svg>

                                                    <span class="px-1">تفاصيل العملية </span>
                                                </h2>
                                                <h2 class="pt-1">
                                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39"
                                                                stroke-width="1.5"/>
                                                        <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                                              fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                                        <path d="M7.5 11.1112V6.05566" stroke="#E51C39"
                                                              stroke-width="1.5"/>
                                                    </svg>
                                                    <span class="style-bio-Modal-trasfer">تنبيه! الرجاء الإطلاع على هذه البيانات للتاكد من المدخلات</span>
                                                </h2>
                                            </div>


                                            <!--end::Modal title-->
                                            <!--begin::Close-->
                                            <div data-bs-dismiss="modal" aria-label="Close"
                                                 data-kt-users-modal-action="close">
                                                <i class="fas fa-times  style-icon-Close-Modal"></i>
                                            </div>
                                            <!--end::Close-->
                                        </div>


                                        <div class="modal-body scroll-y ">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">

                                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم
                                                                العملية
                                                            </div>

                                                            <div class="text-end style-row-Invouce-text">3</div>

                                                        </div>
                                                    </div>
                                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم
                                                                المحفظة
                                                            </div>
                                                            <div class="text-end style-row-Invouce-text"
                                                                 id="wallet_trans_info_wallet">P1235677945
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ
                                                            </div>
                                                            <div class="text-end style-row-Invouce-text"><span
                                                                        id="wallet_trans_info_amount"></span> دولار
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">--}}
                                                    {{--                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">--}}
                                                    {{--                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">عمولة التحويل</div>--}}
                                                    {{--                                            <div class="text-end style-row-Invouce-text">7$</div>--}}
                                                    {{--                                        </div>--}}
                                                    {{--                                    </div>--}}
                                                    {{--                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">--}}
                                                    {{--                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">--}}
                                                    {{--                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ الاجمالي</div>--}}
                                                    {{--                                            <div class="text-end style-row-Invouce-text">47 دولار</div>--}}
                                                    {{--                                        </div>--}}
                                                    {{--                                    </div>--}}
                                                </div>
                                                <div class="col-md-12 mt-5">
                                                    <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               value=""
                                                               id="flexCheckDefault"/>
                                                        <label class="form-check-label style-label-form"
                                                               for="flexCheckDefault">
                                                            جميع بياناتي السابقة صحيحة
                                                        </label>
                                                    </span>
                                                    </h1>
                                                </div>
                                            </div>


                                            <div class="modal-footer row flex-center">
                                                <button type="submit" id="transfer_to_wallet_btn"
                                                        class="btn col-md-12  BntAdd-Modal">
                                                    تأكيد
                                                </button>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>

        </div>


        <!--begin::Modal title-->

        <div class="modal fade" id="kt_modal_Transfer_Warranty" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-450px">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <div>
                            <h2 class="fw-bolder style-Address-Modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                                    <path d="M16.3068 8.76953L10.3837 14.6926L7.69141 12.0003" stroke="white"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span class="px-1">تفاصيل العملية </span>
                            </h2>
                            <h2 class="pt-1">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.5 11.1112V6.05566" stroke="#E51C39" stroke-width="1.5"/>
                                </svg>
                                <span class="style-bio-Modal-trasfer">تنبيه! الرجاء الإطلاع على هذه البيانات للتاكد من المدخلات</span>
                            </h2>
                        </div>


                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>


                    <div class="modal-body scroll-y ">
                        <form class="form" action="#">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">

                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم العملية</div>

                                            <div class="text-end style-row-Invouce-text">3</div>

                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم المحفظة</div>
                                            <div class="text-end style-row-Invouce-text">P1235677945</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ</div>
                                            <div class="text-end style-row-Invouce-text">40 دولار</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">عمولة التحويل</div>
                                            <div class="text-end style-row-Invouce-text">7$</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ الاجمالي</div>
                                            <div class="text-end style-row-Invouce-text">47 دولار</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               value=""
                                                               id="flexCheckDefault"/>
                                                        <label class="form-check-label style-label-form"
                                                               for="flexCheckDefault">
                                                            جميع بياناتي السابقة صحيحة
                                                        </label>
                                                    </span>
                                    </h1>
                                </div>
                            </div>


                            <div class="modal-footer row flex-center">
                                <button type="submit" onclick="Clicksuccesmoneytransfer()"
                                        class="btn col-md-12  BntAdd-Modal">
                                    تأكيد
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>


        <!--begin::Modal title-->

        <div class="modal fade" id="model_operation" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-450px">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <div>
                            <h2 class="fw-bolder style-Address-Modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                                    <path d="M16.3068 8.76953L10.3837 14.6926L7.69141 12.0003" stroke="white"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span class="px-1">تفاصيل العملية </span>
                            </h2>
                            <h2 class="pt-1">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.5 11.1112V6.05566" stroke="#E51C39" stroke-width="1.5"/>
                                </svg>
                                <span class="style-bio-Modal-trasfer">تنبيه! الرجاء الإطلاع على هذه البيانات للتاكد من المدخلات</span>
                            </h2>
                        </div>


                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>


                    <div class="modal-body scroll-y ">
                        <form class="form" action="#">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">

                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم العملية</div>

                                            <div class="text-end style-row-Invouce-text">3</div>

                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">انا احول إلى</div>
                                            <div class="text-end style-row-Invouce-text" id="info_transfer_country">
                                                الصحراء الغربية
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">طريقة التسليم</div>
                                            <div class="text-end style-row-Invouce-text" id="info_transfer_type">كاش
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">عمولة التحويل</div>
                                            <div class="text-end style-row-Invouce-text" id="info_transfer_commission">
                                                7$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ المرسل</div>
                                            <div class="text-end style-row-Invouce-text" id="info_transfered_money">47
                                                دولار
                                            </div>
                                        </div>
                                    </div>
                                    {{--                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">--}}
                                    {{--                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">--}}
                                    {{--                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ المستلم</div>--}}
                                    {{--                                            <div class="text-end style-row-Invouce-text" id="info_rec_money"> 475.5569165 ETH</div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="col-md-12 mt-5">
                                    <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               value=""
                                                               id="flexCheckDefault"/>
                                                        <label class="form-check-label style-label-form"
                                                               for="flexCheckDefault">
                                                            جميع بياناتي السابقة صحيحة
                                                        </label>
                                                    </span>
                                    </h1>
                                </div>
                            </div>


                            <div class="modal-footer row flex-center">
                                <button type="button" id="save-form"
                                        class="btn col-md-12  BntAdd-Modal">
                                    تأكيد
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>


        <!--begin::Modal title-->

        <div class="modal fade" id="kt_modal_Transfer_agent_account" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-450px">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <div>
                            <h2 class="fw-bolder style-Address-Modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                                    <path d="M16.3068 8.76953L10.3837 14.6926L7.69141 12.0003" stroke="white"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span class="px-1">تفاصيل العملية </span>
                            </h2>
                            <h2 class="pt-1">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.5 11.1112V6.05566" stroke="#E51C39" stroke-width="1.5"/>
                                </svg>
                                <span class="style-bio-Modal-trasfer">تنبيه! الرجاء الإطلاع على هذه البيانات للتاكد من المدخلات</span>
                            </h2>
                        </div>


                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>


                    <div class="modal-body scroll-y ">
                        <form class="form" action="#">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">

                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم العملية</div>

                                            <div class="text-end style-row-Invouce-text">3</div>

                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم المحفظة</div>
                                            <div class="text-end style-row-Invouce-text">P1235677945</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ</div>
                                            <div class="text-end style-row-Invouce-text">40 دولار</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">عمولة التحويل</div>
                                            <div class="text-end style-row-Invouce-text">7$</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">المبلغ الاجمالي</div>
                                            <div class="text-end style-row-Invouce-text">47 دولار</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               value=""
                                                               id="flexCheckDefault"/>
                                                        <label class="form-check-label style-label-form"
                                                               for="flexCheckDefault">
                                                            جميع بياناتي السابقة صحيحة
                                                        </label>
                                                    </span>
                                    </h1>
                                </div>
                            </div>


                            <div class="modal-footer row flex-center">
                                <button type="submit" onclick="Clicksuccesmoneytransfer()"
                                        class="btn col-md-12  BntAdd-Modal">
                                    تأكيد
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section("custom_js")



    <script type="text/javascript">

        // var btns = header.getElementsByClassName("btn-style-Transger-sale2");
        // for (var i = 0; i < btns.length; i++) {
        //     btns[i].addEventListener("click", function () {
        //         var current = document.getElementsByClassName("btn-style-Transger-sale");
        //         current[0].className = current[0].className.replace("  btn-style-Transger-sale", "");
        //         this.className += "  btn-style-Transger-sale";
        //     });
        // }

        // var btnFixedPrice = document.getElementById("btnFixedPrice");
        var btnFixedPriceChange = document.getElementById("btnFixedPriceChange");


        //var BtnClickShow2 = document.getElementById("BtnClickShow2");

        // btnFixedPrice.style.display = "block";
        // btnFixedPriceChange.style.display = "none";

        function ClickFixedPriceChange() {
            $('#fixedPriceChange').addClass('btn-style-Transger-sale')
            $('#fixedPrice').removeClass('btn-style-Transger-sale')
            document.getElementById("btnFixedPriceChange").style.display = "block";
            document.getElementById("btnFixedPrice").style.display = "none";
            $('#is_amount_fixed').val(0)
            getExchange()
        }

        function ClickFixedPrice() {
            $('#fixedPrice').addClass('btn-style-Transger-sale')
            $('#fixedPriceChange').removeClass('btn-style-Transger-sale')
            document.getElementById("btnFixedPrice").style.display = "block";
            document.getElementById("btnFixedPriceChange").style.display = "none";
            $('#is_amount_fixed').val(1)
            getExchange()
        }

        // $('#currency_select').change(function() {
        //     getExchange()
        // });

        $('#clickBtnTest').click(function (e) {
            e.preventDefault();
            console.log('here')
        })
        $('#show_trans_wallet_modal').click(function (e) {
            console.log('clicked')
            var wallet_number = $("#wallet_number").val();
            var wallet_trans_amount = $("#wallet_trans_amount").val();
            console.log(wallet_number)

            if (wallet_number != "" && wallet_trans_amount != "") {
                $('#wallet_trans_model_operation').modal('show');
                $("#wallet_trans_info_wallet").html(wallet_number);
                $("#wallet_trans_info_amount").html(wallet_trans_amount);
            } else {
                showErrorModal('يجب إدخال رقم المحفظة والمبلغ')
            }
        });

        $(document).ready(function ($) {
            $(document).on('change', '#currency_select', function () {
                getExchange()
            });
        });

        function getExchange() {
            var currency_select = $('#currency_select').find('option:selected').text()
            if (currency_select == '') {
                currency_select = 'USD'
            }
            $.easyAjax({
                url: '{{route('getExchange')}}',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "amount": $('#form_amount').val(),
                    "is_fixed": $('#is_amount_fixed').val(),
                    "currency_code": currency_select,
                },
                success: function (response) {
                    $('.fixedPriceValue').text(response.value)
                }
            })
        }

        function updateAmount() {
            // var agency_id = $("#form_agency_id").val();
            var amount = $("#form_amount").val();
            var form_fee = $('#form_fee').val();
            $("#info_amount").text(amount);

            if (parseFloat(amount) <= 0) {
                result = 0
            } else {
                result = parseFloat(amount)
                    + (parseFloat(amount) * parseFloat(form_fee));
            }

            // var result = amount + (amount * form_fee)
            $('#amountPlusTransferFee').val(result)
            $('#info_transfered_money').text(result)
            getExchange()
        }

        function updateTranTotalAmount(){
            var wallet_trans_amount = $("#wallet_trans_amount").val();
            var cus_fee = $('#cus_fee').val();
            $("#info_amount").text(wallet_trans_amount);

            var result = 0;
            if (parseFloat(wallet_trans_amount) <= 0 || wallet_trans_amount == undefined || wallet_trans_amount == null) {
                result = 0
            } else {
                result = parseFloat(wallet_trans_amount)
                    + ((parseFloat(wallet_trans_amount) * parseFloat(cus_fee))/100);
            }

            // var result = amount + (amount * form_fee)
            $('#total_amount').val(result)
        }
        
        $('#show_first_model').click(function (e) {

            var form_country_id = $('#form_country_id').find('option:selected').val();
            var formtransfer_agency_id = $('#formtransfer_agency_id').find('option:selected').attr("transfer_fee");
            var amount = $("#form_amount").val();


            if (form_country_id > 0 && formtransfer_agency_id > 0) {
                if (amount > 0)
                    $('#detail').modal('show');
                else {
                    showErrorModal('يجب تحديد المبلغ المراد تحويله')
                }
            } else {
                showErrorModal('يجب تحديد الدولة و الوكالة')
            }
        });


        $('#show_model').click(function (e) {


            var form_receiver_acc_number = $("#form_receiver_acc_number").val();
            var form_receiver_address = $("#form_receiver_address").val();
            var form_receiver_phone = $("#form_receiver_phone").val();
            var form_receiver_name = $("#form_receiver_name").val();

            if (form_receiver_acc_number != "" && form_receiver_address != "" && form_receiver_name != "") {
                $('#detail').modal('hide');
                $('#model_operation').modal('show');
                $("#info_receiver_name").html($("#form_receiver_name").val());
                $("#info_receiver_phone").html($("#form_receiver_phone").val());
                $("#info_receiver_address").html($("#form_receiver_address").val());
                $("#info_receiver_email").html($("#form_receiver_email").val());
                $("#info_receiver_acc_number").html($("#form_receiver_acc_number").val());
                $("#info_amount").html($("#form_amount").val());
            } else {
                showErrorModal('يجب تحديد اسم وعنوان ورقمالهاتف و الحساب للمستلم')
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
                $.easyAjax({
                    url: '{{route('confirm_transfer_order')}}',
                    container: '#form_data',
                    type: "POST",
                    redirect: true,
                    data: $('#form_data').serialize(),
                    beforeSend: function () {
                        $("#save-form").attr("disabled", true);
                        $("#save-form").text("{{cp('wait_process_to_finish')}}");
                    },
                    complete: function (xhr, status) {
                        $("#save-form").attr("disabled", true);
                        $("#save-form").text("{{cp('confirm')}}");
                    },
                    success: function (response) {
                        console.log(response)
                        if (response.success == false) {
                            // $.toast({
                            //     heading: "error",
                            //     position: {
                            //         right: 10,
                            //         top: 10
                            //     },
                            //     text: response.message,
                            //     icon: 'error'
                            // });
                            showErrorModal(response.message)

                        } else {
                            // $.toast({
                            //     heading: "success",
                            //     position: {
                            //         right: 10,
                            //         top: 10
                            //     },
                            //     text: response.message,
                            //     icon: 'success'
                            // });
                            $('#model_operation').modal('hide')
                            showSuccessModal(response.message)
                            location.replace("{{route("list_deposit_withdraws")}}" + "#deposit_requests_tab")
                        }


                    }, error: function (error) {
                        $("#save-form").prop("disabled", false);
                    }, custom_error: function () {
                        $("#save-form").prop("disabled", false);
                    }


                })
            });

        });

        $(document).on("change", '#form_country_id', function () {
            // $('#customCheck').attr('checked', false);
            // $("#form_receiving_mode_span").html();
            // $("#form_receiving_mode").val("");
            // $("#info_country").html($(this).html());
            var amount = $("#form_amount").val();
            $("#info_amount").text(amount);
            var country_id = $(this).attr("id");
            $('#info_transfer_country').text($('#form_country_id').find('option:selected').text());
            $.easyAjax({
                url: "{{route('chooseReceivingTypes')}}",
                type: "get",
                data: {"country_id": country_id},
                success: function (response) {
                    {{--location.replace("{{route("wallet.my_accounts")}}")--}}
                    $('#form_receiving_mode').empty()
                    // var options = "";
                    var newOption = new Option('', '', true, true);
                    $('#form_receiving_mode').append(newOption);

                    response.forEach(function (element) {
                        var newOption = '<option value="' + element + '">' + element + '</option>';

                        $('#form_receiving_mode').append(newOption);
                    });
                    // $("#ul_receiving_mode").html(options);
                    // console.log(response);
                }
            })

        });
        $(document).on("change", '#formtransfer_agency_id', function () {
            $("#info_agency_name").html($(this).html());
            let tf = $('#formtransfer_agency_id').find('option:selected').attr("transfer_fee")
            $('#info_transfer_commission').text(tf + '$');
            $("#info_fees").text(tf);
            $("#form_fee").val(tf);

        });

        $(document).on("change", '#form_receiving_mode', function () {
            // var country_id = $("#form_country_id").val();
            var country_id = $('#form_country_id').find('option:selected').val();

            var ty = $('#form_receiving_mode').find('option:selected').text()
            var info_transfer_type = ''
            if (ty == 'cash') {
                info_transfer_type = 'كاش';
            } else if (ty == 'wallet') {
                info_transfer_type = 'محفظة الكترونية';
            }
            $('#info_transfer_type').text(info_transfer_type);
            var trans_type = $(this).val();
            console.log(trans_type)
            var url = '{!! route('list_receiving_agencies_by_c_type', [':country_id',':trans_type']) !!}';
            url = url.replace(':trans_type', trans_type);
            url = url.replace(':country_id', country_id);
            console.log(url)
            $.easyAjax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    var options = "";
                    $('#formtransfer_agency_id').empty()
                    // var options = "";
                    var newOption = new Option('', '', true, true);
                    $('#formtransfer_agency_id').append(newOption);

                    response.forEach(function (element) {
                        var newOption = '<option value="' + element.id + '" ' +
                            'transfer_fee="' + element.transfer_fee + '" ' +
                            '>' + element.agency_name + '</option>';

                        $('#formtransfer_agency_id').append(newOption);
                    });

                    // $("#ul_transfer_agency_id").html(options);
                    // console.log(response);
                }
            })

        });


        $('#transfer_to_wallet_form').submit(function (event) {
            //transfer_to_wallet_form
            event.preventDefault();
            let form = $(this);
            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: $(form).serialize(),
                beforeSend: function (xhr) {
                    $('#transfer_to_wallet_btn').attr('disabled', true)
                },
                complete: function (xhr, status) {
                    $('#transfer_to_wallet_btn').attr('disabled', false)
                    $('#wallet_trans_model_operation').modal('hide')
                },
                success: function (res) {
                    if (res.success) {
                        showSuccessModal(res.message)
                        window.location.reload()
                    } else {
                        showErrorModal(res.message)
                    }
                },
                error: function (xhr, status, message) {
                    if (xhr.status === 422) {
                        let response = $.parseJSON(xhr.responseText);
                        $.each(response.errors, function (key, value) {
                            showErrorModal(value[0])
                        });
                    }
                }
            });
        })
    </script>
@endsection