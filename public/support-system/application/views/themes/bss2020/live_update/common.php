<div class="w-100">
	<div class="clearfix form pb-3">
		<?php
			/** @var input_box_2020[] $inputs */
			if(!empty($inputs)) {
				foreach ( $inputs as $name=>$input ) {
				    if($input->type=="B"){
				        ?>
                        <div class="col-sm">
                            <?php
	                            get_boolean_input_2020( $input->title, $name, getAPIPostValue_2020( $name ),"col-sm" );
                            ?>
                        </div>
				        <?php
					    
                    }elseif($input->type=="I"){
					    get_input_image_2020( $input->title, $name, $input->default_value,$input->placeholder,$input->option);
                    }elseif($input->type=="H"){
					    get_html_textarea_2020( $input->title, $name, getAPIPostValue_2020( $name ,true), $input->is_required, $input->placeholder );
                    }elseif($input->type=="m"){
					    get_html_textarea_2020( $input->title, $name, getAPIPostValue_2020( $name ,true), $input->is_required, $input->placeholder );
				    }else {
					    get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );
				    }
				}
			}else{
			    ?>
			    <h4>No input set to update</h4>
			    <?php
            }
			//get_inputbox_2020("Title","_needhlp_title",getAPIPostValue_2020('_needhlp_title'),false,"Still Need Support?");
			//get_inputbox_2020("Description","_needhlp_subtitle",getAPIPostValue_2020('_needhlp_subtitle'),false,"We normally response within 24 hours");
		?>
	</div>
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
