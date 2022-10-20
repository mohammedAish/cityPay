<?php
//$config['useragent'] = 'Appsbd';
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
$config['mailtype'] = 'html'; //text 	text or html
$config['from_email'] = '';
$config['from_name'] = '';
// IF SMTP Enabled
if($config['protocol']=="smtp"){
$config['smtp_host'] = '';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_port'] = '';
$config['smtp_crypto'] = 'ssl';//tls or ssl
//$config['tls_verify']=false;
}
$config['smtp_timeout'] = 60;
