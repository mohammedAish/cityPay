
<?php //GPrint($muser);
if(empty($muser)){
	$muser=new Msite_user();
}
?>
<div class="panel panel-default">
	<div class="panel-body p-0 ">
		<table class="table m-b-0">
			<tr>
				<th style="width: 150px;"><?php _e("Name") ; ?></th>
				<th style="width: 20px;">:</th>
				<td><?php echo $muser->first_name." ".$muser->last_name?></td>
			</tr>
			<tr>
				<th><?php _e("Email") ; ?></th>
				<th>:</th>
				<td><?php echo $muser->email?></td>
			</tr>
			<tr>
				<th><?php _e("Join Date") ; ?></th>
				<th>:</th>
				<td><?php echo get_user_datetime_default_format($muser->join_date);?></td>
			</tr>
			<tr>
				<th><?php _e("Timezone") ; ?></th>
				<th>:</th>
				<td><?php echo $muser->tzone;?>
                    <a data-effect="mfp-move-from-top" data-onclose="TimezoneChanged" class="popupformWR btn btn-xs btn-theme" href="<?php echo site_url("client/panel/change-timezone"); ?>"><?php echo !empty($muser->tzone)?__("Change"):__("Set");?></a></td>
			</tr>
			<?php
            $userCustomFlds=Msite_user_custom_field::FindAllBy("user_id",$muser->id);
            if(count($userCustomFlds)>0){
                foreach ($userCustomFlds as $uf){
                    ?>
                    <tr>
                        <th><?php echo $uf->fld_title; ?></th>
                        <th>:</th>
                        <td>
                            <?php echo $uf->fld_value_text; ?>
                        </td>

                    </tr>
                    <?php
                }
            }
			?>
		</table>
  
	</div>
	
</div>
<?php
	$isGDPR=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_is_active",'N')=="Y";
	if($isGDPR){
		//$isGDPRDelete=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ua_active",'N')=="Y";
		//$isGDPRDownload=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ud_active",'N')=="Y";
		if(Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ud_active",'N')=="Y"){?>
            <a href="<?php echo site_url("client/panel/download-data"); ?>"><?php _e("Download this account data") ; ?></a><br/>
		<?php }
		if(Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ua_active",'N')=="Y"){ ?>
            <a href="<?php echo site_url("client/panel/delete-data") ?>" class="confirmAjaxWR" data-on-complete="account_deleted" data-msg="<?php _e("Are you sure to delete your account?") ; ?>"><?php _e("Delete my account") ; ?></a>
            <script type="text/javascript">
                function account_deleted(rdata){
                    if(rdata.status) {
                        swal({
                            title: rdata.msg,
                            type: "success",
                            cancelButtonText: appGlobalLang.closeText,
                        }, function () {
                            RedirectUrl("<?php echo base_url(); ?>");
                        });
                    }else{
                        swal(rdata.status ? "Success" : "Failed", rdata.msg, rdata.status ? "success" : "error");
                    }
                }
            </script>
		<?php }
	} ?>
<script type="text/javascript">
    function TimezoneChanged(){
        if(MyAjaxChange){
            ReloadSiteUrl();
        }
    }
    
</script>
