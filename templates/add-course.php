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
<h3 class="ui dividing header" style="text-align: left;">Add new course</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
  <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>Course Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="cname" placeholder="Name of course name">
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Course Type</label>
      </div>
      <div class="four wide field">

<select name="ctype">
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
<select name="duration">
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
        <input type="radio" name="frequency" value="yes" checked="checked">
        <label>YES</label>
      </div>
    </div>
    <div class="field">
      <div class="ui radio checkbox">
        <input type="radio" name="frequency" value="no">
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
        <input type="text" name="sessions" placeholder="Enter the no of session">
      </div>
    </div>
  </div>

  </div>
<form class="ui form" action="course" method="post" >
<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new course" value="Save" ></input>
</div>
</div>
</div>
</form>
</body>

</html> 