
<?php

if(isset($_GET['edit'])) {

include("../includes/database.php");

$id = $_GET['edit'];

$run_cat1 = mysqli_query($con, "SELECT * FROM brands WHERE brand_id = '$id'");

$row_cat1 = mysqli_fetch_array($run_cat1);

$name = $row_cat1['brand_title']

 ?>

<div id="edit-cat1">

  <form action="" method="post" enctype="multipart/form-data">
    <input type="text" name="cat1" value="<?php echo $name;?>"/>
    <button type="submit" name="submit">Update Now</button>
  </form>

</div>

<?php
}

if(isset($_POST['submit'])) {

  
  $n_name = $_POST['cat1'];
  $edit_cat1 = mysqli_query($con, "UPDATE brands SET brand_title = '$n_name' WHERE brand_id = '$id'")
  or die(mysqli_error($con));

  if($edit_cat1) {
    echo "<script>alert('You have successfully updated a category!')</script>";
    echo "<script>window.open('index.php?manage_categories1','_self')</script>";
  } else {
    echo "<script>alert('Something went wrong!')</script>";
  }

}
 ?>
