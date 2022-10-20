
<?php
   $allows_multiple = $crud->guessIfFieldHasMultipleFromRelationType($column['relation_type']);
?>

<?php if($allows_multiple): ?>
	<?php echo $__env->make('crud::columns.select_multiple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
	<?php echo $__env->make('crud::columns.select', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/relationship.blade.php ENDPATH**/ ?>