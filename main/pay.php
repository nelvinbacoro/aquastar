<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM sales where transaction_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="customer_ledger.php" method="get">
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
<input type="hidden" name="cname" value="<?php echo $row['name']; ?>" />
<input type="hidden" name="credit" value="<?php echo $row['amount']; ?>" />

<span>&nbsp;</span><input id="btn" type="submit" value="Add payment" />
</div>
</form>

<?php
}
?>