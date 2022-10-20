<?php
if(empty($pageObj)){
    $pageObj=new Mcustom_page();
}
?>
<div class="container-fluid">


<div class="row" >
    <?php
    if(!$this->input->is_ajax_request()){ ?>
        
        <div class="col-sm-12 ">
            <?php echo $pageObj->page_body;?>
        </div>
    <?php }else{ ?>
    <div class="col-sm-12 mb-3">
		<?php
			if ( ! empty( $pageObj ) ) {
				?>
                <div class="card card-default app-panel-box">


                    <div class="card-body kn-details-container">
						<?php echo $pageObj->page_body; ?>
                    </div>
                </div>
			<?php } else {
				?>
                <div class="alert alert-danger"><?php _e( "No detials found" ); ?></div>
			<?php } ?>
        </div>
    </div>
    <div class="btn-group-md popup-footer ">
        <div class="clearfix">
            <div class="float-sm-right text-center text-sm-right ">
                <button type="button" class="close-pop-up btn btn-sm  btn-danger"><i class="fa fa-times"></i> <?php _e("Cancel"); ?></button>
            </div>
            <div class="float-sm-left text-center text-sm-left">

            </div>
        </div>
    </div>
<?php
	}?>
</div>
