<?php 
session_start(); 



if (isset($_SESSION['ID']) && isset($_SESSION['User'])){ 
  header("Location: main.php"); 
  exit(); 
}

?> 
<!DOCTYPE html>
<html> 

  <head> 
    <link rel="icon" href="images/lpu.png"> 
   
   <meta charset="utf-8"> 

    <meta name="author"  content="GROUP 5">
    <meta name="description" content="Lyceum of the Philippines University - Cavite Canteen Ordering" >
    <meta name="keywords" content="HTML, CSS, JAVASCRIPT, JQUERY, WEB DEVELOPMENT, FREELANCE DEVELOPER, WEB DESIGNER PHILIPPINES">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv = "refresh" content = ""> 
    <title> Canteen Ordering and Queueing System</title>
   

    <link rel="stylesheet" href="bs/css/bootstrap.css"> 
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css"> 
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@500;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </head> 

    <body style = "background-color : #A3272F"> 
      
      <h1 class="h1 mt-5 mb-4 fw-normal text-light text-center"><b>CANTEEN ORDERING SYSTEM</b></h1> 


  
      <!-- LOG IN FORM -->
    
      <section style = "margin-top: 40px;">
      <div class="container mt-5 pt-5 text-center">
        <div class="row">
          <div class="col-12 col-sm-7 col-md-5 m-auto">
            <div class="card border-0 shadow-lg">
              <div class="card-body" style = "background-color: #d9d9d96e">
                
                <form method = "POST" action = "login.php" class = "mt-3 align-items-start">
            
                 
        
             <!-- EMAIL ADDRESS -->  
                
            <div class="" style = "width: 70%; margin: 0 auto; ">
           
            <?php 
              if (isset($_SESSION['error'])) {
                echo '<div class="error-message rounded-5"> <i class="fa fa-exclamation-triangle error-icon mt-3"></i> <STRONG><p class = "fs-6">' . $_SESSION['error'] . '</p></STRONG></div>';
                unset($_SESSION['error']);
              }
            ?>
              <input style = "padding: 1rem 0.75rem;" type="text" name = "username" class=" rounded-5 form-control " id="username" placeholder="ID">
              
            </div>
            <br> 
          <!-- PASSWORD --> 
            <div class=" mb-5" style = "width: 70%; margin: 0 auto;">
              <input style = "padding: 1rem 0.75rem;" type="password" class="rounded-5 form-control" name = "password" id="password" placeholder="Password">
              
            </div>
         
                    
            <!-- LOG IN BUTTON -->
            <button type = "submit" name = "submit" value = "LOGIN" style = "width: 130px;" class="rounded-5 btn-lg text-light btn-red" type="submit">Log In</button>
           <!-- LOG IN AS GUEST BUTTON -->
            
            <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
          </form>
      
              </div>
            </div>
          </div>
        </div>

        <!-- LPU Logo -->
        
          <img class = "" style = "margin-top: 90px;" src="assets/images/logo.png" alt="LPU - Cavite Logo" width="250px" height="200px">
          
      </div>
      
    </section>
     
    </body>

    </html> 

