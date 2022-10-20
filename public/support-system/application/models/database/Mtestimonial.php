<?php 			
/** 
 * @since: 06/Aug/2020
 * @author: Sarwar Hasan 
 * @version 1.0.0
 * @property:id,name,designation,testimonial,entry_date,status		
 */						
class Mtestimonial extends APP_Model{
	public $id;
	public $name;
	public $designation;
	public $testimonial;
	public $entry_date;
	public $status;
	private static $isLoadedOnce=false;
	private static $active_testimonials=null;
	
	
	/**
	     *@property id,name,designation,testimonial,entry_date,status
		 */
		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="testimonial";
			$this->primaryKey="id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array("id");	
			
		}
			

	function SetValidation(){
		$this->validations=array(
			"id"=>array("Text"=>"Id", "Rule"=>"max_length[10]|integer"),
			"name"=>array("Text"=>"Name", "Rule"=>"required|max_length[255]"),
			"designation"=>array("Text"=>"Designation", "Rule"=>"required|max_length[255]"),
			"testimonial"=>array("Text"=>"Testimonial", "Rule"=>"required"),
			"entry_date"=>array("Text"=>"Entry Date", "Rule"=>"max_length[20]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}
	static function get_user_image_url($id,$isVersionAdd=false){
		    $path=self::get_user_testimonial_path($id);
		if(!empty($id) && file_exists($path)){
			if($isVersionAdd){
				$ftime=filemtime($path);
				return base_url("/data/testimonial/$id.jpg?v=".$ftime);
			}else{
				
				return base_url("data/testimonial/$id.jpg");
			}
		}
		return base_url("images/no-image.png");
	}
	static function get_user_testimonial_path($id){
		$path=FCPATH."/data/testimonial/";
		if(app_make_dir($path)){
		
		}
		return $path.DIRECTORY_SEPARATOR.$id.".jpg";
	}
	static function upload_testimonial_photo($post_name,$id){
		$userpath=self::get_user_testimonial_path($id);
		if(move_upload_file_if_ok($post_name, $userpath)){
			$objthis=new self();
			$objthis->load->library("SimpleImage");
			$m = new SimpleImage($userpath);
			$m->thumbnail(100, 100, 'center');
			$m->save();
			return true;
		}else{
			return false;
		}
	}
	public function GetPropertyRawOptions($property,$isWithSelect=false){
		$returnObj=array();
		switch ($property) {
			case "status":
				$returnObj=array("A"=>"Active","I"=>"Inactive");
				break;
			default:
		}
		if($isWithSelect){
			return array_merge(array(""=>"Select"),$returnObj);
		}
		return $returnObj;
		
	}
	public function GetPropertyOptionsColor( $property ) {
		$returnObj=array();
		switch ($property) {
			case "status":
				$returnObj=array("A"=>"success","I"=>"danger");
				break;
			default:
		}
		return $returnObj;
	}
	
	
	
	
	//auto generated
   public static function getItem($name,$designation,$testimonial) {
	    $obj=new self();
	    $obj->name=$name;
	    $obj->designation=$designation;
	    $obj->testimonial=$testimonial;
	    return $obj;
   }
	
	public static function getActiveTestimonials() {
		    if(!self::$isLoadedOnce) {
			    $tst = new Mtestimonial();
			    $tst->status( 'A' );
			    self::$active_testimonials = $tst->SelectAll( '', 'id', 'desc' );
			    self::$isLoadedOnce=true;
		    }
		return self::$active_testimonials;
	}

/* add custom function here*/
	
/* end custom function */
	 function GetAddForm($label_col=4,$input_col=8,$mainobj=null,$except=array(),$disabled=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<div class="row">
                <div class="col-md-8">
	                <?php if(!in_array("status",$except)){ ?>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="status"><?php _e("Status"); ?></label>
                            <div class="col-md-9">

                                <div class="togglebutton ">
                                    <input  name="status" value="I" type="hidden">
                                    <label>
                                        <input  type="checkbox" <?php echo $mainobj->GetPostValue("status","'A'") == "A" ? "checked" : ""?>  value="A" class="" id="status" <?php echo in_array("status", $disabled)?' disabled="disabled" ':' name="status" ';?>   >

                                    </label>
                                </div>

                            </div>
                        </div>
	                <?php } ?>
	                <?php if(!in_array("name",$except)){ ?>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="name"><?php _e("Name"); ?></label>
                            <div class="col-md-9">
                                <input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("name");?>" class="form-control" id="name" <?php echo in_array("name", $disabled)?' disabled="disabled" ':' name="name" ';?>     placeholder="<?php _e("Name");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Name"));?>">
                            </div>
                        </div>
	                <?php } ?>
	
	                <?php if(!in_array("designation",$except)){ ?>
                        <div class="form-group">
                            <label class="control-label col-md-3" for="designation"><?php _e("Designation"); ?></label>
                            <div class="col-md-9">
                                <input type="text" maxlength="255"   value="<?php echo  $mainobj->GetPostValue("designation");?>" class="form-control" id="designation" <?php echo in_array("designation", $disabled)?' disabled="disabled" ':' name="designation" ';?>     placeholder="<?php _e("Designation");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Designation"));?>">
                            </div>
                        </div>
	                <?php } ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        <div class="col-md-12 text-center">
                            <img class="app-image-input img-thumbnail" data-name="user_img" src="<?php echo Mtestimonial::get_user_image_url($mainobj->id,true);?>" style="width:108px; height: 108px;"/>
                            <span class="form-group-help-block text-center"><?php _e("Click on the Image to change");?><br/> <?php _e("Best size is 100px X 100px");?></span>
                        </div>
                    </div>
                </div>
			
            </div>
		 
			<?php if(!in_array("testimonial",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="testimonial"><?php _e("Testimonial"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">
                    <textarea type="text" maxlength="600" style="height: 250px" class="form-control" id="testimonial" <?php echo in_array("testimonial", $disabled)?' disabled="disabled" ':' name="testimonial" ';?>     placeholder="<?php _e("Testimonial");?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Testimonial"));?>"><?php echo  $mainobj->GetPostValue("testimonial");?></textarea>
			     		<?php /*<span class="form-group-help-block"><?php _e("testimonial");?></span>	*/?>
		      	</div>
		      </div> 
		     <?php } ?>
       
		
			
			<?php 
	}


}
?>