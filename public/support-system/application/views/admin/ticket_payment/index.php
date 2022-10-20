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
if(ACL::HasPermission("admin/ticket-payment/add")){
	//$grid->AddTitleRightHtml('<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info" href="'.site_url("admin/ticket-payment/add").'" ><i class="fa fa-plus"></i>'.__('Add New').'</a>');
}
//Fields
//$grid->AddModel("Id", "id", 100 ,"center");
//$grid->AddModelNonSearchable("Ticket Id", "ticket_id", 80 ,"center");
$grid->AddModelNonSearchable("Payment Description", "payment_des", 180 ,"left");
//$grid->AddModelNonSearchable("Reply Id", "reply_id", 100 ,"center");
$grid->AddModelNonSearchable("Amount", "amount", 60 ,"center");
$grid->SetXSCombindeField("amount");
//$grid->AddModelNonSearchable("Payment Currency", "payment_currency", 100 ,"center");

//$grid->AddModelNonSearchable("Payment ID", "payment_id", 100 ,"center");
$grid->AddModelNonSearchable("Created By", "created_by", 80 ,"center");
//$grid->AddModelNonSearchable("Refund Msg", "refund_msg", 100 ,"center");
$grid->AddModelNonSearchable("Method", "payment_method", 60 ,"center");
$grid->AddSortableModel("Create Date", "create_date", 115 ,"center");
$grid->AddModelNonSearchable("Process Date", "process_date", 115 ,"center");
$status=[];
$grid->AddModelCustomSearchable("Status", "status", 80 ,"center","select",["*"=>"All","P"=>"Pending","A"=>"Paid","F"=>"Failed"]);
	    
//if(ACL::HasPermission("admin/ticket-payment/edit")){
	$grid->AddModelNonSearchable("Action", "action", 100 ,"center");
//}

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
