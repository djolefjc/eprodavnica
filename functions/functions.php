<?php
//database connection

$con = mysqli_connect("localhost","root","","eprodavnica");

// function for getting ip address of the client
/*In this PHP function, first attempt is to get the direct IP address of client’s machine, if not available then try for forwarded for IP address using HTTP_X_FORWARDED_FOR. And if this is also not available, then finally get the IP address using REMOTE_ADDR.*/

function getIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

//adding product to cart

function cart() {

    if(isset($_GET['add_cart'])) {

        global $con;

        $ip = getIp();

        $pro_id = $_GET['add_cart'];

        $run_check = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$pro_id'") or die(mysqli_error($con));

        if(mysqli_num_rows($run_check)>0) {

            echo "";
        }

     else {

        $run_pro = mysqli_query($con, "INSERT INTO cart (p_id, ip_add) values ('$pro_id','$ip')") or die(mysqli_error($con));

        echo "<script>window.open('index.php','_self')</script>";
    }
    }
}

//getting the categories

function getCats() {

    global $con;

    $run_cats = mysqli_query($con,"SELECT * FROM categories");

    while($row_cats = mysqli_fetch_array($run_cats)) {

        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

        echo "<li>
            <a href='index.php?cat=$cat_id'>$cat_title</a>
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

            <a href='index.php?brand=$brand_id'>$brand_title</a>

        </td>";
    }


}


//getting products on main page

function getPro() {

    if(!isset($_GET['cat'])){
        if(!isset($_GET['brands'])) {





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

            <a href='index.php?add_cart=$pro_id'><button>Add To Cart</button></a>
            </div>

            ";

    }
    }
}
}


//getting the category products

function getCatPro() {

    if(isset($_GET['cat'])){



        $cat_id = $_GET['cat'];


    global $con;

    $run_cat_pro = mysqli_query($con,"SELECT * FROM products WHERE product_cat = '$cat_id'");



    $count_cats = mysqli_num_rows($run_cat_pro);

    if($count_cats == 0) {

        echo "<div class='no-cat'>

        <h1> We're sorry! There are currently no products with that category. :(</h1>

        </div>";
    } else {

    while($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {

        $pro_id = $row_cat_pro['product_id'];
        $pro_cat = $row_cat_pro['product_cat'];
        $pro_brand = $row_cat_pro['product_brand'];
        $pro_title = $row_cat_pro['product_title'];
        $pro_price = $row_cat_pro['product_price'];
        $pro_image = $row_cat_pro['product_image'];

            echo "
            <div class='single-product cf'>

            <h4><a href='#'>$pro_title</a></h4>
            <a href='details.php?pro_id=$pro_id'><img src='admin/product_images/$pro_image' /></a>
            <p>
            Price: $ $pro_price
            </p>

            <a href='index.php?add_cart=$pro_id'><button>Add To Cart</button></a>
            </div>

            ";

    }
    }
}
}

//getting the brand products (in this case sex)

function getBrandPro() {

    if(isset($_GET['brand'])){



        $brand_id = $_GET['brand'];


    global $con;

    $run_brand_pro = mysqli_query($con,"SELECT * FROM products WHERE product_brand = '$brand_id'") or die(mysqli_error($con));

    $count_brands = mysqli_num_rows($run_brand_pro);

    if($count_brands == 0) {

        echo "<div class='no-cat'>

        <h1> We're sorry! There are currently no products for that sex. :(</h1>

        </div>";
    } else {

    while($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {

        $pro_id = $row_brand_pro['product_id'];
        $pro_cat = $row_brand_pro['product_cat'];
        $pro_brand = $row_brand_pro['product_brand'];
        $pro_title = $row_brand_pro['product_title'];
        $pro_price = $row_brand_pro['product_price'];
        $pro_image = $row_brand_pro['product_image'];

            echo "
            <div class='single-product cf'>

            <h4><a href='#'>$pro_title</a></h4>
            <a href='details.php?pro_id=$pro_id'><img src='admin/product_images/$pro_image' /></a>
            <p>
            Price: $ $pro_price
            </p>

            <a href='index.php?add_cart=$pro_id'><button>Add To Cart</button></a>
            </div>

            ";

    }
    }
}

}
