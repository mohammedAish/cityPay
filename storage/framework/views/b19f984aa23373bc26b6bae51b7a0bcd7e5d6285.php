<?php $__env->startSection('after_styles'); ?>
    <style media="screen">
        .backpack-profile-form .required::after {
            content: ' *';
            color: red;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php
  $breadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      trans('backpack::base.my_account') => false,
  ];
?>

<?php $__env->startSection('header'); ?>
    <section class="content-header">
        <div class="container-fluid mb-3">
            <h1><?php echo e(trans('backpack::base.my_account')); ?></h1>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <?php if(session('success')): ?>
        <div class="col-lg-8">
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        </div>
        <?php endif; ?>

        <?php if($errors->count()): ?>
        <div class="col-lg-8">
            <div class="alert alert-danger">
                <ul class="mb-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        
        <div class="col-lg-8">
            <form class="form" action="<?php echo e(route('backpack.account.info.store')); ?>" method="post">

                <?php echo csrf_field(); ?>


                <div class="card padding-10">

                    <div class="card-header">
                        <?php echo e(trans('backpack::base.update_account_info')); ?>

                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <?php
                                    $label = trans('backpack::base.name');
                                    $field = 'name';
                                ?>
                                <label class="required"><?php echo e($label); ?></label>
                                <input required class="form-control" type="text" name="<?php echo e($field); ?>" value="<?php echo e(old($field) ? old($field) : $user->$field); ?>">
                            </div>

                            <div class="col-md-6 form-group">
                                <?php
                                    $label = config('backpack.base.authentication_column_name');
                                    $field = backpack_authentication_column();
                                ?>
                                <label class="required"><?php echo e($label); ?></label>
                                <input required class="form-control" type="<?php echo e(backpack_authentication_column()=='email'?'email':'text'); ?>" name="<?php echo e($field); ?>" value="<?php echo e(old($field) ? old($field) : $user->$field); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"><i class="la la-save"></i> <?php echo e(trans('backpack::base.save')); ?></button>
                        <a href="<?php echo e(backpack_url()); ?>" class="btn"><?php echo e(trans('backpack::base.cancel')); ?></a>
                    </div>
                </div>

            </form>
        </div>
        
        
        <div class="col-lg-8">
            <form class="form" action="<?php echo e(route('backpack.account.password')); ?>" method="post">

                <?php echo csrf_field(); ?>


                <div class="card padding-10">

                    <div class="card-header">
                        <?php echo e(trans('backpack::base.change_password')); ?>

                    </div>

                    <div class="card-body backpack-profile-form bold-labels">
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <?php
                                    $label = trans('backpack::base.old_password');
                                    $field = 'old_password';
                                ?>
                                <label class="required"><?php echo e($label); ?></label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="<?php echo e($field); ?>" id="<?php echo e($field); ?>" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                <?php
                                    $label = trans('backpack::base.new_password');
                                    $field = 'new_password';
                                ?>
                                <label class="required"><?php echo e($label); ?></label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="<?php echo e($field); ?>" id="<?php echo e($field); ?>" value="">
                            </div>

                            <div class="col-md-4 form-group">
                                <?php
                                    $label = trans('backpack::base.confirm_password');
                                    $field = 'confirm_password';
                                ?>
                                <label class="required"><?php echo e($label); ?></label>
                                <input autocomplete="new-password" required class="form-control" type="password" name="<?php echo e($field); ?>" id="<?php echo e($field); ?>" value="">
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                            <button type="submit" class="btn btn-success"><i class="la la-save"></i> <?php echo e(trans('backpack::base.change_password')); ?></button>
                            <a href="<?php echo e(backpack_url()); ?>" class="btn"><?php echo e(trans('backpack::base.cancel')); ?></a>
                    </div>

                </div>

            </form>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(backpack_view('blank'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/base/my_account.blade.php ENDPATH**/ ?>