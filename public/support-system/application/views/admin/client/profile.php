<div class="clearfix form-horizontal">
<?php     
    if(empty($mainobj)){
        $mainobj=new Msite_user();
        AddError("Main object has not initialized in controller");
    }
    $photo_url=!empty($mainobj->photo_url)?$mainobj->photo_url:base_url("images/no-image.png");
    //GPrint($mainobj);
    $countryList=getCountryKeyValuePair();
?>	 
<div class="row">
	<div class="col-sm-5 col-md-3">
	   <div class="box box-primary m-b-15">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle m-b-10" style="min-height: 100px; max-width: 100px;" src="<?php echo $photo_url;?>" alt="<?php echo $mainobj->first_name." ".$mainobj->last_name;?>">

              <h3 class="profile-username text-center"><?php echo($mainobj->user_type=="G")?__("[GUEST USER]"):$mainobj->first_name." ".$mainobj->last_name;?></h3>

              <p class="text-muted text-center"><?php _e("Join Date") ; ?> : <?php echo get_user_date_default_format($mainobj->join_date);?></p>

              <ul class="list-group list-group-unbordered m-b-0">
               <li class="list-group-item">
                  <b style="padding-right: 10px;"><?php _e("Email Address") ; ?></b> <a><?php echo $mainobj->email;?></a>
                </li>
                <li class="list-group-item">
                  <b><?php _e("Country") ; ?></b> <a class="pull-right"><?php echo getTextByKey($mainobj->country,$countryList);?></a>
                </li>
                <li class="list-group-item">
                  <b><?php _e("Ticket Opened") ; ?></b> <a class="pull-right"><?php echo !empty($tickets)?count($tickets):0?></a>
                </li>    
                 <li class="list-group-item p-b-0" style="border-bottom: none;">
                  <b><?php _e("Timezone") ; ?></b> <a class="pull-right"><?php echo $mainobj->tzone;?></a>
                </li>
                  <?php
                  $userCustomFlds=Msite_user_custom_field::FindAllBy("user_id",$mainobj->id);
                  if(count($userCustomFlds)>0){
                  foreach ($userCustomFlds as $uf){
                  ?>
                  <li class="list-group-item p-b-0" style="border-bottom: none;">
                      <b><?php echo $uf->fld_title; ?></b>
                      <a class="pull-right">
			              <?php echo $uf->fld_value_text; ?>
                      </a>

                  </li>
                  <?php
                }
            }?>
              </ul>            
            </div>
            <!-- /.box-body -->
          </div>
        <?php $notes=getAdminNotes($mainobj->id);
                if(!empty($notes)) {?>
        <div class="panel panel-success app-panel-box">
            <div class="panel-heading bg-green p-5"><i class="fa fa-sticky-note"></i>  <?php _e("Admin Notes") ; ?>



            </div>
            <div class="panel-body p-0" style="margin-top: -1px;">

                    <?php echo $notes; ?>

            </div>
        </div>
    <?php } ?>
	</div>
	<div class="col-sm-9 col-md-9" >
	<div class="panel panel-default">	  
	  <div class="panel-body p-0" style="position: relative;"> 
    	  <table id="ticket-container-modal" class="table scroll-tbody m-0 table-responsive">
    	  	<thead>
    	  		<tr >
    	  			<th style="width: 5%">#</th>
    	  			<th style="width: 35%"><?php _e("Title") ; ?></th>
    	  			<th style="width: 20%" class=""><?php _e("Category") ; ?></th>
    	  			<th style="width: 20%" ><?php _e("Status") ; ?></th>
    	  			<th style="width: 20%" class=""><?php _e("Last Date") ; ?></th>
    	  			
    	  		</tr>
    	  	</thead>
    	  	<tbody  class="" style="max-height: 350px; overflow: hidden;" >
    	  	<?php if(!empty($tickets)){ 
    	  	    $i=1;
    	  	   
              	 foreach ($tickets as $tkt){
              	     if(empty($tkt)){
              	         $tkt=new Mticket();
              	     }
              	    ?>
              	    <tr>
        	  			<td style="width: 5%"><?php echo $i++;?></td>
        	  			<td style="width: 35%"><a target="_blank" href="<?php echo admin_url("ticket/details/{$tkt->id}");?>" class=""> <?php echo $tkt->title;?></a></td>
        	  			<td style="width: 20%"><?php echo Mcategory::getParentStr($tkt->cat_id);?></td>
        	  			<td style="width: 20%"><?php echo $tkt->getTextByKey("status");?></td>
        	  			<td style="width: 20%"><?php echo get_user_date_default_format($tkt->last_reply_time);?></td>        	  			
        	  		</tr>
              	    <?php 
              	     
              	 }
              	}else{?>
              	 <tr>
        	  		<td class="text-center" colspan="5"><?php _e("No ticket open by %s",$mainobj->first_name." ".$mainobj->last_name); ?></td>
        	  	</tr>
              	<?php }?>	
    	  		
    	  	</tbody>
    	  </table>
       </div>
	</div>    		      	
      
	</div>
</div>

</div>
<div class="row btn-group-md popup-footer text-right">	
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Close");?></button>
</div>
<script type="text/javascript">
$(function(){ 
    var isResized=false;
    $("#ticket-container-modal tbody").on("mouseenter",function(){        
        if(!isResized){
            setTimeout(function(){
        	$("#ticket-container-modal tbody").css("overflow","auto");
        	try{
           	 $("#ticket-container-modal tbody").niceScroll({
     	        cursorcolor:"rgba(0, 0, 0, 0.31)",
     	        cursorwidth: "7px",
     	        background:"rgba(0, 0, 0, 0.03)",
     	        autohidemode:"leave",        
     	     }); 
        	}catch(e){}
      	  isResized=true;
        },100);
        }
     });
    
});
</script>