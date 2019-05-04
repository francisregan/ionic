<?php
namespace App\Controllers;

use Psr\Container\ContainerInterface;

session_start();

class BulkController
{
    protected $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function bulkUpload($request, $response, $args)
    {
        $data = $request->getParsedBody();
        $file = $_FILES["file"]["tmp_name"];

        $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        if($ext == "csv"){
        $sqli = $this->container->db;
        if (($h = fopen($file, "r")) !== FALSE) 
        {
          while (($filedata = fgetcsv($h, 1000, ",")) !== FALSE) 
          {		
            if($filedata[0] != "student_name"){
              $result = $sqli->query("INSERT INTO ioniccloud.student (student_name, contact_number, email, school,
              age, batch, class, parent_name,activate) VALUES ('$filedata[0]','$filedata[1]','$filedata[2]','$filedata[3]','$filedata[4]','$filedata[5]',
              '$filedata[6]','$filedata[7]','$filedata[8]')");             
            }
          }
          fclose($h);
        }
        if (mysqli_affected_rows($sqli) == 1) {
            return $this->container->renderer->render($response, 'index.php', array('redirect' => 'manage-student'));
        }
        echo ("<script>window.alert('Record Not Added');</script>");
      }else{
        echo ("<script>window.alert('File formate should be csv file');</script>");
      }
        return $this->container->renderer->render($response, 'index.php', array('redirect' => 'bulk-upload'));
    }
}