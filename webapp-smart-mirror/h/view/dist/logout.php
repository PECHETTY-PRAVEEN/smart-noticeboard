<?php 

session_start();

session_unset();
session_destroy();

echo "<script type='text/javascript'>alert ('logout successful');</script>"; ;
	echo "<script>location.href='index.php'</script>";


 ?>