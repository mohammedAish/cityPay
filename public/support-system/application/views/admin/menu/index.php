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
if(ACL::HasPermission("admin/menu/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/menu/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
//$grid->AddModelNonSearchable("Parent Id", "parent_id", 100 ,"center");
$grid->SetXSCombindeField("parent_id");
$grid->AddModelNonSearchable("Title", "title", 100 ,"center");
$grid->AddModelNonSearchable("Link", "href", 100 ,"center");
//$grid->AddModelNonSearchable("View Counter", "view_counter", 100 ,"center");
$grid->AddModelNonSearchable("New Window", "is_new_window", 100 ,"center");
$grid->AddModelNonSearchable("Status", "status", 100 ,"center");
	    
if(ACL::HasPermission("admin/menu/edit")){
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
