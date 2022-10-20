<?php
/**
 * @var Mapp_settings_advance $mainobj
 */
?>
<div class="row">
	<div class="col-md-12">		
	     <?php  echo form_open ( admin_url("api-setting-confirm/update-payment-basic"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?>
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Payment Basic Settings");?></h3>
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="row">
                	   <div class="col-md-12">
    			            <div class="form-group">
                        		<label class="control-label col-md-3 label-required" for="payment_currencies"><?php _e("Select Allowed Currencies") ; ?></label>
                        		<div class="col-md-9">
                        			<textarea type="text"
                                           class="form-control app-tags" id="payment_currencies" name="payment_currencies"
                                           placeholder="<?php _e("ex. USD,AUD"); ?>" data-bv-notempty="true"
                                          data-bv-notempty-message="<?php  _e(" %s is required","Payment currency");?>"
                                        ><?php echo  $mainobj->GetPostValue("payment_currencies","USD")?></textarea>
                                    <span class="form-group-help-block  "><?php _e("Comma seperated,Enter three-letter currency ISO code");?></span>
                        		</div>


                    	   </div>
                       </div>

                	</div>
			     
			       
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-left">
                  <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button>
                </div>
                <!-- /.footer -->
         </div>
         <!-- /.box -->
         <?php echo form_close();?>
    </div>
</div> 

<script type="text/javascript">
function on_beforesend(form){	 
	   form.find(">.box").addClass("state-loading");
}  
function on_complete(rdata,form){
	   ShowGritterMsg(rdata.msg,rdata.status,rdata.is_sticky,rdata.title,rdata.icon);
	   form.find(">.box").removeClass("state-loading");	  
} 
           
</script>
