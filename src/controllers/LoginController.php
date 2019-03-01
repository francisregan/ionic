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
    $id = ltrim(substr($userid,7,4),'\0');
    switch ($type) {
      case 0:
        if($firstword=='ION'){
          $result = $this->container->db->query("SELECT * FROM ioniccloud.login where id='$id';");
          $columnname = "name";
          $this->checkLogin($request, $response, $args, $result, $password, $columnname);
          return 0;
        }
        break;
      case 1:
          if($firstword=='STU'){
            $schoolid = ltrim(substr($userid,3,4),'\0');
            $result = $this->container->db->query("SELECT * FROM ioniccloud.student where student_id='$id' AND school='$schoolid';");
            $columnname = "student_name";
            $this->checkLogin($request, $response, $args, $result, $password, $columnname, $type);
            return 0;
          }
          break;
      case 2:
          if($firstword=='TRA'){
            $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer where trainer_id='$id';");
            $columnname = "trainer_name";
            $this->checkLogin($request, $response, $args, $result, $password, $columnname, $type);
            return 0;
          }
          break;
      case 3:
          if($firstword=='SCH'){
            $result = $this->container->db->query("SELECT * FROM ioniccloud.school where sno='$id';");
            $columnname = "school_name";
            $this->checkLogin($request, $response, $args, $result, $password, $columnname, $type);
            return 0;
          }
          break;
  }
    echo("<script>window.alert('USERNAME OR PASSWORD IS INCORRECT');</script>");
    return $this->container->renderer->render($response, 'login.php', $args);
  }
 public function checkLogin($request, $response, $args, $result, $password, $columnname, $type){
    if ($result->num_rows > 0) {
      while($row = mysqli_fetch_array($result)) {
        $_SESSION['user'] = $row[$columnname];
        $_SESSION['type']= $type;
        $this->container->logger->info($type);
        if($type == 1){
          $_SESSION['student_id'] = $row['student_id'];
          $_SESSION['school_id'] = $row['school'];
        }
        $lastword = substr(preg_replace('/\s+/', '', $row[$columnname]),-3);
        $generatedPassword = $lastword."@ionic";
      }
      $passwordresult = strcmp($password,$generatedPassword);
      if($passwordresult == 0){
        return $this->container->renderer->render($response, 'index.php', $args);
      }
    }
  }
}
?>