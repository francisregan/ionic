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
    $result = $this->container->db->query("SELECT student.student_id,student.student_name,student.contact_number,student.email,student.school,school.school_name,student.age,student.batch,student.class,student.parent_name,student.activate
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
    $studentid = $data['stid'];
    $this->container->logger->info($studentid);
    $name = filter_var($data['sname'], FILTER_SANITIZE_STRING);
    $contactno = $data['stphoneno'];
    $mail = filter_var($data['smailid'], FILTER_SANITIZE_STRING);
    $school = $data['schoolname'];
    $age = $data['sage'];
    $batch = $data['sbatch'];
    $class = $data['sclass'];
    $parentname = $data['sparentname'];
    $act=$data['activate'];  
  $sqli = $this->container->db;
  if($studentid !=NULL)
  {
    $result = $sqli->query("UPDATE ioniccloud.student SET student_name='$name', contact_number='$contactno', email='$mail', school='$school', age='$age', batch='$batch', class='$class', parent_name='$parentname', activate='$act' WHERE student_id='$studentid';");
  }else{
  $result = $sqli->query("INSERT INTO ioniccloud.student (student_name, contact_number, email, school, age, batch, class, parent_name,activate)
  VALUES ('$name','$contactno','$mail','$school','$age','$batch','$class','$parentname','$act')");
  }
  if (mysqli_affected_rows($sqli)==1) {
  
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-student'));
  }
    echo("<script>window.alert('Record Not Added');</script>");
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-student'));
  }

  public function editStudent($request, $response, $args) {
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-student'));
  }  
}
?>