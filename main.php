<?php 
session_start(); 
include "restaurant_availability.php"; 
// Check if the user is logged in, else restrict access
if (isset($_SESSION['ID']) && isset($_SESSION['User'])){ 


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
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css"> 

    <link rel="stylesheet" href="bs/css/bootstrap.css"> 
    <link rel="stylesheet" href="flickity-docs.css"> 
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <script src="js/flickity-docs.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head> 

    

    <body style = "background-color : #ffffff"> 
   
    <?php
      include_once 'header.php';

   ?>

<?php
    if(isset($_GET['success'])) {
        echo '<div class="modal fade show" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" >
                        <h1 class="modal-title fs-5 " id="exampleModalLabel">Order Success!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Order successfully submitted.
                    </div>
                    <div class="modal-footer">
                        <a class="text-light"><button type="button" name="submit" data-bs-dismiss="modal" class="btn text-light justify-align-center" style="background-color:#A3272F ">Close</button></a>
                    </div>
                </div>
            </div>
        </div>';
        unset($_GET['success']);
        echo '<script>
        $(document).ready(function(){
            $("#successModal").modal("show");
        });
    </script>';
    }
?>
    
    <!-- Carousel -->
    <div class="" data-flickity="" data-js="hero-carousel">
    
    <div class=" hero-carousel__cell--1"> <!-- First Carousel -->
      <a href = "chowking.php"><img src="assets/images/promo1.JPG" style = "background-size: cover;" class="hero-carousel__cell d-block w-100" alt="..."></a>
    </div>
    
    <div class="hero-carousel__cell--2">  <!-- Second Carousel -->
    <a href = "turks.php"><img src="assets/images/promo2.JPG" class=" hero-carousel__cell d-block w-100" alt="..."></a>
    </div>
    
    <div class="hero-carousel__cell--3">  <!-- Third Carousel -->
    <a href = "chowking.php"><img src="assets/images/promo1.JPG" class="hero-carousel__cell d-block w-100" alt="..."></a>
    </div>
    
    <div class="hero-carousel__cell--4">  <!-- Fourth Carousel -->
    <a href = "turks.php"><img src="assets/images/promo2.JPG" class="hero-carousel__cell  d-block w-100" alt="..."></a>
    </div>
  </div>

          
      <center>
      <h1 class="h1 mt-5 mb-1 fw-normal text-dark font-dosis">Featured Meals</h1>
      <h1 class="h6 mt-1 mb-4 fw-normal text-dark font-dosis">Our most sought-after products</h1> <br> 
    </center> 

    <div class="carousell flickity-viewport-visible" data-flickity='{"cellAlign": "left", "contain": true, "imagesLoaded": true, "pageDots": false}'>
      <div class="carousell-cell" style = "background-color: white;"></div>
      
      <!-- FEATURED MEALS LOOPING--> 
       <?php 
              include ('db_conn.php'); 
              $qry = $con->query("SELECT * FROM  product_list WHERE feature = 1 order by product_id ASC");
              while($row = $qry->fetch_assoc()):
                ?> 
                <?php "<br>" ?>

      <!-- FEATURED MEALS  --> 
      <div class="w-100 px-2" style="max-width: 350px;">  <!-- Product Card -->

        <!-- Card -->
        <a href = "<?php $restaurant = $row['restaurant'];
      $qryy = $con->query("SELECT target FROM  restaurant_list WHERE Name = '$restaurant'");
      $roww = $qryy->fetch_assoc();
        echo $roww['target'];
        
        ?>.php">
        <div class="card border-0  ">
         
          <!-- Image -->
            <div>
              <img  style = "max-height: 222px;" class=" card-img-top" src="assets/images/<?php echo $row['img_path'] ?>" alt="..." />
            </div>
           
          <!-- Body -->
          <div class="card-body">
          
            <!-- Heading -->
            <div class="row mb-2">
              <div class="col">
                <h6 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "<?php echo $roww['target'] ?>.php"> <?php echo $row['name'] ?></a></h6>
                <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "<?php echo $roww['target']?>.php"> <?php echo $row['restaurant'] ?> </a></h7>
              </div>
              <div class="col-auto">
                <span class="fs-7 font-serif text-black font-dosis">₱<?php echo $row['price'] ?></span>
              </div>
            </div>

            <!-- Text -->
            <p class="mb-0 text-muted font-dosis">
              <a class = "text-muted link-dark font-dosis"style = "text-decoration: none; "href = "<?php echo $roww['target']?>.php">
            <?php echo $row['product_desc'] ?>
              </a>
            </p>

          </div>

        </div>
        </a>
      </div>
     
      <?php endwhile; ?>
      <div class="carousell-cell" style = "background-color: white;"></div>
    </div>
    
    
    <hr class="featurette-divider">  
    <center>
      <h1 class="h1 mt-5 mb-1 fw-normal text-dark font-dosis">All Restaurants </h1>
      </center>
    <main id = "designs">

      <!-- LOOPING TO GET ALL AVAILABLE RESTAURANTS INFO --> 
      
        <div class="album py-3" style = "margin-right: 5%; margin-left: 5%;">
          <div class="">
      
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4"> 
              <?php 
              include ('db_conn.php'); 
              $qry = $con->query("SELECT * FROM  restaurant_list WHERE avl = '1' order by id ASC ");
              while($row = $qry->fetch_assoc()):
                ?> 
                <?php "<br>" ?>
              <div class="col "  >
                <div class="card border-0 shadow-lg bg-light">
                  <img style = "max-height: 200px;" src = "assets/images/<?php echo $row['img_path'] ?>" class="bd-placeholder-img " width="" height=""> 
            <div class="image__overlay image__overlay--blur">
              <a href="<?php echo $row['target']?>.php" class = "text-decoration-none link-light fs-5"><div class="image__title font-dosis text-decoration-none "><?php echo $row['Name'] ?></div></a> 
            </div>
          </div> 
          <div class="card shadow-sm ">
                  
                </div>
              </div> 
      
     
          <?php endwhile; ?>

          <!-- LOOPING TO GET ALL CLOSED RESTAURANTS INFO -->
          <?php 
              include ('db_conn.php'); 
              $qry = $con->query("SELECT * FROM  restaurant_list WHERE avl = '0' order by id ASC ");
              while($row = $qry->fetch_assoc()):
                ?> 
                <?php "<br>" ?>
              <div class="col "  >
                <div class="card border-0 shadow-lg bg-light">
                  <img style = "max-height: 200px;" src = "assets/images/<?php echo $row['img_path'] ?>" class="darkened-image bd-placeholder-img " width="" height=""> 
            <div class="image__overlayy ">
              <a href = "#"  data-bs-toggle="modal" data-bs-target = "#closed-<?php echo $row['Name']?>" class = "text-muted text-decoration-none link-light fs-1"><div class="image__title font-dosis text-decoration-none ">CLOSED</div></a> 
            </div>
          </div> 
          <div class="card shadow-sm ">
                  
                </div>
              </div> 
      
     <!-- LOG OUT MODAL -->   
<div class="modal fade" id="closed-<?php echo $row['Name']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Closed</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <?php echo $row['Name']; echo" is currently closed. Please check again later."; ?>
                      </div>
               <!-- Modal Footer -->
                        <div class="modal-footer">
                          
                          <a class = "text-light" ><button type="button" name = "submit" data-bs-dismiss="modal" class=" btn text-light justify-align-center" style = "background-color:#A3272F ">Close</button></a>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endwhile; ?>  
                </div>
                
              </div>
             
             </div>
          

        
      </main> 
      <hr class="featurette-divider"> 
      
      </div> 

      <?php include('footer.php') ?>



    </body>

    </html>

    <?php 
    }else { 
          header("Location: index.php"); 
          exit(); 

    }
    ?>