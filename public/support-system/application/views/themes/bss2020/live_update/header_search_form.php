<div class="w-100">
	<div class="clearfix form pl-3 pr-3 pb-3 pt-0">
        <div class="form-row bss2020_style_chooser">
            <div class="col-sm-4">
                <?php
                $name='_src_style';
                $options=[
                    "bss2020_head_20"=>'<div  class="apbd-rdo-container ape-animated-pr-hover"><div class="i-container"><img src="'.image_url("theme/bss2020/images/bss2020_head_20.jpg").'"/></div><div>'.__("Style 2020").'</div></div>',
                    "bss2020_head_21"=>'<div  class="apbd-rdo-container ape-animated-pr-hover"><div class="i-container"><img src="'.image_url("theme/bss2020/images/bss2020_head_21.jpg").'"/></div><div>'.__("Style 2021").'</div></div>',

                ];
                $input=input_box_2020::getInput("Style","",true,'R',$options);

                get_radio_2020( $input->title, $name, getAPIPostValue_2020( $name ,false,'bss2020_head_20'), $input->option,"",false,"has_depend_fld");
                ?>


            </div>



        </div>
        <div class="form-row">
            <?php
            $name='_src_home_title';
            $input=input_box_2020::getInput("Heading","Looking for help?");
            get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder ,'col-sm-5');
            ?>

            <?php
            $name='_src_home_subtitle';
            $input=input_box_2020::getInput("Subtitle","Write into the box to search & get result immediately");
            get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );
            ?>
        </div>
        <div class="form-row">
		<?php
			$name='_src_placeholder';
			$input=input_box_2020::getInput("Input box placeholder","Ask Your Question");
			get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder,'col-sm-5 ' );


			$name='_src_rdy_msg';
			$input=input_box_2020::getInput("Search Ready Message","Ready To Search");
			get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder );



			?>
        </div>
        <div class="form-row">
            <?php

            $name='_src_text_color';
            $input=input_box_2020::getInput("Text Color","Choose text Color");
            get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder,"col-sm","app-color-picker2" );

            $name='_src_bg_color';
            $input=input_box_2020::getInput("Background Color","Choose Background Color");
            get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder,"col-sm","app-color-picker2" );

            $name='_src_hr_img';
            $input=input_box_2020::getBoolenInput("Hide Right Image","N");
            get_boolean_input_default_2020( $input->title, $name, getAPIPostValue_2020( $name ),"col-sm-3 " ,'has_depend_fld');

            ?>
        </div>
        <div class="form-row">
			<?php
                $bgImageUrl=base_url("theme/bss2020/images/bg-4.svg");
                $tempBg=get_bg_image_link_2020();
                $hasCustomBg=false;
                if(!empty($tempBg)){
                    $bgImageUrl=$tempBg;
	                $hasCustomBg=true;
                }
                $name='_src_bg_img';
                $input=input_box_2020::getImageInput("Background Image",$bgImageUrl,"Best size is 1900px X 900px",'width:371px; height:176px');

                ?>
                <div class="form-group col-sm ">
                    <label class="col-form-label" for="<?php echo $name; ?>"><?php _e( $input->title ); ?></label>
                    <div class="live-bg-image position-relative">
                        <img class="app-image-input img-thumbnail" data-name="<?php echo $name; ?>" src="<?php echo $input->default_value; ?>" style="<?php echo $input->option; ?>"/>
                        <div class="form-group-help-block"><?php _e( $input->placeholder ); ?></div>
                        <?php if($hasCustomBg){ ?>
                            <button id="del-img2" class="img-input-del btn btn-sm"  type="button" data-dname="<?php echo $name; ?>_del" data-base="<?php echo base_url("theme/bss2020/images/bg-4.svg"); ; ?>" ><i class="fa fa-trash-alt"></i></button>
                        <?php } ?>
                    </div>
                </div>
                <?php
                    $imageUrl=base_url("theme/bss2020/images/right-img.svg");
	                $tempRightIm=get_right_image_link_2020(true);
	                $hasCustomRI=false;
                    if(!empty($tempRightIm)){
                        $imageUrl=$tempRightIm;
	                    $hasCustomRI=true;
                    }
                    $name='_src_right_img';
                    $input=input_box_2020::getImageInput("Right Side Image",$imageUrl,"Best size is 475px X 420px",'width:200px; height:176px');

			    ?>
            <div class="form-group col-sm-5  fld--src-hr-img fld--src-hr-img-n">
                <label class="col-form-label" for="<?php echo $name; ?>"><?php _e( $input->title ); ?></label>
                <div class="position-relative">
                    <img class="app-image-input img-thumbnail" data-name="<?php echo $name; ?>" src="<?php echo $input->default_value; ?>" style="<?php echo $input->option; ?>"/>
                    <div class="form-group-help-block"><?php _e( $input->placeholder ); ?></div>
                    <?php if($hasCustomRI){ ?>
                        <button id="del-img" class="img-input-del btn btn-sm"  type="button" data-dname="<?php echo $name; ?>_del" data-base="<?php echo base_url("theme/bss2020/images/right-img.svg"); ?>" ><i class="fa fa-trash-alt"></i></button>
                    <?php } ?>
                </div>
            </div>
            </div>



        <script>
            jQuery( document ).ready(function( $ ) {
               $(".img-input-del").on("click",function(e){
                   e.preventDefault();
                   $(this).parent().find('img.app-image-input').attr('src',$(this).data('base'));
                   $(this).after('<input name="'+$(this).data('dname')+'" value="Y" type="hidden"/>');
                   $(this).remove();
               });

            });
        </script>
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
