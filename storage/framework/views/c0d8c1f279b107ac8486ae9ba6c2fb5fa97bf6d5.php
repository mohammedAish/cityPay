<?php
    $connected_entity = new $field['model'];
    $connected_entity_key_name = $connected_entity->getKeyName();
    $field['multiple'] = $field['multiple'] ?? $crud->relationAllowsMultiple($field['relation_type']);
    $field['attribute'] = $field['attribute'] ?? $connected_entity->identifiableAttribute();
    $field['include_all_form_fields'] = $field['include_all_form_fields'] ?? true;
    $field['allows_null'] = $field['allows_null'] ?? $crud->model::isColumnNullable($field['name']);
    // Note: isColumnNullable returns true if column is nullable in database, also true if column does not exist.

    if (!isset($field['options'])) {
            $field['options'] = $connected_entity::all()->pluck($field['attribute'],$connected_entity_key_name);
        } else {
            $field['options'] = call_user_func($field['options'], $field['model']::query())->pluck($field['attribute'],$connected_entity_key_name);
    }

    // make sure the $field['value'] takes the proper value
    // and format it to JSON, so that select2 can parse it
    $current_value = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '';


    if ($current_value != false) {
        switch (gettype($current_value)) {
            case 'array':
                $current_value = $connected_entity
                                    ->whereIn($connected_entity_key_name, $current_value)
                                    ->get()
                                    ->pluck($field['attribute'], $connected_entity_key_name);
                break;

            case 'object':
                if (is_subclass_of(get_class($current_value), 'Illuminate\Database\Eloquent\Model') ) {
                    $current_value = [$current_value->{$connected_entity_key_name} => $current_value->{$field['attribute']}];
                }else{
                    $current_value = $current_value
                                    ->pluck($field['attribute'], $connected_entity_key_name);
                    }

            break;

            default:
                $current_value = $connected_entity
                                ->where($connected_entity_key_name, $current_value)
                                ->get()
                                ->pluck($field['attribute'], $connected_entity_key_name);
                break;
        }
    }



    $field['value'] = json_encode($current_value);

?>

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label><?php echo $field['label']; ?></label>

    <select
        style="width:100%"
        name="<?php echo e($field['name'].($field['multiple']?'[]':'')); ?>"
        data-init-function="bpFieldInitRelationshipSelectElement"
        data-column-nullable="<?php echo e(var_export($field['allows_null'])); ?>"
        data-dependencies="<?php echo e(isset($field['dependencies'])?json_encode(Arr::wrap($field['dependencies'])): json_encode([])); ?>"
        data-model-local-key="<?php echo e($crud->model->getKeyName()); ?>"
        data-placeholder="<?php echo e($field['placeholder']); ?>"
        data-field-attribute="<?php echo e($field['attribute']); ?>"
        data-connected-entity-key-name="<?php echo e($connected_entity_key_name); ?>"
        data-include-all-form-fields="<?php echo e(var_export($field['include_all_form_fields'])); ?>"
        data-current-value="<?php echo e($field['value']); ?>"
        data-field-multiple="<?php echo e(var_export($field['multiple'])); ?>"

        <?php echo $__env->make('crud::fields.inc.attributes', ['default_class' =>  'form-control'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if($field['multiple']): ?>
        multiple
        <?php endif; ?>
        >
        <?php if($field['allows_null']): ?>
            <option value="">-</option>
        <?php endif; ?>

        <?php if(count($field['options'])): ?>
            <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($option); ?></option>
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
    <?php $__env->stopPush(); ?>



<!-- include field specific select2 js-->
<?php $__env->startPush('crud_fields_scripts'); ?>
<script>
    // if nullable, make sure the Clear button uses the translated string
    document.styleSheets[0].addRule('.select2-selection__clear::after','content:  "<?php echo e(trans('backpack::crud.clear')); ?>";');


    /**
     *
     * This method gets called automatically by Backpack:
     *
     * @param    node element The jQuery-wrapped "select" element.
     * @return  void
     */
    function bpFieldInitRelationshipSelectElement(element) {
        var form = element.closest('form');
        var $placeholder = element.attr('data-placeholder');
        var $modelKey = element.attr('data-model-local-key');
        var $fieldAttribute = element.attr('data-field-attribute');
        var $connectedEntityKeyName = element.attr('data-connected-entity-key-name');
        var $includeAllFormFields = element.attr('data-include-all-form-fields') == 'false' ? false : true;
        var $dependencies = JSON.parse(element.attr('data-dependencies'));
        var $multiple = element.attr('data-field-multiple')  == 'false' ? false : true;
        var $selectedOptions = typeof element.attr('data-selected-options') === 'string' ? JSON.parse(element.attr('data-selected-options')) : JSON.parse(null);
        var $allows_null = (element.attr('data-column-nullable') == 'true') ? true : false;
        var $allowClear = $allows_null;

        var $item = false;

        var $value = JSON.parse(element.attr('data-current-value'))

        if(Object.keys($value).length > 0) {
            $item = true;
        }
        var selectedOptions = [];
        var $currentValue = $item ? $value : '';

        for (const [key, value] of Object.entries($currentValue)) {
            selectedOptions.push(key);
            $(element).val(selectedOptions);
        }

        if (!$allows_null && $item === false) {
            element.find('option:eq(0)').prop('selected', true);
        }

        $(element).attr('data-current-value',$(element).val());
        $(element).trigger('change');

        var $select2Settings = {
                theme: 'bootstrap',
                multiple: $multiple,
                placeholder: $placeholder,
                allowClear: $allowClear,
            };
        if (!$(element).hasClass("select2-hidden-accessible"))
        {
            $(element).select2($select2Settings);
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/fields/relationship/relationship_select.blade.php ENDPATH**/ ?>