<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Apr/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Addons_confirm extends APP_ConfirmController
{
    function __construct()
    {
        parent::__construct();
    }


    function active_addon()
    {
        $file_path = GetValue("p");
        if(empty($file_path) || !file_exists(FCPATH."/addons/".$file_path)){
            $this->SetConfirmResponse(false, __("File doesn't exists"));
            return;
        }

        $file_ful_path=FCPATH."/addons/".$file_path;
        if(!$this->is_valid_php_code_or_throw($file_ful_path,$error)){
            $this->SetConfirmResponse(false, $error, null);
            return;
        }
        $oldPluginData=AddOnManager::getAllActiveAddons();
        $isActive=true;
        if(isset($oldPluginData[$file_path])){
           unset($oldPluginData[$file_path]);
            $isActive=false;
        }else{
            $oldPluginData[$file_path]= AddOnManager::getPluginFileData($file_ful_path);
        }
        if(AddOnManager::saveAllActiveAddons($oldPluginData)) {
            $this->SetConfirmResponse(true, $isActive?__("Successfully activated"):__("Successfully deactivate"), $isActive?'A':'D');
            return;
        }
        $this->SetConfirmResponse(false, __("Addon activation failed"));
    }

    function is_valid_php_code_or_throw( $file ,&$error='') {

        exec("php -v", $output, $version);
        if($version!==0 || empty($output[0])){
            return true;
        }
        exec("php -l {$file}", $output, $return);
        if ($return === 0) {
            return true;
        } else {
            $error='Syntax error found in the file';
            return false;
        }

        $code=file_get_contents($file);
        $isOk=true;
        $old = ini_set('display_errors', 1);
        try {
            token_get_all($code, TOKEN_PARSE);
        }
        catch ( Exception $ex ) {
            $error = $ex->getMessage();
            $line = $ex->getLine() - 1;
            $error="PARSE ERROR on line $line:\n\n$error";
            $isOk= false;
        }
        finally {
            ini_set('display_errors', $old);
        }
        return $isOk;
    }

}
