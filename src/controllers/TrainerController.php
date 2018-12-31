<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();
class TrainerController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }

   public function load($request, $response, $args) {
    return $this->container->renderer->render($response, 'manage-trainer.php' ,$args);
   }

  public function manageTrainer($request, $response, $args) {
    $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer;");
    $results = [];
    while($row = mysqli_fetch_array($result)) {
      array_push($results, $row);
    }
    return json_encode($results);
  }
}
?>