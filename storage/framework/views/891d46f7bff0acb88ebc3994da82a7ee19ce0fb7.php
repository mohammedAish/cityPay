<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    <?php echo e(cp('protection_and_security_title')); ?>

                                                </span>
                </h1>

            </div>
        </div>
    </div>

    <div class="card-body">

        <form>
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-5">
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-bold form-label style-label-form mb-2"
                                   style="color:#1B3160;"><?php echo e(cp('successful_license_notification')); ?></label>
                            <select name="confirmation_notification" id="confirmation_notification"
                                    data-control="select2"
                                    data-placeholder="<?php echo e(cp('successful_license_notification_placeholder')); ?>"
                                    data-hide-search="true"
                                    class="form-select style-select-profile style-label-form  ">
                                
                                <option value="0" <?php if(auth()->user()->confirmation_notification == 0): ?> selected <?php endif; ?>><?php echo e(cp('never_send_a_verification_code')); ?></option>
                                <option value="2" <?php if(auth()->user()->confirmation_notification == 2): ?> selected <?php endif; ?>><?php echo e(cp('ip_send_when_address_change')); ?></option>
                                <option value="1" <?php if(auth()->user()->confirmation_notification == 1): ?> selected <?php endif; ?>><?php echo e(cp('always_send_code')); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="col-md-5">
                        <div class="fv-row mb-10">
                            <label class="fs-6 fw-bold form-label style-label-form mb-2"
                                   style="color:#1B3160;"><?php echo e(cp('confirmation_method')); ?></label>
                            <select name="confirmation_method" id="confirmation_method" data-control="select2"
                                    data-placeholder="<?php echo e(cp('confirmation_method_placeholder')); ?>"
                                    data-hide-search="true"
                                    class="form-select style-select-profile style-label-form  ">
                                <option value="0" <?php if(auth()->user()->confirmation_method == 0): ?> selected <?php endif; ?>><?php echo e(cp('e-mail')); ?></option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                                    <span class="fw-bolder mb-2 text-dark">
                                                        <?php echo e(cp('master_key')); ?>

                                                    </span>
                        </h1>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-5">
                        <div class="fv-row mb-2 mt-5">
                            <div class="form-check">
                                <input name="is_master_key_enabled"
                                       <?php if(auth()->user()->is_master_key_enabled == 1): ?> checked <?php endif; ?>
                                       class="form-check-input" type="checkbox" value=""
                                       id="masterKeyCheckbox"/>
                                <label class="form-check-label style-label-form" for="masterKeyCheckbox">
                                    <?php echo e(cp('enable_master_key')); ?>

                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-5">
                        <div class="fv-row mb-10 mt-2">
                            <button type="button" id="protectionSecurityBtn"
                                    
                                    
                                    class="form-control BntAdd-Modal"><?php echo e(cp('confirm')); ?>

                            </button>




                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="kt_modal_master_key" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-350px">
        <div class="modal-content">
            <div class="modal-header">
                <!--begin::Modal title-->
                <div>
                    <h2 class="fw-bolder style-Address-Modal">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.4998 7.5L18.9998 4M20.9998 2L18.9998 4L20.9998 2ZM11.3898 11.61C11.9061 12.1195 12.3166 12.726 12.5975 13.3948C12.8785 14.0635 13.0244 14.7813 13.0268 15.5066C13.0292 16.232 12.8882 16.9507 12.6117 17.6213C12.3352 18.2919 11.9288 18.9012 11.4159 19.4141C10.903 19.9271 10.2937 20.3334 9.62309 20.6099C8.95247 20.8864 8.23379 21.0275 7.50842 21.025C6.78305 21.0226 6.06533 20.8767 5.39658 20.5958C4.72782 20.3148 4.12125 19.9043 3.61179 19.388C2.60992 18.3507 2.05555 16.9614 2.06808 15.5193C2.08061 14.0772 2.65904 12.6977 3.67878 11.678C4.69853 10.6583 6.078 10.0798 7.52008 10.0673C8.96216 10.0548 10.3515 10.6091 11.3888 11.611L11.3898 11.61ZM11.3898 11.61L15.4998 7.5L11.3898 11.61ZM15.4998 7.5L18.4998 10.5L21.9998 7L18.9998 4L15.4998 7.5Z"
                                  stroke="#9B9B9B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="px-1"><?php echo e(cp('master_key')); ?></span>
                    </h2>
                    <h2 class="pt-1">
                        <span class="style-bio-Modal-trasfer"><?php echo e(cp('please_enter_3_numbers')); ?></span>
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
                        <div class="col-md-12 mx-4 mb-4">
                            <div class="d-flex  flex-row mw-md-600px w-100">
                                                    <span>
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal"
                                                                id="masterKeySubmitBtn">OK</button>
                                                    </span>
                                <span class="px-3">
                                                        <input type="number" readonly style="width:185px;" class="form-control"
                                                               placeholder="XXX" id="masterKeysInput" value="<?php echo e(auth()->user()->is_master_key_enabled == 1 ? auth()->user()->master_key : ''); ?>"/>
                                                    </span>
                            </div>
                            <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">9</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">8</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">7</button>
                                                    </span>

                            </div>
                            <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">6</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">5</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">4</button>
                                                    </span>

                            </div>
                            <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">3</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">2</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number master_keys">1</button>
                                                    </span>

                            </div>
                            <div class="d-flex  mt-3  flex-row mw-md-600px w-100">
                                                    <span class="px-1">
                                                        <button type="button" class="btn style-btn-calut-modal-number"
                                                                style="width:165px;" id="backSpaceBtn">BKSP</button>
                                                    </span>
                                <span class="px-1">
                                                        <button type="button"
                                                                class="btn style-btn-calut-modal-number">0</button>
                                                    </span>

                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {

        $('#protectionSecurityBtn').click(function () {
            // e.preventDefault();
            let is_master_key_enabled = $('#masterKeyCheckbox').prop("checked") ? 1 : 0;

            if (is_master_key_enabled) {
                $('#kt_modal_master_key').modal('show')
                return
            }

            sendProtectionSecurityRequest()
        });

        $('.master_keys').click(function (e) {
            const key = e.target
            const keyContent = key.textContent

            // $('#masterKeysInput').val();
            let masterKeysInput = document.getElementById('masterKeysInput');
            let value = masterKeysInput.value;

            if (value.length > 2) {
                return
            }

            masterKeysInput.value = value + keyContent;
        });

        $('#backSpaceBtn').click(function (e) {
            let masterKeysInputValue = $('#masterKeysInput').val()
            $('#masterKeysInput').val(masterKeysInputValue.substr(0, masterKeysInputValue.length - 1))
        });


        $('#masterKeySubmitBtn').click(function (e) {
            let masterKeysInputValue = $('#masterKeysInput').val()
            if (masterKeysInputValue.length <= 2) {
                return
            }
            sendProtectionSecurityRequest()
        })

        function sendProtectionSecurityRequest() {
            let confirmationNotification = $('#confirmation_notification').find("option:selected").val();
            let confirmationMethod = $('#confirmation_method').find("option:selected").val();
            let isMasterKeyEnabled = $('#masterKeyCheckbox').prop("checked") ? 1 : 0;
            let masterKeysInputValue = $('#masterKeysInput').val();

            $.ajax({
                url: '<?php echo e(route('update_protection_and_security')); ?>',
                type: "post",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    confirmation_notification: confirmationNotification,
                    confirmation_method: confirmationMethod,
                    is_master_key_enabled: isMasterKeyEnabled,
                    master_key: masterKeysInputValue,
                },
                success: function (response) {
                    if (response.success){
                        $('#kt_modal_master_key').modal('hide')
                        showSuccessModal(response.message)
                    }else{
                        showErrorModal(response.message)
                    }
                    
                    // $('#kt_modal_enter_code_modal').modal('show')
                }, error: function (response) {
                    if (xhr.status === 422) {
                        let response = $.parseJSON(xhr.responseText);
                        $.each(response.errors, function (key, value) {
                            showErrorModal(value[0])
                        });
                    }
                },
            })

        }
    });

</script><?php /**PATH /home/ytadawu1/wallet-main/resources/views/profile/partials/protection_and_security.blade.php ENDPATH**/ ?>