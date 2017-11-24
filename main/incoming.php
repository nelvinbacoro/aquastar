<?php
session_start();
include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['product'];
$c = $_POST['qty'];
$w = $_POST['pt'];
$product_qty = 0;
$discount = $_POST['discount'];
$result = $db->prepare("SELECT * FROM products WHERE product_name= :userid");
$result->bindParam(':userid', $b);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){
$asasa=$row['price'];
$name=$row['product_name'];
$product_qty = $row['qty'];
}
$remaining_qty = $product_qty - $c;

if($remaining_qty > 0){
    //edit qty
        $sql = "UPDATE products 
            SET qty=qty-?
            WHERE product_name=?";
        $q = $db->prepare($sql);
        $q->execute(array($c,$b));
        $fffffff=$asasa-$discount;
        $d=$fffffff*$c;
    // query
        $sql = "INSERT INTO sales_order (invoice,product,qty,amount,name,price,discount) VALUES (:a,:b,:c,:d,:e,:f,:g)";
        $q = $db->prepare($sql);
        $q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$name,':f'=>$asasa,':g'=>$discount));
    header("location: sales.php?id=$w&invoice=$a");

}else{
    $msg = "Insufficient Qty of Products. Product <strong>$name</strong> remaining qty is <strong>$product_qty</strong>";
    $_SESSION['qty_error'] = $msg;
    header("location: sales.php?id=$w&invoice=$a");
}

?>