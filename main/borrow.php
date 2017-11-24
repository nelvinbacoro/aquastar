<?php
	require_once('auth.php');
?>
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
<html>
<head>
<title>
AQR
</title>
<style>
.nav-wrapper {
	background-color: #004080;
	color: white;
}
</style>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="../style01.css" media="screen" rel="stylesheet" type="text/css" />
<!--sa poip up-->
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
<a rel="facebox" href="#"><img src="logo.png" style="width:63px; height:63px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<p>

<div class="container">

<div class="btn-group btn-group-xs">
	 	<a class="btn btn-default btn-lg" href="sales.php?id=cash&invoice=<?php echo $finalcode ?>" style="float: none;">CASH</a>
	 	</div>
		
		<div class="btn-group btn-group-xs">
	 	<a class="btn btn-default btn-lg" href="sales1.php?id=credit&invoice=<?php echo $finalcode ?>" style="float: none;">CREDIT</a>
	 	</div>
		
		<div class="btn-group btn-group-sm">
	 	<a class="btn btn-default btn-lg disabled" href="sales1.php?id=credit&invoice=<?php echo $finalcode ?>" style="float: none;">SKEMBERDO</a>
	 	</div>
		
		<br>
		<br>
<a class="btn btn-success btn-xs-2x" href="index.php" style="float: none;">Back</a>
<br>
<br>
<div class="jumbotron">
<div style="background-color: #004080; width: 110px; height: 110px">
<a rel="facebox" href="borrow2.php" ><img src="gal.jpg" style="width: 100px; height: 100px; margin-left:4%; margin-top: 4%"/></a>
</div>
<table id="resultTable" data-responsive="table">
	<thead>
		<tr>
			
			<th> Customer Name </th>
			<th> No. of Gallon </th>
			<th> Date Borrowed </th>
			<th> Date Return </th>
			
			<th> Action </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				$id=$_GET['invoice'];
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM sales_order WHERE invoice= :userid");
				$result->bindParam(':userid', $id);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php echo $row['cust_name']; ?></td>
			<td><?php echo $row['gal_qty']; ?></td>
			<td><?php echo $row['dateB']; ?></td>
			<td><?php echo $row['dateR']; ?></td>
			<td><a class="delbutton" href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['product'];?>"> Delete </a></td>
			</tr>
			<?php
				}
			?>	
	</tbody>
</table><br>
<a rel="facebox" class="btn btn-warning btn-xs-2x" href="checkoutnew.php?pt=<?php echo $_GET['id']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME']?>">Check Out</a>
<div class="clearfix"></div>
</div>
</div>
</body>
</html>