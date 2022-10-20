<?php
$grid=new jQGrid();
$grid->url =$grid_url;
$grid->width = "auto";
//$grid->minWidth=500;
$grid->height = 540;
$grid->rowNum = 200;
$grid->pager = "#pagerb";
$grid->container = ".grid-body";
$grid->ShowReloadButtonInTitle=true;
$grid->ShowDownloadButtonInTitle=false;
$grid->AddGroupColumn("controller_title",false);
//$grid->shrinkToFit=false;
$pagelist=Mpage_list::getUniqueControllerKeyValueArray(true,"A","A");
$rolelist=Mrole_list::FetchAll('','grade','ASC');

$grid->AddSearchProperty("Type", "controller_title",'select',$pagelist);
//$grid->AddHiddenProperty("controller_title");
$grid->AddModelNonSearchable("#", "id", 30 ,"left");
$grid->AddModelNonSearchable("Controller Title", "controller_title", 100 ,"left");
$grid->AddModelNonSearchable("Page Name", "title", 160 ,"left");
foreach ($rolelist as $role){
	$grid->AddModelNonSearchable($role->title, $role->role_id, 130 ,"center");
}
if(ACL::HasPermission("admin/app-permission/reset-access")){
    $grid->AddTitleRightHtml('<a id="a" data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-danger" href="'.admin_url("app-permission/reset-access").'" ><i class="fa fa-retweet"></i>Reset Role</a>');
}
if(ACL::HasPermission("admin/app-permission/copy-access")){
    $grid->AddTitleRightHtml('<a id="a" data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-warning" href="'.admin_url("app-permission/copy-access").'" ><i class="fa fa-retweet"></i>Copy Role Access</a>');
}
if(ACL::HasPermission("admin/app-permission/role-add")){
    $grid->AddTitleRightHtml('<a id="b" data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" data-onclose="new_role_created" href="'.admin_url("app-permission/role-add").'" ><i class="fa fa-plus"></i>Add New Role</a>');
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
function response_process(rdata,element){	
	if(typeof(swal)=="function"){
		swal(rdata.status?"Success":"Failed", rdata.msg, rdata.status?"success":"error");
	}else{
		ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky);
	}
	
	if(rdata.status){
		var span=element.find('i');		
		if(span.hasClass('fa-times')){
			span.removeClass('fa-times text-danger').addClass('fa-check text-success');
		}else if(span.hasClass('fa-check')){
			span.removeClass('fa-check text-success').addClass('fa-times text-danger');
		}
	}
}
function new_role_created(){
	if (MyAjaxChange) {
		ReloadSiteUrl();
	}	
}
</script>