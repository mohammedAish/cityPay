<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Hybridauth Class
 */
class Hybridauth {

  /**
   * Reference to the Hybrid_Auth object
   *
   * @var Hybrid_Auth
   */
  public $HA;

  /**
   * Reference to CodeIgniter instance
   *
   * @var CI_Controller
   */
  protected $CI;

  /**
   * Class constructor
   *
   * @param array $config
   */
  public $current_config=null;
  public function __construct($config = array())
  {
    $this->CI =& get_instance();
    // Load the HA config.
    if (!$this->CI->load->config('hybridauth'))
    {
      log_message('error', 'Hybridauth config does not exist.');

      return;
    }

    // Get HA config.
    $config = $this->CI->config->item('hybridauth');
    $provider=&$config['providers'];
      //google
      if(Mapp_setting_api::GetSettingsValue("social", "is_enable_envt_login","N")=="Y"){
          $provider['Envato']['keys']=array(
              "id"     => Mapp_setting_api::GetSettingsValue("social", "login_envt_client_id",""),
              "secret" => Mapp_setting_api::GetSettingsValue("social", "login_envt_secret","")
          );
          if(!empty($provider['Envato']['keys']['id']) && !empty($provider['Envato']['keys']['secret'])){
              $provider['Envato']['enabled']=TRUE;
          }
      }
      //google
    if(Mapp_setting_api::GetSettingsValue("social", "is_enable_g_login","N")=="Y"){       
        $provider['Google']['keys']=array(
            "id"     => Mapp_setting_api::GetSettingsValue("social", "login_g_client_id",""),
            "secret" => Mapp_setting_api::GetSettingsValue("social", "login_g_secret","")            
        );
        if(!empty($provider['Google']['keys']['id']) && !empty($provider['Google']['keys']['secret'])){
            $provider['Google']['enabled']=TRUE;
        }
    }    
    //facebook
    if(Mapp_setting_api::GetSettingsValue("social", "is_enable_f_login","N")=="Y"){        
        $provider['Facebook']['keys']=array(
            "id"     => Mapp_setting_api::GetSettingsValue("social", "login_f_client_id",""),
            "secret" => Mapp_setting_api::GetSettingsValue("social", "login_f_secret","")            
        );
        if(!empty($provider['Facebook']['keys']['id']) && !empty($provider['Facebook']['keys']['secret'])){
            $provider['Facebook']['enabled']=TRUE;
        }
    }
    //twitter
    if(Mapp_setting_api::GetSettingsValue("social", "is_enable_t_login","N")=="Y"){        
        $provider['Twitter']['keys']=array(
            "key"     => Mapp_setting_api::GetSettingsValue("social", "login_t_client_id",""),
            "secret" => Mapp_setting_api::GetSettingsValue("social", "login_t_secret","")           
        );
        if(!empty($provider['Twitter']['keys']['key']) && !empty($provider['Twitter']['keys']['secret'])){
            $provider['Twitter']['enabled']=TRUE;
        }
    }    
    
    //GitHub
    if(Mapp_setting_api::GetSettingsValue("social", "is_enable_gh_login","N")=="Y"){
        $provider['GitHub']['keys']=array(
            "id"     => Mapp_setting_api::GetSettingsValue("social", "login_gh_client_id",""),
            "secret" => Mapp_setting_api::GetSettingsValue("social", "login_gh_secret","")
        );
        if(!empty($provider['GitHub']['keys']['id']) && !empty($provider['GitHub']['keys']['secret'])){
            $provider['GitHub']['enabled']=TRUE;
        }
    }
    //LinkedIn
    if(Mapp_setting_api::GetSettingsValue("social", "is_enable_l_login","N")=="Y"){
        $provider['LinkedIn']['keys']=array(
            "id"     => Mapp_setting_api::GetSettingsValue("social", "login_l_client_id",""),
            "secret" => Mapp_setting_api::GetSettingsValue("social", "login_l_secret","")
        );
        if(!empty($provider['LinkedIn']['keys']['id']) && !empty($provider['LinkedIn']['keys']['secret'])){
            $provider['LinkedIn']['enabled']=TRUE;
        }
    }
    //LinkedIn
    if(Mapp_setting_api::GetSettingsValue("social", "is_enable_y_login","N")=="Y"){
        $provider['Yahoo']['keys']=array(
            "id"     => Mapp_setting_api::GetSettingsValue("social", "login_y_client_id",""),
            "secret" => Mapp_setting_api::GetSettingsValue("social", "login_y_secret","")
        );
        if(!empty($provider['Yahoo']['keys']['id']) && !empty($provider['Yahoo']['keys']['secret'])){
            $provider['Yahoo']['enabled']=TRUE;
        }
    }
    // Specify base url to HA Controller.
    $config['base_url'] = $this->CI->config->site_url('index.php/social/endpoint');
   // GPrint($config);die;
   $this->current_config=$config;
    try
    {
      // Load HA library.
      $this->_init();

      // Initialize Hybrid_Auth.
      $this->HA = new Hybrid_Auth($config);

      log_message('info', 'Hybridauth Class is initialized.');
    }
    catch (Exception $e)
    {
	    throw new Exception($e->getMessage(), $e->getCode());
    	/*if(ENVIRONMENT=='development'){
		    show_error($e->getMessage());
	    }else{
		    throw new Exception($e->getMessage(), $e->getCode());
	    }*/
    }
  }

  /**
   * Process the HA request
   */
  public function process()
  {
    $this->_init('Hybrid_Endpoint');

    Hybrid_Endpoint::process();
  }

  /**
   * Initialize HA library
   *
   * @param string $class_name The class name to initialize
   *
   * @throws \Exception
   */
  protected function _init($class_name = 'Hybrid_Auth')
  {
    list($dir, $filename) = explode('_', $class_name);

    if (class_exists($class_name))
    {
      // Nothing to do here. Most probably the class is loaded by composer_autoload.
    }
    elseif (file_exists(APPPATH . "third_party/hybridauth/hybridauth/{$dir}/{$filename}.php"))
    {
      // In case when the library is placed in third_party/hybridauth.
      require_once APPPATH . "third_party/hybridauth/hybridauth/{$dir}/{$filename}.php";
    }
    elseif (file_exists(FCPATH . 'vendor/autoload.php'))
    {
      // Finally try to load the given class from CI autoload.
      require_once FCPATH . 'vendor/autoload.php';
    }

    if (!class_exists($class_name))
    {
      throw new Exception("Could not load the {$class_name} class.");
    }

    log_message('info', "{$class_name} class is loaded.");
  }

}
