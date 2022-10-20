<?php
APP_Controller::LoadConfirmController();
class App_permission_confirm extends APP_ConfirmController
{
    function __construct()
    {
        parent::__construct();
        $this->CheckPageAccess("reset_user_pass");
    }

    function change_role_access()
    {
        $page_id = $this->getUriData("pid");
        $role_id = $this->getUriData("rid");
        if ($role_id != 'R1') {
            $mr = new Mrole_access();
            $mr->res_id($page_id);
            $mr->role_id($role_id);
            if ($mr->Select()) {
                //need to update
                $ur = new Mrole_access();
                $ur->status($mr->status == "Y" ? "N" : "Y");
                $ur->SetWhereCondition("res_id", $page_id);
                $ur->SetWhereCondition("role_id", $role_id);
                if ($ur->Update()) {
                    $this->SetConfirmResponse(true, "Successfully Updated");
                } else {
                    $this->SetConfirmResponse(false, "Update failed try again");
                }
            } else {
                //need to add
                $nr = new Mrole_access();
                $nr->res_id($page_id);
                $nr->role_id($role_id);
                $nr->status('Y');
                if ($nr->Save()) {
                    $this->SetConfirmResponse(true, "Successfully Updated");
                } else {
                    $this->SetConfirmResponse(false, "Update failed try again");
                }
            }
        } else {
            $this->SetConfirmResponse(false, "This role can not be delete");
        }
    }

    function change_user_status()
    {
        $adminData = GetAdminData();
        $uid = $this->getUriData("uid");
        $mr = new Mapp_user();
        $mr->id($uid);
        if ($adminData->id != $uid) {
            if ($mr->Select()) {
                if ($mr->status != "D") {
                    $ur = new Mapp_user();
                    $ur->status($mr->status == "A" ? "I" : "A");
                    $ur->SetWhereCondition("id", $uid);
                    if ($ur->Update()) {
                        $this->SetConfirmResponse(true, "Successfully Updated");
                    } else {
                        $this->SetConfirmResponse(false, "Update failed try again");
                    }
                } else {
                    $this->SetConfirmResponse(false, "The user is already archived. You can't active or inactive");
                }
            }
        } else {
            $this->SetConfirmResponse(false, "You can't change status by yourself");
        }
    }

    function reset_user_pass()
    {
        $uid = $this->getUriData("uid");
        if (Mapp_user::send_reset_email($uid)) {
            AddLog("U", "", "l001", "Password reset");
            $this->SetConfirmResponse(true, "Reset link has been sent to the user", NULL, true);
        } else {
            $this->SetConfirmResponse(false, "Reset failed try again", NULL, true);
        }

    }

    //Role
    function role_delete($param = "")
    {
        //temporary
        // $this->SetConfirmResponse(false, "Check Model First");
        // return;
        if (empty($param)) {
            $this->SetConfirmResponse(false, "Invalid Request");
            return;
        }
        $mr = new Mrole_list();
        $mr->role_id($param);
        if ($mr->Select()) {
            $ur = new Mrole_list();
            if (Mrole_list::DeleteByKeyValue("role_id", $param)) {
                Mrole_access::ClearAccessByRole($param);
                AddLog("D", "role_id=,$param", "l003", "App_permission_confirm", $param);
                $this->SetConfirmResponse(true, "Successfully deleted");
            } else {
                $this->SetConfirmResponse(false, "Delete failed try again");
            }
        }
    }

    function archive_user($uid)
    {
        $adminData = GetAdminData();
        $mr = new Mapp_user();
        $mr->id($uid);
        if ($adminData->id != $uid) {
            if ($mr->Select()) {
                if (Mapp_user::DeleteAccount($uid)) {
                    $this->SetConfirmResponse(true, "Successfully Deleted");
                } else {
                    $this->SetConfirmResponse(false, "Update failed try again");
                }
            }
        } else {
            $this->SetConfirmResponse(false, "You can't change status by yourself");
        }
    }
}