<?php
// configuration
include('../connect.php');

// new data
$id = $_POST['memi'];
$a = $_POST['Fname'];
$b = $_POST['name'];
$c = $_POST['address'];
$g = $_POST['address2'];
$d = $_POST['contact'];
$e = $_POST['memno'];
$f = $_POST['order_qty'];
$s = $_POST['status'];
// query
$sql = "UPDATE customer 
        SET customer_Fname=?, customer_name=?, address=?, address2=?, contact=?, membership_number=?, order_qty=?, status=?
		WHERE customer_id=?";
$q = $db->prepare($sql);
$q->execute(array($a,$b,$c,$g,$d,$e,$f,$s,$id));
header("location: cus-new.php");

?>