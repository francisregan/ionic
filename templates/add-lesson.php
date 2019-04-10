<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<html>
<head>
<title> Add New Lesson </title>
<link href="css/summernote.css" rel="stylesheet">
<script type="text/javascript" src="script/summernote.js">
</script>
<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
           lessonname: {
              identifier  : 'lessonname',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter lesson name'
                },
              ]
            },
           pages: {
               identifier : 'noofpages',
               rules: [
                   {
                       type  : 'empty',
                       prompt : 'please select No of pages'
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
<form class="ui form" action="lesson" method="post" >
<br />
<h3  id="lessonheader"  class="ui dividing header" style="text-align: left;">Add Lesson</h3>
<br />
<div class="ui error message"></div>
<div style="align:center">
<div>
      <div class="field" style = "display: none;">
        <div class="two fields">
            <div class="three wide field">
                <label>Name of the Lesson</label>
            </div>
            <div class="four wide field">
                <input type="text" name="arr" id="arr">
            </div>
        </div>
      </div>
      <div class="field">
        <div class="three fields" style="display: none;">
          <div class="three wide field">
            <label>Lesson ID</label>
          </div>
          <div class="four wide field">
            <input type="text" name="lid" id="lid">
          </div>
        </div>

    <div class="field">
        <div class="two fields">
            <div class="three wide field">
                <label>Name of the Lesson</label>
            </div>
            <div class="four wide field">
                <input type="text" name="lessonname" placeholder="Enter the lesson name" id="lessonname">
            </div>
        </div>
      </div>

      <div class="field">
            <div class="two fields">
                <div class="three wide field">
                    <label>Number of Pages</label>
                </div>
                <div class="four wide field">
                    <select name="noofpages" id="mySelect" onchange="myFunction()">
                        <option value="">Select Number of Pages</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>
     </div>
     <div class="field">
        <div class="ten wide" id="snote" name="page[]"></div>
     </div>
     
     <div class="two fields">
      <div class="three wide field">
      <label>Activate</label>
    </div>
    <div class="field">
    
     <div class="one wide field" >
     <input type="hidden" name="activate" value="N">
     <input type="checkbox" name="activate" id="myCheck"  value="Y"style="margin-left: 10px; margin-top: 10px; text-align:center;" />
    </div>
    </div>
 </div>
</div>

<?php
$_SESSION['les_res'] = true;
?>
    

     <div class="field">
        <div class="seven wide field">
             <input id="submitBtn" type="submit" class="ui primary button" name="Add a new Lesson" value="Add lesson" />
        </div>
    </div>
</div>
</div>
</div>
</body>
</form>
<script>
    $('.ui.dropdown')
        .dropdown()
    ;
  $(document).ready(function(){

    $(".primary").click(function() {
        var totalPage = $('#mySelect').val();
        var arr = [];
        for(var i=0;i<totalPage;i++){
        var markupStr = $('.summernote').eq(i).summernote('code');
        arr.push(markupStr);
    }
    document.getElementById("arr").value = JSON.stringify(arr);
  });
  });

function myFunction() {
  var selectValue = document.getElementById("mySelect").value;
  var node = document.getElementById("snote");
  document.getElementById("snote").innerHTML = "";
    for (var i = 0; i < selectValue; i++) {

        var lineBreak = document.createElement("br");

        var labelHeader = document.createElement("label");
        labelHeader.innerHTML = "Page No " + (i+1);

        var createSummerNote = document.createElement("div");
        createSummerNote.setAttribute("class","summernote");
        createSummerNote.setAttribute("name","Page"+(i+1));
        createSummerNote.setAttribute("id","Page"+(i+1));
        
        node.appendChild(labelHeader);
        node.appendChild(createSummerNote);
        node.appendChild(lineBreak);
        $('.summernote').summernote({
        placeholder: 'Write your page content',
        height: 300   
        });
    } 
}   
</script>
   <script type="text/javascript">
    $(function () {
        if (window.location.href.indexOf("id") > -1) {
            var params = window.location.search.split('?')[1].split('&');
            var lessonId = decodeURIComponent(params[0].split('=')[1]);
            document.getElementById("lid").value = lessonId;
            document.getElementById("submitBtn").value = "Add Lesson";
            document.getElementById("lessonheader").innerText ="editlesson";
           
            $.ajax({
                type: 'GET',
                url: "lesson?id="+lessonId,
                success: function(data){
                  var lessons = JSON.parse(data);
                    var obj = lessons[0];     
                    document.getElementById("lessonname").value = obj.lesson_name;

                    if(obj.activate == "Y"){
                      document.getElementById("myCheck").checked = true; 
                  } 
                      var val = obj.total_pages;
                  var sel = document.getElementById('mySelect');
                    var opts = sel.options;
                    
                      for (var j = 0; j <= opts.length; j++) { 
                          var opt = opts[j];
                          if (opt.value == val) {
                            sel.selectedIndex = j;
                             myFunction();   
                            break;  
                        }
                      }
                      for(var i=0;i<obj.content.length;i++){
                        $('#Page'+(i+1)).summernote('code', obj.content[i]);
                      }
                  
                },
                error:function(error){
                  console.log(error);
                }});

        }
    });

</script>
</html>
