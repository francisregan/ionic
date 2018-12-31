<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'index.php', $args);
}); 

$app->group('/login', function(){
    $this->get('', 'LoginController:load');
    $this->post('', 'LoginController:login');
});

$app->group('/trainer', function(){
    $this->post('', 'TrainerController:trainer');
});       

$app->group('/student',function(){
    $this->post('','StudentController:student');
});

$app->group('/school',function(){
    $this->post('','SchoolController:school');
});

$app->get('/logout', function (Request $request, Response $response, array $args) {
    session_destroy();
    $_SESSION = array();
    $this->renderer->render($response, 'index.php', $args);
});

$app->group('/manageschool', function(){
    $this->get('', 'SchoolController:manageSchool');
});

$app->group('/managetrainer', function(){
    $this->get('', 'TrainerController:manageTrainer');
});

$app->group('/managestudent', function(){
    $this->get('', 'StudentController:manageStudent');
});

