<!DOCTYPE html>
<html lang="en" dir="<?php echo Mapp_setting::GetSettingsValue("is_rtl_client")=="Y"?"rtl":"ltr"; ?>" >
<head>
    <meta charset="UTF-8">
    <title><?php echo !empty($title)?$title:""; ?></title>
    <script type="text/javascript">
        var base_url="<?php echo base_url();?>";
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
	
	    foreach($css as $key=>$file){
		    echo "\n\t\t";
		    ?><link <?php echo !empty($file->id)?' id="'.$file->id.'"':""; ?> rel="stylesheet" href="<?php echo $file->url; ?>" type="text/css" /><?php
	    } echo "\n\t";
	
	    foreach($js as $file){
		    echo "\n\t\t";
		    ?><script src="<?php echo $file; ?>"></script><?php
	    } echo "\n\t";
    ?>
    <style type="text/css">
        body.app-loader{
            opacity: 0.2;
        }
    </style>
</head>
<body class="bss2020 app-loading <?php echo isLiveEditMode()?' live-edit-mode ':'';  echo strtolower(str_replace('_','-',$this->router->fetch_class().'-'.$this->router->fetch_method())); ?>">

<?php   echo !empty($app_module[APP_Output::MODULE_HEADER])?$app_module[APP_Output::MODULE_HEADER]:"";?>
<?php   echo !empty($app_module[APP_Output::MODULE_CONTENT_TOP])?$app_module[APP_Output::MODULE_CONTENT_TOP]:"";?>
<?php   echo !empty($app_module[APP_Output::MODULE_BEFORE_CONTENT])?$app_module[APP_Output::MODULE_BEFORE_CONTENT]:"";?>

<div class="<?php echo get_app_container_type();?>">


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
           <?php   echo !empty($app_module[APP_Output::MODULE_LEFT])?$app_module[APP_Output::MODULE_LEFT]:"";?>
        </div>
	<?php }?>
    <div class="col-md-<?php echo $middle_col_length;?> col-sm-<?php echo $middle_col_sm_length;?>">
    
			<?php echo !empty($app_module[APP_Output::MODULE_TOP])?$app_module[APP_Output::MODULE_TOP]:"";
				
				echo $output;
				echo !empty($app_module[APP_Output::MODULE_BOTTOM])?$app_module[APP_Output::MODULE_BOTTOM]:"";
			?>
    
    </div>
    <?php    if(!empty($app_module[APP_Output::MODULE_RIGHT])){
	
	    ?>
        <div class="col-md-<?php echo $_right_col_length;?>">
        
			    <?php   echo !empty($app_module[APP_Output::MODULE_RIGHT])?$app_module[APP_Output::MODULE_RIGHT]:"";?>

        
        </div>
    <?php }?>

</div>
</div>
<?php   echo !empty($app_module[APP_Output::MODULE_CONTENT_BOTTOM])?$app_module[APP_Output::MODULE_CONTENT_BOTTOM]:"";?>



<footer class="section-pt section-pb">
    <div class="<?php echo get_app_container_type();?>">
        <div class="row justify-content-center">
	        <?php if(!empty($app_module[APP_Output::MODULE_FOOTER])){
		        echo $app_module[APP_Output::MODULE_FOOTER];
	        }?>
        </div>
    </div>
    <?php
	    $defaultCData='&copy; Copyright appsbd.com '.date('Y');
	    $copyright=Mapp_setting_api::GetSettingsValue("system", "site_copyw",$defaultCData);
	    if(!empty($copyright)){
	        ?>
	        <div class="copy-right-container">
              <?php  echo $copyright; ?>
            </div>
	        <?php
	        
	    }
	    $isHidePoweredBy=Mapp_setting::GetSettingsValue("is_powered_by","Y")=="Y";
	    if($isHidePoweredBy){
	        ?>
            <div class="powered-by"><?php _e("Powered By") ; ?> Best Support System</div>
	        <?php
        }
	   
	   
    ?>
</footer>

<div class="call-to-act-list
<?php echo Mapp_setting_api::GetSettingsValue("webchat","wc_is_active","N")=="Y"?'left-side':''?>">
    <button id="goToTop" class="call-to-action">
        <i class="fa fa-angle-double-up"></i>
    </button>
</div>

<?php if(!empty($app_module[APP_Output::MODULE_PAGE_FOOTER])){
	echo $app_module[APP_Output::MODULE_PAGE_FOOTER];
}?>
</body>
</html>