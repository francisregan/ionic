<html>
<head>
<title> Manage Course </title>
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
        var celltype = row.insertCell(2);
        var cellduration = row.insertCell(3);
        var cellprinting = row.insertCell(4);
        var cellsession = row.insertCell(5);
        var celledit = row.insertCell(6);
        var cellid = row.insertCell(7);
        cellid.setAttribute("style","display: none;");

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        if(obj.activate == "Y"){
           document.getElementById("myCheck").checked = true;
        }else{
          document.getElementById("myCheck").checked = false;
        }
        document.getElementById("myCheck").disabled = true
        cellname.innerHTML = obj.name;
        celltype.innerHTML = obj.type;
        cellduration.innerHTML = obj.duration;
        cellprinting.innerHTML = obj.printing;
        cellsession.innerHTML = obj.session;
        celledit.innerHTML = document.getElementById("edit").innerHTML;
        cellid.innerHTML = obj.id;
        cellid.setAttribute("class","cid");
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
        var $id = $row.find(".cid").text();
        var url = "editcourse?id=" + $id;
        window.location.href = url;
        });
});
</script>
</head>
<body>
<h3 class="ui header" style="text-align: left;">Manage Course</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Name</th>
      <th>Type</th>
      <th>Duration</th>
      <th>Printing</th>
      <th>Session</th>
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
