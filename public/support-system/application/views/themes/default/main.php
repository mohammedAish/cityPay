<!DOCTYPE html>
<html lang="en"  <?php echo Mapp_setting::GetSettingsValue("is_rtl_admin")=="Y"?' dir="rtl" ':""; ?> >
	<head>
		<title><?php echo !empty($title)?$title:""; ?></title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
        <meta name="resource-type" content="document" />
        <meta name="robots" content="all, index, follow"/>
        <meta name="googlebot" content="all, index, follow" />
        <script type="text/javascript">var base_url="<?php echo base_url();?>";</script>
        

        <?php if( ENVIRONMENT=="development" && is_dir(FCPATH."../../webplugins")){?>
    	<link rel="stylesheet" href="<?php echo base_url();?>../../webplugins/google/font.css" type="text/css" /> 
    	<?php }else{?>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" type="text/css" /> 
        <?php }?>
		<link rel="stylesheet" href="<?php echo base_url();?>theme/default/css/skin/skin-<?php echo !empty($_app_color)?$_app_color:"blue"; ?>.min.css" type="text/css" />

    <?php 
    $favexist=true;    
    $faviconurl=image_url("images/icon-logo/logo.png",true);
    	
    if($favexist){
    ?>    
   
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo image_url("images/icon-logo/apple-touch-icon.png",true);?>">
	<link rel="icon" type="image/png" href="<?php echo $faviconurl;?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo image_url("images/icon-logo/favicon-32x32.png",true);?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo image_url("images/icon-logo/favicon-16x16.png",true);?>">
	<link rel="manifest" href="<?php echo base_url("images/icon-logo/manifest.json");?>">

    <meta name="theme-color" content="<?php echo Mapp_setting::GetSettingsValue("app_main_color");?>">
    <meta name="msapplication-navbutton-color" content="<?php echo Mapp_setting::GetSettingsValue("app_main_color");?>">
    <?php
     }
   
    /** -- Copy from here -- */
    if(!empty($meta))
    foreach($meta as $name=>$content){
        echo "\n\t\t";
        ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
             }
    echo "\n";
    
    if(!empty($meta_property))
    foreach($meta_property as $name=>$content){
        echo "\n\t\t";
        ?><meta property="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
             }
    echo "\n";

    if(!empty($canonical))
    {
        echo "\n\t\t";
        ?><link rel="canonical" href="<?php echo $canonical?>" /><?php
 
    }
    echo "\n\t";
 
    foreach($css as $file){
         echo "\n\t\t";
        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";
 
    foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
    } echo "\n\t";
 
    /** -- to here -- */
?>
       <!--[if lt IE 9]>
            <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
<body class="aps-ctrl-p skin-<?php echo !empty($_app_color)?$_app_color:"blue"; ?> sidebar-mini <?php  echo  !empty($_COOKIE['isMBC'])?' sidebar-collapse ':'';?>  <?php echo Mapp_setting::GetSettingsValue("is_rtl_admin")=="Y"?"app-rtl":""; ?> ">
<?php
	$_app_name=get_app_title();
	$_app_short_name=get_app_title_short($_app_name);
?>	
    <div class="wrapper">      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo site_url("admin")?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><?php echo !empty($_app_short_name)?$_app_short_name:'<b>A</b>LT';?></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">
          <?php 
          
          	$sppost=strpos($_app_name, " ");
          	$_firstpart=$_app_name;
          	$_2ndpart="";
          	if($sppost!==FALSE){
          		$_firstpart=substr($_app_name, 0,$sppost);
          		$_2ndpart=substr($_app_name,$sppost);
          	}
          ?>
          <b><?php echo $_firstpart;?></b><?php echo $_2ndpart;?></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <a href="<?php echo base_url();?>" target="blank" class="top-bar-link " ><i class="fa fa-globe"></i> <?php _e("View Site") ; ?></a>
         
          <?php
	          $adminData=GetAdminData();
	          if(!empty($adminData) && $adminData->IsSuperUser()) {
	              ?>
                  <a href="<?php echo base_url('?live=1');?>" target="blank" class="top-bar-link " ><i class="fa fa-edit"></i> <?php _e("Live Edit") ; ?></a>
	              <?php
	          }
          ?>
          
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php
                // */
                $__current_user_type=GetCurrentUserType();
                $__baseUserData=GetAppBaseUserData();
                $logouturl=$__baseUserData->getLogoutUrl();
                ?>
                <!-- Messages: style can be found in dropdown.less-->

              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu notifications-menu2">
                 <?php echo AppNotification::getMessageHTML();?>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <li id="app_noti_container" class="dropdown messages-menu notifications-menu2">
                <?php //notifications-menu 
              echo AppNotification::getNotificationHTML();?>
              </li>              

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $__baseUserData->user_img;?>" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php  echo !empty($__baseUserData->title)?$__baseUserData->title:"User";?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $__baseUserData->user_img;?>" class="img-circle" alt="User Image" />
                    <p>
                      <?php                      
                      echo !empty($__baseUserData->title)?$__baseUserData->title:"User";?>
                        <small><?php _e("Member since") ; ?> <?php echo date('M. Y', strtotime($__baseUserData->add_date));?></small>
                        <div id="user_chat_status_container" class="chat-status-bar">
                        <label style="display: inline;" class="control-label" for="chatstatus"><?php _e("Chat Online Status"); ?> &nbsp;</label>
                            <div class="togglebutton " style="display: inline;">
                                <label>
                                    <input class="ajax-toggle"  data-oncomplete="updatedChatStatus"   type="checkbox" data-url="<?php echo admin_url("dashboard/update-chat-status"); ?>" <?php echo !empty($__baseUserData->isChatEnable)?' checked="checked"':'';?> value="Y"  id="chatstatus"  name="_chatstatus" >
                                </label>
                                <span class="form-group-help-block"><?php _e("");?></span>
                            </div>
                            <div class="row"></div>
                      </div>

                    <a href="<?php echo alluser_url("user/change-password");?>" data-effect="mfp-move-from-top" class="popupform  btn btn-xs btn-black"><i class="fa fa-gear"></i> <?php _e("Change Password") ; ?></a>
                    </p>
                  </li>
                  <!-- Menu Body -->

                  <!-- Menu Footer-->
                  <li class="user-footer text-center">
                    <?php /*?> <div class="pull-left">
                     <a href="#" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">                      
                       <a href="<?php echo $logouturl;?>" class="btn btn-default btn-flat"><?php _e("Sign out") ; ?></a>
                    </div><?php */?>
                     <a href="<?php echo $logouturl;?>" class="btn btn-default btn-flat"><?php _e("Sign out") ; ?></a>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
               &nbsp;
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $__baseUserData->user_img;?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">            	
            	<p><?php echo Mapp_user::getLoggedUserTitle();?></p>            	
               	<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>     
          <div id="sidebar-menu-container">
          <!-- sidebar menu: : style can be found in sidebar.less -->         
          <ul class="sidebar-menu">   
          <?php
			if(!AppMenu::$isMenuLoaded){
				$this->load->view("menus"); 
			}			
			?>        
            <?php  foreach ( AppMenu::GetMenus() as $apm){
            	if($apm->isDisabled){
            		continue;
            	}
            	if($apm->type=="M"){
					if(!$apm->isGroupViewable)continue;
            ?>
            <li class="<?php echo $apm->isSelected?"active selected open ".(count($apm->submenus)>0?"has-sub":""):"";?> treeview">
              <a href="<?php echo !empty($apm->url)?$apm->url:'#'?>" class="<?php echo $apm->cssClass;?> <?php echo $apm->isSelected?"active":""?>">
                <i class="fa <?php echo $apm->iconClass;?>"></i> <span><?php echo $apm->title;?></span>
                <?php if(empty($apm->rightText) && count($apm->submenus)>0){?>
                 <i class="fa fa-angle-left pull-right"></i>
                 <?php }elseif(!empty($apm->rightText)){?>
                 <span class="pull-right-container">
                	 <small class="label pull-right bg-<?php echo $apm->rightTextColor;?>"><?php echo $apm->rightText?></small>
                 </span>
                 <?php }?>
              </a>
            <?php if(count($apm->submenus)>0){?>
              <ul class="treeview-menu">
               <?php foreach ( $apm->submenus as $apsm){            	
            		?>
                	<li class="<?php echo $apsm->isSelected?" active selected ":"";?> "><a class="<?php echo $apsm->cssClass;?>" href="<?php echo !empty($apsm->url)?$apsm->url:'#'?>"><i class="fa <?php echo $apsm->iconClass;?>"></i> <?php echo $apsm->title;?></a></li>
               
                <?php }?>
              </ul>
              <?php }?>
            </li>
            <?php
            	}else{
            		?>
            		<li class="header"><?php echo $apm->title;?></li>
            		<?php 
            	}            	
            }?> 
             
          </ul>
          </div>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div  id="main-content"  class="content-wrapper">
      
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           <?php if(!empty($__icon_class)){?>
          <i class="<?php echo $__icon_class;?>"></i> 
          <?php }?>
            <?php echo !empty($_title)?$_title:""; ?>
            <?php if(!empty($_subTitle)){?>
            <small><?php echo $_subTitle;?></small>
            <?php }?>
          </h1>
          <?php if(!empty($_uiBreadCrumb) && is_array($_uiBreadCrumb)){?>
          <ol class="breadcrumb">
		  	<?php foreach ($_uiBreadCrumb as $btitle=>$blink){  		
		  	?>
		    <li>
		    <?php if($blink->url!="#"){?>
		   		 <a href="<?php echo $blink->url;?>"><i class="<?php echo $blink->icon;?>"></i> <?php echo  $blink->title;?></a>
		   		 <?php }else{ echo $blink->title;}?>
		    </li>
		    <?php }?>   
		  </ol>
          <?php }?>
        </section>

        <!-- Main content -->
        <section class="content"> 
          <!-- Main row -->
            <?php 	
            if(empty($___no_noti_msg)){
                GetSystemMsg();
                GetNoticeMsg("A");
            }
            echo $output; ?>         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version  </b><?php echo $_app_version;?> 
        </div>
        <strong><i class="ap ap-support-system" style="vertical-align: middle;"></i> <?php echo $_app_name;?> </strong>.
      </footer>  
    </div><!-- ./wrapper -->
<script type="text/javascript">
    $(function () {
       $("#user_chat_status_container").on("click",function (e) {
           e.stopPropagation();
       })
    });
    function updatedChatStatus(rdata,thisObj){
        if(rdata.status){
            update_basic_conf(rdata.data.status);
        }
    }

</script>
</body>
</html>