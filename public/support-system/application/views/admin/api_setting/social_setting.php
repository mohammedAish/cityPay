<style>
 textarea.form-control-2{
 	min-height: 80px !important;
 }
 .save-noti{
 	position:fixed; 	
 	bottom:-20px;
 	min-width:500px;
 	margin: 0 auto;
 	z-index:50000;
 	display: none;
 	left:0;
 	right: 0; 
 	text-align: center;	
 	
 }
 .save-noti .alert{ 
 -webkit-border-radius: 0;
 -moz-border-radius: 0;
 border-radius: 0;
 }
</style>

<div id="stgs-main-container" class="row">
	<div class="col-md-12">		
	     <?php  echo form_open ( admin_url("api-setting-confirm/update-social"),array("class"=>"form app-ajax-form ","id"=>"app_basic_form","method"=>"post","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?> 
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Social Settings");?> </h3>    <button type="submit" class="btn btn-sm btn-success pull-right " style="margin-right: 50px;"><i class="fa fa-save"></i> <?php _e("Save") ; ?></button>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading p-b-5">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <i class="fa ap ap-envato c-envato"></i> Envato Login
                                        </div>
                                        <div class="col-xs-5 text-right">
                                            <div class="togglebutton ">
                                                <input  name="config[is_enable_envt_login]" value="N" type="hidden">
                                                <label>
                                                    <input   type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_envt_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_envt_login"  name="config[is_enable_envt_login]" >
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label class="control-label  " for="login_envt_call_back">Callback/Redirect URL
                                            <button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo site_url('index.php/social/endpoint');?>?hauth.done=Envato" >
                                                <i class="fa fa-copy "></i>
                                            </button>
                                        </label>
                                        <div class="form-control bg-disable"  style="font-size: 12px; height:auto; min-height: 50px;" id="login_g_call_back"  ><?php echo site_url('index.php/social/endpoint');?>?hauth.done=Envato</div>
                                        <span class="form-group-help-block"><?php _e("Use this as your confirmation url into your envato app register page.");?><br/>
                                            <a class="popupformIF" href="http://bit.ly/2IY6L01"> <?php _e("Click here to watch the video tutorial") ; ?></a>
                                        </span>
                                    </div>
                                    <div class="form-group fld-config-is-enable-envt-login fld-config-is-enable-envt-login-y">
                                        <label class="control-label  label-required" for="login_envt_client_id">Client ID</label>
                                        <textarea   class="form-control form-control-2" id="login_envt_client_id" name="config[login_envt_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_envt_client_id")?></textarea>
                                    </div>
                                    <div class="form-group fld-config-is-enable-envt-login fld-config-is-enable-envt-login-y">
                                        <label class="control-label label-required" for="login_g_secret">Secret</label>
                                        <textarea    class="form-control form-control-2" id="login_envt_secret" name="config[login_envt_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_envt_secret")?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                	   <div class="col-md-4">
                	   <div class="panel panel-default">   
                	    <div class="panel-heading p-b-5">
                	    <div class="row">
                	      	<div class="col-xs-7">
                	      	<i class="fa fa-google c-google"></i> Google Login
                	      	</div>
                	      	<div class="col-xs-5 text-right">
    					     	<div class="togglebutton ">
    						    	<input  name="config[is_enable_g_login]" value="N" type="hidden">
    								<label> 
    									<input   type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_g_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_g_login"  name="config[is_enable_g_login]" > 
    								</label>    								
    							</div>    								
        				      	</div>
        				     </div>
                	    </div>             	   
                	     <div class="panel-body">  
                	        <div class="form-group">
                        		<label class="control-label  " for="login_g_call_back">Callback/Redirect URL 
                        		<button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo site_url('index.php/social/endpoint');?>?hauth.done=Google" >
                        		  <i class="fa fa-copy "></i>
                        		</button> 
                        		</label>
                        		<div class="form-control bg-disable"  style="font-size: 12px; height:auto; min-height: 50px;" id="login_g_call_back"  ><?php echo site_url('index.php/social/endpoint');?>?hauth.done=Google</div>
                        		<span class="form-group-help-block"><?php _e("Use this as your callback url into your google developer console");?></span>
                    	   </div>               	   
    			            <div class="form-group fld-config-is-enable-g-login fld-config-is-enable-g-login-y">
                        		<label class="control-label  label-required" for="login_g_client_id">Client ID</label>
                        		<textarea   class="form-control form-control-2" id="login_g_client_id" name="config[login_g_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_g_client_id")?></textarea>
                    	   </div>                    	     
    			            <div class="form-group fld-config-is-enable-g-login fld-config-is-enable-g-login-y">
                        		<label class="control-label label-required" for="login_g_secret">Secret</label>
                        		<textarea    class="form-control form-control-2" id="login_g_secret" name="config[login_g_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_g_secret")?></textarea>
                    	   </div> 
			            </div>
			            </div>
                	   </div>

                	  <div class="col-md-4">
                	   <div class="panel panel-default">   
                	    <div class="panel-heading p-b-5">
                	    <div class="row">
                	      	<div class="col-xs-7">
                	      	<i class="fa fa-facebook c-facebook"></i> Facebook Login
                	      	</div>
                	      	<div class="col-xs-5 text-right">
    					     	<div class="togglebutton ">
    						    	<input  name="config[is_enable_f_login]" value="N" type="hidden">
    								<label> 
    									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_f_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_f_login"  name="config[is_enable_f_login]" > 
    								</label>    								
    							</div>    								
        				      	</div>
        				     </div>
                	    </div>             	   
                	     <div class="panel-body">    
                	       <div class="form-group">
                        		<label class="control-label  " for="login_g_call_back">Callback/Redirect URL
                            		<button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo site_url('index.php/social/endpoint?hauth_done=Facebook');?>" >
                            		  <i class="fa fa-copy "></i>
                            		</button> 
                        		</label>
                        		<div class="form-control bg-disable" style="font-size: 12px; height:auto; min-height: 50px;" id="login_g_call_back" ><?php echo site_url('index.php/social/endpoint?hauth_done=Facebook');?></div>
                        		<span class="form-group-help-block"><?php _e("Use this as your callback url into facebook developer panel");?></span>
                    	   </div>            	   
    			             <div class="form-group fld-config-is-enable-f-login fld-config-is-enable-f-login-y">
                        		<label class="control-label  label-required" for="login_f_client_id">Client ID</label>
                        		<textarea  style=" height:auto; min-height: 50px;" class="form-control form-control-2" id="login_f_client_id" name="config[login_f_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_f_client_id")?></textarea>
                    	   </div>                    	     
    			            <div class="form-group fld-config-is-enable-f-login fld-config-is-enable-f-login-y">
                        		<label class="control-label label-required" for="login_f_secret">Secret</label>
                        		<textarea     class="form-control form-control-2" id="login_f_secret" name="config[login_f_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_f_secret")?></textarea>
                    	   </div>
			            </div>
			            </div>
                	   </div>
                	   

                	   </div>
                	   
                	  <div class="row">

                          <div class="col-md-4">
                              <div class="panel panel-default">
                                  <div class="panel-heading p-b-5">
                                      <div class="row">
                                          <div class="col-xs-7">
                                              <i class="fa fa-twitter c-twitter"></i> Twitter Login
                                          </div>
                                          <div class="col-xs-5 text-right">
                                              <div class="togglebutton ">
                                                  <input  name="config[is_enable_t_login]" value="N" type="hidden">
                                                  <label>
                                                      <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_t_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_t_login"  name="config[is_enable_t_login]" >
                                                  </label>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="panel-body">
                                      <div class="form-group">
                                          <label class="control-label  " for="login_g_call_back">Callback/Redirect URL
                                              <button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo site_url('index.php/social/endpoint');?>" >
                                                  <i class="fa fa-copy "></i>
                                              </button>
                                          </label>
                                          <div class="form-control bg-disable" style="font-size: 12px; height:auto; min-height: 50px;" id="login_g_call_back"  ><?php echo site_url('index.php/social/endpoint');?></div>
                                          <span class="form-group-help-block"><?php _e("Use this as your callback url into twitter developer panel");?></span>
                                      </div>
                                      <div class="form-group fld-config-is-enable-t-login fld-config-is-enable-t-login-y">
                                          <label class="control-label  label-required" for="login_t_client_id">Client ID</label>
                                          <textarea style="height: 60px;"  class="form-control form-control-2" id="login_t_client_id" name="config[login_t_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_t_client_id")?></textarea>
                                      </div>
                                      <div class="form-group fld-config-is-enable-t-login fld-config-is-enable-t-login-y">
                                          <label class="control-label label-required" for="login_t_secret">Secret</label>
                                          <textarea     class="form-control form-control-2" id="login_t_secret" name="config[login_t_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_t_secret")?></textarea>
                                      </div>
                                  </div>
                              </div>
                          </div>


                          <div class="col-md-4">
                	   <div class="panel panel-default">   
                	    <div class="panel-heading p-b-5">
                	    <div class="row">
                	      	<div class="col-xs-7">
                	      	<i class="fa fa-linkedin c-app"></i> LinkedIn Login
                	      	</div>
                	      	<div class="col-xs-5 text-right">
    					     	<div class="togglebutton ">
    						    	<input  name="config[is_enable_l_login]" value="N" type="hidden">
    								<label> 
    									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_l_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_l_login"  name="config[is_enable_l_login]" > 
    								</label>    								
    							</div>    								
        				      	</div>
        				     </div>
                	    </div>             	   
                	   <div class="panel-body"> 
                	       <div class="form-group">
                        		<label class="control-label  " for="login_l_call_back">Callback/Redirect URL
                        		<button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo site_url('index.php/social/endpoint?hauth.done=LinkedIn&response_type=code&scope=r_basicprofile+r_emailaddress');?>" >
                            		  <i class="fa fa-copy "></i>
                            		</button>
                        		</label>
                        		<div class="form-control bg-disable" style="font-size: 12px; height:auto; min-height: 50px;" id="login_l_call_back"  ><?php echo site_url('index.php/social/endpoint?hauth.done=LinkedIn&response_type=code&scope=r_basicprofile+r_emailaddress');?></div>
                        		<span class="form-group-help-block"><?php _e("Use this as your callback url into twitter developer panel");?></span>
                    	   </div>                    	   
    			             <div class="form-group fld-config-is-enable-l-login fld-config-is-enable-l-login-y">
                        		<label class="control-label  label-required" for="login_t_client_id">Client ID</label>
                        		<textarea   class="form-control"  style="height: 60px;" id="login_l_client_id" name="config[login_l_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_l_client_id")?></textarea>
                    	   </div>                    	     
    			            <div class="form-group fld-config-is-enable-l-login fld-config-is-enable-l-login-y">
                        		<label class="control-label label-required" for="login_t_secret">Secret</label>
                        		<textarea     class="form-control form-control-2" id="login_l_secret" name="config[login_l_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_l_secret")?></textarea>
                    	   </div>
			            </div>
			            </div>
                	   </div>   
                	   
                	   
                	   <div class="col-md-4">
                	   <div class="panel panel-default">   
                	    <div class="panel-heading p-b-5">
                	    <div class="row">
                	      	<div class="col-xs-7">
                	      	<i class="fa fa-github c-app"></i> GitHub Login
                	      	</div>
                	      	<div class="col-xs-5 text-right">
    					     	<div class="togglebutton ">
    						    	<input  name="config[is_enable_gh_login]" value="N" type="hidden">
    								<label> 
    									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_gh_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_gh_login"  name="config[is_enable_gh_login]" > 
    								</label>    								
    							</div>    								
        				      	</div>
        				     </div>
                	    </div>             	   
                	   <div class="panel-body"> 
                	       <div class="form-group">
                        		<label class="control-label  " for="login_gh_call_back">Callback/Redirect URL
                        		<button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo site_url('index.php/social/endpoint');?>" >
                            		  <i class="fa fa-copy "></i>
                            		</button>
                        		</label>
                        		<div class="form-control bg-disable" style="font-size: 12px; height:auto; min-height: 50px;" id="login_gh_call_back"  ><?php echo site_url('index.php/social/endpoint');?></div>
                        		<span class="form-group-help-block"><?php _e("Use this as your callback url into twitter developer panel");?></span>
                    	   </div>                    	   
    			             <div class="form-group fld-config-is-enable-gh-login fld-config-is-enable-gh-login-y">
                        		<label class="control-label  label-required" for="login_t_client_id">Client ID</label>
                        		<textarea   class="form-control form-control-2" id="login_gh_client_id" name="config[login_gh_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_gh_client_id")?></textarea>
                    	   </div>                    	     
    			            <div class="form-group fld-config-is-enable-gh-login fld-config-is-enable-gh-login-y">
                        		<label class="control-label label-required" for="login_t_secret">Secret</label>
                        		<textarea     class="form-control form-control-2" id="login_gh_secret" name="config[login_gh_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_gh_secret")?></textarea>
                    	   </div>
			            </div>
			            </div>
                	   </div>
                	   
                	   
                	   
                	   <div class="col-md-4">
                	   <div class="panel panel-default">   
                	    <div class="panel-heading p-b-5">
                	    <div class="row">
                	      	<div class="col-xs-7">
                	      	<i class="fa fa-yahoo c-app"></i> Yahoo
                	      	</div>
                	      	<div class="col-xs-5 text-right">
    					     	<div class="togglebutton ">
    						    	<input  name="config[is_enable_y_login]" value="N" type="hidden">
    								<label> 
    									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_y_login","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld2" id="is_enable_y_login"  name="config[is_enable_y_login]" > 
    								</label>    								
    							</div>    								
        				      	</div>
        				     </div>
                	    </div>             	   
                	   <div class="panel-body"> 
                	       <div class="form-group">
                        		<label class="control-label  " for="login_y_call_back">Callback/Redirect Domain
                        		<?php
                        		$base_domain =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http")."://".(isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:"");
                        		 
                        		?>
                        		<button class="btn btn-xs app-copy-btn" type="button" title="<?php _e("Copy callback url") ; ?>" data-clipboard-text="<?php echo $base_domain;?>" >
                            		  <i class="fa fa-copy "></i>
                            		</button>
                        		</label>
                        		<div class="form-control bg-disable" style="font-size: 12px; height:auto; min-height: 50px;" id="login_y_call_back"  ><?php echo $base_domain;?></div>
                        		<span class="form-group-help-block"><?php _e("Use this as your callback url into twitter developer panel");?></span>
                    	   </div>                    	   
    			             <div class="form-group fld-config-is-enable-y-login fld-config-is-enable-y-login-y">
                        		<label class="control-label  label-required" for="login_t_client_id">Client ID</label>
                        		<textarea   class="form-control form-control-2" id="login_y_client_id" name="config[login_y_client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_y_client_id")?></textarea>
                    	   </div>                    	     
    			            <div class="form-group fld-config-is-enable-y-login fld-config-is-enable-y-login-y">
                        		<label class="control-label label-required" for="login_t_secret">Secret</label>
                        		<textarea     class="form-control form-control-2" id="login_y_secret" name="config[login_y_secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>"><?php echo  $mainobj->GetPostValue("login_y_secret")?></textarea>
                    	   </div>
			            </div>
			            </div>
                	   </div>
                	   
                	                	
                	</div>			       
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-left">
                  <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save") ; ?></button>
                </div>
                <!-- /.footer -->
         </div>
         <!-- /.box -->
         <?php echo form_close();?>
    </div>
</div> 

<script type="text/javascript">
function on_beforesend(form){	 
	   form.find(">.box").addClass("state-loading");
}  
function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   if(rdata.status){
		   //$("#ap-noti").fadeOut('slow');
		   $("#ap-noti").removeClass("fadeInUp").addClass("fadeOutDown");
		 
	   }
	   form.find(">.box").removeClass("state-loading");	  
} 
$(function(e){
	$("body").append('<div id="ap-noti" class="save-noti animated"><div class="alert alert-warning p-5"><?php _e("!! You need to click save button to complete") ; ?></div></div>');
	$("input,textarea").on("change",function(){
		//$("#ap-noti").fadeIn('slow');
		$("#ap-noti").show().removeClass("fadeOutDown").addClass("fadeInUp");
	});
})
           
</script>
