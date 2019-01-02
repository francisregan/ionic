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
    $this->post('', 'TrainerController:addTrainer');
    $this->get('', 'TrainerController:listTrainer');
});       

$app->group('/student',function(){
    $this->post('','StudentController:addStudent');
    $this->get('', 'StudentController:listStudent');
});

$app->group('/school',function(){
    $this->post('','SchoolController:addSchool');
    $this->get('', 'SchoolController:listSchool');
});

$app->get('/logout', function (Request $request, Response $response, array $args) {
    session_destroy();
    $_SESSION = array();
    $this->renderer->render($response, 'index.php', $args);
});

