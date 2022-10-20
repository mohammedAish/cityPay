<?php

class MAddonManagerModel extends APP_Model
{
    public static $selfobj;
    function __construct()
    {
        parent::__construct();

    }
    function create_table($table_name,$query)
    {
	    if(strpos($this->GetSelectDB()->database,'.')!==false){
		    $tables=[];
		    $tables_obj=$this->SelectQuery("SHOW TABLES FROM `{$this->GetSelectDB()->database}`",true);
		    foreach ($tables_obj as $t){
		    	foreach ($t as $v){
				    $tables[]=$v;
				    break;
			    }
		    }
	    }else {
		    $tables = $this->GetSelectDB()->list_tables();
	    }
        $table_name = trim($table_name);
        if (!in_array($table_name, $tables)) {
            $result = $this->GetSelectDB()->query($query);
	        
            if (!$result) {
                Mdebug_log::AddGeneralLog("Database table creation failed",Mdebug_log::STATUS_FAILED,Mdebug_log::STATUS_SUCCESS,$query);
            }
        }
    }
}