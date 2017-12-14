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
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script language="javascript">
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}
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
<br>
<div class="container">
<a class="btn btn-success btn-xs-2x" href="index.php" style="float: none;">Back</a>
<br>
<br>
<a href="brwreport.php" class="btn btn-default" style="float: right;" >DISBURSEMENT report</a>
<a href="collection.php?d1=0&d2=0" class="btn btn-default" style="float: right;" disabled>collection report</a>
<a href="salesreport.php?d1=0&d2=0" class="btn btn-default" style="float: right;" >sales report</a>
<div class="jumbotron">
<form action="collection.php" method="get">
From : <input type="text" name="d1" class="tcal" style="width: 300px" value="" /> 
To: <input type="text" name="d2" class="tcal" style="width: 300px" value="" /> 
<input class="btn btn-info" type="submit" value="Search"> <a class="btn btn-default btn-xs-2x" href="javascript:Clickheretoprint()">Print</a>
</form>
<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
Collection Report from&nbsp;<?php echo $_GET['d1'] ?>&nbsp;to&nbsp;<?php echo $_GET['d2'] ?>
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th width="17%"> Transaction ID </th>
			<th width="8%"> Date </th>
			
			<th width="20%"> Invoice Number </th>
			<th width="10%"> Amount </th>
			<th width="10%"> Remarks </th>
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result = $db->prepare("SELECT * FROM collection WHERE date BETWEEN :a AND :b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			<td>CTI-000<?php echo $row['transaction_id']; ?></td>
			<td><?php echo $row['date']; ?></td>
			
			<td><?php echo $row['invoice']; ?></td>
			<td><?php
			$dsdsd=$row['amount'];
			echo formatMoney($dsdsd, true);
			?></td>
			<td><?php echo $row['remarks']; ?></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total </th>
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
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$results = $db->prepare("SELECT sum(amount) FROM collection WHERE date BETWEEN :a AND :b");
				$results->bindParam(':a', $d1);
				$results->bindParam(':b', $d2);
				$results->execute();
				for($i=0; $rows = $results->fetch(); $i++){
				$dsdsd=$rows['sum(amount)'];
				echo formatMoney($dsdsd, true);
				}
				?>
			</th>
		</tr>
	</thead>
</table>
</div>
<div class="clearfix"></div>
</div>
</div>
</fieldset>
</body>
</html>