<div class="clearfix form-horizontal">
<?php echo GetMsg(); 
$paramlist=Mcanned_msg::getParamList();?>

          <?php /*   <div class="col-md-6">

                     <div class="form-group form-group-sm">
                         <label class="control-label" for="k_word"><?php _e("Keyword"); ?></label>
                         <div class="">
                             <select name="k_word" id="k_word" class="form-control" data-bv-notempty="true" data-bv-notempty-message="Keyword is required">
                                 <?php
                                     $keywords = array(""=>"---Select---") + Memail_templates::get_email_keywords();
                                     GetHTMLOptionByArray($keywords,$mainobj->GetPostValue("k_word"));
                                 ?>
                             </select>
                         </div>
                     </div>
             </div>  */ ?>

               <div class="row">
                 
                     <div class="<?php echo count($paramlist)>0?"col-xs-8":"col-xs-12";?> ">
                        <div class="row">
                        	<div class="col-sm-8">                	
                    			 
                                 
                                  <div class="form-group form-group-sm">
                    		      	<label class="control-label col-md-2" style="text-align: left !important;" for="title"><?php _e("Title"); ?></label>
                    		      	<div class="col-md-10">                   			     	
                    		      		<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" name="title"     data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
                    			     		<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/?>
                    		      	</div>
                    		      </div> 
                                                 	
                        	</div>
                        	<div class="col-sm-4">
                        	
                        	 <div class="form-group form-group-sm">
                        		      	<label class="control-label col-md-3" for="status"><?php _e("Status"); ?></label>
                        		      	<div class="col-md-9"> 
                        			     <div class="togglebutton ">
                        				    <input  name="status" value="I" type="hidden">
                        					<label> 
                        					<input  type="checkbox" <?php echo $mainobj->GetPostValue("status","A") == "A" ? "checked" : ""?>  value="A" class="" id="status"  name="status"  >
                        						 
                        					</label>
                        					<?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>		
                        				</div>			         
                        			         
                        		      	</div>
                        		      </div>                         	 
                        	</div>
                        </div>
                        </div>
                   
                </div>
             
            <div class="<?php echo count($paramlist)>0?"col-xs-8":"col-xs-12";?>">			
			 <div class="form-group form-group-sm">
		      	<label class="control-label >" for="canned_msg"><?php _e("Message"); ?></label>
		        <textarea style="min-height: 168px;"  class="form-control app-html-editor" id="canned_msg"  name="app_des_html"    data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Canned Msg"));?>"><?php echo PostValue("app_des_html",$mainobj->canned_msg);?></textarea>
		      	
		      </div> 
		    
		
			
			
		     
		     
                 
                 

                 
               
             </div>
             <?php if(count($paramlist)>0){?>
             <div class="col-xs-4 md-p-r-0  md-p-t-25">
             
                <div class="panel panel-primary" style="overflow: hidden;">
                <div class="panel-heading text-bold"><?php _e("Canned Message Fields") ; ?></div>
                	<div class="panel-body p-0">
                	       <table class="table m-b-0 table-striped">
                 	<thead>
                 		<tr class="bg-info">
                 		    <th style="width: 20px;"></th>
                 			<th style="width: 120px;"><?php _e("Property") ; ?></th>
                 			<th><?php _e("Description") ; ?></th>
                 		</tr>
                 	</thead>
                 	<tbody>
                 	  <?php foreach ($paramlist as $key=>$des){?>
                 		<tr>
                 		    <th ><i title="Click to insert {{<?php echo $key;?>}} to edittor" style="font-size: 16px;" class="tooltip2 ap ap-insert app-ins-btn text-green text-bold" data-tooltip-position="left" data-tooltip-delay="2000" data-clipboard-text="{{<?php echo $key;?>}}"></i>  </th>
                 			<th>{{<?php echo $key;?>}} </th>
                 			<td><?php _e($des);?></td>
                 		</tr>
                 		<?php }?>                 		
                 	</tbody>
                 </table>
                	</div>
                </div>
             </div>
             <?php }?>
      

<script type="text/javascript">
$(function(){
	$(".app-ins-btn").on("click",function(e){
		e.preventDefault();
		var text=$(this).data("clipboard-text");
		if(text){
			insert_edittor_text("canned_msg",text);
		}
		
	});
})
</script>

</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
