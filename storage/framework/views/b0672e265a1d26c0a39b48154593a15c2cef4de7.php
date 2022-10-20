<!-- checkbox field -->

<?php echo $__env->make('crud::fields.inc.wrapper_start', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('crud::fields.inc.translatable_icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="checkbox">
        <input type="hidden" name="<?php echo e($field['name']); ?>" value="<?php echo e(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? 0); ?>">
    	  <input type="checkbox"
          data-init-function="bpFieldInitCheckbox"

          <?php if(old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? false): ?>
                 checked="checked"
          <?php endif; ?>

          <?php if(isset($field['attributes'])): ?>
              <?php $__currentLoopData = $field['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    			<?php echo e($attribute); ?>="<?php echo e($value); ?>"
        	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
          >
    	<label class="form-check-label font-weight-normal"><?php echo $field['label']; ?></label>

        
        <?php if(isset($field['hint'])): ?>
            <p class="help-block"><?php echo $field['hint']; ?></p>
        <?php endif; ?>
    </div>
<?php echo $__env->make('crud::fields.inc.wrapper_end', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>




<?php if($crud->fieldTypeNotLoaded($field)): ?>
    <?php
        $crud->markFieldTypeAsLoaded($field);
    ?>
    
    <?php $__env->startPush('crud_fields_scripts'); ?>
        <script>
            function bpFieldInitCheckbox(element) {
                var hidden_element = element.siblings('input[type=hidden]');
                var id = 'checkbox_'+Math.floor(Math.random() * 1000000);

                // make sure the value is a boolean (so it will pass validation)
                if (hidden_element.val() === '') hidden_element.val(0);

                // set unique IDs so that labels are correlated with inputs
                element.attr('id', id);
                element.siblings('label').attr('for', id);

                // set the default checked/unchecked state
                // if the field has been loaded with javascript
                if (hidden_element.val() != 0) {
                  element.prop('checked', 'checked');
                } else {
                  element.prop('checked', false);
                }

                // when the checkbox is clicked
                // set the correct value on the hidden input
                element.change(function() {
                  if (element.is(":checked")) {
                    hidden_element.val(1);
                  } else {
                    hidden_element.val(0);
                  }
                })
            }
        </script>
    <?php $__env->stopPush(); ?>

<?php endif; ?>


<?php /**PATH /home/ytadawu1/wallet-main/vendor/backpack/crud/src/resources/views/crud/fields/checkbox.blade.php ENDPATH**/ ?>