<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		
body{
	background: #eee;
}
#frm{
	border: solid gray 1px;
	width: 20%;
	border-radius: 5px;
	margin: 100px auto;
	background: white;
	padding:50px; 
}
#btn{
	color: #fff;
	background: #337ab7;
	padding: 5px;
	margin-left:69%; 
}
</style>
</head>
<body>
	<div id="frm">
	<form action="#" method="post" enctype="multipart/form-data">
<input type="text" name="txt" id="txt" placeholder="Enter Your text" ><br><br>
<input type="submit" value="submit" name="submit">
</form>
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