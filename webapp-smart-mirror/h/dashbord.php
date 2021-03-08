<?php 
$con =	mysqli_connect("localhost","root","","start");
if(!$con){
	echo "not connected";
}


?>



<!DOCTYPE html>
<html>
<head>
	<title>Dash Board</title>
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
			<div class=" col-md-3">
              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i> Logout</button>
            </div>
        </form>
			<div class="col-md-6 thumbnail text-center">
				<h3 class="text-center text-primary">Registration</h3><hr>
				<span class="text-center text-danger"><b>	</b></span>
				<form class="" method="post" enctype="multipart/form-data" action="fetch.php">
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" name="name" placeholder="Image Your Name" value="">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-3">
							<div class="input-group">
								<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="file" class="form-control" name="image" placeholder="Enter Your Name" value="" >
							</div>
						</div>
						<div class="clearfix"></div>
					</div>


					<button class="btn Submit btn-warning btn-sm"  type="submit" name="Submit"><i class="glyphicon glyphicon-send"></i> Submit</button>
					<button class="btn Submit btn-warning btn-sm" type="submit" name="save" ><i class="glyphicon glyphicon-send"></i> Delete</button>




				</form>	
				<div class="clearfix"></div>
			</div>
		</div>

	</body>
	</html>


	<?php

	if (isset($_POST['Submit'])) {
		$name=$_POST['name'];
		$image_name = $_FILES['image']['name'];
		$image_type = $_FILES['image']['type'];
		$target = "images/";

		$ext = pathinfo($image_name,PATHINFO_EXTENSION);
		$allowTypes = array('jpg','png','jpeg','gif');
		if (in_array($ext, $allowTypes)) {
			$move=move_uploaded_file($_FILES['image']['tmp_name'], $target.$image_name);
			if ($move) {
				$insert="INSERT INTO `student` (`name`,`images`) VALUES ('$name', '$image_name')";
				$result = mysqli_query($con, $insert);

				if($result){
					echo "<script>alert('success')</script>";
				}
				else{
					echo "<script>alert('Not success')</script>";
				}

			}else{
				echo "condtion is wrong";
			}
		}else{
			echo "Your Image formate is worng";
		}
	}


	?>

