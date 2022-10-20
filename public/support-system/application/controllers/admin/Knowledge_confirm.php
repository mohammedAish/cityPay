<?php 
/**
 * Version 1.0.0
 * Creation date: 04/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Knowledge_confirm extends APP_ConfirmController
{


    function __construct()
    {
        parent::__construct();
        $this->CheckPageAccess();
    }


    function knowledge_delete($param = "")
    {
        //temporary

        if (empty($param)) {
            $this->SetConfirmResponse(false, "Invalid Request");
            return;
        }
        $mr = new Mknowledge();
        $mr->id($param);
        if ($mr->Select()) {
            //$ur=new Mknowledge();
            if (Mknowledge::DeleteById($param)) {
                AddLog("D", "id={$param}", "l003", "Knowledge_confirm");
                $this->SetConfirmResponse(true, "Successfully deleted");
            } else {
                $this->SetConfirmResponse(false, "Delete failed try again");
            }
        }
    }

    function is_stickey_change($param = "")
    {
        if (empty($param)) {
            $this->SetConfirmResponse(false, "Invalid Request");
            return;
        }
        $mr = new Mknowledge();
        $is_stickeyChange = $mr->GetPropertyOptionsTag("is_stickey");

        $mr->id($param);
        if ($mr->Select("is_stickey")) {
            $newStatus = $mr->is_stickey == "Y" ? "N" : "Y";
            $uo = new Mknowledge();
            $uo->is_stickey($newStatus);
            $uo->SetWhereUpdate("id", $param);
            if ($uo->Update()) {
                $status_text = getTextByKey($uo->is_stickey, $is_stickeyChange);
                AddLog("U", $uo->settedPropertyforLog(), "l002", "Knowledge");
                $this->SetConfirmResponse(true, "Successfully Updated", $status_text);
            } else {
                $this->SetConfirmResponse(false, "Update failed try again");
            }

        }

    }

    function status_change($param = "")
    {
        if (empty($param)) {
            $this->SetConfirmResponse(false, "Invalid Request");
            return;
        }
        $mr = new Mknowledge();
        $statusChange = $mr->GetPropertyOptionsTag("status");

        $mr->id($param);
        if ($mr->Select("status")) {
            $newStatus = $mr->status == "P" ? "U" : "P";
            $uo = new Mknowledge();
            $uo->status($newStatus);
            $uo->SetWhereUpdate("id", $param);
            if ($uo->Update()) {
                $status_text = getTextByKey($uo->status, $statusChange);
                AddLog("U", $uo->settedPropertyforLog(), "l002", "Knowledge");
                $this->SetConfirmResponse(true, "Successfully Updated", $status_text);
            } else {
                $this->SetConfirmResponse(false, "Update failed try again");
            }

        }

    }

    function delete_feature($param = "")
    {
        if (empty($param)) {
            $this->SetConfirmResponse(false, "Invalid Request");
            return;
        }
        if (Mknowledge::delete_feature_img($param)) {
            AddLog("U", "", "l003", "Knowledge feature image");
            $this->SetConfirmResponse(true, "Successfully deleted", null, false);
        } else {
            $this->SetConfirmResponse(false, "Delete failed", null, false);
        }

    }

    function del_attach_file($id = "", $filename = '')
    {
        if(empty($id) || empty($filename)){
            $this->SetConfirmResponse(false, "Invalid Request");
            return;
        }
        if(Mknowledge::delete_attached_file($id,$filename)){
            AddLog("U", "", "l003", "Knowledge attached file");
            $this->SetConfirmResponse(true, "Successfully deleted", null,false);
        }else{
            $this->SetConfirmResponse(false, "Delete failed", null,false);
        }

    }


}
?>