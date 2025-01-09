<?php 
// from cart.php / sends all the order information into order_list / order_product and clears cart 

// Validates if the user has gone through the checkout process 
// if not, then the user returns to the cart page.
session_start();
if(!isset($_POST['checkout_confirm'])){
    header("Location: cart.php");
    exit();
}
?>
<html> 
    <head>
    <link rel="icon" href="assets/images/lpu.png"> 
   
   <meta charset="utf-8"> 

    <meta name="author"  content="Luis Mayrina">
    <meta name="description" content="Lyceum of the Philippines University - Cavite Canteen Ordering" >
    <meta name="keywords" content="HTML, CSS, JAVASCRIPT, JQUERY, WEB DEVELOPMENT, FREELANCE DEVELOPER, WEB DESIGNER PHILIPPINES">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "refresh" content = ""> 
    <title> Canteen Ordering and Queueing System</title>
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="page.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="bs/css/bootstrap.css"> 
    <link rel="stylesheet" href="flickity-docs.css"> 

    <link rel="stylesheet" href="cart-copy.css">

    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;700&display=swap" rel="stylesheet">
     
    <script src="js/flickity-docs.min.js"></script>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</head>
    
    <body> 

    


<?php 
include_once 'db_conn.php'; 
$restaurant = $_POST['restaurant_name'];
$payment_method = $_POST['inlineRadioOptions']; 
$user_id = $_POST['userid']; 
$user = $_SESSION['User'];
$product_ids = array();
$quantities = array();
$product_name = array(); 
$total_amount = $_POST['total_amount']; 

if (isset($_POST['order_id'])) {
  // If order_id is already set, do not run SQL processes (if order came from order_history)
  $order_id = $_POST['order_id'];
} else {
// Get product_ids and quantities from cart table
$sqll = "SELECT product_id, qty FROM cart WHERE user_id = $user_id";
$result = mysqli_query($con, $sqll);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($product_ids, $row["product_id"]);
        array_push($quantities, $row["qty"]);
    }
} 



// Insert order information into order_list table
$sql = "INSERT INTO order_list (user_id, restaurant_name, payment_method, total_amount, status, order_time, user) VALUES ('$user_id', '$restaurant', '$payment_method', '$total_amount', 'To Pay', CURRENT_TIMESTAMP, '$user')";

// Check if record is inserted successfully then display the order id 
if(mysqli_query($con, $sql)){
    // Get last inserted order_id
    $order_id = mysqli_insert_id($con);
    
}else{
    echo "Error inserting record: " . mysqli_error($con);
}

// Insert product_ids and quantities into a separate table with the same order_id
foreach ($product_ids as $index => $product_id) {
  $quantity = $quantities[$index];
  $product_name = mysqli_query($con, "SELECT name FROM product_list WHERE product_id = $product_id");
$product_name = mysqli_fetch_assoc($product_name)['name'];
$product_price = mysqli_query($con, "SELECT price FROM product_list WHERE product_id = $product_id");
$product_price = mysqli_fetch_assoc($product_price)['price'];;
  $sql = "INSERT INTO order_products (order_id, product_id, product_name, qty, product_price) VALUES ('$order_id', '$product_id', '$product_name', '$quantity', '$product_price')";

  if(mysqli_query($con, $sql)){
      
  }else{
      echo "Error inserting record: " . mysqli_error($con);
  }
}

// Clear cart table
$sql = "DELETE FROM cart WHERE user_id = $user_id";
if(mysqli_query($con, $sql)){
    
}else{
    echo "Error clearing cart: " . mysqli_error($con);
}
}
// Custom modal depending on the chosen payment method
echo '<div class="" tabindex="-1">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Payment</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <div class="card border-0  ">';
    
if ($payment_method == "gcash") { 
  if ($restaurant == "Waffle Time"){ 
echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/gcash.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      ';
    }
    else if ($restaurant == "Ava Cakery"){ 
      echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/qr_avacakery.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      '; 
      
    } 

    else if ($restaurant == "Warm Fuzzies"){ 
      echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/qr_warmfuzzies.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      '; 
      
    } 

    else if ($restaurant == "KIMPOP"){ 
      echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/qr_kimpop.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      '; 
      
    } 

    else if ($restaurant == "Turks"){ 
      echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/qr_turks.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      '; 
      
    } 

    else if ($restaurant == "Chowking"){ 
      echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/qr_chowking.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      '; 
      
    }  



    

    else if ($restaurant == "Kusina ni Tata Rod"){ 
      echo '
<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/qr_kntr.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      '; 
      
    } 
    
    
    
}
else if ($payment_method == "maya"){ 
    echo '<!-- Image -->
  <div>
    <img  style = "max-height: 500px;" class=" card-img-top" src="assets/images/maya.jpg" alt="..." />
   
  </div>
  
<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please include your student id in the message section when sending payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      ';
}
else if ($payment_method == "cash"){ 
    echo '<!-- Body -->
<div class="card-body">

  <!-- Heading -->
  <div class="row mb-2">
    <div class="col-12">
      <h5 class="mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; ">  Please proceed to the canteen for payment</a></h5>
      <h7 class="fs-8 mb-0"><a class = "link-dark font-dosis"style = "text-decoration: none; "href = "index.php">   </a></h7>
    </div>
    
  </div>

  <!-- Text -->
  <div class="col-auto">
  <span class="fs-7 font-serif text-black font-dosis">Total amount to be paid: ₱'.$total_amount.'</span>
    </div>

</div>

</div>
      </div>
      ';
}


echo '<div class="modal-footer">
<form action = "submit_order.php" method = "POST"> 
<input type = "hidden" value ="1" name = "checkout_confirm">
<input type = "hidden" value ="'.$user_id.'" name = "user_id">
<input type = "hidden" name = "order_id" value = "'.$order_id.'">
<button type="button" class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target = "#cancel-modal">Cancel</button>
<button type="submit" id = "submit" class="btn text-light" style = "background-color:#A3272F ">Proceed</button>
</form>
</div>
</div>
</div>
</div>

<!-- CANCEL ORDER MODAL -->   
<div class="modal fade" id="cancel-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Cancel Order?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to cancel your order?
                      </div>
               <!-- Modal Footer -->
                       <form action = "cancel_order.php" method = "POST">
                       <input type = "hidden" value ="'.$user_id.'" name = "user_id">
                      <input type = "hidden" name = "order_id" value = "'.$order_id.'">
                        <div class="modal-footer">
                          <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" name = "submit" class=" btn text-light justify-align-center" style = "background-color:#A3272F ">Confirm</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                            
                </div>

              </div>

             </div>';

// Redirects the customer back to the cart page if the user cancels the payment
?> 
<script>
function redirectToCart(){
  window.history.back();
}
</script>

</body>
</head> 

</html> 