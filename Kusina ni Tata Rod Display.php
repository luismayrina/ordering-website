<?php
    include 'db_conn.php';
    $sql='SELECT * FROM product_list WHERE restaurant ="Kusina ni Tata Rod"';
    $all_foods=$con->query($sql);
?>
<html>
<head>	
		<title>Kusina ni Tata Rod(Admin)</title>
	    <link rel="shortcut icon" href="assets/images/lpu.png">
		<style>
		a{
				text-decoration: none;
				color: black;
			}
		</style>

		<meta charset="utf-8">
		<meta name="author"  content="Gionne Antonio Abogado">
		<meta name="description" content="A website about me" >
		<meta name="keywords" content="Gionne Antonio Abogado, Gionne badminton, Gionne basketball,Gionne esports, Gionne Antonio Abogado Website">
		
		<link rel="stylesheet" href="styling.css"> 
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css"> 		
		<script defer src="javascript.js"></script>
	</head>
<body>
		<div class="grid-container">
                    <?php	
					if($all_foods){
						while($row=mysqli_fetch_assoc($all_foods)){ 
							$product_id=$_POST['product_id'];
							$name=$_POST['name'];
							$product_desc=$_POST['product_desc'];
							$price=$_POST['price'];
							$avl=$_POST['avl'];
							$stock=$_POST['stock'];
					?>
					<div style="text-align:center;" class="grid-item" >
						<div class="mypad">
						<?php
						if($row["avl"] == 1){ 
						?>
							<div class="mypad">
								<img src="assets/images/<?php echo $row["img_path"]; ?>" width="158px" height="110px">	 
							</div>
						<?php		
						}elseif($row["avl"] == 0){
						?>
							<div class="mypad">
								<div class ="container22">
										<div class ="blur">
											<img src="assets/images/<?php echo $row["img_path"]; ?>" width="158px" height="110px">
										</div>	
											<div class="centertext">N/A</div>	
								</div>
							</div>
						<?php
						}
							
						?>
						</div>
							<div><?php echo mb_strimwidth($row["name"],0,12,"...");?></div>
							<div class="myrow1">
                            	<div class="mycolumn myleft50">₱<?php echo $row["price"]; ?></div>
                            	<div class="mycolumn myright50">(<?php echo $row["stock"];?>)
								</div>
							</div>
							<div class="myrow1">
                            	<div class="mycolumn myleft50">
								<a href="update.php?updateid=<?php echo $row["product_id"];?>" target="popup" 
  								onclick="window.open('update.php?updateid=<?php echo $row["product_id"];?>','popup','width=500,height=700'); return false;"><button class="mybtn">Edit Food</button></a>
	
								</div>
                            	<div class="mycolumn myright50">
								<a href="delete.php?deleteid=<?php echo $row["product_id"];?>" onclick='return checkdelete()'><button class="mybtn1">Remove</button></a></div>
							</div>
					</div>
                    <?php }
					} ?>
		</div>
	<script>
		function checkdelete()
		{
			return confirm('Are you sure you want to delete?');
		}
	</script>
</body> 

</html>