<html>
<head>
    <title> My Profile </title>


<script>
$(document).ready(function(){
$.ajax({ 
  type: 'GET',
  url: "profile",
  success: function(data){
    var schools = JSON.parse(data);
      var obj = schools[0];
      document.getElementById("name").innerHTML = obj.name;
      document.getElementById("gender").innerHTML = obj.gender;
      document.getElementById("phone").innerHTML = obj.phone;
      document.getElementById("course").innerHTML = obj.course;
      document.getElementById("schoolname").innerHTML = obj.school_name;
      document.getElementById("branch").innerHTML = obj.branch;
  },
  error:function(error){
    console.log(error);
  }});
});

</script>

</head>

<body>
<div class="ui grid">
  <div class="four wide column">
<div class="ui small image">
  <svg width="150" height="150">
    <image xlink:href="/images/wireframe/image.png" x="0" y="0" width="100%" height="100%"></image>
  </svg>
</div>
</div>
  <div class="ten wide column">
	<table class="ui very basic table">
   <tbody>
   <tr class="left aligned">
      <td>Name</td>
      <td id="name"></td>
    </tr>
    <tr class="left aligned">
      <td>Gender</td>
      <td id="gender"></td>
    </tr>
    <tr class="left aligned">
      <td>Contact No</td>
      <td id="phone"></td>
    </tr>
    <tr class="left aligned">
      <td>Course</td>
      <td id="course"></td>
    </tr>
    <tr class="left aligned">
      <td>School Name</td>
      <td id="schoolname"></td>
    </tr>
    <tr class="left aligned">
      <td>Branch</td>
      <td id="branch"></td>
    </tr>
  </tbody>
</table>
  </div>
  <div class="two column">
</div>
</div>
<!DOCTYPE html>
<html>
<body>
<div class="ui medium header" align ="left">Status</div>
<pre 
<div class="ui tiny header" align ="left">Course 1 </div> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <button class="ui twitter button"><i class="download icon"></i> Download Certificate</button>
</pre>
</div>
</body>
</html>

</body>
</html>