<?php
	include 'db_conn.php';
	if(isset($_GET["claimid"])){
		$order_id=$_GET["claimid"];
		$sql = "UPDATE order_list SET status='Claimed' WHERE order_id=$order_id";
		$all_orders=mysqli_query($con,$sql);
		if($all_orders){
			echo "<script>alert('Updated Successfully')</script>";
		}else{
			echo "fail";
		}
	}
    header("location: claimableorder.php");
    exit;
?>
