<!DOCTYPE html>

<?php

include("../includes/database.php");

 ?>

        <form action="insert_product.php" method="post" enctype="multipart/form-data">

            <h2>Insert New Product From Here</h2>
            <p>
                Product Title:
            </p>
            <input type="text" name="product_title" />

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


            <p>
                Product Image:
            </p>
            <input type="file" name="product_image" />

            <p>
                Product Price:
            </p>
            <input type="text" name="product_price" />


            <p>
                Product Description:
            </p>
            <textarea id="editor"  name="product_description" cols="60" rows="10"></textarea>
            <script>

                CKEDITOR.replace( 'editor' );
                CKEDITOR.config.width = 600;

            </script>

            <p>
                Product Keywords:
            </p>
            <input type="text" name="product_keywords" />

            <input type="submit" name="insert_post" value="Insert Now" />
        </form>

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




        if($product_title == "" or $product_category == "null" or $product_price == "" or
        $product_keywords == "" or $product_brand == "null" or $product_image == "") {

            echo "<script>alert('Please enter all fields!')</script>";
        } else {
            move_uploaded_file($product_image_tmp,"product_images/$product_image");

            $run_product = mysqli_query($con,"INSERT INTO products
                 (product_cat,product_brand ,product_title, product_price, product_description, product_image, product_keywords)
                  VALUES('$product_category','$product_brand','$product_title',
               '$product_price','$product_description','$product_image','$product_keywords')")
                or die( mysqli_error($con));

        }
        if($run_product) {
          echo "<script>alert('You have successfully inserted a product!')</script>";
          echo "<script>window.open('index.php?view_products','_self')</script>";
        }
}

 ?>
