<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CTPAY</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo e(asset('assets_v3/assets/img/favicon.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('assets_v3/assets/img/apple-touch-icon.png')); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css') }}">

    <!-- Vendor CSS Files -->
    <link href="<?php echo e(asset('assets_v3/assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_v3/assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_v3/assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_v3/assets/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_v3/assets/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets_v3/assets/css/Ltr.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets_v3/assets/css/login-ltr.css')); ?>" rel="stylesheet" />

</head>

<body dir="rtl">

    <main>
        <section class="container-fluid style-rtl">
            <div class="row justify-content-around">
                <div class="col-md-5 style-container-form ">

                    <form class="style-container-form" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>
                        <div class="text-center ">
                        <p class="TitleSigin pt-5">
                                Welcome To
                                <span> <img src="<?php echo e(asset('assets_v3/assets/img/logoFooter.png')); ?>" class="img-fluid imglogo" /></span>
                            </p>
                            <p class="TitleText">Register</p>
                        </div>

                        <div class="form-group">
                        <div class="inner-addon right-addon">
                        <i class="fas fa-user-lock glyphicon"></i>
                        <label for="name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Name')); ?></label>

                            
                                <input id="name" type="text" class="form-control input-style mb-4" name="name" required autocomplete="name">

                                <?php $__errorArgs = ['name'];
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


                        <div class="form-group pt-4">
                        <div class="inner-addon right-addon">
                        <i class="far fa-envelope glyphicon"></i>
                        <label for="email" class="col-md-4 col-form-label text-md-right"><?php echo e(__('E-Mail Address')); ?></label>

                           
                                <input id="email" type="email" class="form-control input-style mb-4" name="email"  required autocomplete="email" autofocus>
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

                        <div class="form-group">
                        <div class="inner-addon right-addon">
                        <i class="fas fa-user-lock glyphicon"></i>
                        <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Password')); ?></label>

                            
                                <input id="password" type="password" class="form-control input-style mb-4" name="password" required autocomplete="password">

                                <?php $__errorArgs = ['password'];
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


                        <div class="form-group">
                        <div class="inner-addon right-addon">
                        <i class="fas fa-user-lock glyphicon"></i>
                        <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Confirm_Password')); ?></label>

                            
                                <input id="password" type="password" class="form-control input-style mb-4" name="password" required autocomplete="password">

                                <?php $__errorArgs = ['Confirm_Password'];
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




                        <button class="btn stylebtnSignin w-100   my-4" type="submit">
                        <?php echo e(__('Register')); ?>

                        </button>

                        <p class="text-register">
                            If you have an account?
                            <a href="https://ctpay.uk/en/login" class="style-quction-password">Login</a>
                        </p>

                    </form>

                </div>
                <div class="col-md-6   style-respinsvie ">
                <img src="<?php echo e(asset('assets_v3/assets/img/Login.png')); ?>" class="img-fluid " />
                </div>
            </div>
        </section>




    </main>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="<?php echo e(asset('assets_v3/assets/vendor/purecounter/purecounter_vanilla.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_v3/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_v3/assets/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_v3/assets/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_v3/assets/vendor/swiper/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_v3/assets/vendor/php-email-form/validate.js')); ?>"></script>


    <script src="<?php echo e(asset('assets_v3/assets/js/main.js')); ?>"></script>


</body>

</html>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/auth/register.blade.php ENDPATH**/ ?>