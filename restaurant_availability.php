<?php 

date_default_timezone_set('Asia/Manila');

include "db_conn.php"; 

// Get the current time
$current_time = date('H:i:s');
$openingTime = strtotime('9:00 AM');
$closingTime = strtotime('3:15 PM');
// Get all the restaurants from the database
$get_restaurants_query = "SELECT * FROM restaurant_list";
$get_restaurants_result = mysqli_query($con, $get_restaurants_query);

// Loop through each restaurant and update its availability
while ($restaurant_row = mysqli_fetch_assoc($get_restaurants_result)) {
  $restaurant_id = $restaurant_row['ID'];
  $opening_time = $restaurant_row['opening_time'];
  $closing_time = $restaurant_row['closing_time'];
  
  // Check if the current time is between the opening and closing times of the restaurant
  if ($current_time >= $opening_time && $current_time <= $closing_time) {
    // Update the availability of the restaurant to open (1)
    $update_availability_query = "UPDATE restaurant_list SET avl = 1 WHERE id = $restaurant_id";
    mysqli_query($con, $update_availability_query);
  } else {
    // Update the availability of the restaurant to closed (0)
    $update_availability_query = "UPDATE restaurant_list SET avl = 0 WHERE id = $restaurant_id";
    mysqli_query($con, $update_availability_query);
  }
} 

?>