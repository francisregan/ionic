<html>
<head>
<title> Manage schools </title>
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
  url: "school",
  success: function(data){
    var schools = JSON.parse(data);
    
    for (var i =0; i< schools.length; i++){
      var obj = schools[i];
      console.log(obj);
      table = document.getElementById("mytable");
        row = table.insertRow(1);
        row.setAttribute("class","rowdata");
        var cellcheckbox = row.insertCell(0);
        var cellschool = row.insertCell(1);
        var cellcontact = row.insertCell(2);
        var cellcontactno = row.insertCell(3);
        var cellmail = row.insertCell(4);
        var celladdress = row.insertCell(5);
        var celledit = row.insertCell(6);
        var cellremarks = row.insertCell(7);

        cellcheckbox.innerHTML = document.getElementById("check").innerHTML;
        cellschool.innerHTML = obj.school_name;
        cellcontact.innerHTML = obj.contact_person;
        cellcontactno.innerHTML = obj.contact_no;
        cellmail.innerHTML = obj.mail_id;
        celladdress.innerHTML = obj.address;
        celledit.innerHTML = document.getElementById("edit").innerHTML
        cellremarks.innerHTML = document.getElementById("tarea").innerHTML;
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
<div class="page">
<h3 class="ui header" style="text-align: left;">Manage School</h3>

<br />
<table id="mytable" class="ui celled table">
  <thead>
    <tr>
      <th></th>
      <th>School Name</th>
      <th>Contact Person</th>
      <th>Contact No</th>
      <th>Mail Id</th>
      <th>Address</th>
      <th>Edit Details</th>
	  <th>Remark</th>
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
		<div class="ui form">
    
     <button class="ui primary basic button" value="edit">Edits</button>
    
		</div>

  </script>

  <script id="tarea" type="text/template"> 
		<div class="ui form">
			<div class="field">
			  <textarea rows="1"></textarea>
      </div>
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