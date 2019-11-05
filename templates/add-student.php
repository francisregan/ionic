<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

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
                  type   : 'exactLength[10]',
                  prompt : 'Your contact no should be exactly 10 numbers'
                },
                {
                  type   : 'number',
                  prompt : 'Your contact no should not contain any character and any other sign'
                },
                {
                  type   : 'not[0000000000]',
                  prompt : 'Please enter valid Contact number'
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
                  type   : 'regExp[/^([a-z0-9\\+_\\-]+)(\\.[a-z0-9\\+_\\-]+)*@([a-z0-9\\-]+\\.)+[a-z]{2,6}$/]',
                  prompt : 'Please Enter valid mail'
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
            sparentname: {
              identifier  : 'sparentname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your parents name'
                },
                {
                  type  : 'regExp[/^[a-zA-Z ]{2,255}$/]',
                  prompt: 'Parent name should not contain any digit'
                }
              ]
            },
            country: {
              identifier  : 'country',
              rules: [
                {
                  type    : 'empty',
                  prompt  : 'Please select country'
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
      <option value="0">select school</option>
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


  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Country</label>
      </div>
      <div class="four wide field">
      <?php 
    include __DIR__ . '/../templates/countries.php';
    ?>   
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
$_SESSION['stu_res'] = true;
?>

<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new student" value="Add this student record"  disabled="disabled"  ></input>
</div>
</div>
</div>
</form>
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
      /* $(function() {     
  var select = $('select');
  select.html(select.find('option').sort(function(x, y) {
    return $(x).text() > $(y).text() ? 1 : -1;
  }));
}); */

$('#name,#contactno,#myCheck,#mailid,#age,#batch,#class,#pname,#schoolname,#country').on('input change', function () {
            if ($(this).val() != '') {
                $('#submitBtn').prop('disabled', false);
            }
            else {
                $('#submitBtn').prop('disabled', true);
            }
        });

      var schools = JSON.parse(data);
      for (var i =0; i< schools.length; i++){
        var obj = schools[i];
        var element = document.getElementById("schoolname");
        var option = document.createElement("option");
        option.value = obj.sno;
        option.id = obj.sno;
        option.text = obj.school_name;
        if(obj.activate == 'Y'){
          element.add(option);
        }
      }
    },
    error:function(error){
      console.log(error);
    }});
  });
</script>

<script type="text/javascript">

    $(function () {
        if (window.location.href.indexOf("id") > -1) {
            var params = window.location.search.split('?')[1].split('&');
            var studentId = decodeURIComponent(params[0].split('=')[1]);
            document.getElementById("eid").value = studentId;
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("studentheader").innerText = "Edit Student Details";
            $.ajax({
                type: 'GET',
                url: "student?id="+studentId,
                success: function(data){
                  var schools = JSON.parse(data);
                    var obj = schools[0];
                    document.getElementById("name").value = obj.student_name;
                    document.getElementById("contactno").value = obj.contact_number;
                    document.getElementById("contactno").readOnly = true;
                    document.getElementById("mailid").value = obj.email;
                    document.getElementById("mailid").readOnly = true;
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
                    document.getElementById("age").value = obj.age;
                    document.getElementById("batch").value = obj.batch;
                    document.getElementById("class").value = obj.class;
                    document.getElementById("pname").value = obj.parent_name;
                    document.getElementById("country").value = obj.country;
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
</html>
