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
if(ACL::HasPermission("admin/page/add")){
	$grid->AddTitleRightHtml('<a  class="btn btn-xs btn-info" href="'.site_url("admin/page/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 20 ,"center");
$grid->AddModelNonSearchable("Title", "title", 150 ,"center");
$grid->SetXSCombindeField("title");
//$grid->AddModelNonSearchable("Slag Title", "slag_title", 100 ,"center");
$grid->AddModelNonSearchable("Added", "added_on", 50 ,"center");
$grid->AddModelNonSearchable("Status", "status", 50 ,"center");
	    
if(ACL::HasPermission("admin/page/edit")){
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
