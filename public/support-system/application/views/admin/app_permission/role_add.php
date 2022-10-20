<div class="clearfix form-horizontal">
<?php 
    //$mainobj=new Mrole_list();
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="pv_id,title,grade";
    	$disabled[]="pv_id,title,grade";
    }*/
    $adminUser=GetAdminData();
    if($adminUser){
        $except[]="grade";
    }
    $mainobj->GetAddForm(3,9,NULL,$except,$disabled);
?>	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
