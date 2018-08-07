<table>
  <thead>
      <th colspan="6">

  </th>
  </thead>
      </tr>
  <tbody>
      <tr>
          <th>
            No
          </th>
          <th>
              Name
          </th>
          <th>
              Email
          </th>
          <th>
              Image
          </th>

          <th>
              Delete
          </th>
          <th>
            Details
          </th>

      </tr>
      <?php

      include("../includes/database.php");

      $run_c = mysqli_query($con,"SELECT * FROM customers");
      $i=0;
      while($row_c = mysqli_fetch_array($run_c)) {

          $c_id = $row_c['customer_id'];
          $c_name = $row_c['customer_name'];
          $c_img = $row_c['customer_image'];
          $c_email = $row_c['customer_email'];
          $i++;



       ?>

       <tr>
           <th>
               <?php echo $i; ?>
           </th>
           <th>
               <?php echo $c_name; ?>
           </th>
           <th>
              <?php echo $c_email; ?>
           </th>

           <th>
              <img src="../customer/customer_images/<?php echo $c_img; ?>" >
           </th>
           <th>
               <a href="delete_customer.php?delete_customer=<?php echo $c_id;?>">Delete</a>
           </th>
           <th>
             <a href="index.php?details_customer=<?php echo $c_id;?>">Details</a>
           </th>
       </tr>
       <?php
}

          if(isset($_GET['delete_customer'])) {

            $delete_c = mysqli_query($con,"DELETE FROM customers WHERE customer_id = '$c_id'") or die(mysqli_error($con));

            if($delete_c) {
              echo "<script>alert('You have successfully deleted a customer!')</script>";
              echo "<script>window.open('index.php?view_customers','_self')</script>";
            }
            if(isset($_GET['details_customer'])) {
              include("details_customer.php");
            }
          }
        ?>
  </tbody>
</table>
