<div class="row">
	<div class="col-md-12">	         
	      <?php  echo form_open ( admin_url("admin-setting-confirm/modify-theme"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>   
	       <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Theme Settings");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                
                  <div class="form-group">	                	
               				<label class="control-label col-md-4 label-required text-right p-10" for="app_theme"><?php _e("Choose Theme"); ?></label>
               				<div class="col-md-8">
               					<div class="inline radio-inline">
					        <?php 
					            $app_editor_selected= $mainobj->GetPostValue("app_theme","bss2020");
					            $app_editor_op=array("bss2020"=>"Theme 2020","client2"=>"Default Theme","client"=>"2nd Theme");
					            GetHTMLRadioByArray("Choose HTML Editor","config[app_theme]","app_theme",true,$app_editor_op,$app_editor_selected,false,false,"has_depend_fld");
					            ?>					        
					       </div> 
					       <span class="form-group-help-block"><?php _e("More theme will be come in next version");?></span>              					
               			</div>				      	
               		</div>
               		<div class="row"></div>
               		<hr class="m-t-0 m-b-10" />
               		<div class="form-group">
                		<label style="line-height: 65px;" class="control-label col-md-4 label-required" for="app_logo"><?php _e("App Logo"); ?></label>
                		<div class="col-md-8">                		
                		 	<img class="app-image-input img-thumbnail" data-name="app_logo" src="<?php echo base_url("images/logo.png?t=".time());?>" style="height: 75px;"/>	
                		 	<span class="form-group-help-block"><?php _e("Click on the Image to change. Best size is 75px x 75px");?></span>
                		</div>
                	</div> 
                   <div class="row"></div>
                   
               		<div class="fld-config-app-theme fld-config-app-theme-client2 form form-horizontal">
               		 	<div class="form-group">
                		<label style="line-height: 65px;" class="control-label col-md-4 label-required" for="app_logo"><?php _e("App White Logo"); ?></label>
                		<div class="col-md-8" >       
                		  <?php 
                		      if(file_exists(FCPATH."images/white-logo.png")){
                		          $_app_white_logo=base_url("images/white-logo.png?t=".time());
                		      }else{
                		          $_app_white_logo=base_url("images/logo.png?t=".time());
                		      }
                		  ?>         		
                		 	<img class="app-image-input img-thumbnail" data-name="app_white_logo" src="<?php echo $_app_white_logo;?>" style="background: rgb(217, 220, 220); height: 75px;"/>	
                		 	<span class="form-group-help-block"><?php _e("Click on the Image to change. Best size hight is 40px");?></span>
                		 	<span class="form-group-help-block text-red"><?php _e("If you don't choose the white logo then primary logo will be displayed in site header");?></span>
                		</div>
                	</div>                	               		
               		</div>  
               		
               	<div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="isonly_logo"><?php _e("Show Logo in Header"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[isonly_logo]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("isonly_logo","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="isonly_logo"  name="config[isonly_logo]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then logo only show in site header");?></span>
							</div>
							
				      	</div>				      	
			       </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_show_app_ttl"><?php _e("Show App Title in Header"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_show_app_ttl]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_show_app_ttl","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_show_app_ttl"  name="config[is_show_app_ttl]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable this then the tile will show in site header");?></span>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
               				<label class="control-label col-md-4 label-required text-right p-10" for="app_hmp"><?php _e("Choose Homepage"); ?></label>
               				<div class="col-md-8">
               					<div class="inline radio-inline">
					        <?php 
					            $app_home_selected= $mainobj->GetPostValue("app_hmp","1");					           
					            $app_home_op=array("1"=>"Default Homepage","2"=>"2nd Homepage");			          
					            GetHTMLRadioByArray("Choose Homepage","config[app_hmp]","app_hmp",true,$app_home_op,$app_home_selected,false,false,"has_depend_fld");
					            ?>					        
					       </div> 
					       <span class="form-group-help-block"><?php _e("More homepage will be come in next version");?></span>              					
               			</div>				      	
               		</div>
                    <style>
                        .popover{
                            max-width: unset !important;
                        }
                    </style>
                    <div class="form-group fld-config-app-hmp fld-config-app-hmp-1 app-popover-html"  data-trigger="hover" data-custom-content="#state_dis" data-placement="top">
                        <label class="control-label col-md-4 label-required" for="is_state_kn"><?php _e("Disable Knowledge Stat In Homepage"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_state_kn]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_state_kn","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_state_kn"  name="config[is_state_kn]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("Enable this to disable %s,%s,%s in homepage",'<strong class="text-yellow">'.__("Recent Articles").'</strong>','<strong class="text-yellow">'.__("Popular Articles").'</strong>','<strong class="text-yellow">'.__("Most Helpful Articles ").'</strong>');?></span>
                                <div style="display: none;">
                                    <div id="state_dis" >
                                        <img style="width: 600px" src="<?php echo base_url("images/disabled-state.jpg")?>" alt="<?php _e("Disable knowledge statistics in home page") ; ?>" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group app-popover-html"  data-trigger="hover" data-custom-content="#state_like_dlike" data-placement="top">
                        <label class="control-label col-md-4 label-required" for="is_kn_like_dlike"><?php _e("Disable Knowledge Like/Dislike Button"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_kn_like_dlike]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_kn_like_dlike","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_kn_like_dlike"  name="config[is_kn_like_dlike]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable this then it won't show the like or dislike button on knowledge details.");?></span>
                                <div style="display: none;">
                                    <div id="state_like_dlike" >
                                        <img style="width: 600px" src="<?php echo base_url("images/like_dilike.jpg")?>" alt="<?php _e("Disable knowledge like and dislike button") ; ?>" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group app-popover-html"  data-trigger="hover" data-custom-content="#state_like_lud" data-placement="top">
                        <label class="control-label col-md-4 label-required" for="is_kn_l_upd"><?php _e("Do Not Show Last Update Date on Knowledge Details"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_kn_l_upd]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_kn_l_upd","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_kn_l_upd"  name="config[is_kn_l_upd]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable this then, it won't show the last update date on knowledge details.");?></span>
                                <div style="display: none;">
                                    <div id="state_like_lud" >
                                        <img style="width: 600px" src="<?php echo base_url("images/last_update_img.jpg")?>" alt="<?php _e("Disable knowledge like and dislike button") ; ?>" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-group app-popover-html"  data-trigger="hover" data-custom-content="#state_like_ct" data-placement="top">
                        <label class="control-label col-md-4 label-required" for="is_kn_iconc"><?php _e("Do Not Show counter with knowledge"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_kn_iconc]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_kn_iconc","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_kn_iconc"  name="config[is_kn_iconc]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable this then, it won't show the view/rate counter.");?></span>
                                <div style="display: none;">
                                    <div id="state_like_ct" >
                                        <img style="width: 600px" src="<?php echo base_url("images/counter_icon.jpg")?>" alt="<?php _e("Disable Counter Icon") ; ?>" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                 <div class="row">                    
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
   $(function(){
	  
	});          
</script>
