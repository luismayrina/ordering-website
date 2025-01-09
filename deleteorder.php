<?php
	include 'db_conn.php';
	if(isset($_GET["delorderid"])){
		$order_id=$_GET["delorderid"];

		$sql = "DELETE FROM order_list where order_id=$order_id";
		$all_orders=mysqli_query($con,$sql);
		if($all_orders){
			echo "<script>alert('Deleted Successfully')</script>";
		}else{
			echo "fail";
		}
	}
    header("location: unpaidorder.php");
    exit;
?>
