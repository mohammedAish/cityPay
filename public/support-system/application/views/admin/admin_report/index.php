<div class="row">
    <div class="col-md-12">    
<!-- Info boxes -->
      <div class="row info-box-row">
        <div class="col-md-2 col-sm-4  col-xs-6">
         <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('app-permission/user-list');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-aqua">
            <i class="fa fa-users"></i>
            <span class="sm-outline-text"><?php _e("Total") ; ?></span>
            </span>
           
                <div class="info-box-content">
                  <span class="info-box-text"><?php _e("Active Members") ; ?></span>
                  <span class="info-box-number"><?php echo $totalTicketInfo->active_member;?> 
                         
                  </span>              
                </div>
            
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box --> 
        </div>
                <!-- /.col -->
        <div class="col-md-2  col-sm-4 col-xs-6">
          <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-aqua"><i class="fa fa-ticket"></i>
             <span class="sm-outline-text"><?php _e("Total") ; ?></span>
            </span>
    
            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->total;?></span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
          
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-md-2  col-sm-4 col-xs-6">
          <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket');?>">
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
  <!-- /.col -->
        <div class="col-md-2  col-sm-4 col-xs-6">
        <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/unassigned-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-red">
            <i class="fa fa-ticket"></i>
            <span class="sm-outline-text"><?php _e("Total") ; ?></span>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Unassigned Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->unassigned_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-2 col-sm-4  col-xs-6">
          <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/all-paid-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-red"><i class="fa fa-ticket"></i>            
             <span class="sm-outline-text"><?php _e("Total") ; ?></span>            
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Active Paid Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->paid_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
        <div class="col-md-2  col-sm-4 col-xs-6">
        <a title="<?php _e("Click to see details") ; ?>" data-tooltip-position="right" class="tooltip2" href="<?php echo admin_url('ticket/closed-ticket');?>">
          <div class="info-box info-box-sm">
            <span class="info-box-icon bg-green">
            <i class="fa fa-ticket"></i>
            <span class="sm-outline-text"><?php _e("Total") ; ?></span>
            </span>

            <div class="info-box-content">
              <span class="info-box-text"><?php _e("Total Closed Tickets") ; ?></span>
              <span class="info-box-number"><?php echo $totalTicketInfo->close_ticket;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
   
        
        </div>
   
    
    <!-- solid sales graph bg-green-gradient-->
          <div class="box box-solid  m-b-0">           
            <div class="box-body border-radius-none">
                <div class="control-report">
                    <form id="chart-form" action="">
                        <div class="inline radio-inline">
                        <?php 
                        GetHTMLRadioByArray("Choose Type","report_type","report_type",true,["Y"=>"Year(".date('Y').")","M"=>"Month(".date('F-Y').")"],"Y");
                        ?>
                        </div>
                    </form>
                </div>
             <?php  APPChartJS::ShowByAjaxData(admin_url("admin-report-chart-data/get-agent-month-data"), 120,"#chart-form");?>
            </div>
            <!-- /.box-body -->         
          </div>
          <!-- /.box -->
 
    </div>   
    <div class="col-md-4">
        
          
       
	   
    </div><!-- end 2nd column -->
</div> 
<style>
.art-kn-list li {
	list-style: outside none none;
	padding: 9px 2px;
	border-bottom: 1px dashed rgba(18,17,17,0.11);
}
@media all and (min-width: 992px) {
    .control-report{
    	position: absolute;left: 92px;top: 1px;
    	z-index: 99;
    }
}
.control-report{
	
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
	$("input[name=report_type]").change(function(e){
		$(this).closest('form').submit();
	});
});

</script>