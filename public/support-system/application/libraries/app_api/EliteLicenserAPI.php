<?php
/*
API Name: Appsbd Licnese
Description: The api can verify envato purchase code
Version: 1.0
Author: Sarwar Hasan
*/
class EliteLicenserAPI extends APP_API {
	
	function __construct() {
		$this->set_api_type( self::$API_TYPE_FIELD );
		$this->menu_icon = "ap ap-elite-licenser text-info";
		
		
	}
	
	
	public function set_configuration_list() {
		$this->addInputText( "API Settings", "Server End Point", "api_server", "Your license eerver end point url", "", true, "", "fld-AppsbdLicense-api-type fld-AppsbdLicense-api-type-o" );
		$this->addInputText( "API Settings", "API Key", "api_key", "Enter the api of your license key", "", false );
		
		$this->addHtml("API Settings",'<hr/>');
		$this->addInputToggle("API Settings", "Check Support Expiry", "ischeck_expiry_date","If you enable it then one expire support it will return false return with a expiry message","N");
	}
	
	public function SetAdminMenu() {
		
		$apihost = $this->get_config_value( "api_server" );
		$api_key = $this->get_config_value( "api_key" );
		if ( ! empty( $apihost ) && ! empty( $api_key ) ) {
			
			AppMenu::AddInternalMenu( "ADA", "Check Elite License", "admin/api-setting/process-api/" . $this->get_name() . "?action=mchklic", "fa fa-crosshairs", [], "popupform" );
			
		}
	}
	
	public function valid_configuration( array &$post_data, &$message = NULL ) {
		return true;
	}
	
	/* (non-PHPdoc)
	 * @see APP_API::get_api_response()
	 */
	public function get_api_response( $field_value ,$is_force_result=false) {
		$field_value = trim( $field_value );
		$response    = $this->apicall( "license/view_with_product_client", [ "license_code" => $field_value ] );
		$obj         = new APP_Field_API_Response();
		if ( ! empty( $response ) ) {
			$response = json_decode( $response );
			if ( !empty($response->status) ) {
				if($this->get_config_value("ischeck_expiry_date")=="Y"){
                    if(!empty($response->data->has_expiry)&& ($response->data->has_expiry=="Y" && time()>strtotime($response->data->expiry_time))){
	                    $obj->SetResponse(false, "License key has been expire please renew license",$response->data);
	                    return $obj;
                    }
					if(!$is_force_result && (!empty($response->data->has_support)&& ($response->data->has_support=="N" || ($response->data->has_support=="Y" && time()>strtotime($response->data->support_end_time))))){
						if($response->data->has_support=="N"){
							$obj->SetResponse( false, "This license key doesn't allow support, please change license", $response->data );
                        }else {
							$obj->SetResponse( false, "Support time expire please renew support", $response->data );
						}
						return $obj;
					}
					$obj->SetResponse( true, "Successfully found", $response->data );
				}else{
					$obj->SetResponse( true, "Successfully found", $response->data );
				}
				
			} else {
				$obj->SetResponse( false, "Invalid Purchase Key", $response->data );
			}
		} else {
			$obj->SetResponse( false, "Invalid Purchase Key", NULL );
		}
		
		return $obj;
	}
	
	public function get_menu_title() {
		return "Elite Licenser";
	}
	
	
	/**
	 * @param APPAPIResponse $response_data
	 *
	 * @return string
	 */
	public function get_html_display_by_response( $response_data ) {
		//return "<pre>". print_r($response_data,true)."</pre>";
        $isAdmin=GetCurrentUserType()=="AD";
		ob_start();
		if ( $response_data->status && ! empty( $response_data->data ) ) {
			$returnUrl = $this->get_process_button_link() . "?action=mchklic&pcode=" . $response_data->data->purchase_key;
			$returnUrl = urlencode( $returnUrl );
			?>
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default app-panel-box-2">
                        <div class="panel-heading p-l-5"><?php _e( "Buyer Details" ); ?></div>
                        <div class="panel-body p-0">

                            <table class="table m-b-0">
                                <tr>
                                    <th style="width: 132px; "><?php _e( "Buyer Name" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td><?php echo $response_data->data->client_obj->name; ?></td>
                                </tr>
                                <tr>
                                    <th><?php _e( "Email" ); ?></th>
                                    <th>:</th>
                                    <td><?php echo $response_data->data->client_obj->email; ?></td>
                                </tr>
                                <tr>
                                    <th><?php _e( "Country" ); ?></th>
                                    <th>:</th>
                                    <td><?php echo $response_data->data->client_obj->country; ?></td>
                                </tr>
                                <tr>
                                    <th><?php _e( "company" ); ?></th>
                                    <th>:</th>
                                    <td><?php echo $response_data->data->client_obj->company; ?></td>
                                </tr>
                                <tr>
                                    <th><?php _e( "Entry Date" ); ?></th>
                                    <th>:</th>
                                    <td><?php echo get_user_date_default_format( $response_data->data->client_obj->entry_time ); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 md-p-l-0">
                    <div class="panel panel-default app-panel-box-2">
                        <div class="panel-heading p-l-5"><?php _e( "License Details" ); ?></div>
                        <div class="panel-body p-0">
                            <table class="table m-b-0" style="z-index: 10; position: relative;">
                                <tr>
                                    <th style="width: 132px; "><?php _e( "Product Name" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; "
                                        title="<?php echo $response_data->data->product_obj->product_name; ?>">
										<?php echo $response_data->data->product_obj->product_name; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 132px; "><?php _e( "License Title" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; "
                                        title="<?php echo $response_data->data->license_title; ?>">
										<?php echo $response_data->data->license_title; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 132px; "><?php _e( "Market" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; "
                                        title="<?php echo $response_data->data->market; ?>">
										<?php
											if ( empty( $response_data->data->market_description ) ) {
												$response_data->data->market_description = [];
											}
											$response_data->data->market_description = (array) $response_data->data->market_description;
											echo getTextByKey( $response_data->data->market, $response_data->data->market_description ); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 132px; "><?php _e( "License Expire Date" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; ">
										<?php echo $response_data->data->has_expiry == "Y" && ! empty( $response_data->data->has_expiry ) ? get_user_date_default_format( $response_data->data->has_expiry ) : "No Expiry"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $isExpire=strtotime($response_data->data->support_end_time)<time();
                                    ?>
                                    <th style="width: 132px; "><?php _e( "Support" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; ">
										<?php echo $response_data->data->has_support == "Y" && ! empty( $response_data->data->support_end_time ) ? '<span class=" '.($isExpire?'text-danger text-bold':'text-success').' ">'.get_user_date_default_format( $response_data->data->support_end_time ).'</span>' : "No Support"; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 132px; "><?php _e( "Extra Param" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; "
                                        title="<?php echo $response_data->data->extra_param; ?>">
										<?php echo $response_data->data->extra_param; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 132px; "><?php _e( "Status" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; "
                                        title="<?php echo $response_data->data->status; ?>">
										<?php
											$response_data->data->status_description = (array) $response_data->data->status_description;
											echo getTextByKey( $response_data->data->status, $response_data->data->status_description );
											if (  $isAdmin && $response_data->data->status == "A" ) {
												?>

												<?php
											}
										?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 132px; "><?php _e( "Active Domains" ); ?></th>
                                    <th style="width: 8px; ">:</th>
                                    <td class="app-tooltip"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; ">

                                    </td>

                                </tr>
                                <tr>

                                    <td colspan="3"
                                        style="white-space: nowrap; overflow: hidden; max-width: 100px;  text-overflow: ellipsis; ">
                                        <div style="max-height: 100px; overflow: auto;">
                                            <ol>
												<?php foreach ( $response_data->data->active_domains as $active_domain ) {
												    $url=$this->APBD_CleanDomainName($active_domain);
													echo '<li>' . $active_domain . ((  $isAdmin && $response_data->data->status == "A" )? '
													<a class="popupformWR pull-right btn btn-success btn-xs" href="'.$this->get_process_button_link().'?action=resetkey&pcode='.$response_data->data->purchase_key.'&domain='.urlencode($url).'&rtn='.$returnUrl.'"
                                                   data-effect="mfp-move-from-top"  >'.__('Remove').'</a><div class="row m-t-5"></div> </li>':'');
												} ?>
                                            </ol>
                                        </div>
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
			
			<?php
			
		} else {
			?>
            <h4 class="text-danger"><?php _e( "Response data doesn't valid" ); ?></h4>
			<?php
		}
		if ( GetCurrentUserType() == "AD" && ! empty( $response_data->data->purchase_code ) ) {
			
			$returnUrl = urlencode( current_url() );
			
			?>

            <div class="row">
                <div class="col-md-12 text-center p-b-15">
                    <a class="popupformWR btn btn-xs btn-info"
                       href="<?php echo $this->get_process_button_link(); ?>?action=chklic&pcode=<?php echo $response_data->data->purchase_code; ?>&rtn=<?php echo $returnUrl; ?>"><?php _e( "View License Information" ); ?></a>
                </div>
            </div>
			
			<?php
		}
		
		return ob_get_clean();
	}
    function APBD_CleanDomainName($domain) {
        $domain=trim($domain);
        $domain=strtolower($domain);
        $url=str_replace(['https://','http://'],"",$domain);
        $iswww=substr($url,0,4);
        if(strtolower($iswww)=="www."){
            $url=substr($url,4);
        }
        return $url;
    }
	/* (non-PHPdoc)
	 * @see APP_API::do_porcess()
	 */
	public function do_porcess() {
		ob_start();
		
		$action    = GetValue( "action" );
		$returnUrl = GetValue( "rtn" );
		$returnUrl = $returnUrl;
		if ( $action == "chklic" ) {
			$purchaseCode = GetValue( "pcode" );
			$this->getAppsbdLiceseCode( $purchaseCode, $returnUrl );
		} elseif ( $action == "mchklic" ) {
			$this->manualCheckLic();
		} elseif ( $action == "pchklic" ) {
			$purchaseCode = GetValue( "pcode" );
			$this->manualCheckProcess( $purchaseCode, $returnUrl );
		} elseif ( $action == "resetkey" ) {
			$purchaseCode = GetValue( "pcode" );
			$this->resetKeyProcess( $purchaseCode, $returnUrl );
		}
		
		return ob_get_clean();
	}
	
	public function resetKeyProcess( $pcode, $returnUrl ) {
        $domain = GetValue( "domain" );
		$response = $this->apicall( "/license/remove_domain", [ "license_code" => $pcode, "domain" => $domain] );
		if ( ! empty( $response ) ) {
            $response2=$response;
			$response = json_decode( $response );

			if ( !empty($response->status) ) {
				redirect( "admin/api-setting/process-api/" . $this->get_name() . "?action=pchklic&pcode=$pcode" );
				return;
			} else {
                if(is_null($response) || empty($response->msg) || !is_object($response)){
                    AddError( "Not a valid response received form license server" );
                }else {
                    AddError($response->msg);
                }
                redirect( "admin/api-setting/process-api/" . $this->get_name() . "?action=pchklic&pcode=$pcode" );
                return;
			}
		}
	}
	
	public function manualCheckProcess( $pcode, $returnUrl ) {
		$responseData = $this->get_api_response( $pcode,true );
		$ci           = get_instance();
		if ( $responseData->status ) {
			?>
            <h3 class="p-t-10">License Key: <?php echo $pcode ?></h3>
			<?php
			echo $this->get_html_display_by_response( $responseData );
		} else {
		    if(!empty($responseData->msg)){
			?>
            
            <div class="alert alert-danger"><?php echo $responseData->msg; ?></div>
                <?php } ?>
            <div class="alert alert-danger">No data found</div>
			<?php
		}
		?>
        <div class="row btn-group-md popup-footer text-right">
			<?php if ( ! empty( $returnUrl ) ) { ?>
                <a class="<?php echo $ci->input->is_ajax_request() ? "popupformWR" : ""; ?> btn btn-info m-0"
                   href="<?php echo $returnUrl ?>"><?php _e( "Back" ); ?></a>
			<?php } ?>
            <button type="button" class="close-pop-up btn  btn-danger"><i
                        class="fa fa-times"></i> <?php _e( "Close" ); ?></button>
        </div>
		<?php
	}
	
	public function manualCheckLic() {
		if ( IsPostBack ) {
			$purchaseCode = PostValue( "pcode" );
			if ( ! empty( $purchaseCode ) ) {
				redirect( "admin/api-setting/process-api/" . $this->get_name() . "?action=pchklic&pcode=$purchaseCode&rtn=" . current_url() );
				
				return;
			}
		}
		?>
        <div class="clearfix">
            <div class="form-group">
                <label class="control-label label-required" for="pcode"><?php _e( "Purchase Code" ); ?></label>
                <input type="text" class="form-control" id="pcode" name="pcode" placeholder="Purchase Code"
                       data-bv-notempty="true"
                       data-bv-notempty-message="<?php _e( "Purchase Code is required" ); ?>">
            </div>
        </div>
        <div class="row btn-group-md popup-footer text-right">
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> View License Details</button>
            <button type="button" class="close-pop-up btn  btn-danger"><i
                        class="fa fa-times"></i> <?php _e( "Cancel" ); ?></button>
        </div>
		<?php
	}
	
	public function getAppsbdLiceseCode( $purchaseCode, $returnUrl = '' ) {
		
		$ci                       = get_instance();
		$licenseInfo              = new stdClass();
		$licenseInfo->domain      = "";
		$licenseInfo->type        = "";
		$licenseInfo->ip          = "";
		$licenseInfo->add_date    = "";
		$licenseInfo->app_version = "";
		$licenseInfo->status      = "";
		
		$request_param        = new stdClass();
		$request_param->pcode = $purchaseCode;
		$request_param->time  = time();
		$data                 = $this->callAppsbdLicense( $purchaseCode );
		$msg                  = "";
		if ( $data ) {
			if ( $data->status ) {
				$licenseInfo->domain      = $data->data->domain;
				$licenseInfo->type        = $data->data->lic_str;
				$licenseInfo->ip          = $data->data->ip;
				$licenseInfo->add_date    = $data->data->add_date;
				$licenseInfo->app_version = $data->data->app_version;
				$licenseInfo->status      = $data->data->status_str;
			} else {
				$msg = $data->msg;
			}
		}
		
		?>
        <div class="panel panel-default">
            <div class="panel-heading"><?php _e( "Apps BD License info" ); ?></div>
            <div class="panel-body p-0">
				<?php if ( ! empty( $msg ) ) { ?>
                    <div class="col-md-12">
                        <div class="app-alert alert alert-danger m-t-10">
                            <i class="fa fa-exclamation-triangle faa-shake animated animated-2"></i>
							<?php echo $msg; ?>
                        </div>
                    </div>
				<?php } ?>
                <table class="table m-b-0">
                    <tr>
                        <th width="150px;">License Code</th>
                        <th width="10px;">:</th>
                        <td><?php echo $purchaseCode; ?></td>
                    </tr>
                    <tr>
                        <th width="150px;">License Type</th>
                        <th width="10px;">:</th>
                        <td><?php echo $licenseInfo->type; ?></td>
                    </tr>
                    <tr>
                        <th width="100px;">Domain</th>
                        <th width="10px;">:</th>
                        <td>
							<?php
								$licenseInfo->domain = ( strpos( $licenseInfo->domain, "http" ) === false ? "http://" : "" ) . $licenseInfo->domain;
								echo $licenseInfo->domain;
								if ( ! empty( $licenseInfo->domain ) ) {
									?>
                                    <a target="_blank" href="<?php echo $licenseInfo->domain; ?>"
                                       class="btn btn-xs btn-info">Visit</a>
								<?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th>IP</th>
                        <th>:</th>
                        <td><?php echo $licenseInfo->ip; ?></td>
                    </tr>
                    <tr>
                        <th>Added</th>
                        <th>:</th>
                        <td><?php echo $licenseInfo->add_date; ?></td>
                    </tr>
                    <tr>
                        <th>App Version</th>
                        <th>:</th>
                        <td><?php echo $licenseInfo->app_version; ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>:</th>
                        <td><?php echo $licenseInfo->status; ?>
                            <a class="<?php echo $ci->input->is_ajax_request() ? "popupformWR" : ""; ?> btn btn-xs  btn-danger m-0"
                               href="<?php echo $this->get_process_button_link(); ?>?action=resetkey&pcode=<?php echo $purchaseCode; ?>&rtn=<?php echo $returnUrl; ?>"><i
                                        class="fa fa-trash"></i> <?php _e( "Reset License Key" ); ?></a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row btn-group-md popup-footer text-right">
			<?php if ( ! empty( $returnUrl ) ) { ?>
                <a class="<?php echo $ci->input->is_ajax_request() ? "popupformWR" : ""; ?> btn btn-info m-0 pull-left"
                   href="<?php echo $returnUrl ?>"><?php _e( "Back" ); ?></a>
			<?php } ?>


            <button type="button" class="close-pop-up btn  btn-danger"><i
                        class="fa fa-times"></i> <?php _e( "Close" ); ?></button>
        </div>
		<?php
		
	}
	
	private function callAppsbdLicense( $pcode ) {
		$url                  = "";
		$request_param        = new stdClass();
		$request_param->pcode = $pcode;
		$request_param->time  = time();
		$requestcode          = json_encode( $request_param );
		$key                  = "myappkey2018";
		$encrypt_code         = $this->app_encrypt( $requestcode, $key );
		$postarray            = [ "info" => $encrypt_code ];
		$param                = "?info=" . urlencode( $encrypt_code );
		$ch                   = curl_init();
		//echo $url.$param;
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_URL, $url . $param );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$output = curl_exec( $ch );
		$info   = curl_getinfo( $ch );
		//print_r($info);
		if ( $output === false ) {
			$obj             = new stdClass();
			$obj->status     = false;
			$obj->type       = "curl_error";
			$obj->msg        = curl_error( $ch );
			$obj->curl_errno = curl_errno( $ch );
			
			return json_encode( $obj );
		}
		curl_close( $ch );
		
		return ! empty( $output ) ? json_decode( $output ) : NULL;
		
	}
	
	private function resetAppsbdLicense( $pcode, $status = 'WD' ) {
		$url                       = "";
		$request_param             = new stdClass();
		$request_param->pcode      = $pcode;
		$request_param->lic_status = $status;
		$request_param->time       = time();
		$requestcode               = json_encode( $request_param );
		$key                       = "myappkey2018";
		$encrypt_code              = $this->app_encrypt( $requestcode, $key );
		$postarray                 = [ "info" => $encrypt_code ];
		$param                     = "?info=" . urlencode( $encrypt_code );
		$ch                        = curl_init();
		//echo $url.$param;
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_URL, $url . $param );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$output = curl_exec( $ch );
		$info   = curl_getinfo( $ch );
		//print_r($info);
		if ( $output === false ) {
			$obj             = new stdClass();
			$obj->status     = false;
			$obj->type       = "curl_error";
			$obj->msg        = curl_error( $ch );
			$obj->curl_errno = curl_errno( $ch );
			
			return json_encode( $obj );
		}
		curl_close( $ch );
		
		return ! empty( $output ) ? json_decode( $output ) : NULL;
		
	}
	
	
	public function get_api_description() {
		ob_start();
		$response = $this->apicall( 'hello' );
		if ( ! empty( $response ) ) {
			$response = json_decode( $response );
			if ( !empty($response->status) ) {
				//GPrint($response);
				
				echo '<h3 class="m-t-0">ELite Licenser API successfully linked</h3>';
				
				?>
                <div class="panel panel-default">
                    <div class="panel-heading"><?php _e( "API Permissions" ); ?></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">

                                <ul class="nav nav-stacked app-nav-stacked">
                                    <li>Add Product
                                        <span class="pull-right  ">
                                            <?php echo $response->data->add_product == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>
                                    <li>Edit Product <span class="pull-right  ">
                                            <?php echo $response->data->edit_product == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span></li>
                                    <li>View Product <span class="pull-right  ">
                                            <?php echo $response->data->view_product == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span></li>


                                </ul>
                            </div>
                            <div class="col-md-4">
                                <ul class="nav nav-stacked app-nav-stacked">

                                    <li>Add Client
                                        <span class="pull-right  ">
                                            <?php echo $response->data->add_client == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>
                                    <li>Edit Client
                                        <span class="pull-right  ">
                                            <?php echo $response->data->edit_client == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>
                                    <li>View Client
                                        <span class="pull-right  ">
                                            <?php echo $response->data->view_client == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>

                                </ul>

                            </div>
                            <div class="col-md-4">
                                <ul class="nav nav-stacked app-nav-stacked">

                                    <li>Add License
                                        <span class="pull-right  ">
                                            <?php echo $response->data->add_license == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>
                                    <li>Edit License
                                        <span class="pull-right  ">
                                            <?php echo $response->data->edit_license == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>
                                    <li>View License
                                        <span class="pull-right  ">
                                            <?php echo $response->data->view_license == "Y" ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>' ?>
                                        </span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
				
				<?php
			} else {
				$apihost = $this->get_config_value( "api_server" );				
				$api_key = $this->get_config_value( "api_key" );
				if(!empty($apihost) && !empty($api_key)){
				    ?>
				    <div class="alert alert-danger">
                        Your API information is wrong.
                    </div>
				    <?php
                }
				?>
				<div class="panel panel-default">
				  <div class="panel-heading"><?php _e("About Eite Licenser"); ?></div>
				  <div class="panel-body">
                      <p class="card-text"><strong>Elite Licenser </strong> is a WordPress plugin for any types of
                          product licensing.
                          It also manages product updates, auto generates license code, built in
                          Envato licensing verification system,
                          full license control and more. It has full set of API, so you can handle
                          it by other applications as well.
                          One app handles license of all your products. You can handle any
                          language (PHP, .Net, Java, Android, etc.).
                          Also you can add licensing to more than one WordPress plugin or theme
                          and it can be installed on same WordPress.</p>

                      

                  </div>
				</div>
				<?php
			}
		}
		
		return ob_get_clean();
	}
	
	private function apicall( $url, $postarray = array() ) {
		$apihost = $this->get_config_value( "api_server" );
		$apihost = rtrim( $apihost, '/' ) . "/";
		$url     = ltrim( $url, '/' );
		$api_key = $this->get_config_value( "api_key" );
		if ( empty( $apihost ) || empty( $api_key ) ) {
			$obj             = new stdClass();
			$obj->status     = false;
			$obj->type       = "curl_error";
			$obj->error_msg  = "Invalid API Info";
			$obj->curl_errno = "";
			
			return json_encode( $obj );
		}
		
		$postarray['api_key'] = $api_key;
		//$headers=array('Authorization: Bearer '.$bearerToken);
		//GPrint($headers);
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_URL, $apihost . $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		if ( count( $postarray ) > 0 ) {
			curl_setopt( $ch, CURLOPT_POST, true );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $postarray );
		}
		$output = curl_exec( $ch );
		$info   = curl_getinfo( $ch );
		//print_r($info);
		if ( $output === false ) {
			$obj             = new stdClass();
			$obj->status     = false;
			$obj->type       = "curl_error";
			$obj->error_msg  = curl_error( $ch );
			$obj->curl_errno = curl_errno( $ch );
			
			return json_encode( $obj );
		}
		curl_close( $ch );
		
		return $output;
		
	}
	
	
}