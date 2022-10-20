<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    <?php echo e(cp('restore_password')); ?>

                                                </span>
                </h1>

            </div>
        </div>
    </div>

    <div class="card-body">

        <form name="password_form" action="<?php echo e(route('update_password')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row justify-content-between">

                <div class="col-md-8">
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if(session('msg')): ?>
                        <div class="alert alert-success ">
                            <ul>
                                <li><?php echo e(session('msg')); ?></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                        
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('e_mail')); ?></label>
                            <input type="email" disabled value="<?php echo e(auth('customers')->user()->email); ?>" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('old-password')); ?> </label>
                            <input type="password" name="old_password" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('new_password')); ?> </label>
                            <input type="password" name="password" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form"><?php echo e(cp('confirm_password')); ?> </label>
                            <input type="password" name="password_confirmation" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <button class="form-control BntAdd-Modal"

                            ><?php echo e(cp('save')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div><?php /**PATH /home/ytadawu1/wallet-main/resources/views/profile/partials/restore_password.blade.php ENDPATH**/ ?>