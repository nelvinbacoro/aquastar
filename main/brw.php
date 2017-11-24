
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savebrw.php" method="post">
<div id="ac">
<center>
Customer Name
<br>
<select name="customer_name" style="width: 157px;">
<option>--select customer--</option>
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM customer");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['customer_Fname']; ?> <?php echo $row['customer_name']; ?>"><?php echo $row['customer_Fname']; ?> <?php echo $row['customer_name']; ?></option>
	<?php
	}
	?>
</select>
<br>
<br>
No. of Container
<br>
<input type="number" name="gal_qty" style="width: 155px;"/><br>
<br>
<br>
Date Barrowed
<br>
<input type="date" name="dateB" /><br>
<br>
<br>
Date Returned
<br>
<input type="date" name="daeR" /><br>
<br>
<br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</center>
</div>
</form>