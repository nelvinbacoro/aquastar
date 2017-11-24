<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("SELECT * FROM products WHERE product_id= :userid");
	$result->bindParam(':userid', $id);
	$result->execute();
	for($i=0; $row = $result->fetch(); $i++){
?>
<style>
	
#fs {
	font-size: 20px;
}

</style>
<link rel="stylesheet" href="../css/materialize.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<form action="saveeditproduct1.php" method="post">
<div id="ac">
<input type="hidden" name="memi" value="<?php echo $id; ?>" />

<span>update Qty : </span><input type="text" name="qty" id="fs" value="<?php echo $row['qty']; ?>" /><br>

<span>Date load : </span><input type="date" name="date_loaded" id="fs" value="<?php echo $row['date_loaded']; ?>" /><br>


<span>&nbsp;</span><input id="btn btn-success btn-xs-2x" type="submit" value="save" />
</div>
</form>
<?php
}
?>