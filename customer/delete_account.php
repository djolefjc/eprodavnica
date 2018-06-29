<div id="container">
    <div id="main">
        <div id="delete-box">
            <h1> Are you sure you want to delete your account?</h1>
            <form action="" method="post">
                <input type="submit" name="yes" value="YES" />
                <input type="submit" name="no" value="NO" />
            </form>
        </div> <!-- END delete-box -->
    </div><!-- END main -->
</div> <!-- END container -->

<?php

$user = $_SESSION['customer_email'];

if(isset($_POST['yes'])) {

    $run_delete = mysqli_query($con,"DELETE FROM customers WHERE customer_email ='$user'");
    echo "<script>alert('You have successfuly deleted your account!')</script>";
    session_destroy();
    echo "<script>window.open('../index.php','_self')</script>";

} if(isset($_POST['no'])) {
    echo "<script>alert('You will be redirected to your account shortly.')</script>";
    echo "<script>window.open('my_account.php', '_self')</script>";
}

 ?>
