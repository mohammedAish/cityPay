<?php /* @var APP_Controller $this; */ ?>
<div class="row">
	<div class="col-md-12">	
         <form id="app-admin-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-security/t");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Admin User");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                
                  <div class="form-group">	                	
               				<label class="control-label col-md-4 label-required" for="app_dos_atk"><?php _e("Admin User Login Security"); ?></label>
               				<div class="col-md-8">
               					<div class="togglebutton ">
               						<input  name="config[app_user_scq]" value="N" type="hidden">
               						<label> 
               							<input  type="checkbox" <?php echo $mainobj->GetPostValue("app_user_scq","Y")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="app_user_scq"  name="config[app_user_scq]" > 
               						</label>
               						<span class="form-group-help-block "><?php _e("Enable it to secure admin/staff user");?></span>
               					</div>
               					
               					
               					
               			</div>				      	
               		</div>
               		<div class="row"></div>
               		<div class="fld-config-app-user-scq fld-config-app-user-scq-y form-inline text-center">
               		   <hr class="m-15" />
               		   <div class="form-group ">
               		   	<label class="control-label" for="app_dos_req"><?php _e("Temporary lock admin or staff user, if attempts "); ?></label>
               		   	               			     	
               		   		<input type="number" maxlength="2" style="width:80px;"  value="<?php echo  $mainobj->GetPostValue("appuser_sec_tried",5)?>" class="form-control" id="app_dos_req" name="config[app_dos_req]" placeholder="<?php _e("ex.5"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Request Count"));?>">
               		   	<label class="control-label" for="app_dos_sec"><?php _e("miss login in "); ?></label>               		   	               			     	
               		    <input type="number" maxlength="2" style="width:80px;"  value="<?php echo  $mainobj->GetPostValue("appuser_sec_min",30)?>" class="form-control" id="app_dos_sec" name="config[app_dos_sec]" placeholder="<?php _e("ex.5"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Seconds"));?>">
               		    <label class="control-label" for="name" style="padding-right: 10px;"><?php _e("minuites"); ?></label>               		   		
               		   	
               		   	<span class="form-group-help-block text-red" ><?php _e("Example: Temporary lock admin or staff user if attempts 5 miss login in 30 minutes") ; ?></span>
               		   </div> 
               		   
               		   
               		
               		</div>
			       
                
                
                	
				  
                	  	
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                 <div class="row">
                    <div class="col-sm-6 hidden-xs"><a href="<?php echo site_url("admin/locked-user");?>" target="_blank" class="btn btn-default btn-sm"> <i class="ap ap-locked-user2"></i> <?php _e("Show Locked User List") ; ?></a></div>
                    <div class="col-sm-6 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
                </div>
                </div>
                <!-- /.footer -->
         	</div>
         <!-- /.box -->
         </form>
		<?php $this->load->view("admin/admin_setting/admin_panel_security");?>


        <form id="app-dos-form-ad" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-security/g");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php _e("Site Security");?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="app_dos_atk"><?php _e("DoS Attack Security"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[app_dos_atk]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("app_dos_atk","Y")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="app_dos_atk"  name="config[app_dos_atk]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable it then app prevent DoS Attack.");?> <a class="text-bold text-red" href="https://en.wikipedia.org/wiki/Denial-of-service_attack"><?php _e("Click here") ; ?></a> to know about DoS Attack</span>
                            </div>



                        </div>
                    </div>
                    <div class="row"></div>
                    <div class="fld-config-app-dos-atk fld-config-app-dos-atk-y form-inline text-center">
                        <hr class="m-t-0 m-15" />
                        <div class="form-group ">
                            <label class="control-label" for="app_dos_req"><?php _e("If request more than "); ?></label>

                            <input type="number" maxlength="2" style="width:80px;"  value="<?php echo  $mainobj->GetPostValue("app_dos_req",5)?>" class="form-control" id="app_dos_req" name="config[app_dos_req]" placeholder="<?php _e("ex.5"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Request Count"));?>">
                            <label class="control-label" for="app_dos_sec"><?php _e("in "); ?></label>
                            <input type="number" maxlength="2" style="width:80px;"  value="<?php echo  $mainobj->GetPostValue("app_dos_sec",5)?>" class="form-control" id="app_dos_sec" name="config[app_dos_sec]" placeholder="<?php _e("ex.5"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Seconds"));?>">
                            <label class="control-label" for="name" style="padding-right: 10px;"><?php _e("seconds, then"); ?></label>
                            <div class="inline radio-inline"  style="padding-top: 10px;">
								<?php
									$vap_dc_str_type = $mainobj->GetPostValue("app_dos_action","C");
									$vap_dc_str_type_opt=array("C"=>"Show Captcha","L"=>"Block IP");
									GetHTMLRadioByArray("Action type","config[app_dos_action]","app_dos_action",true,$vap_dc_str_type_opt,$vap_dc_str_type);
								?>
                            </div>
                            <span class="form-group-help-block text-red"><?php _e("Example: if request more then 5 in 5 second then show captcha or block ip") ; ?></span>
                        </div>
                    </div>






                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs"><a href="<?php echo site_url("admin/iplist");?>" target="_blank" class="btn btn-default btn-sm"> <i class="ap ap-ip"></i> <?php _e("Show IP List") ; ?></a></div>
                        <div class="col-sm-6 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
                    </div>

                </div>
                <!-- /.footer -->
            </div>
            <!-- /.box -->
        </form>

        <form id="app-dos-form-cl" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-security/c");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php _e("Country Block Settings (for all panel)");?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="app_ctry_block"><?php _e("Status"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[app_ctry_block]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("app_ctry_block","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="app_ctry_block"  name="config[app_ctry_block]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable it then app check country for allow or block.");?></span>
                            </div>



                        </div>
                    </div>
                    <div class="row"></div>
                    <div class="fld-config-app-ctry-block fld-config-app-ctry-block-y">
                        <hr class="m-t-0 m-15" />
                        <div class="form-group m-b-0">
                            <label class="control-label label-required col-md-4" for="status"><?php _e("Country Block Rule"); ?></label>
                            <div class="col-md-8">
                                <div class="inline radio-inline">
				                    <?php
					                    $app_ctrybr_selected  = $mainobj->GetPostValue("app_ctry_brule","B");
					                    $app_ctrybr_editor_op =array( "B" =>"Block Listed Country", "A" =>"Allow Listed Country Only");
					                    GetHTMLRadioByArray("Country Block Rule","config[app_ctry_brule]","app_ctry_brule",true,$app_ctrybr_editor_op,$app_ctrybr_selected,false,false,"");
				                    ?>
                                
                                </div>

                            </div>
                        </div>
                        <div class="row"></div>
                        <div class="form-group m-l-15">
                            <label class="control-label  label-required" for="app_ctry_list"><?php _e("Country List"); ?></label>
                            <textarea class="form-control app-tags"  id="app_ctry_list" name="config[app_ctry_list]"><?php echo  $mainobj->GetPostValue("app_ctry_list")?></textarea>
                            <span class="form-group-help-block"><?php _e("Enter 2 digit Country Code(ex. US,CA,BD), Separated by comma");?></span>
                        </div>

                    </div>






                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs"></div>
                        <div class="col-sm-6 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
                    </div>

                </div>
                <!-- /.footer -->
            </div>
            <!-- /.box -->
        </form>

        <form id="app-dos-form-se" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-security/s");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php _e("Spam Emails");?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="">
                        <div class="row"></div>
                        <div class="form-group m-l-15">
                            <label class="control-label  label-required" for="app_ctry_list"><?php _e("SPAM Emails"); ?></label>
                            <textarea class="form-control app-tags"  id="app_spam_emails" name="config[app_spam_emails]"><?php echo  $mainobj->GetPostValue("app_spam_emails")?></textarea>
                            <span class="form-group-help-block"><?php _e("Enter email address(ex. example@example.com), Separated by comma");?></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 label-required" for="app_dos_atk"><?php _e("Delete SMAP Email"); ?></label>
                            <div class="col-md-10">
                                <div class="togglebutton ">
                                    <input  name="config[is_del_spam_email]" value="N" type="hidden">
                                    <label>
                                        <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_del_spam_email","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_del_spam_email"  name="config[is_del_spam_email]" >
                                    </label>
                                    <span class="form-group-help-block">
                                        <?php _e("If you enable it then, app will delete those email form mail client, which are come from spam email list");?>
                                    </span>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <div class="row">
                        <div class="col-sm-6 hidden-xs"></div>
                        <div class="col-sm-6 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
                    </div>

                </div>
                <!-- /.footer -->
            </div>
            <!-- /.box -->
        </form>
    </div>
</div> 

<script type="text/javascript">
   
   function on_beforesend(form){	 
	   form.find(">.box").addClass("state-loading");
   }  
   function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.box").removeClass("state-loading");
   }   
   function showAutocolorFlds(selectedAction){
	   var activeFlields=$(".auto-color-fld."+selectedAction+"-action");	   
	   activeFlields.fadeIn();
	   activeFlields.find("input,select").prop("disabled",false);	
   }
</script>
