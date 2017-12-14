<?php 
	include('../connect.php'); ?>
<html>
<head>
<title>Checkout</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>
<script>
function suggest(inputString){
		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#country').addClass('load');
			$.post("autosuggestname.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#country').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#country').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>

<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	border: 1px solid #999;
	background: #EEEEEE;
	padding: 5px 10px;
	box-shadow:0 1px 2px #ddd;
    -moz-box-shadow:0 1px 2px #ddd;
    -webkit-box-shadow:0 1px 2px #ddd;
}
.suggestionsBox {
	position: absolute;
	left: 10px;
	margin: 0;
	width: 268px;
	top: 40px;
	padding:0px;
	background-color: #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
}
.combopopup{
	padding:3px;
	width:268px;
	border:1px #CCC solid;
}

</style>	
</head>
<body onLoad="document.getElementById('country').focus();">
<form action="savesales.php" method="post" style="width:500px;">
<div id="ac">

<h4>Delivery Details</h4>

 <input type="text" id="delivery_location" name="delivery_location_name" placeholder="Enter a location" style="width: 100%; margin-bottom: 15px;padding: 8px;" /><br>
 <input type="hidden" id="delivery_lat" name="delivery_lat" required="required" />
 <input type="hidden" id="delivery_lng" name="delivery_lng" required="required" />

<hr />

<input type="hidden" name="date" value="<?php echo date("m/d/Y"); ?>" />
<input type="hidden" name="invoice" value="<?php echo $_GET['invoice']; ?>" />
<input type="hidden" name="amount" value="<?php echo $_GET['total']; ?>" />
<input type="hidden" name="ptype" value="<?php echo $_GET['pt']; ?>" />
<input type="hidden" name="cashier" value="<?php echo $_GET['cashier']; ?>" />
<h4>Payment Details</h4>
<select type="text" name="cname" style="width: 100%;padding: 5px;margin:5px 0;" required="required">
<option value="">--select customer--</option>
	<?php
	$result = $db->prepare("SELECT * FROM customer");
		$result->bindParam(':userid', $res);
		$result->execute();
		for($i=0; $row = $result->fetch(); $i++){
	?>
		
		<option value="<?php echo $row['customer_name']; ?>"><?php echo $row['customer_Fname']; ?> <?php echo $row['customer_name']; ?></option>
	<?php
	}
	?>
</select>
      <div class="suggestionsBox" id="suggestions" style="display: none;">
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
      </div>
<?php
$asas=$_GET['pt'];
if($asas=='credit') {
?><input type="text" name="due" placeholder="credit" style="width: 100%; margin-bottom: 15px;" required="required" autocomplete="off" /><br>
<?php
}
if($asas=='cash') {
?><input type="number" name="cash" placeholder="Cash" style="text-align:left;width: 100%; padding: 5px; margin-bottom: 15px;" autocomplete="off" required="required" /><br>
<?php
}
?>
<input id="btn" type="submit" value="save" style="width: 100%;" />
</div>
</form>

<script>
    var deliverryLatLng = {};
    var freeKm = 1000; // meters
    function initMap() {

        var input = document.getElementById('delivery_location');
        var lat = document.getElementById('delivery_lat');
        var lng = document.getElementById('delivery_lng');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            lat.value = place.geometry.location.lat();
            lng.value = place.geometry.location.lng();

        });


    }

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5bT-zX0RPq99vBKgPTOEl-haME-YM1Ow&callback=initMap&sensor=false&libraries=places">
</script>
</body>
</html>