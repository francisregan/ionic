<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO database library
$container['db'] = function ($c) {
    $settings = $c->get('settings')['db'];
    return new mysqli($settings['host'], $settings['user'], $settings['pass'], $settings['dbname']);
}; 

$container['flash'] = function () {
    return new Slim\Flash\Messages();
};

$container['LoginController'] = function ($c)
{
    return new App\Controllers\LoginController($c); 
};  
$container['HomeController'] = function ($c)
{
    return new App\Controllers\HomeController($c); 
    
};

$container['TrainerController']=function($c)
{
    return new App\Controllers\TrainerController($c);
};

$container['StudentController']=function($c)
{
    return new App\Controllers\StudentController($c);
};

$container['SchoolController']=function($c)
{
    return new App\Controllers\SchoolController($c);
};

