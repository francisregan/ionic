<html>
<head>
<title> Manage Batch </title>
<link href="css/style.css" rel="stylesheet">
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
        row.setAttribute("class","rowdata")
        var cellcheckbox = row.insertCell(0);
        var cellname = row.insertCell(1);
        var cellschool = row.insertCell(2);
        var cellstartdate = row.insertCell(3);
        var cellenddate = row.insertCell(4);
        var celledit = row.insertCell(5);
		    var cellid = row.insertCell(6);
        cellid.setAttribute("style","display: none;");
     
        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
       if(obj.activate == "Yes"){
           document.getElementById("myCheck").checked = true;
         }else{
          document.getElementById("myCheck").checked = false;
       }
        document.getElementById("myCheck").disabled = true
        cellname.innerHTML = obj.name;
        cellschool.innerHTML = obj.school_name;
        cellstartdate.innerHTML = obj.sdate;
        cellenddate.innerHTML = obj.edate;
        celledit.innerHTML = document.getElementById("edit").innerHTML
        cellid.innerHTML = obj.id;
        cellid.setAttribute("class","bid");

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
      var $id = $row.find(".bid").text();  // Find the text
      console.log($id);
    var url = "editbatch?id=" + $id;
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
      <th>Batch Name</th>
      <th>School</th>
      <th>Start Date</th>
      <th>End Date</th>
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
         <button class="ui primary basic button" value="edits">Edits</button>
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