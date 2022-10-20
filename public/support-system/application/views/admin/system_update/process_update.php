
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Updating") ; ?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">

                <div id="u-progress-bar">
                    <div  class="f-content">
                        <div class="f-w-11 " style="padding-top: 7px;">
                           <div class="progress progress-xs m-b-5">
                              <div id="main-pbar" class="progress-bar progress-bar-success active progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"></div>
                          </div>
                        </div>
                        <div id="per-str" class="f-w-1 text-left p-l-5">10%</div>
                    </div>
                    <div id="up-msg" class="update-msg text-left"><i class="fa fa-clock-o"></i>Starting ...</div>
                </div>    
                <div id="u-cong" class=" hidden  zoomIn text-center">
                    <h3>Congratulation</h3>
                    <h4>Your application has been update into <?php echo $updateObj->new_version;?></h4>
                </div>
                <div id="u-err-cong" class=" hidden  zoomIn text-center text-red">
                    <h3>!! Error on update, Please try again</h3>
                    <h4 id="er-msg"></h4>
                </div>
    
    
    
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
var downloading_icon='<i class="fa animated fa-angle-double-down faa-falling "></i>';

var step=1;
function SetProgessStatus(per,icon,msg){
	if(per>=0){
	   $("#main-pbar").width(per+"%");
	   $("#per-str").text(per+"%");
	}
	
	$("#up-msg").html(icon+" "+msg);
}
function showErrorMsg(msg){
	$("#er-msg").html('<i class="fa fa-times text-danger"></i> '+msg);
	$("#u-err-cong").removeClass("hidden").addClass("animated");
	SetProgessStatus(-1,'<i class="fa fa-times-circle-o text-danger"></i>',msg);
	$("#main-pbar").removeClass("progress-bar-success").removeClass("progress-bar-striped").addClass("progress-bar-danger");
}
$(function(){
	if(step==1){
		step1();
	}
});

function step1(){
	SetProgessStatus(10,downloading_icon,"Downloading ...");
	$.getJSON( "<?php echo admin_url("system-update/process-update/2")?>", function( data ) {
		if(data.status){
			SetProgessStatus(data.data,"","Downloaded");
			step2();
		}else{
			showErrorMsg(data.msg);
		}		 
   });
}
function step2(){
	SetProgessStatus(-1,'<i class="fa fa-gear fa-spin"></i>',"Unzipping ...");
	$.getJSON( "<?php echo admin_url("system-update/process-update/3")?>", function( data ) {
		if(data.status){
			SetProgessStatus(data.data,"","Unziped");
			step3();
		}else{
			showErrorMsg(data.msg);
		}		 
   });
}
function step3(){
	SetProgessStatus(-1,'<i class="fa fa-database faa-flash animated"></i>',"Database Updating ...");
	$.getJSON( "<?php echo admin_url("system-update/process-update/4")?>", function( data ) {
		if(data.status){
			SetProgessStatus(data.data,"","Downloaded");
			step4();
		}else{
			showErrorMsg(data.msg);
		}		 
   });
}

function step4(){
	SetProgessStatus(-1,'<i class="fa fa-gear fa-spin"></i>',"File Updating ...");
	$.getJSON( "<?php echo admin_url("system-update/process-update/5")?>", function( data ) {
		if(data.status){
			SetProgessStatus(data.data,'<i class="fa fa-thumbs-o-up  faa-vertical animated "></i>',"Finished");
			$("#u-progress-bar").fadeOut('fast',function(){
				$("#u-cong").removeClass("hidden").addClass("animated");
			});
		}else{
			showErrorMsg(data.msg);
		}		 
   });
}




</script>