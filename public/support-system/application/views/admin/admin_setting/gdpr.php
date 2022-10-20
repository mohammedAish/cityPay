<?php
$gdpr=new Mapp_settings_api_advance();
$gdpr->SetAPIName("gdpr");
?>
<form id="gdpr-fbc-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-gdpr");?>" data-beforesend="on_beforesend" enctype="multipart/form-data" data-on-complete="on_complete" data-multipart="true" class="form app-ajax-form form-horizontal">
  	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="ap ap-gdpr" style="font-size: 21px;vertical-align: -4px;"></i> <?php _e("GDPR Settings");?></h3>
                 <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-4 label-required" for="gdpr_is_active"><?php _e("Enable"); ?></label>
                                <div class="col-md-8">
                                    <div class="togglebutton ">
                                        <input  name="config[gdpr_is_active]" value="N" type="hidden">
                                        <label>
                                            <input type="checkbox" <?php echo $gdpr->GetPostValue("gdpr_is_active","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="gdpr_is_active" name="config[gdpr_is_active]" >
                                        </label>
                                        <span class="form-group-help-block"><?php _e("To enable GDPR");?></span>
                                    </div>
    
                                </div>
                            </div>
                            <div class="fld-config-gdpr-is-active fld-config-gdpr-is-active-y">
                                <hr>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="gdpr_ua_active"><?php _e("Allow User Own Account Delete Option"); ?></label>
                                    <div class="col-md-8">
                                        <div class="togglebutton ">
                                            <input  name="config[gdpr_ua_active]" value="N" type="hidden">
                                            <label>
                                                <input type="checkbox" <?php echo $gdpr->GetPostValue("gdpr_ua_active","N")=="Y"?' checked="checked"':'';?> value="Y"  id="gdpr_ua_active" name="config[gdpr_ua_active]" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("If you enable it, then site user or visitor can download their account data from their panel");?></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="gdpr_ud_active"><?php _e("Allow User To Download Their User Data"); ?></label>
                                    <div class="col-md-8">
                                        <div class="togglebutton ">
                                            <input  name="config[gdpr_ud_active]" value="N" type="hidden">
                                            <label>
                                                <input type="checkbox" <?php echo $gdpr->GetPostValue("gdpr_ud_active","N")=="Y"?' checked="checked"':'';?> value="Y"  id="gdpr_ud_active" name="config[gdpr_ud_active]" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("If you enable it, then site user or visitor can delete their account from their panel");?></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="gdpr_cnb"><?php _e("View Cookie Notification Bar"); ?></label>
                                    <div class="col-md-8">
                                        <div class="togglebutton ">
                                            <input  name="config[gdpr_cnb]" value="N" type="hidden">
                                            <label>
                                                <input type="checkbox" <?php echo $gdpr->GetPostValue("gdpr_cnb","N")=="Y"?' checked="checked"':'';?> class="has_depend_fld" value="Y"  id="gdpr_cnb" name="config[gdpr_cnb]" >
                                            </label>
                                            <span class="form-group-help-block"><?php _e("If you enable it, then app will show a notification bar for cookie message");?></span>
                                        </div>

                                    </div>
                                </div>
                                <div class="fld-config-gdpr-cnb fld-config-gdpr-cnb-y">
                                    <hr>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="gdpr_cnb_bg"><?php _e("Cookie Bar Background Color"); ?></label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" maxlength="7"  value="<?php echo  $gdpr->GetPostValue("gdpr_cnb_bg",'#000000')?>" class="form-control app-color-picker" id="gdpr_cnb_bg" name="config[gdpr_cnb_bg]"  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Cookie bar bg color"));?>">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-square c-preview"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-0">
                                            <a class="app-default-color" data-target="#gdpr_cnb_bg" data-color="#000000" href="#">Set Default Color</a>
                                        </div>
                                        <div class="">
                                            <span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It is the cookie bar background color");?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 label-required" for="gpbr_bg_op"><?php _e("Background Opacity"); ?></label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="gpbr_bg_op" name="config[gpbr_bg_op]" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("Background Opacity is required");?>">
				                                <?php
					                                $gdpr_bg_op_sel=$gdpr->GetPostValue("gpbr_bg_op",90);
					                                for($bgi=30;$bgi<=100;$bgi+=5) {
						                                GetHTMLOption( $bgi, $bgi . "%", $gdpr_bg_op_sel );
					                                }
				                                ?>
                                            </select>
                                            <span class="form-group-help-block"><?php _e("It will control the opacity or background transparency of cookie bar background");?></span>

                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="gdpr_cnb_bg"><?php _e("Cookie Bar Text Color"); ?></label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" maxlength="7"  value="<?php echo  $gdpr->GetPostValue("gdpr_cnb_tc",'#FFFFFF')?>" class="form-control app-color-picker" id="gdpr_cnb_tc" name="config[gdpr_cnb_tc]"  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Cookie bar text color"));?>">
                                                <span class="input-group-addon" id="basic-addon1">
                                                    <i class="fa fa-square c-preview"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 p-0">
                                            <a class="app-default-color" data-target="#gdpr_cnb_bg" data-color="#FFFFFF" href="#">Set Default Color</a>
                                        </div>
                                        <div class="">
                                            <span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("It is the cookie bar background color");?></span>
                                        </div>
                                    </div>
                                    
                                   
                                    <div class="form-group">
                                        <label class="control-label col-md-4 label-required" for="gpbr_bar_ani"><?php _e("Choose Bar Open Animation"); ?></label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="gdpr_bar_ani" name="config[gdpr_bar_ani]">
				                                <?php
					                                $gdpr_ani_op_sel=$gdpr->GetPostValue("gdpr_bar_ani","slideInUp");
					                                GetHTMLOption("","Select");
				                                ?>
                                                <optgroup label="Sliding Entrances" >
		                                            <?php
			                                            GetHTMLOption("slideInUp","slideInUp",$gdpr_ani_op_sel);
			                                            GetHTMLOption("slideInLeft","slideInLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("slideInRight","slideInRight",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>
                                                <optgroup label="Zoom Entrances" >
		                                            <?php
			                                            GetHTMLOption("zoomIn","zoomIn",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomInDown","zoomInDown",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomInLeft","zoomInLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomInRight","zoomInRight",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomInUp","zoomInUp",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>
                                              

                                                <optgroup label="Lightspeed" >
		                                            <?php
			                                            GetHTMLOption("lightSpeedIn","lightSpeedIn",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>

                                                <optgroup label="Rotating Entrances" >
		                                            <?php
			                                            GetHTMLOption("rotateIn","rotateIn",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateInDownLeft","rotateInDownLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateInDownRight","rotateInDownRight",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateInUpLeft","rotateInUpLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateInUpRight","rotateInUpRight",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>
                                               

                                                <optgroup label="Specials" >
		                                            <?php
			                                            GetHTMLOption("rollIn","rollIn",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>
                                            </select>
                                            <span class="form-group-help-block"><?php _e("Choose cookie notification bar out animation");?></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 label-required" for="gpbr_bar_cani"><?php _e("Choose Bar Close Animation"); ?></label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="gdpr_bar_cani" name="config[gdpr_bar_cani]">
				                                <?php
					                                $gdpr_ani_op_sel=$gdpr->GetPostValue("gdpr_bar_cani","slideOutDown");
					                                GetHTMLOption("","Select");
				                                ?>
                                                <optgroup label="Sliding Exits" >
		                                            <?php
			                                            GetHTMLOption("slideOutUp","slideOutUp",$gdpr_ani_op_sel);
			                                            GetHTMLOption("slideOutDown","slideOutDown",$gdpr_ani_op_sel);
			                                            GetHTMLOption("slideOutLeft","slideOutLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("slideOutRight","slideOutRight",$gdpr_ani_op_sel);
		
		                                            ?>
                                                </optgroup>
                                                <optgroup label="Fading Exits" >
		                                            <?php
			                                            GetHTMLOption("fadeOut","fadeOut",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutDown","fadeOutDown",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutDownBig","fadeOutDownBig",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutLeft","fadeOutLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutLeftBig","fadeOutLeftBig",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutRight","fadeOutRight",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutRightBig","fadeOutRightBig",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutUp","fadeOutUp",$gdpr_ani_op_sel);
			                                            GetHTMLOption("fadeOutUpBig","fadeOutUpBig",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>

                                               

                                                <optgroup label="Lightspeed" >
		                                            <?php
			                                          
			                                            GetHTMLOption("lightSpeedOut","lightSpeedOut",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>


                                                <optgroup label="Rotating Exits" >
		                                            <?php
			                                            GetHTMLOption("rotateOut","rotateOut",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateOutDownLeft","rotateOutDownLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateOutDownRight","rotateOutDownRight",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateOutUpLeft","rotateOutUpLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rotateOutUpRight","rotateOutUpRight",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>
                                               
                                                

                                                <optgroup label="Zoom Exits" >
		                                            <?php
			                                            GetHTMLOption("zoomOut","zoomOut",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomOutDown","zoomOutDown",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomOutLeft","zoomOutLeft",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomOutRight","zoomOutRight",$gdpr_ani_op_sel);
			                                            GetHTMLOption("zoomOutUp","zoomOutUp",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>

                                                <optgroup label="Specials" >
		                                            <?php
			                                            GetHTMLOption("hinge","hinge",$gdpr_ani_op_sel);
			                                            GetHTMLOption("rollOut","rollOut",$gdpr_ani_op_sel);
		                                            ?>
                                                </optgroup>

                                            </select>
                                            <span class="form-group-help-block"><?php _e("Choose cookie notification bar out animation");?></span>

                                        </div>
                                    </div>
                                 
                                    <div class="form-group ">
                                        <label class="control-label col-md-4 label-required text-right p-10" for="gpbr_dis_event"><?php _e("Choose Display Event"); ?></label>
                                        <div class="col-md-8">
                                            <div class="inline radio-inline">
				                                <?php
					                                $gdpr_dis_type_selected= $gdpr->GetPostValue("gpbr_dis_event","S");
					                                $gdpr_dis_type_arr=array("S"=>"On Every Session","O"=>"Once in a Browser [Once for long period]");
					                                GetHTMLRadioByArray("Choose Chat Type","config[gpbr_dis_event]","gpbr_dis_event",true,$gdpr_dis_type_arr,$gdpr_dis_type_selected);
				                                ?>
                                            </div>
                                            <span class="form-group-help-block"><?php _e("Choose Display Event");?></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 label-required" for="gpbr_policy_page"><?php _e("Choose Policy Page"); ?></label>
                                        <div class="col-md-4">
                                            <select class="form-control" id="gpbr_privacy" name="config[gpbr_policy_page]" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("Policy Page is required");?>">
				                                <?php
					                                $gdpr_pp_op_sel=$gdpr->GetPostValue("gpbr_policy_page","");
					                                $pageList=Mcustom_page::FindAllByKeyValue("status","A","id","title");
					                                GetHTMLOptionByArray( $pageList, $gdpr_pp_op_sel );
				
				                                ?>
                                            </select>
                                            <span class="form-group-help-block"><?php _e("You can create many page in page menu. Go to Admin Settings > Pages or %s",'<a href="'.admin_url("page").'">'.__("Click Here").'</a>');?></span>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 label-required" for="gdpr_is_popsh"><?php _e("View Policy In POP UP window(Lightbox)"); ?></label>
                                        <div class="col-md-8">
                                            <div class="togglebutton ">
                                                <input  name="config[gdpr_is_popsh]" value="N" type="hidden">
                                                <label>
                                                    <input type="checkbox" <?php echo $gdpr->GetPostValue("gdpr_is_popsh","N")=="Y"?' checked="checked"':'';?>  value="Y"  id="gdpr_is_popsh" name="config[gdpr_is_popsh]" >
                                                </label>
                                                <span class="form-group-help-block"><?php _e("If you enable it, then when visitor click the privacy policy then that will be show in lighbox window");?></span>
                                        </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  label-required col-md-4" for="gdpr_cookie_msg"><?php _e("Cookie Message"); ?></label>
                                        <div class="col-md-12">
                                        <textarea data-no-image="true" style="min-height: 150px;" class="form-control app-html-editor" id="gdpr_cookie_msg" name="config[gdpr_cookie_msg]" placeholder="<?php _e("Cookie Message"); ?>"><?php echo  $gdpr->GetPostValue("gdpr_cookie_msg");?></textarea>
                                        <span class="form-group-help-block"><?php _e("Write %s for Policy Link and %s for only policy URL",'<strong class="text-yellow">{{PolicyLink}}</strong>','<strong class="text-yellow">{{PolicyURL}}</strong>');?></span>
                                        </div>
                                     </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 label-required" for="gdpr_is_agree"><?php _e("Show User Agreement Message on Registration Form"); ?></label>
                                        <div class="col-md-8">
                                            <div class="togglebutton ">
                                                <input  name="config[gdpr_is_agree]" value="N" type="hidden">
                                                <label>
                                                    <input type="checkbox" <?php echo $gdpr->GetPostValue("gdpr_is_agree","N")=="Y"?' checked="checked"':'';?>  value="Y"  id="gdpr_is_agree" name="config[gdpr_is_agree]" >
                                                </label>
                                                <span class="form-group-help-block"><?php _e("If you enable it, then your site user will see %s message in registration form",'<strong>'.__("User Agreement Message").'</strong>');?></span>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label  label-required col-md-4" for="gdpr_agree_message"><?php _e("User Agreement Message"); ?></label>
                                        <div class="col-md-12">
                                            <textarea data-no-image="true" style="min-height: 150px;" class="form-control app-html-editor" id="gdpr_agree_message" name="config[gdpr_agree_message]" placeholder="<?php _e("User Agreement Message"); ?>"><?php echo  $gdpr->GetPostValue("gdpr_agree_message",'By continuing to register, you are accepting the <strong>User Agreement</strong>');?></textarea>
                                            <span class="form-group-help-block"><?php _e("Write %s for Policy Link and %s for only policy URL",'<strong class="text-yellow">{{PolicyLink}}</strong>','<strong class="text-yellow">{{PolicyURL}}</strong>');?></span>
                                        </div>
                                    </div>
                                    
                             
                                </div>
    
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