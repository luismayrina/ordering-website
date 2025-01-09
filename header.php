<?php
  
  require_once 'db_conn.php';

$sql_cart = "SELECT SUM(qty) as total_qty FROM cart WHERE user_id = '".$_SESSION['ID']."' GROUP BY user_id;";
$all_cart = $con->query($sql_cart);
$sql_cart2 = "SELECT * FROM cart WHERE user_id = '".$_SESSION['ID']."';"; 
$all_cart2 = $con->query($sql_cart2);

?>

<!-- NAVIGATION BAR CONTENT-->
<div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <p style = "font-size: 15px; padding: 8px 8px 8px 32px;">Hello, <?php echo $_SESSION['Fname']; ?></p>
            <?php if($_SESSION['User'] == "admin"){
            ?>
              <a href="Stalls.php">Admin Mode</a>
            <?php } ?> 

            <a href="main.php">Home</a>
            <a href="order_history.php">Orders</a>
            
           
            <a href = "#"  data-bs-toggle="modal" data-bs-target = "#logout-modal"><btn>Log out</btn></a>
          </div> 

<!-- NAVIGATION BAR  -->          
          <div id="main" style = "margin-top: 50px;"> 
        <nav id = "side" style = "background-color: #A3272F;" class="fixed-top navbar navbar-dark" aria-label="First navbar example">
            <div class="container-fluid">
              
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation" onclick="openNav()">
                    <span  id = "openNavBtn" class="navbar-toggler-icon"></span>
                  </button>
            <div class="col-6"> 
            <form action = "search.php" method = "POST">
          <input type="search" class="form-control form-control-dark text-bg-dark" name = "search_term" placeholder="Search..." aria-label="Search">
          </div>
          
          
        </form>

                  <a class="nav-link js-scroll-trigger link-light" href="cart.php"><span id = "badge"> <?php echo ($all_cart->num_rows>0) ? mysqli_fetch_object($all_cart)->total_qty : 0; ?></span>  <i class="fa fa-shopping-cart"></i>  Cart</a>
                  
</ul>
              </div>
            
          </nav>  

          
</div>
        
</div> 


<!-- LOG OUT MODAL -->   
<div class="modal fade" id="logout-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" >
                    <h1 class="modal-title fs-5 " id="exampleModalLabel">Log Out</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      Are you sure you want to log out?
                      </div>
               <!-- Modal Footer -->
                        <div class="modal-footer">
                          <button type="button" class=" btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <a class = "text-light" href ="logout.php"><button type="submit" name = "submit" class=" btn text-light justify-align-center" style = "background-color:#A3272F ">Confirm</button></a>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                            
                </div>

              </div>

             </div>

<!-- Collapsible Navbar Script -->       
<script>
    function openNav() {
      var sidebar = document.getElementById("mySidebar");
      if (sidebar.style.width == "250px") {   // CHECK IF SIDEBAR IS ALREADY OPEN  
       closeNav();                            // THEN CALL CLOSENAV()
      } else {
        sidebar.style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px"; // IF NOT THEN CALL SIDEBAR  
        document.getElementById("side").style.marginLeft = "250px"; 
      
      }
    }
    
    function closeNav() {
      document.getElementById("mySidebar").style.width = "0";
      document.getElementById("main").style.marginLeft= "0";
      document.getElementById("side").style.marginLeft = "0";
      
    } 

    window.onclick = function(event) { // CLOSE SIDEBAR IF USER CLICKS OUTSIDE OF SIDEBAR 
      if (!event.target.matches('.navbar-toggler') && !event.target.matches('#mySidebar') && !event.target.matches('#openNavBtn')) {
        closeNav();
      }
    }

  
</script> 