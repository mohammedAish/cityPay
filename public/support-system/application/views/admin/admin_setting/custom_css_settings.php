<form id="app-csjs-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify/j");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
	        
	        
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Custom CSS & JavaScript");?></h3>    
                 <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>                      
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                
                <div class="row">
        	      	<div class="col-md-6"> 
        	      	<div class="form-group">
                  
			       	<label class="control-label  label-required" for="welcome_msg"><?php _e("CSS ( Style)"); ?></label>
			       	                  			     	
			       		<textarea data-no-image="true" style="min-height: 350px;"  data-bv-stringlength-message=" <?php _e("Text must be less then %d characters length",256); ; ?> " class="form-control" id="welcome_msg" name="custom[css]" placeholder="<?php _e("Welcome Message"); ?>"><?php echo  $mainobj->GetPostValue("app_custom_css")?></textarea>
			       		
			            <span class="form-group-help-block"><?php _e("Only enter css code. Do not add any tag like %s ","<b>(&lt;style&gt;,&lt;script&gt; etc)</b>");?></span>
			       </div>
        	      	
        	      	</div>
        	      	<div class="col-md-6 md-p-l-0"> 
        	      	  <div class="form-group">
				  	<label class="control-label  label-required" for="footer_text"><?php _e("JavaScript"); ?></label>				  	                 			     	
				  	<textarea data-no-image="true" style="min-height: 350px;" data-bv-stringlength-message=" <?php _e("Text must be less then %d characters length",256); ; ?> " style="min-height: 100px;" class="form-control" id="footer_text" name="custom[js]" placeholder="<?php _e("Custom JavaScript"); ?>" ><?php echo  $mainobj->GetPostValue("app_custom_js")?></textarea>				  
				    <span class="form-group-help-block"><?php _e("Ex. Google analytics code, Do not add any tag  like %s","<b>( &lt;script&gt; )</b>");?></span>
				  </div> 
				  
        	      	</div>
    	      </div>
                   
			       
                
                
                		  
				
				  
                	   
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                </div>
                <!-- /.footer -->
         	</div>
         <!-- /.box -->
         </form> <!-- CSS & JS -->