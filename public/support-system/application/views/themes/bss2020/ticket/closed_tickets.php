<?php //GPrint($ticket_list);?>
<div class="card card-default app-card-box">
	<div class="card-header"><?php _e("Closed Tickets"); ?></div>
	  <div class="card-body p-0 app-nice-scroll" style="max-height: 400px; overflow: auto;">
      	<?php if(isset($ticket_list)){ echo get_ticket_list_2020($ticket_list,"No closed ticket found"); }?>
  </div>
</div>