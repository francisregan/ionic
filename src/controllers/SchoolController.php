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
    $name = filter_var($data['sname'], FILTER_SANITIZE_STRING);
    $contact = filter_var($data['sphoneno'], FILTER_SANITIZE_STRING);
    $contactperson = filter_var($data['scontactperson'], FILTER_SANITIZE_STRING);
    $mailid = $data['smailid'];
    $address = $data['saddress'];
    $sqli = $this->container->db;
    $result = $sqli->query("INSERT INTO ioniccloud.school (School_Name, Contact_No, Contact_Person, Mail_id, Address) 
    VALUES ('$name','$contact','$contactperson','$mailid','$address')");
    if (mysqli_affected_rows($sqli)==1) {
      return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-school'));
    }
    echo("<script>window.alert('Record Not Added');</script>");
        return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-school'));
    }
}
?>