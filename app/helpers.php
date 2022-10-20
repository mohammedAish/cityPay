<?php

function cp($t)
{
//    $t = str_replace('_id', '', $t);
    $t = trans('lang.' . $t);
    $t = str_replace('lang.', '', $t);
    $t = str_replace('_', ' ', $t);
    return $t;
}

function getUserIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}