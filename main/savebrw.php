<?php
session_start();
include('../connect.php');

$a = $_POST['customer_name'];
$b = $_POST['gal_qty'];
$c = $_POST['dateB'];
$f = $_POST['daeR'];



$sql = "INSERT INTO borrow (customer_name,gal_qty,dateB,daeR) VALUES (:a,:b,:c,:f)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':f'=>$f));
header("location:brw2.php");


?>