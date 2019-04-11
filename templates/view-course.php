<html>
<head>
<title> View Course </title>
<link href="css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  async: false,
  url: "course",
  success: function(data){
    var course = JSON.parse(data);
    var table = document.getElementById("mytable");
    for (var i =0; i< course.length; i++){
      var obj = course[i];
        var row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellname = row.insertCell(1);
        var celllesson = row.insertCell(2);
        var cellprogress = row.insertCell(3);
        var cellviewlesson = row.insertCell(4);
        var cellstart = row.insertCell(5);
        var cellid = row.insertCell(6);
        
    
        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellname.innerHTML = obj.name;
        celllesson.innerHTML = obj.lesson_ids;
        cellprogress.innerHTML = document.getElementById("progress").innerHTML;
        cellviewlesson.innerHTML = document.getElementById("viewlesson").innerHTML;
        cellstart.innerHTML = document.getElementById("startcourse").innerHTML;
        cellid.innerHTML = obj.id;
        cellid.setAttribute("class","courseid");
        cellid.setAttribute("style","display: none;");
    }
  },
  error:function(error){
    console.log(error);
  }});
  
  $(".pagination").customPaginate({
  itemsToPaginate : ".rowdata"
});

$(".viewlesson").click(function() {
      var $row = $(this).closest("tr"); 
      var $id = $row.find(".courseid").text();
      var url = "viewlesson?id=" + $id;
      
      window.location.href = url;
      });
});
</script>
</head>
<body>
<h3 class="ui header" style="text-align: left;">Registered Course</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Course Name</th>
      <th>No of Lesson</th>
      <th>Progress</th>
      <th>View Lesson</th>
      <th>Start Course</th>
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
        <script id="progress" type="text/template">
            <div class="ui blue progress">
                <div class="bar">
                <div class="progress"></div>
                </div>
            </div>
        </script>
        <script id="viewlesson" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button viewlesson" value="viewlesson">View Lesson</button>
          </div> 
        </script>
        <script id="startcourse" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button startcourse" value="startcourse">Start Course</button>
          </div> 
        </script>
  </tbody>
  <tfoot class="full-width">
    <tr>
      <th></th>
      <th colspan="8">
      <div class="ui right floated pagination menu">
        
      </div>
       
      </th>
    </tr> 
  </tfoot>
</table>

<script type="text/javascript" src="script/pagination.js">
</script>
</body>
</html>