<div class="w-100">
    <section id="feature-box-container" class="feature-box-container">
        <div class="container-fluid">
            <div class="row">
              
                    <div class="col-sm">
		                <?php
			                get_boolean_input_2020( "Hide This Section", '_fbox_is_hide', getAPIPostValue_2020( '_fbox_is_hide' ),"col-sm" );
		                ?>
                    </div>
                
            </div>
            <div class="row">

                <div class="col-sm">
                    <div class="feature-box d-box-shadow ">
                        <div class="f-icon">
							<?php get_iconpicker_2020("Icon 1","_fbox_icon_1",getAPIPostValue_2020( "_fbox_icon_1" )); ?>
                        </div>
                        <div class="f-title">
                            <div class="form-group ">
                                <input class="form-control " type="text" maxlength="100"
                                       value="<?php echo getAPIPostValue_2020( "_fbox_title_1" ); ?>" id="_fbox_title_1" name="_fbox_title_1"
                                       placeholder="<?php _e( 'Community Forums' ); ?>">
                            </div>
                        </div>
                        <div class="f-content">
                            <div class="form-group ">
                                <textarea class="form-control " type="text"
                                          id="_fbox_dtls_1" name="_fbox_dtls_1"
                                          placeholder="<?php _e( 'Community Forums' ); ?>"><?php echo getAPIPostValue_2020( "_fbox_dtls_1" ); ?></textarea>
                            </div>
                            <div class="form-group ">
                                <textarea class="form-control " type="text"
                                          id="_fbox_link_1" name="_fbox_link_1"
                                          placeholder="<?php _e( 'link, ex. https://example.com' ); ?>"><?php echo getAPIPostValue_2020( "_fbox_link_1" ); ?></textarea>
                            </div>
                        </div>

                    </div>


                </div>
                <div class="col-sm ">
                    <div class="feature-box d-box-shadow">
                        <div class="f-icon">
	                        <?php get_iconpicker_2020("Icon 2","_fbox_icon_2",getAPIPostValue_2020( "_fbox_icon_2" )); ?>
                        </div>
                        <div class="f-title">
                            <div class="form-group ">
                                <input class="form-control " type="text" maxlength="100"
                                       value="<?php echo getAPIPostValue_2020( "_fbox_title_2" ); ?>" id="_fbox_title_2" name="_fbox_title_2"
                                       placeholder="<?php _e( 'Community Forums' ); ?>">
                            </div>
                        </div>
                        <div class="f-content">
                            <div class="form-group ">
                                <textarea class="form-control " type="text"
                                        id="_fbox_dtls_2" name="_fbox_dtls_2"
                                          placeholder="<?php _e( 'Community Forums' ); ?>"><?php echo getAPIPostValue_2020( "_fbox_dtls_2" ); ?></textarea>
                            </div>
                            <div class="form-group ">
                                <textarea class="form-control " type="text"
                                          id="_fbox_link_2" name="_fbox_link_2"
                                          placeholder="<?php _e( 'link, ex. https://example.com' ); ?>"><?php echo getAPIPostValue_2020( "_fbox_link_2" ); ?></textarea>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="col-sm ">
                    <div class="feature-box d-box-shadow">
                        <div class="f-icon">
	                        <?php get_iconpicker_2020("Icon 1","_fbox_icon_3",getAPIPostValue_2020( "_fbox_icon_3" )); ?>
                        </div>
                        <div class="f-title">
                            <div class="form-group ">
                                <input class="form-control " type="text" maxlength="100"
                                       value="<?php echo getAPIPostValue_2020( "_fbox_title_3" ); ?>" id="_fbox_title_3" name="_fbox_title_3"
                                       placeholder="<?php _e( 'Community Forums' ); ?>">
                            </div>
                        </div>
                        <div class="f-content">
                            <div class="form-group ">
                                <textarea class="form-control " type="text"
                                          id="_fbox_dtls_3" name="_fbox_dtls_3"
                                          placeholder="<?php _e( 'Community Forums' ); ?>"><?php echo getAPIPostValue_2020( "_fbox_dtls_3" ); ?></textarea>
                            </div>
                            <div class="form-group ">
                                <textarea class="form-control " type="text"
                                          id="_fbox_link_3" name="_fbox_link_3"
                                          placeholder="<?php _e( 'link, ex. https://example.com' ); ?>"><?php echo getAPIPostValue_2020( "_fbox_link_3" ); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
   <?php
	   //get_iconpicker_2020("Icon 1","_fbox_icon-1","fa fa-star");
   ?>
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
