<?php if(empty($cboxWidth)){$cboxWidth=325;}
$cboxWidth=strtolower($cboxWidth)=="auto"?"auto":$cboxWidth."px";
$col_class=!empty($__col_class)?$__col_class:"col-md-6";
if(empty($method)){$method="post";}
if(!isset($formtype)){$formtype="form-horizontal";}
?>
<div id="popup-container"  class="mfp-with-anim mfp-dialog <?php echo $col_class;?> clearfix">
<?php if(!empty($__icon_class)){?><i class="fa <?php echo $__icon_class;?> dialog-icon"></i><?php }?>
<div style=" position:relative;">
	<div class="hidden-xs" style="width:<?php echo $cboxWidth; ?>;"></div>	
	<div id="LightBoxBody" class="lightbox-body" style="padding:0 4px 2px;">
		<?php if(!empty($_title)){?>
			<div class="row">	 
			<h3><?php echo $_title;?></h3>
            <?php if(!empty($_subTitle)){?>           
            <h5 class="p-0 m-t-0"><?php echo $_subTitle;?></h5>
            <?php }	?>
            <hr class="" style="margin: 0px 0px 8px;" />
		</div>
		<?php }?>
		<div class="container-fluid"> 
		<div class="row" style="margin-left: -16px; margin-right: -16px;"><?php echo GetMsg();?></div>	
			<div class="row">					  
		 		<?php echo !empty($_msg_only)?$_msg_only:""; ?>
		 		<div class="row btn-group-md popup-footer text-right">	
			<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Close");?></button>
		</div> 		 			 	 
		 	</div>	
		 	
	 	</div>
	 	
	</div>
</div>
</div>
