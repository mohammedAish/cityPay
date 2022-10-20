<?php  echo form_open ( admin_url("admin-setting-confirm/modify/g"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?> 
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Basic Settings");?></h3>    
                  <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>                      
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="row">
                		<div class="col-md-6">
                    		<div class="form-group">
                        		<label class="control-label col-md-5 label-required" for="app_title"><?php _e("App Title"); ?></label>
                        		<div class="col-md-7">                   			     	
                        			<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("app_title")?>" class="form-control" id="app_title" name="config[app_title]" placeholder="<?php _e("App Title"); ?>" data-bv-notempty="true"   data-bv-notempty-message="<?php  _e("%s is required",__("App Title"));?>">
                        		</div>
                        	</div>
                        	
                        	                		
                		</div><!-- 1st Column -->
                		<div class="col-md-6">
                    		<div class="form-group">
                        		<label class="control-label col-md-4 label-required" for="app_email"><?php _e("App Email"); ?></label>
                        		<div class="col-md-8">                   			     	
                        			<input type="email" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("app_email")?>" class="form-control" id="app_email" name="config[app_email]" placeholder="<?php _e("App Email"); ?>" data-bv-notempty="true" data-bv-emailaddress="true" data-bv-emailaddress-message="<?php  _e("%s is invalid",__("Email Address"));?>"	data-bv-notempty-message="<?php  _e("%s is required",__("App Email"));?>">
                        		</div>
                        	</div>
                        	
                		</div><!-- 2nd Column -->
                	</div>
                	                 	
                	<div class="row">
                		<div class="col-md-6">
                    		
                        	                		
                		</div><!-- 1st Column -->
                		<div class="col-md-6">                    		
                        	
                		</div><!-- 2nd Column -->
                	</div>
                	
                	<div class="row">
                		<div class="col-md-6">
                            <?php $vapp_lang= $mainobj->GetPostValue("app_lang");?>
                        	<div class="form-group">
                        		<label class="control-label  label-required col-md-5" for="app_lang"><?php if(!empty($vapp_lang)){?><small>(Language)</small><?php }?>
                        		<?php _e("Admin Panel Language"); ?>
                        		</label>

                        		<div class="col-md-7 selectbox">                   			     	
                        			<select   class="form-control" id="app_lang" name="config[app_lang]"  >
                        				<?php
                        					//$vapp_lang= $mainobj->GetPostValue("app_lang");
                        					$languageList=app_get_languages();
                        					foreach ($languageList as $language){
                        					    $beta=!ISDEMOMODE && $language->is_beta?" (beta)":"";
                        				        GetHTMLOption($language->iso_code, $language->title.$beta,$vapp_lang,["data-is-beta"=>($language->is_beta?"true":"false")]);
                        					}
                        				?>
                        			</select>
                        			<span id="beta-msg" class="hidden form-group-help-block" style="color:#cd7810;"><i class="fa fa-info-circle faa-flash animated "></i> It's a beta version of this language. If you want to contribute on translation then please visit http://translator.appsbd.com</span>
                        		</div>

                        	</div> 
                        	                		
                		</div><!-- 1st Column -->
                		<div class="col-md-6">                    		
                        	<?php $vapp_clang= $mainobj->GetPostValue("app_clang");?>
                        	<div class="form-group">
                        		<label class="control-label  label-required col-md-4" for="app_clang">
                        		<?php _e("Site Language"); ?>
                        		
                        		</label>
                        		<div class="col-md-8 selectbox">                   			     	
                        			<select   class="form-control" id="app_clang" name="config[app_clang]"  >
                        				<?php
                        					//$vapp_lang= $mainobj->GetPostValue("app_lang");
                        				    GetHTMLOption("", __("Same As Admin"),$vapp_clang);
                        					foreach ($languageList as $language){
                        					    $beta=$language->is_beta?" (beta)":"";
                        				        GetHTMLOption($language->iso_code, $language->title.$beta,$vapp_clang,["data-is-beta"=>($language->is_beta?"true":"false")]);
                        					}
                        				?>
                        			</select>                        			
                        		</div>
                        		 
                        	</div> 
                		</div><!-- 2nd Column -->
                	</div>
                	<div class="row">
                		<div class="col-md-6">
                    		<div class="form-group">
                        		<label class="control-label  label-required col-md-5" for="app_date_format"><?php _e("Date Format"); ?></label>
                        		<div class="col-md-7 selectbox">                   			     	
                        			<select   class="form-control" id="app_date_format" name="config[app_date_format]"  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Date Format"));?>">
                        				<?php
                        					$vapp_date_format= $mainobj->GetPostValue("app_date_format");
                        					$array_date_format = array (
                        							'Y-m-d'  => "(YYYY-MM-DD)   &nbsp;  " . date ( 'Y-m-d'), 
                        							'Y.m.d'  => "(YYYY.MM.DD)   &nbsp;  " . date ( 'Y.m.d'),
                        							'Y/m/d'  => "(YYYY/MM/DD)   &nbsp;  " . date ( 'Y/m/d'),
                        							'd/m/Y'  => "(DD/MM/YYYY)   &nbsp;  " . date ( 'd/m/Y'),
                        							'd-m-Y'  => "(DD-MM-YYYY)   &nbsp;  " . date ( 'd-m-Y'),
                        							'd-M-Y'  => "(DD-MMM-YYYY)  &nbsp;  " . date ( 'd-M-Y'),
                        							'M d, Y' => "(MMM DD, YYYY) &nbsp;  " . date ( 'M d, Y'),
                        							'F d, Y' => "(MMMM DD, YYYY) &nbsp;  " . date ( 'F d, Y'),
        											
        									);
        									GetHTMLOptionByArray($array_date_format,$vapp_date_format);
                        				?>
                        			</select>
                        		</div>
                        	</div> 
                        	                		
                		</div><!-- 1st Column -->
                		<div class="col-md-6">                    		
                        	<div class="form-group">
                        		<label class="control-label  label-required col-md-4" for="app_time_format"><?php _e("Time Format"); ?></label>
                        		<div class="col-md-8 selectbox">                   			     	
                        			<select   class="form-control" id="app_time_format" name="config[app_time_format]"  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Time Format"));?>">
                        				<?php
                        					$vapp_time_format= $mainobj->GetPostValue("app_time_format");
                        					$timeobj=strtotime('18:20:30');
                        					$array_time_format=array (
                        							'H:i:s'  => "24H (HH:MM:SS)    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  " . date ( 'H:i:s',$timeobj), 
                        							'H:i'  => "24H (HH:MM)    &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  " . date ( 'H:i',$timeobj),
                        							'h:i:s A'  => "12H (HH:MM:SS PM)   &nbsp;&nbsp;" . date ( 'h:i:s A',$timeobj),
                        							'h:i A'  => "12H (HH:MM PM)   &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  " . date ( 'h:i A',$timeobj),
        											
        									);
                        					GetHTMLOptionByArray($array_time_format,$vapp_time_format);
                        				?>
                        			</select>
                        		</div>
                        	</div> 
                		</div><!-- 2nd Column -->
                	</div>
                	<div class="row"></div>
                	<hr />
                	
                	
                	 
                	 
                
                	
                	
                	
                	
                		
                	
                	
                	<div class="form-group m-b-0">
				      	<label class="control-label label-required col-md-4" for="status"><?php _e("Choose HTML Editor"); ?></label>
				      	<div class="col-md-8">                   			     	
				      	 <div class="inline radio-inline">
					        <?php 
					            $app_editor_selected= $mainobj->GetPostValue("app_html_editor","S");					           
					            $app_editor_op=array("S"=>"Summernote","C"=>"CK Editor");			          
					            GetHTMLRadioByArray("Choose HTML Editor","config[app_html_editor]","app_html_editor",true,$app_editor_op,$app_editor_selected,false,false,"app_html_editor");
					            ?>
					        <span class="form-group-help-block" style="display: inline-block;"><?php _e("It will effect in next reload. If you want to now then refresh after save.");?></span>
					       </div> 
					       
				      	</div>
				  </div>
                 <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="dlogin_enable"><?php _e("Disable Default Login"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[dlogin_enable]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("dlogin_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="dlogin_enable"  name="config[dlogin_enable]" > 
								</label>
								<span class="form-group-help-block"><?php _e("Default login system form won't not show if it enabled, but Remote Login & Social login will show if those are enabled");?></span>
							</div>
							
				      	</div>				      	
			       </div>
	                <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="regi_enable"><?php _e("Disable Registration"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[regi_enable]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("regi_enable","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="regi_enable"  name="config[regi_enable]" > 
								</label>
								<span class="form-group-help-block"><?php _e("Registration  of visitor. If you disable this then visitor can't register. Only registered client can open ticket after login");?></span>
							</div>
							
				      	</div>				      	
			       </div>
			       <div class="form-group app-popover-html"  data-trigger="hover" data-custom-content="#otgh"  data-placement="top">	                	
				      	<label class="control-label col-md-4 label-required" for="dgustpopup"><?php _e("Disable Guest Open Popup"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton">
						    	<input  name="config[dgustpopup]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("dgustpopup","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="dgustpopup"  name="config[dgustpopup]" > 
								</label>
								<span class="form-group-help-block" style="color:#7b7b7b;font-weight: normal;"><?php _e("Normally visitor will show a popup it s/he doesn't logged in. If you don't want to show that then enable it");?></span>
								<div style="display: none;">
                    			<div id="otgh" >
                    				
                    				<img style="width: 250px" src="<?php echo base_url("images/open-ticket-help.jpg")?>" alt="" />
                    			</div>
                    			</div>
							</div>
							
				      	</div>				      	
			       </div>
			       
			       <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_check_online"><?php _e("Enable User Online Check"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_check_online]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_check_online","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_check_online"  name="config[is_check_online]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then this app will check and show user online status.");?></span>
							</div>
							
				      	</div>				      	
			       </div>
			        <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_app_forcessl"><?php _e("Enable Force SSL"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_app_forcessl]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_app_forcessl","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_app_forcessl"  name="config[is_app_forcessl]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then this app will check SSL Request, if not then it will redirect to SSL URL.");?></span>
							</div>
							
				      	</div>				      	
			       </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_rtl_admin"><?php _e("Disable Google Font"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_dis_googlefont]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_dis_googlefont","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_dis_googlefont"  name="config[is_dis_googlefont]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable it, google font won't load in site");?></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_rtl_admin"><?php _e("Hide Knowledge Menu"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_hide_knowledge]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_hide_knowledge","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_hide_knowledge"  name="config[is_hide_knowledge]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable it, knowledge will be hide from the menu");?></span>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_rtl_admin"><?php _e("Enable RTL- Client Panel"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_rtl_client]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_rtl_client","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_rtl_client"  name="config[is_rtl_client]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable it, then client panel will in RTL direction");?></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_rtl_admin"><?php _e("Enable RTL- Admin Panel"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_rtl_admin]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_rtl_admin","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_rtl_admin"  name="config[is_rtl_admin]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable it, then admin panel will in RTL direction");?></span>
                            </div>

                        </div>
                    </div>
                   
			     
			       
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                </div>
                <!-- /.footer -->
         </div>
         <!-- /.box -->
         <?php echo form_close();?>