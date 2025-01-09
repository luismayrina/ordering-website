<?php 
include_once 'db_conn.php'; 

$order_id = $_POST['order_id']; 
$status = "Cancelled"; 

$sqll = "SELECT * FROM order_products WHERE order_id = '$order_id' "; 
$all_order = $con->query($sqll); 
while($row_order = mysqli_fetch_assoc($all_order)){ 
  
    $product_id = $row_order['product_id']; 
    $qty = $row_order['qty']; 
    $sql = "SELECT * FROM product_list WHERE product_id = $product_id"; 
    $all_product = $con->query($sql); 
    while($row_products = mysqli_fetch_assoc($all_product)){ 
        $stock = $row_products['stock'] - $qty ; 
        $update_stock = "UPDATE product_list SET stock = '$stock' WHERE product_id = '$product_id'";
        $con->query($update_stock);
    } 
}

$sql = "UPDATE order_list SET status = '$status' WHERE order_id = '$order_id'"; 

if(mysqli_query($con, $sql)){
    // Redirect to main.php on successful order
    header("Location: cart.php");
    exit();
}else{
    echo "Error updating order status: " . mysqli_error($con);
    // Redirect back to cart.php on failure
    header("Location: cart.php");
    exit();
}
?>