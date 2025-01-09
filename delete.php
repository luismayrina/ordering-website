<?php
	include 'db_conn.php';
	if(isset($_GET["deleteid"])){
		$product_id=$_GET["deleteid"];

		$sql = "DELETE FROM product_list where product_id=$product_id";
		$all_foods=mysqli_query($con,$sql);
		if($all_foods){
			echo "<script>alert('Deleted Successfully')</script>";
			
		}else{
			echo "fail to delete";
		}
	}
	header("location: Stalls.php");
    exit;
?>
