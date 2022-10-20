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
if(ACL::HasPermission("admin/knowledge/add")){
	$grid->AddTitleRightHtml('<a class="btn btn-xs btn-info" href="'.site_url("admin/knowledge/add").'" ><i class="fa fa-plus"></i>Add New</a>');
}
$options_category=["0"=>"All Category"];
$mainobj=new Mknowledge();
$opts=Mcategory::getKnowledgeCategoryListHtmlOptionArray('A');
foreach ($opts as $key=>$vl){
    $options_category[$key]=$vl;
}
$status=array_merge(["*"=>"All"],$mainobj->GetPropertyOptions("status"));

//GPrint($options_category);
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddSortableModel("Title", "title", 150 ,"left");
$grid->SetXSCombindeField("title");
$grid->AddModelCustomSearchable("Category", "cat_id", 150 ,"left","select",$options_category);
//$grid->AddModelNonSearchable("Priroty", "priroty", 100 ,"center");
//$grid->AddModelNonSearchable("K Body", "k_body", 100 ,"center");
//$grid->AddModelNonSearchable("V Count", "v_count", 100 ,"center");
//$grid->AddModelNonSearchable("L Count", "l_count", 100 ,"center");
//$grid->AddModelNonSearchable("D Count", "d_count", 100 ,"center");
$grid->AddSortableModel("Sticky/Pinned", "is_stickey", 50 ,"center");

//$grid->AddModelNonSearchable("K Tag", "k_tag", 100 ,"center");
//$grid->AddModelNonSearchable("K Soundex", "k_soundex", 100 ,"center");
$grid->AddModelCustomSearchable("Status", "status", 50 ,"center","select",$status);
	    
if(ACL::HasPermission("admin/knowledge/edit")){
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
