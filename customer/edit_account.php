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

 ?>
            <div id="container">

                <div id="main">

                    <div id="product-box">
                        <div id="register-box">
                        <form action = "" method="post" enctype="multipart/form-data">
                            <h1>Update your profile</h1>
                            <table>
                            <tr>

                            <td>
                                Customer Name:


                                </td>
                                <td>
                            <input type="text" name="c_name" value="<?php echo $c_name; ?>" />
                        </td>
                            </tr>
                            <tr>
                                <td>
                                Customer Email:
                            </td>
                            <td>
                            <input type="text" name="c_email" value="<?php echo $c_email;?>" />
                        </td>
                    </tr>

                    <tr>
                            <td>
                                Customer Country:
                        </td>
                        <td>
                            <select name="c_country" >
                                <option class="s_country">
                                    <?php echo $c_country; ?>
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
                            <input type="text" name="c_city" value="<?php echo $c_city; ?>"/>
                        </td>
                    </tr>
                            <tr>
                                <td>
                                Customer Address:
                            </td>
                            <td>
                            <input type="text" name="c_address" value="<?php echo $c_address; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                                Customer Contact:
                            </td>
                            <td>
                            <input type="text" name="c_contact" value="<?php echo $c_contact ?>"/>
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
                    <tr>
                        <td colspan="2">
                            <img src="customer_images/<?php echo $c_image;?>">
                        </td>
                    </tr>

                            </table>
                            <button type="submit" name="update">Update Account</button>
                        </form>


                    </div> <!-- END register box -->
                    </div> <!-- END product box -->

                </div> <!-- END main -->





    <?php

    if(isset($_POST['update'])) {
        $ip = getIp();
        $c_id = $row_all['customer_id'];
        $c_name = $_POST['c_name'];
        $c_email = $_POST['c_email'];
        $c_pass = $_POST['c_pass'];
        $c_img = $_FILES['c_img']['name'];
        $c_img_tmp = $_FILES['c_img']['tmp_name'];
        $c_country = $_POST['c_country'];
        $c_city = $_POST['c_city'];
        $c_address = $_POST['c_address'];
        $c_contact = $_POST['c_contact'];


        // ako select img = null  bira staru sliku
        if (empty($c_img)) $c_img = $row_all['customer_image'];

        $upl = move_uploaded_file($c_img_tmp,"customer_images/$c_img");


            $update_c = "UPDATE customers SET customer_name ='$c_name', customer_email = '$c_email', customer_image = '$c_img',customer_country = '$c_country', customer_city = '$c_city', customer_address = '$c_address', customer_contact = '$c_contact' WHERE customer_id = '$c_id'";

            $run_update = mysqli_query($con,$update_c);
            var_dump($run_update);

            if($run_update) {
                echo "<script>alert('Your account was successfuly updated!')</script>";
                echo "<script>window.open('my_account.php','_self')</script>";
                var_dump($run_update);
            }

    }
}
     ?>

</div> <!-- END container -->
