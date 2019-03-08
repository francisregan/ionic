<?php
    include 'content-navigation.php';
?>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Slim 3</title>
        <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    <?php 
        if(isset($user)){
            if($redirect){
                $var = $redirect;
            }
            include 'student-content.php'; 
        }
    ?>
    </body>
</html>