<?php 			
/**
 * Version 1.0.0
 * Creation date: 23/Oct/2016
 * @Written By: S.M. Sarwar Hasan
 * Appsbd
 * DB Properties:res_id,title,controller,method,status		
 */						
class Mpage_list extends APP_Model{	
    public $res_id;
	public $title;
	public $controller_title;
	public $directory;
	public $controller;
	public $method;
	public $panel;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="page_list";
			$this->primaryKey="res_id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->res_id=$this->title=$this->controller_title=$this->directory=$this->controller=null;
		$this->method=$this->panel=$this->status=null;

	}
	function SetValidation(){
		$this->validations=array(
			"res_id"=>array("Text"=>"Res Id", "Rule"=>"required|max_length[2]"),
			"title"=>array("Text"=>"Title", "Rule"=>"required|max_length[50]"),
			"controller_title"=>array("Text"=>"Controller Title", "Rule"=>"required|max_length[150]"),
			"directory"=>array("Text"=>"Directory", "Rule"=>"max_length[50]"),
			"controller"=>array("Text"=>"Controller", "Rule"=>"required|max_length[50]"),
			"method"=>array("Text"=>"Method", "Rule"=>"required|max_length[40]"),
			"panel"=>array("Text"=>"Panel", "Rule"=>"max_length[1]"),
			"status"=>array("Text"=>"Status", "Rule"=>"max_length[1]")
			
		);
	}
    static function AddUpdatePage($status,$directory,$controller,$method,$title,$controller_title,$panel="A")
    {
        $controller = str_replace("_", "-", $controller);
        $method = str_replace("_", "-", $method);
        $oldPage = self::FindBy("directory", $directory, ["controller" => $controller, "method" => $method]);
        $n = new self();
        $n->title($title);
        $n->controller_title($controller_title);
        $n->directory($directory);
        $n->controller($controller);
        $n->method($method);
        $n->panel($panel);
        $n->status($status);
        if ($oldPage) {
            $n->SetWhereCondition("res_id", $oldPage->res_id);
            return $n->Update();
        } else {
            $resid = $n->GetNewIncId("res_id", "AA");
            $n->res_id($resid);
            return $n->Save();
        }

    }
	static function AddNewPage($title,$controller,$method,$contoller_title="",$directory="",$panel="A"){
	    $controller=str_replace("_", "-", $controller);
	    $method=str_replace("_", "-",$method);
	    $directory=trim($directory);
	    $directory=rtrim($directory,'/');
	    if(empty($contoller_title)){
	        $contoller_title=str_replace("-", " ", $controller);
	        if(function_exists("ucwords")){
	            $controller_title=ucwords($contoller_title);
	        }
	    }
	    if(function_exists("ucwords")){
	        $title=ucwords($title);
	    }
	    $n=new self();
	    $resid=$n->GetNewIncId("res_id", "AA");
	    $n->res_id($resid);
	    $n->title($title);
	    $n->controller_title($contoller_title); 
	    $n->directory($directory);
	    $n->controller($controller);
	    $n->method($method);
	    $n->panel($panel);
	    return $n->Save();
	}
    static function DeleteAddonResources($addon_slug){
		    $mp=Mpage_list::FindAllBy("controller",$addon_slug);
		    if(!empty($mp) && count($mp)>0){
                foreach ($mp as $item) {
                   Mrole_access::ClearAccessByResource($item->res_id);
		        }
            }
    }
	static function getUniqueController($status='',$panel=''){
	    if(!empty($status)){
	        $status=" AND (status='{$status}') ";
	    } 
	    if(!empty($panel)){
	        $panel=" AND (panel='{$panel}') ";
	    }
	    $query="select DISTINCT controller_title as controller from page_list
				where (controller NOT REGEXP 'confirm-response|data-center') {$status} {$panel}
				order by controller";
	    $thisobj=new self();
	    return $thisobj->SelectQuery($query);
	
	}
	static function getUniqueControllerKeyValueArray($isWithStar=false,$status='',$panel=''){
	    $data=self::getUniqueController($status,$panel);
	    $return=array();
	    if($isWithStar)	{
	        $return['*']="All";
	    }
	    if($data){
	        foreach ($data as $co){
	            $return[$co->controller]=$co->controller;
	        }
	    }
	    return $return;
	
	
	}

	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("res_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="res_id"><?php _e("Res Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="2"  value="<?php echo  $mainobj->GetPostValue("res_id");?>" class="form-control" id="res_id" name="res_id" placeholder="<?php _e("Res Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Res Id"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="title"><?php _e("Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="50"  value="<?php echo  $mainobj->GetPostValue("title");?>" class="form-control" id="title" name="title" placeholder="<?php _e("Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			<?php if(!in_array("controller_title",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="controller"><?php _e("Controller Title"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="150"  value="<?php echo  $mainobj->GetPostValue("controller_title");?>" class="form-control" id="controller_title" name="controller_title" placeholder="<?php _e("Controller Title"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("controller Title"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			<?php if(!in_array("controller",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="controller"><?php _e("Controller"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="25"  value="<?php echo  $mainobj->GetPostValue("controller");?>" class="form-control" id="controller" name="controller" placeholder="<?php _e("Controller"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Controller"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("method",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="method"><?php _e("Method"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="40"  value="<?php echo  $mainobj->GetPostValue("method");?>" class="form-control" id="method" name="method" placeholder="<?php _e("Method"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Method"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("status");?>" class="form-control" id="status" name="status" placeholder="<?php _e("Status"); ?>" >
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>