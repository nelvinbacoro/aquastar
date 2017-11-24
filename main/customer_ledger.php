<html>
<head>
<title>
AQR
</title>
<style>
body {
  
	background:url(body5.png); 
}
</style>
<link href="../style2.css" media="screen" rel="stylesheet" type="text/css" />
<link href="../style4.css" media="screen" rel="stylesheet" type="text/css" />

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
<fieldset class="hd">
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><img src="logo.png" style="width:50px; height:50px" /></a>
<a href="../index.php" style="float: right"><img src="logout1.png" style="width:50px; height:50px" /></a>
</fieldset>
<br>
<br>
<br>
<br>
<br>
<fieldset class="ho">
<div id="maintable">
<div style="margin-top: -19px; margin-bottom: 21px;">
<a id="addd" href="cus-credit.php" style="float: none;">Back</a>
</div>
<?php
include('../connect.php');
$tftft=$_GET['cname'];
$resulta = $db->prepare("SELECT * FROM sales WHERE invoice_number= :a");
$resulta->bindParam(':a', $tftft);
$resulta->execute();
for($i=0; $rowa = $resulta->fetch(); $i++){
$name=$rowa['name'];
$amount=$rowa['amount'];
}
$resultas = $db->prepare("SELECT * FROM customer WHERE customer_name= :b");
$resultas->bindParam(':b', $name);
$resultas->execute();
for($i=0; $rowas = $resultas->fetch(); $i++){
echo 'Name : '.$rowas['customer_name'].'<br>';
echo 'Address : '.$rowas['address'].'<br>';
echo 'Contact : '.$rowas['contact'].'<br>';
}
?>

<table id="resultTable" data-responsive="table">
	<thead>
		<tr>
			<th> Transaction ID </th>
			<th> Date </th>
			<th> Invoice Number </th>
			<th> Name and Balance </th>
			<th> Payment </th>
			
			
		</tr>
	</thead>
	<tbody>
			<tr class="record">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			
			
			</tr>
			<?php
				$tftft=$_GET['cname'];
				$result = $db->prepare("SELECT * FROM collection WHERE name= :userid ORDER BY transaction_id ASC");
				$result->bindParam(':userid', $tftft);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td>TR-000<?php echo $row['transaction_id']; ?></td>
			<td><?php echo $row['date']; ?></td>
			<td><?php echo $row['invoice']; ?></td>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['amount']; ?></td>
			
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="4" style="border-top:1px solid #999999"> Total </th>
			<th colspan="2" style="border-top:1px solid #999999">
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
				$tftft=$_GET['cname'];
				$results = $db->prepare("SELECT sum(amount) FROM collection WHERE name= :userid ORDER BY transaction_id ASC");
				
				$results->bindParam(':userid', $tftft);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$dsdsd=$rows['sum(amount)'];
				echo formatMoney($dsdsd, true);
				}
				?>
				
			</th>
			</th>
			</tr>
			</thead>
</table>
<a rel="facebox" id="addd" href="addledger.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $amount; ?>" style="margin-top: 10px;">Add Payment</a><br><br>
<div class="clearfix"></div>
</div>
</fieldset>
</body>
</html>