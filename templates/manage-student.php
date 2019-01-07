<html>
<head>
<title> Manage Student </title>
<link href="css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
  var table;
  var row;
$.ajax({ 
  type: 'GET',
  async: false,
  url: "student",
  success: function(data){
    var schools = JSON.parse(data);
    
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
      console.log(obj);
        table = document.getElementById("mytable");
        row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellstudent = row.insertCell(1);
        var cellcontactno = row.insertCell(2);
        var cellmail = row.insertCell(3);
        var cellschool = row.insertCell(4);
        var cellbatch = row.insertCell(5);
        var celledit = row.insertCell(6);

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellstudent.innerHTML = obj.student_name;
        cellcontactno.innerHTML = obj.contact_number;
        cellmail.innerHTML = obj.email;
        cellschool.innerHTML = obj.school;
        cellbatch.innerHTML = obj.batch;
        celledit.innerHTML = document.getElementById("edit").innerHTML
    }
  },
  error:function(error){
    console.log(error);
  }});

$(".pagination").customPaginate({

itemsToPaginate : ".rowdata"

});
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
      <th>Student Name</th>
      <th>Contact No</th>
      <th>Mail Address</th>
      <th>School</th>
      <th>Batch</th>
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

  </tbody>
  <tfoot class="full-width">
    <tr>
      <th></th>
      <th colspan="8">
        <div class="ui right floated pagination menu">

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
<script type="text/javascript" src="script/pagination.js">
</script>

</body>
</html>