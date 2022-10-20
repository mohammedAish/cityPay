<form id="app-color-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify/o");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Layout & Color Settings");?></h3>    
                  <div class="box-tools pull-right">
                   <button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                   </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">			  
				   <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="app_layout"><?php _e("Application Layout"); ?></label>
				      	<div class="col-md-8">
					     	<div class="inline radio-inline">
					        <?php 
					            $is_box_size_selected= $mainobj->GetPostValue("app_layout","F");					           
					            $app_box_editor_op=array("F"=>"Full Width","B"=>"Box Size");			          
					            GetHTMLRadioByArray("Application Layout","config[app_layout]","app_layout",true,$app_box_editor_op,$is_box_size_selected,false,false,"app_layout");
					            ?>
					        
					       </div> 
							
				      	</div>				      	
			       </div>
                    <div class="fld-config-app-theme fld-config-app-theme-bss2020">
                        <div class="panel panel-success">
                            <div class="panel-body text-center bg-success">
                                <?php _e("You have choosen %s theme, Its latest theme it has live edit feature. Please use that. Click the button below to use live edit",'<span class="text-bold">Theme 2020</span>') ; ?>
                                <br><a target="_blank" href="<?php echo base_url('?live=1') ?>" class="btn btn-success btn-sm m-t-15"><i class="fa fa-edit"></i> <?php _e("Live Edit") ; ?></a>
                                <br>  <br> <small class=""><?php _e("In live edit mode, you see a button with icon (%s) the right top position, use that to change color",'<i class=" faa-pulse animated fa fa-cog"></i>');?></small>
                            </div>
                        </div>

                    </div>
                    <div class="fld-config-app-theme fld-config-app-theme-client2 fld-config-app-theme-client">
                	<div class="form-group">
                		<label class="control-label col-md-4 label-required" for="app_main_color"><?php _e("Main Color"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">
                			
                			<input type="text" maxlength="7"  value="<?php echo  $mainobj->GetPostValue("app_main_color")?>" class="form-control app-color-picker" id="app_main_color" name="config[app_main_color]" placeholder="<?php _e("Main Color"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Main Color"));?>">
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_main_color" data-color="<?php echo Mapp_setting::GetSettingsValue('app_theme')=="bss2020"?'#00a606':'#0b8ec2'; ?>" href="#">Set Default Color</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("Main site color is defined for application main color of client site.");?></span>
                		</div> 
                	</div> 
                	
                	<div class="form-group">
                		<label class="control-label col-md-4 label-required" for="app_header_bg"><?php _e("Header Color"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("app_header_bg")?>" class="form-control app-color-picker" id="app_header_bg" name="config[app_header_bg]" placeholder="<?php _e("Main Color"); ?>">
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_header_bg" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("Its background color of header");?></span>
                		</div> 
                	</div> 
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="app_c_auto"><?php _e("Header Gradient"); ?></label>
                			<div class="col-md-8">
                				<div class="togglebutton ">
                					<input  name="config[app_header_isg]" value="N" type="hidden">
                					<label> 
                						<input  type="checkbox" <?php echo $mainobj->GetPostValue("app_header_isg","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="app_header_isg" name="config[app_header_isg]" >
                					</label>
                					<span class="form-group-help-block"><?php _e("If enable this then the header background will be gradient");?></span>
                				</div>
                				
                		</div>				      	
                	</div>
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="app_c_auto"><?php _e("Auto Others Color"); ?></label>
                			<div class="col-md-8">
                				<div class="togglebutton ">
                					<input  name="config[app_c_auto]" value="N" type="hidden">
                					<label> 
                						<input  type="checkbox" <?php echo $mainobj->GetPostValue("app_c_auto","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="app_c_auto" name="config[app_c_auto]" >
                					</label>
                					<span class="form-group-help-block"><?php _e("If enable this then other color will be auto generate based on main color");?></span>
                				</div>
                				
                		</div>				      	
                	</div>
                	<hr class="auto-color-fld no-action" />
                	
                    <div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="app_text_color"><?php _e("Welcome Background"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("app_welcome_bg")?>" class="form-control app-color-picker" id="app_welcome_bg" name="config[app_welcome_bg]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_welcome_bg" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's the background color of welcome message. But you can choose any text color on any text of welcome message using editor. Empty value will be auto from main color");?></span>
                		</div> 
                	</div> 
                	<div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="app_welcome_text"><?php _e("Welcome Text"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("app_welcome_text")?>" class="form-control app-color-picker" id="app_welcome_text" name="config[app_welcome_text]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_welcome_text" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's the background color of welcome message. But you can choose any text color on any text of welcome message using editor. Empty value will be auto from main color");?></span>
                		</div> 
                	</div> 
                	           	
					<div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="app_text_color"><?php _e("Link And Heading Text"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("app_text_color")?>" class="form-control app-color-picker" id="app_text_color" name="config[app_text_color]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_text_color" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's the color of anchor link and heading(h1,h2,h3,h4) Color. Empty value will be auto from main color");?></span>
                		</div> 
                	</div> 
                	
                	<div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="app_navbar_bg"><?php _e("Menu Background"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("app_navbar_bg")?>" class="form-control app-color-picker" id="app_navbar_bg" name="config[app_navbar_bg]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_navbar_bg" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's background color of menu bar. Empty value will be auto from main color");?></span>
                		</div> 
                	</div> 
                	 
                	<div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="app_nav_acive_text"><?php _e("Menu Active Text Color"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("app_nav_acive_text")?>" class="form-control app-color-picker" id="app_nav_acive_text" name="config[app_nav_acive_text]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#app_nav_acive_text" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's background color of menu text color when active. Empty value will be auto from main color");?></span>
                		</div> 
                	</div>
                	
                	<div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="footer_bg_color"><?php _e("Footer Background"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("footer_bg_color")?>" class="form-control app-color-picker" id="footer_bg_color" name="config[footer_bg_color]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#footer_bg_color" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's background color of footer. Empty value will be auto from main color");?></span>
                		</div> 
                	</div>
                	<div class="form-group auto-color-fld no-action">
                		<label class="control-label col-md-4 " for="footer_text_color"><?php _e("Footer Text"); ?></label>
                		<div class="col-md-4">                   			     	
                			<div class="input-group">                			
                			<input type="text" maxlength="7"   value="<?php echo $mainobj->GetPostValue("footer_text_color")?>" class="form-control app-color-picker" id="footer_text_color" name="config[footer_text_color]" >
                			<span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                			</div>
                		</div> 
                		<div class="col-md-4 p-0">
                			<a class="app-default-color" data-target="#footer_text_color" data-color="" href="#">Clear</a>
                		</div>
                		<div class="">
                			<span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It's text color of footer. Empty value will be auto from main color");?></span>
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