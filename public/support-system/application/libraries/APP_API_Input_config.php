<?php
class APP_API_Input_config{	
	public $type;
	public $title;
	public $name;
	public $default_value="";	
	public $option=array();
	public $is_required=false;
	public $note="";
	public $validator="";
	public $class="";
	public $form_group_class="";	
	/**
	 * @param string $title
	 * @param string $name
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $validator
	 * @return APP_API_Input_config
	 */
	static function getInputHidden($name,$default_value=""){
		$obj=new self();
		$obj->type="H";
		$obj->name=$name;		
		$obj->default_value=$default_value;		
		return $obj;
	}
	/**
	 * @param string $title
	 * @param string $name
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $validator
	 * @return APP_API_Input_config
	 */
	static function getInputText($title,$name,$note='',$default_value="",$is_required=true,$class="",$form_group_class="",$validator=""){
		//$a=func_get_args();
		//GPrint($a);
		$obj=new self();
		$obj->type="T";
		$obj->name=$name;
		$obj->title=$title;
		$obj->is_required=$is_required;
		$obj->validator=$validator;
		$obj->default_value=$default_value;
		$obj->note=$note;
		$obj->class=$class;
		$obj->form_group_class=$form_group_class;
		return $obj;		
	}
	
	/**
	 * @param string $title
	 * @param string $name
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $validator
	 * @return APP_API_Input_config
	 */
	static function getInputNumber($title,$name,$note='',$default_value="",$is_required=true,$class="",$form_group_class="",$validator=""){
		$obj=new self();
		$obj->title=$title;
		$obj->type="N";
		$obj->name=$name;
		$obj->validator=$validator;
		$obj->default_value=$default_value;
		$obj->note=$note;
		$obj->class=$class;
		$obj->form_group_class=$form_group_class;
		return $obj;		
	}
	
	/**
	 * @param unknown $title
	 * @param unknown $name
	 * @param string $default_value must be  Y or N;
	 * @return APP_API_Input_config
	 */
	static function getInputToggle($title,$name,$note='',$default_value="",$class="",$form_group_class=""){
		$obj=new self();
		$obj->title=$title;
		$obj->type="O";
		$obj->name=$name;		
		$obj->note=$note;
		$obj->default_value=$default_value;
		$obj->class=$class;
		$obj->form_group_class=$form_group_class;
		return $obj;
	}
	/**
	 * @param string $title
	 * @param string $name
	 * @param array $option
	 * @param string $default_value
	 * @param string $is_required
	 * @return APP_API_Input_config
	 */
	static function getInputDropdown($title,$name,array $option,$note='',$default_value="",$is_required=true,$class="",$form_group_class=""){
		$obj=new self();
		$obj->title=$title;
		$obj->type="D";
		$obj->name=$name;
		$obj->option=$option;
		$obj->note=$note;
		$obj->default_value=$default_value;
		$obj->class=$class;
		$obj->form_group_class=$form_group_class;
		return $obj;
	}
	/**
	 * @param string $title
	 * @param string $name
	 * @param array $option
	 * @param string $default_value
	 * @param string $is_required
	 */
	static function getInputRadio($title,$name,array $option,$note='',$default_value="",$is_required=true,$class="",$form_group_class=""){
		$obj=new self();
		$obj->title=$title;
		$obj->type="R";
		$obj->name=$name;
		$obj->option=$option;
		$obj->note=$note;
		$obj->default_value=$default_value;
		$obj->class=$class;
		$obj->form_group_class=$form_group_class;
		return $obj;
	}
}