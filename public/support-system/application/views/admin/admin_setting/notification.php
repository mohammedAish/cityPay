<div class="row">
	<div class="col-md-6">	         
	      <?php  echo form_open ( admin_url("admin-setting-confirm/modify-notification/e"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>   
	       <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-envelope"></i> <?php _e("Email Notification Settings");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                <div class="form-group">
                			<div class="col-md-12 text-center">
                            <h4><i class="fa text-yellow fa-exclamation-triangle faa-pulse animated"></i> <?php _e("Based on ticket assigning rule") ; ?></h4>
                                <a target="_blank" href="<?php echo admin_url("ticket-assign-rule"); ?>"><?php _e("Click here") ; ?></a> <?php _e("to view the ticket assigning rule") ; ?>
                        </div>
                	</div> 
                	 <hr class="m-t-0 m-b-5" />
                 <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_netkt_open"><?php _e("On Ticket Open"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_netkt_open]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_netkt_open","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_netkt_open"  name="config[is_netkt_open]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then admin will get notification on ticket open");?></span>
							</div>
							
				      	</div>				      	
			       </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_aetkt_open"><?php _e("On Ticket Assign"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_aetkt_open]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_aetkt_open","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_aetkt_open"  name="config[is_aetkt_open]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable this then assigned user will get notification on ticket assigning");?></span>
                            </div>

                        </div>
                    </div>
			      <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_netktu_reply"><?php _e("On Ticket User Reply"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_netktu_reply]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_netktu_reply","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_netktu_reply"  name="config[is_netktu_reply]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then admin will get notification on ticket user reply");?></span>
							</div>
							
				      	</div>				      	
			       </div>
			       <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_netkta_reply"><?php _e("On Admin/staff Reply"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_netkta_reply]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_netkta_reply","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_netkta_reply"  name="config[is_netkta_reply]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then admin will get notification on ticket open");?></span>
							</div>
							
				      	</div>				      	
			       </div>                     		
			                	  	
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                 <div class="row">                    
                    <div class="col-sm-12 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
                </div>
                </div>
                <!-- /.footer -->
         	</div>
         	
         <!-- /.box -->
        <?php echo form_close()?>
	</div>  
	
	<div class="col-md-6 md-p-l-0">	         
	      <?php  echo form_open ( admin_url("admin-setting-confirm/modify-notification/s"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>   
	       <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-desktop"></i> <?php _e("On Screeen Notification Settings");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	  
                <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_nstone"><?php _e("Enable Tone (Sound)"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_nstone]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_nstone","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_nstone"  name="config[is_nstone]" > 
								</label>
								<span class="form-group-help-block"><?php _e("Admin will hear tone on notification if enabled");?></span>
							</div>
							
				      	</div>				      	
			       </div> 
			       <hr class="m-0" />            
                 <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_nstkt_open"><?php _e("On Ticket Open"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_nstkt_open]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_nstkt_open","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_nstkt_open"  name="config[is_nstkt_open]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then admin will get notification on ticket open");?></span>
							</div>
							
				      	</div>				      	
			       </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_astkt_open"><?php _e("On Ticket Assign"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_astkt_open]" value="N" type="hidden">
                                <label>
                                    <input  type="checkbox" <?php echo $mainobj->GetPostValue("is_astkt_open","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_astkt_open"  name="config[is_astkt_open]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("If you enable this then assigned user will get notification on ticket assigning");?></span>
                            </div>

                        </div>
                    </div>
			      <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_nstktu_reply"><?php _e("On Ticket User Reply"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_nstktu_reply]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_nstktu_reply","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_nstktu_reply"  name="config[is_nstktu_reply]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then admin will get notification on ticket user reply");?></span>
							</div>
							
				      	</div>				      	
			       </div>
			       <div class="form-group">	                	
				      	<label class="control-label col-md-4 label-required" for="is_nstkta_reply"><?php _e("On Admin/staff Reply"); ?></label>
				      	<div class="col-md-8">
					     	<div class="togglebutton ">
						    	<input  name="config[is_nstkta_reply]" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_nstkta_reply","N")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_nstkta_reply"  name="config[is_nstkta_reply]" > 
								</label>
								<span class="form-group-help-block"><?php _e("If you enable this then admin will get notification on ticket open");?></span>
							</div>
							
				      	</div>				      	
			       </div>                     		
			                	  	
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                 <div class="row">                    
                    <div class="col-sm-12 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
                </div>
                </div>
                <!-- /.footer -->
         	</div>
         	
         <!-- /.box -->
        <?php echo form_close()?>
	</div>  
	<div class="row"></div>
	<?php /*?>
	<div class="col-md-6">	         
	         
	       <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-desktop"></i> <?php echo ("Firebase Notification");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">	 
                    <?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on"){?>              
                       Cooming Soon        
                       <?php }else{?>
                       Firebase notification need ssl certification on your server. You server doesn't have any ssl.
                       Please install ssl. The cheapest ssl found in ...
                       <?php }?> 		
			                	  	
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                 <div class="row">                    
                    
                </div>
                </div>
                <!-- /.footer -->
         	</div>
         	
         <!-- /.box -->

	</div> 
	 <?php */?>
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
