<?php
	//Start session test commit
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>
<html>
<head>
<title>
AQR
</title>
<meta charset="utf-8">
<style>

.tab-content {
		border-left: 1px solid #ddd;
		border-right: 1px solid #ddd;
		border-bottom: 1px solid #ddd;
		padding: 10px;
}

.nav-tabs {
	margin-bottom: 0;
}
.t {
	text-align: center;
}
.nav-wrapper {
	background-color: #004080;
    	color: white;
}
.jumbotron1
{
	width: 30%;
}

</style>
<link rel="stylesheet" href="css/materialize.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<nav>
<div class="nav-wrapper">
<center>
	<a rel="facebox" href="#"><img src="aqrlogo.png" style="width:250px; height:60px" /></a>
</center>

</div>
</nav>
<br>
<br>
<div class="container">
<div class="page-header">
<div class="jumbotron">
<?php
if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
	foreach($_SESSION['ERRMSG_ARR'] as $msg) {
		echo '<div style="color: red; text-align: center;">',$msg,'</div><br>'; 
	}
	unset($_SESSION['ERRMSG_ARR']);
}
?>
<br>
<br>
<center>
<div class="jumbotron1">
<form action="login.php" method="post">

Username<input placeholder="Enter username" class="t" type="text" name="username" />
Password<input placeholder="Enter password" class="t" type="password" name="password" />
&nbsp;<input class="btn btn-lg btn-primary" type="submit" value="Login" />
</form>
</div>
</center>
</div>
</div>
</div>

<script src="js/jquery.min.js"></script>
      <script src="js/materialize.min.js"></script>
</body>
</html>