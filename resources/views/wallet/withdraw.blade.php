@extends('wallet.index')
@section('content')
    <section>
        <div class="card m-5 ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                        <span class="fw-bolder mb-2 text-dark">
                                            {{cp('withdrawing_funds_from_wallet')}}
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
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form">{{cp('account')}}</label>
                                    <input type="text" class="form-control"
                                           value="{{auth()->user()->wallet_code_symbol}}" disabled/>
                                </div>
                            </div>
                            <div class="col-md-10 my-2">
                                <label class=" style-label-form ">{{cp('withdrawal_method')}}</label>
                                <select name="agency_id" id="form_agency_id" data-control="select2"
                                        data-placeholder="{{cp('select_withdrawal_method')}}"
                                        data-hide-search="true"
                                        class="form-select style-select-profile style-label-form  ">
                                    <option></option>
                                    @include("wallet.agency_select2_agencies",["agencies"=> $accounts])

                                </select>
                                <span class="style-bio-Modal-trasfer">{{cp('withdrawal_method_description')}}</span>
                            </div>
                            <div class="row">
                                <div class="col-md-5 my-2">
                                    <label class="style-label-form">{{cp('amount')}}</label>
                                    <input type="number" name="amount" min="1" id="form_amount" value=""
                                           placeholder="" class="form-control">
                                </div>
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('currency')}}</label>
                                    <input type="text" class="form-control" value="0" name="sum_deposit_amount"
                                           id="sum_deposit_amount" placeholder="" disabled>
                                </div>
                            </div>
                            @include('wallet._master_key')
                            <div class="row d-none">
                                <div class="col-md-5 my-2">
                                    <label class="style-label-form">{{cp('min_withdraw_amount')}}</label>
                                    <input type="text" class="form-control" value="" name="min_deposit_amount"
                                           id="min_deposit_amount" placeholder="" disabled>
                                </div>
                                <div class="col-md-5 my-2">
                                    <label class=" style-label-form ">{{cp('max_withdraw_amount')}}</label>
                                    <input type="text" class="form-control" value="" name="max_deposit_amount"
                                           id="max_deposit_amount" placeholder="" disabled>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <button type="button" id="show_model"
                                            class="form-control BntAdd-Modal">{{cp('Withdrawal')}}
                                    </button>
                                </div>

                            </div>

                        </form>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount')}}</div>
                                            <div class="text-end style-row-Invouce-text"><span id="info_amount"></span>$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('our-fees')}}
                                            </div>
                                            <div class="text-end style-row-Invouce-text"><span id="info_fees"></span>$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('total_withdraw_with_fee')}}</div>
                                            <div class="text-end style-row-Invouce-text"><span
                                                        id="withdraw_with_fee"></span>$
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('withdraw-system')}}</div>
                                            <div class="text-end style-row-Invouce-text"><span
                                                        id="info_agency_name"></span></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="edit_customer_agency_acc_number_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الحساب</div>
                                            <div class="text-end style-row-Invouce-text" id="edit_customer_agency_acc_number">{{auth()->user()->wallet_code_symbol}}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="edit_customer_agency_acc_name_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم الحساب</div>
                                            <div class="text-end style-row-Invouce-text" id="edit_customer_agency_acc_name">{{auth()->user()->first_name}}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="edit_customer_soft_bank_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">عنوان البنك</div>
                                            <div class="text-end style-row-Invouce-text" id="edit_customer_soft_bank"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="edit_customer_address_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">سوفت البنك</div>
                                            <div class="text-end style-row-Invouce-text" id="edit_customer_address"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="recipient_name_transfer_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم المستلم</div>
                                            <div class="text-end style-row-Invouce-text" id="recipient_name_transfer"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="phone_number_transfer_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الجوال</div>
                                            <div class="text-end style-row-Invouce-text" id="phone_number_transfer"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="address_transfer_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">العنوان</div>
                                            <div class="text-end style-row-Invouce-text" id="address_transfer"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('account-number')}}</div>
                                            <div class="text-end style-row-Invouce-text"><span
                                                        id="info_account_number"></span></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('account-name')}}</div>
                                            <div class="text-end style-row-Invouce-text"><span
                                                        id="info_account_name"></span></div>
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
                                <button type="submit" id="save-form" data-bs-toggle="modal"
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
            <div class="modal-dialog modal-dialog-centered">
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
                                <div class="col-md-12 my-2">
                                    <div class="col-md-12">
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('amount')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_amount" name="success_operation_amount" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('our-fees')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_our-fees" name="success_operation_our-fees" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('total_withdraw_with_fee')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_total_withdraw_with_fee" name="success_operation_total_withdraw_with_fee" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('withdraw-system')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_withdraw-system" name="success_operation_withdraw-system" type="text">
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_edit_customer_agency_acc_number_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الحساب</div>
                                                <div class="text-end style-row-Invouce-text" id="success_edit_customer_agency_acc_number">{{auth()->user()->wallet_code_symbol}}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_edit_customer_agency_acc_name_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم الحساب</div>
                                                <div class="text-end style-row-Invouce-text" id="success_edit_customer_agency_acc_name">{{auth()->user()->first_name}}</div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_edit_customer_soft_bank_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">عنوان البنك</div>
                                                <div class="text-end style-row-Invouce-text" id="success_edit_customer_soft_bank"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_edit_customer_address_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">سوفت البنك</div>
                                                <div class="text-end style-row-Invouce-text" id="success_edit_customer_address"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_recipient_name_transfer_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم المستلم</div>
                                                <div class="text-end style-row-Invouce-text" id="success_recipient_name_transfer"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_phone_number_transfer_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الجوال</div>
                                                <div class="text-end style-row-Invouce-text" id="success_phone_number_transfer"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="success_address_transfer_cont" style="display: none;">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">العنوان</div>
                                                <div class="text-end style-row-Invouce-text" id="success_address_transfer"></div>
                                            </div>
                                        </div>
                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('account-number')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_account-number" name="success_operation_account-number" type="text">
                                            </div>
                                        </div>

                                        <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                            <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                                <div class="fw-bold pe-5 style-row-Invouce-tilte">{{cp('account-name')}}</div>
                                                <input class="text-end style-row-Invouce-text border-0"
                                                       id="success_operation_account-name" name="success_operation_account-name" type="text">
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class=" row justify-content-start my-3">
                                    <div class="d-flex flex-row justify-content-start">
                                        <button type="submit" data-type="image" class="success-operation-submit-btn btn mx-2 BntAdd-Modal" data-bs-toggle="modal"
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
                                        <button type="submit" data-type="pdf" class="success-operation-submit-btn btn mx-2 BntAdd-Modal-Download"
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

@endsection

@section("custom_js")



    <script type="text/javascript">
        $(document).ready(function () {
            $('#customCheck').attr('checked', false);
            $("#save-form").prop("disabled", true);
        });


        $(document).on("click", '.dropdown .dropdown-menu li.deposit_type', function () {
            // $('#customCheck').attr('checked', false);
            $("#info_agency_type").html($(this).html());
        });

        $('#form_agency_id').change(function () {
            $("#info_agency_type").html("");
            $("#selected_deposit_type").html("");
            $("#deposit_type").val("");
            // var data = JSON.parse($(this).attr('all_data'));
            var data = JSON.parse($('#form_agency_id').find('option:selected').attr('all_data'));
            console.log(data)

            $("#edit_customer_soft_bank_cont").attr("style", "display: none !important");
            $("#edit_customer_address_cont").attr("style", "display: none !important");
            $("#recipient_name_transfer_cont").attr("style", "display: none !important");
            $("#phone_number_transfer_cont").attr("style", "display: none !important");
            $("#address_transfer_cont").attr("style", "display: none !important");
            $("#edit_customer_agency_acc_number_cont").attr("style", "display: flex !important");
            $("#edit_customer_agency_acc_name_cont").attr("style", "display: flex !important");
            //success
            $("#success_edit_customer_soft_bank_cont").attr("style", "display: none !important");
            $("#success_edit_customer_address_cont").attr("style", "display: none !important");
            $("#success_recipient_name_transfer_cont").attr("style", "display: none !important");
            $("#success_phone_number_transfer_cont").attr("style", "display: none !important");
            $("#success_address_transfer_cont").attr("style", "display: none !important");
            $("#success_edit_customer_agency_acc_number_cont").attr("style", "display: flex !important");
            $("#success_edit_customer_agency_acc_name_cont").attr("style", "display: flex !important");
            
            let acc_number = '';
            if (data.wallet_number == null || data.wallet_number === undefined){
                acc_number = data.customer_agency_acc_number;
            }else{
                acc_number = data.wallet_number;
            }
            $("#edit_customer_agency_acc_number").text(acc_number);
            $("#success_edit_customer_agency_acc_number").text(acc_number);
            
            if (data.deposit_type == 12){
                $("#edit_customer_soft_bank").text(data.soft_bank);
                $("#edit_customer_address").text(data.customer_address);
                $("#edit_customer_soft_bank_cont").attr("style", "display: flex !important");
                $("#edit_customer_address_cont").attr("style", "display: flex !important");
                
                $("#success_edit_customer_soft_bank").text(data.soft_bank);
                $("#success_edit_customer_address").text(data.customer_address);
                $("#success_edit_customer_soft_bank_cont").attr("style", "display: flex !important");
                $("#success_edit_customer_address_cont").attr("style", "display: flex !important");
            }else if (data.deposit_type == 1){
                $("#recipient_name_transfer").text(data.recipient_name);
                $("#phone_number_transfer").text(data.phone_number);
                $("#address_transfer").text(data.customer_address);
                $("#recipient_name_transfer_cont").attr("style", "display: flex !important");
                $("#phone_number_transfer_cont").attr("style", "display: flex !important");
                $("#address_transfer_cont").attr("style", "display: flex !important");
                $("#edit_customer_agency_acc_number_cont").attr("style", "display: none !important");
                $("#edit_customer_agency_acc_name_cont").attr("style", "display: none !important");
                
                $("#success_recipient_name_transfer").text(data.recipient_name);
                $("#success_phone_number_transfer").text(data.phone_number);
                $("#success_address_transfer").text(data.customer_address);
                $("#success_recipient_name_transfer_cont").attr("style", "display: flex !important");
                $("#success_phone_number_transfer_cont").attr("style", "display: flex !important");
                $("#success_address_transfer_cont").attr("style", "display: flex !important");
                $("#success_edit_customer_agency_acc_number_cont").attr("style", "display: none !important");
                $("#success_edit_customer_agency_acc_name_cont").attr("style", "display: none !important");
            }
            
            $("#info_agency_ytadawul_account_number").text(data.agency.ytadawul_account_number);
            $("#info_agency_name").text(get_first_objectVal(data.agency.name));
            var amount = $("#form_amount").val();
            $("#info_amount").text(amount);
            // $("#info_account_number").text(data.customer_agency_acc_number);
            // $("#info_account_name").text(data.customer_agency_acc_name);
            $("#info_account_number").text(data.ytadawul_account_number);
            $("#info_account_name").text(data.ytadawul_account_name);
            $("#min_deposit_amount").val(data.min_deposit_amount);
            $("#max_deposit_amount").val(data.max_deposit_amount);
            $("#withdraw_instructions").html(data.withdraw_instructions);
            update_fee(data.agency.id, amount);
        });

        function update_fee(agency_id, amount) {
            var url = '{!! route('withdraw_percent', [':amount',':agency_id']) !!}';
            url = url.replace(':agency_id', agency_id);
            url = url.replace(':amount', amount);
            if (amount) {
                $.easyAjax({
                    url: url,
                    type: "get",
                    data: {},
                    success: function (response) {
                        $("#info_fees").html(response);
                        $("#sum_deposit_amount").val(response);
                        $("#withdraw_with_fee").html(+$("#sum_deposit_amount").val() + +amount);
                    }
                })
            }

        }

        $('.dropdown .dropdown-menu li.currency').click(function () {
            $("#info_selected_currency").html($(this).html());

        });

        $('#model_operation_close').click(function (e) {
            $('#model_balance').modal('hide');
        });
        $('#show_model').click(function (e) {

            $.easyAjax({
                url: '{{route('get_customer_balance')}}',
                container: '#form_data',
                type: "GET",
                success: function (response) {
                    var total_amount = +$("#sum_deposit_amount").val() + +$("#form_amount").val();
                    if (response.balance > total_amount) {

                        var deposit_agency_id = $("#form_agency_id").val();
                        var amount = +$("#form_amount").val();
                        var min = +$("#min_deposit_amount").val();
                        var max = +$("#max_deposit_amount").val();


                        if (deposit_agency_id > 0) {
                            if (amount <= max && amount >= min){
                                $.when(checkUserMasterKey($('#master_key').val(), '{{route('check_user_master_key')}}')).done(function(response){
                                    if (response.success){
                                        $('#model_operation').modal('show');
                                    }else{
                                        showErrorModal(response.message)
                                    }
                                })
                            }
                            else {
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
                            //     text: "يجب تحديد  الوكالة",
                            //     icon: 'error'
                            // });
                            $('#kt_modal_error_text').empty()
                            $('#kt_modal_error_text').append('{{cp("agency_id_field_is_required")}}')
                            $('#kt_modal_error').modal('show')
                        }

                    } else {

                        $('#model_balance').modal('show');
                    }
                }
            })


        });


        $('#form_amount').change(function () {

            var agency_id = $("#form_agency_id").val();
            var amount = $(this).val();
            $("#info_amount").text(amount);


            update_fee(agency_id, amount)
        });


        $('#customCheck').change(function () {

            var is_checked = $("#customCheck").is(":checked");

            if (is_checked)
                $("#save-form").prop("disabled", false);
            else
                $("#save-form").prop("disabled", true);

        });
        $('#cancel-withdraw').click(function (e) {
            $("#model_balance").modal('hide');
        });
        $('#save-form').click(function (e) {
            e.preventDefault();
            $("#save-form").prop("disabled", true);
            $("#save-form").text("{{cp('wait_process_to_finish')}}");
            $.easyAjax({
                url: '{{route('confirm_internal_withdraw')}}',
                container: '#form_data',
                type: "POST",
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    //$("#save-form").text(old_text);
                    $("#save-form").prop("disabled", false);
                    $("#save-form").prop("disabled", false);
                    {{--location.replace("{{route("list_internal_withdraw_orders")}}")--}}
{{--                    location.replace("{{route("list_deposit_withdraws")}}" + "#withdrawal_requests_tab")--}}
                    $('#success_operation_amount').val($("#info_amount").text())
                    $('#success_operation_our-fees').val($("#info_fees").text())
                    $('#success_operation_total_withdraw_with_fee').val($("#withdraw_with_fee").text() + '$')
                    $('#success_operation_withdraw-system').val($("#info_agency_name").text())
                    $('#success_operation_account-number').val($("#info_account_number").text())
                    $('#success_operation_account-name').val($("#info_account_name").text())
                    $('#kt_modal_success_operation').modal('show')
                }
                , custom_error: function () {
                    $("#save-form").prop("disabled", false);
                }

            })
        });

        $('.success-operation-submit-btn').click(function(e) {
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
                    let blob = new Blob([res],{type:'application/download'});
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'process_details_' + Math.round(Date.now() / 1000)  + '.pdf';
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

    </script>
@endsection
