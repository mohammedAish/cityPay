<?php

if (!function_exists("get_knowledge_list_artbox_2020")) {

    function get_knowledge_list_artbox_2020($knowledges, $isStickyCheck = true, $isViewCount = true, $isLikeCount = false, $isDislikeCount = false, $is_blank = false, $is_porpup = false, $ulClass = '')
    {


        ob_start();

        if (!empty($knowledges) && is_array($knowledges)) {
            ?>

            <ul class="<?php echo $ulClass; ?>">

                <?php foreach ($knowledges as $knw) {

                    $knw = !$knw ? new Mknowledge() : $knw;

                    app_check_slag($knw->slug_id, $knw->title);

                    $knw->slug_id = app_slag_refine($knw->slug_id);


                    ?>

                    <li class="<?php echo $isStickyCheck && $knw->is_stickey == "Y" ? " is-sticky " : ""; ?>">


                        <a class=" <?php echo $is_porpup ? " popupform " : ""; ?>" <?php echo $is_porpup ? '  data-effect="mfp-move-from-top "' : ""; ?> <?php echo $is_blank ? ' target="_blank" ' : ''; ?>
                           href="<?php echo site_url("knowledge/details/{$knw->id}/{$knw->slug_id}"); ?>"><i
                                    class="fa fa-file-alt"></i> <?php echo $knw->title; ?>

                            <?php if ($isViewCount) { ?>

                                <span class="view-counter float-right"><i
                                            class="fa fa-eye"></i> <?php echo _n(str_pad($knw->v_count, 2, '0', STR_PAD_LEFT)); ?></span>

                            <?php }

                            if ($isLikeCount) {

                                ?>

                                <span class="view-counter float-right"><i
                                            class="fa fa-thumbs-up"></i> <?php echo _n(str_pad($knw->l_count, 2, '0', STR_PAD_LEFT)); ?></span>

                            <?php }

                            if ($isDislikeCount) {


                                ?>

                                <span class="view-counter float-right"><i
                                            class="fa fa-thumbs-down"></i> <?php echo _n(str_pad($knw->d_count, 2, '0', STR_PAD_LEFT)); ?></span>

                            <?php } ?>

                        </a>


                    </li>

                <?php } ?>

            </ul>

        <?php }

        return ob_get_clean();

    }

}


if (!function_exists("get_open_ticket_link_2020")) {

    function get_open_ticket_link_2020($class = "", $title = "Open Ticket", $icon = 'fa fa-ticket')
    {

        $userdata = GetUserData();

        $isDisableGuestPopup = Mapp_setting::GetSettingsValue("dgustpopup", "N") == "Y";

        ob_start();

        if (!empty($userdata) || $isDisableGuestPopup) {

            ?>

            <a class="<?php echo $class; ?> btn btn-lg btn-theme-light" href="<?php echo site_url('ticket/open'); ?>">

                <?php if (!empty($icon)) { ?><i class="<?php echo $icon; ?>"></i>  <?php }
                _e($title); ?>

            </a>

            <?php

        } else {

            ?>

            <a data-effect="mfp-move-from-top"
               class="btn btn-lg btn-theme-light popupformWR <?php echo $class; ?> open-ticket"
               href="<?php echo site_url('user/login-register'); ?>">

                <i class="fa fa-ticket"></i> <?php _e($title); ?>

            </a>

            <?php


        }

        return ob_get_clean();


    }

}

if (!function_exists("get_inputbox_2020")) {

    function get_inputbox_2020($title, $name, $value = '', $isRequired = false, $place_holder = '', $group_class = 'col-sm', $input_class = '')
    {

        $re = $isRequired ? ' data-bv-notempty-message="' . __("%s is required", "Product Name") . '" ' : '';

        ?>

        <div class="form-group <?php echo $group_class; ?>">

            <label class="col-form-label" for="<?php echo $name; ?>"><?php _e($title); ?></label>

            <input class="form-control  <?php echo $input_class; ?>" type="text" maxlength="200"

                   value="<?php echo $value; ?>" id="<?php echo $name; ?>" name="<?php echo $name; ?>"

                   placeholder="<?php _e($place_holder); ?>" <?php echo $re; ?> >

        </div>

        <?php

    }

}

if (!function_exists("get_iconpicker_2020")) {

    function get_iconpicker_2020($title, $name, $value = '', $input_class = '')
    {

        ?>

        <button name="<?php echo $name; ?>" class="btn btn-secondary  bss-icon-picker-2020 <?php echo $input_class; ?>"
                data-placement="bottom" data-icon="<?php echo $value; ?>" value="<?php echo $value; ?>"
                role="iconpicker"></button>

        <?php

    }

}
if (!function_exists("get_radio_2020")) {

    function get_radio_2020($title, $name, $value, $options = [], $group_class = '', $is_required = false, $input_class = '')
    {

        ?>

        <div class="form-group <?php echo $group_class; ?>">
            <label class="col-form-label" for="<?php echo $name; ?>"><?php _e($title); ?></label>
            <div class="">
                <?php
                GetHTMLRadioBoxByArray("Choose Style", $name, $name, $is_required, $options, $value, false, '#ffffff', $input_class);
                ?>
            </div>
        </div>
        <?php

    }

}

if (!function_exists("get_textarea_2020")) {

    function get_textarea_2020($title, $name, $value = '', $isRequired = false, $place_holder = '', $group_class = 'col-sm', $input_class = '')
    {

        $re = $isRequired ? ' data-bv-notempty-message="' . __("%s is required", "Product Name") . '" ' : '';

        ?>

        <div class="form-group <?php echo $group_class; ?>">

            <label class="col-form-label" for="<?php echo $name; ?>"><?php _e($title); ?></label>

            <textarea class="form-control  <?php echo $input_class; ?>"

                      id="<?php echo $name; ?>" name="<?php echo $name; ?>"

                      placeholder="<?php _e($place_holder); ?>" <?php echo $re; ?> ><?php echo $value; ?></textarea>

        </div>

        <?php

    }

}

if (!function_exists("get_html_textarea_2020")) {

    function get_html_textarea_2020($title, $name, $value = '', $isRequired = false, $place_holder = '', $group_class = 'col-sm', $input_class = '')
    {

        $input_class .= ' app-html-editor ';

        return get_textarea_2020($title, $name, $value, $isRequired, $place_holder, $group_class, $input_class);

    }

}

if (!function_exists("get_boolean_input_2020")) {

    function get_boolean_input_2020($title, $name, $value = '', $group_class = 'material-switch-sm', $input_class = '', $label_class = 'bg-mat')
    {

        ?>

        <div class="form-group row <?php echo $group_class; ?>">


            <label class="col-form-label" for="<?php echo $name; ?>"><?php _e($title); ?></label>

            <?php

            APBD_GetHTMLSwitchButtonInline_2020($name, $name, "N", "Y", $value, false, $input_class, $label_class, $group_class);

            ?>

        </div>

        <?php

    }

}

if (!function_exists("get_boolean_input_default_2020")) {

    function get_boolean_input_default_2020($title, $name, $value = '', $group_class = 'material-switch-sm', $input_class = '', $label_class = 'bg-mat')
    {

        ?>

        <div class="form-group <?php echo $group_class; ?>">


            <label class="col-form-label" for="<?php echo $name; ?>"><?php _e($title); ?></label>

            <?php

            APBD_GetHTMLSwitchButton_2020($name, $name, "N", "Y", $value, false, $input_class, $label_class, $group_class);

            ?>

        </div>

        <?php

    }

}


if (!function_exists("get_input_image_2020")) {

    function get_input_image_2020($title, $name, $value = '', $placeholder = '', $style = 'width:108px; height: 108px;', $group_class = 'col-sm', $input_class = '')
    {

        ?>

        <div class="form-group <?php echo $group_class; ?>">

            <label class="col-form-label" for="<?php echo $name; ?>"><?php _e($title); ?></label>

            <div class="">

                <img class="app-image-input img-thumbnail" data-name="<?php echo $name; ?>" src="<?php echo $value; ?>"
                     style="<?php echo $style; ?>"/>

                <div class="form-group-help-block"><?php _e($placeholder); ?></div>

            </div>

        </div>

        <?php

    }

}

if (!function_exists("getAPIPostValue_2020")) {

    function getAPIPostValue_2020($key, $isHtml = false, $default = null)
    {

        if ($isHtml) {

            return AppSecurity::RawPostValue($key, Mapp_setting_api::GetSettingsValue('bss2020', $key, $default));

        }

        return PostValue($key, Mapp_setting_api::GetSettingsValue('bss2020', $key, $default));

    }

}

if (!function_exists("getThemeAPIValue_2020")) {

    function getThemeAPIValue_2020($key, $default = '')
    {

        $value = Mapp_setting_api::GetSettingsValue('bss2020', $key);

        if (empty($value)) {

            return $default;

        }

        return $value;

    }

}

if (!function_exists("APBD_GetHTMLSwitchButton_2020")) {

    function APBD_GetHTMLSwitchButton_2020($id, $name, $default_value = "", $boolvalue, $checkedValue, $isDisabled = false, $input_class = '', $label_class = 'bg-mat', $group_class = 'material-switch-sm')
    {

        ?>
        <div class="material-switch <?php echo $group_class; ?> ">

        <input name="<?php echo $name; ?>" value="<?php echo $default_value; ?>" type="hidden">

        <input class="<?php echo $input_class; ?>"
               id="<?php echo $id; ?>" <?php echo $isDisabled ? ' disabled="disabled"' : 'name="' . $name . '"'; ?>
               type="checkbox" <?php echo $checkedValue == $boolvalue ? "checked" : "" ?>
               value="<?php echo $boolvalue; ?>">

        <label for="<?php echo $id; ?>" class="<?php echo $label_class; ?>"></label>

        </div><?php


    }

}

if (!function_exists("APBD_GetHTMLSwitchButtonInline_2020")) {

    function APBD_GetHTMLSwitchButtonInline_2020($id, $name, $default_value, $boolvalue, $checkedValue, $isDisabled = false, $input_class = '', $label_class = 'bg-mat', $group_class = 'material-switch-sm inline')
    {

        APBD_GetHTMLSwitchButton_2020($id, $name, $default_value, $boolvalue, $checkedValue, $isDisabled, $input_class, $label_class, $group_class);

    }

}


if (!function_exists("get_ticket_list_2020")) {

    /**
     * @param multitype:Mticket $ticket_list
     * @param string $no_ticket_msg ;
     * @return string
     */

    function get_ticket_list_2020($ticket_list, $no_ticket_msg = "", $page_type = "")
    {


        //$categories=Mcategory::FetchAllKeyValue("id", "title");

        //GPrint($ticket_list);

        if (empty($no_ticket_msg)) {

            $no_ticket_msg = "There is not ticket to show";

        }

        $mainticket_obj = new Mticket();

        ob_start();

        if (!empty($ticket_list) && is_array($ticket_list)) {

            ?>

            <div class="table-responsive">
                <table class="table kn-list">
                    <tr>
                        <th><?php _e("Category"); ?></th>
                        <th><?php _e("Ticket Track ID"); ?></th>
                        <th><?php _e("Status"); ?></th>
                        <th><?php _e("Opened"); ?></th>
                        <th><?php _e($page_type == "C" ? "Closed On" : "Last Replied"); ?></th>
                    </tr>
                    <tbody>
                    <?php foreach ($ticket_list as $ticket) {

                        //GPrint($ticket);

                        $ticket = !$ticket ? new Mticket() : $ticket;

                        ?>
                        <tr class="kn-details ticket-item">
                            <td><?php if (!empty($ticket->cat_id)) { ?><a
                                        href="#"><?php echo Mcategory::getParentStr($ticket->cat_id); ?></a><?php } ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url("ticket/details/{$ticket->id}"); ?>"
                                   class="kn-tracking-id"># <?php echo $ticket->ticket_track_id; ?></a>
                                <div class="kn-title"><a
                                            href="<?php echo site_url("ticket/details/{$ticket->id}"); ?>"><?php echo $ticket->title; ?></a>
                                </div>
                            </td>
                            <td>
                                <span class="kn-status-label"><?php echo getTextByKey($ticket->status, $mainticket_obj->GetPropertyOptionsTag("status")); ?></span>
                            </td>
                            <td><?php echo $ticket->opened_time != "0000-00-00 00:00:00" ? get_user_datetime_default_format($ticket->opened_time) : "-"; ?></td>
                            <td><?php echo $ticket->last_reply_time != "0000-00-00 00:00:00" ? get_user_datetime_default_format($ticket->last_reply_time) : "-"; ?></td>
                        </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>

        <?php } else {
            ?>

            <h3 class="text-success text-center m-15"><?php _e($no_ticket_msg); ?></h3>

        <?php }

        return ob_get_clean();

    }

}


if (!function_exists("GetTicketReplyHTML2020")) {


    /**
     * @param Mticket_reply $reply_object
     * @return string
     */

    function GetTicketReplyHTML2020($reply_object, $ticket_user_id = "", $class = "")
    {
        $isAdmin = GetCurrentUserType() == "AD";
        ob_start();
        if ($reply_object instanceof Mticket_reply) {
            $files = Mticket_reply::get_reply_attachments_by($reply_object, false, $ticket_user_id);
            $ticketObj = new Mticket();
            $user = Mticket_reply::get_user_by_id($reply_object->ticket_id, $reply_object->replied_by);
            if (!empty($user)) {
                $has_payment = $reply_object->payment_id > 0;
                if ($has_payment) {
                    $payment_obj = Mticket_payment::FindBy("id", $reply_object->payment_id, ["ticket_id" => $reply_object->ticket_id, "reply_id" => $reply_object->reply_id]);
                }
                ?>

                <div id="id_<?php echo $reply_object->ticket_id . "_" . $reply_object->reply_id; ?>"
                     class="<?php echo $class; ?> card card-default app-panel-box mb-3 ticket-reply <?php echo ($user->type == "A" || $user->type == "S") ? "admin-user" : ""; ?>">
                    <div class="card-body text-justify">
                        <?php if ($user->type == "A" || $user->type == "S") { ?>
                            <div class="user-type"><?php echo $user->type_title; ?></div>
                        <?php } ?>
                        <div class="row">
                            <div class=" col-xs-3 col-sm-2 col-md-2 user-profile ">
                                <?php echo get_user_img($user->title, $user->id, $user->type, $user->photo_url); ?>
                                <div class="tooltip2 r-user-title" title="<?php echo $user->title; ?>"><?php echo $user->title; ?></div>
                                <div class="r-user-title">
                                    <?php echo get_user_date_default_format($reply_object->reply_time); ?><br/>
                                    <?php echo get_user_time_default_format($reply_object->reply_time); ?>
                                </div>
                            </div>
                            <div class="col-xs-9 col-sm-10 col-md-10">
                                <div class="reply-text">
                                    <?php echo $reply_object->reply_text;
                                    if ($has_payment) {
                                        if ($payment_obj) {
                                            ?>

                                            <div class="card card-default payment-panel <?php echo $payment_obj->status == "A" ? " paid-panel" : ""; ?>">
                                                <div class="card-header"><?php _e("Payment Added"); ?>
                                                    <?php if (!$isAdmin && in_array($payment_obj->status, ['P', 'F'])) { ?>
                                                        <a href="<?php echo site_url("ticket-payment/choose-method/{$payment_obj->ticket_id}/{$payment_obj->reply_id}/{$payment_obj->id}"); ?>"
                                                           class="payment-btn btn btn-xs btn-success float-right"><?php _e("Pay Now"); ?></a>

                                                    <?php } ?>

                                                </div>

                                                <div class="card-body">

                                                    <ul class="app-ul-properties payment-ul">

                                                        <li class="">
                                                            <label class="f-w-3 w-clone"    for=""><?php _e("Description"); ?></label>
                                                            <span class="f-w-9"><?php echo $payment_obj->payment_des; ?></span>
                                                        </li>
                                                        <li>
                                                            <label class="f-w-3 w-clone" for=""><?php _e("Amount"); ?></label>
                                                            <span class="f-w-3"><?php echo $payment_obj->payment_currency . " " . $payment_obj->amount; ?></span>
                                                            <label class="f-w-3 w-clone" for=""><?php _e("Status"); ?></label>
                                                            <span class="f-w-3"><?php echo $payment_obj->getTextByKey("status"); ?></span>

                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                            <?php

                                        }

                                    }

                                    ?>

                                </div>

                                <div class="ticket-footer-info">
                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="pro-row d-flex">
                                                <div class="pro-title"><?php _e("Ticket Status"); ?>  </div>
                                                <div class="pro-value">
                                                    <?php echo $ticketObj->getTextByKey("status", true, $reply_object->ticket_status); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-6">
                                            <?php if (count($files)) { ?>
                                                <div class="pro-title"><?php _e("File Attached"); ?>  </div>
                                                <div class="pro-value">
                                                    <ul class="app-file-list inline-file-list">
                                                        <?php

                                                        $utype = GetCurrentUserType();

                                                        foreach ($files as $file) {
                                                            $linkUrl = $utype == "AD" ? (base_url("admin/ticket/ticket-replied-file/{$file->hash}/{$ticket_user_id}/{$reply_object->ticket_id}/{$reply_object->reply_id}/{$file->name}")) : (base_url("ticket/ticket-replied-file/{$file->hash}/{$ticket_user_id}/{$reply_object->ticket_id}/{$reply_object->reply_id}/{$file->name}"));
                                                            ?>
                                                            <li>
                                                                <a class="<?php echo strtolower(substr($file->type, 0, 3)) == "ima" ? "popupimg" : ""; ?>"
                                                                   href="<?php echo $linkUrl; ?>">
                                                                    <i class="fa <?php echo $file->class; ?>"></i>
                                                                    <?php
                                                                    echo $file->name . " <em>( {$file->size_str} )</em>";
                                                                    ?></a>
                                                            </li>

                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <?php if ($isAdmin) { ?>

                                            <div class="col-xs-12 col-sm-2 text-right text-italic p-l-0">

                                                <?php if ($reply_object->is_user_seen != "Y") { ?>

                                                    <a href="<?php echo admin_url("ticket/edit-reply/{$reply_object->ticket_id}/{$reply_object->reply_id}"); ?>"
                                                       class="popupformWR" data-onclose="ReloadSiteUrl"
                                                       data-effect="mfp-move-from-top"><?php _e("Edit"); ?></a> &nbsp;

                                                <?php } ?>

                                                <i title="<?php echo $reply_object->is_user_seen == "Y" ? __("Seen by ticket owner") : __("Unseened by ticket owner"); ?>"
                                                   data-tooltip-position="top"
                                                   class="tooltip2 fa <?php echo $reply_object->is_user_seen == "Y" ? 'fa-eye u-seen' : 'fa-eye-slash u-unseen'; ?>"></i> <?php echo $reply_object->is_user_seen == "Y" ? app_time_elapsed_string($reply_object->seen_time) : "" ?>

                                            </div>

                                        <?php } ?>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <?php

            }

        }

        //echo GetMsg();

        return ob_get_clean();

    }

}

if (!function_exists("get_knowledge_list_2020")) {

    function get_knowledge_list_2020($knowledges, $categories = null)
    {

        if (empty($categories)) {

            $categories = Mcategory::FetchAllKeyValue("id", "title");

        }

        ob_start();

        if (!empty($knowledges) && is_array($knowledges)) {
            ?>

            <ul class="kn-list">

                <?php foreach ($knowledges as $knw) {

                    $knw = !$knw ? new Mknowledge() : $knw;

                    $knw->slug_id = app_slag_refine($knw->slug_id);


                    app_check_slag($knw->slug_id, $knw->title);

                    ?>

                    <li class="<?php echo $knw->is_stickey == "Y" ? " is-sticky " : ""; ?>">

                        <div class="kn-title">

                            <h3 class="m-0">

                                <a href="<?php echo site_url("knowledge/details/{$knw->id}/{$knw->slug_id}"); ?>"><?php echo $knw->title; ?></a>

                                <span class="kn-like ab-rt-1 text-success"><i
                                            class="fa fa-thumbs-up "></i> <?php _n(str_pad($knw->l_count, 2, '0', STR_PAD_LEFT)); ?></span>

                            </h3>

                        </div>

                        <div class="kn-details">

                            <?php _e("Last updated on ");
                            echo get_user_datetime_default_format($knw->last_update_time); ?> <?php if (!empty($knw->cat_id)) { ?>in
                                <a
                                href="<?php echo site_url("category/details/{$knw->cat_id}/" . getTextByKey($knw->cat_id, $categories)) ?>"><?php echo getTextByKey($knw->cat_id, $categories); ?></a><?php } ?>

                        </div>

                    </li>

                <?php } ?>

            </ul>

        <?php }

        return ob_get_clean();

    }

}


if (!function_exists("get_right_image_link_2020")) {

    function get_right_image_link_2020($not_exists_return_empty = false)
    {

        foreach (['png', 'svg', 'jpg', 'jpeg'] as $extension) {

            if (file_exists(FCPATH . "/data/theme2020/right-img." . $extension)) {

                return image_url("data/theme2020/right-img." . $extension, true);

            }

        }

        if ($not_exists_return_empty) {

            return '';

        }

        return image_url('theme/bss2020/images/right-img.svg');

    }

}

if (!function_exists("get_bg_image_link_2020")) {

    function get_bg_image_link_2020()
    {

        foreach (['png', 'svg', 'jpg', 'jpeg'] as $extension) {

            if (file_exists(FCPATH . "/data/theme2020/bg." . $extension)) {

                return image_url("data/theme2020/bg." . $extension, true);

            }

        }

        return "";

    }

}