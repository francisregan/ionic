<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
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
            document.getElementById("schoolheader").innerText = "Edit School Details";
            $.ajax({ 
                type: 'GET',
                url: "school",
                success: function(data){
                  var schools = JSON.parse(data);
                  for (var i =0; i< schools.length; i++){
                    var obj = schools[i];
                    console.log(obj);
                    if(obj.sno == queryString["id"]){
                    document.getElementById("name").value = obj.school_name;
                    document.getElementById("contactno").value = obj.contact_no;
                    document.getElementById("contactperson").value = obj.contact_person;
                    document.getElementById("mailid").value = obj.mail_id;
                    document.getElementById("address").value = obj.address;
                    document.getElementById("state").value = obj.state;
                    document.getElementById("city").value = obj.city;
                    }
                  }
                },
                error:function(error){
                  console.log(error);
                }});

        }
    });
</script>
</head>
<body>

<form class="ui form" action="school" method="post" >
<br />
<h3 class="ui dividing header" id="schoolheader" style="text-align: left;">Add School</h3>
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
            <input type="text" name="sid" id="eid">
          </div>
        </div>
    </div>
  <div class="field">
     <div class="three fields">
      <div class="three wide field">
      <label>School Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sname" placeholder="Name of School" id="name">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="four fields">
      <div class="three wide field">
      <label>Contact No</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sphoneno" placeholder="Contact Number" id="contactno">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Contact Person</label>
      </div>
      <div class="four wide field">
        <input type="text" name="scontactperson" placeholder="Name of person" id="contactperson">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Mail id</label>
      </div>
      <div class="four wide field">
        <input type="text" name="smailid" placeholder="abc@gmail.com" id="mailid">
      </div>
    </div>
  </div>
 
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School Address</label>
      </div>
      <div class="four wide field">
        <input type="text" name="saddress" placeholder="Enter the address" id="address">
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>State</label>
      </div>
      <div class="four wide field">
        <input type="text" name="sstate" placeholder="Name of state" id="state">
      </div>
    </div>
  </div>
  

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School City</label>
      </div>
      <div class="four wide field">
        <input type="text" name="scity" placeholder="Enter the city" id="city">
      </div>
    </div>
  </div>

  </div>
  
<form class="ui form" action="school" method="post" >
  <div class="seven wide field">
  <input id="submitBtn" type="submit" class="ui primary button" name="Add a new school" value="Add this school record"></i>
</div>
</div>
</div>
</form>
</body>
</html>