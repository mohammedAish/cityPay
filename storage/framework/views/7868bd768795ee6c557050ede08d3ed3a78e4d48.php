<!DOCTYPE html>
<html lang="<?php echo e(LaravelLocalization::getCurrentLocale()); ?>" 

>
<head>


    <meta charset="utf-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php if(app()->getLocale()==="ar"): ?>

    <?php else: ?>

    <?php endif; ?>

    







    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
          integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
          crossorigin="anonymous"/>
    <?php echo $__env->yieldContent('header'); ?>
    <title>CTRPAY</title>
    <meta name="theme-color" content="#001c71">
    <meta property="og:locale" content="en_US">
    <meta property="og:image" content="assets/images/meta-banner.html">
    <meta property="og:image:secure_url" content="assets/images/meta-banner.html">
    <style type="text/css">
        @media  screen and (max-width: 767px) {
            .wallet-transaction {
                margin: 30px 0 0 !important;
            }
        }
    </style>
    <script src="<?php echo e(asset('/org_assets/dist/js/jquery-3.5.0.min.js')); ?>"></script>

    <link rel="shortcut icon" href="/assets_v2/media/logos/favicon.png"/>
    <!--begin::Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Almarai&display=swap" rel="stylesheet">
    <link href="/assets_v2/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/assets_v2/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendor Stylesheets-->
    <link href="/assets_v2/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    
    <?php if(LaravelLocalization::getCurrentLocale() == 'ar'): ?>
        <link href="/assets_v2/css/style.bundle.rtl.css" rel="stylesheet" type="text/css"/>
    <?php else: ?>
        <link href="/assets_v2/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <?php endif; ?>    
    <!--end::Global Stylesheets Bundle-->
    
    <style>
        .imgupload{
            color:#1E2832;
            padding-top:40px;
            font-size:7em;
        }
        .imgupload.ok{
            display:none;
            color:green;
        }
        .imgupload.stop{
            display:none;
            color:red;
        }

        @media  screen and (max-width : 1920px){
            .div-only-mobile{
                visibility:hidden;
            }
        }
        
        @media  screen and (max-width : 906px){
            .div-only-mobile{
                visibility:visible;
            }
        }
    </style>
</head>
<body class="header-fixed header-tablet-and-mobile-fixed aside-enabled aside-fixed" id="kt_body">
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid"><?php /**PATH /home/ytadawu1/wallet-main/resources/views/layouts/wallet/header.blade.php ENDPATH**/ ?>