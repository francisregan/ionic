<?php  
session_start();

$student_data = $_SESSION["student_data"];

$arr = json_decode($student_data, true);


?>
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
<script src="jquery-3.1.1.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
<script src="semantic/dist/components/form.js"></script>
<script src="semantic/dist/components/transition.js"></script>
<html>
<head>

<style type="text/css">
    .ui.segment {
        border:0px;
    }
  </style>

<!-- <script>
    $(function () {
      var unique_reference = "<?php echo $unique_reference ?>";
      $('#content').load("image");
      var x = $("#content").position(); //gets the position of the div element...
      window.scrollTo(x.left, x.top); //window.scrollTo() scrolls the page upto certain position....
    });
</script> -->

</head>
<body>
<div class="ui one column grid container">
  <div class="column">
    <div class="ui segment">
        <a href="http://localhost/ionic/templates/download_cert.php?unique_reference=<?php echo  $arr["unique_reference"]?>" class="ui labeled icon button">
        
        <button class="ui primary button">
        Download Certificate as JPG
        </button>
       <i class="blue download icon" ></i>
        </a>
    </div>
  </div>
  <div class="column">
    <div class="ui segment">
      <?php 
      echo "<img src=\"http://localhost/ionic/templates/image.php?unique_reference=".$arr["unique_reference"]."\" />";
      ?>
 
    </div>
  </div>
  </div>
</body>
</html>
    