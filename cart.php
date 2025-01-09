<?php 
session_start(); 
include 'restaurant_availability.php'; 
if (isset($_SESSION['ID']) && isset($_SESSION['User'])){ 


?>

<!-- GET USER PERSONAL DETAILS-->
<?php
require_once 'db_conn.php';
$user_id = $_SESSION['ID'];
$sql = "SELECT Phone FROM customer WHERE ID = $user_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$_SESSION['Phone'] = $row['Phone'];

$sql_email = "SELECT Email FROM customer WHERE ID = $user_id";
$result = mysqli_query($con, $sql_email);
$row = mysqli_fetch_assoc($result);
$_SESSION['Email'] = $row['Email'];


$sql_cart = "SELECT * FROM cart";
$all_cart = $con->query($sql_cart);

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






<script>
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
    

    <body style = "background-color : #ffffff "> 
    
    <?php
      include_once 'header.php';

   ?>

          
 
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h4>My Cart</h4>
                <hr>
            
                <?php
                
                    $total = 0;
                    $formatted_total = number_format($total, 2, '.', ',');
                    while($row_cart = mysqli_fetch_assoc($all_cart2)){
                        $sql = "SELECT * FROM product_list WHERE product_id=".$row_cart["product_id"];
                        $qtyy = $row_cart["qty"]; 
                        $all_product = $con->query($sql);
                        while($row = mysqli_fetch_assoc($all_product)){
                           $restaurant = $row["restaurant"]; 
                           $stock = $row["stock"];  
                           $product_name = $row['name']; 
                           
                           $total = $total + (float)$qtyy*(float)$row['price'];
                           $formatted_total = number_format($total, 2, '.', ','); 
                           
                           if ($qtyy > 0){ 
                ?>
                    
                                <div class="border rounded">
                                    <div class="row bg-white">
                                        <div class="col-md-3 pl-0">
                                            <img src="assets/images/<?php echo $row["img_path"]; ?>" alt="">
                                        </div>
                                        <div class="col-md-6">
                                            <h5 class="pt-2"><?php echo $row["name"]; ?></h5>
                                            <h5 class="pt-2">₱<?php echo $row["price"]; ?></h5>
                                            <button href = "#"  data-bs-toggle="modal" data-bs-target = "#remove-modal<?php echo $row['product_id'] ?>" class="btn btn-danger">Remove</button>
                                        </div>
                                        <div class="col-md-3 py-5">
                                        <div>
                                            
                                            <input type="text" value="<?php     #IF STOCK BECOMES LESS THAN THE QUANTITY ADDED TO CART BY USER THEN IT FORCES CART QUANTITY TO BECOME EQUAL TO STOCK 
                                             if ($qtyy > $stock) { 
                                              $qtyy = $stock; 
                                              $find_cart = "SELECT * FROM cart WHERE product_name = '$product_name' AND user_id = '$user_id'";
                                              $result = mysqli_query($con, $find_cart); 
                                              if (mysqli_num_rows($result) > 0) { 
                                                $update_qty = "UPDATE cart SET qty = $qtyy WHERE product_name = '$product_name' AND user_id = '$user_id'"; 
                                                mysqli_query($con, $update_qty);
                                              } 
                                              } 
                                              echo $qtyy; ?>" class="quantity-input<?php echo $row["product_id"]; ?> form-control w-25 d-inline">
                                            <button class="fs-8 btn mb-1 text-light" style = "background-color:#A3272F " data-bs-toggle="modal"  data-bs-target="#editModal<?php echo $row['product_id'] ?>">Edit quantity</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                 <!-- EDIT QUANTITY MODAL -->   
            <div class="modal fade" id="editModal<?php echo $row['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Cart</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

            <!-- EDIT QUANTITY MODALCard -->
                  <div class="card border-1 rounded-5 shadow-lg">

            <!-- EDIT QUANTITY MODAL Image -->
                          <div>
                            <img  style = "max-height: 200px;" class="card-img-top" src="assets/images/<?php echo $row['img_path'] ?>" alt="..." />
                          
                          </div>
                          
            <!-- EDIT QUANTITY MODAL Body -->
                        <div class="card-body" >

            <!-- EDIT QUANTITY MODAL -->
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
                          
                          
            <!-- EDIT QUANTITY MODAL -->
                          <p style = "min-height: 50px; " class="mb-0 text-muted font-dosis fs-8">
                          <!-- MODAL PRODUCT DESRIPTION  -->
                          <?php echo $row['product_desc'] ?>
                          </p> 
            <!-- EDIT QUANTITY MODAL FORM -->
                          <div class="form-group"> 
                      <form action = "update_quantity.php" method = "POST" ><!-- Submit order form to addtocart.php -->
                      <div class="row">
                        <div class="col-md-2"><label class="control-label">Qty</label></div>
                        <div class="input-group col-md-9 mb-3 " >
                        
                          
                        <div class="input-group ">
                      <input type = "hidden" value ="<?php echo $user_id ?>" name = "userid"> <!-- Include user_id in the form-->
                      <input type = "hidden" value = "<?php echo $row['product_id'] ?>" name = "productid" >  <!-- Include product_id in the form-->
                      <input type = "hidden" value = "<?php echo $row['name'] ?>" name = "productname" >  <!-- Include product_name in the form-->
                      <button class="input-group-text decrement-btnn<?php echo $row['product_id'] ?>">-</button> <!-- Decrement button-->
                  
                    <input type="number" name = "qty" value="<?php echo $qtyy ?>" min = 0 max = "<?php echo $row['stock'] ?>" style = "background-color: white" class="form-control text-center qty-input<?php echo $row['product_id'] ?>">  <!-- Quantity value-->
                  
                      <button class = "input-group-text increment-btnn<?php echo $row['product_id'] ?>">+</button> <!-- Increment button-->
                    </div>
                  </div>
                      </div>
                    
                  </div>
                      </div>
               <!-- EDIT QUANTITY MODAL Footer -->
                        <div class="modal-footer">
                          <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" name = "submit" class=" btn text-light justify-align-center add<?php echo $row['product_id'] ?>" style = "background-color:#A3272F " data-id="<?php echo $row['product_id']; ?>">Edit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                            
                </div>

              </div>

              <!-- REMOVE FROM CART MODAL -->   
            <div class="modal fade" id="remove-modal<?php echo $row['product_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Remove from Cart</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to remove <?php echo $row['name'];?>?
                      </div>
               <!-- Modal Footer -->
                        <div class="modal-footer">
                          <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <a class = "text-light remove" href ="#" data-id="<?php echo $row["product_id"]; ?>"><button type="button" name = "submit" class=" btn text-light justify-align-center remove" style = "background-color:#A3272F " data-id="<?php echo $row["product_id"]; ?>">Confirm</button></a>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                 
                            
                

              
                           
                  
               <!-- Product Quantity Increment / Decrement Script  -->            
  <!-- Product Quantity Increment / Decrement Script  -->            
<script> 
     $(document).ready(function () {
  $('.increment-btnn<?php echo $row['product_id'] ?>').click(function(e) {
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
  $('.decrement-btnn<?php echo $row['product_id'] ?>').click(function(e) {
    e.preventDefault();
    var dec_value = $('.qty-input<?php echo $row['product_id'] ?>').val();
    var value = parseInt(dec_value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 0) {
      value--;
      $('.qty-input<?php echo $row['product_id'] ?>').val(value);
    }
  });
});
      
     </script>


                

                                <?php 
                        } 
                        else { 
                          $find_cart = "SELECT * FROM cart WHERE product_name = '$product_name' AND user_id = '$user_id'";
                                              $result = mysqli_query($con, $find_cart); 
                                              if (mysqli_num_rows($result) > 0) { 
                                                $update_qty = "DELETE FROM cart WHERE product_name = '$product_name' AND user_id = '$user_id'"; 
                                                mysqli_query($con, $update_qty);
                                              } 
                        }
                         }
                    }
                ?>
            </div>
        </div>
<!-- END OF WHILE LOOP --> 

<!-- TOTAL PAYMENT AMOUNT -->      
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <h6>Price (<?php echo mysqli_num_rows($all_cart2); ?> items)</h6> <!-- CHECKS THE TOTAL AMOUNT OF ITEMS IN THE CART -->    
                        <hr>
                        <h6>Amount Payable</h6> 
                    </div>
                    <div class="col-md-6">
                        <h6>₱<?php echo $formatted_total; ?></h6>
                        <hr>
                        <h6>₱<?php
                            echo $formatted_total;
                            ?></h6>
                            
                    </div>
                </div>
            </div>
            <div>
                <?php
                    if (mysqli_num_rows($all_cart2) == 0) {
                        echo '<center><p class = "mt-3" >Your cart is currently empty.</p></center>';
                    } else {
                      include 'restaurant_availability.php'; 
                      $get_restaurants_query = "SELECT * FROM restaurant_list WHERE Name = '$restaurant'";
                      $get_restaurants_result = mysqli_query($con, $get_restaurants_query);
                      $restaurant_row = mysqli_fetch_assoc($get_restaurants_result);
                      $current_restaurant = $restaurant_row['ID'];
                      $opening_time = $restaurant_row['opening_time'];
                      $closing_time = $restaurant_row['closing_time'];
                      
                      if ($current_time >= $opening_time && $current_time <= $closing_time) {
                        
                        echo '<center> <button class = "col-md-12 mb-2 mt-4 rounded-5 btn-sm btn-red text-light " id = "checkout-button" style = " height: 50px;" data-bs-toggle="modal"  data-bs-target="#checkout"> Continue to Checkout </button></center>';
                      } else {
                        echo '<center> <button class = "col-md-12 mb-2 mt-4 rounded-5 btn-sm btn-red text-light " id = "checkout-button" style = " height: 50px;" data-bs-toggle="modal"  data-bs-target="#closed-modal"> Continue to Checkout </button></center>';
                      }

                    }
                ?>
            </div>
        </div> 
    </div>
</div> 






<!-- CHECKOUT MODAL -->   

<div class="modal fade" id="checkout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
    <div class="modal-header">
<!-- MODAL TITLE-->
        <h1 class="modal-title fs-5" id="exampleModalLabel">Checkout</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">

<!-- MODAL PERSONAL DETAILS CARD -->
    <div class="card border-1 rounded-5 shadow-lg">

<!-- MODAL Body -->
            <div class="card-body" >

<!-- MODAL Heading -->
            <div class="row mb-2">
                <div class="col">
                <!-- MODAL Personal Details -->
                <h6 class = "font-dosis text-start text-red" style = "max-width: 400px;" class="mb-0 truncate ">Personal Details</h6> 
                <!-- MODAL User First Name & Last Name   -->
                <h6 class = "font-dosis text-start fs-8" style = "max-width: 400px;" class="mb-0 truncate "><?php echo $_SESSION['Fname']." ".$_SESSION['Lname'] ?></h6>
                <!-- MODAL User Email Address  -->
                <p class="mb-0 text-muted font-dosis fs-8"> <?php  echo $_SESSION['Email'] ?></p> 
                <!-- MODAL User Phone Number  -->
                <p class="mb-0 text-muted font-dosis fs-8"> <?php  echo $_SESSION['Phone'] ?></p> 
                </div>
                <!-- MODAL Edit Button  -->
                <div class="col-auto">
               <!--- <a href = "#" class="fs-8 font-dosis link-red">Edit</a> -->
                </div>
                </div>          
            </div> 
</div>
<!-- Payment Methods CARD -->
    <div class="card border-1 rounded-5 shadow-lg mt-3">

<!-- MODAL Body -->
            <div class="card-body" >

<!-- MODAL Heading -->
            <div class="row mb-2">
                <div class="col">
                <!-- MODAL Personal Details -->
                <h6 class = "font-dosis text-start text-red" style = "max-width: 400px;" class="mb-0 truncate ">Payment Methods</h6> 
                <div class="col-md-12">

<!-- MODAL DEBIT / CREDIT CARD PAYMENT METHOD -->

<form action = "checkout.php" method = "POST" class="needs-validation" novalidate>
<input type = "hidden" value ="1" name = "checkout_confirm">
<input type = "hidden" value ="<?php echo $user_id ?>" name = "userid">
<input type = "hidden" value ="<?php echo $total?>" name = "total_amount">
<input type = "hidden" value ="<?php echo $restaurant?>" name = "restaurant_name">



    

<!-- MODAL GCASH PAYMENT METHOD -->
<div class=" py-sm-3 px-sm-3  rounded-3 mb-3 " style = "background-color: rgb(245, 243, 243);">                                                    
<label class="radio-inline mr-3 h6">
<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="gcash" checked> GCash
</label>
<div class="panel panel-default">
    
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
        <div class="panel-body">
    
        </div>
    </div>
    </div>
</div>
    </div>  





    
<!-- PAYMENT METHOD CASH -->
<div class=" py-sm-3 px-sm-3  rounded-3  " style = "background-color: rgb(245, 243, 243);">
<label class="radio-inline ml-3 h6">
<input type="radio" name="inlineRadioOptions" id="inlineRadio5" value="cash"> Cash
</label>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<div class="panel panel-default">
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
    <div class="panel-body">
        
    </div>
    </div>
</div>
</div>
</div>


</div>
</div>
                </div>          
            </div> 
</div>
<div class="card border-1 rounded-5 shadow-lg">
<div class="modal-footer">
<button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
<button type="button" data-bs-toggle="modal" data-bs-target = "#confirm-modal" class=" btn text-light justify-align-center add<?php echo $row['product_id'] ?>"  style = "background-color:#A3272F ">Proceed to Payment</button>
 

</div>
</div>
</div>
</div>
</div>
</div> 

<!-- CLOSED RESTAURANT MODAL -->   
<div class="modal fade" id="closed-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Restaurant Closed</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <?php echo $restaurant; ?> are currently closed. Please try again later. 
                      </div>
               <!-- Modal Footer -->
                        <div class="modal-footer">
                          <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         
                        </div>
                      </div>
                    </div>
                  </div>
                            
                </div>

              </div>

             </div>

<!-- CONFIRM ORDER MODAL -->   
<div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Confirm Order</h1>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target = "#checkout" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to confirm your order?
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
                  </form>

<!-- PAYMENT METHOD RADIO BUTTON SELECTION SCRIPT-->
    <script> 
    $(document).ready(function () {
    $("input[name='inlineRadioOptions']").click(function () {
        var checkedValue = $("input[name='inlineRadioOptions']:checked").val();
        console.log(checkedValue);
        if (checkedValue == "debitcard") {
            $("#collapseOne").collapse('show');
            $("#collapseTwo").collapse('hide');
            $("#collapseThree").collapse('hide');
            $("#collapseFour").collapse('hide');
            $("#collapseFive").collapse('hide');
        } 
        
        else if (checkedValue == "gcash") {
            $("#collapseOne").collapse('hide');
            $("#collapseTwo").collapse('show');
            $("#collapseThree").collapse('hide');
            $("#collapseFour").collapse('hide');
            $("#collapseFive").collapse('hide');
            

        } 
        
        else if (checkedValue == "maya") {
            $("#collapseOne").collapse('hide');
            $("#collapseTwo").collapse('hide');
            $("#collapseThree").collapse('show');
            $("#collapseFour").collapse('hide');
            $("#collapseFive").collapse('hide');
            

        } 
       
        else if (checkedValue == "option4") {
            $("#collapseOne").collapse('hide');
            $("#collapseTwo").collapse('hide');
            $("#collapseThree").collapse('hide');
            $("#collapseFour").collapse('show');
            $("#collapseFive").collapse('hide');
            

        } 

        else if (checkedValue == "cash") {
            $("#collapseOne").collapse('hide');
            $("#collapseTwo").collapse('hide');
            $("#collapseThree").collapse('hide');
            $("#collapseFour").collapse('hide');
            $("#collapseFive").collapse('show');
            

        } 

        else {
            console.log("Oops.");
        }
    });
}); 
</script>



   


<!-- REMOVE FROM CART SCRIPT  --> 
<script>
        var remove = document.getElementsByClassName("remove");
        for(var i = 0; i<remove.length; i++){
            remove[i].addEventListener("click",function(event){
                var target = event.target;
                var cart_id = target.getAttribute("data-id");
                var xml = new XMLHttpRequest();
                xml.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                       target.innerHTML = this.responseText;
                       target.style.opacity = .3; 
                       location.reload();
                    }
                }

                xml.open("GET","db_conn.php?cart_id="+cart_id,true);
                xml.send();
            })
        }
</script>

 


        <script type = "text/javascript"> 
$('#btn').on('click', function(){ 
  $(#goalmodal).modal('show');
})
</script>
    </body>

    </html>

    <?php 
    }else { 
          header("Location: index.php"); 
          exit(); 

    }
    ?> 