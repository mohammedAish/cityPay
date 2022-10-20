<?php 		
/**
 * Version 1.0.0
 * Creation date: 07/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,entry_type,log_type,title,log_data,status,entry_time		
 */						
class Mdebug_log extends APP_Model {
	public $id;
	public $entry_type;
	public $log_type;
	public $title;
	public $log_data;
	public $status;
	public $entry_time;
	/**
	 * @var DebugEntryType
	 */
	const ENTRY_TYPE_ERROR = "E";
	const ENTRY_TYPE_SUCCESS = "S";
	const LOG_TYPE_GENERAL = "GEN";
	const LOG_TYPE_EMAIL = "EML";
	const LOG_TYPE_PAYPAL = "PPL";
	const LOG_TYPE_OTHER = "OTH";
	const STATUS_FAILED = "F";
	const STATUS_SUCCESS = "S";
	
	function __construct() {
		parent::__construct();
		$this->SetValidation();
		$this->tableName           = "debug_log";
		$this->primaryKey          = "id";
		$this->uniqueKey           = array();
		$this->multiKey            = array( array( "entry_type" ) );
		$this->autoIncField        = array( "id" );
		$this->ENTRY_TYPE_PROPERTY = new DebugEntryType();
	}
	
	
	function SetValidation() {
		$this->validations = array(
			"id"         => array( "Text" => "Id", "Rule" => "max_length[11]|integer" ),
			"entry_type" => array( "Text" => "Entry Type", "Rule" => "max_length[1]" ),
			"log_type"   => array( "Text" => "Log Type", "Rule" => "max_length[4]" ),
			"title"      => array( "Text" => "Title", "Rule" => "required|max_length[255]" ),
			"log_data"   => array( "Text" => "Log Data", "Rule" => "" ),
			"status"     => array( "Text" => "Status", "Rule" => "max_length[1]" ),
			"entry_time" => array( "Text" => "Entry Time", "Rule" => "max_length[20]" )
		
		);
	}
	
	public function GetPropertyRawOptions( $property, $isWithSelect = false ) {
		$returnObj = array();
		switch ( $property ) {
			case "entry_type":
				$returnObj = array( "E" => "Error", "S" => "Success" );
				break;
			case "log_type":
				$returnObj = array( "GEN" => "General", "EML" => "Email", "OTH" => "Others", "PPL" => "PayPal" );
				break;
			case "status":
				$returnObj = array( "F" => "Failed", "S" => "Success" );
				break;
			default:
		}
		if ( $isWithSelect ) {
			return array_merge( array( "" => "Select" ), $returnObj );
		}
		
		return $returnObj;
		
	}
	
	public function GetPropertyOptionsColor( $property ) {
		$returnObj = array();
		switch ( $property ) {
			case "entry_type":
				$returnObj = array( "E" => "danger", "S" => "success" );
				break;
			case "log_type":
				$returnObj = array( "GEN" => "success", "EML" => "success", "OTH" => "success", "PPL" => "info" );
				break;
			case "status":
				$returnObj = array( "F" => "danger", "S" => "success" );
				break;
			default:
		}
		
		return $returnObj;
		
	}
	
	public function GetPropertyOptionsIcon( $property ) {
		$returnObj = array();
		switch ( $property ) {
			case "entry_type":
				$returnObj = array( "E" => "fa fa-times-circle-o", "S" => "fa fa-check-circle-o" );
				break;
			case "log_type":
				$returnObj = array( "GEN" => "", "EML" => "", "OTH" => "", "PPL" => "fa fa-paypal text-info" );
				break;
			case "status":
				$returnObj = array( "F" => "fa fa-times-circle-o", "S" => "fa fa-check-circle-o" );
				break;
			default:
		}
		
		return $returnObj;
		
	}
	
	//auto generated
	/*function Save(){
		return parent::Save();
	}*/
	
	
	/* add custom function here*/
	static function ClearAll() {
		$thisobj = new self();
		if ( $thisobj->GetUpdateDB()->query( "DELETE FROM ".$thisobj->tableName ) ) {
			if ( $thisobj->GetUpdateDB()->affected_rows() > 0 ) {
				return true;
			}
		}
		return false;
	}
	
	function doFieldValueFilter( $property, &$value, $isXsClean = true ) {
		switch ( $property ) {
			case "title":
				if ( strlen( $value ) > 255 ) {
					$value = substr( $value, 0, 250 ) . "...";
				}
				break;
			default:
				break;
		}
		
	}
	
	/**
	 * @param string $log_type
	 * @param string $title
	 * @param string $status
	 * @param string $entry_type
	 */
	static function AddLog( $log_type, $title, $status, $entry_type, $fullLog = '' ) {
		if ( ! is_string( $fullLog ) ) {
			$fullLog = json_encode( $fullLog );
		}
		$fullLog = htmlentities( $fullLog );
		$obj     = new self();
		$obj->log_type( $log_type );
		$obj->log_data( $fullLog );
		$obj->title( $title );
		$obj->status( $status );
		$obj->entry_type( $entry_type );
		
		return $obj->Save();
	}
	
	static function AddEmailLog( $title, $status, $entry_type, $fullLog = '' ) {
		return self::AddLog( self::LOG_TYPE_EMAIL, $title, $status, $entry_type, $fullLog );
	}
	
	static function AddPaypalLog( $title, $status, $entry_type, $fullLog = '' ) {
		return self::AddLog( self::LOG_TYPE_PAYPAL, $title, $status, $entry_type, $fullLog );
	}
	
	static function AddGeneralLog( $title, $status, $entry_type, $fullLog = '' ) {
		return self::AddLog( self::LOG_TYPE_GENERAL, $title, $status, $entry_type, $fullLog );
	}
	
	static function AddOtherLog( $title, $status, $entry_type, $fullLog = '' ) {
		return self::AddLog( self::LOG_TYPE_OTHER, $title, $status, $entry_type, $fullLog );
	}
	
	/* end custom function */
	function GetAddForm( $label_col = 5, $input_col = 7, $mainobj = NULL, $except = array(), $disabled = array() ) {
		
		if ( ! $mainobj ) {
			$mainobj = $this;
		}
		?>
		<?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="11"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */
		?>
		
		<?php if ( ! in_array( "entry_type", $except ) ) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="entry_type"><?php _e( "Entry Type" ); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <div class="inline radio-inline">
						<?php
							$entry_type_selected   = $mainobj->GetPostValue( "entry_type", "S" );
							$entry_type_isDisabled = in_array( "entry_type", $disabled );
							GetHTMLRadioByArray( "Entry Type", "entry_type", "entry_type", true, $mainobj->GetPropertyRawOptions( "entry_type" ), $entry_type_selected, $entry_type_isDisabled );
						?>
						<?php /*<span class="form-group-help-block"><?php _e("entry_type");?></span>	*/ ?>
                    </div>
                </div>
            </div>
		<?php } ?>
		
		<?php if ( ! in_array( "log_type", $except ) ) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="log_type"><?php _e( "Log Type" ); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <select class="form-control"
                            id="log_type" <?php echo in_array( "log_type", $disabled ) ? ' disabled="disabled" ' : ' name="log_type" '; ?>
                            data-bv-notempty="true"
                            data-bv-notempty-message="<?php _e( "%s is required", __( "Log Type" ) ); ?>">
						<?php $log_type_selected = $mainobj->GetPostValue( "log_type", "GEN" );
							GetHTMLOptionByArray( $mainobj->GetPropertyRawOptions( "log_type", true ), $log_type_selected );
						?>

                    </select>
					<?php /*<span class="form-group-help-block"><?php _e("log_type");?></span>	*/ ?>
                </div>
            </div>
		<?php } ?>
		
		<?php if ( ! in_array( "title", $except ) ) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="title"><?php _e( "Title" ); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <input type="text" maxlength="255" value="<?php echo $mainobj->GetPostValue( "title" ); ?>"
                           class="form-control"
                           id="title" <?php echo in_array( "title", $disabled ) ? ' disabled="disabled" ' : ' name="title" '; ?>
                           placeholder="<?php _e( "Title" ); ?>" data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e( "%s is required", __( "Title" ) ); ?>">
					<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/ ?>
                </div>
            </div>
		<?php } ?>
		
		<?php if ( ! in_array( "log_data", $except ) ) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="log_data"><?php _e( "Log Data" ); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <input type="text" maxlength="" value="<?php echo $mainobj->GetPostValue( "log_data" ); ?>"
                           class="form-control"
                           id="log_data" <?php echo in_array( "log_data", $disabled ) ? ' disabled="disabled" ' : ' name="log_data" '; ?>
                           placeholder="<?php _e( "Log Data" ); ?>" data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e( "%s is required", __( "Log Data" ) ); ?>">
					<?php /*<span class="form-group-help-block"><?php _e("log_data");?></span>	*/ ?>
                </div>
            </div>
		<?php } ?>
		
		<?php if ( ! in_array( "status", $except ) ) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="status"><?php _e( "Status" ); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <select class="form-control"
                            id="status" <?php echo in_array( "status", $disabled ) ? ' disabled="disabled" ' : ' name="status" '; ?>
                            data-bv-notempty="true"
                            data-bv-notempty-message="<?php _e( "%s is required", __( "Status" ) ); ?>">
						<?php $status_selected = $mainobj->GetPostValue( "status", "S" );
							GetHTMLOptionByArray( $mainobj->GetPropertyRawOptions( "status", true ), $status_selected );
						?>

                    </select>
					<?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/ ?>
                </div>
            </div>
		<?php } ?>
		
		<?php if ( ! in_array( "entry_time", $except ) ) { ?>
            <div class="form-group">
                <label class="control-label col-md-<?php echo $label_col; ?>"
                       for="entry_time"><?php _e( "Entry Time" ); ?></label>
                <div class="col-md-<?php echo $input_col; ?>">
                    <input type="text" maxlength="20" value="<?php echo $mainobj->GetPostValue( "entry_time" ); ?>"
                           class="form-control"
                           id="entry_time" <?php echo in_array( "entry_time", $disabled ) ? ' disabled="disabled" ' : ' name="entry_time" '; ?>
                           placeholder="<?php _e( "Entry Time" ); ?>" data-bv-notempty="true"
                           data-bv-notempty-message="<?php _e( "%s is required", __( "Entry Time" ) ); ?>">
					<?php /*<span class="form-group-help-block"><?php _e("entry_time");?></span>	*/ ?>
                </div>
            </div>
		<?php } ?>
		
		<?php
	}
	
	
}
class DebugEntryType{
    const ERROR="E";
    const SUCCESS="S";
}
?>