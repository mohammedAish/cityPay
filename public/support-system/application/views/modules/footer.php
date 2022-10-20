<?php $footerText=Mapp_setting_api::GetSettingsValue("system","footer_text");
if(!empty($footerText)){
?>
<div class="row">
	<div class="col-md-12 text-center"><?php echo $footerText;?></div>
</div>
<?php }?>