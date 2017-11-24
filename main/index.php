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
<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="sass/components/_buttons.scss"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="sass/components/_icons-material-design.scss"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/materialize.min.css">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
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
<?php
function createRandomPassword() {
	$chars = "003232303232023232023456789";
	srand((double)microtime()*1000000);
	$i = 0;
	$pass = '' ;
	while ($i <= 7) {

		$num = rand() % 33;

		$tmp = substr($chars, $num, 1);

		$pass = $pass . $tmp;

		$i++;

	}
	return $pass;
}
$finalcode='AS-'.createRandomPassword();
?>
<nav>
<div class="nav-wrapper">
<center>
<p>AQUASTAR</p>
</center>
<a href="../index.php"></a>
</div>
</nav>

<br>
<br>
<br>

<div class="container">
<?php
$position=$_SESSION['SESS_LAST_NAME'];
if($position=='Cashier') {
?>
<br>
<br>
<center>
<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><img src="trans.jpg" style="width: 300px; height: 300px" /></a>
<a href="delivery_pending.php"><img src="delivery.jpg" style="width: 300px; height: 300px" /></a>
</center>
<?php
}
if($position=='admin') {
?>

	<a href="sales.php?id=cash&invoice=<?php echo $finalcode ?>"><img src="trans.jpg" style="width: 220px; height: 300px" /></a>
	<a href="products.php"><img src="pro.jpg" style="width: 220px; height: 300px" /></a>
	<a href="cus-new.php"><img src="custo.jpg" style="width: 230px; height: 300px" /></a>
	<a href="salesreport.php?d1=0&d2=0"><img src="repo.jpg" style="width: 220px; height: 300px" /></a>
	<a href="delivery_pending.php"><img src="delivery.jpg" style="width: 220px; height: 300px" /></a>

<?php
}
?>
<div class="clearfix"></div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large red" href="../index.php" title="click to exit">
      <i class="large material-icons" alt="Exit" >power_settings_new</i>
    </a>
  </div>
</div>
