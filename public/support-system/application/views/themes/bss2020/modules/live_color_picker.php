<div id="live-site-color-picker" class="live-site-color-picker">
    <span id="live-color-opener" class="btn-picker-opener"><i class="align-self-center fas fa-cog"></i></span>
    <div class="container-fluid">
        <form id="live_color_form" action="<?php echo admin_url('admin-setting-confirm/modify/o'); ?>" method="post">
        <div class="card">
            <div class="card-header">
                <?php _e("App Color Settings") ; ?>
            </div>
            <div class="card-body">
                
                    <div class="form-row">
                        <div class="form-group">
                            <label for=""><?php _e("Main Color") ; ?></label>
                            <input class="form-control"  type="text" maxlength="200"
                                   value="<?php echo Mapp_setting::GetSettingsValue("app_main_color","#a6ffa9"); ?>"
                                   id="app_main_color" name="config[app_main_color]"
                                   placeholder="Live Color Picker" >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="section_color"><?php _e("Section Background Color") ; ?></label>
                            <input class="form-control app-color-picker2"  type="text" maxlength="200"
                                   value="<?php echo  Mapp_setting_api::GetSettingsValue( "bss2020","section_color","rgba(235, 235, 235, 0.3)" ); ?>"
                                   id="section_color" name="api[bss2020][section_color]"
                                   placeholder="Section Background color" >

                        </div>
                    <div class="form-group col-sm">
                        <label for="top_notification_color"><?php _e("Top Notification Backgorund") ; ?></label>
                        <input class="form-control app-color-picker2"  type="text" maxlength="200"
                               value="<?php echo  Mapp_setting_api::GetSettingsValue( "bss2020","top_noti_color" ); ?>"
                               id="top_notification_color" name="api[bss2020][top_noti_color]"
                               placeholder="Section Background color" >

                    </div>
                </div>
                    <div class="form-row">
	                    <?php
		                    $name='config[app_c_auto]';
		                    $input=input_box_2020::getBoolenInput("Auto Others Color","Y");
		                    get_boolean_input_default_2020( $input->title, $name, Mapp_setting::GetSettingsValue("app_c_auto","Y"),"" ,'has_depend_fld');
	
	                    ?>
                     
                    </div>
                    <div class="fld-config-app-c-auto fld-config-app-c-auto-n">
                        <div class="form-row">
                            <?php
                                $name='app_text_color';
                                $title='Link And Heading Text';
                                $default="";
                            ?>
                            <div class="form-group col-sm">
                                <label for=""><?php _e($title) ; ?></label>
                                <input class="app-color-picker2 form-control"  type="text" maxlength="200"
                                       value="<?php echo Mapp_setting::GetSettingsValue($name,$default); ?>"
                                       id="app_text_color" name="config[<?php echo $name; ?>]"
                                       placeholder="<?php echo $title; ?>" >
                            </div>
                        </div>
                        <div class="form-row">
	
	                        <?php
		                        $name='footer_bg_color';
		                        $title='Footer Background';
		                        $default="";
	                        ?>
                            <div class="form-group col-sm">
                                <label for=""><?php _e($title) ; ?></label>
                                <input class="app-color-picker2 form-control"  type="text" maxlength="200"
                                       value="<?php echo Mapp_setting::GetSettingsValue($name,$default); ?>"
                                       id="app_text_color" name="config[<?php echo $name; ?>]"
                                       placeholder="<?php echo $title; ?>" >
                            </div>

	                        <?php
		                        $name='footer_text_color';
		                        $title='Footer Text Color';
		                        $default="";
	                        ?>
                            <div class="form-group col-sm">
                                <label for=""><?php _e($title) ; ?></label>
                                <input class="app-color-picker2 form-control"  type="text" maxlength="200"
                                       value="<?php echo Mapp_setting::GetSettingsValue($name,$default); ?>"
                                       id="app_text_color" name="config[<?php echo $name; ?>]"
                                       placeholder="<?php echo $title; ?>" >
                            </div>
                    </div>
                    </div>
                   
               
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-sm"><?php _e("Update") ; ?></button>
            </div>
           
        </div>
        </form>
    </div>
</div>

<script>
    jQuery( document ).ready(function( $ ) {
        $("#live-color-opener").on("click",function(e){
            e.preventDefault();
            $("#live-site-color-picker").toggleClass('open');
        });
       $("#app_main_color").spectrum({
           showInitial: true,
           showAlpha: false,
           showInput: true,
           allowEmpty:false,
           palette: [
               ["#ce2727","#c70f0f","#ce2753","#c90007"],
               ["#c2c70f","#b5ce27","#82ce27","#00a606"],
               ["#69c70f","#55ce27","#20c70f","#0fc758"],
               ["#27ce42","#27ce76","#27ceaa","#0fc7a9"],
               ["#2750ce","#0f43c7","#240fc7","#3927ce"],
               ["#27b8ce","#0f8cc7","#8a27ce","#ce27c1"],
               ["#c70fb7","#c70f7e","#ce277f","#c70f4e"],
               ["#dd8b55","#c76b0f","#ce6a27","#b15b22"]
           ]
       });
       var main_style_url="<?php echo base_url("theme/bss2020/css/style.css"); ?>";
       $("#live_color_form").on("submit",function (e) {
           e.preventDefault();
           <?php
           if(false && ISDEMOMODE){
               ?>
                ShowGritterMsg('Disabled in demo mode',false,false,"Demo Mode");
               return;
               <?php
           }else{
           ?>
           var url=$(this).attr("action");
           var data=$("#live_color_form").serialize();
           CallMyAjax(url,data,function(){
               ShowWait(true);
           },function(rdata){
               if(rdata.status){
                   var finalCss=main_style_url+'?v='+Date.now();
                   $('<link rel="stylesheet" href="'+finalCss+'">').load(finalCss,function(e){
                      var scrollTop=$(window).scrollTop();
                       ShowWait(false);
                       $("link#main_theme_style").attr("href",main_style_url+'?v='+Date.now());
                       setTimeout(function(){
                           $("html, body").animate({ scrollTop: scrollTop }, 500);
                       },500);
                      
                   });
               }else{
                   ShowWait(false);
                   ShowGritterMsg(rdata.msg,rdata.status,false,rdata.title,rdata.icon);
               }
           },true,function(){
           
           });
           <?php } ?>
       });
    });
</script>