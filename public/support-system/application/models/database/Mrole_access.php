<?php 			
/**
 * Version 1.0.0
 * Creation date: 23/Oct/2016
 * @Written By: S.M. Sarwar Hasan
 * Appsbd
 * DB Properties:pvid,role_id,res_id,status		
 */						
class Mrole_access extends APP_Model{	
	public $pvid;
	public $role_id;
	public $res_id;
	public $status;


		function __construct() {
			parent::__construct ();
			$this->SetValidation();	
			$this->tableName="role_access";
			$this->primaryKey="res_id";
			$this->uniqueKey=array();	
			$this->multiKey=array();
			$this->autoIncField=array();	
		}
			
	 function Reset(){
		$this->pvid=$this->role_id=$this->res_id=$this->status=null;

	}



	function SetValidation(){
		$this->validations=array(
			"pvid"=>array("Text"=>"Pvid", "Rule"=>"required|max_length[4]"),
			"role_id"=>array("Text"=>"Role Id", "Rule"=>"required|max_length[2]"),
			"res_id"=>array("Text"=>"Res Id", "Rule"=>"required|max_length[8]"),
			"status"=>array("Text"=>"Status", "Rule"=>"")
			
		);
	}
	static function CopyAccess($fromRole,$toRole,&$total=0,&$copied=0){	    
	    $isok=true;
	    if(empty($fromRole)){
	        $isok=false;
	        AddError("From Role is required");
	    }
	     
	    if(empty($toRole)){
	        $isok=false;
	        AddError("To Role is required");
	    }
	    if($isok){
	        if($fromRole!=$toRole){
	            $allRole=self::FindAllBy("role_id", $fromRole);
	            $total=count($allRole);
	            self::ClearAccessByRole($toRole);
	            $copied=0;
	            foreach ($allRole as $fr){
	                $ob=new Mrole_access();
	                $ob->pvid($fr->pvid);
	                $ob->role_id($toRole);
	                $ob->res_id($fr->res_id);
	                $ob->status($fr->status);
	                if($ob->Save()){
	                    $copied++;
	                }
	            }
	        	return true;
	        }else{
	            AddError("From and To Role are same");
	            return false;
	        }
	    }
	    return false;
	}
	static function ClearAccessByRole($role_id){
	    if(empty($role_id)){	        
	        AddError("Role is required");
	        return false;
	    }
	    return parent::DeleteByKeyValue("role_id", $role_id,true);
	}
    static function ClearAccessByResource($res_id){
        if(empty($res_id)){
            return false;
        }
        return parent::DeleteByKeyValue("res_id", $res_id,true);
    }
	static function GetRoleAccessArrayByRoleId($roleId,$status='A'){
	    $thisobj=new self();
	    $rolearray=$thisobj->GetPublicPages(true);	   
	    $thisobj->role_id($roleId);
	    $thisobj->status('Y');
	
	    $resource=new Mpage_list();
	    $thisobj->Join($resource, "res_id", "res_id");
	
	
	    $productAccessList=$thisobj->SelectAll("*,directory,controller,method");
	    self::processAccessList($rolearray, $productAccessList);
	    $productAccessList2=Mpage_list::FindAllBy("status", "S",["panel"=>"A"]);
	    self::processAccessList($rolearray, $productAccessList2);
        $rolearray=AddOnManager::DoFilter("allowed-role-access",$rolearray,$roleId);
	    return  $rolearray;
	}
	private static function processAccessList(&$rolearray,$productAccessList){
	    if($productAccessList && count($productAccessList)>0){
	        foreach ($productAccessList as $role){
	            $role->directory=!empty($role->directory)?$role->directory."/":"";
	            $rolearray[]=get_route_unique_id($role->directory.$role->controller."/".$role->method);
	        }
	    }
	    
	}
	/**
	 * @param bool $isHashCodeArray
	 * @return multitype:string |Ambigous <string, NULL, multitype:>|multitype:
	 */
	function GetPublicPages($isHashCodeArray=false){
	    $this->config->load("public_page_list");
	    $ppagelist=$this->config->item("public_page_list",FALSE,TRUE);
	    if(is_array($ppagelist)){
	        if($isHashCodeArray){
	            $hasharray=array();
	            foreach ($ppagelist as $pp){
	                $hasharray[]=get_route_unique_id($pp);
	            }
	            return $hasharray;
	        }
	        return $ppagelist;
	    }
	    return array();
	}
	static function getAllRoleAccess($limit = "", $limitStart = "0",&$rolelist=NULL,$srcProperty="",$searchValue="",$panel='',$status=''){
	    $rolelist=Mrole_list::FetchAll('','grade','ASC');
	    $select="SELECT pl.res_id,pl.title,pl.controller_title,";
	    foreach ($rolelist as $role){
	        $select	.=" Max(IF(ra.role_id='{$role->role_id}',ra.status,'N')) AS {$role->role_id},";
	    }
	    $where="";
	    if(!empty($srcProperty) && !empty($searchValue)){
	        $where=" WHERE  pl.controller_title='{$searchValue}'";
	    }
	    if(!empty($panel)){
	        if(empty($where)){
	            $where=" WHERE pl.panel='{$panel}'";
	        }else{
	           $where.=" AND pl.panel='{$panel}'";
	        }
	    }
	    if(!empty($status)){
		    if(empty($where)){
		    	$where=" WHERE pl.status='{$status}'";
		    }else{
		    	$where.=" AND pl.status='{$status}'";
		    }
	    }
	    $select=rtrim($select,",");
	    $select.=" FROM page_list as pl
		LEFT JOIN role_access as ra  ON ra.res_id=pl.res_id
	    {$where}
		GROUP BY pl.res_id
		ORDER BY  pl.controller_title,pl.res_id";
	    if(!empty($limit)){
	        if(!empty($limitStart)){
	            $select.=" LIMIT $limitStart,$limit";
	        }else{
	            $select.=" LIMIT $limit";
	        }
	    }
	    //die($select);
	    $ss=new static();
        $result=$ss->SelectQuery($select);
        $result= AddOnManager::DoFilter("role-page-list",$result,$rolelist);
        function cmp($a, $b) {
            return strcmp($a->controller_title, $b->controller_title);
        }
        usort($result, "cmp");
	    return $result;
	}
	 function GetAddForm($label_col=5,$input_col=7,$mainobj=null,$except=array()){
		
				if(!$mainobj){
				$mainobj=$this;
				}
					?>
			<?php if(!in_array("pvid",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="pvid"><?php _e("Pvid"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="4"  value="<?php echo  $mainobj->GetPostValue("pvid");?>" class="form-control" id="pvid" name="pvid" placeholder="<?php _e("Pvid"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Pvid"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("role_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="role_id"><?php _e("Role Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("role_id");?>" class="form-control" id="role_id" name="role_id" placeholder="<?php _e("Role Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Role Id"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("res_id",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="res_id"><?php _e("Res Id"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="8"  value="<?php echo  $mainobj->GetPostValue("res_id");?>" class="form-control" id="res_id" name="res_id" placeholder="<?php _e("Res Id"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Res Id"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php if(!in_array("status",$except)){ ?>
			 <div class="form-group">
		      	<label class="control-label col-md-<?php echo $label_col;?>" for="status"><?php _e("Status"); ?></label>
		      	<div class="col-md-<?php echo $input_col;?>">                   			     	
		      		<input type="text" maxlength="1"  value="<?php echo  $mainobj->GetPostValue("status");?>" class="form-control" id="status" name="status" placeholder="<?php _e("Status"); ?>" data-bv-notempty="true" 	data-bv-notempty-message="<?php  _e("%s is required",__("Status"));?>">
		      	</div>
		      </div> 
		     <?php } ?>
			
			<?php 
	}


}
?>