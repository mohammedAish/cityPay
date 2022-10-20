<?php if(session('message')): ?>
    <script>
        new Noty({
            layout: 'topLeft',
            text: "<?php echo e(session('message')); ?>",
            killer: true,
            type:'success',
            timeout: 5000,
        }).show();
    </script>
<?php endif; ?>

<?php if(session('success')): ?>
    <script>
        new Noty({
            layout: 'topLeft',
            text: "<?php echo e(session('success')); ?>",
            killer: true,
            type:'success',
            timeout: 5000,
        }).show();
    </script>
<?php endif; ?>

<?php if(session()->has('status')): ?>
    <?php if(session()->get('status') == 'wrong'): ?>
            <script>
                new Noty({
                    layout: 'topLeft',
                    text: "  <?php echo e(session('message')); ?>",
                    killer: true,
                    type: 'error',
                    timeout: 5000,
                }).show();
            </script>
    <?php endif; ?>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        new Noty({
            layout: 'topLeft',
            text: "  <?php echo e(session('error')); ?>",
            killer: true,
            type: 'error',
            timeout: 5000,
        }).show();
    </script>
<?php endif; ?>

<?php if(session('errors') && count($errors) > 0): ?>
    <script>
        new Noty({
            layout: 'topLeft',
            text: " <ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><ol><?php echo e($error); ?></ol><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul>",
            killer: true,
            type: 'error',
            timeout: 5000,
        }).show();
    </script>
<?php endif; ?><?php /**PATH /home/ytadawu1/wallet-main/resources/views/org_web/msg.blade.php ENDPATH**/ ?>