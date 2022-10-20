<?php 
/**
 * Version 1.0.0
 * Creation date: 17/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Custom_field_confirm extends APP_ConfirmController {
	
	
	function __construct() {
		parent::__construct();
		$this->CheckPageAccess();
	}
	
	
	function custom_field_delete( $param = "" ) {
		
		if ( empty( $param ) ) {
			$this->SetConfirmResponse( false, __( "Invalid Request" ) );
			
			return;
		}
		$mr = new Mcustom_field();
		$mr->id( $param );
		if ( $mr->Select() ) {
			//$ur=new Mcustom_field();
			if ( Mcustom_field::DeleteByKeyValue( "id", $param ) ) {
				AddLog( "D", "id={$param}", "l003", "Custom_field_confirm" );
				$this->SetConfirmResponse( true, __( "Successfully deleted" ) );
			} else {
				$this->SetConfirmResponse( false, __( "Delete failed try again" ) );
			}
		}
	}
	
	function is_required_change( $param = "" ) {
		if ( empty( $param ) ) {
			$this->SetConfirmResponse( false, __( "Invalid Request" ) );
			
			return;
		}
		$mr                = new Mcustom_field();
		$is_requiredChange = $mr->GetPropertyOptionsTag( "is_required" );
		
		$mr->id( $param );
		if ( $mr->Select( "is_required" ) ) {
			$newStatus = $mr->is_required == "Y" ? "N" : "Y";
			$uo        = new Mcustom_field();
			$uo->is_required( $newStatus );
			$uo->SetWhereUpdate( "id", $param );
			if ( $uo->Update() ) {
				$status_text = getTextByKey( $uo->is_required, $is_requiredChange );
				AddLog( "U", $uo->settedPropertyforLog(), "l002", "Custom_field" );
				$this->SetConfirmResponse( true, __( "Successfully Updated" ), $status_text );
			} else {
				$this->SetConfirmResponse( false, __( "Update failed try again" ) );
			}
			
		}
		
	}
	
	function is_api_based_change( $param = "" ) {
		if ( empty( $param ) ) {
			$this->SetConfirmResponse( false, __( "Invalid Request" ) );
			
			return;
		}
		$mr                 = new Mcustom_field();
		$is_api_basedChange = $mr->GetPropertyOptionsTag( "is_api_based" );
		
		$mr->id( $param );
		if ( $mr->Select( "is_api_based" ) ) {
			$newStatus = $mr->is_api_based == "Y" ? "N" : "Y";
			$uo        = new Mcustom_field();
			$uo->is_api_based( $newStatus );
			$uo->SetWhereUpdate( "id", $param );
			if ( $uo->Update() ) {
				$status_text = getTextByKey( $uo->is_api_based, $is_api_basedChange );
				AddLog( "U", $uo->settedPropertyforLog(), "l002", "Custom_field" );
				$this->SetConfirmResponse( true, __( "Successfully Updated" ), $status_text );
			} else {
				$this->SetConfirmResponse( false, __( "Update failed try again" ) );
			}
			
		}
		
	}
	
	function on_submit_api_check_change( $param = "" ) {
		if ( empty( $param ) ) {
			$this->SetConfirmResponse( false, __( "Invalid Request" ) );
			
			return;
		}
		$mr                        = new Mcustom_field();
		$on_submit_api_checkChange = $mr->GetPropertyOptionsTag( "on_submit_api_check" );
		
		$mr->id( $param );
		if ( $mr->Select( "on_submit_api_check" ) ) {
			$newStatus = $mr->on_submit_api_check == "Y" ? "N" : "Y";
			$uo        = new Mcustom_field();
			$uo->on_submit_api_check( $newStatus );
			$uo->SetWhereUpdate( "id", $param );
			if ( $uo->Update() ) {
				$status_text = getTextByKey( $uo->on_submit_api_check, $on_submit_api_checkChange );
				AddLog( "U", $uo->settedPropertyforLog(), "l002", "Custom_field" );
				$this->SetConfirmResponse( true, __( "Successfully Updated" ), $status_text );
			} else {
				$this->SetConfirmResponse( false, __( "Update failed try again" ) );
			}
			
		}
		
	}
	
	function status_change( $param = "" ) {
		if ( empty( $param ) ) {
			$this->SetConfirmResponse( false, __( "Invalid Request" ) );
			
			return;
		}
		$mr           = new Mcustom_field();
		$statusChange = $mr->GetPropertyOptionsTag( "status" );
		
		$mr->id( $param );
		if ( $mr->Select( "status" ) ) {
			$newStatus = $mr->status == "A" ? "I" : "A";
			$uo        = new Mcustom_field();
			$uo->status( $newStatus );
			$uo->SetWhereUpdate( "id", $param );
			if ( $uo->Update() ) {
				$status_text = getTextByKey( $uo->status, $statusChange );
				AddLog( "U", $uo->settedPropertyforLog(), "l002", "Custom_field" );
				$this->SetConfirmResponse( true, __( "Successfully Updated" ), $status_text );
			} else {
				$this->SetConfirmResponse( false, __( "Update failed try again" ) );
			}
			
		}
		
	}
	
	function reset_order( ) {
		Mcustom_field::ResetOrder();
		$this->SetConfirmResponse( true, __( "Successfully rest" ) );
	}
	function order_change( $type,$id = "" ) {
		if ( empty( $id ) ) {
			$this->SetConfirmResponse( false, __( "Invalid Request" ) );
			return;
		}
		if ( Mcustom_field::changeOrder( $id ,$type) ) {
			$this->SetConfirmResponse( true, __( "Successfully Updated" ));
		} else {
			$this->SetConfirmResponse( false, __( "Failed, may be this item is first or last item" ) );
		}
		
	}
	
	
}
?>