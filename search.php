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
<body>
    
<?php 
session_start();
include_once 'header.php';
include_once 'db_conn.php';

$search_term = trim($_POST['search_term']); 
if(empty($search_term)) {                   // IF USER SEARCHES FOR AN EMPTY STRING THEN RETURN MESSAGE 
 echo "<div class=\"container py-4\">
    <header class=\"pb-3 mb-4 border-bottom\">
        <a href=\"#\" class=\"d-flex align-items-center text-dark text-decoration-none\">
            <span class=\"fs-2 mt-5\">Search Results for '$search_term'</span>
        </a>
    </header>
    <header class=\"pb-3 mb-4 border-bottom\">
        <a  class=\"d-flex align-items-center text-dark text-decoration-none\">
            <span class=\"font-dosis text-dark fs-3 \"><i class=\"fa-solid fa-fire\"></i> Please enter a search term</span>
        </a> 
        <div class=\"album py-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4\">";
} else {
$query = "SELECT * FROM product_list WHERE name OR restaurant LIKE '%$search_term%' OR product_desc LIKE '%$search_term%'";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) == 0) {
  echo "<div class=\"container py-4\">
    <header class=\"pb-3 mb-4 border-bottom\">
        <a href=\"#\" class=\"d-flex align-items-center text-dark text-decoration-none\">
            <span class=\"fs-2 mt-5\">Search Results for '$search_term'</span>
        </a>
    </header>
    <header class=\"pb-3 mb-4 border-bottom\">
        <a href=\"/\" class=\"d-flex align-items-center text-dark text-decoration-none\">
            <span class=\"font-dosis text-dark fs-3 \"><i class=\"fa-solid fa-fire\"></i> Products</span>
            
        </a> 
        <div class=\"album py-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4\">";
} 
else {
echo "<div class=\"container py-4\">
    <header class=\"pb-3 mb-4 border-bottom\">
        <a href=\"#\" class=\"d-flex align-items-center text-dark text-decoration-none\">
            <span class=\"fs-2 mt-5\">Search Results for '$search_term'</span>
        </a>
    </header>
    <header class=\"pb-3 mb-4 border-bottom\">
        <a href=\"/\" class=\"d-flex align-items-center text-dark text-decoration-none\">
            <span class=\"font-dosis text-dark fs-3 \"><i class=\"fa-solid fa-fire\"></i> Products</span>
            
        </a> 
        <div class=\"album py-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4\">"; 

?>
<?php
while ($row = mysqli_fetch_assoc($result)) :
    $product_name = $row['name'];
    $product_description = $row['product_desc'];
    $product_price = $row['price'];

  
    ?>
    <div class="w-100 px-2  " style="max-width: 330px; ">

<!-- PRODUCT Card -->
        <div class="card border-1 rounded-5 shadow-lg">

<!-- PRODUCT Image -->
            <div>
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
            <center>
              </div>
              </div>
<!-- END OF PRODUCT CARD  -->         


  <!-- PRODUCT MODAL -->   
  <div class="modal fade" id="exampleModal<?php echo $row['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
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
            <button class="input-group-text decrement-btn<?php echo $row['product_id'] ?>">-</button> <!-- Decrement button-->
        
          <input type="number" name = "qty" value="1" min = 0 class="form-control text-center qty-input<?php echo $row['product_id'] ?>" >  <!-- Quantity value-->
        
            <button class = "input-group-text increment-btn<?php echo $row['product_id'] ?>">+</button> <!-- Increment button-->
          </div>
        </div>
            </div>
          
        </div>
            </div>
     <!-- Modal Footer -->
              <div class="modal-footer">
                <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name = "submit" class=" btn text-light justify-align-center add<?php echo $row['product_id'] ?>" style = "background-color:#A3272F " data-id="<?php echo $row['product_id']; ?>">Add to Cart</button>
                </form>
              </div>
            </div>
          </div>
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
if (value < 10) { 

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

<?php endwhile;
}
?> 

</header>
<?php

//RESTAURANTS SEARCH RESULT 
echo '


<header class="pb-3 mb-4 border-bottom">
  <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
    <span class="font-dosis text-dark fs-3 "><i class="fa-solid fa-fire"></i> Restaurants </span> <!-- Category name-->
  </a> 

  <div class="album py-4 row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" >'; 

$query = "SELECT * FROM restaurant_list WHERE Name LIKE '%$search_term%'";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $restaurant_name = $row['Name']; 
?>
    <div class="w-100 px-2  " style="max-width: 330px; ">

<!-- Restaurant Card -->
        <div class="card border-1 rounded-5 shadow-lg">

<!-- Restaurant Image -->
            <div>
              <img  style = "max-height: 200px;" class="card-img-top" src="assets/images/<?php echo $row['img_path'] ?>" alt="..." />
            
            </div>
            
<!-- Restaurant Body -->
          <div class="card-body">

<!-- Restaurant Heading -->
            <div class="row mb-2">
              <div class="col">
                <h6 style = "max-width: 200px;"class="mb-0 truncate"><a class = "link-dark font-dosis "style = "text-decoration: none; "href = "index.php"> <?php echo $row['Name'] ?></a></h6>
                
              </div>
            
              
            </div>
            
            
<!-- Restaurant Button -->
            <p style = "min-height: 50px; " class="mb-0 text-muted font-dosis fs-8">
            
            </p> 
            <center>
            <button class="fs-8 btn mt-3 text-light" style = "background-color:#A3272F " data-bs-toggle="modal"><a class = "text-light text-decoration-none" href = "<?php echo $row['target'] ?>">Visit Restaurant</a></button>
            <center>
              </div>
              </div>
</header>
<!-- END OF PRODUCT CARD  --> 
<?php 
} 

}
?> 

<!-- Collapsible Navbar Script -->       
<script>
    function openNav() {
      document.getElementById("mySidebar").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      document.getElementById("side").style.marginLeft = "250px";
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
      document.getElementById("side").style.marginLeft = "0";
    }
</script>

</body>
</html>