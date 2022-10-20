<div class="clearfix">
<?php if(!empty($fld_title) && !empty($field_value) ){?>
<h4><?php echo "{$fld_title} : {$field_value}"; ?></h4>
<hr class="m-5" />
<?php }?>
<?php echo $data_str; ?>

</div>
<div class="row btn-group-md popup-footer text-right">	
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Close");?></button>
</div>
