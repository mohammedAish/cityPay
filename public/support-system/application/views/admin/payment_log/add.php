<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Mpayment_log();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="payment_idticket_payment_idamount_cramount_drfirst_2_digitlast_4_digittransaction_idprocess_timetransaction_timeupdate_timeresultresult_msgnoteresponse_reasonstatustransation_typepaid_bypp_payer_emailname_on_cardcountryapproval_coderef_transaction_id";
    	$disabled[]="payment_idticket_payment_idamount_cramount_drfirst_2_digitlast_4_digittransaction_idprocess_timetransaction_timeupdate_timeresultresult_msgnoteresponse_reasonstatustransation_typepaid_bypp_payer_emailname_on_cardcountryapproval_coderef_transaction_id";
    }*/
    $mainobj->GetAddForm(3,9,NULL,$except,$disabled);
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
