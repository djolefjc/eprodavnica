<?php

include("../includes/database.php");
if(isset($_GET['delete_product'])) {

$delete_id = $_GET['delete_product'];

$delete_run = mysqli_query($con, "DELETE FROM products WHERE product_id = '$delete_id'");

}
if($delete_run) {

  echo "<script>alert('Product has been deleted!')</script>";
  echo "<script>window.open('index.php?view_products','_self')</script>";


}
?>
