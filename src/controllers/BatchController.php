<?php
namespace App\Controllers;
use Psr\Container\ContainerInterface;
session_start();
class BatchController
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function listbatch($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $manageid = $request->getParam('id');
        $editId = $request->getParam('editid');
        $lessonId = $request->getParam('lid');
        $batchid = $request->getParam('bid');
        $schoolsid = $request->getParam('sid');
        $courseid = $request->getParam('cid');
        if ($batchid != null && $schoolsid != null && $courseid != null) {
            $result = $this->container->db->query("SELECT student FROM ioniccloud.batch where id = '$batchid' and school = '$schoolsid' and course_id = '$courseid';");
            $studentResult = $this->container->db->query("SELECT * FROM ioniccloud.student;");
            $results = [];
            $studentResults = [];
            $studentnames = [];
            while ($studentrow = mysqli_fetch_array($studentResult)) {
                array_push($studentResults, $studentrow);
            }
            while ($row = mysqli_fetch_array($result)) {
                $studentids = json_decode($row['student'], true);
                foreach ($studentResults as $studentname) {
                    foreach ($studentids as $studentid) {
                        if ($studentid === $studentname['student_id']) {
                            array_push($studentnames, $studentname['student_name']);
                            break;
                        }
                    }
                }
                $row['student'] = $studentnames;
                array_push($results, $row);
            }
            return json_encode($results);
        } else if ($editId != null) {
            $result = $this->container->db->query("SELECT batch.name, school.school_name, batch.school, batch.sdate, batch.edate, batch.activate
      FROM batch
      INNER JOIN school
      ON batch.school=school.sno where id = '$editId';");
            $results = [];
            while ($row = mysqli_fetch_array($result)) {
                array_push($results, $row);
            }
            return json_encode($results);
        } else if ($manageid != null) {
            $result = $this->container->db->query("SELECT school.sno, batch.id,batch.name,school.school_name,batch.student,batch.course_id
      FROM batch
      INNER JOIN school
      ON batch.school=school.sno where id = '$manageid';");
            $trainerresult = $this->container->db->query("SELECT school,trainer_name FROM ioniccloud.trainer where activate = 'Yes';");
            $lessonresult = $this->container->db->query("SELECT * FROM ioniccloud.lesson;");
            $results = [];
            $trainerresults = [];
            $lessonresults = [];
            while ($lessonrow = mysqli_fetch_array($lessonresult)) {
                array_push($lessonresults, $lessonrow);
            }
            while ($row = mysqli_fetch_array($result)) {
                while ($trainerrow = mysqli_fetch_array($trainerresult)) {
                    $schoolids = json_decode($trainerrow['school'], true);
                    foreach ($schoolids as $schoolid) {
                        if ($row['sno'] === $schoolid) {
                            array_push($trainerresults, $trainerrow['trainer_name']);
                            break;
                        }
                    }
                }
                $lessonnames = [];
                $lessonIds = [];
                foreach ($lessonresults as $lessonname) {
                    if ($row['course_id'] === $lessonname['course_id']) {
                        array_push($lessonnames, $lessonname['lesson_name']);
                        array_push($lessonIds, $lessonname['id']);
                    }
                }
                $courseId = $row['course_id'];
                $courseresult = $this->container->db->query("SELECT name FROM ioniccloud.course where id='$courseId';");
                $courseresults = [];
                while ($courserow = mysqli_fetch_array($courseresult)) {
                    $row['coursename'] = $courserow['name'];
                }
                $row['trainername'] = $trainerresults;
                $row['lessonname'] = $lessonnames;
                $row['lessonid'] = $lessonIds;
                array_push($results, $row);
            }
        } else {
            $result = $this->container->db->query("SELECT batch.id,batch.name,school.school_name,batch.student,batch.sdate,batch.edate,batch.course_id,batch.activate
    FROM batch
    INNER JOIN school
    ON batch.school=school.sno;");
            $studentresult = $this->container->db->query("SELECT * FROM ioniccloud.student;");
            $courseresult = $this->container->db->query("SELECT id, name FROM ioniccloud.course;");
            $results = [];
            $studentresults = [];
            $courseresults = [];
            while ($studentrow = mysqli_fetch_array($studentresult)) {
                array_push($studentresults, $studentrow);
            }
            while ($courserow = mysqli_fetch_array($courseresult)) {
                array_push($courseresults, $courserow);
            }
            while ($row = mysqli_fetch_array($result)) {
                $studentids = json_decode($row['student'], true);
                $studentresult = [];
                foreach ($studentids as $studentid) {
                    foreach ($studentresults as $student) {
                        if ($student['student_id'] === $studentid) {
                            array_push($studentresult, $student['student_name']);
                            break;
                        }
                    }
                }
                $courseresult = [];
                foreach ($courseresults as $coursename) {
                    if ($row['course_id'] === $coursename['id']) {
                        array_push($courseresult, $coursename['name']);
                        break;
                    }
                }
                $row['student'] = $final;
                $row['course_id'] = $courseresult;
                array_push($results, $row);
            }
        }
        return json_encode($results);
    }
    public function addbatch($request, $response, $args)
    {
        $batch_random = $_SESSION['bat_res'];
        if (!$batch_random) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-batch'));
        }
        $_SESSION['bat_res'] = false;
        $data = $request->getParsedBody();
        $batchid = filter_var($data['bid'], FILTER_SANITIZE_STRING);
        $name = filter_var($data['bname'], FILTER_SANITIZE_STRING);
        $school = filter_var($data['schoolname'], FILTER_SANITIZE_STRING);
        $assignedStudents = $data['assignedStudents'];
        $studentsEncoded = json_encode($assignedStudents);
        $startdate = filter_var($data['sdate'], FILTER_SANITIZE_STRING);
        $enddate = filter_var($data['edate'], FILTER_SANITIZE_STRING);
        $date = date('y-m-d', strtotime($startdate));
        $edate = date('y-m-d', strtotime($enddate));
        $act = $data['activate'];
        $sqli = $this->container->db;
        if ($batchid != null) {
            $result = $sqli->query("UPDATE ioniccloud.batch SET name='$name', school='$school', student='$studentsEncoded', sdate='$date', edate='$edate', activate='$act' WHERE id='$batchid';");
        } else {
            $result = $sqli->query("insert into ioniccloud.batch (name, school, student, sdate, edate, activate)
      VALUES ('$name','$school','$studentsEncoded','$date','$edate','$act')");
        }
        if (mysqli_affected_rows($sqli) == 1) {
            $last_id = mysqli_insert_id($sqli);
            $result = $sqli->query("delete from ioniccloud.studentbatch where batch_id =$batchid");
            foreach ($assignedStudents as $assignedStu) {
                if ($batchid != null) {
                    $resultnew = $this->container->db->query("insert into ioniccloud.studentbatch (student_id, batch_id, school_id)
            VALUES ('$assignedStu','$batchid','$school')");
                } else {
                    $resultnew = $this->container->db->query("insert into ioniccloud.studentbatch (student_id, batch_id, school_id )
          VALUES ('$assignedStu','$last_id','$school')");
                }
            }
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-batch'));
        }echo ("<script>window.alert('Record Could Not Be Added');</script>");
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-batch'));
    }
    public function batchedstudents($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $schoolid = $request->getParam('id');
        $batchid = $request->getParam('bid');
        $studentresultunAllocated = $this->container->db->query("Select * from student where school='$schoolid' and student_id not in(Select student_id from studentbatch where school_id='$schoolid');");
        $studentresultAllocated = $this->container->db->query("Select * from student where school='$schoolid' and student_id in(Select student_id from studentbatch where school_id='$schoolid' and batch_id = '$batchid');");
        $studentresults = [];
        $unAllocated = [];
        $allocated = [];
        foreach ($studentresultunAllocated as $student) {
            array_push($unAllocated, $student);
        }
        foreach ($studentresultAllocated as $student) {
            array_push($allocated, $student);
        }
        $studentresults['unAllocated'] = $unAllocated;
        $studentresults['allocated'] = $allocated;
        return json_encode($studentresults);
    }
    public function selectCourse($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'select-course'));
    }
    public function updateCourse($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $batchid = $data['batchid'];
        $selectcourse = filter_var($data['selectcourse'], FILTER_SANITIZE_STRING);
        $sqli = $this->container->db;
        $result = $sqli->query("UPDATE batch SET course_id= '$selectcourse' WHERE id = '$batchid';");
        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-batch'));
        }
        echo ("<script>window.alert('Record Not Added');</script>");
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-batch'));
    }
    public function lessonPlan($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'lesson-plan'));
    }
    public function editBatch($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-batch'));
    }
    public function studentProgress($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'student-progress'));
    }
}