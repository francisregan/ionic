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
    $middleword = ltrim(substr($userid,3,4),'');
    $id = ltrim(substr($userid,7,4),'');
    $args = [];
    $args[0] = $password;
    $args[1] = $type;
    switch ($type) {
      case 0:
        if($firstword=='ION'){
          //$sql = $this->container->db->query("SELECT id FROM ioniccloud.login WHERE  password = '$password';");
          $result = $this->container->db->query("SELECT * FROM ioniccloud.login where id='$id' and RIGHT(phone, 4) = '$middleword';");
          $args[2] = "name";
          $args[3] = $result;
          $loginresult = $this->checkLogin($args);
          if($loginresult == 0){
            return $this->container->renderer->render($response, 'index.php', $args);
          }
        }
        break;
      case 1:
          if($firstword=='STU'){
            $result = $this->container->db->query("SELECT * FROM ioniccloud.student where student_id='$id' AND school='$middleword';");
            $args[2] = "student_name";
            $args[3] = $result;
            $loginresult = $this->checkLogin($args);
            if($loginresult == 0){
              return $this->container->renderer->render($response, 'index.php', $args);
            }
          }
          break;
      case 2:
          if($firstword=='TRA'){
            $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer where trainer_id='$id' and RIGHT(contact_no, 4) = '$middleword';");
            $args[2] = "trainer_name";
            $args[3] = $result;
            $loginresult = $this->checkLogin($args);
            if($loginresult == 0){
              return $this->container->renderer->render($response, 'index.php', $args);
            }
          }
          break;
      case 3:
          if($firstword=='SCH'){
            $result = $this->container->db->query("SELECT * FROM ioniccloud.school where sno='$id' and RIGHT(contact_no, 4) = '$middleword';");
            $args[2] = "school_name";
            $args[3] = $result;
            $loginresult = $this->checkLogin($args);
            if($loginresult == 0){
              return $this->container->renderer->render($response, 'index.php', $args);
            }
          }
          break;
  }
  if($loginresult == 1){
    echo("<script>window.alert('Your account is not active');</script>");
  }else{
    echo("<script>window.alert('USERNAME OR PASSWORD IS INCORRECT');</script>");
  }
    return $this->container->renderer->render($response, 'login.php', $args);
  }
 public function checkLogin($args){
   $password = $args[0];
   $type = $args[1];
   $columnname = $args[2];
   $result = $args[3];
    if ($result->num_rows > 0) {
      while($row = mysqli_fetch_array($result)) {
        if($row['activate'] == "N"){
          return 1;
        }
        $_SESSION['user'] = $row[$columnname];
        $_SESSION['type']= $type;
        if($type == 1){
          $_SESSION['student_id'] = $row['student_id'];
          $_SESSION['school_id'] = $row['school'];
        }
        $lastword = substr(preg_replace('/\s+/', '', $row[$columnname]),-3);
        $generatedPassword = $lastword."@ionic";
      }
      return strcmp($password,$generatedPassword);
    }
  }
}
?>