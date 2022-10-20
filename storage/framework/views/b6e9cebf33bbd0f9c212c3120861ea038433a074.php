<?php $__env->startSection('content'); ?>
    <section>
        <div class="card m-5 ">
            <div class="card-body table-responsive style-card-body-tabs-processes">

                <ul class="nav nav-custom nav-tabs style-card-body-tabs-links-processes  nav-line-tabs nav-line-tabs-2x border-0 ">

                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-bs-toggle="tab"
                           href="#all_processes_tab">
                            <?php echo e(cp('processes')); ?>

                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-bs-toggle="tab"
                           href="#deposit_requests_tab">
                            <?php echo e(cp('processes_deposit')); ?>

                        </a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#withdrawal_requests_tab">
                            <?php echo e(cp('processes_withdraw')); ?>

                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#transfer_requests_tab">
                            <?php echo e(cp('processes_transfer')); ?>

                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#pay_bills_requests_tab">
                            <?php echo e(cp('processes_pay_bills')); ?>

                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#freelance_platforms_tab">
                            <?php echo e(cp('processes_withdrawing_profits_from_freelance_platforms')); ?>

                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Tab_digital_cards_Tabs">
                            بطاقاتي الرقمية
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Tab_Reports_and_data_Tabs">
                            التقارير والبيانات
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Tab_voucher_requests_Tabs">
                            القسائم الإلكترونية
                        </a>
                    </li>
                    <li class="nav-item d-none">
                        <a class="nav-link style-table-nav-link" data-kt-countup-tabs="true" data-bs-toggle="tab"
                           href="#kt_Tab_Security_Transfer_Requests_P2P_Tabs">
                            مدفوعات الضمان (P2P)
                        </a>
                    </li>

                </ul>


            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <?php echo $__env->make('wallet.processes.partials.all_processes_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('wallet.processes.partials.deposit_requests_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('wallet.processes.partials.withdrawal_requests_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('wallet.processes.partials.transfer_requests_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('wallet.processes.partials.pay_bills_requests_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('wallet.processes.partials.freelance_platforms_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

    </section>

    <div class="modal fade" id="deposit-order" tabindex="-1" role="dialog" aria-labelledby="modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
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

                            <span class="px-1"><?php echo e(cp('upload-payment-invoice')); ?></span>
                        </h2>

                    </div>

                    <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                        <i class="fas fa-times  style-icon-Close-Modal"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <div class="inner">
                        <div class="form-row form-row-date">
                            <div class="form-holder form-holder-2 col-md-12">
                                <div class="container" style="text-align: center;">
                                    <form id="data" method="post" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>

                                        <div class="row">
                                            <div class="col-md-12 col-md-offset-3 "
                                                 style="text-align: center;">
                                                <div class="btn-container">
                                                    <h1 class="imgupload"><i
                                                                class="zmdi zmdi-cloud-upload"
                                                                style="color: #0B4879;"></i>
                                                    </h1>
                                                    <h1 class="imgupload ok"><i
                                                                class="zmdi zmdi-check"></i></h1>
                                                    <h1 class="imgupload stop"><i
                                                                class="zmdi zmdi-close-circle"></i>
                                                    </h1>
                                                    <p id="namefile"><?php echo e(trans('lang.img-extension')); ?>

                                                        (jpg,jpeg,bmp,png)</p>
                                                    <button type="button" id="btnup" class="btn  btn-lg"
                                                            style="background-color: #0B4879; color: white">
                                                        <?php echo e(trans('lang.brows-imgs')); ?>

                                                    </button>
                                                    <input type="file" value="" name="fileup"
                                                           id="fileup">
                                                    <input type="hidden" name="order_id" id="model_order_id" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--additional fields-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_success_deposit" tabindex="-1" aria-hidden="true">
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

                            <span class="px-1"><?php echo e(cp('process_data')); ?></span>
                        </h2>
                    </div>

                    <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                        <i class="fas fa-times  style-icon-Close-Modal"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body scroll-y ">

                    <form method="" id="success_operation_form" action="#" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 my-2">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('process_number')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="kt_modal_success_deposit_process_number"
                                                   name="kt_modal_success_deposit_process_number" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('deposit_system')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="kt_modal_success_deposit_system"
                                                   name="kt_modal_success_deposit_system" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('agency')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="kt_modal_success_deposit_agency"
                                                   name="kt_modal_success_deposit_agency" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('amount_to_deposited_into_wallet_in_dollars')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="kt_modal_success_deposit_amount_in_dollars"
                                                   name="kt_modal_success_deposit_amount_in_dollars" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('deposit_commission')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="kt_modal_success_deposit_commission"
                                                   name="kt_modal_success_deposit_commission" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('amount_to_be_paid_currency')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="kt_modal_success_deposit_amount_to_paid"
                                                   name="kt_modal_success_deposit_amount_to_paid" type="text">
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
                                        <span class="px-1"><?php echo e(cp('recipient_data')); ?></span>
                                    </h2>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('recipient_name')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="recipient_name"><?php echo e(auth()->user()->first_name); ?></div>
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
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('phone-number')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="recipient_phone_number"><?php echo e(auth()->user()->phone); ?></div>
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
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('address')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="recipient_address"><?php echo e(auth()->user()->country->name); ?></div>
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
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('customer_acc_number')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="recipient_acc_number"><?php echo e(auth()->user()->wallet_code_symbol); ?></div>
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
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('email')); ?>

                                            </div>
                                            <div class="text-end style-row-Invouce-text" id="recipient_email"><?php echo e(auth()->user()->email); ?></div>
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

                            <div class=" row justify-content-start my-3">
                                <div class="d-flex flex-row justify-content-start">
                                    <button type="submit" data-type="image"
                                            class="success-operation-submit-btn btn mx-2 BntAdd-Modal"


                                    >
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.8333 2.5H4.16667C3.24619 2.5 2.5 3.24619 2.5 4.16667V15.8333C2.5 16.7538 3.24619 17.5 4.16667 17.5H15.8333C16.7538 17.5 17.5 16.7538 17.5 15.8333V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z"
                                                  stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M7.08203 8.33398C7.77239 8.33398 8.33203 7.77434 8.33203 7.08398C8.33203 6.39363 7.77239 5.83398 7.08203 5.83398C6.39168 5.83398 5.83203 6.39363 5.83203 7.08398C5.83203 7.77434 6.39168 8.33398 7.08203 8.33398Z"
                                                  stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M17.5013 12.5007L13.3346 8.33398L4.16797 17.5007"
                                                  stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span><?php echo e(cp('download_image')); ?></span>
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
                                        <span><?php echo e(cp('download_pdf')); ?></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_success_withdraw" tabindex="-1" aria-hidden="true">
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

                            <span class="px-1"><?php echo e(cp('process_data')); ?></span>
                        </h2>
                    </div>

                    <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                        <i class="fas fa-times  style-icon-Close-Modal"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body scroll-y ">

                    <form method="" id="" action="#" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-12 my-2">
                                <div class="col-md-12">
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('amount')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="withdraw_modal_amount" name="success_operation_amount" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('our-fees')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="withdraw_modal_our_fees" name="success_operation_our-fees" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('total_withdraw_with_fee')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="withdraw_modal_total_withdraw_with_fee" name="success_operation_total_withdraw_with_fee" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('withdraw-system')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="withdraw_modal_system" name="success_operation_withdraw-system" type="text">
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="edit_customer_agency_acc_number_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الحساب</div>
                                            <div class="text-end style-row-Invouce-text" id="edit_customer_agency_acc_number"><?php echo e(auth()->user()->wallet_code_symbol); ?></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100" id="edit_customer_agency_acc_name_cont" style="display: none;">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم الحساب</div>
                                            <div class="text-end style-row-Invouce-text" id="edit_customer_agency_acc_name"><?php echo e(auth()->user()->first_name); ?></div>
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
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('account-number')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="withdraw_modal_account_number" name="success_operation_account-number" type="text">
                                        </div>
                                    </div>

                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100 d-none">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('account-name')); ?></div>
                                            <input class="text-end style-row-Invouce-text border-0"
                                                   id="withdraw_modal_account_name" name="success_operation_account-name" type="text">
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
                                        <span><?php echo e(cp('download_image')); ?></span>
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
                                        <span><?php echo e(cp('download_pdf')); ?></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js"); ?>
    <script type="text/javascript">
        let allowed_hash = ['#all_processes_tab', '#deposit_requests_tab', '#withdrawal_requests_tab', '#pay_bills_requests_tab', '#processes_withdrawing_profits_from_freelance_platforms'];

        let hash = window.location.hash;
        if (!hash || !allowed_hash.includes(hash)) {
            hash = '#all_processes_tab';
        }

        let anchor_element = document.querySelectorAll("a[href='" + hash + "']");
        anchor_element = anchor_element[0];

        let div_element = document.getElementById("" + hash.replace("#", "") + "");

        anchor_element.classList.add('active')
        div_element.classList.add('active')

        $(document).on("click", '.show_add_file_model', function (e) {
            e.preventDefault();
            $('#namefile').html('');
            $(".imgupload").show("fast");
            $(".imgupload.stop").hide("fast");
            $(".imgupload.ok").hide("fast");
            var order_id = $(this).data('order_id');
            $('#model_order_id').val(order_id);
            $('#deposit-order').modal('show');
        });

        $('#fileup').change(function () {

            // Check file selected or not
            // if (files.length > 0)

//here we take the file extension and set an array of valid extensions
            var res = $('#fileup').val();
            var arr = res.split("\\");
            var filename = arr.slice(-1)[0];
            filextension = filename.split(".");
            filext = "." + filextension.slice(-1)[0];
            valid = [".jpg", ".png", ".jpeg", ".bmp"];
//if file is not valid we show the error icon, the red alert, and hide the submit button
            if (valid.indexOf(filext.toLowerCase()) == -1) {
                $(".imgupload").hide("slow");
                $(".imgupload.ok").hide("slow");
                $(".imgupload.stop").show("slow");

                $('#namefile').css({"color": "red", "font-weight": 700});
                $('#namefile').html("File " + filename + " is not  pic!");

                $("#submitbtn").hide();
                $("#fakebtn").show();
            } else {
                var formData = new FormData($("form#data")[0]);
                var order_id = $("#model_order_id").val();

                $.ajax({
                    url: "<?php echo e(route('saveOrderImage')); ?>",
                    type: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        $("#img_path_" + order_id).attr("src", response.data);
                        $.toast({
                            heading: "success",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: response.message,
                            icon: 'success'
                        });

                        $('#deposit-order').modal('hide');
                    }
                });


                $(".imgupload").hide("slow");
                $(".imgupload.stop").hide("slow");
                $(".imgupload.ok").show("slow");

                $('#namefile').css({"color": "green", "font-weight": 700});
                $('#namefile').html(filename);

                $("#submitbtn").show();
                $("#fakebtn").hide();
            }
        });

        $('.success-operation-submit-btn').click(function (e) {
            e.preventDefault();
            let data = $('#success_operation_form').serialize()
            data += '&download=' + $(this).data('type')

            $.ajax({
                url: '<?php echo e(route('wallet.export_pdf_image')); ?>',
                // container: '#success_operation_form',
                data: data,
                type: "POST",
                // redirect: true,
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: function () {
                    $(".success-operation-submit-btn").attr("disabled", true);
                    
                },
                success: function (res) {
                    let blob = new Blob([res], {type: 'application/download'});
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'process_details_' + Math.round(Date.now() / 1000) + '.pdf';
                    link.click();
                    $(".success-operation-submit-btn").attr("disabled", false);
                    location.replace("<?php echo e(route("list_deposit_withdraws")); ?>" + "#deposit_requests_tab")
                }, error: function (response) {
                    console.log('res', response);
                    console.log('txt', JSON.parse(response.responseText));
                    console.log('jss', response.responseJSON.errors);
                    $('#nameError').text(response.responseJSON.errors.currency_iid);

                    $(".success-operation-submit-btn").prop("disabled", false);
                    $(".success-operation-submit-btn").text('<?php echo e(trans('lang.confirm')); ?>');
                },
            })
        })
        
        $('.show-deposit-details-modal').click(function(){
            $('#kt_modal_success_deposit_process_number').val($(this).attr('order_id'))
            $('#kt_modal_success_deposit_system').val($(this).attr('order_method'))
            $('#kt_modal_success_deposit_agency').val($(this).attr('order_agency'))
            $('#kt_modal_success_deposit_amount_in_dollars').val($(this).attr('order_amount'))
            $('#kt_modal_success_deposit_commission').val($(this).attr('order_commission'))
            $('#kt_modal_success_deposit_amount_to_paid').val($(this).attr('order_total_amount') + ' ' + $(this).attr('order_currency'))
            $('#kt_modal_success_deposit').modal('show')
        })

        $('.show-withdraw-details-modal').click(function(){
            $('#withdraw_modal_amount').val($(this).attr('order_amount'))
            $('#withdraw_modal_our_fees').val($(this).attr('order_commission'))
            $('#withdraw_modal_total_withdraw_with_fee').val($(this).attr('order_total_amount') + ' ' + $(this).attr('order_currency'))
            // console.log($(this).attr('order_agency'))
            // console.log($(this).attr('order_account_number'))
            // console.log($(this).attr('order_account_name'))
            $('#withdraw_modal_system').val($(this).attr('order_agency'))
            $('#withdraw_modal_account_number').val($(this).attr('order_account_number'))
            $('#withdraw_modal_account_name').val($(this).attr('order_account_name'))

            $("#edit_customer_soft_bank_cont").attr("style", "display: none !important");
            $("#edit_customer_address_cont").attr("style", "display: none !important");
            $("#recipient_name_transfer_cont").attr("style", "display: none !important");
            $("#phone_number_transfer_cont").attr("style", "display: none !important");
            $("#address_transfer_cont").attr("style", "display: none !important");
            $("#edit_customer_agency_acc_number_cont").attr("style", "display: flex !important");
            $("#edit_customer_agency_acc_name_cont").attr("style", "display: flex !important");

            var data = JSON.parse($(this).attr('all_data'));
            
            let acc_number = '';
            if (data.wallet_number == null || data.wallet_number === undefined){
                acc_number = data.customer_agency_acc_number;
            }else{
                acc_number = data.wallet_number;
            }
            $("#edit_customer_agency_acc_number").text(acc_number);

            if (data.user_deposit_type == 12){
                $("#edit_customer_soft_bank").text(data.soft_bank);
                $("#edit_customer_address").text(data.customer_address);
                $("#edit_customer_soft_bank_cont").attr("style", "display: flex !important");
                $("#edit_customer_address_cont").attr("style", "display: flex !important");
            }else if (data.user_deposit_type == 1){
                $("#recipient_name_transfer").text(data.recipient_name);
                $("#phone_number_transfer").text(data.phone_number);
                $("#address_transfer").text(data.customer_address);
                $("#recipient_name_transfer_cont").attr("style", "display: flex !important");
                $("#phone_number_transfer_cont").attr("style", "display: flex !important");
                $("#address_transfer_cont").attr("style", "display: flex !important");
                $("#edit_customer_agency_acc_number_cont").attr("style", "display: none !important");
                $("#edit_customer_agency_acc_name_cont").attr("style", "display: none !important");
            }
            
            $('#kt_modal_success_withdraw').modal('show')
        })
    </script>
<?php $__env->stopSection(); ?>    
<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/processes/index.blade.php ENDPATH**/ ?>