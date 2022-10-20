<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo !empty($title)?$title:""; ?></title>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<?php echo "\n\t";
 
    foreach($css as $file){
         echo "\n\t\t";
        ?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
    } echo "\n\t";
 
    foreach($js as $file){
            echo "\n\t\t";
            ?><script src="<?php echo $file; ?>"></script><?php
    } echo "\n\t";
    ?>
    </head>
<body class="skin-<?php echo !empty($_app_color)?$_app_color:"blue"; ?> sidebar-mini">
  <?php 	echo $output; ?>         
</body>
</html>