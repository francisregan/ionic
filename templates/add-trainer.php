<?php
if (!isset($_SESSION)) {
    session_start();
}
?>

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
            tmailid: {
              identifier  : 'tmailid',
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
     <input type="checkbox" name="activate" id="myCheck"  value="Yes"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
    </div>
    </div>
 </div>
</div>

<div class="seven wide field">
<?php
$_SESSION['tra_res'] = true;
?>
<input id="submitBtn" type="submit" class="ui primary button" name="Add a new trainer" value="Add this trainer record" disabled="disabled"  ></input>
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
     
      $('#name,#contactno,#myCheck,#mailid,#address,#schoolname,#spec').on('input change', function () {
            if ($(this).val() != '') {
                $('#submitBtn').prop('disabled', false);
            }
            else {
                $('#submitBtn').prop('disabled', true);
            }
        });
        
        $(function() {     
  var select = $('select');
  select.html(select.find('option').sort(function(x, y) {
    return $(x).text() > $(y).text() ? 1 : -1;
  }));
});
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
    $(function () {
        if (window.location.href.indexOf("id") > -1) {
            var params = window.location.search.split('?')[1].split('&');
            var trainerId = decodeURIComponent(params[0].split('=')[1]);
            document.getElementById("eid").value = trainerId;
            document.getElementById("submitBtn").value = "Save Changes";
            document.getElementById("schoolheader").innerText = "Edit Trainer Details";
            $.ajax({
                type: 'GET',
                url: "trainer?id="+trainerId,
                success: function(data){
                  var schools = JSON.parse(data);
                    var obj = schools[0];
                    document.getElementById("name").value = obj.trainer_name;
                    document.getElementById("contactno").value = obj.contact_no;
                    document.getElementById("contactno").readOnly = true;
                    document.getElementById("mailid").value = obj.mail_id;
                    document.getElementById("mailid").readOnly = true;
                    document.getElementById("spec").value = obj.specialization;
                    var val = obj.school;

                    var select = document.getElementById( 'schoolname' );
                    for ( var i = 0; i < val.length; i++ ){
                      var schoolID = val[i];
                      $('#schoolname').dropdown('set selected',schoolID);

                    }
                    document.getElementById("address").value = obj.address;
                    if(obj.activate == "Yes"){
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
