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
@media print{
#print {
display:none;
}
}

#print {
	width: 90px;
    height: 30px;
    font-size: 18px;
    background: white;
    border-radius: 4px;
	margin-left:28px;
	cursor:hand;
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
<a class="btn btn-default btn-xs-2x" rel="facebox" href="productprint.php" style="float: right">Print</a>
<br>
<br>
<a rel="facebox" href="productmng.php" class="btn btn-default" style="float: right;" >delete product</a>
<a href="products.php" class="btn btn-default" style="float: right;" disabled>product list</a>
<div class="jumbotron">
<input style="width:850px" type="text" name="filter" value="" id="filter" placeholder="Search Product..." autocomplete="off" />
<a rel="facebox" href="addproduct.php" class="btn btn-primary btn-sm-2x">Add Product</a><br><br>

<table id="resultTable" data-responsive="table">
	<thead>
		<tr>
			
			<th> Description </th>
			
			<th> Price </th>
			
			<th> Qty </th>
			
			<th><center> Action </center></th>
		</tr>
	</thead>
	<tbody>
		
			<?php
			function formatMoney($number, $fractional=false) {
					if ($fractional) {
						$number = sprintf('%.2f', $number);
					}
					while (true) {
						$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
						if ($replaced != $number) {
							$number = $replaced;
						} else {
							break;
						}
					}
					return $number;
				}
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM products ORDER BY product_id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php echo $row['product_name']; ?></td>
			
			<td><?php
			$pprice=$row['price'];
			echo formatMoney($pprice, true);
			?></td>
			
			<td><?php echo $row['qty']; ?></td>
			
			<td><center><a rel="facebox" href="editproduct.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-xs-2x"> Edit </a> <a rel="facebox" href="editproduct1.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-xs-2x"> Load qty </a> <a rel="facebox" href="productdetail.php?id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-xs-2x"> detail </a> </center></td></tr>
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
   url: "deleteproduct.php",
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