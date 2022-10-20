<?php
$obj=new Mrole_list(); 
$obj->grade(">0",true);
$roleList=$obj->SelectAllWithKeyValue("role_id", "title");
?>
<div class="clearfix form-horizontal"> 
<div class="form-group">
	<label class="control-label  label-required col-md-4" for="to_role"><?php _e("Select Reset Role"); ?></label>
	<div class="col-md-8 selectbox">                   			     	
		<select   class="form-control" id="to_role" name="to_role"  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("To Role"));?>">
			<?php
				$vto_role= PostValue("to_role");
				GetHTMLOptionByArray($roleList,$vto_role);
			?>
		</select>
	</div>
</div> 


	  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo __("Process Reset");?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
