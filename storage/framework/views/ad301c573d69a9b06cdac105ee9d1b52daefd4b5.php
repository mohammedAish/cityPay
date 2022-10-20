
<?php
    $column['escaped'] = $column['escaped'] ?? true;
    $column['prefix'] = $column['prefix'] ?? '';
    $column['suffix'] = $column['suffix'] ?? '';
    $column['limit'] = $column['limit'] ?? 40;
    $column['attribute'] = $column['attribute'] ?? (new $column['model'])->identifiableAttribute();

    $attributes = $crud->getRelatedEntriesAttributes($entry, $column['entity'], $column['attribute']);
    foreach ($attributes as $key => $text) {
        $text = Str::limit($text, $column['limit'], '[...]');
    }
?>

<span>
    <?php if(count($attributes)): ?>
        <?php echo e($column['prefix']); ?>

        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/columns/select.blade.php ENDPATH**/ ?>