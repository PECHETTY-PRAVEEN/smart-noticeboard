<?php
header("Content-Type:application/json");
$con=mysqli_connect("localhost","root","","start");
$sql="SELECT * From student ORDER BY id DESC";
$result = mysqli_query($con, $sql);

$json_array=array();
while($row=mysqli_fetch_assoc($result))
{
	$json_array[]=$row['name'];
}

echo json_encode($json_array);

?>