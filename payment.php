<div id="payment-box">
<?php

include("includes/database.php");


  $total = 0;

  global $con;

  $ip = getIp();

  $run_price = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip'");

  while($row_pro_price = mysqli_fetch_array($run_price)) {

      $pro_id = $row_pro_price['p_id'];
      $pro_qty = $row_pro_price['qty'];

      $run_pro_price2 = mysqli_query($con,"SELECT * FROM products WHERE product_id = '$pro_id'");

      while($row_pro_price2 = mysqli_fetch_array($run_pro_price2)) {

          $pro_price = array($row_pro_price2['product_price']);

          $pro_price_single = $row_pro_price2['product_price'];

          $pro_price_values = array_sum($pro_price);

          $product_name = $row_pro_price2['product_title'];


          $total += $pro_price_values;

          if($pro_qty > 1) {
              $pro_price_single_all = $pro_price_single * $pro_qty;
              $total = $total + $pro_price_single_all - $pro_price_single;
          }


      }

  }
  ?>

<h1> Pay with PayPal: </h1>
<br />
<br />
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="prodavac1@shop.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
  <input type="hidden" name="amount" value="<?php echo $total; ?>">
  <input type="hidden" name="currency_code" value="USD">


  <input type="hidden" name="return" value="https://eprodavnica1.000webhostapp.com/index.php?pay_s" />
  <input type="hidden" name="cancel_return" value="http://eprodavnica1.000webhostapp.com/index.php?pay_c" />

  <!-- Display the payment button. -->

  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  alt="Buy Now">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>
<h2>Total amount:<?php echo "$" . $total;  ?></h2>
</div> <!-- END payment-box -->
