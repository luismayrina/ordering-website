<?php 
session_start();
// add to cart product from waffletime.php /
include_once 'db_conn.php'; 

$product_id = $_POST['productid']; 
$qty = $_POST['qty']; 
$user_id = $_SESSION['ID']; 
$product_name = $_POST['productname']; 

// get the stock of the product
$get_stock = "SELECT stock FROM product_list WHERE product_id = '$product_id'";
$stock_result = mysqli_query($con, $get_stock);
$stock_row = mysqli_fetch_assoc($stock_result);
$stock = $stock_row['stock'];

// check if the requested quantity exceeds the available stock
if ($qty > $stock) {
    // redirect to the previous page with an error message
    $_SESSION['error'] = "Requested quantity exceeds available stock.";
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
} 

$check_product = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id' ";
$result = mysqli_query($con, $check_product);
if(mysqli_num_rows($result) > 0){
    $update_qty = "UPDATE cart SET qty = '$qty' WHERE user_id = '$user_id' AND product_id = '$product_id'";
    mysqli_query($con, $update_qty);
}else{
    $sql = "INSERT INTO cart (user_id, product_name, product_id, qty) VALUES ('$user_id', '$product_name', '$product_id', '$qty') 
        ON DUPLICATE KEY UPDATE qty = $qty";
    
    mysqli_query($con, $sql);
}

// check if quantity is zero, remove the product from the cart
$check_qty = "SELECT qty FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result_qty = mysqli_query($con, $check_qty);
$row_qty = mysqli_fetch_assoc($result_qty);
if ($row_qty['qty'] == 0) {
    $delete_product = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    mysqli_query($con, $delete_product);
} 
// else if ($row_qty['qty'] >= 10) {
//   $default_qty = "UPDATE cart SET qty = '10' WHERE user_id = '$user_id' AND product_id = '$product_id'";
//    mysqli_query($con, $default_qty);
//} 


if(isset($_SERVER['HTTP_REFERER'])) {
    header("Location: ".$_SERVER['HTTP_REFERER']);
    
    
} else {
    // Fallback to a specific page
    header("Location: index.php");
}
?>