<?php 
$userdata=GetUserData();
if(empty($userdata)){
	$__redirect_url=current_uri_path()=="ticket/open"?"/ticket":"";
}
if(file_exists(FCPATH."images/white-logo.png")){
    $_app_white_logo=image_url('images/white-logo.png',true);
}else{
    $_app_white_logo=image_url('images/logo.png',true);
}
$CI=get_instance();
$CI->load->library('hybridauth');
?>
<div class="row s-m-container">

	<nav class="navbar navbar-default app-navbar app-navbar-2 animated">
	  <div class="<?php echo get_app_container_type();?> ">
		<div class="row">
	    <!-- Brand and toggle get grouped for better mobile display -->
	        <!-- Brand and toggle get grouped for better mobile display -->
	    
		<?php
        $isLogoOnly=Mapp_setting::GetSettingsValue("isonly_logo","Y")=="Y" && Mapp_setting::GetSettingsValue("is_show_app_ttl","Y")!="Y";
        ?>
		<div class="col-md-4"> 
		  <div class="row ">
		  <div class=" app-logo-container <?php echo $isLogoOnly?' app-logo-container-full ':''; ?>">
		      <a href="<?php echo base_url();?>">
                <?php if(Mapp_setting::GetSettingsValue("isonly_logo","Y")=="Y"){ ?>
                  <img class="app-logo-img <?php echo $isLogoOnly?' app-logo-img-full ':''; ?>" alt="Logo"
					src="<?php echo $_app_white_logo;?>">
                  <?php }
                
                ?>
                  <div class="app-title">
                      <?php if(Mapp_setting::GetSettingsValue("is_show_app_ttl","Y")=="Y"){?>
					      <?php echo get_app_title(); ?>
				      <?php
					}?>
                  </div>
		      </a>
		 </div>  
		 </div>
		</div>
		<div class="col-md-8">
		 <div class="row ">
		<div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	      
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand visible-xs" href="<?php echo base_url();?>"><?php _e("Site Menu") ; ?></a>
	     <?php  if(empty($userdata)){?>
	      <a class="popupformWR navbar-brand visible-xs pull-right" id="app-login-2" href="<?php echo site_url("user/login{$__redirect_url}")?>" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i> <?php _e("Login");?></a>
	     <?php }else{?>
	      <a class="navbar-brand visible-xs pull-right" href="<?php echo site_url("user/logout")?>"><i class="fa fa-power-off"></i> <?php _e("Logout");?></a>
	      <?php }?>
	     
	    </div>
	
	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse p-0" id="bs-example-navbar-collapse-1">
	       
	      <ul class="nav navbar-nav navbar-right">
	      <li class="<?php echo current_uri_path()=="site/index"?" active ":"";?>"><a href="<?php echo base_url()?>"><i class="fa fa-home"></i> <?php _e("Home");?></a></li>
              <?php if(Mapp_setting::GetSettingsValue("is_hide_knowledge","N") !='Y'){ ?>
          <li class="<?php echo current_uri_path()=="knowledge/index"?" active ":"";?>"><a href="<?php echo site_url("knowledge");?>"><i class="fa fa-graduation-cap"></i> <?php _e("Knowledge");?></a></li>
	        <?php
              }
	           $aditionalMenus=Mmenu::FindAllBy("status", "A");
	           foreach ($aditionalMenus as $m){
	               $clink=$m->href_type=="P"?site_url($m->href):$m->href;
	               ?>
	           <li class="<?php echo current_url(false)==$clink?" active ":"";?>"><a href="<?php echo $clink;?>" <?php echo $m->is_new_window=="Y"?' target="blank" ':'';?> ><i class="fa <?php echo $m->text_icon;?>"></i> <?php echo $m->title;?></a></li>
	               <?php 
	           }
	        ?>
	      <li><?php echo get_open_ticket_link();?></li>
	      <?php
          $addonSiteLinks=AddOnManager::getSiteLinks();
          foreach ($addonSiteLinks as $addonSiteLink) {
              ?>
              <li><a href="<?php echo $addonSiteLink->url ?>"><i class="fa <?php echo $addonSiteLink->iconClass; ?>"></i> <?php echo $addonSiteLink->title; ?></a></li>
              <?php
          }
	      if(empty($userdata)){
	          $isEnableDefaultRegi=Mapp_setting::GetSettingsValue("regi_enable","N")=="N";
	          $isEnableDefaultLogin=Mapp_setting::GetSettingsValue("dlogin_enable","N")=="N";
	          $loginURL=site_url("user/login{$__redirect_url}");
	          $isNoPopUp=false;
	          if(!$isEnableDefaultLogin){
	              
	              $socialProvider=$CI->hybridauth->HA->getProviders();
	              if(count($socialProvider)==0){
	                  $remoteLogins=Mremote_server::FindAllBy("status", "A");
	                  if(count($remoteLogins)==1){
	                      $loginURL=$remoteLogins[0]->login_url;
	                      $isNoPopUp=true;
	                  }
	              }
	          }
	         
	      	
	      ?>
	        <li><a class=" <?php echo $isNoPopUp?'':' popupformWR ';?> " id="app-login"
						href="<?php echo $loginURL;?>"
						data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i> <?php _e("Login");?></a></li>
		      <?php if($isEnableDefaultRegi){?>
	        <li><a class="popupformWR" data-effect="mfp-move-from-top" href="<?php echo site_url("user/register{$__redirect_url}")?>"><i class="fa fa-wpforms"></i> <?php _e("Register");?></a></li>
	        <?php }?>	        
	      <?php }else{?>
	      <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          <img src="<?php echo $userdata->user_img;?>" alt="<?php echo $userdata->title;?>" /><?php _e("My Menu") ; ?> <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a class="<?php echo is_current_uri_path("client/panel/dashboard")?" active ":"";?>" href="<?php echo site_url("client/panel/dashboard")?>"><i class="fa fa-ticket"></i> <?php _e("Dashboard") ; ?></a></li>
	            <li><a class="<?php echo is_current_uri_path("ticket/active-tickets")?" active ":"";?>" href="<?php echo site_url("ticket/active-tickets")?>"><i class="fa fa-ticket"></i> <?php _e("Active Tickets") ; ?></a></li>
	            <li><a class="<?php echo is_current_uri_path("ticket/closed-tickets")?" active ":"";?>" href="<?php echo site_url("ticket/closed-tickets")?>"><i class="fa fa-ticket"></i> <?php _e("Closed Tickets") ; ?></a></li>
	            <li><a class="<?php echo is_current_uri_path("client/panel/profile")?" active ":"";?>" href="<?php echo site_url("client/panel/profile")?>"><i class="fa fa-user-circle-o"></i> Profile</a></li>
	            <li><a class="popupformWR" data-effect="mfp-move-from-top" href="<?php echo site_url("alluser/user/change-password");?>"><i class="fa fa-star"></i> Change Password</a></li>	            
	          </ul>
	        </li>
	        <li><a  href="<?php echo site_url("user/logout")?>"><i class="fa fa-power-off"></i> <?php _e("Logout");?></a></li>
	      <?php }?>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	    </div>
		</div> <!-- end menu wrapper -->
		
		
	    
	    </div>
	  </div><!-- /.container-fluid -->
	</nav>
</div>