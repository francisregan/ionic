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
            var lessons = JSON.parse(data);
            var node = document.getElementById("wrap");
            for (var i =0; i< lessons.length; i++){
            var obj = lessons[i];
            var createAccordion = document.createElement("div");
            createAccordion.setAttribute("class","ui styled fluid accordion");
            
            var accordionTitle = document.createElement("div");
            accordionTitle.setAttribute("class","title");
            accordionTitle.setAttribute("style","text-align: left;");
            accordionTitle.setAttribute("id","title"+(i+1));

            var accordionContent = document.createElement("div");
            accordionContent.setAttribute("class","content");

            var accordionHidden = document.createElement("div");
            accordionHidden.setAttribute("class","transition hidden");

            var accordionTable = document.createElement("table");
            accordionTable.setAttribute("class","ui celled table");
            accordionTable.setAttribute("id","mytable"+(i+1));

            var lineBreak = document.createElement("br");

            accordionHidden.appendChild(accordionTable);
            accordionContent.appendChild(accordionHidden);
            createAccordion.appendChild(accordionTitle);
            createAccordion.appendChild(accordionContent);
            node.appendChild(createAccordion);
            node.appendChild(lineBreak);

            var table = document.getElementById("mytable"+(i+1));
            for (var j =0; j< obj.lesson.length; j++){
                var row = table.insertRow(-1);
                row.setAttribute("class","rowdata");
                var lessonNo = row.insertCell(0);
                var cellname = row.insertCell(1);
                var cellstart = row.insertCell(2);
                var cellprogress = row.insertCell(3);
                var cellid = row.insertCell(4);
            
                lessonNo.innerHTML = (j+1);
                cellname.innerHTML = obj.lesson[j];
                cellprogress.innerHTML = document.getElementById("progress").innerHTML;
                cellstart.innerHTML = document.getElementById("start").innerHTML;
                cellid.innerHTML = obj.lesson_ids[j];
                cellid.setAttribute("class","lessonid");
                cellid.setAttribute("style","display: none;");
            }
                document.getElementById("title"+(i+1)).innerHTML = obj.categoryname;
                document.getElementById("courseheader").innerHTML = obj.coursename;
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
<h3 class="ui header" style="text-align: left;" id="courseheader"></h3>
<br />
<div id = "wrap"></div>
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
</body>
</html>