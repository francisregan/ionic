<?php

session_start();

$student_data = $_SESSION["student_data"];
   $arr = json_decode($student_data, true);

   $file_url = 'http://localhost/ionic/templates/image.php?unique_reference='.$arr["unique_reference"];
    

    header('Content-Type: image/png');
    header("Content-disposition: attachment; filename=\"".$arr["unique_reference"]."\".jpg"); 
    readfile($file_url);

    
?>