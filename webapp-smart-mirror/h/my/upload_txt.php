<!DOCTYPE html>
<html>
<head>
	<title>Upload Text</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
</head>

<body>


	
	<div class="container bg-primary" id="bg">
		<div class="row">
			<form action="index.php">
				<br><br>
			<div class=" col-md-3">
              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i> Logout</button>
            </div>

        </form>
			<div class="col-md-6 thumbnail text-center">
				<h3 class="text-center text-primary">Upload Text</h3><hr>
				<span class="text-center text-danger"><b>	</b></span>
				<form action="#" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input class="form-control" type="text" name="txt" id="txt"><br><br>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
<input class="btn Submit btn-warning btn-sm" type="submit" value="submit" name="submit">
</form>
				<div class="clearfix"></div>
			</div>
		</div>

	</body>
	</html>
<?php 
$con=mysqli_connect("localhost","root","","start");
    if(isset($_POST['submit'])){
    	

    		$txt=$_POST['txt'];
             $insert="INSERT INTO `txt_data` (`txt`) VALUES ('$txt')";
				$result = mysqli_query($con, $insert);

				if($result){
					echo "<script>alert('success')</script>";
					echo "<script>location.href='fetch_text.php'</script>";

				}
				else{
					echo "<script>alert('Not success')</script>";
					echo "<script>location.href='fetch.php'</script>";
				}
	}
?>