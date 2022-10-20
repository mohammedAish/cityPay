<?php 			
/** 
 * @since: 13/Jun/2018
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,ref_id,ref_type,user_id,note,entry_date		
 */						
class Madmin_note extends APP_Model{	
	public $id;
	public $ref_id;
	public $ref_type;
	public $user_id;
	public $note;
	public $entry_date;


	    /**
	     *@property id,ref_id,ref_type,user_id,note,entry_date
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="admin_note";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"ref_id"=>array("Text"=>"Ref Id", "Rule"=>"max_length[10]|integer"),
			"ref_type"=>array("Text"=>"Ref Type", "Rule"=>"max_length[1]"),
			"user_id"=>array("Text"=>"User Id", "Rule"=>"max_length[2]"),
			"note"=>array("Text"=>"Note", "Rule"=>"required|max_length[255]"),
			"entry_date"=>array("Text"=>"Entry Date", "Rule"=>"max_length[20]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false){
	    $returnObj=array();
		switch ($property) {
	      case "ref_type":        
	         $returnObj=array("T"=>"This Ticket","U"=>"Client (User)");
	         break;
	      default:
	    }	        	   
        if($isWithSelect){
            return array_merge(array(""=>"Select"),$returnObj);
        }
        return $returnObj;
		
	}

	public function GetPropertyOptionsColor($property){
	    $returnObj=array();
		switch ($property) {
	      case "ref_type":
	         $returnObj=array("T"=>"success","U"=>"success");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}

	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      case "ref_type":
	         $returnObj=array("T"=>"","U"=>"");
	         break;
	      default:
	    }
        return $returnObj;
	
	}		
	    	
	//auto generated
    function Save(){
		    $this->entry_date(date('Y-m-d H:i:s'));
	    return parent::Save();
	}
			


/* add custom function here*/


    /**
     * @param string $user_id
     * @param string $ticket_id
     * @return self[]
     */
    static function GetAdminNotes($client_id='', $ticket_id=''){
        if(empty($client_id) && empty($ticket_id)){
            return [];
        }

        $where="";
        if(!empty($client_id) && !empty($ticket_id)){
            $where="(admin_note.ref_id='$client_id' AND admin_note.ref_type='U') OR (admin_note.ref_id='$ticket_id' AND admin_note.ref_type='T')";
        }elseif(!empty($client_id)){
            $where="(admin_note.ref_id='$client_id' AND admin_note.ref_type='U')";
        }elseif(!empty($ticket_id)){
            $where="(admin_note.ref_id='$ticket_id' AND admin_note.ref_type='T')";
        }
	    $query="SELECT admin_note.ref_id, admin_note.ref_type,admin_note.note,admin_note.entry_date,app_user.`user`,app_user.title as admin_title,admin_note.user_id,role_list.title AS role_title
                FROM admin_note  LEFT JOIN app_user ON admin_note.user_id = app_user.id  LEFT JOIN role_list ON app_user.role = role_list.role_id
                WHERE $where ORDER BY entry_date";
        $obj=new self();
        $result=$obj->SelectQuery($query);

        $user_notes=[];
        $ticket_notes=[];
        if(count($result)>0) {
            foreach ($result as $item) {
                if($item->ref_type=="U"){
                    $user_notes[]=$item;
                }else{
                    $ticket_notes[]=$item;
                }
            }
        }
        return array_merge($user_notes,$ticket_notes);
    }
/* end custom function */
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php /*if(!in_array("id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="id"><?php _e("Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			

			
			<?php if(!in_array("ref_type",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="ref_type"><?php _e("Note On"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<div class="inline radio-inline">
			        <?php 
			            $ref_type_selected= $mainobj->GetPostValue("ref_type","T");
			            $ref_type_isDisabled=in_array("ref_type", $disabled);
			            GetHTMLRadioByArray("Note on","ref_type","ref_type",true,$mainobj->GetPropertyRawOptions("ref_type"),$ref_type_selected,$ref_type_isDisabled);
			            ?>
			        <?php /*<span class="form-group-help-block"><?php _e("ref_type");?></span>	*/?>
			       </div> 
		      	</div>
		      </div> 
		     <?php } ?>

			<?php if(!in_array("note",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="note"><?php _e("Note"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
                    <textarea maxlength="255" class="form-control" id="note" <?php echo in_array("note", $disabled)?' disabled="disabled" ':' name="note" ';?>     placeholder="<?php _e("Note");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Note"));?>"><?php echo  $mainobj->GetPostValue("note");?></textarea>
			     		<?php /*<span class="form-group-help-block"><?php _e("note");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>