<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();

class LessonController
{
   protected $container;
   public function __construct(ContainerInterface $container) {
     $this->container = $container;
   }

   public function listlesson($request, $response, $args) {
    $result = $this->container->db->query("SELECT lesson.id,lesson.lesson_name,lesson.category_id,category.name,lesson.total_pages
    FROM lesson
    INNER JOIN category
    ON lesson.category_id=category.id;");
   
    $results = [];
    while($row = mysqli_fetch_array($result)) {
      array_push($results, $row);
    }
    return json_encode($results);
  }
  
  public function addLesson($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    
    $course = filter_var($data['course'], FILTER_SANITIZE_STRING);
    $name = filter_var($data['lessonname'], FILTER_SANITIZE_STRING);
    $category = filter_var($data['category'], FILTER_SANITIZE_STRING);
    $totalPage = filter_var($data['noofpages'], FILTER_SANITIZE_STRING);
    $pages = $data["arr"];

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

      $resultPages = $sqli->query("INSERT INTO ioniccloud.lessonpages (lesson_id, page_no, content, md5file) 
      VALUES ('$lessonIds','$i','$pageName','$md5File')");
      array_push($addedIDs, mysqli_insert_id($sqli));

    $pageidsEncode = json_encode($addedIDs);
  }

    $result = $sqli->query("INSERT INTO ioniccloud.lesson (lesson_name, category_id, total_pages, page_ids, course_id) 
    VALUES ('$name','$category','$totalPage','$pageidsEncode','$course')");

    return $this->container->renderer->render($response, 'index.php', array('redirect'=>'manage-lesson'));
 
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-lesson'));
  }
}
?>