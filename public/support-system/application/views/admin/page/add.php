
<?php     
    if(empty($mainobj)){
        $mainobj=new Mcustom_page();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="slag_title,title,page-body,status";
    	$disabled[]="slag_title,title,page-body,status";
    }*/
?>
<div class="box box-primary">
	<?php /*?><div class="box-header" style="cursor: move;"></div><!-- /.box-header --><?php // */?>
    <div class="box-body grid-body">
        <div><?php echo GetMsg();?></div>
		<?php // array("class"=>"form","method"=>"post","enctype"=>"multipart/form-data", "data-multipart"=>"true")
			echo form_open ( current_url(),array("class"=>"form bv-form form-horizontal","method"=>"post","enctype"=>"multipart/form-data", "data-multipart"=>"true"));
			
			$mainobj->GetAddForm(2,10,NULL,$except,$disabled);
		
		?>
		
		<?php if(empty(!$isUpdate)){?>
            <div class="row">
                <div class="col-md-12 text-right">
                    <label><?php _e("Added on:") ; ?> <?php echo get_user_datetime_default_format($mainobj->added_on);?></label>
                </div>
               
            </div>
		<?php }?>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <a href="<?php echo admin_url("page/index");?>" class="btn btn-default"><i class="fa fa-angle-double-left"></i> <?php _e("Show List") ; ?></a>
				<?php if(empty(!$isUpdate)){?>
                    <a href="<?php echo admin_url("page/add");?>" class="btn btn-info"><i class="fa fa-plus-circle"></i> <?php _e("Add New") ; ?></a>
				
				<?php }?>
            </div>
            <div class="col-md-6 text-right">
				
				<?php if(empty($isUpdate)){?>
                    <button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Save</button>
				<?php }else{?>
                    <a href="<?php echo site_url("site/page/{$mainobj->id}/$mainobj->slag_title");?>" target="_blank" class="btn btn-info"><i class="fa fa-eye"></i> <?php _e("View Page") ; ?></a>
                    <button type="submit" class="btn btn-success "><i class="fa fa-save"></i> Update </button>
				<?php }?>
            </div>
        </div>
		
		<?php echo form_close();?>
    </div>
    <!-- /.box-body -->
	<?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?>
</div>