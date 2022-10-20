<?php 
/**
 * Version 1.0.0
 * Creation date: 09/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
APP_Controller::LoadGridController();    
class Client_data extends APP_GridDataController{
    
    
	   
	   function client_list() {
		   if ( ! ACL::HasPermission( "admin/client/index" ) ) {
			   $this->DisplayGridPermissionDenied();
			
			   return;
		   }
		   $this->setDownloadFileName( "client-list" );
		   $customes = [];
		
		   $mainobj = new Msite_user();
		   $mainobj->status("<>'D'",true);
		   $mainobj->setCustomFields( $customes, $hasCustom );
		   $hasCustom = count( $customes ) > 0;
		   $records   = $mainobj->CountALL( $this->srcItem, $this->srcText, $this->multiparam, "after" );
		   if ( $records > 0 ) {
			   $this->SetGridRecords( $records );
			   $this->setOrderByIfEmpty("id",'desc');
			   //site_user:id,first_name,last_name,username,email,password,is_verified_email,gender,phone,address,region,city,zip,country,dob,profile_url,photo_url,age,login_type,join_date,tzone
			   $result = $mainobj->SelectAllGridData( "id,first_name,last_name,username,email,is_verified_email,gender,country,login_type,join_date,status", $this->orderBy, $this->order, $this->rows, $this->limitStart, $this->srcItem, $this->srcText, $this->multiparam, "after" );
			   if ( $result ) {
				   $has_edit_permission                     = ACL::HasPermission( "admin/client/edit" );
				   $has_delete_permission                   = ACL::HasPermission( "admin/client-confirm/client-delete" );
				   $has_reset_permission                    = ACL::HasPermission( "admin/client-confirm/reset-user-pass" );
				   $has_is_verified_email_change_permission = ACL::HasPermission( "admin/client-confirm/is-verified-email-change" );
				
				   $is_verified_email_change = $mainobj->GetPropertyOptionsTag( "is_verified_email" );
				   $login_type_options       = $mainobj->GetPropertyOptionsTag( "login_type" );
				   $statuslist               = $mainobj->GetPropertyOptionsTag( 'status' );
				
				
				   foreach ( $result as &$data ) {
					   $data->action = "";
					   if ( $has_edit_permission ) {
						   $data->action .= "<li><a data-effect='mfp-move-from-top' class='popupformWR' href='" . site_url( "admin/client/edit/" . $data->id ) . "'><i class='fa fa-edit'></i>" . __( "Edit" ) . "</a></li>";
						
					   }
					   if ( $hasCustom ) {
						   Msite_user_custom_field::bindGridCustomFieldData( $data, $customes );
					   }
					   /*if($has_delete_permission){
							$data->action.=" <li><a class='ConfirmAjaxWR btn btn-danger btn-xs' data-msg='".__("Are you sure to delete?")."' href='" . site_url ("admin/client-confirm/client-delete/".$data->id) ."'>".__("Delete")."</a></li>";
						}*/
					
					   if ( $has_reset_permission ) {
						   $data->action .= "<li><a class='ConfirmAjaxWR' data-msg='Are you sure?' href='" . admin_url( "client-confirm/reset-user-pass/" . $data->id ) . "'><i class='fa fa-envelope-o'></i>" . __( "Email Password Reset Link" ) . "</a></li>";
						
					   }
					   $data->action     .= "<li role='separator' class='divider'></li>";
					   $data->action     .= "<li><a data-effect='mfp-move-from-top' class='popupformWR' href='" . site_url( "admin/client/profile/" . $data->id ) . "'><i class='fa fa-eye'></i>" . __( "View Details" ) . "</a></li>";
					   $data->first_name = "<a data-effect='mfp-move-from-top' class='popupformWR' href='" . site_url( "admin/client/profile/" . $data->id ) . "'>" . $data->first_name . "</a>";
					
					   if ( ! empty( $data->action ) ) {
						   $data->action = "<button class='btn btn-xs btn-default app-grid-dropdown' data-content='#dpdown_" . $data->id . "' type='button' id='d" . $data->id . "'>
					   <i class='fa fa-chevron-circle-down'></i> <span class='hidden-sm'>&nbsp; " . __( "Menu" ) . "</span>
					   </button>
					   <ul id='dpdown_" . $data->id . "' class='app-dropdownmenu'>
					   " . $data->action . " </ul>";
						   clean_grid_text( $data->action );
					   }
					
					
					   if ( $has_is_verified_email_change_permission ) {
						   $data->is_verified_email = " <a class='ConfirmAjaxWR' data-on-complete='confirm_wr_change' data-msg='" . __( "Are you sure to change?" ) . "' href='" . site_url( "admin/client-confirm/is-verified-email-change/" . $data->id ) . "'>" . __( getTextByKey( $data->is_verified_email, $is_verified_email_change ) ) . "</a>";
					   } else {
						   $data->is_verified_email = getTextByKey( $data->is_verified_email, $is_verified_email_change );
					   }
					
					   $data->join_date  = get_user_date_default_format( $data->join_date );
					   $data->login_type = getTextByKey( $data->login_type, $login_type_options );
					   $data->status     = getTextByKey( $data->status, $statuslist );
					
				   }
			   }
			   $this->SetGridData( $result );
		   }
		   $this->DisplayGridResponse();
	   }
    
}
?>