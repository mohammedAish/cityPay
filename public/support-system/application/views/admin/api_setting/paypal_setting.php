<div class="row">
	<div class="col-md-12">		
	     <?php  echo form_open ( admin_url("api-setting-confirm/update-paypal"),array("class"=>"form app-ajax-form form-horizontal","id"=>"app_basic_form","method"=>"post","data-on-complete"=>"on_complete","data-beforesend"=>"on_beforesend","data-multipart"=>"true"));?> 
	        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e("Paypal Settings");?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                	<div class="row">
                	   <div class="col-md-8">
                    	   <div class="form-group m-b-0">	                	
    				      	<label class="control-label col-md-2 label-required" for="is_enable_paypal">Enable Paypal</label>
    				      	<div class="col-md-10">
    					     	<div class="togglebutton ">
    						    	<input  name="config[is_enable_paypal]" value="N" type="hidden">
    								<label> 
    									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_enable_paypal","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_enable_paypal"  name="config[is_enable_paypal]" > 
    								</label>
    								<span class="form-group-help-block"><?php _e("Enable this to enable paypal payment");?></span>
    							</div>
    							
        				      	</div>				      	
    			            </div>
                    	   <hr class="form-group fld-config-is-enable-paypal fld-config-is-enable-paypal-y m-0" />
                    	    <div class="form-group fld-config-is-enable-paypal fld-config-is-enable-paypal-y">	                	
        				      	<label class="control-label col-md-2 label-required" for="is_test_mode">Test Mode</label>
        				      	<div class="col-md-10">
        					     	<div class="togglebutton ">
        						    	<input  name="config[is_test_mode]" value="N" type="hidden">
        								<label> 
        									<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_test_mode","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="is_test_mode"  name="config[is_test_mode]" > 
        								</label>
        								<span class="form-group-help-block  "><span class="text-danger text-bold fld-config-is-test-mode fld-config-is-test-mode-y"><?php _e("Disable this if you want real payment");?></span><span class="text-yellow text-bold fld-config-is-test-mode fld-config-is-test-mode-n"><?php _e("If you enable this, then all payment will be in test mode. Don't do this if you want real payment");?></span></span>
        								
        							</div>
        							
        				      	</div>				      	
    			            </div>
    			            
    			            <div class="form-group fld-config-is-enable-paypal fld-config-is-enable-paypal-y">
                        		<label class="control-label col-md-2 label-required" for="client_id">Client ID</label>
                        		<div class="col-md-10">                   			     	
                        			<input type="text"   value="<?php echo  $mainobj->GetPostValue("client_id")?>" class="form-control" id="client_id" name="config[client_id]" placeholder="<?php _e("Client ID"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Client Id <?php  _e(" is required");?>">
                        		</div>
                    	   </div> 
                    	   
                    	     
    			            <div class="form-group fld-config-is-enable-paypal fld-config-is-enable-paypal-y">
                        		<label class="control-label col-md-2 label-required" for="secret">Secret</label>
                        		<div class="col-md-10">                   			     	
                        			<input type="text"   value="<?php echo  $mainobj->GetPostValue("secret")?>" class="form-control" id="secret" name="config[secret]" placeholder="<?php _e("Secret"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Secret <?php  _e(" is required");?>">
                        		</div>
                    	   </div>
                           <div class="form-group fld-config-is-enable-paypal fld-config-is-enable-paypal-y">
                               <label class="control-label col-md-2 label-required" for="secret"><?php _e("Currency"); ?></label>
                               <div class="col-md-10">
                                   <select  class="form-control" id="p_currency" name="config[p_currency]" placeholder="<?php _e("Currency"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="Currency <?php  _e(" is required");?>">
                                       <?php
                                             $selectedc=$mainobj->GetPostValue("p_currency","USD");
                                             $pcurrencry=["USD" => "U.S. Dollar","AUD" => "Australian Dollar","CAD" => "Canadian Dollar","CZK" => "Czech Koruna","DKK" => "Danish Krone","EUR" => "Euro","HKD" => "Hong Kong Dollar","HUF" => "Hungarian Forint","INR" => "Indian Rupee","ILS" => "Israeli New Sheqel","MXN" => "Mexican Peso","NOK" => "Norwegian Krone","NZD" => "New Zealand Dollar","PHP" => "Philippine Peso","PLN" => "Polish Zloty","GBP" => "Pound Sterling","RUB" => "Russian Ruble","SGD" => "Singapore Dollar","SEK" => "Swedish Krona","CHF" => "Swiss Franc","THB" => "Thai Baht"];
                                             foreach ($pcurrencry as $pcode=>$ptitle) {
                                                 GetHTMLOption($pcode, $ptitle."($pcode)",$selectedc);
                                             }
                                       ?>
                                   </select>
                               </div>
                           </div>

                       </div>
                	   <div class="col-md-4">
                	   <div class="panel panel-default">                	   
                	     <div class="panel-body">
                	         Instruciton for PayPal details : 
                	         <ol class="p-l-15">
    						  <li>Go to PayPal Developer Panel.<a target="blank" href="https://developer.paypal.com/developer/" class="btn btn-xs btn-info">Click Here</a></li>
    						  <li>And click the button "Login to Dashboard". </li>
    						  <li>And follow the instuction on your dashboard. </li>
    						 </ol>
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
