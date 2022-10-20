<div class="clearfix form-horizontal">
<div class="row">
	<div class="col-md-7">
	<?php     
    if(empty($mainobj)){
        $mainobj=new Mremote_server();
        AddError("Main object has not initialized in controller");
    }
    $except=array();
    $disabled=array();
    if(!$isUpdate){       
        $mainobj->button_txt="Login Button";
        $mainobj->button_color="#dddddd";
     }else{
         
    	//$except[]="name,login_url,valid_url,button_color,button_txt,server_type,status";
    	//$disabled[]="name,login_url,valid_url,button_color,button_txt,server_type,status";
    }
    $mainobj->GetAddForm(4,8,NULL,$except,$disabled);
?>	
	</div>
	<div class="col-md-5 md-p-l-0">	
	<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Preview") ; ?></h3>   
                
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center" style="min-height: 100px;">
                	<button id="target-btn" class="btn btn-sm">
                	   <img src="<?php echo $mainobj->getImageUrl(true);?>" alt="button-img" class="btn-img" style="<?php if(!$mainobj->hasImageFile()){?>display: none;<?php }?> max-height: 13px;" />
                	   <span class="btn-text"></span>
                	</button>
                </div>
                <!-- /.box-body -->
               
         </div>
         <?php if($isUpdate){?>
         <div class="row"></div><br/>
         <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Your server's redirect URL") ; ?></h3>   
                
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="min-height: 150px;">                	
                	<div class="" ><?php echo site_url("user/remote-login/{$mainobj->id}?token=")?><span class="text-danger">&lt;token&gt;</span></div>
                	
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-left">
                 <small class="help-text " style="font-style: italic;font-weight: bold;"><?php _e("NB. %s will be your server's login token, by this it can validated the user",'<span class="text-danger">&lt;token&gt;</span>') ; ?></small>
                </div>
                <!-- /.footer -->
         </div>
         <?php }?>
	
	</div>
</div>
  
</div>
<div class="row btn-group-md popup-footer text-right">
	<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $isUpdate?__("Update"):__("Save")?></button>
	<button type="button" class="close-pop-up btn  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel");?></button>
</div>
<script type="text/javascript">
function button_change(){
	var targetBtn=$("#target-btn");
	var targetText=$("#target-btn > .btn-text");
	var text=$("#button_txt").val();
	var bgcolor=$("#button_color").val();
	var txtcolor=$("#button_text_color").val();
	targetText.text(text);
	targetBtn.css({"background":bgcolor,"color":txtcolor});
}
function image_changed(src){
	 if($("input#file_deleted").length==0){
		 $(".app-lb-ajax-form").append('<input id="file_deleted" type="hidden" name="file_deleted" value="N">')
	 }
	if(src){
		$("#target-btn > img.btn-img").attr("src",src).show();	
		<?php if($isUpdate){?>		
			 $("input#file_deleted").val("N");		 
		<?php }?>	
	}else{
		$("#target-btn > img.btn-img").attr("src",src).hide();	
		<?php if($isUpdate){?>
		 $("input#file_deleted").val("Y");		 
		<?php }?>
	}
}
$(function(){
	button_change();
	$("#button_txt").on("keyup",function(){
		button_change();
	});
	$("#button_color,#button_text_color").on("change",function(){
		   button_change();
    });
    setTimeout(function(){
   	 $("#name").focus();
   	},500);
   
});
</script>