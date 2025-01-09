<?php
    include 'db_conn.php';
    $sql='SELECT * FROM order_list WHERE status="Pending"';
	$sql_cart2 = "SELECT * FROM cart"; 
    $all_orders=$con->query($sql);
	$all_cart2 = $con->query($sql_cart2);

	if(isset($_POST["submit"])){

	}
	
?>
<html>
<head>	
		<title>Menu</title>
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
					if($all_orders){ 
					while($row_cart = mysqli_fetch_assoc($all_cart2)){
                        $sql = "SELECT * FROM product_list WHERE product_id=".$row_cart["product_id"];
                        $qtyy = $row_cart["qty"]; 
                        $all_product = $con->query($sql);
                        while($row = mysqli_fetch_assoc($all_product)){		
							while($rowid= mysqli_fetch_assoc($all_orders)){

									
					?>
					<div style="text-align:center;" class="grid-item" >
						<div class="mypad">
							<img src="assets/images/lpu.png" width="158px" height="90px">
						</div>
							<div><h6>Order No: <?php echo $rowid["order_id"]; ?></h6></div>
							<div><h6><?php echo $rowid["User"]; ?></h6></div>
							<div><a href="orders.php?ordersid=<?php echo $rowid["order_id"];?>" target="popup" 
  								onclick="window.open('orders.php?ordersid=<?php echo $rowid["order_id"];?>','popup','width=500,height=600'); return false;"><button class="button122 button11">OPEN</button></a>
							</div>
							<div class="myrow1">
                            	<div class="mycolumn myleft50">
									<a href="updateorder.php?orderid=<?php echo $rowid["order_id"];?>" onclick='return checkdelete()'><button class="button12">Paid</button></a>
									<div class="form-popup">
									</div>	
								</div>
                            	<div class="mycolumn myright50">
								<a href="deleteorder.php?delorderid=<?php echo $rowid["order_id"];?>" onclick='return checkdelete2()'><button class="button13">Remove</button></a></div>
							</div>
					</div>
                    <?php }}}
					} ?>
		</div>
		<script>
		function checkdelete()
		{
			return confirm('Are you sure that this order is paid?');
		}
		function checkdelete2()
		{
			return confirm('Are you sure you want to delete this order?');
		}
		</script>
</body> 
</body> 
</html>