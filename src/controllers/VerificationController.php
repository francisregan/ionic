<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class VerificationController
{
    protected $container;
    public function __construct(ContainerInterface $container) {
      $this->container = $container;
    }
    public function download($request, $response, $args) {   
   
      return $this->container->renderer->render($response, 'download_cert.php', $args);
    }
    public function load($request, $response, $args) {    
      return $this->container->renderer->render($response, 'certification.php', $args);
    }

    public function verify($request, $response, $args) {
      $data = $request->getParsedBody();
      $unique = filter_var($data['unique'], FILTER_SANITIZE_STRING);
      $result = $this->container->db->query("SELECT * FROM ioniccloud.students where unique_reference='$unique'");
      if ($result->num_rows == 0) {
          echo("<script>window.alert('The unique code you entered is incorrect. ');</script>");
          return $this->container->renderer->render($response, 'certification.php', $args);
        } else {
          $resultrow = []; 
          while($row = $result->fetch_assoc()) {
            $resultrow['unique_reference'] = $row["unique_reference"];
            $resultrow['student_name'] = $row["student_name"];
            $resultrow['course_title'] = $row["course_title"];
            $resultrow['from'] = $row["from"];
            $resultrow['to'] = $row["to"];
            $resultrow['conducted_at'] = $row["conducted_at"];
            $resultrow['currently_represent'] = $row["currently_represent"];
            $resultrow['type'] = $row["type"];
            }
      
          
          $_SESSION["student_data"] = json_encode($resultrow);

        /*   $this->container->logger->info($_SESSION["student_data"]); */

          return $this->container->renderer->render($response, 'viewer.php', $args);
         }  
    }
  }


 
