<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();
class StudentController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }

   public function load($request, $response, $args) {
    return $this->container->renderer->render($response, 'manage-student.php' ,$args);
   }

  public function manageStudent($request, $response, $args) {
    $result = $this->container->db->query("SELECT * FROM ioniccloud.student;");
    $results = [];
    while($row = mysqli_fetch_array($result)) {
      array_push($results, $row);
    }
    return json_encode($results);
  }
}
?>