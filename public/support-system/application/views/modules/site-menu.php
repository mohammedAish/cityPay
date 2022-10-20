<?php 
$userdata=GetUserData();
if(empty($userdata)){
	$__redirect_url=current_uri_path()=="ticket/open"?"/ticket":"";
}
?>
<div class="row">
	<nav class="navbar navbar-default app-navbar">
	  <div class="<?php echo get_app_container_type();?> ">
		<div class="row">
	    <!-- Brand and toggle get grouped for better mobile display -->
	        <!-- Brand and toggle get grouped for better mobile display -->
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
	      <ul class="nav navbar-nav">
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
	      </ul>	   
	      <ul class="nav navbar-nav navbar-right">
	      <li><?php echo get_open_ticket_link();?></li>
	      <?php 

	      if(empty($userdata)){
	      	
	      ?>
	        <li><a class="popupformWR" id="app-login"
						href="<?php echo site_url("user/login{$__redirect_url}")?>"
						data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i> <?php _e("Login");?></a></li>
	        <li><a class="popupformWR" data-effect="mfp-move-from-top" href="<?php echo site_url("user/register{$__redirect_url}")?>"><i class="fa fa-wpforms"></i> <?php _e("Register");?></a></li>	        
	      <?php }else{?>
	      <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          <img src="<?php echo $userdata->user_img;?>" alt="<?php echo $userdata->title;?>" />My Menu <span class="caret"></span></a>
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
	  </div><!-- /.container-fluid -->
	</nav>
</div>