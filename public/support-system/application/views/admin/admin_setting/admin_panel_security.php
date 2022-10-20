<form id="app-dos-form" method="post" action="<?php echo admin_url("admin-setting-confirm/modify-security/a");?>" data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title"><?php _e("Admin Panel Security");?></h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			
			<div class="form-group">
				<label class="control-label col-md-4 label-required" for="app_adctry_block"><?php _e("Status"); ?></label>
				<div class="col-md-8">
					<div class="togglebutton ">
						<input  name="config[app_adctry_block]" value="N" type="hidden">
						<label>
							<input  type="checkbox" <?php echo $mainobj->GetPostValue("app_adctry_block","N")=="Y"?' checked="checked"':'';?> value="Y" class="has_depend_fld" id="app_adctry_block"  name="config[app_adctry_block]" >
						</label>
						<span class="form-group-help-block"><?php _e("If you enable it then app check country for allow or block.");?></span>
					</div>
				
				
				
				</div>
			</div>
			<div class="row"></div>
			<div class="fld-config-app-adctry-block fld-config-app-adctry-block-y">
				<hr class="m-t-0 m-15" />
				<div class="form-group m-b-0">
					<label class="control-label label-required col-md-4 m-t-10" for="status"><?php _e("Country Block Rule"); ?></label>
					<div class="col-md-8">
						<div class="inline radio-inline">
							<?php
								$app_adctrybr_selected  = $mainobj->GetPostValue("app_adctry_brule","B");
								$app_adctrybr_editor_op =array( "B" =>"Block Listed Country", "A" =>"Allow Listed Country Only");
								GetHTMLRadioByArray("Country Block Rule","config[app_adctry_brule]","app_adctry_brule",true,$app_adctrybr_editor_op,$app_adctrybr_selected,false,false,"");
							?>
						
						</div>
					
					</div>
				</div>
				<div class="row"></div>
				<div class="form-group m-l-15">
					<label class="control-label  label-required" for="app_adctry_list"><?php _e("Country List"); ?></label>
					<textarea class="form-control app-tags"  id="app_adctry_list" name="config[app_adctry_list]"><?php echo  $mainobj->GetPostValue("app_adctry_list")?></textarea>
					<span class="form-group-help-block"><?php _e("Enter 2 digit Country Code(ex. US,CA,BD), Separated by comma");?></span>
				</div>
				<div class="form-group m-b-0">
					<label class="control-label label-required col-md-4 m-t-10" for="status"><?php _e("Block Page"); ?></label>
					<div class="col-md-8">
						<div class="inline radio-inline">
							<?php
								$app_adctrypbr_selected  = $mainobj->GetPostValue("app_adctry_ptype","H");
								$app_adctrybr_editor_pop =array( "H" =>"Redirect To Home Page", "E" =>"Show Error Page");
								GetHTMLRadioByArray("On Block Page","config[app_adctry_ptype]","app_adctry_ptype",true,$app_adctrybr_editor_pop,$app_adctrypbr_selected,false,false,"");
							?>
						
						</div>
					
					</div>
				</div>
			</div>
		
		
		
		
		
		
		</div>
		<!-- /.box-body -->
		<div class="box-footer ">
			<div class="row">
				<div class="col-sm-6 hidden-xs"></div>
				<div class="col-sm-6 text-right"><button id="color-submit-btn" type="submit" class="btn btn-sm btn-success" ><i class="fa fa-save"></i> Save</button></div>
			</div>
		
		</div>
		<!-- /.footer -->
	</div>
	<!-- /.box -->
</form>