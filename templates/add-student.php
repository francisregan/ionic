<html>
<head>
<title> Add Student </title>
<script>
$(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            sname: {
              identifier  : 'sname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter the student name'
                },
              ]
            },
            stphoneno: {
              identifier  : 'stphoneno',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your contact no'
                },
                {
                  type   : 'length[10]',
                  prompt : 'Your contact no should be exactly 10 numbers'
                }
              ]
            },
            smailid: {
              identifier  : 'smailid',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your mail id'
                },
                {
                  type   : 'email',
                  prompt : 'Enter valid mail'
                }
              ]
            }, 
            schoolname: {
              identifier  : 'schoolname',
              rules: [
                {
                  type    : 'empty',
                  prompt  : 'please select school name'
                }
              ]
            },
            sage: {
              identifier  : 'sage',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your age'
                }
              ]
            },
           

            sclass: {
              identifier  : 'sclass',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your class'
                }
              ]
            },

            sparentname: {
              identifier  : 'sparentname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your parents name'
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
<form class="ui form" action="student" method="post" >
<br />
<h3 class="ui dividing header" id="studentheader" style="text-align: left;">Add Student</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
    <div class="field">
        <div class="three fields" style="display: none;">
          <div class="three wide field">
            <label>Student ID</label>
          </div>
          <div class="four wide field">
            <input type="text" name="stid" id="eid">
          </div>
        </div>
    </div>
  <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>Student Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sname" placeholder="Name of Student" id="name">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Contact No</label>
      </div>
      <div class="four wide field">
        <input type="text" name="stphoneno" placeholder="Contact Number" id="contactno">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Mail Id</label>
      </div>
      <div class="four wide field">
        <input type="text" name="smailid" placeholder="abc@gmail.com" id="mailid">
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

  
 
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Age</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sage" placeholder="12" id="age">
      </div>
    </div>
  </div>
 
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Batch</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sbatch" placeholder="Specify the Batch" id="batch">
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Class</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sclass" placeholder="Specify the Class" id="class">
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Parents Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sparentname" placeholder="Enter your parent name" id="pname">
      </div>
    </div>
  </div>
  </div>
<form class="ui form" action="student" method="post" >
<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new student" value="Add this student record" ></input>
</div>
</div>
</div>
</form>
<form>

</body>

<form class="ui form" action="student" method="post" >
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
        element.add(option);
      }
    },
    error:function(error){
      console.log(error);
    }});
  });
</script>

<script type="text/javascript">
    var queryString = new Array();
    $(function () {
        if (queryString.length == 0) {
            if (window.location.search.split('?').length > 1) {
                var params = window.location.search.split('?')[1].split('&');
                for (var i = 0; i < params.length; i++) {
                    var key = params[i].split('=')[0];
                    var value = decodeURIComponent(params[i].split('=')[1]);
                    queryString[key] = value;
                }
            }
        }
        if (queryString["id"] != null) {
            document.getElementById("eid").value = queryString["id"];
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("studentheader").innerText = "Edit Student Details";
            $.ajax({ 
                type: 'GET',
                url: "student",
                success: function(data){
                  var schools = JSON.parse(data);
                  for (var i =0; i< schools.length; i++){
                    var obj = schools[i];
                    if(obj.student_id == queryString["id"]){
                    console.log(obj);
                    document.getElementById("name").value = obj.student_name;
                    document.getElementById("contactno").value = obj.contact_number;
                    document.getElementById("mailid").value = obj.email;
                    var val = obj.school;
                    var sel = document.getElementById('schoolname');
                    var opts = sel.options;
                      for (var j = 0; j <= opts.length; j++) {
                          console.log(j);  
                          var opt = opts[j];
                          if (opt.value == val) {
                            sel.selectedIndex = j;
                            break;
                        }
                      }
                    
                    document.getElementById("age").value = obj.age;
                    document.getElementById("batch").value = obj.batch;
                    document.getElementById("class").value = obj.class;
                    document.getElementById("pname").value = obj.parent_name;
                    }
                  }
                },
                error:function(error){
                  console.log(error);
                }});
        }
    });
</script>
</html>