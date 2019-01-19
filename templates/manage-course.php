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
      console.log(obj);
        var row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellname = row.insertCell(1);
        var celltype = row.insertCell(2);
        var cellcategory = row.insertCell(3);
        var cellduration = row.insertCell(4);
        var cellprinting = row.insertCell(5);
        var cellsession = row.insertCell(6);
    

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellname.innerHTML = obj.name;
        celltype.innerHTML = obj.type;
        cellcategory.innerHTML = obj.category;
        cellduration.innerHTML = obj.duration;
        cellprinting.innerHTML = obj.printing;
        cellsession.innerHTML = obj.session;
        
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
<h3 class="ui header" style="text-align: left;">Manage Course</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Name</th>
      <th>Type</th>
      <th>Category</th>
      <th>Duration</th>
      <th>Printing</th>
      <th>Session</th>
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