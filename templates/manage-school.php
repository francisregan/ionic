<html>
<head>
<title> Manage schools </title>
<link href="css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  async: false,
  url: "school",
  success: function(data){
    var schools = JSON.parse(data);
    var table = document.getElementById("mytable");
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
        var row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellschool = row.insertCell(1);
        var cellcontact = row.insertCell(2);  
        var cellcontactno = row.insertCell(3);
        var cellmail = row.insertCell(4);
        var celladdress = row.insertCell(5);
        var celledit = row.insertCell(6);
        var cellid = row.insertCell(7);
        cellid.setAttribute("style","display: none;");
        
        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        if(obj.activate == "Y"){
           document.getElementById("myCheck").checked = true;
        }else{
          document.getElementById("myCheck").checked = false;
        }
        document.getElementById("myCheck").disabled = true;
        cellschool.innerHTML = obj.school_name;
        cellcontact.innerHTML = obj.contact_person;
        cellcontactno.innerHTML = obj.contact_no;
        cellmail.innerHTML = obj.mail_id;
        celladdress.innerHTML = obj.address;
        celledit.innerHTML = document.getElementById("edit").innerHTML;
        cellid.innerHTML = obj.sno;
        cellid.setAttribute("class","sid");
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
      var $id = $row.find(".sid").text();  // Find the text
      var url = "editschool?id=" + $id;
    window.location.href = url;
  });
});
</script>
</head>
<body>
<h3 class="ui header" style="text-align: left;">Manage School</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>School Name</th>
      <th>Contact Person</th>
      <th>Contact No</th>
      <th>Mail Id</th>
      <th>Address</th>
      <th>Edit Details</th>
      <th></th>
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
		<div class="ui form">
     <button class="ui primary basic button" value="edits">Edits</button>
		</div>
  </script>

  <script id="tarea" type="text/template"> 
		<div class="ui form">
			<div class="field">
			  <textarea rows="1"></textarea>
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