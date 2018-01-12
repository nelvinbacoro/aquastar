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
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            float: left;
            width: 100%;
            height: 100%;
        }
        #right-panel {
            margin: 20px;
            border-width: 2px;
            text-align: left;
            padding-top: 0;
        }
        #directions-panel {
            margin-top: 10px;
            background-color: #FFEE77;
            padding: 10px;
            overflow: scroll;
            height: 174px;
        }

        #infowindow-content .title {
            font-weight: bold;
        }

        #infowindow-content {
            display: none;
        }

        #map #infowindow-content {
            display: inline;
        }

        .pac-card {
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
            position: absolute;
            top: 0px;
            right: 0px;
            height: 100%;
            width: 30%;
            z-index: 999;
        }

        #pac-container {
                padding: 10px;
        }

        .pac-controls {
            display: inline-block;
            padding: 5px 11px;
        }

        .pac-controls label {
            font-family: Roboto;
            font-size: 13px;
            font-weight: 300;
        }

        #pac-input {
            background-color: #fff;
            font-family: Roboto;
            font-size: 15px;
            font-weight: 300;
            padding: 10px;
            width:100%;
            text-overflow: ellipsis;
        }

        #pac-input:focus {
            border-color: #4d90fe;
        }

        #title {
            color: #fff;
            background-color: #4d90fe;
            font-size: 25px;
            font-weight: 500;
            padding: 6px 12px;
        }
        td:last-child{
            text-align:right;
        }
    </style>
</head>
<body >

<div class="pac-card" id="pac-card">
    <div>
        <div id="title">Aquastar Delivery Calculator
        </div>
        
    </div>
    <div id="pac-container">
        <input id="pac-input" type="text"
               placeholder="Enter a location">
    </div>
    <div style="padding:10px;font-size;12px;">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Shipping Calculations</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Delivery Rate</td>
                    <td><?php echo ($settings['delivery_rate']) ? $settings['delivery_rate'] : 0;  ?></td>
                </tr>
                <tr>
                    <td>Free Distance</td>
                    <td><?php echo ($settings['free_distance']) ? $settings['free_distance']/1000 : 0;  ?> km</td>
                </tr>
                <tr>
                    <td>Total Distance</td>
                    <td><span id="distance">0.0</span></td>
                </tr>
                <tr>
                    <td>Total Delivery Fee</td>
                    <td><span id="charges">0.0</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="map"></div>
<div id="infowindow-content">
    <img src="" width="16" height="16" id="place-icon">
    <span id="place-name"  class="title"></span><br>
    <span id="place-address"></span>
</div>
<script>
    var deliveryLatLng = {};
    freeKm = <?php echo ($settings['free_distance']) ? $settings['free_distance'] : 0;  ?>; // meters
    oLat = <?php echo ($settings['office_location_lat']) ? $settings['office_location_lat'] : 0;  ?>; // meters
    oLng = <?php echo ($settings['office_location_lng']) ? $settings['office_location_lng'] : 0;  ?>; // meters
    var directionsService = null;
    var directionsDisplay = null;

    var map = null;

    function setMap(oLat, oLng, km){

        var myLatLng = {lat: oLat, lng: oLng}; //marker in toril area(midpoint)

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: myLatLng,
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: 'Aquastar Delivery!'
        });

        // Add circle overlay and bind to marker
        var circle = new google.maps.Circle({
            map: map,
            radius: km,    // 10 miles in metres
            strokeColor: '#05a239',
            strokeOpacity: 0.8,
            fillColor: '#36aa27',
            fillOpacity: 0.35,
        });
        circle.bindTo('center', marker, 'position');



        var card = document.getElementById('pac-card');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);

        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        directionsDisplay.setMap(map);
    }

    function setDeliveryLatLng(lat, lng, km, olat, olng){
        deliveryLatLng = {lat: lat, lng: lng, freeKm: km, oLat: olat, oLng: olng};
        setMap(olat, olng, km);
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

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: {lat: oLat, lng: oLng},
        });

        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            deliveryLatLng = {lat: place.geometry.location.lat(), lng: place.geometry.location.lng()};
            setDeliveryLatLng(place.geometry.location.lat(), place.geometry.location.lng(), freeKm, oLat, oLng)
        });

        setMap(oLat, oLng, freeKm);
        calculateAndDisplayRoute();

    }

    function calculateAndDisplayRoute() {


        var start = new google.maps.LatLng(deliveryLatLng.oLat,deliveryLatLng.oLng);
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
                var excess = Math.floor(km - (freeKm/1000));
                var rate = <?php echo ($settings['delivery_rate']) ? $settings['delivery_rate'] : 0;  ?>; // 30php per excess km

                var deliveryFee = (excess < 0) ? 0 : excess * rate;
                document.getElementById('distance').innerHTML = km.toFixed(2) + " kms";
                document.getElementById('charges').innerHTML = deliveryFee.toFixed(2);
            }

        });

    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5bT-zX0RPq99vBKgPTOEl-haME-YM1Ow&callback=initMap&sensor=false&libraries=places">
</script>
</body>
</html>