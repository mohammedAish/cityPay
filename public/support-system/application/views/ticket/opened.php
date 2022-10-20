<h1><?php _e("Thank you, your ticket has been opened successfully") ; ?></h1>
<?php 
echo GetMsg();
if(!empty($ticketObj)){
	?>
	<div class="panel panel-default app-panel-box">
	  <div class="panel-heading"><?php _e("Ticket Details"); ?></div>
	  <div class="panel-body p-0">
	   <table class="table m-b-0">
		<tr>
			<th style="width: 180px;"><?php _e("Ticket Track ID") ; ?></th>
			<th style="width: 10px;">:</th>
			<td><?php echo $ticketObj->ticket_track_id;?></td>
			
		</tr>
		<tr>
			<th><?php _e("Ticket Subject") ; ?></th>
			<th>:</th>
			<td><?php echo $ticketObj->title;?></td>
		</tr>
		<tr>
			<th><?php _e("Ticket Priority") ; ?></th>
			<th>:</th>
			<td><?php echo getTextByKey($ticketObj->priroty,$ticketObj->GetPropertyOptionsTag("priroty"));?></td>
		</tr>
		<tr>
			<th><?php _e("Ticket Category") ; ?></th>
			<th>:</th>
			<td><?php echo Mcategory::getParentStr($ticketObj->cat_id);?></td>
		</tr>
		<tr>
			<th colspan="2">&nbsp;</th>
			<td ><a href="<?php echo site_url("ticket/details/".$ticketObj->id)?>" class="btn btn-success btn-sm"><i class="fa fa-ticket"></i> <?php _e("View Ticket Details") ; ?></a></td>
			
		</tr>
	</table>	
	  </div>
	</div>
	
	<?php 
}
?>