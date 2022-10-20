<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class CORE_Loader extends CI_Loader {
		private $_javascript = array();
		private $_css = array();
		private $_inline_scripting = array("infile"=>"", "stripped"=>"", "unstripped"=>"");
		private $_sections = array();
		private $_cached_css = array();
		private $_cached_js = array();
		private $_template_asset_path="";
		private $_added_css_files=array();
		private $_added_js_files=array();
		private $_remove_css_files=array();
		private $_remove_js_files=array();
		function __construct(){
			
			if(!defined('SPARKPATH'))
			{
				define('SPARKPATH', 'sparks/');
			}
			
			parent::__construct();
			spl_autoload_register(array($this,"_myautoload_method"));
		}
		function _myautoload_method($class){
			// For Model;
			$firstchar=substr($class, 0,1);
			if(strtoupper($firstchar)=="M"){
				$modelfilename=APPPATH."models".DIRECTORY_SEPARATOR;
				if(file_exists($modelfilename.$class.".php")){
					$this->model($class);
					return;
				}elseif(file_exists($modelfilename."database".DIRECTORY_SEPARATOR.$class.".php")){
					$this->model("database/".$class);
					return;
				}elseif(file_exists($modelfilename."sys".DIRECTORY_SEPARATOR.$class.".php")){
					$this->model("sys/".$class);
					return;
				}elseif(file_exists($modelfilename."sys".DIRECTORY_SEPARATOR.ucfirst($class).".php")){
					$this->model("sys/".ucfirst($class));
					return;
				}
				else{
					foreach (glob($modelfilename."database/*.php") as $file){
						$sfilename=basename($file);
						$sfilename=strtolower($sfilename);
						$cfilename=strtolower($class.".php");
						if($sfilename==$cfilename){
							$finalModel="database/".basename($file,".php");
							$this->model($finalModel);
							return;
						}
						
					}
				}
				
			}
			
			// Library
			$class2=str_replace(array("APP_","CI_"),array("",""), $class);
			$libraryfile=APPPATH."libraries".DIRECTORY_SEPARATOR.$class2.".php";
			$systemlib=SYSDIR.DIRECTORY_SEPARATOR."libraries".DIRECTORY_SEPARATOR.$class2.".php";
			if(file_exists($libraryfile)){
				$this->libraryLoadOnly($libraryfile);
				return;
			}
			if(file_exists($systemlib)){
				$this->libraryLoadOnly($systemlib);
				return;
			}
			
			if(file_exists(APPPATH."libraries".DIRECTORY_SEPARATOR.$class.".php")){
				$this->libraryLoadOnly(APPPATH."libraries".DIRECTORY_SEPARATOR.$class.".php");
				return;
			}
			if(file_exists(file_exists(SYSDIR.DIRECTORY_SEPARATOR."libraries".DIRECTORY_SEPARATOR.$class.".php"))){
				$this->libraryLoadOnly(SYSDIR.DIRECTORY_SEPARATOR."libraries".DIRECTORY_SEPARATOR.$class.".php");
				return;
			}
			if(file_exists(APPPATH."libraries".DIRECTORY_SEPARATOR.ucfirst($class).".php")){
				$this->libraryLoadOnly(APPPATH."libraries".DIRECTORY_SEPARATOR.ucfirst($class).".php");
				return;
			}
			if(file_exists(SYSDIR.DIRECTORY_SEPARATOR."libraries".DIRECTORY_SEPARATOR.ucfirst($class).".php")){
				$this->libraryLoadOnly(SYSDIR.DIRECTORY_SEPARATOR."libraries".DIRECTORY_SEPARATOR.ucfirst($class).".php");
				return;
			}
			
			foreach (glob(APPPATH."libraries".DIRECTORY_SEPARATOR."*.php") as $file){
				$sfilename=basename($file);
				$sfilename=strtolower($sfilename);
				$cfilename=strtolower($class.".php");
				if($sfilename==$cfilename){
					$finalModel=basename($file,".php");
					$this->library($finalModel);
					return;
				}
			}
			
			
		}
		public function libraryLoadOnly($file)
		{
			if(file_exists($file)){
				include_once $file;
			}
			
		}
		function db_model($model, $name = '', $db_conn = FALSE){
			return parent::model("database/".$model,$name,$db_conn);
		}
		function sys_model($model, $name = '', $db_conn = FALSE){
			return parent::model("sys/".$model,$name,$db_conn);
		}
		function set_themplate_asset_by_theme($theme){
			$this->_template_asset_path=base_url()."theme/".$theme."/";
		}
		/* Added from others*/

        function css($css_file,$label=10,$isNoneCacheable=false,$isNonVersionable=false,$id=''){
            $base_css=parse_url($css_file, PHP_URL_PATH);
            if(in_array($base_css,$this->_remove_css_files)){
                return;
            }
            $css_file=trim($css_file);
            if(substr($css_file, 0,2)!='//' &&  !preg_match("/^https?:\/\//", $css_file)){
                $is_external = false;
                $css_file = substr($css_file,0,1) == '/' ? substr($css_file,1) : $css_file;
            }elseif(substr($css_file, 0,2)=='///'){
                $is_external = true;
                $css_file = substr($css_file,0,1) == '/' ? substr($css_file,1) : $css_file;
            }else{
                $is_external = true;
            }

            if(is_bool($css_file))
                return;

            $base_css_file=parse_url($css_file, PHP_URL_PATH);
            if(!$is_external)
                if(!file_exists($base_css_file)){
                    show_error("Cannot locate stylesheet file: {$css_file}.");
                }else{
                	if(!$isNonVersionable) {
		                if ( strpos( $css_file, "v=" ) === false ) {
			                $versionvalue = filemtime( $base_css_file );
			                if ( strpos( $css_file, "?" ) !== false ) {
				                $css_file .= "&v=" . $versionvalue;
			                } else {
				                $css_file .= "?v=" . $versionvalue;
			                }
		                }
	                }
                }

            $css_file = $is_external == FALSE ? base_url() . $css_file : $css_file;

            if(!isset($this->_added_css_files[$base_css_file])){
                $css_file_obj=new AppCssFile();
                $css_file_obj->is_combindable=!$is_external;
                $css_file_obj->url=$css_file;
                $css_file_obj->id=$id;
                $css_file_obj->actual_path=$base_css_file;
                if($isNoneCacheable){
                    $css_file_obj->is_combindable=false;
                }
                $this->_added_css_files[$base_css_file]=$label;
                $this->_css[$label][] = $css_file_obj ;
            }

            return;
        }
        function remove_css($css){
            $base_css=parse_url($css, PHP_URL_PATH);
            if(isset($this->_added_css_files[$base_css])){
                $level=$this->_added_css_files[$base_css];
                foreach ($this->_css[$level] as $key=>$file){
                    if($base_css==$file->actual_path){
                        unset($this->_css[$level][$key]);
                        return;
                    }
                }
            }
            $this->_remove_css_files[]=$base_css;
        }
        function remove_js($js){
            $base_script=parse_url($js, PHP_URL_PATH);
            if(isset($this->_added_js_files[$base_script])){
                $level=$this->_added_js_files[$base_script];
                foreach ($this->_javascript[$level] as $key=>$file){
                    if($base_script==$file->actual_path){
                        unset($this->_javascript[$level][$key]);
                        return;
                    }
                }
            }
            $this->_remove_css_files[]=$base_script;
        }
        function js($script_file,$label=10,$isNoneCacheable=false,$isNonVersionAble=false){
            $base_css=parse_url($script_file, PHP_URL_PATH);
            if(in_array($base_css,$this->_remove_js_files)){
                return;
            }
            $script_file=trim($script_file);
            if(substr($script_file, 0,2)!='//' &&  !preg_match("/^https?:\/\//", $script_file)){
                $is_external = false;
                $script_file = substr($script_file,0,1) == '/' ? substr($script_file,1) : $script_file;
            }elseif(substr($script_file, 0,2)=='///'){
                $is_external = true;
                $script_file = substr($script_file,0,1) == '/' ? substr($script_file,1) : $script_file;
            }else{
                $is_external = true;
            }
            if(is_bool($script_file))
                return;

            $base_script=parse_url($script_file, PHP_URL_PATH);
            if(!$is_external){
                if(!file_exists($base_script)){
                    //$script_file=parse_url($script_file, PHP_URL_PATH);
                    show_error("Cannot locate javascript file: {$script_file}.");

                }else{
                	if(!$isNonVersionAble) {
		                if ( strpos( $script_file, "v=" ) === false ) {
			                $versionvalue = filemtime( $base_script );
			                if ( strpos( $script_file, "?" ) !== false ) {
				                $script_file .= "&v=" . $versionvalue;
			                } else {
				                $script_file .= "?v=" . $versionvalue;
			                }
		                }
	                }
                }
            }

            $script_file = $is_external == FALSE ?  base_url() . $script_file : $script_file;

            if(!isset($this->_added_js_files[$base_script])){
                $js_file=new stdClass();
                $js_file->is_combindable=!$is_external;
                $js_file->url=$script_file;
                $js_file->actual_path=$base_script;
                if($isNoneCacheable){
                    $js_file->is_combindable=false;
                }
                $this->_added_js_files[$base_script]=$label;
                $this->_javascript[$label][] = $js_file ;
            }



            return;
        }
        function ResetJs(){
	        $this->_added_js_files=[];
	        $this->_javascript=[];
        }
        function ResetCss(){
	        $this->_added_css_files=[];
	        $this->_css=[];
        }
        function template_js($script_file,$label=10,$isNoneCacheable=false){
            $script_file=$this->_template_asset_path.$script_file;
            $this->js($script_file,$label,$isNoneCacheable);
        }
        function template_css(){
            $script_files = func_get_args();
            foreach($script_files as &$script_file){
                $script_file=$this->_template_asset_path.$script_file;
            }
            return call_user_func_array(array($this,"css"), $script_files);
        }
		
		function start_inline_scripting(){
			ob_start();
		}
		
		function end_inline_scripting($strip_tags=true, $append_to_file=true){
			$source = ob_get_clean();
			
			if($strip_tags){
				$source = preg_replace("/<script.[^>]*>/", '', $source);
				$source = preg_replace("/<\/script>/", '', $source);
			}
			
			if($append_to_file){
				
				$this->_inline_scripting['infile'] .= $source;
				
			}else{
				
				if($strip_tags){
					$this->_inline_scripting['stripped'] .= $source;
				}else{
					$this->_inline_scripting['unstripped'] .= $source;
				}
			}
		}
		
		function &get_css_files(){
			ksort($this->_css);
			return $this->_css;
			
		}
		function __call($func,$args){ call_user_func($this->handle_call,$func,$args,$this);}

        function get_processed_css(&$loaded_css_files=null){
            if(!$loaded_css_files){
                $loaded_css_files = $this->get_css_files();
            }
            $css_files=array();
            foreach ($loaded_css_files as $key=>$css_file_objs){
                foreach ($css_file_objs as $cssfile){
                	
                    $css_files[]=$cssfile;
                }
            }
            return $css_files;
        }
        function get_combined_css(){
            $loaded_css_files = $this->get_css_files();
            $cache_path=FCPATH."/css/min/";
            if(!is_dir($cache_path)){
                @mkdir($cache_path,0755,true);
            }
            if(!is_writable($cache_path)){
                return $this->get_processed_css($loaded_css_files);
            }

            $keystring="";
            $combindablecss=array();
            $NonCombindable_css=array();
            foreach ($loaded_css_files as $key=>$css_file_objs){
                foreach ($css_file_objs as $cssfile){
                    if($cssfile->is_combindable){
                        $keystring.=$cssfile->url.filemtime(FCPATH.$cssfile->actual_path)."_N_";
                        $combindablecss[]=$cssfile->actual_path;
                    }else{
                        $NonCombindable_css[]=$cssfile->url;
                    }
                }
            }
            $keystring=md5($keystring).".css";
            if(!file_exists($cache_path."{$keystring}") ){
                if(class_exists('APPCssCombinder')){
                    $minifier = new APPCssCombinder();
                    foreach ($combindablecss as $cjs){
                        $minifier->AddFile(FCPATH.$cjs);
                    }
                    //die;
                    if($minifier->save($cache_path."{$keystring}",FCPATH)){
                        return array_merge(array(base_url("css/min/{$keystring}")),$NonCombindable_css);
                    }
                }
            }else{
                return array_merge(array(base_url("css/min/{$keystring}")),$NonCombindable_css);
            }
            return  $this->get_processed_js($loaded_css_files);

        }
        function get_cached_css_files(){
            return $this->_cached_css;
        }

        function &get_js_files($is_processed=true){
            ksort($this->_javascript);
            return $this->_javascript;
        }
        function get_processed_js(&$loaded_js_files=null){
            if(!$loaded_js_files){
                $loaded_js_files = $this->get_js_files();
            }
            $js_files=array();
            foreach ($loaded_js_files as $key=>$js_file_objs){
                foreach ($js_file_objs as $jsfile){
                    $js_files[]=$jsfile->url;
                }
            }
            return $js_files;
        }

        function get_combined_js(){
            $loaded_js_files = $this->get_js_files();
            $cache_path=FCPATH."/js/min/";
            if(!is_dir($cache_path)){
                @mkdir($cache_path,0755,true);
            }
            if(!is_writable($cache_path)){
                return $this->get_processed_js($loaded_js_files);
            }

            $keystring="";
            $combindablejs=array();
            $NonCombindablejs=array();
            foreach ($loaded_js_files as $key=>$js_file_objs){
                foreach ($js_file_objs as $jsfile){
                    if($jsfile->is_combindable){
                        $keystring.=$jsfile->url.filemtime(FCPATH.$jsfile->actual_path)."_N_";
                        $combindablejs[]=$jsfile->actual_path;
                    }else{
                        $NonCombindablejs[]=$jsfile->url;
                    }
                }
            }

            $keystring=md5($keystring).".js";
            $filename=$cache_path."/{$keystring}";
            if(!file_exists($filename)){
                $fh = fopen($filename, 'w');
                if($fh){
                    $js_strings="";
                    foreach ($combindablejs as $cjs){
                        //$minifiedCode = \JShrink\Minifier::minify($js);
                        $codestr=file_get_contents($cjs);
                        if(class_exists('\JShrink\Minifier')){
                            $codestr=\JShrink\Minifier::minify($codestr);
                        }
                        fwrite($fh,"\n\n/*{$cjs}*/\n".$codestr);
                    }
                    fclose($fh);
                }
                return array_merge(array(base_url("js/min/{$keystring}")),$NonCombindablejs);

            }else{
                return array_merge(array(base_url("js/min/{$keystring}")),$NonCombindablejs);
            }
            return  $this->get_processed_js($loaded_js_files);

        }

        function get_cached_js_files(){
            return $this->_cached_js;
        }

        function get_inline_scripting(){
            return $this->_inline_scripting;
        }
		
		/**
		 * Loads the requested view in the given area
		 * <em>Useful if you want to fill a side area with data</em>
		 * <em><b>Note: </b> Areas are defined by the template, those might differs in each template.</em>
		 *
		 * @param string $area
		 * @param string $view
		 * @param array $data
		 * @return string
		 */
		function section($area, $view, $data=array()){
			if(!array_key_exists($area, $this->_sections))
				$this->_sections[$area] = array();
			
			$content = $this->view($view, $data, true);
			
			$checksum = md5( $view . serialize($data) );
			
			$this->_sections[$area][$checksum] = $content;
			
			return $checksum;
		}
		
		function get_section($section_name)
		{
			$section_string = '';
			if(isset($this->_sections[$section_name]))
				foreach($this->_sections[$section_name] as $section)
					$section_string .= $section;
			
			return $section_string;
		}
		/**
		 * Gets the declared sections
		 *
		 * @return object
		 */
		function get_sections(){
			return (object)$this->_sections;
		}
		function msg_decode(&$msg){
			$msg=strip_tags($msg);
		}
		/*
		 * Can load a view file from an absolute path and
		 * relative to the CodeIgniter index.php file
		 * Handy if you have views outside the usual CI views dir
		 */
		function viewfile($viewfile, $vars = array(), $return = FALSE)
		{
			return $this->_ci_load(
				array('_ci_path' => $viewfile,
				      '_ci_vars' => $this->_ci_object_to_array($vars),
				      '_ci_return' => $return)
			);
		}
		/**
		 * View Loader
		 *
		 * Loads "view" files.
		 *
		 * @param	string	$view	View name
		 * @param	array	$vars	An associative array of data
		 *				to be extracted for use in the view
		 * @param	bool	$return	Whether to return the view output
		 *				or leave it to the Output class
		 * @return	object|string
		 */
		public function view($view, $vars = array(), $return = FALSE)
		{
			return parent::view($view,$vars,$return);
		}
		
		function getModule($module_name,$data=[]){
			$ci=get_instance();
			$currentTheme="themes/".$ci->output->get_app_theme()."/modules/";
			$themepath=VIEWPATH.$currentTheme;
			if(file_exists(VIEWPATH."override/modules/{$module_name}.php")){
				return $ci->load->view("override/modules/{$module_name}",$data,true);
			}elseif(file_exists($themepath."{$module_name}.php")){
				return $ci->load->view($currentTheme.$module_name,$data,true);
			}
			return $ci->load->view("modules/{$module_name}",$data,true);
		}
		
		
	}

