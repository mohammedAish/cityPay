<?php
class Panel extends APP_Controller {
	public $userData=null;
	function __construct(){
		
		parent::__construct();
		//$this->output->set_template('login');
		$this->CheckPageAccess();
		$this->userData=GetUserData();
		AddModule("my_menu",APP_Output::MODULE_LEFT);$obj=new Mticket();
        $display_counter=Mticket::getClientTicketCounter($this->userData->id);
        $this->AddViewData("counter", $display_counter);

	}
	public function index(){
	    redirect("client/panel/dashboard");
	}
	public function Dashboard()
	{
		//UnsetModule("content_header");
		UnsetModule("breadcrumb");
		$this->SetTitle("Hello, %s",$this->userData->title);

		$this->Display();
	}
	public function Profile()
    {
        $this->SetTitle('Profile');
        $this->SetIcon("fa fa-user-circle-o");
        $this->AddBreadCrumb("User Panel", site_url("client/panel/dashboard"), "fa fa-user-o");
        $muser = new Msite_user();
        $muser->id($this->userData->id);
        if ($muser->Select()) {

        }
        $this->AddViewData("muser", $muser);
        $this->Display();
    }

    public function change_photo()
    {
        $this->SetTitle('Change Profile Photo');
        $this->SetIcon("fa fa-user-circle-o");
        $this->SetPOPUPColClass ( "col-md-4 col-sm-6" );

        if(Mapp_setting::GetSettingsValue("allow_profile_upload","N")!="Y"){
            AddError("Client Photo upload has been disabled by admin");
            $this->DisplayPOPUPMsg();
            return;
        }

        if(IsPostBack){
             if(isset($_FILES['user_photo'])){
                 $fullpath="data/site_user/{$this->userData->id}/".$_FILES['user_photo']['name'];
                 if(move_upload_file_if_ok('user_photo',FCPATH.$fullpath)){
                     app_image_resize(FCPATH.$fullpath,250,200,null,"center");
                     $uobj=new Msite_user();
                     $uobj->photo_url(base_url($fullpath));
                     $uobj->SetWhereCondition("id",$this->userData->id);
                     if($uobj->Update()){
                         $userdata=GetUserData();
                         $userdata->user_img=base_url($fullpath);
                         $this->session->SetUserData($userdata);
                     }
                     AddInfo("Successfully saved");
                 }else{
                     AddError("Update failed");
                 }
             }
        }
        $mainobj=new Msite_user();
        $mainobj->id($this->userData->id);
        $mainobj->Select();
        $this->SetPopupFromMutipart();
        $this->AddViewData("mainobj", $mainobj);
        $this->AddViewData("isUpdate", false);
        $this->DisplayPOPUP();
    }
    public function change_timezone()
    {
        $this->SetPOPUPColClass("col-md-4");
        $this->SetPOPUPIconClass("fa fa-map");
        $this->SetTitle("Change Timezone");
        $userData=GetUserData();

        $mainobj=new Msite_user();

        if(IsPostBack){
            $tzone=PostValue("tzone");
            if(!empty($tzone)){
                $uob=new Msite_user();
                $uob->tzone($tzone);
                $uob->SetWhereCondition("id", $userData->id);
                if($uob->Update()){
                    $userData->timezone=$tzone;
                    $this->session->SetUserData($userData);
                    Mapp_setting::SetTimeZoneSession($tzone);
                    AddInfo("Timezone updated successfully");
                    $this->DisplayPOPUPMsg();
                    return;
                }else{
                    AddError("No change found for update");
                }
            }else{
                AddError("Please select a valid timezone");
            }
        }

        $mainobj->id($userData->id);
        $mainobj->Select('tzone');
        $this->AddViewData("mainobj", $mainobj);
        $this->DisplayPOPUP();
    }
    function delete_data() {
	    header('Content-Type: application/json');
	    $userData=GetUserData();
		$response=new APPAPIResponse();
		$this->output->unset_template();
	    $isGDPR=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_is_active",'N')=="Y";
	    $response->setResponse(false,"Delete failed, contact admin");
	    if(ISDEMOMODE){
		    $response->setResponse(false,"You can't delete in demo mode");
		    $response->displayResponse();
		    return;
	    }
	    if($isGDPR) {
		    $isGDPRDelete=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ua_active",'N')=="Y";
		   // $isGDPRDownload=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ud_active",'N')=="Y";
		    if($isGDPRDelete){
		        if(Msite_user::DeleteAccount($userData->id)){
		        	$this->session->UnsetAllUserData();
			        $response->setResponse(true,"Deleted Successfully");
		        }else{
			        $response->setResponse(true,GetMsgForAPI());
		        }
		    }
	    }
	    $response->displayResponse();
    }
	function download_data() {
		$userData=GetUserData();
		header('Content-Type: application/json');
		header('Content-Disposition: attachment; filename="userdata.json"');
		$response=new stdClass();
		$response->data="Authorized Error";
		$this->output->unset_template();
		$isGDPR=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_is_active",'N')=="Y";
		if(ISDEMOMODE){
			$response=new stdClass();
			$response->msg="download is disable in demo mode";
			echo json_encode($response,JSON_PRETTY_PRINT);die;
			return;
		}
		if($isGDPR) {
			$isGDPRDownload=Mapp_setting_api::GetSettingsValue("gdpr","gdpr_ud_active",'N')=="Y";
			if($isGDPRDownload){
				$response=new stdClass();
				$response->user_infomation=Msite_user::FindBy("id",$userData->id);
				if($response->user_infomation) {
					//unset( $response->user_infomation->id );
					unset( $response->user_infomation->user_social_session_data );
					unset( $response->user_infomation->pass );
					unset( $response->user_infomation->is_verified_email );
					unset( $response->user_infomation->login_type );
					unset( $response->user_infomation->last_login_time );
					unset( $response->user_infomation->user_type );
					unset( $response->user_infomation->age );
					unset( $response->user_infomation->status );
				}
				$response->tickets=[];
				$tickets=Mticket::FindAllBy("ticket_user",$userData->id);
				if($tickets){
					foreach ($tickets as $ticket){
						$tobj=new stdClass();
						$tobj->id=$ticket->id;
						$tobj->title=$ticket->title;
						$tobj->category=Mcategory::getParentStr($ticket->cat_id);
						$tobj->ticket_body=$ticket->ticket_body;
						$tobj->assigned_on=Mapp_user::get_user_obj_by($ticket->assigned_on)->title;
						$tobj->status=$ticket->status;
						$response->tickets[]=$tobj;
					}
				}
			}
		}
		echo json_encode($response,JSON_PRETTY_PRINT);die;
	}
}