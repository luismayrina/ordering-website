<?php
    session_start(); 
    include 'db_conn.php';

    if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
		if ($_SESSION['User'] == "turksadmin" || $_SESSION['User'] == "waffleadmin"){
            $res=$_SESSION['restaurant_name'];
            
            $sql="SELECT * FROM order_list WHERE restaurant_name = '$res' AND status = 'Claimed'";
            $sql_cart2 = "SELECT * FROM cart"; 
            $all_orders=$con->query($sql);
	        $all_cart2 = $con->query($sql_cart2);

?>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Claimed Orders</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" href="styling.css"> 
        <style>
            body{
                background-color: whitesmoke;
            }

            

            .header{
                background-color: #a3272f;
                max-height: 125px;
                max-width: 100vw;
            }

            .logo{
                max-width: 115px;
                max-height: 115px;
            }

            h4{
                font-size: 35px;
            }

            hr{
                width: 100%;
                border: 2px solid rgb(255, 255, 255);
            }

            .preparing{
                color: black;
            }
            .prepare-queue{
                font-size: 2.49rem;
            }

            .serving{
                color: white;
            }
            .serve-queue{
                font-size: 2.49rem;
            }
            
            table{
                border-collapse: collapse;
            }
            tr:nth-child(n+7){
                display: none;
            }
            td{
                background-color: rgba(228, 228, 228, 0.3);
                padding: 14px;
            }
            .navbar {
		  overflow: hidden;
		  background-color: #333;
		  font-family: Arial, sans-serif;
		}

		/* Links inside the navbar */
		.navbar a {
		  float: left;
		  display: block;
		  color: white;
		  text-align: center;
		  padding: 14px 16px;
		  text-decoration: none;
		}

		/* Change the color of links on hover */
		.navbar a:hover {
		  background-color: #ddd;
		  color: black;
		}

		/* Add a responsive navigation menu */
		@media screen and (max-width: 600px) {
		  .navbar a {
		    float: none;
		    display: block;
		  }
		}
        </style>
    </head>
    <body>
    <div class="navbar">
	  <a href="stallfoods.php">Foods</a>
	  <a href="stallunpaid.php">Orders to Pay</a>
	  <a href="stallpaid.php">Pending Orders</a>
      <a href="stallclaimable.php">Claimable Orders</a>
      <a class="activenav" href="stallclaimed.php">Claimed Orders</a>
	</div> 
        <div class="container-fluid">
            <!-- HEADER -->
            <div class="row text-center">

                <div class="header">
                    <!-- LPU LOGO -->
                    <img src="/assets/images/lpu.png" class="logo" alt="LPU Logo"> 
                </div> 

            </div>        
                    <!-- COLLECT COLUMN -->
                    <div class="order-2 bg-success">
                        <div class="p-4 serving text-center">
                            <h4> <?php echo $res; ?> Claimed Orders</h4>
                           
                            <hr>
                            <!-- COLLECT QUEUE LIST -->
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
                                        <div><a href="archiveorder.php?archiveid=<?php echo $rowid["order_id"];?>" onclick='return checkdelete()'><button class="button15">REMOVE</button></a> 
                                        </div>
                                                                            
                                </div>
                                <?php }}}
                                } ?>
		</div>
                        </div>
                    </div>


            
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">  
        </script>
    </body>
</html>
<?php
        }}
?>
