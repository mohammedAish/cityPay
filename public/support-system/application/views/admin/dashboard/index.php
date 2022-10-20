<div class="row">
    <div class="col-md-8 md-p-r-0">    
<!-- Info boxes -->
      <div class="row info-box-row">
        <div class="col-md-3 col-sm-6  col-xs-12">
         <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-assigned-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-aqua">
            <i class="fa fa-ticket"></i>
            <span class="sm-outline-text"><?php _e("Total") ; ?></span>
            </span>
           
                <div class="info-box-content">
                  <span class="info-box-text"><?php _e("Assigned Tickets") ; ?></span>
                  <span class="info-box-number"><?php echo $totalTicketInfo->total;?> 
                         
                  </span>              
                </div>
            
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box --> 
        </div>
        <!-- /.col -->
        <div class="col-md-3  col-sm-6 col-xs-12">
          <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-yellow"><i class="fa fa-ticket"></i>
             <span class="sm-outline-text"><?php _e("Total") ; ?></span>
            </span>
    
            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Active Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->pending_ticket;?></span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
          
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6  col-xs-12">
          <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-paid-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i>            
             <span class="sm-outline-text"><?php _e("Total") ; ?></span>            
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Active Paid Ticket") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->paid_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3  col-sm-6 col-xs-12">
          <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-closed');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-green">
                <i class="fa fa-ticket"></i>
              
                 <span class="sm-outline-text"><?php _e("Total") ; ?></span>  
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Total Closed Ticket") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->close_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        </div>
        <div class="row info-box-row">
        <!-- /.col -->
        <div class="col-md-3  col-sm-6 col-xs-12">
        <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-assigned-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-aqua">
            <i class="fa fa-ticket"></i>
              <span class="sm-outline-text"><?php _e("Today's") ; ?></span>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Assigned Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $monthTicketInfo->total;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3  col-sm-6 col-xs-12">
        <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-yellow">
            <i class="fa fa-ticket"></i>
            <span class="sm-outline-text"><?php _e("Today's") ; ?></span>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Active Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $monthTicketInfo->pending_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-3  col-sm-6 col-xs-12">
        <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-paid-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-red">
            <i class="fa fa-ticket"></i>
            <span class="sm-outline-text"><?php _e("Today's") ; ?></span>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Active Paid Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $monthTicketInfo->paid_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <!-- /.col -->
        <div class="col-md-3  col-sm-6 col-xs-12">
        <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/my-closed');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-green">
            <i class="fa fa-ticket"></i>
            <span class="sm-outline-text">Today's</span>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Closed Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $monthTicketInfo->close_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
      </div>
      <!-- /.row -->
    
    <!-- solid sales graph bg-green-gradient-->
          <div class="box box-solid  m-b-0">           
            <div class="box-body border-radius-none">
             <?php  APPChartJS::ShowByAjaxData(admin_url("Report-chart-data/get-agent-month-data"), 120,"#month_form",null,false,null,"monthly_load");?>
            </div>
            <!-- /.box-body -->         
          </div>
          <!-- /.box -->
 
    </div>
    <?php
    if(empty($myprof)){
    $myprof=new Mapp_user();
    }
    ?>
    <div class="col-md-4">
        <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2 m-b-10">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-green">
              <div class="widget-user-image">
              <?php  $_MydataUserData=GetAppBaseUserData();?>
                <img class="img-circle" src="<?php echo $_MydataUserData->user_img;?>" alt="<?php echo $_MydataUserData->title;?>">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $_MydataUserData->title;?></h3>
              <h5 class="widget-user-desc"><?php echo $_MydataUserData->role_title;?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked app-nav-stacked">
                <li><?php _e("Email Address") ; ?> <span class="pull-right  "><?php echo $_MydataUserData->email;?></span></li>
                <li><?php _e("Contact Number") ; ?> <span class="pull-right  "><?php echo $myprof->contact_number;?></span></li> 
                <li><?php _e("Date of Birth") ; ?><span class="pull-right  "><?php echo date(get_current_user_default_date_format(),strtotime($myprof->dob));?></span></li>                 
                <li><?php _e("Join Date") ; ?><span class="pull-right  "><?php echo get_user_date_default_format($myprof->add_date);?></span></li> 
                <li><?php _e("Timezone") ; ?> <span class="pull-right "><?php echo $_MydataUserData->timezone;?> <a style="margin-top: -5px;" class="btn btn-success popupformWR btn-xs" data-onclose="reload_timezone" href="<?php echo admin_url("dashboard/set-timezone")?>" ><?php _e("Change") ; ?> </a></span></li>              
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
          
          
          <?php 
          $__resentKnowledgeList=Mknowledge::FindAllBy("is_stickey", "N",array("status"=>"P"),'entry_time','DESC',5);
          
          ?>
        
         <div class="box box-solid bg-green-gradient art-box m-b-0">
            <div class="box-header">
              <i class="fa fa-file-text-o"></i>
              <h3 class="box-title"> <?php _e("Recent Articles") ; ?></h3>
              <small class="pull-right text-em"><?php _e("Read article to provide best support") ; ?></small>
            </div>               	   
    	   <div class="box-footer no-border art-box-content p-t-0 p-b-0">
                <?php if(!empty($__resentKnowledgeList)){echo get_knowledge_list_artbox($__resentKnowledgeList,true,true,false,false,true,true); }
                else{?>
                <h4 class="text-center text-info"><?php _e("No knowledge found") ; ?></h4>
                <?php }?>	
            </div>
             
             
            </div>
            <!-- /.box -->         
         
          
       
	   
    </div><!-- end 2nd column -->
</div> 
<style>
.art-kn-list li {
	list-style: outside none none;
	padding: 9px 2px;
	border-bottom: 1px dashed rgba(18,17,17,0.11);
}
</style>      
    
<div class="row"></div>

<script>
var agentloadedTabs=[];
$(function(){
	
	/*$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
	    var target = $(e.target).attr("href");
	    AgentLoadTabData(target);	   
	});*/
	
	monthly_load();	  
});
function reload_timezone(){
	 if (MyAjaxChange) {
		 ShowWait(true,"Reloading",function (){ReloadSiteUrl();});
		 
	 }
}
function AgentLoadTabData(target){	
	 if(target=="#tab_1"){
		    if(agentloadedTabs.indexOf(target)==-1){
		    	monthly_load();	    		
		    }
	    }else if(target=="#tab_2"){
		    if(agentloadedTabs.indexOf(target)==-1){
		    	yearly_load();	    		
		    }
	    }
	 agentloadedTabs.push(target);
}
</script>