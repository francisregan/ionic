<html>
<head>
<title> Manage Categories </title>

<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  url: "category",
  success: function(data){
    var category = JSON.parse(data);
    for (var i =0; i< category.length; i++){
      var obj = category[i];
      var table = document.getElementById("mytable");
        var row = table.insertRow(1);
        var cellname = row.insertCell(0);
        var celltype = row.insertCell(1);
        cellname.innerHTML = obj.name;
        celltype.innerHTML = obj.type;
    }
  },
  error:function(error){
    console.log(error);
  }});
});
</script>
</head>

<body>
<h3 class="ui header" style="text-align: left;">Manage Categories</h3>
<br />
<div style="text-align: center;">
<input id="submitBtn" type="submit" class="ui fluid teal submit button" style="width:20%;" onclick="location.href='addcategory'" value="Add a new Category"></input>
</div>
<br />
<div >
  <table id="mytable" class="ui celled table" style="width:50%;text-align:center;">
    <thead>
      <tr>
        <th>Category Name</th>
        <th>Category Type</th>
      </tr>
    </thead>
    <tbody>
  </table>
<div >
</body>
</html>