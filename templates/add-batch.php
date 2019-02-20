<html>
<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<script type="text/javascript" src="script/moment.js"></script>
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
<h3 class="ui dividing header" style="text-align: left;" id="batchheader">Add Batch</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>

        <div class="field">
            <div class="three fields" style="display: none;">
              <div class="three wide field">
                <label>School ID</label>
              </div>
              <div class="four wide field">
                <input type="text" name="bid" id="eid">
              </div>
            </div>
        </div>
        <div class="field">
          <div class="six fields">
            <div class="three wide field">
              <label>Batch Name</label>
            </div>
            <div class="four wide field">
              <input type="text" name="bname" placeholder="Enter the batch name" id="bname">
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
                <option value="">Select school </option> 
              </select>
            </div>
          </div>
        </div>

        <div class="field">
          <div class="three fields">
            <div class="subject-info-box-1">
              Unallocated Students
              <select multiple="multiple" id='studentname' name="studentname[]" class="form-control">
              </select>
            </div>
        
            <div class="subject-info-arrows text-center">
              <input type="button" id="btnRight" value=">"style="margin-right:10px; margin-left:10px; margin-top: 40px;" class="btn btn-default" /><br />
              <input type="button" id="btnLeft" value="<" style="margin-right:10px; margin-left:10px; margin-top: 30px; class="btn btn-default" /><br />
            </div>

            <div class="subject-info-box-2">
              Allocated Students 
              <select multiple="multiple" id='assignedStudents' name="assignedStudents[]" class="form-control">
              </select>
            </div>
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
              <input type="text" id="edate" name="edate" />
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
              <input type="checkbox" name="activate" id="myCheck"  value="Yes"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
            </div>
          </div>
        </div>

        <form class="ui form" action="batch" method="post" >
          <div class="seven wide field">
            <input id="submitBtn" type="submit" class="ui primary basic button" name="Create a new Batch" value="Save" onfocus="myFunction()"></i></input>
          </div>
</div>
</div>
</form>
</body>
<script>
var dateToday = new Date();
var dates = $i("#sdate, #edate").datepicker({
  changeMonth: true,
  minDate: dateToday,
  onSelect: function(selectedDate) {
      var option = this.id == "sdate" ? "minDate" : "maxDate",
          instance = $i(this).data("datepicker"),
          date = $i.datepicker.parseDate(instance.settings.dateFormat || $i.datepicker._defaults.dateFormat, selectedDate, instance.settings);
      dates.not(this).datepicker("option", option, date);
  }
});
</script>
<script>
$('.ui.dropdown')
    .dropdown();
$(document).ready(function(){
$.ajax({ 
type: 'GET',
url: "school",
success: function(data){
  var schools = JSON.parse(data);
  for (var i =0; i< schools.length; i++){
    var obj = schools[i];
    var element = document.getElementById("schoolname");
    var option = document.createElement("option");
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
}});
});

  (function () {
    $('#btnRight').click(function (e) {
        var selectedOpts = $('#studentname option:selected');
        if (selectedOpts.length == 0) {
            alert("Nothing to move.");
            e.preventDefault();
        }
        $('#assignedStudents').append($(selectedOpts).clone());
        console.log($('#assignedStudents option').prop('selected','selected'));
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
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#schoolname').on('change', function() {
      unallocatedStudents();
    });
}


(jQuery));
function unallocatedStudents(){
  var e = document.getElementById("schoolname");
      var school_id = e.options[e.selectedIndex].value;
      
      $.ajax({ 
        type: 'GET',
        url: "batchedstudents?id="+school_id,
        success: function(data){
          $('#studentname').empty();
          var studentname = JSON.parse(data);
          for (var i =0; i< studentname.unAllocatedStudent_name.length; i++){
              var obj = studentname.unAllocatedStudent_name[i];
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
$(function () {
        if (window.location.href.indexOf("id") > -1) {
            var params = window.location.search.split('?')[1].split('&');
            var batchId = decodeURIComponent(params[0].split('=')[1]);
            document.getElementById("eid").value = batchId;
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("batchheader").innerText = "Edit Batch Details";
          
            $.ajax({
                type: 'GET',
                url: "batch?editid="+batchId,
                success: function(data){
                  var schools = JSON.parse(data);
                    var obj = schools[0];
                    console.log(obj);
                    document.getElementById("bname").value = obj.name;
                    var val = obj.school;
                    var sel = document.getElementById('schoolname');
                    var opts = sel.options;
                      for (var j = 0; j <= opts.length; j++) { 
                          var opt = opts[j];
                          if (opt.value == val) {
                            sel.selectedIndex = j;
                            break;
                        }
                      }
                     $.ajax({ 
                        type: 'GET',
                        url: "batchedstudents?id="+opt.value+"&bid="+batchId,
                        success: function(data){
                          $('#studentname').empty();
                          var studentname = JSON.parse(data);
                          for (var i =0; i< studentname.unAllocatedStudent_name.length; i++){
                              var obj = studentname.unAllocatedStudent_name[i];
                              var element = document.getElementById("studentname");
                              var option = document.createElement("option");
                              option.value = obj.student_id;
                              option.id = obj.student_id;
                              option.text = obj.student_name;
                              element.add(option);
                            }
                            for (var i =0; i< studentname.allocatedStudent_name.length; i++){
                              var obj = studentname.allocatedStudent_name[i];
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
                    document.getElementById("sdate").value = moment(obj.sdate, "YYYY-MM-DD").format('L');
                    document.getElementById("edate").value = moment(obj.edate, "YYYY-MM-DD").format('L');
                    if(obj.activate == "Yes"){
                    document.getElementById("myCheck").checked = true;
                    }
                },
                error:function(error){
                  console.log(error);
                }});
        }
    });
    function myFunction(){
      $('#assignedStudents option').prop('selected', true);
    }
</script>
</html>