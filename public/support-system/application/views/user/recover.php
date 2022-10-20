<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default app-panel-box">
			<div class="panel-heading"><?php _e("Set new password"); ?></div>		  
		  <div class="panel-body ">		  
	      	<?php 
	      	echo GetMsg();
	      	if(empty($is_reset_success)){
	      	echo form_open(current_url(),array("class"=>"form bv-form material","method"=>"post"));?>         
         
	      	<div class="form-group">
	      		<label class="control-label label-required" for="pass"><?php _e("Password"); ?></label>
	      		<input type="password" maxlength="32"   value="" class="form-control" id="pass"  name="pass"     placeholder="<?php _e("Password"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
	      	</div> 
           <div class="form-group">
				<label class="control-label" for="cpass">Confirm Password</label>
				<input type="password" name="cpass" id="cpass" value="" maxlength="250" autocomplete="off" class="form-control" placeholder="<?php _e("Confirm password"); ?>" data-bv-identical="true"data-bv-identical-field="pass" data-bv-field="password" data-bv-notempty="true"data-bv-identical-message="Confirm password is not same"data-bv-notempty-message="Confirm Password is required">
			</div>
			<div class="">
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-unlock-alt"></i> <?php _e("Update");?></button>
            </div> 
            <div class="row"></div>
             <?php echo form_close();
	      	}else{?>
	      	   <div class="text-center">
	      	   <p><?php _e("Your password has been changed successfully") ; ?></p>
	      	   <a data-effect="mfp-move-from-top" class="popupformWR btn btn-success" href="<?php echo site_url("user/login");?>">Click here to login</a>
	      	 
	      	   </div>
	      	   <?php 
	      	}
             ?>
		  </div>
		</div>
	</div>
	<div class="col-md-4 md-p-l-0">
	
		<?php echo $this->getModule("right_module");?>		
		
	</div>
</div>