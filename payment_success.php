










<?php session_start(); ?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Payment Successful</title>
  </head>
  <body>

    <h2> Welcome <?php echo $_SESSION['customer_email']; ?></h2>
    <h3> Your Payment Was Successful, please go to your account!</h3>
    <h3><a href="htttp://eprodavnica1.000webhostapp.com/customer/my_account.php">My account</a></h3>
  </body>
</html>
