
<?php
    $value = data_get($entry, $column['name']);

    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['format'] = $column['format'] ?? config('backpack.base.default_date_format');
    $column['text'] = '';

    if(!empty($value)) {
        $column['text'] = \Carbon\Carbon::parse($value)
            ->locale(App::getLocale())
            ->isoFormat($column['format']);

        $column['text'] = $column['prefix'].$column['text'].$column['suffix'];
    }
?>

<span data-order="<?php echo e($value ?? ''); ?>">
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
        <?php if($column['escaped']): ?>
            <?php echo e($column['text']); ?>

        <?php else: ?>
            <?php echo $column['text']; ?>

        <?php endif; ?>
    <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
</span>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/date.blade.php ENDPATH**/ ?>