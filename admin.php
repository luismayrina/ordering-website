<?php
    require_once 'db_conn.php';
    $sql='SELECT * FROM foods WHERE rn ="Waffle Time"';
    $all_foods=$con->query($sql);
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
<body>
		<div class="grid-container">
                    <?php	
					if($all_foods){
						while($row=mysqli_fetch_assoc($all_foods)){ 
							$food_id=$_POST['food_id'];
							$fn=$_POST['fn'];
							$fd=$_POST['fd'];
							$price=$_POST['price'];
							$quantity=$_POST['quantity'];
					?>
					<div style="text-align:center;" class="grid-item" >
						<div class="mypad">
							<img src="assets/images/<?php echo $row["foodimg"]; ?>" width="158px" height="100px">
						</div>
							<div><?php echo $row["fn"]; ?></div>
							<div class="myrow1">
                            	<div class="mycolumn myleft50">₱<?php echo $row["price"]; ?></div>
                            	<div class="mycolumn myright50">Qty:<?php echo $row["quantity"]; ?></p></div>
							</div>
							<div class="myrow1">
                            	<div class="mycolumn myleft50">
								<button class="mybtn"><a href="update.php?updateid=<?php echo $row["food_id"];?>" target="popup" 
  								onclick="window.open('update.php?updateid=<?php echo $row["food_id"];?>','popup','width=500,height=600'); return false;">Edit Food</a></button>
									<div class="form-popup">
									</div>	
								</div>
                            	<div class="mycolumn myright50">
								<button class="mybtn1"><a href="delete.php?deleteid=<?php echo $row["food_id"];?>">Remove</a></button></div>
							</div>
					</div>
                    <?php }
					} ?>
		</div>
		
</body> 
</html>