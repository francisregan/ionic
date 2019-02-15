<html>
    <head>
        <title>Manage Lesson Plan</title>
        <script type="text/javascript">
        $(function () {
            if (window.location.href.indexOf("id") > -1) {
                var params = window.location.search.split('?')[1].split('&');
                var batchId = decodeURIComponent(params[0].split('=')[1]);
                $.ajax({
                    type: 'GET',
                    url: "batch?id="+batchId,
                    success: function(data){
                    var schools = JSON.parse(data);
                        var obj = schools[0];
                        console.log(schools);
                        document.getElementById("batch").innerHTML = obj.name;
                        document.getElementById("school").innerHTML= obj.school_name;
                        
                        linebreak = document.createElement("br");
                        for(var i=0; i<obj.trainername.length; i++){
                          document.getElementById("trainer").innerHTML += obj.trainername[i];
                          document.getElementById("trainer").appendChild(linebreak)
                        }

                        document.getElementById("course").innerHTML= obj.coursename;

                        var table = document.getElementById("mytable");
                        for (var i =0; i< obj.lessonname.length; i++){
                            var row = table.insertRow(1);
                            var celllessonname = row.insertCell(0);
                            var cellunabledisable = row.insertCell(1);
                            var cellprogress= row.insertCell(2);
                            var cellupdate = row.insertCell(3);

                            celllessonname.innerHTML = obj.lessonname[i];
                            cellunabledisable.innerHTML = document.getElementById("unabledisable").innerHTML;
                            cellprogress.innerHTML = document.getElementById("progress").innerHTML;
                            cellupdate.innerHTML = document.getElementById("update").innerHTML;
                            
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
	<form class="ui form">
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
          <th>Progress</th>
          <th>Update Details</th>
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
          <div class="ui blue progress">
            <div class="bar">
              <div class="progress"></div>
            </div>
          </div>
        </script>
      </tbody>
    </table>
    </form>
    </body>
</html>