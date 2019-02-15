<html>
<script type="text/javascript" src="script/pagination.js"></script>
<head>
<title> Manage Batch </title>
<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  async: false,
  url: "batch",
  success: function(data){
    var batch = JSON.parse(data);
    var table = document.getElementById("mytable");
    for (var i =0; i< batch.length; i++){
      var obj = batch[i];
        var row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellname = row.insertCell(1); 
        var cellschool = row.insertCell(2);
        var cellstudent = row.insertCell(3);
        var cellstartdate = row.insertCell(4);
        var cellenddate = row.insertCell(5);
        var celledit = row.insertCell(6);
        var cellcoursename = row.insertCell(7);
        var selectcourse = row.insertCell(8);
        var manageLessonPlan = row.insertCell(9);
        var cellbatchid = row.insertCell(10);
        cellbatchid.setAttribute("style","display: none;");
    
        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellname.innerHTML = obj.name;
        cellschool.innerHTML = obj.school_name;
        cellstudent.innerHTML = obj.student;
        cellstartdate.innerHTML = obj.sdate;
        cellenddate.innerHTML = obj.edate;
      
        celledit.innerHTML = document.getElementById("edit").innerHTML;
        cellcoursename.innerHTML = obj.course_id;
        selectcourse.innerHTML = document.getElementById("selectcourse").innerHTML;
        manageLessonPlan.innerHTML = document.getElementById("managelessonplan").innerHTML;
        cellbatchid.innerHTML = obj.id;
        cellbatchid.setAttribute("class","batchid");
    }
  },
  error:function(error){
    console.log(error);
  }});  
  $(".pagination").customPaginate({
    itemsToPaginate : ".rowdata"
  });

  $(".selectcourse").click(function() {
      var $row = $(this).closest("tr");    // Find the row
      var $id = $row.find(".batchid").text();  // Find the text
    var url = "selectcourse?id=" + $id;
    window.location.href = url;
  });

});
</script>
</head>
<body>
<h3 class="ui header" style="text-align: left;">Manage Batch</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Name</th>
      <th>School</th>
      <th>Student</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Edit Details</th>
      <th>Course</th>
      <th>Select Course</th>
      <th>Manage Lesson Plan</th>

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
    <div class="ui form">
    
     <button class="ui primary basic button" value="edit">Edits</button>
    
    </div>

  </script>

  <script id="selectcourse" type="text/template">
    <div class="ui form">
     <button class="ui primary basic button selectcourse" value="selectcourse">Select Course</button>
    </div>
  </script>

  <script id="managelessonplan" type="text/template">
    <div class="ui form">
     <button class="ui primary basic button" value="managelessonplan">Manage Lesson Plan</button>
    </div>
  </script>

  </tbody>
  <tfoot class="full-width">
    <tr>
      <th></th>
      <th colspan="10">
      <div class="ui right floated pagination menu">
        
      </div>
       
      </th>
    </tr> 
  </tfoot>
</table>
</body>
</html>