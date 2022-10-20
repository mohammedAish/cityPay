<div class="card card-default app-panel-box">
			<div class="card-header"><?php _e("Need Support? Create a Ticket."); ?></div>
		  <div class="card-body">
		      <?php echo get_open_ticket_link("btn btn-theme btn-lg btn-block");?>
		      	
		  </div>
		</div>
		
		<?php echo $this->getModule("categories");
		      echo $this->getModule("popular_knowledge");
		?>
		