<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<html>
<head>
<title> Add New Lesson </title>
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
                       prompt : 'please select the course'
                   }
               ]
           },
           lessonname: {
              identifier  : 'lessonname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter lesson name'
                },
              ]
            },
           category: {
               identifier : 'category',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'please select the category'
                   }
               ]
           },
         pages: {
               identifier : 'noofpages',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'please select No of pages'
                   }
               ]
           },
          }
        })
      ;
    });
  </script>
</head>

<body>
<form class="ui form" action="lesson" method="post" >
<br />
<h3 class="ui dividing header" style="text-align: left;">Add Lesson</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
<div class="field" style = "display: none;">
        <div class="two fields">
            <div class="three wide field">
                <label>Name of the Lesson</label>
            </div>
            <div class="four wide field">
                <input type="text" name="name" id="arr">
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
                <label>Name of the Lesson</label>
            </div>
            <div class="four wide field">
                <input type="text" name="lessonname" placeholder="Enter the lesson name" id="lessonname">
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
                    <label>Number of Pages</label>
                </div>
                <div class="four wide field">
                    <select name="noofpages" id="mySelect" onchange="myFunction()">
                        <option value="">Select Number of Pages</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
     </div>
     <div class="field">
        <div class="ten wide" id="snote" name="page[]"></div>
     </div>

     <?php
$_SESSION['les_res'] = true;
?>
     <div class="field">
        <div class="seven wide field">
             <input id="submitBtn" type="submit" class="ui primary button" name="Add a new Lesson" value="Add lesson" />
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

    $(".primary").click(function() {
        var totalPage = $('#mySelect').val();
        var arr = [];
        for(var i=0;i<totalPage;i++){
        var markupStr = $('.summernote').eq(i).summernote('code');
        arr.push(markupStr);
    }
    document.getElementById("arr").value = JSON.stringify(arr);
  });
  });

function myFunction() {
  var selectValue = document.getElementById("mySelect").value;
  var node = document.getElementById("snote");
  document.getElementById("snote").innerHTML = "";
    for (var i = 0; i < selectValue; i++) {

        var lineBreak = document.createElement("br");

        var labelHeader = document.createElement("label");
        labelHeader.innerHTML = "Page No " + (i+1);

        var createSummerNote = document.createElement("div");
        createSummerNote.setAttribute("class","summernote");
        createSummerNote.setAttribute("name","Page"+(i+1));
        createSummerNote.setAttribute("id","Page"+(i+1));

        node.appendChild(labelHeader);
        node.appendChild(createSummerNote);
        node.appendChild(lineBreak);
        $('.summernote').summernote({
        placeholder: 'Write your page content',
        height: 300
        });
    }
}
</script>
</html>
