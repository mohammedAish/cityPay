<?php
    if(empty($mainobj)){
        $mainobj=new Msite_user();
        AddError("Main object has not initialized in controller");
    }?>

<div class="register-form">
    <div class="row-wrap ">
        <div class="form-group">
            <label class="control-label label-required" for="email"><?php _e("Username"); ?></label>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                <input type="text" maxlength="100"
                       class="form-control" id="username"  name="username" placeholder="<?php _e("Username"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Username"));?>">
            </div>
        </div>
        <div class="form-group">
            <label><?php _e("Captcha");?></label>
            <?php echo AppCaptcha::get_chapcha_html('','form-control');?>
        </div>
        <?php echo show_require_msg();?>
    
    </div>
    
    <div class="row btn-group-sm popup-footer ">
        <div class="row">
            <div class="col-md-6 ">
                <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> <?php _e("Submit")?></button>
            
            </div>
        
        </div>
    </div>
</div>
