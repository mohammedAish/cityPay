<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Mticket();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="cat_title,ticket_body,ticket_user,opened_time,re_open_time,re_open_by,re_open_by_type,user_type,status,assigned_on,closed_by,ticket_rating,priroty";
    	$disabled[]="cat_title,ticket_body,ticket_user,opened_time,re_open_time,re_open_by,re_open_by_type,user_type,status,assigned_on,closed_by,ticket_rating,priroty";
    }*/
    $mainobj->GetAddForm(3,9,NULL,$except,$disabled);
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
