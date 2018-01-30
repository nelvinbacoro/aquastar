<html>
<head>
<title>
AQR
</title>
<style>
body {
  
	background:url(body5.png); 
}
.nav-wrapper {
	background-color: #004080;
	color: white;
}
</style>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/materialize.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="../style01.css" media="screen" rel="stylesheet" type="text/css" />
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
</head>
<body>
<nav>
<div class="nav-wrapper">
<center>
	<a rel="facebox" href="#"><img src="aqrlogo.png" style="width:250px; height:60px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<p>
<div class="container">

		
		
		<br>
<a href="index.php" class="btn btn-success btn-xs-2x" style="float: none;">Back</a>
 <a class="btn btn-default btn-xs-2x" href="javascript:Clickheretoprint()">Print</a>
<br>
<br>
<a href="brwreport.php" class="btn btn-default" style="float: right;" disabled>DISBURSEMENT report</a>
<a href="collection.php?d1=0&d2=0" class="btn btn-default" style="float: right;" >collection report</a>
    <a href="inventoryreport.php?d1=0&d2=0" class="btn btn-default" style="float: right;">inventory report</a>
<a href="salesreport.php?d1=0&d2=0" class="btn btn-default" style="float: right;">sales report</a>
<div class="jumbotron">
<input style="width:812px" type="text" name="filter" value="" id="filter" placeholder="Search name..." autocomplete="off" />

<table id="resultTable" data-responsive="table">
	<thead>
		<tr>
			
			<th> Customer Name </th>
			
			<th> No. of Container </th>
			
			<th> Date Borrowed </th>
			
			<th> Date Returned </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
                $result = $db->prepare("SELECT * FROM borrow b
                                            LEFT JOIN customer c ON c.customer_id = b.customer_id
                                            ORDER BY daeR ASC, borrow_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php echo $row['customer_name']; ?></td>
			
			
			
			<td><?php echo $row['gal_qty']; ?></td>
			<td><?php echo $row['dateB']; ?></td>
			<td><?php echo $row['daeR']; ?></td></tr>
			<?php
				}
			?>
		
	</tbody>
</table>
</div>
</div>
<div class="clearfix"></div>

<script src="js/jquery.js"></script>
  <script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this update? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "deletecustomer.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
</body>
</fieldset>
</html>