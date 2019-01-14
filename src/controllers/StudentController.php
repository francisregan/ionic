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

  public function listStudent($request, $response, $args) {
    $result = $this->container->db->query("SELECT student.sno,student.student_name,student.contact_number,school.school_name,student.batch,student.class
    FROM student
    INNER JOIN school
    ON student.school=school.sno;");

    $results = [];
    while($row = mysqli_fetch_array($result)) {
      array_push($results, $row);
    }
    return json_encode($results);
  }
  public function addStudent($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    $name = filter_var($data['sname'], FILTER_SANITIZE_STRING);
    $contactno = $data['stphoneno'];
    $mail = filter_var($data['smailid'], FILTER_SANITIZE_STRING);
    $school = $data['schoolname'];
    $age = $data['sage'];
    $batch = $data['sbatch'];
    $class = $data['sclass'];
    $parentname = $data['sparentname'];

  $sqli = $this->container->db;

  $result = $sqli->query("INSERT INTO ioniccloud.student (student_name, contact_number, email, school, age, batch, class, parent_name)
  VALUES ('$name','$contactno','$mail','$school','$age','$batch','$class','$parentname')");
  if (mysqli_affected_rows($sqli)==1) {
  
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-student'));
  }
    echo("<script>window.alert('Record Not Added');</script>");
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-student'));
  }
}
?>