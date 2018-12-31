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
  public function student($request, $response, $args) 
  {
    $this->container->logger->info("successfully reached here");
    $data = $request->getParsedBody();
    $name = filter_var($data['sname'], FILTER_SANITIZE_STRING);
    $contact = filter_var($data['sphoneno'], FILTER_SANITIZE_STRING);
    $mail = filter_var($data['smailid'], FILTER_SANITIZE_STRING);
    /* $specialization = filter_var($data['tspec'], FILTER_SANTIZE_STRING); */
    $school = $data['sschool'];
    $batch = $data['sbatch'];
  $sqli = $this->container->db;

  $result = $sqli->query("INSERT INTO ioniccloud.student (Student_Name, Contact_Number, email, School, Batch) 
  VALUES ('$name','$contact','$mail','$school','$batch')");
  if (mysqli_affected_rows($sqli)==1) {
    echo("<script>window.alert('Record Successfully Added');</script>");
    return $this->container->renderer->render($response, 'index.php', $args);
  }
    echo("<script>window.alert('Record Not Added');</script>");
    return $this->container->renderer->render($response, 'index.php', $args);
  }
}
?>