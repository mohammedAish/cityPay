<div class="row">
	<div class="col-md-8">
		<?php echo GetMsg();?>
		<?php  echo form_open ( current_url(),array("class"=>"form bv-form","id"=>"ticket_open_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>
	      
		<div class="card card-default app-card-box">
			<div class="card-header"><?php _e("New Ticket Form"); ?></div>
		  <div class="card-body">
	      		<?php 
	      		if(empty($mainobj)){
	      			$mainobj=new Mticket();
	      		}
	      		
	      		?>
	      	
	      	
	      		<div class="form-horizontal form-horizontal-text-left">
	      	
			 <div class="form-group">
		      	<label class="control-label label-required col-md-3" for="title"><?php _e("Ticket Subject"); ?></label>	
		      	<div class="col-md-9">	      	                			     	
		      	<input type="text" maxlength="150"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" name="title"      placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket subject"));?>">
		      	</div>
		      </div> 
		      <?php 
		      $userdata=GetUserData();
		      if(empty($userdata)){
		      ?>
		    <div class="form-group">
		        <label class="control-label label-required col-md-3" for="user_email"><?php _e("Email Address"); ?></label>
		        <div class="col-md-9">	
			        <input type="Email" class="form-control" id="user_email" data-bv-remote-url="<?php echo site_url("user/email-check/ticket-open/user_email");?>" data-bv-trigger="blur"  data-bv-remote="true"  value="<?php echo  PostValue("user_email");?>" name="user_email" placeholder="<?php _e("Email Address"); ?>" data-bv-notempty="true"
					data-bv-emailaddress="true" 
					data-bv-emailaddress-message="<?php _e("Invalid email address.") ; ?>" 
					data-bv-notempty-message="<?php _e("Email is required");?>"
			        data-bv-notempty-message="<?php  _e("%s is required",__("Email Address"));?>" />
		        </div>
		     </div>
		     <?php }?>
		     
			<div class="form-group">
		      	<label class="control-label label-required col-md-3" for="priroty"><?php _e("Priroty"); ?></label>		      	                   			     	
	      		<div class="col-md-9">
	      		<select    class="form-control" id="priroty"  name="priroty"      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Priroty"));?>">
		        <?php $priroty_selected= $mainobj->GetPostValue("priroty","L");
		        if(!empty($userdata)){
		            GetHTMLOptionByArray($mainobj->GetPropertyOptions("priroty",true),$priroty_selected);
		        }else{
		        	GetHTMLOption("L", "Low-Please login to set priroty");
		        }
		            ?>
		        
		        </select>
		      	</div>
		      </div>
		      <?php if(Mapp_setting::GetSettingsValue("is_public_ticket")=="Y"){?>
		      	<div class="form-group">
			      	<label  style="line-height: 40px;" class="control-label label-required col-md-3" for="is_public"><?php _e("Public Ticket"); ?></label>
			      	<div class="col-md-9">                   			     	
			      		<div class="inline radio-inline">
				        <?php 
				            $is_public_selected= $mainobj->GetPostValue("is_public","N");			            
				            GetHTMLRadioByArray("Private Ticket","is_public","is_public",true,$mainobj->GetPropertyOptions("is_public"),$is_public_selected);
				            ?>			        
				       </div> 	
				       <span class="form-group-help-block"><?php _e("If you make this ticket public then other user can see and reply on this ticket");?></span>			         
			      	</div>
		      </div> 
		      <?php }?>
		      <div class="form-group">
		      	<label class="control-label label-required col-md-3" for="cat_id"><?php _e("Ticket Category"); ?></label>
		      	<div class="col-md-9">                   			     	
		      		<?php 		      		
		      		$options_category=Mcategory::getCategoryListHtmlOptionArray('A');
		      		?>
			        <select class="form-control" id="cat_id"  name="cat_id"       data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Category"));?>">
			        <?php $category_selected= $mainobj->GetPostValue("cat_id");
			        	GetHTMLOption("", "Select",$category_selected);
			            GetHTMLOptionByArray($options_category,$category_selected);
			            ?>			        
			        </select>
		      	</div>
		      </div> 
		      <?php 
		      //Custome All Category
		      foreach ($all_category_fields as $fld){
		      	echo app_get_html_form_field($fld);
		      
		      }
		      ?>
		      <div id="custom-fields" class="app-custom-fld-container">
		       <?php 
			      //Custome All Category			     
			     foreach ($custom_fields as $fld_group){
			      	foreach ($fld_group as $cfld){
			      	echo app_get_html_form_field($cfld,"custom_","custom-field-group grp-cat-".$cfld->cat_id." grp-".$cfld->id);
			      	}			      
			      }
			    ?>
		      </div>
		      </div>
		      
			 <div class="form-group">
		      	<label class="control-label label-required" for="ticket_body"><?php _e("Ticket Body"); ?></label>		                        			     	
		      	<textarea  style="height: 200px;" class="form-control app-html-editor force-bv" id="ticket_body" name="ticket_body"  required="required"  placeholder="<?php _e("Ticket Body"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Body"));?>"><?php echo  $mainobj->GetPostValue("ticket_body","",false);?></textarea>
		      	
		      </div> 
		      <?php 
		      
		      
		      
		      
		      $filesizeinmb=Mapp_setting::GetSettingsValue("max_file_upload_size",1);
		      $is_ticket_file_upload=Mapp_setting::GetSettingsValue('allow_ticket_file_upload','N')=="Y";
		      if($is_ticket_file_upload){
		      $file_extensions=Mapp_setting::GetSettingsValue('allowed_file_type');
		      if(!empty($file_extensions)){
		      	$file_extensions=".".str_replace("|", ",.", $file_extensions);
		      }
		      
		     if(!empty($uploaded_file_list) && count($uploaded_file_list)>0){		     	
		     	?>
		     	 <div  class="form-group m-b-0 app-file-main-container">
		           <label for=""><?php _e("Attach File"); ?></label>
		           <?php foreach ($uploaded_file_list as $fl){
		           	$isImage=strtolower(substr($fl->type, 0,3))=="ima";
		           	if($isImage){
		           		$typeTitle=$fl->type;		           		
		           	}elseif($fl->type=="application/x-zip-compressed"){
		           		$typeTitle="Zip File";
		           		$iclass="fa fa-file-zip-o float-right";
		           		$icolor="#fbb847";
		           	}elseif($fl->type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||$fl->type=="application/msword"){
		           		$typeTitle="Word File";
		           		$iclass="fa fa-file-word-o float-right";
		           		$icolor="#2C5990";
		           	}elseif($fl->type=="application/pdf"){
		           		$typeTitle="PDF File";
		           		$iclass="fa fa-file-pdf-o float-right";
		           		$icolor="#E42101";
		           	}else{
		           		$iclass="fa-file-o";
		      			$typeTitle=$fl->type;
		      			$icolor="#CCCCCC";
		           	}
		           	
		           ?>
		           <input type="hidden" name="w_uploaded_file[]" value="<?php echo $fl->name;?>"/>	
		           <div class="card card-default m-b-5">
		       		<div class="card-body app-file-upload-container">
			       		<div class="row">
			       			<div class="col-md-7 col-sm-6 col-xs-9 ">
			       				<label><?php echo substr($fl->name, 11);?></label>	
			       				<input type="hidden" name="a_uploaded_file[]" value="<?php echo $fl->name;?>"/>	
			       				<br/><button type="button" class="btn btn-xs btn-danger app-btn-file-reset-2"><i class="fa fa-trash-o"></i> <?php _e("Remove") ; ?></button>	           			
			       			</div>
			       			<div class="col-md-5 col-sm-6 col-xs-3">
			       			   <div class="row file-preview-img">			          
					           	<div class="u-file-dtls col-sm-8">					           		
					           		<dl class="dl-horizontal">
									  <dt>File Type</dt>
									  <dd><?php echo $typeTitle;?></dd>
									  <dt>File Size</dt>
									  <dd><?php echo sprintf("%.2f mb",($fl->size/1048576));?></dd>
									</dl>
					           	</div>
					           	<div class=" col-sm-4 col-xs-12 text-right">
					           		<?php if(!$isImage){?>
					           	  <i class="fa <?php echo $iclass;?> float-right" style="color:<?php echo $icolor;?>;"></i>
					           	  <?php }else{?>
					              <img  class="img-responsive float-right" src="<?php echo base_url("ticket/ticket-tmp-img/{$file_session_id}/{$fl->name}");?>" alt="<?php echo $fl->old_name;?>" />
					              <?php }?>
					           	</div>
					           </div>
			       			</div>
			       		
			       		</div>
			       
			        
		       		</div>
		       	</div>
		           <?php }?>
		        </div>
		     	<?php 
		     }else{
		      ?>
		       <div  class="form-group m-b-0">
		           <label for="upload_files"><?php _e("Attach File"); ?></label>
		        </div>
		        <?php }?>
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
									  <dt>File Type</dt>
									  <dd><span class="u-file-type"></span></dd>
									  <dt>File Size</dt>
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
		      
		       
		       	<button data-target="main_file_btn" data-clone-inc="true" class="add-cloner-button btn btn-xs btn-info m-t-15 "><i class="fa fa-plus-circle"></i> Add Another File</button>
		       	
			<?php }?>
		       <?php if(empty($userdata) && Mapp_setting::GetSettingsValue("is_cptcha_guest_ticket","N")=="Y"){?>
				<div class="form-group">
					<label><?php _e("Captcha");?></label> 
					<?php echo AppCaptcha::get_chapcha_html('','form-control');?>
				</div>
				<?php }?> 
		  </div>
		  <div class="card-footer text-center">
		  	<button type="submit" class="btn btn-theme btn-lg"><i class="fa fa-ticket"></i> <?php _e("Create Ticket") ; ?></button>
		  </div>
		 	
		</div>
		 <?php echo form_close();?>  
	</div>
	<div class="col-md-4 md-p-l-0">
		
		<div class="card card-default app-card-box">
			<div class="card-header"><?php _e("Knowledge Categories"); ?></div>
		  <div class="card-body">
		      	
		      	
		  </div>
		</div>
		
		
		<div class="card card-default app-card-box">
			<div class="card-header"><?php _e("Popular Knowledge"); ?></div>
			  <div class="card-body">
			
			      	
			  </div>
		</div>
		
		
	</div>
</div>
<script type="text/javascript">
 var custom_flds=<?php echo json_encode($custom_fields);?>;
 var cat_parent_list=<?php echo json_encode($cat_patent_list);?>;
		      
 function resetFile(obj){
    	  var parentBodyElem=obj.closest(".app-file-upload-container");
	  		var previewWindowElem=parentBodyElem.find(".file-preview-img");
	  		previewWindowElem.addClass("hidden");
	  		parentBodyElem.find("input[type=file]").val("");
	  		obj.addClass("hidden");
 }
 function enable_all_custom_field_by(cat_id){
	 activeFlields=$(".grp-cat-"+cat_id);
	 if(activeFlields.length>0){	 	
	 	activeFlields.find("input,select").prop("disabled",false);
	 	activeFlields.show();
	 }
 }
 function disable_all_custom_field(){
	 activeFlields=$(".custom-field-group");
	 if(activeFlields.length>0){
	 	activeFlields.hide();
	 	activeFlields.find("input,select").prop("disabled",false);
	 }
 }
 function show_custom_inputs(){	
	 disable_all_custom_field();
	 var cat_id=$("#cat_id").val();
	 if(cat_id!=""){		
	 	var parent_list=cat_parent_list[cat_id];
	 	if(parent_list && parent_list.length>0){
		 	for(var pi=0; pi<parent_list.length;pi++){
		 		console.log("HC3-"+parent_list[pi]);
		 		enable_all_custom_field_by(parent_list[pi]);
		 	}
	 	}	 	
	 	enable_all_custom_field_by(cat_id);	 	
	 }
 }
$(function(){
	<?php 
	if(empty($userdata)){?>
		CallOnAjaxComplete("<?php echo site_url('user/email-check/ticket-open/user_email');?>",function (event, xhr, settings){
	    	if(!xhr.responseJSON.valid){
	    		_popupajaxLoadComplted();
	    	}
	    });
	<?php }
	?>
	show_custom_inputs();
	$(".app-custom-fld-container").removeClass("app-custom-fld-container");
	$("#cat_id").on("change",function(e){
		show_custom_inputs();		
	});
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