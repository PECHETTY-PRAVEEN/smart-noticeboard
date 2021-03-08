<?php
include "config.php";
if(isset($_POST['email'])){

	session_start();
	$_SESSION['email']=$_POST['email'];

}


$email = $_POST['email'];
$password = $_POST['pwd'];

$email=stripcslashes($email);
$password=stripcslashes($password);
$email=mysqli_real_escape_string($con,$email);
$password=mysqli_real_escape_string($con,$password);




$result = mysqli_query($con,"select * from users where email ='$email' and password ='$password'");
$row= mysqli_fetch_array($result);
if ($row['email']==$email && $row['password']==$password) {
	$_SESSION['type']=$row['type'];
	$_SESSION['name']=$row['username'];

	echo "<script>location.href='dashboard.php'</script>";
}else{
	echo "<script type='text/javascript'>alert ('login failed');</script>"; ;
	echo "<script>location.href='index.php'</script>";

}

?>
