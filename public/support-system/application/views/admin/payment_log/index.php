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
$grid->AddModelNonSearchable("Payment Id", "payment_id", 100 ,"center");
$grid->SetXSCombindeField("payment_id");
$grid->AddModelNonSearchable("Name", "name_on_card", 100 ,"center");
$grid->AddModelNonSearchable("Ticket ID", "ticket_payment_id", 100 ,"center");
$grid->AddModelNonSearchable("Amount", "amount_cr", 100 ,"center");
//$grid->AddModelNonSearchable("Amount Dr", "amount_dr", 100 ,"center");
//$grid->AddModelNonSearchable("First 2 Digit", "first_2_digit", 100 ,"center");
//$grid->AddModelNonSearchable("Last 4 Digit", "last_4_digit", 100 ,"center");
$grid->AddModelNonSearchable("Transaction Id", "transaction_id", 100 ,"center");
$grid->AddModelNonSearchable("Process Time", "process_time", 100 ,"center");
//$grid->AddModelNonSearchable("Transaction Time", "transaction_time", 100 ,"center");
//$grid->AddModelNonSearchable("Update Time", "update_time", 100 ,"center");
//$grid->AddModelNonSearchable("Result", "result", 100 ,"center");
$grid->AddModelNonSearchable("Status", "result_msg", 100 ,"center");
$grid->AddModelNonSearchable("Note", "note", 100 ,"center");
$grid->AddModelNonSearchable("Response Reason", "response_reason", 100 ,"center");
$grid->AddModelNonSearchable("Status", "status", 100 ,"center");
$grid->AddModelNonSearchable("Transation Type", "transation_type", 100 ,"center");
$grid->AddModelNonSearchable("Paid By", "paid_by", 100 ,"center");
$grid->AddModelNonSearchable("Pp Payer Email", "pp_payer_email", 100 ,"center");

$grid->AddModelNonSearchable("Country", "country", 100 ,"center");
$grid->AddModelNonSearchable("Approval Code", "approval_code", 100 ,"center");
//$grid->AddModelNonSearchable("Ref Transaction Id", "ref_transaction_id", 100 ,"center");
	    
/*if(ACL::HasPermission("admin/payment-log/edit")){
	$grid->AddModelNonSearchable("Action", "action", 100 ,"center");
}*/

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
