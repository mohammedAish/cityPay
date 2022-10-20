<style type="text/css">
    .dashboard-messages  {
      height: 412px; 
    }
.no-chat-msg {
    /* position: absolute; */
    text-align: center;
    font-size: 25px;
    color: #dedede;
    /* text-shadow: 0px -1px 0px black; */
}
</style>
<div class="row">
	
	
    <div class="col-md-8"> 
                 
         <form method="post" action="<?php echo admin_url("admin-setting-confirm/modify/m");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Email to Ticket Settings Form");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="form-group">	                	
                			<label class="control-label col-md-4 label-required" for="is_guest_ticket"><?php _e("Enable Email To Ticket/Reply"); ?></label>
                			<div class="col-md-8">
                				<div class="togglebutton ">
                					<input  name="config[is_imap_ticket]" value="N" type="hidden">
                					<label> 
                						<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_imap_ticket","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_guest_ticket"  name="config[is_imap_ticket]" > 
                					</label>
                					<span class="form-group-help-block"><?php _e("Enable to convert email to ticket");?></span>
                				</div>
                				
                		</div>				      	
                	</div> 
                	               	
                	<h4 class="fld-config-is-imap-ticket fld-config-is-imap-ticket-y text-center"><?php _e("IMAP Settings"); ?></h4>
                	<hr class="fld-config-is-imap-ticket fld-config-is-imap-ticket-y m-5" />
                	
                
              <?php /*  IMap Ticket String
                IMap Ticket Reply String
                host
                port
                Is Secure Secure */?>
                <div class="form-group fld-config-is-imap-ticket fld-config-is-imap-ticket-y">
                	<label class="control-label col-md-4  label-required" for="imap_host"><?php _e("Host & Port"); ?></label>
                	<div class="row visible-sm"></div>
                	<div class="col-md-6 col-sm-7"> 
                		<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("imap_host")?>" class="form-control" id="imap_host" name="config[imap_host]" placeholder="<?php _e("Host"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Host"));?>">
                	</div>
                	<div class="col-md-2 col-sm-3 col-xs-5 md-p-l-0">
                		<input type="number" maxlength="10"  value="<?php echo  $mainobj->GetPostValue("imap_port")?>" class="form-control" id="imap_port" name="config[imap_port]" placeholder="<?php _e("Port"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Port"));?>">
                	</div>
                </div>                
                <div class="form-group fld-config-is-imap-ticket fld-config-is-imap-ticket-y">	                	
                		<label class="control-label col-md-4 label-required" for="imap_is_secure"><?php _e("Is Secure Protocol (SSL/TLS)"); ?></label>
                		<div class="col-md-8">
                			<div class="togglebutton ">
                				<input  name="config[imap_is_secure]" value="N" type="hidden">
                				<label> 
                					<input  type="checkbox" <?php echo $mainobj->GetPostValue("imap_is_secure","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="imap_is_secure"  name="config[imap_is_secure]" >
                				</label>
                				<span class="form-group-help-block"><?php _e("Enable it if your protocol is secure");?></span>
                			</div>
                			
                	</div>				      	
                </div>
                <div class="form-group fld-config-imap-is-secure fld-config-imap-is-secure-y">
                    <label class="control-label col-md-4 label-required" for="imap_secure_type"><?php _e("Secure Protocol Type"); ?></label>
                    <div class="col-md-8">
                        <div class="inline radio-inline">
                            <?php
                                $vimap_seq_type = $mainobj->GetPostValue("imap_secure_type","ssl");
                                $vimap_seq_typee_opt=array("ssl"=>"SSL","tls"=>"TLS");
                                GetHTMLRadioByArray("Email Protocol","config[imap_secure_type]","imap_secure_type",true,$vimap_seq_typee_opt,$vimap_seq_type,false,false);
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="form-group fld-config-is-imap-ticket fld-config-is-imap-ticket-y">
                	<label class="control-label col-md-4 label-required" for="imap_user"><?php _e("User (Email)"); ?></label>
                	<div class="col-md-8">                   			     	
                		<input type="text" maxlength="255"  value="<?php echo  $mainobj->GetPostValue("imap_user")?>" class="form-control" id="imap_user" name="config[imap_user]" placeholder="<?php _e("User (Email)"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("User (Email)"));?>">
                	</div>
                </div> 
                <div class="form-group fld-config-is-imap-ticket fld-config-is-imap-ticket-y">
                	<label class="control-label col-md-4 label-required" for="imap_pass"><?php _e("Password"); ?></label>
                	<div class="col-md-8">          
                	   <?php $imap_pass=$mainobj->GetPostValue("imap_pass");
                	   if(!empty($imap_pass)){
                	       $imap_pass="**nopasshackplz**";
                	   }
                	   ?>         			     	
                		<input type="password" maxlength="255"  value="<?php echo  $imap_pass;?>" class="form-control" id="imap_pass" name="config[imap_pass]" placeholder="" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Password"));?>">
                	</div>
                </div>
                 <div class="form-group fld-config-is-imap-ticket fld-config-is-imap-ticket-y">
                	<label class="control-label col-md-4" for="imap_pass"><?php _e("Cron Job Command"); ?></label>
                	<div class="col-md-8">
                    	<div class="input-group"> 
                    	   <div class="form-control bg-disable text-bold"  style="font-size: 12px; min-height: 30px !important;" id="login_g_call_back"  >wget --no-check-certificate --quiet -O /dev/null <?php echo site_url('autoscript/cron/email-to-ticket');?></div>
                    	   <span class="input-group-addon p-5" style="border: 1px solid #ccc;background: #FFF; ">
                    	   <button style="min-height:37px;" class="btn btn-default app-copy-btn m-0" type="button" title="<?php _e("Copy Cron Link") ; ?>" data-clipboard-text="wget --no-check-certificate --quiet -O /dev/null <?php echo site_url('autoscript/cron/email-to-ticket');?>" ><i class="fa fa-copy "></i></button>
                    	   </span>
                    	</div>
                    	<span class="form-group-help-block text-danger"><span class="text-danger text-bold"><i class="fa fa-info-circle faa-pulse animated "></i> <?php _e("Set this cron command into your server cron list, otherwise email to ticket won't work");?></span></span>
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
     <div class="col-md-4 md-p-l-0 fld-config-is-imap-ticket fld-config-is-imap-ticket-y" style="display: none;">                  
        
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("IMAP Help");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 425px;">
                    <h4>What is IMAP?</h4>
                    <p>Internet Message Access Protocol (IMAP) lets you access email stored on a server from multiple devices. 
                    To use IMAP email, you must have an email plan that supports IMAP. 
                    If you have IMAP-enabled Workspace email, you can set it up in pretty much any email client, on whatever computer or device you want.
                    </p>  
                     <h4>IMAP Setting tutorial in cPanel</h4>
                    <iframe width="100%" style="min-height: 220px;" src="https://www.youtube.com/embed/MUbZhKIA7tE?rel=0&amp;start=25&amp;end=222" frameborder="0" allowfullscreen></iframe>                  
                </div>
                <!-- /.box-body -->
         </div>
         <!-- /.box -->
        
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
</script>
