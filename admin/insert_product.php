<!DOCTYPE html>

<?php

include("../includes/database.php");

 ?>
<html>
    <head>
        <meta charset="utf-8">
        <script src="../js/ckeditor/ckeditor.js"></script>
        <link type="text/css" rel="stylesheet" href="../styles/style_admin.css" />
        <title>Insert Product</title>
    </head>
    <body>

        <form action="insert_product.php" method="post" enctype="multipart/form-data">

            <h2>Insert New Product From Here</h2>
            <p>
                Product Title:
            </p>
            <input type="text" name="product_title" />
            <hr />
            <p>
                Product Category:
            </p>
            <select name="product_category">
                <option>
                    Select a Category
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
            <hr />
            <p>
                Product For:
            </p>
            <select name="product_brand">
                <option>
                    Select One
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

            <hr />
            <p>
                Product Image:
            </p>
            <input type="file" name="product_image" />
            <hr />
            <p>
                Product Price:
            </p>
            <input type="text" name="product_price" />
            <hr />

            <p>
                Product Description:
            </p>
            <textarea id="editor"  name="product_description" cols="60" rows="10"></textarea>
            <script>

                CKEDITOR.replace( 'editor' );
                CKEDITOR.config.width = 600;

            </script>
            <hr />
            <p>
                Product Keywords:
            </p>
            <input type="text" name="product_keywords" />

            <input type="submit" name="insert_post" value="Insert Now" />
        </form>

    </body>
</html>

<?php

if(isset($_POST['insert_post'])) {

    $product_title = $_POST['product_title'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_brand = $_POST['product_brand'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];

     $run_product = mysqli_query($con,"INSERT INTO products (product_cat,product_brand ,product_title, product_price, product_description, product_image, product_keywords) VALUES('$product_category','$product_brand','$product_title',
        '$product_price','$product_description','$product_description','$product_keywords')") or die( mysqli_error($con));

}

 ?>
