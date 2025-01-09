<?php
error_reporting(0);
    include 'db_conn.php';
    $order_id=$_GET['ordersid'];
    $sql="SELECT * FROM order_products WHERE order_id=$order_id";
    $sql2="SELECT * FROM order_list WHERE order_id=$order_id";
    $all_orders2=$con->query($sql2);
    $total_amount=$_POST['total_amount'];
    $all_orders=$con->query($sql);
    if($all_orders){
        while($row=mysqli_fetch_assoc($all_orders)){
            $product_name=$_POST['product_name'];
            $qty=$_POST['qty'];
       
?>
<h1><?php echo $row["product_name"];?>       -      <?php echo $row["qty"];?>x</h1>



<?php }}
    ?>

<?php if($all_orders2){
$row2=mysqli_fetch_assoc($all_orders2)
 ?>
<h1>Total: ₱<?php echo $row2["total_amount"];?></h1>

<?php } ?>