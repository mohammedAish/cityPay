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
if(ACL::HasPermission("admin/remote-server/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/remote-server/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddModelNonSearchable("Name", "name", 80 ,"center");
$grid->SetXSCombindeField("name");
$grid->AddModelNonSearchable("Login Url", "login_url", 200 ,"center");
//$grid->AddModelNonSearchable("Valid Url", "valid_url", 100 ,"center");
//$grid->AddModelNonSearchable("Button Color", "button_color", 100 ,"center");
$grid->AddModelNonSearchable("Button View", "button_txt", 100 ,"center");
//$grid->AddModelNonSearchable("Server Type", "server_type", 100 ,"center");
$grid->AddModelNonSearchable("Status", "status", 60 ,"center");
	    
if(ACL::HasPermission("admin/remote-server/edit")){
	$grid->AddModelNonSearchable("Action", "action", 100 ,"center");
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
