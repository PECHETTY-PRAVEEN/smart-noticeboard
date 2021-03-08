<?php

/*if(isset($_POST['user'])){

	session_start();
	$_SESSION['Name']=$_POST['user'];
	header("location: dashboard.php");
}
*/
$con=mysqli_connect("localhost","root","","start");
$username = $_POST['user'];
$password = $_POST['pwd'];

$username=stripcslashes($username);
$password=stripcslashes($password);
$username=mysqli_real_escape_string($con,$username);
$password=mysqli_real_escape_string($con,$password);




$result = mysqli_query($con,"select * from users1 where name ='$username' and password ='$password'");
$row= mysqli_fetch_array($result);
if ($row['name']==$username && $row['password']==$password) {
	echo "<script>location.href='dashboard.php'</script>";
}else{
	echo "<script type='text/javascript'>alert ('login failed');</script>"; ;
	echo "<script>location.href='index.php'</script>";

}

?>
