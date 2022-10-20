<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
/**
 * @author Sarwar
 * @ Last Updated: 23/OCT/2016
 */
class CORE_Model extends CI_Model {   
	protected $validations;
	protected $setProperties;
	protected $likesFields;
	protected $setOption;
	protected $updateWhereExtraField;
	protected $updateWhereExtraFieldOption=array();
	protected $tableName;
	protected $tableShortForm="";
	protected $autoIncField;
	protected $primaryKey;
	protected $uniqueKey;
	protected $multiKey;
	protected $MySqlError;
	protected $settedPropertyforLog = "";
	protected $htmlInputField = array ();
	protected $isWhereSet=false;
	protected $isValidationRule=false;
	protected $_app_name="";
	protected $checkCache=false;
	protected $cacheTime=300; //5 minitue
    protected $textDomain="";
	/**
	 * @var ObjectJoin[]
	 */
	protected $joinObjects=array();
	/**
	 * @var CI_DB_query_builder
	 */
	private static $db1;
	/**
	 * @var CI_DB_query_builder
	 */
	private static $db2;
	private $avoidCustomCheck=false;
	private $group_by=null;
	function __construct() {
		$this->_app_name=$this->config->item('app_name');
		$this->tableShortForm="";	
		$this->setProperties = array ();
		$this->setOption = array ();
		$this->updateWhereExtraField = array ();
		$this->updateWhereExtraFieldOption=array();
		$this->uniqueKey = array ();
		$this->multiKey = array ();		
		$this->autoIncField=array();
		$this->likesFields=array();		
	}
    protected function GetPropertyRawOptions($property, $isWithSelect = false){
        if($isWithSelect){
            return array(""=>"Select");
        }
	    return array();
	}
	public function GetPropertyOptions($property, $isWithSelect = false) {
		$returnobj = $this->GetPropertyRawOptions( $property, $isWithSelect );
		foreach ( $returnobj as &$v) {
			$v = __( $v );
		}
		return $returnobj;
	}
	public function GetPropertyOptionsColor($property){
		
		return array();
	}
	public function GetPropertyOptionsIcon($property){
	
		return array();
	}
	public function GetPropertyOptionsTag($property,$tag='span',$class_prefix='text-',$class_postfix='',$default=''){
		$properties=$this->GetPropertyOptions($property);
		if(count($properties)>0){
			$colors=$this->GetPropertyOptionsColor($property);
			$icons=$this->GetPropertyOptionsIcon($property);
			foreach ($properties as $key=>&$value){
				$color=!empty($colors[$key])?$colors[$key]:$default;
				$icon=!empty($icons[$key])?'<i class="'.$icons[$key].'"></i>':"";
				$value="<{$tag} class=\"{$class_prefix}{$color}{$class_postfix}\">{$icon} {$value}</{$tag}>";
			}
		}
		return $properties;
	}
	function CheckCache($setValue=true,$cacheTime=0){
		$is_cache=$this->config->item("custom_cache");
		if($is_cache){
			$this->checkCache=$setValue;
			if($cacheTime>0){
				$this->cacheTime=60*$cacheTime;
			}
		}
	}
	function settedPropertyforLog(){
	   return $this->settedPropertyforLog;
	}
	function setTableShortName($name){
		$this->tableShortForm=$name;
	}
	/**
	 * check the table name and othething
	 * @return boolean
	 */
	protected function CheckBasicCheck(){
		if (empty ( $this->tableName )){
			add_model_errors_code("E002");
			return false;
		}
		return true;
	}

	function __($string, $parameter = null, $_ = null){
		$args=func_get_args();
		if(empty($this->textDomain)){
			echo call_user_func_array("__",$args);
		}else{
			$args=array_unshift($args,$this->textDomain);
			echo call_user_func_array("__a",$args);
		}
    }
    function _e($string, $parameter = null, $_ = null){
        $args=func_get_args();
        if(empty($this->textDomain)){
	        echo call_user_func_array("_e",$args);
        }else{
	        array_unshift($args,$this->textDomain);
	        echo call_user_func_array("_ae",$args);
        }
      
    }
	function GetPostValue($name, $default = "",$isXsClean=true) {
	    $objdata=$this->$name;
		if (!empty ( $this->$name ) || ( is_string($objdata)&& $objdata."_-A"==="0_-A")) {
			$default = $this->$name;
		}
		$postvalue=$this->input->post($name,$isXsClean);		
		$this->doFieldValueFilter($name, $postvalue,$isXsClean);		
		return !empty($postvalue)?$postvalue:$default;
	}
	
	function AddGroupBy($key){
	    $this->group_by=$key;
	}
	
	protected function setCustomParamData(){
		if(count($this->setOption)==0)return;
		$tbname=$this->GetTableName().".";
		foreach ($this->setOption as $key=>$value){
			$this->$key=str_replace('[fld]', $tbname.$key, $this->$key);
			$this->setProperties[$key]=str_replace('[fld]', $tbname.$key, $this->setProperties[$key]);
		}
	}
	protected function onSaveUpdateEvent(){
		
	}
	
	/**
	 * It user for specific for setting, It could be based on session.
	 * @param array $alreadyadded	
	 * @param CI_DB_query_builder $db
	 */
	protected function SetCustomModelWhereProperties(){
		return;
	}
	function AvoidCustomModelWhereProperties($isAvoid=true){
		$this->avoidCustomCheck=$isAvoid;
	}
	/**
	 * @param unknown $extraParam
	 * @param string $isSelectDb
	 * @return boolean
	 */
	protected function SetDBSelectWhereProperties($extraParam=array(),$clear_properties=true,$isSelectDb=true){
		if(!$this->avoidCustomCheck){
			$this->SetCustomModelWhereProperties();
		}
		$alreadyadded=array();
		$tbname=$this->GetTableName().".";
		$this->setCustomParamData();
		if($isSelectDb){
			$db=$this->GetSelectDB();
		}else{
			$db=$this->GetUpdateDB();
		}
		if (empty ( $this->tableName ))return false;
		
		//primary key query
		$primaryKey=$this->primaryKey;
		if(!empty($primaryKey) && isset($this->setProperties[$primaryKey])){
			if (!empty ( $this->setOption [$primaryKey] )) {
				$db->where("(".$tbname.$primaryKey." ".$this->$primaryKey.")","",FALSE);
			} else {
				$db->where($tbname.$primaryKey,$this->$primaryKey);
			}
			$alreadyadded[]=$primaryKey;
			$this->isWhereSet=true;
		}
	    $generalKeys=array();
		// Unique Index key query
		if(count($this->uniqueKey)>0){
		    if(is_array($this->uniqueKey[0])){
		        $selectedKey="";
		        foreach ($this->uniqueKey as $pos=>$uk){	
		            $generalKeys=array_merge($generalKeys,$uk);
		            $isOk=true;
		            foreach ($uk as $fld){
		                if(!isset($this->setProperties[$fld])){
		                    $isOk=false;
		                    break;
		                }
		                		                
		            }
		           if($isOk){
		                 $selectedKey=$pos;
		           }
		        }
		        if($selectedKey!=""){
    		        foreach ($this->uniqueKey[$selectedKey] as $uk){
    		            if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
    		                if (!empty ( $this->setOption [$uk] )) {
    		                    $db->where("(".$tbname.$uk." ".$this->$uk.")","",FALSE);
    		                } else {
    		                    $db->where($tbname.$uk,$this->$uk);
    		                }
    		                $alreadyadded[]=$uk;
    		                $this->isWhereSet=true;
    		            }
    		        }
		        }
		    }else{
		        //for backword compatibility
        		foreach ($this->uniqueKey as $uk){
        			if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
        				if (!empty ( $this->setOption [$uk] )) {
        					$db->where("(".$tbname.$uk." ".$this->$uk.")","",FALSE);
        				} else {
        					$db->where($tbname.$uk,$this->$uk);
        				}
        				$alreadyadded[]=$uk;
        				$this->isWhereSet=true;
        			}
        		}
		    }
		}		
		
		// Other's key query
		if(count($this->multiKey)>0){
		    if(is_array($this->multiKey[0])){
		        $selectedKey="";
		        foreach ($this->multiKey as $pos=>$uk){
		            $generalKeys=array_merge($generalKeys,$uk);
		            $isOk=true;
		            foreach ($uk as $fld){
		                if(!isset($this->setProperties[$fld])){
		                    $isOk=false;
		                    break;
		                }
		        
		            }
		            if($isOk){
		                $selectedKey=$pos;
		            }
		        }
		        if($selectedKey!=""){
		            foreach ($this->multiKey[$selectedKey] as $uk){
		                if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
		                    if (!empty ( $this->setOption [$uk] )) {
		                        $db->where("(".$tbname.$uk.$this->setProperties[$uk].")","",FALSE);
		                    } else {
		                        $db->where($tbname.$uk,$this->setProperties[$uk]);
		                    }
		                    $alreadyadded[]=$uk;
		                    $this->isWhereSet=true;
		                }
		            }
		        }
		    }else{
		        //for backword compatibility
        		foreach ($this->multiKey as $uk){        		   
        			if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
        				if (!empty ( $this->setOption [$uk] )) {
        					$db->where("(".$tbname.$uk.$this->setProperties[$uk].")","",FALSE);
        				} else {
        					$db->where($tbname.$uk,$this->setProperties[$uk]);
        				}
        				$alreadyadded[]=$uk;
        				$this->isWhereSet=true;
        			}
        		}
		    }
		}
		
		//for GeneralKeys 
		foreach ($generalKeys as $uk){
		    if(!in_array($uk, $alreadyadded)) {
		        if(isset($this->setProperties[$uk])){
		            if (!empty ( $this->setOption [$uk] )) {
		                $db->where("(".$tbname.$uk." ".$this->$uk.")","",FALSE);
		            } else {
		                $db->where($tbname.$uk,$this->$uk);
		            }
		            $alreadyadded[]=$uk;
		            $this->isWhereSet=true;
		        }
		    }		    
		}
		
		foreach ( $this->setProperties as $key => $value ) {
			if (property_exists ( $this, $key ) && !in_array($key, $alreadyadded)) {
				if (!empty ( $this->setOption [$key] )) {
					$db->where("(".$tbname.$key." ".$this->$key.")","",FALSE);
				} else {
					$db->where($tbname.$key,$this->$key);
				}
				$alreadyadded[]=$key;
			}
		}
		foreach ( $extraParam as $key => $value ) {
			if (property_exists ( $this, $key ) && !in_array($key, $alreadyadded)) {
				if (!empty ( $this->setOption [$key] )) {
					$db->where("(".$tbname.$key." ".$value.")","",FALSE);
				} else {
					$db->where($tbname.$key,$value);
				}
				$alreadyadded[]=$key;
			}
		}
		//like properties
		if(count($this->likesFields)>0){
		    foreach ($this->likesFields as $likefld){
		        $db->like($likefld->field,$likefld->value,$likefld->likeside);
		    }
		}
		if(!empty($this->group_by)){
		    $db->group_by($this->group_by);
		}
		if($clear_properties){
			$this->ResetSetForInsetUpdate();
		}
		
		return true;
	}
	
	/**
	 * @param CI_DB_query_builder $dbobj
	 * @param unknown $extraParam
	 * @param string $clear_properties
	 * @return boolean
	 */
	function SetDBSelectJoinProperties($db,$extraParam=array(),$clear_properties=true){
		$alreadyadded=array();
		$tbname=$this->GetTableName().".";
		
		if (empty ( $this->tableName ))return false;
	
		//primary key query
		$primaryKey=$this->primaryKey;
		if(!empty($primaryKey) && isset($this->setProperties[$primaryKey])){
			if (!empty ( $this->setOption [$primaryKey] )) {
				$db->where("(".$tbname.$primaryKey." ".$this->$primaryKey.")","",FALSE);
			} else {
				$db->where($tbname.$primaryKey,$this->$primaryKey);
			}
			$alreadyadded[]=$primaryKey;
			$this->isWhereSet=true;
		}
	
		
		
		
		
		
		
		
		$generalKeys=array();
		// Unique Index key query
		if(count($this->uniqueKey)>0){
		    if(is_array($this->uniqueKey[0])){
		        $selectedKey="";
		        foreach ($this->uniqueKey as $pos=>$uk){
		            $generalKeys=array_merge($generalKeys,$uk);
		            $isOk=true;
		            foreach ($uk as $fld){
		                if(!isset($this->setProperties[$fld])){
		                    $isOk=false;
		                    break;
		                }
		
		            }
		            if($isOk){
		                $selectedKey=$pos;
		            }
		        }
		        if($selectedKey!=""){		        
		            foreach ($this->uniqueKey[$selectedKey] as $uk){
		                if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
		                    if (!empty ( $this->setOption [$uk] )) {
		                        $db->where("(".$tbname.$uk." ".$this->$uk,"",FALSE);
		                    } else {
		                        $db->where($tbname.$uk,$this->$uk);
		                    }
		                    $alreadyadded[]=$uk;
		                    $this->isWhereSet=true;
		                }
		            }
		        }
		    }else{		       
		        foreach ($this->uniqueKey as $uk){
		            if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
		                if (!empty ( $this->setOption [$uk] )) {
		                    $db->where("(".$tbname.$uk." ".$this->$uk,"",FALSE);
		                } else {
		                    $db->where($tbname.$uk,$this->$uk);
		                }
		                $alreadyadded[]=$uk;
		                $this->isWhereSet=true;
		            }
		        }
		    }
		}
		
		// Other's key query
		if(count($this->multiKey)>0){
		    if(is_array($this->multiKey[0])){
		        $selectedKey="";
		        foreach ($this->multiKey as $pos=>$uk){
		            $generalKeys=array_merge($generalKeys,$uk);
		            $isOk=true;
		            foreach ($uk as $fld){
		                if(!isset($this->setProperties[$fld])){
		                    $isOk=false;
		                    break;
		                }
		
		            }
		            if($isOk){
		                $selectedKey=$pos;
		            }
		        }
		        if($selectedKey!=""){		           
		            foreach ($this->multiKey[$selectedKey] as $uk){
		                if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
		                    if (!empty ( $this->setOption [$uk] )) {
		                        $db->where("(".$tbname.$uk." ".$this->$uk.")","",FALSE);
		                    } else {
		                        $db->where($tbname.$uk,$this->$uk);
		                    }
		                    $alreadyadded[]=$uk;
		                    $this->isWhereSet=true;
		                }
		            }
		        }
		    }else{
		        //for backword compatibility		       
		        foreach ($this->multiKey as $uk){
		            if(!in_array($uk, $alreadyadded) && isset($this->setProperties[$uk])){
		                if (!empty ( $this->setOption [$uk] )) {
		                    $db->where("(".$tbname.$uk." ".$this->$uk.")","",FALSE);
		                } else {
		                    $db->where($tbname.$uk,$this->$uk);
		                }
		                $alreadyadded[]=$uk;
		                $this->isWhereSet=true;
		            }
		        }
		    }
		}
		
		//for GeneralKeys
		foreach ($generalKeys as $uk){
		    if(!in_array($uk, $alreadyadded)) {
		        if(isset($this->setProperties[$uk])){
		            if (!empty ( $this->setOption [$uk] )) {
		                $db->where("(".$tbname.$uk." ".$this->$uk.")","",FALSE);
		            } else {
		                $db->where($tbname.$uk,$this->$uk);
		            }
		            $alreadyadded[]=$uk;
		            $this->isWhereSet=true;
		        }
		    }
		}		
		
		foreach ( $this->setProperties as $key => $value ) {
			if (property_exists ( $this, $key ) && !in_array($key, $alreadyadded)) {
				if (!empty ( $this->setOption [$key] )) {
					$db->where("(".$tbname.$key." ".$this->$key.")","",FALSE);
				} else {
					$db->where($tbname.$key,$this->$key);
				}
				$alreadyadded[]=$key;
			}
		}
		foreach ( $extraParam as $key => $value ) {
			if (property_exists ( $this, $key ) && !in_array($key, $alreadyadded)) {
				if (!empty ( $this->setOption [$key] )) {
					$db->where("(".$tbname.$key." ".$value.")","",FALSE);
				} else {
					$db->where($tbname.$key,$value);
				}
				$alreadyadded[]=$key;
			}
		}
		if($clear_properties){
			$this->setProperties=array();
			$this->setOption=array();
		}
	
		return true;
	}
	
	function Join($join_obj,$join_obj_property,$main_obj_property,$type="",$as="",$extraParam=[]){
		if(!empty($as)){
			$join_obj->setTableShortName($as);
		}
		$joinobj=new ObjectJoin();
		$joinobj->join_obj=$join_obj;
		$joinobj->join_obj_property=$join_obj_property;
		$joinobj->main_obj_property=$main_obj_property;
		$joinobj->type=$type;
		$joinobj->extra_param=$extraParam;
		$this->joinObjects[]=$joinobj;
	}
	
	protected function SetJoinProperties($clear_properties=true){
		if(count($this->joinObjects)>0){
			foreach ($this->joinObjects as $jn){
				//$jn=new ObjectJoin();
				$thistblstrproperty=$this->getTableNameForJoinProperty($jn->main_obj_property);
				if(property_exists($jn->join_obj, $jn->join_obj_property) && !empty($thistblstrproperty)){
					$tablestr=$jn->join_obj->GetTableName(false);
					$shorttbl=$jn->join_obj->GetTableName();
					$extra_param_str="";
					if(count($jn->extra_param)>0){
					    foreach ($jn->extra_param as $fd=>$vd){
						    $extra_param_str.=!empty($extra_param_str)?" AND ":"";
						    $extra_param_str.=$fd."=".$vd;
                        }
						$extra_param_str=" AND $extra_param_str";
                    }
					$this->GetSelectDB()->join($tablestr, " $shorttbl.$jn->join_obj_property=$thistblstrproperty $extra_param_str",$jn->type);
					$jn->join_obj->SetDBSelectJoinProperties($this->GetSelectDB(),array(),$clear_properties);
				}
			}
		}
	}
	private function getTableNameForJoinProperty($propertyName){		
		if (strpos($propertyName,".") !== false) {return $propertyName;}
		if(property_exists($this, $propertyName)){
			return $this->GetTableName().".$propertyName";
		}else{
			if(count($this->joinObjects)>0){
				foreach ($this->joinObjects as $jn){
					if(property_exists($jn->join_obj, $propertyName)){
						return $jn->join_obj->GetTableName().".$propertyName";
					}
				}
			}
		}
		return "";
	}
	
	protected function SetDBUpdateWhereProperties($extraParam=array(),$isCheckWherePropetrySetOrNot=true,$clear_properties=false){				
		if (!$this->CheckBasicCheck()){return false;	}		
		if(count($this->updateWhereExtraField)==0){return false;}
		$alreadyadded=array();
		//primary key query
		$primaryKey=$this->primaryKey;		
		if(!empty($primaryKey) && isset($this->updateWhereExtraField[$primaryKey])){		    
			if(in_array($primaryKey,$this->updateWhereExtraFieldOption)){
				$this->GetUpdateDB()->where("(".$primaryKey.$this->updateWhereExtraField[$primaryKey].")","",FALSE);
			}else{			
				$this->GetUpdateDB()->where($primaryKey,$this->updateWhereExtraField[$primaryKey]);	
			}
			$alreadyadded[]=$primaryKey;
		}
	
		
		$generalKeys=array();
		// Unique Index key query
		if(count($this->uniqueKey)>0){
		    if(is_array($this->uniqueKey[0])){
		        $selectedKey="";
		        foreach ($this->uniqueKey as $pos=>$uk){
		            $generalKeys=array_merge($generalKeys,$uk);
		            $isOk=true;
		            foreach ($uk as $fld){
		                if(!isset($this->updateWhereExtraField[$fld])){
		                    $isOk=false;
		                    break;
		                }
		
		            }
		            if($isOk){
		                $selectedKey=$pos;
		            }
		        }
		        if($selectedKey!=""){		           
		            foreach ($this->uniqueKey[$selectedKey] as $uk){
		                if(isset($this->updateWhereExtraField[$uk]) && !in_array($uk, $alreadyadded)){
		                    if(in_array($uk,$this->updateWhereExtraFieldOption)){
		                        $this->GetUpdateDB()->where("(".$uk.$this->updateWhereExtraField[$uk].")","",FALSE);
		                    }else{
		                        $this->GetUpdateDB()->where($uk,$this->updateWhereExtraField[$uk]);
		                    }
		                    $alreadyadded[]=$uk;
		                }		                 
		            }		            
		        }
		    }else{
		        //for backword compatibility
    		    // Other's key query		
        		foreach ($this->uniqueKey as $uk){
        			if(isset($this->updateWhereExtraField[$uk]) && !in_array($uk, $alreadyadded)){
        				if(in_array($uk,$this->updateWhereExtraFieldOption)){
        					$this->GetUpdateDB()->where("(".$uk.$this->updateWhereExtraField[$uk].")","",FALSE);
        				}else{			
        					$this->GetUpdateDB()->where($uk,$this->updateWhereExtraField[$uk]);	
        				}
        				$alreadyadded[]=$uk;
        			}
        			
        		}
		    }
		}		
		
		// Other's Multikey query
		
		// Other's key query
		if(count($this->multiKey)>0){
		    if(is_array($this->multiKey[0])){
		        $selectedKey="";
		        foreach ($this->multiKey as $pos=>$uk){
		            $generalKeys=array_merge($generalKeys,$uk);
		            $isOk=true;
		            foreach ($uk as $fld){
		                if(!isset($this->updateWhereExtraField[$fld])){
		                    $isOk=false;
		                    break;
		                }
		
		            }
		            if($isOk){
		                $selectedKey=$pos;
		            }
		        }
		        if($selectedKey!=""){
    		        foreach ($this->multiKey[$selectedKey] as $uk){
            			if(isset($this->updateWhereExtraField[$uk])&& !in_array($uk, $alreadyadded)){
            				if(in_array($uk,$this->updateWhereExtraFieldOption)){
            					$this->GetUpdateDB()->where("(".$uk.$this->updateWhereExtraField[$uk].")","",FALSE);
            				}else{			
            					$this->GetUpdateDB()->where($uk,$this->updateWhereExtraField[$uk]);	
            				}
            				$alreadyadded[]=$uk;
            			}
            		}
		        }
		    }else{
		        //for backword compatibility
        		foreach ($this->multiKey as $uk){
        			if(isset($this->updateWhereExtraField[$uk])&& !in_array($uk, $alreadyadded)){
        				if(in_array($uk,$this->updateWhereExtraFieldOption)){
        					$this->GetUpdateDB()->where("(".$uk.$this->updateWhereExtraField[$uk].")","",FALSE);
        				}else{			
        					$this->GetUpdateDB()->where($uk,$this->updateWhereExtraField[$uk]);	
        				}
        				$alreadyadded[]=$uk;
        			}
        		}
		    }
		}
		//for GeneralKeys
		foreach ($generalKeys as $uk){
		    if(!in_array($uk, $alreadyadded)) {
		        if(isset($this->updateWhereExtraField[$uk])){
    		        if(in_array($uk,$this->updateWhereExtraFieldOption)){
                		$this->GetUpdateDB()->where("(".$uk.$this->updateWhereExtraField[$uk].")","",FALSE);
    				}else{			
    					$this->GetUpdateDB()->where($uk,$this->updateWhereExtraField[$uk]);	
    				}
		            $alreadyadded[]=$uk;
		            $this->isWhereSet=true;
		        }
		    }
		}
		
			
		foreach ( $this->updateWhereExtraField as $key => $value ) {
			if (property_exists ( $this, $key ) && !in_array($key, $alreadyadded)) {
				if(in_array($key,$this->updateWhereExtraFieldOption)){
					$this->GetUpdateDB()->where("(".$key.$this->updateWhereExtraField[$key].")","",FALSE);
				} else {
					$this->GetUpdateDB()->where($key,$this->updateWhereExtraField[$key]);
				}
				$alreadyadded[]=$key;
			}
		}
			
		foreach ( $extraParam as $key => $value ) {
			if (property_exists ( $this, $key ) && !in_array($key, $alreadyadded)) {
				$this->GetUpdateDB()->where($key,$value);
				$alreadyadded[]=$key;
			}
		}
		if($isCheckWherePropetrySetOrNot){
			if(count($alreadyadded)==0){
				add_model_errors_code("E004");
				return false;
			}
		}
		if($clear_properties){
			$this->updateWhereExtraField=array();
			$this->updateWhereExtraFieldOption=array();		
		}	
		return true;
	}
	function UnsetAllUpdateProperty(){
		$this->updateWhereExtraField=array();
		$this->updateWhereExtraFieldOption=array();
	}
	function SetDBPropertyForInsertOrUpdate($isForUpdate=false){
		if (!$this->CheckBasicCheck()){			
			return false;
		}
		if(!$isForUpdate){
			$primaryKey = $this->primaryKey;
			if(!empty($primaryKey) && !isset($this->setProperties[$primaryKey]) && !in_array($primaryKey, $this->autoIncField)){	
				add_model_errors_code("E002");
				return false;
			}
		}		
		$primaryKey = $this->primaryKey;
		foreach ( $this->setProperties as $key => $value ) {
			if($isForUpdate && $primaryKey==$key){
				continue;
			}
			if (!empty ( $this->setOption [$key] )) {			
				$this->GetUpdateDB ()->set ( $key, $this->$key." " ,FALSE);
			}else{
				$this->GetUpdateDB ()->set ( $key, $this->$key );
			}
		}
		$this->ResetSetForInsetUpdate();
		return true;
	}
	function AddLike($likefld,$likeValue,$likeside="both"){
	    if(property_exists($this, $likefld)){
	        $std=new stdClass();
	        $std->field=$likefld;
	        $std->value=$likeValue;
	        $std->likeside=$likeside;
	        $this->likesFields[]=$std;
	    }
	}
	/**
	 * @param string $likefld
	 * @param string $likeValue
	 * @param string $likeside
	 * @param bool $isSelectDb
	 */
	function SetDBLike($likefld,$likeValue,$likeside="after",$isSelectDb=true){
		$db=$isSelectDb?$this->GetSelectDB():$this->GetUpdateDB();
		//set like
		if (! empty ( $likefld )) {
			if (property_exists ( $this, $likefld )) {
				if(count($this->joinObjects)>0){
					$likefld=$this->GetTableName().".".$likefld;
				}
				$db->like($likefld,$likeValue,$likeside);
			}else{
				if(count($this->joinObjects)>0){
					foreach ($this->joinObjects as $jn){
				//$jn=new ObjectJoin();
						$thistblstrproperty=$this->getTableNameForJoinProperty($likefld);
						if(property_exists($jn->join_obj, $likefld) && !empty($thistblstrproperty)){
							$likefld=$thistblstrproperty;
							$db->like($likefld,$likeValue,$likeside);
							break;
						}
					}
				}
			}
		}
	}
	/**
	 * @param string|array $order_by
	 * @param string $order
	 * @param bool $isSelectDb
	 */
	function SetDBOrder($order_by,$order="",$isSelectDb=true,$isEscap=true){
		$db=$isSelectDb?$this->GetSelectDB():$this->GetUpdateDB();
		//SetOrder
		if(is_array($order_by)){
			$forder="";
			foreach ($order_by as $op=>$ov){
				$forder.="$op $ov ,";
			}
			$forder=rtrim($forder,',');
			$db->order_by($forder);
		}elseif (! empty ( $order_by ) && property_exists ( $this, $order_by )) {
			$db->order_by($order_by,$order);
		}elseif(!empty($order_by) && property_exists ( $this, $order_by ) && empty($order)){
			$db->order_by($order_by);
		}elseif(!$isEscap){
			$db->order_by($order_by);
		}
	}
	/**
	 * @param number $limit
	 * @param number $limitStart
	 * @param bool $isSelectDb
	 */
	function SetDBLimit($limit, $limitStart = 0,$isSelectDb=true){
		$db=$isSelectDb?$this->GetSelectDB():$this->GetUpdateDB();
		$db->limit($limit, $limitStart);
	}
	/**
	 * @param string $select	
	 * @param bool $isSelectDb
	 */
	function SetDBSelect($select="",$isSelectDb=true,$isEscap=true){
		$db=$isSelectDb?$this->GetSelectDB():$this->GetUpdateDB();
		$dbname= $this->GetTableName();
		if (empty ( $select )) {
			$select =$dbname . ".* ";
		}else{
			$select=explode(",", $select);
			foreach ($select as $key=> &$se){
				$se=trim($se);
				if (strpos($se,".") !== false) {continue;}
				if($se=="*"){
					$se=$dbname . ".* ";
				}elseif(property_exists($this, $se)){
					$se="$dbname.$se ";
				}elseif(!$isEscap){
					continue;
				}else{
					if(count($this->joinObjects)>0){
						foreach ($this->joinObjects as $jn){
							if(property_exists($jn->join_obj, $se)){
								$se=$jn->join_obj->GetTableName().".$se";
							}
						}
					}else{
						unset($select[$key]);
					}
				}
			}
			$select=implode(", ", $select);
		}
		$db->select($select);
	}
	
	
	
	/**
	 * @param bool $isOnlyTableName
	 * @return string
	 */
	function GetTableName($isOnlyTableName=true){
		if(!empty($this->tableShortForm)){
			if($isOnlyTableName){
				return $this->tableShortForm;
			}else{
				return $this->tableName." as ".$this->tableShortForm;
			}
		}
		return $this->tableName;
	}
	
	protected function BindObject($obj) { 
		if(!empty($obj) && (is_object($obj) || is_array($obj))){
			foreach ( $obj as $key => $value ) {
				if (in_array ( $key, $this->htmlInputField )) {
					$value = stripcslashes ( $value );
				}
				$this->$key = $value;
			}			
		}
	}
	protected function SetCustomValidationMessage(){
		//$this->form_validation;
	}
	protected function SetValidationRule($isForNew = true) {
		$this->form_validation->reset_validation();
		$this->form_validation->set_data($this->setProperties);
		
		if ($isForNew) {
			foreach ($this->validations as $key=>$value){
				if(!empty($this->setOption[$key])){
					continue;
				}
				if($key==$value['Text']){
					$name=str_replace("_", " ", $value['Text']);
				}else{
					$name=$value['Text'];
				}
				if(function_exists("ucwords")){
					$name=ucwords($name);
				}
				$name="<strong>".$name."</strong>";
				if(!empty($value['Rule'])){
					$this->isValidationRule = true;
					$this->form_validation->set_rules ( $key, $name, $value['Rule'] );
				}
			}			
		} else {
			if (count ( $this->setProperties ) > 0) {
				foreach ( $this->setProperties as $key=>$value) {	
					if(!empty($this->setOption[$key])){
						continue;
					}				
					if (isset ( $this->validations [$key] ) && $this->validations [$key] ['Rule'] != "") {						
						$this->isValidationRule = true;
						if($key==$this->validations [$key]['Text']){
							$name=str_replace("_", " ", $this->validations [$key]['Text']);
							if(function_exists("ucwords")){
								$name=ucwords($name);
							}
						}else{
							$name=$this->validations[$key]['Text'];
						}						
						$name="<strong>".$name."</strong>";
						$this->form_validation->set_rules ( $key, $this->validations [$key] ['Text'], $this->validations [$key] ['Rule'] );
					} else {
						//$this->form_validation->set_rules ( $key, '', '' );
					}
				}
			}
		}
		$this->SetCustomValidationMessage($this->form_validation);	
	}
	public function IsValidForm($isNew=true,$addError=true,$isSelectOnly=false){		
		$this->SetValidationRule($isNew);
		if(!$this->isValidationRule){
			return true;
		}
		if($isSelectOnly){
			$this->form_validation->dontChangePostValue=true;
		}
		if ($this->form_validation->run() == FALSE)
		{	if($addError){	
				add_validation_errors();
			}
			return  false;
		}else{
			return true;
		}
	}
	function Save() {
		if (! $this->IsValidForm(true)){			
			return false;
		}
		if(!$this->SetDBPropertyForInsertOrUpdate()){
			return false;
		}		
		if ($this->GetUpdateDB ()->insert ( $this->tableName )) {		   
		    if(is_array($this->autoIncField) && count($this->autoIncField)>0){
		        $auto_inserted=$this->GetUpdateDB ()->insert_id();
		        foreach ($this->autoIncField as $fld){
		            if(property_exists($this, $fld)){
		                $this->$fld=$auto_inserted;
		            }
		        }
		    }
			$this->ResetSetForInsetUpdate();	
			$this->onSaveUpdateEvent();
			return true;
		} else {
			add_model_errors_code("E003");
			return false;
		}
	}
	/**
	 * @param string $select
	 * @return boolean
	 */
	function SelectArray($select = "",$addFieldError=false) {
		return $this->Select($select,$addFieldError,false);
	}
	
	/**
	 * @param string $select
	 * @return boolean
	 */
	function Select($select = "",$addFieldError=false,$isObject=true) {		
		if (!$this->CheckBasicCheck())	return false;
		if (!$this->IsValidForm(false,$addFieldError,true)){
			return false;
		}
		if($this->checkCache){
			$cacheid=md5("select".$this->tableName.json_encode($this->setProperties).json_encode($this->joinObjects).$select.$isObject);				
			$response_data = get_cache_data($cacheid);		
			if(!empty($response_data) || is_object($response_data) || is_array($response_data)){
				$this->BindObject($response_data);
				return true;
			}
		}
		if(!$this->SetDBSelectWhereProperties(array(),true,true)){
			return false;
		}		
		$this->SetDBSelect($select,true);
		$this->SetJoinProperties();	
		$result = $this->GetSelectDB()->get($this->GetTableName(false));	
		if ($result && $result->num_rows() >0 ) {		   
			if($isObject){
				$firstRow=$result->first_row();
				if($this->checkCache){
					save_cache_data($cacheid, $firstRow, $this->cacheTime);
				}
				$this->BindObject($firstRow);
			}else{				
				return $result->first_row('array');
			}
			return true;			
		} else {		   
			return false;
		}
	}
	/**
	 * @param string $select
	 * @return NULL || self
	 */
	function SelectCustom($select = "",$addFieldError=false,$isObject=true) {
		if (!$this->CheckBasicCheck())	return false;
		if (!$this->IsValidForm(false,$addFieldError,true)){
			return false;
		}
		if($this->checkCache){
			$cacheid=md5("select".$this->tableName.json_encode($this->setProperties).json_encode($this->joinObjects).$select.$isObject);
			$response_data = get_cache_data($cacheid);
			if(!empty($response_data) || is_object($response_data) || is_array($response_data)){
				$this->BindObject($response_data);
				return true;
			}
		}
		if(!$this->SetDBSelectWhereProperties(array(),true,true)){
			return false;
		}
		$this->GetSelectDB()->select($select,false);
		$this->SetJoinProperties();
		$result = $this->GetSelectDB()->get($this->GetTableName(false));
		if ($result && $result->num_rows() >0 ) {
			if($isObject){
				$firstRow=$result->first_row();
				if($this->checkCache){
					save_cache_data($cacheid, $firstRow, $this->cacheTime);
				}
				return $firstRow;
			}else{
				return $result->first_row('array');
			}			
		} else {
			return NULL;
		}
	}
	/**
	 * @param string $select
	 * @param string $likefld
	 * @param string $likeValue
	 * @param unknown $extraParam
	 * @param string $likeside
	 * @return boolean|NULL
	 */
	function CustomSelect($select = "*",$likefld = "", $likeValue = "",$extraParam=array(),$likeside="after"){
		$this->GetSelectDB()->select("$select",FALSE);
		if (empty ( $this->tableName ))	return false;
		if(!$this->SetDBSelectWhereProperties($extraParam,false,true)){
			return false;
		}
		//set like
		$this->SetDBLike($likefld, $likeValue,$likeside,true);
		//SetOrder
		$this->SetJoinProperties();
	
		$result = $this->GetSelectDB()->get($this->GetTableName(false));
		if ($result && $result->num_rows() >0 ) {
			return $result->first_row();
				
		}
		return NULL;
	}
	/**
	 *
	 * @param string $select
	 * @param string $orderBy
	 * @param string $order
	 * @param string $limit
	 * @param string $limitStart
	 * @param string $likefld
	 * @param string $like
	 * @param Array $ExtraLike
     * @return static []
	 */
	function SelectAll($select = "", $orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true,$is_data_only=false) {
		if (!$this->CheckBasicCheck())	return array();	
		$isshowerror=ENVIRONMENT=="development";		
		if($this->checkCache){
			$cache_id=$is_data_only?"selectall_data":"selectall";
			$cacheid=md5($cache_id.$this->tableName.json_encode($this->setProperties).json_encode($this->joinObjects).$likefld.$likeValue.$order.$orderBy.$limit.$limitStart.$likeside.json_encode($extraParam));
			$response_data = get_cache_data($cacheid);
			if(is_array($response_data)){
				return $response_data;
			}		
		}
		
		if (! $this->IsValidForm(false,$isshowerror,true)){
			return array();
		}				
		if(!$this->SetDBSelectWhereProperties($extraParam,true,true)){
			return array();
		}
		
		$this->SetDBLike($likefld, $likeValue,$likeside,true);
		
		//SetOrder
		$this->SetDBOrder($orderBy,$order,true,$isEscap);
		$this->SetDBLimit($limit,$limitStart);
		
		$this->SetDBSelect($select,true,$isEscap);
		$this->SetJoinProperties();
		
		$result = $this->GetSelectDB()->get($this->GetTableName(false));
		if ($result && $result->num_rows()>0) {			
			if($this->checkCache){
				if($is_data_only){
					$result_dara=$result->result();
				}else{
					$result_dara=$result->result(get_class($this));
				}
				save_cache_data($cacheid, $result_dara, $this->cacheTime);
				return $result_dara;
			}else{
				if($is_data_only){
					return $result_dara=$result->result();
				}else{
					return $result_dara=$result->result(get_class($this));
				}				
			}			
		} else {
			if($this->checkCache){
				save_cache_data($cacheid, array(), $this->cacheTime);
			}
			return array();
					
		}
	}
	/**
	 *
	 * @param string $select
	 * @param string $orderBy
	 * @param string $order
	 * @param string $limit
	 * @param string $limitStart
	 * @param string $likefld
	 * @param string $like
	 * @param Array $ExtraLike
	 * @return static []
	 */
	function SelectAllGridData($select = "", $orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true) {
		return $this->SelectAll($select,$orderBy, $order, $limit, $limitStart, $likefld, $likeValue,$extraParam,$likeside,$isEscap,true);
	}
	/**
	 * @param string $select
	 * @param string $orderBy
	 * @param string $order
	 * @param string $limit
	 * @param string $limitStart
	 * @param string $likefld
	 * @param string $likeValue
	 * @param unknown $extraParam
	 * @param string $likeside
	 * @param string $isEscap
	 * @return static []
	 */
	static function FetchAll($select = "", $orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true,$isCache=false,$cacheTime=0){
		$s=new static();
		$s->checkCache($isCache,$cacheTime);
		return $s->SelectAll($select,$orderBy, $order, $limit, $limitStart,$likefld ,$likeValue,$extraParam,$likeside,$isEscap);
	}
	/**
	 * @param unknown $property
	 * @param unknown $value
	 * @return APP_Model|NULL|static
	 */
	static function FindBy($property,$value,$extraparam=array(),$isCache=false,$cacheTime=0){		
		$n =new static();
		$n->checkCache($isCache,$cacheTime);
		if(property_exists($n, $property)){
			$n->$property($value);
			if(is_array($extraparam)){
				foreach ($extraparam as $key=>$value){
					if(property_exists($n, $key)){
						$n->$key($value);
					}
				}
			}			
			if($n->Select()){			   
				return $n;
			}
		}
		
		return NULL;
	}
	
	/**
	 * @param String $property
	 * @param unknown $value
	 * @param unknown $extraparam
	 * @param string $isCache
	 * @param number $cacheTime
	 * @return static []:
	 */
	static function FindAllBy($property,$value,$extraparam=array(),$order_by='',$order='ASC',$limit = "", $limitStart = "",$isCache=false,$cacheTime=0){
	    $n =new static();
	    $n->checkCache($isCache,$cacheTime);
	    if(property_exists($n, $property)){
	        $n->$property($value);
	        if(is_array($extraparam)){
	            foreach ($extraparam as $key=>$value){
	                if(property_exists($n, $key)){
	                    $n->$key($value);
	                }
	            }
	        }
	       return $n->SelectAll('',$order_by,$order,$limit,$limitStart);
	    }
	
	    return array();
	}
	
	/**
	 * @param $findByProperty
	 * @param $findByvalue
	 * @param $key
	 * @param $value
	 * @param array $extraparam
	 * @param bool $isCache
	 * @param int $cacheTime
	 *
	 * @return static []
	 */
	static function FindAllByKeyValue($findByProperty,$findByvalue,$key,$value,$extraparam=array(),$isCache=false,$cacheTime=0){
		$n =new static();
		$n->checkCache($isCache,$cacheTime);
		if(property_exists($n, $findByProperty)){
			$n->$findByProperty($findByvalue);
			return $n->SelectAllWithKeyValue($key, $value,"","","","","","",$extraparam);
		}
		
		return array();
	}
	
	/**
	 * @param $findByProperty
	 * @param $findByvalue
	 * @param $identity_fld
	 * @param array $extraparam
	 * @param bool $isCache
	 * @param int $cacheTime
	 *
	 * @return static []
	 */
	static function FindAllByIdentiry($findByProperty,$findByvalue,$identity_fld,$extraparam=array(),$isCache=false,$cacheTime=0){
		$n =new static();
		$n->checkCache($isCache,$cacheTime);
		if(property_exists($n, $findByProperty)){
			$n->$findByProperty($findByvalue);
			return $n->SelectAllWithIdentity($identity_fld,"","","","","","",$extraparam);
		}
		
		return array();
	}
	function getPropertiesArray($skipped=""){	
		$skipped=explode(",", $skipped);
		$return=array();
	    $reflection = new ReflectionObject($this);
	    $properties = $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
	    $skipped[]="settedPropertyforLog";
	    foreach ($properties as $property) {	    	
	    	if(in_array($property->getName(), $skipped)){
	    		continue;
	    	}
	    	$return[$property->getName()]=$property->getValue($this);
	    }
	    return $return;
	}
	static function FetchCountAll($likefld = "", $likeValue = "",$extraParam=array(),$likeside="after",$isCache=false,$cacheTime=0){
		$s=new static();
		$s->checkCache($isCache,$cacheTime);		
		return $s->CountALL($likefld,$likeValue, $extraParam, $likeside);
	}	
	static function FetchAllKeyValue($key,$value,$isStarAdd=false,$orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true,$isCache=false,$cacheTime=0){
		$s=new static();
		$s->checkCache($isCache,$cacheTime);
		$results=$s->SelectAll($key.",".$value,$orderBy, $order, $limit, $limitStart,$likefld ,$likeValue,$extraParam,$likeside,$isEscap);
		$returndata=array();
		if($isStarAdd){
			$returndata['*']="All";
		}
		foreach ($results as $data){
			if(!empty($data->$key)){
				$returndata[$data->$key]=$data->$value;
			}
		}
		return $returndata;
	}
	function SelectAllWithIdentity($unique_field,$select = "", $orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true){
		$result=$this->SelectAll($select,$orderBy, $order, $limit, $limitStart,$likefld ,$likeValue,$extraParam,$likeside,$isEscap);
		if(count($result)>0){
			$newrsult=array();
			foreach ($result as $obj){
				if(!empty($obj->$unique_field)){
					$newrsult[$obj->$unique_field]=$obj;
				}
			}
			return $newrsult;
		}
		return $result;
	}	
	function SelectAllWithIdentityWithSelectPropertyOnly($unique_field,$select = "", $orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true){
		$result=$this->SelectAll($select,$orderBy, $order, $limit, $limitStart,$likefld ,$likeValue,$extraParam,$likeside,$isEscap,true);
		if(count($result)>0){
			$newrsult=array();
			foreach ($result as $obj){
				if(!empty($obj->$unique_field)){
					$newrsult[$obj->$unique_field]=$obj;
				}
			}
			return $newrsult;
		}
		return $result;
	}
	
	function SelectAllWithKeyValueWithStar($key,$value,$isStarAdd=true,$orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true){  
		$results=$this->SelectAll($key.",".$value,$orderBy, $order, $limit, $limitStart,$likefld ,$likeValue,$extraParam,$likeside,$isEscap);
		$returndata=array();
		if($isStarAdd){
			$returndata['*']="All";
		}
		foreach ($results as $data){
			if(!empty($data->$key)){
				$returndata[$data->$key]=$data->$value;
			}
		}
		return $returndata;
	}
	function SelectAllWithKeyValue($key,$value,$orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true){
		return $this->SelectAllWithKeyValueWithStar($key, $value,false,$orderBy, $order, $limit, $limitStart, $likefld, $likeValue,$extraParam,$likeside,$isEscap);
	}
	function SelectAllWithArrayKeys($key,$orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true){
		$results=$this->SelectAll($key,$orderBy, $order, $limit, $limitStart,$likefld ,$likeValue,$extraParam,$likeside,$isEscap);
		$returndata=array();
		foreach ($results as $data){
			if(!empty($data->$key)){
				$returndata[]=$data->$key;
			}
		}
		return $returndata;
	}
	
	
	
	/**
	 * @param strin $fieldName | db field name
	 * @param string $default | default value
	 * @return string
	 */
	function GetNewIncId($fieldName, $default,$param=array()) {		
		$nthis=new static();
		if(is_array($param)&& count($param)>0){
			foreach ($param as $property=>$value){
				if(property_exists($nthis, $property)){					
					call_user_func(array($nthis, $property), $value );
				}else{
					return false;
				}
			}
		}	
		if (!$nthis->CheckBasicCheck())	return false;
		if (!$nthis->IsValidForm(false,false,true)){
			return false;
		}
		if(!$nthis->SetDBSelectWhereProperties(array(),true,true)){
			return false;
		}		
		$nthis->GetSelectDB()->select("max({$fieldName}) as `lastS` ",false);
		$nthis->SetJoinProperties();	
		$result = $nthis->GetSelectDB()->get($nthis->GetTableName(false));	
		if ($result && $result->num_rows() >0 ) {		   
			$row=$result->first_row();
			if($row->lastS){
				$a=$row->lastS;
				$a++;
				return $a;
			}
		}		
		return $default;	
	}
	function SelectQuery($sql,$isArray=false) {
		$result = $this->GetSelectDB()->query($sql);
		if ($result) {
			if($isArray){
				return $result->result_array ();
			}
			return $result->result ();
		} else {
			return array ();
		}
	}
	
	function SelectQuery2($sql,$isArray=false) {
	    $result = $this->GetSelectDB()->query($sql);
	    return $this->GetSelectDB()->affected_rows();
	}
	
	function IsExists($property, $value, $otherParam = array()) {
		if (property_exists ( $this, $property )) {	
			$this->GetSelectDB()->where($property,$value);	
			foreach ( $otherParam as $key => $pvalue ) {
				$this->GetSelectDB()->where($key,$pvalue);
			}
			$count=$this->GetSelectDB ()->count_all_results($this->tableName);
			if ($count) {
				if ($count > 0) {
					return true;
				}
			}			
		}
		return false;
	}
	/**
	 *
	 * @var CI_DB_query_builder
	 */
	public function GetSelectDB() {
		if (self::$db1 == null) {
			self::$db1 = $this->load->database ( "default", TRUE );
		}
		return self::$db1;
	}
	
	/**
	 *
	 * @var CI_DB_query_builder
	 */
	public function GetUpdateDB() {
		if(!$this->config->item("IsMultipleDB")){
			return $this->GetSelectDB();
		}
	
		if (self::$db2 == null) {
			self::$db2 = $this->load->database ( "update", TRUE );
		}
		return self::$db2;
	}
	public static function __callStatic($func, $args){		
		if(static::startsWith($func, "FindBy")){
			$funcl=strtolower($func);
			$property=str_replace("findby", "", $funcl);
			return static::FindBy($property, $args[0]);
		}
		trigger_error("Call to undefined method ".get_called_class().": $func", E_USER_ERROR);
	}
	function __call($func, $args) {		
		
		if (isset ( $args [0] )) {
			$value = $this->$func;
				
			// echo $func."=>".$value."==".$args[0];
			if(empty($args [1])){
				$this->doFieldValueFilter($this->$func, $args [0]);		
			}	
			if ($value != $args [0] || ($args [0] == '' && $value == null)) {
	
				if (property_exists ( $this, $func )) {
					if (isset ( $args [1] )) {
						$this->setOption [$func] = $args [1];
					}					
					$this->setProperties [$func] = $args [0];					
				}
				$this->$func = trim ( $args [0] );
			}
		} else {
			// echo $func;
		}
	}
	function doFieldValueFilter($property,&$value,$isXsClean=true){
		
	}
	static function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
	function CountALL($likefld = "", $likeValue = "",$extraParam=array(),$likeside="after") {
		if (empty ( $this->tableName ))	return false;
		if(!$this->SetDBSelectWhereProperties($extraParam,false,true)){
			return false;
		}
		//set like
		$this->SetDBLike($likefld, $likeValue,$likeside,true);
		//SetOrder
		$this->SetJoinProperties(false);
	  
		return $this->GetSelectDB()->count_all_results($this->GetTableName(false));
	
	}
	function ResetSetForInsetUpdate() {		
		foreach ( $this->setProperties as $key => $value ) {
			if (isset ( $this->htmlInputField [$key] )) {
				continue;
			}
			if (! empty ( $this->settedPropertyforLog ))
				$this->settedPropertyforLog .= ", ";
			$this->settedPropertyforLog .= $key . "=" . $value;
		}
		$this->setProperties = array ();
		$this->setOption = array ();
		$this->likesFields=array();
		$this->group_by=null;
	}
	
	function SetFromArray(&$dataarray,$isNew = false,$selectedFields=null){
	    if($selectedFields){
	        if(is_string($selectedFields)){	            
	            $selectedFields=explode(",", $selectedFields);
	            array_walk($selectedFields, 'trim_value');	           
	        }
	    }
		foreach ( $dataarray as $key => $value ) {
			if (property_exists ( $this, $key ) && (!$selectedFields || in_array($key, $selectedFields))) {
				$isHtml = in_array ( $key, $this->htmlInputField );
				$NewValue = $this->input->post( $key, !$isHtml );
				$oldValue = $this->input->post( "old_" . $key, !$isHtml );
				if ($oldValue != null) {
					if ($oldValue == $NewValue) {
						$this->$key = $NewValue;
					} else {
						$this->$key ( $NewValue );
						// $this->SetValidationRule ( $key );
					}
				} else {
					if ($NewValue !== $oldValue) {
						$this->$key ( $NewValue );
					} else {
						$this->$key = $NewValue;
					}
				}
			}
		}
		return $this->IsValidForm($isNew);
	}
	function SetFromPostData($isNew = false,$selectedFields=null) {
		return $this->SetFromArray($_POST,$isNew,$selectedFields);
	}
	function SetWhereUpdate($property, $value,$isNotXSSClean=false) {
		$this->SetWhereCondition($property, $value,$isNotXSSClean);
	}
	function SetWhereCondition($property, $value,$isNotXSSClean=false) {
		$this->updateWhereExtraField [$property] = $value;
		if($isNotXSSClean){
			$this->updateWhereExtraFieldOption[]=$property;
		}
	}
	function GetWhereConditionValue($property) {
		if(isset($this->updateWhereExtraField [$property])){
			return $this->updateWhereExtraField [$property];
		}
		return null;
	}
	function IsSetDataForSaveUpdate($isShowMsg = false) {
		$re = count ( $this->setProperties ) > 0;
		if (! $re && $isShowMsg) {
			AddError ( "No change for update" );
		}
		return $re;
	}
	/**
	 * @param String $properties
	 * Comma separated
	 */	
    function UnsetAllExcepts($properties) {
		$properties=explode(",", $properties);
		$properties=array_map("trim", $properties);
		foreach ($this->setProperties as $key=>$value){
			if(!in_array($key, $properties)){
				$this->UnsetPrperty($key);
			}
		}
		return count ($this->setProperties )>0;
	}
	function IsSetPrperty($property) {
		return isset ( $this->setProperties [$property] );
	}
	function IsSetWherePrperty($property) {
		return isset ( $this->updateWhereExtraField [$property] );
	}
	function getWherePrperty($property) {
		return isset ( $this->updateWhereExtraField [$property] )?$this->updateWhereExtraField [$property] :"";
	}
	function hasPrpertyOpt($property) {
		return isset ( $this->setOption [$property] )?$this->setOption [$property] :false;
	}
	function hasWherePrpertyOpt($property) {
		return isset ( $this->updateWhereExtraFieldOption [$property] )?$this->updateWhereExtraFieldOption [$property] :false;
	}
	function UnsetPrperty($property) {
		if (isset ( $this->setProperties [$property] )) {
			unset ( $this->setProperties [$property] );
		}
		if (isset ( $this->setOption [$property] )) {
			unset ( $this->setOption [$property] );
		}
	}
	
	function IsHTMLProperty($property = "") {
		if (in_array ( $property, $this->htmlInputField )) {
			return true;
		}
		return false;
	}
	
	static function GetTotalQueries() {
		$ci=get_instance();
		ob_start ();
		?>
				<div class="row">
					<div class="panel panel-info">
						<div class="panel-heading">Queries</div>
						<div class="panel-body">
							<pre>
								<?php
								if(!empty(self::$db1)){
									foreach ( self::$db1->queries as $qur ) {
										$qur=str_replace("\n","", $qur);
										GPrint ( $qur );
									}
								}
								if(!empty(self::$db2)){
									if($ci->config->item("IsMultipleDB")){
										foreach ( self::$db2->queries as $qur ) {
											$qur=str_replace("\n","", $qur);
											GPrint ( $qur );
										}
									}
								}
								?>
							</pre>
						</div>
					</div>
				</div>
				<?php
			return ob_get_clean ();
		}
		static function GetTotalQueriesForLog() {
			$ci=get_instance();
			ob_start ();		
				if(!empty(self::$db1)){
					foreach ( self::$db1->queries as $qur ) {
						$qur=str_replace("\n","", $qur);
						echo  ( $qur ),";\n";
					}
				}
				if(!empty(self::$db2)){
					if($ci->config->item("IsMultipleDB")){
						foreach ( self::$db2->queries as $qur ) {
							$qur=str_replace("\n","", $qur);
							echo  ( $qur ),";\n";
						}
					}
				}						
			return ob_get_clean ();
		}
		static function GetTotalQueriesCountStr() {
			$total=count(self::$db1->queries);
			if(!empty(self::$db2)){
                $ci=get_instance();
				if($ci->config->item("IsMultipleDB")){
					$total+=count(self::$db2->queries);
				}
			}
			return "Total Quirie(s) = $total";
		}


		function Update($notLimit = false, $isShowMsg = true,$dontProcessIdWhereNotset=true) {
			if ($this->IsSetDataForSaveUpdate () && count ( $this->updateWhereExtraField ) > 0) {
					if (! $this->IsValidForm(false)){						
						return false;
					}
					//set update propertry for update
					if(!$this->SetDBPropertyForInsertOrUpdate(true)){						
						return false;
					}
					
					//set where condition propertry for update
					if(!$this->SetDBUpdateWhereProperties(array(),$dontProcessIdWhereNotset)){						
						return false;
					}
					if(!$notLimit){
						$this->GetUpdateDB()->limit(1);
					}
					if ($this->GetUpdateDB ()->update($this->tableName)) {
						if($this->GetUpdateDB()->affected_rows()>0){
							$this->ResetSetForInsetUpdate();
							$this->UnsetAllUpdateProperty();
							$this->onSaveUpdateEvent();
							return true;
						}
					}else{
						//AddError("Error-U005: Update failed. ");
					}
			}
			else{
				if($isShowMsg && !$this->IsSetDataForSaveUpdate ()){			
					AddError("No data found for update");
				}elseif( count ( $this->updateWhereExtraField )==0){
					add_model_errors_code("E004");
				}
			}
			return false;
		}
		protected static function DeleteByKeyValue($key,$value,$noLimit=false){
			$thisobj=new static();
			if(!property_exists($thisobj, $key)){				
				return false;
			}
			$thisobj->GetUpdateDB()->where($key, $value);
			if(!$noLimit){
				$thisobj->GetUpdateDB()->limit(1);
			}		
			if ($thisobj->GetUpdateDB ()->delete($thisobj->tableName)) {
				if($thisobj->GetUpdateDB()->affected_rows()>0){					
					return true;
				}
			}				
			return false;
		}

		function GetAffectedRows($isSelectDB=false){
			if($isSelectDB){
				return  $this->GetSelectDB()->affected_rows();
			}else{			
				return  $this->GetUpdateDB()->affected_rows();
			}
		}
		function force_set_pk_for_update($isClean=true) {
			$pk = $this->primaryKey;
			if(!empty($this->$pk)){
				if(!$isClean){
					$this->GetUpdateDB ()->set ( $pk.$this->$pk,FALSE);
				}else{
					$this->GetUpdateDB ()->set ( $pk, $this->$pk ,FALSE);
				}
			}			
		}
		
		function getTextByKey($property,$isTag=true,$key=null){
			if($isTag){
				$data=$this->GetPropertyOptionsTag($property);
			}else{
				$data=$this->GetPropertyOptions($property);
			}
			if(!empty($key) || property_exists($this, $property)){
				if(empty($key)){$key=$this->$property;}
				return !empty($data[$key])?$data[$key]:$key;
			}else{
				return "Undefined Property";
			}
		}
		static function GetDBFields(){
            $thisobj=new static();
            $fields = $thisobj->GetSelectDB()->field_data($thisobj->tableName);
            $returnField=[];
            foreach ($fields as $fld){
                $returnField[$fld->name]=$fld;
            }
            return $returnField;
        }
        static function DBColumnAddOrModify($columnName,$type,$length,$default='',$nullstatus='NOT NULL',$after='',$comment='',$char_set='')
        {
            $thisObj = new static();
            $tableName = $thisObj->tableName;
            if (empty($tableName)) {
                return;
            }
            if ($default == '') {
                $default = "''";
            }
            if (!empty($char_set)) {
                $char_set = " CHARACTER SET {$char_set}";
            }
            if (!empty($after)) {
                $after = " AFTER {$after}";
            }
            $fields = static::GetDBFields();
            //GPrint($fields);
            if (isset($fields[$columnName])) {
                $queryType = "MODIFY";
            } else {
                $queryType = "ADD";
            }
            if (strtolower($type) == "text") {
                $query = "ALTER TABLE `{$tableName}` {$queryType} COLUMN `{$columnName}`  {$type} $char_set {$nullstatus}  COMMENT '{$comment}' $after";

            } elseif (strtolower($type) == "timestamp") {
                if($default=="''"){
                    $default="'0000-00-00 00:00:00'";
                }
                $query = "ALTER TABLE `{$tableName}` {$queryType} COLUMN `{$columnName}`  {$type} {$nullstatus} DEFAULT $default $after";

            } else {
                $query = "ALTER TABLE `{$tableName}` {$queryType} COLUMN `{$columnName}`  {$type}({$length}) $char_set {$nullstatus} DEFAULT {$default} COMMENT '{$comment}' $after";
            }
            //echo ($query) . "<br/>"; die;return;
            
            $thisObj->GetUpdateDB()->query($query);
        }
        static function DBAddIndex($key_name,$fields,$isUnique=false)
        {
            $thisObj = new static();
            $tableName = $thisObj->tableName;
            if (empty($tableName)) {
                return;
            }
            $allIndex="SHOW INDEX FROM $tableName where key_name='$key_name'";
            $result=$thisObj->SelectQuery($allIndex);
            if(is_array($result) && count($result)>0){
                $dropindex="ALTER TABLE $tableName DROP INDEX `$key_name`";
                $thisObj->SelectQuery2($dropindex);
            }
            $type=$isUnique?"UNIQUE":"INDEX";
            $query="ALTER TABLE `$tableName` ADD  $type `$key_name` ($fields)";
            $thisObj->GetUpdateDB()->query($query);
        }
	
	/**
	 * @param string $textDomain
	 */
	public function setTextDomain( $textDomain ) {
		$this->textDomain = $textDomain;
	}
	/*unchecked*/
}
	
class ObjectJoin{
	const LEFT="LEFT";
	const RIGHT="RIGHT";
	const OUTER="OUTER";
	const INNER="INNER";	
	public $join_obj_property;
	public $main_obj_property;
	/**
	 * @var APP_Model
	 */
	public $join_obj;
	public $type;
	public $extra_param=[];
}

