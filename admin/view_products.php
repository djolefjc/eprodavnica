<table>
  <thead>
      <th colspan="6">
      All Products
  </th>
  </thead>
      </tr>
  <tbody>
      <tr>
          <th>
              Serial Number
          </th>
          <th>
              Title
          </th>
          <th>
              Image
          </th>
          <th>
              Price
          </th>
          <th>
              Edit
          </th>
          <th>
              Delete
          </th>
      </tr>
      <?php

      include("../includes/database.php");

      $run_pro = mysqli_query($con,"SELECT * FROM products");
      $i=0;
      while($row_pro = mysqli_fetch_array($run_pro)) {

          $pro_serial = $row_pro['product_id'];
          $pro_title = $row_pro['product_title'];
          $pro_img = $row_pro['product_image'];
          $pro_price = $row_pro['product_price'];
          $i++;



       ?>

       <tr>
           <th>
               <?php echo $i; ?>
           </th>
           <th>
               <?php echo $pro_title ?>
           </th>
           <th>
             <img src="../images/<?php echo $pro_img ?>">
           </th>
           <th>
              $ <?php echo $pro_price ?>
           </th>
           <th>
               <a href="index.php?edit_product=<?php echo $pro_serial; ?>">Edit</a>
           </th>
           <th>
               <a href="delete_product.php?delete_product=<?php echo $pro_serial;?>">Delete</a>
           </th>
       </tr>
       <?php
}

        ?>
  </tbody>
</table>
