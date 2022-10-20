<?php
	$userData=GetUserData(); 
?>
<div class="row">
	<div class="col-md-12">		
		<h3 class="mb-3"><?php _e("Your current ticket status"); ?></h3>
		<div class="row client-dashboard">
			<div class="col-sm-4 ">
				<a href="<?php echo site_url("ticket/active-tickets");?>">
				<div class="card card-default active-text">
					<div class="card-body">
						<div class="data-counter"><?php echo $counter->active;?></div>
						<div class="data-text"><?php _e("Active Tickets") ; ?></div>
						<div class="data-note"><?php _e("Your total active tickets") ; ?></div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="<?php echo site_url("ticket/closed-tickets");?>">
				<div class="card card-default closed-text">
					<div class="card-body">
						<div class="data-counter"><?php echo $counter->closed;?></div>
						<div class="data-text"><?php _e("Closed Tickets") ; ?></div>
						<div class="data-note"><?php _e("Your closed ticket list") ; ?></div>
					</div>
				</div>
				</a>
			</div>
			<div class="col-sm-4">
				<a href="<?php echo site_url("ticket/active-tickets");?>">
				<div class="card card-default action-req-text">
					<div class="card-body">
						<div class="data-counter"><?php echo $counter->action_required;?></div>
						<div class="data-text"><?php _e("Action Required") ; ?></div>
						<div class="data-note"><?php _e("Agent replied, needs your action") ; ?></div>
					</div>
				</div>
				</a>
			</div>
		</div>
		<div class="col-md-12 text-center">
			<h4><?php _e("Thank you for being with us") ; ?></h4>
		</div>
	</div>
</div>