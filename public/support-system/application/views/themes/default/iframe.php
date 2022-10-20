<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo !empty($title)?$title:""; ?></title>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">	
        <meta name="resource-type" content="document" />
        <meta name="robots" content="all, index, follow"/>
        <meta name="googlebot" content="all, index, follow" />
        <script type="text/javascript">var base_url="<?php echo base_url();?>";</script>
       
        <script src="<?php echo  base_url("plugins/jquery/1.11.3/jquery.min.js");?>"></script>
        <?php if( ENVIRONMENT=="development" && is_dir(FCPATH."../../webplugins")){?>
    	<link rel="stylesheet" href="<?php echo base_url();?>../../webplugins/google/font.css" type="text/css" /> 
    	<?php }else{?>
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic" type="text/css" /> 
        <?php }?>   
        <link rel="stylesheet" href="<?php echo base_url("plugins/bootstrap/3.3.7/css/bootstrap.min.css");?>">
        <!-- Latest compiled and minified JavaScript -->
    	<script src="<?php echo base_url("plugins/bootstrap/3.3.7/js/bootstrap.min.js");?>"></script>			
    	<!-- FontAwesome 4.4.0 -->
    	<link href="<?php echo base_url("plugins/font-awesome/4.7.0/css/font-awesome.min.css");?>" rel="stylesheet" type="text/css" />
    	<!-- Ionicons 2.0.0 -->
    	<link href="<?php echo base_url("plugins/ionicons/2.0.1/css/ionicons.min.css");?>" rel="stylesheet" type="text/css" />
    	
	   <!-- select2 -->
        <link rel="stylesheet" href="<?php echo base_url("plugins/select2/css/select2.min.css");?>"/>
        <link rel="stylesheet" href="<?php echo base_url("plugins/select2/css/select2-bootstrap.min.css");?>"/>
        <script src="<?php echo base_url("plugins/select2/js/select2.full.min.js");?>"></script>
        
		<link rel="stylesheet" href="<?php echo base_url();?>/theme/default/css/skin/skin-<?php echo !empty($_app_color)?$_app_color:"blue"; ?>.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>/theme/default/css/AdminLTE.min.css" type="text/css" />	
		<script src="<?php echo base_url();?>/theme/default/js/app.min.js"></script>
    <?php
    /** -- Copy from here -- */
    if(!empty($meta))
    foreach($meta as $name=>$content){
        echo "\n\t\t";
        ?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
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
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
<body class="aps-ctrl-p skin-<?php echo !empty($_app_color)?$_app_color:"blue"; ?> sidebar-mini">
 <section class="content"> 
 <?php 	echo $output; ?>  
 </section>
</body>
</html>