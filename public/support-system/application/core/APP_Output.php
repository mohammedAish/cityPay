<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
require_once APPPATH."core".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."CORE_Output.php";
/**
 * PHP Codeigniter Simplicity
 *
 *
 * Copyright (C) 2013  John Skoumbourdis.
 *
 * GROCERY CRUD LICENSE
 *
 * Codeigniter Simplicity is released with dual licensing, using the GPL v3 and the MIT license.
 * You don't have to do anything special to choose one license or the other and you don't have to notify anyone which license you are using.
 * Please see the corresponding license file for details of these licenses.
 * You are free to use, modify and distribute this software, but all copyright information must remain.
 *
 * @package    	Codeigniter Simplicity
 * @copyright  	Copyright (c) 2013, John Skoumbourdis
 * @license    	https://github.com/scoumbourdis/grocery-crud/blob/master/license-grocery-crud.txt
 * @version    	0.6
 * @author     	John Skoumbourdis <scoumbourdisj@gmail.com>
 */
class APP_Output extends CORE_Output {
    function __construct(){
        parent::__construct();
    }
	/* (non-PHPdoc)
     * @see CORE_Output::AddError()
     */
    public static function AddError($msg, $isSession = false,$is_unique=false,$alredy_translated=false)
    {
        if(!$alredy_translated){
            $msg=__($msg);
        }
        return parent::AddError($msg,$isSession,$is_unique);
        
    }

	/* (non-PHPdoc)
     * @see CORE_Output::AddInfo()
     */
    public static function AddInfo($msg, $isSession = false,$is_unique=false)
    {
        $msg=__($msg);
        return parent::AddInfo($msg,$isSession,$is_unique);
        
    }     
}