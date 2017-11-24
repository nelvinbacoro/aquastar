<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];

$b = $_POST['name'];

$d = $_POST['price'];



$sql = "UPDATE products 
        SET product_name=?, price=?
		WHERE product_id=?";
$q = $db->prepare($sql);
$q->execute(array($b,$d,$id));
header("location: products.php");

?>