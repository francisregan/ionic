<?php

namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class LoginController
{
   protected $container;

   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }

   public function load($request, $response, $args) {
    return $this->container->renderer->render($response, 'login.php', $args);
   }

  public function login($request, $response, $args) {
    //echo "in here";
    $data = $request->getParsedBody();
    $userid = filter_var($data['login'], FILTER_SANITIZE_STRING);
    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $type = filter_var($data['charactertype'], FILTER_SANITIZE_STRING);
    $firstword = substr($userid,0,3);
    if($type == 1 && $firstword=='STU'){
      $studentid = ltrim(substr($userid,7,4),'\0');
      $schoolid = ltrim(substr($userid,3,4),'\0');
      $result = $this->container->db->query("SELECT * FROM ioniccloud.student where student_id='$studentid' AND school='$schoolid';");
      if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
          $_SESSION['user'] = $row['student_name'];
          $_SESSION['student_id'] = $row['student_id'];
          $_SESSION['school_id'] = $row['school'];
          $_SESSION['type']= $type;
          $lastword = substr(preg_replace('/\s+/', '', $row['student_name']),-3);
          $generatedPassword = $lastword."@ionic";
        }
        $passwordresult = strcmp($password,$generatedPassword);
        if($passwordresult == 0){
          return $this->container->renderer->render($response, 'index.php', $args);
        }
      }
    } else if($type == 2 && $firstword=='TRA'){
      $trainerid = ltrim(substr($userid,7,4),'\0');
      $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer where trainer_id='$trainerid';");
      if ($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
          $_SESSION['user'] = $row['trainer_name'];
          $_SESSION['type']= $type;
          $lastword = substr(preg_replace('/\s+/', '', $row['trainer_name']),-3);
          $generatedPassword = $lastword."@ionic";
        }
        $passwordresult = strcmp($password,$generatedPassword);
        if($passwordresult == 0){
          return $this->container->renderer->render($response, 'index.php', $args);
        }
      }
    }
    echo("<script>window.alert('USERNAME OR PASSWORD IS INCORRECT');</script>");
    return $this->container->renderer->render($response, 'login.php', $args);
  }
}
?>