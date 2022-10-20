<!DOCTYPE HTML>
<html>
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
    <!-- IE 8 Fallback -->
    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="css/ie.css" />
    <![endif]-->
</head>

<body class="aps-ctrl-p site-theme body-loading site-theme-2 <?php echo strtolower(str_replace('_','-',$this->router->fetch_class().'-'.$this->router->fetch_method())); ?>  <?php echo Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"?"app-rtl":""; ?>">
	<div class="page-loader">
		<div style="margin-top:20%;font-size: 45px">
		<i class="fa fa-circle-o faa-burst animated"></i> &nbsp;<?php _e("Loading") ; ?>..
		</div>
	</div>
<div class="container-fluid app-content">	
    <div class="app-client-2-header">
    	<div class="app-header row <?php echo Mapp_setting::GetSettingsValue("app_header_isg","N")=="Y"?" app-header-gredient ":""; ?>">
    		<div class="col-md-12">
       		<?php   echo !empty($app_module[APP_Output::MODULE_HEADER])?$app_module[APP_Output::MODULE_HEADER]:"";?>
    		</div>
    	</div>
    	 <div class="<?php echo get_app_container_type();?> ">
    	<div class="row app-header-bottom">
    	  
        <?php   echo !empty($app_module[APP_Output::MODULE_HEADER_BOTTOM])?$app_module[APP_Output::MODULE_HEADER_BOTTOM]:"";?>   
        <?php   echo !empty($app_module[APP_Output::MODULE_CONTENT_TOP])?$app_module[APP_Output::MODULE_CONTENT_TOP]:"";?>  
        </div> 
        </div>
    </div>
    <?php   echo !empty($app_module[APP_Output::MODULE_BEFORE_CONTENT])?$app_module[APP_Output::MODULE_BEFORE_CONTENT]:"";
    
    if(empty($___no_noti_msg)){        
        GetNoticeMsg("S");
    }
    ?>   
	<div class="app-content p-t-15">			
		<div class="<?php echo get_app_container_type();?> ">
		<div class="row">	
			<div class="col-md-12">	
				<div class="row">
				
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
						 $defaultCData='&copy; Copyright appsbd.com '.date('Y');
						 $copywrite=Mapp_setting_api::GetSettingsValue("system", "site_copyw");
						 if(!Mapp_setting_api::HasSettings("system", "site_copyw")){ 
						     $copywrite=$defaultCData;
						 }
                         if(!empty($copywrite)){ echo $copywrite;}?>							
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
	    <button class="go_top btn-theme animated hidden"><i class="fa fa-chevron-up"></i></button>
	</div>
	        <!-- Custom scripts -->
	        <script src="<?php echo base_url();?>theme/client/js/theme-main.js"></script>
			<script type="text/javascript">
			var __previous_h=-1;
				$(function(){
					$('body').removeClass("body-loading");

					$(window).on("scroll",function(e){
						__set_stickey();
					});
					__set_stickey();
					$(".go_top").on("click",function(e){
						e.preventDefault();
						 $("html, body").animate({ scrollTop: 0 }, 600);
					});
					
				});	
				function __set_stickey(){
					__goTop();
					return;
					<?php /* ?>
					var height=$(".app-navbar").height();
					var windowTop = $(window).scrollTop();
					$(".s-m-container").css("height",$(".app-navbar").height()+12);
					if(windowTop>height){
						if(__previous_h>1 && windowTop < __previous_h){							
							$(".s-m-container").css("height",$(".app-navbar").height()+12);					
							$(".app-navbar").addClass("sticky-menu").addClass("slideInDown");
						}else{
							__previous_h=windowTop;
						}	
					}else{	
						__previous_h=-1;
						$(".s-m-container").css("height","auto");					
						$(".app-navbar").removeClass("sticky-menu").removeClass("slideInDown");
					}
					<?php */?>
				}	
				function __goTop(){
					var height=$(window).height();
					var windowTop = $(window).scrollTop();						
					if(windowTop>100){
						$(".go_top").removeClass("hidden").removeClass("zoomOut").addClass("zoomIn");
					}else{						
						$(".go_top").removeClass("zoomIn").addClass("zoomOut");
					}
				}		
			</script>

        <?php if(!empty($app_module[APP_Output::MODULE_PAGE_FOOTER])){
            echo $app_module[APP_Output::MODULE_PAGE_FOOTER];
         }?>
	</body>

</html>


      
