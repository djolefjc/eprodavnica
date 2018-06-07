<?php
session_start();
include("functions/functions.php");


 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <title>Prodavnica+</title>
    </head>
    <body>
        <div id="header" class="cf">
            <img src="images/logo.png" />
            <div id="navbar">
                <ul>
                    <li>
                        <a href="index.php"> Home</a>
                    </li>
                    <li>
                        <a href="all_products.php"> Products</a>
                    </li>
                    <li>
                        <a href="customer/my_account.php"> My Account</a>
                    </li>
                    <li>
                        <?php
                         if(!isset($_SESSION['customer_email'])) {
                            echo "<a href='customer_register.php'>Sign Up</a>";
                         }

                         ?>
                    </li>
                    <li>
                        <a href="cart.php"> Shopping Card</a>
                    </li>
                    <li>
                        <a href="#"> Contact Us</a>
                    </li>
                </ul>
            </div> <!-- END navbar -->
            <div id="search">
                <form method="get" action="results.php" enctype="multipart/form-data">
                    <input type="text" name="search_query" placeholder="Search Product" />
                    <input type="submit" name="search_button" value="Search" />

                </form>
            </div>
        </div> <!-- END header -->

        <div id="shop-bar">
            <p>
                Total items: <?php totalItems() ?>
            </p>
            <p>
                Total price: <?php totalPrice()?>
            </p>
            <a href="cart.php"><i class="fas fa-shopping-cart">   | </i></a>
            <span>
                <?php
                if(isset($_SESSION['customer_email'])) {
                    $c_email = $_SESSION['customer_email'];
                    $select_user = mysqli_query($con,"SELECT * FROM customers WHERE customer_email = '$c_email' ");
                    $row_all = mysqli_fetch_array($select_user);
                    $c_name = $row_all['customer_name'];
                    echo "Welcome " . $c_name;
                }else {
                    echo "Welcome Guest";
                }
                 ?>
            </span>

            <?php
            if(!isset($_SESSION['customer_email'])) {
                echo "<a href='checkout.php' class='sign'>Login</a>";

            } else {
                echo "<a href='logout.php' class='sign'>Logout</a>";
            }
             ?>
        </div> <!-- END shop-bar -->
        <div id="container">

            <div id="main">

                <div id="product-box">
                    <?php


                    getCatPro();

                    getBrandPro();

                        $run_pro = mysqli_query($con,"SELECT * FROM products");

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

                    ?>
                </div> <!-- END product box -->

            </div> <!-- END main -->


            <div id="side">
                <div id="side-category">
                    <h2>Categories</h2>
                    <hr />
                    <table id="mw">
                        <tr>
                            <?php
                            getBrands();
                             ?>
                        </tr>
                    </table>

                    <ul>

                        <?php
                        getCats();
                         ?>

                    </ul>
                </div><!-- END side-category-->

            </div> <!-- END side -->

        </div> <!--END container -->

        <div id="footer">
            <p>&copy; 2018 by Djordje Stamenkovic</p>
        </div> <!-- END footer -->

    </body>
</html>
