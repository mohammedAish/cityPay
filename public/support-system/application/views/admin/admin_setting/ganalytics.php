<?php
$ganalysis=new Mapp_settings_api_advance();
$ganalysis->SetAPIName("gana");
?>
<form id="app-fbc-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-analytics/e");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa ap" style="font-size: 21px;vertical-align: -4px;">&#xe927;</i> <?php _e("Google Analytics Settings");?></h3>
            <div class="box-tools pull-right">
                <button type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-4 label-required" for="is_ga_active"><?php _e("Enable"); ?></label>
                        <div class="col-md-8">
                            <div class="togglebutton ">
                                <input  name="config[is_ga_active]" value="N" type="hidden">
                                <label>
                                    <input type="checkbox" <?php echo $ganalysis->GetPostValue("is_ga_active","N")=="Y"?' checked="checked"':'';?>value="Y" class="has_depend_fld2" id="is_ga_active" name="config[is_ga_active]" >
                                </label>
                                <span class="form-group-help-block"><?php _e("To enable facebook messenger chat");?></span>
                            </div>

                        </div>
                    </div>
                    <div class="form-group  fld-config-is-ga-active fld-config-is-ga-active-y">
                        <label class="control-label col-md-4 label-required" for="gtag_id"><?php _e("Google Analytics Gtag ID"); ?></label>
                        <div class="col-md-6">
                            <input type="text" maxlength="255" value="<?php echo  $ganalysis->GetPostValue("gtag_id")?>" class="form-control" id="gtag_id" name="config[gtag_id]" placeholder="<?php _e("Analytics Gtag ID"); ?>" data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",__("Gtag ID"));?>">
                        </div>
                    </div>

                </div>

            </div>








        </div>
        <!-- /.box-body -->
        <div class="box-footer text-right">
            <button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> <?php _e("Save");?></button>
        </div>
        <!-- /.footer -->
    </div>
    <!-- /.box -->
</form> <!-- CSS & JS -->