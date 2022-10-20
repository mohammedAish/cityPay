<?php
class Mfull_member extends APP_Model{
	public $tem_id;
	public $step;
	/**
	 * @var Muser_membership;
	 */
	public $userMember;
	public $username;
	/**
	 * @var Muser_membership_profile
	 */
	public $userMemberProfile;
	public $account_opend_by="A";
	/**
	 * @var Mmembership
	 */
	private $membershipObj;
	public $agent_id;
	public $staff_id;
	public $is_same_address;
	function __construct(){
		parent::__construct();
		$this->setMemberData();
	}
	function setAgentData($agent_id,$staff_id=""){
		$this->agent_id=$agent_id;
		$this->staff_id=$staff_id;
		$this->account_opend_by="A";
		return true;
	}
	/**
	 * @param string $temp_id
	 * @return Mfull_member
	 */
	static function &getInstance($temp_id="",$from="A"){
		if(empty($temp_id)){
			$newobj=new self();
			if($from=="A"){
				$agentData=GetAgentData();
				$newobj->setAgentData($agentData->id);
			
			}elseif($from=="S"){
				$staffData=GetStaffData();
				$newobj->setAgentData($staffData->agent_id,$staffData->id);
			}
			return $newobj;
		}else{
			$temobj=Mmember_open_attempts::FindBy("id", $temp_id);
			if($temobj){
				
				$data=base64_decode($temobj->data);
				$data=unserialize($data);
				if($data instanceof Mfull_member){
					return $data;
				}else{
					AddError("Step data load failed");
				}
				
			}else{
				AddError("Step data load failed");
			}
			$newobj=new self();
			if($from=="A"){
				$agentData=GetAgentData();
				$newobj->setAgentData($agentData->id);				
				
			}elseif($from=="S"){
				$staffData=GetStaffData();
				$newobj->setAgentData($staffData->agent_id,$staffData->id);		
			}
			return $newobj;
		}
		
	}
	function IsSetDataForSaveUpdate($isShowMsg = false) {
		return $this->userMember->IsSetDataForSaveUpdate() || $this->userMemberProfile->IsSetDataForSaveUpdate();		
	}
	function SaveUpdateTemattempts($step=1){
		$md=new Mmember_open_attempts();
		$isUpdate=false;
		if(!empty($this->tem_id)){
			//update
			$isUpdate=true;
		}else{			
			$this->tem_id=$md->GetNewIncId("id", "AAAAAA");
		}
		$md=new Mmember_open_attempts();
		$this->step=$step;
		$data=serialize($this);
		$data=base64_encode($data);
		$md->data($data);
		$md->step($step);
		$md->entry_date(date('Y-m-d H:i:s'));
		if(!empty($this->agent_id)){
			$md->agent_id($this->agent_id);
		}
		if(!empty($this->staff_id)){
			$md->staff_id($this->staff_id);
		}
		if($isUpdate){
			$md->SetWhereCondition("id", $this->tem_id);
			return $md->Update();
		}else{
			$md->id($this->tem_id);
			return $md->Save();
		}
		return false;
	}
	function setMemberData($member_id="",$account_opend_by="A"){
		if(!empty($member_id)){
			$this->userMember=Muser_membership::FindBy("id", $member_id);
			if(empty($this->userMember)){
				return false;
			}
			$this->userMemberProfile=Muser_membership_profile::FindBy("id", $member_id);
		}else {
			$this->userMember=new Muser_membership();
			$this->userMemberProfile=new Muser_membership_profile();
		}
		$this->account_opend_by=$account_opend_by;
		return true;
	}
	/**
	 * @return NULL|Mmembership
	 */
	function getMembershipObj(){
		if(empty($this->membershipObj)){
			$m=new Mmembership();
			if(!empty($this->userMember->membership_type)){
				$m->id($this->userMember->membership_type);
				if($m->Select()){
					$this->membershipObj=$m;
				}else{
					return NULL;
				}
			}else{
				return NULL;
			}			
		}
		return $this->membershipObj;
	}
	function getNewUserId(){
		$obj=new Muser_membership();
		return $obj->GetNewIncId("id", "AAAA");
	}
	function getNewMemberCode($membership_id){
		$m=$this->getMembershipObj();
		if($m){		
			$obj=new Muser_membership();
			return $obj->GetNewMembershipCode($membership_id,$m->member_code_prefix );
		}
		return NULL;
	}
	function setUserIdandMemberCode(){
		if(!empty($this->userMember->membership_type)){
			$membercode=$this->getNewMemberCode($this->userMember->membership_type);
			$this->userMember->member_code($membercode);
			$this->userMemberProfile->member_code($membercode);
			$this->userMember->id($this->getNewUserId());
			$this->userMemberProfile->id($this->userMember->id);
			return true;
		}
		return false;
	}
	function checkAgentBalance(){
		$m=$this->getMembershipObj();
		if($m){
			//$this->userMember
			$amount=0;
			if($this->userMember->is_installment=="Y"){
				$amount=$m->booking_money;
			}else{
				$amount=$m->price-$m->full_payment_discount;
			}
			$agent=Magent::FindBy("id", $this->agent_id);
			//$agent=new Magent();
			$finalamount=0;
			if($agent && $amount>0 && $agent->opening_fee_per>0){
				$finalamount=$amount*($agent->opening_fee_per/100);
				$nextDue=$amount-$finalamount;
				$agentCurrentBalance=$agent->deposit_amount-$agent->used_amount;
				$agentDueBalance=$agent->due_amount-$agent->due_paid;
				if($agentCurrentBalance>$finalamount){
					if($agent->due_limit >=$agentDueBalance+$nextDue){
						return true;
					}else{
						AddError("Agent due limit is over, please pay due payment");
						return true;
					}
				}else{
					AddError("insufficient agent balance. Please deposit agent balance");
					return false;
				}
			}
			
			
		}
		AddError("invalid membership data");
		return false;
	}
	static function isUsernameExists($username){
		$muser=new Msite_user();
		if($muser->IsExists("username", $username)){
			return true;
		}
		return false;
	}
	static function isMobileExists($mobile_number){
		$muser=new Msite_user();
		if($muser->IsExists("mobile", $mobile_number)){
			return true;
		}
		return false;
	}
	static function isEmailExists($emailAddress){
		$muser=new Msite_user();
		if($muser->IsExists("email", $emailAddress)){
			return true;
		}
		return false;
	}
	function IsValidForm($isNew=true,$addError=true,$isSelectOnly=false,$isAlreadyValidMemberData=false){
		$isOk=true;	
		if($isOk){
			if(!$this->setUserIdandMemberCode()){
				$isOk=false;
			}
		}	
		if(!$isAlreadyValidMemberData){
			if (! $this->userMember->IsValidForm($isNew)){
				$isOk= false;
			}
			
			if (! $this->userMemberProfile->IsValidForm($isNew)){
				$isOk= false;
			}
		}
		if(self::isUsernameExists($this->username)){
			AddErrorField("username", "Username is already exists");
			$isOk=false;
		}
		if(self::isMobileExists($this->userMember->mobile)){
			AddErrorField("mobile", "Mobile number is already exists");
			$isOk=false;
		}
		if(self::isEmailExists($this->userMember->email)){
			AddErrorField("email", "Email address is already exists");
			$isOk=false;
		}
		if($isNew && $this->account_opend_by=="A"){
			if(!$this->checkAgentBalance()){
				$isOk=false;
			}
		}		
		return $isOk;
	}
	function SetFromPostData($isNew = false,$selectedFields=null) {
		$isOk=true;
		if($isNew){
			$this->userMember->used_amount(0);
			$this->userMember->credit_amount(0);
			$this->userMember->total_share(0);			
			
		}
		if(empty($this->username)){
		$this->username=PostValue("username");
		if(empty($this->username)){
			AddErrorField("username","Username is required");
			$isOk=false;
		}
		}
		if($this->account_opend_by=="A"){
			$this->userMember->coupon_code("");
			$this->userMember->account_open_by("A");		
			$this->userMember->account_open_code($this->agent_id);
			$this->userMember->agent_staff_id($this->staff_id);
			UnsetPostValues('coupon_code,account_open_by,account_open_code,agent_staff_id');
		}
		$this->is_same_address=PostValue("is_same_address");
		if($this->is_same_address=="Y"){			
			$this->userMemberProfile->per_country(PostValue("country"));
			$this->userMemberProfile->per_address1(PostValue("address1"));
			$this->userMemberProfile->per_address2(PostValue("address2"));
			$this->userMemberProfile->per_thana_id(PostValue("thana_id"));
			$this->userMemberProfile->per_district_id(PostValue("district_id"));
			$this->userMemberProfile->per_division_id(PostValue("division_id"));
			$this->userMemberProfile->per_postal_code(PostValue("postal_code"));
			UnsetPostValues('per_country,per_address1,per_address2,per_thana_id,per_district_id,per_division_id,per_postal_code');
		}
		if(!$this->userMember->SetFromPostData($isNew)){
			$isOk=false;
		}
		if(!$this->userMemberProfile->SetFromPostData($isNew)){
			$isOk=false;
		}
		if(!$this->IsValidForm($isNew,true,false,true)){
			$isOk=false;
		}
		return $isOk;
	}
	function setMembershipInfo(){
		$m=$this->getMembershipObj();
		if($m){
			$this->userMember->membership_price($m->price);			
			$totalInstalment=ceil(($m->price-$m->booking_money)/$m->per_ins_amount);
			$this->userMember->total_installment($totalInstalment);
			$this->userMember->total_share($m->share);
			
			$this->userMember->last_payment_date(date('Y-m-d H:i:s'));
			$nextdate=app_add_month(1);
			$this->userMember->next_payment_date(date('Y-m-d H:i:s',$nextdate));
			$amount=0;
			if($this->userMember->is_installment=="Y"){
				$amount=$m->booking_money;
				$this->userMember->installment_amount($m->per_ins_amount);
			}else{
				$amount=$m->price-$m->full_payment_discount;
			}
			$this->userMember->credit_amount($amount);
			$this->userMember->used_amount($amount);
			return true;
		}
		AddError("invalid membership data");
		return false;
	}
	function Save(){
		$isOk=true;
		$this->userMember->used_amount(0);
		$this->userMember->credit_amount(0);
		$this->userMember->total_share(0);
		if($this->account_opend_by=="A"){
			$this->userMember->coupon_code("");
			$this->userMember->account_open_by("A");
			$this->userMember->account_open_code($this->agent_id);
			$this->userMember->agent_staff_id($this->staff_id);
			if(!empty($this->staff_id)){
				$staff=Magent_staff::FindBy("id", $this->staff_id,array("agent_id"=>$this->agent_id));
				if($staff){
					$this->userMember->referral_full_path($staff->parent_path);
				}
			}
		}
		if(!$this->IsValidForm(true)){
			$isOk=false;
		}		
		if($isOk){
			$this->setMembershipInfo();
			if(!$this->userMember->save()){
				$isOk=false;
			}
			if($isOk){
				if(!$this->userMemberProfile->save()){
					$isOk=false;
					//roll back user member
					Muser_membership::DeleteByUserId($this->userMember->id);
				}
			}
			if($isOk){
				//need to do some extra work
				if($this->account_opend_by=="A"){					
					//ledger entry
					$membership=$this->getMembershipObj();
					$ml=new Mmember_ledger();
					$ml->pre_balance(0);
					$ml->user_id($this->agent_id);
					$ml->member_id($this->userMember->id);
					$ml->amount($this->userMember->credit_amount);
					$ml->narration("Transfer balance from agent");					
					$ml->ledger_type("C");
					$ml->entry_type("D");
					$ml->entry_ref_type("G");
					if($ml->Save()){
						
					}
					
					$ml=new Mmember_ledger();
					$ml->user_id("SYSM");
					$ml->pre_balance($this->userMember->credit_amount);
					$ml->member_id($this->userMember->id);
					$ml->amount($this->userMember->credit_amount);
					if($this->userMember->is_installment=="Y"){
						$ml->narration("Booking money cost");
					}else{
						$ml->narration("Full payment of membership({$membership->title})");
					}
					$ml->ledger_type("D");
					$ml->entry_type("B");
					$ml->entry_ref_type("G");
					if($ml->Save()){
					
					}
					//Agent Part
					$agent=Magent::FindBy("id", $this->agent_id);
					$agent_ledger=new Magent_ledger();
					$agent_ledger->agent_id($this->agent_id);
					$agent_ledger->member_id($this->userMember->id);					
					$amount=ceil($this->userMember->credit_amount*($agent->opening_fee_per/100));
					if($this->userMember->is_installment=="Y"){
						$agent_ledger->entry_type("B");
						$agent_ledger->narration("Member booking money ({$agent->opening_fee_per}%) of {$this->userMember->credit_amount}TK");	
					}else{
						$agent_ledger->entry_type("F");
						$agent_ledger->narration("Member opening full payment({$agent->opening_fee_per}%) of {$this->userMember->credit_amount}TK ");	
					}
									
						
					$agent_ledger->pre_balance($agent->deposit_amount-$agent->used_amount);
					$agent_ledger->amount($amount);
					$agent_ledger->ledger_type("D");					
					$agent_ledger->entry_ref_type("M");					
					if($agent_ledger->Save()){
						AddLog("A", $agent_ledger->settedPropertyforLog(), "l001","Ledger",$this->userMember->id,$this->agent_id);
						$updateAgent=new Magent();
						$updateAgent->used_amount("used_amount +{$amount}",true);
						$updateAgent->SetWhereCondition("id", $agent->id);
						if($updateAgent->Update()){
							
						}
					}
					if($agent->opening_fee_per<100){
						$agent_due_ledger=new Magent_due_ledger();
						$agent_due_ledger->agent_id($agent->id);
						$agent_due_ledger->member_id($this->userMember->id);
						$dueamount=$this->userMember->credit_amount-$amount;
						if($this->userMember->is_installment=="Y"){
							$agent_due_ledger->entry_type("B");
							$agent_due_ledger->narration("Member booking money ({$agent->opening_fee_per}%) TK {$dueamount} due added");
						}else{							
							$agent_due_ledger->entry_type("F");
							$agent_due_ledger->narration("Member opening due(".(100-$agent->opening_fee_per)."%) TK {$dueamount} due added");
							
						}
						$agent_due_ledger->amount($dueamount);
						$agent_due_ledger->pre_balance($agent->due_amount-$agent->due_paid);
						
						$agent_due_ledger->ledger_type("C");						
						$agent_due_ledger->entry_ref_type("M");
							
						if($agent_due_ledger->Save()){
							AddLog("A", $agent_due_ledger->settedPropertyforLog(), "l001","Due Ledger",$this->userMember->id,$this->agent_id);
							$updateAgent=new Magent();
							$updateAgent->due_amount("due_amount +{$agent_due_ledger->amount}",true);
							$updateAgent->SetWhereCondition("id", $agent->id);
							if($updateAgent->Update()){
								
							}
						}else{
							AddError("Failed");
						}
					}
					//Agent Commission Calculation 
					$agent_pre_balance=$agent->agent_com_amount-$agent->agent_com_used;
					//com calculaton entry
					if($this->userMember->is_installment=="Y"){
						// With Conditional amount
						$coditions=Magent_mature_condition::FindAllBy("agent_id", $this->agent_id);
						foreach ($coditions as $comcond){
							//$comcond=new Magent_mature_condition();
							
							//full payment
							$com_pending=new Magent_pending_com();
							$com_pending->agent_id($this->agent_id);
							$com_pending->member_id($this->userMember->id);
							if($comcond->m_type=="I"){
								$com_pending->required_installment(0);
								$com_pending->status("M");
							}else{
								$com_pending->status("P");
								$com_pending->required_installment($comcond->installment_count);
							}
							$com_pending->com_based_on("O");
							$com_pending->com_type($comcond->m_type);
							$com_pending->cal_type($agent->agent_com_type);
							$com_pending->per_ac_com($agent->agent_com_per);
							if($agent->agent_com_type=="P"){
								$comamount=$membership->price*($agent->agent_com_per/100);
							}else{
								$comamount=$agent->agent_com_per;
							}
							$com_pending->com_amount($comamount*($comcond->com_per/100));
							$com_pending->total_com_amount($comamount);
							$com_pending->matured_per($comcond->com_per);
							$com_pending->total_calculated_account(1);
							$com_pending->total_calculated_amount($membership->price);
							
							if($com_pending->Save()){
								AddInfo("Com amount save");
								//need to add com ledger
								if($comcond->m_type=="I"){
									if(Magent_com_ledger::SaveFromPendingComObject($com_pending,$agent_pre_balance,$membership->share)){
										//AddInfo("Com ledger added");
									}
								}
							}
							
						}
					}else{
						//full payment
						$com_pending=new Magent_pending_com();
						$com_pending->agent_id($this->agent_id);
						$com_pending->member_id($this->userMember->id);		
						$com_pending->required_installment(0);
						$com_pending->com_based_on("O");
						$com_pending->com_type("I");
						$com_pending->cal_type($agent->agent_com_type);
						$com_pending->per_ac_com($agent->agent_com_per);
						$com_pending->matured_per(100);
						if($agent->agent_com_type=="P"){
							$comamount=$this->userMember->credit_amount*($agent->agent_com_per/100);
						}else{
							$comamount=$agent->agent_com_per;
						}
						$com_pending->com_amount($comamount);
						$com_pending->total_com_amount($comamount);
						$com_pending->total_calculated_account(1);
						$com_pending->total_calculated_amount($this->userMember->credit_amount);
						$com_pending->status("M");
						if($com_pending->Save()){							
							if(Magent_com_ledger::SaveFromPendingComObject($com_pending,$agent_pre_balance,$membership->share)){
								
							}						
						}
					}
					//END Agent Commission Calculation 
					
					
					//Agent Staff Commission Calculation
					//will be add later
					if(!empty($this->staff_id)){
						//recursion process required. will be later
						if($this->userMember->is_installment=="Y"){
							Magent_staff::ProcessCommission($this->agent_id,$this->staff_id, $this->userMember->id, $membership->price,false,0,$membership->share);							
						}else{
							Magent_staff::ProcessCommission($this->agent_id,$this->staff_id, $this->userMember->id, $this->userMember->credit_amount,true,0,$membership->share);
						}
						
					}
					
				}
				
				//site_user entry							
				$su=new Msite_user();
				$su->name($this->userMember->name);
				$su->username($this->username);
				$su->mobile($this->userMember->mobile);
				$su->email($this->userMember->email);
				$su->com_amount(0);				
				$su->status("I");
				$su->is_agent("Y");
				$su->is_agent_com_eligible('N');
				$su->agent_total_member(0);
				if($su->Save()){
					$um=new Muser_membership();
					$um->user_id($su->id);
					$um->SetWhereCondition("id", $this->userMember->id);
					if($um->Update()){
						
					}
					
					$this->load->helper("string");
					$pass=random_string('alnum',8);
					$passmd5=md5($su->id.$pass);
					$mo=new Msite_user();
					$mo->user_pass($passmd5);
					$mo->SetWhereCondition("id", $su->id);
					if($mo->Update()){
						
					}
					
					
				}
				AddLog ( "A", "New Member", "l008", "Member Created", $this->userMember->id);
				//send email
				//Set Password	
				$this->SendWelcomeEmail($su,$this->userMember->id,$pass);
				return true;
			}else{
				AddError("something went wrong. please try again",true);
			}
		}else{
			return false;
		}
		
	}
	//auto generated
	/**
	 * @param Msite_user $siteobject
	 * @param unknown $staff_id
	 * @param string $isSendEmail
	 * @param string $agentStaffObject
	 * @return boolean
	 */
	function SendWelcomeEmail($siteobject,$member_id='',$password=''){			
			//send email
			//Memail_templates::SendEmailTemplates($keyword, $toEmail, $subject)				
		$emailParam = array (
				"name" => $siteobject->name,
				"username" => $siteobject->username,
				"password" => $password,						
				"login_link"=>site_url("user/login"),
				"membership_info"=>self::getMembershipInfo($this->userMember, $this->userMemberProfile,$siteobject)
		);
		if(Memail_templates::SendEmailTemplates("MWC", $siteobject->email,null,$emailParam)){
			//AddInfo("Email sent");
			AddLog ( "A", "$siteobject->email", "l008", "Welcome email", $this->userMember->id);
			return true;
		}	
		return false;
	}	
	/**
	 * @param Muser_membership $userMember
	 * @param Muser_membership_profile $userMemberProfile
	 * @param Msite_user $appsite_user
	 * @return string
	 */
	static function getMembershipInfo($userMember,$userMemberProfile,$appsite_user=NULL){
		if(!$appsite_user){
			$appsite_user=Msite_user::FindBy("id", $userMember->user_id);
		}
		ob_start();
		?>
		<br/>
		<table class="table">
	            		<tr>
	            			<th style="max-width:100px;">Name</th>
	            			<td width="10px;">:</td>
	            			<td><?php echo $userMember->name;?></td>
	            		</tr>
	            		<tr>
	            			<th>Login Username</th>
	            			<td>:</td>
	            			<td><?php echo $appsite_user->username;?></td>
	            		</tr>
	            		<tr>
	            			<th>Father's Name</th>
	            			<td>:</td>
	            			<td><?php echo $userMemberProfile->father_name;?></td>
	            		</tr>
	            		<tr>
	            			<th>Mother's Name</th>
	            			<td>:</td>
	            			<td><?php echo $userMemberProfile->mother_name;?></td>
	            		</tr>
	            		<tr>
	            			<th>Mobile Number</th>
	            			<td>:</td>
	            			<td><?php echo $userMember->mobile;?></td>
	            		</tr>
	            		<tr>
	            			<th>Email Address</th>
	            			<td>:</td>
	            			<td><?php echo $userMember->email;?></td>
	            		</tr>
	            		<tr>
	            			<th>Membership Name</th>
	            			<td>:</td>
	            			<td>
	            			<?php 
	            				$mm=new Mmembership();
	            				$mm->id($userMember->membership_type);
	            				$mm->Select('title');
	            				echo $mm->title;
	            			?>
	            			
	            			</td>
	            		</tr>
	            		<tr>
	            			<th>Price</th>
	            			<td>:</td>
	            			<td><?php echo $userMember->membership_price;?></td>
	            		</tr>
	            		<?php if($userMember->is_installment=="Y"){?>
	            		<tr>
	            			<th>Installment Amount</th>
	            			<td>:</td>
	            			<td><?php echo $userMember->installment_amount;?></td>
	            		</tr>
	            		<tr>
	            			<th>Total Installment</th>
	            			<td>:</td>
	            			<td><?php echo $userMember->total_installment;?></td>
	            		</tr>
	            		<tr>
	            			<th>Next Installment Date</th>
	            			<td>:</td>	            			
	            			<td class="text-danger "><strong> <?php echo get_current_user_timezonetime($userMember->next_payment_date,'d M,Y');?></strong></td>
	            		</tr>
	            		<?php }else{?>
	            		<tr>
	            			<th>Discount</th>
	            			<td>:</td>
	            			<td><?php echo $userMember->discount;?></td>
	            		</tr>
	            		<?php }?>
	            	</table>
	            	<br/>
		<?php 
		return ob_get_clean();
	}
	function GetAddForm($label_col=4,$input_col=8,$except=array(),$disabled=array()){
			//$account_opend_by=S=Self, A=Agent,R=Referrer, C=Coupon Code
			if(is_string($disabled)){
				$disabled=explode(",", $disabled);
			}		
			$disabled=array_merge($disabled,array("total_share","discount","total_installment","installment_amount","installment_amount","membership_price"));
			
			$mobileVerificationUrl="";
			$emailVerificationUrl="";
			$usernameVerificaitonUrl="";
			if($this->account_opend_by=="A"){
				if(!empty($this->staff_id)){
					$mobileVerificationUrl=staff_url('member/is-available-mobile');
					$emailVerificationUrl=staff_url('member/is-available-email');
					$usernameVerificaitonUrl=staff_url('member/is-available-username');
				}else{
					$mobileVerificationUrl=agent_url('member/is-available-mobile');
					$emailVerificationUrl=agent_url('member/is-available-email');
					$usernameVerificaitonUrl=agent_url('member/is-available-username');
					
				}
			}
			
		?>
		<style>
			
		</style>
		<div class="app-global-panel form-horizontal">
			<div class="row ">
			<div class="col-md-6"> <!-- left side -->
				<div class="row"><!-- left side Row -->
					<div class="col-md-12 md-p-r-0">
					<div class="panel panel-default">
					  <div class="panel-heading"><?php _e("Basic Info"); ?></div>
					  <div class="panel-body">
						<?php if(!in_array("name",$except)){ ?>
						 <div class="form-group">
					      	<label class="control-label col-md-<?php echo $label_col;?>" for="name"><?php _e("Name"); ?></label>
					      	<div class="col-md-<?php echo $input_col;?>">                   			     	
					      		<input type="text" maxlength="100"   value="<?php echo  $this->userMember->GetPostValue("name");?>" class="form-control" id="name" <?php echo in_array("name", $disabled)?' disabled="disabled" ':' name="name" ';?>     placeholder="<?php _e("Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Name"));?>">
					      	</div>
					      </div> 
					     <?php } ?>
						<?php if(!in_array("father_name",$except)){ ?>
							 <div class="form-group">
						      	<label class="control-label col-md-<?php echo $label_col;?>" for="father_name"><?php _e("Father Name"); ?></label>
						      	<div class="col-md-<?php echo $input_col;?>">                   			     	
						      		<input type="text" maxlength="100"   value="<?php echo  $this->userMemberProfile->GetPostValue("father_name");?>" class="form-control" id="father_name" <?php echo in_array("father_name", $disabled)?' disabled="disabled" ':' name="father_name" ';?>     placeholder="<?php _e("Father Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Father Name"));?>">
						      	</div>
						      </div> 
						     <?php } ?>
							
							<?php if(!in_array("mother_name",$except)){ ?>
							 <div class="form-group">
						      	<label class="control-label col-md-<?php echo $label_col;?>" for="mother_name"><?php _e("Mother Name"); ?></label>
						      	<div class="col-md-<?php echo $input_col;?>">                   			     	
						      		<input type="text" maxlength="100"   value="<?php echo  $this->userMemberProfile->GetPostValue("mother_name");?>" class="form-control" id="mother_name" <?php echo in_array("mother_name", $disabled)?' disabled="disabled" ':' name="mother_name" ';?>     placeholder="<?php _e("Mother Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Mother Name"));?>">
						      	</div>
						      </div> 
						     <?php } ?>
						     	 <?php if(!in_array("username",$except)){ ?>
						 <div class="form-group">
					      	<label class="control-label col-md-<?php echo $label_col;?>" for="username"><?php _e("Username"); ?></label>
					      	<div class="col-md-<?php echo $input_col;?>">                   			     	
					      		<input type="text" maxlength="50" autocomplete="off"  data-bv-regexp="true" data-bv-trigger="blur"  pattern="^[A-Za-z0-9_]+$"  data-bv-remote="true"  data-bv-regexp-message="Invalid Username,Please don't enter space or any other special character" data-bv-remote-before-send="before_send" data-bv-remote-url="<?php echo $usernameVerificaitonUrl;?>"  data-bv-remote-message="Username is alreay taken."  value="<?php echo  $this->GetPostValue("username");?>" class="form-control" id="username" <?php echo in_array("username", $disabled)?' disabled="disabled" ':' name="username" ';?>     placeholder="<?php _e("Username"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Username"));?>">
					      	</div>
					      </div> 
					     <?php } ?>
						<?php if(!in_array("mobile",$except)){ ?>
						 <div class="form-group">
					      	<label class="control-label col-md-<?php echo $label_col;?>" for="mobile"><?php _e("Mobile"); ?></label>
					      	<div class="col-md-<?php echo $input_col;?>">                   			     	
					      		<input type="text" maxlength="15" data-bv-phone-country="BD"  data-bv-remote-url="<?php echo $mobileVerificationUrl;?>" data-bv-trigger="blur"  data-bv-remote="true"  data-bv-remote-message="Mobile number is alreay exists"  value="<?php echo  $this->userMember->GetPostValue("mobile");?>" class="form-control phone" id="mobile" <?php echo in_array("mobile", $disabled)?' disabled="disabled" ':' name="mobile" ';?>     placeholder="<?php _e("Mobile"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Mobile"));?>">
					      	</div>
					      </div> 
					     <?php } ?>
					
						<?php if(!in_array("email",$except)){ ?>
						 <div class="form-group">
					      	<label class="control-label col-md-<?php echo $label_col;?>" for="email"><?php _e("Email"); ?></label>
					      	<div class="col-md-<?php echo $input_col;?>">                   			     	
					      		<input type="email" maxlength="50"   data-bv-remote-url="<?php echo $emailVerificationUrl;?>" data-bv-trigger="blur"  data-bv-remote="true"  data-bv-remote-message="Email address is alreay exists"  value="<?php echo  $this->userMember->GetPostValue("email");?>" class="form-control" id="email" <?php echo in_array("email", $disabled)?' disabled="disabled" ':' name="email" ';?>     placeholder="<?php _e("Email"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Email"));?>">
					      	</div>
					      </div> 
					     <?php } ?>
						
						
							<?php if(!in_array("gender",$except)){ ?>
						 <div class="form-group">
					      	<label class="control-label col-md-<?php echo $label_col;?>" for="gender"><?php _e("Gender"); ?></label>
					      	<div class="col-md-<?php echo $input_col;?>">                   			     	
					      		<div class="inline radio-inline">
						        <?php 
						            $gender_selected= $this->userMemberProfile->GetPostValue("gender","M");
						            $gender_isDisabled=in_array("gender", $disabled);
						            GetHTMLRadioByArray("Gender","gender","gender",true,$this->userMemberProfile->GetPropertyOptions("gender"),$gender_selected,$gender_isDisabled);
						            ?>
						        
						       </div> 
					      	</div>
					      </div> 
					     <?php } ?>
						
						<?php if(!in_array("marital_status",$except)){ ?>
						 <div class="form-group">
					      	<label class="control-label col-md-<?php echo $label_col;?>" for="marital_status"><?php _e("Marital Status"); ?></label>
					      	<div class="col-md-<?php echo $input_col;?>">                   			     	
					      		<div class="inline radio-inline">
						        <?php 
						            $marital_status_selected= $this->userMemberProfile->GetPostValue("marital_status","");
						            $marital_status_isDisabled=in_array("marital_status", $disabled);
						            GetHTMLRadioByArray("Marital Status","marital_status","marital_status",true,$this->userMemberProfile->GetPropertyOptions("marital_status"),$marital_status_selected,$marital_status_isDisabled);
						            ?>
						        
						       </div> 
					      	</div>
					      </div> 
					     <?php } ?>
							<?php if(!in_array("spouse_name",$except)){ ?>
							 <div class="form-group">
						      	<label class="control-label col-md-<?php echo $label_col;?>" for="spouse_name"><?php _e("Spouse Name"); ?></label>
						      	<div class="col-md-<?php echo $input_col;?>">                   			     	
						      		<input type="text" maxlength="100"   value="<?php echo  $this->userMemberProfile->GetPostValue("spouse_name");?>" class="form-control" id="spouse_name" <?php echo in_array("spouse_name", $disabled)?' disabled="disabled" ':' name="spouse_name" ';?>     placeholder="<?php _e("Spouse Name"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Spouse Name"));?>">
						      	</div>
						      </div> 
						     <?php } ?>
						
						<?php if(!in_array("dob",$except)){ ?>
							 <div class="form-group">
						      	<label class="control-label col-md-<?php echo $label_col;?>" for="dob"><?php _e("Date of Birth"); ?> <small>(<?php echo _e("dd-mm-yyy");?>)</small></label>
						      	<div class="col-md-<?php echo $input_col;?>">                   			     	
						      		<input type="text" maxlength="10"   value="<?php echo  $this->userMemberProfile->GetPostValue("dob");?>" class="form-control app-date-picker" id="dob" <?php echo in_array("dob", $disabled)?' disabled="disabled" ':' name="dob" ';?>     placeholder="<?php echo _e("dd-mm-yyy");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Dob"));?>">
						      	</div>
						      </div> 
						     <?php } ?>
						     <?php if(!in_array("sec_number_type",$except)){ ?>
							 <div class="form-group">
						      	<label class="control-label col-md-<?php echo $label_col;?>" for="sec_number_type"><?php _e("ID Type"); ?></label>
						      	<div class="col-md-<?php echo $input_col;?>">                   			     	
						      		<select    class="form-control" id="sec_number_type" <?php echo in_array("sec_number_type", $disabled)?' disabled="disabled" ':' name="sec_number_type" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("ID Type"));?>">
							        <?php $sec_number_type_selected= $this->userMemberProfile->GetPostValue("sec_number_type","NS");
							            GetHTMLOptionByArray($this->userMemberProfile->GetPropertyOptions("sec_number_type",true),$sec_number_type_selected);
							            ?>
							        
							        </select>
						      	</div>
						      </div> 
						     <?php } ?>
							
							<?php if(!in_array("sec_number",$except)){ ?>
							 <div class="form-group">
						      	<label class="control-label col-md-<?php echo $label_col;?>" for="sec_number"><?php _e("ID Number"); ?></label>
						      	<div class="col-md-<?php echo $input_col;?>">                   			     	
						      		<input type="text" maxlength="20"   value="<?php echo  $this->userMemberProfile->GetPostValue("sec_number");?>" class="form-control" id="sec_number" <?php echo in_array("sec_number", $disabled)?' disabled="disabled" ':' name="sec_number" ';?>     placeholder="<?php _e("ID Number"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("ID Number"));?>">
						      	</div>
						      </div> 
						     <?php } ?>
							  </div>
							</div>
					</div>
				
				</div><!-- End left side Row -->
			
			</div> <!--End left side -->
			<div class="col-md-6"> <!-- Right side -->
				<div class="row"><!-- Right side Row -->
				<?php $this->getAddressForms(12,$label_col,$input_col,$except,$disabled);?>				
					<div class="col-md-12">
					
					<div class="panel panel-default">
					  <div class="panel-heading"><?php _e("Membership Info"); ?></div>
					  <div class="panel-body">
					<?php if(!in_array("membership_type",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="membership_type"><?php _e("Membership Type"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php 
			      		$mn=new Mmembership();
			      		$mn->total("> (sold-canceled)",true);
			      		$mn->status('A');
			      		$options_membership_type= $mn->SelectAllGridData("id,title,member_code_prefix,share,price,per_ins_amount,booking_money,full_payment_discount,status");?>
				        <select class="form-control" id="membership_type" <?php echo in_array("membership_type", $disabled)?' disabled="disabled" ':' name="membership_type" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Membership Type"));?>">
				        <?php $membership_type_selected= $this->userMember->GetPostValue("membership_type");
				        	GetHTMLOption("",_("select") ,$membership_type_selected);
				            if($options_membership_type){
				            	foreach ($options_membership_type as $key=>$op){
				        			GetHTMLOption($op->id,$op->title ,$membership_type_selected);
				        			unset($options_membership_type[$key]);
				        			$options_membership_type[$op->id]=$op;
				            	}
				            }
				        	?>			        
				        </select>
			      	</div>
			      </div> 
			     <?php } ?>      	
			     <?php if(!in_array("is_installment",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_installment"><?php _e("Payment Type"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<div class="inline radio-inline">
				        <?php 
				            $is_installment_selected= $this->userMember->GetPostValue("is_installment","Y");
				            $is_installment_isDisabled=in_array("is_installment", $disabled);
				            GetHTMLRadioByArray("Is Installment","is_installment","is_installment",true,$this->userMember->GetPropertyOptions("is_installment"),$is_installment_selected,$is_installment_isDisabled);
				            ?>
				        
				       </div> 
			      	</div>
			      </div> 
			     <?php } ?>
				
				
				<?php if(!in_array("membership_price",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="membership_price"><?php _e("Membership Price"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		
			      		<div class="input-group">
			      			<input type="text" maxlength="102"   value="<?php echo  $this->userMember->GetPostValue("membership_price");?>" class="form-control" id="membership_price" <?php echo in_array("membership_price", $disabled)?' disabled="disabled" ':' name="membership_price" ';?>     placeholder="<?php _e("Membership Price"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Membership Price"));?>">
			      		 	<span class="input-group-addon" >TK</span>
			      		</div>
			      	
			      	</div>
			      </div> 
			     <?php } ?>
				
				<?php if(!in_array("discount",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="discount"><?php _e("Discount"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>"> 
			      		<div class="input-group">
			      			<input type="text" maxlength="102"   value="<?php echo  $this->userMember->GetPostValue("discount");?>" class="form-control" id="discount" <?php echo in_array("discount", $disabled)?' disabled="disabled" ':' name="discount" ';?>     placeholder="<?php _e("Discount"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Discount"));?>">
			      		 	<span class="input-group-addon" >TK</span>
			      		</div>
			      	</div>
			      </div> 
			     <?php } ?>
				
				<?php if(!in_array("installment_amount",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="installment_amount"><?php _e("Installment Amount"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		
			      		<div class="input-group">
			      			<input type="text" maxlength="102"   value="<?php echo  $this->userMember->GetPostValue("installment_amount");?>" class="form-control" id="installment_amount" <?php echo in_array("installment_amount", $disabled)?' disabled="disabled" ':' name="installment_amount" ';?>     placeholder="<?php _e("Installment Amount"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Installment Amount"));?>">
			      		 	<span class="input-group-addon" >TK</span>
			      		</div>
			      	</div>
			      </div> 
			     <?php } ?>
				
				<?php if(!in_array("total_installment",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="total_installment"><?php _e("Total Installment"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		
			      		
			      			<input type="text" maxlength="3"   value="<?php echo  $this->userMember->GetPostValue("total_installment");?>" class="form-control" id="total_installment" <?php echo in_array("total_installment", $disabled)?' disabled="disabled" ':' name="total_installment" ';?>     placeholder="<?php _e("Total Installment"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Total Installment"));?>">
			      		 	
			      		
			      	</div>
			      </div> 
			     <?php } ?>
				
				<?php /*if(!in_array("total_share",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="total_share"><?php _e("Total Share"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<input type="text" maxlength="2"   value="<?php echo  $userMembershipObj->GetPostValue("total_share");?>" class="form-control" id="total_share" <?php echo in_array("total_share", $disabled)?' disabled="disabled" ':' name="total_share" ';?>     placeholder="<?php _e("Total Share"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Total Share"));?>">
			      	</div>
			      </div> 
			     <?php } */?>
					  </div>
					</div>
					
				</div>
				</div><!-- End Right side Row -->
			</div> <!-- End Right side -->
			
			
			
			
			
			
			
				
			
			
			</div>
			<div class="row">
			<?php if($this->account_opend_by=="S"){?>
			<div class="col-md-6">
				<div class="panel panel-default">
				  <div class="panel-heading"><?php _e("Payment Info"); ?></div>
				  <div class="panel-body">
				      	
				  </div>
				</div>
			</div>
			<?php }?>
			</div>
			
			
			
			<?php /*if(!in_array("id",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<input type="text" maxlength="4"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			      	</div>
			      </div> 
			     <?php } */?>
								
				
				
				<?php /* if(!in_array("country",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="country"><?php _e("Country"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<input type="text" maxlength="2"   value="<?php echo  $userMemberProfile->GetPostValue("country");?>" class="form-control" id="country" <?php echo in_array("country", $disabled)?' disabled="disabled" ':' name="country" ';?>     placeholder="<?php _e("Country"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
			      	</div>
			      </div> 
			     <?php }*/ ?>
				
				
				
				
				
				<?php 
				if($this->account_opend_by=="S"){
				if(!in_array("coupon_code",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="coupon_code"><?php _e("Coupon Code"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<input type="text" maxlength="10"   value="<?php echo  $this->userMemberProfile->GetPostValue("coupon_code");?>" class="form-control" id="coupon_code" <?php echo in_array("coupon_code", $disabled)?' disabled="disabled" ':' name="coupon_code" ';?>     placeholder="<?php _e("Coupon Code"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Coupon Code"));?>">
			      	</div>
			      </div> 
			     <?php }
				} ?>
			     
			</div>
			<script type="text/javascript">
				
				function SetMemberDetails(){					
					var member_id=$("#membership_type").val();	
					var membershiplist=<?php echo json_encode($options_membership_type);?>;				
					if(member_id !="" && typeof !member_id !="undefined"){						
						if(typeof membershiplist[member_id] !="undefined"){
							
							$("#membership_price").val(membershiplist[member_id].price);
							$("#discount").val(membershiplist[member_id].full_payment_discount);
							$("#installment_amount").val(membershiplist[member_id].per_ins_amount);
							$("#total_installment").val(Math.ceil((membershiplist[member_id].price-membershiplist[member_id].booking_money)/membershiplist[member_id].per_ins_amount));
							var isInstallment=$("input[name=is_installment]:checked").val();
							//gcl(isInstallment);
							if(isInstallment!="Y"){
								//gcl("Yes 1");
								$("#discount").closest(".form-group").show();
								$("#installment_amount").closest(".form-group").hide();
								$("#total_installment").closest(".form-group").hide();
							}else{
								//gcl("Yes 2");
								$("#discount").closest(".form-group").hide();
								$("#installment_amount").closest(".form-group").show();
								$("#total_installment").closest(".form-group").show();
							}
						}						
					}
				}
				function setSpouseName(){
					if($("input[name=marital_status]:checked").val()=="M"){
						$("#spouse_name").closest(".form-group").show();
					}else{
						$("#spouse_name").closest(".form-group").hide();
					}
				}
				function setDobDetails(){
					var age=getTotalAge($("#dob").val());
					if(age<18){
						if($("#dob").parent().find(".below-msg").length>0){
							$("#dob").parent().find(".below-msg").show();
						}else{
							var objmsg=$("<span class='help-block below-msg text-success' style='color:#3c763d !important;'>Below 18 Years</span>");
							$("#dob").parent().append(objmsg);
							objmsg.show();
						}
						$("#sec_number_type option").show();
						$("#sec_number_type option[value=NS],#sec_number_type option[value=PS]").prop("disabled",true).hide();
					}else{
						$("#dob").parent().find(".below-msg").hide();
						$("#sec_number_type option").hide();
						$("#sec_number_type option[value=NS],#sec_number_type option[value=PS]").prop("disabled",false).show();
					}
				}
				$(function(){
					SetMemberDetails();
					setDobDetails();
					$("#membership_type").change(function(e){
						SetMemberDetails();
					});
					$("input[name=is_installment]").change(function(e){
						SetMemberDetails();
					});
					setSpouseName();
					$("input[name=marital_status]").change(function(e){
						setSpouseName();
					});
					$("#dob").on("input",function(e){
						$("#sec_number_type").val("");
						setDobDetails();
					});
					$("#sec_number_type").change(function(){
						$("#sec_number").focus();
					});
				});
			</script>
			<?php 
		}
		
		function getAddressForms($col_length=6,$label_col=4,$input_col=8,$except=array(),$disabled=array()){
			$divisions=Mdivision::FetchAllKeyValue("id", "name");
			$district_list=Mdistrict::FetchAll("", "name");
			$thana_list=Mthana::FetchAll("", "name");
			$districts=array();
			$districtjson=array();
			$thanajson=array();
			$thanas=array();
			foreach ($thana_list as $thana){
				//$districts[$dist->id]=$dist->name;
				$thanajson[$thana->district_id][$thana->id]=$thana->name;
			}
			foreach ($district_list as $dist){
				//$districts[$dist->id]=$dist->name;
				$districtjson[$dist->division_id][$dist->id]=$dist->name;
			}
			
			?>
		<div class="col-md-<?php echo $col_length;?>">
			
			<div class="panel panel-default">
				  <div class="panel-heading"><?php _e("Present Address"); ?></div>
				  <div class="panel-body">
				  	<?php if(!in_array("country",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="country"><?php _e("Country"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>"> 
		      		<select    class="form-control" id="country" <?php echo in_array("country", $disabled)?' disabled="disabled" ':' name="country" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
				        <?php $country_selected= $this->userMemberProfile->GetPostValue("country","");
				            GetHTMLOptionByArray(getCountryKeyValuePair(),$country_selected);
				            ?>
				        
				      </select>
		      	</div>
		      	
		      	
		      </div> 
		     <?php } ?>
				<?php  
				
				$selected_division_id=$this->userMemberProfile->GetPostValue("division_id");
				$selected_district_id=$this->userMemberProfile->GetPostValue("district_id");
				$selected_thana_id=$this->userMemberProfile->GetPostValue("thana_id");
				if(isset($districtjson[$selected_division_id])){
				    $districts=&$districtjson[$selected_division_id];
				}
				if(isset($thanajson[$selected_district_id])){
				    $thanas=&$thanajson[$selected_district_id];
				}?>
				<div id="cbd-form">
				<?php if(!in_array("address1",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="address1"><?php _e("Address"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<textarea style="min-height: 66px;" maxlength="150"  class="form-control <?php echo !in_array("address1", $disabled)?' pad-field ':'';?>" id="address1" <?php echo in_array("address1", $disabled)?' disabled="disabled" ':' name="address1" ';?>     placeholder="<?php _e("Address"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address1"));?>"><?php echo  $this->userMemberProfile->GetPostValue("address1");?></textarea>
			      	</div>
			      </div> 
			     <?php } ?>
				<?php if(!in_array("division_id",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="division_id"><?php _e("Division"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php $options_division_id= Mdivision::FetchAllKeyValue("id", "name",false);?>
				        <select  class="form-control <?php echo !in_array("division_id", $disabled)?' pad-field ':'';?> " id="division_id" <?php echo in_array("division_id", $disabled)?' disabled="disabled" ':' name="division_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Division Name"));?>">
				       <?php GetHTMLOption("","Select");
			      		      GetHTMLOptionByArray($divisions,$selected_division_id);?>		        
				        </select>
			      	</div>
			      </div> 			     
			     <?php } ?>	
			     <?php if(!in_array("district_id",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="district_id"><?php _e("District"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php $options_district_id= Mdistrict::FetchAllKeyValue("id", "name",false);?>
        			        <select   class="form-control  <?php echo !in_array("district_id", $disabled)?' pad-field ':'';?> " id="district_id" <?php echo in_array("district_id", $disabled)?' disabled="disabled" ':' name="district_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("District Name"));?>">
        			       <?php 
        		      		GetHTMLOption("","Select");
        		      		 GetHTMLOptionByArray($districts,$selected_district_id);?>		        
        			        </select>
			      	</div>
			      </div> 
			     <?php } ?>
				<?php if(!in_array("thana_id",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="thana_id"><?php _e("Thana/Upazilla"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php $options_thana_id= Mthana::FetchAllKeyValue("id", "name",false);?>
        			        <select   class="form-control <?php echo !in_array("thana_id", $disabled)?' pad-field ':'';?>" id="thana_id" <?php echo in_array("thana_id", $disabled)?' disabled="disabled" ':' name="thana_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Thana Name"));?>">
        			       <?php GetHTMLOption("","Select");
        		      		      GetHTMLOptionByArray($thanas,$selected_thana_id);?>	        
        			        </select>
			      	</div>
			      </div> 
			     <?php } ?>				   	
				</div>
				<div id="cnbd-form">
				<?php if(!in_array("address1",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="address1"><?php _e("Address Line 1"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<input  maxlength="150"  class="form-control <?php echo !in_array("address1", $disabled)?' pad-field ':'';?>" id="address1" <?php echo in_array("address1", $disabled)?' disabled="disabled" ':' name="address1" ';?>  value="<?php echo  $this->userMemberProfile->GetPostValue("address1");?>"   placeholder="<?php _e("Street address, P.O. Box, Company Name,C/O"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address Line 1"));?>">
			      </div> 
			      </div>
			     <?php } ?>
					<?php if(!in_array("address2",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="address2"><?php _e("Address Line 2"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>"> 
	        			     <input maxlength="150"  class="form-control <?php echo !in_array("address2", $disabled)?' pad-field ':'';?>" id="address2" <?php echo in_array("address2", $disabled)?' disabled="disabled" ':' name="address2" ';?>    value="<?php echo $this->userMemberProfile->GetPostValue("address2");?>"  placeholder="<?php _e("Apartment,suite,unit,building,floor,etc"); ?>"   data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address Line 2"));?>">
				      	</div>
				      </div> 
				     <?php } ?>
				      <?php if(!in_array("thana_id",$except)){ ?>
				     	<input class="form-control <?php echo !in_array("thana_id", $disabled)?' pad-field ':'';?>" type="hidden" name="thana_id" value="NA"/>
				     <?php }?>
				     <?php if(!in_array("district_id",$except)){ ?>
					 <div class="form-group ">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="cndistrict_id"><?php _e("City"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>">                   			     	
				      		
	        			        <input maxlength="40"  class="form-control <?php echo !in_array("district_id", $disabled)?' pad-field ':'';?>" id="cndistrict_id" <?php echo in_array("district_id", $disabled)?' disabled="disabled" ':' name="district_id" ';?>    value="<?php echo $this->userMemberProfile->GetPostValue("district_id");?>"  data-bv-notempty="true" placeholder="<?php _e("City"); ?>"	data-bv-notempty-message="<?php  _e("%s is required",__("City"));?>">
	        			       
				      	</div>
				      </div> 
				     <?php } ?>
					<?php if(!in_array("division_id",$except)){ ?>
					 <div class="form-group ">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="cndivision_id"><?php _e("State/Province/Region"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>">                   			     	
				      		 <input maxlength="40"  class="form-control <?php echo !in_array("division_id", $disabled)?' pad-field ':'';?>" id="cndivision_id" <?php echo in_array("division_id", $disabled)?' disabled="disabled" ':' name="division_id" ';?>    value="<?php echo $this->userMemberProfile->GetPostValue("district_id");?>"  data-bv-notempty="true" placeholder="<?php _e("State/Province/Region"); ?>"	data-bv-notempty-message="<?php  _e("%s is required",__("State/Province/Region"));?>">
				      	</div>
				      </div> 			     
				     <?php } ?>	
				    
					
					</div>
				 <?php if(!in_array("postal_code",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="postal_code"><?php _e("Zip/Postal Code"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>">                   			     	
				      		<input type="text" maxlength="10"   value="<?php echo  $this->userMemberProfile->GetPostValue("postal_code");?>" class="form-control" id="postal_code" <?php echo in_array("postal_code", $disabled)?' disabled="disabled" ':' name="postal_code" ';?>     placeholder="<?php _e("Zip/Postal Code"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Postal Code"));?>">
				      	</div>
				      </div> 
				     <?php } ?>	
				     	
				<div class="form-group text-center">
		      	<label class="control-label col-md-7 xs-text-center" for="is_same_address" style="font-weight: bold;"><?php _e("Permantent address is same as present"); ?></label>		      
		      	<div class="col-md-4 p-l-0 app-block-help-span">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $is_same_address=$this->GetPostValue("is_same_address");
			            $is_same_address_isDisabled=in_array("is_same_address", $disabled);
			            
			            GetHTMLRadioByArray("same or not","is_same_address","is_same_address",true,array("Y"=>"Yes","N"=>"No"),$is_same_address,$is_same_address_isDisabled);
			            ?>			        
			       </div> 
		      	</div>
		      </div> 
				  </div>
				</div>
				</div>
				
				
				
				<div id="permanent_address_container" class="animated col-md-<?php echo $col_length;?>">
					<div class="panel panel-default">
					  	<div class="panel-heading"><?php _e("Permanent Address"); ?></div>
					  	<div class="panel-body"> <!--  Permanent Address -->
					  	
				  	<?php if(!in_array("per_country",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="per_country"><?php _e("Country"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>"> 
		      		<select    class="form-control " id="per_country" <?php echo in_array("per_country", $disabled)?' disabled="disabled" ':' name="per_country" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Country"));?>">
				        <?php $country_selected= $this->userMemberProfile->GetPostValue("per_country","");
				            GetHTMLOptionByArray(getCountryKeyValuePair(),$country_selected);
				            ?>
				        
				      </select>
		      	</div>
		      	
		      	
		      </div> 
		     <?php } ?>
				<?php  
				
				$selected_per_division_id=$this->userMemberProfile->GetPostValue("per_division_id");
				$selected_per_district_id=$this->userMemberProfile->GetPostValue("per_district_id");
				$selected_per_thana_id=$this->userMemberProfile->GetPostValue("per_thana_id");
				$per_districts=array();
				$per_thanas=array();
				if(isset($districtjson[$selected_per_division_id])){
				    $per_districts=&$districtjson[$selected_per_division_id];
				}
				if(isset($thanajson[$selected_per_district_id])){
				    $per_thanas=&$thanajson[$selected_per_district_id];
				}?>
				<div id="pbd-form">
				<?php if(!in_array("per_address1",$except)){ ?>
				 <div class="form-group ">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="per_address1"><?php _e("Address"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<textarea style="min-height: 66px;" maxlength="150"  class="form-control <?php echo !in_array("per_address1", $disabled)?' pad-field ':'';?>" id="per_address1" <?php echo in_array("per_address1", $disabled)?' disabled="disabled" ':' name="per_address1" ';?>     placeholder="<?php _e("Address"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address1"));?>"><?php echo  $this->userMemberProfile->GetPostValue("per_address1");?></textarea>
			      	</div>
			      </div> 
			     <?php } ?>
				<?php if(!in_array("per_division_id",$except)){ ?>
				 <div class="form-group ">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="per_division_id"><?php _e("Division"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php $options_division_id= Mdivision::FetchAllKeyValue("id", "name",false);?>
				        <select  class="form-control <?php echo !in_array("per_division_id", $disabled)?' pad-field ':'';?>" id="per_division_id" <?php echo in_array("per_division_id", $disabled)?' disabled="disabled" ':' name="per_division_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Division Name"));?>">
				       <?php GetHTMLOption("","Select");
			      		      GetHTMLOptionByArray($divisions,$selected_division_id);?>		        
				        </select>
			      	</div>
			      </div> 			     
			     <?php } ?>	
			     <?php if(!in_array("per_district_id",$except)){ ?>
				 <div class="form-group ">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="per_district_id"><?php _e("District"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php $options_district_id= Mdistrict::FetchAllKeyValue("id", "name",false);?>
        			        <select   class="form-control <?php echo !in_array("per_district_id", $disabled)?' pad-field ':'';?>" id="per_district_id" <?php echo in_array("per_district_id", $disabled)?' disabled="disabled" ':' name="per_district_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("District Name"));?>">
        			       <?php 
        		      		GetHTMLOption("","Select");
        		      		 GetHTMLOptionByArray($districts,$selected_district_id);?>		        
        			        </select>
			      	</div>
			      </div> 
			     <?php } ?>
				<?php if(!in_array("per_thana_id",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="per_thana_id"><?php _e("Thana/Upazilla"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<?php $options_thana_id= Mthana::FetchAllKeyValue("id", "name",false);?>
        			        <select   class="form-control <?php echo !in_array("per_thana_id", $disabled)?' pad-field ':'';?>" id="per_thana_id" <?php echo in_array("per_thana_id", $disabled)?' disabled="disabled" ':' name="per_thana_id" ';?>      data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Thana Name"));?>">
        			       <?php GetHTMLOption("","Select");
        		      		      GetHTMLOptionByArray($thanas,$selected_thana_id);?>	        
        			        </select>
			      	</div>
			      </div> 
			     <?php } ?>				   	
				</div>
				<div id="pnbd-form">
				<?php if(!in_array("per_address1",$except)){ ?>
				 <div class="form-group">
			      	<label class="control-label col-md-<?php echo $label_col;?>" for="pnper_address1"><?php _e("Address Line 1"); ?></label>
			      	<div class="col-md-<?php echo $input_col;?>">                   			     	
			      		<input  maxlength="150"  class="form-control <?php echo !in_array("per_address1", $disabled)?' pad-field ':'';?>" id="pnper_address1" <?php echo in_array("per_address1", $disabled)?' disabled="disabled" ':' name="per_address1" ';?>  value="<?php echo  $this->userMemberProfile->GetPostValue("per_address1");?>"   placeholder="<?php _e("Street address, P.O. Box, Company Name,C/O"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address Line 1"));?>">
			      </div> 
			      </div>
			     <?php } ?>
					<?php if(!in_array("per_address2",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="pnper_address2"><?php _e("Address Line 2"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>"> 
	        			     <input maxlength="150"  class="form-control <?php echo !in_array("per_address2", $disabled)?' pad-field ':'';?>" id="pnper_address2" <?php echo in_array("per_address2", $disabled)?' disabled="disabled" ':' name="per_address2" ';?>    value="<?php echo $this->userMemberProfile->GetPostValue("per_address2");?>"  placeholder="<?php _e("Apartment,suite,unit,building,floor,etc"); ?>"   data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Address Line 2"));?>">
				      	</div>
				      </div> 
				     <?php } ?>
				     <?php if(!in_array("per_thana_id",$except)){ ?>
				     	<input class="form-control <?php echo !in_array("per_thana_id", $disabled)?' pad-field ':'';?>" type="hidden" name="per_thana_id" value="NA"/>
				     <?php }?>
				     <?php if(!in_array("per_district_id",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="pnper_district_id"><?php _e("City"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>">                   			     	
				      		
	        			        <input maxlength="40"  class="form-control <?php echo !in_array("per_district_id", $disabled)?' pad-field ':'';?>" id="pnper_district_id" <?php echo in_array("per_district_id", $disabled)?' disabled="disabled" ':' name="per_district_id" ';?>    value="<?php echo $this->userMemberProfile->GetPostValue("per_district_id");?>"  data-bv-notempty="true" placeholder="<?php _e("City"); ?>"	data-bv-notempty-message="<?php  _e("%s is required",__("City"));?>">
	        			       
				      	</div>
				      </div> 
				     <?php } ?>
					<?php if(!in_array("per_division_id",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="pnper_division_id"><?php _e("State/Province/Region"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>">                   			     	
				      		 <input maxlength="40"  class="form-control <?php echo !in_array("per_division_id", $disabled)?' pad-field ':'';?>" id="pnper_division_id" <?php echo in_array("per_division_id", $disabled)?' disabled="disabled" ':' name="per_division_id" ';?>    value="<?php echo $this->userMemberProfile->GetPostValue("per_district_id");?>"  data-bv-notempty="true" placeholder="<?php _e("State/Province/Region"); ?>"	data-bv-notempty-message="<?php  _e("%s is required",__("State/Province/Region"));?>">
				      	</div>
				      </div> 			     
				     <?php } ?>	
				    
					
					</div>
				 <?php if(!in_array("per_postal_code",$except)){ ?>
					 <div class="form-group">
				      	<label class="control-label col-md-<?php echo $label_col;?>" for="pnper_postal_code"><?php _e("Zip/Postal Code"); ?></label>
				      	<div class="col-md-<?php echo $input_col;?>">                   			     	
				      		<input type="text" maxlength="10"   value="<?php echo  $this->userMemberProfile->GetPostValue("per_postal_code");?>" class="form-control " id="pnper_postal_code" <?php echo in_array("per_postal_code", $disabled)?' disabled="disabled" ':' name="per_postal_code" ';?>     placeholder="<?php _e("Zip/Postal Code"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Postal Code"));?>">
				      	</div>
				      </div> 
				     <?php } ?>	
				     	
			 				
					  	</div><!-- end permanent Address -->
					  </div>
					
				</div>
				
				<script type="text/javascript">
				var form=null;
				var division_districts=<?php echo json_encode($districtjson);?>;	 
				var district_thana=<?php echo json_encode($thanajson);?>;	
				function enableDisableFields(elements,status){
					elements.each(function(){
						$(this).prop("disabled",!status);
						var name=$(this).attr("name");						
						/*if(name){
							console.log(name);
							form.data('bootstrapValidator').enableFieldValidators($(this), status);
						}*/
					});
				}	
				function SetPresentCountryFrom(){
						var selectedCountry=$("#country").val();						
						if(selectedCountry=="BD"){
							$("#cnbd-form").hide();
							$("#cbd-form").show();
							$("#cbd-form").find(".pad-field").prop("disabled",false);							
							enableDisableFields($("#cnbd-form").find(".pad-field"),false);
							$("#cbd-form #address1").focus();
							
						}else{
							$("#cnbd-form").show();
							$("#cbd-form").hide();
							$("#cnbd-form").find(".pad-field").prop("disabled",false);
							$("#cbd-form").find(".pad-field").prop("disabled",true);
							enableDisableFields($("#cbd-form").find(".pad-field"),false);
							$("#cnbd-form #address1").focus();
							
						}
						
				}
				function SetPermanentCountryFrom(){
					var selectedCountry=$("#per_country").val();					
					if(selectedCountry=="BD"){
						$("#pnbd-form").hide();
						$("#pbd-form").show();
						$("#pbd-form").find(".pad-field").prop("disabled",false);						
						enableDisableFields($("#pnbd-form").find(".pad-field"),false);
						$("#pbd-form #per_address1").focus();
						
					}else{
						$("#pnbd-form").show();
						$("#pbd-form").hide();
						$("#pnbd-form").find(".pad-field").prop("disabled",false);						
						enableDisableFields($("#pbd-form").find(".pad-field"),false);
						$("#pnbd-form #pnper_address1").focus();
						
					}
					
			}
				function SetPermanentAddress(){
					var is_same_address=$("#is_same_address:checked").val();
					console.log(is_same_address);
					
					if(is_same_address=="N"){
						$("#permanent_address_container").removeClass("hidden").addClass("fadeIn");
						SetPermanentCountryFrom();
					}else{
						$("#permanent_address_container").addClass("hidden");
						enableDisableFields($("#permanent_address_container").find(".pad-field"),false);
					}
				}
				$(function(){	
					form=$("#name").closest('form');
					//var validator=form.data('bootstrapValidator');
					//validator.enableFieldValidators("name", false);
					//console.log(form);
					SetPresentCountryFrom();
					SetPermanentCountryFrom();
					SetPermanentAddress();
					$("#country").on("change",function(e){
						SetPresentCountryFrom();
					});
					$("#per_country").on("change",function(e){
						SetPermanentCountryFrom();
					});	
					$("input[name=is_same_address]").change(function(e){
						SetPermanentAddress();
					});
								
				$("#division_id").change(function(e){
			    	  var val=$(this).val();
			    	 
			    	  try{
			    		  var options=division_districts[val];		    		 
			    		  set_options_to_select('#district_id',options); 
			    	  }catch(e){}
			    	  try{
			    	  $("#thana_id").find("option").remove();
			    	  }catch(e){}
		    	   });
		    	  $("#district_id").change(function(e){
			    	  var val=$(this).val();
			    	  try{
			    		  var options=district_thana[val];		    		 
			    		  set_options_to_select('#thana_id',options); 
			    	  }catch(e){}
		    	   });

		    	  $("#per_division_id").change(function(e){
			    	  var val=$(this).val();
			    	 
			    	  try{
			    		  var options=division_districts[val];		    		 
			    		  set_options_to_select('#per_district_id',options); 
			    	  }catch(e){}
			    	  try{
			    	  $("#thana_id").find("option").remove();
			    	  }catch(e){}
		    	   });
		    	  $("#per_district_id").change(function(e){
			    	  var val=$(this).val();
			    	  try{
			    		  var options=district_thana[val];		    		 
			    		  set_options_to_select('#per_thana_id',options); 
			    	  }catch(e){}
		    	   });
			    	  
				});

				</script>
			<?php 
		}
	
}