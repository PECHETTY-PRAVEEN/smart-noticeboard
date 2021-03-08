<?php
header("Content-Type:application/json");
$con=mysqli_connect("localhost","root","","mirror");
$sql="SELECT * From images WHERE images.priority = 'medium' ORDER BY 'date' DESC";
$result = mysqli_query($con, $sql);

$json_array=array();
while($row=mysqli_fetch_assoc($result))
{
	$json_array[]=$row['imagename'];
}

echo json_encode($json_array);

?>