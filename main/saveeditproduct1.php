<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];

$b = $_POST['qty'];

$d = $_POST['date_loaded'];



$sql = "UPDATE products 
        SET qty=?, date_loaded=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$d,$id));
header("location: products.php");

?>