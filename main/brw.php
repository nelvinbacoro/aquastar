<?php
    include('../connect.php');
    $brw_id = (isset($_GET['id'])) ? $_GET['id'] : 0;

    $qry = $db->prepare("SELECT * FROM borrow b
                          LEFT JOIN customer c ON c.customer_id = b.customer_id
                          WHERE b.borrow_id = :brw_id") ;
    $qry->bindParam(':brw_id', $brw_id);
    $qry->execute();
    $user = $qry->fetch();
?>
<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />

<form action="savebrw.php" method="post">
    <input type="hidden" name="borrow_id" value="<?php echo $brw_id; ?>" />
<div id="ac">
<center>
Customer Name
<br>
<select name="customer_name" style="width: 157px;" disabled="disabled">
<option>--select customer--</option>
	<?php
	    $result = $db->prepare("SELECT * FROM customer");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		<option value="<?php echo $row['customer_id']; ?>" <?php echo ($user['customer_id'] == $row['customer_id']) ? "selected" : ""; ?>><?php echo $row['customer_Fname']; ?> <?php echo $row['customer_name']; ?></option>
	<?php
	}
	?>
</select>
<br>
<br>
No. of Container
<br>
<input type="number" name="gal_qty" style="width: 155px;" value="<?php echo isset($user['gal_qty']) ? $user['gal_qty'] : ""; ?>"/><br>
<br>
<br>
Date Barrowed
<br>
<input type="date" name="dateB" value="<?php echo isset($user['dateB']) ? $user['dateB'] : ""; ?>" /><br>
<br>
<br>
Date Returned
<br>
<input type="date" name="daeR" value="<?php echo isset($user['daeR']) ? $user['daeR'] : ""; ?>" /><br>
<br>
<br>
<span>&nbsp;</span><input id="btn" type="submit" value="save" />
</center>
</div>
</form>