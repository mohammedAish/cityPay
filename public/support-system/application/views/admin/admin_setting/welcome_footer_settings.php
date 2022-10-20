<form id="app-color-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify/t");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Welcome & Footer Text");?></h3>    
                  <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>                      
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                
                  <div class="form-group">
                  
			       	<label class="control-label  label-required" for="welcome_msg"><?php _e("Welcome Message"); ?></label>
			       	                  			     	
			       		<textarea data-no-image="true" style="min-height: 150px;" class="form-control app-html-editor" id="welcome_msg" name="api[system][welcome_msg]" placeholder="<?php _e("Welcome Message"); ?>"><?php echo  $apiobject->GetPostValue("welcome_msg")?></textarea>
			       		<span class="form-group-help-block"><?php _e("Keep empty if you don't want to show any message");?></span>
			       
			       </div> 
			       
                
                
                		  
				  <div class="form-group">
				  	<label class="control-label  label-required" for="footer_text"><?php _e("Footer Text"); ?></label>
				  	<textarea  style="min-height: 130px;" class="form-control app-html-editor" id="footer_text" name="api[system][footer_text]" placeholder="<?php _e("Footer Text"); ?>" ><?php echo  $apiobject->GetPostValue("footer_text")?></textarea>
				  <span class="form-group-help-block"><?php _e("Keep empty if you don't want to show any footer");?></span>
				  </div> 
				  <div class="form-group">
				  	<label class="control-label  label-required" for="email_footer"><?php _e("Email Footer Text"); ?></label>
				  	<?php
				  	$footerEText='This email is a service from '.get_app_title().', delivered by <a href="https://goo.gl/qHkvTR" target="_blank">Appbd Support System</a> &copy; Appsbd'.date('Y');
				  	?>
				  	<textarea  style="min-height: 70px;" class="form-control app-html-editor" id="email_footer" name="api[system][email_footer]" placeholder="<?php _e("Email Footer Text"); ?>" ><?php echo  $apiobject->GetPostValue("email_footer",$footerEText)?></textarea>
				  <span class="form-group-help-block"><?php _e("Keep empty if you don't want to show any footer on email");?></span>
				  </div> 				
				   <div class="form-group">
				  	<label class="control-label  label-required" for="site_copyw"><?php _e("Site Copyright Text"); ?></label>
				  	<?php $defaultCData='&copy; Copyright <a href="http://www.appsbd.com">appsbd.com</a> '.date('Y');?>
				  	<textarea  style="min-height: 70px;" class="form-control app-html-editor" id="site_copyw" name="api[system][site_copyw]" placeholder="<?php _e("Copyright Text"); ?>" ><?php echo  $apiobject->GetPostValue("site_copyw",$defaultCData)?></textarea>
				  <span class="form-group-help-block"><?php _e("Keep empty if you don't want to show any footer on site copy write text");?></span>
				  </div>


                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_powered_by"><?php _e("Show Powered By Text"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input   name="config[is_powered_by]" value="N" type="hidden">
                                <label>
                                    <input class="has_depend_fld"  type="checkbox" <?php echo $mainobj->GetPostValue("is_powered_by","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_powered_by"  name="config[is_powered_by]" >
                                </label>
                                <span class="form-group-help-block  fld-config-is-powered-by fld-config-is-powered-by-n"><strong class="text-danger"><?php _e("We the developer team of best support system, worked very hard on this app. If it's spread by you, then we will get much motivation. If possible then, please keep this enable.");?></strong></span>
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
         </form>