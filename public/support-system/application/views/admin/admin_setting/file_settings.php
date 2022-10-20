<form method="post" action="<?php echo admin_url("admin-setting-confirm/modify/f");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("File Upload Settings");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="form-group">
               			<label class="control-label col-md-4 label-required" for="max_file_upload_size"><?php _e("Max Upload File Size"); ?></label>
               			<div class="col-md-8">                   			     	
               				<div class="input-group" style="max-width: 120px;">                			
                			<input type="text" data-bv-integer="true" data-bv-integer-message="<?php _e("The value is not a numeric");?>"  data-bv-between="true" data-bv-between-min="1" data-bv-between-max="99"
                				data-bv-between-message="<?php _e("Value must be between 1 to 99");?>" maxlength="2"  value="<?php echo  $mainobj->GetPostValue("max_file_upload_size")?>" class="form-control" id="max_file_upload_size" name="config[max_file_upload_size]" placeholder="<?php _e("ex. 2"); ?>" data-bv-notempty="true"  data-bv-notempty-message="<?php  _e("%s is required",__("Field"));?>">
                			<span class="input-group-addon" id="basic-addon1">
                				MB
                			</span>
                			</div>
               			</div>
               		</div>
               		<div class="form-group">
               			<label class="control-label col-md-4 label-required" for="allowed_file_type"><?php _e("Allowed File Types"); ?></label>
               			<div class="col-md-8">                   			     	
               				<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("allowed_file_type")?>" class="form-control" id="allowed_file_type" name="config[allowed_file_type]" placeholder="<?php _e("Allowed File Types"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Allowed File Types"));?>">
               			</div>
               		</div> 
               		<hr class="m-t-0 m-b-10" />
               		<div class="form-group">	                	
               				<label class="control-label col-md-4 label-required" for="allow_profile_upload"><?php _e("Client Photo Upload"); ?></label>
               				<div class="col-md-8">
               					<div class="togglebutton ">
               						<input  name="config[allow_profile_upload]" value="N" type="hidden">
               						<label> 
               							<input  type="checkbox" <?php echo $mainobj->GetPostValue("allow_profile_upload","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="allow_profile_upload"  name="config[allow_profile_upload]" > 
               						</label>
               						<span class="form-group-help-block"><?php _e("If you enable it, then you can able to upload their profile photo");?></span>
               					</div>
               					
               			</div>				      	
               		</div>
               		<div class="form-group">	                	
               				<label class="control-label col-md-4 label-required" for="allow_ticket_file_upload"><?php _e("Ticket File Upload"); ?></label>
               				<div class="col-md-8">
               					<div class="togglebutton ">
               						<input  name="config[allow_ticket_file_upload]" value="N" type="hidden">
               						<label> 
               							<input  type="checkbox" <?php echo $mainobj->GetPostValue("allow_ticket_file_upload","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="allow_ticket_file_upload"  name="config[allow_ticket_file_upload]" > 
               						</label>
               						<span class="form-group-help-block"><?php _e("If you enable it then user can upload file when they open ticket and reply any ticket");?></span>
               					</div>
               					
               			</div>				      	
               		</div>
               		
               		
               		  
               		 
               		
                	  
                	  
                	 
                	 
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <button id="captcha-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                </div>
                <!-- /.footer -->
         </div>
         <!-- /.box -->
         </form>