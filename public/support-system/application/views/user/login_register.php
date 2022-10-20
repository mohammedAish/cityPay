<?php 
$is_guest_ticket=Mapp_setting::GetSettingsValue("is_guest_ticket","N")=="Y";
$isEnableDefaultRegi=Mapp_setting::GetSettingsValue("regi_enable","N")=="N";
$col=!$is_guest_ticket || !$isEnableDefaultRegi?6:4;
?>
<div class="register-form">	
	<div class="row-wrap p-b-30">
	<h2 class="login-register-title"  style="text-transform: uppercase;"><?php _e("You are not logged in. What would you like do now?") ; ?></h2>
	<div class="row btn-icon-list">
		<div class="col-sm-<?php echo $col;?> ">
			<div class="panel panel-default">			 
			  <div class="panel-body">
			  	<span class="tag-note text-danger"><?php _e("Top Priority") ; ?></span>
		      	<a data-effect="mfp-move-from-top" class="popupformWR" href="<?php echo site_url("user/login/ticket?bbtn=".current_url());?>">
		      		<i class="fa fa-sign-in"></i>
		      		<span class="app-icon-title"><?php _e("Login") ; ?></span>
		      		<span class="app-icon-sub-title"  ><?php _e("Open ticket after login") ; ?></span>
		      		
		      	</a>
			  </div>
			</div>
		</div>
		
		<?php if($isEnableDefaultRegi){?>
		<div class="col-sm-<?php echo $col;?> ">
			<div class="panel panel-default">			 
			  <div class="panel-body">
			   	<span class="tag-note text-danger"><?php _e("Top Priority") ; ?> </span>
		      	<a data-effect="mfp-move-from-top" class="popupformWR" href="<?php echo site_url("user/register/ticket?bbtn=".current_url());?>">
		      		<i class="fa fa fa-wpforms"></i>
		      		<span class="app-icon-title"><?php _e("Register") ; ?></span>
		      		<span class="app-icon-sub-title"  ><?php _e("Open ticket after register") ; ?></span>
		      		
		      	</a>
			  </div>
			</div>
		</div>
		<?php }?>
		<?php if($is_guest_ticket){?>
		<div class="col-sm-<?php echo $col;?> ">
			<div class="panel panel-default">			 
			  <div class="panel-body">
			  	<span class="tag-note less-priroty text-danger"><?php _e("Low Priority") ; ?></span>
			      	<a href="<?php echo site_url("ticket/open");?>">
			      		<i class="fa fa-group"></i>
			      		<span class="app-icon-title"><?php _e("Guest Ticket") ; ?></span>
			      		<span class="app-icon-sub-title"  ><?php _e("Open Ticket With Less Priority") ; ?></span>
			      	</a>
			  </div>
			</div>
		</div>
		<?php }?>
	</div>
	
	
</div>	
<div class="row btn-group-sm popup-footer">
			<div class="row">					
				<?php 
				$remoteLogins=Mremote_server::FindAllBy("status", "A");
				if(count($providers)>0 || count($remoteLogins)){?>				
				<div class="col-md-12  text-center">
					<div class="row"></div>				
					<h4><?php _e("Or open ticket using");?></h4>
					<?php 
					if(count($remoteLogins)>0){
    				    foreach ($remoteLogins as $rl){
    				        // $rl=new Mremote_server();
    				        ?>
        					    <a href="<?php echo $rl->login_url;?>" style="background: <?php echo $rl->button_color;?>; <?php if(!empty($rl->button_text_color)){?> color:<?php echo $rl->button_text_color;?>;<?php }?>" class="btn btn-sm btn-default m-b-5"><?php if($rl->hasImageFile()){?><img src="<?php echo $rl->getImageUrl(true);?>" alt='' class="btn-img" style="max-height: 13px;margin-right:2px; margin-top:-2px;"><?php }?> <?php echo $rl->button_txt;?></a>
        					    <?php 
        					}
    					}
					foreach ($providers as $provider=>$link){?>
						<a href="<?php echo site_url($link."/ticket");?>" class="btn m-b-5 btn-sm btn-default btn-<?php echo strtolower($provider);?>"><i class="fa fa-<?php echo strtolower($provider);?>"></i> <?php echo $provider;?></a> 
					<?php }?>					
				</div>
				<?php }?>
			</div>
	</div>
</div>


