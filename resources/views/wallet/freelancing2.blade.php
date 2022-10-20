@extends('wallet.index')
@section('content')
    <section>
        <div class="card m-5 ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                        <span class="fw-bolder mb-2 text-dark">
                                            {{cp('withdraw_money_from_freelancing_platforms')}}
                                        </span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <form method="" id="form_data" action="#" autocomplete="off">
                    @csrf
                    <input type="hidden" name="currency_id" value="1">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    {{--                                    <input type="hidden" required id="deposit_type" name="reference_id">--}}
                                    <label class=" style-label-form ">{{cp('FreelancingPlatforms')}} </label>
                                    <select name="reference_id" data-control="select2"
                                            data-placeholder="{{cp('select_freelancing_platforms_placeholder')}}"
                                            data-hide-search="true"
                                            id="deposit_type"
                                            class="form-select style-select-profile style-label-form  ">
                                        <option></option>
                                        @foreach($free_lancing_platforms as $free)
                                            <option value="{{$free->id}}">{{$free->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    {{--                                    <input type="hidden" name="deposit_agency_id" id="formtransfer_agency_id">--}}
                                    <label class=" style-label-form ">{{cp('agency')}} </label>
                                    <select name="deposit_agency_id" data-control="select2"
                                            data-placeholder="{{cp('select_agency')}}"
                                            data-hide-search="true"
                                            id="formtransfer_agency_id"
                                            class="form-select style-select-profile style-label-form  ">
                                        <option></option>

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form">{{cp('amount')}}</label>
                                    <input type="number" min="1" name="amount" id="form_amount" value=""
                                           class="form-control"/>
                                </div>
                            </div>


                            <div class="row d-none">
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('min_amount_pull')}}</label>
                                    <input type="text" class="form-control" value="" name="min_deposit_amount"
                                           id="min_deposit_amount" disabled/>
                                </div>
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('max_amount_pull')}}</label>
                                    <input type="text" class="form-control" value="" name="max_deposit_amount"
                                           id="max_deposit_amount" disabled/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <button type="button" id="show_model"
                                            class="form-control BntAdd-Modal">{{cp('send-withdraw-order')}}
                                    </button>

                                </div>

                            </div>
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
                                                    <div class="flex-grow-1 me-2">
                                                        <h2 class="style-box-wallet-info-Big">
                                                            {!! cp('welcome_to_ctpay_wallet') !!}
                                                        </h2>


                                                        <p class="style-box-wallet-info-Big-Title-text">
                                                            {!! cp('withdraw_instructions_text') !!}
                                                        </p>
                                                        <p class="style-box-wallet-info-Big-list-info-text">
                                                            {!! cp('withdraw_instructions_description') !!}
                                                        </p>
                                                        <ul class=" style-box-wallet-info-Big-list-info">

                                                            <li class="style-box-wallet-info-Big-list-info-text">
                                                                <i class="fas fa-check text-white"></i>
                                                                {{cp('withdraw_instructions_step_1')}}
                                                            </li>
                                                            <li class="style-box-wallet-info-Big-list-info-text">
                                                                <i class="fas fa-check text-white"></i>
                                                            {{cp('withdraw_instructions_step_2')}}
                                                            <li class="style-box-wallet-info-Big-list-info-text">
                                                                <i class="fas fa-check text-white"></i>
                                                                {{cp('withdraw_instructions_step_3')}}
                                                            </li>
                                                            <li class="style-box-wallet-info-Big-list-info-text">
                                                                <i class="fas fa-check text-white"></i>
                                                                {{cp('withdraw_instructions_step_4')}}
                                                            </li>
                                                            <li class="style-box-wallet-info-Big-list-info-text">
                                                                <i class="fas fa-check text-white"></i>
                                                                {{cp('withdraw_instructions_step_5')}}
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
                </form>

            </div>
        </div>
        
        
        <!--begin::Modal title-->
        <div class="modal fade" id="model_operation" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-450px">
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

                                <span class="px-1">{{cp('transaction-detail')}}</span>
                            </h2>
                            <h2 class="pt-1">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.5 11.1112V6.05566" stroke="#E51C39" stroke-width="1.5"/>
                                </svg>
                                <span class="style-bio-Modal-trasfer">{{cp('please_review_all_enterd_data')}}</span>
                            </h2>
                        </div>

                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body scroll-y ">
                        {{--                        <form class="form" action="#">--}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('freelancing-Platforms')}}</div>
                                        <div class="text-end style-row-Invouce-text" id="info_plateform"></div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('agency')}}</div>
                                        <div class="text-end style-row-Invouce-text" id="info_deposit_agency"></div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount_wanted_to_pull')}}</div>
                                        <div class="text-end style-row-Invouce-text" id="info_amount"></div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('our_pull_fee')}}</div>
                                        <div class="text-end style-row-Invouce-text" id="our_deposit_fee"></div>
                                    </div>
                                </div>

                                <h2 class="fw-bolder my-3 style-Address-Modal d-none">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="12" cy="12" r="12" fill="#3ABE32"/>
                                        <path d="M12.0025 6.35291C12.7514 6.35291 13.4695 6.65038 13.9991 7.1799C14.5286 7.70941 14.8261 8.42759 14.8261 9.17643C14.8261 9.92528 14.5286 10.6435 13.9991 11.173C13.4695 11.7025 12.7514 12 12.0025 12C11.2537 12 10.5355 11.7025 10.006 11.173C9.47648 10.6435 9.179 9.92528 9.179 9.17643C9.179 8.42759 9.47648 7.70941 10.006 7.1799C10.5355 6.65038 11.2537 6.35291 12.0025 6.35291ZM12.0025 13.4117C15.1225 13.4117 17.6496 14.6753 17.6496 16.2353V17.647H6.35547V16.2353C6.35547 14.6753 8.88253 13.4117 12.0025 13.4117Z"
                                              fill="white"/>
                                    </svg>
                                    <span class="px-1">{{cp('ytaduwel-information')}}</span>
                                </h2>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('ytaduwel-account-number')}}</div>
                                        <div class="text-end style-row-Invouce-text" id="info_agency_ytadawul_account_number"></div>
                                    </div>
                                </div>
                                <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                    <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('ytaduwel-account-name')}}</div>
                                        <div class="text-end style-row-Invouce-text" id="info_agency_ytadawul_account_name"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-5">
                                <h1 class="style-title-card">
                                                    <span class="form-check">
                                                        <input class="form-check-input"
                                                               type="checkbox"
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
                            <button type="button" id="save-form"
                                    class="btn col-md-12  BntAdd-Modal">
                                {{cp('confirm')}}
                            </button>

                        </div>

                        {{--                        </form>--}}

                    </div>
                </div>
            </div>

        </div>
        <!--begin::Modal title-->
        <!--begin::Modal title-->
        <div class="modal fade" id="kt_modal_wronge_money_freelance_platforms" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-300px">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <h2 class="fw-bolder style-Address-Modal">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                          stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M12 8V12" stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                    <path d="M12 16H12.01" stroke="#E51C39" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round"/>
                                </svg>

                                <span class="px-1">تنبية  </span>
                            </h2>

                        </div>

                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                            <i class="fas fa-times  style-icon-Close-Modal"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body scroll-y ">
                        <div class="row">
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row">
                                    <p class="style-title-wronge-platform">يجب ان يكون المبلغ ضمن المدى المسموح به </p>
                                </div>
                                <div class="d-flex flex-row">
                                    <div>
                                        <p class="style-label-form">أقل مبلغ للايداع :</p>
                                    </div>
                                    <div class="px-2">
                                        <p class="style-Max-Sale-Platform">400$</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row">
                                    <div>
                                        <p class="style-label-form">أقصى مبلغ للايداع :</p>
                                    </div>
                                    <div class="px-2">
                                        <p class="style-Max-Sale-Platform">1000$</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <!--begin::Modal title-->


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
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('agency')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_platform_ag"
                                                       name="success_operation_platform_ag" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_amount"
                                                       name="success_operation_amount" type="text">
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
                                                <div class="text-end style-row-Invouce-text" id="recipient_name">{{auth()->user()->first_name}}</div>
                                                <div class="text-end style-row-Invouce-text" onclick="CopyToClipboard('recipient_name')">
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
                                                <div class="text-end style-row-Invouce-text" id="recipient_phone_number">{{auth()->user()->phone}}</div>
                                                <div class="text-end style-row-Invouce-text" onclick="CopyToClipboard('recipient_phone_number')">
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
                                                <div class="text-end style-row-Invouce-text" id="recipient_address">{{auth()->user()->country->name}}</div>
                                                <div class="text-end style-row-Invouce-text" onclick="CopyToClipboard('recipient_address')">
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
                                                <div class="text-end style-row-Invouce-text" id="recipient_acc_number">{{auth()->user()->wallet_code_symbol}}</div>
                                                <div class="text-end style-row-Invouce-text" onclick="CopyToClipboard('recipient_acc_number')">
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
                                                <div class="text-end style-row-Invouce-text" id="recipient_email">{{auth()->user()->email}}</div>
                                                <div class="text-end style-row-Invouce-text" onclick="CopyToClipboard('recipient_email')">
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

                                <div class=" row justify-content-start my-3 d-none">
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

        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_phone" id="info_agency_ytadawul_phone"/>
        <input type="hidden" class="form-control" value="" name="info_agency_ytadawul_address" id="info_agency_ytadawul_address"/>
    </section>
@endsection


@section("custom_js")
    <script type="text/javascript">
        $(document).ready(function () {
            $('#customCheck').attr('checked', false);
            $("#save-form").prop("disabled", true);
        });
        
        $('#customCheck').change(function () {

            var is_checked = $("#customCheck").is(":checked");

            if (is_checked)
                $("#save-form").prop("disabled", false);
            else
                $("#save-form").prop("disabled", true);

        });
        
        $('#show_model').click(function (e) {
            var deposit_type = $("#deposit_type").val();
            var formtransfer_agency_id = $("#formtransfer_agency_id").val();
            var amount = $("#form_amount").val();
            var min = +$("#min_deposit_amount").val();
            var max = +$("#max_deposit_amount").val();

            if (deposit_type > 0 && formtransfer_agency_id > 0 && amount > 0) {
                if (amount <= max && amount >= min){
                    $('#model_operation').modal('show');
                    // $("#info_plateform").html($("#form_plateform").html());
                    // $("#info_deposit_agency").html($("#form_deposit_agency").html());
                    $("#info_link_url").attr('href', $("#form_link_url").val());
                    $("#info_link_url").html($("#form_link_url").val());
                    $("#info_description").html($("#form_description").val());
                    $("#info_paying_date").html($("#form_paying_date").val());
                    $("#info_amount").html($("#form_amount").val());
                }else{
                    $('#kt_modal_rang_error_text').empty()
                    $('#kt_modal_rang_error_text').append('{{cp("amount_must_be_between_the_allowed_range")}}')
                    $('#kt_modal_rang_error_min').empty()
                    $('#kt_modal_rang_error_max').empty()
                    $('#kt_modal_rang_error_min').append(min)
                    $('#kt_modal_rang_error_max').append(max)
                    $('#kt_modal_rang_error').modal('show')
                }
                

            } else {
                // $.toast({
                //     heading: "error",
                //     position: {
                //         right: 10,
                //         top: 10
                //     },
                //     text: "يجب المنصة و الوكالة و المبلغ",
                //     icon: 'error'
                // });
                showErrorModal('{{cp('all_fields_are_required')}}')
            }


        });

        var elements = [];
        $(document).on("change", '#deposit_type', function () {
            // var id = $(this).attr("id");
            var id = $(this).val();
            var url = '{!! route('list_payment_bt_platform', [':id']) !!}';
            url = url.replace(':id', id);
            
            $("#info_plateform").html($('#deposit_type').find('option:selected').text())

            $.easyAjax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    $('#formtransfer_agency_id').empty()
                    // var options = "";
                    var newOption = new Option('', '', true, true);
                    $('#formtransfer_agency_id').append(newOption);
                    response.forEach(function (element) {
                        // var newOption = new Option(element.name, element.id, false, false);
                        var newOption = '<option value="'+element.id+'" ' +
                            'data-min_deposit_amount="'+element.min_deposit_amount+'" ' +
                            'data-max_deposit_amount="'+element.max_deposit_amount+'" ' +
                            'data-ytadawul_account_number="'+element.ytadawul_account_number+'" ' +
                            'data-ytadawul_account_name="'+element.ytadawul_account_name+'" ' +
                            'data-name="'+element.name+'" ' +
                            'data-deposit_fee_percent="'+element.deposit_fee_percent+'" ' +
                            'data-fixed_charge_deposit="'+element.fixed_charge_deposit+'" ' +
                            'data-ytadawul_phone="'+element.phone+'" ' +
                            'data-ytadawul_address="'+element.address+'" ' +
                            '>'+element.name+'</option>';
                        // console.log(newOption)
                        $('#formtransfer_agency_id').append(newOption);
                        {{--elements.push(element);--}}
                        {{--options += ' <li all_data="' + element.data + '"  id="' + element.id + '" class="agency_li" style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:97%;">\n' +--}}
                        {{--    '                                        <div class="row col-md-12">\n' +--}}
                        {{--    '                                            <div class="col-md-4">\n' +--}}
                        {{--    '                                                <img src="{{asset("")}}/' + element.img_path + '" alt=""\n' +--}}
                        {{--    '                                                     style="max-width: 40px;">\n' +--}}
                        {{--    '                                            </div>\n' +--}}
                        {{--    '                                            <div class="col-md-7">\n' +--}}
                        {{--    '                                                <div class="method">\n' +--}}
                        {{--    '                                                    <h3>' + element.name + ' </h3>\n' +--}}
                        {{--    '                                                </div>\n' +--}}
                        {{--    '                                            </div>\n' +--}}
                        {{--    '                                        </div>\n' +--}}
                        {{--    '\n' +--}}
                        {{--    '                                    </li>';--}}
                    });
                    
                    {{--$("#ul_transfer_agency_id").html(options);--}}
                }
            })

        });
        var sum_fee = 0;
        // $(document).on("change", '#formtransfer_agency_id', function () {
        $('#formtransfer_agency_id').change(function () {

            // var id = $(this).attr('id');
            // console.log()
            var selected_agency = $('#formtransfer_agency_id').find('option:selected');
            $("#info_deposit_agency").html($('#formtransfer_agency_id').find('option:selected').text())
            // let data = JSON.parse($('#formtransfer_agency_id').find('option:selected').attr('all_data'));
            // console.log(data);
            // var __FOUND = elements.find(function (item, index) {
            //     if (item.id == id)
            //         return item;
            // });

            $("#min_deposit_amount").val((selected_agency.attr('data-min_deposit_amount')));
            $("#max_deposit_amount").val((selected_agency.attr('data-max_deposit_amount')));
            $("#info_agency_ytadawul_account_number").text(selected_agency.attr('data-ytadawul_account_number'));
            $("#info_agency_ytadawul_account_name").text(selected_agency.attr('data-ytadawul_account_name'));
            $("#info_agency_ytadawul_phone").text(selected_agency.attr('data-ytadawul_phone'));
            $("#info_agency_ytadawul_address").text(selected_agency.attr('data-ytadawul_address'));
            $("#info_agency_name").text(selected_agency.attr('data-name'));
            sum_fee = parseFloat((selected_agency.attr('data-deposit_fee_percent') * $("#form_amount").val() / 100)) + parseFloat(selected_agency.attr('data-fixed_charge_deposit'));
            $("#info_amount").html($("#form_amount").val());
            $("#our_deposit_fee").html(sum_fee + '$');
            $("#form_amount").attr('min', selected_agency.attr('data-min_deposit_amount'));
            $("#form_amount").attr('max', selected_agency.attr('data-max_deposit_amount'));
        });

        $('#save-form').click(function (e) {
            e.preventDefault();
            // var old_text = $("#save-form").text();
            // $("#save-form").prop("disabled", true);
            // $("#save-form").text("انتظار اتمام العملية");
            $.easyAjax({
                url: '{{route('save_freelancing')}}',
                container: '#form_data',
                type: "POST",
                redirect: true,
                beforeSend: function () {
                    $(".btn-confirm").attr("disabled", true);
                    $("#save-form").attr("disabled", true);
                    $("#save-form").text("{{cp('wait_process_to_finish')}}");
                },
                complete: function (xhr, status) {
                    $("#save-form").attr("disabled", true);
                    $("#save-form").text("{{cp('confirm')}}");
                },
                data: $('#form_data').serialize(),
                success: function (response) {

                    // console.log(response)
                    $('#model_operation').modal('hide');
                    
                    $('#success_operation_process_number').val(response.data.id)
                    $('#success_operation_platform_ag').val(response.agency)
                    $('#success_operation_amount').val(response.data.final_amount)

                    $('#recipient_acc_number').text($("#info_agency_ytadawul_account_number").text())
                    $('#recipient_name').text($("#info_agency_ytadawul_account_name").text())
                    $('#recipient_phone_number').text($("#info_agency_ytadawul_phone").text())
                    $('#recipient_address').text($("#info_agency_ytadawul_address").text())
                    $('#recipient_email').text($("#info_agency_ytadawul_account_name").text())
                    
                    $('#kt_modal_success_operation').modal('show')
                    // showSuccessModal('success')
                    {{--location.replace("{{route("list_pull_earnings_orders")}}")--}}
{{--                    location.replace("{{route("list_deposit_withdraws")}}" + "#freelance_platforms_tab")--}}
                }, custom_error: function () {
                    $("#save-form").prop("disabled", false);
                }

            })
        });
    </script>
@endsection
