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
	<a rel="facebox" href="#"><img src="aqrlogo.png" style="width:250px; height:60px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<p>

<div class="container">

<div class="btn-group btn-group-sm">
	 	<a class="btn btn-default btn-lg disabled" href="sales.php?id=cash&invoice=<?php echo $finalcode ?>" style="float: none;">CASH</a>
	 	</div>

		<div class="btn-group btn-group-xs">
	 	<a class="btn btn-default btn-lg" href="sales1.php?id=credit&invoice=<?php echo $finalcode ?>" style="float: none;">CREDIT</a>
	 	</div>

		<div class="btn-group btn-group-xs">
	 	<a class="btn btn-default btn-lg" href="brw2.php" style="float: none;">DISBURSEMENT</a>
	 	</div>

		<br>
		<br>
<a class="btn btn-success btn-xs-2x" href="index.php" style="float: none;">Back</a>
<br>
<br>
<div class="jumbotron">
    <?php if(isset($_SESSION['qty_error'])): ?>
        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['qty_error']; ?></div>
    <?php unset($_SESSION['qty_error']); endif; ?>
<form action="incoming.php" method="post" >
<input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<select name="product" style="width: 520px;padding:8px 0;">
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM products");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?></option>
	<?php
	}
	?>
</select>
<input type="text" name="qty" value="" placeholder="Qty" autocomplete="off" style="width: 68px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
<input type="text" name="discount" value="" placeholder="Discount" autocomplete="off" style="width: 68px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
<input class="btn btn-primary btn-sm-2x" type="submit" value="Save" style="width: 123px;" />
</form>
<table id="resultTable" data-responsive="table">
	<thead>
		<tr>

			<th> Product Name </th>
			<th> Qty </th>
			<th> Price </th>
			<th> Discount </th>
			<th> Amount </th>
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

			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['qty']; ?></td>
			<td>
			<?php
			$ppp=$row['price'];
			echo formatMoney($ppp, true);
			?>
			</td>
			<td>
			<?php
			$ddd=$row['discount'];
			echo formatMoney($ddd, true);
			?>
			</td>
			<td>
			<?php
			$dfdf=$row['amount'];
			echo formatMoney($dfdf, true);
			?>
			</td>
			<td><a class="delbutton" href="delete.php?id=<?php echo $row['transaction_id']; ?>&invoice=<?php echo $_GET['invoice']; ?>&dle=<?php echo $_GET['id']; ?>&qty=<?php echo $row['qty'];?>&code=<?php echo $row['product'];?>"> Delete </a></td>
			</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="4"><strong style="font-size: 12px; color: #222222;">Total:</strong></td>
				<td colspan="2"><strong style="font-size: 12px; color: #222222;">
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
				$sdsd=$_GET['invoice'];
				$resultas = $db->prepare("SELECT sum(amount) FROM sales_order WHERE invoice= :a");
				$resultas->bindParam(':a', $sdsd);
				$resultas->execute();
				for($i=0; $rowas = $resultas->fetch(); $i++){
				$fgfg=$rowas['sum(amount)'];
				echo formatMoney($fgfg, true);
				}
				?>
				</strong></td>
			</tr>

	</tbody>
</table><br>
<a rel="facebox" class="btn btn-warning btn-xs-2x" href="checkoutnew.php?pt=<?php echo $_GET['id']?>&invoice=<?php echo $_GET['invoice']?>&total=<?php echo $fgfg ?>&cashier=<?php echo $_SESSION['SESS_FIRST_NAME']?>">Check Out</a>
<div class="clearfix"></div>
</div>
</div>
</body>
</html>