<?php
	error_reporting(0);
	session_start(); 
	include 'db_conn.php';

	if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
		if ($_SESSION['User'] == "admin"){
	if(isset($_POST["submit"])){
		$Name=$_POST["Name"];
		$avl=$_POST["avl"];
		$target=$_POST["target"];

		$img_path=$upload_dir.$_FILES["img_path"]["name"];
		$img_path2=$upload_dir.$_FILES["img_path2"]["name"];
		$img_path=$_FILES['img_path'];
		$img_path2=$_FILES['img_path2'];
		$fileName=$_FILES['img_path']['name'];
		$fileName2=$_FILES['img_path2']['name'];
		$fileTmpName=$_FILES['img_path']['tmp_name'];
		$fileTmpName2=$_FILES['img_path2']['tmp_name'];
		$fileSize=$_FILES['img_path']['size'];
		$fileSize2=$_FILES['img_path2']['size'];
		$fileError=$_FILES['img_path']['error'];
		$fileError2=$_FILES['img_path2']['error'];
		$fileType=$_FILES['img_path']['type'];
		$fileType2=$_FILES['img_path2']['type'];

		$fileExt = explode('.',$fileName);
		$fileActualExt=strtolower(end($fileExt));
		$fileExt2 = explode('.',$fileName2);
		$fileActualExt2=strtolower(end($fileExt2));

		$allowed = array('jpg','jpeg','png');
		if(in_array($fileActualExt, $allowed)){
			if($fileError === 0 && $fileError2 !=0){
				if($fileSize<1000000000){
					$fileNameNew=uniqid('', true).".".$fileActualExt;
					$fileDestination='assets/images/'.$fileNameNew;
					move_uploaded_file($fileTmpName, $fileDestination);
					$sql = "INSERT INTO restaurant_list (Name,img_path,img_path2,target)
					VALUES('$Name','$fileNameNew','defaultbg.png','$target')";
					$all_res=mysqli_query($con,$sql);
					if($all_res){
						echo "<script>alert('Success but no background uploaded, will use the default background.')</script>";
					}else{
						die(mysqli_error($con));
					}
						}
			}
		else if($fileError === 0 && $fileError2 === 0){
				if($fileSize<1000000000 && $fileSize2<1000000000){
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileNameNew2 = uniqid('', true).".".$fileActualExt;
					$fileDestination='assets/images/'.$fileNameNew;
					$fileDestination2='assets/images/'.$fileNameNew2;
					move_uploaded_file($fileTmpName, $fileDestination);
					move_uploaded_file($fileTmpName2, $fileDestination2);
					$sql = "INSERT INTO restaurant_list (Name,avl,img_path,img_path2,target)
						VALUES('$Name','$avl','$fileNameNew','$fileNameNew2','$target')";
						$all_res=mysqli_query($con,$sql);
						if($all_res){
							echo "<script>alert('Success')</script>";
						}else{
							die(mysqli_error($con));
						}
				}else{
					echo "Your file is too big!";
				}

			}
				
			
			}else if(in_array($fileActualExt2, $allowed)){
				if($fileError2 ===0 && $fileError !=0){
					if($fileSize2<1000000000){
						$fileNameNew2=uniqid('', true).".".$fileActualExt2;
						$fileDestination2='assets/images/'.$fileNameNew2;
						move_uploaded_file($fileTmpName2, $fileDestination2);
						$sql = "INSERT INTO restaurant_list (Name,avl,img_path,img_path2,target)
						VALUES('$Name','$avl','default.png','$fileNameNew2','$target')";
						$all_res=mysqli_query($con,$sql);
						if($all_res){
							echo "<script>alert('Success but no logo uploaded, will use the default logo.')</script>";
						}else{
							die(mysqli_error($con));
						}
					}
				}
		}else{
			$sql = "INSERT INTO restaurant_list (Name,avl,img_path,img_path2,target)
						VALUES('$Name','$avl','default.png','defaultbg.png','$target')";
						$all_res=mysqli_query($con,$sql);
						if($all_res){
							echo "<script>alert('Success but no images uploaded or wrong file type, will use the default logo and background.')</script>";
						}else{
							die(mysqli_error($con));
						}
		}
		}
		
					
	

?>
<html>
	<head>	
		<title>Admin (Stalls)</title>
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
	<div class="centered2"><li class="myul"><a href="main.php">Go to main website</a></li></div>
	<header class="myheader" style="background-color: #8b0000;"> 
	<p style="text-align:center; font-family:Times New Romans; font-size:72"><strong>Hello, <?php echo $_SESSION['Fname'];?></strong><p>
	</header>
	</div>
	
	<div class="myrow" style="background-color: #f1f1f1">	
			<div class="mycolumn myleft">
				<ul class="myul">
					<li><a class="activenav" href="#home">Stalls</a></li>
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
								<form action="Stalls.php" method="POST" class="form-container" enctype="multipart/form-data">
								<h1>Add Restaurant</h1>
							
								<label for="Name"><b>Restaurant Name</b></label>
								<input type="text" placeholder="Enter restaurant name" name="Name" id="Name" required>
								<label for="category"><b>Target</b></label>
										<select name="target" placeholder="Select target" name="target" id="target" required>
										<option value="" selected disabled hidden>Choose here</option>
											<option value="Turks">Turks</option>
											<option value="Waffle Time">Waffle Time</option>
											<option value="Chowking">Chowking</option>
											<option value="House of Dimsum">House of Dimsum</option>
											<option value="Kusina ni Tata Rod">Kusina ni Tata Rod</option>
											<option value="Ava Cakery">Ava Cakery</option>
											<option value="KIMPOP">KIMPOP</option>
											<option value="Warm Fuzzies">Warm Fuzzies</option>
										</select>
								<b>Availability</b><br>
								<input type="radio" id="avl" name="avl" value="1">
								<label for="Yes">Yes</label><br>
								<input type="radio" id="avl" name="avl" value="0">
								<label for="No">No</label><br>  
								<b>Restaurant Logo</b>
								<input type="file" id="img_path" name="img_path" accept="image/png, image/jpeg, image/jpg"><br>
								<b>Restaurant Background</b><br>
								<input type="file" id="img_path2" name="img_path2">
								<input type="submit" value="Add Restaurant" name="submit" class="btn">
								<button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
								</form>
							</div>	
					<?php include_once 'stalldisplay.php' ?>	  	
			</div>
			
	</div>
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
</body>
</html>
