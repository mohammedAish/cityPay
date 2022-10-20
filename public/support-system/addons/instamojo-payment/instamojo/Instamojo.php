<?php

// Include Instamojo only if not already defined
if (class_exists('Instamojo') === false){
    require_once __DIR__.'/libs/Instamojo.php';
}
/*
try
{
    Instamojo::register_autoloader();
}
catch (\Exception $e)
{
    throw new Exception('Instamojo class found but did not match');
}

spl_autoload_register(function ($class)
{
    // project-specific namespace prefix
    $prefix = 'Instamojo';

    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);

    if (strncmp($prefix, $class, $len) !== 0)
    {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    //
    // replace the namespace prefix with the base directory,
    // replace namespace separators with directory separators
    // in the relative class name, append with .php
    //
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file))
    {
        require $file;
    }
});*/