<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_controller'][] = array(
    'class'    => 'AppSecurity',
    'function' => 'CleanRequestParam',
    'filename' => 'AppSecurity.php',
    'filepath' => 'hooks'
);
$hook['pre_controller'][]= array(
	'class'    => 'AddOnManager',
	'function' => 'PreController',
	'filename' => 'AddOnManager.php',
	'filepath' => 'hooks'
	//'params'   => array('beer', 'wine', 'snacks')
);
$hook['post_controller_constructor'][] = array(
    'class'    => 'AddOnManager',
    'function' => 'LoadAddons',
    'filename' => 'AddOnManager.php',
    'filepath' => 'hooks'
);
$hook['post_controller_constructor'][]= array(
    'class'    => 'ProviderSelector',
    'function' => 'setProvider',
    'filename' => 'ProviderSelector.php',
    'filepath' => 'hooks',
    //'params'   => array('beer', 'wine', 'snacks')
);
$hook['post_controller_constructor'][] = array(
		'class'    => 'AppConfigHook',
		'function' => 'Setup',
		'filename' => 'AppConfigHook.php',
		'filepath' => 'hooks',
		//'params'   => array('beer', 'wine', 'snacks')
);
$hook['post_controller_constructor'][]= array(
    'class'    => 'ThemeSelector',
    'function' => 'setThemeAndLayout',
    'filename' => 'ThemeSelector.php',
    'filepath' => 'hooks',
    //'params'   => array('beer', 'wine', 'snacks')
);
$hook['post_controller_constructor'][]= array(
	'class'    => 'AddOnManager',
	'function' => 'PostCallBack',
	'filename' => 'AddOnManager.php',
	'filepath' => 'hooks'
	//'params'   => array('beer', 'wine', 'snacks')
);

/*$hook['post_controller_constructor'][] = array(
		'class'    => 'TestHook',
		'function' => 'TestH',
		'filename' => 'TestHook.php',
		'filepath' => 'hooks',
		//'params'   => array('beer', 'wine', 'snacks')
);*/
/*
$hook['pre_controller'][] = array(
		'class'    => 'MyClass',
		'function' => 'MyMethod',
		'filename' => 'Myclass.php',
		'filepath' => 'hooks',
		'params'   => array('beer', 'wine', 'snacks')
);*/