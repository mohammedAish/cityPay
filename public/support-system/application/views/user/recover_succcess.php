<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default app-panel-box">
			<div class="panel-heading"><?php _e("Password info"); ?></div>		  
		  <div class="panel-body ">		  
	      	<?php 
	      	    echo GetMsg();
	      	    ?>
	      	   <div class="text-center">
	      	   <p><?php _e("Your password has been changed successfully") ; ?></p>
	      	   <a data-effect="mfp-move-from-top" class="popupformWR btn btn-success" href="<?php echo site_url("user/login");?>">Click here to login</a>
	      	 
	      	   </div>	      	  
		  </div>
		</div>
	</div>
	<div class="col-md-4 md-p-l-0">
	
		<?php echo $this->getModule("right_module");?>		
		
	</div>
</div>