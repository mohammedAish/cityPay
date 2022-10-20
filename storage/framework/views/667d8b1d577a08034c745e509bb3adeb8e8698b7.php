<!-- summernote editor -->
<?php
    // make sure that the options array is defined
    // and at the very least, dialogsInBody is true;
    // that's needed for modals to show above the overlay in Bootstrap 4
    $field['options'] = array_merge(['dialogsInBody' => true, 'tooltip' => false], $field['options'] ?? []);
?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label><?php echo $field['label']; ?></label>
    <?php echo $__env->make('crud::fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <textarea
        name="<?php echo e($field['name']); ?>"
        data-init-function="bpFieldInitSummernoteElement"
        data-options="<?php echo e(json_encode($field['options'])); ?>"
        <?php echo $__env->make('crud::fields.inc.attributes', ['default_class' =>  'form-control summernote'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        ><?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? ''); ?></textarea>

    
    <?php if(isset($field['hint'])): ?>
        <p class="help-block"><?php echo $field['hint']; ?></p>
    <?php endif; ?>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>





<?php if($crud->fieldTypeNotLoaded($field)): ?>
    <?php
        $crud->markFieldTypeAsLoaded($field);
    ?>

    
    <?php $__env->startPush('crud_fields_styles'); ?>
        <!-- include summernote css-->
        <link href="<?php echo e(asset('packages/summernote/dist/summernote-bs4.css')); ?>" rel="stylesheet" type="text/css" />
        <style type="text/css">
            .note-editor.note-frame .note-status-output, .note-editor.note-airframe .note-status-output {
                height: auto;
            }
        </style>
    <?php $__env->stopPush(); ?>

    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <!-- include summernote js-->
        
        <script src="<?php echo e(asset('packages/summernote/dist/summernote-bs4.min.js')); ?>"></script>
        <script>
            function bpFieldInitSummernoteElement(element) {
                element.summernote(element.data('options'));
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/fields/summernote.blade.php ENDPATH**/ ?>