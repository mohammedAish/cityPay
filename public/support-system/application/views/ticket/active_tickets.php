<?php //GPrint($ticket_list);?>
<div class="panel panel-default app-panel-box">
	<div class="panel-heading"><?php _e("Active Tickets"); ?></div>		  
	  <div class="panel-body p-0 app-nice-scroll" style="max-height: 450px; overflow: auto;">		  
      	<?php if(isset($ticket_list)){ echo get_ticket_list($ticket_list,"No active ticket found"); }?>		      	
  </div>
</div>