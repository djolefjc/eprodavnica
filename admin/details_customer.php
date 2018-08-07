<!DOCTYPE html>

<?php

if(isset($_GET['details_customer'])) {


include("../includes/database.php");

$c_id = $_GET['details_customer'];

$get_customer = mysqli_query($con, "SELECT * FROM customers WHERE customer_Id = '$c_id'") or die(mysqli_error($con));

$row_customer = mysqli_fetch_array($get_customer);

$c_ip = $row_customer['customer_ip'];
$c_name = $row_customer['customer_name'];
$c_email = $row_customer['customer_email'];
$c_pass = $row_customer['customer_pass'];
$c_country = $row_customer['customer_country'];
$c_city = $row_customer['customer_city'];
$c_address = $row_customer['customer_address'];
$c_contact = $row_customer['customer_contact'];
$c_img = $row_customer['customer_image'];
}

 ?>

 <div id="view_customer">
   <br />
   <br />
   <img src="../customer/customer_images/<?php echo $c_img; ?>" style="width:250px;">

   <p>
     Name : <?php echo $c_name; ?>
   </p>
   <p>
     Email : <?php echo $c_email; ?>
   </p>
   <p>
     Password : <?php echo $c_pass; ?>
   </p>
   <p>
     Country : <?php echo $c_country; ?>
   </p>
   <p>
     City : <?php echo $c_city; ?>
   </p>
   <p>
     Address : <?php echo $c_address; ?>
   </p>
   <p>
     Contact : <?php echo $c_contact; ?>
   </p>
   <p>
     IP Address : <?php echo $c_ip; ?>
   </p>
   <p>
     Name : <?php echo $c_name; ?>
   </p>
 </div>
