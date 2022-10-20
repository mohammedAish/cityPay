<?php

use Backpack\Settings\app\Models\Setting as  GeneralSetting;
use \Illuminate\Support\Str;
use Carbon\Carbon;

function get_image($image,$clean = ''){
    return file_exists($image) && is_file($image)? asset($image).$clean :asset(config('constants.image.default'));
}


function slug($string){
    return Illuminate\Support\Str::slug($string);
}


function description_shortener($string,$length = null){
    if (empty($length)) {
        $length = config('constants.stringLimit.default');
    }

    return Illuminate\Support\Str::limit($string,$length);
}


function sidenav_active($routename,$class = 'active open'){
    if (is_array($routename)) {
        foreach ($routename as $key => $value) {
            if (request()->routeIs($value)) {
                return $class;
            }
        }
    } elseif (request()->routeIs($routename)) {
        return $class;
    }
}


function show_datetime($date,$format = 'd M, Y h:i a'){
    return \Carbon\Carbon::parse($date)->format($format);
}


function shortcode_replacer($shortcode,$replace_with,$template_string){
    return str_replace($shortcode,$replace_with,$template_string);
}


function verification_code($length){
    if ($length == 0) {
        return 0;
    }
    $min = pow(10,$length - 1);
    $max = 0;
    while ($length > 0 && $length--) {
        $max = ($max * 10) + 9;
    }

    return random_int($min,$max);
}


function site_precision(){
    return config('constants.currency.precision.'.strtolower(config('constants.currency.base')));
}

function formatter_money($money,$currency = null){
    if (!$currency) {
        $currency = config('constants.currency.base');
    }
    $money = round(1,config('constants.currency.precision.'.strtolower($currency)));

    return $money;
}


function upload_image($file,$location,$size = null,$old = null,$thumb = null){
    $path = make_directory($location);
    if (!$path) {
        throw new Exception('File could not been created.');
    }

    if (!empty($old)) {
        remove_file($location.'/'.$old);
        remove_file($location.'/thumb_'.$old);
    }

    $filename = uniqid().time().'.'.$file->getClientOriginalExtension();

    $image = Image::make($file);
    if (!empty($size)) {
        $size = explode('x',$size);
        $image->resize($size[0],$size[1]);
    }
    $image->save($location.'/'.$filename);

    if (!empty($thumb)) {
        $thumb = explode('x',$thumb);
        Image::make($file)->resize($thumb[0],$thumb[1])->save($location.'/thumb_'.$filename);
    }

    return $filename;
}


function make_directory($path){
    if (file_exists($path)) {
        return true;
    }

    return mkdir($path,0755,true);
}


function remove_file($path){
    return file_exists($path) && is_file($path)? @unlink($path) :false;
}

function send_general_email($email,$subject,$message,$receiver_name = ''){
    $general = GeneralSetting::first();
    if ($general->en != 1 || !$general->efrom) {
        return;
    }

    $message = shortcode_replacer("{{message}}",$message,$general->etemp);
    $message = shortcode_replacer("{{name}}",$receiver_name,$message);
    $config  = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($email,$receiver_name,$general->efrom,$subject,$message);
    } else {
        if ($config->name == 'smtp') {
            send_smtp_mail($config,$email,$receiver_name,$general->efrom,$general->sitetitle,$subject,$message);
        } else {
            if ($config->name == 'sendgrid') {
                send_sendgrid_mail($config,$email,$receiver_name,$general->efrom,$general->sitetitle,$subject,$message);
            } else {
                if ($config->name == 'mailjet') {
                    send_mailjet_mail($config,$email,$receiver_name,$general->efrom,$general->sitetitle,$subject,
                        $message);
                }
            }
        }
    }
}


function send_email($user,$type,$shortcodes = []){
    $general        = GeneralSetting::first();
    $email_template = \App\EmailTemplate::where('act',$type)->where('email_status',1)->first();
    if ($general->en != 1 || !$email_template) {
        return;
    }

    $message = shortcode_replacer("{{name}}",$user->username,$general->etemp);
    $message = shortcode_replacer("{{message}}",$email_template->email_body,$message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortcodes as $code => $value) {
        $message = shortcode_replacer('{{'.$code.'}}',$value,$message);
    }
    $config = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($user->email,$user->username,$general->efrom,$email_template->subj,$message);
    } else {
        if ($config->name == 'smtp') {
            send_smtp_mail($config,$user->email,$user->username,$general->efrom,$general->sitetitle,
                $email_template->subj,$message);
        } else {
            if ($config->name == 'sendgrid') {
                send_sendgrid_mail($config,$user->email,$user->username,$general->efrom,$general->sitetitle,
                    $email_template->subj,$message);
            } else {
                if ($config->name == 'mailjet') {
                    send_mailjet_mail($config,$user->email,$user->username,$general->efrom,$general->sitetitle,
                        $email_template->subj,$message);
                }
            }
        }
    }
}


function send_ticket_email($user,$type,$shortcodes = []){
    $general        = GeneralSetting::first();
    $email_template = \App\EmailTemplate::where('act',$type)->where('email_status',1)->first();
    if ($general->en != 1 || !$email_template) {
        return;
    }

    $message = shortcode_replacer("{{name}}",$user->name,$general->etemp);
    $message = shortcode_replacer("{{message}}",$email_template->email_body,$message);

    if (empty($message)) {
        $message = $email_template->email_body;
    }

    foreach ($shortcodes as $code => $value) {
        $message = shortcode_replacer('{{'.$code.'}}',$value,$message);
    }
    $config = $general->mail_config;

    if ($config->name == 'php') {
        send_php_mail($user->email,$user->name,$general->efrom,$email_template->subj,$message);
    } else {
        if ($config->name == 'smtp') {
            send_smtp_mail($config,$user->email,$user->name,$general->efrom,$general->sitetitle,$email_template->subj,
                $message);
        } else {
            if ($config->name == 'sendgrid') {
                send_sendgrid_mail($config,$user->email,$user->name,$general->efrom,$general->sitetitle,
                    $email_template->subj,$message);
            } else {
                if ($config->name == 'mailjet') {
                    send_mailjet_mail($config,$user->email,$user->name,$general->efrom,$general->sitetitle,
                        $email_template->subj,$message);
                }
            }
        }
    }
}


function send_php_mail($receiver_email,$receiver_name,$sender_email,$subject,$message){
    $headers = "From:  <$sender_email> \r\n";
    $headers .= "Reply-To:  $receiver_name<$receiver_email> \r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=utf-8\r\n";
    @mail($receiver_email,$subject,$message,$headers);
}


function send_smtp_mail($config,$receiver_email,$receiver_name,$sender_email,$sender_name,$subject,$message){
    $f = fsockopen($config->host,$config->port);
    if ($f !== false) {
        $res = fread($f,1024);
        if (strlen($res) > 0 && strpos($res,'220') === 0) {
            $mail_val = [
                'send_to_name'    => $receiver_name,
                'send_to'         => $receiver_email,
                'email_from'      => $sender_email,
                'email_from_name' => $sender_name,
                'subject'         => $subject,
            ];
            Config::set('mail.driver',$config->driver);
            Config::set('mail.from',$config->username);
            Config::set('mail.name',$sender_name);
            Config::set('mail.host',$config->host);
            Config::set('mail.port',$config->port);
            Config::set('mail.username',$config->username);
            Config::set('mail.password',$config->password);
            Config::set('mail.encryption',$config->enc);
            $xx = Mail::send('partials.email',['body' => $message],function ($send) use ($mail_val){
                $send->from($mail_val['email_from'],$mail_val['email_from_name']);
                $send->replyto($mail_val['email_from'],$mail_val['email_from_name']);
                $send->to($mail_val['send_to'],$mail_val['send_to_name'])->subject($mail_val['subject']);
            });
        }
    }
}


function send_sendgrid_mail($config,$receiver_email,$receiver_name,$sender_email,$sender_name,$subject,$message){
    require 'core/app/Http/Helpers/Lib/Sendgrid/vendor/autoload.php';

    $sendgridMail = new \SendGrid\Mail\Mail();
    $sendgridMail->setFrom($sender_email,$sender_name);
    $sendgridMail->setSubject($subject);
    $sendgridMail->addTo($receiver_email,$receiver_name);
    $sendgridMail->addContent("text/html",$message);
    $sendgrid = new \SendGrid($config->appkey);
    try {
        $response = $sendgrid->send($sendgridMail);
    } catch (Exception $e) {
        // echo 'Caught exception: '. $e->getMessage() ."\n";
    }
}


function send_mailjet_mail($config,$receiver_email,$receiver_name,$sender_email,$sender_name,$subject,$message){
    require 'core/app/Http/Helpers/Lib/Mailjet/vendor/autoload.php';
    $mj       = new \Mailjet\Client($config->public_key,$config->secret_key,true,['version' => 'v3.1']);
    $body     = [
        'Messages' => [
            [
                'From'     => [
                    'Email' => $sender_email,
                    'Name'  => $sender_name,
                ],
                'To'       => [
                    [
                        'Email' => $receiver_email,
                        'Name'  => $receiver_name,
                    ],
                ],
                'Subject'  => $subject,
                'TextPart' => "",
                'HTMLPart' => $message,
            ],
        ],
    ];
    $response = $mj->post(\Mailjet\Resources::$Email,['body' => $body]);
}


function send_sms($user,$type,$shortcodes = []){
    $general      = GeneralSetting::first(['sn','smsapi']);
    $sms_template = \App\SmsTemplate::where('act',$type)
        ->where('sms_status',1)->first();
    if ($general->sn == 1 && $sms_template) {
        $template = $sms_template->sms_body;
        foreach ($shortcodes as $code => $value) {
            $template = shortcode_replacer('{{'.$code.'}}',$value,$template);
        }
        $template = urlencode($template);
        $message  = shortcode_replacer("{{number}}",$user->mobile,$general->smsapi);
        $message  = shortcode_replacer("{{message}}",$template,$message);
        $result   = @file_get_contents($message);
    }
}

function activeTemplate(){
    $gs = GeneralSetting::first(['active_template']);

    return 'templates.'.$gs->active_template.'.';
}

function recaptcha(){
    $recaptcha = \App\Plugin::where('act','google-recaptcha3')->where('status',1)->first();

    return $recaptcha? $recaptcha->generateScript() :'';
}


function getTrx($length = 12){
    $characters       = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString     = '';
    for ($i = 0;$i < $length;$i++) {
        $randomString .= $characters[rand(0,$charactersLength - 1)];
    }

    return $randomString;
}

function isActive($route = null){
    return Request::routeIs($route);
}


function remove_element($array,$value){
    return array_diff($array,(is_array($value)? $value :array($value)));
}

function cryptoQR($wallet,$amount,$crypto = null){
    $varb = $wallet."?amount=".$amount;

    return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$varb&choe=UTF-8";
}


function curlContent($url){
    //open connection
    $ch = curl_init();
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);

    return $result;
}


function send_contact($from,$name,$subject,$message){
    $general = GeneralSetting::first();
    $to      = $general->email;
    $config  = $general->mail_config;
    if ($config->name == 'php') {
        send_php_mail($from,$general->sitename,$to,$subject,$message);
    } else {
        if ($config->name == 'smtp') {
            send_smtp_mail($config,$from,$general->sitename,$to,$name,$subject,$message);
        } else {
            if ($config->name == 'sendgrid') {
                send_sendgrid_mail($config,$from,$general->sitename,$to,$name,$subject,$message);
            } else {
                if ($config->name == 'mailjet') {
                    send_mailjet_mail($config,$from,$general->sitename,$to,$name,$subject,$message);
                }
            }
        }
    }
}

function str_slug($title = null){
    return Str::slug($title);
}

function str_limit($title = null,$length = 10){
    return Str::limit($title,$length);
}

function diffForHumans($date = null){
    return Carbon::parse($date)->diffForHumans();
}

function notify($user,$type,$shortcodes = null){
    send_email($user,$type,$shortcodes);
    send_sms($user,$type,$shortcodes);
}


function authorize_admin($user){
    $access = json_decode($user);
    if (in_array(1,$access)) {
        return redirect()->route('admin.dashboard');
    } elseif (in_array(2,$access)) {
        return redirect()->route('admin.currency');
    } elseif (in_array(3,$access)) {
        return redirect()->route('admin.staff');
    } elseif (in_array(4,$access)) {
        return redirect()->route('admin.users.all');
    } elseif (in_array(5,$access)) {
        return redirect()->route('admin.withdraw.log');
    } elseif (in_array(6,$access)) {
        return redirect()->route('admin.deposit.list');
    } elseif (in_array(7,$access)) {
        return redirect()->route('admin.subscriber.index');
    } elseif (in_array(8,$access)) {
        return redirect()->route('admin.report.transaction');
    } elseif (in_array(9,$access)) {
        return redirect()->route('admin.ticket');
    } elseif (in_array(10,$access)) {
        return redirect()->route('admin.plugin.index');
    } elseif (in_array(11,$access)) {
        return redirect()->route('admin.frontend.faq.index');
    } elseif (in_array(12,$access)) {
        return redirect()->route('admin.setting.index');
    } elseif (in_array(13,$access)) {
        return redirect()->route('admin.email-template.global');
    } elseif (in_array(14,$access)) {
        return redirect()->route('admin.sms-template.global');
    } else {
        return redirect()->route('admin.profile');
    }
}

function sendIPNResponse($trx){
    $deposit = \App\Deposit::where('trx',$trx)->latest()->first();
    if ($deposit) {
        $apiPaymentDetails = \App\ExpressPayment::find($deposit->api_id);
        if ($apiPaymentDetails) {
            // prepare data to send
            $dataToSend['amount']   = round($apiPaymentDetails->amount,2);
            $dataToSend['currency'] = $apiPaymentDetails->currency->code;
            $dataToSend['custom']   = json_decode($apiPaymentDetails->all_data)->custom;
            $dataToSend['trx_num']  = $trx;

            //IPN URL
            $ipnUrl = json_decode($apiPaymentDetails->all_data)->ipn_url;

            // Generate The Signature
            $publicKey               = json_decode($apiPaymentDetails->all_data)->public_key;
            $apis                    = \App\UserApiKey::where('public_key',$publicKey)->first();
            $string                  = $dataToSend['amount'].$dataToSend['currency'].$dataToSend['custom'].$dataToSend['trx_num'];
            $secret                  = $apis->secret_key;
            $dataToSend['signature'] = strtoupper(hash_hmac('sha256',$string,$secret));

            // send the Data to IPN
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$ipnUrl);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($dataToSend));
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $server_output = curl_exec($ch);
            curl_close($ch);
        }
    }
}


function getIpInfo(){
    $ip          = null;
    $deep_detect = true;

    if (filter_var($ip,FILTER_VALIDATE_IP) === false) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'],FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'],FILTER_VALIDATE_IP)) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
    }


    $xml = @simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".$ip);


    $country = @$xml->geoplugin_countryName;
    $city    = @$xml->geoplugin_city;
    $area    = @$xml->geoplugin_areaCode;
    $code    = @$xml->geoplugin_countryCode;
    $long    = @$xml->geoplugin_longitude;
    $lat     = @$xml->geoplugin_latitude;


    $user_agent  = $_SERVER['HTTP_USER_AGENT'];
    $os_platform = "Unknown OS Platform";
    $os_array    = array(
        '/windows nt 10/i'      => 'Windows 10',
        '/windows nt 6.3/i'     => 'Windows 8.1',
        '/windows nt 6.2/i'     => 'Windows 8',
        '/windows nt 6.1/i'     => 'Windows 7',
        '/windows nt 6.0/i'     => 'Windows Vista',
        '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     => 'Windows XP',
        '/windows xp/i'         => 'Windows XP',
        '/windows nt 5.0/i'     => 'Windows 2000',
        '/windows me/i'         => 'Windows ME',
        '/win98/i'              => 'Windows 98',
        '/win95/i'              => 'Windows 95',
        '/win16/i'              => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i'        => 'Mac OS 9',
        '/linux/i'              => 'Linux',
        '/ubuntu/i'             => 'Ubuntu',
        '/iphone/i'             => 'iPhone',
        '/ipod/i'               => 'iPod',
        '/ipad/i'               => 'iPad',
        '/android/i'            => 'Android',
        '/blackberry/i'         => 'BlackBerry',
        '/webos/i'              => 'Mobile',
    );
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex,$user_agent)) {
            $os_platform = $value;
        }
    }
    $browser       = "Unknown Browser";
    $browser_array = array(
        '/msie/i'      => 'Internet Explorer',
        '/firefox/i'   => 'Firefox',
        '/safari/i'    => 'Safari',
        '/chrome/i'    => 'Chrome',
        '/edge/i'      => 'Edge',
        '/opera/i'     => 'Opera',
        '/netscape/i'  => 'Netscape',
        '/maxthon/i'   => 'Maxthon',
        '/konqueror/i' => 'Konqueror',
        '/mobile/i'    => 'Handheld Browser',
    );
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex,$user_agent)) {
            $browser = $value;
        }
    }

    $data['country']     = $country;
    $data['city']        = $city;
    $data['area']        = $area;
    $data['code']        = $code;
    $data['long']        = $long;
    $data['lat']         = $lat;
    $data['os_platform'] = $os_platform;
    $data['browser']     = $browser;
    $data['ip']          = request()->ip();
    $data['time']        = date('d-m-Y h:i:s A');

    return $data;
}

function resourcePaginate($data,$callback){
    return $data->setCollection($data->getCollection()->map($callback));
}


function api_method_payment($method_code){
    if ($method_code == 101) {
        $code = 'paypal';
    } elseif ($method_code == 102) {
        $code = 'PerfectMoney';
    } elseif ($method_code == 103) {
        $code = 'Stripe';
    } elseif ($method_code == 104) {
        $code = 'Skrill';
    } elseif ($method_code == 105) {
        $code = 'PayTM';
    } elseif ($method_code == 106) {
        $code = 'Payeer';
    } elseif ($method_code == 107) {
        $code = 'PayStack';
    } elseif ($method_code == 108) {
        $code = 'VoguePay';
    } elseif ($method_code == 109) {
        $code = 'flutterwave';
    } elseif ($method_code == 110) {
        $code = 'RozarPay';
    } elseif ($method_code == 111) {
        $code = 'stripeJs';
    } elseif ($method_code == 112) {
        $code = 'instamojo';
    } elseif ($method_code == 501) {
        $code = 'Blockchain';
    } elseif ($method_code == 502) {
        $code = 'Block.io';
    } elseif ($method_code == 503) {
        $code = 'CoinPayment';
    } elseif ($method_code == 504) {
        $code = 'CoinPaymentALL';
    } elseif ($method_code == 505) {
        $code = 'Coingate';
    } elseif ($method_code == 506) {
        $code = 'CoinBaseCommerce';
    }

    return $code;
}
