<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$b = $_POST['address'];
$c = $_POST['contact'];
$d = $_POST['order_qty'];
$e = $_POST['cdate'];
// query
$sql = "INSERT INTO customer (customer_name,address,contact,order_qty,cdate) VALUES (:a,:b,:c,:d,:e)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e));
header("location: customerpay.php");


?>