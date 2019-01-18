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
                  type   : 'length[10]',
                  prompt : 'Your contact no should be exactly 10 digits'
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
            sstate: {
              identifier  : 'sstate',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your state'
                }
              ]
            },
            scity: {
              identifier  : 'scity',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please Enter Your City'
                }
              ]
            },
          }
        })
      ;
    });
  </script>

<style>
    
</style>
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
     <div class="six fields">
      <div class="three wide field">
      <label>School Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sname" placeholder="Name of School">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="four fields">
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
      <label>Contact Person</label>
      </div>
      <div class="four wide field">
        <input type="text" name="scontactperson" placeholder="Name of person">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Mail id</label>
      </div>
      <div class="four wide field">
        <input type="text" name="smailid" placeholder="abc@gmail.com">
      </div>
    </div>
  </div>
 
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School Address</label>
      </div>
      <div class="four wide field">
        <input type="text" name="saddress" placeholder="Enter the address">
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>State</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sstate" placeholder="abc@gmail.com">
      </div>
    </div>
  </div>
  

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School City</label>
    </div>
    <div class="four wide field">
      <input type="text" name="scity" placeholder="Enter the city">
    </div>
    </div>
  </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Activate</label>
    </div>
    <div class="two wide field">
    <input type="checkbox" name="activate"  value="Yes">Yes 
    <input type="hidden"  name="activate" value="No">
    </div>
    </div>
  </div>
  </div>
 </div>
</div>

<form class="ui form" action="school" method="post" >
  <div class="seven wide field">
  <input id="submitBtn" type="submit" class="ui primary button" name="Add a new school" value="Add this school record"></i></input>
</div>
</div>
</div>
</form>
</body>