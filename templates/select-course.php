<html>
    <head>
        <title>select course</title>
        <script type="text/javascript">
        $(function () {
            if (window.location.href.indexOf("id") > -1) {
                var params = window.location.search.split('?')[1].split('&');
                var batchId = decodeURIComponent(params[0].split('=')[1]);
                console.log(batchId);
                $.ajax({
                    type: 'GET',
                    url: "batch?id="+batchId,
                    success: function(data){
                    var schools = JSON.parse(data);
                        var obj = schools[0];
                        document.getElementById("batchid").value = batchId;
                        document.getElementById("batch").innerHTML = obj.name;
                        document.getElementById("school").innerHTML= obj.school_name;
                       
                    },
                    error:function(error){
                    console.log(error);
                    }});

            }
        });
       $('.ui.dropdown')
        .dropdown() ;
  $(document).ready(function(){
  $.ajax({ 
    type: 'GET',
    url: "course",
    success: function(data){
      var courses = JSON.parse(data);
      
      for (var i =0; i<courses.length; i++){
        var obj =courses[i];
        var element = document.getElementById("selectcourse");
        var option = document.createElement("option");
        option.value = obj.id;
        option.id = obj.id;
        option.text = obj.name;
        if(obj.activate=='Yes'){
          element.add(option);
        }
      }
    },
    error:function(error){
      console.log(error);
    }});
  }); 

    </script>
    </head>
    <body>
    <form class="ui form" action="selectcourse" method="post" >
    <br />
    <h3 class="ui dividing header" style="text-align: left;">selectcourse</h3>
    <br />
    <table class="ui definition table">
  <tbody>
    <tr style = "display: none;">
      <td class="three wide column"></td>
      <td class="four wide column"><input type="text" name="batchid" id="batchid"></td>
    </tr>
    <tr>
      <td class="three wide column">Batch</td>
      <td class="four wide column" id="batch"></td>
    </tr>
    <tr>
      <td class="three wide column">School</td>
      <td class="three wide column" id="school"></td>
    </tr>
     
    <tr>
      <td class="three wide column">Selectcourse</td>
      <td class="three wide column">
      <select id="selectcourse" name="selectcourse" >
      <option value="0">Select course </option> 
      </td>
    </tr>
  </tbody>
  </table>


<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="update" id="updatecourse"  value="updatecouse" style="margin-left: 500px; margin-top: 10px;" ></input>
</form>
    </body>
    </html>
