<div class="w-100">
	<section id="feature-box-container" class="feature-box-container">
		<div class="container-fluid">
			<div class="form-row">
				
				<div class="col-sm">
					<?php
						get_boolean_input_2020( "Enable MailChimp", 'is_mailchimp', Mapp_setting_api::GetSettingsValue( "MailChimp","is_mailchimp"),"col-sm" );
					?>
				</div>
			
			</div>
   
			<div class="form-row">
                <?php
                $name='title';
                $input=input_box_2020::getInput("Title","Want to get update?");
                get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );
                ?>
			
			</div>
            <div class="form-row">
				<?php
					$name='sub_title';
					$input=input_box_2020::getInput("Subtitle","Subscribe with to newsletter, to get latest update and news from us");
					get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );
				?>

            </div>
            <div class="form-row">
				<?php
					$name='placeholder';
					$input=input_box_2020::getInput("Placeholder","Enter Your Email Address");
					get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );
				?>

            </div>
            <div class="form-row">
				<?php
					$name='subs_btn';
					$input=input_box_2020::getInput("Button Name","Subscribe");
					get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );
				?>

            </div>
            <p class="text-success mt-3"><?php _e("You have to enter api key to show this in web site. Please configure those settings in admin panel, to configure those go to") ; ?>
                <br/>
                <span class="card mt-3">
                    <span class="card-body pt-2  pb-2">
                        <small>Admin Menu >> API Settings >> MailChimp <?php _e("or") ; ?>  <a class="btn btn-success btn-sm" href="<?php echo site_url("admin/api-setting/api/MailChimp"); ?>"><?php _e("Click here") ; ?></a></small>
                    </span>
                </span>
                
            </p>
            
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
