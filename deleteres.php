<?php
	include 'db_conn.php';
	if(isset($_GET["deleteid"])){
		$ID=$_GET["deleteid"];

		$sql = "DELETE FROM restaurant_list where ID=$ID";
		$all_res=mysqli_query($con,$sql);
		echo "<script>alert('Deleted Successfully');</script>";
		header("location: Stalls.php");
	}
?>
