<div class="row clearfix form-horizontal">
 <?php 
        if(empty($mainobj)){
	  	    $mainobj=new Mapp_user();
	  	    AddError("mainobj is not initilised");
        }
	  	$except=array();
	  	$disabled=array();
	  	if($isUpdate){
			$except[]='pass';
			$disabled[]='user';
		  if(!empty($isRoleDisable)){
		      $disabled[]='role';
		      $disabled[]='status';
		  }
		}
	  	$mainobj->GetAddForm(3,9,NULL,$except,$disabled);
	  ?>
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>