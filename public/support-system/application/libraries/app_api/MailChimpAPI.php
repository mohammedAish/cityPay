<?php
	
	/*
	API Name: MailChimp
	Description: The api can subscribe email
	Version: 1.0
	Author: Sarwar Hasan
	*/
	
	class MailChimpAPI extends APP_API {
		
		public $MailChimp;
		
		function __construct() {
			$this->set_api_type( self::$API_TYPE_POST );
			$this->menu_icon = "ap ap-mailchimp text-success";
			
			
		}
		
		/**
		 * @return \DrewM\MailChimp\MailChimp
		 * @throws Exception
		 */
		public function &loadMailChimpObj() {
		    if(empty($this->MailChimp)) {
			    $api_key = $this->get_config_value( "api_key" );
			    if ( ! empty( $api_key ) ) {
				    $this->MailChimp             = new \DrewM\MailChimp\MailChimp( $api_key );
				    $this->MailChimp->verify_ssl = false;
			    }
		    }
			return $this->MailChimp;
		}
		public function set_configuration_list() {
		 
			$this->addInputToggle( "API Settings", "Enable MailChimp", "is_mailchimp", "Enable this to active mailchimp email subscription", "N","has_depend_fld","" );
			
			$this->addInputText( "API Settings", "API Key", "api_key", "Your MailChimpAPI Key", "", true, "", "fld-MailChimp-is-mailchimp fld-MailChimp-is-mailchimp-y" );
		}
		
		
		public function valid_configuration( array &$post_data, &$message = NULL ) {
			if ( ! empty( $post_data['list_id'] ) ) {
				$api_name = $this->get_name();
				Mapp_setting_api::UpdateSettingsOrAdd( $api_name, 'list_id', $post_data['list_id'] );
				$this->LoadDBValue();
			}
			
			return true;
		}
		
		/* (non-PHPdoc)
		 * @see APP_API::get_api_response()
		 */
		public function get_api_response( $field_value ) {
		
		}
		
	    public function getList(){
		    $this->loadMailChimpObj();
		    if(!empty($this->MailChimp)) {
		        $response=[];
			    $result = $this->MailChimp->get( 'lists' );
			    if(!empty($result['lists'])){
			        foreach ($result['lists'] as $list){
				        $response[$list['id']]=$list['name'];
                    }
                }
			    $response['dsfd']="Appsdvd2";
			    return $response;
		    }
		    
		    return [];
        }
		public function getListID($is_default=false){
			$list_id = $this->get_config_value( "list_id" );
			if(empty($list_id) && $is_default ){
			    $list=$this->getList();
			    if(!empty($list)){
			        $list_id=array_keys($list)[0];
			        if(!empty($list_id)) {
				        $this->save_hidden_config( 'list_id', $list_id );
				        return $list_id;
			        }
                }
				return null;
            }else{
			    return $list_id;
            }
		}
		private function apicall( $url, $postarray = array() ) {
		
			
		}
		
		/**
		 * @param APPAPIResponse $response_data
		 *
		 * @return string
		 */
		public function get_html_display_by_response( $response_data ) {
			return '';
		}
		
		public function get_api_description() {
			ob_start();
			$lists=$this->getList();
			if(!empty($lists)){?>
                
                <div class="form-group">
                    <label class="control-label  col-md-3" for="list_id"><?php _e("Select List") ; ?></label>
                    <div class="col-md-9">
                        <select type="text"  class="form-control " id="list_id"
                                name="MailChimp[list_id]"
                                placeholder="<?php _e("Select List") ; ?>"

                                data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required","List");?>"

                        ><?php
                                $selectedKey=$this->getListID();
			                    GetHTMLOptionByArray($lists,$selectedKey)    ;
		                    ?>
                        </select>
                        <span class="form-group-help-block"><?php _e("Select Your List and Press the Save Button") ; ?></span>
                    </div>
                </div>
               
				
				<?php
            }else{
			    ?>
			    <div class="alert alert-danger"><?php _e("Please check your api key, may be you key is wrong") ; ?></div>
			    <?php
            }
			return ob_get_clean();
		}
		
		public function Subscribe($email_address,$status='subscribed'){
			$this->loadMailChimpObj();
			$list_id=$this->getListID();
			if(!empty($this->MailChimp)) {
				$result = $this->MailChimp->post( "lists/$list_id/members", [
					'email_address' => $email_address,
					'status'        => $status,
				] );
				if ( $this->MailChimp->success() ) {
					return $result;
				}
				if($result['status']=='400'){
					return $result;
                }
				return null;
			}
        }
	}