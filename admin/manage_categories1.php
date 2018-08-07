<?php include("../includes/database.php"); ?>

<div id="cat1">
<form action="" method="post">
<h2>Insert New Category</h2>

<input type="text" name="new_cat" />
<input type="submit" name="add_cat"  value="Add Category" />
</form>

<br />

<table>
  <tr>
    <th>
      Category Name:
    </th>
    <th>
      Delete
    </th>
    <th>
      Edit
    </th>
  </tr>

    <?php
    $run_cat1 = mysqli_query($con, "SELECT * FROM brands");

    while($row_cat1 = mysqli_fetch_array($run_cat1)) {
      $cat1_name = $row_cat1['brand_title'];
      $cat1_id = $row_cat1['brand_id'];



     ?>

     <tr>
       <th>
       <?php echo $cat1_name; ?>
       </th>
       <th>
       <a href="manage_categories1.php?delete=<?php echo $cat1_id; ?>"><i class="fas fa-trash-alt"></i></a>
       </th>
       <th>
       <a href="edit_category1.php?edit=<?php echo $cat1_id; ?>"><i class="fas fa-edit"></i> </a>
       </th>


       </tr>
<?php }

  if(isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $delete_cat1 = mysqli_query($con,"DELETE FROM brands WHERE brand_id = '$id'") or die(mysqli_error($con));

    echo "<script>alert('You have succesfully deleted a category')</script>";
    echo "<script>window.open('index.php?manage_categories1','_self')</script>";

  } if(isset($_GET['edit'])) {

    include("edit_category1.php");

  }

if(isset($_POST['add_cat'])) {

  $new_cat1 = $_POST['new_cat'];

  $insert_cat1 = mysqli_query($con, "INSERT INTO brands(brand_title) VALUES ('$new_cat1')")
  or die(mysqli_query($con));

  if($insert_cat1) {
    echo "<script>alert('You have successfully inserted new category!')</script>";
    echo "<script>window.open('index.php?manage_categories1','_self')</script>";
  } else {
    echo "<script>alert('Something went wrong!')</script>";
  }
}





?>

  </table>

</div> <!-- END cat1 -->
