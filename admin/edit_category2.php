
<?php

if(isset($_GET['edit'])) {

include("../includes/database.php");

$id = $_GET['edit'];

$run_cat2 = mysqli_query($con, "SELECT * FROM categories WHERE cat_id = '$id'");

$row_cat2 = mysqli_fetch_array($run_cat2);

$name = $row_cat2['cat_title'];
$brand_id = $row_cat2['brand_id'];



 ?>

<div id="edit-cat1">

  <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="cat2" value="<?php echo $name;?>"/>
    <select name = "update_cat2_brand">
      <option value="<?php echo $brand_id;?>">
        <?php

        $get_brand_name = mysqli_query($con, "SELECT * FROM brands WHERE brand_id = '$brand_id'");
        $row_brand_name = mysqli_fetch_array($get_brand_name);
        $brand_name = $row_brand_name['brand_title'];

        echo $brand_name;

        ?>
      </option>
      <?php
      $run_brands = mysqli_query($con,"SELECT * FROM brands");

      while($row_brands = mysqli_fetch_array($run_brands)) {

          $brand_update_id = $row_brands['brand_id'];
          $brand_update_title = $row_brands['brand_title'];

          echo "<option value='$brand_update_id'>
          $brand_update_title
          </option>";
      }

       ?>
    </select>
    <button type="submit" name="submit">Update Now</button>
  </form>

</div>

<?php
}

if(isset($_POST['submit'])) {


  $n_name = $_POST['cat2'];

  $n_brand_id = $_POST['update_cat2_brand'];
  $edit_cat2 = mysqli_query($con, "UPDATE categories SET cat_title='$n_name', brand_id='$n_brand_id' WHERE cat_id='$id'")
  or die(mysqli_error($con));

  if($edit_cat2) {
    echo "<script>alert('You have successfully updated a category!')</script>";
    echo "<script>window.open('index.php?manage_categories2','_self')</script>";
  } else {
    echo "<script>alert('Something went wrong!')</script>";
  }

}
 ?>
