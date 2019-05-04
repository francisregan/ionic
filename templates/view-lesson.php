<html>
<head>
<title> View Lesson </title>
<link href="css/style.css" rel="stylesheet">
<script>
$(document).ready(function(){
    if (window.location.href.indexOf("id") > -1) {
        var params = window.location.search.split('?')[1].split('&');
        var courseid = decodeURIComponent(params[0].split('=')[1]);
        $.ajax({ 
        type: 'GET',
        async: false,
        url: "lesson?lid="+courseid,
        success: function(data){
            var lesson = JSON.parse(data);
            var table = document.getElementById("mytable");
            for (var i =0; i< lesson.length; i++){
            var obj = lesson[i];
            console.log(obj);
                var row = table.insertRow(-1);
                row.setAttribute("class","rowdata");
                var lessonNo = row.insertCell(0);
                var cellname = row.insertCell(1);
                var cellstart = row.insertCell(2);
                var cellprogress = row.insertCell(3);
                var cellid = row.insertCell(4);
            
                lessonNo.innerHTML = (i+1);
                cellname.innerHTML = obj.lesson_name;
                cellprogress.innerHTML = document.getElementById("progress").innerHTML;
                cellstart.innerHTML = document.getElementById("start").innerHTML;
                cellid.innerHTML = obj.id;
                cellid.setAttribute("class","lessonid");
                cellid.setAttribute("style","display: none;");

                document.getElementById("coursetitle").innerHTML = obj.name;
            }
        },
        error:function(error){
            console.log(error);
        }});
        
        $(".viewlesson").click(function() {
          var $row = $(this).closest("tr"); 
          var $id = $row.find(".lessonid").text();
          var url = "viewcontent?id=" + $id;
          window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes");
        });
        $('.ui.accordion')
        .accordion();
    }
});
</script>
</head>
<body>
<h3 class="ui header" style="text-align: left;">Manage Lesson</h3>
<br />
<div class="ui styled fluid accordion">
  <div class="title" id="coursetitle" style="text-align: left;">
  </div>
  <div class="content">
    <div class="transition hidden">
    <table id="mytable" class="ui celled table">
      <thead>
        <tr style= "display: none">
          <th></th>
          <th></th>
          <th></th>
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
        <script id="progress" type="text/template">
          <td class="center aligned">
            <i class="large green checkmark icon"></i>
          </td>
        </script>
        <script id="start" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button viewlesson" value="start">Start Lesson</button>
          </div> 
        </script>
      </tbody>
        <tfoot class="full-width">
        </tfoot>
    </table>
    </div>
  </div>
</div>
<br>
<div class="ui styled fluid accordion">
  <div class="title" style="text-align: left;">
    Submission Exercise/Assignments
  </div>
  <div class="content">
    <p class="transition hidden">Exercise/Assignments.</p>
  </div>
</div>
</body>
</html>