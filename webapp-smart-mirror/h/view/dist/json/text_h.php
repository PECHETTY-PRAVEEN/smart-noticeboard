<?php
header("Content-Type:application/json");
$con=mysqli_connect("localhost","root","","mirror");
$sql="SELECT * From texts WHERE texts.priority = 'high' ORDER BY 'date' DESC";
$result = mysqli_query($con, $sql);

$json_array=array();
while($row=mysqli_fetch_assoc($result))
{
	$json_array[]=$row['text'];
}

echo json_encode($json_array);

?>