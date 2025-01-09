<?php
session_start();
include_once 'db_conn.php';

$user_id = $_SESSION['ID'];

$delete_cart = "DELETE FROM cart WHERE user_id = '$user_id'";
mysqli_query($con, $delete_cart);

header("Location: ".$_SERVER['HTTP_REFERER']);
?>