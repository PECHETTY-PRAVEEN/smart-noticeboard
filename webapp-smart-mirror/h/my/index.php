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
				<form class="" method="post" action="process.php">
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
								<input class="form-control" type="text" id="user" name="user"/>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-eye-open"></i></span>
								<input class="form-control" type="Password" id="pwd" name="pwd">
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