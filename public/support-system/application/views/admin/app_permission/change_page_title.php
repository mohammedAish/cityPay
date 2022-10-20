<div class="clearfix form-horizontal">
 <?php 
	  	//$mainobj=new Mmessages();
	  	$except=array();
	  	$disabled=array();
	  	if($isUpdate){
			$except[]='res_id';
			$disabled[]='controller';
			$disabled[]='method';
		}
	  	$mainobj->GetAddForm(3,9,NULL,$except,$disabled);
	  ?> 
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Close");?></button>

</div>
