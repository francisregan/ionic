<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

session_start();

class CourseController
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function listcourse($request, $response, $args)
    {
        if ($_SESSION['type'] == 1) {
            $studentid = $_SESSION['student_id'];
            $result = $this->container->db->query("SELECT distinct c.id, c.name
        FROM ioniccloud.studentbatch sb, ioniccloud.batch b, ioniccloud.course c, ioniccloud.allocatelesson al
        where sb.student_id = '$studentid' and sb.batch_id = b.id and b.course_id = c.id and al.course_id = c.id;");

            $results = [];

            while ($row = mysqli_fetch_array($result)) {
                $courseid = $row['id'];
                $allocateresult = $this->container->db->query("SELECT * FROM ioniccloud.allocatelesson where course_id = '$courseid';");
                $allocateresults = [];
                $count = 0;
                while ($allocaterow = mysqli_fetch_array($allocateresult)) {
                    $lessonids = json_decode($allocaterow['lesson_ids'], true);
                    foreach ($lessonids as $lessonid) {
                        $count = $count + 1;
                    }
                }
                $row['lesson_ids'] = $count;
                array_push($results, $row);
            }
        } else {
            $result = $this->container->db->query("SELECT * FROM ioniccloud.course;");
            $results = [];
            while ($row = mysqli_fetch_array($result)) {
                array_push($results, $row);
            }
        }
        return json_encode($results);
    }

    public function addcourse($request, $response, $args)
    {

        $course_random = $_SESSION['cou_res'];
        if (!$course_random) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-course'));
        }

        $_SESSION['cou_res'] = false;

        $data = $request->getParsedBody();
        $name = filter_var($data['cname'], FILTER_SANITIZE_STRING);
        $type = filter_var($data['ctype'], FILTER_SANITIZE_STRING);
        $duration = filter_var($data['duration'], FILTER_SANITIZE_STRING);
        $value = $data['frequency'];
        $sessions = filter_var($data['sessions'], FILTER_SANITIZE_STRING);
        $act = $data['activate'];
        $sqli = $this->container->db;
        $result = $sqli->query("insert into ioniccloud.course (name, type, duration, printing, session, activate)
    VALUES ('$name','$type','$duration','$value','$sessions', '$act')");
        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-course'));
        }

        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-course'));
    }
    public function allocateLesson($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $allocateid = $data['aid'];
        $course = $data['course'];
        $category = filter_var($data['category'], FILTER_SANITIZE_STRING);
        $lessons = $data['lesson'];
        $act=$data['activate'];
        $lessonsEncoded = json_encode($lessons);

        $sqli = $this->container->db;
        if ($allocateid != null) {
            $result = $sqli->query("UPDATE ioniccloud.allocatelesson SET course_id='$course', category_id='$category', lesson_ids='$lessonsEncoded', activate='$act' WHERE id='$allocateid';");
            echo ("<script>window.alert('Record Updated Successfully');</script>");
        } else {
            $result = $sqli->query("INSERT INTO ioniccloud.allocatelesson (course_id, category_id, lesson_ids, activate)
  VALUES ('$course','$category','$lessonsEncoded','$act')");
        }
        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-allocatelesson'));
        }
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'allocate-lesson'));
    }

    public function listAllocate($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $request->getParam('id');
        $this->container->logger->info($id);
        if ($id != null) {
            $result = $this->container->db->query("SELECT c.name As course_name, ct.name As category_name, al.id, al.lesson_ids, al.activate FROM ioniccloud.allocatelesson al, ioniccloud.course c, ioniccloud.category ct where al.course_id=c.id and al.category_id=ct.id and al.id='$id';");
        }else{
            $result = $this->container->db->query("SELECT c.name As course_name, ct.name As category_name, al.id, al.lesson_ids, al.activate FROM ioniccloud.allocatelesson al, ioniccloud.course c, ioniccloud.category ct where al.course_id=c.id and al.category_id=ct.id;");
        }
            $results = [];
            $lessonresult = $this->container->db->query("SELECT * FROM ioniccloud.lesson;");
            $results = [];
            $lessonresults = [];
            while ($lessonrow = mysqli_fetch_array($lessonresult)) {
                array_push($lessonresults, $lessonrow);
            }
            while ($row = mysqli_fetch_array($result)) {
                $lessonids = json_decode($row['lesson_ids'], true);
                $lessonresult = [];
                foreach ($lessonids as $lessonid) {
                    foreach ($lessonresults as $lesson) {
                        if ($lesson['id'] === $lessonid) {
                            array_push($lessonresult, $lesson['lesson_name']);
                            break;
                        }
                    }
                }
                $row['lesson'] = $lessonresult;
                array_push($results, $row);
            }
            return json_encode($results);
    }  
    public function editAllocate($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'allocate-lesson'));
    }

}
