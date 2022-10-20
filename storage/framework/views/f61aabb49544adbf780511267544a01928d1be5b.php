
<?php
    $value = $entry->{$column['function_name']}(...($column['function_parameters'] ?? []));
    
    $column['escaped'] = $column['escaped'] ?? false;
    $column['limit']   = $column['limit'] ?? 40;
    $column['prefix']  = $column['prefix'] ?? '';
    $column['suffix']  = $column['suffix'] ?? '';
    $column['text']    = $column['prefix'].
                         Str::limit($value, $column['limit'], "[...]").
                         $column['suffix'];
?>

<span>
	<?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php if($column['escaped']): ?>
            <?php echo e($column['text']); ?>

        <?php else: ?>
            <?php echo $column['text']; ?>

        <?php endif; ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/model_function.blade.php ENDPATH**/ ?>