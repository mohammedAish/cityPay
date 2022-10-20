<?php if(Config::get('settings.toasts')==1): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/iziToast.min.css')); ?>">
<?php elseif(Config::get('settings.toasts')==2): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/admin/css/toastr.min.css')); ?>">
<?php endif; ?>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/partials/notify-css.blade.php ENDPATH**/ ?>