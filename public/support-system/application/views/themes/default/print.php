<!DOCTYPE html>
<html lang="en"  moznomarginboxes mozdisallowselectionprint>
<head>
<title>Iframe<?php echo $title; ?></title>
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
    	       
		<link rel="stylesheet" href="<?php echo base_url();?>/theme/default/css/skin/skin-<?php echo !empty($_app_color)?$_app_color:"blue"; ?>.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url();?>/theme/default/css/AdminLTE.min.css" type="text/css" />	
		<script src="<?php echo base_url();?>/theme/default/js/app.min.js"></script>
        <style type="text/css">	

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;		
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		
		font-size: 19px;
		font-weight: normal;
		
		
	}
	header{
		padding: 14px 15px 10px 15px;
		border-bottom: 1px solid #D0D0D0;
		margin: 0 0 14px 0;
		position: relative;
	}
	header > .print-date{
		position: absolute;
		right: 0;
		bottom:5px;
	}
	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	


	.box{
		border-top: none !important;
	}
	
	@page{
		size: A4;
		margin: 0.5in;
	}
	footer{
		margin-top: 20px;
		position: fixed;
		bottom: 0;
		left: 0; 
		right: 0;
		width: 100%;
		padding: 0;
	}
	</style>
    

        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style type="text/css">
	.p-0{
		padding:2px !important; 	
	}
	</style>
    </head>
<body>
<header class="text-center">
	<h1 ><?php echo $_app_name;?></h1>
	<small class="print-date">Print Date: <?php echo date('d M,Y');?></small>
</header>
<?php echo $output; ?>
<footer style="border-top:1px solid #ccc; padding-top: 5px;; ">

<small><?php echo $_app_name;?>   &copy; <?php echo date('Y');?>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</small> 
	 

</footer>
<script type="text/javascript">
	$(function(){
		window.print();
		})
</script>
</body>
</html>