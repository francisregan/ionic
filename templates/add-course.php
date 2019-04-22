<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

<html>
<head>
<title> Add New Course </title>
<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            cname: {
              identifier  : 'cname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter the course name'
                },
              ]
            },
           ctype: {
               identifier : 'ctype',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'please select the type'
                   }
               ]
           },
           category: {
               identifier : 'category',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'please select the category'
                   }
               ]
           },
           duration: {
               identifier : 'duration',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'please select the duration'
                   }
               ]
           },
           sessions: {
              identifier  : 'sessions',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter the session'
                },
                {
                  type   : 'number',
                  prompt : 'Sessions should not contain any character and any other sign only numeric value accept'
                },
                {
                  type   : 'not[0]',
                  prompt : 'Please enter atleat one Session number'
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

<form class="ui form" action="course" method="post" >
<br />
<h3 class="ui dividing header" style="text-align: left;" id="courseheader">Add new course</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
<div class="field" style="display: none;">
            <div class="three fields">
              <div class="three wide field">
                <label>Course Id</label>
              </div>
              <div class="four wide field">
                <input type="text" name="cid" id="cid">
              </div>
            </div>
        </div>
  <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>Course Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="cname" id="cname" placeholder="Name of course name">
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Course Type</label>
      </div>
      <div class="four wide field">

<select name="ctype" id="ctype">
<option value=""> Select course Type</option>
  <option value="School">School</option>
  <option value="College">College</option>
  <option value="Professional">Professional</option>
</select>
 </div>
 </div>
 </div>

      <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Duration</label>
      </div>
      <div class="four wide field">
<select name="duration" id="duration">
  <option value="">Select Duration</option>
  <option value="1 Day">1 Day</option>
  <option value="2 Days">2 Days</option>
  <option value="3 Days">3 Days</option>
  <option value="4 Days">4 Days</option>
  <option value="5 Days">5 Days</option>
  <option value="6 Days">6 Days</option>
  <option value="1 Week">1 Weeks</option>
  <option value="2 Week">2 Weeks</option>
  <option value="3 Week">3 Weeks</option>
  <option value="4 Week">4 Weeks</option>
  <option value="1 Month">1 Month</option>
</select>
 </div>
 </div>
 </div>

 <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>3D Printing Required?</label>
      </div>
      <div class="four wide field">
      <div class="ui form">
  <div class="inline fields">

    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="frequency" value="yes" checked="checked" id="yes">
        <label>YES</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="frequency" value="no" id="no">
        <label>NO</label>
      </div>
    </div>
      </div>
      </div>
      </div>
 </div>
 </div>

 <div class="field">
     <div class="two wide fields">
      <div class="three wide field">
      <label>Number of Sessions</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sessions" placeholder="Enter the no of session" id="session">
      </div>
    </div>
  </div>

  <div class="two fields">
      <div class="three wide field">
        <label>Activate</label>
      </div>
    <div class="field">
      <div class="one wide field" >
        <input type="hidden" name="activate" value="N">
        <input type="checkbox" name="activate" id="myCheck" value="Y"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
      </div>
    </div>
 </div>

  </div>
  <?php
$_SESSION['cou_res'] = true;
?>
<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new course" value="Save" ></input>
</div>
</div>
</div>
</form>
</body>
</html>

<script>
$(document).ready(function(){
    if (window.location.href.indexOf("id") > -1) {
            var params = window.location.search.split('?')[1].split('&');
            var courseId = decodeURIComponent(params[0].split('=')[1]);
            document.getElementById("cid").value = courseId;
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("courseheader").innerText = "Edit Course Details";
            $.ajax({
                type: 'GET',
                url: "course?id="+courseId,
                success: function(data){
                  var lessons = JSON.parse(data);
                    var obj = lessons[0];

                    document.getElementById("cname").value = obj.name;
                    $('#ctype').dropdown('set selected',obj.type);
                    $('#duration').dropdown('set selected',obj.duration);
                    if(obj.printing == "no"){
                      document.getElementById("yes").checked = false;
                      document.getElementById("no").checked = true;
                    }
                    document.getElementById("session").value = obj.session;
                    if(obj.activate == "Y"){
                      document.getElementById("myCheck").checked = true;
                    }
                },
                error:function(error){
                  console.log(error);
                }});
        }
  });
</script>