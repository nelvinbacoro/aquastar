<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM customer WHERE customer_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>

<style>
	
#fs {
	font-size: 20px;
}

</style>

<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="saveeditcustomer.php" method="post">
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
Name<br><input type="text" name="name" value="<?php echo $row['customer_name']; ?>" id="fs" /><br>
<br>
Address<br><input type="text" name="address" value="<?php echo $row['address']; ?>" id="fs" /><br>
<br>
Contact<br><input type="text" name="contact" value="<?php echo $row['contact']; ?>" id="fs" /><br>
<br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</div>
</form>
<?php
}
?>