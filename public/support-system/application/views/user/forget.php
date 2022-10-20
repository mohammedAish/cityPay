<?php     
    if(empty($mainobj)){
        $mainobj=new Msite_user();
        AddError("Main object has not initialized in controller");
    }?>	

<div class="register-form">	
	<div class="row-wrap ">	  			
	 <div class="form-group">
      	<label class="control-label label-required" for="email"><?php _e("Email"); ?></label>
      	<div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope"></i></span>
      	<input type="text" maxlength="100"   
      	data-bv-remote-url="<?php echo site_url("user/email-check");?>"
      	value="<?php echo  $mainobj->GetPostValue("email");?>" class="form-control" id="email"  name="email" placeholder="<?php _e("Email"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Email"));?>">
      </div>
      </div>
	<?php echo show_require_msg();?>

</div>

	<div class="row btn-group-sm popup-footer ">
			<div class="row">
				<div class="col-md-6 ">
					<button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> <?php _e("Submit")?></button>
					
				</div>
				<div class="col-md-6 text-right">
					<a data-effect="mfp-move-from-top"	href="<?php echo site_url("user/login")?>"	class="popupform  pull-right "> <?php _e("Go to Login");?> <i class="fa fa-angle-double-right"></i></a>
				</div>
			</div>
	</div>
</div>
