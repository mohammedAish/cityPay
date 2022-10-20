
<?php
    $values = data_get($entry, $column['name']);
    $list = [];
    if ($values !== null) {
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                if (! is_null($value)) {
                    $list[$key] = $column['options'][$value] ?? $value;
                }
            }
        } else {
            $value = $column['options'][$values] ?? $values;
            $list[$values] = $value;
        }
    }


    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
?>

<span>
    <?php if(!empty($list)): ?>
        <?php echo e($column['prefix']); ?>

        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $related_key = $key;
            ?>

            <span class="d-inline-flex">
                <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>
                    <?php if($column['escaped']): ?>
                        <?php echo e($text); ?>

                    <?php else: ?>
                        <?php echo $text; ?>

                    <?php endif; ?>
                <?php echo $__env->renderWhen(!empty($column['wrapper']), 'crud::columns.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path'])); ?>

                <?php if(!$loop->last): ?>, <?php endif; ?>
            </span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($column['suffix']); ?>

    <?php else: ?>
        -
    <?php endif; ?>
</span>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/select_from_array.blade.php ENDPATH**/ ?>