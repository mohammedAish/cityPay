<?php $__env->startSection('content'); ?>
    <section class="m-5">
        <div class="card m-5 ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                        <span class="fw-bolder mb-2 text-dark">
                                            <?php echo e(cp('pay_purchase_bills')); ?>

                                        </span>
                        </h1>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" id="form_data" action="<?php echo e(route('confirm_paying_order')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form"><?php echo e(cp('product-name')); ?></label>
                                    <input type="text" id="form_product_name" name="product_name"
                                           placeholder="<?php echo e(cp('product_name_placeholder')); ?>" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form"><?php echo e(cp('product-link')); ?></label>
                                    <input type="url" name="link_url" id="form_link_url"
                                           placeholder="<?php echo e(cp('product_link_placeholder')); ?>" class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form"><?php echo e(cp('product-desc')); ?></label>
                                    <textarea id="form_description" name="description"
                                              placeholder="<?php echo e(cp('product_desc_placeholder')); ?>" class="form-control"
                                              rows="3"></textarea>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form"><?php echo e(cp('buy-time')); ?></label>
                                    <input type="datetime-local" id="form_paying_date" name="paying_date"
                                           placeholder="product_buy_time_placeholder"
                                           class="form-control"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <label class="style-label-form"><?php echo e(cp('amount')); ?></label>
                                    <div class="input-group">
                                        <input type="text" name="product_price" min="1" id="form_amount"
                                               class="style-input-radiuse form-control "/>
                                        <span class="input-group-text text-white style-select-profile-curreny"
                                              id="basic-addon2">
                                                        USD
                                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10 my-2">
                                    <button type="button" id="show_model"
                                            
                                            class="form-control BntAdd-Modal"><?php echo e(cp('send_pay_bills_order')); ?>

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
                                                        <?php echo cp('welcome_to_ctpay_wallet'); ?>

                                                    </h2>


                                                    <p class="style-box-wallet-info-Big-Title-text">
                                                        <?php echo cp('withdraw_instructions_text'); ?>

                                                    </p>
                                                    <p class="style-box-wallet-info-Big-list-info-text">
                                                        <?php echo cp('withdraw_instructions_description'); ?>

                                                    </p>
                                                    <ul class=" style-box-wallet-info-Big-list-info">

                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white"></i>
                                                            <?php echo e(cp('withdraw_instructions_step_1')); ?>

                                                        </li>
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white"></i>
                                                        <?php echo e(cp('withdraw_instructions_step_2')); ?>

                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white"></i>
                                                            <?php echo e(cp('withdraw_instructions_step_3')); ?>

                                                        </li>
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white"></i>
                                                            <?php echo e(cp('withdraw_instructions_step_4')); ?>

                                                        </li>
                                                        <li class="style-box-wallet-info-Big-list-info-text">
                                                            <i class="fas fa-check text-white"></i>
                                                            <?php echo e(cp('withdraw_instructions_step_5')); ?>

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

                                <span class="px-1"><?php echo e(cp('transaction-detail')); ?> </span>
                            </h2>
                            <h2 class="pt-1">
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="6.5" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.85894 4.24978C7.85894 4.44922 7.69727 4.61089 7.49783 4.61089C7.29839 4.61089 7.13672 4.44922 7.13672 4.24978C7.13672 4.05035 7.29839 3.88867 7.49783 3.88867C7.69727 3.88867 7.85894 4.05035 7.85894 4.24978Z"
                                          fill="#E51C39" stroke="#E51C39" stroke-width="1.5"/>
                                    <path d="M7.5 11.1112V6.05566" stroke="#E51C39" stroke-width="1.5"/>
                                </svg>
                                <span class="style-bio-Modal-trasfer"><?php echo e(cp('please_review_all_enterd_data')); ?></span>
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
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('product-name')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="info_product_name"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('product-name')); ?></div>
                                            <div class="text-end style-row-Invouce-text">
                                                <a href="" target="_blank" id="info_link_url"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('product-desc')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="info_description"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('buy-time')); ?></div>
                                            <div class="text-end style-row-Invouce-text" id="info_paying_date"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex style-border-row-Invouce flex-column mw-md-600px w-100">
                                        <div class="d-flex flex-stack mx-3 text-gray-800 my-3 fs-6">
                                            <div class="fw-bold pe-5 style-row-Invouce-tilte"><?php echo e(cp('bill-amount')); ?></div>
                                            <div class="text-end style-row-Invouce-text"><span id="info_amount"></span><span>$</span></div>
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
                                                            <?php echo e(cp('all_previous_information_correct')); ?>

                                                        </label>
                                                    </span>
                                    </h1>
                                </div>
                            </div>


                            <div class="modal-footer row flex-center">
                                <button type="button" id="save-form"
                                        class="btn col-md-12  BntAdd-Modal">
                                    <?php echo e(cp('confirm')); ?>

                                </button>

                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("custom_js"); ?>
    <script type="text/javascript">
        //todo OSAMA must show to the customer the $paying_order_comms it is available now and the final price will be
        // price+ (price* $paying_order_comms)

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

            var form_product_name = $("#form_product_name").val();
            var form_link_url = $("#form_link_url").val();
            var form_description = $("#form_description").val();
            var form_amount = $("#form_amount").val();
            var form_paying_date = $("#form_paying_date").val();


            if (form_paying_date != "" && form_link_url != "" && form_amount != "" && form_description != "" && form_product_name != "") {
                $('#model_operation').modal('show');
                $("#info_product_name").html($("#form_product_name").val());
                $("#info_link_url").attr('href', $("#form_link_url").val());
                $("#info_link_url").html($("#form_link_url").val());
                $("#info_description").html($("#form_description").val());
                $("#info_paying_date").html($("#form_paying_date").val());
                $("#info_amount").html($("#form_amount").val());

            } else {
                // $.toast({
                //     heading: "error",
                //     position: {
                //         right: 10,
                //         top: 10
                //     },
                //     text: "يجب اكمال جميع البيانات",
                //     icon: 'error'
                // });
                showErrorModal('<?php echo e(cp('all_fields_are_required')); ?>')
            }


        });


        $('#save-form').click(function (e) {
            e.preventDefault();
            $("#save-form").prop("disabled", true);
            $.easyAjax({
                url: '<?php echo e(route('confirm_paying_order')); ?>',
                container: '#form_data',
                type: "POST",
                async: false,
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    // console.log(response)
                    $('#model_operation').modal('hide');
                    showSuccessModal('success')
                    
                    location.replace("<?php echo e(route("list_deposit_withdraws")); ?>" + "#pay_bills_requests_tab")
                }, custom_error: function () {
                    $("#save-form").prop("disabled", false);
                }

            });

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/pay_invoices2.blade.php ENDPATH**/ ?>