<?php
include "restaurant_availability.php"; 
session_start();

include ('db_conn.php');

$check_avail = "SELECT * FROM restaurant_list WHERE Name = 'Turks' AND avl = 1"; // Search for items in the product_list that includes the restaurant name "Turks"

$result = mysqli_query($con, $check_avail);

if(mysqli_num_rows($result) > 0){

if (isset($_SESSION['ID']) && isset($_SESSION['User'])){





?>

<?php
require_once 'db_conn.php'; 
$user_id = $_SESSION['ID'];


?> 
<!DOCTYPE html>
<html> 

  <head> 
    <link rel="icon" href="assets/images/lpu.png"> 
   
   <meta charset="utf-8"> 

    <meta name="author"  content="GROUP 5">
    <meta name="description" content="Lyceum of the Philippines University - Cavite Canteen Ordering" >
    <meta name="keywords" content="HTML, CSS, JAVASCRIPT, JQUERY, WEB DEVELOPMENT, FREELANCE DEVELOPER, WEB DESIGNER PHILIPPINES">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "refresh" content = ""> 
    <title> Canteen Ordering and Queueing System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"> 
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="page.css"> 
    <link rel="stylesheet" href="style1.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="bs/css/bootstrap.css"> 
    <link rel="stylesheet" href="flickity-docs.css"> 

    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;700&display=swap" rel="stylesheet">
     
    <script src="js/flickity-docs.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head> 
<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
    

    <body style = "background-color : #ffffff "> 
    
    <?php
      include_once 'header.php';

   ?>

          
 
<!-- END OF CART  -->   




    
    <div class=" hero-carousel__cell--1">
    <?php
     $sql="SELECT * FROM restaurant_list WHERE Name = 'Turks'";
     $all_res=$con->query($sql);
     $row=mysqli_fetch_assoc($all_res);
    ?>
     <img src="assets/images/<?php echo $row["img_path2"]; ?>" style = "max-height: 300px;" id = "banner" class="hero-carousel__cell d-block w-100" alt="...">
      
    </div>
    
    <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
      
        <span class="fs-2">Turks</span> <!-- Stall Name -->
        
      </a>
    </header>

    
    <header class="pb-3 mb-4 border-bottom">
    <?php
      // Retrieve the categories for a restaurant
      $restaurant = 'Turks';
      $categories = $con->query("SELECT DISTINCT category FROM product_list WHERE restaurant = '$restaurant'");
      
      // Display the categories as links
      while ($row = $categories->fetch_assoc()) {
        $category = $row['category'];  
        echo '<a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="font-dosis text-dark fs-3 "><i class="fa-solid fa-fire"></i>'.$row['category'].'</span> <!-- Category name-->
      </a> 
      ';
      
      echo '<div class="album py-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" >';
      include ('db_conn.php'); 
              $qry = $con->query("SELECT * FROM  product_list WHERE restaurant = 'Turks' AND category='$category' AND avl='1' order by product_id ASC"); // Search for items in the product_list that includes the restaurant name "Turks"
              while($row = $qry->fetch_assoc()):
                
      ?>

      
      
      
                <?php  ?>
                <div class="w-100 px-2  " style="max-width: 330px; ">

          <!-- PRODUCT Card -->
                  <div class="card border-1 rounded-5 shadow-lg">

          <!-- PRODUCT Image -->
                      <div>
                      
                      <?php
                      $restaurant_name = $row['restaurant']; 
                      $product_stock = $row['stock'];
                      if ($product_stock <= 0){ 
                          echo '<div class="image__overlayy "> 
                          <a href = "#"  data-bs-toggle="modal" data-bs-target = "#closed-'.$row['product_id'].'" class = "text-muted text-decoration-none link-light fs-1">
                          <div class="image__title font-dosis text-decoration-none text-center">OUT OF STOCK</div></a> 
                          </div>
                          
                          <!-- CLOSED RESTAURANT MODAL -->   
                          <div class="modal fade" id="closed-'.$row['product_id'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header" >
                                              <h1 class="modal-title fs-5 " id="exampleModalLabel">Out of Stock</h1>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                '.$row['name'].' is currently out of stock. Please check again later.
                                                </div>
                                         <!-- Modal Footer -->
                                                  <div class="modal-footer">
                                                    
                                                    <a class = "text-light" ><button type="button" name = "submit" data-bs-dismiss="modal" class=" btn text-light justify-align-center" style = "background-color:#A3272F ">Close</button></a>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>';
                        }
                        ?>
                        
                        
                        <img  style = "max-height: 200px;" class="card-img-top" src="assets/images/<?php echo $row['img_path'] ?>" alt="..." />
                        
                      </div>
                      
          <!-- PRODUCT Body -->
                    <div class="card-body">

          <!-- PRODUCT Heading -->
                      <div class="row mb-2">
                        <div class="col">
                          <h6 style = "max-width: 200px;"class="mb-0 truncate"><a class = "link-dark font-dosis "style = "text-decoration: none; "href = "index.php"> <?php echo $row['name'] ?></a></h6>
                          
                        </div>
                        <div class="col-auto">
                          <span class="fs-7 font-serif text-black font-dosis">₱<?php echo $row['price'] ?></span>
                        </div>
                        
                      </div>
                      
                      
          <!-- PRODUCT Text -->
                      <p style = "min-height: 50px; " class="mb-0 text-muted font-dosis fs-8">
                        <?php echo $row['product_desc'] ?>
                      </p> 
                      
                      <center> 
                        <button class="fs-8 btn mt-3 text-light" style = "background-color:#A3272F " data-bs-toggle="modal"  data-bs-target="#exampleModal<?php echo $row['product_id'] ?>">Add to cart</button>
                      </center>
                      <p class=" mb-0 text-muted font-dosis fs-8">
                        Stock: <?php echo $row['stock'] ?>
                      </p>
                        </div>
                        </div>
          <!-- END OF PRODUCT CARD  -->         


            <!-- PRODUCT MODAL -->   
            <div class="modal fade" id="exampleModal<?php echo $row['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Purchase</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

            <!-- MODAL Card -->
                  <div class="card border-1 rounded-5 shadow-lg">

            <!-- MODAL Image -->
                          <div>
                            <img  style = "max-height: 200px;" class="card-img-top" src="assets/images/<?php echo $row['img_path'] ?>" alt="..." />
                          
                          </div>
                          
            <!-- MODAL Body -->
                        <div class="card-body" >

            <!-- MODAL Heading -->
                          <div class="row mb-2">
                            <div class="col">
                              <!-- MODAL PRODUCT NAME  -->
                              <h6 class = "font-dosis text-start" style = "max-width: 400px;" class="mb-0 truncate "><?php echo $row['name'] ?></h6> 
                              <!-- MODAL PRODUCT RESTAURANT  -->
                              
                            </div>
                            <!-- MODAL PRODUCT PRICE  -->
                            <div class="col-auto">
                              <span class="fs-7 font-serif text-black font-dosis">₱<?php echo $row['price'] ?></span>
                            </div>
                            
                          </div>
                          
                          
            <!-- MODAL Text -->
                          <p style = "min-height: 50px; " class="mb-0 text-muted font-dosis fs-8">
                          <!-- MODAL PRODUCT DESRIPTION  -->
                          <?php echo $row['product_desc'] ?>
                          </p> 
            <!-- ADD TO CART FORM -->
                          <div class="form-group"> 
                      <form action = "addtocart.php" method = "POST" ><!-- Submit order form to addtocart.php -->
                      <div class="row">
                        <div class="col-md-2"><label class="control-label">Qty</label></div>
                        <div class="input-group col-md-9 mb-3 " >
                        
                          
                        <div class="input-group ">
                      <input type = "hidden" value ="<?php echo $user_id ?>" name = "userid"> <!-- Include user_id in the form-->
                      <input type = "hidden" value = "<?php echo $row['product_id'] ?>" name = "productid" >  <!-- Include product_id in the form-->
                      <input type = "hidden" value = "<?php echo $row['name'] ?>" name = "productname" >  <!-- Include product_name in the form-->
                      <input type = "hidden" value = "<?php echo $row['restaurant'] ?>" name = "restaurantname" >  <!-- Include restaurant name in the form-->
                      <button class="input-group-text decrement-btn<?php echo $row['product_id'] ?>">-</button> <!-- Decrement button-->
                      
                    <input type="number" name = "qty" value="1" min = 1 max = "<?php echo $row['stock'] ?>" style = "background-color: white" class="form-control text-center qty-input<?php echo $row['product_id'] ?>" >  <!-- Quantity value-->
                  
                      <button class = "input-group-text increment-btn<?php echo $row['product_id'] ?>">+</button> <!-- Increment button-->
                    </div>
                  </div>
                      </div>
                    
                  </div>
                      </div>
               <!-- Modal Footer -->
                        <div class="modal-footer">
                          <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <?php 
                          $check_product = "SELECT * FROM cart WHERE restaurant_name != '$restaurant_name' AND user_id = $user_id ";
                          $result = mysqli_query($con, $check_product);
                          if (mysqli_num_rows($result) > 0) {
                            echo '<button type="button"  data-bs-toggle="modal" data-bs-target = "#newproduct-modal" name="submit" class="btn text-light justify-align-center add'.$row['product_id'].'" style="background-color:#A3272F" data-id="'.$row['product_id'].'">Add to Cart</button>';
                              
                          }
                          else { 
                            echo '<button type="submit" name="submit" class="btn text-light justify-align-center add'.$row['product_id'].'" style="background-color:#A3272F" data-id="'.$row['product_id'].'">Add to Cart</button>';
                            
                          }
                          ?>
                          
                          
                        </div>
                      </div>
                    </div>
                  </div>
                         
                </div>

              </div>

             </div>
               <!-- NEW PRODUCT MODAL -->   
               <div class="modal fade" id="newproduct-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header" >
                                              <h1 class="modal-title fs-5 " id="exampleModalLabel">Remove previous items?</h1>
                                              <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target = "#checkout" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                You have already selected a different restaurant. If you continue, your cart and selections will be removed. 
                                                </div>
                                        <!-- Modal Footer -->
                                                  <div class="modal-footer">
                                                    <button type="button" class=" btn btn-secondary" data-bs-toggle="modal" data-bs-target = "#checkout">Cancel</button>
                                                  <button type="submit" id = "submit" name = "submit" class=" btn text-light justify-align-center add<?php echo $row['product_id'] ?>" style = "background-color:#A3272F " data-id="<?php echo $row["product_id"]; ?>">Confirm</button>
                                                    </form>
                                                  </div>
                                                </div>
                                              </div>
                                            </div> 

             


<!-- Product Quantity Increment / Decrement Script  -->            
<script> 
     $(document).ready(function () {
  $('.increment-btn<?php echo $row['product_id'] ?>').click(function(e) {
    e.preventDefault();
    var inc_value = $('.qty-input<?php echo $row['product_id'] ?>').val();
    var value = parseInt(inc_value, 10);
    value = isNaN(value) ? 0 : value;
    var stock = <?php echo $row['stock'] ?>;
    if (value < stock) {
      value++;
      $('.qty-input<?php echo $row['product_id'] ?>').val(value);
    }
  });
});

$(document).ready(function () {
  $('.decrement-btn<?php echo $row['product_id'] ?>').click(function(e) {
    e.preventDefault();
    var dec_value = $('.qty-input<?php echo $row['product_id'] ?>').val();
    var value = parseInt(dec_value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
      $('.qty-input<?php echo $row['product_id'] ?>').val(value);
    }
  });
});
      
     </script>

    
   
      
      <?php endwhile; echo '</header>';?>
      
      <?php  } ?>


 
    </div>
    </div>
<!-- Page Footer  --> 
<div style = "margin-top: 500px;">
          <?php include('footer.php') ?>



       

        

<!-- Show Modal script -->    
        <script type = "text/javascript"> 
$('#btn').on('click', function(){ 
  $(#goalmodal).modal('show');
})

</script>
    </body>

    </html>

    <?php

}else {

  echo "<script>alert('You are not authorized to view this page!');window.location='main.php';</script>";
  
  
  
  exit();
  
  
  
  
  }

}else {

echo "<script>alert('You are not authorized to view this page!');window.location='main.php';</script>";



exit();




}



 ?>

