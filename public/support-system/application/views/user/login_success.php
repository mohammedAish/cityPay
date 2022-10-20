<h4> <?php _e("Logging in.. ");?></h4>
<p><?php _e("Please wait");?></p>
<script type="text/javascript">
setTimeout(function(){	
	<?php if(empty($redirect_url)){?>
	ReloadSiteUrl();
	<?php }else{?>
	RedirectUrl("<?php echo $redirect_url;?>");
	<?php }?>
},1000);

</script>