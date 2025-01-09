<?php
	include 'db_conn.php';
	if(isset($_GET["finishid"])){
		$order_id=$_GET["finishid"];
		$sql = "UPDATE order_list SET status='Claimable' WHERE order_id=$order_id";
		$all_orders=mysqli_query($con,$sql);
		if($all_orders){
			echo "<script>alert('Updated Successfully')</script>";
		}else{
			echo "fail";
		}
	}
    header("location: paidorder.php");
    exit;
?>
