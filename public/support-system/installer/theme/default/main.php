<!DOCTYPE HTML>
<html>
<head>
   
    <script type="text/javascript">
		var base_url="<?php echo base_url();?>";		
    </script>
    <!-- meta info -->
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
	<link rel="stylesheet" href="<?php echo plugin_url("bootstrap/3.3.7/css/bootstrap.min.css");?>">	
	<?php /*?><!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url();?>../../webplugins/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	*/?>
	<script src="<?php echo plugin_url("jquery/3.2.1/jquery.min.js");?>"></script>
	
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="<?php echo plugin_url("bootstrap/3.3.7/js/bootstrap.min.js");?>"></script>	
	
	<!-- FontAwesome 4.4.0 -->
	<link href="<?php echo plugin_url("font-awesome/4.7.0/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css" />	
	   
    <!-- Main Template styles -->
    <link rel="stylesheet" href="<?php echo template_url("css/styles.css?v=1.0");?>">
    <link rel="stylesheet" href="<?php echo template_url("css/theme-responsive.css?v=1.0");?>">
    <link rel="stylesheet" href="<?php echo template_url("css/color.css",true);?>">
    <!-- Main Template styles -->
    <link rel="stylesheet" href="<?php template_url("css/app-custom.css",true);?>">
    <?php AppInstaller::GetHeaderContent();?>
    
    <!-- IE 8 Fallback -->
    <!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="css/ie.css" />
<![endif]-->
    
</head>
<body class="aps-ctrl-p site-theme body-loading">
    <div class="main-container">
    <?php AppInstaller::FormOpen(); ?>
    <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading p-0"><?php AppInstaller::GetAppTitle(); ?></div>
      <div class="panel-body main-body">           
          	<?php AppInstaller::Output();?>	   
      </div>
      <div class="panel-footer">
     
            <?php  AppInstaller::FormButtons()?>
          <div class="row"></div>      
      </div>
    </div>
    </div>
   <?php AppInstaller::FormClose(); ?>
    </div>	
  <?php AppInstaller::GetFooterContent();?>
</body>
</html>


      
