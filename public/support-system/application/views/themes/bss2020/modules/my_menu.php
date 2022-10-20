<?php $userData=GetUserData();?>
<div class="client-menu-sidebar">
<div class="sidebar-nav">
      <div class="p-0 mt-3 navbar navbar-expand-sm navbar-client-menu" role="navigation">
        <div class="navbar-header d-sm-none">
          <button type="button" class="navbar-toggle d-sm-none float-right m-0" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
              <span class="fa fa-bars"></span>
          </button>
          <span class="d-sm-none navbar-brand"><img src="<?php echo $userData->user_img;?>" alt="<?php echo $userData->title;?>"/> <?php _e("My Menu") ; ?></span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
          <ul class=" client-my-menu list-group w-100">
            <li class="list-group-item d-none d-sm-block ">
		<?php ;
		if($userData){
		?>
		<div class="text-center profile-container">

			<div class="outer-w">
				<div class="profile-img">
						<img src="<?php echo $userData->user_img; ?>" alt="<?php echo $userData->title; ?>" />
                    <?php if(Mapp_setting::GetSettingsValue("allow_profile_upload","N")=="Y"){ ?>
                    <a href="<?php echo site_url("client/panel/change-photo"); ?>" data-onclose="ReloadSiteUrl" data-effect="mfp-move-from-top" class="popupformWR app-change-photo btn btn-flat btn-info added-ripples"><?php _e("Change") ; ?></a>
                    <?php } ?>
				</div>

			</div>
			<div><?php echo $userData->title?></div>

			<small><?php _e("Join : %s",get_user_date_default_format($userData->add_date)) ; ?></small>
		</div>
		<?php }else{?>
		<label for=""><?php _e("My Menu"); ?></label>
		<?php }?>
                <?php if(empty($counter)){
                    $counter=Mticket::getClientTicketCounter($userData->id);
                } ?>
	</li>
            <li><a class="<?php echo is_current_uri_path("client/panel/dashboard")?" active ":"";?>" href="<?php echo site_url("client/panel/dashboard")?>"><i class="fa fa-th"></i> <?php _e("Dashboard") ; ?></a></li>
			    <li><a class="<?php echo is_current_uri_path("ticket/active-tickets")?" active ":"";?>" href="<?php echo site_url("ticket/active-tickets")?>"><i class="fa fa-ticket"></i> <?php _e("Active Tickets") ; ?><span class="badge badge-success active-ticket ml-1"><?php echo $counter->active;?></span></a></li>
			    <li><a class="<?php echo is_current_uri_path("ticket/closed-tickets")?" active ":"";?>" href="<?php echo site_url("ticket/closed-tickets")?>"><i class="fa fa-ticket"></i> <?php _e("Closed Tickets") ; ?><span class="badge badge-danger closed-ticket ml-1"><?php echo $counter->closed;?></span></a></li>
			    <li><a class="<?php echo is_current_uri_path("client/panel/profile")?" active ":"";?>" href="<?php echo site_url("client/panel/profile")?>"><i class="far fa-user-circle"></i> <?php _e("Profile") ; ?></a></li>

			    <li><a class="popupformWR" data-effect="mfp-move-from-top" href="<?php echo site_url("alluser/user/change-password");?>"><i class="fa fa-hashtag"></i> <?php echo empty($userData->is_skip_old_pass)?__("Change Password"):__("Set Passowrd");?></a></li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
</div>
</div>

