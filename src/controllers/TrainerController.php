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
  public function listTrainer($request, $response, $args) {
    $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer;");
    $schoolresult = $this->container->db->query("SELECT * FROM ioniccloud.school;");
    $results = [];
    $schoolresults = [];
    while($schoolrow = mysqli_fetch_array($schoolresult))
     {
      array_push($schoolresults, $schoolrow);
    }
    
    while($row = mysqli_fetch_array($result)) {
     $final = "";
      $schoolids = json_decode($row['school'], true);
      $schoolresult = "";
      foreach ($schoolids as $schoolid){
          foreach ($schoolresults as $school){
            if($school['sno'] === $schoolid){
              $schoolresult = $school['school_name'];
              $final  .=  $schoolresult . "," ;
              break;
            }
          }
      } 
      $row['school'] = $final;
      array_push($results, $row);
    }
    $this->container->logger->info(json_encode($school)); 
    return json_encode($results);
  }

  public function addTrainer($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    $name = filter_var($data['tname'], FILTER_SANITIZE_STRING);
    $contact = filter_var($data['tphoneno'], FILTER_SANITIZE_STRING);
    $mail = filter_var($data['tmailid'], FILTER_SANITIZE_STRING);
    $specialization = $data['tspec'];
    $schools = $data['schoolname'];
    $this->container->logger->info("school info is");
    $this->container->logger->info($school);
    foreach ($schools as $school)
    {
      $this->container->logger->info("here");
      $this->container->logger->info(json_encode($school)); 
    }
    $schoolsEncoded = json_encode($schools);
    $address =$data['taddress'];
  $sqli = $this->container->db;

  $result = $sqli->query("INSERT INTO ioniccloud.trainer (trainer_name, contact_no, mail_id, specialization, school, address) 
  VALUES ('$name','$contact','$mail','$specialization', '$schoolsEncoded','$address')");
  if (mysqli_affected_rows($sqli)==1) {
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-trainer'));
  }
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-trainer'));
  }
}
?>
