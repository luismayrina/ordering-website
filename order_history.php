<?php 
session_start(); 

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
            <div class="shopping-cart" >
                <div style = " overflow-y: hidden;">
                    <h4>Order History</h4>
                    <hr>
                </div>
                <?php
                    date_default_timezone_set('Asia/Manila');
                    $total = 0;
                    // SELECT FROM ORDER_LIST (ORDER HISTORY) TABLE SAME AS USERID 
                    $sqll = "SELECT * FROM order_list WHERE user_id=".$_SESSION['ID']." ORDER BY order_id DESC";       
                    $all_order = $con->query($sqll);                                        // ORDER LIST TABLE 

                    while($row_order = mysqli_fetch_assoc($all_order)){                     // ORDER LIST TABLE 
                      $id = $row_order['user_id']; 
                      $order_id = $row_order['order_id']; 
                      $history_total_amount = $row_order['total_amount'];
                      $formatted_number = number_format($history_total_amount, 2, '.', ',');
                      $order_time = $row_order['order_time'];
                      $formatted_time = date('F j, Y, g:i a', strtotime($order_time));
                      $order_status = $row_order['status'];
                      $sql = "SELECT * FROM order_products WHERE order_id = $order_id";     // ORDER_PRODUCTS TABLE 
                      $all_product = $con->query($sql);                                     // ORDER_PRODUCTS TABLE 
                    
                      if ($all_product->num_rows > 0) {
                        $row = $all_product->fetch_assoc();
                        $product_namee = $row['product_name'];
                    } else {
                        $product_namee = '';
                    } 
                    $sqll = "SELECT * FROM product_list WHERE name = '$product_namee'";
                    $all_productt = $con->query($sqll);   
                    if ($all_productt->num_rows > 0) {
                        $row = $all_productt->fetch_assoc();
                        $restaurant_namee = $row['restaurant'];
                    } else {
                        $restaurant_namee = '';
                    } 

                    $sqlll = "SELECT img_path FROM restaurant_list WHERE Name= '$restaurant_namee'";
                    $all_producttt = $con->query($sqlll);   
                    if ($all_producttt->num_rows > 0) {
                        $row = $all_producttt->fetch_assoc();
                        $img_namee = $row['img_path'];
                    } else {
                        $img_namee = '';
                    }
                    $sql = "SELECT * FROM order_products WHERE order_id = $order_id";     // ORDER_PRODUCTS TABLE 
                    $all_product = $con->query($sql);                     
                          
                ?>
                    
                        <div class="border rounded widthh" style = "max-width: 1000px; min-width: 400px; ">
                            <div class="row bg-white" >
                                <div style = "max-width: 500px; "class="col-md-3 pl-0">
                                <img style="max-width: 100%;  max-height: 500px; min-height: 150px; width: auto;" src="assets/images/<?php echo $img_namee ?>" alt="">
                                </div>
                                <div class="col-md-6">
                                <h6 class="pt-2"><?php echo $restaurant_namee . ' - ' . $order_status; ?></h6>
                                    <h6 class="pt-2">₱<?php echo $formatted_number ?></h6>
                                    <h7 class="pt-2 fs-8 text-muted" > <?php echo $formatted_time; ?></h7>
                                </div>
                                <div class="col-md-3 py-5">
                                <div>
                             
                                   
                                    <button class="fs-8 btn mb-1 text-light " style = "background-color:#A3272F " data-bs-toggle="modal"  data-bs-target="#editModal<?php echo $order_id?>">View order</button>
                                </div>
                                </div>
                            </div>
                        </div>
                
               
                   
                 <!-- EDIT QUANTITY MODAL -->   
            <div class="modal fade" id="editModal<?php echo $order_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Order #<?php echo $order_id ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

            <!-- EDIT QUANTITY MODALCard -->
                  <div class="card border-1 rounded-5 shadow-lg">

            <!-- EDIT QUANTITY MODAL Image -->
                          
                          
            <!-- EDIT QUANTITY MODAL Body -->
                        <div class="card-body" >

            <!-- EDIT QUANTITY MODAL -->
                          <div class="row mb-2">
                            
                              <!-- MODAL PRODUCT NAME  -->
                              <h6 class = "font-dosis text-start" style = "max-width: 400px;" class="mb-0 truncate "><?php  ?></h6> 
                              <!-- MODAL PRODUCT RESTAURANT  -->
                             
                            
                            <!-- MODAL PRODUCT PRICE  -->
                            <div class="col">
                            <?php while($row_products = mysqli_fetch_assoc($all_product)){ 
                        $product_name = $row_products['product_name'] ;  
                        $qty =  $row_products['qty'];
                        $price =  $row_products['product_price'];
                        ?>
                        <div>
                        <?php include ('db_conn.php'); 
                            // Search for items in the product_list that includes the restaurant name "Waffle Time"
                             $qry = $con->query("SELECT * FROM  product_list WHERE name = '$product_name' "); 
                                while($row = $qry->fetch_assoc()): ?>
                                    <div class="border rounded mb-3">
                                    <div class="row bg-white">
                                        <div class="col-md-3 pl-0">
                                            <img style = "min-height: 100px; min-width: 100px;" src="assets/images/<?php echo $row["img_path"]; ?>" alt="">
                                        </div>
                                        <div class="col-md-6 ">
                                        <span class="fs-6 font-serif text-black font-dosis"><?php echo $product_name ?></span> <br> 
                                        <span class="fs-7 font-serif text-black font-dosis">₱<?php echo ($qty*$price); ?></span> <br> 
                                        <span class="fs-8 font-serif text-black font-dosis text-muted">Quantity: <?php echo $qty; ?></span> <br>     
                                        </div>
                                        
                                    </div>
                                </div>
                          <?php endwhile?>
                          </div>
                             
                              
                              <?php } ?>
                            </div>
                            
                          </div>
                          
                          
            <!-- EDIT QUANTITY MODAL -->
                          <p style = "min-height: 50px; " class="mb-0 text-muted font-dosis fs-8">
                          <!-- MODAL PRODUCT DESRIPTION  -->
                          
                          </p> 
            <!-- EDIT QUANTITY MODAL FORM -->
                        
                    
                  
                      </div>
                      <?php  ?>
               <!-- EDIT QUANTITY MODAL Footer -->
                        <div class="modal-footer">
                        <h5 class = "col" >Status: <h7 class = "text-red"><?php echo $order_status ?></h5><br>
                        <h5 class = "col-3" >Total: <h7 class = "text-red"><?php echo "₱$formatted_number" ?> </h7></h5>  
                          
                          <?php 
                            if ($order_status == "To Pay"){ 
                               echo '
                                <button type="submit" class="row-cols-3  btn btn-secondary" data-bs-toggle="modal"  data-bs-target="#cancel-modal'.$order_id.'" >Cancel</button>
                               
                               <button type="submit" name = "submit" class=" row-cols-2 btn text-light justify-align-center add<?php  ?>" style = "background-color:#A3272F " id = "checkout-button" data-bs-toggle="modal"  data-bs-target="#checkout'.$order_id.'" >Pay Now</button>';
                            } 
                         ?>
                        </div>
                      </div>
                    </div>
                  </div>
                            
                </div>

              </div>
                              
                         
<!-- CHECKOUT MODAL -->   

<div class="modal fade" id="checkout<?php echo $order_id?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href = "#" class="fs-8 font-dosis link-red">Edit</a>
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
<input type = "hidden" value ="<?php echo $restaurant_namee ?>" name = "restaurant_name">
<input type = "hidden" value ="<?php echo $formatted_number?>" name = "total_amount">
<input type = "hidden" value ="<?php echo $order_id ?>" name = "order_id">

    

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

<button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" id = "submit" class=" btn text-light justify-align-center add<?php echo $row['product_id'] ?>" data-id="<?php echo $row['product_id']; ?> " style = "background-color:#A3272F ">Proceed to Payment</button>
</form>
</div>
</div>
</div>
</div>
</div> 

<!-- CANCEL ORDER MODAL  -->
<div class="modal fade" id="cancel-modal<?php echo $order_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Cancel Order</h1>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target = "#checkout" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to cancel your order? 
                      </div>
               <!-- Modal Footer -->
                        <div class="modal-footer">
                        <form action = "cancel_order.php" method = "POST"> 
                        <input type = "hidden" value ="<?php echo $order_id ?>" name = "order_id">
                          <button type="button" class=" btn btn-secondary" data-bs-toggle="modal">Close</button>
                         <button type="submit" id = "submit" name = "submit" class=" btn text-light justify-align-center add<?php echo $row['product_id'] ?>" style = "background-color:#A3272F " data-id="<?php echo $row["product_id"]; ?>">Confirm</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>


                

                                <?php 
                         
                    }
                ?>
            </div>
        </div>
<!-- END OF WHILE LOOP --> 


</div> 









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