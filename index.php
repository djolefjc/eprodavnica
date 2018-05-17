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
            <a href="index.php"><img src="images/logo.png" /></a>
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
                        <a href="#"> Sign Up</a>
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
        <?php cart(); ?>
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



                    if(isset($_GET['cat'])) {
                    getCatPro();
                }
                    elseif(isset($_GET['brand'])) {
                        getBrandPro();
                    }
                    else {
                        getPro();
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
