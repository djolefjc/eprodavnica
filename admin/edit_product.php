<!DOCTYPE html>

<?php

include("../includes/database.php");

if(isset($_GET['edit_product'])) {
    $get_id = $_GET['edit_product'];

    $get_pro = mysqli_query($con,"SELECT * FROM products WHERE product_id ='$get_id'");
    $get_row_pro = mysqli_fetch_array($get_pro);
    $get_cat = $get_row_pro['product_cat'];
    $get_brand = $get_row_pro['product_brand'];
    $get_title = $get_row_pro['product_title'];
    $get_price = $get_row_pro['product_price'];
    $get_desc = $get_row_pro['product_description'];
    $get_img = $get_row_pro['product_image'];
    $get_key = $get_row_pro['product_keywords'];

    $pro_get_cat = mysqli_query($con,"SELECT * FROM categories WHERE cat_id = '$get_cat'");
    $pro_row_cat = mysqli_fetch_array($pro_get_cat);
    $cat_row = $pro_row_cat['cat_title'];
    $cat_id_row = $pro_row_cat['cat_id'];

    $pro_get_brand = mysqli_query($con,"SELECT * FROM brands WHERE brand_id = '$get_brand'");
    $pro_row_brand = mysqli_fetch_array($pro_get_brand);
    $brand_row = $pro_row_brand['brand_title'];
    $brand_id_row = $pro_row_brand['brand_id'];
}
 ?>
<html>
    <head>
        <meta charset="utf-8">
        <script src="../js/ckeditor/ckeditor.js"></script>
        <link type="text/css" rel="stylesheet" href="../styles/style_admin.css" />
        <title>Insert Product</title>
    </head>
    <body>

        <form action="" method="post" enctype="multipart/form-data">

            <h2>Update Your Product From Here</h2>
            <p>
                Product Title:
            </p>
            <input type="text" name="product_title" value="<?php echo $get_title; ?>" />
            <br />
            <p>
                First Category:
            </p>
            <select name="product_category">
                <option value="<?php echo $cat_id_row; ?>">
                    <?php echo $cat_row; ?>
                </option>
                <?php
                $run_cats = mysqli_query($con,"SELECT * FROM categories");

                while($row_cats = mysqli_fetch_array($run_cats)) {

                    $cat_id = $row_cats['cat_id'];
                    $cat_title = $row_cats['cat_title'];

                    echo "<option value='$cat_id'>$cat_title</option>";
                }
                 ?>
            </select>
            <br />
            <p>
                Second Category:
            </p>
            <select name="product_brand">
                <option value = "<?php echo $brand_id_row; ?>">
                    <?php echo $brand_row; ?>
                </option>
                <?php
                $run_brands = mysqli_query($con,"SELECT * FROM brands");

                while($row_brands = mysqli_fetch_array($run_brands)) {

                    $brand_id = $row_brands['brand_id'];
                    $brand_title = $row_brands['brand_title'];

                    echo "<option value='$brand_id'>
                    $brand_title
                    </option>";
                }

                 ?>

            </select>

            <br />
            <p>
                Product Image:
            </p>
            <input type="file" name="product_image" />
            <img src="../images/<?php echo $get_img; ?>" style="display:block; width:250px; height:200px; margin:0 auto; margin-top:10px; margin-bottom:10px;">
            <br />
            <p>
                Product Price:
            </p>
            <input type="text" name="product_price" value="<?php echo $get_price; ?>" />
            <br />

            <p>
                Product Description:
            </p>
           <textarea id="editor"  name="product_description" cols="60" rows="10">
               <?php echo $get_desc; ?>
           </textarea>

            <script>

                CKEDITOR.replace( 'editor' );
                CKEDITOR.config.width = 600;

            </script>
            <br />
            <p>
                Product Keywords:
            </p>
            <input type="text" name="product_keywords" value="<?php echo $get_key; ?>" />

            <input type="submit" name="update_post" value="Update Now" />
        </form>

    </body>
</html>

<?php

if(isset($_POST['update_post'])) {

    $product_title = $_POST['product_title'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_brand = $_POST['product_brand'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];


        if(empty($product_image)) { $product_image = $get_row_pro['product_image']; }

        if($product_title == "" or $product_category == "null" or $product_price == "" or
        $product_keywords == "" or $product_brand == "null") {

            echo "<script>alert('Please enter all fields!')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        } else {
            move_uploaded_file($product_image_tmp,"product_images/$product_image");

            $run_product = mysqli_query($con,"UPDATE products SET product_cat = '$product_category',
                product_brand = '$product_brand', product_title = '$product_title',product_price = '$product_price',
                product_description = '$product_description', product_image = '$product_image', product_keywords = '$product_keywords' WHERE product_id = '$get_id'")
                or die(mysqli_error($con));

                echo "<script>alert('You have successfuly updated a product!')</script>";
                echo "<script>window.open('index.php?view_products','_self')</script>";


        }
}

 ?>
