 
<html>

<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="jquery-ui.js"></script>
<script>
    var $i = jQuery.noConflict();
</script> 

<head>
<style>
.ui-datepicker {
	width: 17em;
	padding: .2em .2em 0;
	display: none;
    background:#ffffff;  
}
.ui-datepicker .ui-datepicker-title {
	margin: 0 2.3em;
	line-height: 1.8em;
	text-align: center;
    color:#3399ff;
    background:#ffffff;  
}
.ui-datepicker table {
	width: 100%;
	font-size: .7em;
	border-collapse: collapse;
    font-family:verdana;
	margin: 0 0 .4em;
    color:#000000;
    background:#;    
}

.ui-datepicker td {

	border: 0;
	padding: 1px;
  

    
}
.ui-datepicker td span,
.ui-datepicker td a {
	display: block;
	padding: .8em;
	text-align: right;
	text-decoration: underline;
  
}

.subject-info-box-1,
.subject-info-box-2 {
    float: left;
    width: 30%;
    
    select {
        height: 100px;
        padding: 0;
       background:#ffffff;

        option {
            padding: 4px 10px 4px 10px;
        }

        option:hover {
            background:#ffffff;  
        }
    }
}

.subject-info-arrows {
    float: center;
    width: 6%;

    input {
        width: 30%;
        margin-bottom:45px;
    }
}
</style> 
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
<h3 class="ui dividing header" style="text-align: left;">Add Batch</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>

<div class="field">
     <div class="six fields">
      <div class="three wide field">
      	<label>Batch Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="bname" placeholder="Enter the batch name">
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
    <div class="two fields">
      <div class="subject-info-box-1">
       Unallocated Students
        <select multiple="multiple" id='studentname' name="studentname[]" class="form-control">
        </select>
        </div>
  
      <div class="subject-info-arrows text-center">
        <input type="button" id="btnRight" value=">"style="margin-right: 60px;margin-left: 15px; margin-top: 40px;  class="btn btn-default" /><br />
        <input type="button" id="btnLeft" value="<" style="margin-right: 60px;margin-left: 15px; margin-top: 30px; class="btn btn-default" /><br />
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
<input type="text" id="edate" name="edate" />
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
    .dropdown()
;
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
      var e = document.getElementById("schoolname");
      var school_id = e.options[e.selectedIndex].value;
      
      $.ajax({ 
        type: 'GET',
        url: "batchedstudents?id="+school_id,
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
    });
}


(jQuery));
</script>
</html>