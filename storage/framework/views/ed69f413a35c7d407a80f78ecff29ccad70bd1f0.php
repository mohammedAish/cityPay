<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                    <span class="fw-bolder mb-2 text-dark">
                        <?php echo e(cp('personal_information')); ?>

                    </span>
                </h1>
            </div>
        </div>
    </div>

    <div class="card-body">

        <form name="profile" action="<?php echo e(route('update_profile')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row justify-content-between">
                <div class="col-md-3 text-center">
                    <div class="image-input image-input-outline mask image-input-circle  image-input-empty" data-kt-image-input="true" style="background-image: url('/metronic8/demo1/assets/media/svg/avatars/blank.svg')">
                        <div class="image-input-wrapper  w-150px h-150px" style="background-image:url('<?php echo e(asset($profile_info["img_profile"] )); ?>');background-color: rgba(0, 0, 0, 0.5);background-blend-mode: overlay;"></div>
                        <label class="btn btn-icon btn-circle  btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="تغيير الصورة">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23 19C23 19.5304 22.7893 20.0391 22.4142 20.4142C22.0391 20.7893 21.5304 21 21 21H3C2.46957 21 1.96086 20.7893 1.58579 20.4142C1.21071 20.0391 1 19.5304 1 19V8C1 7.46957 1.21071 6.96086 1.58579 6.58579C1.96086 6.21071 2.46957 6 3 6H7L9 3H15L17 6H21C21.5304 6 22.0391 6.21071 22.4142 6.58579C22.7893 6.96086 23 7.46957 23 8V19Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 17C14.2091 17 16 15.2091 16 13C16 10.7909 14.2091 9 12 9C9.79086 9 8 10.7909 8 13C8 15.2091 9.79086 17 12 17Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <input type="file" name="fileup" accept=".png, .jpg, .jpeg">


                        </label>
                        <div class="p-5 text-center">
                            <p class="style-Name-user-profile" style="font-family:almarai!important;color:#262626;font-weight:600!important;">
                                <?php echo e($profile_info['first_name']); ?>

                            </p>
                            <p class="style-email-user-profile" style="font-family:almarai!important;color:#262626;font-weight:600!important;">
                                <?php echo e(auth('customers')->user()->email); ?>

                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('full-name')); ?></label>
                            <input type="text" name="first_name" class="form-control"
                                   value="<?php echo e($profile_info['first_name']); ?>"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('phone-number')); ?></label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?php echo e(auth('customers')->user()->phone); ?>"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('email')); ?></label>
                            <input type="email" class="form-control" disabled
                                   value="<?php echo e(auth('customers')->user()->email); ?>"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('country')); ?></label>
                            <select name="country_code" data-control="select2"
                                    data-placeholder="<?php echo e(cp('select_country_placeholder')); ?>" data-hide-search="true"
                                    class="form-select style-select-profile style-label-form " id="country_code">
                                <option></option>
                                <?php $__currentLoopData = $collected_data['countries']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($country->id); ?>" <?php if($country->id == auth('customers')->user()->country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('facebook-account')); ?></label>
                            <input type="text" name="facebook_acc" class="form-control"
                                   value="<?php echo e(auth('customers')->user()->facebook_acc); ?>"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('whatsapp-number')); ?></label>
                            <input type="text" name="whatsapp_acc" class="form-control"
                                   value="<?php echo e(auth('customers')->user()->whatsapp_acc); ?>"/>
                        </div>

                        <div class="col-md-6 my-2">
                            
                            <input type="submit" class="form-control BntAdd-Modal"
                                   style="color: white !important;" value="<?php echo e(trans('lang.save')); ?>"/>
                        </div>
                    </div>
                </div>


            </div>
        </form>


    </div>
</div><?php /**PATH /home/ytadawu1/wallet-main/resources/views/profile/partials/personal_info.blade.php ENDPATH**/ ?>