<?php

use PayPal\Api\Payer;
use PayPal\Api\ItemList;
use PayPal\Api\Item;
use PayPal\Api\Payment;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
class Ticket extends APP_Controller {
	
	public function index()
	{
		$this->SetTitle("Knowledge List");
	
		$stickyKnowledges=Mknowledge::FindAllBy("is_stickey", "Y",array("status"=>"P"),'entry_time');
		$total=count($stickyKnowledges);
		$total=20-$total;
		$knowledges=Mknowledge::FindAllBy("is_stickey", "N",array("status"=>"P"),'entry_time','DESC',$total);
		//GPrint($stickyKnowledges);
		//GPrint($knowledges);
		$knowledges=array_merge($stickyKnowledges,$knowledges);		
		$this->AddViewData("knowledges", $knowledges);
		$this->Display();
	}
	
	public function open()
	{
		$this->SetTitle("New Ticket");
		$isHtmlEditor=Mapp_setting::GetSettingsValue("ticket_htmleditor","Y")=="Y";
		if($isHtmlEditor){
			AddAppHTMLEditor();
		}
		$userData=GetUserData();
		$isGuestTicketEnable=Mapp_setting::GetSettingsValue("is_guest_ticket","N")=="Y";
		if(empty($userData) && !$isGuestTicketEnable){
		  $this->Display('user/login_shower');
		  return;
		}
		
		$emsg="";
		if(!empty($userData) && !Mticket::CheckLimit($userData->id,false,$emsg)){
			$this->DisplayMSGOnly($emsg,site_url());
			return;
		}
		
		$mainobj=new Mticket();		
		$final_custom_fields=array();
		$final_ctg_base_fields=[];
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
			$ctgs=explode(",",$fld->cat_id);
			foreach ( $ctgs as $ctg) {
				$final_ctg_base_fields[$ctg]=$fld;
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
			if(empty($userData) && Mapp_setting::GetSettingsValue("is_cptcha_guest_ticket","N")=="Y"){
				if(!AppCaptcha::is_valid_captcha()){					
					$isEveryThingOk=false;
				}
			}
			
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
								}else{
									if($old_site_user->user_type=="G"){
										$newobj->ticket_user($old_site_user->id);
										$newobj->user_type($old_site_user->user_type);
									}else{
										AddError("This email address has been regisited. Would you please login before open ticket.");
										$is_required_login=true;
										$isEveryThingOk=false;
									}
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
					
					
					//end ticket counter
					if($isEveryThingOk){
						
					    $is_alpguest_ticket=Mapp_setting::GetSettingsValue("is_alpguest_ticket","N")=="Y";
						if(empty($userData) && !$is_alpguest_ticket){
							$newobj->priroty("L");
						}		
						if(Mapp_setting::GetSettingsValue("is_public_ticket")!="Y"){
							$newobj->is_public("N");
						}
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
								
								$this->session->SetSession("new_ticket_".$newobj->id, $newobj);
								redirect("ticket/opened/{$newobj->id}");
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
	 * @param Mcustom_field $cfld
	 * @param unknown $customFieldsNeedToBeSave
	 */
	private function is_ok_custom_value($cfld,&$customFieldsNeedToBeSave=[]){		
		$posted_value=PostValue("custom_".$cfld->id,null);
		$ticketCustomObject=new Mticket_custom_field();		
		$ticketCustomObject->custom_id($cfld->id);
		$ticketCustomObject->fld_title($cfld->title);
		$ticketCustomObject->fld_value($posted_value);
		$ticketCustomObject->fld_value_text($posted_value);
		$ticketCustomObject->is_api_based($cfld->is_api_based);
				
		if($cfld->is_required=="Y"){
			if(empty($posted_value)){
				AddError(__("%s is required",$cfld->title));
				return false;
			}
		}
		/*if(($cfld->is_api_based!="R" || $cfld->is_api_based!="D")){
			$opt=explode(",", $cfld->opt_json_base);
			$ticketCustomObject->fld_value_text(getTextByKey($posted_value)); // no need 
		}else*/
		
		if($cfld->type=="O"){
			
			$ticketCustomObject->fld_value_text($posted_value=="Y"?"Yes":"No");
		}
		if(!empty($posted_value) && ($cfld->is_api_based!="R" || $cfld->is_api_based!="D" || $cfld->is_api_based!="O") &&  $cfld->is_api_based=="Y" && !empty($cfld->api_name)){
			$apiObj=APP_API::get_api_object($cfld->api_name);
			if($apiObj){
				
				$msg="";
				$apidata=$apiObj->get_api_response($posted_value);
				if($cfld->on_submit_api_check=="Y" && !$apidata->status){
					AddError($apidata->msg);
					return false;
				}
				$ticketCustomObject->api_name($cfld->api_name);
				$ticketCustomObject->api_data(base64_encode(json_encode($apidata)));				
				
			}
		}
		$ticketCustomObject->ticket_id("0");
		if(!$ticketCustomObject->IsValidForm()){
			return false;
		}
		$customFieldsNeedToBeSave[]=$ticketCustomObject;
		return true;
	}
	public function api_check($api_name,$post_name){
		//sleep(5);
		// ^[A-Za-z0-9_]+$
		$this->output->unset_template ();
		$field_value = PostValue ( $post_name );
		$apiObj=APP_API::get_api_object($api_name);
		$msg="API error";
		$isAvailable = false;
		if($apiObj){
			$isAvailable=$apiObj->is_valid_field_value($field_value,$msg);
		}	
		// Finally, return a JSON
		die ( json_encode ( array (
				'valid' => $isAvailable,
				'message' => $msg
		) ) );
	}
	
	public function opened($ticket_id=''){
		$this->SetTitle("Ticket Open By Guest");
		$ticketObj=$this->session->GetSession("new_ticket_".$ticket_id);
		$this->AddViewData("ticketObj", $ticketObj);
		$this->Display();
	}
	
	public function ticket_tmp_img($tmp_session_id='',$name=''){
		$this->output->unset_template();
		$file_temp_session_id=$this->session->GetSession("file_tmp_id");
		if($file_temp_session_id==$tmp_session_id){		
			$main_file_path="";
			if(file_exists(FCPATH."tmp/ticket/$name")){
				$main_file_path=FCPATH."tmp/ticket/$name";
			}else{
				$main_file_path=FCPATH."images/no-image.png";
			}
			if (file_exists($main_file_path)) {
				//header('Content-Description: File Transfer');
				header('Content-Type: '.mime_content_type ( $main_file_path));
				header('Content-Disposition: filename="'.basename($main_file_path).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($main_file_path));
				ob_clean();
				flush();
				readfile($main_file_path);
				exit;
			}	
		}else{
			header('HTTP/1.0 401 Unauthorized');
			echo "<h1/>Unauthorize Access Forbidden</h1>";
			exit;
		}	
	}
    public function ticket_img($session_hash,$user_id='',$ticket_id='',$name='',$replied_id=''){
        $this->output->unset_template();
        if((!empty($ticket_id) && !empty($user_id) && !empty($name))){
            $main_file_path=Mticket::get_ticket_file_path($user_id, $ticket_id,false,$replied_id)."$name";
            $main_file_path=urldecode($main_file_path);
            $calculated_hash=Mticket::get_hash($main_file_path);
            //echo $calculated_hash;
            $userData=GetUserData();

            if(($userData && $userData->id==$user_id) || HasTicketSession($ticket_id)){
                if (file_exists($main_file_path)) {
                    $ftype=mime_content_type ( $main_file_path);
                    if(empty($ftype) || strtolower(substr($ftype, 0,3))!="ima"){
                        header('Content-Disposition: attachment; filename="' . basename ( $main_file_path ) . '"');
                    }else{
                        header ( 'Content-Disposition: filename="' . basename ( $main_file_path ) . '"' );
                    }
                    header('Content-Type: '.$ftype);
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($main_file_path));
                    ob_get_clean();
                    readfile($main_file_path);
                    exit;
                }else{
                    header('HTTP/1.0 401 Unauthorized');
                    echo "<h1/>Unauthorize Access Forbidden. Please don't use any downloader if download failed</h1>";
                    exit;
                }
            }else{
                header('HTTP/1.0 401 Unauthorized');
                echo "<h1/>Unauthorize Access Forbidden. Please don't use any downloader if download failed</h1>";
                exit;
            }
        }else{
            header('HTTP/1.0 401 Unauthorized');
            echo "<h1/>Unauthorize Access Forbidden. Please don't use any downloader if download failed</h1>";
            exit;
        }
    }
	public function ticket_replied_file($session_hash,$user_id='',$ticket_id='',$replied_id='',$name=''){
		$this->output->unset_template();
		$this->ticket_img($session_hash,$user_id,$ticket_id,$name,$replied_id);
	}
	function active_tickets(){
		$this->CheckPageAccess();
		$this->SetTitle("Active Tickets");
		//$this->SetSubtitle("Your Active Ticket List");
		$this->SetIcon("fa fa-ticket");
		$this->AddBreadCrumb("User Panel", site_url("client/panel/dashboard"),"fa fa-user-o");
		$userData=GetUserData();
		$ticket_list=[];
		if($userData){
			AddModule("my_menu",APP_Output::MODULE_LEFT);
			$mtkt=new Mticket();
			$mtkt->ticket_user($userData->id);
			$mtkt->status("in ('N','P','R','A')",true);
			$ticket_list=$mtkt->SelectAllGridData("","re_open_time","DESC");
		}
		$this->AddViewData("ticket_list", $ticket_list);
		$this->Display();
	}
	

	function closed_tickets(){
		$this->CheckPageAccess();
		$this->SetTitle("Close Tickets");		
		//$this->SetSubtitle("Your Closed Ticket List");
		$this->SetIcon("fa fa-ticket");
		$this->AddBreadCrumb("User Panel", site_url("client/panel/dashboard"),"fa fa-user-o");
		$userData=GetUserData();
		
		$ticket_list=[];
		if($userData){
			AddModule("my_menu",APP_Output::MODULE_LEFT);
			$mtkt=new Mticket();
			$mtkt->ticket_user($userData->id);
			$mtkt->status("C");
			$ticket_list=$mtkt->SelectAllGridData("","re_open_time","DESC");
		}
		$this->AddViewData("ticket_list", $ticket_list);
		$this->Display();
	}
	
	function details($id){
		$this->SetTitle("Ticket Details");
		$isHtmlEditor=Mapp_setting::GetSettingsValue("ticket_htmleditor","Y")=="Y";
		if($isHtmlEditor){
			AddAppHTMLEditor();
		}
		$userData=GetUserData();
		$ticketObj=null;
		if($userData){
			$app_layout=Mapp_setting::GetSettingsValue("app_layout","F");
			if($app_layout=="F"){
				AddModule("my_menu",APP_Output::MODULE_LEFT);
			}
			$ticketObj=Mticket::FindBy("id", $id);
			//GPrint($ticketObj);
			if($ticketObj->ticket_user != $userData->id){				
			  $this->DisplayMSGOnly("You are not authorizse to see this ticket");
		      return;
			}else{
				$active_status=array("N","P","R");
				if(in_array($ticketObj->status, $active_status)){
					$this->AddBreadCrumb("Active Tickets", site_url("ticket/active-tickets"),"fa fa-ticket");
				}else{
					$this->AddBreadCrumb("Closed Tickets", site_url("ticket/closed-tickets"),"fa fa-ticket");
				}
			}
			
		}else{
			$ticketObj=$this->session->GetSession("new_ticket_".$id);
		}
		if(empty($ticketObj)){
		    $this->DisplayMSGOnly("You are not authorizse to see this ticket");
		    return;
		}
		$files=[];
		$custom_fields=[];
		$ticket_replies=[];
		$ticket_logs=[];
		$ticket_user=new Msite_user();		
		if(!empty($ticketObj->id)){				
			$files=Mticket::get_all_attachments_by_ticket_obj($ticketObj);
			$custom_fields=Mticket_custom_field::FindAllBy("ticket_id", $ticketObj->id);
			$ticket_replies=Mticket_reply::FindAllBy("ticket_id", $ticketObj->id,[],'reply_time', "ASC");
			$ticket_logs=Mticket_log::FindAllBy("ticket_id", $ticketObj->id,[],'entry_time',"DESC");
			$ticket_user=Msite_user::FindBy("id", $ticketObj->ticket_user);
			
		}
		//$files=
		
		
		Mticket::SetSeenStatus($ticketObj->id, true);
		$this->AddViewData("ticket_files", $files);
		$this->AddViewData("custom_fields", $custom_fields);
		$this->AddViewData("ticket_logs", $ticket_logs);
		$this->AddViewData("ticket_replies", $ticket_replies);
		$this->AddViewData("ticket_user", $ticket_user);		
		$this->AddViewData("ticketObj", $ticketObj);
		$this->Display();
	}
	function re_open($ticket_id=''){
		$userdata=GetUserData();
		if(($userdata || HasTicketSession($ticket_id))){
			$reply_user_id="";
			$reply_user_Type="";
			$ticketObj=null;
			if(!empty($userdata)){
				$reply_user_id=$userdata->id;
				$reply_user_Type="U";
				$ticketObj=Mticket::FindBy("id", $ticket_id);
				if($ticketObj){
					if($ticketObj->ticket_user!=$userdata->id && $ticketObj->is_public!="Y"){
						AddError("You can't reply on this ticket",true);
						redirect("ticket/details/{$ticket_id}");
						return;
					}
				}
			}else{
				$ticketObj=GetTicketSessionObj($ticket_id);
				$reply_user_id=$ticketObj->ticket_user;
				$reply_user_Type=$ticketObj->user_type;;
			}
			if(!Mticket::UserCanReopenByID($ticket_id)){
				$this->DisplayMSGOnly("You can't re-open this ticket",site_url("ticket/details/{$ticket_id}"));
				return;
			}
			$this->output->unset_template();
			if(Mticket::ReopenStatus($ticket_id, "R", $reply_user_id, $reply_user_Type,true)){
				Mticket_reply::add($ticket_id, $reply_user_id, $reply_user_Type, "Ticket re opened", "R", "Y", $ticketObj->assigned_on,false);
				redirect("ticket/details/{$ticket_id}");
			}
		}
		
	}
	
	function field_details($ticket_id='',$field_id=''){
		
		$data_str=__("Noting to show");
		$this->SetTitle("Field Details");
		$field_title="";
		$field_value="";
		$userdata=GetUserData();
		$cu=GetCurrentUserType();	
		if(($cu=="AD" || $userdata || HasTicketSession($ticket_id))){
		if(!empty($ticket_id) && !empty($field_id)){
			$mtcus=Mticket_custom_field::FindBy("id", $field_id,array("ticket_id"=>$ticket_id));
			
			if($mtcus && $mtcus->is_api_based=="Y"){
				$field_title=$mtcus->fld_title;				
				$field_value=$mtcus->fld_value_text;
				$mapiobj=APP_API::get_api_object($mtcus->api_name);
				$msg="";
				$res=$mapiobj->get_api_response($field_value);
				if(!empty($res)){
					$data_str=$mapiobj->get_html_display_by_response($res);
				}else{
					$data_str=$mapiobj->get_html_display_by_response(json_decode(base64_decode($mtcus->api_data)));
				}
				
			}else{
				
				AddError("Field Data Error");
				$this->DisplayPOPUPMsg();
			}
		}else{
			
			AddError("Field Data Error");
			$this->DisplayPOPUPMsg();
		
		}
		}else{
			AddError("You are not authorize to see this details");
		}
		$this->AddViewData("data_str", $data_str);
		$this->AddViewData("fld_title", $field_title);
		$this->AddViewData("field_value", $field_value);
		$this->DisplayPOPUP();
	}
	function user_ticket($ticket_track_id){
	    $this->SetTitle("User Ticket");
	  
	    $userdata=GetUserData();
	    if(!empty($userdata)){
	        $mticket=Mticket::FindBy("ticket_track_id", $ticket_track_id);
	        if($mticket && $mticket->ticket_user==$userdata->id){
	            redirect("ticket/details/{$mticket->id}");
	            return;
	        }else{
	            $this->DisplayMSGOnly("You are not authorize to see this details of this ticket");
	            return;
	          
	        }
	    }
	  
	    $this->AddViewData("track_id", $ticket_track_id);
	    $this->Display('user/login_shower');
	    
	}
	function guest_ticket($ticket_track_id){
	    UnsetModule("content_header");
	    $this->SetTitle("User Ticket");
	    $this->AddViewData("track_id", $ticket_track_id);
	    if(IsPostBack){
	        if(AppCaptcha::is_valid_captcha()){
	            $ticket_email=PostValue("ticket_email","");
	            if(!empty($ticket_email)){
	                $tuser=Msite_user::FindBy("email", $ticket_email);
	                if($tuser->user_type=="G"){
    	                $mticket=Mticket::FindBy("ticket_track_id", $ticket_track_id);
            	        if($mticket && $mticket->ticket_user==$tuser->id){
            	            $this->session->SetSession("new_ticket_".$mticket->id, $mticket);
            	            redirect("ticket/details/{$mticket->id}");
            	            return;
            	        }
	                }else{
	                    redirect("ticket/user-ticket/{$ticket_track_id}");
	                    return;
	                }
	            }else{
	                AddError("Woops !! empty email address. Try again");
	            }
	        }else{
	            AddError("Woops !! Captch invalid. Try again");
	        }
	    }
	    $this->Display();	  
	}
	function ticket_payment($ticket_id="",$reply_id="",$payment_id=""){
	    	   
	    $this->SetTitle("Choose Payment Method");
	    if(empty($ticket_id) || empty($reply_id) || empty($payment_id)){
	        AddError("Invalid request");
	        $this->DisplayMSGOnly("Request param is missing, Try again");
	        return;
	    }

        $this->Display();
    }
    function ticket_payment_process($method='',$ticket_id="",$reply_id="",$payment_id=""){
        $this->SetTitle("Choose Payment Method");
        if(empty($ticket_id) || empty($reply_id) || empty($payment_id)){
            AddError("Invalid request");
            $this->DisplayMSGOnly("Request param is missing, Try again");
            return;
        }
        $this->SetTitle("Ticket Payment");
        if(empty($ticket_id) || empty($reply_id) || empty($payment_id)){
            AddError("Invalid request");
            $this->DisplayMSGOnly("Request param is missing, Try again");
            return;
        }
        $isDisplayed=false;
        $payment_obj=Mticket_payment::FindBy("id", $payment_id,["ticket_id"=>$ticket_id,"reply_id"=>$reply_id]);
        if($payment_obj) {
            $payment_id_str = $ticket_id . "-" . $reply_id . "-" . $payment_id;
            AddOnManager::DoFilter("process-payment-".$method,$payment_id_str,$payment_obj,$this,$isDisplayed);
        }else{
            $this->DisplayMSGOnly("Invalid payment information");
            return;
        }
        $this->Display();
    }
    function ticket_payment_paypal($ticket_id="",$reply_id="",$payment_id=""){

        $this->SetTitle("Ticket Payment");
        if(empty($ticket_id) || empty($reply_id) || empty($payment_id)){
            AddError("Invalid request");
            $this->DisplayMSGOnly("Request param is missing, Try again");
            return;
        }
        $payment_obj=Mticket_payment::FindBy("id", $payment_id,["ticket_id"=>$ticket_id,"reply_id"=>$reply_id]);
        if($payment_obj){
            $payment_id_str=$ticket_id."-".$reply_id."-".$payment_id;
            //GPrint($payment_obj);
            $this->load->library("APPPaypal");
            $paypal=new APPPaypal();
            $success_url=site_url("ticket/paypal-payment-process/S/{$ticket_id}/{$reply_id}/{$payment_id}");
            $cancel_url=site_url("ticket/paypal-payment-process/C/{$ticket_id}/{$reply_id}/{$payment_id}");
            $process_status=$paypal->process_single_payment($payment_id_str,$payment_obj->payment_des,$payment_obj->amount,$success_url,$cancel_url,0,$payment_obj->payment_currency);
            if(!$process_status){
                $this->DisplayMSGOnly("Payment Process failed, Try again");
                return;
            }else{
                $this->output->unset_template();
            }


        }else{
            $this->DisplayMSGOnly("Invalid payment information");
            return;
        }
        $this->DisplayMSGOnly("Invalid payment information");
        return;
    }
	function paypal_payment_process($type="",$ticket_id="",$reply_id="",$payment_id=""){
	    $this->SetTitle("Ticket Payment Process");
	    if ($type=="S" && !empty($payment_id)) {
	        	//GPrint($_COOKIE);
	        	//die("TesT");
	        $this->load->library("APPPaypal");
	    
	        /*$orddtls=new Morder_details();
	         $orddtls->merchant_id($this->merchant_id);
	         $orddtls->order_id($order_id);
	         $order_items=$orddtls->SelectAll();*/
	        //end
	        $payment_obj=Mticket_payment::FindBy("id", $payment_id,["ticket_id"=>$ticket_id,"reply_id"=>$reply_id]);	
	        if(!$payment_obj){
	            $this->DisplayMSGOnly("Process Failed");
	            return;
	        }	
	        $paypal_obj=new APPPaypal();
	        $apiContext=$paypal_obj->getApiContext();
	        // Get the payment Object by passing paymentId
	        // payment id was previously stored in session in
	        // CreatePaymentUsingPayPal.php
	        $paymentId = $_GET['paymentId'];
	        $payment = Payment::get($paymentId, $apiContext);
	        $currentStatus=$payment->getState();
	        if($currentStatus=="approved"){
	            $mplog=new Mpayment_log();
	            $transaction_id=$payment->getId();
	            $mplog->ticket_payment_id($payment_obj->id);
	            $mplog->transaction_id($transaction_id);
	            if(!$mplog->Select()){
	                $this->finish_order($payment,  $payment_obj);
	            }else{
	                $this->DisplayMSGOnly("The payment is already processed");
	                return;
	            }	            
	            exit(1);
	        }elseif($currentStatus!="created"){	          
	            $this->DisplayMSGOnly("Payment Process Error, Please try again later");
	            return;
	        }
	        // ### Payment Execute
	        // PaymentExecution object includes information necessary
	        // to execute a PayPal account payment.
	        // The payer_id is added to the request query parameters
	        // when the user is redirected from paypal back to your site
	        $execution = new PayPal\Api\PaymentExecution();
	        $execution->setPayerId($_GET['PayerID']);
	    
	        	
	        	
	        	
	        // ### Additional payment details
	        // Use this optional field to set additional
	        // payment information such as tax, shipping
	        // charges etc.
	        $details = new Details();
	        $details->setShipping(0)
	        ->setSubtotal($payment_obj->amount);
	        	
	        // ### Amount
	        // Lets you specify a payment amount.
	        // You can also specify additional details
	        // such as shipping, tax.
	        $amount_obj = new Amount();
	        $amount_obj->setCurrency(strtoupper($payment_obj->payment_currency))
	        ->setTotal($payment_obj->amount)
	        ->setDetails($details);
	      
	        //fromhrer
	        	
	        	
	        	
	        // ### Optional Changes to Amount
	        // If you wish to update the amount that you wish to charge the customer,
	        // based on the shipping address or any other reason, you could
	        // do that by passing the transaction object with just `amount` field in it.
	        // Here is the example on how we changed the shipping to $1 more than before.
	        $transaction = new Transaction();
	        $transaction->setAmount($amount_obj);
	        // Add the above transaction object inside our Execution object.
	        $execution->addTransaction($transaction);
	    
	        try {
	            // Execute the payment
	            // (See bootstrap.php for more on `ApiContext`)
	            $paymentObj = $payment->execute($execution, $apiContext);
	            $this->finish_order($paymentObj, $payment_obj);
	            //ResultPrinter::printResult("Executed Payment", "Payment", $payment->getId(), $execution, $result);
	    
	    
	        }catch (PayPal\Exception\PayPalConnectionException $ex) {
	            	
	            $data=$ex->getData();
	            $data=json_decode($data);
	            if($data->name=="PAYMENT_ALREADY_DONE"){
	                $mplog=new Mpayment_log();
	                $transaction_id=$payment->getId();	               
	                $mplog->ticket_payment_id($payment_obj->id);
	                $mplog->transaction_id($transaction_id);
	                if(!$mplog->Select()){
	                    $this->finish_order($payment,  $payment_obj);
	                }else{
	                     $this->DisplayMSGOnly("The payment is already processed");
	                     return;	                   
	                }
	            }else{	               
	                Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_id}-{$reply_id}-{$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,$ex->getData());
	            }
	        } catch (Exception $ex) {	           
	            Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_id}-{$reply_id}-{$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,$ex->getData());
	        }
	        	
	    } elseif($type=="C") {
	        //cancel user
	       $this->DisplayMSGOnly("You have canceled the payment process",site_url("ticket/details/{$ticket_id}"));
	        return;
	    }else{
	        // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
	        Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_id}-{$reply_id}-{$payment_id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,"Unknown type({$type}) error");
	    }
	
	}
	/**
	 * @param Payment $paymentObj	
	 * @param Mticket_payment $ticket_payment_obj
	 */
	private function finish_order($paymentObj,$ticket_payment_obj){
	    try {
	        	
	        $transactions = $paymentObj->getTransactions();
	        $relatedResources = $transactions[0]->getRelatedResources();
	        $sale = $relatedResources[0]->getSale();
	        $saleId = $sale->getId();
	        	
	      
	        //$paymentObj = Payment::get($paymentId, $apiContext);
	        $payer=$paymentObj->getPayer();
	        $payerinfo=$payer->getPayerInfo();
	        //$payerinfo->email
	        $first2=substr($payerinfo->email, 0,2);
	        $last4=substr($payerinfo->email, -4);	
	        $mpayment=new Mpayment_log();	       
	        $paidtransc=$paymentObj->getTransactions();
	        $total_amount=!empty($paidtransc[0]->amount->total)?$paidtransc[0]->amount->total:$ticket_payment_obj->amount;
	        $mpayment->amount_cr($total_amount);
	        $mpayment->amount_dr(0);
	        $mpayment->transaction_id($paymentObj->getId());
	        $mpayment->ticket_payment_id($ticket_payment_obj->id);
	        $paymentid=Mpayment_log::get_new_payment_id();
	        $mpayment->payment_id($paymentid);
	        $mpayment->first_2_digit($first2);
	        $mpayment->last_4_digit($last4);
	        $mpayment->paid_by("PP");
	        $mpayment->pp_payer_email($payerinfo->email);
	        $mpayment->transation_type("A");
	        $trantime=$paymentObj->getCreateTime();
	        $mpayment->transaction_time($trantime);
	        $mpayment->process_time(date('Y-m-d H:i:s'));
	        $mpayment->update_time(date('Y-m-d H:i:s'));
	        $mpayment->note(" Ticket Payment");
	        $mpayment->status("A");
	        $mpayment->result(0);
	        $mpayment->result_msg($paymentObj->getState());
	        $mpayment->response_reason(0);
	        $mpayment->country($payerinfo->country_code);
	        $mpayment->name_on_card($payerinfo->first_name.$payerinfo->last_name);
	        $mpayment->approval_code($saleId);
	        if($mpayment->Save()){
	           Mticket::setPaidTicket($ticket_payment_obj->ticket_id);
	           $mticket=Mticket::FindBy("id", $ticket_payment_obj->ticket_id);
	           $user=Msite_user::FindBy("id", $mticket->ticket_user);
	           Mticket::UpdateStatus($ticket_payment_obj->ticket_id, "P", $user->id, $user->user_type);	
	           Mticket_log::AddTicketLog($ticket_payment_obj->ticket_id,  $user->id,  $user->user_type, "Paid ({$ticket_payment_obj->payment_currency}{$total_amount})", "P");
	           $upayment=new Mticket_payment();
	           $upayment->status("A");
	           $upayment->process_date(date('Y-m-d H:i:S'));
	           $upayment->payment_method("P");
	           $upayment->payment_id($mpayment->payment_id);
	           $upayment->SetWhereCondition("id", $ticket_payment_obj->id);
	           $upayment->SetWhereCondition("ticket_id", $ticket_payment_obj->ticket_id);
	           $upayment->SetWhereCondition("reply_id", $ticket_payment_obj->reply_id);
	           if($upayment->Update()){
	               $this->DisplayMSGOnly("Payment success",site_url("ticket/details/{$ticket_payment_obj->ticket_id}"),10,true);
	               return;	               
	           }
	
	        }else{
	            Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_payment_obj->ticket_id}-{$ticket_payment_obj->reply_id}-{$ticket_payment_obj->id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,current_url());
	            $this->DisplayMSGOnly("Payment failed. Please try again later");
	            return;
	        }	        
	    }catch (Exception $ex) {
	        Mdebug_log::AddPaypalLog("Paypal Payment Error for id({$ticket_payment_obj->ticket_id}-{$ticket_payment_obj->reply_id}-{$ticket_payment_obj->id})", Mdebug_log::STATUS_FAILED, Mdebug_log::ENTRY_TYPE_ERROR,$ex->getData());
	    }
	}
	function feedback(){
	    $key=GetValue("k");
	    $this->SetTitle("Ticket Feedback");
	    $this->load->library("APPEncryptionLib");
	    $appencp=new APPEncryptionLib();
	    $feedbackData=$appencp->decryptObj($key);
	   
	    if(!empty($feedbackData->ticket_id)){
	      $isFeedbackMsg=$this->session->GetSession("feedback".$feedbackData->ticket_id);
	       $mainobj=new Mticket_feedback();
	       $mainobj->ticket_id($feedbackData->ticket_id);
	       if(!$mainobj->Select()){
	           $m=new Mticket_feedback();
	           $m->ticket_id($feedbackData->ticket_id);
	           $m->f_type($feedbackData->feedback_type);
	           $m->f_msg("");
	           if($m->Save()){;
	               $isFeedbackMsg=true;
	               $this->session->SetSession("feedback".$feedbackData->ticket_id,true);
	               $mainobj=$m;
	           }
	       }else{
	           if(!$isFeedbackMsg){
	               $this->DisplayMSGOnly("We already received a feedback from you. Thank you");
	               return;
	           }
	       }
	       if(IsPostBack){
	           $msg=PostValue("f_msg");
	           if(!empty($msg)){
	              $u=new Mticket_feedback();
	              $u->f_msg($msg);
	              $u->SetWhereCondition("ticket_id", $feedbackData->ticket_id);
	              if($u->Update()){
	                  $this->session->UnsetSession("feedback".$feedbackData->ticket_id);
	                  redirect("ticket/feedback-received");
	              }
	           }
	       }
	       $msg=$feedbackData->feedback_type=="P"?Mapp_setting::GetSettingsValue("fb_p_msg"):Mapp_setting::GetSettingsValue("fb_n_msg");
	       $this->AddViewData("fb_msg", $msg);
	       $this->AddViewData("mainobj", $mainobj);
	       $this->SetTitle("");
	       $this->Display();
	       return;
	    }else{
	        $this->DisplayMSGOnly("Invalid or expired link");
	        return;
	    }	   
	    
	}
	function feedback_received(){
	    $this->SetTitle("");
	    $this->Display();
	}
	
}