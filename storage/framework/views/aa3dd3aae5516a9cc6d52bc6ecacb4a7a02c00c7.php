<?php $__env->startSection('content'); ?>
    <section class="m-5">
        <div class="row my-3">
            <div class="col-md-12 ">
                <div class="page-title style-boder-titel-card d-flex flex-column   ">
                    <h1 class="style-title-card px-4 py-4">
                                    <span class="fw-bolder mb-2 text-dark">
                                        <?php echo e(trans('lang.my-finical-accounts')); ?>

                                    </span>
                    </h1>

                </div>
            </div>
        </div>
        <div class="row style-right mx-3 my-3">
            <div class="col-md-3 my-3">
                <div class=" card style-card-Add-account-money">
                    <a href="<?php echo e(route('wallet.add_finance_account')); ?>" class="card-body">
                        <svg width="60" height="40" viewBox="0 0 40 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.9566 15.6235H14.2695M19.9566 10.1396V15.6235V10.1396ZM19.9566 15.6235V21.1073V15.6235ZM19.9566 15.6235H25.6438H19.9566Z"
                                  stroke-width="2" stroke-linecap="round" stroke-dasharray="6 6"/>
                            <path d="M23.7484 30.247C30.8971 30.247 34.4724 30.247 36.6923 28.1047C38.9141 25.9642 38.9141 22.5167 38.9141 15.6235C38.9141 8.73036 38.9141 5.28286 36.6923 3.14234C34.4724 1 30.8971 1 23.7484 1H16.1656C9.01693 1 5.44163 1 3.22176 3.14234C1 5.28286 1 8.73036 1 15.6235C1 22.5167 1 25.9642 3.22176 28.1047C4.45966 29.3002 6.1184 29.8284 8.58281 30.0606"
                                  stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-dasharray="6 6"/>
                            <path d="M23.7489 30.2468C21.4059 30.2468 18.8239 31.1608 16.4675 32.3398C12.6799 34.2354 10.7861 35.1841 9.85344 34.579C8.92076 33.9758 9.09706 32.1022 9.45155 28.3567L9.53117 27.5049"
                                  stroke-width="2" stroke-linecap="round" stroke-dasharray="6 6"/>
                        </svg>
                        <p class="style-card-Add-account-money-title"><?php echo e(trans('lang.add_account')); ?></p>
                    </a>
                </div>
            </div>

            <?php $__currentLoopData = $finance_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($account->agency!=null): ?>
                    <div class="col-md-3 my-3 edit_customer_agency_btn" 
                         account_id="<?php echo e($account->id); ?>" 
                         agency_name="<?php echo e($account->agency->name); ?>"
                         agency_id="<?php echo e($account->agency_id); ?>"
                         all_data="<?php echo e($account); ?>"
                    >
                        <div class=" card style-card-Add-account-money-img">
                            <div class="card-body">
                                <img src="<?php echo e(asset($account->agency->img_path)); ?>" width="70px" class="py-4"/>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!--begin::Modal title-->
        <div class="modal fade" id="kt_modal_Recipient_data" tabindex="-1" aria-hidden="true">
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
                        <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
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
                                        <input type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <label class="style-label-form">رقم الهاتف</label>
                                        <input type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <label class="style-label-form">عنوان المستلم</label>
                                        <input type="text" class="form-control"/>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <label class="style-label-form">البريد الالكتروني</label>
                                        <input type="email" class="form-control"/>
                                    </div>
                                    <div class="col-md-12 my-3">
                                        <label class="style-label-form">رقم الحساب </label>
                                        <input type="text" class="form-control"/>
                                    </div>
                                </div>
                            </div>


                            <div class="modal-footer flex-center">
                                <button type="button" class="btn BntAdd-Modal" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_Transfer_money_around_world">
                                    ارسال طلب التحويل
                                </button>
                                <button type="reset" class="btn BntAdd-Modal-close" data-bs-dismiss="modal"
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

        <!--begin::Modal title-->
        <div class="modal fade" id="kt_modal_Transfer_Now" tabindex="-1" aria-hidden="true">
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
                                <button type="submit" data-bs-toggle="modal" data-bs-target="#kt_modal_Succes"
                                        class="btn col-md-12  BntAdd-Modal">
                                    تأكيد
                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>


        <div class="modal fade" id="kt_modal_view_Account_Money" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-450px">
                <div class="modal-content">
                    <!--<div class="modal-header" style="border:none!important;">
            <h2 class="fw-bolder style-Address-Modal">
            </h2>
            <div data-bs-dismiss="modal" aria-label="Close" data-kt-users-modal-action="close">
                <i class="fas fa-times  style-icon-Close-Modal"></i>
            </div>-->
                    <!--end::Close-->
                    <!--</div>-->


                    <div class="modal-body scroll-y ">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex  flex-column mw-md-600px w-100">
                                    <div class="d-flex  flex-row justify-content-center mx-3 text-gray-800 my-3 fs-6">
                                        <img src="assets/media/imagesWebsite/monycurreny2.png" id="agency_img" width="100px"/>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100">
                                    <div class="d-flex  flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">الوكالة:</div>
                                        <div class="text-end style-row-Invouce-text" id="edit_agency_name"></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="edit_customer_agency_acc_number_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الحساب</div>
                                        <div class="text-end style-row-Invouce-text" id="edit_customer_agency_acc_number"><?php echo e(auth()->user()->wallet_code_symbol); ?></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="edit_customer_agency_acc_name_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم الحساب</div>
                                        <div class="text-end style-row-Invouce-text" id="edit_customer_agency_acc_name"><?php echo e(auth()->user()->first_name); ?></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="edit_customer_soft_bank_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">عنوان البنك</div>
                                        <div class="text-end style-row-Invouce-text" id="edit_customer_soft_bank"></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="edit_customer_address_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">سوفت البنك</div>
                                        <div class="text-end style-row-Invouce-text" id="edit_customer_address"></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="recipient_name_transfer_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">اسم المستلم</div>
                                        <div class="text-end style-row-Invouce-text" id="recipient_name_transfer"></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="phone_number_transfer_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">رقم الهاتف</div>
                                        <div class="text-end style-row-Invouce-text" id="phone_number_transfer"></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100" id="address_transfer_cont">
                                    <div class="d-flex flex-row mx-3 text-gray-800 my-3 fs-6">
                                        <div class="fw-bold pe-5 style-row-Invouce-tilte">عنوان المستلم</div>
                                        <div class="text-end style-row-Invouce-text" id="address_transfer"></div>
                                    </div>
                                </div>
                                <div class="d-flex  flex-column mw-md-600px w-100">
                                    <div class="d-flex flex-row justify-content-end my-3 fs-6">
                                        <a href="#" id="edit_link"
                                           class="text-start style-row-Invouce-text">
                                            <svg width="17" height="21" viewBox="0 0 17 21" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.5322 0.00153463C11.2809 -0.00679467 11.026 0.0186916 10.774 0.0802005C10.102 0.244224 9.54854 0.645099 9.21253 1.19184L8.50107 2.37646C8.34295 2.63161 8.4417 2.97816 8.71841 3.12396L12.1379 4.94645C12.2367 5.00112 12.3355 5.01906 12.4344 5.01906C12.4937 5.01906 12.533 5.01913 12.5923 5.00091C12.7504 4.96446 12.8691 4.87326 12.9482 4.74569L13.6793 3.56107C14.0153 3.01433 14.1143 2.37674 13.9364 1.7571C13.7585 1.13746 13.3238 0.627088 12.7308 0.317266C12.3603 0.123627 11.9511 0.0154169 11.5322 0.00153463ZM7.72977 4.09465C7.5383 4.10818 7.35455 4.20357 7.25572 4.36304L1.28686 13.9129C0.614853 14.97 0.239474 16.1547 0.160414 17.3575L0.00213979 19.7086C-0.0176252 19.909 0.100965 20.1093 0.298614 20.2187C0.397439 20.2733 0.496264 20.2916 0.595088 20.2916C0.713678 20.2916 0.832113 20.2552 0.930938 20.2005L3.06571 18.9066C4.15278 18.2323 5.08173 17.3392 5.73398 16.2822L11.7229 6.73227C11.881 6.47712 11.7819 6.13092 11.5052 5.98512C11.2285 5.83932 10.853 5.93038 10.6949 6.18552L4.70635 15.7354C4.13317 16.6284 3.34234 17.4122 2.39362 17.9954L1.24749 18.6877L1.32624 17.4305C1.38553 16.3917 1.72161 15.3709 2.2948 14.4597L8.28373 4.90978C8.44185 4.65464 8.3431 4.30844 8.0664 4.16264C7.96263 4.10796 7.84466 4.08653 7.72977 4.09465ZM5.53633 19.1981C5.20032 19.1981 4.94338 19.4351 4.94338 19.7449C4.94338 20.0547 5.20032 20.2916 5.53633 20.2916H13.4423C13.7783 20.2916 14.0353 20.0547 14.0353 19.7449C14.0353 19.4351 13.7783 19.1981 13.4423 19.1981H5.53633ZM16.4071 19.1981C16.2498 19.1981 16.099 19.2557 15.9878 19.3583C15.8766 19.4608 15.8141 19.5999 15.8141 19.7449C15.8141 19.8899 15.8766 20.029 15.9878 20.1315C16.099 20.234 16.2498 20.2916 16.4071 20.2916C16.5643 20.2916 16.7151 20.234 16.8263 20.1315C16.9375 20.029 17 19.8899 17 19.7449C17 19.5999 16.9375 19.4608 16.8263 19.3583C16.7151 19.2557 16.5643 19.1981 16.4071 19.1981Z"
                                                      fill="#1B3160"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("custom_js"); ?>
    <script type="text/javascript">
        $('.edit_customer_agency_btn').click(function () {
            var data = JSON.parse($(this).attr('all_data'));
            console.log(data)
            
            $('#agency_img').prop('src', '<?php echo e(asset('/')); ?>' + data.img_path)
            $("#edit_agency_name").text($(this).attr('agency_name'));
            let acc_number = '';
            if (data.wallet_number == null || data.wallet_number === undefined){
                acc_number = data.customer_agency_acc_number;
            }else{
                acc_number = data.wallet_number;
            }
            $("#edit_customer_agency_acc_number").text(acc_number);

            $("#edit_customer_soft_bank_cont").attr("style", "display: none !important");
            $("#edit_customer_address_cont").attr("style", "display: none !important");
            $("#recipient_name_transfer_cont").attr("style", "display: none !important");
            $("#phone_number_transfer_cont").attr("style", "display: none !important");
            $("#address_transfer_cont").attr("style", "display: none !important");
            $("#edit_customer_agency_acc_number_cont").attr("style", "display: flex !important");
            $("#edit_customer_agency_acc_name_cont").attr("style", "display: flex !important");
            
            if (data.deposit_type == 12){
                $("#edit_customer_soft_bank").text(data.soft_bank);
                $("#edit_customer_address").text(data.address);
                $("#edit_customer_soft_bank_cont").attr("style", "display: flex !important");
                $("#edit_customer_address_cont").attr("style", "display: flex !important");
            }else if (data.deposit_type == 1){
                $("#recipient_name_transfer").text(data.recipient_name);
                $("#phone_number_transfer").text(data.phone_number);
                $("#address_transfer").text(data.address);
                $("#recipient_name_transfer_cont").attr("style", "display: flex !important");
                $("#phone_number_transfer_cont").attr("style", "display: flex !important");
                $("#address_transfer_cont").attr("style", "display: flex !important");
                $("#edit_customer_agency_acc_number_cont").attr("style", "display: none !important");
                $("#edit_customer_agency_acc_name_cont").attr("style", "display: none !important");
            }
            
            // $("#edit_customer_agency_acc_name").text(data.customer_agency_acc_name);
            
            var agency_id = $(this).attr('agency_id');
            $('#edit_link').prop('href', '<?php echo e(url('')); ?>' + '/wallet/my_accounts/' + $(this).attr('account_id'))
            $("#edit_agency_id").val(agency_id);
            $('#kt_modal_view_Account_Money').modal('show');
        });

        $('#edit_customer_agency').click(function () {

            $.easyAjax({
                url: '<?php echo e(route('wallet.save_new_account')); ?>',
                container: '#form_data',
                type: "POST",
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    $("#account_" + response.data.id).text(response.data.customer_agency_acc_number);
                    $("#edit_customer_agency_btn" + response.data.id).prop("agency_id", response.data.customer_agency_acc_number);
                    $('#detail').modal('hide');

                    
                }
            })
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/myaccounts2.blade.php ENDPATH**/ ?>