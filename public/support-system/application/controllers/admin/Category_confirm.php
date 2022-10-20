<?php 
/**
 * Version 1.0.0
 * Creation date: 03/Oct/2017
 * @Written By: S.M. Sarwar Hasan
 * Sarwar Hasan
 */
defined('BASEPATH') OR exit('No direct script access allowed');
 APP_Controller::LoadConfirmController();    
class Category_confirm extends APP_ConfirmController{
    
	       
	    function __construct(){
            parent::__construct();            
            $this->CheckPageAccess();
        }
    
	           
	    function category_delete($param=""){        
            if(empty($param)){
                 $this->SetConfirmResponse(false, "Invalid Request");
                 return;
            }           
            $mr=new Mcategory();           
            $mr->id($param);
            if($mr->Select()){
                //$ur=new Mcategory();
                if(Mcategory::DeleteByKeyValue("id",$param)){
                    AddLog("D","id={$param}", "l003","Category_confirm");
                    $this->SetConfirmResponse(true, "Successfully deleted");
                }else{
                    $this->SetConfirmResponse(false, "Delete failed try again");
                }
            }
        }
        
        function status_change($param=""){
           if(empty($param)){
                 $this->SetConfirmResponse(false, "Invalid Request");
                 return;
            } 
            $statusChange=array("A"=>"Active","I"=>"Inactive");

            $mr=new Mcategory();           
            $mr->id($param);
            if($mr->Select("status")){
                $newStatus=$mr->status=="A"?"I":"A";
                $uo=new Mcategory();
                $uo->status($newStatus);
                $uo->SetWhereUpdate("id",$param); 
                if( $uo->Update()){
                    $status_text = getTextByKey($uo->status, $statusChange);
                    AddLog("U",$uo->settedPropertyforLog(), "l002","Category");
                    $this->SetConfirmResponse(true, "Successfully Updated", $status_text);
                }else{
                    $this->SetConfirmResponse(false, "Update failed try again");
                }   
                
            }
            
        }
                
    
}
?>