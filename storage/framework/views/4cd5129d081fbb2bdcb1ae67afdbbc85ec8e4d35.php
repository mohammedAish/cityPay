<?php $__env->startSection('content'); ?>
    <section>
        <div class="card m-5 ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="page-title style-boder-titel-card d-flex flex-column   ">
                        <h1 class="style-title-card px-4 py-4">
                                        <span class="fw-bolder mb-2 text-dark">
                                            <?php echo e(cp('add_finance_account_title')); ?>

                                        </span>
                        </h1>
                        <p class="style-title-bio-card">
                            <?php echo e(cp('add_finance_account_description')); ?>

                        </p>
                    </div>
                </div>
            </div>

            <div class="card-body">


                <form id="form_data">

                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-5 my-2">
                            <label class=" style-label-form " style="color:#1B3160;"><?php echo e(cp('system')); ?></label>
                            <select name="deposit_type" id="deposit_type" data-control="select2"
                                    data-placeholder="<?php echo e(cp('add_finance_account_system_description')); ?>"
                                    data-hide-search="true"
                                    class="form-select style-select-profile style-label-form  ">
                                <option></option>
                                <?php $__currentLoopData = $deposit_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>" id="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 my-2">
                            <label class="style-label-form " style="color:#1B3160;"><?php echo e(cp('agency')); ?></label>
                            <select name="agency_id" id="agency_section" data-control="select2"
                                    data-placeholder="<?php echo e(cp('select_agency')); ?>"
                                    data-hide-search="true"
                                    class="form-select style-select-profile style-label-form">
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div id="localbankaccount" style="display: none">
                        <div class="row">
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('recipient_name')); ?></label>
                                <input name="recipient_name_local" type="text"
                                       placeholder="<?php echo e(cp('recipient_name_placeholder')); ?>" class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('phone_number')); ?></label>
                                <input name="phone_number_local" type="text"
                                       placeholder="<?php echo e(cp('phone_number_placeholder')); ?>" class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('address')); ?></label>
                                <input name="address_local" type="text" placeholder="<?php echo e(cp('address_placeholder')); ?>"
                                       class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('soft_bank')); ?></label>
                                <input name="soft_bank_local" type="text" placeholder="<?php echo e(cp('soft_bank_placeholder')); ?>"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div id="express_transfer">
                        <div class="row">
                            <div class="col-md-5 my-2">
                                <label class="style-label-form"><?php echo e(cp('recipient_name')); ?></label>
                                <input name="recipient_name_transfer" type="text"
                                       placeholder="<?php echo e(cp('recipient_name_placeholder')); ?>" class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2">
                                <label class="style-label-form"><?php echo e(cp('phone_number')); ?></label>
                                <input name="phone_number_transfer" type="text"
                                       placeholder="<?php echo e(cp('phone_number_placeholder')); ?>" class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('address')); ?></label>
                                <input name="address_transfer" type="text" placeholder="<?php echo e(cp('address_placeholder')); ?>"
                                       class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div id="Crypto_currency" style="display: none">
                        <div class="row">
                            <div class="col-md-5 my-2">
                                <label class=" style-label-form " style="color:#1B3160;"><?php echo e(cp('wallet_number')); ?></label>
                                <input name="wallet_number_crypto" type="text"
                                       placeholder="<?php echo e(cp('wallet_number_placeholder')); ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div id="electronic_banking" style="display: none">
                        <div class="row">
                            <div class="col-md-5 my-2">
                                <label class=" style-label-form " style="color:#1B3160;"><?php echo e(cp('wallet_number')); ?></label>
                                <input name="wallet_number_banking" type="text"
                                       placeholder="<?php echo e(cp('wallet_number_placeholder')); ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div id="Internationallocalbankaccount" style="display: none">
                        <div class="row">
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('account_name')); ?></label>
                                <input name="customer_agency_acc_name" type="text"
                                       value="<?php echo e(auth()->user()->first_name); ?>" readonly class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('account_number')); ?></label>
                                <input name="customer_agency_acc_number" type="text"
                                       placeholder="<?php echo e(cp('account_number_placaeholder')); ?>" class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('address')); ?></label>
                                <input name="address_international" type="text"
                                       placeholder="<?php echo e(cp('address_placeholder')); ?>" class="form-control"/>
                            </div>
                            <div class="col-md-5 my-2 localbankaccount">
                                <label class="style-label-form"><?php echo e(cp('soft_bank')); ?></label>
                                <input name="soft_bank_international" type="text"
                                       placeholder="<?php echo e(cp('soft_bank_placeholder')); ?>" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mt-3">
                            <button type="button" id="save-form"
                                    class="form-control BntAdd-Modal"><?php echo e(cp('add_account')); ?>

                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("custom_js"); ?>
    <script type="text/javascript">

        var localbankaccount = document.getElementById("localbankaccount");
        var expresstransfer = document.getElementById("express_transfer");
        var Cryptocurrency = document.getElementById("Crypto_currency");
        var electronicbanking = document.getElementById("electronic_banking");
        var Internationallocalbankaccount = document.getElementById("Internationallocalbankaccount");

        expresstransfer.style.display = "block";
        localbankaccount.style.display = "none";
        Cryptocurrency.style.display = "none";
        electronicbanking.style.display = "none";
        Internationallocalbankaccount.style.display = "none";


        var hostUrl = "assets/";

        $('#deposit_type').change(function () {
            var type_id = $(this).val();
            expresstransfer.style.display = (type_id == 1) ? "block" : "none";
            // localbankaccount.style.display = (type_id == 3) ? "block" : "none";
            Cryptocurrency.style.display = (type_id == 4) ? "block" : "none";
            electronicbanking.style.display = (type_id == 2) ? "block" : "none";
            Internationallocalbankaccount.style.display = (type_id == 12) ? "block" : "none";

            // var type_id = ($(this).attr('id'));
            var url = '<?php echo route('getWithdrawAgencyByMethod', [':type_id']); ?>';
            url = url.replace(':type_id', type_id);
            $.ajax({
                url: url,
                type: "get",
                data: {},
                success: function (response) {
                    // $("#agency_section").html(response);
                    $('#agency_section').empty()
                    $("#agency_section").append(response)
                },
            })
        });

        $('#save-form').click(function () {
            $.easyAjax({
                url: '<?php echo e(route('wallet.save_new_account')); ?>',
                container: '#form_data',
                type: "POST",
                redirect: true,
                data: $('#form_data').serialize(),
                success: function (response) {
                    $('#kt_modal_success').modal('show');
                    location.replace("<?php echo e(route("wallet.my_accounts")); ?>")
                },
                error: function(xhr){
                    let res = $.parseJSON(xhr.responseText);
                    $.each(res.errors, function (key, value) {
                        // new Noty({
                        //     type: "error",
                        //     text: value[0]
                        // }).show();
                        $('#kt_modal_error_text').empty()
                        $('#kt_modal_error_text').append(value[0])
                        $('#kt_modal_error').modal('show');
                        return
                    });
                    // console.log('res', response);
                    // console.log('txt', JSON.parse(response.responseText));
                    // console.log('jss', response.responseJSON.errors);
                }
            })
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/add_my_account2.blade.php ENDPATH**/ ?>