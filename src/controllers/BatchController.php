<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class BatchController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }
   public function listbatch($request, $response, $args) {
    $result = $this->container->db->query("SELECT batch.name,school.school_name,batch.student,batch.sdate,batch.edate
    FROM batch
    INNER JOIN school
    ON batch.school=school.sno;");
     $studentresult = $this->container->db->query("SELECT * FROM ioniccloud.student;");
    
    $results = [];
    $studentresults =[];

    while($studentrow = mysqli_fetch_array($studentresult))
    {
     array_push($studentresults, $studentrow);
    }
   
    while($row = mysqli_fetch_array($result)) {
      $final = "";
      $studentids = json_decode($row['student'], true);
      $studentresult = "";
      
      foreach ($studentids as $studentid){
        foreach ($studentresults as $student){
          if($student['student_id'] === $studentid){
            $studentresult = $student['student_name'];
            $final  .=  $studentresult . "," ;
            break;
          }
        }
      } 
    $row['student'] = $final;
    array_push($results, $row);
    }
    return json_encode($results);
  }
  
  public function addbatch($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    $name = filter_var($data['bname'], FILTER_SANITIZE_STRING);
    $school = filter_var($data['schoolname'], FILTER_SANITIZE_STRING);
    
    $students = filter_var($data['studentname']);
    $assignedStudents = $data['assignedStudents'];
    $studentsEncoded = json_encode($assignedStudents);

    $startdate = filter_var($data['sdate'], FILTER_SANITIZE_STRING); 
    $enddate = filter_var($data['edate'], FILTER_SANITIZE_STRING);
    $date=date('y-m-d',strtotime($startdate));
    $edate=date('y-m-d',strtotime($enddate));
    
    $sqli = $this->container->db;
    $result = $sqli->query("insert into ioniccloud.batch (name, school, student, sdate, edate ) 
    VALUES ('$name','$school','$studentsEncoded','$date','$edate')");

    if (mysqli_affected_rows($sqli)==1) {
      $last_id = mysqli_insert_id($sqli);
        foreach($assignedStudents as $assignedStu){
          $resultnew = $this->container->db->query("insert into ioniccloud.studentbatch (student_id, batch_id, school_id ) 
          VALUES ('$assignedStu','$last_id','$school')");
        
        }
      return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-batch'));
    } echo("<script>window.alert('Record Could Not Be Added');</script>");
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-batch'));
  }

  public function batchedstudents($request, $response, $args)
  {
    $data = $request->getParsedBody();
    $schoolid = $request->getParam('id');
    $schoolid = filter_var($schoolid, FILTER_SANITIZE_STRING); 
   
    $studentresult = $this->container->db->query("Select * from student where school='$schoolid' and student_id not in(Select student_id from studentbatch where school_id='$schoolid');");
    $studentresults =[];
    foreach($studentresult as $student)
    {
      array_push($studentresults,$student);
    }
    return json_encode($studentresults); 
  }
}

?>
