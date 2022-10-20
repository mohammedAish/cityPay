<form method="post" action="<?php echo admin_url("admin-setting-confirm/modify/c");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Captcha Settings");?></h3>    
                   <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>                      
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="form-group m-b-0">
				      	<label class="control-label label-required col-md-4" for="status"><?php _e("Captcha Type"); ?></label>
				      	<div class="col-md-8">                   			     	
				      		<div class="inline radio-inline">
					        <?php 
					            $app_captcha_selected= $mainobj->GetPostValue("app_captcha","D");					           
					            $app_captcha_op=array("D"=>"Default","G"=>"Google Re-captcha");			          
					            GetHTMLRadioByArray("Captcha Type","config[app_captcha]","app_captcha",true,$app_captcha_op,$app_captcha_selected,false,false,"app-captcha-input");
					            ?>
					        
					       </div> 
				      	</div>
				  </div> 
				  <hr class="m-t-0 m-b-10" />
				  <div class="form-group action-fld d-action">
				  	<label class="control-label label-required col-md-4" for="ap_dc_length"><?php _e("Captcha Length"); ?></label>
				  	<div class="col-md-8">                   			     	
				  		
				  		<select   class="form-control" id="ap_dc_length" name="config[ap_dc_length]"  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Captcha Length"));?>">
                				<?php
                					$vaap_dc_length= $mainobj->GetPostValue("ap_dc_length");
                					foreach (range(2, 9) as $i){
										GetHTMLOption($i, $i,$vaap_dc_length);
                					}
                				?>
                			</select>
				  		
				  		<span class="form-group-help-block"><?php _e("Charecter Lenght of default captcha");?></span>
				  	</div>
				  </div>
				  <div class="form-group action-fld d-action">
				  	<label class="control-label  label-required col-md-4" for="ap_dc_str_type"><?php _e("Captcha String Type"); ?></label>
				  	<div class="col-md-8 ">                   			     	
				  		<div class="inline radio-inline">
				  			<?php
				  				$vap_dc_str_type = $mainobj->GetPostValue("ap_dc_str_type","AN");
				  				$vap_dc_str_type_opt=array("AN"=>"Alpha Numeric","NU"=>"Numeric");
				  				GetHTMLRadioByArray("Captcha String Type","config[ap_dc_str_type]","ap_dc_str_type",true,$vap_dc_str_type_opt,$vap_dc_str_type,false,false,"ap_dc_str_type");
				  			?>
				  		 </div> 
				  	</div>
				  </div> 
				  
				   
				  
				  
                	<div class="form-group action-fld g-action">
                		<label class="control-label label-required col-md-4" for="app_gc_secret">Re-captcha Secret key</label>
                		<div class="col-md-8">                   			     	
                			<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("app_gc_secret")?>" class="form-control" id="app_gc_secret" name="config[app_gc_secret]" placeholder="<?php _e("Secret key");?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret key<?php  _e(" is required");?>">
                		</div>
                	</div> 
                	
                	<div class="form-group action-fld g-action">
                		<label class="control-label label-required col-md-4" for="app_gc_site_key">Re-captcha  Site Key</label>
                		<div class="col-md-8">                   			     	
                			<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("app_gc_site_key")?>" class="form-control" id="app_gc_site_key" name="config[app_gc_site_key]" placeholder="<?php _e("Site Key");?>" data-bv-notempty="true" 	data-bv-notempty-message="Site Key <?php  _e(" is required");?>">
                		</div>
                	</div> 
                	<hr class="m-t-0 m-b-10" />
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="is_cptcha_client_login"><?php _e("On Client Login"); ?></label>
                			<div class="col-md-8">
                				<div class="togglebutton ">
                					<input  name="config[is_cptcha_client_login]" value="N" type="hidden">
                					<label> 
                						<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_cptcha_client_login","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_cptcha_client_login"  name="config[is_cptcha_client_login]" > 
                					</label>
                					<span class="form-group-help-block"><?php _e("If you enable it then captcha will show in client login form");?></span>
                				</div>
                				
                		</div>				      	
                	</div> 
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="is_cptcha_guest_ticket"><?php _e("On Guest Ticket"); ?></label>
                			<div class="col-md-8">
                				<div class="togglebutton ">
                					<input  name="config[is_cptcha_guest_ticket]" value="N" type="hidden">
                					<label> 
                						<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_cptcha_guest_ticket","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_cptcha_guest_ticket"  name="config[is_cptcha_guest_ticket]" > 
                					</label>
                					<span class="form-group-help-block"><?php _e("If you enable it then captcha will show in guest ticket opening form");?></span>
                				</div>
                				
                		</div>				      	
                	</div>
                	 
                	  
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="is_cptcha_client_regi"><?php _e("On Client Registration"); ?></label>
                			<div class="col-md-8">
                				<div class="togglebutton ">
                					<input  name="config[is_cptcha_client_regi]" value="N" type="hidden">
                					<label> 
                						<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_cptcha_client_regi","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_cptcha_client_regi"  name="config[is_cptcha_client_regi]" > 
                					</label>
                					<span class="form-group-help-block"><?php _e("If you enable it then captcha will show in client registration form");?></span>
                				</div>
                				
                		</div>				      	
                	</div>
                	 <div class="form-group">	                	
                	 		<label class="control-label col-md-4 label-required" for="is_cptcha_admin_login"><?php _e("On Admin Login"); ?></label>
                	 		<div class="col-md-8">
                	 			<div class="togglebutton ">
                	 				<input  name="config[is_cptcha_admin_login]" value="N" type="hidden">
                	 				<label> 
                	 					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_cptcha_admin_login","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_cptcha_admin_login"  name="config[is_cptcha_admin_login]" > 
                	 				</label>
                	 				<span class="form-group-help-block"><?php _e("If you enable it then captcha will show in admin login form");?></span>
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