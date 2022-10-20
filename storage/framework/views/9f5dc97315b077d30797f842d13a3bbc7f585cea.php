<!DOCTYPE html>

<html lang="<?php echo e(str_replace('_', '-', current_local())); ?>" dir="<?php echo e(current_direction()); ?>">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?php echo e(asset('app/public/nlogo.png')); ?>">
    <?php echo $__env->yieldContent('keywords'); ?>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css">

    <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/chat.css')); ?>">
    <?php if(current_local()=="en"): ?>
        <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/main.en.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/course_en.css')); ?>">
    <?php else: ?>
        <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/course_ar.css')); ?>">



    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/rtl_header.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/icofont.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/slick.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/barfiller.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/coursestyle.css')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/slick.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/videojs.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('org_assets/dist/css/main.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/org_assets/dist/css/courses.min.css')); ?>">
    <link href="<?php echo e(asset('/org_assets/plugins/froiden-helper/helper.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('org_assets/plugins/toast-master/css/jquery.toast.css')); ?>" rel="stylesheet">


    
    
    
    
    


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" href="<?php echo e(asset('org_assets/plugins/noty/noty.css')); ?>">
    <script src="<?php echo e(asset('org_assets/plugins/noty/noty.min.js')); ?>"></script>
    <meta property="og:url" content="<?php echo e(Request::fullUrl()); ?>"/>
    <meta property="og:type" content="website"/>

       <meta property="og:image" content="<?php echo e(asset('app/public/logo.png')); ?>"/>

    <meta name="twitter:site" content="<?php echo e(Request::fullUrl()); ?>">
    <meta name="twitter:creator" content="romoz.co">

    <style>
        .inner-header {
            margin-top: 6%;
        }

        .post-content img {
            width: 100% !important;
        }

    </style>
    <script src="<?php echo e(asset('/org_assets/dist/js/jquery-2.2.4.min.js')); ?>"></script>

</head>
<body>
<!-- <div class="preloader">
     <div class="preloader_image"></div>
 </div>-->
<!-- up btn -->
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/org_web/header.blade.php ENDPATH**/ ?>