<?php 
$cookie_post_fix=get8BitHashCode($grid_url);
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
$grid->loadComplete="data_on_complete";
//$grid->shrinkToFit=false;
$cookie_name=Mapp_setting::get_cookie_prefix()."_".$cookie_post_fix;
$is_checked=false;
if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name]=="Y"){
    $is_checked=true;
}
$grid->AddTitleRightHtml('<div class="form-group form-group-sm"><label class="control-label" for="is_auto_refresh">'.__('Enable Auto Reload (every %d min) ',1).'</label><div class="togglebutton "><label><input '.($is_checked?' checked="checked"':"").'  type="checkbox"  value="Y" class="" id="is_auto_refresh"  name="is_auto_refresh" ></label></div></div>');
/*if(ACL::HasPermission("admin/ticket/add")){
	$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/ticket/add").'" ><i class="fa fa-plus"></i>Add New</a>');
}*/
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
$grid->AddSearchProperty("Track ID", "ticket_track_id");
	
	//$grid->AddSearchProperty("Priority", "priroty");
$grid->AddModel("Title", "title", 260 ,"left");
$grid->SetXSCombindeField("title");
//$grid->AddModelNonSearchable("Category", "cat_id", 100 ,"left","",true);
//$grid->AddModelNonSearchable("Priority", "priroty", 50 ,"center");
//$grid->AddModelNonSearchable("Ticket Body", "ticket_body", 100 ,"center");
$grid->AddModelNonSearchable("Open Time", "opened_time", 60 ,"center","",true);
//$grid->AddModelNonSearchable("Ticket User", "ticket_user", 130 ,"left");
//$grid->AddModelNonSearchable("Re Open Time", "re_open_time", 100 ,"center");
//$grid->AddModelNonSearchable("Re Open By", "re_open_by", 100 ,"center");
//$grid->AddModelNonSearchable("Re Open By Type", "re_open_by_type", 100 ,"center");
//$grid->AddModelNonSearchable("User Type", "user_type", 100 ,"center");

$grid->AddModelNonSearchable("Assigned", "assigned_on", 100 ,"left");
$grid->AddModelNonSearchable("Last Reply", "last_replied_by", 100 ,"left");
$grid->AddModelNonSearchable("L.Reply Time", "last_reply_time", 60 ,"center","",true);
//$grid->AddModelNonSearchable("Status", "status", 70 ,"left","",true);
//$grid->AddModelNonSearchable("Ticket Rating", "ticket_rating", 100 ,"center");
	$grid->isColumnChoseable=true;
$customes=Mcustom_field::getGridColumn();
get_grid_custom_column($grid,$customes);
	    
if(ACL::HasPermission("admin/ticket/details")){
	$grid->AddModelNonSearchable("Action", "action", 80 ,"center");
}

$categories=array_merge(["*"=>"All Category"],Mcategory::getCategoryListHtmlOptionArrayOnlyTicket('A'));
$ticket=new Mticket();
$prTicket=array_merge(["*"=>"All Priorities"],$ticket->GetPropertyOptions("priroty"));

$grid->AddSearchProperty("Category", "cat_id","select",$categories);
$grid->AddSearchProperty("Priority", "priroty","select",$prTicket);
?>
<style>
.gs-jq-grid .ui-jqgrid .loading {
  top: 20% !important;
}
</style>
<div class="box box-primary">
	<?php /*?><div class="box-header" style="cursor: move;"></div><!-- /.box-header --><?php // */?>     
     <div class="box-body grid-body">
     <?php $grid->show();?>
     </div><!-- /.box-body -->
    <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?> 
</div>
<script type="text/javascript">
var reload_interval=null;
function data_on_complete(rdata){
	setToolTipNalert();
	$("[aria-describedby$=cat_id]").removeAttr("title");
}
function Reload_setting(){
	var isChecked=$("#is_auto_refresh").is(":checked");
	if(isChecked){
		//gcl("checked");
		setCookie(appGlobalLang.base_cookie_name+"_<?php echo $cookie_post_fix;?>", "Y", 15,"/");    
    	if(!reload_interval){
        	//gcl("starting");
    		reload_interval=setInterval(
    	    function(){
        	//gcl("Called");
    	   
    		<?php echo $grid->ReloadMethod();?>();
    		},60000);
    	}
	}else{
		try{
			//gcl("unchecked");
			deleteCookie(appGlobalLang.base_cookie_name+"_<?php echo $cookie_post_fix;?>");  
			clearInterval(reload_interval);
			reload_interval=null;
			
		}catch(e){}
	}
}
/*window.onbeforeunload = function(e) {
    return 'Are you sure you want to leave this page?  You will lose any unsaved data.';
 };*/
$(function(){
	AddOnPageCloseMethod(function(e){
		console.log("Called");
		//return "Test";
	});
	AddOnCloseMethod(<?php echo $grid->ReloadMethod();?>);
	AddOnShowNotificationMethod(<?php echo $grid->ReloadMethod();?>);
	Reload_setting();
	$("#is_auto_refresh").on("change",function(){
		Reload_setting();
			  
	});
	
});
   
</script>
