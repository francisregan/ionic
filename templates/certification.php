<?php
include 'navigation.php';

?>

<html>
<head>
  <style type="text/css">
      .column {
         max-width: 80%; 
      }
      .error{
        color: red;
      }
  </style>
</head>
<body>

<div class="ui middle aligned container">
<div class="column">
<div>
<h2 class="ui header" style="margin-left: 10px; margin-top: 130px; text-align:center;">Verify certification of a student </h2>
  <div class="ui bottom attached segment">
  <form class="ui form" method="post">
  
<!--     <label>Certification Unique Code</label> -->
    <input type="text"  name="unique" placeholder="Enter Unique Code" style=" margin-top: 30px; text-align:center;">
    <span class="error">* <?php echo $uniqueErr;?></span>
  </div>
  </div>
  <input id="submitBtn" type="submit" class="ui inverted blue button" name="fetch" value="Fetch Records"  style=" margin-top: 30px;"></input>
 
</form>
</div>
</div>
</div>
</body>
</html>