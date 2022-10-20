<?php 
$grid=new jQGrid();
$grid->url =$grid_url;
$grid->width = "auto";
//$grid->minWidth=500;
$grid->height = "auto";
$grid->rowNum = 20;
$grid->pager = "#pagerb";
$grid->container = ".grid-body";
$grid->ShowReloadButtonInTitle=true;
$grid->ShowDownloadButtonInTitle=true;
//$grid->shrinkToFit=false;
if(ACL::HasPermission("admin/client/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/client/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddModelNonSearchable("First Name", "first_name", 120 ,"left");
$grid->SetXSCombindeField("first_name");
$grid->AddModelNonSearchable("Last Name", "last_name", 120 ,"lrft");
//$grid->AddModelNonSearchable("Username", "username", 100 ,"center");
$grid->AddModel("Email", "email", 120 ,"center");
//$grid->AddModelNonSearchable("Password", "password", 100 ,"center");
$grid->AddModelNonSearchable("Verified", "is_verified_email", 50 ,"center");
$grid->AddModelNonSearchable("Gender", "gender", 60 ,"center");
//$grid->AddModelNonSearchable("Phone", "phone", 100 ,"center");
//$grid->AddModelNonSearchable("Address", "address", 100 ,"center");
//$grid->AddModelNonSearchable("Region", "region", 100 ,"center");
//$grid->AddModelNonSearchable("City", "city", 100 ,"center");
//$grid->AddModelNonSearchable("Zip", "zip", 100 ,"center");
$grid->AddModelNonSearchable("Country", "country", 60 ,"center");
//$grid->AddModelNonSearchable("Dob", "dob", 100 ,"center");
//$grid->AddModelNonSearchable("Profile Url", "profile_url", 100 ,"center");
//$grid->AddModelNonSearchable("Photo Url", "photo_url", 100 ,"center");
//$grid->AddModelNonSearchable("Age", "age", 100 ,"center");
//$grid->AddModelNonSearchable("Login Type", "login_type", 100 ,"center");
$grid->AddModelNonSearchable("Join Date", "join_date", 80 ,"center");
$customes=Mcustom_field::getGridColumn("R");
get_grid_custom_column($grid,$customes);

$grid->AddModelNonSearchable("Status", "status", 80 ,"center");
//$grid->AddModelNonSearchable("Tzone", "tzone", 100 ,"center");
	    
if(ACL::HasPermission("admin/client/edit")){
	$grid->AddModelNonSearchable("Action", "action", 80 ,"center");
}

?>
<div class="box box-primary">
	<?php /*?><div class="box-header" style="cursor: move;"></div><!-- /.box-header --><?php // */?>     
     <div class="box-body grid-body">
     <?php $grid->show();?>
     </div><!-- /.box-body -->
    <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?> 
</div>
<script type="text/javascript">
$(function(){
	AddOnCloseMethod(<?php echo $grid->ReloadMethod();?>);
});
   
</script>
