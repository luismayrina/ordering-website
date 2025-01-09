<?php 
session_start();
include_once 'db_conn.php'; 

$product_id = $_POST['productid']; 
$qty = $_POST['qty']; 
$user_id = $_SESSION['ID']; 
$user = $_SESSION['User'];
$product_name = $_POST['productname'];
$restaurant_id = $_POST['restaurantname'];

// GET VALUE OF AVAILABLE STOCKS 
$get_stock = "SELECT stock FROM product_list WHERE product_id = '$product_id'";
$stock_result = mysqli_query($con, $get_stock);
$stock_row = mysqli_fetch_assoc($stock_result);
$stock = $stock_row['stock'];

// IF QUANTITY EXCEEDS THE AVAILABLE STOCK 
if ($qty > $stock) {
    // REDIRECT TO THE PREVIOUS PAGE 
    $_SESSION['error'] = "Requested quantity exceeds available stock.";
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

if (!isset($_SESSION['restaurant_id']) || $_SESSION['restaurant_id'] == $restaurant_id) {
    // CHECK IF A PRODUCT IS FROM A DIFFERENT RESTAURANT 
    $check_cart = "SELECT restaurant FROM cart JOIN product_list ON cart.product_id = product_list.product_id WHERE user_id = '$user_id' AND restaurant != '$restaurant_id'";
    $cart_result = mysqli_query($con, $check_cart);
    if (mysqli_num_rows($cart_result) > 0) {
        // RESET THE CART 
        $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
        mysqli_query($con, $delete_cart);

        // RESET THE RESTAURANT ID TO NULL 
        $_SESSION['restaurant_id'] = null;

        $_SESSION['error'] = "You can only add products from the same restaurant.";
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    }

    $check_product = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($con, $check_product);
    if (mysqli_num_rows($result) > 0) {
        // RETRIEVE CURRENT QUANTITY OF THE PRODUCT 
        $get_qty = "SELECT qty FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
        $qty_result = mysqli_query($con, $get_qty);
        $qty_row = mysqli_fetch_assoc($qty_result);
        $current_qty = $qty_row['qty'];

        // CALCULATE THE TOTAL QUANTITY 
        $total_qty = $current_qty + $qty;

        // IF TOTAL QUANTITY EXCEEDS THE AVAILABLE STOCK 
        if ($total_qty > $stock) {
            // REDIRECT TO THE PREVIOUS PAGE 
            $_SESSION['error'] = "Requested quantity exceeds available stock.";
            header("Location: ".$_SERVER['HTTP_REFERER']);
            exit();
        }

        $update_qty = "UPDATE cart SET qty = qty + '$qty' WHERE user_id = '$user_id' AND product_id = '$product_id'";
        mysqli_query($con, $update_qty);
    } else {
        $sql = "INSERT INTO cart (user_id, product_id, product_name, qty, user, restaurant_name) VALUES ('$user_id','$product_id', '$product_name', '$qty','$user', '$restaurant_id') 
            ON DUPLICATE KEY UPDATE qty = qty + $qty";
        mysqli_query($con, $sql);
    }

    // SET RESTAURANT ID 
    $_SESSION['restaurant_id'] = $restaurant_id;

    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    // RESET THE CART 
    $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
    mysqli_query($con, $delete_cart);
    
    // RESET THE RESTAURANT ID TO NULL 
    $_SESSION['restaurant_id'] = null;

    // ADD THE NEW PRODUCT FROM ANOTHER RESTAURANT TO CART 
    $sql = "INSERT INTO cart (user_id, product_id, product_name, qty, user, restaurant_name) VALUES ('$user_id','$product_id', '$product_name', '$qty','$user', '$restaurant_id')
    ON DUPLICATE KEY UPDATE qty = qty + $qty";
    mysqli_query($con, $sql);


    // SET RESTAURANT ID 
    $_SESSION['restaurant_id'] = $restaurant_id;

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>