<div class="panel panel-default app-panel-box">
			<div class="panel-heading"><?php _e("Need Support? Create a Ticket."); ?></div>		  
		  <div class="panel-body">
		      <?php echo get_open_ticket_link("btn btn-theme btn-lg btn-block");?>
		      	
		  </div>
		</div>
		
		<?php echo $this->getModule("categories");
		      echo $this->getModule("popular_knowledge");
		?>
		