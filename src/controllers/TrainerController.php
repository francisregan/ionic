<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

session_start();

class TrainerController
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function listTrainer($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $id = $request->getParam('id');
        if ($id != null) {
            $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer where trainer_id = '$id';");
        } else {
            $result = $this->container->db->query("SELECT * FROM ioniccloud.trainer;");
        }
        $schoolresult = $this->container->db->query("SELECT * FROM ioniccloud.school;");
        $results = [];
        $schoolresults = [];
        while ($schoolrow = mysqli_fetch_array($schoolresult)) {
            array_push($schoolresults, $schoolrow);
        }

        while ($row = mysqli_fetch_array($result)) {
            $final = "";
            $schoolids = json_decode($row['school'], true);
            $schoolresult = [];
            foreach ($schoolids as $schoolid) {
                foreach ($schoolresults as $school) {
                    if ($school['sno'] === $schoolid) {
                        array_push($schoolresult, $school['school_name']);
                        break;
                    }
                }
            }
            $row['school'] = $schoolresult;
            array_push($results, $row);
        }
        $this->container->logger->info(json_encode($school));
        return json_encode($results);
    }

    public function addTrainer($request, $response, $args)
    {
        $trainer_random = $_SESSION['tra_res'];
        if (!$trainer_random) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-trainer'));
        }

        $_SESSION['tra_res'] = false;
        $data = $request->getParsedBody();
        $trainerid = $data['tid'];
        $name = filter_var($data['tname'], FILTER_SANITIZE_STRING);
        $contact = filter_var($data['tphoneno'], FILTER_SANITIZE_STRING);
        $mail = filter_var($data['tmailid'], FILTER_SANITIZE_STRING);
        $specialization = $data['tspec'];
        $schools = $data['schoolname'];
        $country=$data['country'][0];
        $act = $data['activate'];
        foreach ($schools as $school) {
            $this->container->logger->info("here");
        }
        $schoolsEncoded = json_encode($schools);
        $this->container->logger->info($schoolsEncoded);
        $address = $data['taddress'];
        $sqli = $this->container->db;
        if ($trainerid != null) {
            $result = $sqli->query("UPDATE ioniccloud.trainer SET trainer_name='$name', contact_no='$contact', mail_id='$mail',specialization='$specialization', school='$schoolsEncoded', address='$address', activate='$act', country='$country' WHERE trainer_id='$trainerid';");
            echo ("<script>window.alert('Record Updated Successfully');</script>");
        } else {
            $result = $sqli->query("INSERT INTO ioniccloud.trainer (trainer_name, contact_no, mail_id, specialization, school, address,activate,country)
  VALUES ('$name','$contact','$mail','$specialization', '$schoolsEncoded','$address','$act','$country')");
        }
        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-trainer'));
        }
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-trainer'));
    }
    public function editTrainer($request, $response, $args)
    {
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'add-trainer'));
    }
}
