<html>
<head>
<title>
AQS
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
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="src/facebox.js" type="text/javascript"></script>

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
<a rel="facebox" href="select.php"><img src="logo.png" style="width:63px; height:63px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<br>
<div class="container">
<a href="index.php" class="btn btn-success btn-xs-2x" style="float: none;">Back</a>
<br>
<br>
<a rel="facebox" href="productmng2.php" class="btn btn-default" style="float: right;" >delete sales report</a>
<a href="brwreport.php" class="btn btn-default" style="float: right;" >DISBURSEMENT report</a>
<a href="collection.php?d1=0&d2=0" class="btn btn-default" style="float: right;" >collection report</a>
<a href="salesreport.php?d1=0&d2=0" class="btn btn-default" style="float: right;" disabled>sales report</a>
<div class="jumbotron">
<form action="salesreport.php" method="get">
From : <input type="text" name="d1" class="tcal" value="" style="width: 300px" />
 To: <input type="text" name="d2" class="tcal" value="" style="width: 300px" /> 
 <input class="btn btn-info" type="submit" value="Search"><a class="btn btn-default btn-xs-2x" href="javascript:Clickheretoprint()">Print</a>
</form>
<input style="width:300px" type="text" name="filter" value="" id="filter" placeholder="Search..." autocomplete="off" />
<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
Sales Report from&nbsp;<?php echo $_GET['d1'] ?>&nbsp;to&nbsp;<?php echo $_GET['d2'] ?>
</div>

<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th> Sales ID </th>
			
			<th> Date </th>
			
			<th> Customer Name </th>
			
			<th> Amount </th>
			<th> Remarks </th>
			<th> Balance </th>
			
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$d1=$_GET['d1'];
				$d2=$_GET['d2'];
				$result = $db->prepare("SELECT * FROM sales WHERE date BETWEEN :a AND :b");
				$result->bindParam(':a', $d1);
				$result->bindParam(':b', $d2);
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php echo $row['transaction_id']; ?></td>
			
			<td><?php echo $row['date']; ?></td>
			
			<td><?php echo $row['name']; ?></td>
			
			<td><?php
			$dsdsd=$row['amount'];
			echo formatMoney($dsdsd, true);
			?></td>
			
			<td><?php echo $row['type']; ?></td>
			
			<td><?php echo $row['balance']; ?></td>
			
			</tr>
			<?php
				}
			?>
		
	</tbody>
	<thead>
		<tr>
			<th colspan="3" style="border-top:1px solid #999999"> Total </th>
			<th colspan="4" style="border-top:1px solid #999999"> 
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
				$results = $db->prepare("SELECT sum(amount) FROM sales WHERE date BETWEEN :a AND :b");
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
<div class="clearfix"></div>
</div>
</div>
</div>
</body>
</body>
</html>