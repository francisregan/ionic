<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<html>
<head>
<title> Add category </title>
<script>

  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            name: {
              identifier  : 'name',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter category name'
                },
              ]
            },
          type: {
              identifier  : 'type',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please select type'
                },

              ]
            },


          }
        })
      ;
    });
  </script>

<style>

</style>
</head>
<body>
<form class="ui form" action="addcategory" method="post" >
<br />
<h3 class="ui dividing header" style="text-align: left;">Add Category</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
  <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>Category Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="name" placeholder="Category Name">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Category Type</label>
      </div>
      <div>
        <select name="type">
          <option value="">Select Type</option>
          <option value="Beginner">Beginner</option>
          <option value="Intermediate">Intermediate</option>
          <option value="Advanced">Advanced</option>
        </select>
      </div>
    </div>
  </div>

  <?php
$_SESSION['cat_res'] = true;
?>
<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new student" value="Add a new Category" ></input>
</div>
</div>
</div>
</form>
</body>
</html>