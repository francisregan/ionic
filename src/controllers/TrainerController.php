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

   public function load($request, $response, $args) 
   {
    return $this->container->renderer->render($response, 'add-trainer.php', $args);
   }

  public function trainer($request, $response, $args) 
  {
    $this->container->logger->info("successfully reached here");
    $data = $request->getParsedBody();
    $name = filter_var($data['tname'], FILTER_SANITIZE_STRING);
    $contact = filter_var($data['tphoneno'], FILTER_SANITIZE_STRING);
    $mail = filter_var($data['tmailid'], FILTER_SANITIZE_STRING);
    /* $specialization = filter_var($data['tspec'], FILTER_SANTIZE_STRING); */
    $specialization = $data['tspec'];
    $school = $data['tschool'];
$sqli = $this->container->db;

$result = $sqli->query("INSERT INTO ioniccloud.trainer (trainer_Name, Contact_no, mail_id, specialization, school) 
VALUES ('$name','$contact','$mail','$specialization','$school')");
if (mysqli_affected_rows($sqli)==1) {

    return $this->container->renderer->render($response, 'index.php',  $args);
}
echo("<script>window.alert('not done');</script>");
    return $this->container->renderer->render($response, 'index.php', $args);
}
}

  ?>