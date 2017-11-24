<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
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
            /*display:none; /*AUTO SEARCH*/ 
            margin: 10px;
            border-radius: 2px 0 0 2px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            background-color: #fff;
            font-family: Roboto;
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
            padding: 10px 0;
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
    </style>
</head>
<body >

<div class="pac-card" id="pac-card">
    <div>
        <div id="title">
            Autocomplete search
        </div>
        
    </div>
    <div id="pac-container">
        <input id="pac-input" type="text"
               placeholder="Enter a location">
    </div>
    <div style="padding:10px;font-size;12px;">
        <p>Delivery Fee is free within <strong>1 km</strong> from the office.</p>
        <p>Charges: 30 Php (every exceeding 1km)</p>
        Distance: <span id="distance">0</span>
        Delivery Fee: <span id="duration">0</span>
    </div>
</div>
<div id="map"></div>
<div id="infowindow-content">
    <img src="" width="16" height="16" id="place-icon">
    <span id="place-name"  class="title"></span><br>
    <span id="place-address"></span>
</div>
<script>
    var deliverryLatLng = {};
    var freeKm = 1000; // meters
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        //var directionsDisplay = new google.maps.DirectionsRenderer;

        var directionsDisplay = new google.maps.DirectionsRenderer({
            polylineOptions: {
                strokeColor: "orange"
            }
        });
        var myLatLng = {lat: 7.0147022, lng: 125.4973114}; //marker in toril area(midpoint)

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 16,
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
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        //map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);
        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });


        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(false);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);

            deliverryLatLng = {lat: place.geometry.location.lat(), lng: place.geometry.location.lng()};

            calculateAndDisplayRoute(directionsService, directionsDisplay);
        });

        directionsDisplay.setMap(map);
        calculateAndDisplayRoute(directionsService, directionsDisplay);

    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {

            var start = new google.maps.LatLng(7.0147022,125.4973114);
            var end = new google.maps.LatLng(deliverryLatLng.lat,deliverryLatLng.lng);
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
                    var rate = 30; // 30php per excess km

                    var deliveryFee = (excess < 0) ? 0 : excess * rate;


                    document.getElementById('distance').innerHTML = (totalDistance/1000) + " kms";
                    document.getElementById('duration').innerHTML = deliveryFee.toFixed(2);
                }

            });

    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5bT-zX0RPq99vBKgPTOEl-haME-YM1Ow&callback=initMap&sensor=false&libraries=places">
</script>
</body>
</html>