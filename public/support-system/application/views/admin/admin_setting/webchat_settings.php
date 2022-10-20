<?php
$webmainobj=new Mapp_settings_api_advance();
$webmainobj->SetAPIName("webchat");
?>
<form id="app-fbc-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-webchat/e");?>" data-beforesend="on_beforesend" enctype="multipart/form-data" data-on-complete="on_complete" data-multipart="true" class="form app-ajax-form form-horizontal">
  	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="ap ap-chat3 a-c" style="font-size: 21px;vertical-align: -4px;"></i> <?php _e("Chat Settings");?></h3>
                 <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                
                <div class="row">
        	      	<div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-4 label-required" for="wc_is_active"><?php _e("Enable"); ?></label>
                            <div class="col-md-8">
                                <div class="togglebutton ">
                                    <input  name="config[wc_is_active]" value="N" type="hidden">
                                    <label>
                                        <input type="checkbox" <?php echo $webmainobj->GetPostValue("wc_is_active","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="wc_is_active" name="config[wc_is_active]" >
                                    </label>
                                    <span class="form-group-help-block"><?php _e("To enable chat");?></span>
                                </div>

                            </div>
                        </div>
                        <div class="fld-config-wc-is-active fld-config-wc-is-active-y">
                            <div class="form-group ">
                                <label class="control-label col-md-4 label-required text-right p-10" for="app_theme"><?php _e("Choose Chat Type"); ?></label>
                                <div class="col-md-8">
                                    <div class="inline radio-inline">
                                        <?php
                                        $app_webchat_type_selected= $webmainobj->GetPostValue("app_chat_type","client2");
                                        $app_webchat_type=array("B"=>"Default Chat","F"=>"Facebook Chat");
                                        GetHTMLRadioByArray("Choose Chat Type","config[app_chat_type]","app_chat_type",true,$app_webchat_type,$app_webchat_type_selected,false,false,"has_depend_fld");
                                        ?>
                                    </div>
                                    <span class="form-group-help-block"><?php _e("Choose Chat Type");?></span>
                                </div>
                            </div>
                            <hr class="m-t-0 m-b-10" />
                            <div class="default-chat fld-config-app-chat-type fld-config-app-chat-type-b hidden text-center">
                                <h4 class="text-green"><i class="fa animated fa-exclamation-triangle faa-pulse"></i> <?php _e("Please read it first") ; ?></h4>
                                <span class="text-yellow"><?php _e("To see all settings effect on site, please logout admin user or try with other browser. If admin logged in then you won't see the chat button") ; ?></span>
                                <hr class="m-t-10 m-b-10" />
                            </div>
                            <div class="fld-config-app-chat-type fld-config-app-chat-type-f hidden">
                               <div class="col-md-8">
                                   <div class="form-group ">
                                       <label class="control-label col-md-4 label-required" for="page_id"><?php _e("Facebook Page ID"); ?></label>
                                       <div class="col-md-8">
                                           <input type="text" maxlength="255"  value="<?php echo  $webmainobj->GetPostValue("fb_page_id")?>" class="form-control" id="fb_page_id" name="config[fb_page_id]" placeholder="<?php _e("Facebook Page ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Facebook Page ID"));?>">
                                       </div>
                                   </div>

                                   <div class="app-alert alert alert-warning">
                                       <i class="fa fa-exclamation-triangle faa-pulse animated"></i> <?php _e("N B. If you select Facebook Chat then you have to reply form Facebook Page Manager App or from Facebook. You can't reply from this app") ; ?>
                                   </div>

                               </div>
                                <div class="col-md-4 md-p-l-0">
                                    <label for=""><?php _e("Your Domain URL") ; ?></label>
                                    <div class="text-bold"><?php echo base_url() ; ?></div>
                                    <div class="help-block text-italic"><?php _e("Please put this into your facebook page settings") ; ?></div>
                                    <div class="help-block text-italic m-t-10">
                                        **<?php _e("If you don't know how you will configure the Facebook Page settings then ") ; ?>
                                        <a target="_blank" href="http://appsbd.com/etc/supportapp/fbchatsettings.php"><?php _e("click here") ; ?></a>
                                    </div>
                                </div>

                            </div>
                            <div class="pro-chat fld-config-app-chat-type fld-config-app-chat-type-p hidden">
                                <div class="text-center">
                                    <h1 class="text-green"><i class="fa animated fa-exclamation-triangle faa-pulse"></i> Pro version is coming soon.</h1>
                                    <p>Please wait some more days. It will have many professional features of chat</p>
                                    <p>Please choose <strong> Default Chat</strong> until pro version release</p>
                                </div>
                                <hr class="m-t-0 m-b-10" />
                            </div>

                            <div class="fld-config-app-chat-type fld-config-app-chat-type-b fld-config-app-chat-type-p hidden">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group ">
                                            <label class="control-label col-md-6 label-required" for="app_chat_title"><?php _e("Chat Title"); ?></label>
                                            <div class="col-md-6">
                                                <input type="text" maxlength="50"  value="<?php echo  $webmainobj->GetPostValue("app_chat_title",get_app_title())?>" class="form-control" id="app_chat_title" name="config[app_chat_title]" placeholder="<?php _e("Chat title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Chat title"));?>">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label col-md-6 label-required" for="app_chat_tagline"><?php _e("Chat Tag Line"); ?></label>
                                            <div class="col-md-6">
                                                <input type="text" maxlength="100"  value="<?php echo  $webmainobj->GetPostValue("app_chat_tagline",get_app_title())?>" class="form-control" id="app_chat_tagline" name="config[app_chat_tagline]" placeholder="<?php _e("Chat Tag Line"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Chat tag line"));?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <?php
                                                $chatLogo=Mchat::getChatLogoUrl();
                                                ?>
                                                <img class="app-image-input img-thumbnail pull-left m-r-10" data-name="app_chat_logo" src="<?php echo $chatLogo;?>" style="height: 75px;"/>
                                                <span class="form-group-help-block"><?php _e("Chat Logo"); ?><br/><?php _e("Click on the Image to change. Best size is 75px x 75px");?></span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="chat_header_color"><?php _e("Chat Window Header Color"); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">

                                            <input type="text" maxlength="7"  value="<?php echo  $webmainobj->GetPostValue("chat_header_color","#000")?>" class="form-control app-color-picker" id="chat_header_color" name="config[chat_header_color]" placeholder="<?php _e("Main Color"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Chat Header color"));?>">
                                            <span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <a class="app-default-color" data-target="#chat_header_color" data-color="#000" href="#">Set Default Color</a>
                                    </div>
                                    <div class="">
                                        <span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("Chat window Header.");?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="chat_main_color"><?php _e("Chat Button Color"); ?></label>
                                    <div class="col-md-4">
                                        <div class="input-group">

                                            <input type="text" maxlength="7"  value="<?php echo  $webmainobj->GetPostValue("chat_main_color","#0b8ec2")?>" class="form-control app-color-picker" id="chat_main_color" name="config[chat_main_color]" placeholder="<?php _e("Main Color"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Chat main color"));?>">
                                            <span class="input-group-addon" id="basic-addon1">
                				<i class="fa fa-square c-preview"></i>
                			</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 p-0">
                                        <a class="app-default-color" data-target="#chat_main_color" data-color="#32b9f0" href="#">Set Default Color</a>
                                    </div>
                                    <div class="">
                                        <span class="form-group-help-block col-md-8 col-md-offset-4"><?php _e("Main color of chat window.");?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required text-right p-10" for="chat_bg_pattern"><?php _e("Chat Background Pattern"); ?></label>
                                    <div class="col-md-8">
                                        <div class="">
                                            <?php
                                            $app_chat_pattern_selected= $webmainobj->GetPostValue("chat_bg_pattern","chat-bg5.png");
                                            $app_chatpattern_op=array("chat-bg5.png"=>'<img src="'.base_url('plugins/apsbd-chat/img/chat-bg5.png').'"/>',"chat-bg6.png"=>'<img src="'.base_url('plugins/apsbd-chat/img/chat-bg6.png').'"/>',
                                                "chat-bg7.png"=>'<img src="'.base_url('plugins/apsbd-chat/img/chat-bg7.png').'"/>',
                                                "chat-bg8.png"=>'<img src="'.base_url('plugins/apsbd-chat/img/chat-bg8.png').'"/>',
                                                "chat-bg9.png"=>'<img src="'.base_url('plugins/apsbd-chat/img/chat-bg9.png').'"/>',
                                                "chat-bg10.png"=>'<img src="'.base_url('plugins/apsbd-chat/img/chat-bg10.png').'"/>',
                                            );
                                            GetHTMLRadioBoxByArray("Choose HTML Editor","config[chat_bg_pattern]","chat_bg_pattern",true,$app_chatpattern_op,$app_chat_pattern_selected,false,"#e8fffd",'bg-green');
                                            ?>
                                        </div>
                                        <span class="form-group-help-block"><?php _e("It will display in chat window");?></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required text-right p-10" for="chat_btn_icon"><?php _e("Chat Button Icon"); ?></label>
                                    <div class="col-md-8">
                                        <div class="">
                                            <?php
                                            $app_chatbtn_pattern_selected= $webmainobj->GetPostValue("chat_btn_icon","ap ap-chat2");
                                            $app_chatbtnpattern_op=[
                                                "ap ap-comment"=>'<i class="ap ap-comment" ></i>',
                                                "ap ap-chat2"=>'<i class="ap ap-chat2" ></i>',
                                                "ap ap-chat3"=>'<i class="ap ap-chat3" ></i>'
                                            ];
                                            GetHTMLRadioBoxByArray("Choose chat button icon","config[chat_btn_icon]","chat_btn_icon",true,$app_chatbtnpattern_op,$app_chatbtn_pattern_selected,false);
                                            ?>
                                        </div>
                                        <span class="form-group-help-block"><?php _e("Choose chat button icon");?></span>
                                    </div>
                                </div>
                                <hr class="m-t-0 m-b-10" />
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="max_chat_per_user"><?php _e("Max. Chat Per Agent %s",'<small>('.__('simultaneously').')</small>'); ?></label>
                                    <div class="col-md-2">
                                        <input type="number" maxlength="2" value="<?php echo  $webmainobj->GetPostValue("max_chat_per_user",5)?>" class="form-control" id="max_chat_per_user" name="config[max_chat_per_user]" placeholder="<?php _e("ex. 5"); ?>" data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Max chat count"));?>">

                                    </div>
                                    <span class="form-group-help-block"><?php _e("It set a limit,how many chat per agent(Admin User) can take  simultaneously");?></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="open_text"><?php _e("Chat Opening Text"); ?></label>
                                    <div class="col-md-8">
                                        <textarea  class="form-control" id="open_text" name="config[open_text]" placeholder="Write here.." data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Open Text"));?>"><?php echo  $webmainobj->GetPostValue("open_text",'Welcome to our chat system.if you want to start chat with our agent then please click the button bellow.');?></textarea>
                                        <span class="form-group-help-block"><?php _e("It will show when a user want to start chat");?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="offline_text"><?php _e("Offline Text"); ?></label>
                                    <div class="col-md-8">
                                        <textarea  class="form-control" id="offline_text" name="config[offline_text]" placeholder="Write here.." data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Offline text"));?>"><?php echo  $webmainobj->GetPostValue("offline_text",'We are offline now.')?></textarea>
                                        <span class="form-group-help-block"><?php _e("It will show when all user are offline");?></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="agent_welcome_text"><?php _e("Agent Welcome Text"); ?></label>
                                    <div class="col-md-8">
                                        <textarea  class="form-control" id="agent_welcome_text" name="config[agent_welcome_text]" placeholder="Write here.." data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("agent_welcome_text"));?>"><?php echo  $webmainobj->GetPostValue("agent_welcome_text","Welcome to our chat session.\nI am {{agent_name}},  how may I help you sir?")?></textarea>
                                        <span class="form-group-help-block"><?php _e("It will show when a agent start a chat session.");?><?php _e("You can use some property which is given bellow:") ; ?><br/> <strong class="text-yellow" >{{agent_name}}</strong></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="queue_text"><?php _e("Queue Text"); ?></label>
                                    <div class="col-md-8">
                                        <textarea  class="form-control" id="queue_text" name="config[queue_text]" placeholder="Write here.." data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Queue text"));?>"><?php echo  $webmainobj->GetPostValue("queue_text","You are currently number {{your_position}} in the queue.\nThank you for your patience!")?></textarea>
                                        <span class="form-group-help-block"><?php _e("It will show when all user busy,");?> <?php _e("You can use some property which is given bellow:") ; ?><br/> <strong class="text-yellow">{{total_queue}}, {{your_position}}</strong></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 label-required" for="chat_closing_text"><?php _e("Closing Text"); ?></label>
                                    <div class="col-md-8">
                                        <textarea  class="form-control" id="chat_closing_text" name="config[chat_closing_text]" placeholder="Write here.." data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Chat closing text"));?>"><?php echo  $webmainobj->GetPostValue("chat_closing_text","The chat has been closed by our agent ({{agent_name}})\nThanks");?></textarea>
                                        <span class="form-group-help-block"><?php _e("It will show when all agent close the chat,");?> <?php _e("You can use some property which is given bellow:") ; ?><br/> <strong class="text-yellow">{{agent_name}}</strong></span>
                                    </div>
                                </div>
                                <div class="form-group no-feedback">
                                    <label class="control-label col-md-4 label-required" for="chat_closing_text"><?php _e("Chat Auto Close Interval"); ?></small></label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-5 ">
                                                <div class="input-group">
                                                    <input style="" type="number" class="form-control" id="chat_closing_int" value="<?php echo  $webmainobj->GetPostValue("chat_closing_int",30);?>" name="config[chat_closing_int]" placeholder="" data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Chat closing interval"));?>">
                                                    <span class="input-group-addon" id="basic-addon1">MIN Inactive</span>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <span class="form-group-help-block"><?php _e("Chat will be closed which is inactive for entered value. Enter 0 to disable auto close") ; ?></span>
                                       
                                    </div>
                                    
                                    
                                </div>
                                <?php	                               
                                    if(function_exists('apache_get_modules') && !in_array("mod_headers",apache_get_modules())){
                                       ?>
                                       <div class="alert alert-danger">
                                           <?php _e("apache module mod_headers is not enabled, may be other site chat won't work, Please enable it") ; ?>
                                       </div>
                                       <?php 
                                    }
                                ?>
                                <div class="form-group no-feedback">
                                    <label class="control-label col-md-4 label-required" for="chat_allowed_domains"><?php _e("Allowed Domains"); ?></small></label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <textarea class="form-control" id="chat_allowed_domains" name="config[chat_allowed_domains]"><?php echo  $webmainobj->GetPostValue("chat_allowed_domains",'');?></textarea>
                                            </div>
                                        </div>
                                        <span class="form-group-help-block"><?php _e("separated by comma(,) example : example.com,example2.com") ; ?></span>

                                    </div>


                                </div>
                                <div class="form-group no-feedback">
                                    <label class="control-label col-md-4 label-required" for="chat_allowed_domains"><?php _e("Site Script"); ?></small></label>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                            
<pre><?php echo trim(htmlentities('<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = \''.base_url('app-assets/chat_js').'\';
    fjs.parentNode.insertBefore(js, fjs);
}(document, \'script\', \'best-support-system-chat\'));
</script>')); ?>
                                                </pre>
                                            </div>
                                        </div>
                                        <span class="form-group-help-block"><?php _e("separated by comma(,) example : example.com,example2.com") ; ?></span>

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