
<form action="borrow3.php" method="post" >
<center>
<input type="hidden" name="pt" value="<?php echo $_GET['id']; ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
Customer Name
<br>
<select name="customer">
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
<select type="hidden" name="gal">
	<?php
	include('../connect.php');
	$result = $db->prepare("SELECT * FROM gal");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['gal_name']; ?>"><?php echo $row['gal_name']; ?></option>
	<?php
	}
	?>
</select>
<br>
<br>
No. of gallon
<br>
<input type="text" name="qty" value="" placeholder="Qty" autocomplete="off" style="width: 68px; padding-top: 6px; padding-bottom: 6px; margin-right: 4px;" />
<br>
<br>
Date Borrow
<br>
<input type="date" name="dateB" />
<br>
<br>
Date Return
<br>
<input type="date" name="dateR" />
<br>
<br>
<input class="btn btn-primary btn-sm-2x" type="submit" value="OK" style="width: 123px;" />
</center>
</form>