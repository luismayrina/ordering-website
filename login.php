<?php
session_start();

include "db_conn.php"; 

include "restaurant_availability.php"; 

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){
         $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
  
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    
    if (empty($username) && empty($password)) {
      $_SESSION['error'] = "ID AND PASSWORD IS REQUIRED!";
      header("Location: index.php?error=ID is required");
        exit();
    }
    if (empty($username)) {
      $_SESSION['error'] = "ID IS REQUIRED!";
      header("Location: index.php?error=ID is required");
        exit();
    }else if(empty($password)){
      $_SESSION['error'] = "PASSWORD IS REQUIRED!";
          header("Location: index.php?error=Password is required");
        exit();
    }else{
      $sql = "SELECT * FROM customer WHERE User ='$username' AND Pass ='$password'";
  
      $result = mysqli_query($con, $sql);
  
      if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['User'] == "admin" && $row['Pass'] == "$password") {
          $_SESSION['ID'] = $row['ID'];
          $_SESSION['User'] = $row['User'];
          $_SESSION['Fname'] = $row['Fname'];
          $_SESSION['Lname'] = $row['Lname'];
          
          header("Location: Stalls.php");
        exit();
        }else if($row['User'] == "turksadmin" || $row['User'] == "waffleadmin" && $row['Pass'] == $password){
          $_SESSION['ID'] = $row['ID'];
          $_SESSION['User'] = $row['User'];
          $_SESSION['Fname'] = $row['Fname'];
          $_SESSION['Lname'] = $row['Lname'];
          $_SESSION['restaurant_name'] = $row['restaurant_name'];
          header("Location: stallfoods.php");
          exit();

        }else if ($row['User'] == $username && $row['Pass'] == $password){
          $_SESSION['ID'] = $row['ID'];
          $_SESSION['User'] = $row['User'];
          $_SESSION['Fname'] = $row['Fname'];
          $_SESSION['Lname'] = $row['Lname'];

          header("Location: main.php");
          exit();
              }else{
          $_SESSION['error'] = "INCORRECT ID OR PASSWORD!";
          header("Location: index.php?error=Incorect ID or password");
              exit();
        }
      }else{ 
        $_SESSION['error'] = "INCORRECT ID OR PASSWORD!";
        header("Location: index.php?error=Incorect ID or password");
            exit();
      }
    }
    
  }else{
	header("Location: index.php");
	exit(); 
  }




?>