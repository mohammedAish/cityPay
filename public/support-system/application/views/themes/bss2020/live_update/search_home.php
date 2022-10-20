<div class="w-100">
    <div class="clearfix form pb-3">
        <?php
            get_inputbox_2020("Heading","_src_home_title",getAPIPostValue_2020('_src_home_title'),false,"Looking for help?");
            get_inputbox_2020("Subtitle","_src_home_subtitle",getAPIPostValue_2020('_src_home_subtitle'),false,"Write into the box to search & get result immediately");
            get_inputbox_2020("Input box placeholder","_src_placeholder",getAPIPostValue_2020('_src_placeholder'),false,"Ask You Question");
            get_inputbox_2020("Search Ready Message","_src_rdy_msg",getAPIPostValue_2020('_src_rdy_msg'),false,"Ready To Search");
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
