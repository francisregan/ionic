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

$app->group('/edittrainer',function(){
    $this->get('', 'TrainerController:editTrainer');
});

$app->group('/student',function(){
    $this->post('','StudentController:addStudent');
    $this->get('', 'StudentController:listStudent');  
});

$app->group('/editstudent',function(){
    $this->get('', 'StudentController:editStudent');
});

$app->group('/school',function(){
    $this->post('','SchoolController:addSchool');
    $this->get('', 'SchoolController:listSchool');
});

$app->group('/editschool',function(){
    $this->get('', 'SchoolController:editSchool');
});

$app->get('/logout', function (Request $request, Response $response, array $args) {
    session_destroy();
    $_SESSION = array();
    $this->renderer->render($response, 'index.php', $args);
});

$app->group('/profile', function(){
    $this->get('', 'HomeController:profile');
});

$app->group('/category', function(){
    $this->get('', 'CategoryController:manageCategories'); 
});

$app->group('/addcategory', function(){
  $this->get('', 'CategoryController:showCategory');
  $this->post('', 'CategoryController:addCategory');
});

$app->group('/course', function(){
 $this->post('', 'CourseController:addcourse');
 $this->get('', 'CourseController:listcourse');
}); 

$app->group('/lesson', function(){
    $this->post('', 'LessonController:addlesson');
    $this->get('', 'LessonController:listlesson');
   }); 

 $app->group('/editlesson',function(){
    $this->get('', 'LessonController:editlesson');
});

$app->group('/batch', function(){
    $this->post('', 'BatchController:addbatch');
    $this->get('', 'BatchController:listbatch');
   }); 

$app->group('/editbatch', function(){
    $this->get('', 'BatchController:editBatch');
   }); 

$app->group('/batchedstudents', function(){
    $this->get('', 'BatchController:batchedstudents'); 
});

$app->group('/selectcourse', function(){
    $this->get('', 'BatchController:selectCourse'); 
    $this->post('', 'BatchController:updateCourse');
});

$app->group('/lessonplan',function(){
    $this->get('', 'BatchController:lessonPlan');
});

$app->group('/progresses',function(){
    $this->get('', 'BatchController:studentProgress');
});

$app->group('/viewlesson',function(){
    $this->get('', 'LessonController:viewLesson');
});

$app->group('/viewcontent',function(){
    $this->get('', 'LessonController:viewContent');
});

$app->group('/viewcontents',function(){
    $this->get('', 'LessonController:viewContents');
});

$app->group('/allocatelesson',function(){
    $this->post('', 'CourseController:allocateLesson');
    $this->get('', 'CourseController:listAllocate');
});

$app->group('/editallocate',function(){
    $this->get('', 'CourseController:editAllocate');
});
?>