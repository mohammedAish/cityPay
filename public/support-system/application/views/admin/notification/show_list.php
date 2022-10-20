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
$grid->afterInsertRow="AfterInsertRow";
//$grid->shrinkToFit=false;

//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddHiddenProperty("main_status","main_status");
$grid->AddModelNonSearchable("Time", "entry_time", 60 ,"center","",true);
$grid->AddModelNonSearchable("Title", "title", 100 ,"left");
$grid->SetXSCombindeField("entry_time");
$grid->AddModelNonSearchable("Message", "msg", 250 ,"left");
//$grid->AddModelNonSearchable("View Time", "view_time", 100 ,"center");
//$grid->AddModelNonSearchable("Entry Time", "entry_time", 100 ,"center");
//$grid->AddModelNonSearchable("Status", "status", 100 ,"center");
$grid->AddModelNonSearchable("View", "action", 60 ,"center");
if(ACL::HasPermission("admin/notification/seen-all")){
    $grid->AddTitleRightHtml('<a  class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/notification/seen-all").'" ><i class="fa fa-eye"></i>'.__('Mark as seen all').'</a>');
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
function AfterInsertRow(rowid, rowData, rowelem) {
    if(rowData.main_status=="A"){
        $('tr#' + rowid).addClass('tr-bg-green');
    }
}
</script>
