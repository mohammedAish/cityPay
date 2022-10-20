
<?php
    $value = data_get($entry, $column['name']);
    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['decimals'] = $column['decimals'] ?? 0;
    $column['dec_point'] = $column['dec_point'] ?? '.';
    $column['thousands_sep'] = $column['thousands_sep'] ?? ',';
    $column['text'] = '';

    if (!is_null($value)) {
        $value = number_format($value, $column['decimals'], $column['dec_point'], $column['thousands_sep']);
        $column['text'] = $column['prefix'].$value.$column['suffix'];
    }
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
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/number.blade.php ENDPATH**/ ?>