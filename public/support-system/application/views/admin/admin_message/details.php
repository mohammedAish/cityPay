<?php if(empty($mainobj)){
    $mainobj=new Madmin_message();
}
$msguser= Mapp_user::get_user_obj_by($mainobj->from_user);
?>

<div class="panel panel-default app-panel-box m-b-10">
	  <div class="panel-heading">
	  <div class="row">
    	           <div class="col-md-8"><h4 class="m-0"  title="<?php echo $mainobj->subject;?>"><b><?php _e("Subject") ; ?> : </b><?php echo $mainobj->subject;?></h4></div>
    	           <div class="col-md-4 text-right"><b><?php _e("From") ; ?> : </b><?php echo $msguser->title;?></div>
    	       </div> 
	  
	  
	  
	  </div>
	  <div class="panel-body text-justify"  style="min-height: 150px;">
	  <?php echo $mainobj->body;?>
	  </div>
	  <div class="panel-footer">
	   <small><em><?php _e("Time") ; ?> : <?php echo get_user_datetime_default_format($mainobj->entry_time);?></em></small>
	  </div>
</div>
<?php 
if(!empty($replies) && count($replies)>0){
    foreach ($replies as $rep){
        echo get_message_reply_html($rep);
    }
}
?>
<div id="new_reply_here"></div>
<?php  echo form_open ( admin_url("admin-message-confirm/reply/{$mainobj->id}"),array("class"=>"form app-ajax-form","id"=>"reply_form","method"=>"post","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend"));?>
<div class="panel panel-default app-panel-box m-b-10">
	  <div class="panel-heading"><h5 class="m-0"  title="<?php echo $mainobj->subject;?>"><?php _e("Reply") ; ?>  </h5></div>
	  <div class="panel-body text-justify ">
	   <div class="form-group m-0">
	   	               			     	
	   		<textarea  class="form-control" id="replytext" style="min-height: 150px;" name="replytext" placeholder="<?php _e("Write reply here.."); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Reply"));?>"><?php echo  PostValue("replytext")?></textarea>
	   
	   </div> 
	   
	   
	  </div>
	  <div class="panel-footer">
	   <button type="submit" class="btn btn-success"><?php _e("Send") ; ?></button>
	  </div>
</div>
<?php form_close();?>

<script type="text/javascript" >
function on_beforesend(form){	 
	   form.find(">.panel").addClass("state-loading");
	   console.log(form);
}  
function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.panel").removeClass("state-loading");
	   if(rdata.status){
		   $("#new_reply_here").before(rdata.data);	
		   $('#reply_form')[0].reset();	  
		   $('#replytext').focus();
	   }
}
</script>