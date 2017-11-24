<?php
session_start();
include('../connect.php');
$a = $_POST['Fname'];
$b = $_POST['name'];
$c = $_POST['address'];
$e = $_POST['address2'];
$d = $_POST['contact'];

$sql = "INSERT INTO customer (customer_Fname,customer_name,address,address2,contact) VALUES (:a,:b,:c,:e,:d)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':e'=>$e,':d'=>$d));
header("location: cus-new.php");


?>