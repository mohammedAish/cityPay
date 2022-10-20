<h4> <?php _e("Welcome to "); echo get_app_title();?>.</h4>
<p><?php _e("Thank you for registering with us");?></p>
<script type="text/javascript">
function RegistrationloadNextPage(){
	ShowWait();	
	<?php if(empty($redirect_url)){?>
	ReloadSiteUrl();
	<?php }else{?>
	RedirectUrl("<?php echo $redirect_url;?>");
	<?php }?>
}
setTimeout(RegistrationloadNextPage,10000);
AddOnCloseMethod(RegistrationloadNextPage);
</script>