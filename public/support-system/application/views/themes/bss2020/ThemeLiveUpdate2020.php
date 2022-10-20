<?php
	/**
	 * @since: 03/08/2020
	 * @author: Sarwar Hasan
	 * @version 1.0.0
	 */
	
	class ThemeLiveUpdate2020 {
		function __construct() {
			AddAppHTMLEditor();
			add_css( 'theme/bss2020/plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css' );
			add_js( 'theme/bss2020/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js' );
			
			
			add_js( 'theme/bss2020/js/live-update.js' );
			
			AddOnManager::RegisterHook( "live-update-edit-home", function ( &$ci ) {
				$ci->SetPopupFromMutipart();
				
				
				$this->show_headsarch_form( $ci, " Search Panel Data" );
			} );
			AddOnManager::RegisterHook( "live-update-edit-notification", function ( &$ci ) {
                $this->show_notification_form( $ci, "Notification Section Edit" );
            } );
			AddOnManager::RegisterHook( "live-update-need-help", function ( &$ci ) {
				$inputs = [
					'_needhlp_title'    => input_box_2020::getInput( "Title", "Still Need Support?" ),
					'_needhlp_subtitle' => input_box_2020::getInput( "Description", "We normally response within 24 hours" )
				];
				$this->show_common_form( $ci, "Open Ticket Section", $inputs );
			} );
			AddOnManager::RegisterHook( "live-update-before-article", function ( &$ci ) {
				$inputs = [
					'_b_knw_is_active'   => input_box_2020::getBoolenInput( "Hide This Section", "N" ),
					'_b_knw_title'       => input_box_2020::getInput( "Title", "Check out our guide categories" ),
					'_b_knw_description' => input_box_2020::getInput( "Description", "We normally response within 24 hours", false, "H" )
				];
				$this->show_common_form( $ci, "Before Knowledge List", $inputs );
			} );
			
			AddOnManager::RegisterHook( "live-update-faq-section", function ( &$ci ) {
				$inputs = [
					'_faq_sec_is_active'   => input_box_2020::getBoolenInput( "Hide This Section", "N" ),
					'_faq_sec_bg_img'      => input_box_2020::getBoolenInput( "Show Backgroud Image Overlay", "N" ),
					'_faq_sec_title'       => input_box_2020::getInput( "Title", 'How long will you take?' ),
					'_faq_sec_description' => input_box_2020::getInput( "Description", 'Find quicke answers to frequent pre-sale questions asked by customers', false, "H" )
				];
				$this->show_common_form( $ci, "Before Knowledge List", $inputs );
			} );
			
			AddOnManager::RegisterHook( "live-update-feedback-section", function ( &$ci ) {
				$inputs = [
					'_feedb_sec_is_active' => input_box_2020::getBoolenInput( "Hide This Section", "N" ),
				];
				$this->show_common_form( $ci, "Before Knowledge List", $inputs );
			} );
			AddOnManager::RegisterHook( "live-update-feature-box", [ $this, 'feature_box' ] );
			AddOnManager::RegisterHook( "live-update-email-subs", [ $this, 'mail_subscribe_box' ] );
			AddOnManager::RegisterHook( "live-update-footer-msg", [ $this, 'footer_msg' ] );
		}
		function getUploadedFileExtension($name){
			if(isset($_FILES[$name]) && empty($_FILES[$name]['error'])){
				if(function_exists('pathinfo')) {
					$path_parts = pathinfo( $_FILES[$name]["name"] );
					return $path_parts['extension'];
				}
			}
			return '';
		}
		function cleanHeaderRightImage(){
			foreach ( ['jpg','jpeg','png','svg'] as $extension ) {
				$path = FCPATH . "/data/theme2020" . DIRECTORY_SEPARATOR . "right-img." . $extension;
				if(file_exists($path)){
					unlink($path);
				}
			}
		}
		function cleanHeaderBgImage(){
			foreach ( ['jpg','jpeg','png','svg'] as $extension ) {
				$path = FCPATH . "/data/theme2020" . DIRECTORY_SEPARATOR . "bg.".$extension;
				if(file_exists($path)){
					unlink($path);
				}
			}
		}
		/**
		 * @param Admin_live_update $ci
		 * @param $title
		 * @param $inputs
		 * @param string $col_size
		 */
		function show_headsarch_form( &$ci, $title, $inputs = [], $col_size = 'col-md-6 col-sm-6' ) {
			$ci->SetPOPUPColClass( $col_size );
			$ci->SetAppTheme( 'bss2020' );
			$ci->SetTitle( $title );
			if ( IsPostBack ) {
				$root = FCPATH . "/data/theme2020/";
				if ( ! is_dir( $root ) ) {
					app_make_dir( $root );
				}
				if ( isset( $_POST['_src_right_img_del'] ) ) {
					$this->cleanHeaderRightImage();
				}
				if ( isset( $_POST['_src_bg_img_del'] ) ) {
					$this->cleanHeaderBgImage();
				}
				$extension_right=strtolower($this->getUploadedFileExtension('_src_right_img'));
				if(!empty($extension_right) && in_array($extension_right,['jpg','jpeg','png','svg'])) {
					$path = $root . DIRECTORY_SEPARATOR . "right-img." . $extension_right;
					if ( ( isset( $_FILES['_src_right_img'] ) && empty( $_FILES['_src_right_img']['error'] ) ) ) {
						$this->cleanHeaderRightImage();
						move_upload_file_if_ok( '_src_right_img', $path );
					}
				}
				$extension_bg=strtolower($this->getUploadedFileExtension('_src_bg_img'));
				if(!empty($extension_bg) && in_array($extension_bg,['jpg','jpeg','png','svg'])) {
					$path2 = $root . DIRECTORY_SEPARATOR . "bg.".$extension_bg;
					if ( ( isset( $_FILES['_src_bg_img'] ) && empty( $_FILES['_src_bg_img']['error'] ) ) ) {
						$this->cleanHeaderBgImage();
						move_upload_file_if_ok( '_src_bg_img', $path2 );
					}
					
				}
				
				$allowed_property = [
					'_src_hr_img',
					'_src_rdy_msg',
					'_src_placeholder',
					'_src_home_subtitle',
					'_src_home_title',
					'_src_text_color',
                    '_src_style'
				]; //Todo:need to work
				foreach ( $allowed_property as $kk ) {
					$postValue = $ci->input->get_post( $kk );
					if ( $inputs[ $kk ]->type == "H" ) {
						$postValue = AppSecurity::RawPostValue( $kk );
					}
					Mapp_setting_api::UpdateSettingsOrAdd( "bss2020", $kk, $postValue );
				}
				
				AddInfo( "Successfully updated" );
				$ci->DisplayPOPUPMsg();
				
				return;
			}
			$ci->AddViewData( "inputs", $inputs );
			$ci->DisplayPOPUP( 'themes/bss2020/live_update/header_search_form' );
		}

        /**
         * @param Admin_live_update $ci
         * @param $title
         * @param $inputs
         * @param string $col_size
         */
        function show_notification_form( &$ci, $title, $inputs = [], $col_size = 'col-md-6 col-sm-6' ) {
            $ci->SetPOPUPColClass( $col_size );
            $ci->SetAppTheme( 'bss2020' );
            $ci->SetTitle( $title );
            if ( IsPostBack ) {
                $allowed_property = [
                    'top_noti_color',
                    'top_noti_text_color',
                ]; //Todo:need to work
                foreach ( $allowed_property as $kk ) {
                    $postValue = $ci->input->get_post( $kk );
                    if ( $inputs[ $kk ]->type == "H" ) {
                        $postValue = AppSecurity::RawPostValue( $kk );
                    }
                    Mapp_setting_api::UpdateSettingsOrAdd( "bss2020", $kk, $postValue );
                }
                LessProcess::ProcessClientColor();
                ScssCompiler::ProcessClientColor();
                AddInfo( "Successfully updated" );
                $ci->DisplayPOPUPMsg();
                return;
            }
            $ci->AddViewData( "inputs", $inputs );
            $ci->DisplayPOPUP( 'themes/bss2020/live_update/top_notification' );
        }
		/**
		 * @param Admin_live_update $ci
		 * @param $title
		 * @param $inputs
		 * @param string $col_size
		 */
		function show_common_form( &$ci, $title, $inputs = [], $col_size = 'col-md-6 col-sm-6' ) {
			$ci->SetPOPUPColClass( $col_size );
			$ci->SetAppTheme( 'bss2020' );
			$ci->SetTitle( $title );
			if ( IsPostBack ) {
				$allowed_property = array_keys( $inputs );
				foreach ( $allowed_property as $kk ) {
					$postValue = $ci->input->get_post( $kk );
					if ( $inputs[ $kk ]->type == "H" ) {
						$postValue = AppSecurity::RawPostValue( $kk );
					}
					Mapp_setting_api::UpdateSettingsOrAdd( "bss2020", $kk, $postValue );
					
				}
				AddInfo( "Successfully updated" );
				$ci->DisplayPOPUPMsg();
				
				return;
			}
			$ci->AddViewData( "inputs", $inputs );
			$ci->DisplayPOPUP( 'themes/bss2020/live_update/common' );
		}
		
		
		/**
		 * @param Admin_live_update $ci
		 */
		function feature_box( &$ci ) {
			$ci->SetPOPUPColClass( 'col-sm-10' );
			$ci->SetAppTheme( 'bss2020' );
			$ci->SetTitle( "Feature box" );
			if ( IsPostBack ) {
				$allowed_property = [ '_fbox_is_hide', '_fbox_icon_1', '_fbox_icon_2', '_fbox_icon_3', '_fbox_title_1', '_fbox_title_2', '_fbox_title_3', '_fbox_dtls_1', '_fbox_dtls_2', '_fbox_dtls_3', '_fbox_link_1', '_fbox_link_2', '_fbox_link_3' ];
				foreach ( $allowed_property as $kk ) {
					$postValue = $ci->input->get_post( $kk );
					Mapp_setting_api::UpdateSettingsOrAdd( "bss2020", $kk, $postValue );
				}
				AddInfo( "Successfully updated" );
				$ci->DisplayPOPUPMsg();
				
				return;
				
			}
			$ci->DisplayPOPUP( 'themes/bss2020/live_update/feature_box' );
		}
		
		/**
		 * @param Admin_live_update $ci
		 */
		function mail_subscribe_box( &$ci ) {
						$ci->SetAppTheme( 'bss2020' );
			$ci->SetTitle( "Feature box" );
			if ( IsPostBack ) {
				$allowed_property = [ 'is_mailchimp', 'title', 'sub_title','placeholder','subs_btn'];
				foreach ( $allowed_property as $kk ) {
					$postValue = $ci->input->get_post( $kk );
					Mapp_setting_api::UpdateSettingsOrAdd( "MailChimp", $kk, $postValue );
				}
				AddInfo( "Successfully updated" );
				$ci->DisplayPOPUPMsg();
				return;
				
			}
			$ci->DisplayPOPUP( 'themes/bss2020/live_update/mail_subscriber' );
		}
		function footer_msg( &$ci ) {
		$ci->SetAppTheme( 'bss2020' );
		$ci->SetTitle( "Footer" );
		if ( IsPostBack ) {
			$allowed_property = [ 'footer_text'];
			foreach ( $allowed_property as $kk ) {
				$postValue = $ci->input->get_post( $kk );
				Mapp_setting_api::UpdateSettingsOrAdd( "system", $kk, $postValue );
			}
			AddInfo( "Successfully updated" );
			$ci->DisplayPOPUPMsg();
			return;
			
		}
		$ci->DisplayPOPUP( 'themes/bss2020/live_update/footer_msg' );
	}
	}
	class input_box_2020 {
		public $title;
		public $name;
		public $default_value;
		public $placeholder;
		public $is_required=false;
		public $type;
		public $option;
		
		static function getInput($title,$placeholder='',$is_required=false,$type="T",$options=[]){
			$obj=new self();
			$obj->title=$title;
			$obj->placeholder=$placeholder;
			$obj->is_required=$is_required;
			$obj->type=$type;
			$obj->option=$options;
			return $obj;
		}
		static function getBoolenInput($title,$default_value="N"){
			$obj=new self();
			$obj->title=$title;
			$obj->default_value=$default_value;
			$obj->type="B";
			return $obj;
		}
		static function getImageInput($title,$default_value="",$placeholder='',$style=''){
			$obj=new self();
			$obj->title=$title;
			$obj->placeholder=$placeholder;
			$obj->default_value=$default_value;
			$obj->option=$style;
			$obj->type="I";
			return $obj;
		}
	}