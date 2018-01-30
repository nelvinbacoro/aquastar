<?php
session_start();
include('../connect.php');

$a = $_POST['customer_name'];
$b = $_POST['gal_qty'];
$c = $_POST['dateB'];
$f = ($_POST['daeR'] != "") ? $_POST['daeR'] : null;

$id = $_POST['borrow_id'];

if($id > 0){
    $sql = "UPDATE borrow set gal_qty=:b, dateB=:c, daeR=:f WHERE borrow_id=:id";
    $q = $db->prepare($sql);
    $q->execute(array(':b'=>$b,':c'=>$c,':f'=>$f, ':id'=>$id));
}else{
    $sql = "INSERT INTO borrow (customer_id,gal_qty,dateB,daeR) VALUES (:a,:b,:c,:f)";
    $q = $db->prepare($sql);
    $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':f'=>$f));
}



header("location:brw2.php");


?>