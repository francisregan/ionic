<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<html>
<head>
<title> Allocate Lesson </title>
<link href="css/summernote.css" rel="stylesheet">
<script type="text/javascript" src="script/summernote.js">
</script>
<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            course: {
               identifier : 'file',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'Please select the file'
                   }
               ]
           },           
          }
        })
      ;
    });
  </script>
</head>
<script>
const rows = [["student_name", "contact_number", "email", "school", "age", "batch", "class", "parent_name", "activate"]];
let csvContent = "data:text/csv;charset=utf-8,";
rows.forEach(function(rowArray){
   let row = rowArray.join(",");
   csvContent += row + "\r\n";
});
var encodedUri = encodeURI(csvContent);
var link = document.createElement("a");
link.innerHTML = "Download Formate";
link.setAttribute("href", encodedUri);
link.setAttribute("download", "my_data.csv");

var node = document.getElementById("downloadLink");
node.appendChild(link);
</script>
<body>
<form class="ui form" action="bulkupload" method="post" enctype="multipart/form-data">
<br />
<h3 class="ui dividing header" style="text-align: left;">Upload Student Bulk Data</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
      <div class="field">
            <div class="three fields">
              <div class="three wide field">
                <label>Select File to upload</label>
              </div>
              <div class="seven wide field">
                <input type="file" name="file" id="file">
              </div>
            </div>
      </div>
      <div class="field">
            <div class="three fields">
              <div class="three wide field">
                <label>Download File formate</label>
              </div>
              <div class="seven wide field" id = "downloadLink">
              </div>
            </div>
      </div>
</div>

<?php
$_SESSION['les_res'] = true;
?>
     <div class="field">
        <div class="seven wide field">
            <input id="submitBtn" type="submit" class="ui primary button" value="Upload file" name="submit" />
        </div>
    </div>
</div>
</div>
</div>
</body>
</form>
<script>