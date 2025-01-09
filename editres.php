<?php
	error_reporting(0);
	include 'db_conn.php';
    $ID=$_GET['editresid'];
	$sql="SELECT * FROM restaurant_list WHERE ID=$ID";
	$all_res=$con->query($sql);
	$row=mysqli_fetch_assoc($all_res);
	$Name=$row['Name'];
	$avl=$row['avl'];
	$img_path=$row['img_path'];
	$img_path2=$row['img_path2'];

	if(isset($_POST["submit"])){
		$Name=$_POST["Name"];
		$avl=$_POST["avl"];
		$img_path=$_POST['img_path'];
		
		$img_path=$_FILES['img_path'];
		$fileName=$_FILES['img_path']['name'];
		$fileTmpName=$_FILES['img_path']['tmp_name'];
		$fileSize=$_FILES['img_path']['size'];
		$fileError=$_FILES['img_path']['error'];
		$fileType=$_FILES['img_path']['type'];
		$img_path2=$_FILES['img_path2'];
		$fileName2=$_FILES['img_path2']['name'];
		$fileTmpName2=$_FILES['img_path2']['tmp_name'];
		$fileSize2=$_FILES['img_path2']['size'];
		$fileError2=$_FILES['img_path2']['error'];
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
					$sql = "UPDATE restaurant_list SET Name='$Name',img_path='$fileNameNew', avl='$avl' WHERE ID=$ID";
					$all_res=mysqli_query($con,$sql);
					echo "<script>window.close();</script>";
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
					$sql = "UPDATE restaurant_list SET Name='$Name', img_path='$fileNameNew', img_path2='$fileNameNew2', avl='$avl' WHERE ID=$ID";
						$all_res=mysqli_query($con,$sql);
						echo "<script>window.close();</script>";
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
						$sql = "UPDATE restaurant_list SET Name='$Name',img_path2='$fileNameNew2', avl='$avl' WHERE ID=$ID";
						$all_res=mysqli_query($con,$sql);
						echo "<script>window.close();</script>";
					}
				}
		}else{
			$sql="UPDATE restaurant_list SET Name='$Name', avl='$avl' WHERE ID=$ID";
        	$all_res=mysqli_query($con,$sql);
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
								<h1>Edit Restaurant</h1>
								<label for="name"><b>Restaurant Name</b></label>
								<input type="text" placeholder="Enter restaurant name" value="<?php echo $row["Name"]; ?>" name="Name" id="Name" required>

								<label for="product_desc"><b>Availability</b></label>
								<div class="myrow">	
										<?php if($row["avl"] == 1){
										?>
										<div class="mycolumn myleft50">
										<input type="radio" id="avl" name="avl" value="1" checked>
										<label for="Yes">Yes</label><br>
										</div>
										<div class="mycolumn myright50">					
										<input type="radio" id="avl" name="avl" value="0">
										<label for="No">No</label><br> 
									</div>
										<?php 
										}elseif($row["avl"] == 0){	
										?>
										<div class="mycolumn myleft50">
										<input type="radio" id="avl" name="avl" value="1">
										<label for="Yes">Yes</label><br>
										</div>
									<div class="mycolumn myright50">					
										<input type="radio" id="avl" name="avl" value="0" checked>
										<label for="No">No</label><br>  						
									</div>				
                                        <?php }?>
										
									
									
								</div>
								<b>Restaurant Logo</b><br>
								<input type="file" id="img_path" value="<?php echo $row["img_path"]; ?>" name="img_path"><?php echo $row["img_path"]; ?><br>
								<b>Restaurant Header</b><br>
								<input type="file" id="img_path2" value="<?php echo $row["img_path2"]; ?>" name="img_path2"><?php echo $row["img_path2"]; ?>
								<input type="submit" value="Edit Restaurant" name="submit" onclick="return checkupdate();" class="btn">
								<button type="button" class="btn cancel"  onclick="window.open('', '_self', ''); window.close();">Cancel</button>
								</form>

								<script>
			function checkupdate()
		{
			return confirm('Are you sure you want to update this?');
		}
		</script>
</html>
