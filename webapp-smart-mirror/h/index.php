
<?php 

session_start();
if (!empty($_SESSION['id'])) {
	echo "<script>location.href='index.php'</script>";
}
$error	=	"";


$con =	mysqli_connect("localhost","root","","start");
if(!$con){
	echo "Database Not connect";
}

if(isset($_POST['Submit']))
{


	$email=$_POST['email'];
	$password=$_POST['password'];
	$query ="select * From users1 where email = '".$email."' AND password = '".$password."'";
	$result = mysqli_query($con, $query);
	$fetch =mysqli_fetch_array($result);
	$row =mysqli_num_rows($result);
	if($row==1)
	{
			$type=$fetch['type'];

			$_SESSION['email']=$email;
			$_SESSION['name']=$name;
			$_SESSION['password']= $password;
			$_SESSION['type']= $type;

			echo "<script>location.href='fetch.php'</script>";
			die();
		}

	// else if ($fetch($_SESSION['type'])=="user")
	// {

	// 	echo "<script>location.href='users.php'</script>";
	// }
	else{
 		echo "<script>location.href='index.php'</script>";

	}


}





 ?>

<!DOCTYPE html>
<html>
<head>
	<title>LogIn Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<script type="text/javascript">

		$(document).ready(function () {
			$(".Submit").click(function (e) {
				$('input').each(function() {
					if ($.trim($(this).val()).length == 0) {
						$(this).focus();
						$(this).css("border", "1px solid #f00")
						alert('Please fill out all required fields.');
						e.preventDefault();
						return false;
					} 
					else if ($(this).val().length > 0) {
						$(this).css("border","1px solid #88d")
					}

				})
				if ($("#password").val()="") {
					$("#password").css("border","1px solid #f00");
					alert('Password incorrect')
					e.preventDefault();
				}
			})
		})
	</script>

</head>

<body>

<br><br>

	<div class="container bg-primary" style="height: 1000px">
		<br><br>
<br><br>
<br><br>
<br><br>
<br><br>

		<div class="row">
			<div class="col-md-6 col-md-offset-3 thumbnail text-center">
				<h3 class="text-center text-primary">Login</h3><hr>
				<span class="text-center text-primary"></span>
				<form class="" method="post" action="dashbord.php">
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input type="email" class="form-control" name="email" placeholder="Enter Your Email" value=" ">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
								<input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" value="">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<button class="btn Submit btn-warning btn-sm" id="submit" name="Submit"><i class="glyphicon glyphicon-send"></i> Login</button>
				</form>	

				<div class="clearfix"></div>
			</div>
		</div>

	</body>
	</html>