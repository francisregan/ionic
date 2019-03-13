<html>
<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link href="semantic/dist/semantic.min.css" rel="stylesheet">
<script src="semantic/dist/semantic.min.js"></script>
<link href="css/style.css" rel="stylesheet">

</head>
<body >

<script>
    $(function () {
        $('#menu a').on('click', function (e) {
            e.preventDefault();
            var page = $(this).attr('href');
            $('#content').load("../templates/"+page);
            var x = $("#content").position(); 
            window.scrollTo(x.left, x.top);
        });
    });

    $(function () {
        var redirect = <?php echo (!empty($redirect) ? json_encode($redirect) : '"e"'); ?>;
        if (redirect !== "e" && redirect.length > 2) {
          $('#content').load("../templates/"+redirect+".php");
        }
    });
</script>

<div class="ui horizontal menu">

<div class="ui vertical menu left" style="width:15em; font-size: 1.5rem; text-align: left;">
<?php 
if( $_SESSION['type'] == 1){
?>
<div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-home"></i>
    &nbsp;&nbsp; 
    Home
  </div> 
  <div class="menu" id="menu">
    <a href="profile.php" class="item">Profile</a>
    <a class="item">Edit Profile</a>
  </div>
  </div>
    <div class="item txtsizegrid">
      <div class="ui left icon input">
      <i class="fas fa-book-reader"></i>
        &nbsp;&nbsp; 
        Course
      </div> 
      <div class="menu" id="menu">
        <a href="view-course.php" class="item">Manage Course</a>
      </div>
    </div>
<?php 
}else{
?>
<div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-university"></i>
    &nbsp;&nbsp; School Management
  </div> 
  <div class="menu" id="menu">
  <a href="manage-school.php#" class="item">Manage Schools</a>
  <a href="add-school.php#" class="item">Add a school </a>
  </div>
  </div>

  <div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-chalkboard-teacher"></i>
    &nbsp;&nbsp;Trainer Management
  </div> 
    <div class="menu" id="menu">
      <a href="manage-trainer.php#" class="item">Manage Trainers </a>
      <a href="add-trainer.php#" class="item">Add a Trainer </a>
      <a class="item">Allocate trainer to schools </a>
      <a class="item">Manage content for trainer </a> 
    </div>
  </div>

  <div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-child"></i>
    &nbsp;&nbsp;Student Management
  </div> 
    <div class="menu" id="menu">
      <a href="manage-student.php" class="item" >Manage Students</a>
      <a href="add-student.php" class="item">Add a student</a>
      <a class="item">Bulk upload student data</a>
    </div>
  </div>

  <div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-child"></i>
    &nbsp;&nbsp;Course Management
  </div> 
    <div class="menu" id="menu">
      <a href="manage-category.php" class="item">Manage Categories</a>
      <a href="add-course.php" class="item">Add New Course</a>
      <a href="manage-course.php" class="item">Manage Course</a>
      <a href="add-lesson.php" class="item">Add new lesson</a>
      <a href="manage-lesson.php" class="item">Manage Lesson</a>
      <a href="Manage Contents" class="item">Manage Contents</a>
    </div>
  </div>

  <div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-users"></i>
    &nbsp;&nbsp;Batch Management
  </div> 
    <div class="menu" id="menu">
      <a href="manage-batch.php" class="item">Manage Batches</a>
      <a href="add-batch.php" class="item">Add New Batches</a>
    </div>
  </div>

  <div class="item txtsizegrid">
  <div class="ui left icon input">
    <i class="fas fa-chart-pie"></i>
    &nbsp;&nbsp;Reporting
  </div> 
    <div class="menu">
      <a class="item">View reports of trainers</a>
      <a class="item">View reports of students</a>
      <a class="item">Check student feedbacks</a>
    </div>
</div>
<?php
}
?>
</div>
<div class="content" id="content" style="top:100%; width:100em; font-size: 1rem; text-align:center;"> </div>
</div>
</body>
</html>