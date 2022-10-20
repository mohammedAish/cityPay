<form method="post" action="<?php echo admin_url( "admin-setting-confirm/modify/i" ); ?>"
      data-beforesend="on_beforesend" data-on-complete="on_complete" class="form app-ajax-form form-horizontal">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><?php _e( "Ticket Settings" ); ?></h3>
            <div class="box-tools pull-right">
                <button id="captcha-submit-btn" type="submit" class="btn btn-sm btn-success"><i
                            class="fa fa-save"></i> <?php _e( "Save" ); ?></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="is_guest_ticket"><?php _e( "Enable Guest Ticket" ); ?></label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[is_guest_ticket]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "is_guest_ticket", "Y" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="is_guest_ticket" name="config[is_guest_ticket]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it then any visitor can open ticket without registration" ); ?></span>
                    </div>

                </div>
            </div>


            <div class="form-group app-popover-html" data-trigger="hover" data-custom-content="#gprirpty"
                 data-placement="top">
                <label class="control-label col-md-4 label-required"
                       for="is_alpguest_ticket"><?php _e( "Show all priroty on Guest Ticket" ); ?></label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[is_alpguest_ticket]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "is_alpguest_ticket", "N" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="is_alpguest_ticket" name="config[is_alpguest_ticket]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable this then guest user also get all priroty as dropdown option" ); ?></span>
                    </div>

                </div>
                <div style="display: none;">
                    <div id="gprirpty">
                        <img style="width: 250px" src="<?php echo base_url( "images/priroty.jpg" ) ?>" alt=""/>
                    </div>
                </div>
            </div>
	
	        <?php /* ?>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="is_public_ticket"><?php _e( "Enable Public Ticket" ); ?></label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[is_public_ticket]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "is_public_ticket", "N" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="is_public_ticket" name="config[is_public_ticket]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it then user can open their ticket as public mode. Where any user can replay" ); ?></span>
                    </div>

                </div>
            </div>
            <?php */?>

            <div class="row"></div>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="ticket_htmleditor"><?php _e( "Enable HTML Input" ); ?></label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[ticket_htmleditor]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "ticket_htmleditor", "Y" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="ticket_htmleditor" name="config[ticket_htmleditor]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you disable this then your will get normal text area box insted of html editor" ); ?></span>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="any_can_assign"><?php _e( "Any Staff Can Reply" ); ?>?</label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[any_can_assign]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "any_can_assign", "N" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="any_can_assign" name="config[any_can_assign]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it, then any staff can reply on any ticket, if disable then only assigned staff can reply." ); ?></span>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="is_priority_hide"><?php _e( "Hide Priority Input " ); ?>?</label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[is_priority_hide]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "is_priority_hide", "N" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="is_priority_hide" name="config[is_priority_hide]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it, then priority input will be hidden form ticket open form." ); ?></span>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="is_priority_ad_hide"><?php _e( "Hide Priority From Admin Panel " ); ?>?</label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[is_priority_ad_hide]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "is_priority_ad_hide", "N" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="" id="is_priority_ad_hide" name="config[is_priority_ad_hide]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it, then priority will be hidden form all over in admin panel." ); ?></span>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="enable_aclose"><?php _e( "Enable Auto Close" ); ?>?</label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[enable_aclose]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "enable_aclose", "N" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="has_depend_fld" id="enable_aclose" name="config[enable_aclose]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it, then inactive ticket will be closed automatically by auto closing rule" ); ?></span>
                    </div>

                </div>
            </div>
            <div class="fld-config-enable-aclose fld-config-enable-aclose-y">
                <hr class="m-10"/>
                <div class="form-group">
                    <label class="control-label col-md-4 label-required"
                           for="aclosing_rule"><?php _e( "Auto Closing Rule" ); ?></label>
                    <div class="col-md-6">
                        <div class="input-group">
                                     <span class="input-group-addon"
                                           id="basic-addon1"><?php _e( "Close ticket which has been inactive for " ); ?></span>
                            <input type="number" maxlength="3"
                                   value="<?php echo $mainobj->GetPostValue( "aclosing_rule", 72 ) ?>"
                                   class="form-control" id="aclosing_rule"
                                   name="config[aclosing_rule]"
                                   data-bv-notempty="true"
                                   data-bv-notempty-message="<?php _e( "%s is required", __( "Closing Rule" ) ); ?>">
                            <span class="input-group-addon" id="basic-addon1"><?php _e( "hours" ); ?></span>
                        </div>
                        <span class="form-group-help-block"><?php _e( "The ticket will be close which is inactive for client response" ); ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4 label-required"
                           for="aclosing_msg"><?php _e( "Closing Message" ); ?></label>
                    <div class="col-md-7">
                                     <textarea maxlength="255" style="min-height: 150px;"
                                               class="form-control" id="aclosing_msg"
                                               name="config[aclosing_msg]"
                                               data-bv-notempty="true"
                                               data-bv-notempty-message="<?php _e( "%s is required", __( "Closing message" ) ); ?>"><?php echo $mainobj->GetPostValue( "aclosing_msg" ); ?></textarea>


                        <span class="form-group-help-block"><?php _e( "The ticket will be close which is inactive for client response" ); ?><br/><a
                                    target="_blank"
                                    href="<?php echo admin_url( "email-templates/edit/TAC" ); ?>"><?php _e( "View Closing Email Template" ); ?></a></span>
                    </div>

                </div>
                <hr class="m-10"/>
            </div>


            <hr>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="per_user_max_ticket"><?php _e( "User Max Open Ticket" ); ?>?</label>
                <div class="col-md-7">
                    <input style="max-width: 150px;" type="number" maxlength="2"
                           value="<?php echo $mainobj->GetPostValue( "per_user_max_ticket", '0' ) ?>"
                           class="form-control" id="per_user_max_ticket"
                           name="config[per_user_max_ticket]">
                    <span class="form-group-help-block"><?php _e( "Set 0 for unlimited, if you set 2 then you can open 2 ticket simultaneously, s/he can't open any other ticket until those 2 ticket closed" ); ?></span>
                </div>
            </div>

            <hr>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="is_user_can_reopen"><?php _e( "User Can Re-Open Ticket?" ); ?></label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[is_user_can_reopen]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "is_user_can_reopen", "Y" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="has_depend_fld" id="is_user_can_reopen"
                                   name="config[is_user_can_reopen]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you disable it then user can not re-open ticket" ); ?></span>
                    </div>

                </div>
            </div>
            <div class="fld-config-is-user-can-reopen fld-config-is-user-can-reopen-y">
                <div class="form-group ">
                    <label class="control-label col-md-4 label-required"
                           for="reopen_time"><?php _e( "Re-Open Time" ); ?>?</label>
                    <div class="col-md-7">
                        <div class="input-group" style="max-width: 150px;">
                            <input type="number" maxlength="2"
                                   value="<?php echo $mainobj->GetPostValue( "reopen_time", '0' ) ?>"
                                   class="form-control" id="reopen_time"
                                   name="config[reopen_time]">
                            <span class="input-group-addon"><?php _e( "Days" ); ?></span>
                        </div>
                        <span class="form-group-help-block"><?php _e( "Set 0 then use can re-open ticket any time, if you set 7 then user can re-open the ticket which is closed within 7 days." ); ?></span>
                    </div>

                </div>
                <hr>
            </div>


            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="ticket_email_rp_str"><?php _e( "Email Reply Start Text" ); ?></label>
                <div class="col-md-8">
                    <input type="text" maxlength="255"
                           value="<?php echo $mainobj->GetPostValue( "ticket_email_rp_str" ) ?>" class="form-control"
                           id="ticket_email_rp_str" name="config[ticket_email_rp_str]"
                           placeholder="<?php _e( "Email Reply Start Text" ); ?>" data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e( "%s is required", __( "Email Reply Start Text" ) ); ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4 label-required"
                       for="allow_ticket_file_upload"><?php _e( "Enable Ticket Feedback" ); ?></label>
                <div class="col-md-8">
                    <div class="togglebutton ">
                        <input name="config[fb_enable]" value="N" type="hidden">
                        <label>
                            <input type="checkbox" <?php echo $mainobj->GetPostValue( "fb_enable", "Y" ) == "Y" ? ' checked="checked"' : ''; ?>
                                   value="Y" class="has_depend_fld" id="fb_enable" name="config[fb_enable]">
                        </label>
                        <span class="form-group-help-block"><?php _e( "If you enable it a feedback email will be sent to ticket user email address after closing ticket" ); ?></span>
                    </div>

                </div>
            </div>
            <div class="fld-config-fb-enable fld-config-fb-enable-y">
                <hr class="m-10"/>
                <div class="form-group">
                    <label class="control-label col-md-4 label-required"
                           for="fb_e_msg"><?php _e( "Feedback Email Title" ); ?></label>
                    <div class="col-md-8">
                        <input type="text" maxlength="255" value="<?php echo $mainobj->GetPostValue( "fb_e_msg" ) ?>"
                               class="form-control" id="fb_e_msg" name="config[fb_e_msg]"
                               placeholder="<?php _e( "Feedback Email Title" ); ?>" data-bv-notempty="true"
                               data-bv-notempty-message="<?php _e( "%s is required", __( "Feedback Email Title" ) ); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 label-required"
                           for="fb_p_msg"><?php _e( "Positive Message" ); ?></label>
                    <div class="col-md-8">
                        <textarea maxlength="255" class="form-control" id="fb_p_msg" name="config[fb_p_msg]"
                                  placeholder="<?php _e( "Positive Feedback Message" ); ?>" data-bv-notempty="true"
                                  data-bv-notempty-message="<?php _e( "%s is required", __( "Positive Feedback Message" ) ); ?>"><?php echo $mainobj->GetPostValue( "fb_p_msg" ) ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-4 label-required"
                           for="fb_n_msg"><?php _e( "Nagative Message" ); ?></label>
                    <div class="col-md-8">
                        <textarea maxlength="255" class="form-control" id="fb_n_msg" name="config[fb_n_msg]"
                                  placeholder="<?php _e( "Nagative Feedback Message" ); ?>" data-bv-notempty="true"
                                  data-bv-notempty-message="<?php _e( "%s is required", __( "Nagative Feedback Message" ) ); ?>"><?php echo $mainobj->GetPostValue( "fb_n_msg" ) ?></textarea>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer text-right">
            <button id="captcha-submit-btn" type="submit" class="btn btn-sm btn-success"><i
                        class="fa fa-save"></i> <?php _e( "Save" ); ?></button>
        </div>
        <!-- /.footer -->
    </div>
    <!-- /.box -->
</form>
         