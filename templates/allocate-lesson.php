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
               identifier : 'course',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'Please select the course'
                   }
               ]
           },           
           category: {
               identifier : 'category',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'Please select the category'
                   }
               ]
           },
           lessonname: {
              identifier  : 'lesson',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please select lesson'
                },
              ]
            },
          }
        })
      ;
    });
  </script>
</head>

<body>
<form class="ui form" action="allocatelesson" method="post" >
<br />
<h3  id="allocateheader"  class="ui dividing header" style="text-align: left;">Allocate Lesson</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
      <div class="field" style="display: none;">
            <div class="three fields">
              <div class="three wide field">
                <label>Allocate Id</label>
              </div>
              <div class="four wide field">
                <input type="text" name="aid" id="aid">
              </div>
            </div>
        </div>
      <div class="field">
        <div class="two fields">
            <div class="three wide field">
                <label>Course</label>
            </div>
            <div class="four wide field">
                <select id="course" name="course">
                     <option value=""> Select Course</option>
                </select>
            </div>
        </div>
      </div>

      <div class="field">
        <div class="two fields">
            <div class="three wide field">
                <label>Category</label>
            </div>
            <div class="four wide field">
                <select id="category" name="category">
                <option value=""> Select Category</option>
                </select>
            </div>
        </div>
      </div>

      <div class="field">
        <div class="two fields">
            <div class="three wide field">
                <label>Lesson</label>
            </div>
            <div class="four wide field">
                <select id="lesson" name="lesson[]" class="ui fluid search dropdown" multiple="">
                     <option value=""> Select Lesson</option>
                </select>
            </div>
        </div>
      </div>
        <div class="two fields">
          <div class="three wide field">
            <label>Activate</label>
          </div>
          <div class="field">
            <div class="one wide field" >
              <input type="hidden" name="activate" value="N">
              <input type="checkbox" name="activate" id="myCheck"  value="Y"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
            </div>
          </div>
        </div>
</div>

<?php
$_SESSION['les_res'] = true;
?>
    

     <div class="field">
        <div class="seven wide field">
             <input id="submitBtn" type="submit" class="ui primary button" name="Allocate lesson" value="Allocate lesson" />
        </div>
    </div>
</div>
</div>
</div>
</body>
</form>
<script>
    $('.ui.dropdown')
        .dropdown()
    ;
  $(document).ready(function(){
  $.ajax({
    type: 'GET',
    url: "category",
    success: function(data){
      var category = JSON.parse(data);
      category.forEach(function(obj){
        var element = document.getElementById("category");
        var option = document.createElement("option");
        option.value = obj.id;
        option.id = obj.id;
        option.text = obj.name;
        element.add(option);
});
    },
    error:function(error){
      console.log(error);
    }});

    $.ajax({ 
    type: 'GET',
    url: "course",
    success: function(data){
      var course = JSON.parse(data);
      course.forEach(function(obj){
        var element = document.getElementById("course");
        var option = document.createElement("option");
        option.value = obj.id;
        option.id = obj.id;
        option.text = obj.name;
        element.add(option);
});
    },
    error:function(error){
      console.log(error);
    }});

    $.ajax({
    type: 'GET',
    url: "lesson",
    success: function(data){
      var lessons = JSON.parse(data);  
      for (var i =0; i< lessons.length; i++){
        var obj = lessons[i];
        var element = document.getElementById("lesson");
        var option = document.createElement("option");
        option.value = obj.id;
        option.id = obj.id;
        option.text = obj.lesson_name;
        if(obj.activate == 'Y'){
          element.add(option);
        }
     }
    },
    error:function(error){
      console.log(error);
    }});

    if (window.location.href.indexOf("id") > -1) {
            var params = window.location.search.split('?')[1].split('&');
            var allocateId = decodeURIComponent(params[0].split('=')[1]);
            document.getElementById("aid").value = allocateId;
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("allocateheader").innerText = "Edit Allocate Lesson Details";
            $.ajax({
                type: 'GET',
                url: "allocatelesson?id="+allocateId,
                success: function(data){
                  var allocates = JSON.parse(data);
                    var obj = allocates[0];
                    
                    $('#course').dropdown('set selected',obj.course_name);
                    $('#category').dropdown('set selected',obj.category_name);

                    var val = obj.lesson;
                    for ( var i = 0; i < val.length; i++ ){
                      var lessonID = val[i];
                      $('#lesson').dropdown('set selected',lessonID);
                    }
                    if(obj.activate == "Y"){
                      document.getElementById("myCheck").checked = true;
                    }
                },
                error:function(error){
                  console.log(error);
                }});
        }
  });
 
</script>
</html>