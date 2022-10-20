<?php if(auth()->user()->is_master_key_enabled): ?>
    <div class="row">
        <div class="col-md-5 my-2">
            <label class=" style-label-form "><?php echo e(cp('master_key')); ?></label>
            <input type="number" maxlength="3"
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                   placeholder="<?php echo e(cp('master_key_placeholder')); ?>" class="form-control" value="" name="master_key"
                   id="master_key"/>
        </div>
    </div>
<?php endif; ?>  <?php /**PATH /home/ytadawu1/wallet-main/resources/views/wallet/_master_key.blade.php ENDPATH**/ ?>