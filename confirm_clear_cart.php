<?php
session_start();

if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['ID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // If the user confirmed the reset, delete the cart and set the restaurant ID to null
    if ($_POST['reset_cart'] === 'yes') {
        include_once 'db_conn.php';
        $delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
        mysqli_query($con, $delete_cart);
        $_SESSION['restaurant_id'] = null;
    }
    // Redirect the user back to the previous page
    header("Location: ".$_SERVER['HTTP_REFERER']);
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Clear Cart</title>
</head>
<body>
    <h1>Confirm Clear Cart</h1>
    <p>You can only add products from the same restaurant. Do you want to clear the cart?</p>
    <form method="post">
        <button type="submit" name="reset_cart" value="yes">Yes</button>
        <button type="submit" name="reset_cart" value="no">No</button>
    </form>
</body>
</html>