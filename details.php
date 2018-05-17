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
                        <a href="#"> My Account</a>
                    </li>
                    <li>
                        <a href="#"> Sign Up</a>
                    </li>
                    <li>
                        <a href="#"> Shopping Card</a>
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
            <span> Welcome Guest! </span>

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

                    if(isset($_GET['pro_id'])) {

                        $product_id = $_GET['pro_id'];

                    $run_pro = mysqli_query($con,"SELECT * FROM products WHERE product_id = '$product_id'");

                    while($row_pro = mysqli_fetch_array($run_pro)) {



                        $pro_title = $row_pro['product_title'];
                        $pro_price = $row_pro['product_price'];
                        $pro_image = $row_pro['product_image'];
                        $pro_description = $row_pro['product_description'];


                            echo "
                            <div class='pro-details'>
                            <h1>$pro_title</h1>
                            <img src='admin/product_images/$pro_image' />
                            <div class='desc-details'>
                            <span> Description:</span>
                            <p>
                            $pro_description
                            </p>
                            </div>
                            <span> Price: $ $pro_price</span> &nbsp; &nbsp;
                            <a href='index.php?add_cart=$product_id'><button>Add To Cart</button></a>
                            </div>

                            ";

                    }
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
