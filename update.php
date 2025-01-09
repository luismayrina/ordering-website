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
		$name=$_POST["name"];
		$restaurant=$_POST["restaurant"];
		$product_desc=$_POST["product_desc"];
		$price=$_POST["price"];
		$avl=$_POST["avl"];
		$feature=$_POST["feature"];
		$category=$_POST["category"];
		$stock=$_POST["stock"];
		$img_path=$_POST['img_path'];
		
		$img_path=$_FILES['img_path'];
		$fileName=$_FILES['img_path']['name'];
		$fileTmpName=$_FILES['img_path']['tmp_name'];
		$fileSize=$_FILES['img_path']['size'];
		$fileError=$_FILES['img_path']['error'];
		$fileType=$_FILES['img_path']['type'];

		$fileExt = explode('.',$fileName);
		$fileActualExt=strtolower(end($fileExt));

		$allowed = array('jpg','jpeg','png');
		if(in_array($fileActualExt, $allowed)){
			if($fileError === 0){
				if($fileSize<1000000000){
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDestination='assets/images/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$sql="UPDATE product_list SET product_id=$product_id, name='$name', restaurant='$restaurant',stock='$stock', product_desc='$product_desc',category='$category', price='$price', avl='$avl', feature='$feature',img_path='$fileNameNew' WHERE product_id=$product_id";
        			$all_foods=mysqli_query($con,$sql);
					echo "<script>window.close();</script>";
				}else{
					echo "Your file is too big!";
				}

			}else{
				echo "There was an error uploading your file!";
			}
		}else{
		$sql="UPDATE product_list SET product_id=$product_id, name='$name', restaurant='$restaurant',stock='$stock', product_desc='$product_desc',category='$category', price='$price', avl='$avl', feature='$feature' WHERE product_id=$product_id";
        $all_foods=mysqli_query($con,$sql);
		echo "<script>window.close();</script>";
		}

        

					
	}

?>
<html>
	<head>	
		<title>Menu</title>
	    <link rel="shortcut icon" href="Logo.png">
		<style>
		</style>

		<meta charset="utf-8">
		<meta name="author"  content="Gionne Antonio Abogado">
		<meta name="description" content="A website about me" >
		<meta name="keywords" content="Gionne Antonio Abogado, Gionne badminton, Gionne basketball,Gionne esports, Gionne Antonio Abogado Website">
		
		<link rel="stylesheet" href="styling.css"> 
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"> 		
		<script defer src="javascript.js"></script>
	</head>

								<form method="POST" class="form-container" enctype="multipart/form-data" >
								<h1>Edit Food</h1>
								<label for="name"><b>Food Name</b></label>
								<input type="text" placeholder="Enter food name" value="<?php echo $row["name"]; ?>" name="name" id="name" required>

								<label for="name"><b>Restaurant</b></label>
								<input type="text" placeholder="Enter restaurant name" value="<?php echo $row["restaurant"]; ?>" name="restaurant" id="restaurant" required>
							
								<label for="product_desc"><b>Description</b></label>
								<input type="text" placeholder="Enter food description" value="<?php echo $row["product_desc"]; ?>" name="product_desc" id="product_desc" required>
								<label for="category"><b>Category</b></label>
										<select name="category" placeholder="Select category" value="<?php echo $row["category"]; ?>" name="category" id="category" required>
											<option value="Waffle Dogs">Waffle Dogs</option>
											<option value="Burger">Burger</option>
											<option value="Pita Doner Meals">Pita Doner Meals</option>
											<option value="Siomai & Drinks">Siomai & Drinks</option>
										</select>
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
								<input type="file" id="img_path" value="<?php echo $row["img_path"]; ?>" name="img_path"><?php echo $row["img_path"]; ?>
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
