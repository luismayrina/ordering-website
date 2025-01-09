<?php
	include 'db_conn.php';
	if(isset($_GET["orderid"])){
		$order_id=$_GET["orderid"];
		$sql = "UPDATE order_list SET status='Paid' WHERE order_id=$order_id";
		$all_orders=mysqli_query($con,$sql);
		if($all_orders){
			echo "<script>alert('Updated Successfully')</script>";
		}else{
			echo "fail";
		}
	}
    header("location: unpaidorder.php");
    exit;
?>
