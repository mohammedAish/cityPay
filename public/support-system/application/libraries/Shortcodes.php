<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');

class Shortcodes
{
    public static  function parse ($str)
    {
        // Check for existing shortcodes
        if (! strstr($str, '[ai:')) {
            return $str;
        }
        
        // Find matches against shortcodes like [ai:user id=1|class=admin]
        preg_match_all('/\[ai:([a-zA-Z0-9-_: |=\.,]+)]/', $str, $shortcodes);
        
        if ($shortcodes == NULL) {
            return $str;
        }
        $shortcode_array=[];
        // Tidy up
        foreach ($shortcodes[1] as $key => $shortcode) {
            if (strstr($shortcode, ' ')) {
                $code = substr($shortcode, 0, strpos($shortcode, ' '));
                $tmp = explode('|', str_replace($code . ' ', '', $shortcode));
                $params = array();
                if (count($tmp)) {
                    foreach ($tmp as $param) {
                        $pair = explode('=', $param);
                        $params[$pair[0]] = $pair[1];
                    }
                }
                $array = array('code' => $code, 'params' => $params);
            }
            else {
                $array = array('code' => $shortcode, 'params' => array());
            }
            
            $shortcode_array[$shortcodes[0][$key]] = $array;
        }
        return $shortcode_array;        
        
    }

}