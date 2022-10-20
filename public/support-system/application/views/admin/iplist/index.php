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
if(ACL::HasPermission("admin/iplist/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/iplist/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
$grid->AddModel("IP", "ip", 100 ,"center");
$grid->AddModel("Country", "country_code", 50 ,"center");
$grid->AddModelNonSearchable("Added On", "added_on", 100 ,"center");
$grid->SetXSCombindeField("added_on");
//$grid->AddModelNonSearchable("Start Count Time", "start_count_time", 100 ,"center");
//$grid->AddModelNonSearchable("Req Counter", "req_counter", 100 ,"center");

$mg=new Miplist();
$ent=array_merge(["*"=>"All"],$mg->GetPropertyOptions("entry_type"));
$statuslst=array_merge(["*"=>"All"],$mg->GetPropertyOptions("status"));
$grid->AddSortableModel("Entry Type", "entry_type", 100 ,"center","","","",true,"select",$ent);
$grid->AddSortableModel("Status", "status", 100 ,"center","","","",true,"select",$statuslst);
	    
if(ACL::HasPermission("admin/iplist/edit")){
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
