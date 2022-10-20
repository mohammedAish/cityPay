<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
require_once APPPATH."core".DIRECTORY_SEPARATOR."main".DIRECTORY_SEPARATOR."CORE_Model.php";
/**
 * @author Sarwar
 * @ Last Updated: 23/OCT/2016
 */
class APP_Model extends CORE_Model {
    function __construct(){
        parent::__construct();
    }
	/* (non-PHPdoc)
     * @see CORE_Model::Save()
     */
    public function Save()
    {
      if(property_exists($this, "pvid")){
          if(!$this->IsSetPrperty("pvid")){
              $pvid=ProviderSession::get_session_provider_id();
              $this->pvid($pvid);
          }
      }
      return parent::Save();        
    }
	/* (non-PHPdoc)
     * @see CORE_Model::GetNewIncId()
     */
    public function GetNewIncId($fieldName, $default, $param = array())
    {
        // TODO Auto-generated method stub
        if(property_exists($this, "pvid")){
            if(!isset($param['pvid'])){
                $param['pvid']=ProviderSession::get_session_provider_id();                
            }
        }
        return parent::GetNewIncId($fieldName, $default, $param);
    }
    
   /* function SelectAll($select = "", $orderBy = "", $order = "", $limit = "", $limitStart = "", $likefld = "", $likeValue = "",$extraParam = array(),$likeside="after",$isEscap=true,$is_data_only=false) {
        if(property_exists($this, "pvid")){
          if(!$this->IsSetPrperty("pvid")){
              $pvid=ProviderSession::get_session_provider_id();
              $this->pvid($pvid);
          }
        }
        return parent::SelectAll($select, $orderBy, $order, $limit, $limitStart, $likefld , $likeValue,$extraParam,$likeside,$isEscap,$is_data_only);
        
    }   
    function Select($select = "",$addFieldError=false,$isObject=true) {		
        if(property_exists($this, "pvid")){
            if(!$this->IsSetPrperty("pvid")){
                $pvid=ProviderSession::get_session_provider_id();
                $this->pvid($pvid);
            }
        }
        return parent::Select($select,$addFieldError,$isObject);    
    }*/
    
}
	