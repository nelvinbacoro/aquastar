<?php
include('config.php');
ob_start();
// Define $myusername and $mypassword 
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 
// To protect MySQL injection 
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($conn, $myusername);
$mypassword = mysqli_real_escape_string($conn, $mypassword);

$sql="SELECT * FROM user2 WHERE username='$myusername' and password='$mypassword'";
$result=mysqli_query($conn, $sql);
// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	session_start();
	$_SESSION['logged']="true";
	
header("location:salesreport2.php");
}
else {
echo "<script> alert('Wrong Username or Password') 
window.location='salesreport.php'
</script>";

}
ob_end_flush();
?>