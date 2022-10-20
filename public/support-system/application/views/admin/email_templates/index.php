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
$grid->AddGroupColumn("grp",false);
//$grid->shrinkToFit=false;
/*if(ACL::HasPermission("admin/email-templates/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/email-templates/add").'" ><i class="fa fa-plus"></i>Add New</a>');
}*/
//Fields
//$grid->AddModel("K Word", "k_word", 100 ,"center");
$grid->AddHiddenProperty("grp");
$grid->AddModelNonSearchable("Title", "title", 150 ,"left");
$grid->SetXSCombindeField("title");
$grid->AddModelNonSearchable("Subject", "subject", 250 ,"left");
//$grid->AddModelNonSearchable("Content", "content", 100 ,"left");
$grid->AddModelNonSearchable("Status", "status", 80 ,"center");
if(ACL::HasPermission("admin/email-templates/edit")){
	$grid->AddModelNonSearchable("Action", "action", 50 ,"center");
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
