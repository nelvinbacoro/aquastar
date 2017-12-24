<?php
session_start(); 

include('../connect.php');

$query = "SELECT * FROM settings";

$result = $db->prepare($query);
$result->execute();
$rs = $result->fetchAll(PDO::FETCH_ASSOC);
$settings = array();
foreach ($rs as $key => $value) {
    $settings[$value['name']] = $value['value'];
}



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

	$olat = $settings['office_location_lat'];
	$olng = $settings['office_location_lng'];

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
	

	$sql = "INSERT INTO deliveries (sales_id, location, lat, lng, office_lat, office_lng, meters, free_meters, rate, fee) values ( :sales_id, :location, :lat, :lng, :olat, :olng, :meters, :free_meters, :rate, :fee)";
	$q = $db->prepare($sql);
	$free_meters = $settings['free_distance']; //meter unit
	$rate = $settings['delivery_rate']; // 30php per exceeding km

    $fee = floor( ($distance - $free_meters) / 1000) * $rate;

	$q->execute(
		array(
			':sales_id'	=> intval($sales_id),
			':location'	=> $loc,
			':lat'		=> $lat,
			':lng'		=> $lng,
            ':olat'		=> $olat,
            ':olng'		=> $olng,
			':meters'	=> $distance,
			':free_meters'	=> $free_meters,
			':rate'		=> $rate,
			':fee'	=>  ($fee < 0) ? 0 : $fee
		)
	);
}


header("location: preview.php?invoice=$a");
exit();

?>