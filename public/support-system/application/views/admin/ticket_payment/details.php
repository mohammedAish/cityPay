<?php 
if(empty($paymentDetails)){
    $paymentDetails=new Mticket_payment();
}
?>
<style>
.dtls-box.bg-green-gradient {
	color: #474040;
}
</style>
<div class="clearfix form-horizontal p-b-15">
<div class="row">
    <div class="col-md-6">        
        <div class="box box-solid bg-green-gradient art-box  dtls-box">
            <div class="box-header">
              <i class="fa fa-ticket"></i><?php _e("Ticket Details"); ?>
            </div>               	   
    	   <div class="box-footer no-border art-box-content p-t-0 p-b-0" >
                     <table class="table m-b-0">	   
                		<tr>
                 			<th style="width: 132px; "> <?php _e("Ticket Track ID") ; ?></th>
                 			<th style="width: 10px; ">:</th>
                 			<td><?php echo $ticketObj->ticket_track_id;?></td>   
                 		</tr>
                 		<tr>
                 			<th style="width: 122px; "> <?php _e("Ticket Title") ; ?></th>
                 			<th style="width: 10px; ">:</th>
                 			<td><?php echo $ticketObj->title;?></td>   
                 		</tr>
                 		<tr>
                 			<th><?php _e("Ticket User") ; ?></th>
                 			<th>:</th>
                 			<td>                 			
                     			<?php 
                     			if($ticket_user->first_name){
                     				echo get_grid_user_img($ticket_user->first_name." ".$ticket_user->last_name,$ticket_user->photo_url,$ticket_user->id,$ticket_user->user_type,true);     				
                     			}?>
                 			</td>                 			
                 		</tr>
                 		<tr>
                 			<th><?php _e("Ticket Priroty") ; ?></th>
                 			<th>:</th>
                 			<td><?php echo getTextByKey($ticketObj->priroty,$ticketObj->GetPropertyOptionsTag("priroty"));?></td>
                 			
                 		</tr>
                 		<tr>
                 			<th ><?php _e("Ticket Category") ; ?></th>
                 			<th>:</th>
                 			<td><?php echo Mcategory::getParentStr($ticketObj->cat_id);?></td>
                 		</tr>
                 		<tr>                 			
                 			<th ><?php _e("Assigned On") ; ?></th>
                 			<th >:</th>
                 			<td id="assign-container" class="abs-c">
                 			<?php 
                 			if(!empty($ticketObj->assigned_on)){
                 				
                 				$assign_user=Mapp_user::get_user_obj_by($ticketObj->assigned_on);
                 				if($assign_user){
                 					echo get_grid_user_img($assign_user->title,$assign_user->img_url,$assign_user->id,"A",true);
                 				}else{
                 					echo $ticketObj->assigned_on;
                 				}
                 			}
                 				?>                 				
                 			</td>
                 		</tr>
                 		<tr>
                 			
                 			<th ><?php _e("Opened Time") ; ?></th>
                 			<th >:</th>
                 			<td><?php echo get_user_datetime_default_format($ticketObj->opened_time);?></td>
                 		</tr>
                 		<tr>
                 			
                 			<th ><?php _e("Last Reply Time") ; ?></th>
                 			<th >:</th>
                 			<td><?php echo get_user_datetime_default_format($ticketObj->last_reply_time);?></td>
                 		</tr>
                 		<tr>
                 			
                 			<th ><?php _e("Status") ; ?></th>
                 			<th >:</th>
                 			<td><span class="ticket-status"><?php echo getTextByKey($ticketObj->status,$ticketObj->GetPropertyOptionsTag("status"));;?></span></td>
                 		</tr>  
                	</table>        		
      			
            </div>
       </div>
    </div>
   
    <div class="col-md-6">
          <div class="box box-solid bg-green-gradient art-box dtls-box">
            <div class="box-header">
              <i class="fa fa-money"></i> <?php _e("Payment Details"); ?>
            </div>               	   
    	   <div class="box-footer no-border art-box-content p-t-0 p-b-0" style="min-height: 259px;">
                    
                     <table class="table m-b-0">	   
                		<tr>
                 			<th style="width: 200px; "><?php _e("Description") ; ?></th>
                 			<th style="width: 10px; ">:</th>
                 			<td><?php echo $paymentDetails->payment_des;?></td>   
                 		</tr>
                 		<tr>
                 			<th><?php _e("Amount") ; ?></th>
                 			<th>:</th>
                 			<td>                 			
                     			<?php echo $paymentDetails->payment_currency." ".$paymentDetails->amount;?>
                 			</td>                 			
                 		</tr>
                 		<tr>
                 			<th><?php _e("Method") ; ?></th>
                 			<th>:</th>
                 			<td><?php echo $paymentDetails->getTextByKey("payment_method");?></td>
                 			
                 		</tr>
                 		<tr>
                 			
                 			<th ><?php _e("Status") ; ?></th>
                 			<th >:</th>
                 			<td><?php echo $paymentDetails->getTextByKey("status");?></td>
                 		</tr>  
                 		
                 		<tr>
                 			<th ><?php _e("Create Time") ; ?></th>
                 			<th>:</th>
                 			<td><?php 
                 			
                 			    echo get_user_datetime_default_format($paymentDetails->create_date);                 			
                 			?></td>
                 		</tr>
                 		<tr>
                 			<th ><?php _e("Process Time") ; ?></th>
                 			<th>:</th>
                 			<td><?php 
                 			if(!empty($paymentDetails->payment_id)){
                 			    echo get_user_datetime_default_format($paymentDetails->process_date);
                 			}else{
                 			    echo "-";
                 			}
                 			?></td>
                 		</tr>
                 		<tr>                 			
                 			<th ><?php _e("Transction ID") ; ?></th>
                 			<th >:</th>
                 			<td><?php 
                 			if(!empty($ticket_payment_log)){
                 			    echo $ticket_payment_log->transaction_id;
                 			}
                 			?></td>
                 		</tr> 
                 		<tr>                 			
                 			<th ><?php _e("Payer Email") ; ?></th>
                 			<th >:</th>
                 			<td>
                 			<?php 
                     			if(!empty($ticket_payment_log)){
                     			    echo $ticket_payment_log->pp_payer_email;
                     			}
                 				?>                 				
                 			</td>
                 		</tr>	
                 		<tr>                 			
                 			<th ><?php _e("Payment Method Status") ; ?></th>
                 			<th >:</th>
                 			<td>
                 			<?php 
                     			if(!empty($ticket_payment_log)){
                     			    echo $ticket_payment_log->result_msg;
                     			}
                 				?>                 				
                 			</td>
                 		</tr>
                 	
                	</table>  
                	      		
      			
            </div>
       </div>
    </div>
    
</div>
</div>
<div class="row btn-group-md popup-footer text-right">
	
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
