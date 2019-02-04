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

  public function addLesson($request, $response, $args) 
  {
    $data = $request->getParsedBody();
    
    $name = filter_var($data['lessonname'], FILTER_SANITIZE_STRING);
    $category = filter_var($data['category'], FILTER_SANITIZE_STRING);
    $totalPage = filter_var($data['noofpages'], FILTER_SANITIZE_STRING);
    $pages = $data["arr"];
    $this->container->logger->info("----");

    $lesson = [];
    $pageArray = json_decode($pages, true);
    for($i=0; $i<$totalPage; $i++){
      $tempdata = $pageArray[$i];
      $pageid = ($i+1);
      array_push($lesson, $tempdata);
    }
    

    // Find out the last added ID in lesson table
    $lastidlesson = $this->container->db->query("SELECT id FROM lesson ORDER BY ID DESC LIMIT 1;");
    
    while($row = mysqli_fetch_array($lastidlesson)) {
      $lessonids = json_decode($row['id'], true);
      $this->container->logger->info($lessonids);
    }
    $this->container->logger->info("here");
    $lessonids = $lessonids+1;
    $sqli = $this->container->db;
    $addedIDs = [];
  if (mysqli_affected_rows($sqli)==1) {
    for($i=1; $i<=$totalPage; $i++){
      $content = $lesson[$i-1];
      
      $lessonname = str_replace(' ', '', $name);  //remove space from string

      $pagename = "../../".$lessonname.'_'.$i.".txt";
      $myfile = fopen($pagename, "w");
      fwrite($myfile, $content);
      fclose($myfile);
      $md5file = md5_file($pagename);
      $this->container->logger->info($md5file);

      $resultPages = $sqli->query("INSERT INTO ioniccloud.lessonpages (lesson_id, page_no, content, md5file) 
      VALUES ('$lessonids','$i','$pagename','$md5file')");
      array_push($addedIDs, mysqli_insert_id($sqli));
    }
    $pageidsEncode = json_encode($addedIDs);
    $this->container->logger->info($pageidsEncode);


    $result = $sqli->query("INSERT INTO ioniccloud.lesson (lesson_name, category_id, total_pages, page_ids) 
    VALUES ('$name','$category','$totalPage','$pageidsEncode')");

    return $this->container->renderer->render($response, 'index.php', array('redirect'=>''));
  }
  return $this->container->renderer->render($response, 'index.php', array('redirect'=>'add-lesson'));
  }
}
?>
