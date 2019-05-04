<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <link href="semantic/dist/semantic.min.css" rel="stylesheet">
    <script type="text/javascript" src="jquery-3.1.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <script src="semantic/dist/semantic.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <style>
       body{
         background-color: white; 
       }  

      @media only screen and (max-width: 600px) {
         .hide{
           display:none;
         }
         .search.icon{
           display:none;
         }
      }
    </style>
    <title></title>
</head>
    <body>
    <div class="ui medium menu" style="height:140px">
    <div class="left menu" style="align:center;vertical-align: middle;">
        <a href="index.php"><img src="images/ionic.png" height="80" width="420" title="Ionic3DP EDUCATION" alt="Ionic3DP EDUCATION" /></a>
    </div>
    </div>
    
    <div class="ui massive menu" >
    <?php
        $user=$_SESSION['user'];
        if(!isset($user)){
    ?>
    <div class="left menu">
    <a class="item" href="certification"> Verify Certification</a>
    </div>
    <?php } ?>
    <div class="right menu">
        <?php include 'loginheader.php'; ?>
    </div>
    </div>
    </body>
</html>