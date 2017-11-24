<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM sales where transaction_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditcustomer.php" method="post">
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
Name<br><input type="text" name="name" value="<?php echo $row['name']; ?>" /><br>
<br>
Address<br><input type="text" name="address" value="<?php echo $row['amount']; ?>" /><br>
<br>
Contact<br><input type="text" name="contact" value="<?php echo $row['date']; ?>" /><br>
<br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</div>
</form>
<?php
}
?>