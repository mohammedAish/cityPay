<?php
$fbmainobj=new Mapp_settings_api_advance();
$fbmainobj->SetAPIName("fbchat");
?>
<form id="app-fbc-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify_analytics/e");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
	        
	        
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="ap ap-fb-messenger a-c" style="font-size: 21px;vertical-align: -4px;"></i> <?php _e("Facebook Chat Settings");?></h3>
                 <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                
                <div class="row">
        	      	<div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4 label-required" for="is_active"><?php _e("Enable"); ?></label>
                            <div class="col-md-8">
                                <div class="togglebutton ">
                                    <input  name="config[is_active]" value="N" type="hidden">
                                    <label>
                                        <input   type="checkbox" <?php echo $fbmainobj->GetPostValue("is_active","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_active"  name="config[is_active]" >
                                    </label>
                                    <span class="form-group-help-block"><?php _e("To enable facebook messenger chat");?></span>
                                </div>

                            </div>
                        </div>
                        <div class="form-group  fld-config-is-active fld-config-is-active-y">
                            <label class="control-label col-md-4 label-required" for="page_id"><?php _e("Facebook Page ID"); ?></label>
                            <div class="col-md-8">
                                <input type="text" maxlength="255"  value="<?php echo  $fbmainobj->GetPostValue("page_id")?>" class="form-control" id="page_id" name="config[page_id]" placeholder="<?php _e("Facebook Page ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Facebook Page ID"));?>">
                            </div>
                        </div>
        	      	
        	      	</div>
        	      	<div class="col-md-6 md-p-l-0">
                        <label for=""><?php _e("Your Domain URL") ; ?></label>
                        <div class="text-bold"><?php echo base_url() ; ?></div>
                        <div class="help-block text-italic"><?php _e("Please put this into your facebook page settings") ; ?></div>
                        <div class="help-block text-italic">Goto your facebook page &n Settings</div>
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