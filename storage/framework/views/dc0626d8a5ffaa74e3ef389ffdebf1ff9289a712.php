<?php $__env->startSection('content'); ?>
    <section class="m-5 ">
        <div class="row  my-3">
            <div class="col-md-12 ">
                <div class="page-title style-boder-titel-card d-flex flex-column   ">
                    <h1 class="style-title-card px-4 py-4">
                                    <span class="fw-bolder mb-2 text-dark">
                                        <?php echo e(cp('curr_exchange_prices')); ?>

                                    </span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-row-currency">
            <div class="col-md-11 style-card-currencey-form style-right mx-3 my-3">
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo e(route('wallet.convert_currency')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row justify-content-en">

                                <div class="col-md-3 style-currency-trasnform">
                                    <label class="style-label-form"><?php echo e(cp('deposit_amount')); ?></label>
                                    <input type="text" class="form-control" id="amount" name="amount" value="<?php if(isset($amount)): ?> <?php echo e($amount); ?> <?php endif; ?>" required/>
                                </div>
                                <div class="col-md-3  style-currency-trasnform3">
                                    <label class="style-label-form"><?php echo e(cp('from_amount')); ?></label>
                                    <select class="form-select" data-placeholder="<?php echo e(cp('select_curr')); ?>"
                                            id="kt_docs_select2_country_Currency_exchange_Form" name="exchange_form">
                                        <option></option>
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-kt-select2-country="<?php echo e(asset($currency->img_path)); ?>" value="<?php echo e($currency->code); ?>"
                                                    <?php if(isset($exchange_form) && $exchange_form == $currency->code): ?> selected <?php endif; ?>
                                            ><?php echo e($currency->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        
                                        
                                    </select>
                                </div>
                                <div class="col-md-1 text-center style-currency-trasnform4 ">
                                    <div class="style-icon-currency-switch-desktop2">
                                        <a href="#">
                                            <svg width="35" class="mt-5 style-icon-currency-switch-desktop" height="35"
                                                 viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.0013 34.8333C10.2566 34.8333 3.16797 27.7447 3.16797 19C3.16797 10.2552 10.2566 3.16663 19.0013 3.16663C27.7461 3.16663 34.8346 10.2552 34.8346 19C34.8346 27.7447 27.7461 34.8333 19.0013 34.8333ZM19.0013 31.6666C22.3607 31.6666 25.5825 30.3321 27.958 27.9566C30.3335 25.5812 31.668 22.3594 31.668 19C31.668 15.6406 30.3335 12.4187 27.958 10.0433C25.5825 7.66781 22.3607 6.33329 19.0013 6.33329C15.6419 6.33329 12.4201 7.66781 10.0446 10.0433C7.66916 12.4187 6.33464 15.6406 6.33464 19C6.33464 22.3594 7.66916 25.5812 10.0446 27.9566C12.4201 30.3321 15.6419 31.6666 19.0013 31.6666ZM11.0846 20.5833H25.3346V23.75H19.0013V28.5L11.0846 20.5833ZM19.0013 14.25V9.49996L26.918 17.4166H12.668V14.25H19.0013Z"
                                                      fill="#1B3160"/>
                                            </svg>
                                            <svg width="38" height="38" class="mt-5 style-icon-currency-switch-mobile"
                                                 viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.25093 19.153C3.21247 10.4083 10.2698 3.28864 19.0145 3.25018C27.7591 3.21172 34.8788 10.2691 34.9173 19.0137C34.9558 27.7584 27.8984 34.8781 19.1537 34.9165C10.4091 34.955 3.28939 27.8977 3.25093 19.153ZM6.41756 19.1391C6.43234 22.4984 7.78102 25.7144 10.1669 28.0794C12.5528 30.4443 15.7804 31.7647 19.1398 31.7499C22.4992 31.7351 25.7151 30.3865 28.0801 28.0006C30.4451 25.6147 31.7654 22.387 31.7507 19.0277C31.7359 15.6683 30.3872 12.4524 28.0013 10.0874C25.6154 7.72238 22.3878 6.40204 19.0284 6.41681C15.669 6.43159 12.4531 7.78027 10.0881 10.1662C7.72313 12.552 6.40279 15.7797 6.41756 19.1391ZM17.466 11.1737L17.5286 25.4236L14.362 25.4375L14.3342 19.1043L9.5842 19.1251L17.466 11.1737ZM23.8341 19.0625L28.584 19.0416L20.7022 26.993L20.6396 12.7431L23.8062 12.7292L23.8341 19.0625Z"
                                                      fill="#1B3160"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 style-currency-trasnform2">
                                    <label class="style-label-form"><?php echo e(cp('to_amount')); ?></label>
                                    <select class="form-select" data-placeholder="<?php echo e(cp('select_curr')); ?>"
                                            id="kt_docs_select2_country_Currency_exchange_To" name="exchange_to">
                                        <option></option>
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option data-kt-select2-country="<?php echo e(asset($currency->img_path)); ?>" value="<?php echo e($currency->code); ?>"
                                                    <?php if(isset($exchange_to) && $exchange_to == $currency->code): ?> selected <?php endif; ?>
                                            ><?php echo e($currency->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                        
                                        
                                    </select>
                                </div>

                                <div class="col-md-2  style-currency-trasnform1 ">
                                    <button type="submit" class="btn mt-5 form-control BntAdd-Modal">
                                        <?php echo e(cp('transfer')); ?>

                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mx-1 my-3 style-right">
            <?php if($is_post): ?>
                <div class="col-md-3 my-3 style-card-features-respinsive">
                    <div class="card">
                        <div class="style-card-body-currency">
                            <div class="d-flex style-right justify-content-between flex-row">
                                <div class="text-center pt-3">
                                    <span class="style-titel-currencys-cards-all"><?php echo e(number_format($exchange_price, 4)); ?> <?php echo e($to_curr->symbol); ?></span>
                                </div>
                                <div class="text-center">
                                            <span class="style-titel-currencys-cards-all">
                                                <?php echo e($to_curr->code); ?><br/>
                                                <?php echo e($to_curr->name); ?>

                                            </span>
                                </div>
                                <div class="pt-3">
                                    
                                    <img src="<?php echo e($to_curr->img_path); ?>" alt="<?php echo e($to_curr->code); ?>" width="29px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-3 my-3 style-card-features-respinsive">
                        <div class="card">
                            <div class="style-card-body-currency">
                                <div class="d-flex style-right justify-content-between flex-row">
                                    <div class="text-center pt-3">
                                        <span class="style-titel-currencys-cards-all"><?php echo e(number_format($currency->exchange_price, 4)); ?>$</span>
                                    </div>
                                    <div class="text-center">
                                            <span class="style-titel-currencys-cards-all">
                                                <?php echo e($currency->code); ?><br/>
                                                <?php echo e($currency->name); ?>

                                            </span>
                                    </div>
                                    <div class="pt-3">
                                        
                                        <img src="<?php echo e($currency->img_path); ?>" alt="<?php echo e($currency->code); ?>" width="29px"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>


    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('wallet.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/currency2.blade.php ENDPATH**/ ?>