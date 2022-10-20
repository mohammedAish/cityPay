<!-- html5 datetime input -->

<?php
// if the column has been cast to Carbon or Date (using attribute casting)
// get the value as a date string
if (isset($field['value']) && ($field['value'] instanceof \Carbon\CarbonInterface)) {
    $field['value'] = $field['value']->toDateTimeString();
}

$timestamp = strtotime(old(square_brackets_to_dots($field['name'])) ? old(square_brackets_to_dots($field['name'])) : (isset($field['value']) ? $field['value'] : (isset($field['default']) ? $field['default'] : '' )));

$value = $timestamp ? strftime('%Y-%m-%dT%H:%M:%S', $timestamp) : '';
?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <input
        type="datetime-local"
        name="<?php echo e($field['name']); ?>"
        value="<?php echo e($value); ?>"
        <?php echo $__env->make('crud::fields.inc.attributes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        >

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/fields/datetime.blade.php ENDPATH**/ ?>