

<?php if(Config::get('settings.toasts')==1): ?>
    <script src="<?php echo e(asset('assets/admin/js/iziToast.min.js')); ?>"></script>
    <?php if(session()->has('notify')): ?>
        <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script type="text/javascript">  iziToast.<?php echo e($msg[0]); ?>({
                    message: "<?php echo e($msg[1]); ?>",
                    position: "topRight"
                }); </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <script>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            iziToast.error({
                message: '<?php echo e($error); ?>',
                position: "topRight"
            });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>

    <?php endif; ?>


<?php elseif(Config::get('settings.toasts')==2): ?>
    <!-- Toastr -->
    <script src="<?php echo e(asset('assets/admin/js/toastr.min.js')); ?>"></script>
    <?php if(session()->has('notify')): ?>
        <?php $__currentLoopData = session('notify'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script type="text/javascript">  toastr.<?php echo e($msg[0]); ?>("<?php echo e($msg[1]); ?>"); </script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <script>

            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            toastr.error('<?php echo e($error); ?>');
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>

    <?php endif; ?>

<?php endif; ?>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/partials/notify-js.blade.php ENDPATH**/ ?>