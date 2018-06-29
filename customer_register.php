<?php
session_start();
include("functions/functions.php");
include("includes/database.php");

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

                <div id="product-box">
                    <div id="register-box">
                    <form action = "" method="post" enctype="multipart/form-data">
                        <h1>Register now</h1>
                        <table>
                        <tr>

                        <td>
                            Customer Name:


                            </td>
                            <td>
                        <input type="text" name="c_name" required />
                    </td>
                        </tr>
                        <tr>
                            <td>
                            Customer Email:
                        </td>
                        <td>
                        <input type="text" name="c_email" required />
                    </td>
                </tr>
                        <tr>
                            <td>
                            Customer Password:
                        </td>
                        <td>
                        <input type="password" name="c_pass" required/>
                    </td>
                </tr><tr>
                        <td>
                            Customer Country:
                    </td>
                    <td>
                        <select name="c_country" required>
                            <option class="s_country">
                                Select a Country
                            </option class="s_country">

                                <?php
                                countryList();
                                ?>
                        </select>

</td>
</tr>
<tr>
    <td>
                            Customer City:
                        </td>
                        <td>
                        <input type="text" name="c_city" required/>
                    </td>
                </tr>
                        <tr>
                            <td>
                            Customer Address:
                        </td>
                        <td>
                        <input type="text" name="c_address" required />
                    </td>
                </tr>
                <tr>
                    <td>
                            Customer Contact:
                        </td>
                        <td>
                        <input type="text" name="c_contact" required/>
                    </td>
                </tr>
                        <tr>
                        <td>

                            Customer Image:
                    </td>
                    <td>
                        <input type="file" name="c_img" />
                    </td>
                </tr>

                        </table>
                        <button type="submit" name="register">Create Account</button>
                    </form>


                </div> <!-- END register box -->
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
<?php
if(isset($_POST['register'])) {
    $ip = getIp();
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_img = $_FILES['c_img']['name'];
    $c_img_tmp = $_FILES['c_img']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_address = $_POST['c_address'];
    $c_contact = $_POST['c_contact'];

    //ako korisnik nije izabrao sliku bira normalnu user sliku
    if (empty($c_img)) $c_img = "default.png";

    $upl = move_uploaded_file($c_img_tmp,"customer/customer_images/$c_img");
    var_dump($upl);


    $insert_c = "INSERT INTO customers (customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_city, customer_address, customer_contact,
        customer_image) VALUES('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_address','$c_contact','$c_img')";
        $run_c = mysqli_query($con,$insert_c);

        $run_cart = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip'");

        $check_cart = mysqli_num_rows($run_cart);

        if($check_cart==0) {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Thank you for taking your time to register!')</script>";
            echo "<script>window.open('customer/my_account.php','_self')</script>";
        }
        else {
            $_SESSION['customer_email'] = $c_email;
            echo "<script>alert('Thank you for taking your time to register!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
        }
}

 ?>
