<html>
<head>
<title> Add Trainer </title>
<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            tname: {
              identifier  : 'tname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter the trainer name'
                },
              ]
            },
            tphoneno: {
              identifier  : 'tphoneno',
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
            tmailid: {
              identifier  : 'tmailid',
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
            tspec: {
              identifier  : 'tspec',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your specialization'
                }
              ]
            },
            schoolname: {
              identifier  : 'schoolname',
              rules: [
                {
                  type    : 'empty',
                  prompt  : 'Please select school name'
                }
              ]
            },
           
            taddress: {
              identifier  : 'taddress',
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
<form class="ui form" action="trainer" method="post" >
<br />
<h3 class="ui dividing header" id="schoolheader" style="text-align: left;">Add Trainer</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
    <div class="field">
        <div class="three fields" style="display: none;">
          <div class="three wide field">
            <label>Trainer ID</label>
          </div>
          <div class="four wide field">
            <input type="text" name="tid" id="eid">
          </div>
        </div>
    </div>
  <div class="field">
     <div class="two fields">
      <div class="three wide field">
      <label>Trainer Name</label>
      </div>
      <div class="four wide field">
        <input type="text" name="tname" placeholder="Name of Trainer" id="name">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Contact No</label>
      </div>
      <div class="four wide field">
        <input type="text" name="tphoneno" placeholder="Contact Number" id="contactno">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Mail Id</label>
      </div>
      <div class="four wide field">
        <input type="text" name="tmailid" placeholder="abc@gmail.com" id="mailid">
      </div>
    </div>
  </div>
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Specialization</label>
      </div>
      <div class="four wide field">
        <input type="text" name="tspec" placeholder="Enter the specialization" id="spec">
      </div>
    </div>
  </div>
 
  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>School</label>
      </div>
      <div class="four wide field">
      <select id="schoolname" name="schoolname[]" class="ui fluid search dropdown" multiple="">
      <option value="">Select school </option> 
      </select>
      </div>
    </div>
  </div>

  <div class="field">
    <div class="two fields">
      <div class="three wide field">
      <label>Address</label>
      </div>
      <div class="four wide field">
        <input type="text" name="taddress" placeholder="Name of Address" id="address">
      </div>
    </div>
  </div>

  <div class="two fields">
      <div class="three wide field">
      <label>Activate</label>
    </div>
    <div class="field">
    
     <div class="one wide field" >
     <input type="hidden" name="activate" value="no">
     <input type="checkbox" name="activate"  value="Yes"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
    </div>
    </div>
 </div>
</div>

<form class="ui form" action="trainer" method="post" >
<div class="seven wide field">
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new trainer" value="Add this trainer record" ></input>
</div>
</div>
</div>

</form>
</body>
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
            document.getElementById("schoolheader").innerText = "Edit Trainer Details";
            $.ajax({ 
                type: 'GET',
                url: "trainer",
                success: function(data){
                  var schools = JSON.parse(data);
                  for (var i =0; i< schools.length; i++){
                    var obj = schools[i];
                    if(obj.trainer_id == queryString["id"]){
                    document.getElementById("name").value = obj.trainer_name;
                    document.getElementById("contactno").value = obj.contact_no;
                    document.getElementById("mailid").value = obj.mail_id;
                    document.getElementById("spec").value = obj.specialization;
                    var val = obj.school;
                    var ar =[];
                    ar = val.split(',');
                    console.log(ar.length);               
                      var select = document.getElementById( 'schoolname' );
                      var l, o;
                      l = select.options.length;
                      console.log(ar[0]);
                      for ( var i = 0; i < l; i++ )
                      {
                        o = select.options[i];
                        if ( ar.indexOf( o.text ) != -1 )
                        {
                          $('#schoolname').dropdown('set selected',[o.value]);
                        }
                      }
                    document.getElementById("address").value = obj.address;
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