<?php
    /**
     * @since: 24/06/2018
     * @author: Sarwar Hasan
     * @version 1.0.0
     */
    
    class APPDatabaseTable
    {
       
        public $fields;
        public $table_name="";
        public $db;
        function __construct($table_name='')
        {
            $this->table_name=$table_name;
           
        }
        
        function AddColumn($columnName,$details)
        {
            $this->fields[$columnName]=$details;
        }
    
        /**
         * @param APPDatabaseColumn $field
         */
        function get_field_sql($field){
            if ($field->default == '') {
                $field->default = "''";
            }
            if (!empty($field->char_set)) {
                $field->char_set = " CHARACTER SET {$field->char_set}";
            }
            if (!empty($field->after)) {
                $field->after = " AFTER {$field->after}";
            }
            $field->fields = static::GetDBFields();
            //GPrint($fields);
            if (isset($field->fields[$field->columnName])) {
                $field->queryType = "MODIFY";
            } else {
                $field->queryType = "ADD";
            }
            if (strtolower($field->type) == "text") {
                $query = "`{$field->columnName}`  {$field->type} $field->char_set {$field->nullstatus}  COMMENT '{$field->comment}' $field->after";
        
            } elseif (strtolower($field->type) == "timestamp") {
                if($field->default=="''"){
                    $field->default="'0000-00-00 00:00:00'";
                }
                $query = "`{$field->columnName}` {$field->type} {$field->nullstatus} DEFAULT $field->default $field->after";
        
            } else {
                $query = "`{$field->columnName}`  {$field->type}({$field->length}) $field->char_set {$field->nullstatus} DEFAULT {$field->default} COMMENT '{$field->comment}' $field->after";
            }
            return $query;
        }
        /**
         * @param APP_Model $modelObject
         */
        function create_process($modelObject){
            $tables = $this->GetUpdateDB()->list_tables();
            $table_name=trim($this->table_name);
            
            if(in_array($table_name,$tables)){
                
                foreach ($this->fields as $field){
                    $dbfields=$modelObject::GetDBFields();
                    if(in_array($field,$dbfields)) {
                        //modify
                        
                    }else{
                       // new
                    }
                    
            }
            }else{
                $myforge = $this->load->dbforge($this->GetUpdateDB(), TRUE);
                $attributes = array('ENGINE' => 'MyISAM');
                foreach ($this->fields as $field){
                
                }
            }
            
        }
        
    }
    
    class APPDatabaseColumn
    {
        public $columnName;
        public $type;
        public $length;
        public $default = '';
        public $nullstatus = 'NOT NULL';
        public $after = '';
        public $comment = '';
        public $char_set = '';
    }