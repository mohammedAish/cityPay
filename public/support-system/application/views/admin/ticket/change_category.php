<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Mticket();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    /*if($isUpdate){
    	$except[]="title,parent_category,status";
    	$disabled[]="title,parent_category,status";
    }*/
   ;
        
?>	     <div class="panel panel-default app-panel-box">
  <div class="panel-heading text-bold"><?php echo __("Title : ").$mainobj->title;?></div>
  <div class="panel-body">
        <?php 
       
        ?>
	      <div class="form-group">
		      	<label class="control-label label-required col-md-3" for="cat_id"><?php _e("Select Category"); ?></label>
		      	<div class="col-md-9 ">                   			     	
		      		<?php 		      		
		      		$options_category=Mcategory::getCategoryListHtmlOptionArray('A');
		      		?>
			        <select class="form-control" id="cat_id"  name="cat_id"       data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Category"));?>">
			        <?php $category_selected= $mainobj->GetPostValue("cat_id");
			        	GetHTMLOption("", "Select",$category_selected);
			            GetHTMLOptionByArray($options_category,$category_selected,["class"=>"fa"]);
			            ?>			        
			        </select>
		      	</div>
		  </div>
  </div>
</div>
            
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php  _e("Update");?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
