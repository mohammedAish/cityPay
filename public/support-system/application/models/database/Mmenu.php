<?php 			
/**
 * Version 1.0.0
 * Creation date: 28/Nov/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 * DB Properties:id,parent_id,title,href,text_icon,view_counter,is_new_window,status		
 */						
class Mmenu extends APP_Model{	
	public $id;
	public $parent_id;
	public $title;
	public $href_type;
	public $href;
	public $text_icon;
	public $view_counter;
	public $is_new_window;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="menu";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"parent_id"=>array("Text"=>"Parent Id", "Rule"=>"max_length[10]|integer"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[100]"),
			"href_type"=>array("Text"=>"Href Type", "Rule"=>"max_length[1]"),
			"href"=>array("Text"=>"Href", "Rule"=>"required|max_length[255]"),
			"text_icon"=>array("Text"=>"Text Icon", "Rule"=>"max_length[50]"),
			"view_counter"=>array("Text"=>"View Counter", "Rule"=>"max_length[10]|integer"),
			"is_new_window"=>array("Text"=>"Is New Window", "Rule"=>"max_length[1]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}

	public function GetPropertyRawOptions($property,$isWithSelect=false) {
		$returnObj = array();
		switch ( $property ) {
			case "href_type":
				$returnObj = array( "L" => "Link", "P" => "Page" );
				break;
			case "is_new_window":
				$returnObj = array( "Y" => "Yes", "N" => "No" );
				break;
			case "status":
				$returnObj = array( "A" => "Active", "I" => "Inactive" );
				break;
			default:
		}
		if ( $isWithSelect ) {
			return array_merge( array( "" => "Select" ), $returnObj );
		}
		
		return $returnObj;
		
	}

    
	public function GetPropertyOptionsColor($property){
	    $returnObj=array();
		switch ($property) {
	      case "status":        
	         $returnObj=array("A"=>"success","I"=>"danger");
	         break;
	      default:
	    }       
        return $returnObj;
	
	}
    
	   

    /*
	public function GetPropertyOptionsIcon($property){
	    $returnObj=array();
		switch ($property) {
	      default:
	    }
        return $returnObj;
	
	}
    */
	   		
	    	
	//auto generated
    /*function Save(){			   
	    return parent::Save();
	}*/
			


/* add custom function here*/
	public static function DeleteById($id){
	    return parent::DeleteByKeyValue("id", $id);
	}
	public static function increase_viewcount($id){
	   $obj=new self();
	   $obj->view_counter("view_counter+1",true);
	   $obj->SetWhereCondition("id", $id);
	   return $obj->Update();
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
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("id");?>" class="form-control" id="id" <?php echo in_array("id", $disabled)?' disabled="disabled" ':' name="id" ';?>     placeholder="<?php _e("Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php /* if(!in_array("parent_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="parent_id"><?php _e("Parent Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="10"   value="<?php echo  $mainobj->GetPostValue("parent_id");?>" class="form-control" id="parent_id" <?php echo in_array("parent_id", $disabled)?' disabled="disabled" ':' name="parent_id" ';?>     placeholder="<?php _e("Parent Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Parent Id"));?>">
			     		
		      	</div>
		      </div> 
		     <?php } */?>
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="100"   value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control " id="title" <?php echo in_array("title", $disabled)?' disabled="disabled" ':' name="title" ';?>     placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("title");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
		 <?php if(!in_array("href_type",$except)){ ?>
             <div class="form-group">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="href_type"><?php _e("Type"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <div class="inline radio-inline">
						 <?php
							 $href_type_selected= $mainobj->GetPostValue("href_type","L");
							 $href_type_isDisabled=in_array("href_type", $disabled);
							 GetHTMLRadioByArray("Href Type","href_type","href_type",true,$mainobj->GetPropertyOptions("href_type"),$href_type_selected,$href_type_isDisabled,false,"has_depend_fld");
						 ?>
						 <?php /*<span class="form-group-help-block"><?php _e("href_type");?></span>	*/?>
                     </div>
                 </div>
             </div>
		 <?php } ?>
			<?php if(!in_array("href",$except)){ ?>
			 <div class="form-group fld-href-type fld-href-type-l">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="href"><?php _e("Link"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<textarea maxlength="255"   class="form-control" id="href" <?php echo in_array("href", $disabled)?' disabled="disabled" ':' name="href" ';?>   data-bv-trigger="blur"  placeholder="<?php _e("URL"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Link"));?>"><?php echo  $mainobj->GetPostValue("href");?></textarea>
		      		<span class="form-group-help-block"><?php _e("Ex. http://xyz.com");?></span>
		      	</div>
		      </div>
             <div class="form-group fld-href-type fld-href-type-p">
                 <label class="control-label col-md-<?php echo $label_col;?>" for="hrefpage"><?php _e("Page"); ?></label>
                 <div class="col-md-<?php echo $input_col;?>">
                     <select    class="form-control" id="hrefpage" <?php echo in_array("href", $disabled)?' disabled="disabled" ':' name="href" ';?>  data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Page"));?>" >
                         <?php
                             $selected_page= $mainobj->GetPostValue("href");
                             $pageList=Mcustom_page::FindAllBy("status","A");
	                         GetHTMLOption("","Select");
                             foreach ($pageList as $p){
                                 GetHTMLOption("site/page/{$p->id}/{$p->slag_title}",$p->title,$selected_page);
                             }
                         ?>
                     </select>
                 </div>
             </div>
		 <?php } ?>
			<?php if(!in_array("text_icon",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="text_icon"><?php _e("Icon"); ?></label>
		      	<div class="col-md-4">                   			     	
		      		<input type="text" maxlength="50"   value="<?php echo  $mainobj->GetPostValue("text_icon");?>" class="form-control app-iconpicker" id="text_icon" <?php echo in_array("text_icon", $disabled)?' disabled="disabled" ':' name="text_icon" ';?>     placeholder="<?php _e("Text Icon"); ?>">
			     		<?php /*<span class="form-group-help-block"><?php _e("text_icon");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("is_new_window",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="is_new_window"><?php _e("Is New Window"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="is_new_window" value="N" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("is_new_window","N") == "Y" ? "checked" : ""?>  value="Y" class="" id="is_new_window" <?php echo in_array("is_new_window", $disabled)?' disabled="disabled" ':' name="is_new_window" ';?>   >
						 
					</label>
					<?php /*<span class="form-group-help-block"><?php _e("is_new_window");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		
			     <div class="togglebutton ">
				    <input  name="status" value="I" type="hidden">
					<label> 
					<input  type="checkbox" <?php echo $mainobj->GetPostValue("status","A") == "A" ? "checked" : ""?>  value="A" class="" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>   >
						 
					</label>
					<?php /*<span class="form-group-help-block"><?php _e("status");?></span>	*/?>		
				</div>			         
			         
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>