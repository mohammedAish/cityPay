<?php 
/**
 * Version 1.0.0
 * Creation date: 09/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Client_confirm extends APP_ConfirmController
{


    function __construct()
    {
        parent::__construct();
        $this->CheckPageAccess();
    }


    function client_delete($param = "")
    {
        //temporary
        $this->SetConfirmResponse(false, __("Delete is temporary disabled"));
        return;
        if (empty($param)) {
            $this->SetConfirmResponse(false, __("Invalid Request"));
            return;
        }
        $mr = new Msite_user();
        $mr->id($param);
        if ($mr->Select()) {
            //$ur=new Msite_user();
            if (Msite_user::DeleteByKeyValue("id", $param)) {
                AddLog("D", "id={$param}", "l003", "Client_confirm");
                $this->SetConfirmResponse(true, __("Successfully deleted"));
            } else {
                $this->SetConfirmResponse(false, __("Delete failed try again"));
            }
        }
    }

    function is_verified_email_change($param = "")
    {
        if (empty($param)) {
            $this->SetConfirmResponse(false, __("Invalid Request"));
            return;
        }
        $mr = new Msite_user();
        $is_verified_emailChange = $mr->GetPropertyOptionsTag("is_verified_email");

        $mr->id($param);
        if ($mr->Select("is_verified_email")) {
            $newStatus = $mr->is_verified_email == "Y" ? "N" : "Y";
            $uo = new Msite_user();
            $uo->is_verified_email($newStatus);
            $uo->SetWhereUpdate("id", $param);
            if ($uo->Update()) {
                $status_text = getTextByKey($uo->is_verified_email, $is_verified_emailChange);
                AddLog("U", $uo->settedPropertyforLog(), "l002", "Client");
                $this->SetConfirmResponse(true, __("Successfully Updated"), $status_text);
            } else {
                $this->SetConfirmResponse(false, __("Update failed try again"));
            }

        }

    }

    function reset_user_pass($id='')
    {
        if (!empty($id) && Msite_user::send_reset_by_id($id)) {
            AddLog("U", "", "l001", "Password reset");
            $this->SetConfirmResponse(true, "Reset link has been sent to the user", NULL, true);
        } else {
            $this->SetConfirmResponse(false, "Reset failed try again", NULL, true);
        }

    }


}
?>