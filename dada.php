<?php
//pressing update cart ->
if(isset($_POST['update_cart'])) {






    //removing the products
    if(isset($_POST['remove'])) {
    foreach($_POST['remove'] as $remove_id) {

        $delete_product = "DELETE FROM cart WHERE p_id = '$remove_id' AND ip_add = '$ip'";

        $run_delete = mysqli_query($con,$delete_product);

        if($run_delete) {

            echo "<script>window.open('cart.php','_self')</script>";
        }
        }
    }

        //quantity of product
        if(isset($_POST['qty'])) {

            foreach($_POST['qty'] as $qty_id) {

                $update_qty = "UPDATE cart SET qty = '$qty_id' WHERE p_id = '$pro_id' AND ip_add = '$ip'";

                $run_qty = mysqli_query($con, $update_qty) or die(mysqli_error($con));
            }


    }
    }


    elseif(isset($_POST['continue'])) {

    echo "<script>window.open('index.php','_self')</script>";
}

 ?>
