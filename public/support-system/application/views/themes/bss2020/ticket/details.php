<?php 
echo GetMsg();
if(!empty($ticketObj)){
	//$ticketObj=new Mticket();
	?>
    <div class="row">
        <div class="col-sm-8 pr-sm-0 ticket-dtls">

            <div class="card card-default app-card-box mb-3 ticket-panel">
                <div class="card-header"><h4 class="m-0"  title="<?php echo $ticketObj->title;?>"><?php echo $ticketObj->title;?></h4></div>
                <div class="card-body text-justify app-ticket-dtls">
				    <?php echo $ticketObj->ticket_body;?>
                </div>
			    <?php if(!empty($ticket_files) && is_array($ticket_files)){?>
                    <div class="card-footer of-hidden">

                        <h5 class="m-0 text-bold"><?php _e("File Attached") ; ?></h5>
                        <hr class="m-5" />
                        <ul class="app-file-list">
						    <?php
							    foreach ($ticket_files as $file){
								    ?>
                                    <li class="t-of-ellipsis">
                                        <a class="<?php echo strtolower(substr($file->type, 0,3))=="ima"?"popupimg":"";?>" href="<?php echo base_url("ticket/ticket-img/{$file->hash}/{$ticketObj->ticket_user}/{$ticketObj->id}/{$file->name}");?>" >
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
		    <?php if(count($ticket_replies)>0){
			    foreach ($ticket_replies as $trep){
				    echo GetTicketReplyHTML2020($trep);
			    }
		    }?>
            <div id="new_reply_here mb-3"></div>
            <div class="card card-default mb-3">
                <div class="card-body">
                    <div class="text-success"><?php _e("Current Ticket Status") ; ?> : <span class="ticket-status"><?php echo $ticketObj->getTextByKey("status");?></span></div>
                </div>
            </div>
		    <?php
			    if($ticketObj->status!="C"){
				    echo form_open ( site_url("ticket-confirm/ticket-reply/{$ticketObj->id}"),array("class"=>"form app-ajax-form","id"=>"reply_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>
                    <div class="card card-default app-card-box m-b-10">
                        <div class="card-header"><h5 class="m-0"><?php _e("Reply To Ticket") ; ?></h5></div>
                        <div class="card-body text-justify">

                            <div>
                                <div class="form-group">
			  	<textarea data-no-image="true" style="min-height: 80px;  padding:5px;"
                          data-bv-stringlength-message=" <?php _e("Text must be less then %d characters length",256); ; ?> "
                          class="form-control app-html-editor" id="ticket_body" name="ticket_body"
                          placeholder="<?php _e("Write here.."); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply text"));?>" ></textarea>
                                </div>
                            </div>
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
                                        <div class="card card-default m-b-5">
                                            <div class="card-body app-file-upload-container">
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
                                                                    <dt><?php _e("File Size") ; ?></dt>
                                                                    <dd><span class="u-file-size"></span></dd>
                                                                </dl>
                                                            </div>
                                                            <div class="u-file-preview col-sm-4 col-xs-12 text-right">
                                                                <i class="fa fa-file-o float-right"></i>
                                                                <img  class="img-responsive float-right" src="" alt="" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>


                                    </div>


                                    <button data-target="main_file_btn" data-clone-inc="true" class="add-cloner-button btn btn-xs btn-info m-t-5 m-b-15 "><i class="fa fa-plus-circle"></i> <?php _e("Add Another File");?></button>
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

                            <div class="row mt-3" >
                                <div class="col-md-6 form-horizontal">
                                    <div class="form-group row ">
                                        <label class="control-label col-md-4" for="status"><?php _e("Set Status"); ?></label>
                                        <div class="col-md-7">
                                            <select    class="form-control form-control-sm" id="status"  name="status">
											    <?php //$ticketObj=new Mticket();
												    GetHTMLOption("", __("Leave as Current"));
												    $status_list=$ticketObj->GetPropertyOptions("status");
												    $skip=['N','R','A','P'];
												    foreach ($skip as $key){
													    if(isset($status_list[$key])){
														    unset($status_list[$key]);
													    }
												    }
												    GetHTMLOptionByArray($status_list);
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
			    }
		    ?>
            <div id="re-open" class="card card-default app-card-box m-b-10 <?php echo $ticketObj->status=="C"?"":"hidden";?>">
                <div class="card-body text-center bg-danger">
				    <?php if(Mticket::UserCanReopen($ticketObj)){  _e("Ticket closed do you want to re-open?");?> <a href="<?php echo site_url("ticket/re-open/{$ticketObj->id}");?>" class="btn btn-xs btn-info"><i class="fa fa-ticket"></i> <?php _e("Re-Open") ; ?></a><?php }else{
					    _e("Ticket has been closed");
				    } ?>
                </div>
            </div>

        </div>
        <div class="col-md-4  ticket-dtls">
            <div class="card  card-default app-card-box mb-3">
                <div class="card-header"><h4 class="m-0"><?php _e("Ticket Information") ; ?></h4></div>
                <div class="card-body p-0"  style="margin-top: -1px;">
                    <table class="table mb-0">
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

                            </td>

                        </tr>
                        <?php if(Mapp_setting::GetSettingsValue("is_priority_hide","N")!="Y"){?>
                        <tr>
                            <th><?php _e("Ticket Priority") ; ?></th>
                            <th>:</th>
                            <td><?php echo getTextByKey($ticketObj->priroty,$ticketObj->GetPropertyOptionsTag("priroty"));?></td>

                        </tr>
                        <?php } ?>
                        <tr>
                            <th ><?php _e("Ticket Category") ; ?></th>
                            <th>:</th>
                            <td><?php echo Mcategory::getParentStr($ticketObj->cat_id);?></td>
                        </tr>

                        <tr>

                            <th ><?php _e("Assigned On") ; ?></th>
                            <th >:</th>
                            <td id="assign-container" class="abs-c">
							    <?php
								    if(!empty($ticketObj->assigned_on)){
									
									    $assign_user=Mapp_user::get_user_obj_by($ticketObj->assigned_on);
									    if($assign_user){
										    echo get_grid_user_img($assign_user->title,$assign_user->img_url,$assign_user->id,"A",true);
									    }else{
										    echo $ticketObj->assigned_on;
									    }
								    }
							    ?>

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
                    </table>
                </div>
            </div>
		
		    <?php if(count($custom_fields)>0){?>

                <div class="card card-default app-card-box">
                    <div class="card-header"><h4 class="m-0"><?php _e("Ticket Other's Info") ; ?></h4></div>
                    <div class="card-body p-0" style="margin-top: -1px;">

                        <table class="table mb-0">
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
		    <?php if(count($ticket_logs)>1){?>

            <div class="card card-default app-card-box mb-3">
                <div class="card-header"><h4 class="m-0"><?php _e("Ticket History") ; ?></h4></div>
                <div class="card-body p-0" style="margin-top: -1px;">

                    <ul id="app-ticket-log" class="kn-list">
					    <?php foreach ($ticket_logs as $ticket_log){
						    $ticket_log=empty($ticket_log)?new Mticket_log():$ticket_log;
						    $log_user_name="";
						    if($ticket_log->log_by_type=="U"){
							    if($ticket_user->id==$ticket_log->log_by){
								
								    $log_user_name=$ticket_user->first_name." ".$ticket_user->last_name." (You)";
							    }else{
								    $log_user_name="Other user need to work later";
							    }
						    }else{
							    $log_user_name=Mapp_user::get_user_obj_by($ticket_log->log_by)->title;
						    }
						
						    echo GetTicketLog($ticket_log,$log_user_name);
					    }?>
                    </ul>
                </div>
            </div>
        </div>
	    <?php }?>

    </div>
	
	
	<?php 
	
}else{
	?>
	
	<?php 
}
?>

<script type="text/javascript">
		      
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
	 $(".app-file-main-container:not(#main_file_btn) .card").fadeOut("fast",function(){
		 $(this).remove();
	  });
 }
 function on_beforesend(form){	 
	   form.find(">.card").addClass("state-loading");
	   //console.log(form);
}  
function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.card").removeClass("state-loading");
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
	   }
}

$(function(){	
	
	$('body').on("click",".app-btn-file-reset",function(e){
		e.preventDefault();
		$(this).closest(".app-file-main-container").fadeOut('fast',function(){
			$(this).remove();
		});
		
	});
	$('body').on("click",".app-btn-file-reset-2",function(e){
		e.preventDefault();
		$(this).closest(".card").fadeOut('fast',function(){
			$(this).remove();
		});
		
	});
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
				 fileIconElem.attr("class","fa fa-file-zip-o float-right");
				 fileIconElem.css("color","#fbb847");
			 }else if(type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||type=="application/msword"){
				 typeTitle=type="Word File"				 
				 fileIconElem.attr("class","fa fa-file-word-o float-right");
				 fileIconElem.css("color","#2C5990");
			 }else if(type=="application/pdf"){
				 typeTitle=type="PDF File"				 
				 fileIconElem.attr("class","fa fa-file-pdf-o float-right");
				 fileIconElem.css("color","#E42101");
			 }else{
				 if(type.length>20){
					 type=type.substr(0,17)+"...";
				 }
				 fileIconElem.attr("class","fa fa-file-o float-right").css("color","#CCCCCC");;
			 }
			fileTypeElem.text(type).attr("title",typeTitle);;
			fileSizeElem.text(((this.files[0].size/(1024*1024)).toFixed(2))+" MB");	
			resetInput.removeClass("hidden");
		 }
		  
	});
	
});
</script>