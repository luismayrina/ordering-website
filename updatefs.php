<?php
	error_reporting(0);
	include 'db_conn.php';
    $product_id=$_GET['updateid'];
	$sql="SELECT * FROM product_list WHERE product_id=$product_id";
	$all_foods=$con->query($sql);
	$row=mysqli_fetch_assoc($all_foods);
	$name=$row['name'];
	$restaurant=$row['restaurant'];
	$product_desc=$row['product_desc'];
	$price=$row['price'];
	$avl=$row['avl'];
	$img_path=$row['img_path'];
	$category=$row["category"];
	$feature=$row["feature"];
	$stock=$row["stock"];

	if(isset($_POST["submit"])){
		$price=$_POST["price"];
		$avl=$_POST["avl"];
		$stock=$_POST["stock"];
		
		
		$sql="UPDATE product_list SET stock='$stock', price='$price', avl='$avl' WHERE product_id=$product_id";
        $all_foods=mysqli_query($con,$sql);
		echo "<script>window.close();</script>";				
	}

?>
<html>
	<head>	
		<title>Menu</title>
	    <link rel="shortcut icon" href="Logo.png">
		<style>
		</style>
		
		<link rel="stylesheet" href="styling.css"> 
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"> 		
		<script defer src="javascript.js"></script>
	</head>
								<form method="POST" class="form-container" enctype="multipart/form-data" >
								<h1>Edit Food</h1>
								<label for="name"><b>Food Name</b></label>
								<input type="text" placeholder="Enter food name" value="<?php echo $row["name"]; ?>" name="name" id="name" disabled>
								<div class="myrow">
									<div class="mycolumn myleft50">							
										<label for="stock"><b>Stock</b></label>
										<input type="number" placeholder="Enter stocks" value="<?php echo $row["stock"];?>" min="0" name="stock" id="stock" required>
									</div>
									<div class="mycolumn myright50">
										<b>Featured</b><br>
										<div style="margin-left:10px;">
										<?php if($row["feature"] == 1){
										?>
											<input type="radio" id="feature" name="feature" value="1" checked>
											<label for="Yes">Yes</label><br>
											<input type="radio" id="feature" name="feature" value="0">
											<label for="No">No</label><br>  
										<?php }elseif($row["feature"] == 0){
 										?>
											<input type="radio" id="feature" name="feature" value="1">
											<label for="Yes">Yes</label><br>
											<input type="radio" id="feature" name="feature" value="0" checked>
											<label for="No">No</label><br>
										<?php } ?>
										</div>
									</div>
								</div>
								<div class="myrow">
									<div class="mycolumn myleft50">
										<label for="price"><b>Price</b></label>
										<input type="number" placeholder="Enter food price" value="<?php echo $row["price"]; ?>" min="1" name="price" id="price" required>
									</div>
									<div class="mycolumn myright50">
										<b>Availability</b><br>
										<div style="margin-left:10px;">
											<?php if($row["avl"] == 1){
										?>
											<input type="radio" id="avl" name="avl" value="1" checked>
											<label for="Yes">Yes</label><br>
											<input type="radio" id="avl" name="avl" value="0">
											<label for="No">No</label><br>  
										<?php }elseif($row["avl"] == 0){
 										?>
											<input type="radio" id="avl" name="avl" value="1">
											<label for="Yes">Yes</label><br>
											<input type="radio" id="avl" name="avl" value="0" checked>
											<label for="No">No</label><br>
										<?php } ?> 
										</div>
									</div>
								</div>
								<input type="submit" value="Edit Food" name="submit" onclick="return checkupdate();" class="btn" >
								<button type="button" class="btn cancel"  onclick="window.open('', '_self', ''); window.close();">Cancel</button>
								</form>
		<script>
			function checkupdate()
		{
			return confirm('Are you sure you want to update this?');
		}
		</script>
</html>
