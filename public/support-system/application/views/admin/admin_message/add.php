<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Madmin_message();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="subject,body,to_user,from_user,last_replied,status";
    	$disabled[]="subject,body,to_user,from_user,last_replied,status";
    }*/
    $mainobj->GetAddForm(2,10,NULL,$except,$disabled);
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
