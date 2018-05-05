<?php
//database connection

$con = mysqli_connect("localhost","root","","eprodavnica");

//getting the categories

function getCats() {

    global $con;

    $run_cats = mysqli_query($con,"SELECT * FROM categories");

    while($row_cats = mysqli_fetch_array($run_cats)) {

        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        echo "<li>
            <a href='#'>$cat_title</a>
        </li>";
    }


}

//getting the brands

function getBrands() {

    global $con;

    $run_brands = mysqli_query($con,"SELECT * FROM brands");

    while($row_brands = mysqli_fetch_array($run_brands)) {

        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

        echo "<td>

            <a href='#'>$brand_title</a>

        </td>";
    }


}


//getting products on main page

function getPro() {
    global $con;

    $run_pro = mysqli_query($con,"SELECT * FROM products ORDER BY RAND() LIMIT 0,9");

    while($row_pro = mysqli_fetch_array($run_pro)) {

        $pro_id = $row_pro['product_id'];
        $pro_cat = $row_pro['product_cat'];
        $pro_brand = $row_pro['product_brand'];
        $pro_title = $row_pro['product_title'];
        $pro_price = $row_pro['product_price'];
        $pro_image = $row_pro['product_image'];

            echo "
            <div class='single-product cf'>

            <h4><a href='#'>$pro_title</a></h4>
            <a href='details.php?pro_id=$pro_id'><img src='admin/product_images/$pro_image' /></a>
            <p>
            Price: $ $pro_price
            </p>

            <a href='index.php?pro_id=$pro_id'><button>Add To Cart</button></a>
            </div>

            ";

    }
}
