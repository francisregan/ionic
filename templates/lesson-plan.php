<html>
    <head>
        <title>Lesson Plan</title>
        <script>
        $(document).ready(function(){
            if (window.location.href.indexOf("id") > -1) {
                var params = window.location.search.split('?')[1].split('&');
                var batchId = decodeURIComponent(params[0].split('=')[1]);
                $.ajax({
                    type: 'GET',
                    url: "batch?id="+batchId,
                    success: function(data){
                    var schools = JSON.parse(data);
                        var obj = schools[0];
                        document.getElementById("batch").innerHTML = obj.name;
                        document.getElementById("school").innerHTML= obj.school_name;
                        
                        linebreak = document.createElement("br");
                        for(var i=0; i<obj.trainername.length; i++){
                          document.getElementById("trainer").innerHTML += obj.trainername[i];
                          document.getElementById("trainer").appendChild(linebreak);
                        }

                        if(obj.coursename != null){
                          document.getElementById("course").innerHTML= obj.coursename;
                        }else{
                          document.getElementById("course").innerHTML= "The Course is not allocated for this Batch";
                        }

                        var table = document.getElementById("mytable");
                        for (var i =0; i< obj.lessonname.length; i++){
                            var row = table.insertRow(1);
                            var celllessonname = row.insertCell(0);
                            var cellunabledisable = row.insertCell(1);
                            var cellupdate = row.insertCell(2);
                            var cellprogress= row.insertCell(3);
                            var cellid= row.insertCell(4);
                            cellid.setAttribute("style","display: none;");

                            celllessonname.innerHTML = obj.lessonname[i];
                            cellunabledisable.innerHTML = document.getElementById("unabledisable").innerHTML;
                            cellupdate.innerHTML = document.getElementById("update").innerHTML;
                            cellprogress.innerHTML = document.getElementById("progress").innerHTML;
                            cellid.innerHTML = obj.lessonid[i];
                            cellid.setAttribute("class","lessonid");
                            $(".progresses").click(function() {
                              var $row = $(this).closest("tr");    
                              var $id = $row.find(".lessonid").text();  
                              var url = "progresses?id=" + $id+"&cid="+obj.course_id+"&bid="+batchId+"&sid="+obj.sno;
                              window.location.href = url;
                            });
                            
                        }
                    },
                    error:function(error){
                    console.log(error);
                    }});
            }
        });
    </script>
    </head>
    <body>

    <br />
        <h3 class="ui dividing header" style="text-align: left;">Manage Lesson Plan</h3>
    <br />
    <table class="ui definition table">
      <tbody>
        <tr>
          <td class="three wide column">Batch</td>
          <td class="four wide column" id="batch"></td>
        </tr>
        <tr>
          <td class="three wide column">School</td>
          <td class="three wide column" id="school"></td>
        </tr>
        <tr>
          <td class="three wide column">Trainer</td>
          <td class="three wide column" id="trainer"></td>
        </tr>
        <tr>
          <td class="three wide column">Course</td>
          <td class="three wide column" id="course"></td>
        </tr>
      </tbody>
    </table>
    
    <table id="mytable" class="ui celled table">
      <thead>
        <tr>
          <th>Lesson Name</th>
          <th>Enable/Disable</th>
          <th>Update Details</th>
          <th>Student Progress</th>
        </tr>
      </thead>
      <tbody>
        <script id="unabledisable" type="text/template">
          <div class="ui toggle checkbox">
            <input type="checkbox" name="public">
            <label></label>
          </div>
        </script>
        <script id="update" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button" value="updates">Update</button>
          </div>
        </script>
        <script id="progress" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button progresses" value="progresses">Progress</button>
          </div>
        </script>
      </tbody>
    </table>

    </body>
</html>