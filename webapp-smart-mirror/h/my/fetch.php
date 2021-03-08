<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		th{
			text-align: right;
		}


	</style>
	
	<title>Admin Page</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	
</head>
<body >
<div class="container bg-success"><br><br><br>
<div class="row">

<table width="50%"> 
	<tr>
		<td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<form action="index.php">
              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i> Logout</button>
        </form>
     </td>
     <td>
    <form action="upload.php">

              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i>  Upload Image</button>
            
        </form>
        </td>
        <td>
    <form action="upload_txt.php">

              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i>  Upload text</button>
            
        </form>
        </td>
        <td>
    <form action="fetch_text.php">

              <button class="btn Submit btn-warning btn-sm"><i class="glyphicon glyphicon-send"></i>  View Text</button>
            
        </form>
        </td>
</tr>
 </table>
<div class="col-lg-6 col-md-6 col-md-offset-3  col-lg-offset-3">  
<div class="table table-striped">
<br><br><br>
	<table class="table-bordered" align="left" id="table1" width="100%">
<thead>	
	<tr>
		<th width="25%" >  s no  </th>
		<th width="25%">  Name   </th>
		<th width="25%">  Images  </th>
		<th width="25%">  Action  </th>
	</tr>
</thead>

<?php 
$con =	mysqli_connect("localhost","root","","start");


$sql="SELECT * From student ORDER BY id DESC";
$result = mysqli_query($con, $sql);
$i=1;
while ($row=mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "<td>".$i."</td>";
	echo "<td>".$row['name']."</td>";
		
	?>
	<td><img src="uploads/<?php echo $row['name']; ?>" width="100px" height="100px"></td>
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
	echo "<script>alert('Deleted successfully');location.href=''</script>";
}else{
	echo "<script>alert('Something Went Wrong') </script>";

}
}
 ?>