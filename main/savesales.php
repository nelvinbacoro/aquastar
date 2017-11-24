<?php
session_start(); 

include('../connect.php');
$a = $_POST['invoice'];
$b = $_POST['cashier'];
$c = $_POST['date'];
$d = $_POST['ptype'];
$e = $_POST['amount'];
$cname = $_POST['cname'];
$sales_id = 0;

if($d=='credit') {
$f = $_POST['due'];
$sql = 'INSERT INTO sales (invoice_number,cashier,date,type,amount,due_date,name) VALUES (:a,:b,:c,:d,:e,:f,:g)';
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$cname));
$sales_id = $db->lastInsertId();
// header("location: preview.php?invoice=$a");
// exit();
}
if($d=='cash') {
$f = $_POST['cash'];
$sql = "INSERT INTO sales (invoice_number,cashier,date,type,amount,due_date,name) VALUES (:a,:b,:c,:d,:e,:f,:g)";
$q = $db->prepare($sql);
$q->execute(array(':a'=>$a,':b'=>$b,':c'=>$c,':d'=>$d,':e'=>$e,':f'=>$f,':g'=>$cname));
$sales_id = $db->lastInsertId();
// header("location: preview.php?invoice=$a");
// exit();
}
// query

if($_POST['delivery_location_name'] != ""){

	$olat = "7.0147022";
	$olng = "125.4973114";

	$loc = $_POST['delivery_location_name'];
	$lat = $_POST['delivery_lat'];
	$lng = $_POST['delivery_lng'];
	$distance = 0;
	$time = 0;

	$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$olat,$olng&destinations=$lat,$lng&language=en-EN&sensor=false");
	$data = json_decode($data);

	foreach($data->rows[0]->elements as $road) {
	    $time += $road->duration->value;
	    $distance += $road->distance->value;
	}

	var_dump(intval($sales_id));
	var_dump($loc);
	var_dump($lat);
	var_dump($lng);
	var_dump($distance);
	$sql = "INSERT INTO deliveries (sales_id, location, lat, lng, meters, free_meters, rate, fee) values ( :sales_id, :location, :lat, :lng, :meters, :free_meters, :rate, :fee)";
	$q = $db->prepare($sql);
	$free_meters = 1000; //meter unit
	$rate = 30; // 30php per exceeding km

	$q->execute(
		array(
			':sales_id'	=> intval($sales_id),
			':location'	=> $loc,
			':lat'		=> $lat,
			':lng'		=> $lng,
			':meters'	=> $distance,
			':free_meters'	=> $free_meters,
			':rate'		=> $rate,
			':fee'	=> floor( ($distance - $free_meters) / 1000) * $rate
		)
	);
}


header("location: preview.php?invoice=$a");
exit();

?>