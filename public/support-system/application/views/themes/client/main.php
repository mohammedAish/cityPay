<!DOCTYPE HTML>
<html <?php echo Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"?' dir="rtl" ':""; ?>>
<head>
    <title><?php echo !empty($title)?$title:""; ?></title>
    <script type="text/javascript">
		var base_url="<?php echo base_url();?>";		
    </script>
   <!-- meta info -->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <script src="<?php echo  base_url("plugins/jquery/1.11.3/jquery.min.js");?>"></script>
    <?php
	    if(Mapp_setting::GetSettingsValue("is_dis_googlefont","N")!="Y") {
		    if ( ENVIRONMENT == "development" && is_dir( FCPATH . "../../webplugins" ) ) {
			    ?>
                <link rel="stylesheet" href="<?php echo base_url(); ?>../../webplugins/google/font.css"
                      type="text/css"/>
		    <?php } else {
			
			    ?>
                <link rel="stylesheet"
                      href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"
                      type="text/css"/>
			    <?php
		    }
	    }
    ?>
    <link rel="stylesheet" href="<?php echo base_url("plugins/bootstrap/3.3.7/css/bootstrap.min.css");?>">
    <!-- Latest compiled and minified JavaScript -->
	<script src="<?php echo base_url("plugins/bootstrap/3.3.7/js/bootstrap.min.js");?>"></script>			
	<!-- FontAwesome 4.4.0 -->
	<link href="<?php echo base_url("plugins/font-awesome/4.7.0/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css" />
	<!-- Ionicons 2.0.0 -->
	<link href="<?php echo base_url("plugins/ionicons/2.0.1/css/ionicons.min.css");?>" rel="stylesheet" type="text/css" />
    	

   <!--Easy Responsive Tab Start Here-->

 
     <!-- select2 -->
    <link rel="stylesheet" href="<?php echo base_url("plugins/select2/css/select2.min.css");?>"/>
    <link rel="stylesheet" href="<?php echo base_url("plugins/select2/css/select2-bootstrap.min.css");?>"/>
    
    
    <!-- IE 8 Fallback -->
    <!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
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
    if(!empty($meta)){    
    foreach($meta as $name=>$content){
    	if(empty($content))continue;
        echo "\n\t\t";
        ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
             }}
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
 ?>
<!-- Main Template styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>theme/client/css/styles.css?v=1.0">
    <link rel="stylesheet" href="<?php echo base_url();?>theme/client/css/theme-responsive.css?v=1.0">
    <link rel="stylesheet" href="<?php echo base_url();?>theme/client/css/color.css?v=<?php echo filemtime(FCPATH."theme/client/css/color.css");?>">
    <!-- Main Template styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>theme/client/css/app-custom.css?v=<?php echo fileatime(FCPATH."/theme/client/css/app-custom.css");?>">
   

</head>

<body class="aps-ctrl-p site-theme body-loading <?php echo strtolower(str_replace('_','-',$this->router->fetch_class().'-'.$this->router->fetch_method())); ?> <?php echo Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"?"app-rtl":""; ?> ">
	<div class="page-loader">
		<div style="margin-top:20%;font-size: 45px">
		<i class="fa fa-circle-o faa-burst animated"></i> &nbsp;<?php _e("Loading") ; ?>..
		</div>
	</div>
<div class="container-fluid app-content ">
	
	<div class="app-header row <?php echo Mapp_setting::GetSettingsValue("app_header_isg","N")=="Y"?" app-header-gredient ":""; ?>">
		<div class="col-md-12">
   		<?php   echo !empty($app_module[APP_Output::MODULE_HEADER])?$app_module[APP_Output::MODULE_HEADER]:"";?>
		</div>
	</div>
    <?php   echo !empty($app_module[APP_Output::MODULE_HEADER_BOTTOM])?$app_module[APP_Output::MODULE_HEADER_BOTTOM]:"";?>      
	<div class="app-content p-t-15">			
		<div class="<?php echo get_app_container_type();?> ">
            <div class="row">
	            <?php if(empty($___no_noti_msg)){
		            GetNoticeMsg("S");
	            } ?>
            </div>
		<div class="row">	
			<div class="col-md-12">	
				<div class="row">
				<?php   echo !empty($app_module[APP_Output::MODULE_CONTENT_TOP])?$app_module[APP_Output::MODULE_CONTENT_TOP]:"";?>
				</div>
			</div>
		</div>
  
		<div class="row">
            <?php 
            	$middle_col_sm_length=$middle_col_length=12;  
            	
            	if(empty($_left_col)){
            		$_left_col=3;
            		$_left_sm_col=4;
            		
            	} 
            	if(empty($_left_sm_col)){            		
            		$_left_sm_col=4;
            	
            	}
            	if(empty($_right_col_length)){
            		$_right_col_length=4;
            		
            	}         	
            	if(!empty($app_module[APP_Output::MODULE_RIGHT])){
            		$middle_col_length-=$_right_col_length;
            		
            	}
            	if(!empty($app_module[APP_Output::MODULE_LEFT])){
            		$middle_col_length-=$_left_col;
            		$middle_col_sm_length-=$_left_sm_col;
            	?>
                <div class="col-md-<?php echo $_left_col;?> col-sm-<?php echo $_left_sm_col;?>">
                    <aside class="sidebar-left">                       
                        <?php   echo !empty($app_module[APP_Output::MODULE_LEFT])?$app_module[APP_Output::MODULE_LEFT]:"";?>
                         
                        
                    </aside>
                </div>
                <?php }?>
                <div class="col-md-<?php echo $middle_col_length;?> col-sm-<?php echo $middle_col_sm_length;?>">
                	<div class="row">
                 <?php echo !empty($app_module[APP_Output::MODULE_TOP])?$app_module[APP_Output::MODULE_TOP]:"";
                    
                 	echo $output; 
                    echo !empty($app_module[APP_Output::MODULE_BOTTOM])?$app_module[APP_Output::MODULE_BOTTOM]:"";
                    ?>
                    </div>
                </div>
                <?php 
                if(!empty($app_module[APP_Output::MODULE_RIGHT])){
            		
            	?>
                <div class="col-md-<?php echo $_right_col_length;?>">
                    <aside class="sidebar-right">                       
                        <?php   echo !empty($app_module[APP_Output::MODULE_RIGHT])?$app_module[APP_Output::MODULE_RIGHT]:"";?>                         
                        
                    </aside>
                </div>
                <?php }?>
            </div>
			<div class="row">
				<?php   echo !empty($app_module[APP_Output::MODULE_CONTENT_BOTTOM])?$app_module[APP_Output::MODULE_CONTENT_BOTTOM]:"";?>
			</div>
			</div>
		 </div>
		 
		 <!-- footer -->
		
		 <div class="row">
		  <footer class="">
		   <?php if(!empty($app_module[APP_Output::MODULE_FOOTER])){?>
		  	<div class="main-footer">
				 <div class="<?php echo get_app_container_type();?> ">
				 	<div class="row main-footer-top">
						<!-- Footer Area -->
						<div class="col-md-12">
							<?php   echo !empty($app_module[APP_Output::MODULE_FOOTER])?$app_module[APP_Output::MODULE_FOOTER]:"";?>
							<div class="row"></div>
						</div>
			        </div>
			     </div>
		     </div>
		     <?php }?>
		     
		     <div class="app-copywrite text-center">
				 <div class="<?php echo get_app_container_type();?> ">
				 	<div class="row main-footer-top">
						<!-- Footer Area -->
						<div class="col-md-12">
							<?php 
						 $defaultCData='&copy; Copyright appsbd.com'.date('Y');
						 $copywrite=Mapp_setting_api::GetSettingsValue("system", "site_copyw",$defaultCData);
                            if(!empty($copywrite)){
                                echo $copywrite;
                                }?>		
							<div class="row"></div>
                            <?php
                            $isHidePoweredBy=Mapp_setting::GetSettingsValue("is_powered_by","Y")=="Y";
                            if($isHidePoweredBy){
                            ?>
                            <div class="powered-by"><?php _e("Powered By") ; ?> Best Support System</div>
                            <?php    } ?>
						</div>
			        </div>
			     </div>
		     </div>
		    
		    </footer> 	
	     </div>
	    
	</div>
	        <!-- Custom scripts -->
	        <script src="<?php echo base_url();?>theme/client/js/theme-main.js"></script>
			<script type="text/javascript">
				$(function(){
					$('body').removeClass("body-loading");
				});				
			</script>
    <?php if(!empty($app_module[APP_Output::MODULE_PAGE_FOOTER])){
        echo $app_module[APP_Output::MODULE_PAGE_FOOTER];
    }?>
	</body>

</html>


      
