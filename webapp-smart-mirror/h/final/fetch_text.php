<!DOCTYPE html>
<html>
<head>

	
	<title>Admin Page</title>
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
<div class=" col-md-1">
              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i> Logout</button>
            </div> 
        </form>
    <form action="fetch.php">
<div class=" col-md-3">
              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i>  Dashboard</button>
            </div> 
        </form>
<div class="col-lg-6 col-md-6 col-md-offset-3  col-lg-offset-3">  
<div class="table table-striped">
	<table class="table-bordered" align="left" id="table1" style="text-align:center;">
<thead>	
	<tr>
		<th width="25%" >  s no  </th>
		<th width="50%">  Data   </th>
		<th width="50%">  Action  </th>
	</tr>
</thead>

<?php 
$con =	mysqli_connect("localhost","root","","start");


$sql="SELECT * From txt_data ORDER BY id DESC";
$result = mysqli_query($con, $sql);
$i=1;
while ($row=mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$i."</td>";
	echo "<td>".$row['txt']."</td>";
		
	?>
	<td height="100px" ><form method="post"><button class='btn btn-warning' name="Delete" value="<?php echo $row['ID']; ?>">Delete</button></form></td>
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
$sql="DELETE From txt_data Where ID='".$_POST['Delete']."' ";
$result = mysqli_query($con, $sql);
if ($result) {
	echo "<script>alert('Deleted successfully');location.href=''</script>";
}else{
	echo "<script>alert('Something Went Wrong') </script>";

}
}
 ?>