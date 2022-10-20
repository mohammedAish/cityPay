<?php 
$grid=new jQGrid();
//$grid->caption="abc";
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
	if(ACL::HasPermission("admin/custom-field-confirm/reset_order")){
		$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="ConfirmAjaxWR btn btn-xs btn-warning"  data-msg="'.__("Are you sure to reset order?").'" href="'.site_url("admin/custom-field-confirm/reset_order").'" ><i class="fa fa-refresh"></i>'.__('Reset Order').'</a>');
	}
if(ACL::HasPermission("admin/custom-field/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/custom-field/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}

//Fields
//$grid->AddModel("Id", "id", 100 ,"center");

$grid->AddModelNonSearchable("Label", "title", 100);
$grid->SetXSCombindeField("title");
$grid->AddModelNonSearchable("Category", "cat_id", 150 );
//$grid->AddModelNonSearchable("Help Text", "help_text", 100 ,"center");
$grid->AddModelNonSearchable("Type", "type", 80 );
$grid->AddModelNonSearchable("Options", "opt_json_base", 100 ,"center");
$grid->AddModelNonSearchable("Required", "is_required", 60 ,"center");
$grid->AddModelNonSearchable("API Based", "is_api_based", 60 ,"center");
//$grid->AddModelNonSearchable("Api Name", "api_name", 100 ,"center");
$grid->AddModelNonSearchable("Order", "fld_order", 60 ,"center");
$grid->AddModelNonSearchable("Status", "status", 60 ,"center");

if(ACL::HasPermission("admin/custom-field/edit")){
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
