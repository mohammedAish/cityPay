<div class="<?php echo get_app_container_type();?> ">
    <div class="col-md-12 text-left m-t-0 m-b-5"  style="font-size: 10px; font-style: italic;">
        <?php
        $userdata=GetUserData();
        $link=!empty($userdata)?'<a class="popupformWR " href="'.site_url('client/panel/change-timezone').'">'.get_current_user_timezone().'</a>':get_current_user_timezone();
        ?>
    ** <?php _e("The time is base on %s timezone",$link) ; ?>
    </div>
</div>