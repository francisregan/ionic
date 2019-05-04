<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class LessonController
{
   protected $container;
   public function __construct(ContainerInterface $container) 
   {
     $this->container = $container;
   }

   public function listlesson($request, $response, $args) 
   {
    $data = $request->getParsedBody();
    $id = $request->getParam('id');
    $courseid = $request->getParam('lid');
    if($courseid!= NULL){
      $result = $this->container->db->query("SELECT c.name As coursename, ct.name As categoryname, al.lesson_ids FROM ioniccloud.allocatelesson al, ioniccloud.category ct, ioniccloud.course c where al.course_id= '$courseid' and al.course_id = c.id
      and al.category_id = ct.id;");
      $lessonresult = $this->container->db->query("SELECT * FROM ioniccloud.lesson;");
      $results = [];
      $lessonresults = [];
      while ($lessonrow = mysqli_fetch_array($lessonresult)) {
          array_push($lessonresults, $lessonrow);
      }
      while($row = mysqli_fetch_array($result)) {
        $lessonids = json_decode($row['lesson_ids'], true);
        $lessonresult = [];
        $lessonIdsresult = [];
        foreach ($lessonids as $lessonid) {
            foreach ($lessonresults as $lesson) {
                if ($lesson['id'] === $lessonid) {
                    array_push($lessonresult, $lesson['lesson_name']);
                    array_push($lessonIdsresult, $lesson['id']);
                    break;
                }
            }
        }
        $row['lesson'] = $lessonresult;
        $row['lesson_ids'] = $lessonIdsresult;
        array_push($results, $row);
      }
      return json_encode($results);
    }else if($id != NULL)
     {
      $result = $this->container->db->query("SELECT lesson.id,lesson.lesson_name,lesson.total_pages,lesson.activate
      FROM lesson where  lesson.id = '$id';");
      $lessonpagesresult = $this->container->db->query("SELECT * FROM ioniccloud.lessonpages where lesson_id = '$id';");
        $lessonpagesresults = [];
        while($lessonpagerow = mysqli_fetch_array($lessonpagesresult)) 
         {
          $file = file_get_contents($lessonpagerow['content'], true);
          $lessonpagerow['content'] = $file;
          array_push($lessonpagesresults,$lessonpagerow['content']);
        }
        
    }else{
    $result = $this->container->db->query("SELECT lesson.id,lesson.lesson_name,lesson.total_pages,lesson.activate FROM lesson;");
    }
    $results = [];
    while($row = mysqli_fetch_array($result)) {
      if($id != NULL){
        $row['content'] = $lessonpagesresults;
      }
      array_push($results, $row);
    }
    return json_encode($results);
  }
  public function addLesson($request, $response, $args) 
   {
        $lesson_random = $_SESSION['les_res'];
        if (!$lesson_random) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-lesson'));
        }

        $_SESSION['les_res'] = false;

    $data = $request->getParsedBody();
    $lessonid = $data['lid'];
    $name = filter_var($data['lessonname'], FILTER_SANITIZE_STRING);
    $totalPage = filter_var($data['noofpages'], FILTER_SANITIZE_STRING);
    $pages = $data["arr"];
    $act=$data['activate'];  

    $lesson = [];
    $pageArray = json_decode($pages, true);
    foreach($pageArray as $page){
    array_push($lesson, $page);
    }
   
    $sqli = $this->container->db;
 
    // Find out the last added ID in lesson table
    $lastIdLesson = $sqli->query("SELECT id FROM ioniccloud.lesson ORDER BY ID DESC LIMIT 1;");
     
    while($row = mysqli_fetch_array($lastIdLesson)) {
      $lessonIds = $row['id'];
    }
    $lessonIds = $lessonIds+1;
    
    $addedIDs = [];
    if ($lessonid != null) {
      $deleteresult = $sqli->query("delete from ioniccloud.lessonpages where lesson_id = '$lessonid'");
    }
    for($i=1; $i<=$totalPage; $i++){
      $content = $lesson[$i-1];
      
      $lessonName = str_replace(' ', '', $name);  //remove space from string
      
      //creating folder of lesson
      if (!file_exists($this->container->files.'/'.$lessonName)) {      
        mkdir($this->container->files.'/'.$lessonName);
    }

      $pageName = $this->container->files.'/'.$lessonName.'/'.$lessonName.'_'.$i.".txt";
      $myfile = fopen($pageName, "w");
      fwrite($myfile, $content);
      fclose($myfile);

      $md5File = md5_file($pageName);
      if ($lessonid != null) {
        $resultPages = $sqli->query("INSERT INTO ioniccloud.lessonpages (lesson_id, page_no, content, md5file) 
        VALUES ('$lessonid','$i','$pageName','$md5File')");
      }else{
        $resultPages = $sqli->query("INSERT INTO ioniccloud.lessonpages (lesson_id, page_no, content, md5file) 
        VALUES ('$lessonIds','$i','$pageName','$md5File')");
      }
      array_push($addedIDs, mysqli_insert_id($sqli));

    $pageidsEncode = json_encode($addedIDs);
  } 
   
  if ($lessonid != null) {
    $result = $sqli->query("UPDATE ioniccloud.lesson SET lesson_name='$name', total_pages='$totalPage',page_ids='$pageidsEncode', activate='$act' WHERE id='$lessonid';");
  }else{
    $result = $sqli->query("INSERT INTO ioniccloud.lesson (lesson_name, total_pages, page_ids ,activate) 
    VALUES ('$name','$totalPage','$pageidsEncode','$act')");
  }
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-lesson'));
 
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-lesson'));
} 
  public function editlesson($request, $response, $args) {
    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-lesson'));
} 
public function viewLesson($request, $response, $args) {
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'view-lesson'));
}

public function viewContent($request, $response, $args) {
  return $this->container->renderer->render($response, 'content-index.php', array('redirect'=>'view-content'));
}
public function viewContents($request, $response, $args) {
  $data = $request->getParsedBody();
  $lessonid = $request->getParam('id');
  $result = $this->container->db->query("SELECT lp.*, l.lesson_name FROM ioniccloud.lessonpages lp, ioniccloud.lesson l where lesson_id = $lessonid and l.id = lp.lesson_id;");
  $results = [];
  $content = [];
  while($row = mysqli_fetch_array($result)) {
    $file = file_get_contents($row['content'], true);
    $row['content'] = $file;
    array_push($results,$row);
  }
  return json_encode($results);
}
}

?>