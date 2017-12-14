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
First Name<br><input type="text" name="Fname" value="<?php echo $row['customer_Fname']; ?>" id="fs" /><br>
<br>
Last Name<br><input type="text" name="name" value="<?php echo $row['customer_name']; ?>" id="fs" /><br>
<br>
Permanent Address<br><input type="text" name="address" value="<?php echo $row['address']; ?>" id="fs" /><br>
<br>
Billing Address<br><input type="text" name="address2" value="<?php echo $row['address2']; ?>" id="fs" /><br>
<br>
Contact<br><input type="number" name="contact" value="<?php echo $row['contact']; ?>" id="fs" /><br>
    <br>
    Status<br><select name="status" style="display:block;">
        <option value="0" <?php echo ($row['status']==0) ? "selected":""; ?>>Inactive</option>
        <option value="1" <?php echo ($row['status']==1) ? "selected":""; ?>>Active</option>
    </select><br>
<br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</div>
</form>
<?php
}
?>