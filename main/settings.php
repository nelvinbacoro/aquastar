<?php
	
    include('../connect.php'); 

    if(isset($_POST['update_settings'])){
    	foreach ($_POST['settings'] as $key => $value) {

    		$sql = "UPDATE settings SET value = '$value' WHERE name='$key'";
		    $result = $db->prepare($sql);
    		$result->execute();
    	}

    }


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
	<form class="form-horizontal" method="POST">
		<div class="panel panel-primary">
			<div class="panel-heading"><i class="fa fa-gear"></i> Site Settings</div>
			<div class="panel-body">
				<?php foreach($rs as $key=>$value): ?>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-3 control-label"><?php echo $value['label']; ?></label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control text-right" id="<?php echo $value['name']; ?>" name="settings[<?php echo $value['name']; ?>]" placeholder="Site Name" 
				      	value="<?php echo $value['value']; ?>" />
				    </div>
				  </div>
				<?php endforeach; ?>

			</div>
			<div class="panel-footer">
				<button type="submit" name="update_settings" class="btn btn-success pull-right">Update</button>
				<div class="clearfix"></div>
			</div>
		</div>
	</form>
</div>

</html>