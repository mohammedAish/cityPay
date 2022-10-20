<?php if(count($agencies) > 0): ?>
    <option value=""><?php echo e(cp('select_agency')); ?></option>
    <?php $__currentLoopData = $agencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($agency->id); ?>" all_data="<?php echo e($agency); ?>"><?php echo e($agency->agency->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <option value=""><?php echo e(cp('no_results_found')); ?></option>
<?php endif; ?>
<?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/agency_select2_agencies.blade.php ENDPATH**/ ?>