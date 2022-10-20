<?php $footerText=Mapp_setting_api::GetSettingsValue("system","footer_text");
if(!empty($footerText)){
	
    ?>
    <div class="col-sm mt-3 mt-sm-0 align-self-center">
	    <?php echo getLiveEditButton('footer-msg'); ?>
        <div class="pl-3">
            <?php echo $footerText;?>
        </div>
    </div>
<?php }?>