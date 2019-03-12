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
            $result = $this->container->db->query("SELECT c.id, c.name, COUNT(l.course_id) AS Total_Lesson
        FROM ioniccloud.studentbatch sb, ioniccloud.batch b, ioniccloud.course c, ioniccloud.lesson l
        where sb.student_id = '$studentid' and sb.batch_id = b.id and b.course_id = c.id and l.course_id = c.id;");

            $results = [];
            while ($row = mysqli_fetch_array($result)) {
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
        $sqli = $this->container->db;
        $result = $sqli->query("insert into ioniccloud.course (name, type, duration, printing, session )
    VALUES ('$name','$type','$duration','$value','$sessions')");
        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-course'));
        }

        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-course'));
    }
}
