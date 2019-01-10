<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class CourseController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }
  public function addcourse($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    $name = filter_var($data['cname'], FILTER_SANITIZE_STRING);
    $type = filter_var($data['ctype'], FILTER_SANITIZE_STRING);
    $category = filter_var($data['category'], FILTER_SANITIZE_STRING);
    $duration = filter_var($data['duration'], FILTER_SANITIZE_STRING);
    $value = $data['frequency'];
    $sessions = filter_var($data['sessions'], FILTER_SANITIZE_STRING);
  $sqli = $this->container->db;
  $result = $sqli->query("insert into ioniccloud.add_course (name, type, category, duration, printing, session ) 
  VALUES ('$name','$type',' $category',' $duration','$value','$sessions')");
  if (mysqli_affected_rows($sqli)==1) {
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-category'));
  }
  
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-course'));
  }
}
?>