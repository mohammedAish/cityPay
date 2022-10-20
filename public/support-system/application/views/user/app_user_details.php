<?php
if(empty($app_user)){
    $app_user=new Mapp_user();
}
$roles=Mrole_list::FetchAllKeyValue("role_id", "title");
$obj=new Mknowledge();
$obj->added_by($app_user->id);
$counk=$obj->CountALL();
?>
<div class="row m-b-15">
	<div class="col-md-4 img-responsive">
	   <img class="img-thumbnail" style="" src="<?php echo Mapp_user::get_user_image_url($app_user->id)?>" alt="<?php echo $app_user->title;?>" />
	  
	</div>
	<div class="col-md-8 p-l-0">
	<div class="panel panel-default">	  
	  <div class="panel-body p-0 m-0">
	      	<table class="table m-0">
    		<tr>   
    		    <th style="width: 150px;"><?php _e("Name") ; ?></th>
    		    <th style="width: 10px;">:</th> 			
    			<td><?php echo $app_user->title;?></td>
    		</tr>
    		<tr>  
    		 <th><?php _e("Role") ; ?></th>
    		    <th>:</th> 	  			
    			<td><?php echo getTextByKey($app_user->role,$roles);?></td>
    		</tr>
    		 <th><?php _e("Current Status") ; ?></th>
    		    <th>:</th> 	  			
    			<td><?php echo is_user_online($app_user->id, "A")?"Online":"Offline";?></td>
    		</tr>
    		<tr>  
    		 <th><?php _e("Joined Date") ; ?></th>
    		    <th>:</th> 	  			
    			<td><?php echo get_user_date_default_format($app_user->add_date);?></td>
    		</tr>
    		<tr>  
    		 <th><?php _e("Country") ; ?></th>
    		    <th>:</th> 	  			
    			<td><?php echo $app_user->country;?></td>
    		</tr>
    		<tr>  
    		 <th><?php _e("Total Knowledges") ; ?></th>
    		    <th>:</th> 	  			
    			<td><?php echo $counk;?></td>
    		</tr>
    	</table>
	  </div>
	</div>
    	
	</div>
</div>



