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
<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='AS-'.createRandomPassword();
?>
</head>
<body>
<nav>
<div class="nav-wrapper">
<center>
<a rel="facebox" href="select.php"><img src="logo.png" style="width:63px; height:63px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<br>
<div class="container">

<a href="index.php" class="btn btn-success btn-xs-2x" role="button" >Back</a>
<br>
<br>
<div class="jumbotron">
<input style="width:850px" type="text" name="filter" value="" id="filter" placeholder="SEARCH CUSTOMER..." autocomplete="off" />
<a rel="facebox" href="addcustomer1.php" class="btn btn-primary btn-sm-2x">Add Customer</a><br>
<table id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th > Name </th>
			<th > Address </th>
			<th > Contact </th>
	
			<th > Order </th>
			<th > Date Ecpected </center></th>
			<th ><center> Actions </center></th>
		</tr>
	</thead>
	
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM customer ORDER BY customer_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr>
			<td><?php echo $row['customer_name']; ?></td>
			<td><?php echo $row['address']; ?></td>
			<td><?php echo $row['contact']; ?></td>
			
			<td>Purified Water[<?php echo $row['order_qty']; ?>pc/s]</td>
			<td><?php echo $row['cdate']; ?></td>
			<td><center><a rel="facebox" href="editcustomer.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-warning btn-xs-2x"> Edit </a> 
			 <a href="#" id="<?php echo $row['customer_id']; ?>" class="delbutton" title="Click To Delete">Delete</a>
			</center>
			</td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<div class="clearfix"></div>
</div>
</div>
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
</fieldset>
</body>
</html>