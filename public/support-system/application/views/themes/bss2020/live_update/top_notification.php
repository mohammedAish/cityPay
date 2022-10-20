<div class="w-100">
    <div class="clearfix form pl-3 pr-3 pb-3 pt-0">
        <div class="form-row">
            <?php
            $name='top_noti_color';
            $input=input_box_2020::getInput("Background Color","Choose Background Color");
            get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ), $input->is_required, $input->placeholder,"col-sm","app-color-picker2" );


            $name='top_noti_text_color';
            $input=input_box_2020::getInput("Text Color","Choose Text Color");
            get_inputbox_2020( $input->title, $name, getAPIPostValue_2020( $name ,false."#ffffff"), $input->is_required, $input->placeholder,"col-sm","app-color-picker2" );
            ?>
        </div>

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
