<?php     
    if(empty($mainobj)){
        $mainobj=new Mknowledge();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="title,k_body,v_count,l_count,d_count,is_stickey,added_by,k_tag,k_soundex,status";
    	$disabled[]="title,k_body,v_count,l_count,d_count,is_stickey,added_by,k_tag,k_soundex,status";
    }*/
    
?>
<div class="box box-primary">
	<?php /*?><div class="box-header" style="cursor: move;"></div><!-- /.box-header --><?php // */?>     
     <div class="box-body grid-body">
     <div><?php echo GetMsg();?></div>
     <?php // array("class"=>"form","method"=>"post","enctype"=>"multipart/form-data", "data-multipart"=>"true")
		echo form_open ( current_url(),array("class"=>"form bv-form","method"=>"post","enctype"=>"multipart/form-data", "data-multipart"=>"true"));

		 $mainobj->GetAddForm(2,10,NULL,$except,$disabled);

		?>

         <?php if(empty(!$isUpdate)){?>
   		<div class="row">
	   		<div class="col-md-6">
	   			<label>Added on: <?php echo get_user_time_default_format($mainobj->entry_time);?></label>
	   		</div>
	  </div>
	  <?php }?>
   		<div class="row">
	   		<div class="col-md-6">
	   		<a href="<?php echo admin_url("knowledge/index");?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i> <?php _e("Show List") ; ?></a>
	   		<?php if(empty(!$isUpdate)){?>
	   		<a href="<?php echo admin_url("knowledge/add");?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> <?php _e("Add New") ; ?></a> 	 
	   		   		
	   		<?php }?>
	   		</div>
   			<div class="col-md-6 text-right">
   				
   				<?php if(empty($isUpdate)){?>
   				<button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Save</button>
   				<?php }else{
				    if(empty($mainobj->slug_id)){
					    app_check_slag($mainobj->slug_id,$mainobj->title);
                    }
   				    ?>
   				<a href="<?php echo site_url("knowledge/details/{$mainobj->id}/{$mainobj->slug_id}");?>" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> <?php _e("View Knowledge") ; ?></a>
   				<button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Update </button>
   				<?php }?>
   			</div>
   		</div>
		
    <?php echo form_close();?>
     </div>
	<!-- /.box-body -->
    <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?> 
</div>
