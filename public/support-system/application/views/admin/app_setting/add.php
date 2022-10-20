<div class="clearfix form-horizontal">
<?php 
    //$mainobj=new Mapp_setting();
    $except=array();
    $disabled=array();
    if($isUpdate){    	
    	$mainobj->GetAddForm2(3,9,NULL,$except,$disabled);
    }else{
        $mainobj->GetAddForm(3,9,NULL,$except,$disabled);
    }
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
