<?php 
if(empty($ipinfo)){
    $ipinfo=new APPIPdata();
}
$isMultiCol=!empty($ipinfo->latitude) && !empty($ipinfo->longitude);
?>
<div class="clearfix form-horizontal">
<div class="panel panel-default">  
  <div class="panel-body p-0">
  <div class="row">
    <div class="col-md-<?php echo $isMultiCol?"6":"12";?>">
        <table class="table m-0">
        	<tr>
        		<th style="width:150px;"><?php _e("IP") ; ?></th>
        		<td><?php echo !empty($ipinfo->ip)?$ipinfo->ip:"";?></td>
        	</tr>
        	<tr>
        		<th><?php _e("Country Code") ; ?></th>
        		<td><?php echo !empty($ipinfo->country_code)?$ipinfo->country_code:"";?></td>
        	</tr>
        	<tr>
        		<th><?php _e("Country Name") ; ?></th>
        		<td><?php echo !empty($ipinfo->country_name)?$ipinfo->country_name:"";?></td>
        	</tr>
        	<tr>
        		<th><?php _e("Timezone") ; ?></th>
        		<td><?php echo !empty($ipinfo->time_zone)?$ipinfo->time_zone:"";?></td>
        	</tr>
        	<tr>
        		<th><?php _e("Latitude") ; ?></th>
        		<td><?php echo !empty($ipinfo->latitude)?$ipinfo->latitude:"";?></td>
        	</tr>
        	<tr>
        		<th><?php _e("Longitude") ; ?></th>
        		<td><?php echo !empty($ipinfo->longitude)?$ipinfo->longitude:"";?></td>
        	</tr>
        </table> 
    </div>
    <div class="col-md-6 p-l-0">  
        <?php if($isMultiCol){?>  
        <iframe style="border:none; width: 100%; min-height: 216px;" src = "https://maps.google.com/maps?q=<?php echo $ipinfo->latitude;?>,<?php echo $ipinfo->longitude;?>&hl=es;z=12&amp;output=embed"></iframe>
        <?php }?>
    </div>
  </div>      
  </div>
</div>
 
</div>
<div class="row btn-group-md popup-footer text-right">	
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Close");?></button>
</div>
