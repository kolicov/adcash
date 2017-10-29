<?php


$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$namespaces['Models'] = realpath(__DIR__ . '/../models/');

$string = explode("/", $_SERVER['REQUEST_URI']);
//if (in_array('admin', $string)) {
    $config->moduleName = 'order';
//} else {
//    $config->moduleName = 'frontend';
//}

$namespaces['Modules\\' . ucfirst($config->moduleName) . '\Controllers'] = realpath(__DIR__ . '/../modules/' . $config->moduleName . '/controllers/');
//$namespaces['Modules\\' . ucfirst($config->moduleName) . '\Models'] = realpath(__DIR__ . '/../modules/' . $config->moduleName . '/models/');
$namespaces['Modules\\' . ucfirst($config->moduleName) . '\Plugins'] = realpath(__DIR__ . '/../modules/' . $config->moduleName . '/plugins/');
$namespaces['Modules\\' . ucfirst($config->moduleName) . '\Forms'] = realpath(__DIR__ . '/../modules/' . $config->moduleName . '/forms/');

$loader->registerNamespaces($namespaces);

$loader->registerDirs(
        array(
            $config->application->controllersDir,
            $config->application->modelsDir,
            $config->application->libraryDir
        )
)->register();


function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}
