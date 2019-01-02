<html>
<head>
<title> Manage schools </title>

<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  url: "school",
  success: function(data){
    var schools = JSON.parse(data);
    
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
      console.log(obj);
      var table = document.getElementById("mytable");
        var row = table.insertRow(1);
        var cellcheckbox = row.insertCell(0);
        var cellschool = row.insertCell(1);
        var cellcontact = row.insertCell(2);
        var cellcontactno = row.insertCell(3);
        var cellmail = row.insertCell(4);
        var celladdress = row.insertCell(5);
        var celledit = row.insertCell(6);
        var cellremarks = row.insertCell(7);

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellschool.innerHTML = obj.school_name;
        cellcontact.innerHTML = obj.contact_person;
        cellcontactno.innerHTML = obj.contact_no;
        cellmail.innerHTML = obj.mail_id;
        celladdress.innerHTML = obj.address;
        celledit.innerHTML = document.getElementById("edit").innerHTML
        cellremarks.innerHTML = document.getElementById("tarea").innerHTML;
    }
  },
  error:function(error){
    console.log(error);
  }});
});
</script>
</head>
<body>

<h3 class="ui header" style="text-align: left;">Manage School</h3>

<br />
<table id="mytable" class="ui compact celled definition table">
  <thead>
    <tr>
      <th></th>
      <th>School Name</th>
      <th>Contact Person</th>
      <th>Contact No</th>
      <th>Mail Id</th>
      <th>Address</th>
      <th>Edit Details</th>
	  <th>Remark</th>
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
        <a class="icon item">
          <i class="left chevron icon"></i>
        </a>
        <a class="item">1</a>
        <a class="item">2</a>
        <a class="item">3</a>
        <a class="item">4</a>
        <a class="icon item">
          <i class="right chevron icon"></i>
        </a>
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

</body>
</html>