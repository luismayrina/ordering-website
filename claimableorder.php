<?php
	error_reporting(0);
	session_start(); 
	include 'db_conn.php';

	if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
		if ($_SESSION['User'] == "admin"){
    
	

?>
<html>
	<head>	
		<title>Admin (Claimed Orders)</title>
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
<body style="background-color: #5F8686;">
<div class="container23">
	<div class="centered2"><li class="myul"><a href="main.php">Go to main website</a></li></div>
	<header class="myheader" style="background-color: #8b0000;"> 
	<p style="text-align:center; font-family:Times New Romans; font-size:72"><strong>Hello, <?php echo $_SESSION['Fname'];?></strong><p>
	</header>
	</div>
	
	<div class="myrow" style="background-color: #f1f1f1">	
			<div class="mycolumn myleft">
				<ul class="myul">
                    <li><a href="Stalls.php">Stalls</a></li>
					<li><a href="unpaidorder.php">Unpaid Orders</a></li>
					<li><a href="paidorder.php">Pending Orders</a></li>
					<li><a class="activenav" href="claimableorder.php">Claimable Orders</a></li>
					<li><a href="claimedorder.php">Claimed Orders</a></li>
					<li><a href="logout.php" onclick="return checklogout();">Log out</a></li>
				</ul>
			</div>
			<div class="mycolumn myright">
					<?php include_once 'CLOdisplay.php' ?>	  	
			</div>
			
	</div>
	<?php }else{
		echo "<script>alert('You are not an admin!');window.location='main.php';</script>";
		
	}
		}else { 
			header("Location: index.php"); 
			exit(); 
		}?>
		<script>
		function checklogout()
		{
			return confirm('Are you sure you want to logout?');
		}
		</script>
</body>
</html>
