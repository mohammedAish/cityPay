<?php if(!empty($widgets)): ?>
	<?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currentWidget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php
			if (!is_array($currentWidget)) {
				$currentWidget = $currentWidget->toArray();
			}
		?>

		<?php if(isset($currentWidget['viewNamespace'])): ?>
			<?php echo $__env->make($currentWidget['viewNamespace'].'.'.$currentWidget['type'], ['widget' => $currentWidget], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php else: ?>
			<?php echo $__env->make(backpack_view('widgets.'.$currentWidget['type']), ['widget' => $currentWidget], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>

	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/base/inc/widgets.blade.php ENDPATH**/ ?>