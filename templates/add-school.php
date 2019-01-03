<html>
<head>
<title> Add School </title>
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
                  prompt : 'Please enter the school name'
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
                  type : 'integer'
                },
                {
                  type   : 'exactLength[10]',
                  prompt : 'Contact no must be 10 digit'
                }
              ]
            },
            scontactperson: {
              identifier  : 'scontactperson',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter the contact person'
                },
              ]
            },
            smailid: {
              identifier  : 'smailid',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your e-mail'
                },
                {
                  type   : 'email',
                  prompt : 'Please enter a valid e-mail'
                }
              ]
            },
            saddress: {
              identifier  : 'saddress',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your address'
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



<form class="ui form" action="school" method="post" >
<br />
<h3 class="ui dividing header" style="text-align: left;">Add School</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
  <div class="field">
     <div class="two fields">
      <div class="eight wide field">
      <label>School Name</label>
      </div>
      <div class="eight wide field">
        <input type="text" name="sname" placeholder="Name of School">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="eight wide field">
      <label>Contact No</label>
      </div>
      <div class="eight wide field">
        <input type="text" name="sphoneno" placeholder="Contact Number">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="eight wide field">
      <label>Contact Person</label>
      </div>
      <div class="eight wide field">
        <input type="text" name="scontactperson" placeholder="Name of person">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="eight wide field">
      <label>Mail id</label>
      </div>
      <div class="eight wide field">
        <input type="text" name="smailid" placeholder="abc@gmail.com">
      </div>
    </div>
  </div>
 
  <div class="field">
    <div class="two fields">
      <div class="eight wide field">
      <label>School Address</label>
      </div>
      <div class="eight wide field">
        <input type="text" name="saddress" placeholder="Enter the address">
      </div>
    </div>
  </div>

  </div>
  <h4 class="ui dividing header"></h4>
 
<form class="ui form" action="school" method="post" >
<input id="submitBtn" type="submit" class="ui button" style="background-color:#2185d0" name="Add School" value="Record Saved" ></input>
</div>
</div>
</form>
</body>