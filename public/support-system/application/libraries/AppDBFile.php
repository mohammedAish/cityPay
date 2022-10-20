<?php
class AppDBFile{
   public $mysqlobj=null;
   private $is_connected="NOT";
   private $host;
   private $user;
   private $password;
   private $database;
   private $error_string="";
   function __construct(){       
       $m=new Mapp_user();
       $db=$m->GetSelectDB();       
       $this->host=$db->hostname;
       $this->user=$db->username;
       $this->password=$db->password;
       $this->database=$db->database;
       ob_start();
       $this->mysqlobj=new mysqli( $this->host, $this->user, $this->password, $this->database);
       //$this->mysqlobj->select_db($database);
       if($this->isConnected()){
        $this->mysqlobj->set_charset("utf8");
       }
       ob_get_clean();
       $this->error_string="";
   } 
   function __destruct(){
        if($this->is_connected){            
            $this->mysqlobj->close();
        }
   }
   function query($query){
       //$this->mysqlobj->store_result();
       return $this->mysqlobj->query($query);
   }
   function multi_query($query){
      // GPrint($this->database);
       //$this->mysqlobj->select_db($this->database);
       if($this->mysqlobj->multi_query($query)){       
           do {              
               if ($result = $this->mysqlobj->store_result()) {                  
                   $result->free();
               }              
           } while (@$this->mysqlobj->next_result());
           return true;
       }
       return false;
   }
   function processSQLFile($file){
       if(file_exists($file)){
           $commands = file_get_contents($file);
            if($this->isConnected(true)){
               if(!$this->multi_query($commands)){
                   $this->error_string=print_r($this->mysqlobj->error,true);
                    return false;                  
               }else{
                   return true;
               }
            }
           
       }else{
           $this->error_string="Error, file not exist in : ".$file;           
       }
      return false;
       
   }
   function file_get_contents_utf8($fn) {
       $content = file_get_contents($fn);
       return mb_convert_encoding($content, 'UTF-8',
           mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
   }
   function isConnected($isSetErrorMessage=true){
       if($this->is_connected=="NOT"){ 
           ob_start();
           $is_ok=true;
            if($this->mysqlobj->connect_errno){
                $is_ok=false;
                if($isSetErrorMessage){
                    if($this->mysqlobj->connect_errno==2002){
                        $this->error_string="Connect failed:No such host is known";
                    }else{
                         $this->error_string="Connect failed:".$this->mysqlobj->connect_error;
                    }
                }
            }
    
            
            /* check if server is alive */
            if ($is_ok && !$this->mysqlobj->ping()) {
                if($isSetErrorMessage){  echo (sprintf ("Error: ".$mysqli->error)); }
            }
            ob_get_clean();
            $this->is_connected=$is_ok;
       }
       return $this->is_connected;
   }   
   function getError(){
       return $this->error_string;
   }
    
}