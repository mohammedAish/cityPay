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

//Fields
//$grid->AddModel("Ticket Id", "ticket_id", 100 ,"center");
$grid->AddModelNonSearchable("Ticket Title", "title", 80 ,"left");
$grid->SetXSCombindeField("title");

$grid->AddModelNonSearchable("Ticket Status", "status",50 ,"center");
$grid->AddModelNonSearchable("Assigned", "assigned_on",50 ,"center");
$grid->AddModelNonSearchable("Opened", "opened_time",70 ,"center");
$grid->AddModelNonSearchable("Last Replied", "last_reply_time",70 ,"center");
//$grid->AddModelNonSearchable("Feedback Type", "f_type", 50 ,"center");
$grid->AddModelNonSearchable("Message", "f_msg", 120 ,"center");
//$grid->AddModelNonSearchable("Action", "action", 50 ,"center");

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
