<?php
class APP_API{
	private static $_loaded_api=[];
	private $configs_field=[];
	private $db_config_field=[];
	public $config_post_field=[];
	private $config_default_value=[];
	static $API_TYPE_BOTH="B";
	static $API_TYPE_FIELD="F";
	static $API_TYPE_POST="P";
	private $api_type="B";
	public $menu_icon="fa fa-circle-o";
	private static $loaded_by=[];
	final static function AddAPI($api_name,$loaded_by=""){		
		$api_fullname=str_replace(".php", "", $api_name)."API";
		$api_filename="{$api_fullname}.php";
		$addon_paths=self::get_addons_path_list();		
		foreach ($addon_paths as $path){
			if(self::load_plugin($api_name, $api_fullname, $path.DIRECTORY_SEPARATOR.$api_filename)){
				self::$loaded_by[$api_name]=$loaded_by;
				return true;
			}
			if(self::load_plugin($api_name, $api_fullname, $path.DIRECTORY_SEPARATOR.$api_fullname.DIRECTORY_SEPARATOR.$api_filename)){
				self::$loaded_by[$api_name]=$loaded_by;
				return true;
			}			
		}		
		return false;
	}
    final static function AddAPIByFilePath($filePath,$loaded_by=""){
        $api_name=substr(basename($filePath,'.php'),0,-3);
        $api_full_name=basename($filePath,'.php');
        if(self::load_plugin($api_name, $api_full_name, $filePath)){
            self::$loaded_by[$api_name]=$loaded_by;
            return true;
        }else{
            return false;
        }
    }
	final static function get_addons_path_list(){
		return [
				APPPATH."libraries".DIRECTORY_SEPARATOR."app_api",				
				FCPATH."addons"
		];
	}
	final private static function load_plugin($api_name,$api_fullname,$path){
		if(file_exists($path)){
			include_once $path;
			if(class_exists($api_fullname)){
				self::$_loaded_api[$api_name]=new $api_fullname();
				self::$_loaded_api[$api_name]->initial_loading();
				return true;
			}
		}
		return false;
	}
	final static function get_loaded_api_list_icon($type=''){
		
			$response=[];
			foreach (self::$_loaded_api as $key=>$api){
				if($api->api_type!=self::$API_TYPE_BOTH && !empty($type) && $api->api_type!=$type){
				    continue;
					
				}
				$response[$key]=$api->menu_icon;
			}
			
			return $response;
		
	}
	function get_menu_title(){
	    return $this->get_name();
    }
	
	/**
	 * @param string $type
	 *
	 * @return self[]
	 */
	final static function get_loaded_api_list($type='') {
		$response = [];
		if ( empty( $type ) ) {
			foreach ( self::$_loaded_api as $key => $api ) {
				
				$response[] = $api;
				
			}
			
			return $response;
		} else {
			
			foreach ( self::$_loaded_api as $key => $api ) {
				if ( $api->api_type == self::$API_TYPE_BOTH || $api->api_type == $type ) {
					$response[] = $api;
				}
			}
			
			return $response;
		}
	}
	final static function get_addon_loaded_by_list(){
		return self::$loaded_by;
	}
	final static function is_loaded_by_hook($api_name){
		if(!empty(self::$loaded_by[$api_name]) && self::$loaded_by[$api_name]=="h"){
			return true;
		}
		return self::$loaded_by;
	}
	
	/**
	 * @param unknown $api_name
	 * @return APP_API
	 */
	final static function &get_api_object($api_name){
		if(!isset(self::$_loaded_api[$api_name])){
			if(!self::AddAPI($api_name)){
				return NULL;
			}
		}
		return  self::$_loaded_api[$api_name];
	} 
	final function initial_loading(){
		$this->set_configuration_list();
		
		/*foreach ($this->configs_field as $gorup){
			foreach ($gorup as $field){
				$this->config_default_value[$field->name]=$field;
			}
		}*/
		$this->LoadDBValue();
		$this->SetAdminMenu();
	}
	function SetAdminMenu(){
	   
    }
	final public function LoadDBValue(){
		$totalConfig=count($this->configs_field);		
		$result=Mapp_setting_api::FindAllBy("s_api_name", $this->get_name());			
		foreach ($result as $dbc){			
			$this->db_config_field[$dbc->s_key]=$dbc->s_val;
		}	
		
		foreach ($this->config_default_value as $fld){
			if(!isset($this->db_config_field[$fld->name])){
				//$fld=new APP_API_Input_config();
				Mapp_setting_api::AddSettings($this->get_name(), $fld->name, $fld->default_value, $fld->title,false,$fld->type,$fld->option);
				$this->db_config_field[$fld->name]=$fld->default_value;
			}
		}
			
	}
	final function get_name(){
		$name=get_class($this);
		$name=substr($name, 0,-3);
		return $name;
	}
	final function get_configuration_list(){
		return $this->configs_field;
	}
	final function save_configuation(&$message=null){
		if($this->valid_configuration($this->config_post_field,$message)){
			$api_name=$this->get_name();
			$isOk=true;
			$message="";
			foreach ($this->config_post_field as $fld=>$val){
				if(!Mapp_setting_api::UpdateSettings($api_name,$fld, $val)){
					//$isOk=false;
					/*if(isset($this->config_default_value[$fld])){
						$message.=$this->config_default_value[$fld]->title." save failed. ";
					}*/
				}else{
					$this->db_config_field[$fld]=$val;
				}
			}
			return $isOk;
		}
		return false;
	}
	final function save_hidden_config($key,$value){
		$api_name=$this->get_name();
		if(Mapp_setting_api::UpdateSettings($api_name,$key, $value)){
			$this->db_config_field[$key]=$value;
		}
	}
	final function get_process_button_link(){
		return site_url("admin/api-setting/process-api/".$this->get_name());
	}
	final function get_config_value($key){
		if(isset($this->db_config_field[$key])){
			return $this->db_config_field[$key];
		}
		return null;
	}
	final function set_post_values(){
		if(IsPostBack){
			$this->config_post_field=PostValue($this->get_name());
		}
	}
	final function GetPostValue($key,$isXsClean=true){
		$default = $this->get_config_value($key);
		$ci=get_instance();
		$postvalue=$ci->input->post($key,$isXsClean);			
		return $postvalue===0 || !empty($postvalue)?$postvalue:$default;
	}
	final function addInputHidden($name,$default_value){
		$this->configs_field["__app__hidden"][]=APP_API_Input_config::getInputHidden($name,$default_value);
	}
	
	
	/**
	 * @param string $group
	 * @param string $title
	 * @param string $name
	 * @param string $note
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $class
	 * @param string $form_group_class
	 * @param string $validator
	 */
	final function addInputText($group,$title,$name,$note='',$default_value="",$is_required=true,$class="",$form_group_class="",$validator=""){		
		$obj=APP_API_Input_config::getInputText($title,$name,$note,$default_value,$is_required,$class,$form_group_class,$validator);	
		$this->config_default_value[$name]=$obj;
		$this->configs_field[$group][]=$obj;
	}
	
	final function addHtml($group,$Html){
		$this->configs_field[$group][]=$Html;
	}
	
	
	/**
	 * @param string $group
	 * @param string $title
	 * @param string $name
	 * @param string $note
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $class
	 * @param string $form_group_class
	 * @param string $validator
	 */
	final function addInputNumber($group,$title,$name,$note='',$default_value="",$is_required=true,$class="",$form_group_class="",$validator=""){		
		$obj=APP_API_Input_config::getInputNumber($title, $name,$note,$note,$default_value,$is_required,$class,$form_group_class,$validator);
		$this->config_default_value[$name]=$obj;
		$this->configs_field[$group][]=$obj;
	}
	
	

	/**
	 * @param string $group
	 * @param string $title
	 * @param string $name
	 * @param string $note
	 * @param string $default_value
	 * @param string $class
	 * @param string $form_group_class
	 */
	final function addInputToggle($group,$title,$name,$note='',$default_value="",$class="",$form_group_class=""){
		$obj=APP_API_Input_config::getInputToggle($title, $name,$note,$default_value,$class,$form_group_class);
		$this->config_default_value[$name]=$obj;
		$this->configs_field[$group][]=$obj;
	}
	
	/**
	 * @param string $group
	 * @param string $title
	 * @param string $name
	 * @param array $option
	 * @param string $note
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $class
	 * @param string $form_group_class
	 */
	final function addInputDropdown($group,$title,$name,array $option,$note='',$default_value="",$is_required=true,$class="",$form_group_class=""){
		$obj=APP_API_Input_config::getInputDropdown($title, $name, $option,$note,$default_value,$is_required,$class,$form_group_class);
		$this->config_default_value[$name]=$obj;
		$this->configs_field[$group][]=$obj;
	}

	/**
	 * @param string $group
	 * @param string $title
	 * @param string $name
	 * @param array $option
	 * @param unknown $note
	 * @param string $default_value
	 * @param string $is_required
	 * @param string $class
	 * @param string $form_group_class
	 */
	final function addInputRadio($group,$title,$name,array $option,$note,$default_value="",$is_required=true,$class="",$form_group_class=""){
		$obj=APP_API_Input_config::getInputRadio($title, $name, $option,$note,$default_value,$is_required,$class,$form_group_class);
		$this->config_default_value[$name]=$obj;
		$this->configs_field[$group][]=$obj;
	}
	final function set_api_type($type){
		$this->api_type=$type;
	}
	
	function set_configuration_list(){
		
	}
	
	final function is_api_type($type){
		return $this->api_type==$type;
	}
	function valid_configuration(array &$post_data,&$message=null){
		return true;
	}
	
	/**
	 * @param string|integer $field_value
	 * @return APP_Field_API_Response
	 */
	function get_api_response($field_value){
		return new APP_Field_API_Response();
	}
	function is_valid_field_value($field_value,&$message=null){		
		$obj=$this->get_api_response($field_value);
		if($obj instanceof APP_Field_API_Response){			
			$message=$obj->msg;
		return $obj->status;
		}
		$message="Invalid type of response";
		return false;
	}
	function on_ticket_save($param_data){
		return;
	}
	
	final function GetAddForm($label_col=4,$input_col=8,$mainobj=null){
		if(!$mainobj){
			$mainobj=$this;
		}
		$is_horizontal=true;
		if(empty($label_col) || strtolower($label_col)=="n"){
			$is_horizontal=false;
		}
		foreach ($this->configs_field as $group_title=>$group){
			if($group_title=="__app__hidden")continue;
			?>
			<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php _e($group_title);?></h3>    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">	
                <?php if(!$is_horizontal){?>
                <div class="col-md-12">
                <?php }?>
			<?php 
			foreach ($group as $field){
			    if(is_string($field)){
			        echo $field;
			        continue;
                }
				if(!$field){
				$field=new APP_API_Input_config();
				}
				
			?>	
			  <div class="form-group <?php echo $field->form_group_class;?> ">
		      	<label class="control-label <?php echo $field->is_required?"label-required":""?> <?php echo $is_horizontal?"col-md-".$label_col:"";?>" for="<?php echo $field->name;?>"><?php _e($field->title); ?></label>
		      	<?php if($is_horizontal){?><div class="col-md-<?php echo $input_col;?>">   <?php }
		      	if($field->type=="T" || $field->type=="N"){
		      		//GPrint($field);
		      		$dvaluee=$mainobj->GetPostValue($field->name);
		      	    if(ISDEMOMODE){
		      	        $dvaluee="Demo Mode Default Data";
		      	    }
		      	?>                			     	
		      		
		      		<input type="text" maxlength="100"   
		      		value="<?php echo  $dvaluee;?>" class="form-control <?php echo $field->class;?>" id="<?php echo $field->name;?>" name="<?php echo $mainobj->get_name()."[{$field->name}]";?>"   
		      		placeholder="<?php _e($field->title); ?>" 
		      		<?php if($field->is_required){?>
		      		data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",$field->title);?>"
		      		<?php }?>
		      		>
		      		<?php if(!empty($field->note)){?>
		      		<span class="form-group-help-block"><?php _e($field->note);?></span>
		      		<?php }
		      		
		      	}elseif($field->type=="D"){
							  //GPrint($field);
							  $dvaluee=$mainobj->GetPostValue($field->name);
							  if(ISDEMOMODE){
								  $dvaluee="Demo Mode Default Data";
							  }
							  ?>

                              <select type="text"  class="form-control <?php echo $field->class;?>" id="<?php echo $field->name;?>"
                                      name="<?php echo $mainobj->get_name()."[{$field->name}]";?>"
                                     placeholder="<?php _e($field->title); ?>"
								  <?php if($field->is_required){?>
                                      data-bv-notempty="true" data-bv-notempty-message="<?php  _e("%s is required",$field->title);?>"
								  <?php }?>
                              ><?php
                              GetHTMLOptionByArray($field->option,$dvaluee)    ;
                                  ?>
                              </select>
							  <?php if(!empty($field->note)){?>
                                  <span class="form-group-help-block"><?php _e($field->note);?></span>
							  <?php }
							
						  }elseif($field->type=="O"){
					?>
					  
					     	<div class="togglebutton ">
						    	<input  name="<?php echo $mainobj->get_name()."[{$field->name}]";?>" value="N" type="hidden">
								<label> 
									<input  type="checkbox" <?php echo $mainobj->GetPostValue($field->name,"Y")=="Y"?' checked="checked"':'';?> value="Y" class="<?php echo $field->class;?>" id="<?php echo $field->name;?>"  name="<?php echo $mainobj->get_name()."[{$field->name}]";?>" > 
								</label>
								<?php if(!empty($field->note)){?>
					      		<span class="form-group-help-block"><?php _e($field->note);?></span>
					      		<?php }?>
							</div>
							
				      
					<?php 
				}elseif($field->type=="R"){					
					?>
					  <div class="inline radio-inline">
			        <?php 
			            $__api_input_selected= $mainobj->GetPostValue($field->name);			           
			            GetHTMLRadioByArray($field->title,$mainobj->get_name()."[{$field->name}]",$field->name,true,$field->option,$__api_input_selected,false,true,$field->class);
			            ?>
			        
			       </div> 
			       <?php if(!empty($field->note)){?>
					      		<span class="form-group-help-block"><?php _e($field->note);?></span>
					      		<?php }?>
					     	
							
				      
					<?php 
				}
		      		?>
		      		
		      	<?php if($is_horizontal){?></div><?php }?>
		      </div>   
                
			<?php 
				
			}
			?>
			<?php if(!$is_horizontal){?>
                </div>
                <?php }?>	  	
                </div>
                <!-- /.box-body -->               
                <!-- /.footer -->
         	</div>
         <!-- /.box -->
			<?php 
		}
		
	}
	
	/**
	 * @param APP_Field_API_Response $response_data
	 * @return string
	 */
	function get_html_display_by_response($response_data){
		return "Not override in ".get_class($this);
	}
	function get_api_description(){
		return '';
	}
	function do_porcess(){
		return "there is not to do process of this API";
	}
}
