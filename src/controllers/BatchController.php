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
    $result = $this->container->db->query("SELECT batch.id,batch.name,batch.school,school.school_name,batch.student,batch.sdate,batch.edate,batch.activate
    FROM batch
    INNER JOIN school
    ON batch.school=school.sno;");
    $studentresult = $this->container->db->query("SELECT * FROM ioniccloud.student;");
    
    $results = [];
    $studentresults =[];
   while($studentrow = mysqli_fetch_array($studentresult)){
    array_push($studentresults, $studentrow);
    }
   
    while($row = mysqli_fetch_array($result)) {
    
      $final = "";
      $studentids = json_decode($row['student'], true);
      $studentresult = "";
      
    array_push($results, $row);
    }
    return json_encode($results);
  }
  
  public function addbatch($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    $batchid = $data['bid'];
    $name = filter_var($data['bname'], FILTER_SANITIZE_STRING);
    $school = filter_var($data['schoolname'], FILTER_SANITIZE_STRING);
    
    $students = filter_var($data['studentname']);
    $assignedStudents = $data['assignedStudents'];
    $this->container->logger->info($assignedStudents);
    $studentsEncoded = json_encode($assignedStudents);
    $startdate = filter_var($data['sdate'], FILTER_SANITIZE_STRING); 
    $enddate = filter_var($data['edate'], FILTER_SANITIZE_STRING);
    $date=date('y-m-d',strtotime($startdate));
    $edate=date('y-m-d',strtotime($enddate));
    $act=$data['activate'];  
    
    $sqli = $this->container->db;
    if($batchid != NULL)
  
      {
      
        $result = $sqli->query("UPDATE ioniccloud.batch SET name='$name', school='$school', student='$studentsEncoded', sdate='$date', edate='$edate', activate='$act' WHERE id='$batchid';");
      }
    
    else{
      $result = $sqli->query("insert into ioniccloud.batch (name, school, student, sdate, edate,activate ) 
      VALUES ('$name','$school','$studentsEncoded','$date','$edate','$act' )");
    }
  
    if (mysqli_affected_rows($sqli)==1) {
    
      $last_id = mysqli_insert_id($sqli);
      $result = $sqli->query("delete from ioniccloud.studentbatch where batch_id =$batchid");
      
       foreach($assignedStudents as $assignedStu){
          $this->container->logger->info($assignedStu);
          if($batchid !=NULL){
            $resultnew = $this->container->db->query("insert into ioniccloud.studentbatch (student_id, batch_id, school_id) 
          VALUES ('$assignedStu','$batchid','$school')");
          }else{
          $resultnew = $this->container->db->query("insert into ioniccloud.studentbatch (student_id, batch_id, school_id) 
          VALUES ('$assignedStu','$last_id','$school')");
        }
        }  
      return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-batch'));
    }
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-batch'));
  }
  public function unAllocatedStudents($request, $response, $args)
  {
    $data = $request->getParsedBody();
    $schoolid = $request->getParam('id');
    $schoolid = filter_var($schoolid, FILTER_SANITIZE_STRING); 
    $batchid = filter_var($batch_id, FILTER_SANITIZE_STRING); 
    $studentresult = $this->container->db->query("Select * from student where school='$schoolid' and student_id not in(Select student_id from studentbatch where school_id='$schoolid');");
    $studentresults =[];
    foreach($studentresult as $student)
    {
      array_push($studentresults,$student);
    }
    return json_encode($studentresults); 
  }
  public function allocatedStudents($request, $response, $args)
  {
    $data = $request->getParsedBody();
    $schoolid = $request->getParam('id');
    $schoolid = filter_var($schoolid, FILTER_SANITIZE_STRING); 
    $batchid = filter_var($batch_id, FILTER_SANITIZE_STRING); 
    $studentresult = $this->container->db->query("Select * from student where school='$schoolid' and student_id in(Select student_id from studentbatch where school_id='$schoolid');");
    $studentresults =[];
    foreach($studentresult as $student)
    {
      array_push($studentresults,$student);
    }
    return json_encode($studentresults); 
  }
  public function editBatch($request, $response, $args) { 
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-batch'));
   } 
  public function fetchBatch($request, $response, $args) {
    $data = $request->getParsedBody();
    $id = $request->getParam('id');
    $query = "Select * from batch where id='$id';";
    $this->container->logger->info($query);
    $batchResult = $this->container->db->query($query);
    $result =[];
    foreach($batchResult as $batch)
    {
      $this->container->logger->info("in here");
      $this->container->logger->info(json_encode($batch));
      array_push($result,$batch);
    }
    return json_encode($result); 
  }
}
?>