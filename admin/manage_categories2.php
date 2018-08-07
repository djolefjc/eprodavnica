<?php include("../includes/database.php"); ?>

<div id="cat1">
<form action="" method="post">
<h2>Insert New Category</h2>

<input type="text" name="new_cat" />
<select name = "new_cat_brand">
  <?php
  $run_brands = mysqli_query($con,"SELECT * FROM brands");

  while($row_brands = mysqli_fetch_array($run_brands)) {

      $brand_new_id = $row_brands['brand_id'];
      $brand_new_title = $row_brands['brand_title'];

      echo "<option value='$brand_new_id'>
      $brand_new_title
      </option>";
  }

   ?>
</select>
<input type="submit" name="add_cat"  value="Add Category" />

</form>

<br />

<table>
  <tr>
    <th>
      Category Name:
    </th>
    <th>
      Gender:
    </th>
    <th>
      Delete
    </th>
    <th>
      Edit
    </th>
  </tr>

    <?php
    $run_cat2 = mysqli_query($con, "SELECT * FROM categories");

    while($row_cat2 = mysqli_fetch_array($run_cat2)) {
      $cat2_name = $row_cat2['cat_title'];
      $cat2_id = $row_cat2['cat_id'];
      $cat2_brand = $row_cat2['brand_id'];


     ?>

     <tr>
       <th>
       <?php echo $cat2_name; ?>
       </th>
       <th>

             <?php

             $get_brand_name = mysqli_query($con, "SELECT * FROM brands WHERE brand_id = '$cat2_brand'");
             $row_brand_name = mysqli_fetch_array($get_brand_name);
             $brand_name = $row_brand_name['brand_title'];

             echo $brand_name;

             ?>
        
       </th>
       <th>
       <a href="manage_categories2.php?delete=<?php echo $cat2_id; ?>"><i class="fas fa-trash-alt"></i></a>
       </th>
       <th>
       <a href="edit_category2.php?edit=<?php echo $cat2_id; ?>"><i class="fas fa-edit"></i> </a>
       </th>


       </tr>
<?php }

  if(isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $delete_cat1 = mysqli_query($con,"DELETE FROM categories WHERE cat_id = '$id'") or die(mysqli_error($con));

    echo "<script>alert('You have succesfully deleted a category')</script>";
    echo "<script>window.open('index.php?manage_categories2','_self')</script>";

  } if(isset($_GET['edit'])) {

    include("edit_category2.php");

  }

if(isset($_POST['add_cat'])) {

  $new_cat2 = $_POST['new_cat'];
  $new_cat2_brand = $_POST['new_cat_brand'];

  $insert_cat1 = mysqli_query($con, "INSERT INTO categories(cat_title, brand_id) VALUES ('$new_cat2', '$new_cat2_brand')")
  or die(mysqli_query($con));

  if($insert_cat1) {
    echo "<script>alert('You have successfully inserted new category!')</script>";
    echo "<script>window.open('index.php?manage_categories2','_self')</script>";
  } else {
    echo "<script>alert('Something went wrong!')</script>";
  }
}





?>

  </table>

</div> <!-- END cat1 -->
