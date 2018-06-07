<?php

include("includes/database.php");


 ?>

<div id="login-form">
<form method = "post" action = "">
<h1> Login or register to buy! </h1>
<a href="checkout.php?forgot_pass" class="forgot-pass">Forgot password?</a>
<p>
    Email:
</p>
<input type="text" name="email" placeholder="Enter email" />
<br />
<p>
    Password:
</p>
<input type="password" name="pass" placeholder="Enter password" />

<br />
<button type="submit" name="login">Login Now</button>
<br />


<form>
    <span>
        Don't have an account?
    </span>
    <a href="customer_register.php">Register</a>
</div>

<?php
if(isset($_POST['login'])) {

    $c_email = $_POST['email'];
    $c_pass = $_POST['pass'];

    $run_c = mysqli_query($con, "SELECT * FROM customers WHERE customer_email = '$c_email' AND customer_pass = '$c_pass'");

    $check_c = mysqli_num_rows($run_c);

    if(!$check_c) {
        echo "<script>alert('Incorrect email or password. Please try again!')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
        exit();
    }

    $ip = getIp();

    $run_cart = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip'");

    $check_cart = mysqli_num_rows($run_cart);

    if($check_c > 0 && $check_cart == 0) {

        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('You logged in successfuly')</script>";
        echo "<script>window.open('customer/my_account.php','_self')</script>";
    } else {
        $_SESSION['customer_email'] = $c_email;
        echo "<script>alert('You logged in successfuly')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";

    }
}

 ?>
