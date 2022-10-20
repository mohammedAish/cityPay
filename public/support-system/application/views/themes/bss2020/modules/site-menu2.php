<?php 
$userdata=GetUserData();
	$__redirect_url="";
if(empty($userdata)){
	$__redirect_url=current_uri_path()=="ticket/open"?"/ticket":"";
}
$_app_white_logo=image_url('images/logo.png',true);

$CI=get_instance();
$CI->load->library('hybridauth');
	$isLogoOnly=Mapp_setting::GetSettingsValue("isonly_logo","Y")=="Y" && Mapp_setting::GetSettingsValue("is_show_app_ttl","Y")!="Y";
	
	$isEnableDefaultRegi  = Mapp_setting::GetSettingsValue( "regi_enable", "N" ) == "N";
	$isEnableDefaultLogin = Mapp_setting::GetSettingsValue( "dlogin_enable", "N" ) == "N";
if(!empty($userdata)) {
   
    $loginURL             = site_url( "user/login{$__redirect_url}" );
    $isNoPopUp            = false;
	
}
?>


<header>
    <!-- Fixed navbar -->
    <nav id="main-nav" class="navbar navbar-expand-md   ">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url();?>">
	            <?php if(Mapp_setting::GetSettingsValue("isonly_logo","Y")=="Y"){?>
                <img class="app-logo-img <?php echo $isLogoOnly?' app-logo-img-full ':''; ?>" alt="Logo"
                     src="<?php echo $_app_white_logo;?>">
                <?php } ?>
                <div class="app-title"><?php if(Mapp_setting::GetSettingsValue("is_show_app_ttl","Y")=="Y"){?>
				        <?php echo get_app_title();?>
			        <?php }?></div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="col">
                    <ul class="navbar-nav d-flex justify-content-center ">
                        <li class="nav-item <?php echo current_uri_path()=="site/index"?" active ":"";?>">
                            <a class="nav-link" href="<?php echo site_url("");?>"><i class="fa fa-home"></i> <?php _e("Home");?></a>
                        </li>
                        <?php if(Mapp_setting::GetSettingsValue("is_hide_knowledge","N") !='Y'){ ?>
                        <li class="nav-item <?php echo current_uri_path()=="knowledge/index"?" active ":"";?>">
                            <a class="nav-link" href="<?php echo site_url("knowledge");?>"><i class="fa fa-graduation-cap"></i> <?php _e("Knowledge");?></a>
                        </li>
	                    <?php
                        }
		                    $aditionalMenus=Mmenu::FindAllBy("status", "A");
		                    foreach ($aditionalMenus as $m){
			                    $clink=$m->href_type=="P"?site_url($m->href):$m->href;
			                    ?>
                                <li class="nav-item <?php echo current_url(false)==$clink?" active ":"";?>"><a class="nav-link" href="<?php echo $clink;?>" <?php echo $m->is_new_window=="Y"?' target="blank" ':'';?> ><i class="fa <?php echo $m->text_icon;?>"></i> <?php echo $m->title;?></a></li>
			                    <?php
		                    }
		                    $addonSiteLinks=AddOnManager::getSiteLinks();
		                    foreach ($addonSiteLinks as $addonSiteLink) {
			                    ?>
                                <li class="nav-item"><a class="nav-link" href="<?php echo $addonSiteLink->url ?>"><i class="fa <?php echo $addonSiteLink->iconClass; ?>"></i> <?php echo $addonSiteLink->title; ?></a></li>
			                    <?php
		                    }
	                    ?>
                    </ul>
                </div>
                <div class="text-center header-btns">
	                <?php echo get_open_ticket_link('btn btn-sm btn-login');?>
	                <?php  if(empty($userdata)){?>
                        <a class="popupformWR btn btn-sm btn-login" id="app-login-2" href="<?php echo site_url("user/login{$__redirect_url}")?>" data-effect="mfp-move-from-top"><i class="fas fa-sign-in-alt"></i> <?php _e("Login");?></a>
	                <?php }else{?>
                        
                        <div class="dropdown open">
                    <a class="btn btn-sm btn-login" href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-bars"></i> My Menu <span class="caret"></span></a>


                            <ul class="dropdown-menu">
                                <li><a class="<?php echo is_current_uri_path("client/panel/dashboard")?" active ":"";?>" href="<?php echo site_url("client/panel/dashboard")?>"><i class="fa fa-ticket"></i> <?php _e("Dashboard") ; ?></a></li>
                                <li><a class="<?php echo is_current_uri_path("ticket/active-tickets")?" active ":"";?>" href="<?php echo site_url("ticket/active-tickets")?>"><i class="fa fa-ticket"></i> <?php _e("Active Tickets") ; ?></a></li>
                                <li><a class="<?php echo is_current_uri_path("ticket/closed-tickets")?" active ":"";?>" href="<?php echo site_url("ticket/closed-tickets")?>"><i class="fa fa-ticket"></i> <?php _e("Closed Tickets") ; ?></a></li>
                                <li><a class="<?php echo is_current_uri_path("client/panel/profile")?" active ":"";?>" href="<?php echo site_url("client/panel/profile")?>"><i class="far fa-user-circle"></i> Profile</a></li>
                                <li><a class="popupformWR" data-effect="mfp-move-from-top" href="<?php echo site_url("alluser/user/change-password");?>"><i class="fa fa-star"></i> Change Password</a></li>
                            </ul>
                        </div>
                        <a class="btn btn-sm  btn-register" href="<?php echo site_url("user/logout")?>"><i class="fa fa-power-off"></i> <?php _e("Logout");?></a>
	
	                <?php }?>
	
	                <?php
                        if($isEnableDefaultRegi && empty($userdata)){?>
                        <a class="popupformWR btn btn-sm btn-register" data-effect="mfp-move-from-top" href="<?php echo site_url("user/register{$__redirect_url}")?>"><i class="fa fa-wpforms"></i> <?php _e("Register");?></a>
	                <?php }?>
                </div>
            </div>
        </div>
    </nav>


</header>