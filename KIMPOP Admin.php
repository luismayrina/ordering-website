<?php
	error_reporting(0);
	session_start();
	include 'db_conn.php';
	if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
		if ($_SESSION['User'] == "admin"){
	if(isset($_POST["submit"])){
		$name=$_POST["name"];
		$restaurant=$_POST["restaurant"];
		$product_desc=$_POST["product_desc"];
		$price=$_POST["price"];
		$avl=$_POST["avl"];
		$feature=$_POST["feature"];
		$category=$_POST["category"];
		$stock=$_POST["stock"];

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
					$sql = "INSERT INTO `product_list` (name,product_desc,price,stock,avl,img_path,restaurant,category,feature)
					VALUES('$name','$product_desc','$price','$stock','$avl','$fileNameNew','$restaurant','$category','$feature')";
					$all_foods=mysqli_query($con,$sql);
					if($all_foods){
						echo "<script>alert('Success')</script>";
					}else{
						die(mysqli_error($con));
					}
				}else{
					echo "Your file is too big!";
				}

			}else{
				echo "There was an error uploading your file!";
			}
		}else{
			$sql = "INSERT INTO `product_list` (name,product_desc,price,stock,avl,img_path,restaurant,category,feature)
			VALUES('$name','$product_desc','$price','$stock','$avl','default.png','$restaurant','$category','$feature')";
			$all_foods=mysqli_query($con,$sql);
			if($all_foods){
				echo "<script>alert('Success but no images uploaded or wrong file type, will use the default picture.')</script>";
			}
		}
		
			
					
	}

?>
<html>
	<head>	
		<title>KIMPOP(Admin)</title>
	    <link rel="shortcut icon" href="assets/images/lpu.png">
		<style>
			
		</style>

		<meta charset="utf-8">
		<meta name="author"  content="Gionne Antonio Abogado">
		<meta name="description" content="A website about me" >
		<meta name="keywords" content="Gionne Antonio Abogado, Gionne badminton, Gionne basketball,Gionne esports, Gionne Antonio Abogado Website">
		<link rel="stylesheet" href="style1.css"> 

    <link rel="stylesheet" href="bs/css/bootstrap.css"> 
    <link rel="stylesheet" href="flickity-docs.css"> 
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="styling.css"> 
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"> 		
		<script defer src="javascript.js"></script>
	</head>
<body>
	<div class="container23">
	<div class="centered2"><li class="myul"><a href="main.php">Go to main website</a></li>
	<li class="myul"><a href="Stalls.php">Go back</a></li></div>
	<header class="myheader" style="background-color: #8b0000;"> 
	<p style="text-align:center; font-family:Times New Romans; font-size:72"><strong>KIMPOP</strong><p>
	</header>
	</div>
	
	<div class="myrow" style="background-color: #f1f1f1">	
			<div class="mycolumn myleft">
				<ul class="myul">
                    <li><a class="activenav" href="Stalls.php">Stalls</a></li>
					<li><a href="unpaidorder.php">Unpaid Orders</a></li>
					<li><a href="paidorder.php">Pending Orders</a></li>
					<li><a href="claimableorder.php">Claimable Orders</a></li>
					<li><a href="claimedorder.php">Claimed Orders</a></li>
					<li><a href="logout.php" onclick="return checklogout();">Log out</a></li>
				</ul>
			</div>
			<div class="mycolumn myright">
						<button class="open-button text1" onclick="openForm()">+</button>
							<div class="form-popup" id="myForm">
								<form action="KIMPOP Admin.php" method="POST" class="form-container" enctype="multipart/form-data">
								<h1>Add Food</h1>
							
								<label for="name"><b>Food Name</b></label>
								<input type="text" placeholder="Enter food name" name="name" id="name" required>

								<label for="product_desc"><b>Restaurant</b></label>
								<input type="text" placeholder="Enter restaurant name" value="KIMPOP" name="restaurant" id="restaurant" required>
							
								<label for="product_desc"><b>Description</b></label>
								<input type="text" placeholder="Enter food description" name="product_desc" id="product_desc" required>
								<label for="category"><b>Category</b></label>
										<select name="category" placeholder="Select category" name="category" id="category" required>
											<option value="" selected disabled hidden>Choose here</option>
											<option value="Waffle Dogs">Waffle Dogs</option>
											<option value="Burger">Burger</option>
											<option value="Pita Doner Meals">Pita Doner Meals</option>
											<option value="Siomai & Drinks">Siomai & Drinks</option>
										</select>
								<div class="myrow">
									<div class="mycolumn myleft50">
										<label for="stock"><b>Stock</b></label>
										<input type="number" placeholder="Enter stocks" min="0" name="stock" id="stock" required>
									</div>
									<div class="mycolumn myright50">
										<b>Featured</b><br>
										<div style="margin-left:10px;">
											<input type="radio" id="feature" name="feature" value="1">
											<label for="Yes">Yes</label><br>
											<input type="radio" id="feature" name="feature" value="0">
											<label for="No">No</label><br>  
										</div>
									</div>
								</div>
								<div class="myrow">
									<div class="mycolumn myleft50">
										<label for="price"><b>Price</b></label>
										<input type="number" placeholder="Enter food price" name="price" min="1" id="price" required>
									</div>
									<div class="mycolumn myright50">
										<b>Availability</b><br>
										<div style="margin-left:10px;">
											<input type="radio" id="avl" name="avl" value="1">
											<label for="Yes">Yes</label><br>
											<input type="radio" id="avl" name="avl" value="0">
											<label for="No">No</label><br>  
										</div>
									</div>
								</div>

								<input type="file" id="img_path" name="img_path">
								<input type="submit" value="Add Food" name="submit" class="btn">
								<button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
								</form>
							</div>	
					<?php include_once 'KIMPOP Display.php' ?>	  	
			</div>
			
	</div>
	<script>
		var name = document.getElementById("name");
		var restaurant = document.getElementById("restaurant");
		var product_desc = document.getElementById("product_desc");
		var price = document.getElementById("price");
		var avl = document.getElementById("avl");
		var feature = document.getElementById("feature");
		var category = document.getElementById("category");
		var img_path = document.getElementById("img_path");
 
		img_path.addEventListener("change",function(){
			var file = this.files[0];
			if(name.value==""){
				name.value=file.name;
			}
		});
	</script>
</body>
<?php }else{
		echo "<script>alert('You are not an admin!');window.location='main.php';</script>";
		
	}
}?>
<script>
		function checklogout()
		{
			return confirm('Are you sure you want to logout?');
		}
		</script>
</html>
