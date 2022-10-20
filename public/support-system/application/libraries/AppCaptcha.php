<?php
class AppCaptcha {
	
	private static $captcha_type=null;
	
	static function get_chapcha_html($class="",$input_class=''){
		if(empty(self::$captcha_type)){
			self::$captcha_type=Mapp_setting::GetSettingsValue("app_captcha","D");
		}
		if(self::$captcha_type=="D"){
			return @self::getDefaultCapchaHtml($class,$input_class);
		}elseif(self::$captcha_type=="G"){
			return Recaptcha::get_chapcha_html($class,$input_class);
		}
		
	}
    static function get_chapcha_html_bs_4($class="",$input_class=''){
        if(empty(self::$captcha_type)){
            self::$captcha_type=Mapp_setting::GetSettingsValue("app_captcha","D");
        }
        if(self::$captcha_type=="D"){
            return @self::getDefaultCapchaHtml_bs4($class,$input_class);
        }elseif(self::$captcha_type=="G"){
            return Recaptcha::get_chapcha_html($class,$input_class);
        }

    }
	static function is_valid_captcha(){
		if(empty(self::$captcha_type)){
			self::$captcha_type=Mapp_setting::GetSettingsValue("app_captcha","D");
		}
		if(self::$captcha_type=="D"){
			$user_response=PostValue("app_captcha_response");
			return self::capchaValid($user_response);
		}elseif(self::$captcha_type=="G"){
			$user_response=PostValue("g-recaptcha-response");
			return Recaptcha::is_valid_response($user_response);
		}
		AddError("Captcha Setting Error",true);
		return false;
	
	}
	static function getDefaultCapchaImageTag(){
		$obj=self::getDefaultCapcha();
		return '<img class="app-captcha-img " src="'.$obj->img_inline.'" alt="Captcha Image" />';
	}
	static function getDefaultCapchaInputTag($input_class=''){		
		return '<input data-bv-notempty="true"	 data-bv-notempty-message="'.__("Captcha is required").'" class="app-captcha-input '.$input_class.'" type="text" name="app_captcha_response" value=""/>';
	}
    private static function getDefaultCapchaHtml_bs4($class='',$input_class=''){
        $obj=self::getDefaultCapcha();
        ob_start();
        ?>
        <div class="card">
            <div class="card-body pb-2">
                <div class="app-default-captcha m-0 <?php echo $class;?>">
                    <?php
                    echo self::getDefaultCapchaInputTag($input_class);
                    echo self::getDefaultCapchaImageTag();
                    ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
   }
	private static function getDefaultCapchaHtml($class='',$input_class=''){
		$obj=self::getDefaultCapcha();
		ob_start();
		?>
		<div class="app-default-captcha <?php echo $class;?>">
			<?php 
			
			echo self::getDefaultCapchaInputTag($input_class);
			echo self::getDefaultCapchaImageTag();
			?>			
		</div>
		<?php 
		return ob_get_clean();
	}
	private static function get_captcha_key($keystr){
		return "A".hash("crc32b",$keystr."appsbd.com"."1568255");
	}
	private static function getDefaultCapcha(){
		$captchaLength=Mapp_setting::GetSettingsValue("ap_dc_length",6);
		$captchaType=Mapp_setting::GetSettingsValue("ap_dc_str_type","AN");
		if($captchaType=="NU"){
			$phraseBuilder = new Gregwar\Captcha\PhraseBuilder($captchaLength,'123456789');
			
		}else{
			$phraseBuilder = new Gregwar\Captcha\PhraseBuilder($captchaLength);
			
		}		
		$captcha = new Gregwar\Captcha\CaptchaBuilder(NULL,$phraseBuilder);
		$captcha->setBackgroundColor(255,255,255);	
		$keystr=$captcha->getPhrase();
		//$captcha->se
		$width=35*$captchaLength;
		$captcha->build($width,50);
		$key=self::get_captcha_key($keystr);
		$ci=get_instance();
		$ci->session->SetSession($key, $keystr);
		$_SESSION[$key]=$keystr;		
		$obj=new stdClass();
		$obj->key=$key;
		$obj->img_inline=$captcha->inline();
		return $obj;
	}
	
	private static function capchaValid($capchaText){
		$key=self::get_captcha_key($capchaText);
		$ci=get_instance();
		$session_key=$ci->session->GetSession($key);
		
		if(!empty($session_key)){
			$isOk=$session_key==$capchaText;
			$ci->session->UnsetSession($key);
			return $isOk;
		}
		AddError("Captcha Error");
		return false;
	}
	
}