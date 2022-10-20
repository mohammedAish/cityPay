<?php $__env->startSection('keywords'); ?>
    <?php if(LaravelLocalization::getCurrentLocale()=="en"): ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords_en)?$header->home_keywords_en:'تداول'); ?>"/>
    <?php else: ?>
        <meta name="keywords" content=" <?php echo e(isset($header->home_keywords)?$header->home_keywords:'تداول'); ?>"/>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justif y-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><?php echo e(__('Reset Password')); ?></div>

                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('password.email')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right"><?php echo e(__('lang.email')); ?></label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>"
                                           required autocomplete="email" autofocus>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="center">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <?php echo e(__('lang.Send_Password_Reset_Link')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.org_web.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>