<!DOCTYPE html>
<html>
<head>
	<title>Registration Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
</head>
<body>
<div class="container bg-success"><br><br><br><br>
<div class="row"> 
	<form action="index.php">
<div class=" col-md-3">
              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i> Logout</button>
            </div> 
        </form>
<div class="col-lg-6 col-md-6 col-md-offset-3  col-lg-offset-3">  
<div class="table-responsive">
	<table class="table-bordered">
<thead>	
	<tr>
		<th>Name</th>
		<th>Images</th>
		<th>Action</th>
	</tr>
</thead>

<?php 
$con =	mysqli_connect("localhost","root","","start");


$sql="SELECT * From student";
$result = mysqli_query($con, $sql);
$i=1;
while ($row=mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$row['name']."</td>";
	?>
	<td><img src="images/<?php echo '$row['images']'; ?>" width="100px" height="100px"></td>
	<td><form method="post"><button class='btn btn-warning' name="Delete" value="<?php echo $row['id']; ?>">Delete</button></form></td>
	<?php
$i++;
}

 ?>
</tr>
</table>
</div>

</div>
</div>
</body>
</html>

<?php 
if (isset($_POST['Delete'])) {
$sql="DELETE From student Where id='".$_POST['Delete']."' ";
$result = mysqli_query($con, $sql);
if ($result) {
	echo "<script>alert('Are You Sure');location.href=''</script>";
}else{
	echo "<script>alert('Something Went Wrong') </script>";

}
}
 ?>