<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Mdebug_log();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="entry_type,log_type,title,log_data,status,entry_time";
    	$disabled[]="entry_type,log_type,title,log_data,status,entry_time";
    }*/
    $mainobj->GetAddForm(3,9,NULL,$except,$disabled);
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
