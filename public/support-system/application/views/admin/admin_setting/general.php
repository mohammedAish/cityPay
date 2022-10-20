<div class="col-md-12">
    <div class="row app-vertical-tab-container">
        <div class="col-md-2 col-sm-3 p-0 text-left">
            <a href="#" class="nav-tabs-dropdown btn btn-block btn-primary">Tabs</a>
            <ul id="nav-tabs-wrapper" class="app-v-tab-menu nav nav-tabs nav-pills nav-stacked well p-0">
              <?php if(ACL::HasPermission("admin/admin-setting/general")){?>
              <li class="active"><a href="#vtab1" data-toggle="tab"><i class="fa fa-gear"></i><?php _e("Basic Settings");?></a></li>             
              <li><a href="#vtab2" data-toggle="tab"><i class="fa fa-bullseye"></i><?php _e("Captcha");?></a></li>

               <?php }?> 
               
              <?php if(ACL::HasPermission("admin/admin-setting/theme")){?>
              <li><a href="#vtab12" data-toggle="tab"><i class="fa ap ap-theme"></i> <?php _e("Theme");?></a></li>
              <?php }?>
              <li><a href="#vtab3" data-toggle="tab"><i class="fa fa-paint-brush"></i><?php _e("Layout & Color");?></a></li>

              <?php if(ACL::HasPermission("admin/admin-setting/general")){?>
              <li><a href="#vtab4" data-toggle="tab"><i class="fa fa-upload"></i><?php _e("File Upload");?></a></li> 
              <li><a href="#vtab5" data-toggle="tab"><i class="fa fa-ticket"></i><?php _e("Ticket");?></a></li>  
              <?php }?>
              <?php if(ACL::HasPermission("admin/admin-setting/notification")){?>
              <li><a href="#vtab6" data-toggle="tab"><i class="fa fa-bell"></i> <?php _e("Notification");?></a></li> 
              <?php }?>
              <?php if(ACL::HasPermission("admin/admin-setting/security")){?>
              <li><a href="#vtab7" data-toggle="tab"><i class="fa ap ap-shield"></i><?php _e("Security Settings");?></a></li> 
               <?php }?> 
             <?php if(ACL::HasPermission("admin/admin-setting/email-out-settings")){?>
              <li><a href="#vtab8" data-toggle="tab"><i class="fa fa fa-envelope"></i><?php _e("Email Settings");?></a></li>    
             <?php }?> 
             <?php if(ACL::HasPermission("admin/admin-setting/imap")){?>      
              <li><a href="#vtab9" data-toggle="tab"><i class="fa ap ap-email-ticket"></i> <?php _e("Email to Ticket");?></a></li>
              <?php }?>
                <?php if(ACL::HasPermission("admin/admin-setting/webchat-settings")){?>
                    <li><a href="#vtab_webchat" data-toggle="tab"><i class="fa ap ap-chat3"></i> <?php _e("Chat Settings");?></a></li>
                <?php }?>

            <?php if(ACL::HasPermission("admin/admin-setting/ganalytics")){?>
                <li><a href="#vtab_ganlytics" data-toggle="tab"><i class="fa ap" style="">&#xe927;</i> <?php _e("Google Analytics");?></a></li>
            <?php }?>
              <?php if(ACL::HasPermission("admin/admin-setting/general")){?>
              <li>
              <a href="#vtab10" data-toggle="tab"><i class="fa fa-css3"></i><?php _e("Custom %s",'<small class="">(CSS & JavaScript)</small>');?>
              
              </a>
              </li>
              <li><a href="#vtab11" data-toggle="tab"><i class="fa fa-star-o"></i><?php _e("Welcome & Footer Text");?></a></li>
              <li><a href="#gdpr" data-toggle="tab"><i class="fa ap ap-gdpr"></i><?php _e("GDPR Settings");?></a></li>
              
              <?php }?>
            </ul>
        </div>
        <div class="col-md-10 col-sm-9">       
            <div class="tab-content">
               <?php if(ACL::HasPermission("admin/admin-setting/general")){?>
                <div role="tabpanel" class="tab-pane fade in active" id="vtab1">
                    <?php $this->load->view("admin/admin_setting/basic_settings");?>                   
                </div>
                <div role="tabpanel" class="tab-pane fade" id="vtab2">
                    <?php $this->load->view("admin/admin_setting/captcha_settings");?>                      
                </div>

                <?php }?>
                <?php if(ACL::HasPermission("admin/admin-setting/theme")){?> 
                <div role="tabpanel" class="tab-pane fade in" id="vtab12">
                <?php $this->load->view("admin/admin_setting/theme");?>
                </div> 
                <?php }?>
                <div role="tabpanel" class="tab-pane fade in" id="vtab3">
                    <?php $this->load->view("admin/admin_setting/layout_settings");?>
                </div>
                <?php if(ACL::HasPermission("admin/admin-setting/general")){?>                  
                <div role="tabpanel" class="tab-pane fade in" id="vtab4">
                <?php $this->load->view("admin/admin_setting/file_settings");?>    
                </div> 
                <div role="tabpanel" class="tab-pane fade in" id="vtab5">
                <?php $this->load->view("admin/admin_setting/ticket_settings");?>    
                </div> 
                <?php }?>
               <?php if(ACL::HasPermission("admin/admin-setting/notification")){?> 
               <div role="tabpanel" class="tab-pane fade in" id="vtab6">
                <?php $this->load->view("admin/admin_setting/notification");?>                   
                </div> 
                <?php }?>
                <?php if(ACL::HasPermission("admin/admin-setting/security")){?>  
                <div role="tabpanel" class="tab-pane fade in" id="vtab7">
                <?php $this->load->view("admin/admin_setting/security");?>                   
                </div> 
                <?php }?>                
                <?php if(ACL::HasPermission("admin/admin-setting/email-out-settings")){?>  
                <div role="tabpanel" class="tab-pane fade in" id="vtab8">
                <?php $this->load->view("admin/admin_setting/email_out_settings");?>                   
                </div> 
                <?php }?>
                
                 <?php if(ACL::HasPermission("admin/admin-setting/imap")){?>   
                <div role="tabpanel" class="tab-pane fade in" id="vtab9">
                <?php $this->load->view("admin/admin_setting/imap");?>                   
                </div> 
                <?php }?>  
                <?php if(ACL::HasPermission("admin/admin-setting/general")){?> 
                <div role="tabpanel" class="tab-pane fade in" id="vtab10">
                <?php $this->load->view("admin/admin_setting/custom_css_settings");?>                   
                </div> 
                 <div role="tabpanel" class="tab-pane fade in" id="vtab11">
                <?php $this->load->view("admin/admin_setting/welcome_footer_settings");?>                   
                </div>  
                <?php }?>
                <?php if(ACL::HasPermission("admin/admin-setting/webchat-settings")){?>
                    <div role="tabpanel" class="tab-pane fade in" id="vtab_webchat">
                        <?php $this->load->view("admin/admin_setting/webchat_settings");?>
                    </div>
                <?php } ?>
                <?php if(ACL::HasPermission("admin/admin-setting/ganalytics")){?>
                    <div role="tabpanel" class="tab-pane fade in" id="vtab_ganlytics">
			            <?php $this->load->view("admin/admin_setting/ganalytics");?>
                    </div>
	            <?php } ?>
	            <?php if(ACL::HasPermission("admin/admin-setting/general")){?>
                    <div role="tabpanel" class="tab-pane fade in" id="gdpr">
			            <?php $this->load->view("admin/admin_setting/gdpr");?>
                    </div>
	            <?php } ?>
            </div>
             <div class="row"> </div>
        </div>        
     </div>      
</div>
<div class="row"> </div> 
<script type="text/javascript">
   function on_beforesend(form){	 
	   form.find(">.box").addClass("state-loading");
   }  
   function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.box").removeClass("state-loading");
	   if(rdata.status && form.attr("id")=="app_basic_form"){
		  var title=$("#app_title").val();
		  var titlearray=title.split(' ');
		  var str="";
		  for(var i in titlearray){
			  if(i==0){
			  	str +="<b>"+titlearray[i]+"</b>";
			  }else{
				 str +=" "+titlearray[i];
			  }
		  }
		  $(".logo-lg").html(str);
		  if(rdata.data.is_need_reload){
			  ShowWait(true,rdata.data.is_need_msg);
			  setTimeout(ReloadSiteUrl,1000);	
			  			  
		  }
	  }else if(rdata.status && form.attr("id")=="app-color-form"){
		  if($("#app_c_auto").is(':checked')){
			  try{
			  	$("#app_navbar_bg").val(rdata.data.app_navbar_bg).trigger("input");
			  	$("#app_nav_acive_text").val(rdata.data.app_nav_acive_text).trigger("input");
			  	$("#footer_bg_color").val(rdata.data.footer_bg_color).trigger("input");
			  	$("#footer_text_color").val(rdata.data.footer_text_color).trigger("input");
			  }catch(e){
				  gcl(e.message);
			  }
		  }
	  }
   } 
   function on_complete_color(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.box").removeClass("state-loading");
	   
	  
   }  
   
   function setCaptchaAction(){
	   	var selectedAction=$("input.app-captcha-input:checked").val();
	   	selectedAction=selectedAction.toLowerCase();
	   var hiddenFlields=$(".action-fld:not(."+selectedAction+"-action)");
	   //console.log(hiddenFlields);
	   hiddenFlields.fadeOut('fast',function(){
		   hiddenFlields.find("input,select").prop("disabled",true);
		   var activeFlields=$(".action-fld."+selectedAction+"-action");
		   activeFlields.fadeIn();
		   activeFlields.find("input,select").prop("disabled",false);
	   });		  	      	
   	   $("#captcha-submit-btn").prop("disabled",false);                       
   }
   function setAutoColorSettings(){	 
	   var selectedAction=$("#app_c_auto").is(':checked')?"yes":"no";
	   $("#color-submit-btn").prop("disabled",false);		   
	   var hiddenFlields=$(".auto-color-fld:not(."+selectedAction+"-action)");	 
	   if(hiddenFlields.length>0) {
		   hiddenFlields.fadeOut('fast',function(){
			   hiddenFlields.find("input,select").prop("disabled",true);
			   showAutocolorFlds(selectedAction);
		   });	
	   }else{
		   showAutocolorFlds(selectedAction);
	   }	
	   
   }
   function showAutocolorFlds(selectedAction){
	   var activeFlields=$(".auto-color-fld."+selectedAction+"-action");	   
	   activeFlields.fadeIn();
	   activeFlields.find("input,select").prop("disabled",false);	
   }
   function showBetaMsg(){
	   var opt=$("#app_lang option:selected");
	   isBeta=opt.data("is-beta");
	   if(isBeta){
		   $("#beta-msg").removeClass("hidden");
	   }else{
		   $("#beta-msg").addClass("hidden");
	   }
   }
   $(function(){
	   setCaptchaAction();
	   $("input.app-captcha-input").on("change",function(){
		   setCaptchaAction();		   
		});
	   setAutoColorSettings();
	   $("#app_c_auto").on("change",function(e){		  
		   setAutoColorSettings();
	   });
       <?php if(!ISDEMOMODE){?>
	   $("#app_lang").on("change",function(e){
		   showBetaMsg();
		});
	   <?php } ?>
		/*$("#app_header_bg").on("input",function(){
				if($(this).val()==""){
					$(this).val("#ffffff");
				}
			});
		*/
		//console.log("Test");
		
	});          
</script>
