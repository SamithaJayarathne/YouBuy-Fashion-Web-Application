<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];
    $total = 0;
    $subtotal = 0;
    $shipping = 0;

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">

        <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">

        <title>YouBuy Fashion | Watchlist</title>
    </head>

    <body class="img1">
        <div class="container-fluid">
            <div class="row">

                <?php include "header.php" ?>

                <?php
                $watclist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                                `users_email`='" . $_SESSION["u"]["email"] . "'");
                $watchlist_num = $watclist_rs->num_rows;

                ?>
                <h1 class="col-6 fw-bold mt-3">Watchlist <i class="bi bi-heart"></i></h1>
                <h1 class="offset-4 col-2 text-danger"><?php
                if($watchlist_num==1){
                    echo $watchlist_num;
                    ?>
                    Item
                    <?php
                }else{
                    echo $watchlist_num;
                    ?> Items<?php
                }
                ?>
                </h1>
                <?php
                

                if ($watchlist_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12 emptyView"></div>
                            <div class="col-12 text-center">
                                <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                            </div>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                <a href="home.php" class="btn btn-warning fs-3 fw-bold">Start Shopping</a>
                            </div>
                        </div>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                ?>
                    <div class="table-responsive-sm">
                        <table class="table table-hover table-condensed mt-5 ">
                            <thead>
                                <tr>
                                    <th style="width:45%">Product</th>
                                    <th style="width:15%">Price</th>
                                    <th style="width:10%">Shipping</th>
                                    <th style="width:8%">Quantity</th>
                                    <th style="width:12%" class="text-center">Subtotal</th>
                                    <th style="width:10%"></th>
                                </tr>
                            </thead>
                            <?php
                            for ($x = 0; $x < $watchlist_num; $x++) {
                                $watchlist_data = $watclist_rs->fetch_assoc();
                                $pro_id = $watchlist_data["product_id"];

                            ?>


                                <tbody>

                                    <tr>
                                        <td data-th="Product">
                                            <div class="row">
                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pro_id . "'");
                                                $img_num = $img_rs->num_rows;
                                                if ($img_num != 0) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                ?>
                                                    <div class="col-sm-2 hidden-xs"><img src="<?php echo $img_data["img_path"]; ?>" alt="..." class="img-fluid" /></div>
                                                <?php
                                                }
                                                ?>

                                                <div class="col-sm-10">
                                                    <?php
                                                    $pro_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pro_id . "'");
                                                    $pro_num = $pro_rs->num_rows;
                                                    if ($pro_num != 0) {
                                                        $pro_data = $pro_rs->fetch_assoc();
                                                    ?><h4 class="nomargin"><?php echo $pro_data["title"]; ?></h4><?php
                                                                                                                }
                                                                                                                    ?>


                                                    <div>
                                                        <?php
                                                        $color = $pro_data["color_color_id"];
                                                        $color_rs = Database::search("SELECT * FROM `color` WHERE `color_id`='" . $color . "'");
                                                        $color_num = $color_rs->num_rows;
                                                        if ($color_num != 0) {
                                                            $color_data = $color_rs->fetch_assoc();
                                                        ?>
                                                            <div>Color : <?php echo $color_data["color_name"]; ?></div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div>
                                                        <?php
                                                        $size = $pro_data["size_size_id"];
                                                        $size_rs = Database::search("SELECT * FROM `size` WHERE `size_id`='" . $size . "'");
                                                        $size_num = $size_rs->num_rows;
                                                        if ($size_num != 0) {
                                                            $size_data = $size_rs->fetch_assoc();
                                                        ?>
                                                            <div>Size : <?php echo $size_data["size_name"]; ?></div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <?php
                                                    $user = $pro_data["users_email"];
                                                    $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $user . "'");
                                                    $user_num = $user_rs->num_rows;
                                                    if ($user_num != 0) {
                                                        $user_data = $user_rs->fetch_assoc();
                                                    ?>
                                                        <div>Seller : <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-th="Price">LKR <?php echo $pro_data["price"]; ?> .00</td>

                                        <?php
                                        $address_rs = Database::search("SELECT district.district_id AS `did` FROM 
                                                        `users_has_address` INNER JOIN `city` ON
                                                        users_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                                        city.district_district_id=district.district_id WHERE `users_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 7) {
                                            $ship = $pro_data["delivery_fee_kandy"];
                                            $shipping = $shipping + $pro_data["delivery_fee_kandy"];
                                        } else {
                                            $ship = $pro_data["delivery_fee_other"];
                                            $shipping = $shipping + $pro_data["delivery_fee_other"];
                                        }
                                        ?>
                                        <td data-th="Shipping">LKR <?php echo $shipping; ?> .00</td>
                                        <td data-th="Quantity">
                                        <?php echo $pro_data["qty"]; ?> items
                                        </td>
                                        <td data-th="Subtotal" class="text-center">LKR <?php echo $shipping + $pro_data["price"]; ?> .00</td>
                                        <td class="actions" data-th="">
                                            <button class="btn btn-warning btn-sm" onclick="addToCart(<?php echo $pro_data['id'];?>);"><i class="bi bi-cart3"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                </tbody>


                            <?php
                            }
                            ?>

                        </table>
                    </div>
                    

                    <div class="col-12"></div>
                    

                <?php

                }
                ?>



               
            </div>
        </div>



    </body>

    </html>

<?php
}

?>