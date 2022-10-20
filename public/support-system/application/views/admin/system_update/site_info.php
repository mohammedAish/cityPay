<?php
$items=app_get_version_details();?>
<div class="container">
    <h4><?php echo " App Current Version : ". $_app_version; ?></h4>
<p>The system is checking requirement</p>
        <div class="panel panel-default">
         
          <div class="panel-body p-0 table-responsive">
              	
        
        <table class="table m-b-0">
            <thead>
            	<tr>
            		<th width="30%">Name</th>
            		<th class="text-center" width="20%">Required</th>
            		<th class="text-center" width="20%">Your System</th>
            		<th class="text-center" width="30%">Status</th>
            	</tr>
            </thead>
            <tbody>
            <?php 
            $isOk=true;
            foreach ($items as $item){
                if(!$item->status){
                    $isOk=false;
                }
            ?>
            	<tr>
            		<td><?php echo $item->name;?></td>
            		<td class="text-center"><?php echo $item->required_str;?></td>
            		<td class="text-center"><?php echo $item->system_str;?></td>
            		<td class="text-center"><?php echo $item->status_text;?></td>
            	</tr>
            	<?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-center <?php echo $isOk?"text-success":"text-danger";?>">
                    <?php echo $isOk?'<i class="fa fa-check-circle-o"></i> '."All requirment are passed":'<i class="fa fa-check-times-o"></i> '."All requirment are not passed";?>
                    </td>
                </tr>
            </tfoot>
        </table>
        
         </div>
        </div>
 </div>