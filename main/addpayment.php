<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM sales WHERE transaction_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<script src="lib/jquery.js" type="text/javascript"></script>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
<form action="savepayment.php" method="post">
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />
Name<br><input type="text" name="name" value="<?php echo $row['name']; ?>"readonly /><br>
<br>
Old balance<br><input type="text" name="amount" value="<?php echo $row['amount']; ?>"onkeyup="sum();" Required /><br>
<br>
Add payment<br><input type="text" name="date" onkeyup="sum();" Required /><br>
<br>
New balance<br><input type="text" name="amount" value="<?php echo $row['amount']; ?>"readonly /><br>
<br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</div>
</form>
<?php
}
?>