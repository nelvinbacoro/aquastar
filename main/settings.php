<?php
	
    include('../connect.php');
    $success = "";
    if(isset($_POST['update_settings'])){
    	foreach ($_POST['settings'] as $key => $value) {

    	    $val = $value;

    	    switch($key){
                case "office_location":
                    $val .= "|" . $_POST['office_lat'] . "|" . $_POST['office_lng'];
                    break;
                case "delivery_rate":
                    $val = number_format($val, 2);
                    break;
            }

    		$sql = "UPDATE settings SET value = '$val' WHERE name='$key'";
		    $result = $db->prepare($sql);
    		$result->execute();
            $success = "<div class=\"alert alert-success\"><strong>Success!</strong> Settings has been updated.</div>";
    	}

    }


    $query = "SELECT * FROM settings";

    $result = $db->prepare($query);
    $result->execute();
    $rs = $result->fetchAll(PDO::FETCH_ASSOC);
    $settings = array();
    foreach ($rs as $key => $value) {
        $settings[$value['name']] = $value['value'];
    }



?>
<style>
.nav-wrapper {
	background-color: #004080;
	color: white;
}
.jumbotronE {
    	background-color: #0055ff;
    }
.jumbotron {
    	background-color: #004080;
    	
		
    }

.tab-content {
		border-left: 1px solid #ddd;
		border-right: 1px solid #ddd;
		border-bottom: 1px solid #ddd;
		padding: 10px;
}

.nav-tabs {
	margin-bottom: 0;
}
h3 {
	color: white;
}
h4 {
	color: white;
}

	
</style>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
<link href="css/bootstrap-responsive.css" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<style>
	nav a{
		line-height: 50px;
		color: #fff;
	}
	.menu{
		    background: url(img/m.jpg) no-repeat;
		    width: 200px;
		    height: 200px;
		    float: left;
		    font-size: 32px;
		    color: #fff;
		    text-align: center;
		    padding: 40px 0px;
		    text-decoration: none;
	}

	.menu:hover, .menu:active{
		color: #fff;
		text-decoration: none;
	}

	.menu i{
		font-size: 66px;
		display: block;
	}
</style>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('a[rel*=facebox]').facebox({
      loadingImage : 'src/loading.gif',
      closeImage   : 'src/closelabel.png'
    })
  })
</script>
<?php
	require_once('auth.php');
?>
<nav class="navbar navbar-default">
<div class="nav-wrapper">
<center>
	<a rel="facebox" href="#"><img src="aqrlogo.png" style="width:250px; height:60px" /></a>
</center>
</div>
</nav>
<div class="container">

<br>
<a class="btn btn-success btn-xs-2x" href="index.php" style="float: none;">Back</a>

<br>
<br>
    <?php echo $success; ?>
	<form class="form-horizontal" method="POST">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-gear"></i> Site Settings</div>
			<div class="panel-body">
				<?php foreach($rs as $key=>$value):
                    $lat="";
				    $lng="";
				    if($value['name'] == "office_location"){
				        $v = explode("|", $value['value']);
				        $lat = $v[1];
				        $lng = $v[2];
				        $value['value'] = $v[0];
                    }
				 ?>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $value['label']; ?></label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control text-right" id="<?php echo $value['name']; ?>" name="settings[<?php echo $value['name']; ?>]" placeholder="<?php echo $value['label']; ?>"
				      	value="<?php echo $value['value']; ?>" />
				    </div>
                      <?php if($value['name'] == "office_location_lng"): ?>
                      </div>
                        <div class="form-group">
                        <label class="col-sm-3 control-label">&nbsp;</label>
                        <div class="col-sm-8 text-right">
                            Get Lat and Lng Coordinates <a href="https://www.latlong.net/" target="_blank">Here </a>
                        </div>
                      <?php endif; ?>
				  </div>
				<?php endforeach; ?>

			</div>
			<div class="panel-footer">
				<button type="submit" name="update_settings" class="btn btn-success pull-right" onclick="if(confirm('Save settings?')) return true; else return false;">Update</button>
				<div class="clearfix"></div>
			</div>
		</div>
	</form>
</div>

<script>
    function initMap() {

        var input = document.getElementById('office_location');
        var lat = document.getElementById('office_lat');
        var lng = document.getElementById('office_lng');
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
</html>