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
            sphoneno: {
              identifier  : 'sphoneno',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your contact no'
                },
                {
                  type   : 'length[10]',
                  prompt : 'Your contact no shouldbe exactly 10 characters'
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
            sschool: {
              identifier  : 'sschool',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your school name'
                }
              ]
            },
            sbatch: {
              identifier  : 'sbatch',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your batch name'
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
<h3 class="ui dividing header" style="text-align: left;">Add Student</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
  <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>Student Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sname" placeholder="Name of Student">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Contact No</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sphoneno" placeholder="Contact Number">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Mail Id</label>
      </div>
      <div class="four wide field">
        <input type="text" name="smailid" placeholder="abc@gmail.com">
      </div>
    </div>
    
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sschool" placeholder="xxxschool">
      </div>
    </div>
  </div>
 
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Batch</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sbatch" placeholder="Specify the Batch">
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
</body>
</html>