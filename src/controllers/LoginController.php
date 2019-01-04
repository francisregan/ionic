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
    $email = filter_var($data['login'], FILTER_SANITIZE_STRING);
    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $type = filter_var($data['charactertype'], FILTER_SANITIZE_STRING);
    $charactertype = filter_var($data['charactertype'], FILTER_SANITIZE_STRING);
    $querystr = "SELECT * FROM ioniccloud.login where email='$email' AND password='$password'";
    $result = $this->container->db->query($querystr);
    
    if ($result->num_rows > 0) {
      while($row = mysqli_fetch_array($result)) {
        $_SESSION['user'] = $row['name'];
        $_SESSION['email'] = $row['email'];
      }
      return $this->container->renderer->render($response, 'index.php', $args);
    }
    echo("<script>window.alert('USERNAME OR PASSWORD IS INCORRECT');</script>");
    return $this->container->renderer->render($response, 'login.php', $args);
  }
}
?>