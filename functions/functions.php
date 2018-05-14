                <?php
                //database connection

                $con = mysqli_connect("localhost","root","","eprodavnica");

                // function for getting ip address of the client
                /*In this PHP function, first attempt is to get the direct IP address of client’s machine, if not available then try for forwarded for IP address using HTTP_X_FORWARDED_FOR. And if this is also not available, then finally get the IP address using REMOTE_ADDR.*/

                function getIp()
                {
                    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
                    {
                      $ip=$_SERVER['HTTP_CLIENT_IP'];
                    }
                    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
                    {
                      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
                    }
                    else
                    {
                      $ip=$_SERVER['REMOTE_ADDR'];
                    }
                    return $ip;
                }

                //adding a single product to cart

                function cart() {

                    if(isset($_GET['add_cart'])) {

                        global $con;

                        $ip = getIp();

                        $pro_id = $_GET['add_cart'];

                        $run_check = mysqli_query($con,"SELECT * FROM cart WHERE ip_add = '$ip' AND p_id = '$pro_id'") or die(mysqli_error($con));

                        if(mysqli_num_rows($run_check)>0) {

                            echo "";
                        } else {

                        $run_pro = mysqli_query($con, "INSERT INTO cart (p_id, ip_add, qty) values ('$pro_id','$ip',1)") or die(mysqli_error($con));

                        echo "<script>window.open('index.php','_self')</script>";
                    }
                    }
                }

                //getting the total added items

                function totalItems() {
                    if(isset($_GET['add_cart'])) {

                        global $con;

                        $ip = getIp();

                        $run_items = mysqli_query($con, "SELECT * FROM cart WHERE ip_add='$ip'");

                        $count_items = mysqli_num_rows($run_items);

                    } else {
                        global $con;

                        $ip = getIp();

                        $run_items = mysqli_query($con, "SELECT * FROM cart WHERE ip_add='$ip'") or die(mysqli_error($con));

                        $count_items = mysqli_num_rows($run_items);

                        while($get_items = mysqli_fetch_array($run_items)) {

                            $pro_qty = $get_items['qty'];
                        if($pro_qty > 1) {
                            $count_items = $count_items + $pro_qty - 1;
                        }
                    }
                    }

                    echo $count_items;

                }

                //getting the total Price of items in the cart

                function totalPrice() {

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


                            $total += $pro_price_values;

                            if($pro_qty > 1) {
                                $pro_price_single_all = $pro_price_single * $pro_qty;
                                $total = $total + $pro_price_single_all - $pro_price_single;
                            }


                        }

                    }
                    echo "$" . $total;
                }


                //getting the categories

                function getCats() {

                    global $con;

                    $run_cats = mysqli_query($con,"SELECT * FROM categories");

                    while($row_cats = mysqli_fetch_array($run_cats)) {

                        $cat_id = $row_cats['cat_id'];
                        $cat_title = $row_cats['cat_title'];

                        echo "<li>
                            <a href='index.php?cat=$cat_id'>$cat_title</a>
                        </li>";
                    }


                }

                //getting the brands

                function getBrands() {

                    global $con;

                    $run_brands = mysqli_query($con,"SELECT * FROM brands");

                    while($row_brands = mysqli_fetch_array($run_brands)) {

                        $brand_id = $row_brands['brand_id'];
                        $brand_title = $row_brands['brand_title'];

                        echo "<td>

                            <a href='index.php?brand=$brand_id'>$brand_title</a>

                        </td>";
                    }


                }


                //getting products on main page

                function getPro() {

                    if(!isset($_GET['cat'])){
                        if(!isset($_GET['brands'])) {





                    global $con;

                    $run_pro = mysqli_query($con,"SELECT * FROM products ORDER BY RAND() LIMIT 0,9");

                    while($row_pro = mysqli_fetch_array($run_pro)) {

                        $pro_id = $row_pro['product_id'];
                        $pro_cat = $row_pro['product_cat'];
                        $pro_brand = $row_pro['product_brand'];
                        $pro_title = $row_pro['product_title'];
                        $pro_price = $row_pro['product_price'];
                        $pro_image = $row_pro['product_image'];

                            echo "
                            <div class='single-product cf'>

                            <h4><a href='#'>$pro_title</a></h4>
                            <a href='details.php?pro_id=$pro_id'><img src='admin/product_images/$pro_image' /></a>
                            <p>
                            Price: $ $pro_price
                            </p>

                            <a href='index.php?add_cart=$pro_id'><button>Add To Cart</button></a>
                            </div>

                            ";

                    }
                    }
                }
                }


                //getting the category products

                function getCatPro() {

                    if(isset($_GET['cat'])){



                        $cat_id = $_GET['cat'];


                    global $con;

                    $run_cat_pro = mysqli_query($con,"SELECT * FROM products WHERE product_cat = '$cat_id'");



                    $count_cats = mysqli_num_rows($run_cat_pro);

                    if($count_cats == 0) {

                        echo "<div class='no-cat'>

                        <h1> We're sorry! There are currently no products with that category. :(</h1>

                        </div>";
                    } else {

                    while($row_cat_pro = mysqli_fetch_array($run_cat_pro)) {

                        $pro_id = $row_cat_pro['product_id'];
                        $pro_cat = $row_cat_pro['product_cat'];
                        $pro_brand = $row_cat_pro['product_brand'];
                        $pro_title = $row_cat_pro['product_title'];
                        $pro_price = $row_cat_pro['product_price'];
                        $pro_image = $row_cat_pro['product_image'];

                            echo "
                            <div class='single-product cf'>

                            <h4><a href='#'>$pro_title</a></h4>
                            <a href='details.php?pro_id=$pro_id'><img src='admin/product_images/$pro_image' /></a>
                            <p>
                            Price: $ $pro_price
                            </p>

                            <a href='index.php?add_cart=$pro_id'><button>Add To Cart</button></a>
                            </div>

                            ";

                    }
                    }
                }
                }

                //getting the brand products (in this case sex)

                function getBrandPro() {

                    if(isset($_GET['brand'])){



                        $brand_id = $_GET['brand'];


                    global $con;

                    $run_brand_pro = mysqli_query($con,"SELECT * FROM products WHERE product_brand = '$brand_id'") or die(mysqli_error($con));

                    $count_brands = mysqli_num_rows($run_brand_pro);

                    if($count_brands == 0) {

                        echo "<div class='no-cat'>

                        <h1> We're sorry! There are currently no products for that gender. :(</h1>

                        </div>";
                    } else {

                    while($row_brand_pro = mysqli_fetch_array($run_brand_pro)) {

                        $pro_id = $row_brand_pro['product_id'];
                        $pro_cat = $row_brand_pro['product_cat'];
                        $pro_brand = $row_brand_pro['product_brand'];
                        $pro_title = $row_brand_pro['product_title'];
                        $pro_price = $row_brand_pro['product_price'];
                        $pro_image = $row_brand_pro['product_image'];

                            echo "
                            <div class='single-product cf'>

                            <h4><a href='#'>$pro_title</a></h4>
                            <a href='details.php?pro_id=$pro_id'><img src='admin/product_images/$pro_image' /></a>
                            <p>
                            Price: $ $pro_price
                            </p>

                            <a href='index.php?add_cart=$pro_id'><button>Add To Cart</button></a>
                            </div>

                            ";

                    }
                    }
                }

                }
// total and single price

function cartSinglePrice() {

    if(isset($_POST['qty'])) {

        $_POST['qty'] = $qty;

        $single_price = $single_price * $qty;


}
}
// country list select option

function countryList() {
    $country_array = array("Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
    foreach($country_array as $country) {
        echo "
            <option>
            $country
            </option>

        ";
    }
}
