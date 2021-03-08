<?php
header("Content-Type:application/json");
$con=mysqli_connect("localhost","root","","start");
$sql="SELECT * From txt_data ORDER BY ID DESC";
$result = mysqli_query($con, $sql);

$json_array=array();
while($row=mysqli_fetch_assoc($result))
{
	$json_array[]=$row['txt'];
}

echo json_encode($json_array);

?>