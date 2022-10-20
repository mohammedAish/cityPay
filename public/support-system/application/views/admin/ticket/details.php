<?php
$adminData=GetAdminData(); 
?>
<div class="box box-primary">
	<?php /*?><div class="box-header" style="cursor: move;"></div><!-- /.box-header --><?php // */?>     
     <div class="box-body text-justify app-ticket-dtls">
     <?php 
     echo GetMsg();
     if(!empty($ticketObj)){
     	//$ticketObj=new Mticket();
     	?>
     	<div class="col-md-8 md-r-10 p-l-0 ticket-dtls">
     	
     	<div id="ticket_<?php echo $ticketObj->id;?>" class="panel panel-default app-panel-box m-b-10 ticket-panel">
     	  <div class="panel-heading"><h4 class="m-0"  title="<?php echo $ticketObj->title;?>"><?php echo $ticketObj->title;?></h4></div>
     	  <div class="panel-body text-justify">
     	  	<?php echo $ticketObj->ticket_body;?>
     	  </div>
     	  <?php if(!empty($ticket_files) && is_array($ticket_files)){?>
     	  <div class="panel-footer">
     	   
     	   	<h5 class="m-0 text-bold"><?php _e("File Attached") ; ?></h5>
     	   	<hr class="m-5" />
     	   	<ul class="app-file-list">
     	   	<?php 
     	   	foreach ($ticket_files as $file){
     	   	?>
     	   	<li>	  
     	   	<a class="<?php echo strtolower(substr($file->type, 0,3))=="ima"?"popupimg":"";?>" href="<?php echo base_url("admin/ticket/ticket-img/{$file->hash}/{$ticketObj->ticket_user}/{$ticketObj->id}/{$file->name}");?>" >
     	   	<i class="fa <?php echo $file->class;?>"></i>
     	   	<?php 
     	   		echo substr($file->name, 11)." <em>( {$file->size_str} )</em>";
     	   	?></a>
     	   	</li>
     	   <?php } ?> 	
     	   </ul>	  
     	  </div> 
     	  <?php }?>
     	</div>
     	<?php 
     	//GPrint($ticket_replies);
     	if(count($ticket_replies)>0){
     		foreach ($ticket_replies as $trep){			
     			echo GetTicketReplyHTML($trep); 
     		}
     	}     	
     	?>
     	<div id="new_reply_here"></div>
     	<div class="panel panel-default">     	  
     	  <div class="panel-body">
     	      	<div class="text-success"><?php _e("Current Ticket Status") ; ?> : <span class="ticket-status"><?php echo $ticketObj->getTextByKey("status");?></span></div>
     	  </div>
     	</div>
     	
     	 <?php
     	 $assign_user=Mapp_user::get_user_obj_by($ticketObj->assigned_on);
     	 if(Mticket::hasTicketReplyPermission($ticketObj)){  
     	 if($ticket_user->status!="D" && $ticketObj->status!="C"){
     	     $cannedMessages= Mcanned_msg::get_canned_msgs($ticketObj);
     	 echo form_open ( admin_url("ticket-confirm/ticket-reply/{$ticketObj->id}"),array("class"=>"form app-ajax-form","id"=>"reply_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>
     	<div class="panel panel-default app-panel-box m-b-10">
     	  <div class="panel-heading p-b-5">
     	      <div class="row">
     	      <h5 class="m-0 col-md-6"><?php _e("Reply To Ticket") ; ?></h5>
     	      <div class=" col-md-6 ">
     	      <?php if(count($cannedMessages)>0){?>
    	      <div class="form-group form-group-sm f-content f-hz m-b-0" style="margin-top: -5px;">
		      	<label class="control-label text-no-wrap" style="line-height: 26px;padding-right: 5px;" for="canned_msg"><?php _e("Canned Messages"); ?></label>
		      	<select  style="width: 100%"  class="form-control" id="canned_msg" >
			       <?php 
			       GetHTMLOption("", __("Choose.."));
			       foreach ($cannedMessages as $cmid=>$cm){
			           GetHTMLOption($cmid, $cm->title);
			       }
			       ?>
			        
			    </select>    		      	
		      </div> 
		      <?php }?>
	      </div>
	      </div>
     	  </div>
     	  <div class="panel-body text-justify">	 
     	  	
     		  	<div>	
     		  	<div class="form-group">
     			  	<textarea data-no-image="true" style="min-height: 150px;  padding:5px;" 
     			  	data-bv-stringlength-message=" <?php _e("Text must be less then %d characters length",256); ; ?> " 
     			  	class="form-control app-html-editor" id="ticket_body" name="ticket_body" 
     			  	placeholder="<?php _e("Write here.."); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply text"));?>" ></textarea>
     			  	</div>
     		  	</div> 
     		  	<?php 
     		  	$is_enable_payment=Mticket_payment::has_enable_payment();
     		  	if($is_enable_payment){?>
     		  	<button id="add-payment" class="btn btn-xs btn-danger m-t-5 m-b-15"><i class="fa fa-usd"></i> Add Payment</button>
     		  	<div id="payment-box" class="panel panel-default hidden">
     		  	  <div class="panel-heading  p-t-5 p-b-5"><?php _e("Payment Details"); ?> <button id="remove-payment" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i> Remove</button></div>
     		  	  <div class="panel-body p-t-5 p-b-5">
         		  	  <div class="row" >
         		  	  <input type="hidden" value="Y" name="has_payment"/>
         		  		<div class="col-md-3">
         			  	  <div class="form-group form-group-sm">
         			  	      <label class="control-label label-required" for="amount"><?php _e("Payment Amount"); ?></label>
         			  	     


                              <div class="input-group input-group-sm">
                                  <input type="text" data-bv-between-min="1"  data-bv-between-max="999.99" class="form-control" id="amount" name="amount" placeholder="<?php _e("Payment Amount"); ?>" data-bv-notempty="true" data-bv-between="true" data-bv-between-message="<?php  _e("Amount must be between %.2f and %.2f",1,999.99);?>" data-bv-notempty-message="<?php  _e("%s is required",__("Payment Amount"));?>" >
                                  <div class="input-group-addon has-select-input">
                                      <select name="payment_currency">
                                          <?php
                                          $currencies=trim(Mapp_setting::GetSettingsValue("payment_currencies","USD"));
                                          $currencies=explode(",",$currencies);
                                          $currencies=AddOnManager::DoFilter("payment-currencies",$currencies);
                                          foreach ($currencies as $currency) {
                                              GetHTMLOption($currency,$currency);
                                          }
                                          ?>
                                      </select>
                                  </div><!-- /btn-group -->
                              </div><!-- /input-group -->
         			  	     
         			  	   </div>
         			  	   </div>
         			  	   <div class="col-md-9 md-p-l-0">
         			      <div class="form-group form-group-sm">
         			          <label class="control-label label-required" for="payment_des"><?php _e("Description"); ?></label>
         			          <input type="text" class="form-control" id="payment_des" name="payment_des" placeholder="<?php _e("Description"); ?>" data-bv-notempty="true"
         			      												data-bv-notempty-message="<?php  _e("%s is required",__("Description"));?>">
         			       </div>
         			    </div> 	
     		  	</div>
     		  	  </div>
     		  	</div>
     		  	
     		  	<?php }?>
     		  	<?php  
     		  	  $filesizeinmb=Mapp_setting::GetSettingsValue("max_file_upload_size",1);
     		      $is_ticket_file_upload=Mapp_setting::GetSettingsValue('allow_ticket_file_upload','N')=="Y";
     		      if($is_ticket_file_upload){
     		      	$file_extensions=Mapp_setting::GetSettingsValue('allowed_file_type');
     		      if(!empty($file_extensions)){
     		      	$file_extensions=".".str_replace("|", ",.", $file_extensions);
     		      }?>
     		  	<div  class="form-group m-b-0">
     		           <label for="upload_files"><?php _e("Attach File"); ?></label>
     		        </div>
     		        
     		       <div id="main_file_btn" class="form-group app-file-main-container">
     		       	<div class="panel panel-default m-b-5">
     		       		<div class="panel-body app-file-upload-container">
     			       		<div class="row">
     			       			<div class="col-md-7 col-sm-6 col-xs-9 app-file-input-conteiner">
     			       				<?php echo get_file_upload_button("upload_files[]",$file_extensions,"upload_files","app-ticket-file");?>
     			           			<span class="form-group-help-block"><?php _e("Max file size is %s MB",$filesizeinmb);?></span>
     			           			<button type="button" class="btn btn-xs btn-danger app-btn-file-reset hidden"><i class="fa fa-trash-o"></i> <?php _e("Remove") ; ?></button>
     			       			</div>
     			       			<div class="col-md-5 col-sm-6 col-xs-3">
     			       			   <div class="row file-preview-img hidden">			          
     					           	<div class="u-file-dtls col-sm-8 hidden-xs">					           		
     					           		<dl class="dl-horizontal">
     									  <dt><?php _e("File Type") ; ?></dt>
     									  <dd><span class="u-file-type"></span></dd>
     									  <dt><?php _e("File Type") ; ?></dt>
     									  <dd><span class="u-file-size"></span></dd>
     									</dl>
     					           	</div>
     					           	<div class="u-file-preview col-sm-4 col-xs-12 text-right">
     					           	  <i class="fa fa-file-o pull-right"></i>
     					              <img  class="img-responsive pull-right" src="" alt="" />
     					           	</div>
     					           </div>
     			       			</div>
     			       		
     			       		</div>
     			       
     			        
     		       		</div>
     		       	</div>
     		           
     		           
     		        </div>
     		      
     		       
     		       	<button data-target="main_file_btn" data-clone-inc="true" class="add-cloner-button btn btn-xs btn-info m-t-5 m-b-15 "><i class="fa fa-plus-circle"></i> Add Another File</button>
     		       	<?php }?>
     		       	
     		  	<?php if($ticketObj->is_public=="Y"){?>
     		  	<div class="row" >
     		  		<div class="col-md-6 form-horizontal">
     			  		<div class="form-group form-group-sm">
     			      	<label class="control-label col-md-4" style="line-height: 31px;" for="status"><?php _e("Private Reply"); ?></label>
     			      	<div class="col-md-7">                   			     	
     			      		<div class="togglebutton ">
     						    	<input  name="is_private" value="N" type="hidden">
     								<label> 
     									<input  type="checkbox" <?php echo PostValue("is_private","Y")=="Y"?' checked="checked"':'';?> value="Y" class="" id="is_private"  name="is_private" > 
     								</label>
     								<span class="form-group-help-block"><?php _e("To make this reply private");?></span>
     							</div>
     			      	</div>
     			      </div> 
     		  		</div>		  		
     		  		
     		  	</div>
     	  		<?php }?>
     		  	
     		  	<div class="row" >
     		  		<div class="col-md-6 form-horizontal">
     		  		<div class="form-group form-group-sm">
     		      	<label class="control-label col-md-4" for="status"><?php _e("Set Status"); ?></label>
     		      	<div class="col-md-7">                   			     	
     		      		<select    class="form-control" id="status"  name="status">
     			        <?php //$ticketObj=new Mticket();		
     			        	GetHTMLOption("", __("Leave as Current"));
     			        	$selected=$ticketObj->status=="N"?"P":"";
     			        	$status_list=$ticketObj->GetPropertyOptions("status");
     			        	$skip=['N','R'];     			        
 			        	    foreach ($skip as $key){
 			        	        if(isset($status_list[$key])){
 			        	            unset($status_list[$key]);
 			        	        }
 			        	    }
     			            GetHTMLOptionByArray($status_list,$selected);
     			            ?>
     			        
     			        </select>
     		      	</div>
     		      </div> 
     		  		</div>
     		  		<div class="col-md-6"><button type="submit" class="btn btn-success btn-block btn-sm"> <?php _e("Reply") ; ?></button></div>
     		  		
     		  	</div>
     	  	
     	  </div>
     	</div>
     	<?php echo form_close();
     	 }elseif($ticket_user->status=="D"){
     	     ?>
             <div class="panel panel-default">
               <div class="panel-body text-center text-bold">
                   <div class="text-danger"><?php _e("Ticket user has been data deleted") ; ?></div>
               </div>
             </div>
            
             <?php
         }else{
     	?>
     	<div id="re-open" class="panel panel-default app-panel-box m-b-10 <?php echo $ticketObj->status=="C"?"":"hidden";?>">	  
     	  <div class="panel-body text-center bg-danger"> 
     	  	<?php _e("Ticket closed do you want to re-open?") ; ?> <a href="<?php echo admin_url("ticket/re-open/{$ticketObj->id}");?>" class="btn btn-xs btn-info"><i class="fa fa-ticket"></i> <?php _e("Re-Open") ; ?></a>
     	  </div>
     	</div>	
     	<?php }
     	 }else {?>
     	<div class="panel panel-default app-panel-box m-b-10 reply-protect-container">	  
     	  <div class="panel-body text-center bg-danger"> 
     	  	 <?php if(!empty($ticketObj->assigned_on) &&  $adminData->id !=$ticketObj->assigned_on){     	   
         	      $asuser=$assign_user?(get_grid_user_img($assign_user->title.(($adminData && $adminData->id ==$ticketObj->assigned_on)?" (You) ":""),$assign_user->img_url,$assign_user->id,"A",true,"text-bold")):$ticketObj->assigned_on;     	   
         	     _e("The ticket has been assigned to : %s. You can not reply on this ticket",$asuser);     	     
         	     
         	 }else{
         	     _e("You can't reply on this ticket");
         	 }?>
     	  </div>
     	</div>
         	 
     	 <?php }?> 
     	</div>
     	<div class="col-md-4 md-p-0 ticket-dtls">
     	<div class="panel panel-default app-panel-box">
     	  <div class="panel-heading"><h4 class="m-0"><?php _e("Ticket Information") ; ?></h4></div>
     	  <div class="panel-body p-0"  style="margin-top: -1px;">
     	   <table class="table m-b-0">	   
     		<tr>
     			<th style="width: 122px; "><?php _e("Ticket Track ID") ; ?></th>
     			<th style="width: 10px; ">:</th>
     			<td><?php echo $ticketObj->ticket_track_id;?></td>
     			
     			
     		</tr>
     		<tr>
     			<th><?php _e("Ticket User") ; ?></th>
     			<th>:</th>
     			<td>
     			    			<?php 
     			if($ticket_user->first_name){
     				echo get_grid_user_img($ticket_user->first_name." ".$ticket_user->last_name,$ticket_user->photo_url,$ticket_user->id,$ticket_user->user_type,true);     				
     			}?>
     			<a data-effect="mfp-move-from-top" class="popupformWR btn btn-xs btn-info pull-right" href=" <?php echo site_url ("admin/client/profile/".$ticket_user->id);?>"> 
     			<i class="fa fa-eye"></i> <?php _e("Details") ; ?>
     			</a>
     			</td>
     			
     		</tr>
               <?php
               
               $userCustomFlds=Msite_user_custom_field::FindAllBy("user_id",$ticket_user->id);
               if(count($userCustomFlds)>0){
                   foreach ($userCustomFlds as $uf){
                       ?>
               <tr>
                   <th><?php echo $uf->fld_title; ?></th>
                   <th>:</th>
                   <td>
	                   <?php echo $uf->fld_value_text; ?>
                   </td>

               </tr>
               <?php
                   }
               }
               ?>
     		<tr>
     			<th><?php _e("Ticket Email") ; ?></th>
     			<th>:</th>
     			<td>
     			
     			<?php 
     			if(!empty($ticket_user->email)){
     				echo $ticket_user->email;     				
     			}else{
     			  echo "-";  
                }?>     			
     			</td>
     			
     		</tr>
               <?php if(Mapp_setting::GetSettingsValue("is_priority_ad_hide","N")!="Y"){?>
     		<tr>
     			<th><?php _e("Ticket Priority") ; ?></th>
     			<th>:</th>
     			<td><?php echo getTextByKey($ticketObj->priroty,$ticketObj->GetPropertyOptionsTag("priroty"));?></td>
     			
     		</tr>
               <?php } ?>
     		<tr>
     			<th ><?php _e("Ticket Category") ; ?></th>
     			<th>:</th>
     			<td class="abs-c h-c"><?php echo Mcategory::getParentStr($ticketObj->cat_id);
     			if(ACL::HasPermission ( "admin/ticket/change-category" )){
     			?>
     			<div class="abs-r-t m-t-5 m-r-5 ">
     			<a href="<?php echo admin_url("ticket/change-category/{$ticketObj->id}");?>" data-on-complete="ReloadSiteUrl"  class="popupformWR btn btn-xs btn-success h-el"><i class="fa fa-refresh"></i> <?php _e("Change"); ?></a>
     			</div>
     			<?php }?>
     			</td>
     		</tr>			
     		
     		<tr>
     			
     			<th ><?php _e("Assigned On") ; ?></th>
     			<th >:</th>
     			<td id="assign-container" class="abs-c"><?php 
     			if(!empty($ticketObj->assigned_on)){
     				
     				//$assign_user=Mapp_user::get_user_obj_by($ticketObj->assigned_on);
     				if($assign_user){
     				    $assign_user_url=Mapp_user::get_user_image_url($assign_user->id);     				    
     					echo get_grid_user_img($assign_user->title.(($adminData && $adminData->id ==$ticketObj->assigned_on)?" (You) ":""),$assign_user_url,$assign_user->id,"A",true);
     				}else{
     					echo $ticketObj->assigned_on;
     				}
     			}
     			 if(Mticket::hasTicketAssignPermission($ticketObj)){
     				?>
     				<div class="abs-r-t m-t-5 m-r-5">
     				<a href="<?php echo admin_url("ticket/set-assign/{$ticketObj->id}");?>" data-on-complete="ReloadSiteUrl"  class="popupformWR btn btn-xs btn-success"><i class="fa fa-plus-circle"></i> <?php echo !empty($ticketObj->assigned_on)?__("Change"):__("Set Assign") ; ?></a>
     				<?php if($adminData && $adminData->id !=$ticketObj->assigned_on){?>
     				<a href="<?php echo admin_url("ticket-confirm/assign-me/{$ticketObj->id}");?>" data-msg="<?php _e("Are you sure to assign?") ; ?>" data-on-complete="AssignMe" class="ConfirmAjaxWR btn btn-xs btn-success"><i class="fa fa-user-circle"></i> <?php _e("Assign Me") ; ?></a>
     				<?php }?>
     			    </div>
     			 <?php }?>
     			</td>
     		</tr>
     		<tr>
     			
     			<th ><?php _e("Opened Time") ; ?></th>
     			<th >:</th>
     			<td><?php echo get_user_datetime_default_format($ticketObj->opened_time);?></td>
     		</tr>
     		<tr>
     			
     			<th ><?php _e("Status") ; ?></th>
     			<th >:</th>
     			<td><span class="ticket-status"><?php echo getTextByKey($ticketObj->status,$ticketObj->GetPropertyOptionsTag("status"));;?></span></td>
     		</tr>	
     		<?php /*?>
     		<tr>
     			<td colspan="3" >-</td>
     		</tr>
     		<?php */?>
     		
     	</table>	
     	  </div>
     	</div>
         <div class="panel panel-success app-panel-box">
             <div class="panel-heading bg-green"><h4 class="m-0"><i class="fa fa-sticky-note"></i>  <?php _e("Admin Notes") ; ?>
                 <a data-onclose="note_added" href="<?php echo admin_url("admin-note/add/{$ticketObj->ticket_user}/{$ticketObj->id}") ?>" data-effect="mfp-move-from-top" class="popupformWR btn btn-xs bg-white pull-right"><i class="fa fa-plus-circle"></i> <?php _e("Add Note") ; ?></a>

                 </h4>

             </div>
             <div id="admin-note" class="panel-body p-0" style="margin-top: -1px;">
                 <?php $notes=getAdminNotes($ticketObj->ticket_user,$ticketObj->id);
                 if(!empty($notes)) {
                     echo $notes;
                 }else{
                 ?>
                    <p class="p-10 text-center text-red"><?php _e("No note founds") ; ?></p>
                 <?php } ?>
             </div>
         </div>
         <div class="panel panel-success app-panel-box">
             <div class="panel-heading bg-green"><h4 class="m-0"><i class="fa fa-clock-o"></i>  <?php _e("Admin Work Log") ; ?>
                     <a data-onclose="wnote_added" href="<?php echo admin_url("work-log/add/{$ticketObj->id}") ?>" data-effect="mfp-move-from-top" class="popupformWR btn btn-xs bg-white pull-right"><i class="fa fa-plus-circle"></i> <?php _e("Add Note") ; ?></a>

                 </h4>

             </div>
             <div id="wadmin-note" class="panel-body p-0" style="margin-top: -1px;">
			     <?php $notes=getAdminWorkLog($ticketObj->id);
				     if(!empty($notes)) {
					     echo $notes;
				     }else{
					     ?>
                         <p class="p-10 text-center text-red"><?php _e("No work log founds") ; ?></p>
				     <?php } ?>
             </div>
         </div>
     	<?php if(count($custom_fields)>0){?>
     	
     		<div class="panel panel-default app-panel-box">
     		  	<div class="panel-heading"><h4 class="m-0"><?php _e("Ticket Other's Info") ; ?></h4></div>
     		  	<div class="panel-body p-0" style="margin-top: -1px;">
     		  
     		  	<table class="table m-b-0">	 
     		  	<?php foreach ($custom_fields as $custom_fld){?>  
     			<tr>
     				<th style="width: 122px; "><?php echo $custom_fld->fld_title;?></th>
     				<th style="width: 10px; ">:</th>
     				<td><?php echo $custom_fld->fld_value_text;
     				if($custom_fld->is_api_based=="Y"){?>
     					<a href="<?php echo site_url("ticket/field_details/{$ticketObj->id}/{$custom_fld->id}");?>" class="popupform btn btn-xs btn-info"><i class="fa fa-eye"></i> <?php _e("View Details") ; ?></a>
     				<?php }
     				?>
     				
     				</td>
     			</tr>
     			<?php }?>
     			</table>
     		  	</div>
     	  	</div>
     	
     	<?php }?>
     	<?php if(count($ticket_logs)>0){?>
     	
     		<div class="panel panel-default app-panel-box">
     		  	<div class="panel-heading"><h4 class="m-0"><?php _e("Ticket History") ; ?></h4></div>
     		  	<div class="panel-body p-0" style="margin-top: -1px;">
     		  
     		  	 <ul id="app-ticket-log" class="kn-list">
     		  	<?php foreach ($ticket_logs as $ticket_log){
     		  		$ticket_log=empty($ticket_log)?new Mticket_log():$ticket_log;
     		  		$admindata=GetAdminData();
     		  		$log_user_name="";
     		  		if($admindata && $admindata->id==$ticket_log->log_by){
     		  			$log_user_name=$admindata->title." (You)";     		  			
     		  		}elseif($ticket_log->log_by_type=="U"){
     		  			if($ticket_user->id==$ticket_log->log_by){     		  				
     		  				$log_user_name=$ticket_user->first_name." ".$ticket_user->last_name;
     		  			}else{
     		  				$log_user_name="Other user need to work later";
     		  			}
     		  		}else{
                        if($ticket_log->log_by=="SYS"){
                            //$log_user_name=__("SYSTEM");
                        }else{
                            $log_user_name=Mapp_user::get_user_obj_by($ticket_log->log_by)->title;
                        }
     		  			
                }
     		    
     				echo GetTicketLog($ticket_log,$log_user_name);
     			}?>
     			</ul>
     		  	</div>
     	  	</div>
     	</div>
     	<?php }?>
     	  
     	
     	<?php 
     	
     }else{
     	?>
     	
     	<?php 
     }
     ?>
     
     <script type="text/javascript">
     var cannedMsg=<?php echo json_encode($cannedMessages);?>;
      function AssignMe(rdata){
    	  swal.close();
    	  ShowWait(true,"Reloading",function(){
    		  
    		  ReloadSiteUrl();
        });
    	 
      }		      
      function resetFile(obj){
         	  var parentBodyElem=obj.closest(".app-file-upload-container");
     	  		var previewWindowElem=parentBodyElem.find(".file-preview-img");
     	  		previewWindowElem.addClass("hidden");
     	  		parentBodyElem.find("input[type=file]").val("");
     	  		obj.addClass("hidden");
      }
      function resetFormFile(){
     	 $(".app-file-upload-container").find(".file-preview-img").addClass("hidden");
     	 $(".app-file-upload-container").find(".app-btn-file-reset").addClass("hidden");
     	 $(".app-file-upload-container input").val("");
     	 $(".app-file-main-container:not(#main_file_btn) .panel").fadeOut("fast",function(){
     		 $(this).remove();
     	  });
      }
      function on_beforesend(form){	 
     	   form.find(">.panel").addClass("state-loading");
     	   //console.log(form);
     }  
     function on_complete(rdata,form){
     	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
     	   form.find(">.panel").removeClass("state-loading");
     	   if(rdata.status){
     		   $("#new_reply_here").before(rdata.data.reply);
     		   $("#app-ticket-log").prepend(rdata.data.log);
     		   _popupajaxLoadComplted();
     		   if(rdata.data.current_status=="C"){
     			   $("#reply_form").fadeOut("fast",function(e){
     				   $(this).remove();
     				   $("#re-open").removeClass("hidden");
     			   });			  
     		   }
     		   try{
      			  $(".ticket-status").html(rdata.data.current_status_str);  
     		   }catch(e){}
     		  
     		   try{
     			   $('#ticket_body').summernote('reset');
     		   }catch(e){}
     
     		   $('#reply_form')[0].reset();
      		   
     		   resetFormFile();
      		  HidePaymentBox();
     	   }
     }
     function HidePaymentBox(){
         try{
    	 $("#payment-box").addClass("hidden").find("input").prop("disabled",true);
    	 $("#add-payment").removeClass("hidden");
         }catch(e){}
     }
     function setCannedMsg(){
         var id= $("#canned_msg").val();
         try{
        	 //console.log(cannedMsg[id].canned_msg); 
        	 set_edittor_text("ticket_body",cannedMsg[id].canned_msg);
         }catch(e){
             gcl(e);
         }
     }
     function note_added() {
         CallMyAjax("<?php echo admin_url("admin-note/get-notes/{$ticketObj->ticket_user}/{$ticketObj->id}"); ?>", {}, function(){}, function(data) {
             $("#admin-note").html(data);

         },false);
     }
     function wnote_added() {
         CallMyAjax("<?php echo admin_url("work-log/get-notes/{$ticketObj->id}"); ?>", {}, function(){}, function(data) {
             $("#wadmin-note").html(data);

         },false);
     }
     $(function(){	
    	 AddOnCloseMethod(ReloadSiteUrl);
    	 AddMethodOnNewNotification(gotNewNotification);
     	$('body').on("click",".app-btn-file-reset",function(e){
     		e.preventDefault();
     		$(this).closest(".app-file-main-container").fadeOut('fast',function(){
     			$(this).remove();
     		});
     		
     	});
     	$('body').on("click",".app-btn-file-reset-2",function(e){
     		e.preventDefault();
     		$(this).closest(".panel").fadeOut('fast',function(){
     			$(this).remove();
     		});
     		
     	});
     	HidePaymentBox();
     	$("#add-payment").on("click",function(e){
         	e.preventDefault();
         	$("#payment-box").removeClass("hidden").find("input").prop("disabled",false);
         	$("#add-payment").addClass("hidden");
         });
        $("#remove-payment").on("click",function(e){
         	e.preventDefault();
         	HidePaymentBox();
         });
        try{
         $("#canned_msg").on("change",function(e){
            try{
            	setCannedMsg(); 
            }catch(e){}
             
       	  });
        }catch(e){}
     	$("body").on("change",".app-ticket-file", function() {
     		
     			var parentBodyElem=$(this).closest(".app-file-upload-container");
     			var resetInput=parentBodyElem.find(".app-btn-file-reset");
     			var previewWindowElem=parentBodyElem.find(".file-preview-img");
     			var fileTypeElem=previewWindowElem.find(".u-file-type");
     			var fileSizeElem=previewWindowElem.find(".u-file-size");
     			var fileIconElem=previewWindowElem.find(".u-file-preview > i");
     			var fileImgElem=previewWindowElem.find(".u-file-preview > img");
     			
     		  //this.files[0].size gets the size of your file. u-file-dtls>u-file-type+u-file-size, 
     		  <?php 
     		  
     		  $filesizeinbyte=2048;
     		  if($filesizeinmb){
     		  	$filesizeinbyte=$filesizeinmb*1048576;
     		  }
     		  ?>		 
     		 var maxfilezone=<?php echo $filesizeinbyte;?>;
     		 var fileExtension=this.files[0].name.substr(-4);
     		 var fileAccepts=$(this).attr("accept");
     		var isExtensionOk=fileAccepts.indexOf(fileExtension)!=-1;
     		 if(maxfilezone<this.files[0].size){
     			 $(this).val("");
     			 resetFile(resetInput);
     			 ShowGritterMsg("<?php _e("Max file size is  %s MB",$filesizeinmb) ;?>",false,false,"Large File Error",'times-circle-o');	
     		 }else if(!isExtensionOk){
     			 $(this).val("");
     			 resetFile(resetInput);
     			 ShowGritterMsg("<?php _e("Uploaded file is not  supported") ;?>",false,false,"File Error",'times-circle-o');
     		 }else{
     			 var isImg=this.files[0].type.substr(0,3).toLowerCase();					
     			 if(isImg=="ima"){					 			
     			 	var fr=new FileReader();
     				// when image is loaded, set the src of the image where you want to display it
     				fr.onload = function(e) {		
     					fileIconElem.addClass("hidden")			
     					fileImgElem.attr("src",this.result);
     					fileImgElem.removeClass("hidden");
     					previewWindowElem.removeClass("hidden");					
     				};
     				fr.readAsDataURL(this.files[0]);
     			 }else{
     				 fileImgElem.addClass("hidden");
     				previewWindowElem.removeClass("hidden");	
     				fileIconElem.removeClass("hidden");				
     				
     			 }
     			
     			 var type=typeTitle=this.files[0].type;			
     			 if(type=="application/x-zip-compressed"){
     				 typeTitle=type="Zip File"				 
     				 fileIconElem.attr("class","fa fa-file-zip-o pull-right");
     				 fileIconElem.css("color","#fbb847");
     			 }else if(type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||type=="application/msword"){
     				 typeTitle=type="Word File"				 
     				 fileIconElem.attr("class","fa fa-file-word-o pull-right");
     				 fileIconElem.css("color","#2C5990");
     			 }else if(type=="application/pdf"){
     				 typeTitle=type="PDF File"				 
     				 fileIconElem.attr("class","fa fa-file-pdf-o pull-right");
     				 fileIconElem.css("color","#E42101");
     			 }else{
     				 if(type.length>20){
     					 type=type.substr(0,17)+"...";
     				 }
     				 fileIconElem.attr("class","fa fa-file-o pull-right").css("color","#CCCCCC");;
     			 }
     			fileTypeElem.text(type).attr("title",typeTitle);;
     			fileSizeElem.text(((this.files[0].size/(1024*1024)).toFixed(2))+" MB");	
     			resetInput.removeClass("hidden");
     		 }
     		  
     	});
     	
     });

     function gotNewNotification(rdata){
         if($("#ticket_"+rdata.ticket_id).length>0){
             reloadReply(rdata.ticket_id);
             return true;
         }
         return false;
     }
     function reloadReply(ticket_id){
         var ticketdlts=$(".ticket-dtls");
         var ticketLogdlts=$("#app-ticket-log");
         //$("#new_reply_here").before(rdata.data.reply);
         var previous_elem=null;
         CallMyAjax("<?php echo base_url("admin/ticket/load-ticket-reply/") ?>"+ticket_id, {}, function(){
             //before send
         }, function(rdata){
             //success
             if(rdata.status){
                 for(var i in rdata.data){
                     if(ticketdlts.find("#"+rdata.data[i].id).length==0){
                        if(previous_elem!=null){
                            previous_elem.after(rdata.data[i].html);
                        }else{
                            previous_elem=$(rdata.data[i].html);
                            $("#new_reply_here").before(previous_elem);
                        }
                     }else{
                         previous_elem=ticketdlts.find("#"+rdata.data[i].id);
                     }
                 }
                 for(var i in rdata.tlog){
                     if(ticketLogdlts.find("#"+rdata.tlog[i].id).length==0){
                         ticketLogdlts.prepend(rdata.tlog[i].html);
                     }
                 }
             }

         });
     }
     </script>
     
     </div><!-- /.box-body -->
    <?php /*?> <div class="box-footer clearfix no-border"></div><?php // */?> 
</div>
