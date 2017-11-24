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
<a href="cus-credit.php" class="btn btn-success btn-xs-2x" style="float: none;">Back</a>

<br>
<br>
<div class="jumbotron">
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
			<th> Payment </th>
			<th> Total Ammount Due </th>
			<th> Balance </th>
		</tr>
	</thead>
	<tbody>
			<tr class="record">
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><strong><?php echo $amount; ?></strong></td>
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
			<td><?php echo $row['amount']; ?></td>
			<td>&nbsp;</td>
			<td><?php echo $row['balance']; ?></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
</table>
<a rel="facebox" class="btn btn-primary btn-sm-2x" href="addledger-new.php?invoice=<?php echo $_GET['cname']; ?>&amount=<?php echo $amount; ?>" style="float: right">Add Payment</a><br><br>
<div class="clearfix"></div>
</div>
</div>
</body>
</html>