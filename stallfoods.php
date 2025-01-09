<?php
    session_start(); 
    error_reporting(0);
    include 'db_conn.php';
    if (isset($_SESSION['ID']) && isset($_SESSION['User'])){
		if ($_SESSION['User'] == "turksadmin" || $_SESSION['User'] == "waffleadmin"){
            $res=$_SESSION['restaurant_name'];
            
            $sql="SELECT * FROM product_list WHERE restaurant ='$res'";
            $all_foods=$con->query($sql);

?>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stall Foods</title>

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
        .grid-container {
            display: grid;
            column-gap: 35px;
            row-gap: 50px;
            grid-template-columns: 200px 200px 200px 200px 200px 200px 200px;
            grid-template-rows: 250px 250px 250px 250px 250px 250px 250px;
            background-color: #D3D3D3;
            padding: 20px;
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
	  <a class="activenav" href="stallfoods.php">Foods</a>
	  <a href="stallunpaid.php">Orders to Pay</a>
	  <a href="stallpaid.php">Pending Orders</a>
      <a href="stallclaimable.php">Claimable Orders</a>
      <a href="stallclaimed.php">Claimed Orders</a>
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
                            <h4> <?php echo $res; ?> Foods</h4>
                           
                            <hr>
                            <!-- COLLECT QUEUE LIST -->
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
							<div style="color:black;"><h3><?php echo mb_strimwidth($row["name"],0,12,"...");?></h3></div>
							<div class="myrow1">
                            	<div style="color:black;" class="mycolumn myleft50"><h5>₱<?php echo $row["price"]; ?><h5></div>
                            	<div style="color:black;" class="mycolumn myright50"><h5>(<?php echo $row["stock"];?>)</h5>
								</div>
							</div>
							<div class="myrow1">
                            	<div class="mycolumn myleft50">
								<a href="updatefs.php?updateid=<?php echo $row["product_id"];?>" target="popup" 
  								onclick="window.open('updatefs.php?updateid=<?php echo $row["product_id"];?>','popup','width=500,height=500'); return false;"><button class="mybtn">Edit Food</button></a>
	
								</div>
                            	<div class="mycolumn myright50">
								<a href="delete.php?deleteid=<?php echo $row["product_id"];?>" onclick='return checkdelete()'><button class="mybtn1">Remove</button></a></div>
							</div>
					</div>
                    <?php }
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
