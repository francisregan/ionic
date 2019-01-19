<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class SchoolController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }

  public function listSchool($request, $response, $args) {
    $result = $this->container->db->query("SELECT * FROM ioniccloud.school;");
    $results = [];
    while($row = mysqli_fetch_array($result)) {
      array_push($results, $row);
    }
    return json_encode($results);
  }

  public function addSchool($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    $schoolid = $data['sid'];
    $this->container->logger->info($schoolid);
    $name = filter_var($data['sname'], FILTER_SANITIZE_STRING);
    $contact = $data['sphoneno'];
    $contactperson = filter_var($data['scontactperson'], FILTER_SANITIZE_STRING);
    $mailid = $data['smailid'];
    $address = $data['saddress'];
    $state = $data['sstate'];
    $city = $data['scity'];
  
    $sqli = $this->container->db;
    if($schoolid !=NULL)
    {
      $result = $sqli->query("UPDATE ioniccloud.school SET school_name='$name', contact_person='$contactperson', contact_no='$contact', mail_id='$mailid', address='$address', state='$state', city='$city' WHERE sno='$schoolid';");
    }
    else{
    $result = $sqli->query("INSERT INTO ioniccloud.school (school_name, contact_no, contact_person, mail_id, address, state, city) 
    VALUES ('$name','$contact','$contactperson','$mailid','$address','$state','$city')");
     $this->container->logger->info(mysqli_affected_rows($sqli));
    }
    if (mysqli_affected_rows($sqli)==1) {
      return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-school'));
    }
    echo("<script>window.alert('Record Not Added');</script>");
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-school'));
  }

  public function editSchool($request, $response, $args) {
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-school'));
  }  
}
?>