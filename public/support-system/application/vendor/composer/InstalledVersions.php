<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' => 
  array (
    'pretty_version' => 'dev-master',
    'version' => 'dev-master',
    'aliases' => 
    array (
    ),
    'reference' => '1d4ffe4ba2db953ee63124bac8a36cbc15e5ec01',
    'name' => '__root__',
  ),
  'versions' => 
  array (
    '__root__' => 
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' => 
      array (
      ),
      'reference' => '1d4ffe4ba2db953ee63124bac8a36cbc15e5ec01',
    ),
    'drewm/mailchimp-api' => 
    array (
      'pretty_version' => 'v2.5.4',
      'version' => '2.5.4.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c6cdfab4ca6ddbc3b260913470bd0a4a5cb84c7a',
    ),
    'facebook/graph-sdk' => 
    array (
      'pretty_version' => '5.6.1',
      'version' => '5.6.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '2f9639c15ae043911f40ffe44080b32bac2c5280',
    ),
    'gregwar/captcha' => 
    array (
      'pretty_version' => 'v1.1.3',
      'version' => '1.1.3.0',
      'aliases' => 
      array (
      ),
      'reference' => 'b4f22bc4794b652fccefae5a5be9565305e11572',
    ),
    'hybridauth/hybridauth' => 
    array (
      'pretty_version' => 'v2.17.0',
      'version' => '2.17.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '06909cd8cbc1201f01db8a8d36bc8c06dd27223d',
    ),
    'oyejorge/less.php' => 
    array (
      'pretty_version' => 'v1.7.0.14',
      'version' => '1.7.0.14',
      'aliases' => 
      array (
      ),
      'reference' => '42925c5a01a07d67ca7e82dfc8fb31814d557bc9',
    ),
    'paypal/rest-api-sdk-php' => 
    array (
      'pretty_version' => '1.13.0',
      'version' => '1.13.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '192e217beed14c8e75624e821fdc8ec51e2a21f5',
    ),
    'phpmyadmin/motranslator' => 
    array (
      'pretty_version' => '2.2',
      'version' => '2.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '7d31d1de8167f0824dcff046d2eb2abb3d8364dd',
    ),
    'psr/cache' => 
    array (
      'pretty_version' => '1.0.1',
      'version' => '1.0.1.0',
      'aliases' => 
      array (
      ),
      'reference' => 'd11b50ad223250cf17b86e38383413f5a6764bf8',
    ),
    'psr/cache-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'psr/log' => 
    array (
      'pretty_version' => '1.0.2',
      'version' => '1.0.2.0',
      'aliases' => 
      array (
      ),
      'reference' => '4ebe3a8bf773a19edfe0a84b6585ba3d401b724d',
    ),
    'psr/simple-cache' => 
    array (
      'pretty_version' => '1.0.0',
      'version' => '1.0.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '753fa598e8f3b9966c886fe13f370baa45ef0e24',
    ),
    'psr/simple-cache-implementation' => 
    array (
      'provided' => 
      array (
        0 => '1.0',
      ),
    ),
    'scssphp/scssphp' => 
    array (
      'pretty_version' => '1.1.1',
      'version' => '1.1.1.0',
      'aliases' => 
      array (
      ),
      'reference' => '824e4cec10b2bfa88eec5dac23991cb9106622c1',
    ),
    'stripe/stripe-php' => 
    array (
      'pretty_version' => 'v7.77.0',
      'version' => '7.77.0.0',
      'aliases' => 
      array (
      ),
      'reference' => 'f6724447481f6fb8c2e714165e092adad9ca470a',
    ),
    'symfony/cache' => 
    array (
      'pretty_version' => 'v3.3.13',
      'version' => '3.3.13.0',
      'aliases' => 
      array (
      ),
      'reference' => '49aadc35cc8ae6646cdc39ebdeaceb6712769c9f',
    ),
    'symfony/expression-language' => 
    array (
      'pretty_version' => 'v3.3.13',
      'version' => '3.3.13.0',
      'aliases' => 
      array (
      ),
      'reference' => 'c46362f6025f3b110c8b747fe75aace90c884ec6',
    ),
    'symfony/polyfill-apcu' => 
    array (
      'pretty_version' => 'v1.6.0',
      'version' => '1.6.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '04f62674339602def515bff4bc6901fc1d4951e8',
    ),
    'tedivm/jshrink' => 
    array (
      'pretty_version' => 'v1.2.0',
      'version' => '1.2.0.0',
      'aliases' => 
      array (
      ),
      'reference' => '667e99774d230525d4d3dc2a50da7ba6b1d56bad',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {

foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
