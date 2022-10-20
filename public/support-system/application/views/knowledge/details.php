<?php
    $isViewCount=Mapp_setting::GetSettingsValue("is_kn_iconc","N")=="N";
	$is_kn_like_dlike=Mapp_setting::GetSettingsValue("is_kn_like_dlike","N")=="N";
    $is_kn_l_upd=Mapp_setting::GetSettingsValue("is_kn_l_upd","N")=="N";
?>
<div class="row" >
	<div class="col-md-<?php echo !$this->input->is_ajax_request()?8:12;?>">
		
		<?php 
	      	if(!empty($knowledge)){?>
		      	<div class="panel panel-default app-panel-box">
				 
				<div class="panel-heading">
				<div class="row"> 
				<?php  if(!$this->input->is_ajax_request()){?>
					<div class="col-md-12">
						<h1 class="m-0"><?php echo $knowledge->title; ?>
                            <?php if($is_kn_like_dlike){ ?>
						<span class="kn-like pull-right "><span class="text-success"><i class="fa fa-thumbs-up "></i><span class="kn-like-counter-<?php echo $knowledge->id;?>" ><?php _n($knowledge->l_count);?></span></span>  <span class="text-danger"><i class="fa fa-thumbs-down"></i> <span class="kn-dislike-counter-<?php echo $knowledge->id;?>" ><?php _n($knowledge->d_count);?></span></span></span>
						<?php } ?>
                        </h1>
						
					</div>
					<?php }?>
					<div class="kn-details post-details col-md-12">
						<div class="row">
      
						<div class="col-md-9 col-sm-8 ">
							<?php if($is_kn_l_upd) {?>
							<?php _e("Last updated on ");?> <?php echo get_user_datetime_default_format($knowledge->last_update_time);?>
                            <?php } ?>
                            <?php if(!empty($knowledge->category_name)){?>in <?php echo Mcategory::getParentStr($knowledge->cat_id,true);}?>
						</div>
      
						<div class="col-md-3 col-sm-4 text-right author-detail">
							<?php _e("Posted By ");?><a href="<?php echo site_url("user/app-user-details/{$knowledge->added_by}");?>"  data-effect="mfp-move-from-top " class="popupform author-name"><?php echo $knowledge->added_by_name;?></a>
						</div>
						</div>
						
					</div>
				</div> 
				
				</div>
						  
			  <div class="panel-body kn-details-container">		  
		      	   <?php 
		      	   $furl=Mknowledge::get_feature_url($knowledge->id);
		      	   if(!empty($furl)){
		      	       ?>
		      	       <div class="kn-featured-img">
		      	           <img class="popupimg" href="<?php echo $furl;?>" src="<?php echo $furl;?>" alt="<?php _e("Featured Image") ;?> " />
		      	       </div>
		      	       <div class="m-b-10"></div>
		      	       <?php 
		      	   }
		      	   echo $knowledge->k_body;
                   $afiles = Mknowledge::getAttachedFile($knowledge->id);
                   if(count($afiles)>0){


                ?>
                       <div class="row"></div>
              <div class="kn-f-title"><?php _e("Files:") ; ?></div>

                  <div class="kn-a-files">
                  <?php
             foreach ($afiles as $f) {
                 $type=mime_content_type($f->full_path);
                 $isImage=substr(strtolower($type),0,3)=="ima";
                 $afileName=strlen($f->file)>15?substr($f->file,0,3)."..".substr($f->file,-10):$f->file;
                 $icolor="#a6b2b5";
                 $iclass="";
                 if($isImage){
                     $icolor="#47bdd4";
                     $typeTitle=$type;
                     $iclass="fa-image";
                 }elseif($type=="application/x-zip-compressed" || $type=="application/zip"){
                     $typeTitle="Zip File";
                     $iclass="fa-file-zip-o";
                     $icolor="#fbb847";
                 }elseif($type=="application/vnd.openxmlformats-officedocument.wordprocessingml.document" ||$type=="application/msword"){
                     $typeTitle="Word File";
                     $iclass="fa-file-word-o";
                     $icolor="#2C5990";
                 }elseif($type=="application/pdf"){
                     $typeTitle="PDF File";
                     $iclass="fa-file-pdf-o";
                     $icolor="#E42101";
                 }else{
                     $iclass="fa-file-o";
                     $typeTitle=$type;
                     $icolor="#CCCCCC";
                 }
                 $fileurl=urlencode($f->file);
                 ?>

                     <a title="<?php echo $f->file; ?>" class="kn-a-file" href="<?php echo Mknowledge::get_attach_url($knowledge->id,$f->file); ?>" download >
                         <i  style="color:<?php echo $icolor; ?>" class="fa <?php echo $iclass; ?>"></i>
                         <?php echo $afileName; ?>(<?php printf("%.2f MB",filesize($f->full_path)/1048576) ; ?>)
                     </a>

                  <?php }?>
                  </div>
                  <?php } ?>
			  </div>
			  <?php  if(!$this->input->is_ajax_request()){?>
			  <div class="panel-footer">
			  
			  	<div class="row">
			  		<div class="col-xs-8">
			  			<?php  get_knowledge_like_dislike_buttons($knowledge->id);?>		  		
			  		</div>
			  		<div class="col-xs-4 text-right">
			  			<span class="view-count"> <?php echo  __("Views").":"; _n($knowledge->v_count);?></span> 
			  		</div>
			  	</div>
			  	 
			  </div>
			 <?php }?>
			</div>
	      		<?php }else{?>	
	      		<div class="alert alert-danger">Details not found</div>
	      		<?php }?>	 
	</div>
	<?php if(!$this->input->is_ajax_request()){?>
	<div class="col-md-4 md-p-l-0">	 
		<?php 
		echo $this->getModule("knowledge_video",["kn_video_link"=>$knowledge->featured_video_link]);
		echo $this->getModule("opent_ticket_right_module");
		?>		
	</div>
	<?php }?>
</div>
<?php if($this->input->is_ajax_request()){?>
<div class="row btn-group-md popup-footer text-right">	
	<button type="button" class="close-pop-up btn btn-sm btn-danger"><i class="fa fa-times"></i> <?php _e("Close");?></button>
</div>
<?php }?>