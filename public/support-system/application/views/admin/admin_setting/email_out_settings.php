<div class="row">
	
	
    <div class="col-md-8"> 
                 
         <form method="post" action="<?php echo admin_url("admin-setting-confirm/modify/s");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Email Settings");?></h3>    
                  <div class="box-tools pull-right">
                   <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>                      
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required"  for="out_email_name"><?php _e("From Name"); ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" maxlength="255" value="<?php echo  $mainobj->GetPostValue("out_email_name")?>" id="email_out_name" name="config[out_email_name]" placeholder="<?php _e("From Name") ; ?>" data-bv-notempty="true"data-bv-notempty-message="<?php  _e("%s is required",__("From Name"));?>">
                    	</div>
                     </div>
                     <div class="form-group">
                         <label class="control-label col-md-4 label-required" for="out_email_from"><?php _e("From Email"); ?></label>
                         <div class="col-md-8">
                            <input type="text" class="form-control" value="<?php echo  $mainobj->GetPostValue("out_email_from")?>"  
                            id="out_email_from" name="config[out_email_from]" maxlength="255" placeholder="<?php _e("From Name") ; ?>" data-bv-notempty="true"	data-bv-notempty-message="<?php  _e("%s is required",__("From Name"));?>">
                         </div>
                      </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="out_reply_to_email"><?php _e("Reply To Email"); ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" value="<?php echo  $mainobj->GetPostValue("out_reply_to_email")?>"
                                   id="out_email_from" name="config[out_reply_to_email]" maxlength="255" placeholder="<?php _e("Keep blank if you don't want to use") ; ?>">
                        </div>
                    </div>
                      
                     
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="out_email_protocol"><?php _e("Enable Email To Ticket/Reply"); ?></label>
                			<div class="col-md-8">
                				<div class="inline radio-inline">
				  			<?php
				  				$vap_dc_str_type = $mainobj->GetPostValue("out_email_protocol","sendmail");
				  				$vap_dc_str_type_opt=array("sendmail"=>"Sendmail","smtp"=>"SMTP");
				  				GetHTMLRadioByArray("Email Protocol","config[out_email_protocol]","out_email_protocol",true,$vap_dc_str_type_opt,$vap_dc_str_type,false,false,"has_depend_fld");
				  			?>
				  		 </div> 
                				
                		</div>				      	
                	</div> 
                	<hr class="m-5" />               	
                	             
                <div class="fld-config-out-email-protocol fld-config-out-email-protocol-sendmail hidden">
                    <div class="form-group ">
                    	<label class="control-label col-md-4 label-required" for="mailpath"><?php _e("Sendmail Path"); ?></label>
                    	<div class="col-md-8">                   			     	
                    		<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("mailpath")?>" class="form-control" id="mailpath" name="config[mailpath]" placeholder="<?php _e("Sendmail Path"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Sendmail Path"));?>">
                    	</div>
                    </div>
                </div>	
                
                <div class="fld-config-out-email-protocol fld-config-out-email-protocol-smtp hidden">
                  <h4 class="text-center">
                	 <?php _e("SMTP Settings"); ?>                	   
                	</h4>  
                    <div class="form-group">
                    	<label class="control-label col-md-4  label-required" for="smtp_host"><?php _e("Host & Port"); ?></label>
                    	<div class="row visible-sm"></div>
                    	<div class="col-md-6 col-sm-7"> 
                    		<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("smtp_host")?>" class="form-control" id="smtp_host" name="config[smtp_host]" placeholder="<?php _e("Host"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Host"));?>">
                    	</div>
                    	<div class="col-md-2 col-sm-3 col-xs-5 md-p-l-0">
                    		<input type="number" maxlength="10"  value="<?php echo  $mainobj->GetPostValue("smtp_port")?>" class="form-control" id="smtp_port" name="config[smtp_port]" placeholder="<?php _e("Port"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Port"));?>">
                    	</div>
                    </div>                
                    <div class="form-group">	                	
                    		<label class="control-label col-md-4 label-required" for="smtp_is_secure"><?php _e("Is Secure Protocol (SSL)"); ?></label>
                    		<div class="col-md-8">
                    			<div class="togglebutton ">
                    				<input  name="config[smtp_is_secure]" value="N" type="hidden">
                    				<label> 
                    					<input  type="checkbox" <?php echo $mainobj->GetPostValue("smtp_is_secure","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="smtp_is_secure"  name="config[smtp_is_secure]" >
                    				</label>
                    				<span class="form-group-help-block"><?php _e("Enable it if your protocol is secure");?></span>
                    			</div>
                    			
                    	</div>				      	
                    </div>
                    <div class="form-group fld-config-smtp-is-secure fld-config-smtp-is-secure-y">
                        <label class="control-label col-md-4 label-required" for="smtp_secure_type"><?php _e("Secure Protocol Type"); ?></label>
                        <div class="col-md-8">
                            <div class="inline radio-inline">
	                        <?php
		                        $vap_seq_type = $mainobj->GetPostValue("smtp_secure_type","ssl");
		                        $vap_seq_typee_opt=array("ssl"=>"SSL","tls"=>"TLS");
		                        GetHTMLRadioByArray("Email Protocol","config[smtp_secure_type]","smtp_secure_type",true,$vap_seq_typee_opt,$vap_seq_type,false,false);
	                        ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label class="control-label col-md-4 label-required" for="smtp_user"><?php _e("User (Email)"); ?></label>
                    	<div class="col-md-8">                   			     	
                    		<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("smtp_user")?>" class="form-control" id="smtp_user" name="config[smtp_user]" placeholder="<?php _e("User (Email)"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User (Email)"));?>">
                    	</div>
                    </div> 
                    <div class="form-group">
                    	<label class="control-label col-md-4 label-required" for="smtp_pass"><?php _e("Password"); ?></label>
                    	<div class="col-md-8">          
                    	   <?php $smtp_pass=$mainobj->GetPostValue("smtp_pass");
                    	   if(!empty($smtp_pass)){
                    	       $smtp_pass="**nopasshackplz**";
                    	   }
                    	   ?>         			     	
                    		<input type="password" maxlength="255"  value="<?php echo  $smtp_pass;?>" class="form-control" id="smtp_pass" name="config[smtp_pass]" placeholder="" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
                    	</div>
                    </div>
                 
                </div>	                 
                                	
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-right">
                  <button id="captcha-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button>
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
   function on_complete_color(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.box").removeClass("state-loading");
	  
   }  
   
 
  
   $(function(){
	  
	});          
</script>
