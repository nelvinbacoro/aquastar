<?php 
    include('../connect.php'); 

    $query = "SELECT * FROM settings";

    $result = $db->prepare($query);
    $result->bindParam(':a', $d1);
    $result->bindParam(':b', $d2);
    $result->execute();
    $rs = $result->fetchAll(PDO::FETCH_ASSOC);
    $settings = array();
    foreach ($rs as $key => $value) {
        $settings[$value['name']] = $value['value'];
    }

?>
<html>
<head>
<title>
AQS
</title>
<style>
body {
  
	background:url(body5.png); 
}
.nav-wrapper {
	background-color: #004080;
	color: white;
}

        #map {
            float: left;
            width: 100%;
            height: 350px;
        }
</style>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/materialize.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="../style01.css" media="screen" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>

</head>
<body>
<nav>
<div class="nav-wrapper">
<center>
    <a rel="facebox" href="#"><img src="aqrlogo.png" style="width:250px; height:60px" /></a>
</center>
<a href="../index.php"></a>
</div>
</nav>
<br>
<div class="container">
<a href="index.php" class="btn btn-success btn-xs-2x" style="float: none;">Back</a>
<br>
<br>
<div class="jumbotron">

<div id="map"></div>
<div id="infowindow-content">
    <img src="" width="16" height="16" id="place-icon">
    <span id="place-name"  class="title"></span><br>
    <span id="place-address"></span>
</div>

<hr />
<div class="content" id="content">
<div style="font-weight:bold; text-align:center;font-size:14px;margin-bottom: 15px;">
Deliveries
</div>

<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th> Tracking #</th>
			<th> Sales ID </th>
			<th> Date </th>
			<th> Customer Name </th>
			<th style="width:250px;"> Delivery Location </th>
			
			<!-- <th style="text-align:right;"> Free </th> -->
			<th style="text-align:right;"> Distance </th>
			<th style="text-align:right;"> Delivery Fee </th>
			<th style="text-align:right;"> Status </th>
			<th>Actions</th>
			
		</tr>
	</thead>
	<tbody>
		
			<?php
				include('../connect.php');
				$result = $db->prepare("SELECT * FROM deliveries LEFT JOIN sales ON sales.transaction_id = deliveries.sales_id WHERE status = 0  ORDER BY deliveries.id DESC");
				$result->execute();
				for($i=0; $row = $result->fetch(); $i++){
			?>
			<tr class="record">
			
			<td><?php echo str_pad($row['id'],6,"0",STR_PAD_LEFT); ?></td>
			<td><?php echo str_pad($row['transaction_id'],6,"0",STR_PAD_LEFT); ?></td>
			
			<td><?php echo $row['date']; ?></td>
			
			<td><?php echo $row['name']; ?></td>
			<td style="width:250px;"><?php echo $row['location']; ?></td>
			
			<!-- <td style="text-align:right;"><?php echo number_format($row['free_meters'] / 1000, 2); ?> km</td>-->
			<td style="text-align:right;"><?php echo number_format($row['meters'] / 1000, 2); ?> km</td> 
			<td style="text-align:right;"><?php
			echo number_format($row['fee'], 2);
			?></td>
			
			
			<td style="text-align:right;"><?php echo ($row['status'] == 0) ? "Processing..." : $row['status']; ?></td>
			<td><a target="_window" href="javascript:setDeliveryLatLng(<?php echo $row['lat']; ?>,<?php echo $row['lng']; ?>)">View Map</a></td>
			</tr>
			<?php
				}
			?>
		
	</tbody>

</table>
<div class="clearfix"></div>
</div>
</div>
</div>

<script>
    var deliveryLatLng = {};
    var freeKm = <?php echo ($settings['free_distance']) ? $settings['free_distance'] : 0;  ?>; // meters
    var directionsService = null;
    var directionsDisplay = null;

    function setDeliveryLatLng(lat, lng){
    	deliveryLatLng = {lat: lat, lng: lng};
        calculateAndDisplayRoute();
    }

    function initMap() {
        directionsService = new google.maps.DirectionsService;
        //var directionsDisplay = new google.maps.DirectionsRenderer;

        directionsDisplay = new google.maps.DirectionsRenderer({
            polylineOptions: {
                strokeColor: "orange"
            }
        });
        var myLatLng = {lat: <?php echo ($settings['office_location_lat']) ? $settings['office_location_lat'] : 0;  ?>, lng: <?php echo ($settings['office_location_lng']) ? $settings['office_location_lng'] : 0;  ?>}; //marker in toril area(midpoint)

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: myLatLng,
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Hello World!'
        });

        // Add circle overlay and bind to marker
        var circle = new google.maps.Circle({
            map: map,
            radius: freeKm,    // 10 miles in metres
            strokeColor: '#05a239',
            strokeOpacity: 0.8,
            fillColor: '#36aa27',
            fillOpacity: 0.35,
        });
        circle.bindTo('center', marker, 'position');


        var card = document.getElementById('pac-card');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });



        directionsDisplay.setMap(map);
        calculateAndDisplayRoute();

    }

    function calculateAndDisplayRoute() {

            var start = new google.maps.LatLng(7.0147022,125.4973114);
            var end = new google.maps.LatLng(deliveryLatLng.lat,deliveryLatLng.lng);
            var request = {
                origin: start,
                destination: end,
                optimizeWaypoints: true,
                provideRouteAlternatives: true,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function (response, status) {

                if (status == google.maps.DirectionsStatus.OK) {

                    var distance = null;
                    var routeIndex = 0;

                    // Loop through the routes to find the shortest one
                    for (var i=0; i<response['routes'].length; i++) {

                        var routeDistance = response['routes'][i].legs[0].distance.value;

                        if (distance === null) {

                            distance = routeDistance;
                            routeIndex = i;
                        }

                        if (routeDistance < distance) {

                            distance = routeDistance;
                            routeIndex = i;
                        }
                    }

                    directionsDisplay.setDirections(response);

                    // Set route index
                    directionsDisplay.setOptions({
                        routeIndex: routeIndex
                    });


                    var totalDistance = 0;
                    var totalDuration = 0;
                    var legs = response.routes[routeIndex].legs;
                    for(var i=0; i<legs.length; ++i) {
                        totalDistance += legs[i].distance.value;
                        totalDuration += legs[i].duration.value;
                    }

                    var km = totalDistance/1000;
                    var excess = Math.floor(km - (freeKm/1000));console.log(excess);
                    var rate = <?php echo ($settings['delivery_rate']) ? $settings['delivery_rate'] : 0;  ?>; // 30php per excess km

                    var deliveryFee = (excess < 0) ? 0 : excess * rate;
                	console.log(km, deliveryFee);
                }

            });

    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5bT-zX0RPq99vBKgPTOEl-haME-YM1Ow&callback=initMap&sensor=false&libraries=places">
</script>
</body>
</html>