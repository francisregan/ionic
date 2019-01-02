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
    //$this->container->logger->info("successfully reached here");
    $data = $request->getParsedBody();
    $name = filter_var($data['login'], FILTER_SANITIZE_STRING);
    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $type = filter_var($data['charactertype'], FILTER_SANITIZE_STRING);
    $charactertype = filter_var($data['charactertype'], FILTER_SANITIZE_STRING);
    $result = $this->container->db->query("SELECT * FROM ioniccloud.login where name='$name' AND password='$password'");
    
    if ($result->num_rows > 0) {
      $_SESSION['user'] = $name;
      return $this->container->renderer->render($response, 'index.php', $args);
    }
    echo("<script>window.alert('USERNAME OR PASSWORD IS INCORRECT');</script>");
    return $this->container->renderer->render($response, 'login.php', $args);
  }

}

?>