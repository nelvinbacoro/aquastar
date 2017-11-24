<? php
include('config.php');
?>
<!doctype html>
<html>
<head>
  <title>SIS</title>
  <link rel="stylesheet" type="text/css" href="./css/mystyles.css">
</head>
<body>
<center>
<header><img src="./image/header.jpg"></header>
<hr />
<br />
<fieldset style="float: center; width: 400px; height: 110px; background-color: green">
<form method="post" action="checklogin.php">
<div class="text">
    <label for="username">User Name</label> 
    <input type="text" size="25" name="username" id="name"/> 
</div> 

<div class="text"> 
    <label for="password">Password</label> 
    <input type="password" size="25" name="password" id="password"/> 
</div> 

<div > 
    <input type="submit" value="submit" /> 
</div>
</form>
</fieldset>
</center> 
 
</body>
</html>
