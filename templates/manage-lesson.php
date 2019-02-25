<html>
<head>
<title> Manage Lesson </title>
<script>
$(document).ready(function(){
  var table;
  var row;
$.ajax({ 
  type: 'GET',
  async: false,
  url: "lesson",
  success: function(data){
        var lesson = JSON.parse(data);
        for (var i =0; i< lesson.length; i++){
        var obj = lesson[i];
        table = document.getElementById("mytable");
        row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellid = row.insertCell(0);
        var celllessonname = row.insertCell(1);
        var cellcategory = row.insertCell(2);
        var cellTotalNoPages = row.insertCell(3);
        var celledit = row.insertCell(4);
        cellid.setAttribute("class","lid");
        cellid.setAttribute("style","display: none;");
        celllessonname.innerHTML = obj.lesson_name;
        cellcategory.innerHTML = obj.name;
        cellTotalNoPages.innerHTML = obj.total_pages;
        celledit.innerHTML = document.getElementById("edit").innerHTML;
    }
  },
  error:function(error){
    console.log(error);
  }});
  
  $(".pagination").customPaginate({
      itemsToPaginate : ".rowdata"
      });

      $(".primary").click(function() {
      var $row = $(this).closest("tr");    // Find the row
      var $id = $row.find(".lid").text();  // Find the text
      console.log($id);
      var url = "editlesson?id=" + $id;
      window.location.href = url;
      });
});

</script>

</head>

<body>
<h3 class="ui header" style="text-align: left;">Manage Lesson</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th>Lesson Name</th>
      <th>Category</th>
      <th>Total No Pages</th>
      <th>Edit Content</th>
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