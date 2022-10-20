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
//$grid->multisearch=true;
//$grid->shrinkToFit=false;
if(ACL::HasPermission("admin/notice/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/notice/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddModelNonSearchable("Title", "title", 100 ,"center");
$grid->SetXSCombindeField("title");
$grid->AddModelCustomSearchable("Start Date", "start_date", 80 ,"center","daterange");
$grid->AddModelCustomSearchable("End Date", "end_date",80 ,"center","daterange");
$grid->AddModelNonSearchable("Notice For", "msg_for", 80 ,"center");
$grid->AddModelNonSearchable("Added By", "added_by", 80 ,"center");
$grid->AddModelNonSearchable("Entry Time", "added_on", 110 ,"center");
$grid->AddModelNonSearchable("Status", "status", 100 ,"center");
	    
if(ACL::HasPermission("admin/notice/edit")){
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
