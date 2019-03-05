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
        url: "lesson?id="+courseid,
        success: function(data){
            var lesson = JSON.parse(data);
            var table = document.getElementById("mytable");
            for (var i =0; i< lesson.length; i++){
            var obj = lesson[i];
                var row = table.insertRow(1);
                row.setAttribute("class","rowdata");
                var cellcheckbox = row.insertCell(0);
                var cellname = row.insertCell(1);
                var cellprogress = row.insertCell(2);
                var cellstart = row.insertCell(3);
                var cellid = row.insertCell(4);
            
                cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
                cellname.innerHTML = obj.lesson_name;
                cellprogress.innerHTML = document.getElementById("progress").innerHTML;
                cellstart.innerHTML = document.getElementById("start").innerHTML;
                cellid.innerHTML = obj.id;
                cellid.setAttribute("class","lessonid");
                cellid.setAttribute("style","display: none;");
            }
        },
        error:function(error){
            console.log(error);
        }});
        
        $(".pagination").customPaginate({
            itemsToPaginate : ".rowdata"
        });
    }
});
</script>
</head>
<body>
<h3 class="ui header" style="text-align: left;">Lesson</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Lesson Name</th>
      <th>Progress</th>
      <th>Start Lesson</th>
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
            <div class="ui blue progress">
                <div class="bar">
                <div class="progress"></div>
                </div>
            </div>
        </script>
        <script id="start" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button viewlesson" value="start">Start Lesson</button>
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