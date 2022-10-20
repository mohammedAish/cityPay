<?php
if(empty($pageObj)){
    $pageObj=new Mcustom_page();
}
?>
<div class="row" >
    <?php
    if(!$this->input->is_ajax_request()){ ?>
        <div class="col-md-12">
            <?php echo $pageObj->page_body;?>
        </div>
    <?php }else{ ?>
    <div class="col-md-12">
		<?php
			if ( ! empty( $pageObj ) ) {
				?>
                <div class="panel panel-default app-panel-box">


                    <div class="panel-body kn-details-container">
						<?php echo $pageObj->page_body; ?>
                    </div>
                </div>
			<?php } else {
				?>
                <div class="alert alert-danger"><?php _e( "No detials found" ); ?></div>
			<?php } ?>
        </div>
    </div>
    <div class="row btn-group-md popup-footer text-right">
        <button type="button" class="close-pop-up btn btn-sm btn-danger"><i
                    class="fa fa-times"></i> <?php _e( "Close" ); ?></button>
    </div>
<?php
	}?>
