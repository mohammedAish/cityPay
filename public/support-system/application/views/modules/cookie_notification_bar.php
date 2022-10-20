<?php
	$gdpr_op=Mapp_setting_api::GetSettingsValue("gdpr","gpbr_bg_op",90);
	$gdpr_op=($gdpr_op/100);
	$gdpr_animation=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_bar_ani","");
	$gdpr_closing_animation=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_bar_cani","slideOutDown");
	$policyPage=Mapp_setting_api::GetSettingsValue("gdpr","gpbr_policy_page","");
	$policyPage=Mcustom_page::FindBy("id",$policyPage);
	$policyLink=site_url( "site/page/{$policyPage->id}/{$policyPage->slag_title}" );
	$bgcolor=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_cnb_bg","#000000");
	$text_color=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_cnb_tc","#FFFFFF");
	$isPopUp=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_is_popsh","N")=="Y";
	$DisplayEvent=Mapp_setting_api::GetSettingsValue("gdpr","gpbr_dis_event","S");
	$classPop=$isPopUp?"popupform":"";
	if($policyPage) {
		$boxbody = Mapp_setting_api::GetSettingsValue( "gdpr", "gdpr_cookie_msg", "" );
		$boxbody = preg_replace( '/\{\{policylink\}\}/i', '<a data-effect="mfp-move-from-top" class="'.$classPop.' " href="'.$policyLink.'">'.$policyPage->title.'</a>' ,$boxbody);
		$boxbody = preg_replace( '/\{\{policyurl\}\}/i', $policyLink,$boxbody);
	}
	
	list($r, $g, $b) = sscanf($bgcolor, "#%02x%02x%02x");
	
?>
<div id="app-cookie-bar" class="cookie-bar animated <?php echo $gdpr_animation; ?>" style="color:<?php echo $text_color; ?>;background: rgba(<?php echo $r ?>,<?php echo $g ?>,<?php echo $b ?>,<?php echo $gdpr_op; ?>); ">
	<div class="container">
        <div class="col-md-10 col-sm-8">
            <?php echo $boxbody ; ?>
        </div>
        <div class="col-md-2 col-sm-4 acpt-container">
            <a href="" id="cookie_a_btn" class="acpt-btn btn btn-default btn-block"><?php _e("Accept") ; ?></a>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery( document ).ready(function( $ ) {
       $("#cookie_a_btn").on("click",function(e){
           e.preventDefault();
           $("#app-cookie-bar").removeClass("<?php echo  $gdpr_animation; ?>").addClass("<?php echo $gdpr_closing_animation; ?>");
           <?php if($DisplayEvent=="S"){ ?>
           setCookie("is_cookie_accept","Y",null,"/");
           <?php }else{
               ?>
           setCookie("is_cookie_accept","Y",30,"/");
           <?php
       } ?>
       });
    });
</script>