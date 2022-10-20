<?php if(isLiveEditMode() || Mapp_setting_api::GetSettingsValue( "MailChimp","is_mailchimp","Y")=="Y"){ ?>
<div class="col-sm mail-chimp-form">
	<?php echo getLiveEditButton('email-subs'); ?>
	<h1><?php echo Mapp_setting_api::GetSettingsValueNoEmpty( "MailChimp","title","Want to get update?"); ?></h1>
	<p><?php echo Mapp_setting_api::GetSettingsValueNoEmpty( "MailChimp","sub_title","Subscribe with to newsletter, to get latest update and news from us"); ?></p>
	<div  class="subscribe-box">
		<input type="text" id="app-subs-email" class="src-input" placeholder="<?php echo Mapp_setting_api::GetSettingsValueNoEmpty( "MailChimp","placeholder","Enter Your Email Address"); ?>" aria-label="" aria-describedby="">
		<span id="app-subs-btn" class="header-src-icon"><?php echo Mapp_setting_api::GetSettingsValueNoEmpty( "MailChimp","subs_btn","Subscribe"); ?></span>
	</div>
	<script>
        jQuery( document ).ready(function( $ ) {
            $("#app-subs-btn").on("click",function (e) {
                var thisobj=$(this);
                e.preventDefault();
                var email =$("#app-subs-email").val();

                if(!email ){
                    ShowGritterMsg("<?php _e( "%s is required", "Email" ); ?>",false,false,"<?php _e("Email Subscription"); ?>");
                    return;
                }
                var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if(!re.test(email)) {
                    ShowGritterMsg("<?php _e( "%s is not valid", "Email" ); ?>",false,false,"<?php _e("Email Subscription"); ?>");
                    return;
                }
                var url="<?php echo site_url('site/subscribe-mail'); ?>";
                CallMyAjax(url,{email:email},function(){
                    //before send
                    thisobj.data('olddt',thisobj.text());
                },function(rdata){
                    if(rdata.status){
                        $("#app-subs-email").prop("disabled",true).val("<?php _e("You have subscribed successfully"); ?>");
                        ShowGritterMsg("<?php _e("Successfully subscribed"); ?>",true,false,"<?php _e("Email Subscription"); ?>");
                    }else{
                        ShowGritterMsg(rdata.msg,false,false,"<?php _e("Email Subscription"); ?>");
                    }
                },true,function () {
                    //complete
                    thisobj.data('olddt',thisobj.html());
                    thisobj.text( thisobj.data('olddt'));
                })
            });
        });
	</script>
</div>
<?php } ?>