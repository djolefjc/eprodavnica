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

                                            $num_row_price = mysqli_num_rows($run_price);
                                            if(!$num_row_price) {
                                                echo "<div style='position:relative; top:100px; left:100px; width:100%;height:500px; background:#fff;'>
                                                <h1 style='font-size:40px;'>Your cart seems to be empty :(</h1>
                                                </div>

                                                ";
                                            } else {
                                            while($row_pro_price = mysqli_fetch_array($run_price)) {

                                                $pro_id = $row_pro_price['p_id'];
                                                $pro_qty = $row_pro_price['qty'];

                                                $run_pro_price2 = mysqli_query($con,"SELECT * FROM products WHERE product_id = '$pro_id'") or die(mysqli_error($con));

                                                while($row_pro_price2 = mysqli_fetch_array($run_pro_price2)) {

                                                    $pro_price = array($row_pro_price2['product_price']);
                                                    $pro_title = $row_pro_price2['product_title'];
                                                    $product_image = $row_pro_price2['product_image'];
                                                    $single_price = $row_pro_price2['product_price'];
                                                    $pro_price_single = $row_pro_price2['product_price'];




                                                    $pro_price_values = array_sum($pro_price);


                                                    $total += $pro_price_values;

                                                    if($pro_qty > 0) {
                                                        $single_price = $single_price * $pro_qty;

                                                        $total = $total + $single_price - $pro_price_single;

                                                    }

                                        ?>

                                        <form action="" method="post" enctype="multipart/form-data"  >


                                        <tr>
                                    <td>
                                        <h2><?php echo $pro_title ?></h2>
                                        <img src="admin/product_images/<?php echo $product_image;?>">

                                    </td>
                                    <td>
                                        <input type="text" name="qty" value = "<?php echo $pro_qty;?>">
                                        <button  type="submit" name="qty_btn" value = "<?php echo $pro_id ?>">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    </td>

                                    <td>
                                        <button type="submit" name="remove" value="<?php echo $pro_id?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    </td>
                                    <td>
                                        <?php echo "$" . $single_price; ?>
                                    </td>

                                    </tr>

                                                        </form>


        <?php




     }} }?>
                                    </tbody>
                                       </table>
                            <p>
                            <b>  Total Value: </b>  <?php  echo "$" . $total;?>
                            </p>

                            <div id="check-buttons">
                                <a href="index.php"><input type="submit" name="continue" value="Continue Shopping" /></a>
                            <a href="checkout.php"><input type="button" value="Checkout" /></a>


                            </div>

                        <?php


                        if(isset($_POST['remove'])) {
                            $remove_id = $_POST['remove'];

                            $run_r = mysqli_query($con, "DELETE FROM cart WHERE p_id ='$remove_id' AND ip_add = '$ip'");

                            if($run_r) {
                                echo "<script>window.open('cart.php','_self')</script>";
                            }


                        }
                        if(isset($_POST['qty_btn'])) {

                            $qty_id = $_POST['qty_btn'];
                            $qty = $_POST['qty'];

                            $run_qty = mysqli_query($con,"UPDATE cart SET qty = '$qty' WHERE p_id = '$qty_id' AND ip_add = '$ip'");

                                if($run_qty) {


                                     echo "<script>window.open('cart.php','_self')</script>";
                                     $single_price *= $qty;
                                     $total = $total + $single_price;
                                }


                        }

                        if(isset($_GET['continue'])) {

                            echo "<script>window.open('index.php''_self')</script>";
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
