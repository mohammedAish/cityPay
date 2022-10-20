<?php
$mainObj=APP_API::get_api_object($api_name);
if($mainObj){
	echo $mainObj->do_porcess();
}