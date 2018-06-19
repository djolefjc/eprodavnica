<?php
session_start();
include("../functions/functions.php");

if(!isset($_SESSION['customer_email'])) {

    echo "<script>window.open('../checkout.php','_self')</script>";
}

 ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="../styles/style_account.css" />
        <title>Prodavnica+</title>
    </head>
    <body>
        <div id="header" class="cf">
            <a href="index.php"><img src="../images/logo.png" /></a>
            <div id="navbar">
                <ul>
                    <li>
                        <a href="../index.php"> Home</a>
                    </li>
                    <li>
                        <a href="../all_products.php"> Products</a>
                    </li>
                    <li>
                        <a href="../customer/my_account.php"> My Account</a>
                    </li>
                    <li>
                        <?php
                         if(!isset($_SESSION['customer_email'])) {
                            echo "<a href='customer_register.php'>Sign Up</a>";
                         }


                         ?>
                    </li>
                    <li>
                        <a href="../cart.php"> Shopping Card</a>
                    </li>
                    <li>
                        <a href="../#"> Contact Us</a>
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
            <span>
                <?php
                if(isset($_SESSION['customer_email'])) {
                    $c_email = $_SESSION['customer_email'];
                    $select_user = mysqli_query($con,"SELECT * FROM customers WHERE customer_email = '$c_email' ");
                    $row_all = mysqli_fetch_array($select_user);
                    $c_id = $row_all['customer_id'];
                    $c_name = $row_all['customer_name'];
                    $c_country = $row_all['customer_country'];
                    $c_city = $row_all['customer_city'];
                    $c_address = $row_all['customer_address'];
                    $c_contact = $row_all['customer_contact'];
                    $c_image = $row_all['customer_image'];
                    echo "Welcome " . $c_name;
                }else {
                    echo "Welcome Guest";
                }
                 ?>
             </span>

            <?php
            if(!isset($_SESSION['customer_email'])) {
                echo "<a href='../checkout.php' class='sign'>Login</a>";

            } else {
                echo "<a href='../logout.php' class='sign'>Logout</a>";
            }
             ?>
        </div> <!-- END shop-bar -->
        <div id="container">

            <div id="main">

                <div id="customer-box">
                    <?php
                    if(!isset($_GET['edit'])) {
                        if(!isset($_GET['orders'])) {
                            if(!isset($_GET['pass'])) {
                                if(!isset($_GET['delete'])) {


                    $user = $_SESSION['customer_email'];

                    $run_img = mysqli_query($con,"SELECT * FROM customers WHERE customer_email = '$user'");

                    $row_img = mysqli_fetch_array($run_img);

                    $c_image = $row_img['customer_image'];
                    $c_name = $row_img['customer_name'];
                    $c_email = $row_img['customer_email'];

                    echo "<div class='customer-main'><img src='customer_images/$c_image' />
                    <p>
                    Name : $c_name
                    </p>
                    <p>
                    Email : $c_email
                    </p>
                    </div>
                    ";
                }
            }
        }
    }
                     ?>
                </div> <!-- END customer box -->

            </div> <!-- END main -->


            <div id="side" class="side-customer">
                <?php
                if(isset($_GET['edit'])) {
                    include("edit_account.php");
                } if(isset($_GET['pass'])) {
                    include("edit_password.php");
                } if(isset($_GET['delete'])) {
                    include("delete_account.php");
                }
                 ?>

                    <h2>My Account</h2>
                    <hr />
                    <ul>

                        <li>
                            <a href="my_account.php?orders">My Orders</a>
                        </li>
                        <li>
                            <a href="my_account.php?edit">Edit Account</a>
                        </li>
                        <li>
                            <a href="my_account.php?pass">Change Password</a>
                        </li>
                        <li>
                            <a href="my_account.php?delete">Delete Account</a>
                        </li>
                        <li>
                            <a href="../logout.php">Logout</a>
                        </li>
                    </ul>


            </div> <!-- END side -->

        </div> <!--END container -->

        <div id="footer" >
            <p>&copy; 2018 by Djordje Stamenkovic</p>
        </div> <!-- END footer -->

    </body>
</html>
