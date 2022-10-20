<?php
//GPrint($api_name);
$mainObj=APP_API::get_api_object($api_name);
$description="";
if($mainObj){
	$description=$mainObj->get_api_description();
}
?>

<style type="text/css">
    .dashboard-messages  {
      height: 412px; 
    }
.no-chat-msg {
    /* position: absolute; */
    text-align: center;
    font-size: 25px;
    color: #dedede;
    /* text-shadow: 0px -1px 0px black; */
}
</style>
<div class="row">
<?php if($mainObj){?>
 <?php  echo form_open ( admin_url("api-setting-confirm/modify/{$api_name}"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend"));?> 
	     		
	<div class="col-md-12">	
		<div class="box box-primary">
       		<div class="box-header with-border">
               	<h3 class="box-title"><?php _e("%s Settings",$api_name);?></h3>
               	    
                <div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></div>
           </div>
           <!-- /.box-header -->
          <div class="box-body">                
			<div class="row">
				<div class="col-md-6">
				 
	     		 <?php $mainObj->GetAddForm(4,8);?>
	     		
				</div>
				<div class="col-md-6  md-p-l-0">				
					<div class="box box-primary">
						<div class="box-header with-border">
						  <h3 class="box-title"><?php _e("API Description");?></h3>    
						  <div class="box-tools pull-right"><button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></div>
						</div>
						<!-- /.box-header -->
						<div id="api-description" class="box-body">						
						   <?php echo $description;?>					   
						</div>
						<!-- /.box-body -->					
					</div>
				 	<!-- /.box -->
				
				</div>
			</div>
		 </div>
		 <div class="box-footer">
              <button type="submit" class="btn  btn-success" ><i class="fa fa-save"></i> <?php _e("Save") ; ?></button>
         </div>
		</div>	
    </div>
     <?php echo form_close();?>
    <?php }else{?>
    <div class="col-md-12">
    <div class="alert alert-error"><?php _e("API Settings Error") ; ?></div>
    </div> 
    <?php }?>
</div> 

<script type="text/javascript">
function on_beforesend(form){	 
	   form.find(">div >.box").addClass("state-loading");
}  
function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">div >.box").removeClass("state-loading");
	   if(rdata.status){
		   $("#api-description").html(rdata.data);
		   _popupajaxLoadComplted();
	   }	  
} 
     
</script>
