<div class="clearfix form-horizontal p-0">
<?php    
    if(empty($mainobj)){
        $mainobj=new Mdebug_log();
        AddError("Main object has not initialized in controller");
    }
   
?>	  
<table class="table table-bordered m-b-0" style="margin-top: -9px;">
    <tr>
    	<th><?php _e("Entry Type") ; ?></th>
    	<td><?php echo $mainobj->getTextByKey("entry_type");?></td>
    </tr>
    <tr>
    	<th><?php _e("Title") ; ?></th>
    	<td><?php echo $mainobj->title;?></td>
    </tr>
     <tr>
    	<th><?php _e("Log Type") ; ?></th>
    	<td><?php echo $mainobj->getTextByKey("log_type");?></td>
    </tr>
     <tr>
    	<th><?php _e("Status") ; ?></th>
    	<td><?php echo $mainobj->getTextByKey("status");?></td>
    </tr>
     <tr>
    	<th colspan="2"><?php _e("Details Log") ; ?></th>
    	
    </tr>    
</table>
<pre contenteditable="true" class="debug-log"><?php !empty($mainobj->log_data)?print_r($mainobj->log_data):_e("No Log data");?></pre>
</div>
<div class="row btn-group-md popup-footer text-right">	
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
