<?php 
    $host = "localhost:3307"; 
    $user = "root"; 
    $password = ""; 
    $db = "canteen4"; 

    $con = mysqli_connect($host,$user,$password, $db); 
    mysqli_select_db($con, $db); 

    if (!$con) {
      echo "Connection failed!";
    }

    
    
  if(isset($_GET["cart_id"])){
    $product_id = $_GET["cart_id"];
    $sql = "DELETE FROM cart WHERE product_id=".$product_id;

    if($con->query($sql) === TRUE){
        echo "Removed from cart";
    }
}

?>