<?php 
$email="";
$password="";
if(ISDEMOMODE){
   $email="user@support.com";
   $password="user";
}

if($isEnableDefaultLogin){
?>

<div class="register-form">	
	<div class="row-wrap p-b-30">
	<div class="form-group">
		<label><?php _e("E-mail");?></label> <input type="email"
			placeholder="<?php _e("ex. email@domain.com"); ?>" name="email" class="form-control"
			value="<?php echo PostValue("email",$email); ?>"
			data-bv-notempty="true"  
			data-bv-emailaddress="true"
			data-bv-emailaddress-message="<?php _e("%s is invalid",__("Email address"));?>"
			data-bv-notempty-message="<?php _e("%s is required",__("Email address"));?>">
	</div>
	<div class="form-group">
		<label style="width: 100%"><?php _e("Password");?><a data-effect="mfp-move-from-top" tabindex="-1"	href="<?php echo site_url("user/forget");?>" class="popupform  pull-right"><?php _e("Forgot password?");?></a></label> 
		
		<input type="password" name="pass" value="<?php echo $password;?>"	data-bv-notempty="true"	 class="form-control" data-bv-notempty-message="<?php _e("Password is required");?>"	placeholder="&#xf10c; &#xf10c; &#xf10c; &#xf10c; &#xf10c; &#xf10c; &#xf10c;">
		
	</div>
	<?php if(Mapp_setting::GetSettingsValue("is_cptcha_client_login","N")=="Y"){?>
	<div class="form-group">
		<label><?php _e("Captcha");?></label> 
		<?php echo AppCaptcha::get_chapcha_html('','form-control');?>
	</div>
	<?php }?>

</div>
<?php }?>
	<div class="row btn-group-sm popup-footer" style="<?php echo !$isEnableDefaultLogin?'margin-top: -10px;':'';?>" >
			<div class="row">
			<?php if($isEnableDefaultLogin){?>
				<div class="col-md-12">
					<button type="submit" class="btn btn-sm btn-theme pull-left"><i class="fa fa-unlock-alt"></i> <?php _e("Login");?></button>
					<!-- 	<button type="button" class="close-pop-up btn btn-sm btn-danger pull-right">Close</button> -->
					<?php if(Mapp_setting::GetSettingsValue("regi_enable","N")=="N"){ ?>
                    <div class="pull-right">
					<?php _e("Not member yet ?");?> <i class="fa fa-angle-double-right"></i> <a data-effect="mfp-move-from-top" href="<?php echo site_url("user/register")?>" class="popupform  btn btn-sm btn-info">  <i class="fa fa-wpforms"></i> <?php _e("Register") ; ?></a>
					</div>
                    <?php } ?>
					<div class="row"></div>
				</div>
				<?php }?>
				<?php
				$remoteLogins=Mremote_server::FindAllBy("status", "A");
				if(count($providers)>0 || count($remoteLogins) >0){?>
				<div class="col-md-12  text-center">
					<?php if($isEnableDefaultLogin){?>
					<div class="row"></div>
					<hr class="m-t-10 m-b-5"/>
					<h4><?php _e("Or Login Using");?></h4>
					<?php }?>
					<?php
					if(!empty($redirect_token)){
					    $redirect_token="/".$redirect_token;
					}
					if(count($remoteLogins)>0){
    					foreach ($remoteLogins as $rl){
    					   // $rl=new Mremote_server();
    					    ?>
    					    <a href="<?php echo $rl->login_url;?>" style="background: <?php echo $rl->button_color;?>; <?php if(!empty($rl->button_text_color)){?> color:<?php echo $rl->button_text_color;?>;<?php }?>" class="btn btn-sm btn-default m-b-5"><?php if($rl->hasImageFile()){?><img src="<?php echo $rl->getImageUrl(true);?>" alt='' class="btn-img" style="max-height: 13px;margin-right:2px; margin-top:-2px;"><?php }?> <?php echo $rl->button_txt;?></a>
    					    <?php
    					}
					}
				if(count($providers)>0 || count($remoteLogins) >0){
					foreach ($providers as $provider=>$link){?>
						<a href="<?php echo site_url($link.$redirect_token);?>" class="btn m-b-5 btn-sm btn-default btn-<?php echo strtolower($provider);?>"><i class="fa fa-<?php echo strtolower($provider);?>"></i> <?php echo $provider;?></a>
					<?php }?>
				</div>
				<?php }
					}?>
			</div>
	</div>
</div>


