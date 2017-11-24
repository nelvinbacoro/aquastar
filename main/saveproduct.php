<?php
session_start();
include('../connect.php');

$b = $_POST['name'];

$d = $_POST['price'];


$sql = "INSERT INTO products (product_name,price) VALUES (:b,:d)";
$q = $db->prepare($sql);
$q->execute(array(':b'=>$b,':d'=>$d));
header("location: products.php");


?>