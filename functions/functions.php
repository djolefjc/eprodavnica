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

                //adding a single product to cart

                function cart() {

                    if(isset($_GET['add_cart'])) {

                        global $con;

                        $ip = getIp();

                        $pro_id = $_GET['add_cart'];

                        $run_check = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$pro_id'") or die(mysqli_error($con));

                        if(mysqli_num_rows($run_check)>0) {

                            echo "";
                        } else {

                        $run_pro = mysqli_query($con, "INSERT INTO cart (p_id, ip_add, qty) values ('$pro_id','$ip',1)") or die(mysqli_error($con));

                        echo "<script>window.open('index.php','_self')</script>";
                    }
                    }
                }

                //getting the total added items

                function totalItems() {
                    if(isset($_GET['add_cart'])) {

                        global $con;

                        $ip = getIp();

                        $run_items = mysqli_query($con, "SELECT * FROM cart WHERE ip_add='$ip'");

                        $count_items = mysqli_num_rows($run_items);

                    } else {
                        global $con;

                        $ip = getIp();

                        $run_items = mysqli_query($con, "SELECT * FROM cart WHERE ip_add='$ip'") or die(mysqli_error($con));

                        $count_items = mysqli_num_rows($run_items);

                        while($get_items = mysqli_fetch_array($run_items)) {

                            $pro_qty = $get_items['qty'];
                        if($pro_qty > 1) {
                            $count_items = $count_items + $pro_qty - 1;
                        }
                    }
                    }

                    echo $count_items;

                }

                //getting the total Price of items in the cart

                function totalPrice() {

                    $total = 0;

                    global $con;

                    $ip = getIp();

                    $run_price = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip'");

                    while($row_pro_price = mysqli_fetch_array($run_price)) {

                        $pro_id = $row_pro_price['p_id'];
                        $pro_qty = $row_pro_price['qty'];

                        $run_pro_price2 = mysqli_query($con,"SELECT * FROM products WHERE product_id = '$pro_id'");

                        while($row_pro_price2 = mysqli_fetch_array($run_pro_price2)) {

                            $pro_price = array($row_pro_price2['product_price']);

                            $pro_price_single = $row_pro_price2['product_price'];

                            $pro_price_values = array_sum($pro_price);


                            $total += $pro_price_values;

                            if($pro_qty > 1) {
                                $pro_price_single_all = $pro_price_single * $pro_qty;
                                $total = $total + $pro_price_single_all - $pro_price_single;
                            }


                        }

                    }
                    echo "$" . $total;
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

                        <h1> We're sorry! There are currently no products for that gender. :(</h1>

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
// total and single price

function cartSinglePrice() {

    if(isset($_POST['qty'])) {

        $_POST['qty'] = $qty;

        $single_price = $single_price * $qty;


}
}
