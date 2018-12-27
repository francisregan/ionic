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
    
<<<<<<< HEAD
=======

    $app->group('/trainer', function(){
        $this->get('', 'TrainerController:load');
        $this->post('', 'TrainerController:trainer');
});       
 

     $app->group('/student', function(){            // executed
        $this->get('','StudentController:load');
        $this->post('','StudentController:student');
        
     });

    $app->group('/school',function(){               // executed
        $this->get('','SchoolController: load');
        $this->post('','SchoolController:school');
});


>>>>>>> 52ce0b87b6e6d3cb3f79163c510e9355065825d0

    $app->group('/trainer', function(){
        $this->get('', 'TrainerController:load');
        $this->post('', 'TrainerController:trainer');
});       

$app->group('/student',function(){
        $this->get('','StudentController: load');
        $this->post('','StudentController:student');

 });

 $app->group('/school',function(){
         $this->get('','SchoolController: load');
         $this->post('','SchoolController:school');
  } );

  $app->group('/manageschool', function(){
    $this->get('','ViewSchoolController:manageschool');
});
$app->get('/logout', function (Request $request, Response $response, array $args) {
    session_destroy();
    $_SESSION = array();
    $this->renderer->render($response, 'index.php', $args);
});
