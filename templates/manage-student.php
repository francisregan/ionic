<html>
<head>
<title> Manage Student </title>

<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  url: "student",
  success: function(data){
    var schools = JSON.parse(data);
    
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
      var table = document.getElementById("mytable");
        var row = table.insertRow(1);
        var cellcheckbox = row.insertCell(0);
        var cellserial = row.insertCell(1);
        var cellstudent = row.insertCell(2);
        var cellcontactno = row.insertCell(3);
        var cellschool = row.insertCell(4);
        var cellbatch = row.insertCell(5);
        var cellclass = row.insertCell(6);
        var celledit = row.insertCell(7);

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellserial.innerHTML = obj.sno;
        cellstudent.innerHTML = obj.student_name;
        cellcontactno.innerHTML = obj.contact_number;
        cellschool.innerHTML = obj.school_name;
        cellbatch.innerHTML = obj.batch;
        cellclass.innerHTML = obj.class;
        celledit.innerHTML = document.getElementById("edit").innerHTML
    }
  },
  error:function(error){
    console.log(error);
  }});
});

</script>

</head>

<body>
<h3 class="ui header" style="text-align: left;">Manage Student</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Student ID</th>
      <th>Student Name</th>
      <th>Contact No</th>
      <th>School</th>
      <th>Batch</th>
      <th>Class</th>
      <th>Edit Details</th>
    </tr>
  </thead>
  <tbody>

  <script id="check" type="text/template">
      <div class="collapsing">
        <div class="ui fitted slider checkbox">
          <input type="checkbox"><label></label>
        </div>
      </div>
  </script>

  <script id="edit" type="text/template">
		<div class="ui form" id="edit">
      <button class="ui primary basic button">Edits</button>
		</div>
  </script>

  <script id="tarea" type="text/template"> 
		<div class="ui form">
			<div class="field">
			<textarea rows="1"></textarea>
		</div>
  </script> 
  

  </tbody>
  <tfoot class="full-width">
    <tr>
      <th></th>
      <th colspan="8">
        <div class="ui right floated pagination menu">
        <a class="icon item">
          <i class="left chevron icon"></i>
        </a>
        <a class="item">1</a>
        <a class="item">2</a>
        <a class="item">3</a>
        <a class="item">4</a>
        <a class="icon item">
          <i class="right chevron icon"></i>
        </a>
      </div>
        <div class="ui small button">
          Approve
        </div>
        <div class="ui small  disabled button">
          Approve All
        </div>
      </th>
    </tr>
  </tfoot>
  
  
</table>
</body>
</html>