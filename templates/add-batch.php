 
<html>

<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<script>
var $i = jQuery.noConflict();
</script> 

<head>
<title> Add category </title>
 <script>
    $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            bname: {
              identifier  : 'bname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter the batch name'
                },
              ]
            },
            sdate: {
              identifier  : 'sdate',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your start date'
                }
              ]
            },
            edate: {
              identifier  : 'edate',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your end date'
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
<form class="ui form" action="batch" method="post" >
<br />
<h3 class="ui dividing header" id="batchheader" style="text-align: left;">Add Batch</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>

<div class="field">
        <div class="three fields" style="display: none;">
          <div class="three wide field">
            <label>Batch ID</label>
          </div>
          <div class="four wide field">
            <input type="text" name="bid" id="eid">
          </div>
        </div>
    </div>


    <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Batch Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="bname" placeholder="Specify the Batch" id="batch">
      </div>
    </div>
  </div>

    <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School</label>
      </div>
      <div class="four wide field">
      <select id="schoolname" name="schoolname" >
      <option value="0">Select school </option> 
      </select>
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="subject-info-box-1">
       Unallocated Students
        <select multiple="multiple" id='studentname' name="studentname[]" class="form-control">
        </select>
        </div>
  
      <div class="subject-info-arrows text-center">
        <input type="button" id="btnRight" value=">"style="margin-right:10px; margin-left:10px; margin-top: 40px; class="btn btn-default" /><br />
        <input type="button" id="btnLeft" value="<" style="margin-right:10px; margin-left:10px; margin-top: 30px; class="btn btn-default" /><br />
      </div>

      <div class="subject-info-box-2">
        Allocated Students 
        <select multiple="multiple" id='assignedStudents' name="assignedStudents[]" class="form-control">
        </select>

    </div>
  </div>
    <div class="field">
     <div class="six fields">
      <div class="three wide field">
      	<label>Start Date</label>
      </div>
      <div class="four wide field">
<input type="text" id="sdate" name="sdate" /> 
      </div>
    </div>
  </div>
    <div class="field">
     <div class="six fields">
      <div class="three wide field">
      	<label>End Date</label>
      </div>
      <div class="four wide field">
        <div class="ui calendar">
          <div class="ui input left icon">
            <i class="calendar icon"></i>
            <input type="Date" name="edate" placeholder="Date" id="edate">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="two fields">
      <div class="three wide field">
      <label>Activate</label>
    </div>
    <div class="field">
    
     <div class="one wide field" >
     <input type="hidden" name="activate" value="no">
     <input type="checkbox" name="activate" id="myCheck" value="Yes"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
    </div>
    </div>
   </div>
</div>
<form class="ui form" action="batch" method="post" >
  <div class="seven wide field">
    <input id="submitBtn" type="submit" class="ui primary basic button" name="Create a new Batch" value="Save "></i></input>
  </div>
</div>
</div>
</form>
</body>
<script>
  $('.ui.dropdown')
    .dropdown()
  ;
           
  (function () {
        $('#btnRight').click(function (e) {
            var selectedOpts = $('#studentname option:selected');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                e.preventDefault();
            }
            $('#assignedStudents').append($(selectedOpts).clone());
            $('#assignedStudents option').prop('selected','selected');
            $(selectedOpts).remove();
            e.preventDefault();
        });
      
        $('#btnLeft').click(function (e) {
            var selectedOpts = $('#assignedStudents option:selected');
            if (selectedOpts.length == 0) {
                alert("Nothing to move.");
                e.preventDefault();
            }
            $('#studentname').append($(selectedOpts).clone());
            
            $('#assignedStudents option').prop('selected','selected');
            $(selectedOpts).remove();
            e.preventDefault();
        });

        $('#schoolname').on('change', function() {
          getUnallocatedStudents();
        });
        function getUnallocatedStudents()
        {
          var e = document.getElementById("schoolname");
          var school_id = e.options[e.selectedIndex].value;
          
          $.ajax({ 
            type: 'GET',
            url: "unAllocatedStudents?id="+school_id,
            success: function(data){
              $('#studentname').empty();
              var studentname = JSON.parse(data);
              for (var i =0; i< studentname.length; i++){
                  var obj = studentname[i];
                  var element = document.getElementById("studentname");
                  var option = document.createElement("option");
                  option.value = obj.student_id;
                  option.id = obj.student_id;
                  option.text = obj.student_name;
                  element.add(option);
                }
            },
            error:function(error){
              console.log(error);
            }});
        }
        function getAllocatedStudents()
        {
          var e = document.getElementById("schoolname");
          var school_id = e.options[e.selectedIndex].value;
          
          $.ajax({ 
            type: 'GET',
            url: "allocatedStudents?id="+school_id,
            success: function(data){
              $('#assignedStudents').empty();
              var studentname = JSON.parse(data);
              for (var i =0; i< studentname.length; i++){
                  var obj = studentname[i];
                  var element = document.getElementById("assignedStudents");
                  var option = document.createElement("option");
                  option.value = obj.student_id;
                  option.id = obj.student_id;
                  option.text = obj.student_name;
                  element.add(option);
                }
            },
            error:function(error){
              console.log(error);
            }});
        }

  var schoolArray = [];
  $.ajax({ 
      type: 'GET',
      url: "school",
      async: false,
      success: function(data){
        var schools = JSON.parse(data);
        for (var i = 0; i < schools.length; i++){
          var obj = schools[i];
          console.log(obj.sno);
          schoolArray.push(obj.sno);
          var element = document.getElementById("schoolname");
          var option = document.createElement("option");
          var seletedIndex;
          option.value = obj.sno;
          option.id = obj.sno;
          option.text = obj.school_name;
          if(obj.activate=='Yes'){
              element.add(option);
          }
        }
      },
      error:function(error){
        console.log(error);
      }
    });
        if(window.location.href.indexOf("id") > -1) {
          console.log("ID exists");
          var params = window.location.search.split('?')[1].split('&');
            var id = decodeURIComponent(params[0].split('=')[1]);
            console.log(id);
            document.getElementById("eid").value = id;
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("batchheader").innerText = "Edit Batch Details";

        $.ajax({ 
            type: 'GET',
            url: "fetchBatch?id="+id,    

            success: function(data){
              console.log(data);
              var sbatch = JSON.parse(data);
              var obj = sbatch[0];
              console.log(obj);
              document.getElementById("batch").value = obj.name;
              document.getElementById("date").value = obj.sdate;
              document.getElementById("edate").value = obj.edate;
              if(obj.activate == "Yes"){
                console.log(obj.activate);
                document.getElementById("myCheck").checked = true;
              }
              var school;
              for (var i = 0; i < schoolArray.length; i++) {
                if(schoolArray[i] == obj.school){
                  $('#schoolname').val(schoolArray[i])
                  break;
                }
              }

              getUnallocatedStudents();
              getAllocatedStudents();
            },
          error:function(error){
          console.log(error);
      }
      });
    }
   
  }
(jQuery));

</script>
</html>