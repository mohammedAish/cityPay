<?php 
$welcome_msg=Mapp_setting_api::GetSettingsValue("system","welcome_msg","");
if(!empty($welcome_msg)){
?>
<div class="app-welcome-msg alert alert-success text-center" role="alert">
  <?php echo $welcome_msg;?>
</div>
<?php }?>