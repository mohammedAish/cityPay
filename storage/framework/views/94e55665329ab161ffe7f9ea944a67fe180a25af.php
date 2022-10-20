<!-- select2 -->
<?php
    $current_value = old($field['name']) ?? $field['value'] ?? $field['default'] ?? '';

    //if it's part of a relationship here we have the full related model, we want the key.
    if (is_object($current_value) && is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
        $current_value = $current_value->getKey();
    }
    if (!isset($field['options'])) {
        $options = $field['model']::all();
    } else {
        $options = call_user_func($field['options'], $field['model']::query());
    }
    $field['allows_null'] = $field['allows_null'] ?? $crud->model::isColumnNullable($field['name']);
?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <select
        name="<?php echo e($field['name']); ?>"
        style="width: 100%"
        data-init-function="bpFieldInitSelect2Element"
        <?php echo $__env->make('crud::fields.inc.attributes', ['default_class' =>  'form-control select2_field'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        >

        <?php if($field['allows_null']): ?>
            <option value="">-</option>
        <?php endif; ?>

        <?php if(count($options)): ?>
            <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($current_value == $option->getKey()): ?>
                    <option value="<?php echo e($option->getKey()); ?>" selected><?php echo e($option->{$field['attribute']}); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($option->getKey()); ?>"><?php echo e($option->{$field['attribute']}); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<?php if($crud->fieldTypeNotLoaded($field)): ?>
    <?php
        $crud->markFieldTypeAsLoaded($field);
    ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <!-- include select2 css-->
        <link href="<?php echo e(asset('packages/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('packages/select2-bootstrap-theme/dist/select2-bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- include select2 js-->
        <script src="<?php echo e(asset('packages/select2/dist/js/select2.full.min.js')); ?>"></script>
        <?php if(app()->getLocale() !== 'en'): ?>
        <script src="<?php echo e(asset('packages/select2/dist/js/i18n/' . app()->getLocale() . '.js')); ?>"></script>
        <?php endif; ?>
        <script>
            function bpFieldInitSelect2Element(element) {
                // element will be a jQuery wrapped DOM node
                if (!element.hasClass("select2-hidden-accessible")) {
                    element.select2({
                        theme: "bootstrap"
                    });
                }
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/fields/select2.blade.php ENDPATH**/ ?>