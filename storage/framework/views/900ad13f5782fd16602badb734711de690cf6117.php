<?php
	// if not otherwise specified, the hidden input should take up no space in the form
  $field['wrapper']['class'] = $field['wrapper']['class'] ?? $field['wrapperAttributes']['class'] ?? "hidden";
?>

<!-- hidden input -->
<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <input
  	type="hidden"
    name="<?php echo e($field['name']); ?>"
    value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?>"
    <?php echo $__env->make('crud::fields.inc.attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  	>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/fields/hidden.blade.php ENDPATH**/ ?>