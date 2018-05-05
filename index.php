<?php
include("functions/functions.php");


 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <title>Prodavnica+</title>
    </head>
    <body>
        <div id="header" class="cf">
            <img src="images/logo.png" />
            <div id="navbar">
                <ul>
                    <li>
                        <a href="#"> Home</a>
                    </li>
                    <li>
                        <a href="#"> Products</a>
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
                <form method="get" action="includes/results.php" enctype="multipart/form-data">
                    <input type="text" name="search_query" placeholder="Search Product" />
                    <input type="submit" name="searchd_button" value="Search"

                </form>
            </div>
        </div> <!-- END header -->

        <div id="container">
            <div id="main">
                <div id="product-box">
                    <?php
                    getPro();
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
