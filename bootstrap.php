<?php

use Core\TwitterApi;

include realpath(__DIR__) . '/settings/settings.php';
include realpath(__DIR__) . '/settings/settings.default.php';
include realpath(__DIR__) . '/vendor/autoload.php';

TwitterApi::$searches = include realpath(__DIR__) . '/settings/searches.php';

define('CONTROLLER', isset($_GET['controller']) && '' !== (string) $_GET['controller'] ? (string) $_GET['controller'] : 'user');
define('ACTION', isset($_GET['action']) && '' !== (string) $_GET['action'] ? (string) $_GET['action'] : null);

$controllerName = '\\Controller\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', CONTROLLER))) . 'Controller';

if(!class_exists($controllerName)) {

    throw new \Exception('Controller ' . $controllerName . ' error');
}

$controller = new $controllerName();

if(!is_null(ACTION)) {

    $actionName = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', ACTION)));

    if(!method_exists($controller, $actionName)) {

        throw new \Exception('Method ' . $controllerName . '::' . $actionName . '(); error');
    }

    $controller->{$actionName}();
}
