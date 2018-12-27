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

<<<<<<< HEAD
$container['TrainerController'] = function ($c)
{
    return new App\Controllers\TrainerController($c); 
=======
$container['TrainerController']=function($c)
{
    return new App\Controllers\TrainerController($c);

>>>>>>> 52ce0b87b6e6d3cb3f79163c510e9355065825d0
};

$container['StudentController']=function($c)
{
    return new App\Controllers\StudentController($c);
};

$container['SchoolController']=function($c)
{
    return new App\Controllers\SchoolController($c);
<<<<<<< HEAD
};


$container['ViewSchoolController']=function($c)
{
    return new App\Controllers\ViewSchoolController($c);
};



=======
};
>>>>>>> 52ce0b87b6e6d3cb3f79163c510e9355065825d0
