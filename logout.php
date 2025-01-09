<?php

include_once 'db_conn.php';
session_start();

unset($_SESSION['ID']);
unset($_SESSION['User']);
unset($_SESSION['Fname']);
unset($_SESSION['Lname']); 

session_unset();





session_destroy();

header("Location: index.php");
?>