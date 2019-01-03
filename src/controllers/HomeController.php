<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();
class HomeController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }

  public function profile($request, $response, $args) {
    $email=$_SESSION['email'];
    $result = $this->container->db->query("SELECT * FROM ioniccloud.login where email='$email';");
    $results = [];
    while($row = mysqli_fetch_array($result)) {
      array_push($results, $row);
    }
    return json_encode($results); 
  }
}
?>