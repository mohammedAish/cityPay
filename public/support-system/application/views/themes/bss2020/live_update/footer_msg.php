<div class="w-100">
	<section id="feature-box-container" class="feature-box-container">
		<div class="container-fluid">
   
			<div class="form-row">
                <?php
                $name='footer_text';
                $input=input_box_2020::getInput("Title","Want to get update?");
                get_html_textarea_2020( $input->title, $name, Mapp_setting_api::GetSettingsValue( "system",$name), $input->is_required, $input->placeholder );
                ?>
			
			</div>
   
            
		</div>
	</section>
	<div class="btn-group-md popup-footer ">
		<div class="clearfix">
			
			<div class="float-sm-right text-center text-sm-right ">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> <?php _e("Update");?></button>
				<button type="button" class="close-pop-up btn btn-sm  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel"); ?></button>
			</div>
			<div class="float-sm-left text-center text-sm-left">
			
			</div>
		</div>
	
	
	</div>
</div>
