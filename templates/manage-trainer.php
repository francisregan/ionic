<html>
<head>
<title> Manage Trainer </title>
<link href="css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
  var table;
  var row;
$.ajax({ 
  type: 'GET',
  async: false,
  url: "trainer",
  success: function(data){
    var schools = JSON.parse(data);
    
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
      table = document.getElementById("mytable");
      row = table.insertRow(1);
      row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var celltrainer = row.insertCell(1);
        var cellcontactno = row.insertCell(2);
        var cellmail = row.insertCell(3);
        var cellspecialization = row.insertCell(4);
        var cellschool = row.insertCell(5);
        var celledit = row.insertCell(6);
        var cellid = row.insertCell(7);
        cellid.setAttribute("style","display: none;");

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        if(obj.activate == "Yes"){
           document.getElementById("myCheck").checked = true;
        }else{
          document.getElementById("myCheck").checked = false;
        }
        document.getElementById("myCheck").disabled = true
        celltrainer.innerHTML = obj.trainer_name;
        cellcontactno.innerHTML = obj.contact_no;
        cellmail.innerHTML = obj.mail_id;
        cellspecialization.innerHTML = obj.specialization;
        cellschool.innerHTML = obj.school;
        celledit.innerHTML = document.getElementById("edit").innerHTML;
        cellid.innerHTML = obj.trainer_id;
        cellid.setAttribute("class","tid");
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
      var $id = $row.find(".tid").text();  // Find the text
      console.log($id);
      var url = "edittrainer?id=" + $id;
      window.location.href = url;
      });
});

</script>


</head>

<body>
<h3 class="ui header" style="text-align: left;">Manage Trainer</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Trainer Name</th>
      <th>Contact No</th>
      <th>Mail Id</th>
      <th>Specialization</th>
      <th>School</th>
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