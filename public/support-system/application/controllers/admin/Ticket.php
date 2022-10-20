<?php
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Ticket extends APP_Controller {
	function __construct() {
		parent::__construct ();
		$this->CheckPageAccess ();
		$this->SetPOPUPIconClass("fa fa-ticket");
	}
	function index() {
		$this->SetTitle ( "All Active Tickets" );
		$this->SetSubtitle ( "" );
		$this->AddBreadCrumb ( "home", base_url () );
		$this->load->library ( "jQGrid" );
		$this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/ticket-list/P" ) );
		$this->Display ();
	}
	function closed_ticket() {
		$this->SetTitle ( "All Closed Tickets" );
		$this->SetSubtitle ( "" );
		$this->AddBreadCrumb ( "home", base_url () );
		$this->load->library ( "jQGrid" );
		$this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/closed-ticket" ) );
		$this->Display ('admin/ticket/index');
	}
	function my_ticket() {
	    $this->SetTitle ( "My Active Tickets" );
	    $this->SetSubtitle ( "" );
	    $this->AddBreadCrumb ( "home", base_url () );
	    $this->load->library ( "jQGrid" );
	    $this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/my-ticket" ) );
	    $this->Display ('admin/ticket/index');
	}
	function my_assigned_ticket() {
	    $this->SetTitle ( "My Assigned All Tickets" );
	    $this->SetSubtitle ( "" );
	    $this->AddBreadCrumb ( "home", base_url () );
	    $this->load->library ( "jQGrid" );
	    $this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/my-assigned-ticket" ) );
	    $this->Display ('admin/ticket/index');
	}
	function unassigned_ticket() {
	    $this->SetTitle ( "My Unassigned All Tickets" );
	    $this->SetSubtitle ( "" );
	    $this->AddBreadCrumb ( "home", base_url () );
	    $this->load->library ( "jQGrid" );
	    $this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/unassigned-ticket" ) );
	    $this->Display ('admin/ticket/index');
	}
	function my_paid_ticket() {
	    $this->SetTitle ( "My Paid Tickets" );
	    $this->SetSubtitle ( "" );
	    $this->AddBreadCrumb ( "home", base_url () );
	    $this->load->library ( "jQGrid" );
	    $this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/my-paid-ticket" ) );
	    $this->Display ('admin/ticket/index');
	}
	
	function my_closed() {
	    $this->SetTitle ( "My Closed Ticket" );
	    $this->SetSubtitle ( "" );
	    $this->AddBreadCrumb ( "home", base_url () );
	    $this->load->library ( "jQGrid" );
	    $this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/mc-ticket" ) );
	    $this->Display ('admin/ticket/index');
	}
	
	function all_paid_ticket() {
	    $this->SetTitle ( "All Paid Ticket" );
	    $this->SetSubtitle ( "" );
	    $this->AddBreadCrumb ( "home", base_url () );
	    $this->load->library ( "jQGrid" );
	    $this->AddViewData ( "grid_url", site_url ( "admin/ticket-data/all-paid-ticket" ) );
	    $this->Display ('admin/ticket/index');
	}
	function set_assign($ticket_id='',$already_assign_id=''){
	    $this->SetTitle ( "Assign On Ticket" );
	    $this->SetPOPUPColClass ( "col-md-8" );
	    $this->SetPOPUPIconClass ( "fa fa-paperclip " );
	    $staff_list=Mapp_user::FindAllBy("status", "A");
	    
	    $adminData=GetAdminData();
	   
	    if(IsPostBack){
	        $assign_user=PostValue("assign",null);
	        if($assign_user){
	           if(Mticket::AssignUser($ticket_id, $assign_user, $adminData->id,true)){
    	           AddInfo("Successfully assigned");
    	           $this->DisplayPOPUPMsg();
    	           return;
	           }
	        }
	    }
	    $mainobj = Mticket::FindBy("id", $ticket_id);
	    $selected_user=null;
	    if(!empty($mainobj->assigned_on)){
	        foreach ($staff_list as $key=>$stf){
	            if($stf->id==$mainobj->assigned_on){
	                $selected_user=$stf;
	                unset($staff_list[$key]);
	            }
	        }
	    }
	    if(!empty($selected_user)){
	       $staff_list=array_merge([$selected_user->id=>$selected_user],$staff_list);
	    }
	    // $this->SetPopupFromMutipart();
	    $this->AddViewData ( "mainobj", $mainobj );
	    $this->AddViewData ( "staff_list", $staff_list );
	    $this->AddViewData ( "isUpdate", false );
	    $this->DisplayPOPUP ();
	}

	function add() {
		$this->SetTitle ( "New Ticket" );
		$this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
		$this->SetPOPUPIconClass ( "fa fa-star " );
		
		if (IsPostBack) {
			$nobject = new Mticket ();
			if ($nobject->SetFromPostData ( true )) {
				if ($nobject->Save ()) {
					AddInfo ( "Successfully added" );
					AddLog ( "A", $nobject->settedPropertyforLog (), "l001", "" );
					$this->DisplayPOPUPMsg ();
					return;
				}
			}
		}
		$mainobj = new Mticket ();
		// $this->SetPopupFromMutipart();
		$this->AddViewData ( "mainobj", $mainobj );
		$this->AddViewData ( "isUpdate", false );
		$this->DisplayPOPUP ();
	}
	function edit($param_id = "") {
		if (empty ( $param_id )) {
			AddError ( "Invalid request" );
			$this->DisplayPOPUPMsg ();
			return;
		}
		$this->SetTitle ( "Edit Ticket" );
		$this->SetPOPUPColClass ( "col-md-6 col-sm-6" );
		$this->SetPOPUPIconClass ( "fa fa fa-star " );
		if (IsPostBack) {
			$uobject = new Mticket ();
			if ($uobject->SetFromPostData ( false )) {
				$uobject->SetWhereUpdate ( "id", $param_id );
				if ($uobject->Update ()) {
					AddLog ( "U", $uobject->settedPropertyforLog (), "l002", "" );
					AddInfo ( "Successfully updated" );
					$this->DisplayPOPUPMsg ();
					return;
				}
			}
		}
		$mainobj = new Mticket ();
		$mainobj->id ( $param_id );
		if (! $mainobj->Select ()) {
			AddError ( "Invalid request" );
			$this->DisplayPOPUPMsg ();
			return;
		}
		OldFields ( $mainobj, "cat_title,ticket_body,ticket_user,opened_time,re_open_time,re_open_by,re_open_by_type,user_type,status,assigned_on,closed_by,ticket_rating,priroty" );
		// $this->SetPopupFromMutipart();
		$this->AddViewData ( "mainobj", $mainobj );
		$this->AddViewData ( "isUpdate", true );
		$this->DisplayPOPUP ( "admin/ticket/add" );
	}
	public function open() {
        $this->SetTitle("Admin ticket creation");
        $isHtmlEditor=Mapp_setting::GetSettingsValue("ticket_htmleditor","Y")=="Y";
        if($isHtmlEditor){
            AddAppHTMLEditor();
        }
        $mainobj=new Mticket();
        $final_custom_fields=array();
        $all_category_fields=array();
        $customfield=new Mcustom_field();
		$customfield->cat_id("not in ('R')",true);
        $customfield->status("A");
        foreach ($customfield->SelectAllGridData('','fld_order','ASC') as $fld){
	        $cats=explode(",",$fld->cat_id);
	        if(in_array('0',$cats)){
		        $all_category_fields[]=$fld;
		        continue;
	        }
            if(!isset($final_custom_fields[$fld->cat_id])){
                $final_custom_fields[$fld->cat_id]=[];
            }
            $final_custom_fields[$fld->cat_id][]=$fld;
        }
        $catagory_list=Mcategory::getAllCategoriesKeyValue();
        $cat_patent_list=array();
        foreach ($catagory_list AS $cat){
            $cateroty_array=[];
            if($cat->parent_category_path!=0){
                $cateroty_array=explode("-", $cat->parent_category_path);
            }
            $cat_patent_list[$cat->id]=array_map(function($value){return 1*$value;}, $cateroty_array);
        }
        $is_required_login=false;
        if(IsPostBack){

            $isEveryThingOk=true;
            $ticketBody=PostValue("ticket_body","",$isHtmlEditor);
            if(!$isHtmlEditor){
                $ticketBody=strip_tags($ticketBody);
            }else{
                $ticketBody=strip_tags($ticketBody, '<h1><h2><h3><h4><strong><b><span><ul><u><font><li><table><tr><img><div><td><th><tbody><thead><tfoot><hr><p><a>');
                if(isset($_POST['ticket_body'])){
                    $_POST['ticket_body']=$ticketBody;
                }
            }
            /* File Checking Related work*/
            $file_upload_list=array();
            if(Mapp_setting::GetSettingsValue("allow_ticket_file_upload")=="Y"){
                $already_uploaded=PostValue("a_uploaded_file",array());
                $was_uploaded=PostValue("w_uploaded_file",array());
                //GPrint($_POST);
                if(is_array($was_uploaded)){
                    if(!is_array($was_uploaded)){
                        $was_uploaded=[];
                    }
                    $deleted_files=array_diff($was_uploaded, $already_uploaded);
                    if(count($deleted_files)>0){
                        app_delete_uploaded($deleted_files, FCPATH."tmp/ticket");
                    }
                }
                if(count($already_uploaded)>0){
                    app_process_already_uploaded($already_uploaded, $file_upload_list, FCPATH."tmp/ticket");
                }
                $file_temp_path=FCPATH."tmp/ticket";
                app_make_dir($file_temp_path,0755,true);
                if($isEveryThingOk && !app_uploaded_files_ok($file_upload_list,FCPATH."tmp/ticket",time()."_")){
                    $isEveryThingOk=false;
                }

            }
            /* end Checking file related work*/
            if($isEveryThingOk){
                $newobj=new Mticket();
                $emailAddress=PostValue("user_email","");
                if(!empty($userData)){
                    $emailAddress=$userData->email;
                }
                if($newobj->SetFromPostData()){
                    $newobj->ticket_body($ticketBody);
	
	                $customFieldsNeedToBeSave=[];
	
	                if(!Mcustom_field::CheckValidCustomField($newobj->cat_id,$customFieldsNeedToBeSave)){
		                $isEveryThingOk=false;
	                }
	
	                /*foreach ($all_category_fields as $ccusfield){
						if(!$this->is_ok_custom_value($ccusfield,$customFieldsNeedToBeSave)){
							$isEveryThingOk=false;
						}
					}*/
	                $checking_cats=[];
	                $checking_cats[]=$newobj->cat_id;
	                $mctg=Mcategory::FindBy("id",$newobj->cat_id);
	                if(!empty($mctg->parent_category)){
		                $pctgs=explode("-",$mctg->parent_category);
		                if(is_array($pctgs) && count($pctgs)>0){
			                $checking_cats=array_merge($pctgs,$checking_cats);
		                }
	                }
	                foreach ($checking_cats as $ccat){
		                if(!Mcustom_field::CheckValidCustomField($ccat,$customFieldsNeedToBeSave)){
			                $isEveryThingOk=false;
		                }
	                }
	                $isNewlyOpenGuestUser=false;
                    if($isEveryThingOk){
                        if(empty($userData)){
                            if(!empty($emailAddress)){
                                $old_site_user=Msite_user::FindBy("email", $emailAddress);
                                if(!$old_site_user){
                                    $password=strtoupper(get8BitHashCode(rand(1000, 9999))).rand(10, 99);
                                    $siteU=new Msite_user();
                                    $siteU->email($emailAddress);
                                    $siteU->first_name("-");
                                    $siteU->user_type("G");
                                    $siteU->pass($password);
                                    if($siteU->Save()){
                                        //temporary password
                                        //AddInfo("Password ".$password,true);
                                        $newobj->ticket_user($siteU->id);
                                        $newobj->user_type($siteU->user_type);
                                        $isNewlyOpenGuestUser=true;
                                    }else{
                                        AddError("Ticket save failed. Please try again");
                                        $isEveryThingOk=false;
                                    }
                                }else {
                                    $newobj->ticket_user($old_site_user->id);
                                    $newobj->user_type($old_site_user->user_type);
                                }
                            }else{
                                AddError("Email address is required");
                                $isEveryThingOk=false;
                            }
                            //Need to create a guest user

                        }else{
                            $newobj->ticket_user($userData->id);
                            $newobj->user_type("U");
                        }
                    }
                    if($isEveryThingOk){
                        $is_alpguest_ticket=Mapp_setting::GetSettingsValue("is_alpguest_ticket","N")=="Y";
                       /*if(empty($userData) && !$is_alpguest_ticket){
                            $newobj->priroty("L");
                        }
                        if(Mapp_setting::GetSettingsValue("is_public_ticket")!="Y"){
                            $newobj->is_public("N");
                        }*/
                        $newobj->status("N");
                        if($newobj->Save()){
                            $new_path=FCPATH."data".DIRECTORY_SEPARATOR."/{$newobj->ticket_user}/ticket/{$newobj->id}/pri";
                            if(app_make_dir($new_path,600,true)){
                                app_move_files($file_upload_list, $new_path);
                            }
                            $is_saved_all_ok=true;
                            foreach ($customFieldsNeedToBeSave as $customTicketObj){
                                //$customTicketObj=new Mticket_custom_field();
                                $customTicketObj->ticket_id($newobj->id);
                                if(!$customTicketObj->Save()){
                                    $is_saved_all_ok=false;
                                }
                            }
                            if($is_saved_all_ok){
                                AddInfo("A ticket email has been sent to your email. Please check that");

                                $this->session->SetSession("admin_new_ticket_".$newobj->id, $newobj);
                                redirect("admin/ticket/opened/{$newobj->id}");
                            }
                        }
                    }

                    //AddInfo(GPrint($newobj,true));
                }

            }//chaptcha check

            if(count($file_upload_list)>0){
                $this->AddViewData("uploaded_file_list", $file_upload_list);
            }
        }
      
        $this->AddViewData("cat_patent_list", $cat_patent_list);
        $this->AddViewData("all_category_fields", $all_category_fields);
        $file_session_id=$this->session->GetSession("file_tmp_id");
        $this->AddViewData("file_session_id", $file_session_id);
        $this->AddViewData("custom_fields", $final_custom_fields);
        $this->AddViewData("mainobj", $mainobj);
        $this->Display();
    }
	
	/**
	 *
	 * @param Mcustom_field $cfld        	
	 * @param unknown $customFieldsNeedToBeSave        	
	 */
	private function is_ok_custom_value($cfld, &$customFieldsNeedToBeSave = []) {
		$posted_value = PostValue ( "custom_" . $cfld->id, null );
		$ticketCustomObject = new Mticket_custom_field ();
		$ticketCustomObject->custom_id ( $cfld->id );
		$ticketCustomObject->fld_title ( $cfld->title );
		$ticketCustomObject->fld_value ( $posted_value );
		$ticketCustomObject->fld_value_text ( $posted_value );
		$ticketCustomObject->is_api_based ( $cfld->is_api_based );
		
		if ($cfld->is_required == "Y") {
			if (empty ( $posted_value )) {
				AddError ( __ ( "%s is required", $cfld->title ) );
				return false;
			}
		}
		/*
		 * if(($cfld->is_api_based!="R" || $cfld->is_api_based!="D")){
		 * $opt=explode(",", $cfld->opt_json_base);
		 * $ticketCustomObject->fld_value_text(getTextByKey($posted_value)); // no need
		 * }else
		 */
		
		if ($cfld->type == "O") {
			
			$ticketCustomObject->fld_value_text ( $posted_value == "Y" ? "Yes" : "No" );
		}
		if (! empty ( $posted_value ) && ($cfld->is_api_based != "R" || $cfld->is_api_based != "D" || $cfld->is_api_based != "O") && $cfld->is_api_based == "Y" && ! empty ( $cfld->api_name )) {
			$apiObj = APP_API::get_api_object ( $cfld->api_name );
			if ($apiObj) {
				
				$msg = "";
				$apidata = $apiObj->get_api_response ( $posted_value );
				if ($cfld->on_submit_api_check == "Y" && ! $apidata->status) {
					AddError ( $apidata->msg );
					return false;
				}
				$ticketCustomObject->api_name ( $cfld->api_name );
				$ticketCustomObject->api_data ( base64_encode ( json_encode ( $apidata ) ) );
			}
		}
		$ticketCustomObject->ticket_id ( "0" );
		if (! $ticketCustomObject->IsValidForm ()) {
			return false;
		}
		$customFieldsNeedToBeSave [] = $ticketCustomObject;
		return true;
	}
	public function api_check($api_name, $post_name) {
		// sleep(5);
		// ^[A-Za-z0-9_]+$
		$this->output->unset_template ();
		$field_value = PostValue ( $post_name );
		$apiObj = APP_API::get_api_object ( $api_name );
		$msg = "API error";
		$isAvailable = false;
		if ($apiObj) {
			$isAvailable = $apiObj->is_valid_field_value ( $field_value, $msg );
		}
		// Finally, return a JSON
		die ( json_encode ( array (
				'valid' => $isAvailable,
				'message' => $msg 
		) ) );
	}
	public function opened($ticket_id = '') {
		$this->SetTitle ( "Ticket Open By Admin" );
		$ticketObj = $this->session->GetSession ( "admin_new_ticket_" . $ticket_id );
		$this->AddViewData ( "ticketObj", $ticketObj );
		$this->Display ();
	}
	public function ticket_tmp_img($tmp_session_id = '', $name = '') {
		$this->output->unset_template ();
		$file_temp_session_id = $this->session->GetSession ( "file_tmp_id" );
		if ($file_temp_session_id == $tmp_session_id) {
			$main_file_path = "";
			if (file_exists ( FCPATH . "tmp/ticket/$name" )) {
				$main_file_path = FCPATH . "tmp/ticket/$name";
			} else {
				$main_file_path = FCPATH . "images/no-image.png";
			}
			if (file_exists ( $main_file_path )) {
				// header('Content-Description: File Transfer');
				header ( 'Content-Type: ' . mime_content_type ( $main_file_path ) );
				header ( 'Content-Disposition: filename="' . basename ( $main_file_path ) . '"' );
				header ( 'Expires: 0' );
				header ( 'Cache-Control: must-revalidate' );
				header ( 'Pragma: public' );
				header ( 'Content-Length: ' . filesize ( $main_file_path ) );
				ob_clean ();
				flush ();
				readfile ( $main_file_path );
				exit ();
			}
		} else {
			header ( 'HTTP/1.0 401 Unauthorized' );
			echo "<h1/>Unauthorize Access Forbidden</h1>";
			exit ();
		}
	}
	public function ticket_img($session_hash, $user_id = '', $ticket_id = '', $name = '', $replied_id = '') {
		$this->output->unset_template ();
		if ((! empty ( $ticket_id ) && ! empty ( $user_id ) && ! empty ( $name ))) {
			$main_file_path = Mticket::get_ticket_file_path ( $user_id, $ticket_id, false, $replied_id ) . "$name";
			$main_file_path = urldecode ( $main_file_path );
			$calculated_hash = Mticket::get_hash ( $main_file_path );			
			$userdata = GetAdminData();
			
			if (($userdata || HasTicketSession ( $ticket_id )) || $calculated_hash == $session_hash) {
				if (file_exists ( $main_file_path )) {
					// header('Content-Description: File Transfer');
				    $ftype=mime_content_type ( $main_file_path);
				    if(empty($ftype) || strtolower(substr($ftype, 0,3))!="ima"){				        
				        header('Content-Disposition: attachment; filename="' . basename ( $main_file_path ) . '"');
				    }else{
				        header ( 'Content-Disposition: filename="' . basename ( $main_file_path ) . '"' );
				    }
					header ( 'Content-Type: ' . $ftype );					
					header ( 'Expires: 0' );
					header ( 'Cache-Control: must-revalidate' );
					header ( 'Pragma: public' );
					header ( 'Content-Length: ' . filesize ( $main_file_path ) );
					ob_clean ();
					flush ();
					readfile ( $main_file_path );
					// print_r($_SERVER);
					
					exit ();
				} else {
					header ( 'HTTP/1.0 401 Unauthorized' );
					echo "<h1/>Unauthorize Access Forbidden. Please don't use any downloader if download failed</h1>";
					exit ();
				}
			} else {
				header ( 'HTTP/1.0 401 Unauthorized' );
				echo "<h1/>Unauthorize Access Forbidden. Please don't use any downloader if download failed</h1>";
				exit ();
			}
		} else {
			header ( 'HTTP/1.0 401 Unauthorized' );
			echo "<h1/>Unauthorize Access Forbidden. Please don't use any downloader if download failed</h1>";
			exit ();
		}
	}
	public function ticket_replied_file($session_hash, $user_id = '', $ticket_id = '', $replied_id = '', $name = '') {
		$this->output->unset_template ();
		$this->ticket_img ( $session_hash, $user_id, $ticket_id, $name, $replied_id );
	}
	
	function details($id) {
		$this->SetTitle ( "Ticket Details" );
		$isHtmlEditor = Mapp_setting::GetSettingsValue ( "ticket_htmleditor", "Y" ) == "Y";
		if ($isHtmlEditor) {
			AddAppHTMLEditor ();
		}
		$ticketObj = Mticket::FindBy ( "id", $id );
		if($ticketObj->status=="C"){
			$this->AddBreadCrumb ( "Closed Tickets", site_url ( "ticket/closed-tickets" ), "fa fa-ticket" );
		}else{
			$this->AddBreadCrumb ( "Active Tickets", site_url ( "ticket/active-tickets" ), "fa fa-ticket" );
		}
		AppNotification::CheckTicketNotification($id);
		$files = [ ];
		$custom_fields = [ ];
		$ticket_replies = [ ];
		$ticket_logs = [ ];
		$ticket_user = new Msite_user ();
		if (! empty ( $ticketObj->id )) {
			$files = Mticket::get_all_attachments_by_ticket_obj ( $ticketObj );
			$custom_fields = Mticket_custom_field::FindAllBy ( "ticket_id", $ticketObj->id );
			$ticket_replies = Mticket_reply::FindAllBy ( "ticket_id", $ticketObj->id,[],'reply_time', "ASC" );
			$ticket_logs = Mticket_log::FindAllBy ( "ticket_id", $ticketObj->id, [ ], 'entry_time', "DESC" );
			$ticket_user = Msite_user::FindBy ( "id", $ticketObj->ticket_user );
		}
		// $files=
		
		// AddError("You are not authorize to view this ticket");
		$this->AddViewData ( "ticket_files", $files );
		$this->AddViewData ( "custom_fields", $custom_fields );
		$this->AddViewData ( "ticket_logs", $ticket_logs );
		$this->AddViewData ( "ticket_replies", $ticket_replies );
		$this->AddViewData ( "ticket_user", $ticket_user );
		$this->AddViewData ( "ticketObj", $ticketObj );
		$this->Display ();
	}
	
	function re_open($ticket_id=''){
	    $this->output->unset_template();
	    $userdata=GetAdminData();
	    if(($userdata)){
	        $ticketObj=Mticket::FindBy("id", $ticket_id);
	        if(Mticket::hasTicketReplyPermission($ticketObj)){	           
	            if(Mticket::ReopenStatus($ticket_id, "R", $userdata->id, "A",true)){
	                Mticket_reply::add($ticket_id, $userdata->id, "A", "Ticket re opened", "R", "Y", $ticketObj->assigned_on,false);
	                redirect("admin/ticket/details/{$ticket_id}");
	            }
	        }
	    }
	
	}
	function field_details($ticket_id = '', $field_id = '') {
		$data_str = __ ( "Noting to show" );
		$this->SetTitle ( "Field Details" );
		$field_title = "";
		$field_value = "";
		$userdata = GetUserData ();
		
		if (($userdata || HasTicketSession ( $ticket_id ))) {
			if (! empty ( $ticket_id ) && ! empty ( $field_id )) {
				$mtcus = Mticket_custom_field::FindBy ( "id", $field_id, array (
						"ticket_id" => $ticket_id 
				) );
				
				if ($mtcus && $mtcus->is_api_based == "Y") {
					$field_title = $mtcus->fld_title;
					$field_value = $mtcus->fld_value_text;
					$mapiobj = APP_API::get_api_object ( $mtcus->api_name );
					$msg = "";
					$data_str = $mapiobj->get_html_display_by_response ( json_decode ( base64_decode ( $mtcus->api_data ) ) );
				} else {
					
					AddError ( "Field Data Error" );
					$this->DisplayMSGOnly ();
				}
			} else {
				
				AddError ( "Field Data Error" );
				$this->DisplayMSGOnly ();
			}
		} else {
			AddError ( "You are not authorize to see this details" );
		}
		$this->AddViewData ( "data_str", $data_str );
		$this->AddViewData ( "fld_title", $field_title );
		$this->AddViewData ( "field_value", $field_value );
		$this->DisplayPOPUP ();
	}
	function change_category($ticket_id,$isSet="N"){	   
	     $this->SetTitle("Change Category");	    
	    $ticket=Mticket::FindBy("id", $ticket_id);
	    if(!$ticket){
	        AddError("Ticket information is invalid");
	        $this->DisplayPOPUPMsg();
	        return;
	    }
	    if($isSet=="Y"){
	        $this->SetTitle("Set Category of ticket: ".$ticket->ticket_track_id);
	    }else{
	        $this->SetTitle("Change Category of ticket: ".$ticket->ticket_track_id);
	    }
	    
	    if (IsPostBack) {
	        $uobject = new Mticket ();
	        $cat_id=PostValue("cat_id");
	        $uobject->cat_id($cat_id);
	        if ($uobject->IsValidForm( false )) {
	            $uobject->SetWhereUpdate ( "id", $ticket_id );
	            if ($uobject->Update ()) {
	                AddLog ( "U", $uobject->settedPropertyforLog (), "l002", "" );
	                AddInfo ( "Successfully updated" );
	                $this->DisplayPOPUPMsg ();
	                return;
	            }
	        }
	    }
	    $this->AddViewData ( "mainobj", $ticket );
	    $this->DisplayPOPUP ();
	}
    function change_priority($ticket_id){
        $this->SetTitle("Change Priority");
        $ticket=Mticket::FindBy("id", $ticket_id);
        if(!$ticket){
            AddError("Ticket information is invalid");
            $this->DisplayPOPUPMsg();
            return;
        }
        $this->SetTitle("Change Priority of ticket: ".$ticket->ticket_track_id);
        if (IsPostBack) {
            $uobject = new Mticket ();
            $priroty=PostValue("priroty");
            $uobject->priroty($priroty);
            if ($uobject->IsValidForm( false )) {
                $uobject->SetWhereUpdate ( "id", $ticket_id );
                if ($uobject->Update ()) {
                    AddLog ( "U", $uobject->settedPropertyforLog (), "l002", "" );
                    AddInfo ( "Successfully updated" );
                    $this->DisplayPOPUPMsg ();
                    return;
                }
            }
        }
        $this->AddViewData ( "mainobj", $ticket );
        $this->DisplayPOPUP ();
    }
	function edit_reply($ticket_id='',$reply_id='')
    {
        $this->SetTitle ( "Edit Ticket Reply" );
        $this->SetPOPUPColClass ( "col-md-8 col-sm-10" );
        $this->SetPOPUPIconClass ( "fa fa fa-star " );
        if(empty($ticket_id) || empty($reply_id)){
            AddError( "Parameter error" );
            $this->DisplayPOPUPMsg ();
            return;
        }

        $mainobj = new Mticket_reply();
        $mainobj->ticket_id ( $ticket_id );
        $mainobj->reply_id ( $reply_id );
        if (! $mainobj->Select ()) {
            AddError ( "Invalid request" );
            $this->DisplayPOPUPMsg ();
            return;
        }
        if($mainobj->is_user_seen=="Y"){
            AddError ( "The reply is already seen by user" );
            $this->DisplayPOPUPMsg ();
            return;
        }

        if (IsPostBack) {
            $uobject = new Mticket_reply();
            $ticketBody=PostValue('ticket_body',"");
            $uobject->reply_text($ticketBody);
            if ($uobject->SetFromPostData ( false )) {
                $uobject->SetWhereUpdate ( "ticket_id", $ticket_id );
                $uobject->SetWhereUpdate ( "reply_id", $reply_id );
                if ($uobject->Update ()) {
                    AddLog ( "U", $uobject->settedPropertyforLog (), "l002", "" );
                    AddInfo ( "Successfully updated" );
                    $this->DisplayPOPUPMsg ();
                    return;
                }
            }

        }

        //OldFields ( $mainobj, "reply_text" );
        // $this->SetPopupFromMutipart();
        $this->AddViewData ( "mainobj", $mainobj );
        $this->AddViewData ( "isUpdate", true );
        $this->DisplayPOPUP ();

    }
    function load_ticket_reply($ticket_id='',$ticket_reply_id='',$limit=3){
        $response=new APPAPIResponse();
        $response->status=false;
        $response->data=[];
        $response->tlog=[];
        $extraParam=[];
        $ticket=Mticket::FindBy("id",$ticket_id);
        $ticket_user=Msite_user::FindBy("id",$ticket->ticket_user);
        if(!empty($ticket_reply_id)){
            $extraParam['reply_id']=$ticket_reply_id;
            $limit=1;
        }
        $ticket_reply_data=Mticket_reply::FindAllBy("ticket_id",$ticket_id,$extraParam,'reply_time','DESC',$limit);
        $ticket_log_data=Mticket_log::FindAllBy("ticket_id",$ticket_id,[],'entry_time','DESC',$limit);
        $total=count($ticket_reply_data);
        if($total>0){
            $response->status=true;
        }
        for ($i=$total-1; $i>=0;$i--){
            $d=$ticket_reply_data[$i];
            $obj=new stdClass();
            $obj->id="id_".$d->ticket_id."_".$d->reply_id;
            $obj->html=GetTicketReplyHTML($d,"","animated zoomIn");
            $response->data[]=$obj;
        }
        foreach ($ticket_log_data as $ticket_log_datum) {
            $obj=new stdClass();
            $obj->id="log_".$ticket_log_datum->ticket_id."_".$ticket_log_datum->log_id;
            $obj->html=GetTicketLogWithUser($ticket_log_datum,$ticket_user,"animated zoomIn");
            $response->tlog[]=$obj;
        }
        echo json_encode($response); die;
    }

}
?>