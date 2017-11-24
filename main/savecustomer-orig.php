<?php
session_start();
include('../connect.php');
$a = $_POST['Fname'];
$b = $_POST['name'];
$c = $_POST['address'];
$d = $_POST['contact'];

$sql = "INSERT INTO customer (customer_Fname,customer_name,address,contact) VALUES (:a,:b,:c,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d));
header("location: cus-new.php");


?>