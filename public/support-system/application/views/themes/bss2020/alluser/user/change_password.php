<div class="w-100">
    <div class="clearfix form pb-3">
	    <?php if(empty($is_skip_old_pass)){?>
            <div class="form-group">
                <label class="control-label col-md-4" for="old_password"><?php _e("Old Password"); ?></label>
                <div class="col-md">
                    <input type="password" maxlength="250" autocomplete="off" value="" class="form-control" id="old_password" name="old_password" placeholder="<?php _e("Old Password") ; ?>" data-bv-notempty="true"data-bv-notempty-message="<?php _e("%s is required",__("Old Password")) ; ?>">
                </div>
            </div>
	    <?php }?>
        <div class="form-group">
            <label class="control-label col-md-4" for="password"><?php _e("New Password") ; ?></label>
            <div class="col-md">
                <input type="password" maxlength="250" autocomplete="off" class="form-control" id="password" name="password" placeholder="<?php _e("New Password") ; ?>" data-bv-notempty="true" data-bv-notempty-message="<?php _e("%s is required",__("New Password")) ; ?>" data-bv-field="password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-4" for="cpass"><?php _e("Confirm Password") ; ?></label>
            <div class="col-md">
                <input type="password" name="cpass" id="cpass" data-bv-field="cpassword" value="" maxlength="250" autocomplete="off" class="form-control" placeholder="<?php _e("Change Password") ; ?>" data-bv-identical="true" data-bv-identical-field="password" data-bv-field="password" data-bv-notempty="true" data-bv-identical-message="<?php _e("%s is not same",__("Confirm Password")) ; ?>"data-bv-notempty-message="<?php _e("%s is required",__("Confirm Password")) ; ?>">
            </div>
        </div>
    </div>
    <div class="btn-group-md popup-footer ">
        <div class="clearfix">

            <div class="float-sm-right text-center text-sm-right ">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo __("Save")?></button>
                <button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
            </div>
        </div>
    </div>
</div>






