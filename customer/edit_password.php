<div id="container">
    <div id="main">
        <div id="password-box">
        <h1>Change Your Password</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Enter Current Password:</td>
                <td><input type="password" name="current_pass" required /> </td>
            </tr>
            <tr>
            <td>Enter New Password:</td>
            <td><input type="password" name="new_pass" required /> </td>
        </tr>
            <tr>
            <td>Enter New Password Again:</td>
            <td><input type="password" name= "new_pass_confirm" required /></td>
        </tr>
<tr>

            <td colspan="2"><input type="submit" name="change_pass" value="Change Your Password" /></td>
</tr>
</table>
        </form>
    </div> <!-- END password-box -->
    </div> <!-- END MAIN -->
</div><!-- END CONTAINER -->
<?php
if(isset($_POST['change_pass'])) {

    $user = $_SESSION['customer_email'];

    $current_pass = $_POST['current_pass'];
    $new_pass = $_POST['new_pass'];
    $new_pass_confirm = $_POST['new_pass_confirm'];

    $run_pass = mysqli_query($con, "SELECT * FROM customers WHERE customer_pass = '$current_pass' AND customer_email = '$user'");

    $check_pass = mysqli_num_rows($run_pass);

    if($check_pass == 0) {
        echo "<script>alert('Wrong current password. Please try again!')</script>";
    }
    elseif($new_pass != $new_pass_confirm) {
        echo "<script>alert('Your passwords do not match. Please try again!')</script>";
    }
    else {

        $update_pass = mysqli_query($con,"UPDATE customers SET customer_pass = '$new_pass' WHERE customer_email ='$user'");

        echo "<script>alert('You have successfuly changed your password!')</script>";
        echo "<script>window.open('my_account.php','_self')</script>";
    }
}
?>
