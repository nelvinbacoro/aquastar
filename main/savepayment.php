<?php
session_start();
include('../connect.php');
$a = $_POST['name'];
$g = $_POST['amount'];

// query
$sql = "INSERT INTO collection (name,amount) VALUES (:a,:g)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':g'=>$g);
header("location: payment.php");


?>