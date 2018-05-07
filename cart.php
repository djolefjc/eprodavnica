<?php
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

        </div> <!-- END shop-bar -->
        <div id="container">

            <div id="main">

                <div id="product-box-cart">

                <form action="" method="post" enctype="multipart/form-data">
                    <table>

                            <thead>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Remove</th>
                                <th>Price</th>
                            </thead>
                            <tbody>
                                <?php

                                    $total = 0;

                                    global $con;

                                    $ip = getIp();

                                    $run_price = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip'");

                                    while($row_pro_price = mysqli_fetch_array($run_price)) {

                                        $pro_id = $row_pro_price['p_id'];
                                        $pro_qty = $row_pro_price['qty'];

                                        $run_pro_price2 = mysqli_query($con,"SELECT * FROM products WHERE product_id = '$pro_id'") or die(mysqli_error($con));

                                        while($row_pro_price2 = mysqli_fetch_array($run_pro_price2)) {

                                            $pro_price = array($row_pro_price2['product_price']);
                                            $pro_title = $row_pro_price2['product_title'];
                                            $product_image = $row_pro_price2['product_image'];
                                            $single_price = $row_pro_price2['product_price'];



                                            $pro_price_values = array_sum($pro_price);


                                            $total += $pro_price_values;





                                ?>

                                <tr>
                            <td>
                                <h2><?php echo $pro_title ?></h2>
                                <img src="admin/product_images/<?php echo $product_image;?>">

                            </td>
                            <td>
                                <input type="text" name="qty" placeholder="<?php echo $pro_qty;?>">
                            </td>
                            <td>
                                <input type="checkbox" name="remove[]" value="<?php echo $pro_id ?>" />
                            </td>
                            <td>
                                <?php echo "$" . $single_price; ?>
                            </td>


                            </tr>

                            </tbody>
<?php }} ?>
                    </table>

                    <p>
                    <b>  Total Value: </b>  <?php  echo "$" . $total;?>
                    </p>
                    <div id="check-buttons">
                    <input type="submit" name="update_cart" value="Update Cart" />
                    <input type="submit" name="continue" value="Continue Shopping" />
                    <a href="checkout.php"><input type="button" value="Checkout" /></a>


                    </div>
                </form>

                <?php



                if(isset($_POST['update_cart'])) {

                    foreach($_POST['remove'] as $remove_id) {

                        $delete_product = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip'";

                        $run_delete = mysqli_query($con,$delete_product);

                        if($run_delete) {

                            echo "<script>window.open('cart.php','_self')</script>";
                        }
                    }

                }elseif(isset($_POST['continue'])) {

                    echo "<script>window.open('index.php','_self')</script>";
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
