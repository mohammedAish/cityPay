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
        <?php if( ENVIRONMENT=="development" && is_dir(FCPATH."../../webplugins")){?>
		<link rel="stylesheet" href="<?php echo base_url();?>../../webplugins/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="<?php echo base_url();?>../../webplugins/jquery/1.11.3/jquery.min.js"></script>
		<!-- Latest compiled and minified JavaScript -->
		<script src="<?php echo base_url();?>../../webplugins/bootstrap/3.3.5/js/bootstrap.min.js"></script>		
			<!-- FontAwesome 4.4.0 -->
    	<link href="<?php echo base_url();?>../../webplugins/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<?php }else{?>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>		
		<!-- Latest compiled and minified JavaScript -->
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>			
		<!-- FontAwesome 4.4.0 -->
	    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />	   
	   <?php }
	 
	   ?>
    </head>
<body class="aps-ctrl-p">	
<div class="container">
     <?php 	echo $output; ?>    
</div>
    
</body>
</html>