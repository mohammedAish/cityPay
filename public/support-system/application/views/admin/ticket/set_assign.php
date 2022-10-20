<div class="clearfix form-horizontal">
<div class="src-panel form form-inline text-center">
    <div class="form-group">
        <label for="src"><?php _e("Search"); ?></label>
        <input type="text" class="form-control" id="src" placeholder="<?php _e("Search"); ?>">
     </div>
</div>
<div class="row">
<div class="box box-primary m-b-10">	
     <div class="box-body">     
        <div class="user-list row">
        <?php     
        $rolelist=Mrole_list::FetchAllKeyValue("role_id", "title");
           foreach ($staff_list as $staff){
               if(empty($staff)){
                   $staff=new Mapp_user();//temporary
               }      
               //GetHTMLRadioByArray($title, $name, $id, $isRequired, $options, $checkedValue)
               ?>
               <div class="col-md-4 staff-data">
               	<div class="panel panel-default">
               		<div class="panel-body p-b-0">
               		<div class="form-group m-b-5">
                    
                    <label for="st_<?php echo $staff->id?>" class="staff-label col-xs-8 col-md-10" style="text-align: left;">
                         <?php 
                            
                            $title=$staff->title."<br/><em><small>".getTextByKey($staff->role,$rolelist)."</small></em>";
               		       echo get_grid_user_img($title,$staff->img_url,$staff->id,"A",true);
               		   ?>
               		 
                     </label>
                       <div class="pull-right" style="margin-top: -5px;margin-bottom: -10px;">
                            <div class="radio">
                            <label class="" >
                                <input class="" id="st_<?php echo $staff->id?>" type="radio" name="assign" <?php echo $mainobj->assigned_on==$staff->id?' checked="checked" ':"";?> value="<?php echo $staff->id;?>" data-bv-notempty="true" data-bv-notempty-message="<?php _e("Choose Staff") ; ?>" /> 
                                
                               
                            </label>                
                            </div>
                    </div>
                     </div>       		   
               		</div>
               	</div>
               </div>      
               <?php 
               
           }
        ?>	  
        </div>
</div><!-- /.box-body -->  
</div>
</div>
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
<script type="text/javascript">	
	$(function(){		
		$('input#src').quicksearch('.staff-data', {
			selector: '.staff-label',
			minValLength:1
		});
		$('input#src').focus();
	});
</script>
