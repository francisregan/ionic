<html>
<head>
<title> Manage Allocate Lesson </title>
<link href="css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
  var table;
  var row;
$.ajax({ 
  type: 'GET',
  async: false,
  url: "allocatelesson",
  success: function(data){
    var allocates = JSON.parse(data);
    
    for (var i =0; i< allocates.length; i++){
      var obj = allocates[i];
      console.log(obj);
      table = document.getElementById("mytable");
      row = table.insertRow(1);
      row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellcourse = row.insertCell(1);
        var cellcategory = row.insertCell(2);
        var celllesson = row.insertCell(3);
        var celledit = row.insertCell(4);
        var cellid = row.insertCell(5);
        cellid.setAttribute("style","display: none;");

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        if(obj.activate == "Yes"){
           document.getElementById("myCheck").checked = true;
        }else{
          document.getElementById("myCheck").checked = false;
        }
        document.getElementById("myCheck").disabled = true
        cellcourse.innerHTML = obj.course_name;
        cellcategory.innerHTML = obj.category_name;
        celllesson.innerHTML = obj.lesson;
        celledit.innerHTML = document.getElementById("edit").innerHTML;
        cellid.innerHTML = obj.id;
        cellid.setAttribute("class","aid");
    }
  },
  error:function(error){
    console.log(error);
  }});

      $(".pagination").customPaginate({
      itemsToPaginate : ".rowdata"
      });

      $(".primary").click(function() {
      var $row = $(this).closest("tr");
      var $id = $row.find(".aid").text();
      var url = "editallocate?id=" + $id;
      window.location.href = url;
      });

});
</script>

</head>

<body>
<h3 class="ui header" style="text-align: left;">Manage Allocate Lesson</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Course Name</th>
      <th>Category Name</th>
      <th>Lesson Name</th>
      <th>Edit Details</th>
    </tr>
  </thead>
  <tbody>
  <script id="check" type="text/template">
      <div class="collapsing">
        <div class="ui fitted slider checkbox">
          <input type="checkbox" id="myCheck"><label></label>
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
      </th>
    </tr>
  </tfoot>
</table>
<script type="text/javascript" src="script/pagination.js">
</script>
</body>
</html>