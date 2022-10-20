<?php
class NotificationHook{
	function setNotification(){
		$ci=get_instance();
		$isLoggedIn=$ci->session->GetCurrentUserType();	
	}
}