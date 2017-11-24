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
<a rel="" href="#"><img src="logo.png" style="width:63px; height:63px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<p>
<div class="container">

		
		
		<br>
<a href="index.php" class="btn btn-success btn-xs-2x" style="float: none;">Back</a>

<br>
<br>
<a href="cus-credit.php" class="btn btn-default" style="float: right;" disabled>credit list</a>
<a href="cus-new.php" class="btn btn-default" style="float: right;" >customer list</a>
<div class="jumbotron">
<input style="width:812px" type="text" name="filter" value="" id="filter" placeholder="Search name..." autocomplete="off" />
<a rel="facebox" href="select_customer-new.php" class="btn btn-primary btn-sm-2x">Customer Ledger</a><br><br>
<table id="resultTable" data-responsive="table">
	<thead>
		<tr>
			
			<th> Name </th>
			
			<th> Credit Amount </th>
			
			<th> Date </th>
			
			<th> Balance </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM sales where type='credit' ORDER BY transaction_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php echo $row['name']; ?></td>
			
			
			
			<td><?php echo $row['amount']; ?></td>
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['balance']; ?></td></tr>
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