<html>
<head>
<title> Manage Trainer </title>
<style>
.pagination li
{
	list-style:none;
	float:left;
	width :50px;
	height:50px;
	border: 1px solid blue;
	background-color:white;
	color:blue;
	text-align:center;
	cursor:pointer;
}

.pagination li:hover
{
	background-color:blue;
	border:1px solid blue;
	color: white;
}

.pagination ul
{
	border:0px;
	padding:0px;
}

</style>

<script>
$(document).ready(function(){
  var table;
  var row;
$.ajax({ 
  type: 'GET',
  async: false,
  url: "trainer",
  success: function(data){
    var schools = JSON.parse(data);
    
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
      console.log(obj);
      table = document.getElementById("mytable");
      row = table.insertRow(1);
      row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var celltrainer = row.insertCell(1);
        var cellcontactno = row.insertCell(2);
        var cellmail = row.insertCell(3);
        var cellspecialization = row.insertCell(4);
        var cellschool = row.insertCell(5);
        var celledit = row.insertCell(6);

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        celltrainer.innerHTML = obj.trainer_name;
        cellcontactno.innerHTML = obj.contact_no;
        cellmail.innerHTML = obj.mail_id;
        cellspecialization.innerHTML = obj.specialization;
        cellschool.innerHTML = obj.school;
        celledit.innerHTML = document.getElementById("edit").innerHTML
    }
  },
  error:function(error){
    console.log(error);
  }});

$(".pagination").customPaginate({

itemsToPaginate : ".rowdata"

});
});

</script>


</head>

<body>
<h3 class="ui header" style="text-align: left;">Manage Trainer</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>Trainer Name</th>
      <th>Contact No</th>
      <th>Mail Id</th>
      <th>Specialization</th>
      <th>School</th>
      <th>Edit Details</th>
    </tr>
  </thead>
  <tbody>
  
  <script id="check" type="text/template">
      <div class="collapsing">
        <div class="ui fitted slider checkbox">
          <input type="checkbox"><label></label>
        </div>
      </div>
  </script>

  <script id="edit" type="text/template">
		<div class="ui form" id="edit">
      <button class="ui primary basic button">Edits</button>
		</div>
  </script>

  </tbody>
  <tfoot class="full-width">
    <tr>
      <th></th>
      <th colspan="8">
        <div class="ui right floated pagination menu">
     
        </div>
        <div class="ui small button">
          Approve
        </div>
        <div class="ui small  disabled button">
          Approve All
        </div>
      </th>
    </tr>
  </tfoot>
  
  
</table>
<script>
	 (function($){

      $.fn.customPaginate = function(options)
      {
         var paginationContainer = this;
         var itemsToPaginate;

        var defaults = {

          itemsPerPage : 5
        };

        var settings = {};
        $.extend(settings, defaults, options);
		
		    var itemsPerPage = settings.itemsPerPage;

        itemsToPaginate = $(settings.itemsToPaginate);
	    	var numberOfPaginationLinks = Math.ceil((itemsToPaginate.length / itemsPerPage));

        $('<ul></ul>').prependTo(paginationContainer);
		
	    	for(var index = 0; index < numberOfPaginationLinks; index++)
	    	{
		    	paginationContainer.find("ul").append("<li>"+ (index+1) +"</li>")
	    	}
		
		    itemsToPaginate.filter(":gt("+ (itemsPerPage - 1) +")").hide();

	    	paginationContainer.find("ul li").on('click', function(){
			
		  	var linkNumber = $(this).text();
		  	var itemsToHide = itemsToPaginate.filter(":lt("+ ((linkNumber-1)  * itemsPerPage) +")");
		  	$.merge(itemsToHide, itemsToPaginate.filter(":gt("+ ((linkNumber  * itemsPerPage) -1) +")"));
		  	itemsToHide.hide();
			
			  var itemsToShow = itemsToPaginate.not(itemsToHide);
			  itemsToShow.show();
		});
  }
  
 }(jQuery));
</script>
</body>
</html>