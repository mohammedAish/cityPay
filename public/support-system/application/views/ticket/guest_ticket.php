<div class="row">
	<div class="col-md-offset-4 col-md-4">
		<?php echo GetMsg();?>
		<?php  echo form_open ( current_url(),array("class"=>"form bv-form","id"=>"ticket_open_form","method"=>"post"));?>	      
		<div class="panel panel-default app-panel-box">
			<div class="panel-heading"><?php _e("Enter Ticket information"); ?></div>
			<div class="panel-body">
			<div class="form-group">
			    <label class="control-label label-required" for="track_id"><?php _e("Ticket Track ID"); ?></label>
			    <input type="text" class="form-control" id="track_id" name="track_id" placeholder="<?php _e("Ticket Track ID"); ?>" data-bv-notempty="true" disabled="disabled"
				value="<?php echo $track_id;?>" data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Track ID"));?>">
			 </div>
			 <div class="form-group">
			     <label class="control-label label-required" for="ticket_email"><?php _e("Ticket Email"); ?></label>
			     <input type="email" class="form-control" id="ticket_email" autofocus="autofocus" name="ticket_email" placeholder="<?php _e("Ticket Email"); ?>" data-bv-notempty="true"
			 	data-bv-notempty-message="<?php  _e("%s is required",__("Ticket Email"));?>">
			  </div>
			  <div class="form-group">
            		<label><?php _e("Captcha");?></label> 
            		<?php echo AppCaptcha::get_chapcha_html('','form-control');?>
            	</div>
			   <div class="form-group">
			     <button type="submit" class="btn btn-success"><?php _e("Submit") ; ?></button>
			  </div>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>