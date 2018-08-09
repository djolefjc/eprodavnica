<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="../styles/style_admin.css" rel="stylesheet" type="text/css" />
    <title>Login</title>
  </head>
  <body>
    <div id="admin-login">

      <!-- RADI SAMO KADA NEMAS aUTORIZACIJU DA NASTAVIS -->
    <h3><?php echo @$_GET['not_admin']; echo @$_GET['out']; echo @$_GET['wrong']; ?></h3>

    <h2> Admin Login </h2>
      <form action="" method="post">
        <input type="text" name="u_name" placeholder="Username" /><br />
        <input type="password" name="u_pass" placeholder="Password" /><br />
        <button type="submit" name="login">Let Me In</button>
      </form>
      <a href="../index.php">Back to home</a>
    </div>

  </body>
</html>
<?php
session_start();
include("../includes/database.php");

      if(isset($_POST['login'])) {



        $name = mysqli_real_escape_string($con,$_POST['u_name']);
        $pass = mysqli_real_escape_string($con,$_POST['u_pass']);


        $run_admin = mysqli_query($con, "SELECT * FROM admins WHERE admin_username = '$name' AND admin_password = '$pass'")
        or die(mysqli_error($con));

        $check_admin = mysqli_num_rows($run_admin);

      if($check_admin > 0 ) {

        $_SESSION['admin_username'] = $name;

        echo "<script>window.open('index.php?logged=You have successfully logged in!','_self')</script>";

      } else {

        echo "<script>window.open('login.php?wrong=You have entered a wrong username or password!','_self')</script>";
      }
    }
