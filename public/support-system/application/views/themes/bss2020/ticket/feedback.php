<?php if (empty($mainobj)) { $mainobj = new Mticket_feedback();            }  ?>
<div class="row">
	<div class="col-md-12">
		<?php echo GetMsg();?>
		<?php  echo form_open ( current_url(),array("class"=>"form bv-form","id"=>"ticket_open_form","method"=>"post","enctype"=>"multipart/form-data","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>
	      <h1 class="text-center"><?php _e("Thank you for your feedback") ; ?></h1>
	      <?php if(!empty($fb_msg)){?>
	      <h2 class="text-center <?php echo $mainobj->f_type=="P"?"text-success":"text-danger"?>"><?php echo $fb_msg;?></h2>
	      <?php }?>
		<div class="card card-default app-card-box">
			<div class="card-body">
	      		<div class="form-group">
		      	<label class="control-label>" for="f_msg"><?php _e("Would you please share your experience with us?"); ?></label>
		      	                  			     	
		      		<textarea maxlength="255"   style="height: 150px;" class="form-control" id="f_msg"  name="f_msg"   placeholder="<?php _e("Please write a comment on us here") ; ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Feedback message"));?>"></textarea>
			     		<?php /*<span class="form-group-help-block"><?php _e("f_msg");?></span>	*/?>
		      	
		      </div> 
		       <div class="text-center">
		          <button type="submit" class="btn btn-theme"><?php _e("Submit") ; ?></button>
		       </div>
		     </div>
		</div>
		<?php echo form_close();?>
	</div>
</div>