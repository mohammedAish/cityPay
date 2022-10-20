@extends('wallet.index')
@section('content')

    <section>
        <div class="card m-5 ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                        <span class="fw-bolder mb-2 text-dark">
                                            {{cp('deposit')}}
                                        </span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <form method="" id="form_data" action="#" autocomplete="off">
                            @csrf
                            <div class="col-md-10 my-2">
                                <label class=" style-label-form ">{{cp('select_account')}}</label>
                                <input type="text" class="form-control"
                                       value="{{auth()->user()->wallet_code_symbol}}" disabled/>
                            </div>
                            <div class="col-md-10 my-2">
                                <label class=" style-label-form ">{{cp('deposit_system')}}</label>
                                <input type="hidden" name="deposit_method" value="cash" id="deposit_method">
                                {{--                                <input type="hidden" name="min_deposit_amount" value="" id="min_deposit_amount">--}}
                                {{--                                <input type="hidden" name="max_deposit_amount" value="" id="max_deposit_amount">--}}
                                <select name="deposit_type" data-control="select2"
                                        data-placeholder="{{cp('deposit_system_placeholder')}}" data-hide-search="true"
                                        class="form-select style-select-profile style-label-form " id="deposit_type">
                                    <option></option>
                                    @foreach($deposit_types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-10 my-2">
                                <label class=" style-label-form ">{{cp('agency')}}</label>
                                <input type="hidden" required="" value="" id="deposit_agency_id"
                                       name="deposit_agency_id">
                                <select name="agency_section" data-control="select2"
                                        data-placeholder="{{cp('select_agency')}}"
                                        data-hide-search="true"
                                        id="agency_section"
                                        class="form-select  style-select-profile style-label-form">
                                    <option></option>
                                    {{--                                <option value="1">النجم اكسبرس</option>--}}
                                    {{--                                <option value="2">اكسبرس موني</option>--}}
                                    {{--                                <option value="3">الجزمي اكسبرس</option>--}}
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-5 my-2">
                                    <label class="style-label-form">{{cp('amount')}}</label>
                                    <input type="text" class="form-control" id="form_amount" name="amount"/>
                                </div>
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('currency')}}</label>
                                    {{--                                <input type="hidden" required value="" id="currency_id" name="currency_id">--}}
                                    <select name="currency_id" data-control="select2" id="currency_id"
                                            data-placeholder="{{cp('select_currency')}}"
                                            data-hide-search="true"
                                            class="form-select style-select-profile style-label-form ">
                                        <option></option>
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row d-none">
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('min_amount_withd')}}</label>
                                    <input type="text" class="form-control" value="" name="min_deposit_amount"
                                           id="min_deposit_amount" disabled/>
                                </div>
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('max_amount_withd')}}</label>
                                    <input type="text" class="form-control" value="" name="max_deposit_amount"
                                           id="max_deposit_amount" disabled/>
                                </div>
                            </div>
                            @include('wallet._master_key')
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <button type="button" id="show_model" class="form-control BntAdd-Modal"
                                            {{--                                        data-bs-toggle="modal" data-bs-target="#kt_modal_Coninfirem_Details"--}}
                                    >
                                        {{cp('confirm')}}
                                    </button>

                                </div>

                            </div>
                        </form>
                        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_account_number" id="info_agency_ytadawul_account_number"/>
                        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_account_name" id="info_agency_ytadawul_account_name"/>
                        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_phone" id="info_agency_ytadawul_phone"/>
                        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_address" id="info_agency_ytadawul_address"/>
                        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_account_name" id="info_agency_ytadawul_account_name"/>
                        <input type="hidden" class="form-control" value="" name="info_agency_name" id="info_agency_name"/>
                    </div>
                    <div class="col-md-6 style-respoinsive-hide-card">
                        <div class="card style-box-wallet-info">
                            <div class="p-3 py-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-sm-center mb-7">
                                            <!--begin::Symbol-->
                                            <!--end::Symbol-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                                <div class="flex-grow-1 ">
                                                    <h2 class="style-box-wallet-info-Big">
                                                        {!! cp('welcome_to_ctpay_wallet') !!}
                                                    </h2>


                                                    <p class="style-box-wallet-info-Big-Title-text">
                                                        {{cp('deposit_instructions_text')}}
                                                    </p>
                                                    <p class="style-box-wallet-info-Big-list-info-text">
                                                        {!! cp('deposit_instructions_description') !!}
                                                    </p>
                                                    <ul class=" style-box-wallet-info-Big-list-info">

                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white px-1"></i>
                                                            {{cp('deposit_instructions_step_1')}}
                                                        </li>
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white px-1"></i>
                                                        {{cp('deposit_instructions_step_2')}}
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white px-1"></i>
                                                            {{cp('deposit_instructions_step_3')}}
                                                        </li>
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white px-1"></i>
                                                            {{cp('deposit_instructions_step_4')}}
                                                        </li>
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white px-1"></i>
                                                            {{cp('deposit_instructions_step_5')}}
                                                        </li>

                                                    </ul>

                                                </div>
                                            </div>
                                            <div class=" symbol-md-160px style-image-Wallet symbol-sm-125px me-5">
                                                            <span class="symbol-label ">
                                                                <img src="/assets_v2/media/imagesWebsite/ImageCustomeWallet.png"
                                                                     class="img-fluid"/>
                                                            </span>
                                            </div>
                                            <!--end::Section-->
                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
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

                                <span class="px-1">{{cp('process_details')}}</span>
                            </h2>
                            <h2 class="pt-1">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.5 11.1112V6.05566" stroke="#E51C39" stroke-width="1.5"/>
                                </svg>
                                <span class="style-bio-Modal-trasfer">{{cp('process_details_description')}}</span>
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
                        <form class="form" action="#" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('process_number')}}</div>
                                            <div class="text-end style-row-Invouce-text">{{$process_number}}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('deposit_system')}}</div>
                                            <div class="text-end style-row-Invouce-text" id="modal_deposit_type"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount_to_deposited_into_wallet_in_dollars')}}
                                            </div>
                                            <div class="text-end style-row-Invouce-text" id="info_amount"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('deposit_commission')}}</div>
                                            <div class="text-end style-row-Invouce-text" id="our_deposit_fee"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount_to_be_paid_currency')}}
                                            </div>
                                            <div class="text-end style-row-Invouce-text">
                                                <span id="info_amount_currency"></span>
                                                <span id="info_selected_currency"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-5">
                                    <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               {{--                                                               value=""--}}
                                                               checked="false"
                                                               id="customCheck" required/>
                                                        <label class="form-check-label style-label-form"
                                                               for="customCheck">
                                                            {{cp('all_previous_information_correct')}}
                                                        </label>
                                                    </span>
                                    </h1>
                                </div>
                            </div>


                            <div class="modal-footer row flex-center">
                                <button type="submit" id="save-form"
                                        {{--                                        data-bs-toggle="modal"--}}
                                        class="btn col-md-12  BntAdd-Modal">
                                    {{cp('confirm')}}
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="kt_modal_success_operation" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-800px">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h2 class="fw-bolder style-Address-Modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                                    <path d="M16.3068 8.76953L10.3837 14.6926L7.69141 12.0003" stroke="white"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                                <span class="px-1">{{cp('process_data')}}</span>
                            </h2>
                        </div>

                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body scroll-y ">

                        <form method="" id="success_operation_form" action="#" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 my-2">
                                    <div class="col-md-12">
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('process_number')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_process_number"
                                                       name="success_operation_process_number" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('deposit_system')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_deposit_system"
                                                       name="success_operation_deposit_system" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('agency')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_agency"
                                                       name="success_operation_agency" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount_to_deposited_into_wallet_in_dollars')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_amount_in_dollars"
                                                       name="success_operation_amount_in_dollars" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('deposit_commission')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_deposit_commission"
                                                       name="success_operation_deposit_commission" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount_to_be_paid_currency')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_amount_to_paid"
                                                       name="success_operation_amount_to_paid" type="text">
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6 style-border-Modal-right my-2">
                                    <div class="col-md-12">
                                        <h2 class="fw-bolder my-3 style-Address-Modal">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="12" r="12" fill="#3ABE32"></circle>
                                                <path d="M12.0025 6.35352C12.7514 6.35352 13.4695 6.65099 13.9991 7.18051C14.5286 7.71002 14.8261 8.4282 14.8261 9.17704C14.8261 9.92589 14.5286 10.6441 13.9991 11.1736C13.4695 11.7031 12.7514 12.0006 12.0025 12.0006C11.2537 12.0006 10.5355 11.7031 10.006 11.1736C9.47648 10.6441 9.179 9.92589 9.179 9.17704C9.179 8.4282 9.47648 7.71002 10.006 7.18051C10.5355 6.65099 11.2537 6.35352 12.0025 6.35352ZM12.0025 13.4123C15.1225 13.4123 17.6496 14.6759 17.6496 16.2359V17.6476H6.35547V16.2359C6.35547 14.6759 8.88253 13.4123 12.0025 13.4123Z"
                                                      fill="white"></path>
                                            </svg>
                                            <span class="px-1">{{cp('recipient_data')}}</span>
                                        </h2>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('recipient_name')}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     id="recipient_name">{{auth()->user()->first_name}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     onclick="CopyToClipboard('recipient_name')">
                                                    <a href="#">
                                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.0367 16.6094H0.619752C0.455383 16.6094 0.297747 16.5441 0.181521 16.4279C0.0652952 16.3116 0 16.154 0 15.9896V3.96356C0 3.79919 0.0652952 3.64156 0.181521 3.52533C0.297747 3.40911 0.455383 3.34381 0.619752 3.34381H10.0367C10.201 3.34381 10.3587 3.40911 10.4749 3.52533C10.5911 3.64156 10.6564 3.79919 10.6564 3.96356V15.9896C10.6564 16.154 10.5911 16.3116 10.4749 16.4279C10.3587 16.5441 10.201 16.6094 10.0367 16.6094ZM1.2395 15.3699H9.41692V4.58331H1.2395V15.3699Z"
                                                                  fill="#3ABE32"></path>
                                                            <path d="M13.3804 13.2656H10.0367C9.87229 13.2656 9.71465 13.2003 9.59842 13.0841C9.4822 12.9678 9.4169 12.8102 9.4169 12.6458C9.4169 12.4815 9.4822 12.3238 9.59842 12.2076C9.71465 12.0914 9.87229 12.0261 10.0367 12.0261H12.7607V1.2395H4.58325V3.9631C4.58325 4.12747 4.51796 4.28511 4.40173 4.40134C4.28551 4.51756 4.12787 4.58286 3.9635 4.58286C3.79913 4.58286 3.6415 4.51756 3.52527 4.40134C3.40904 4.28511 3.34375 4.12747 3.34375 3.9631V0.619752C3.34375 0.455383 3.40904 0.297747 3.52527 0.181521C3.6415 0.0652951 3.79913 0 3.9635 0H13.3804C13.5448 0 13.7024 0.0652951 13.8187 0.181521C13.9349 0.297747 14.0002 0.455383 14.0002 0.619752V12.6458C14.0002 12.8102 13.9349 12.9678 13.8187 13.0841C13.7024 13.2003 13.5448 13.2656 13.3804 13.2656Z"
                                                                  fill="#3ABE32"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('phone-number')}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     id="recipient_phone_number">{{auth()->user()->phone}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     onclick="CopyToClipboard('recipient_phone_number')">
                                                    <a href="#">
                                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.0367 16.6094H0.619752C0.455383 16.6094 0.297747 16.5441 0.181521 16.4279C0.0652952 16.3116 0 16.154 0 15.9896V3.96356C0 3.79919 0.0652952 3.64156 0.181521 3.52533C0.297747 3.40911 0.455383 3.34381 0.619752 3.34381H10.0367C10.201 3.34381 10.3587 3.40911 10.4749 3.52533C10.5911 3.64156 10.6564 3.79919 10.6564 3.96356V15.9896C10.6564 16.154 10.5911 16.3116 10.4749 16.4279C10.3587 16.5441 10.201 16.6094 10.0367 16.6094ZM1.2395 15.3699H9.41692V4.58331H1.2395V15.3699Z"
                                                                  fill="#3ABE32"></path>
                                                            <path d="M13.3804 13.2656H10.0367C9.87229 13.2656 9.71465 13.2003 9.59842 13.0841C9.4822 12.9678 9.4169 12.8102 9.4169 12.6458C9.4169 12.4815 9.4822 12.3238 9.59842 12.2076C9.71465 12.0914 9.87229 12.0261 10.0367 12.0261H12.7607V1.2395H4.58325V3.9631C4.58325 4.12747 4.51796 4.28511 4.40173 4.40134C4.28551 4.51756 4.12787 4.58286 3.9635 4.58286C3.79913 4.58286 3.6415 4.51756 3.52527 4.40134C3.40904 4.28511 3.34375 4.12747 3.34375 3.9631V0.619752C3.34375 0.455383 3.40904 0.297747 3.52527 0.181521C3.6415 0.0652951 3.79913 0 3.9635 0H13.3804C13.5448 0 13.7024 0.0652951 13.8187 0.181521C13.9349 0.297747 14.0002 0.455383 14.0002 0.619752V12.6458C14.0002 12.8102 13.9349 12.9678 13.8187 13.0841C13.7024 13.2003 13.5448 13.2656 13.3804 13.2656Z"
                                                                  fill="#3ABE32"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('address')}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     id="recipient_address">{{auth()->user()->country->name}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     onclick="CopyToClipboard('recipient_address')">
                                                    <a href="#">
                                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.0367 16.6094H0.619752C0.455383 16.6094 0.297747 16.5441 0.181521 16.4279C0.0652952 16.3116 0 16.154 0 15.9896V3.96356C0 3.79919 0.0652952 3.64156 0.181521 3.52533C0.297747 3.40911 0.455383 3.34381 0.619752 3.34381H10.0367C10.201 3.34381 10.3587 3.40911 10.4749 3.52533C10.5911 3.64156 10.6564 3.79919 10.6564 3.96356V15.9896C10.6564 16.154 10.5911 16.3116 10.4749 16.4279C10.3587 16.5441 10.201 16.6094 10.0367 16.6094ZM1.2395 15.3699H9.41692V4.58331H1.2395V15.3699Z"
                                                                  fill="#3ABE32"></path>
                                                            <path d="M13.3804 13.2656H10.0367C9.87229 13.2656 9.71465 13.2003 9.59842 13.0841C9.4822 12.9678 9.4169 12.8102 9.4169 12.6458C9.4169 12.4815 9.4822 12.3238 9.59842 12.2076C9.71465 12.0914 9.87229 12.0261 10.0367 12.0261H12.7607V1.2395H4.58325V3.9631C4.58325 4.12747 4.51796 4.28511 4.40173 4.40134C4.28551 4.51756 4.12787 4.58286 3.9635 4.58286C3.79913 4.58286 3.6415 4.51756 3.52527 4.40134C3.40904 4.28511 3.34375 4.12747 3.34375 3.9631V0.619752C3.34375 0.455383 3.40904 0.297747 3.52527 0.181521C3.6415 0.0652951 3.79913 0 3.9635 0H13.3804C13.5448 0 13.7024 0.0652951 13.8187 0.181521C13.9349 0.297747 14.0002 0.455383 14.0002 0.619752V12.6458C14.0002 12.8102 13.9349 12.9678 13.8187 13.0841C13.7024 13.2003 13.5448 13.2656 13.3804 13.2656Z"
                                                                  fill="#3ABE32"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('customer_acc_number')}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     id="recipient_acc_number">{{auth()->user()->wallet_code_symbol}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     onclick="CopyToClipboard('recipient_acc_number')">
                                                    <a href="#">
                                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.0367 16.6094H0.619752C0.455383 16.6094 0.297747 16.5441 0.181521 16.4279C0.0652952 16.3116 0 16.154 0 15.9896V3.96356C0 3.79919 0.0652952 3.64156 0.181521 3.52533C0.297747 3.40911 0.455383 3.34381 0.619752 3.34381H10.0367C10.201 3.34381 10.3587 3.40911 10.4749 3.52533C10.5911 3.64156 10.6564 3.79919 10.6564 3.96356V15.9896C10.6564 16.154 10.5911 16.3116 10.4749 16.4279C10.3587 16.5441 10.201 16.6094 10.0367 16.6094ZM1.2395 15.3699H9.41692V4.58331H1.2395V15.3699Z"
                                                                  fill="#3ABE32"></path>
                                                            <path d="M13.3804 13.2656H10.0367C9.87229 13.2656 9.71465 13.2003 9.59842 13.0841C9.4822 12.9678 9.4169 12.8102 9.4169 12.6458C9.4169 12.4815 9.4822 12.3238 9.59842 12.2076C9.71465 12.0914 9.87229 12.0261 10.0367 12.0261H12.7607V1.2395H4.58325V3.9631C4.58325 4.12747 4.51796 4.28511 4.40173 4.40134C4.28551 4.51756 4.12787 4.58286 3.9635 4.58286C3.79913 4.58286 3.6415 4.51756 3.52527 4.40134C3.40904 4.28511 3.34375 4.12747 3.34375 3.9631V0.619752C3.34375 0.455383 3.40904 0.297747 3.52527 0.181521C3.6415 0.0652951 3.79913 0 3.9635 0H13.3804C13.5448 0 13.7024 0.0652951 13.8187 0.181521C13.9349 0.297747 14.0002 0.455383 14.0002 0.619752V12.6458C14.0002 12.8102 13.9349 12.9678 13.8187 13.0841C13.7024 13.2003 13.5448 13.2656 13.3804 13.2656Z"
                                                                  fill="#3ABE32"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('email')}}
                                                </div>
                                                <div class="text-end style-row-Invouce-text"
                                                     id="recipient_email">{{auth()->user()->email}}</div>
                                                <div class="text-end style-row-Invouce-text"
                                                     onclick="CopyToClipboard('recipient_email')">
                                                    <a href="#">
                                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10.0367 16.6094H0.619752C0.455383 16.6094 0.297747 16.5441 0.181521 16.4279C0.0652952 16.3116 0 16.154 0 15.9896V3.96356C0 3.79919 0.0652952 3.64156 0.181521 3.52533C0.297747 3.40911 0.455383 3.34381 0.619752 3.34381H10.0367C10.201 3.34381 10.3587 3.40911 10.4749 3.52533C10.5911 3.64156 10.6564 3.79919 10.6564 3.96356V15.9896C10.6564 16.154 10.5911 16.3116 10.4749 16.4279C10.3587 16.5441 10.201 16.6094 10.0367 16.6094ZM1.2395 15.3699H9.41692V4.58331H1.2395V15.3699Z"
                                                                  fill="#3ABE32"></path>
                                                            <path d="M13.3804 13.2656H10.0367C9.87229 13.2656 9.71465 13.2003 9.59842 13.0841C9.4822 12.9678 9.4169 12.8102 9.4169 12.6458C9.4169 12.4815 9.4822 12.3238 9.59842 12.2076C9.71465 12.0914 9.87229 12.0261 10.0367 12.0261H12.7607V1.2395H4.58325V3.9631C4.58325 4.12747 4.51796 4.28511 4.40173 4.40134C4.28551 4.51756 4.12787 4.58286 3.9635 4.58286C3.79913 4.58286 3.6415 4.51756 3.52527 4.40134C3.40904 4.28511 3.34375 4.12747 3.34375 3.9631V0.619752C3.34375 0.455383 3.40904 0.297747 3.52527 0.181521C3.6415 0.0652951 3.79913 0 3.9635 0H13.3804C13.5448 0 13.7024 0.0652951 13.8187 0.181521C13.9349 0.297747 14.0002 0.455383 14.0002 0.619752V12.6458C14.0002 12.8102 13.9349 12.9678 13.8187 13.0841C13.7024 13.2003 13.5448 13.2656 13.3804 13.2656Z"
                                                                  fill="#3ABE32"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                <div class=" row justify-content-start my-3">
                                    <div class="d-flex flex-row justify-content-start">
                                        <button type="submit" data-type="image"
                                                class="success-operation-submit-btn btn mx-2 BntAdd-Modal"
                                                data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_Transfer_money_around_world">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H4.16667C3.24619 2.5 2.5 3.24619 2.5 4.16667V15.8333C2.5 16.7538 3.24619 17.5 4.16667 17.5H15.8333C16.7538 17.5 17.5 16.7538 17.5 15.8333V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z"
                                                      stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M7.08203 8.33398C7.77239 8.33398 8.33203 7.77434 8.33203 7.08398C8.33203 6.39363 7.77239 5.83398 7.08203 5.83398C6.39168 5.83398 5.83203 6.39363 5.83203 7.08398C5.83203 7.77434 6.39168 8.33398 7.08203 8.33398Z"
                                                      stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M17.5013 12.5007L13.3346 8.33398L4.16797 17.5007"
                                                      stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                            <span>{{cp('download_image')}}</span>
                                        </button>
                                        <button type="submit" data-type="pdf"
                                                class="success-operation-submit-btn btn mx-2 BntAdd-Modal-Download"
                                                style="font-weight:600!important;;font-family:almarai!important;color:#fff;background-color:#262626;">
                                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M16.625 11.875V15.0417C16.625 15.4616 16.4582 15.8643 16.1613 16.1613C15.8643 16.4582 15.4616 16.625 15.0417 16.625H3.95833C3.53841 16.625 3.13568 16.4582 2.83875 16.1613C2.54181 15.8643 2.375 15.4616 2.375 15.0417V11.875"
                                                      stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.54297 7.91602L9.5013 11.8743L13.4596 7.91602" stroke="white"
                                                      stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.5 11.875V2.375" stroke="white" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                            </svg>
                                            <span>{{cp('download_pdf')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <form action="https://perfectmoney.com/api/step1.asp" id="perfectmoneyForm" method="POST">
        <input type="hidden" name="PAYEE_ACCOUNT" value="U31910263">
        <input type="hidden" name="PAYEE_NAME" value="ytadawul">
        <input type="hidden" name="PAYMENT_ID" value="" id="PAYMENT_ID">
        <input type="hidden" name="PAYMENT_AMOUNT" value="" id="PAYMENT_AMOUNT">
        <input type="hidden" name="PAYMENT_UNITS" value="USD">
        <input type="hidden" name="STATUS_URL" value="">
        <input type="hidden" name="PAYMENT_URL" value="https://ctpay.uk/perfectmoney-success-callback">
        <input type="hidden" name="PAYMENT_URL_METHOD" value="LINK">
        <input type="hidden" name="NOPAYMENT_URL" value="https://ctpay.uk/perfectmoney-nopayment-callback">
        <input type="hidden" name="NOPAYMENT_URL_METHOD" value="LINK">
        <input type="hidden" name="SUGGESTED_MEMO" value="">
        <input type="hidden" name="BAGGAGE_FIELDS" value="">
        <input type="submit" name="PAYMENT_METHOD" value="Pay Now!" style="display: none;">
    </form>
@endsection

@section("custom_js")
    <script type="text/javascript">
        $(document).ready(function () {
            $('#customCheck').attr('checked', false);
            $("#save-form").prop("disabled", true);
        });

        $(document).on("click", '.dropdown .dropdown-menu li.deposit_type', function () {
            $("#info_agency_type").html($(this).html());

        });
        $('#agency_section').change(function () {
            // $("#deposit_type").val("")

            data = JSON.parse($('#agency_section').find('option:selected').attr('all_data'));
            fixed_charge = data.fixed_charge_deposit;
            percent_value = data.deposit_fee_percent;
            total_with_percent = getTotal($("#form_amount").val(), fixed_charge, percent_value, exchange_price);
            $("#our_deposit_fee").text(fixed_charge + percent_value);

            $("#info_agency_ytadawul_account_number").text(data.ytadawul_account_number);
            $("#info_agency_ytadawul_account_name").text(data.ytadawul_account_name);
            $("#info_agency_ytadawul_phone").text(data.phone);
            $("#info_agency_ytadawul_address").text(data.address);
            $("#info_agency_ytadawul_account_name").text(data.ytadawul_account_name);
            $("#info_agency_name").text(get_first_objectVal(data.name));
            $("#info_amount").text($("#form_amount").val());
            $("#min_deposit_amount").val((data.min_deposit_amount));
            $("#max_deposit_amount").val((data.max_deposit_amount));
            $("#form_amount").attr('min', data.min_deposit_amount);
            $("#form_amount").attr('max', data.max_deposit_amount);
            $("#deposit_instructions").html(data.deposit_instructions);
            setChangedValues();

            let deposit_agency_id = $(this).val();
            $("#deposit_agency_id").val(deposit_agency_id);
        });

        $('#deposit_type').change(function () {
            var type_id = $(this).val();
            $("#deposit_method").val(type_id)
            $('#modal_deposit_type').empty()
            $("#modal_deposit_type").append($(this).find("option:selected").text())
            var url = '{!! route('getDepositAgencyByDepositMethod', [':type_id']) !!}';
            url = url.replace(':type_id', type_id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    {{--if(response.success){--}}
                    {{--    $('#agency_section').empty()--}}
                    {{--    let data = response.data--}}
                    {{--    if (data.length > 0){--}}
                    {{--        for(var key in data) {--}}
                    {{--            $('#agency_section').append(new Option(data[key]['text'], data[key]['id'], false, false))--}}
                    {{--        }--}}
                    {{--    }else{--}}
                    {{--        $('#agency_section').append(new Option('{{cp('no_results_foundd')}}', '', false, false))--}}
                    {{--    }--}}
                    {{--    --}}
                    {{--}--}}
                    $('#agency_section').empty()
                    $("#agency_section").append(response)

                },
                //todo OSAMA you must add checking for response when no data found
            })
        });

        function getTotal(amount, fixed_charge, percent_val, exchange_price = 1) {
            if (parseFloat(amount) <= 0) return 0
            var total = parseFloat(amount) + parseFloat(fixed_charge)
                + (parseFloat(amount) * parseFloat(percent_val) / 100);
            return Number(total * exchange_price).toFixed(6);
        }

        function setChangedValues() {
            var total_all = getTotal($("#form_amount").val(), fixed_charge, percent_value, exchange_price);
            $("#info_amount_currency").text(total_all);
            $('#client_amount').val(total_all);
        }

        var data = {};
        var exchange_price = 1;
        var fixed_charge = 0;
        var percent_value = 0;
        var total_with_percent = 0
        $(document).on("click", '.dropdown .dropdown-menu li.agency_li', function () {
            $("#deposit_type").val("")

            data = JSON.parse($(this).attr('all_data'));
            //   console.log(data)
            fixed_charge = data.fixed_charge_deposit;
            percent_value = data.deposit_fee_percent;
            total_with_percent = getTotal($("#form_amount").val(), fixed_charge, percent_value, exchange_price);
            $("#our_deposit_fee").text(fixed_charge + percent_value);

            $("#info_agency_ytadawul_account_number").text(data.ytadawul_account_number);
            $("#info_agency_ytadawul_account_name").text(data.ytadawul_account_name);
            $("#info_agency_name").text(get_first_objectVal(data.name));
            $("#info_amount").text($("#form_amount").val());
            $("#min_deposit_amount").val((data.min_deposit_amount));
            $("#max_deposit_amount").val((data.max_deposit_amount));
            $("#form_amount").attr('min', data.min_deposit_amount);
            $("#form_amount").attr('max', data.max_deposit_amount);
            $("#deposit_instructions").html(data.deposit_instructions);
            setChangedValues();

        });

        $('.dropdown .dropdown-menu li.currency').click(function () {
            $("#info_selected_currency").html($(this).html());
            exchange_price = $(this).attr('exchange_price');
            setChangedValues();

        });
        $('#form_amount').change(function () {
            $("#info_amount").text('$ ' + $(this).val());
            $("#our_deposit_fee").text(+data.fixed_charge_deposit + +data.deposit_fee_percent);
            setChangedValues();
        });


        $('#customCheck').change(function () {
            var is_checked = $("#customCheck").is(":checked");

            if (is_checked)
                $("#save-form").prop("disabled", false);
            else
                $("#save-form").prop("disabled", true);

        });

        $('#show_model').click(function (e) {
            // var deposit_agency_id = $("#deposit_agency_id").val();
            var agency_section = $("#agency_section").val();
            // console.log(deposit_agency_id)
            // console.log(agency_section)
            var currency_id = $("#currency_id").val();
            var amount = +$("#form_amount").val();
            var min = +$("#min_deposit_amount").val();
            var max = +$("#max_deposit_amount").val();


            if (agency_section > 0 && currency_id > 0) {
                // $("#info_selected_currency").append($('#currency_id').find('option:selected').text());
                // $('#model_operation').modal('show');
                if (amount <= max && amount >= min) {
                    $.when(checkUserMasterKey($('#master_key').val(), '{{route('check_user_master_key')}}')).done(function (response) {
                        if (response.success) {
                            $("#info_selected_currency").append($('#currency_id').find('option:selected').text());
                            $('#model_operation').modal('show');
                        } else {
                            showErrorModal(response.message)
                        }
                    })
                } else {
                    $('#kt_modal_rang_error_text').empty()
                    $('#kt_modal_rang_error_text').append('{{cp("amount_must_be_between_the_allowed_range")}}')
                    $('#kt_modal_rang_error_min').empty()
                    $('#kt_modal_rang_error_max').empty()
                    $('#kt_modal_rang_error_min').append(min)
                    $('#kt_modal_rang_error_max').append(max)
                    $('#kt_modal_rang_error').modal('show')
                }
            } else {
                var txt = '{{cp('must_enter_all_data')}}';
                if (deposit_agency_id === undefined || deposit_agency_id <= 0) {
                    txt = "{{cp('agency_and_other_fields_are_required')}}";
                } else if (currency_id === undefined || currency_id <= 0) {
                    txt = '{{cp('currency_id_is_required')}}';
                }

                $('#kt_modal_error_text').empty()
                $('#kt_modal_error_text').append(txt)
                $('#kt_modal_error').modal('show')
                // toastrErrorMessage(txt)
                // $.toast({
                //     heading: "error",
                //     position: {
                //         right: 10,
                //         top: 10
                //     },
                //     text: txt,
                //     icon: 'error'
                // });
            }
        });

        $('.success-operation-submit-btn').click(function (e) {
            e.preventDefault();
            let data = $('#success_operation_form').serialize()
            data += '&download=' + $(this).data('type')

            $.ajax({
                url: '{{route('wallet.export_pdf_image')}}',
                // container: '#success_operation_form',
                data: data,
                type: "POST",
                // redirect: true,
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: function () {
                    $(".success-operation-submit-btn").attr("disabled", true);
                    {{--$("#save-form").text("{{cp('wait_process_to_finish')}}");--}}
                },
                success: function (res) {
                    let blob = new Blob([res], {type: 'application/download'});
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'process_details_' + Math.round(Date.now() / 1000) + '.pdf';
                    link.click();
                    $(".success-operation-submit-btn").attr("disabled", false);
                    location.replace("{{route("list_deposit_withdraws")}}" + "#deposit_requests_tab")
                }, error: function (response) {
                    console.log('res', response);
                    console.log('txt', JSON.parse(response.responseText));
                    console.log('jss', response.responseJSON.errors);
                    $('#nameError').text(response.responseJSON.errors.currency_iid);

                    $(".success-operation-submit-btn").prop("disabled", false);
                    $(".success-operation-submit-btn").text('{{trans('lang.confirm')}}');
                },
            })
        })

        $('#save-form').click(function (e) {
            e.preventDefault();
            $.easyAjax({
                url: '{{route('wallet.confirm_deposit')}}',
                container: '#form_data',
                type: "POST",
                redirect: true,
                data: $('#form_data').serialize() + '&master_key=' + $('#master_key').val(),
                beforeSend: function () {
                    $(".btn-confirm").attr("disabled", true);
                    $("#save-form").attr("disabled", true);
                    $("#save-form").text("{{cp('wait_process_to_finish')}}");
                },
                complete: function (xhr, status) {
                    $("#save-form").attr("disabled", true);
                    $("#save-form").text("{{cp('confirm')}}");
                },
                success: function (response) {
                    if(response.submit_perfect_money_form){
                        $('#PAYMENT_ID').val(response.data.id)
                        $('#PAYMENT_AMOUNT').val(response.data.final_amount)
                        $('#perfectmoneyForm').submit()
                        return;
                    }
                    
                    if (response.has_redirect_url && response.redirect_url != '') {
                        window.location.href = response.redirect_url;
                        return
                    }
                    // $.toast({
                    //     heading: 'تم ارسال الطلب',
                    //     text: 'نجحت عملية طلب الايداع  بامكانك الان استعراضها',
                    //     showHideTransition: 'fade',
                    //     hideAfter: false,
                    //     icon: 'success',
                    //     position: 'top-right'
                    // });
                    //todo OSAMA must check the response if not success
                    let data = response.data
                    $('#success_operation_process_number').val(data.id)
                    $('#success_operation_deposit_system').val($("#modal_deposit_type").text())
                    $('#success_operation_agency').val($("#info_agency_name").text())
                    $('#success_operation_amount_in_dollars').val($("#form_amount").val())
                    $('#success_operation_deposit_commission').val($("#our_deposit_fee").text())
                    $('#success_operation_amount_to_paid').val($('#info_amount_currency').text() + ' ' + $('#info_selected_currency').text())
                    // console.log(response)
                    {{--                    location.replace("{{route("list_deposit_withdraws")}}" + "#deposit_requests_tab")--}}

                    $('#recipient_acc_number').text($("#info_agency_ytadawul_account_number").text())
                    $('#recipient_name').text($("#info_agency_ytadawul_account_name").text())
                    $('#recipient_phone_number').text($("#info_agency_ytadawul_phone").text())
                    $('#recipient_address').text($("#info_agency_ytadawul_address").text())
                    $('#recipient_email').text($("#info_agency_ytadawul_account_name").text())
                    $('#model_operation').modal('hide');
                    $('#kt_modal_success_operation').modal('show')
                }, error: function (response) {
                    if (response.status === 422) {
                        let text = $.parseJSON(response.responseText);
                        $.each(text.errors, function (key, value) {
                            showErrorModal(value[0])
                        });
                    }

                    console.log('res', response);
                    console.log('txt', JSON.parse(response.responseText));
                    console.log('jss', response.responseJSON.errors);
                    $('#nameError').text(response.responseJSON.errors.currency_iid);

                    $("#save-form").prop("disabled", false);
                    $("#save-form").text('{{trans('lang.confirm')}}');
                },
            })
        });

        function CopyToClipboard(containerid) {
            var range = document.createRange();
            range.selectNode(document.getElementById(containerid));
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            window.getSelection().removeAllRanges();// to deselect
        }

    </script>
@endsection
