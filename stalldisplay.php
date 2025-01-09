<?php
    include 'db_conn.php';
    $sql='SELECT * FROM restaurant_list';
    $all_res=$con->query($sql);
?>
<html>
<head>	
		<title>Menu</title>
	    <link rel="shortcut icon" href="Logo.png">
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
					if($all_res){
						while($row=mysqli_fetch_assoc($all_res)){ 
							$ID=$_POST['ID'];
							$Name=$_POST['target'];
							$Name=$_POST['Name'];
							$avl=$_POST['avl'];							
					?>
					<div style="text-align:center;" class="grid-item" >
						<?php
						if($row["avl"] == 1){ 
						?>
							<div class="mypad">
								<img src="assets/images/<?php echo $row["img_path"]; ?>" width="158px" height="116px">	 
							</div>
						<?php		
						}elseif($row["avl"] == 0){
						?>
							<div class="mypad">
								<div class ="container22">
										<div class ="blur">
											<img src="assets/images/<?php echo $row["img_path"]; ?>" width="158px" height="116px">
										</div>	
											<div class="centertext">Closed</div>	
								</div>
							</div>
						<?php
						}
							
						?>
								<div><?php echo mb_strimwidth($row["Name"],0,12,"..."); ?></div>
								<div>
									<a href="<?php echo $row["target"]; ?> Admin.php"><button class="button122 button11">OPEN</button></a>
								</div>
								<div class="myrow1">
									<div class="mycolumn myleft50">
										<a href="editres.php?editresid=<?php echo $row["ID"];?>" target="popup" 
									onclick="window.open('editres.php?editresid=<?php echo $row["ID"];?>','popup','width=500,height=600'); return false;"><button class="button12">Edit</button></a>
									</div>
									<div class="mycolumn myright50">
										<a href="deleteres.php?deleteid=<?php echo $row["ID"];?>" onclick='return checkdelete()'><button class="button13">Remove</button></a>
									</div>
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