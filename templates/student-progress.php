<html>
    <head>
        <title>Manage Lesson Plan</title>
        <script>
        $(document).ready(function(){
            if (window.location.href.indexOf("id") > -1) {
                var params = window.location.search.split('?')[1].split('&');
                var lessonId = decodeURIComponent(params[0].split('=')[1]);
                var courseId = decodeURIComponent(params[1].split('=')[1]);
                var batchId = decodeURIComponent(params[2].split('=')[1]);
                var schoolId = decodeURIComponent(params[3].split('=')[1]);
                $.ajax({
                    type: 'GET',
                    url: "batch?lid="+lessonId+"&cid="+courseId+"&bid="+batchId+"&sid="+schoolId,
                    success: function(data){
                    var schools = JSON.parse(data);
                        var obj = schools[0];
                        var table = document.getElementById("mytable");
                        for (var i =0; i< obj.student.length; i++){
                            var row = table.insertRow(1);
                            var cellname = row.insertCell(0);
                            var cellprogress = row.insertCell(1);
                            var cellreport = row.insertCell(2);

                            cellname.innerHTML = obj.student[i];
                            cellprogress.innerHTML = document.getElementById("progress").innerHTML;
                            cellreport.innerHTML = document.getElementById("viewreport").innerHTML;
                            
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
        <h3 class="ui dividing header" style="text-align: left;">Student Progress</h3>
    <br />
    <table id="mytable" class="ui padded table">
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Progress</th>
          <th>View Report</th>
        </tr>
      </thead>
      <tbody>
        <script id="progress" type="text/template">
            <div class="ui blue progress">
            <div class="bar">
              <div class="progress"></div>
            </div>
          </div>
        </script>
        <script id="viewreport" type="text/template">
          <div class="ui form">
            <button class="ui primary basic button" value="viewreport">View Report &nbsp; &nbsp; <i class="download icon"></i></button>
          </div> 
        </script>
    </table>
    </body>
</html>