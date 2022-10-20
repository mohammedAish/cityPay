<style type="text/css">
   #update-details-pan #details-tab{
   	display: block !important;
   }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("App update information") ; $userData=GetAdminData(); if($userData->IsSuperUser()){?> <a href="<?php echo site_url("admin/system-update/re-check");?>" class="btn btn-info btn-xs"><?php _e("Re-Check Update") ; ?></a><?php }?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                <?php if(empty($updateObj->new_version)){?>
        		<h2 class="text-success"><?php _e("Your application is up to date") ; ?></h2>
        		<h4><?php _e("Current version is : %s",$_app_version) ; ?></h4>  
        		<?php $changeLog=Mapp_setting_api::GetSettingsValue("system","nvcl", "");
        		if(!empty($changeLog)){
        		?>
        		<hr class="m-0" />
        		<div class="help-block text-left p-15">
        		  <?php
                      $changeLog=str_replace(['&gt','&lt','&quot'],['&gt;','&lt;','&quot;'],$changeLog);
        		    echo change_log_formater($changeLog);
        		  ?>
        		</div>      		
        		<?php 
        		  }
        		}else{
        		    //GPrint($updateObj);
        		    
        		    ?>
        		    <div class="panel panel-default">        		      
        		      <div class="panel-body p-0">
        		      
        		      <table class="table text-left m-b-0">
        		      	<tr>
        		      		<th style="width: 200px;">New Version</th>
        		      		<td> v <?php echo $updateObj->new_version;?> &nbsp; &nbsp; <a href="#update-details-pan" data-effect="mfp-move-from-top" class="popupinline btn btn-info btn-xs">View Details</a></td>
        		      	</tr>
        		      	<tr>
        		      		<th style="width: 200px;">Update Date</th>
        		      		<td><?php echo get_user_datetime_default_format($updateObj->last_updated);?></td>
        		      	</tr>        		      	
        		      	<?php if(ACL::HasPermission('admin/system-update/process-update')){?>
        		      	<tr>
        		      		
        		      		<td colspan="2">
        		      		  <a href="<?php echo admin_url("system-update/process-update");?>" data-effect="mfp-move-from-top" class="btn btn-success btn-sm"> <i class="fa fa-gear"></i> Process Update</a>
        		      		</td>
        		      	</tr>
        		      	<?php }else{
        		      	    ?>
        		      	    <tr>
        		      		
        		      		<td colspan="2">
        		      		<b class="text-red">Please inform the user who have update process access.</b>        		      		
        		      		</td>
        		      	</tr>
        		      	    <?php 
        		    }?>
        		      </table>
        		      <div class="hidden">
        		      <div id="update-details-pan" class="col-md-6 ">
        		         <ul class="nav nav-tabs" id="details-tab">
                          
                          <li class="active" ><a data-toggle="tab" href="#changelog">Change log</a></li>
                          <li ><a data-toggle="tab" href="#descriptiondts">Description</a></li>
                         
                        </ul>
                        
                        <div class="tab-content">
                         
                          <div id="changelog" class="tab-pane fade in active text-left">   
                          <h3>Change Log</h3>
                            <div style="background: #e8e8e8;padding: 10px;font-size: 12px;font-family: Courier,'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif;border: 1px solid #cdcdcd;">            
                            <?php
                                echo  change_log_formater(str_replace(['&gt','&lt','&quot'],['&gt;','&lt;','&quot;'],$updateObj->sections->changelog));?>
                            </div> 
                          </div>
                          <div id="descriptiondts" class="tab-pane text-left">
                           <h3>Update Description</h3>
                           <?php echo nl2br($updateObj->sections->description);?>
                          </div>
                          
                        </div>	
        		      </div>
        		    </div>
        		    </div>
        		    </div>
        		    <?php         		
        		}?>
                </div>
                <!-- /.box-body -->
                <div class="box-footer no-padding">
                  
                </div>
                <!-- /.footer -->
         </div>
         <!-- /.box -->
    </div>
    </div> 
      
    
<div class="row"></div>

<script type="text/javascript">
$(function(){
	
    $('#myTab a:first').tab('show');
    $("#details-tab > li").on("click",function(){
     });

});
</script>