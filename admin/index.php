



<?php
session_start();
/* GET varijabla koja se pojavljuje ako nema autorizaciju */
if(!isset($_SESSION['admin_username'])) {

  echo "<script>window.open('login.php?not_admin=You are not an admin!','_self')</script>";

} else {

 ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="../styles/style_admin.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Rock+Salt" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <title>Admin Panel</title>
    </head>
    <body>

<div id="container">
  <div id="head">
  <h1>Admin Panel</h1>

  <a href="index.php"><span>Home</span></i></a>
  </div> <!-- END head -->

    <div id="main">

      <?php

       echo"<span id='logged-in'>". @$_GET['logged'] . "</span>";

      if(isset($_GET['insert_product'])) {
        include("insert_product.php");
      }
      if(isset($_GET['view_products'])) {
          include("view_products.php");
      }
      if(isset($_GET['edit_product'])) {
          include("edit_product.php");
      }
      if(isset($_GET['manage_categories1'])) {
        include("manage_categories1.php");
      } if(isset($_GET['manage_categories2'])) {
        include("manage_categories2.php");
      }
      if(isset($_GET['view_customers'])) {
        include('view_customers.php');
      }
      if(isset($_GET['details_customer'])) {
        include("details_customer.php");
      }

      ?>
    </div> <!-- END main -->
    <div id="side">
      <h2>Manage Content</h2>
      <ul>
        <li>
        <a href="index.php?insert_product">Insert New Product</a>
        </li>
        <li>
        <a href="index.php?view_products">View All Products</a>
        </li>
        <li>
        <a href="index.php?manage_categories1">Manage First Category Tree</a>
        </li>
        <li>
        <a href="index.php?manage_categories2">Manage Second Category Tree</a>
        </li>
        <li>
        <a href="index.php?view_customers">View Customers</a>
        </li>
        <li>
        <a href="index.php?view_orders">View Orders</a>
        </li>
        <li>
        <a href="index.php?view_payments">View Payments</a>
        </li>
        <li>
        <a href="logout.php">Admin Logout</a>
        </li>
      </ul>
    </div> <!-- END side -->
</div><!-- End container -->
    </body>
</html>
<?php }?>
