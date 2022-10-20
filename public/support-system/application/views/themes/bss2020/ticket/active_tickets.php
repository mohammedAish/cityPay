<?php //GPrint($ticket_list);?>
<div class="card card-default app-card-box">
	<div class="card-header"><?php _e("Active Tickets"); ?></div>
	  <div class="card-body p-0 app-nice-scroll" style="max-height: 450px; overflow: auto;">
      	<?php if(isset($ticket_list)){ echo get_ticket_list_2020($ticket_list,"No active ticket found"); }?>
  </div>
</div>