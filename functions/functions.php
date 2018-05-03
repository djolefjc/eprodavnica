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
