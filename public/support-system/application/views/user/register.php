<?php     
    if(empty($mainobj)){
        $mainobj=new Msite_user();
        AddError("Main object has not initialized in controller");
    }?>	

<div class="register-form">	
	<div class="row-wrap ">
	  			
	 <div class="form-group">
      	<label class="control-label label-required" for="email"><?php _e("Email"); ?></label>
      	<input type="text" maxlength="100"   
      	data-bv-remote-url="<?php echo site_url("user/email-check");?>" data-bv-trigger="blur"  data-bv-remote="true"  data-bv-remote-message="<?php _e("Email address is alreay exists");?>" 
      	value="<?php echo  $mainobj->GetPostValue("email");?>" class="form-control" id="email"  name="email" placeholder="<?php _e("Email"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Email"));?>">
      </div>
      
	<div class="row">
		<div class="col-md-6"> 
			<div class="form-group">
	      		<label class="control-label label-required" for="first_name"><?php _e("First Name"); ?></label>
	      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("first_name");?>" class="form-control" id="first_name"  name="first_name"   placeholder="<?php _e("First Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("First Name"));?>">
	      	</div> 
      </div>
		<div class="col-md-6">
			<div class="form-group">
	      		<label class="control-label label-required" for="last_name"><?php _e("Last Name"); ?></label>
	      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("last_name");?>" class="form-control" id="last_name" name="last_name"     placeholder="<?php _e("Last Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Last Name"));?>">
	      	</div> 
		</div>
	</div>
	 <?php /*?><div class="form-group">
      	<label class="control-label " for="username"><?php _e("Username"); ?></label>
      	<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("username");?>" class="form-control" id="username"  name="username"      placeholder="<?php _e("Username"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Username"));?>">
      </div>
      */?>
      <div class="row">
		<div class="col-md-6"> 
			<div class="form-group">
	      		<label class="control-label label-required" for="pass"><?php _e("Password"); ?></label>
	      		<input type="password" maxlength="32"   value="<?php echo  $mainobj->GetPostValue("pass");?>" class="form-control" id="pass"  name="pass"     placeholder="<?php _e("Password"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
	      	</div> 
      </div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label" for="cpass"><?php _e("Confirm Password");?></label>
				<input type="password" name="cpass" id="cpass" value="" maxlength="250" autocomplete="off" class="form-control" placeholder="<?php _e("Confirm Password"); ?>" data-bv-identical="true" data-bv-identical-field="pass" data-bv-field="password" data-bv-notempty="true" 
				data-bv-identical-message="<?php  _e("%s is not same",__("Confirm Password"));?>" data-bv-notempty-message="<?php  _e("%s is required",__("Confirm Password"));?>">
			</div>
		</div>
	</div>
        <?php if(!empty($custom_fields)){ ?>
            <div class="row">
        
			<?php
				//Custome All Category
				foreach ($custom_fields as $fld_group){
					    ?>
                    <div class="col-md-12">
                        <?php
						echo app_get_html_form_field($fld_group,"custom_","","","","",false);
                        ?>
                    </div>
                    <?php  }
			?>
       
            </div>
        <?php } ?>
		
		<?php if(Mapp_setting::GetSettingsValue("is_cptcha_client_regi","N")=="Y"){?>
        <div class="form-group">
            <label><?php _e("Captcha");?></label>
			<?php echo AppCaptcha::get_chapcha_html('','form-control');?>
        </div>
        <?php } ?>
	<?php echo show_require_msg();?>

</div>
    <?php if(Mapp_setting_api::GetSettingsValue("gdpr","gdpr_is_agree",'N')=="Y"){?>
    <div class="row">
        <div class="col-md-12 m-b-15">
            <?php echo Mapp_setting_api::GetSettingsValue("gdpr","gdpr_agree_message",''); ?>
        </div>
    </div>
    <?php } ?>
	<div class="row btn-group-sm popup-footer ">
			<div class="row">
				<div class="col-md-6 ">
					<button type="submit" class="btn btn-theme"><i class="fa fa-paper-plane"></i> <?php _e("Submit")?></button>
					
				</div>
				<div class="col-md-6 text-right">
					<a data-effect="mfp-move-from-top"	href="<?php echo site_url("user/login")?>"	class="popupform  pull-right "><i class="fa fa-angle-double-right"></i> <?php _e("Already registered?");?></a>
				</div>
			</div>
			<?php if(count($providers)>0){?>
				<div class="row"><div class="col-md-12  text-center">
					<div class="row"></div>
					<hr class="m-t-10 m-b-5"/>
					<h4><?php _e("Or Register Using");?></h4>
					<?php 
					if(!empty($redirect_token)){
					    $redirect_token="/".$redirect_token;
					}
					foreach ($providers as $provider=>$link){?>
						<a href="<?php echo site_url($link.$redirect_token);?>" class="btn btn-sm btn-default btn-<?php echo strtolower($provider);?>"><i class="fa fa-<?php echo strtolower($provider);?>"></i> <?php echo $provider;?></a> 
					<?php }?>					
				</div>
				</div>
				<?php }?>
			
	</div>
</div>
<script type="text/javascript">
    $(function(){
    	CallOnAjaxComplete("<?php echo site_url('user/email-check')?>",function (event, xhr, settings){
        	if(!xhr.responseJSON.valid){
        		_popupajaxLoadComplted();
        	}
        });
	});
</script>